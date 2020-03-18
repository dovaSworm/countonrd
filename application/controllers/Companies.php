<?php
class Companies extends CI_Controller
{

    public function index()
    {
        $data['companies'] = $this->company_model->get_Companies();

        if (empty($data['companies'])) {
            show_404();
            // echo "prazno";
        }
        $this->load->view('templates/header');
        $this->load->view('companies/company_index', $data);
        $this->load->view('templates/footer');
    }
    public function edit($id)
    {

        $naslov['title'] = 'Edit';
        $data['company'] = $this->company_model->get_one($id);
        // $data['categories'] = $this->product_model->get_categories();

        if (empty($data['company'])) {
            show_404();
        }
        $data['title'] = $data['company']['name'];

        $this->load->view('templates/header', $naslov);
        $this->load->view('companies/company_edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|');
        $this->form_validation->set_rules('pib', 'PIB', 'trim|required|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('mb', 'MB', 'trim|required|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('adress', 'Adress', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('account-num', 'Account number', 'trim|numeric|required');
        // $varijabla = $this->company_model->update_company();
        if(!empty($this->company_model->update_company())){
            $this->session->set_flashdata('company_edited', 'Kompanija uspesno  izmenjena');
            redirect('companies/index');
        }else{
            $this->db->display_errors();
        }
        
    }

    public function delete($id)
    {
        $this->company_model->delete_company($id);
        $this->session->set_flashdata('company_deleted', 'Kompanija uspesno obrisana');
        redirect('home');
    }

    public function name_check($str)
    {
        if (preg_match('/^[a-zA-Z0-9-_. ]*$/', $str) === 1) {

            return true;
        } else {
            $this->form_validation->set_message('name_check', 'Možete koristiti samo slova, brojeve, razmak, srednju i donju crtu.');
            return false;
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_name_check');
        $this->form_validation->set_rules('pib', 'PIB', 'trim|required|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('mb', 'MB', 'trim|required|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('adress', 'Adress', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('account-num', 'Account number', 'trim|numeric|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $data = array(
            'name' => $this->input->post('name'),
            'pib' => $this->input->post('pib'),
            'mb' => $this->input->post('mb'),
            'adress' => $this->input->post('adress'),
            'email' => $this->input->post('email'),
            'bank' => $this->input->post('bank'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'zip_code' => $this->input->post('zip-code'),
            'account_num' => $this->input->post('account-num'),
        );

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('companies/company_create', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->company_model->create($data)) {

                $this->session->set_flashdata('company_created', 'Kompanija  uspesno dodana u bazu');
                redirect('home');
            } else {
                $this->db->display_errors();
            }
        }
    }

}
