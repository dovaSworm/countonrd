<?php
class Entry extends CI_Controller
{

    public function index()
    {
        $data['items'] = $this->item_model->get_items();

        if (empty($data['items'])) {
            show_404();
            // echo "prazno";
        }
        $this->load->view('templates/header');
        $this->load->view('entry/entry_create', $data);
        $this->load->view('templates/footer');
    }
    public function credit()
    {
      $entry_id=$this->uri->segment(3);
      $date = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Y-m-d");
      $data = array(
          'date' => $date,
          'name' => $this->input->post('name')
      );
      if($entry_id===null){
          $this->form_validation->set_rules('date', 'Date', 'trim|required');
          $this->form_validation->set_rules('name', 'Name', 'trim|required');

          $this->entry_model->create($data);
          $data['entry'] = $this->entry_model->get_by_date_and_item_name($date, $data['name']);
          redirect('entry/view/' . $data['entry']['id'] , 'refresh');
      }

      $this->entry_model->update($data, $entry_id);
      redirect('entry/view/'.$entry_id);
    }
    // public function create()
    // {
    //     $this->form_validation->set_rules('date', 'Date', 'trim|required');
    //     $this->form_validation->set_rules('name', 'Name', 'trim|required');

        
    //     $date = date_create_from_format("Y-m-d", $this->input->post('date'))->format("Y-m-d");
    //     $data = array(
    //         'date' => $date,
    //         'name' => $this->input->post('name')
    //     );
    //     if($this->form_validation->run() === FALSE){
    //         // $item = $this->item_model->get_one($this->input->post('item'));
    //         $this->load->view('templates/header');
    //         $this->load->view('entry/entry_create', $data);
    //         $this->load->view('templates/footer');  
    //         $this->session->set_flashdata('entry_not_created', 'Kalkulacija cena nije dodana u bazu');
    //     }else{
    //         if($created = $this->entry_model->create($data)){
    //             $data['entry'] = $this->entry_model->get_by_date_and_item_name($date, $data['name']);
    //             $this->session->set_flashdata('entry_created', 'Kalkulacija uspesno dodana u bazu');
    //             $this->session->set_flashdata('entry', $data['entry']);

    //             redirect('entry/view/' . $data['entry']['id'] , 'refresh');
    //         }else{
    //             $this->db->error();
    //         }
    //     }
    // }

    public function view()
    {
        $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
           
        $item = $this->item_model->get_one($this->input->post('item'));
        $data['items'] = $this->item_model->get_items();
        $data['entry'] = $this->entry_model->get_one($id);
        $data['entry_items'] = $this->entry_item_model->get_all_by_entry_id($id);
            

            $this->load->view('templates/header');
            $this->load->view('entry/entry_view', $data);
            $this->load->view('templates/footer');
    }

    public function update_item()
    {
        $id=$this->uri->segment(3);
            if($id===null){
                $this->session->set_flashdata('info', 'Prvo napraviti ulaz pa onda dodati artikle!');
                redirect('entry/view' , 'refresh');
            }
        $this->form_validation->set_rules('currency', 'Currency', 'trim|min_length[2]|max_length[3]');
        $this->form_validation->set_rules('exch-rate', 'Exchange rate', 'trim');
        $this->form_validation->set_rules('buying-for', 'Buying price foreign currency', 'trim|required');
        $this->form_validation->set_rules('buying-home', 'Buying price home currency', 'trim|required');
        $this->form_validation->set_rules('selling-for', 'Selling price foreign', 'trim|required');
        $this->form_validation->set_rules('selling-home', 'Selling price home', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric|required');
        $this->form_validation->set_message('required', 'Polje je obavezno!');
        $this->form_validation->set_message('min_length', 'Unos ta ovo polje je prekratko!');
        $this->form_validation->set_message('max_length', 'Unos ta ovo polje je predugačak!');
        $data['entry'] = $this->entry_model->get_one($id);
        $item = $this->item_model->get_one($this->input->post('item'));
        $currency = "RSD";
        if(!empty($_POST['currency'])){
            $currency = $this->input->post('currency');
        }
        $data = array(
                'entry_id' => $id,
                'item_id' => $item['id'],
                'sellers_code' => $item['sellers_code'],
                'code' => $item['code'],
                'name' => $item['name'],
                'currency' => $currency,
                'exch_rate' => $this->input->post('exch-rate'),
                'buying_for'=> $this->input->post('buying-for'),
                'buying_home'=> $this->input->post('buying-home'),
                'selling_for'=> $this->input->post('selling-for'),
                'selling_home'=> $this->input->post('selling-home'),
                'quantity' => $this->input->post('quantity')
            );
            if($this->form_validation->run() === FALSE){
                $data['entry'] = $this->entry_model->get_one($id);
                $item = $this->item_model->get_one($this->input->post('item'));
                $data['entry_items'] = $this->entry_item_model->get_all_by_entry_id($id);
                $this->load->view('templates/header');
                $this->load->view('entry/entry_view', $data);
                $this->load->view('templates/footer');  
                $this->session->set_flashdata('entry_not_created', 'artilkal za unos nije dodana u bazu');
            }else{
                if($created = $this->entry_item_model->create($data)){
                    $this->item_model->change_quantity($item['quantity'] + $this->input->post('quantity'), $item['id']);
                    $update_item_date['buying_price'] = $this->input->post('buying-home');
                    $update_item_date['selling_price'] = $this->input->post('selling-home');
                    $this->item_model->update_item($update_item_date, $item['id']);
                    $data['entry'] = $this->entry_model->get_one($id);
                    $data['entry_items'] = $this->entry_item_model->get_all_by_entry_id($id);
                    $this->session->set_flashdata('entry_created', 'Kalkulacija uspesno dodana u bazu');
                    $this->session->set_flashdata('entry', $data['entry']);
                    
                    redirect('entry/view/' . $data['entry']['id'] , 'refresh');
                    echo json_encode($data);
                }else{
                    $this->db->error();
                }
            }
    }

    public function make_pdf()
        {
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
           $data['entry_items'] = $this->entry_item_model->get_all_by_entry_id($id);
           $data['entry'] = $this->entry_model->get_one($id);
            // $this->load->view('templates/header');
            // $this->load->view('entry/make_entry_pdf', $data);
            // $this->load->view('templates/footer');
            $this->load->library('pdf');
            $dompdf = new Dompdf\Dompdf();
            // $dompdf->set_option('defaultFont', 'DejaVu Sans');
            $dompdf->set_option('isRemoteEnabled',true);    
            $html = $this->load->view('entry/make_entry_pdf',$data,true);
            $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
            $dompdf->loadHtml($html, 'UTF-8');
            $dompdf->set_option('isFontSubsettingEnabled', true);
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $pdf = $dompdf->output();
            $filename = $data['entry']['name'];
            $dompdf->stream($filename, array("Attachment"=>0));
        }
    
        public function delete_item()
        {
            $entry_item_id=$this->uri->segment(3);
            if($entry_item_id===null){
                $entry_item_id=false;
            }
            $entry_id=$this->uri->segment(4);
            if($entry_id===null){
                $entry_id=false;
            }

            $entry_item = $this->entry_item_model->get_one($entry_item_id);
            $item = $this->item_model->get_one($entry_item['item_id']);
            $this->entry_item_model->delete($entry_item_id);
            $this->item_model->change_quantity($item['quantity'] - $entry_item['quantity'], $item['id']);
            redirect('entry/view/' . $entry_id , 'refresh');
        }

        public function delete()
        {
            $entry_id=$this->uri->segment(3);
            if($entry_id===null){
                $entry_id=false;
            }
            $this->entry_model->delete($entry_id);
            redirect('entry/view_all/');
        }
        public function view_all($offset = 0)
        {
            $this->load->library('pagination');

            $config['base_url'] = base_url().'entry/view_all';
            $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
            $config['total_rows'] = $this->db->count_all('entries');
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
            $data['entries'] = $this->entry_model->get_entries($config['per_page'], $offset);
            $this->pagination->initialize($config);
            $this->load->view('templates/header');
            $this->load->view('entry/entry_index', $data);
            $this->load->view('templates/footer');
        }

        // public function edit($id)
        // {
        //     $naslov['title'] = 'Edit';
        //     $data['entry'] = $this->entry_model->get_one($id);
        //     if (empty($data['entry'])) {
        //         show_404();
        //     }
        //     $data['title'] = $data['entry']['name'];
    
        //     $this->load->view('templates/header', $naslov);
        //     $this->load->view('entry/entry_update', $data);
        //     $this->load->view('templates/footer');
        // }
        // public function update()
        // {
        //     $entry_id=$this->uri->segment(3);
        //     if($entry_id===null){
        //         $entry_id=false;
        //     }
        //     $entry = $this->entry_model->get_one($entry_id);
        //     $data['name'] = $entry['name'];
        //     $data['date'] = $entry['date'];
        //     $this->entry_model->update($data, $entry_id);
        //     redirect('entry/view/'.$entry_id);
        // }

      

}