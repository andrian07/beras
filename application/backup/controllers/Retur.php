<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Retur extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admin_model');
		$this->load->model('masterdata_model');
		$this->load->model('report_model');
		$this->load->model('retur_model');
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


	public function retursales(){
		$this->check_auth();
		$get_header_faktur['get_header_faktur'] = $this->retur_model->get_header_faktur();
		$this->load->view('admin/retursalesview', $get_header_faktur);
	}

	public function addretursales(){
		$this->check_auth();
		$userid = $_SESSION['user_id'];
		$get_salesheader_retur['get_salesheader_retur'] = $this->retur_model->get_salesheader_retur();
		$get_mastercustomer['get_mastercustomer'] = $this->masterdata_model->get_mastercustomer();
		$get_mastercompany['get_mastercompany'] = $this->masterdata_model->get_mastercompany();
		$get_masterbarang['get_masterbarang'] = $this->masterdata_model->get_masterbarang();
		$get_gudang['get_gudang'] = $this->masterdata_model->get_gudang();
		$get_lastretursales['get_lastretursales'] = $this->retur_model->get_lastretursales();
		$get_retur_sales_cart['get_retur_sales_cart'] = $this->retur_model->get_retur_sales_cart($userid);
		$data['datas'] = array_merge_recursive($get_salesheader_retur, $get_lastretursales, $get_mastercustomer, $get_mastercompany, $get_masterbarang, $get_gudang, $get_retur_sales_cart);
		$this->load->view('admin/addretursales', $data);
	}

	public function get_sales_header_data(){
		$this->check_auth(); 
		$id = $_GET['id'];
		$result = $this->retur_model->get_sales_header_data($id);
		$sales_customer_id = $result[0]->sales_customer_id;
		$sales_company_id = $result[0]->sales_company_id;
		echo json_encode(['code'=>200, 'sales_customer_id'=>$sales_customer_id, 'sales_company_id'=>$sales_company_id]);
	}

	public function get_detailretur(){
		$this->check_auth(); 
		$id = $_GET['id'];
		$salesfakturid = $_GET['salesfakturid'];
		if($salesfakturid == null){
			echo json_encode(['code'=>0, 'msg'=>'Silahkan Isi No Invoice Penjualan Terlebih Dahulu']);
			die();
		}
		$result = $this->retur_model->get_detailretur($id, $salesfakturid);
		if($result == null){
			echo json_encode(['code'=>0, 'msg'=>'Produk Tidak Ada Di Penjualan']);
			die();
		}
		$sales_detail_satuan = $result[0]->sales_detail_satuan;
		$sales_detail_warehouse = $result[0]->sales_detail_warehouse;
		$sales_detail_price = $result[0]->sales_detail_price;
		echo json_encode(['code'=>200, 'sales_detail_satuan'=>$sales_detail_satuan, 'sales_detail_warehouse'=>$sales_detail_warehouse, 'sales_detail_price'=> $sales_detail_price]);
	}

	public function getreturpayment(){
		$this->check_auth(); 
		$invoice = $salesfakturid = $this->input->post('invoice');;
		$result = $this->retur_model->getreturpayment($invoice);
		$retur_sales_total = $result[0]->retur_sales_total;
		echo json_encode(['code'=>200, 'retur_sales_total'=>$retur_sales_total]);
	}

	public function processaddheaderretursales(){
		$userid = $_SESSION['user_id'];
		$retursalesfakturid = $this->input->post('retursalesfakturid');
		$salesfakturid = $this->input->post('salesfakturid');
		$customersales = $this->input->post('customersales');
		$companypurchase = $this->input->post('companypurchase');
		$salesdate = $this->input->post('returdate');
		$billingtype = $this->input->post('billingtype');
		$billingtypepayment = $this->input->post('billingtypepayment');
		$totalretur = $this->input->post('totalretur');

		if($billingtype == null){
			$msg = 'Silahkan Isi Jenis Penagihan';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}

		if($billingtype == 2 ){
			if($billingtypepayment == null){
				$msg = 'Silahkan Isi Jenis Pembayaran';
				echo json_encode(['code'=>0, 'msg'=>$msg]);die();
			}
		}

		$check_billingtype = $this->retur_model->check_billingtype($salesfakturid);
		if($billingtype == 1 ){
			if($check_billingtype[0]->sales_status == 'lunas'){
				$msg = 'Tagihan Sudah Lunas Silahkan Pilih Jenis Tagihan Lain';
				echo json_encode(['code'=>0, 'msg'=>$msg]);die();
			}
		}


		$get_retur_sales_cart = $this->retur_model->get_retur_sales_cart($userid);

		$data_insert_header = array(
                'retur_sales_faktur_id' => $retursalesfakturid,
                'retur_sales_faktur_ref' => $salesfakturid,
                'retur_sales_customer' => $customersales,
                'retur_sales_company' => $companypurchase,
                'retur_sales_date' => $salesdate,
                'retur_sales_billtype' => $billingtype,
                'retur_sales_billtype_payment' => $billingtypepayment,
                'retur_sales_total' => $totalretur
            );
        $insertheaderpurchase = $this->retur_model->insertheaderpurchase($data_insert_header);


		foreach ($get_retur_sales_cart as $row){
			$data_insert = array(
				'retur_sales_inv' => $row->retur_sales_cart_inv,
				'retur_sales_transaction' => $row->retur_sales_cart_transaction,
				'retur_sales_item' => $row->retur_sales_cart_item,
				'retur_sales_qty' => $row->retur_sales_cart_qty,
				'retur_sales_total' => $row->retur_sales_cart_total,
				'retur_sales_warehouse' => $row->retur_sales_cart_warehouse,
				'retur_sales_desc' => $row->retur_sales_cart_desc,
			);

			$insertdetailretursales = $this->retur_model->insertdetailretursales($data_insert);
			$item_id = $row->retur_sales_cart_item;
			$gudang = $row->retur_sales_cart_warehouse;
			$get_last_stock = $this->masterdata_model->get_last_stock($item_id, $gudang);
			$update_stock = array(
				'master_gudang_stock' =>  $get_last_stock[0]->master_gudang_stock + $row->retur_sales_cart_qty,
			);
			$master_gudang_barang_id  = $get_last_stock[0]->master_gudang_barang_id;
			$updatestock = $this->transaction_model->updatestock($update_stock, $master_gudang_barang_id);
		}

		$emptycartretursales = $this->retur_model->emptycartretursales($retursalesfakturid);
        $msg = 'Sukses';
        echo json_encode(['code'=>200, 'msg'=>$msg]);die();



	}

	public function processaddsalesreturcart(){
		$userid = $_SESSION['user_id'];
		$salesfakturid = $this->input->post('salesfakturid');
		$retursalesfakturid = $this->input->post('retursalesfakturid');
		$retursalesitem = $this->input->post('retursalesitem');
		$retursalesqty = $this->input->post('retursalesqty');
		$cartdetailsalesprice = $this->input->post('cartdetailsalesprice');
		$warehouse = $this->input->post('warehouse');
		$returdesc = $this->input->post('returdesc');
		$qtycartdetailsales = $this->input->post('qtycartdetailsales');

		if($retursalesqty == ''){
			$msg = 'Jumlah Qty Retur Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}
		if($qtycartdetailsales < $retursalesqty){
			$msg = 'Jumlah Qty Retur Tidak Bisa Lebih Besar Dari Pembelian';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}   

		$check_retur_cart = $this->retur_model->check_retur_cart($retursalesitem, $retursalesfakturid);

		if($check_retur_cart != null){
			$msg = 'Data Retur Item Sudah Di Input';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}

		$data_insert = array(
			'retur_sales_cart_inv' => $retursalesfakturid,
			'retur_sales_cart_transaction' => $salesfakturid,
			'retur_sales_cart_item' => $retursalesitem,
			'retur_sales_cart_qty' => $retursalesqty,
			'retur_sales_cart_total' => $retursalesqty * $cartdetailsalesprice,
			'retur_sales_cart_warehouse' => $warehouse,
			'retur_sales_cart_desc' => $returdesc,
			'retur_sales_cart_admin' => $userid,
		);
		$insertretursalescart = $this->retur_model->insertretursalescart($data_insert);
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function get_last_post_cart_sales(){
		$userid = $_SESSION['user_id'];
		$result = $this->retur_model->get_last_post_cart_sales($userid);
		$retur_sales_cart_transaction = $result[0]->retur_sales_cart_transaction;
		$id = $retur_sales_cart_transaction;
		$results = $this->retur_model->get_sales_header_data($id);
		$sales_customer_id = $results[0]->sales_customer_id;
		$sales_company_id = $results[0]->sales_company_id;
		if($result != null){
			echo json_encode(['code'=>200, 'retur_sales_cart_inv'=>$retur_sales_cart_transaction, 'sales_customer_id'=>$sales_customer_id, 'sales_company_id'=>$sales_company_id]);
		}else{
			echo json_encode(['code'=>0, 'retur_sales_cart_inv'=>$retur_sales_cart_transaction, 'sales_customer_id'=>$sales_customer_id, 'sales_company_id'=>$sales_company_id]);
		}
		
	}

	public function get_total_cart_sales(){
		$userid = $_SESSION['user_id'];
		$retursalesfakturid = $this->input->post('retursalesfakturid');
		$result = $this->retur_model->get_total_cart_sales($userid, $retursalesfakturid);
		$total_retur = $result[0]->total_retur;
		echo json_encode(['code'=>200, 'total_retur'=>$total_retur]);
	}

	public function printinvoiceretursales(){
		$id = $this->input->get('id');
		$get_header_retur_by_nofak['get_header_retur_by_nofak'] = $this->retur_model->get_header_retur_by_nofak($id);
		$get_detail_retur_by_nofak['get_detail_retur_by_nofak'] = $this->retur_model->get_detail_retur_by_nofak($id);
		$data['datas'] = array_merge_recursive($get_header_retur_by_nofak, $get_detail_retur_by_nofak);
		$this->load->view('admin/printinvoiceretursales', $data);
	}

	public function deletecartretur(){
		$this->check_auth();
		$id = $this->input->get('id');
		$deletereturcart = $this->retur_model->deletereturcart($id);
		redirect('Retur/addretursales', 'refresh');
	}
}

?>