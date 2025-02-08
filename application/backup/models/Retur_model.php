<?php

class retur_model extends CI_Model {


    public function insertretursalescart($data_insert){
          $this->db->insert('tbl_detail_retur_sales_cart', $data_insert);
    }

    public function insertdetailretursales($data_insert){
        $this->db->insert('tbl_detail_retur_sales', $data_insert);
    }

    public function insertheaderpurchase($data_insert_header){
         $this->db->insert('tbl_header_retur_sales', $data_insert_header);
    }

    public function deletereturcart($id){
        $this->db->where('retur_sales_cart_id', $id);
        $this->db->delete('tbl_detail_retur_sales_cart');
    }

    public function emptycartretursales($retursalesfakturid){
        $this->db->where('retur_sales_cart_inv', $retursalesfakturid);
        $this->db->delete('tbl_detail_retur_sales_cart');
    }

    public function get_header_faktur(){
        $query = $this->db->query("select * from tbl_header_retur_sales");
        $result = $query->result();
        return $result;
    }

      public function get_salesheader_retur(){
        $query = $this->db->query("select * from tbl_header_sales");
        $result = $query->result();
        return $result;
    }

    public function get_sales_header_data($id){
        $query = $this->db->query("select * from tbl_header_sales where sales_faktur_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_total_cart_sales($userid, $retursalesfakturid){
         $query = $this->db->query("select sum(retur_sales_cart_total) as total_retur from tbl_detail_retur_sales_cart a, tbl_masterbarang b where a.retur_sales_cart_item = b.master_barang_id  and retur_sales_cart_inv = '".$retursalesfakturid."' and retur_sales_cart_admin = '".$userid."'");
        $result = $query->result();
        return $result;
    }

    public function get_detailretur($id, $salesfakturid){
        $query = $this->db->query("select * from tbl_detail_sales where sales_detail_faktur = '".$salesfakturid."' and sales_detail_item = '".$id."'");
        $result = $query->result();
        return $result;
    }

    public function getreturpayment($invoice){
        $query = $this->db->query("select * from tbl_header_retur_sales where retur_sales_faktur_ref = '".$invoice."' and retur_sales_billtype = 1");
        $result = $query->result();
        return $result;
    }

    public function get_retur_sales_cart($userid){
        $query = $this->db->query("select * from tbl_detail_retur_sales_cart a, tbl_masterbarang b, tbl_master_gudang c  where a.retur_sales_cart_item = b.master_barang_id and a.retur_sales_cart_warehouse = c.master_gudang_id and retur_sales_cart_admin = '".$userid."'");
        $result = $query->result();
        return $result;
    }

    public function get_last_post_cart_sales($userid){
         $query = $this->db->query("select * from tbl_detail_retur_sales_cart where retur_sales_cart_admin = '".$userid."'");
        $result = $query->result();
        return $result;
    }

    public function check_retur_cart($retursalesitem, $retursalesfakturid){
        $query = $this->db->query("select * from tbl_detail_retur_sales_cart where retur_sales_cart_item = '".$retursalesitem."' and retur_sales_cart_inv = '".$retursalesfakturid."'");
        $result = $query->result();
        return $result;
    }

    public function get_lastretursales(){
        $query = $this->db->query("select * from tbl_header_retur_sales order by retur_sales_id  desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function check_billingtype($salesfakturid){
        $query = $this->db->query("select * from tbl_header_sales where sales_faktur_id = '".$salesfakturid."'");
        $result = $query->result();
        return $result;
    }

    public function get_header_retur_by_nofak($id){
        $query = $this->db->query("select * from tbl_header_retur_sales a, tbl_customer b, tbl_mastercompany c, tbl_mastercompany_bank d where a.retur_sales_customer = b.customer_id  and a.retur_sales_company = c.mastercompany_id and c.mastercompany_id = d.mastercompany_id and retur_sales_faktur_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_detail_retur_by_nofak($id){
        $query = $this->db->query("select * from tbl_detail_retur_sales a, tbl_masterbarang b where a.retur_sales_item = b.master_barang_id   and  retur_sales_inv = '".$id."'");
        $result = $query->result();
        return $result;
    }
}

?>