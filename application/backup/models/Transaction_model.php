<?php

class transaction_model extends CI_Model {

	public function insertpurchasecart($data_insert){
		$this->db->insert('tbl_detail_purchase_cart', $data_insert);
	}

    public function insertdetailpurchase($data_insert){
        $this->db->insert('tbl_detail_purchase', $data_insert);
    }

    public function insertdetailsales($data_insert){
        $this->db->insert('tbl_detail_sales', $data_insert);
    }

    public function insertheaderpurchase($data_insert_header){
        $this->db->insert('tbl_header_purchase', $data_insert_header);
    }

     public function insertheadersales($data_insert_header){
        $this->db->insert('tbl_header_sales', $data_insert_header);
    }

     public function inputpaymentpurchase($data_insert){
        $this->db->insert('tbl_payment_hutang_purchase', $data_insert);
    }

    public function inputpaymentsales($data_insert){
        $this->db->insert('tbl_payment_hutang_sales', $data_insert);
    }
    
    public function insertsellcart($data_insert){
         $this->db->insert('tbl_detail_sales_cart', $data_insert);
    }

    public function data_insert_gudang($data_insert_gudang){
        $this->db->insert('tbl_master_gudang_barang', $data_insert_gudang);
    }

    public function insertprojectcart($data_insert){
        $this->db->insert('tbl_project_detail_cart', $data_insert);
    }

    public function insertheaderproject($data_insert_header){
        $this->db->insert('tbl_project', $data_insert_header);
    }

    public function insertdetailproject($data_insert_detail){
         $this->db->insert('tbl_project_detail', $data_insert_detail);
    }
    public function get_purchaseheader($curmonth){
        $query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and purchase_date like '%".$curmonth."%'");
        $result = $query->result();
        return $result;
    }

    public function check_sales_cart($userid, $purcasedetailitem){
         $query = $this->db->query("select * from tbl_detail_sales_cart where sales_detail_cart_admin = '".$userid."' and sales_detail_cart_item = '".$purcasedetailitem."'");
        $result = $query->result();
        return $result;
    }

    public function get_projectdetail(){
        $query = $this->db->query("select * from tbl_project_detail_cart");
        $result = $query->result();
        return $result;
    }

    public function dataprintprojectheader($id){
          $query = $this->db->query("select * from tbl_project where project_header_number = '".$id."'");
        $result = $query->result();
        return $result;
    }

  

    public function get_projectheader(){
        $query = $this->db->query("select * from tbl_project");
        $result = $query->result();
        return $result;
    }

      public function get_salesheader($curmonth){
        $query = $this->db->query("select * FROM tbl_header_sales LEFT JOIN tbl_header_retur_sales ON tbl_header_sales.sales_faktur_id = tbl_header_retur_sales.retur_sales_faktur_ref JOIN tbl_customer ON tbl_header_sales.sales_customer_id = tbl_customer.customer_id and sales_date like '%".$curmonth."%'");
        $result = $query->result();
        return $result;
    }

  

    public function get_purchaseheader_by_date($datefrom, $dateend, $suplierpurchase){
        if($suplierpurchase == ''){
        $query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and purchase_date between '".$datefrom."' and '".$dateend."'");
        }else{
        $query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and purchase_date between '".$datefrom."' and '".$dateend."' and suplier_id = '".$suplierpurchase."'");
        }
        $result = $query->result();
        return $result;
    }

      public function get_salesheader_by_date($datefrom, $dateend, $customersales){
        if($customersales == ''){
        $query = $this->db->query("select * FROM tbl_header_sales LEFT JOIN tbl_header_retur_sales ON tbl_header_sales.sales_faktur_id = tbl_header_retur_sales.retur_sales_faktur_ref JOIN tbl_customer ON tbl_header_sales.sales_customer_id = tbl_customer.customer_id and sales_date between '".$datefrom."' and '".$dateend."' order by sales_header_id asc");
        }else{
        $query = $this->db->query("select * FROM tbl_header_sales LEFT JOIN tbl_header_retur_sales ON tbl_header_sales.sales_faktur_id = tbl_header_retur_sales.retur_sales_faktur_ref JOIN tbl_customer ON tbl_header_sales.sales_customer_id = tbl_customer.customer_id and sales_date between '".$datefrom."' and '".$dateend."' and customer_id = '".$customersales."' order by sales_header_id desc");
        }
        $result = $query->result();
        return $result;
    }

    public function get_purchaseheader_by_suplier($suplierpurchase){
         $query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and suplier_id = '".$suplierpurchase."' ");
         $result = $query->result();
        return $result;
    }
    
    public function get_salesheader_by_customer($customersales){
        $query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id and sales_customer_id = '".$customersales."' order by sales_header_id desc");
        $result = $query->result();
        return $result;
    }

    public function get_autocomplete_suplier($term){
    	 $query = $this->db->query("select * from tbl_mastersuplier where suplier_name like '%".$term."%' and suplier_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_autocomplete_customer($term){
         $query = $this->db->query("select * from tbl_customer where customer_name like '%".$term."%' and customer_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_lastpurchase(){
    	$query = $this->db->query("select * from tbl_header_purchase order by purchase_header_id desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function get_lastsales(){
        $query = $this->db->query("select * from tbl_header_sales  order by sales_header_id desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function get_lastproject(){
        $query = $this->db->query("select * from tbl_project order by project_header_id desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function get_purchasecart($userid){
    	$query = $this->db->query("select * from tbl_detail_purchase_cart a, tbl_masterbarang b, tbl_masterunit c where a.purchase_detail_cart_item = b.master_barang_id and b.master_barang_unit_id = c.unit_id and purchase_detail_cart_admin = '".$userid."'");
        $result = $query->result();
        return $result;
    }

     public function get_salescart($userid){
        $query = $this->db->query("select * from tbl_detail_sales_cart a, tbl_masterbarang b, tbl_masterunit c where a.sales_detail_cart_item = b.master_barang_id and b.master_barang_unit_id = c.unit_id and sales_detail_cart_admin = '".$userid."' ");
        $result = $query->result();
        return $result;
    }
    

    public function get_detailpurchasecart($fakturcode){
        $query = $this->db->query("select * from tbl_detail_purchase_cart where purchase_detail_cart_faktur = '".$fakturcode."'");
        $result = $query->result();
        return $result;
    }

    public function get_detailsalescart($fakturcode){
        $query = $this->db->query("select * from tbl_detail_sales_cart where sales_detail_cart_faktur = '".$fakturcode."'");
        $result = $query->result();
        return $result;
    }

    public function get_total_cart_purchase($userid){
        $query = $this->db->query("select sum(purchase_detail_cart_total) as total_purchase_cart from tbl_detail_purchase_cart where purchase_detail_cart_admin = '".$userid."'  ");
        $result = $query->result();
        return $result;
    }

    public function get_last_post_cart($fakturcode){
        $query = $this->db->query("select * from tbl_detail_purchase_cart where purchase_detail_cart_faktur = '".$fakturcode."'");
        $result = $query->result();
        return $result;
    }

    public function get_last_post_cart_sales($fakturcode){
        $query = $this->db->query("select * from tbl_detail_sales_cart where sales_detail_cart_faktur = '".$fakturcode."'");
        $result = $query->result();
        return $result;
    }

     public function get_price_by_id($id){
        $query = $this->db->query("select * from tbl_masterbarang where master_barang_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_price_by_id_lastcust($id, $customersales){
        $query = $this->db->query("select * from tbl_detail_sales a, tbl_header_sales b where a.sales_detail_faktur = b.sales_faktur_id  and sales_detail_item = '".$id."' and sales_customer_id = '".$customersales."' order by sales_header_id desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function get_total_cart_sales($userid){
        $query = $this->db->query("select sum(sales_detail_cart_total) as total_sales_cart from tbl_detail_sales_cart where sales_detail_cart_admin = '".$userid."'");
        $result = $query->result();
        return $result;
    }

    public function get_gudang_input($fakturcode){
        $query = $this->db->query("select sales_warehouse_cart_admin from tbl_detail_sales_cart where sales_detail_cart_faktur = '".$fakturcode."'");
        $result = $query->result();
        return $result;
    }
    

    public function get_detail_purchase_byfaktur($faktur){
        $query = $this->db->query("select * from tbl_detail_purchase a, tbl_masterbarang b, tbl_masterunit c where a.purchase_detail_item = b.master_barang_id  and b.master_barang_unit_id = c.unit_id and purchase_detail_faktur = '".$faktur."'");
        $result = $query->result();
        return $result;
    }

    public function get_detail_sales_byfaktur($faktur){
        $query = $this->db->query("select * from tbl_detail_sales a, tbl_masterbarang b, tbl_masterunit c where a.sales_detail_item = b.master_barang_id  and b.master_barang_unit_id = c.unit_id and sales_detail_faktur = '".$faktur."'");
        $result = $query->result();
        return $result;
    }

    public function get_header_purchase_byfaktur($faktur){
        $query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and purchase_faktur_id = '".$faktur."'");
        $result = $query->result();
        return $result;
    }

    public function get_header_sales_byfaktur($faktur){
        $query = $this->db->query("select * from tbl_header_sales a, tbl_customer b, tbl_mastercompany c, tbl_mastercompany_bank d where a.sales_customer_id = b.customer_id  and a.sales_company_id = c.mastercompany_id and c.mastercompany_id = d.mastercompany_id and sales_faktur_id = '".$faktur."'");
        $result = $query->result();
        return $result;
    }

    public function check_qty_sent($detail_id)
    {
        $query = $this->db->query("select sales_detail_satuan from tbl_detail_sales where sales_detail_id = '".$detail_id."'");
        $result = $query->result();
        return $result;
    }
    
    public function updatestock($update_stock, $master_gudang_barang_id){
        $this->db->set($update_stock);
        $this->db->where('master_gudang_barang_id ', $master_gudang_barang_id);
        $this->db->update('tbl_master_gudang_barang');
    }

    public function updatesent($data_update, $detail_id)
    {
        $this->db->set($data_update);
        $this->db->where('sales_detail_id ', $detail_id);
        $this->db->update('tbl_detail_sales');
    }

    public function deletecartpurchase($id){
    	$this->db->where('purchase_detail_cart_id ', $id);
        $this->db->delete('tbl_detail_purchase_cart');
    }
    public function deletecartproject($id){
        $this->db->where('project_detail_cart_id  ', $id);
        $this->db->delete('tbl_project_detail_cart');
    }

    public function deletecartsales($id){
        $this->db->where('sales_detail_cart_id', $id);
        $this->db->delete('tbl_detail_sales_cart');
    }

    public function emptycartpurchase($fakturcode){
        $this->db->where('purchase_detail_cart_faktur ', $fakturcode);
        $this->db->delete('tbl_detail_purchase_cart');
    }

    public function emptycartsales($fakturcode){
        $this->db->where('sales_detail_cart_faktur ', $fakturcode);
        $this->db->delete('tbl_detail_sales_cart');
    }

    public function deletesales($id){
        $this->db->where('sales_faktur_id', $id);
        $this->db->delete('tbl_header_sales');
    }

    public function deletedetailsales($id){
        $this->db->where('sales_detail_faktur', $id);
        $this->db->delete('tbl_detail_sales');
    }

    public function deletepurchase($id){
        $this->db->where('purchase_faktur_id', $id);
        $this->db->delete('tbl_header_purchase');
    }

    public function deletedetailpurchase($id){
        $this->db->where('purchase_detail_faktur', $id);
        $this->db->delete('tbl_detail_purchase');
    }

    public function emptyprojectcart($projectnumber){
         $this->db->where('project_detail_cart_number ', $projectnumber);
        $this->db->delete('tbl_project_detail_cart');
    }

    public function updatepaymentsisa($sisapayment, $invoicepayment){
        $this->db->set('purchase_sisa_pembayaran', $sisapayment);
        $this->db->where('purchase_faktur_id', $invoicepayment);
        $this->db->update('tbl_header_purchase');
    }

      public function updatepaymentsisasales($sisapayment, $invoicepayment){
        $this->db->set('sales_sisa_pembayaran', $sisapayment);
        $this->db->where('sales_faktur_id', $invoicepayment);
        $this->db->update('tbl_header_sales');
    }

    public function updatelunas($invoicepayment){
         $this->db->set('purchase_status', 'lunas');
        $this->db->where('purchase_faktur_id', $invoicepayment);
        $this->db->update('tbl_header_purchase');
    }

    public function updatelunassales($invoicepayment){
         $this->db->set('sales_status', 'lunas');
        $this->db->where('sales_faktur_id', $invoicepayment);
        $this->db->update('tbl_header_sales');
    }
    
    public function upload_bukti($purchaseheaderid, $image_name){
         $this->db->set('purchase_bukti_name', $image_name);
        $this->db->where('purchase_header_id ', $purchaseheaderid);
        $this->db->update('tbl_header_purchase');
    }

}

?>