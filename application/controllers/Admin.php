<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller {

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

	public function processlogin(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$branch = $this->input->post('branch');
		
		$get_admin_by_username = $this->admin_model->get_admin_by_username($username, $password);
			if($get_admin_by_username != null){
					$user_name = $get_admin_by_username[0]->admin_username;
					$user_id  = $get_admin_by_username[0]->admin_id ;
					$user_role  = $get_admin_by_username[0]->admin_role ;

					$newdata = [
        			'user_name'  => $user_name,
        			'user_id' => $user_id,
        			'user_role' => $user_role,
        		    'logged_in' => TRUE,
					];
					$this->session->set_userdata($newdata);
					$msg = 'Sukses login';
					echo json_encode(['code'=>'200', 'msg'=>$msg]); 
			}else{
					$msg = 'Username Atau Password Salah';
					echo json_encode(['code'=>0, 'msg'=>$msg]);
			}	
	}
	
	public function purchase(){
		$this->check_auth();
		$this->load->view('admin/purchaseadmin');
	}


	public function dashboardadmin(){
		$this->check_auth();
		$get_transaction_today['get_transaction_today'] = $this->masterdata_model->get_transaction_today();
		$get_hutang_today['get_hutang_today'] = $this->masterdata_model->get_hutang_today();
		$get_piutang_today['get_piutang_today'] = $this->masterdata_model->get_piutang_today();

		$get_product_total['get_product_total'] = $this->masterdata_model->get_product_total();
		$get_list_piutang_today['get_list_piutang_today'] = $this->masterdata_model->get_list_piutang_today();
		$curent_date = Date("Y-m-d");
		$before_date = Date('Y-m-d', strtotime('-7 days'));
		$get_not_send_product['get_not_send_product'] = $this->masterdata_model->get_not_send_product($curent_date, $before_date);
		$data['data'] = array_merge_recursive($get_transaction_today, $get_hutang_today, $get_piutang_today, $get_product_total, $get_list_piutang_today, $get_not_send_product);
		$this->load->view('admin/admindashboardview', $data);
	}



}

?>