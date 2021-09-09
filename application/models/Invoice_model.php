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
            $sql = "SELECT invoices.date, invoices.avans, invoices.gotovinski, invoices.konacni, invoices.due, invoices.payed, invoices.profaktura, invoices.letters, invoices.id, invoices.total,
            invoices.inv_num, invoices.currency, invoices.notes, invoices.pay_deadline, invoices.discount, c.name as buyername, c.mb as buyermb, c.pib as buyerpib, c.adress as buyeradress, c.city as buyercity, c.zip_code as buyerzip,
             c2.name as sellername, c2.pib sellerpib, c2.mb sellermb, c2.phone sellerphone, c2.account_num selleracc_num, c2.bank sellerbank, c2.email selleremail, c2.adress as selleradress, c2.city sellercity, c2.account_num selleraccount, c2.zip_code as sellerzip FROM invoices INNER JOIN companies c ON c.id = invoices.buyer INNER JOIN companies c2 ON c2.id = invoices.seller where invoices.id = ?";
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
    public function get_invoices($limit = false, $offset = false)
    {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->select('invoices.*, c.name AS buyername, cc.name AS sellername');
        $this->db->join('companies c', 'invoices.buyer = c.id','left');
        $this->db->join('companies cc', 'invoices.seller = cc.id','left');
        $query = $this->db->get('invoices');
        return $query->result_array();
    }

    public function get_total_and_due($company, $prokup, $date_from, $date_to, $pay_deadline, $currency, $avans, $prof, $konacni, $gotovinski)
    {
        $this->db->query("SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        // $query = $this->db->get_where('invoices', array('buyer' => $company));
        $sql = "SELECT SUM(total) as total, SUM(due) as due, currency
        FROM invoices
        where $prokup=?";
        if (!$date_from == "") {
            $sql .= " AND date >='{$date_from}'";
        }
        if (!$date_to == "") {
            $sql .= " AND date <='{$date_to}'";
        }
        if (!$pay_deadline == "") {
            $sql .= " AND pay_deadline <='{$pay_deadline}'";
        }
        if (!$currency == "") {
            $sql .= " AND currency ='{$currency}'";
        }
        if ($avans > 0) {
            $sql .= " AND avans ='{$avans}'";
        }
        if ($avans > 0) {
            $sql .= " AND konacni ='{$konacni}'";
        }
        if ($prof > 0) {
            $sql .= " AND profaktura ='{$prof}'";
        }
        if ($gotovinski > 0) {
            $sql .= "AND gotovinski ='{$gotovinski}'";
        }
        $query = $this->db->query($sql, $company);
        return $query->result_array();
    }
    public function get_inv_num_for_company($company, $bors, $date_from, $date_to, $pay_deadline, $currency, $avans, $prof, $konacni, $gotovinski)
    {
        $this->db->query("SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        $sql = "SELECT id, inv_num, total, due, currency
        FROM invoices 
        where $bors=?";
        if (!$date_from == "") {
            $sql .= " AND date >='{$date_from}'";
        }
        if (!$date_to == "") {
            $sql .= " AND date <='{$date_to}'";
        }
        if (!$pay_deadline == "") {
            $sql .= " AND pay_deadline <='{$pay_deadline}'";
        }
        if (!$currency == "") {
            $sql .= " AND currency ='{$currency}'";
        }
        if ($avans > 0) {
            $sql .= " AND avans ='{$avans}'";
        }
        if ($avans > 0) {
            $sql .= " AND konacni ='{$konacni}'";
        }
        if ($prof > 0) {
            $sql .= "AND profaktura ='{$prof}'";
        }
        if ($gotovinski > 0) {
            $sql .= "AND gotovinski ='{$gotovinski}'";
        }
        $query = $this->db->query($sql, $company);
        return $query->result_array();
    }
     public function get_income($month=false)
     {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if(!$month==false){
            $sql = "SELECT SUM(total) as total_in, currency
            FROM invoices
            where seller='16' AND MONTH(date) = '{$month}' GROUP BY currency";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        $sql = "SELECT SUM(total) as total_in, currency
        FROM invoices
        where seller='16' GROUP BY currency";
        $query = $this->db->query($sql);
        return $query->result_array();
     }
     public function get_outcome($month=false)
     {
        $this->db->query("SET sql_mode = 'ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
        if(!$month==false){
            $sql = "SELECT SUM(total) as total_out, currency
            FROM invoices
            where buyer='16' AND MONTH(date) = '{$month}' GROUP BY currency";
            $query = $this->db->query($sql);
            // $query = $this->db->get('invoices');
            return $query->result_array();
        }
        $sql = "SELECT SUM(total) as total_out, currency
        FROM invoices
        where buyer='16' GROUP BY currency";
        $query = $this->db->query($sql);
        // $query = $this->db->get('invoices');
        return $query->result_array();
     }
}
