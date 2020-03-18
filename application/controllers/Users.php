<?php
    class Users extends CI_Controller{

        

        public function login(){
            $data['title'] = 'Sign in';
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            }else{
                $enc_pass = md5($this->input->post('password'));
                $user = $this->user_model->login($this->input->post('name'), $enc_pass);
                if($user){
                    $user_data = array(
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'role' => $user->role,
                        'logged_in' => true
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('user_loged_in', 'U R loged in');
                    redirect('home');
                }
            }
        }

        public function logout()
        {
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            // $user_data = array();
            // $this->session->unset_userdata($user_data);
            redirect('home');
        }
       
        public function register(){
            // echo "register";
            $data['title'] = 'Sign up';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            }else{
                $enc_password = md5($this->input->post('password'));
                $this->user_model->register($enc_password);
                $this->session->set_flashdata('user_registered', 'You are registered');
                redirect('home');
            }
        }
    }