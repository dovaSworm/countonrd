<?php
class Entry_item_model extends CI_Model
{

    public function create($data)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");

        return $this->db->insert('entry_items', $data);
    }

    public function get_one($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('entry_items', array('id' => $id));
        return $query->row_array();
    }
    public function get_all_by_entry_id($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('entry_items', array('entry_id' => $id));
            if($query->num_fields()>0){

                return $query->result_array();
            }else{
                return "dodaj stavku 2";
            }
    }
    public function delete($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->delete('entry_items', array('id' => $id));
    }
    
}