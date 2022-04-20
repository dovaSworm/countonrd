<?php
class Companies extends CI_Controller
{

    public function index($offset = 0)
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'companies/index';
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $config['total_rows'] = $this->db->count_all('companies');
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
        $data['companies'] = $this->company_model->get_companies($config['per_page'], $offset);
        $this->pagination->initialize($config);
        $this->load->view('templates/header');
        $this->load->view('companies/company_index', $data);
        $this->load->view('templates/footer');
    }
    public function edit($id)
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $naslov['title'] = 'Edit';
        $data['company'] = $this->company_model->get_one($id);
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
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('pib', 'PIB', 'trim|required|min_length[5]|max_length[14]');
        $this->form_validation->set_rules('mb', 'MB', 'trim|required|min_length[5]|max_length[14]');
        $this->form_validation->set_rules('adress', 'Adress', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('zip-code', 'zip-code', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('account-num', 'Account number', 'trim');
        $this->form_validation->set_rules('bank', 'Bank', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('contact', 'Contact person', 'trim');

        if (!empty($this->company_model->update_company())) {
            $this->session->set_flashdata('company_edited', 'Kompanija uspesno  izmenjena');
            redirect('companies/index');
        } else {
            $this->db->display_errors();
        }
    }

    public function delete($id)
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $this->company_model->delete_company($id);
        $this->session->set_flashdata('company_deleted', 'Kompanija uspesno obrisana');
        redirect('home');
    }

    public function create()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('pib', 'PIB', 'trim|required|min_length[5]|max_length[14]');
        $this->form_validation->set_rules('mb', 'MB', 'trim|required|min_length[5]|max_length[14]');
        $this->form_validation->set_rules('adress', 'Adress', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('zip-code', 'zip-code', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('account-num', 'Account number', 'trim');
        $this->form_validation->set_rules('bank', 'Bank', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('contact', 'Contact person', 'trim');
        $data = array(
            'name' => $this->input->post('name'),
            'pib' => $this->input->post('pib'),
            'mb' => $this->input->post('mb'),
            'adress' => $this->input->post('adress'),
            'city' => $this->input->post('city'),
            'zip_code' => $this->input->post('zip-code'),
            'email' => !empty($this->input->post('email')) ? $this->input->post('email') : "",
            'phone' => !empty($this->input->post('phone')) ? $this->input->post('phone') : "",
            'bank' => !empty($this->input->post('bank')) ? $this->input->post('bank') : "",
            'account_num' => !empty($this->input->post('account-num')) ? $this->input->post('account-num') : "",
            'contact' => !empty($this->input->post('contact')) ? $this->input->post('contact') : "",
        );

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('companies/company_create', $data);
            $this->load->view('templates/footer');
        } else {
            $user = $this->session->userdata('user_id');
            if (!is_numeric($user)) {
                redirect('users/login');
            }
            if ($this->company_model->create($data)) {

                $this->session->set_flashdata('company_created', 'Kompanija  uspesno dodana u bazu');
                redirect('companies/index');
            } else {
                $this->db->display_errors();
            }
        }
    }

    public function companies_stat()
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $this_month = date('m');
        $last_month = date('m', strtotime('now - 1 month'));

        $data['this_in'] = $this->invoice_model->get_income($this_month);
        $data['this_out'] = $this->invoice_model->get_outcome($this_month);
        $data['last_in'] = $this->invoice_model->get_income($last_month);
        $data['last_out'] = $this->invoice_model->get_outcome($last_month);
        $data['income_total'] = $this->invoice_model->get_income();
        $data['outcome_total'] = $this->invoice_model->get_outcome();
    }

    public function stat()
    {
        $user = $this->session->userdata('user_id');
        if (!is_numeric($user)) {
            redirect('users/login');
        }
        $this_month = date('m');
        $last_month = date('m', strtotime('now - 1 month'));
        $data['this_in'] = $this->company_model->companies_in($this_month);
        $data['this_out'] = $this->company_model->companies_out($this_month);
        $data['last_in'] = $this->company_model->companies_in($last_month);
        $data['last_out'] = $this->company_model->companies_out($last_month);
        $data['total_in'] = $this->company_model->companies_in();
        $data['total_out'] = $this->company_model->companies_out();
        $this->load->view('templates/header');
        $this->load->view('companies/stat', $data);
        $this->load->view('templates/footer');
    }

}
