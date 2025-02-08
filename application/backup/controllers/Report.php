<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Report extends CI_Controller {

	public function __construct(){
	 	parent::__construct();
	 	$this->load->helper('url');
        $this->load->library('session');
        $this->load->model('admin_model');
         $this->load->model('masterdata_model');
         $this->load->model('report_model');
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


	public function reportstock(){
		$this->check_auth();
		$warehouse = $this->input->get('warehouse');
		$get_reportstock['get_reportstock'] = $this->report_model->get_reportstock($warehouse);
		$get_stocknotinputed['get_stocknotinputed'] = $this->report_model->get_stocknotinputed();
		$data['datas'] = array_merge_recursive($get_reportstock, $get_stocknotinputed);
		$this->load->view('admin/stockreportview', $data);
	}


	public function paymentreport(){
        $this->check_auth();
        $invoiceno = $this->input->get('invoiceno');
        $get_paymentreport['get_paymentreport'] = $this->report_model->get_paymentreport_sales($invoiceno);
        if(isset($get_paymentreport['get_paymentreport'][0]->payment_hutang_sales_id) == null){
        $get_paymentreport['get_paymentreport'] = $this->report_model->get_paymentreport_purchase($invoiceno);	
        }
        $this->load->view('admin/paymentreportview', $get_paymentreport);
    }

	public function reportstockexcell(){
		$this->check_auth();
		$warehouse = $this->input->get('warehouse');
		$get_reportstock['get_reportstock'] = $this->report_model->get_reportstock($warehouse);
		$get_stocknotinputed['get_stocknotinputed'] = $this->report_model->get_stocknotinputed();
		$data['datas'] = array_merge_recursive($get_reportstock, $get_stocknotinputed);
		$this->load->view('admin/stockreportexcellview', $data);
	}

	public function reportsales(){
		$this->check_auth();
		if(!$_GET){
		$get_report_sales['get_report_sales'] = $this->report_model->get_report_sales();
		$get_report_sales_header['get_report_sales_header'] = $this->report_model->get_report_sales_header();
		$get_report_sales_detail['get_report_sales_detail'] = $this->report_model->get_report_sales_detail();
		
		$data['datas'] = array_merge_recursive($get_report_sales, $get_report_sales_header, $get_report_sales_detail);
		//print("<pre>".print_r($data,true)."</pre>");
		$this->load->view('admin/reportsalesview', $data);
		}else{
		$datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $customersales = $this->input->get('customersales');
        $customersales = substr($customersales, strpos($customersales, "/") + 2);
		$get_reporthutang['get_reporthutang'] = $this->report_model->get_reporthutang_byduedate($datefrom, $dateend, $customersales);
		$this->load->view('admin/reporthutangview', $get_reporthutang);
		}

	}

	public function reporthutang(){
		$this->check_auth();
		if(!$_GET){
		$get_reporthutang['get_reporthutang'] = $this->report_model->get_reporthutang();
		$this->load->view('admin/reporthutangview', $get_reporthutang);
		}else{
		$datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $customersales = $this->input->get('customersales');
        $customersales = substr($customersales, strpos($customersales, "/") + 2);
		$get_reporthutang['get_reporthutang'] = $this->report_model->get_reporthutang_byduedate($datefrom, $dateend, $customersales);
		$this->load->view('admin/reporthutangview', $get_reporthutang);
		}

	}

	public function reporthutangexcell(){
		$this->check_auth();
		if(!$_GET){
		$get_reporthutang['get_reporthutang'] = $this->report_model->get_reporthutang();
		$this->load->view('admin/reporthutangexcellview', $get_reporthutang);
		}else{
		$datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $customersales = $this->input->get('customersales');
        $customersales = substr($customersales, strpos($customersales, "/") + 2);
		$get_reporthutang['get_reporthutang'] = $this->report_model->get_reporthutang_byduedate($datefrom, $dateend, $customersales);
		$this->load->view('admin/reporthutangexcellview', $get_reporthutang);
		}
	}

	public function reportpiutang(){
		$this->check_auth();
		if(!$_GET){
		$get_reportpiutang['get_reportpiutang'] = $this->report_model->get_reportpiutang();
		$this->load->view('admin/reportpiutangview', $get_reportpiutang);
		}else{
		$datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $suplierpurchase = $this->input->get('suplierpurchase');
        $suplierpurchase = substr($suplierpurchase, strpos($suplierpurchase, "/") + 2);
		$get_reportpiutang['get_reportpiutang'] = $this->report_model->get_reportpiutang_byduedate($datefrom, $dateend, $suplierpurchase);
		$this->load->view('admin/reportpiutangview', $get_reportpiutang);
		}

	}

	public function reportpiutangexcell(){
		$this->check_auth();
		if(!$_GET){
		$get_reportpiutang['get_reportpiutang'] = $this->report_model->get_reportpiutang();
		$this->load->view('admin/reportpiutangview', $get_reportpiutang);
		}else{
		$datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $suplierpurchase = $this->input->get('suplierpurchase');
        $suplierpurchase = substr($suplierpurchase, strpos($suplierpurchase, "/") + 2);
		$get_reportpiutang['get_reportpiutang'] = $this->report_model->get_reportpiutang_byduedate($datefrom, $dateend, $suplierpurchase);
		$this->load->view('admin/reportpiutangexcellview', $get_reportpiutang);
		}
	}

	public function reportomzet(){
		$this->check_auth();
		if(!$_GET){
		$get_reportpiutang['get_reportpiutang'] = $this->report_model->get_reportpiutang();
		$this->load->view('admin/reportpiutangview', $get_reportpiutang);
		}else{
		$datefrom = $this->input->get('datefrom');
        $dateend = $this->input->get('dateend');
        $suplierpurchase = $this->input->get('suplierpurchase');
        $suplierpurchase = substr($suplierpurchase, strpos($suplierpurchase, "/") + 2);
		$get_reportpiutang['get_reportpiutang'] = $this->report_model->get_reportpiutang_byduedate($datefrom, $dateend, $suplierpurchase);
		$this->load->view('admin/reportpiutangexcellview', $get_reportpiutang);
		}
	}

}

?>