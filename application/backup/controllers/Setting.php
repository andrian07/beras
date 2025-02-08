<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Setting extends CI_Controller {

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

    public function settingunit(){
    	$this->check_auth();
		$get_masterunit['get_masterunit'] = $this->masterdata_model->get_masterunit();
		$this->load->view('admin/settingunitview', $get_masterunit);
    }

    public function settingcategory(){
    	$this->check_auth();
		$get_mastercategory['get_mastercategory'] = $this->masterdata_model->get_mastercategory();
		$this->load->view('admin/settingcategoryview', $get_mastercategory);
    }

     public function changepassword(){
    	$this->check_auth();
		$this->load->view('admin/changepasswordview');
    }

    public function processaddunit(){
		$id = $this->input->post('id');
		$unitname = $this->input->post('unitname');
		$actiontype = $this->input->post('actiontype');

		 if($unitname == ''){
		 	$msg = 'Nama Unit Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 $data_insert = array(
			'unit_name' => $unitname
            );

		if($actiontype == 'add'){
		$insertunit = $this->masterdata_model->insertunit($data_insert);
		}else{
		$editunit = $this->masterdata_model->editunit($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	 public function processaddcategory(){
		$id = $this->input->post('id');
		$categoryname = $this->input->post('categoryname');
		$actiontype = $this->input->post('actiontype');

		 if($categoryname == ''){
		 	$msg = 'Nama Kategori Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }
		 $data_insert = array(
			'category_name' => $categoryname
            );

		if($actiontype == 'add'){
		$insertcategory = $this->masterdata_model->insertcategory($data_insert);
		}else{
		$editcategory = $this->masterdata_model->editcategory($data_insert, $id);	
		}
		$msg = 'Sukses';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function processchangepass(){
		$user_idlogin = $_SESSION['user_id'];
		$oldpass = md5($this->input->post('oldpass'));
		$newpass = md5($this->input->post('newpass'));
		$confnewdpass = md5($this->input->post('confnewdpass'));


		if($oldpass == ''){
		 	$msg = 'Password Lama Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		 }

		if($newpass == ''){
		 	$msg = 'Password Baru Harus Di Isi';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}

		if($newpass != $confnewdpass){
		 	$msg = 'Ulangi Password Tidak Sama';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}


		$get_oldpass = $this->masterdata_model->get_oldpass($user_idlogin);

		if($oldpass != $get_oldpass[0]->admin_password){
			$msg = 'Password Lama Anda Salah';
			echo json_encode(['code'=>0, 'msg'=>$msg]);die();
		}

		$data_insert = array(
			'admin_password' => $newpass
        );
		$updatepass = $this->masterdata_model->updatepass($data_insert, $user_idlogin);
		$msg = 'Berhasil Update Password';
		echo json_encode(['code'=>200, 'msg'=>$msg]);die();
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Admin/index', 'refresh');
	}

	public function deleteunit(){
		$id = $this->input->get('id');
		$deleteunit = $this->masterdata_model->deleteunit($id);
		redirect('Setting/settingunit', 'refresh');
	}

	public function deletecategory(){
		$id = $this->input->get('id');
		$deletecategory = $this->masterdata_model->deletecategory($id);
		redirect('Setting/settingcategory', 'refresh');
	}
}

?>