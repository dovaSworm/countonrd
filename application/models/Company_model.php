<?php
class Company_model extends CI_Model
{

    public function check_name_exists($name)
    {
        $query = $this->db->get_where('companies', array('name' => $name));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function create($data)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        return $this->db->insert('companies', $data);
    }

    public function get_companies()
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->order_by('id');
        $query = $this->db->get('companies');
        return $query->result_array();
    }
    public function get_one($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('companies', array('id' => $id));
        return $query->row_array();
    }
    public function delete_company($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->where('id', $id);
        $this->db->delete('companies');
        return true;
    }
    public function update_company()
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");

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
            'contact' => !empty($this->input->post('contact')) ? $this->input->post('contact') : ""
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('companies', $data);
    }

    public function companies_in($month=false)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if(!$month==false){
        $sql = "SELECT SUM(total) as total_in, buyer, SUM(due) as due, COUNT(inv_num) as inv_num
        FROM invoices
        where seller='Protech' AND MONTH(date) = '{$month}' GROUP BY buyer";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        $sql = "SELECT SUM(total) as total_in, buyer, SUM(due) as due, COUNT(inv_num) as inv_num
            FROM invoices
            where seller='Protech' GROUP BY buyer";
            $query = $this->db->query($sql);
            return $query->result_array();
    }
    public function companies_out($month=false)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if(!$month==false){
        $sql = "SELECT SUM(total) as total_out, seller, SUM(due) as due, COUNT(inv_num) as inv_num
        FROM invoices as i
        where buyer='Protech' AND MONTH(date) = '{$month}' GROUP BY seller";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        $sql = "SELECT SUM(total) as total_out, seller, SUM(due) as due, COUNT(inv_num) as inv_num
            FROM invoices as i
            where buyer='Protech' GROUP BY seller";
            $query = $this->db->query($sql);
            return $query->result_array();
    }

}
