<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Project extends CI_Controller {

	public function __construct(){
	 	parent::__construct();
	 	$this->load->helper('url');
        $this->load->library('session');
        $this->load->model('transaction_model');
        $this->load->helper(array('url', 'html', 'new'));
     }

     
    public function index(){
    	$get_projectheader['get_projectheader'] = $this->transaction_model->get_projectheader();
    	$this->load->view('admin/projectview', $get_projectheader);
	}


	public function Projectadd(){
		$get_lastproject['get_lastproject'] = $this->transaction_model->get_lastproject();
    	$this->load->view('admin/projectadd', $get_lastproject);
	}


    public function processaddprojectheader(){
    	$projectnumber = $this->input->post('projectnumber');
    	$datasurat = $this->input->post('datasurat');
    
    	 $data_insert_header = array(
                'project_header_number' => $projectnumber,
                'project_text' => $datasurat,
            );
        $insertheaderproject = $this->transaction_model->insertheaderproject($data_insert_header);
        redirect('Project', 'refresh');
    }


	public function print(){
		$id = $this->input->get('id');
		$dataprintprojectheader['dataprintprojectheader'] = $this->transaction_model->dataprintprojectheader($id);
		$this->load->view('admin/projectexcell', $dataprintprojectheader);
	}

}

?>