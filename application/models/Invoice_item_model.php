<?php
class Invoice_item_model extends CI_Model
{

 
    public function create($data)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
         if($this->db->insert('invoice_items', $data)){
            return "uspjelo";
        }else{
            return "mnije uspjelo";
        };
    }
    public function update($data, $id)
    {
        
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->update('invoice_items', $data, array('id' => $id));
    }

    public function delete($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->delete('invoice_items', array('id' => $id));
    }

    public function get_inv_items($id = false)
    {
        $this->db->order_by('id');
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if($id === false){
            $query = $this->db->get('invoice_items');
            return $query->result_array();
        }else{
            $query = $this->db->get_where('invoice_items', array('inv_id' => $id));
            if($query->num_fields()>0){

                return $query->result_array();
            }else{
                return "dodaj stavku 2";
            }
        }
    }
    public function get_one($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('invoice_items', array('id' => $id));
        return $query->row_array();
    }
    public function delete_invoice_item($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->where('id', $id);
        $this->db->delete('invoice_items');
        return true;
    }
    public function update_invoice_item()
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");

        $data = array(
            'inv_num' => $this->input->post('inv-num'),
            'date' => $this->input->post('date'),
            'seller' => $this->input->post('seller'),
            'byer' => $this->input->post('byer'),
            'currency' => $this->input->post('currency'),
            'discount' => $this->input->post('discount'),
            'pay-deadline' => $this->input->post('pay-deadline'),
            'total' => $this->input->post('total'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('invoice_items', $data);
    }

}
