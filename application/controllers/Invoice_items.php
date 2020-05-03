<?php
    class Invoice_items extends CI_Controller{

        public function index()
        { 
            $data['items'] = $this->item_model->get_items();
            $data['companies'] = $this->company_model->get_companies();
            $data['invoice_items'] = $this->invoice_item_model->get_invoice_items();
            $this->load->view('templates/header');
            $this->load->view('invoices/invoice_create', $data);
            $this->load->view('invoice_items/invoice_items_create', $data);
            $this->load->view('templates/footer');

        }

        public function create()
        {
            $inv_id=$this->uri->segment(3);
            if($inv_id===null){
                $inv_id=false;
            }
            
            $item_id=$this->input->post('item');
            if($item_id===null){
                $item_id=false;
            }
            $invoice = $this->invoice_model->get_one($inv_id);
            $item = $this->item_model->get_one($item_id);
            $quantity = 1;
            $data = array(
                'name' => $item['name'],
                'item_id' => $item['id'],
                'inv_id' => $inv_id,
                'code' => $item['code'],
                'it_disc' => 0,
                'sellers_code' => $item['sellers_code'],
                'sellers_name' => $item['sellers_name'],
                'price' => $item['selling_price'],
                'mes_unit' => $item['mes_unit'],
                'tax' => $item['tax'],
                'quantity' => $quantity,
                'total' => $quantity*($item['selling_price'] + ($item['selling_price']*($item['tax']/100)))
            );
            
            $this->invoice_item_model->create($data);
            if(($item['group_id'] == 1) && !($invoice['profaktura'] == 0 && $invoice['avans'] == 0)){
                $this->item_model->change_quantity(($item['quantity']-$quantity),$item_id);
            }
            $this->session->set_flashdata('invoiceitem_created', 'invoiceitem uspesno dodana u bazu');
            redirect('invoices/view/' . $inv_id);
        }
        
        public function update()
        {
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $inv_item = $this->invoice_item_model->get_one($id);
            $invoice=$this->invoice_model->get_one($inv_item['inv_id']);
            $item = $this->item_model->get_one($inv_item['item_id']);
            $data['quantity'] = $this->input->post('quantity');
            $data['tax'] = $this->input->post('tax');
            $data['it_disc'] = $this->input->post('it-disc');
            $data['price'] = $this->input->post('price');
            $notax = ($data['price'] - $data['price']*($data['it_disc']/100))*$data['quantity'];
            $data['total'] = $notax + ($notax*($data['tax']/100));
            $this->invoice_item_model->update($data, $id);
            if(($item['group_id'] == 1) && !($invoice['profaktura'] == 0 && $invoice['avans'] == 0)){
                $this->item_model->change_quantity(($item['quantity']-$data['quantity']+$inv_item['quantity']),$inv_item['item_id']);
            }
            redirect('invoices/view/' . $inv_item['inv_id']);
            // echo json_encode($data['tax'] . " plus kolicina " . $data['quantity']);
        }
        
        public function delete()
        {
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $inv_id=$this->uri->segment(4);
            if($inv_id===null){
                $inv_id=false;
            }
            $invoice=$this->invoice_model->get_one($id);
            $inv_item = $this->invoice_item_model->get_one($id);
            $this->invoice_item_model->delete($id);
            $item = $this->item_model->get_one($inv_item['item_id']);
            if(($item['group_id'] == 1) && !($invoice['profaktura'] == 0 && $invoice['avans'] == 0)){
                $this->item_model->change_quantity(($item['quantity']+$inv_item['quantity']),$inv_item['item_id']);
            }
            redirect('invoices/view/' . $inv_id);
        }

        public function get_inv_items(){
            $id=$this->uri->segment(3);
            if($id===null){
                $id=false;
            }
            $data['invoice'] = $this->invoice_model->get_invoice_and_companies($id);
            $this->session->set_flashdata('invoice2', $data['invoice']);
            $data['items'] = $this->invoice_item_model->get_inv_items($id);
            // echo json_encode($data);
            // echo json_encode($data['invoice']);
        }

    }