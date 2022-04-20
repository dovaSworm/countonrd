<?php
class Item_model extends CI_Model
{

    public function create($data)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");

        return $this->db->insert('items', $data);
    }

    public function check_name_exists($name){
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('items', array('name'=> $name));
        if(empty($query->row_array())){
            return true;
        }else{
            return false;
        }
    }

    public function get_one($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('items', array('id' => $id));
        return $query->row_array();
    }
    public function get_item($name)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('items', array('name' => $name));
        return $query->row_array();
    }
    public function get_items($limit = FALSE, $offset = FALSE)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if($limit){
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('id');
        $query = $this->db->get('items');
        return $query->result_array();
    }
    public function get_items_hint($hint=false)
    {
        if($hint){
            $sql = "SELECT items.id, items.name, items.code, items.mes_unit, items.quantity, items.buying_price, items.selling_price, items.sellers_code, g.name as groupname FROM items INNER JOIN groups g ON g.id = items.group_id WHERE items.code LIKE '%" .
            $this->db->escape_like_str($hint)."%' ESCAPE '!'";
                $query = $this->db->query($sql);
                if ($query->num_fields() > 0) {
                    return $query->result_array();
                } 
        }
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT items.id, items.name, items.code, items.mes_unit, items.quantity, items.buying_price, items.selling_price, items.sellers_code, g.name as groupname FROM items INNER JOIN groups g ON g.id = items.group_id";
        $query = $this->db->query($sql);
        if ($query->num_fields() > 0) {
            return $query->result_array();
        } 
    }
    public function get_items_by_hint_code($hint=false)
    {
        if($hint){
            $sql = "SELECT items.id, items.name, items.code, items.mes_unit, items.quantity, items.buying_price, items.selling_price, items.sellers_code, g.name as groupname FROM items INNER JOIN groups g ON g.id = items.group_id WHERE items.code LIKE '%" .
            $this->db->escape_like_str($hint)."%' ESCAPE '!'";
                $query = $this->db->query($sql);
                if ($query->num_fields() > 0) {
                    return $query->result_array();
                } 
        }
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT items.id, items.name, items.code, items.mes_unit, items.quantity, items.buying_price, items.selling_price, items.sellers_code, g.name as groupname FROM items INNER JOIN groups g ON g.id = items.group_id";
        $query = $this->db->query($sql);
        if ($query->num_fields() > 0) {
            return $query->result_array();
        } 
    }
    public function change_quantity($data, $id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->set('quantity', $data);
        $this->db->where('id', $id);
        return $this->db->update('items');
    }
    public function update_item($data, $id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }

    public function delete_item($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->where('id', $id);
        $this->db->delete('items');
        return true;
    }

    public function item_under($x)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if($x == 0){
            $sql = "SELECT items.id, items.name, items.quantity FROM items WHERE items.quantity = $x AND items.group_id = 1 ORDER BY items.quantity DESC";
            $query = $this->db->query($sql);
            if ($query->num_fields() > 0) {
                return $query->result_array();
            } 
        }
        $sql = "SELECT items.id, items.name, items.quantity FROM items WHERE items.quantity <$x AND items.quantity > 0 AND items.group_id = 1 ORDER BY items.quantity DESC";
        $query = $this->db->query($sql);
        if ($query->num_fields() > 0) {
            return $query->result_array();
        } 
    }

    public function most_buyers()
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT ii.name, COUNT(i.buyer) as total FROM invoice_items ii, invoices i WHERE ii.inv_id = i.id GROUP BY ii.name ORDER BY total ASC";
        $query = $this->db->query($sql);
        if ($query->num_fields() > 0) {
            return $query->result_array();
        } 
    }

}
