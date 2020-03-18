<?php
class Invoice_model extends CI_Model
{


    public function create($data)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");

        $this->db->insert('invoices', $data);
        return "xxx";
    }

    public function get_invoice_and_companies($id = false)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if ($id === false) {
            $query = $this->db->get('invoice_items');
            return $query->result_array();
        } else {
            $sql = "SELECT invoices.date, invoices.avans, invoices.due, invoices.payed, invoices.profaktura, invoices.id, invoices.total, 
            invoices.inv_num, invoices.currency, invoices.notes, invoices.pay_deadline, invoices.discount, c.name as buyername, c.mb as buyermb, c.pib as buyerpib, c.adress as buyeradress, c.city as buyercity, c.zip_code as buyerzip,
             c2.name as sellername, c2.pib sellerpib, c2.mb sellermb, c2.phone sellerphone, c2.account_num selleracc_num, c2.bank sellerbank, c2.email selleremail, c2.adress as selleradress, c2.city sellercity, c2.account_num selleraccount, c2.zip_code as sellerzip FROM invoices INNER JOIN companies c ON c.name = invoices.buyer INNER JOIN companies c2 ON c2.name = invoices.seller where invoices.id = ?";
            $query = $this->db->query($sql, $id);
            if ($query->num_fields() > 0) {
                return $query->row_array();
            } else {
                return "dodaj stavku 2";
            }
        }
    }

    public function delete($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->where('id', $id);
        $this->db->delete('invoices');
    }

    public function update($data, $id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $this->db->update('invoices', $data, array('id' => $id));
    }

    public function get_one($inv_num)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('invoices', array('inv_num' => $inv_num));
        return $query->row_array();
    }
    public function get_one_by_id($id)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $query = $this->db->get_where('invoices', array('id' => $id));
        return $query->row_array();
    }
    public function get_invoices($limit = FALSE, $offset = FALSE)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if($limit){
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('id');
        $query = $this->db->get('invoices');
        return $query->result_array();
    }

    public function get_invoices_for_buyer($id, $prokup)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        // $query = $this->db->get_where('invoices', array('buyer' => $id));
        $sql = "SELECT SUM(total) as total
        FROM invoices
        where $prokup=?";
            $query = $this->db->query($sql, $id);
        // $query = $this->db->get('invoices');
        return $query->row_array();
    }

}
