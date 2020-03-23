<?php 
    class Invoices extends CI_Controller{
      
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
            $this->load->library('pagination');

            $config['base_url'] = base_url().'invoices/view_all';
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
        }

      
        public function create()
        {
            $this->form_validation->set_rules('inv-num', 'Inovice number', 'required|numeric');
            $this->form_validation->set_rules('date', 'Date', 'trim|required');
            $this->form_validation->set_rules('seller', 'Seller', 'trim|required');
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|required');
            $this->form_validation->set_rules('currency', 'Currency', 'trim');
            $this->form_validation->set_rules('discount', 'Discount', 'trim|numeric');
            $this->form_validation->set_rules('pay-deadline', 'Payment deadline', 'trim');
            $this->form_validation->set_rules('total', 'Total cost', 'trim');
            $date = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Y-m-d");
            $inv_num = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Ymd") . "/" .  $this->input->post('inv-num');
            $pay_deadline = date_add(date_create_from_format("Y-m-d", $this->input->post('date')),date_interval_create_from_date_string($this->input->post('pay-deadline') . " days"))->format("Y-m-d");
            $total = 0;
            if(!empty($_POST['total'])){
                $total = $this->input->post('total');
            }
            $data = array(
                'inv_num' => $inv_num,
                'date' =>  $date,
                'seller' => $this->input->post('seller'),
                'buyer' => $this->input->post('buyer'),
                'currency' => $this->input->post('currency'),
                'discount' => $this->input->post('discount'),
                'pay_deadline' => $pay_deadline,
                'total' => $total,
                'profaktura' => !empty($this->input->post('profaktura')) ? 1 : 0,
                'avans' => !empty($this->input->post('avans')) ? 1 : 0,
                'notes' => $this->input->post('notes')
            );
            if($this->form_validation->run() === FALSE){
                $data['items'] = $this->item_model->get_items();
                $data['companies'] = $this->company_model->get_companies();
                $this->load->view('templates/header');
                $this->load->view('invoices/invoice_create', $data);
                $this->load->view('templates/footer');  
                $this->session->set_flashdata('invoice_not_created', 'Faktura nije dodana u bazu');
            }else{
                if($created = $this->invoice_model->create($data)){
                    $data['invoice'] = $this->invoice_model->get_one($inv_num);
                    $data['items'] = $this->item_model->get_items();
                    $this->session->set_flashdata('invoice_created', 'Faktura uspesno dodana u bazu');
                    $this->session->set_flashdata('invoice', $data['invoice']);
                    
                    redirect('invoices/view/' . $data['invoice']['id'] , 'refresh');
                }else{
                    $this->db->error();
                }
            }
        }
        
        public function view()
        { 
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id) ;
            $this->session->set_flashdata('invoice2', $data['invoice']);
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
                
                $html .= '<tr>'. 
                            '<td>'. $value['sellers_code'] . '</td>'.
                            '<td>'.$value['name'].'</td>'.
                            '<td>'.$value['mes_unit'].'</td>'.
                            '<td><input type="text" name="quantity"  class="quantity" size="3" value="'.$value['quantity'].'"></td>'.
                            '<td><input type="text" name="tax"  class="tax" size="3" value="'.$value['tax'].'"></td>'.
                            '<td><input type="text" name="price"  class="price" size="7" value="'.$value['price'].'"></td>'.
                            '<td>'.($value['quantity']*$value['price']*($value['tax']/100)).'</td>'.
                            '<td>'.($value['quantity']*$value['price']).'</td>'.
                            '<td>'.$value['total'].'</td>'.
                            '<td><button class="btn-default text-primary edit-item" type="submit"><i class="fas fa-pen"></i></button><input type="hidden" class="form-control discount" value="'.$value['id'].'"></td><td><button class="bg-red text-danger btn-default delete-item" type="submit"><i class="fas fa-trash-alt"></i></button></td></tr>';
                $data['tax_count'] += $value['price']*($value['tax']/100)*$value['quantity'];
                $data['without_tax'] += $value['price']*$value['quantity'];
                $data['inv_total_with_tax'] += ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
            }
            $data['total_inv'] = $data['inv_total_with_tax'] - ($data['inv_total_with_tax']*$data['invoice']['discount']/100);
            $html_total = '<tr>'.
            '<td>Total</td>'.
            '<td></td>'.
            '<td></td>'.
            '<td></td>'.
            '<td></td>'.
            '<td></td>'.
            '<td>'.$data['tax_count'].'</td>'.
            '<td>'.$data['without_tax'].'</td>'.
            '<td>'.$data['inv_total_with_tax'].'</td></tr>';
            $data['html'] = $html;
            $data['html_total'] = $html_total;
            $inovice_update['total'] =  $data['inv_total_with_tax'] - ($data['inv_total_with_tax']*$data['invoice']['discount']/100);
            $inovice_update['payed'] = $data['invoice']['payed'] + $this->input->post('payed');
            $inovice_update['due'] = $inovice_update['total'] - $inovice_update['payed'];
            $this->invoice_model->update($inovice_update, $id);
            $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id) ;
            $data['total_inv'] = $inovice_update['total'];
            $this->load->view('templates/header');
            $this->load->view('invoices/invoice_view', $data);
            $this->load->view('templates/footer');

        }

        public function update()
        {
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id) ;
            // $this->session->set_flashdata('invoice2', $data['invoice']);
            $data['invoice_items'] = $this->invoice_item_model->get_inv_items($id);
            $total_with_tax = 0;
            $tax_count = 0;
            $without_tax = 0;
            $items = $data['invoice_items'];
            $total_inv = 0;
            $invoice = $this->invoice_model->get_one_by_id($id);
            $payed = $invoice['payed'] + $this->input->post('payed');
            $date = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Y-m-d");
            $pay_deadline = date_add(date_create_from_format("Y-m-d", $this->input->post('date')),date_interval_create_from_date_string($this->input->post('pay-deadline') . " days"))->format("Y-m-d");
            
            foreach ($items as $key => $value) {
                $tax_count += $value['price']*($value['tax']/100)*$value['quantity'];
                $without_tax += $value['price']*$value['quantity'];
                $total_with_tax += ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
            }
            if(empty($items)){
                $total_inv = $data['invoice']['total'];
            }
            $total_inv = ($total_with_tax - ($total_with_tax*$this->input->post('discount')/100)) + $data['invoice']['total'];
            // $payed = $invoice['payed'] + $this->input->post('payed');
            $data = array(
                'date' =>  $date,
                'payed' => $payed,
                //     // 'currency' => $this->input->post('currency'),
                'discount' => $this->input->post('discount'),
                'pay_deadline' => $pay_deadline,
                'total' =>$total_inv,
                'notes' => $this->input->post('notes'),
                'due' => $total_inv - $payed
            );
            $this->invoice_model->update($data, $id);
            redirect('invoices/view/' . $id);
            echo json_encode($data);
        }

        public function delete()
        {
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $this->invoice_model->delete($id);
            redirect('invoices/view_all');
            // echo json_encode($id);
        }

        public function make_pdf()
        {
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id) ;
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
                
                $data['tax_count'] += $value['price']*($value['tax']/100)*$value['quantity'];
                $data['without_tax'] += $value['price']*$value['quantity'];
                $data['inv_total_with_tax'] += ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
            }
            $data['total_inv'] = number_format($data['inv_total_with_tax'] - ($data['inv_total_with_tax']*$data['invoice']['discount']/100),2);
            $html_total = '<tr class="nnn">'.
            '<td>Ukupno</td>'.
            '<td></td>'.
            '<td></td>'.
            '<td></td>'.
            '<td></td>'.
            '<td></td>'.
            '<td>'.$data['tax_count'].'</td>'.
            '<td>'.$data['without_tax'].'</td>'.
            '<td>'.$data['inv_total_with_tax'].'</td></tr>';
            $data['html'] = $html;
            $data['html_total'] = $html_total;
            $inovice_update['total'] =  $data['inv_total_with_tax'] - ($data['inv_total_with_tax']*$data['invoice']['discount']/100);
            $inovice_update['payed'] = $data['invoice']['payed'] + $this->input->post('payed');
            $inovice_update['due'] = $inovice_update['total'] - $inovice_update['payed'];
            $this->invoice_model->update($inovice_update, $id);
            $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id) ;
            $data['total_inv'] = $inovice_update['total'];
            // $this->load->view('templates/header');
            // $this->load->view('invoices/pdf_view', $data);
            // $this->load->view('templates/footer');
            $this->load->library('pdf');
            $dompdf = new Dompdf\Dompdf();
            // $dompdf->set_option('defaultFont', 'DejaVu Sans');
            $dompdf->set_option('isRemoteEnabled',true);    
            $html = $this->load->view('invoices/pdf_view',$data,true);
            $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
            $dompdf->loadHtml($html, 'UTF-8');
            $dompdf->set_option('isFontSubsettingEnabled', true);
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $pdf = $dompdf->output();
            $filename = $data['invoice']['date'] . '-' .$data['invoice']['buyername'];
            $dompdf->stream($filename, array("Attachment"=>0));
        }


    }