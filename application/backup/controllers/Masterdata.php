<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Masterdata extends CI_Controller {

	public function __construct(){
	 	parent::__construct();
	 	$this->load->helper('url');
        $this->load->library('session');
        $this->load->model('admin_model');
         $this->load->model('masterdata_model');
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

	public function masterbarang(){
		$this->check_auth();
		$get_masterbarang['get_masterbarang'] = $this->masterdata_model->get_masterbarang();
		$get_mastercategory['get_mastercategory'] = $this->masterdata_model->get_mastercategory();
		$get_masterunit['get_masterunit'] = $this->masterdata_model->get_masterunit();
		$data['datas'] = array_merge_recursive($get_masterbarang, $get_mastercategory, $get_masterunit);
		$this->load->view('admin/masterbarangview', $data);
	}

	public function mastercompany(){
		$this->check_auth();
		$get_mastercompany['get_mastercompany'] = $this->masterdata_model->get_mastercompany();
		$this->load->view('admin/mastercompany', $get_mastercompany);
	}

	public function masterbarangdetail(){
		$this->check_auth();
		$id = $this->input->get('id');
		$get_masterbarang_detail['get_masterbarang_detail'] = $this->masterdata_model->get_masterbarang_detail($id);
		$this->load->view('admin/masterbarangdetailview', $get_masterbarang_detail);
	}

	public function masterbankaccount(){
		$this->check_auth();
		$id = $this->input->get('id');
		$get_mastercompany_bank['get_mastercompany_bank'] = $this->masterdata_model->get_mastercompany_bank($id);
		$this->load->view('admin/mastercompanybankaccount', $get_mastercompany_bank);
	}

	public function checkpassmodal(){
		$this->check_auth(); 
		$passwordmodal = md5($this->input->post('passwordmodal'));
		$get_passwordmodal = $this->masterdata_model->get_passwordmodal($passwordmodal);
		if($get_passwordmodal != null){
					$msg = 'Password Benar';
					echo json_encode(['code'=>'200', 'msg'=>$msg]); 
		}else{
					$msg = 'Password Salah';
					echo json_encode(['code'=>0, 'msg'=>$msg]);
		}	
	}
	
	public function mastersuplier(){
		$this->check_auth();
		$get_mastersuplier['get_mastersuplier'] = $this->masterdata_model->get_mastersuplier();
		$this->load->view('admin/mastersuplierview', $get_mastersuplier);
	}

	public function mastercustomer(){
		$this->check_auth();
		$get_mastersuplier['get_mastercustomer'] = $this->masterdata_model->get_mastercustomer();
		$this->load->view('admin/mastercustomerview', $get_mastersuplier);
	}

	public function mastersales(){
		$this->check_auth();
		$get_mastersales['get_mastersales'] = $this->masterdata_model->get_mastersales();
		$this->load->view('admin/mastersalesview', $get_mastersales);
	}

	public function processactionbarang(){
		 $id = $this->input->post('id');
		 $codeitem = $this->input->post('codeitem');
		 $nameitem = $this->input->post('nameitem');
		 $categoryitem = $this->input->post('categoryitem'); 
		 $unititem = $this->input->post('unititem');
		 $modalitem = $this->input->post('modalitem'); 
		 $jualitem = $this->input->post('jualitem');
		 $actiontype = $this->input->post('actiontype');
		 if($_SESSION['user_role'] == 0){
		 $modalitem = 0; 
		 }
		

		 $data_insert = array(
			'master_barang_code' => $codeitem,
			'master_barang_name' => $nameitem,
			'master_barang_category_id' => $categoryitem,
			'master_barang_unit_id' => $unititem,
			'master_barang_harga_modal' => $modalitem,
			'master_barang_harga_jual' => $jualitem
            );

		if($actiontype == 'add'){

		$get_codeitem = $this->masterdata_model->get_codeitem($codeitem);
		if($get_codeitem != null){
		 	$msg = 'Kode Item Sudah Terdaftar';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}
		$insertmasterbarang = $this->masterdata_model->insertmasterbarang($data_insert);
		}else{
		$editmasterbarang = $this->masterdata_model->editmasterbarang($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}


	public function processaddbankaccount(){
		 $id = $this->input->post('id');
		 $bankname = $this->input->post('bankname');
		 $rekname = $this->input->post('rekname');
		 $companyid = $this->input->post('companyid');
		 $actiontype = $this->input->post('actiontype');

		

		 $data_insert = array(
		 	'mastercompany_id' => $companyid,
			'mastercompany_bank_name' => $bankname,
			'mastercompany_bank_rek' => $rekname,
            );

		if($actiontype == 'add'){
		$insertbankaccount = $this->masterdata_model->insertbankaccount($data_insert);
		}else{
		$editbankaccount = $this->masterdata_model->editbankaccount($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function processaddsales(){
		 $id = $this->input->post('id');
		 $salesname = $this->input->post('salesname');
		 $salesphone = $this->input->post('salesphone');
		 $salesaddress = $this->input->post('salesaddress');
		 $actiontype = $this->input->post('actiontype');

		 if($salesname == ''){
		 	$msg = 'Nama Sales Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 /*if($salesphone == ''){
		 	$msg = '
		 	No Telepon Sales Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 if($salesaddress == ''){
		 	$msg = 'Alamat Sales Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }*/

		 $data_insert = array(
			'sales_name' => $salesname,
			'sales_phone' => $salesphone,
			'sales_address' => $salesaddress
            );

		if($actiontype == 'add'){
		$insertmastersales = $this->masterdata_model->insertmastersales($data_insert);
		}else{
		$editmastersales = $this->masterdata_model->editmastersales($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function processaddsuplier(){
		 $id = $this->input->post('id');
		 $supliername = $this->input->post('supliername');
		 $notelp = $this->input->post('notelp');
		 $nonpwp = $this->input->post('nonpwp');
		 $address = $this->input->post('address'); 
		 $actiontype = $this->input->post('actiontype');

		 if($supliername == ''){
		 	$msg = 'Nama Suplier Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 /*if($notelp == ''){
		 	$msg = '
		 	No Telepon Suplier Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 if($address == ''){
		 	$msg = 'Alamat Suplier Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }*/

		 $data_insert = array(
			'suplier_name' => $supliername,
			'suplier_address' => $address,
			'suplier_phone' => $notelp,
			'suplier_npwp' => $nonpwp
            );

		if($actiontype == 'add'){
		$insertmastersuplier = $this->masterdata_model->insertmastersuplier($data_insert);
		}else{
		$editmastersuplier = $this->masterdata_model->editmastersuplier($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function processactioncompany(){
		 $id = $this->input->post('id');
		 $namecompany = $this->input->post('namecompany');
		 $phonecompany = $this->input->post('phonecompany');
		 $emailcompany = $this->input->post('emailcompany');
		 $actiontype = $this->input->post('actiontype');

		 $data_insert = array(
			'mastercompany_name' => $namecompany,
			'mastercompany_phone' => $phonecompany,
			'mastercompany_email' => $emailcompany
            );

		if($actiontype == 'add'){
		$insertmastercompany = $this->masterdata_model->insertmastercompany($data_insert);
		}else{
		$editmastercompany = $this->masterdata_model->editmastercompany($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function processaddcustomer(){
		 $id = $this->input->post('id');
		 $customername = $this->input->post('customername');
		 $notelp = $this->input->post('notelp');
		 $nonpwp = $this->input->post('nonpwp');
		 $address = $this->input->post('address'); 
		 $actiontype = $this->input->post('actiontype');

		 if($customername == ''){
		 	$msg = 'Nama Customer Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 /*if($notelp == ''){
		 	$msg = 'No Telepon Customer Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 if($address == ''){
		 	$msg = 'Alamat Customer Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }*/

		 $data_insert = array(
			'customer_name' => $customername,
			'customer_address' => $address,
			'customer_phone' => $notelp,
			'customer_npwp' => $nonpwp
            );

		if($actiontype == 'add'){
		$insertmastercustomer = $this->masterdata_model->insertmastercustomer($data_insert);
		}else{
		$editmastercustomer = $this->masterdata_model->editmastercustomer($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	

	public function deletemasterbarang(){
		$id = $this->input->get('id');
		$deletemasterbarang = $this->masterdata_model->deletemasterbarang($id);
		redirect('Masterdata/masterbarang', 'refresh');
	}


	public function deletmastersales(){
		$id = $this->input->get('id');
		$deletemastersales = $this->masterdata_model->deletemastersales($id);
		redirect('Masterdata/mastersales', 'refresh');
	}

	public function deletemastersuplier(){
		$id = $this->input->get('id');
		$deletemasterbarang = $this->masterdata_model->deletemastersuplier($id);
		redirect('Masterdata/mastersuplier', 'refresh');
	}
	
	public function deletemastercustomer(){
		$id = $this->input->get('id');
		$deletemastercustomer = $this->masterdata_model->deletemastercustomer($id);
		redirect('Masterdata/mastercustomer', 'refresh');
	}

	  public function get_autocomplete_item(){
   			$this->check_auth(); 
            if (isset($_GET['term'])) {
            $term =  $this->input->get('term');
           	$result = $this->masterdata_model->get_autocomplete_item($term);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->master_barang_name.' / '.$row->master_barang_id ;
                echo json_encode($arr_result);
            	}
        	}
    }

    public function get_autocomplete_sales(){
   			$this->check_auth(); 
            if (isset($_GET['term'])) {
            $term =  $this->input->get('term');
           	$result = $this->masterdata_model->get_autocomplete_sales($term);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->sales_name ;
                echo json_encode($arr_result);
            	}
        	}
    }

}

?>