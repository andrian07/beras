<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Transaction extends CI_Controller {

	public function __construct(){
	 	parent::__construct();
	 	$this->load->helper('url');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('masterdata_model');
        $this->load->model('transaction_model');
        $this->load->helper(array('url', 'html', 'new'));
     }

     public function index(){
		if(isset($_SESSION['user_name']) != null){
			redirect('Admin/dashboardadmin', 'refresh');
		}else{
			$this->load->view('admin/adminloginview');
		}
	}

	private function check_auth(){
    	if(isset($_SESSION['user_name']) == null){
    		redirect('Admin', 'refresh');
    	}
    }

    public function purchase(){
    	$this->check_auth();
        if($_SESSION['user_role'] != 1){ 
            redirect('Admin', 'refresh');
        }
        if(!$_GET){
        $curmonth = date('Y-m');
		$get_purchaseheader['get_purchaseheader'] = $this->transaction_model->get_purchaseheader($curmonth);
        }else{
        $datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $suplierpurchase = $this->input->get('suplierpurchase');
        $suplierpurchase = substr($suplierpurchase, strpos($suplierpurchase, "/") + 2);
         if($datefrom != '' && $dateend == ''){
                $msg = 'Tanggal Harus Di Isi';
                echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
       
         if($datefrom == ''){
                $get_purchaseheader['get_purchaseheader'] = $this->transaction_model->get_purchaseheader_by_suplier($suplierpurchase);
            }else{
                $get_purchaseheader['get_purchaseheader'] = $this->transaction_model->get_purchaseheader_by_date($datefrom, $dateend, $suplierpurchase);
            }
        }
		$this->load->view('admin/purchaseview', $get_purchaseheader);
    }

    public function sales(){
        $this->check_auth();
        if(!$_GET){
        $curmonth = date('Y-m');
        $get_salesheader['get_salesheader'] = $this->transaction_model->get_salesheader($curmonth);
        }else{
        $datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $customersales = $this->input->get('customersales');
        $customersales = substr($customersales, strpos($customersales, "/") + 2);
        if($datefrom != '' && $dateend == ''){
                $msg = 'Tanggal Harus Di Isi';
                echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        if($datefrom == ''){
                $get_salesheader['get_salesheader'] = $this->transaction_model->get_salesheader_by_customer($customersales);
            }else{
                $get_salesheader['get_salesheader'] = $this->transaction_model->get_salesheader_by_date($datefrom, $dateend, $customersales);
            }
        }
        $this->load->view('admin/salesview', $get_salesheader);
    }

    public function deletesales(){
        $this->check_auth();
        $id = $this->input->get('id');
        $deletesales = $this->transaction_model->deletesales($id);
        $deletedetailsales = $this->transaction_model->deletedetailsales($id);
        redirect('Transaction/sales', 'refresh');
    }

    public function deletepurchase(){
        $this->check_auth();
        $id = $this->input->get('id');
        $deletepurchase = $this->transaction_model->deletepurchase($id);
        $deletedetailpurchase = $this->transaction_model->deletedetailpurchase($id);
        redirect('Transaction/purchase', 'refresh');
    }

    public function detailpurchase(){
        $this->check_auth();
        $faktur = $this->input->get('id');
        $get_detail_purchase_byfaktur['get_detail_purchase_byfaktur'] = $this->transaction_model->get_detail_purchase_byfaktur($faktur);
        $get_header_purchase_byfaktur['get_header_purchase_byfaktur'] = $this->transaction_model->get_header_purchase_byfaktur($faktur);
        $data['datas'] = array_merge_recursive($get_detail_purchase_byfaktur, $get_header_purchase_byfaktur);
        $this->load->view('admin/detailpurchaseview', $data);
    }

    public function retursales(){
        $this->check_auth();
        $faktur = $this->input->get('id');
        $get_detail_sales_byfaktur['get_detail_sales_byfaktur'] = $this->transaction_model->get_detail_sales_byfaktur($faktur);
        $get_header_sales_byfaktur['get_header_sales_byfaktur'] = $this->transaction_model->get_header_sales_byfaktur($faktur);
        $data['datas'] = array_merge_recursive($get_detail_sales_byfaktur, $get_header_sales_byfaktur);
        $this->load->view('admin/retursalesview', $data);
    }

    


    public function detailsales(){
        $this->check_auth();
        $faktur = $this->input->get('id');
        $get_detail_sales_byfaktur['get_detail_sales_byfaktur'] = $this->transaction_model->get_detail_sales_byfaktur($faktur);
        $get_header_sales_byfaktur['get_header_sales_byfaktur'] = $this->transaction_model->get_header_sales_byfaktur($faktur);
        $data['datas'] = array_merge_recursive($get_detail_sales_byfaktur, $get_header_sales_byfaktur);
        $this->load->view('admin/detailsalesview', $data);
    }


    public function printnotapenjualan(){
        $this->check_auth();
        $faktur = $this->input->get('id');
        $printtype = $this->input->get('printtype');
        $get_detail_sales_byfaktur['get_detail_sales_byfaktur'] = $this->transaction_model->get_detail_sales_byfaktur($faktur);
        $get_header_sales_byfaktur['get_header_sales_byfaktur'] = $this->transaction_model->get_header_sales_byfaktur($faktur);
        $data['datas'] = array_merge_recursive($get_detail_sales_byfaktur, $get_header_sales_byfaktur);
        if($printtype == 1){
        $this->load->view('admin/printnotapenjualan', $data);
        }else if($printtype == 2){
        $this->load->view('admin/printsuratjalanview', $data);
        }else if($printtype == 3){
        $this->load->view('admin/printkwitansiview', $data);
        }
    }

    public function addpurchaseview(){
    	$this->check_auth();
    	$userid = $_SESSION['user_id'];
		$get_mastersuplier['get_mastersuplier'] = $this->masterdata_model->get_mastersuplier();
		$get_purchasecart['get_purchasecart'] = $this->transaction_model->get_purchasecart($userid);
		$get_lastpurchase['get_lastpurchase'] = $this->transaction_model->get_lastpurchase();
        $get_mastercompany['get_mastercompany'] = $this->masterdata_model->get_mastercompany();
        $get_masterbarang['get_masterbarang'] = $this->masterdata_model->get_masterbarang();
        $get_mastersuplier['get_mastersuplier'] = $this->masterdata_model->get_mastersuplier();
        $get_gudang['get_gudang'] = $this->masterdata_model->get_gudang();
		$data['datas'] = array_merge_recursive($get_mastersuplier, $get_purchasecart, $get_lastpurchase,$get_mastercompany,$get_gudang, $get_mastersuplier, $get_masterbarang);
		$this->load->view('admin/addpurchaseview', $data);
    }

    public function addsalesview(){
        $this->check_auth();
        $userid = $_SESSION['user_id'];
        $get_mastersuplier['get_mastersuplier'] = $this->masterdata_model->get_mastersuplier();
        $get_salescart['get_salescart'] = $this->transaction_model->get_salescart($userid);
        $get_lastsales['get_lastsales'] = $this->transaction_model->get_lastsales();
        $get_mastercompany['get_mastercompany'] = $this->masterdata_model->get_mastercompany();
        $get_gudang['get_gudang'] = $this->masterdata_model->get_gudang();
        $get_masterbarang['get_masterbarang'] = $this->masterdata_model->get_masterbarang();
        $get_mastercustomer['get_mastercustomer'] = $this->masterdata_model->get_mastercustomer();
         $get_mastersales['get_mastersales'] = $this->masterdata_model->get_mastersales();
        $data['datas'] = array_merge_recursive($get_mastersuplier, $get_salescart, $get_lastsales,$get_mastercompany, $get_gudang, $get_masterbarang, $get_mastercustomer, $get_mastersales);

        $this->load->view('admin/addsalesview', $data);
    }

    public function processaddpurchasedetailcart(){
    	$purcasedetailitem = $this->input->post('purcasedetailitem');
    	$qtycartdetailpurchase = $this->input->post('qtycartdetailpurchase');
    	$discountcartdetailpurchase = $this->input->post('discountcartdetailpurchase');
    	$fakturcode = $this->input->post('fakturcode');
    	$buydetailpurchase = $this->input->post('buydetailpurchase');
        $suplierpurchase = $this->input->post('suplierpurchase');
        $companypurchase = $this->input->post('companypurchase');

    	if($discountcartdetailpurchase == ''){
		 	$msg = 'Discount Harus Di Isi Minimal 0';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}	
		if($qtycartdetailpurchase == ''){
		 	$msg = 'Qty Harus Diisi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}
		if($buydetailpurchase == ''){
		 	$msg = 'Harga Beli Harus Di isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}	
        if($suplierpurchase == ''){
            $msg = 'Silahkan Pilih Suplier Terlebih Dahulu';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        if($companypurchase == ''){
            $msg = 'Silahkan Pilih Nama Perusahaan';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

    	$get_masterbarang_byid = $this->masterdata_model->get_masterbarang_byid($purcasedetailitem);
    	if(!isset($get_masterbarang_byid[0]->master_barang_harga_modal)){
		 	$msg = 'Item Tidak Di Temukan';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}
    	$total = $buydetailpurchase * $qtycartdetailpurchase - $discountcartdetailpurchase;
    	$data_insert = array(
			'purchase_detail_cart_faktur' => $fakturcode,
			'purchase_detail_cart_item' => $purcasedetailitem,
            'purchase_detail_cart_suplier' => $suplierpurchase,
            'purchase_detail_cart_company' => $companypurchase,
			'purchase_detail_cart_price' => $buydetailpurchase,
			'purchase_detail_cart_satuan' => $qtycartdetailpurchase,
			'purchase_detail_cart_discount' => $discountcartdetailpurchase,
			'purchase_detail_cart_total' => $total,
			'purchase_detail_cart_admin' => $_SESSION['user_id']
        );
    	$insertpurchasecart = $this->transaction_model->insertpurchasecart($data_insert);
    	$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
    }

    public function processaddsalesdetailcart(){
        $userid = $_SESSION['user_id'];
        $purcasedetailitem = $this->input->post('purcasedetailitem');
        $qtycartdetailsales = $this->input->post('qtycartdetailsales');
        $discountcartdetailsales = $this->input->post('discountcartdetailsales');
        $fakturcode = $this->input->post('fakturcode');
        $warehouse = $this->input->post('warehouse');
        $salesdesc = $this->input->post('salesdesc');
        $sellprice = $this->input->post('sellprice');
        $customersales = $this->input->post('customersales');
        $companypurchase = $this->input->post('companypurchase');



        if($warehouse == ''){
            $msg = 'Gudang Harus Diisi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        if($discountcartdetailsales == ''){
            $msg = 'Discount Harus Di Isi Minimal 0';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }   
        if($qtycartdetailsales == ''){
            $msg = 'Qty Harus Diisi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        if($customersales == ''){
            $msg = 'Silahkan Pilih Nama Pelanggan';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        
        if($companypurchase == ''){
            $msg = 'Silahkan Pilih Nama Perusahaan';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

        $get_masterbarang_byid = $this->masterdata_model->get_masterbarang_byid($purcasedetailitem);
        $get_stock_check = $this->masterdata_model->get_stock_check($purcasedetailitem, $warehouse);
        $check_sales_cart = $this->transaction_model->check_sales_cart($userid, $purcasedetailitem);


        if($check_sales_cart != null){
            $msg = 'Data Item Sudah Di Input';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

        if(!isset($get_stock_check[0]->master_gudang_stock)){
            $msg = 'Stock Di Gudang Tidak Cukup';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        $stock = $get_stock_check[0]->master_gudang_stock;
        if($stock < $qtycartdetailsales){
            $msg = 'Stock Tidak Cukup';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

        if(!isset($get_masterbarang_byid[0]->master_barang_harga_modal)){
            $msg = 'Item Tidak Di Temukan';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        $total = $sellprice * $qtycartdetailsales - $discountcartdetailsales;
        $data_insert = array(
            'sales_detail_cart_faktur' => $fakturcode,
            'sales_detail_cart_item' => $purcasedetailitem,
            'sales_detail_cart_price' => $sellprice,
            'sales_detail_cart_satuan' => $qtycartdetailsales,
            'sales_detail_cart_discount' => $discountcartdetailsales,
            'sales_detail_cart_total' => $total,
            'sales_detail_cart_customer' => $customersales,
            'sales_detail_cart_company' => $companypurchase,
            'sales_detail_cart_admin' => $_SESSION['user_id'],
            'sales_warehouse_cart_admin' => $warehouse,
            'sales_description_cart' =>  $salesdesc
        );
        $insertsellcart = $this->transaction_model->insertsellcart($data_insert);
        $msg = 'Sukses';
        echo json_encode(['code'=>200, 'msg'=>$msg]);die();
    }

    public function processaddheaderpurchase(){
        $fakturcode = $this->input->post('fakturcode');
        $suplierpurchase = $this->input->post('suplierpurchase');
        $purchasedate = $this->input->post('purchasedate');
        $companypurchase = $this->input->post('companypurchase');
        $purchaseduedate = $this->input->post('purchaseduedate');
        $total_purchase_cart = $this->input->post('total_purchase_cart');
        $discountpurchase = $this->input->post('discountpurchase');
        $grandtotalpurchase = $this->input->post('grandtotalpurchase');
        $paymentstatus = $this->input->post('paymentstatus'); 
        $gudang = $this->input->post('gudang');

        $check_suplierbyid = $this->masterdata_model->check_suplierbyid($suplierpurchase);


        if($paymentstatus == ''){
            $msg = 'Status Pembayaran Harus Di isi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

        if($gudang == ''){
            $msg = 'Silahkan Pilih Gudang';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

        if(!isset($check_suplierbyid[0]->suplier_name)){
            $msg = 'Nama Suplier Harus Di isi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        $get_detailpurchasecart = $this->transaction_model->get_detailpurchasecart($fakturcode);

        
         $data_insert_header = array(
                'purchase_faktur_id' => $fakturcode,
                'purchase_suplier_id' => $suplierpurchase,
                'purchase_company_id' => $companypurchase,
                'purchase_date' => $purchasedate,
                'purchase_due_date' => $purchaseduedate,
                'purchase_subtotal' => $total_purchase_cart,
                'purchase_discount' => $discountpurchase,
                'purchase_total' => $grandtotalpurchase,
                'purchase_sisa_pembayaran' => $grandtotalpurchase,
                'purchase_status' => $paymentstatus,
            );
        $insertheaderpurchase = $this->transaction_model->insertheaderpurchase($data_insert_header);

        foreach ($get_detailpurchasecart as $row) {
            $data_insert = array(
                'purchase_detail_faktur' => $row->purchase_detail_cart_faktur,
                'purchase_detail_item' => $row->purchase_detail_cart_item,
                'purchase_detail_price' => $row->purchase_detail_cart_price,
                'purchase_detail_satuan' => $row->purchase_detail_cart_satuan,
                'purchase_detail_discount' => $row->purchase_detail_cart_discount,
                'purchase_detail_total' => $row->purchase_detail_cart_total,
                'purchase_detail_cart_admin' => $row->purchase_detail_cart_admin,
                'purchase_detail_company' => $row->purchase_detail_cart_company
            );
            $insertdetailpurchase = $this->transaction_model->insertdetailpurchase($data_insert);

            $item_id = $row->purchase_detail_cart_item;
            $get_last_stock = $this->masterdata_model->get_last_stock($item_id, $gudang);
            if($get_last_stock == null){
                 $data_insert_gudang = array(
                'master_gudang_id' => $gudang,
                'master_barang_id' => $row->purchase_detail_cart_item,
                'master_company_id' => $row->purchase_detail_cart_company,
                'master_gudang_stock' => $row->purchase_detail_cart_satuan
                );
                 $data_insert_gudang = $this->transaction_model->data_insert_gudang($data_insert_gudang);
            }else{
                $update_stock = array(
                'master_gudang_stock' =>  $get_last_stock[0]->master_gudang_stock + $row->purchase_detail_cart_satuan,
                );
                $master_gudang_barang_id  = $get_last_stock[0]->master_gudang_barang_id;
                $updatestock = $this->transaction_model->updatestock($update_stock, $master_gudang_barang_id);
            }
        }

        $emptycartpurchase = $this->transaction_model->emptycartpurchase($fakturcode);
        $msg = 'Sukses';
        echo json_encode(['code'=>200, 'msg'=>$msg]);die();
    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
 
    public function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }           
        return $hasil;
    }

    public function processaddheadersales(){
        $fakturcode = $this->input->post('fakturcode');
        $customersales = $this->input->post('customersales');
        $salesdate = $this->input->post('salesdate');
        $salesduedate = $this->input->post('salesduedate');
        $total_sales_cart = $this->input->post('total_sales_cart');
        $discountsales = $this->input->post('discountsales');
        $grandtotalsales = $this->input->post('grandtotalsales');
        $paymentstatus = $this->input->post('paymentstatus');
        $salesname = $this->input->post('salesname');
        $warehouse = $this->input->post('warehouse');
        $ponumber = $this->input->post('ponumber');
         $companypurchase = $this->input->post('companypurchase');
        $terbilang =  $this->terbilang($grandtotalsales);

    
        $check_customerbyid = $this->masterdata_model->check_customerbyid($customersales);

        if($paymentstatus == ''){
            $msg = 'Status Pembayaran Harus Di isi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }

        if($salesname == ''){
           $msg = 'Nama Sales Harus Di isi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();  
        }

        if(!isset($check_customerbyid[0]->customer_name)){
            $msg = 'Nama Pelanggan Harus Di isi';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die();
        }
        $get_detailsalescart = $this->transaction_model->get_detailsalescart($fakturcode);
      
        
         $data_insert_header = array(
                'sales_faktur_id' => $fakturcode,
                'sales_customer_id' => $customersales,
                'sales_company_id' => $companypurchase,
                'sales_date' => $salesdate,
                'sales_due_date' => $salesduedate,
                'sales_subtotal' => $total_sales_cart,
                'sales_discount' => $discountsales,
                'sales_total' => $grandtotalsales,
                'sales_sisa_pembayaran' => $grandtotalsales,
                'sales_sales_name' => $salesname, 
                'sales_status' => $paymentstatus,
                'sales_warehouse' => $warehouse,
                'sales_po' => $ponumber,
                'sales_terbilang' => $terbilang
            );
        $insertheadersales = $this->transaction_model->insertheadersales($data_insert_header);

        foreach ($get_detailsalescart as $row) {
            $data_insert = array(
                'sales_detail_faktur' => $row->sales_detail_cart_faktur,
                'sales_detail_item' => $row->sales_detail_cart_item,
                'sales_detail_price' => $row->sales_detail_cart_price,
                'sales_detail_satuan' => $row->sales_detail_cart_satuan,
                'sales_detail_discount' => $row->sales_detail_cart_discount,
                'sales_detail_total' => $row->sales_detail_cart_total,
                'sales_detail_admin' => $row->sales_detail_cart_admin,
                'sales_detail_warehouse' => $row->sales_warehouse_cart_admin,
                'sales_description' => $row->sales_description_cart,
            );
            $insertdetailsales = $this->transaction_model->insertdetailsales($data_insert);

            $item_id = $row->sales_detail_cart_item;
            $gudang = $row->sales_warehouse_cart_admin;
            $get_last_stock = $this->masterdata_model->get_last_stock($item_id, $gudang);
            $update_stock = array(
                'master_gudang_stock' =>  $get_last_stock[0]->master_gudang_stock - $row->sales_detail_cart_satuan,
                );
            $master_gudang_barang_id  = $get_last_stock[0]->master_gudang_barang_id;
            $updatestock = $this->transaction_model->updatestock($update_stock, $master_gudang_barang_id);
        }

        $emptycartsales = $this->transaction_model->emptycartsales($fakturcode);
        $msg = 'Sukses';
        echo json_encode(['code'=>200, 'msg'=>$msg]);die();
    }


    public function updatepayment(){
        $invoicepayment = $this->input->post('invoicepayment'); 
        $totalpayment = $this->input->post('totalpayment');
        $totalpaymentpay = $this->input->post('totalpaymentpay');
        $sisapayment = $this->input->post('sisapayment');

        if($totalpaymentpay == ''){
            $msg = 'Total Pembayran Tidak Boleh Kosong';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die(); 
        }
        
        if($totalpaymentpay > $totalpayment){
            $msg = 'Pembayaran Melebihi Total Yang Di Bayar';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die(); 
        }

        $data_insert = array(
                'payment_hutang_faktur_id' => $invoicepayment,
                'payment_hutang_total' => $totalpaymentpay,
                'payment_sisa_hutang' => $sisapayment
        );
        $inputpaymentpurchase = $this->transaction_model->inputpaymentpurchase($data_insert);
        $updatepaymentsisa = $this->transaction_model->updatepaymentsisa($sisapayment, $invoicepayment);
        if($sisapayment == 0){
        $updatelunas = $this->transaction_model->updatelunas($invoicepayment);
        }
        $msg = 'Sukses';
        echo json_encode(['code'=>200, 'msg'=>$msg]);die();
    }


    public function updatepaymentsales(){
        $invoicepayment = $this->input->post('invoicepayment'); 
        $totalpayment = $this->input->post('totalpayment');
        $totalpaymentpay = $this->input->post('totalpaymentpay');
        $sisapayment = $this->input->post('sisapayment');

        if($totalpaymentpay == ''){
            $msg = 'Total Pembayran Tidak Boleh Kosong';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die(); 
        }
        
        if($totalpaymentpay > $totalpayment){
            $msg = 'Pembayaran Melebihi Total Yang Di Bayar';
            echo json_encode(['code'=>0, 'msg'=>$msg]);die(); 
        }

        $data_insert = array(
                'payment_hutang_faktur_id' => $invoicepayment,
                'payment_hutang_total' => $totalpaymentpay,
                'payment_sisa_hutang' => $sisapayment
        );
        $inputpaymentsales = $this->transaction_model->inputpaymentsales($data_insert);
        $updatepaymentsisasales = $this->transaction_model->updatepaymentsisasales($sisapayment, $invoicepayment);
        if($sisapayment == 0){
        $updatelunassales = $this->transaction_model->updatelunassales($invoicepayment);
        }
        $msg = 'Sukses';
        echo json_encode(['code'=>200, 'msg'=>$msg]);die();
    }

    public function uploadbukti(){

        $purchaseheaderid = $this->input->post('purchaseheaderid');
        $berkastp = $this->input->post('berkastp');
        $config['upload_path'] = './asset/images/bukti';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1200;
        $config['max_width'] = 15500;
        $config['max_height'] = 15500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('berkastp')) {
            $error = array('error' => $this->upload->display_errors());
            print_r("Ukuran File Photo Terlalu Besar");die();
        } 

        $data = array('image_metadata' => $this->upload->data());
        $image_name = $data['image_metadata']['file_name'];
        $upload_bukti = $this->transaction_model->upload_bukti($purchaseheaderid, $image_name);
        redirect('Transaction/purchase', 'refresh');
    }

    public function deletecartpurchase(){
    	$id = $this->input->get('id');
    	$deletecartpurchase = $this->transaction_model->deletecartpurchase($id);
    	redirect('Transaction/addpurchaseview', 'refresh');
    }

    

    public function deletecartsales(){
        $id = $this->input->get('id');
        $deletecartsales = $this->transaction_model->deletecartsales($id);
        redirect('Transaction/addsalesview', 'refresh');
    }

    public function get_autocomplete_suplier(){
   			$this->check_auth(); 
            if (isset($_GET['term'])) {
            $term =  $this->input->get('term');
           	$result = $this->transaction_model->get_autocomplete_suplier($term);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->suplier_name.' / '.$row->suplier_id;
                echo json_encode($arr_result);
            	}
        	}
    }
    public function get_autocomplete_customer(){
        $this->check_auth(); 
            if (isset($_GET['term'])) {
            $term =  $this->input->get('term');
            $result = $this->transaction_model->get_autocomplete_customer($term);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->customer_name.' / '.$row->customer_id ;
                echo json_encode($arr_result);
                }
            }
    }

      public function get_total_cart_purchase(){

            $this->check_auth(); 
            $userid = $_SESSION['user_id'];
            $result = $this->transaction_model->get_total_cart_purchase($userid);
            $total_purchase_cart =    $result[0]->total_purchase_cart;


            echo json_encode(['code'=>200, 'total_purchase_cart'=>$total_purchase_cart]);

    }

    public function get_last_post_cart(){

            $this->check_auth(); 
            $fakturcode = $this->input->post('fakturcode');
            $result = $this->transaction_model->get_last_post_cart($fakturcode);
            $purchase_detail_cart_suplier =    $result[0]->purchase_detail_cart_suplier;
            $purchase_detail_cart_company =    $result[0]->purchase_detail_cart_company;
            echo json_encode(['code'=>200, 'purchase_detail_cart_suplier'=>$purchase_detail_cart_suplier, 'purchase_detail_cart_company'=>$purchase_detail_cart_company]);

    }

    public function get_last_post_cart_sales(){
            $this->check_auth(); 
            $fakturcode = $this->input->post('fakturcode');
            $result = $this->transaction_model->get_last_post_cart_sales($fakturcode);
            $sales_detail_cart_customer =    $result[0]->sales_detail_cart_customer;
            $sales_detail_cart_company =    $result[0]->sales_detail_cart_company;
            echo json_encode(['code'=>200, 'sales_detail_cart_customer'=>$sales_detail_cart_customer, 'sales_detail_cart_company'=>$sales_detail_cart_company]);

    }

     public function get_price_by_id_purchase(){
         $this->check_auth(); 
            $id = $_GET['id'];
            $result = $this->transaction_model->get_price_by_id($id);
            $master_barang_harga_modal = $result[0]->master_barang_harga_modal;
            echo json_encode(['code'=>200, 'master_barang_harga_modal'=>$master_barang_harga_modal]);
     } 

     public function get_price_by_id(){
            $this->check_auth(); 
            $id = $_GET['id'];
            $customersales = $_GET['cust'];
            $result = $this->transaction_model->get_price_by_id($id);
            $master_barang_harga_modal = $result[0]->master_barang_harga_modal;
            $result1 = $this->transaction_model->get_price_by_id_lastcust($id, $customersales);
            if($result1 != null){
            $master_barang_harga_jual = $result1[0]->sales_detail_price;
            }else{
            $result = $this->transaction_model->get_price_by_id($id);
            $master_barang_harga_jual = $result[0]->master_barang_harga_jual; 
                if($master_barang_harga_jual == 0){
                    echo json_encode(['code'=>0, 'msg'=>'Harga Jual Belum Di Setting', 'master_barang_harga_modal'=>'0']);die();
                }  
            }
            echo json_encode(['code'=>200, 'master_barang_harga_modal'=>$master_barang_harga_modal, 'master_barang_harga_jual'=>$master_barang_harga_jual]);

    }


     public function get_total_cart_sales(){

            $this->check_auth(); 
            $userid = $_SESSION['user_id'];
            $result = $this->transaction_model->get_total_cart_sales($userid);
            $total_sales_cart =    $result[0]->total_sales_cart;
            echo json_encode(['code'=>200, 'total_sales_cart'=>$total_sales_cart]);

    }


    public function get_gudang_input(){
            $this->check_auth(); 
            $userid = $_SESSION['user_id'];
            $fakturcode = $this->input->post('fakturcode');
            $result = $this->transaction_model->get_gudang_input($fakturcode);
            $sales_warehouse_cart_admin = $result[0]->sales_warehouse_cart_admin;
            echo json_encode(['code'=>200, 'sales_warehouse_cart_admin'=>$sales_warehouse_cart_admin]);

    }

 
}

?>