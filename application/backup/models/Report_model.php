<?php

class report_model extends CI_Model {


     public function get_stockreport($productname){
     	if($productname == ''){
     		$query = $this->db->query("select * from tbl_masterbarang a, tbl_masterunit b, tbl_mastercategory c where a.master_barang_unit_id = b.unit_id and a.master_barang_category_id = c.category_id and master_barang_status = 1");
     	}else{
     		$query = $this->db->query("select * from tbl_masterbarang a, tbl_masterunit b, tbl_mastercategory c where a.master_barang_unit_id = b.unit_id and a.master_barang_category_id = c.category_id and master_barang_status = 1");
     	}
        $result = $query->result();
        return $result;
    }

   public function get_reportstock($warehouse){
        if($warehouse == 0){
            $query = $this->db->query("select * from tbl_masterbarang a, tbl_master_gudang_barang b, tbl_masterunit c, tbl_master_gudang d, tbl_mastercompany e, tbl_mastercategory f where a.master_barang_id = b.master_barang_id and  b.master_gudang_id = d.master_gudang_id and a.master_barang_unit_id = c.unit_id and b.master_company_id = e.mastercompany_id and a.master_barang_category_id = f.category_id and master_barang_status = 1 order by e.mastercompany_id");
        }else{
        $query = $this->db->query("select * from tbl_masterbarang a, tbl_master_gudang_barang b, tbl_masterunit c, tbl_master_gudang d, tbl_mastercompany e, tbl_mastercategory f where a.master_barang_id = b.master_barang_id and  b.master_gudang_id = d.master_gudang_id and a.master_barang_unit_id = c.unit_id and b.master_company_id = e.mastercompany_id and a.master_barang_category_id = f.category_id and b.master_company_id  = '".$warehouse."' and master_barang_status = 1");
        }
        $result = $query->result();
        return $result;
    }

    public function get_stocknotinputed(){
        $query = $this->db->query("select *  FROM   tbl_masterbarang  WHERE  master_barang_id NOT IN (SELECT master_barang_id FROM tbl_master_gudang_barang) and master_barang_status = 1");
        $result = $query->result();
        return $result;
    }
   /* public function get_reportstock($warehouse){
        $query = $this->db->query("select * FROM tbl_masterbarang a 
            LEFT JOIN tbl_master_gudang_barang b ON a.master_barang_id = b.master_barang_id  where  master_barang_status = 1");
        $result = $query->result();
        return $result;
    }*/


    public function get_reporthutang(){
    	$query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id and a.sales_status = 'hutang'");
    	$result = $query->result();
        return $result;
    }

    public function get_reporthutang_byduedate($datefrom, $dateend, $customersales){
    	if($datefrom == ''){
    	$query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id and a.sales_status = 'hutang' and sales_customer_id = '".$customersales."'");
    	}else if($customersales == ''){
    	$query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id and a.sales_status = 'hutang' and sales_due_date between '".$datefrom."' and '".$dateend."'");
    	}else{
    	$query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id and a.sales_status = 'hutang' and sales_customer_id = '".$customersales."' and sales_due_date between '".$datefrom."' and '".$dateend."'");
    	}
    	$result = $query->result();
        return $result;
    }

    public function get_reportpiutang_byduedate($datefrom, $dateend, $suplierpurchase){
    	if($datefrom == ''){
    	$query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and a.purchase_status = 'hutang' and purchase_suplier_id = '".$suplierpurchase."'");
    	}else if($suplierpurchase == ''){
    	$query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and a.purchase_status = 'hutang' and purchase_due_date between '".$datefrom."' and '".$dateend."'");
    	}else{
    	$query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and a.purchase_status = 'hutang' and purchase_suplier_id = '".$suplierpurchase."' and purchase_due_date between '".$datefrom."' and '".$dateend."'");
    	}
    	$result = $query->result();
        return $result;
    }

    public function get_reportpiutang(){
    	$query = $this->db->query("select * from tbl_header_purchase a, tbl_mastersuplier b where a.purchase_suplier_id = b.suplier_id and a.purchase_status = 'hutang'");
    	$result = $query->result();
        return $result;
    }

    public function get_report_sales(){
        $query = $this->db->query("select * FROM tbl_header_sales LEFT JOIN tbl_detail_sales ON tbl_header_sales.sales_faktur_id = tbl_detail_sales.sales_detail_faktur JOIN tbl_masterbarang ON tbl_detail_sales.sales_detail_item = tbl_masterbarang.master_barang_id JOIN tbl_masterunit ON tbl_masterbarang.master_barang_unit_id = tbl_masterunit.unit_id JOIN tbl_customer ON tbl_header_sales.sales_customer_id = tbl_customer.customer_id");
        $result = $query->result();
        return $result;
    }

    public function get_report_sales_header(){
        $query = $this->db->query("select * from tbl_header_sales a, tbl_customer b where a.sales_customer_id = b.customer_id");
        $result = $query->result();
        return $result;
    }

    public function get_report_sales_detail(){
        $query = $this->db->query("select * from tbl_detail_sales a, tbl_masterbarang b, tbl_masterunit c where a.sales_detail_item = b.master_barang_id  and b.master_barang_unit_id = c.unit_id");
        $result = $query->result();
        return $result;
    }

    public function get_paymentreport_sales($invoiceno){
        $query = $this->db->query("select * from  tbl_payment_hutang_sales  where  payment_hutang_faktur_id = '".$invoiceno."'");
        $result = $query->result();
        return $result;
    }

    public function get_paymentreport_purchase($invoiceno){
        $query = $this->db->query("select * from  tbl_payment_hutang_purchase  where  payment_hutang_faktur_id = '".$invoiceno."'");
        $result = $query->result();
        return $result;
    }
    
}

?>