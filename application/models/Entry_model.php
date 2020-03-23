<?php
class Entry_model extends CI_Model
{

    public function create($data)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");

        return $this->db->insert('entries', $data);
    }

    public function get_one($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('entries', array('id' => $id));
        return $query->row_array();
    }
    public function get_by_date_and_item_name($date, $item_name)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('entries', array('date' => $date, 'name' => $item_name));
        return $query->row_array();
    }   
    
    public function get_entry_items_by_id($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('entry_items', array('id' => $id));
        if($query->num_fields()>0){

            return $query->result_array();
        }else{
            return "dodaj artikal za unos";
        }
    }
    public function get_entries($limit = FALSE, $offset = FALSE)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if($limit){
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('id');
        $query = $this->db->get('entries');
        return $query->result_array();
    }
    public function delete($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->delete('entries', array('id' => $id));
    }
 
    public function update($data, $id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->where('id', $id);
        return $this->db->update('entries', $data);
    }
}