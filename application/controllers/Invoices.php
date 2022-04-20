<?php
class Invoices extends CI_Controller
{

    public function home_function()
    {
        $data['invoices'] = $this->invoice_model->get_invoices_for_buyer("Protech", "buyer");
        $this->load->view('templates/header');
        $this->load->view('pages/home', $data);
        $this->load->view('templates/footer');
    }
    public function index()
    {
        $data['items'] = $this->item_model->get_items();
        $data['companies'] = $this->company_model->get_companies();
        $this->load->view('templates/header');
        $this->load->view('invoices/invoice_create', $data);
        $this->load->view('templates/footer');
    }

    public function view_all($offset = 0)
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'invoices/view_all';
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $config['total_rows'] = $this->db->count_all('invoices');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['first_link'] = "Prva";
        $config['last_link'] = false;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Sledeća';
        $config['next_tag_open'] = '<li><i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Predhodna';
        $config['prev_tag_open'] = '<li><i class="fa fa-long-arrow-left"></i>';
        $config['prev_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'pagination-links');

        $data['invoices'] = $this->invoice_model->get_invoices($config['per_page'], $offset);
        $this->pagination->initialize($config);
        $this->load->view('templates/header');
        $this->load->view('invoices/invoice_index', $data);
        $this->load->view('templates/footer');
        // echo json_encode($data);
    }

    public function create()
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }

        $this->form_validation->set_rules('inv-num', 'Inovice number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('seller', 'Seller', 'trim|required');
        $this->form_validation->set_rules('buyer', 'Buyer', 'trim|required');
        $this->form_validation->set_rules('currency', 'Currency', 'trim');
        $this->form_validation->set_rules('discount', 'Discount', 'trim|numeric');
        $this->form_validation->set_rules('pay-deadline', 'Payment deadline', 'trim|required');
        $this->form_validation->set_rules('total', 'Total cost', 'trim');

        if ($this->form_validation->run() === false) {
            $data['items'] = $this->item_model->get_items();
            $data['companies'] = $this->company_model->get_companies();
            $this->load->view('templates/header');
            $this->load->view('invoices/invoice_create', $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('invoice_not_created', 'Faktura nije dodana u bazu');
        } else {
            $date = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Y-m-d");
            // $inv_num = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Ymd") . "/" . $this->input->post('inv-num');
            $pay_deadline = date_create_from_format("Y-m-d", $this->input->post('pay-deadline'))->format("Y-m-d");
            $total = 0;
            $discount = 0;
            $letters = '';
            if (!empty($_POST['total'])) {
                $total = $this->input->post('total');
            }
            if (!empty($_POST['discount'])) {
                $discount = $this->input->post('discount');
            }
            if (!empty($_POST['letters'])) {
                $letters = $this->input->post('letters');
            }
            $data = array(
                'inv_num' =>$this->input->post('inv-num'),
                'date' => $date,
                'seller' => $this->input->post('seller'),
                'buyer' => $this->input->post('buyer'),
                'currency' => $this->input->post('currency'),
                'discount' => $discount,
                'pay_deadline' => $pay_deadline,
                'total' => $total,
                'payed' => 0,
                'due' => 0,
                'letters' => $letters,
                'profaktura' => !empty($this->input->post('profaktura')) ? 1 : 0,
                'avans' => !empty($this->input->post('avans')) ? 1 : 0,
                'konacni' => !empty($this->input->post('konacni')) ? 1 : 0,
                'gotovinski' => !empty($this->input->post('gotovinski')) ? 1 : 0,
                'notes' => $this->input->post('notes'),
            );
            if ($created = $this->invoice_model->create($data)) {
                $data['invoice'] = $this->invoice_model->get_one($this->input->post('inv-num'));
                $data['items'] = $this->item_model->get_items();
                $this->session->set_flashdata('invoice_created', 'Faktura uspesno dodana u bazu');
                $this->session->set_flashdata('invoice', $data['invoice']);

                redirect('invoices/view/' . $data['invoice']['id'], 'refresh');
            } else {
                $this->db->error();
            }
        }
    }
    public function update()
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $id = $this->uri->segment(3);
        if ($id === null) {
            $id = false;
        }
        $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id);
        $data['invoice_items'] = $this->invoice_item_model->get_inv_items($id);
        $total_with_tax = 0;
        $tax_count = 0;
        $without_tax = 0;
        $items = $data['invoice_items'];
        $total_inv = 0;
        $invoice = $this->invoice_model->get_one_by_id($id);
        $new_payment = !empty($this->input->post('payed')) ? $this->input->post('payed') : 0;
        $payed = $invoice['payed'] + $new_payment;
        $date = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Y-m-d");
        $pay_deadline = date_create_from_format("Y-m-d", $this->input->post('pay-deadline'))->format("Y-m-d");

        foreach ($items as $key => $value) {
            $without_tax += $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
            $tax_count += $without_tax*($value['tax']/100);
            $total_with_tax += ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
        }
        if (empty($items)) {
            $total_inv = $data['invoice']['total'];
        }
        $total_inv = ($total_with_tax - ($total_with_tax * $this->input->post('discount') / 100)) + $data['invoice']['total'];
        $data = array(
            'date' => $date,
            'buyer' =>  $this->input->post('buyer'),
            'seller' =>  $this->input->post('seller'),
            'payed' => $payed,
            'discount' => $this->input->post('discount'),
            'inv_num' => $this->input->post('inv-num'),
            'pay_deadline' => $pay_deadline,
            'total' => 100,
            'notes' => $this->input->post('notes'),
            'letters' => $this->input->post('letters'),
            'due' => $total_inv - $payed,
        );
        $this->invoice_model->update($data, $id);
        redirect('invoices/view/' . $id);
        echo json_encode($data);
    }

    public function delete()
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $id = $this->uri->segment(3);
        if ($id === null) {
            $id = false;
        }
        $this->invoice_model->delete($id);
        $this->invoice_item_model->delete_by_inv($id);
        redirect('invoices/view_all');
        // echo json_encode($id);
    }

    public function view()
    {
        $id = $this->uri->segment(3);
        if ($id === null) {
            $id = false;
        }
        $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id);
        $this->session->set_flashdata('invoice2', $data['invoice']);
        $data['items'] = $this->item_model->get_items();
        $data['companies'] = $this->company_model->get_companies();
        $data['invoice_items'] = $this->invoice_item_model->get_inv_items($id);
        $data['inv_total_with_tax'] = 0;
        $data['tax_count'] = 0;
        $data['without_tax'] = 0;
        $items = $data['invoice_items'];
        $html = '';
        $data['total_inv'] = 0;
        $data['payed'] = 0;
        $data['due'] = 0;

        foreach ($items as $key => $value) {
            $xxx = $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
            $data['without_tax'] +=  $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
            $data['tax_count'] += $xxx *($value['tax']/100); 
            $data['inv_total_with_tax'] += $value['total'];
        }
        $data['total_inv'] = $data['inv_total_with_tax'] - ($data['inv_total_with_tax'] * $data['invoice']['discount'] / 100);
        $html_total = 
            '<td>Total</td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td class="number">' .  number_format($data['without_tax'],2) . '</td><td></td>' .
            '<td class="number">' .  number_format($data['tax_count'],2) . '</td>' .
            '<td class="number">' .  number_format($data['inv_total_with_tax'],2) . '</td><td></td><td></td>';
        $data['html'] = $html;
        $data['html_total'] = $html_total;
        $inovice_update['total'] = $data['inv_total_with_tax'] - ($data['inv_total_with_tax'] * $data['invoice']['discount'] / 100);
        $inovice_update['payed'] = $data['invoice']['payed'] + $this->input->post('payed');
        $inovice_update['due'] = $inovice_update['total'] - $inovice_update['payed'];
        $this->invoice_model->update($inovice_update, $id);
        $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id);
        $data['total_inv'] = $inovice_update['total'];
        $this->load->view('templates/header');
        $this->load->view('invoices/invoice_view', $data);
        $this->load->view('templates/footer');
    }

    public function make_pdf()
    {
        $id = $this->uri->segment(3);
        if ($id === null) {
            $id = false;
        }
        $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id);
        $data['items'] = $this->item_model->get_items();
        $data['invoice_items'] = $this->invoice_item_model->get_inv_items($id);
        $data['inv_total_with_tax'] = 0;
        $data['tax_count'] = 0;
        $data['without_tax'] = 0;
        $items = $data['invoice_items'];
        $html = '';
        $data['total_inv'] = 0;
        $data['payed'] = 0;
        $data['due'] = 0;
        foreach ($items as $key => $value) {
            $xxx = $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
            $data['without_tax'] +=  $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
            $data['tax_count'] += $xxx *($value['tax']/100); 
            $data['inv_total_with_tax'] += $value['total'];
        }
        $data['total_inv'] = number_format($data['inv_total_with_tax'] - ($data['inv_total_with_tax'] * $data['invoice']['discount'] / 100), 2);
        $html_total = '<tr class="total">' .
            '<td>Ukupno</td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td></td>' .
            '<td>' . number_format($data['without_tax'], 2). '</td>' .
            '<td></td>><td>' . number_format($data['tax_count'], 2) . '</td>' .
            '<td>' . number_format($data['inv_total_with_tax'], 2) . '</td></tr>';
        $data['html_total'] = $html_total;
        $type = '';
        if($data['invoice']['avans'] == 1){
            $type = 'Avansni račun';
        }elseif($data['invoice']['profaktura'] == 1){
            $type = "Predračun";
        }elseif($data['invoice']['konacni'] == 1){
            $type = "Konačni račun";
        }elseif($data['invoice']['gotovinski'] == 1){
            $type = "Gotovinski račun";
        }else{
            $type = "Račun";
        }
        $data['type'] = $type;
        // $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id);
        // $this->load->view('templates/header');
        // $this->load->view('invoices/pdf_view', $data);
        // $this->load->view('templates/footer');
        $this->load->library('pdf');
        $dompdf = new Dompdf\Dompdf();
        // $dompdf->set_option('defaultFont', 'DejaVu Sans');
        $dompdf->set_option('isRemoteEnabled', true);
        $html = $this->load->view('invoices/pdf_view', $data, true);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->set_option('isFontSubsettingEnabled', true);
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdf = $dompdf->output();
        $filename = $data['invoice']['date'] . '-' . $data['invoice']['buyername'];
        $dompdf->stream($filename, array("Attachment" => 0));
    }

   

    public function get_stat()
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $date_from ="";
        $date_to = "";
        $currency = "";
        $total_max = "";
        $total_min = "";
        $pay_deadline = "";
        $bors = "";
        $type = "";
        if (!empty($_POST['bors'])) {
            $bors = $this->input->post('bors');
        }
        if (!empty($_POST['date-from'])) {
            $date_from = date_create_from_format("Y-m-d", $this->input->post('date-from'))->format("Y-m-d");
        }
        if (!empty($_POST['date-to'])) {
            $date_to = date_create_from_format("Y-m-d", $this->input->post('date-to'))->format("Y-m-d");
        }
        if (!empty($_POST['pay-deadline'])) {
            $pay_deadline = date_create_from_format("Y-m-d", $this->input->post('pay-deadline'))->format("Y-m-d");
        }
        if (!empty($_POST['currency'])) {
            $currency = $this->input->post('currency');
        }
        if (!empty($_POST['total-max'])) {
            $total_max = $this->input->post('total-max');
        }
        if (!empty($_POST['total-min'])) {
            $total_min = $this->input->post('total-min');
        }
        $prof = !empty($this->input->post('profaktura')) ? 1 : 0;
        $avans = !empty($this->input->post('avans')) ? 1 : 0;
        $konacni =  !empty($this->input->post('konacni')) ? 1 : 0;
        $gotovinski =  !empty($this->input->post('gotovinski')) ? 1 : 0;
        $company = $this->input->post('company');
        $data = $this->invoice_stat_monthly();
        $data['company'] = $this->company_model->get_one($this->input->post('company'));
        $data['bors'] = $bors;
        $data['companies'] = $this->company_model->get_companies();
        $data['invoices'] = $this->invoice_model->get_inv_num_for_company($company, $bors, $date_from, $date_to, $pay_deadline, $currency, $avans, $prof, $konacni, $gotovinski);
        $data['total'] = $this->invoice_model->get_total_and_due($company, $bors, $date_from, $date_to, $pay_deadline, $currency, $avans, $prof, $konacni, $gotovinski);
        $this->load->view('templates/header');
        $this->load->view('invoices/stat', $data);
        $this->load->view('templates/footer');
        // echo json_encode($data['total']);
    }
    public function invoice_stat_monthly()
    {
        $this_month = date('m');
        $last_month = date('m', strtotime('now - 1 month'));

        $data['this_in'] = $this->invoice_model->get_income($this_month);
        $data['this_out'] = $this->invoice_model->get_outcome($this_month);
        $data['last_in'] = $this->invoice_model->get_income($last_month);
        $data['last_out'] = $this->invoice_model->get_outcome($last_month);
        $data['income_total'] = $this->invoice_model->get_income();
        $data['outcome_total'] = $this->invoice_model->get_outcome();
        // $this->load->view('templates/header');
        // $this->load->view('invoices/stat', $data);
        // $this->load->view('templates/footer');
        return $data;
    }
    public function stat()
    {
        $data = $this->invoice_stat_monthly();
        $data['companies'] = $this->company_model->get_companies();
        $this->load->view('templates/header');
        $this->load->view('invoices/stat', $data);
        $this->load->view('templates/footer');
    }
}