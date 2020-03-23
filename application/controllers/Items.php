<?php 
    class Items extends CI_Controller{

        public function name_check($str)
        {
            if(preg_match('/^[a-zA-Z0-9-_. ]*$/', $str) === 1){
                return TRUE;
            }else{
                $this->form_validation->set_message('name_check', 'Možete koristiti samo slova, brojeve, razmak, srednju i donju crtu.');
                return FALSE;
            }
        }

        public function index()
        { 
            $items['items'] = $this->item_model->get_items();
            $this->load->view('templates/header');
            $this->load->view('items/item_index', $items);
            $this->load->view('templates/footer');

        }

        public function create()
        {
            $groups['groups'] = $this->group_model->get_groups();

            $this->form_validation->set_rules('group-id', 'Group id', 'required|numeric');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_name_check|is_unique[items.name]');
            $this->form_validation->set_rules('tax', 'Tax', 'trim|numeric');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|callback_name_check');
            $this->form_validation->set_rules('buying-price', 'Buying price', 'trim|numeric');
            $this->form_validation->set_rules('selling-price', 'Selling price', 'trim|numeric|required');
            $this->form_validation->set_rules('sellers-code', 'Sellers code', 'trim');
            $this->form_validation->set_rules('sellers-name', 'Sellers name', 'trim|callback_name_check');
            
            $data = array(
                'group_id' => $this->input->post('group-id'),
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'tax' => $this->input->post('tax'),
                'quantity' => 0,
                'description' => $this->input->post('description'),
                'buying_price' => $this->input->post('buying-price'),
                'selling_price' => $this->input->post('selling-price'),
                'sellers_code' => $this->input->post('sellers-code'),
                'sellers_name' => $this->input->post('sellers-name')
            );
            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('items/item_create', $groups);
                $this->load->view('templates/footer');
            }else{
                $this->item_model->create($data);
                $this->session->set_flashdata('item_created', 'Proizvod uspesno dodan u bazu');
                redirect('home');
            }
        }

        public function edit($id)
        {
            // $groups['groups'] = $this->group_model->get_groups();
            $naslov['title'] = 'Edit';
            $data['item'] = $this->item_model->get_one($id);
            $data['groups'] = $this->group_model->get_groups();
    
            if (empty($data['item'])) {
                show_404();
            }
            $data['title'] = $data['item']['name'];
    
            $this->load->view('templates/header', $naslov);
            $this->load->view('items/item_edit', $data);
            $this->load->view('templates/footer');
        }

        public function update()
    {
        $this->form_validation->set_rules('group-id', 'Group id', 'numeric');
        $this->form_validation->set_rules('name', 'Name', 'trim|callback_name_check|is_unique[items.name]');
        $this->form_validation->set_rules('code', 'Code', 'trim');
        $this->form_validation->set_rules('rate', 'Rate', 'trim|numeric');
        $this->form_validation->set_rules('tax', 'Tax', 'trim|numeric');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric');
        $this->form_validation->set_rules('discount', 'Discount', 'trim|numeric');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('buying-price', 'Buying price', 'trim|numeric');
        $this->form_validation->set_rules('selling-price', 'Selling price', 'trim|numeric|required');
        $this->form_validation->set_rules('sellers-code', 'Sellers code', 'trim');
        $this->form_validation->set_rules('sellers-name', 'Sellers name', 'trim|callback_name_check');

        $data = array(
            'group_id' => $this->input->post('group-id'),
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'tax' => $this->input->post('tax'),
            'quantity' => $this->input->post('quantity'),
            'description' => $this->input->post('description'),
            'buying_price' => $this->input->post('buying-price'),
            'selling_price' => $this->input->post('selling-price'),
            'sellers_code' => $this->input->post('sellers-code'),
            'sellers_name' => $this->input->post('sellers-name') 
        );

        if(!empty($this->item_model->update_item($data, $this->input->post('id')))){
            $this->session->set_flashdata('item_edited', 'Proizvod uspesno  izmenjen');
            redirect('items/index');
        }else{
            $this->db->display_errors();
        }
    }
    

    public function delete($id)
    {
        $this->item_model->delete_item($id);
        $this->session->set_flashdata('item_deleted', 'Proizvod uspesno obrisan');
        redirect('items/index');
    }
}