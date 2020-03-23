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
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'pib' => $this->input->post('pib'),
            'mb' => $this->input->post('mb'),
            'adress' => $this->input->post('adress'),
            'email' => $this->input->post('email'),
            'account_num' => $this->input->post('account-num'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('companies', $data);
    }

}
