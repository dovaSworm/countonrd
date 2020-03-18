<?php
    class User_model extends CI_Model{
        public function __construct(){
            // $this->load->database();
        }
        public function register($enc_password){
            $data = array(
                'name' => $this->input->post('name'),
                'password' => $enc_password,
                'role' => 'user'
            );

            return $this->db->insert('users', $data);
        }

        public function login($name, $password){

            $this->db->where('name', $name);
            $this->db->where('password', $password);

            $result = $this->db->get('users');

            if($result->num_rows() == 1){
                return $result->row(0);
            }else{
                return false;
            }
        }

        public function getAll(){
          $query = $this->db->get('users');
            return $query->result_array();
        }

    }