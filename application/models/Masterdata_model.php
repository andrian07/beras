<?php

class masterdata_model extends CI_Model {

    public function insertmasterbarang($data_insert){
        $this->db->insert('tbl_masterbarang', $data_insert);
    }

    public function insertmastersuplier($data_insert){
        $this->db->insert('tbl_mastersuplier', $data_insert);
    }

    public function insertmastercustomer($data_insert){
        $this->db->insert('tbl_customer', $data_insert);
    }
    public function insertunit($data_insert){
        $this->db->insert('tbl_masterunit', $data_insert);
    }
    public function insertcategory($data_insert){
        $this->db->insert('tbl_mastercategory', $data_insert);
    }
    public function insertmastersales($data_insert){
         $this->db->insert('tbl_mastersales', $data_insert);
    }
    public function insertmastercompany($data_insert){
         $this->db->insert('tbl_mastercompany', $data_insert);
    }

    public function insertbankaccount($data_insert){
        $this->db->insert('tbl_mastercompany_bank', $data_insert);
    }

    public function get_masterbarang(){
        $query = $this->db->query("select * from tbl_masterbarang a, tbl_masterunit b, tbl_mastercategory c where a.master_barang_unit_id = b.unit_id and a.master_barang_category_id = c.category_id and master_barang_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_transaction_today()
    {
        $query = $this->db->query("select sum(sales_total) as total_transaction from tbl_header_sales where sales_date = CURRENT_DATE()");
        $result = $query->result();
        return $result;
    }

    public function get_hutang_today()
    {
        $query = $this->db->query("select sum(purchase_sisa_pembayaran) as total_hutang from tbl_header_purchase where purchase_status = 'hutang' and purchase_date = CURRENT_DATE()");
        $result = $query->result();
        return $result;
    }

    public function get_piutang_today()
    {
        $query = $this->db->query("select sum(sales_sisa_pembayaran) as total_piutang from tbl_header_sales where sales_status = 'hutang' and sales_date = CURRENT_DATE()");
        $result = $query->result();
        return $result;
    }

    public function get_list_piutang_today()
    {
        $query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id and sales_status = 'hutang' and sales_due_date = CURRENT_DATE()");
        $result = $query->result();
        return $result;
    }

    public function get_not_send_product($curent_date, $before_date)
    {   
 
        $query = $this->db->query("select * from tbl_detail_sales a, tbl_masterbarang b, tbl_header_sales c where a.sales_detail_item = b.master_barang_id and a.sales_detail_faktur = c.sales_faktur_id and sales_detail_sent < sales_detail_satuan and c.sales_date between '".$before_date."' and '".$curent_date."'");
        $result = $query->result();
        return $result;
    }

    public function get_product_total()
    {
        $query = $this->db->query("select sum(sales_detail_total) as total_price, master_barang_name, sum(sales_detail_satuan) as total_satuan from tbl_detail_sales a, tbl_masterbarang b, tbl_header_sales c where a.sales_detail_item = b.master_barang_id and a.sales_detail_faktur = c.sales_faktur_id and sales_date = CURRENT_DATE() group by sales_detail_item order by total_price desc");
        $result = $query->result();
        return $result;
    }
    

    public function get_mastercompany(){
        $query = $this->db->query("select * from tbl_mastercompany where mastercompany_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_masterbarang_detail($id){
         $query = $this->db->query("select * from tbl_masterbarang a, tbl_masterunit b, tbl_mastercategory c, tbl_master_gudang_barang d, tbl_master_gudang e where a.master_barang_unit_id = b.unit_id and a.master_barang_category_id = c.category_id and a.master_barang_id = d.master_barang_id and e.master_gudang_id = d.master_gudang_id and master_barang_status = 1 and a.master_barang_id = '".$id."'");
        $result = $query->result();
        return $result;
    }


    public function get_gudang(){
         $query = $this->db->query("select * from tbl_master_gudang where master_gudang_active = 1");
        $result = $query->result();
        return $result;
    }

    public function get_passwordmodal($passwordmodal){
         $query = $this->db->query("select * from tbl_admin_success where admin_success_password = '".$passwordmodal."'");
        $result = $query->result();
        return $result;
    }

    public function get_mastersales(){
        $query = $this->db->query("select * from tbl_mastersales where sales_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_masterbarang_byid($purcasedetailitem){
        $query = $this->db->query("select * from tbl_masterbarang a, tbl_masterunit b, tbl_mastercategory c where a.master_barang_unit_id = b.unit_id and a.master_barang_category_id = c.category_id and master_barang_status = 1 and master_barang_id = '".$purcasedetailitem."'");
        $result = $query->result();
        return $result;
    }

     public function get_stock_check($purcasedetailitem, $warehouse){
        $query = $this->db->query("select * from tbl_master_gudang_barang where master_gudang_id = '".$warehouse."' and master_barang_id = '".$purcasedetailitem."'");
        $result = $query->result();
        return $result;
    }

    public function get_mastersuplier(){
         $query = $this->db->query("select * from tbl_mastersuplier where suplier_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_mastercustomer(){
         $query = $this->db->query("select * from tbl_customer where customer_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_last_stock($item_id, $gudang){
         $query = $this->db->query("select * from tbl_master_gudang_barang where master_gudang_id = '".$gudang."' and master_barang_id = '".$item_id."'");
        $result = $query->result();
        return $result;
    }
    

     public function get_codeitem($codeitem){
        $query = $this->db->query("select * from tbl_masterbarang where master_barang_code = '".$codeitem."'");
        $result = $query->result();
        return $result;
    }

    public function get_mastercategory(){
    	$query = $this->db->query("select * from tbl_mastercategory where category_status = 1");
        $result = $query->result();
        return $result;
    }

    public function check_suplierbyid($suplierpurchase){
        $query = $this->db->query("select * from tbl_mastersuplier where suplier_id = '".$suplierpurchase."' and suplier_status = 1");
        $result = $query->result();
        return $result;
    }

     public function check_customerbyid($customersales){
        $query = $this->db->query("select * from tbl_customer where customer_id  = '".$customersales."' and customer_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_masterunit(){
    	$query = $this->db->query("select * from tbl_masterunit where unit_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_mastercompany_bank($id){
        $query = $this->db->query("select * from tbl_mastercompany_bank a, tbl_mastercompany b where a.mastercompany_id = b.mastercompany_id and b.mastercompany_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_oldpass($user_idlogin){
        $query = $this->db->query("select * from tbl_admin where admin_id = '".$user_idlogin."'");
        $result = $query->result();
        return $result;
    }


    public function editmasterbarang($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('master_barang_id', $id);
        $this->db->update('tbl_masterbarang');
    }

    public function editbankaccount($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('mastercompany_bank_id ', $id);
        $this->db->update('tbl_mastercompany_bank');
    }

     public function editmastercompany($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('mastercompany_id', $id);
        $this->db->update('tbl_mastercompany');
    }

     public function editmastersuplier($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('suplier_id', $id);
        $this->db->update('tbl_mastersuplier');
    }

    public function editmastercustomer($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('customer_id', $id);
        $this->db->update('tbl_customer');
    }

    public function editunit($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('unit_id', $id);
        $this->db->update('tbl_masterunit');
    }

     public function editcategory($data_insert, $id){
        $this->db->set($data_insert);
        $this->db->where('category_id ', $id);
        $this->db->update('tbl_mastercategory');
    }

    public function editmastersales($data_insert, $id){
         $this->db->set($data_insert);
        $this->db->where('sales_id', $id);
        $this->db->update('tbl_mastersales');
    }

    public function updatepass($data_insert, $user_idlogin){
        $this->db->set($data_insert);
        $this->db->where('admin_id ', $user_idlogin);
        $this->db->update('tbl_admin');
    }

     public function deletemasterbarang($id){
        $this->db->set('master_barang_status', '0');
        $this->db->where('master_barang_id  ', $id);
        $this->db->update('tbl_masterbarang');
    }

    public function deletemastersales($id){
        $this->db->set('sales_status', '0');
        $this->db->where('sales_id  ', $id);
        $this->db->update('tbl_mastersales');
    }

    public function deletemastersuplier($id){
        $this->db->set('suplier_status', '0');
        $this->db->where('suplier_id', $id);
        $this->db->update('tbl_mastersuplier');
    }

    public function deletemastercustomer($id){
        $this->db->set('customer_status', '0');
        $this->db->where('customer_id', $id);
        $this->db->update('tbl_customer');
    }

     public function deleteunit($id){
        $this->db->set('unit_status', '0');
        $this->db->where('unit_id', $id);
        $this->db->update('tbl_masterunit');
    }

    public function deletecategory($id){
        $this->db->set('category_status', '0');
        $this->db->where('category_id', $id);
        $this->db->update('tbl_mastercategory');
    }

    
     public function get_autocomplete_item($term){
         $query = $this->db->query("select * from tbl_masterbarang where master_barang_name like '%".$term."%' and master_barang_status = 1");
        $result = $query->result();
        return $result;
    }

    public function get_autocomplete_sales($term){
         $query = $this->db->query("select * from tbl_mastersales where sales_name like '%".$term."%' and sales_status = 1");
        $result = $query->result();
        return $result;
    }

    
}

?>