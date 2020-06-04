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
    public function delete_by_inv($inv_id)
    {
        $this->db->delete('invoice_items', array('inv_id' => $inv_id));
    }

    public function best_sell($param, $order, $month)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT name, SUM($param) AS total
        FROM invoice_items join invoices on invoice_items.inv_id = invoices.id
        where MONTH(invoices.date) = '{$month}'
        GROUP BY name
        ORDER BY SUM($param) $order LIMIT 3;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function ava_prof_items($type)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT name, SUM(quantity) AS total
        FROM invoice_items join invoices on invoice_items.inv_id = invoices.id
        where $type = 1
        GROUP BY name
        ORDER BY SUM(quantity);";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function items_total($group)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT ii.name, SUM(ii.quantity) as quantity, SUM(ii.total) as total FROM invoice_items ii JOIN invoices i ON ii.inv_id = i.id JOIN items it ON ii.item_id = it.id WHERE it.group_id = $group GROUP BY ii.name ORDER BY total DESC LIMIT 7";
        $query = $this->db->query($sql);
        if ($query->num_fields() > 0) {
            return $query->result_array();
        } 
    }

}
