<?php
    class Pages extends CI_Controller{

        public function view($page = 'home', $offset = 0){
            if(!file_exists(APPPATH . 'views/pages/' . $page . '.php')){
                show_404();
                // echo 'rado';
            }

            $data['title'] = ucfirst($page);
            
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        }
    }