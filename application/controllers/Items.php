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

        public function index($offset=0)
        { 
            $this->load->library('pagination');

        $config['base_url'] = base_url() . 'items/index';
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $config['total_rows'] = $this->db->count_all('items');
        $config['per_page'] = 11;
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

        $data['items'] = $this->item_model->get_items($config['per_page'], $offset);
        $this->pagination->initialize($config);
        $this->load->view('templates/header');
        $this->load->view('items/item_index', $data);
        $this->load->view('templates/footer');
            

        }

        public function create()
        {
            $groups['groups'] = $this->group_model->get_groups();

            $this->form_validation->set_rules('group-id', 'Group id', 'required|numeric');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[items.name]');
            $this->form_validation->set_rules('tax', 'Tax', 'trim|numeric');
            $this->form_validation->set_rules('mes-unit', 'Mes unit', 'trim');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('buying-price', 'Buying price', 'trim|numeric');
            $this->form_validation->set_rules('selling-price', 'Selling price', 'trim|numeric|required');
            $this->form_validation->set_rules('sellers-code', 'Sellers code', 'trim');
            $this->form_validation->set_rules('sellers-name', 'Sellers name', 'trim');
            $name = str_replace(array('"'), array('\"'), $this->input->post('name'));
            $data = array(
                'group_id' => $this->input->post('group-id'),
                'name' =>  $this->input->post('name'),
                'code' => $this->input->post('code'),
                'mes_unit' => $this->input->post('mes-unit'),
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
        $this->form_validation->set_rules('name', 'Name', 'trim|is_unique[items.name]');
        $this->form_validation->set_rules('code', 'Code', 'trim');
        $this->form_validation->set_rules('rate', 'Rate', 'trim|numeric');
        $this->form_validation->set_rules('tax', 'Tax', 'trim|numeric');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric');
        $this->form_validation->set_rules('mes-unit', 'Mes unit', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('buying-price', 'Buying price', 'trim|numeric');
        $this->form_validation->set_rules('selling-price', 'Selling price', 'trim|numeric|required');
        $this->form_validation->set_rules('sellers-code', 'Sellers code', 'trim');
        $this->form_validation->set_rules('sellers-name', 'Sellers name', 'trim');

        $data = array(
            'group_id' => $this->input->post('group-id'),
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'mes_unit' => $this->input->post('mes-unit'),
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

    public function get_items_like()
    {
        if(isset($_REQUEST["q"])){
            $hint = $_REQUEST["q"];
            $items = $this->item_model->get_items_hint($hint);
            $html = '';

            foreach($items as $item){
                $html .= '<tr><td>'.$item['name'].'</td><td>'.$item['code'].'</td><td>'.$item['groupname'].'</td><td>'.$item['mes_unit'].'</td><td>'.$item['quantity'].'</td><td>'.$item['buying_price'].'</td><td>'.$item['selling_price'].'</td><td>'.$item['sellers_code'].'</td><td><input type="hidden" name="zabrisanje" value="'. $item["id"] .'"></td><td><button class="edit-item" type="submit" title="Izmeni"><a href="' .  base_url() .'items/edit/'. $item["id"] .'" class="btn-default"><i class="fas fa-pen"></i></a></button></td> <td><button class="delete-item" type="submit" title="Obriši"><a href="' . base_url() . 'items/delete/' . $item["id"] .'"><i class="fas fa-trash-alt"></i></a></button></td></tr>';
            }

            echo $html;
        }      
    
    }

    public function get_items_for_entry()
    {
        $item = $this->item_model->get_one($_REQUEST["id"]);
        echo json_encode($item);
    }

    public function get_items_by_hint()
    {
        $name = $_REQUEST["hint"];
        $items = $this->item_model->get_items_hint($name);
        echo json_encode($items);
        
    }
    public function get_items_by_code()
    {
        $code = $_REQUEST["hint"];
        $items = $this->item_model->get_items_by_hint_code($code);
        echo json_encode($items);
        
    }
    public function stat()
    {
        $this_month = date('m');
        $last_month = date('m', strtotime('now - 1 month'));
        $data['items'] = $this->item_model->get_items();
        $data['best_q_this'] = $this->invoice_item_model->best_sell('quantity', 'DESC', $this_month);
        $data['worst_q_this'] = $this->invoice_item_model->best_sell('quantity', 'ASC', $this_month);
        $data['best_p_this'] = $this->invoice_item_model->best_sell('price', 'DESC', $this_month);
        $data['worst_p_this'] = $this->invoice_item_model->best_sell('price', 'ASC', $this_month);

        $data['best_q_last'] = $this->invoice_item_model->best_sell('quantity', 'DESC', $last_month);
        $data['worst_q_last'] = $this->invoice_item_model->best_sell('quantity', 'ASC', $last_month);
        $data['best_p_last'] = $this->invoice_item_model->best_sell('price', 'DESC', $last_month);
        $data['worst_p_last'] = $this->invoice_item_model->best_sell('price', 'ASC', $last_month);

        $data['under_0'] = $this->item_model->item_under(0);
        $data['under_5'] = $this->item_model->item_under(6);
        $data['profaktura'] = $this->invoice_item_model->ava_prof_items('profaktura');
        $data['avans'] = $this->invoice_item_model->ava_prof_items('avans');
        $data['items_total'] = $this->invoice_item_model->items_total();
        // $data['most_buyers'] = $this->item_model->most_buyers();
        $this->load->view('templates/header');
        $this->load->view('items/stat', $data);
        $this->load->view('templates/footer');
        // echo json_encode($data);
    }
}