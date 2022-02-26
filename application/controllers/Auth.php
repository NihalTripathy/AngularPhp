<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//header('X-Frame-Options: SAMEORIGIN');
header('Access-Control-Allow-Origin: *');
header("Cache-Control: no-cache, must-revalidate");
header("Access-Control-Allow-Headers: X-API-KEY,x-auth,Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
class Auth extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->helper('custom_security');	
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
		date_default_timezone_set('Asia/Kolkata');
		
	}
	
	public function get_emp_data()
	{
		echo json_encode($this->Auth_model->utility($_POST,'get_emp_data')); 
	}
	
	public function logout()
	{
		$this->session->unset_userdata('sess_id', session_id());
		$this->session->unset_userdata('reg_user_id', $phone_no);
		$this->session->unset_userdata('first_name', $first_name);
		
		redirect('Auth/index');
	}
	public function registration()
	{
		$data = file_get_contents("php://input");
		$_POST = json_decode($data, true);
		// echo "<pre>";print_r($_POST);die;
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"="
			);
			if (hasXSS($_POST,$temp_rule)){
				$data = array(
	                'status' => 'xsserror',
	                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
	            );
				echo json_encode($data);
				exit;
			}
			else
			{
				
				$config = array(
	               array(
	                     'field'   => 'username',
	                     'label'   => 'User Name',
	                     'rules'   => 'trim|required'
	                  ),
	                array(
	                     'field'   => 'password',
	                     'label'   => 'Password',
	                     'rules'   => 'trim|required'
	                )
	                   
		        );
				
			}
			
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
				echo json_encode($data);
				exit;
			}
			else
			{
				echo json_encode($this->Auth_model->utility($_POST,'insert_registration_data'));
				
			}
	}
	public function registration_login()
	{
		$data = file_get_contents("php://input");
		$_POST = json_decode($data, true);
		$config = array(
			array(
                 'field'   => 'username',
                 'label'   => 'username',
                 'rules'   => 'trim|required'
              ),
              array(
                 'field'   => 'password',
                 'label'   => 'password',
                 'rules'   => 'trim|required'
              )
			
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
			echo json_encode($data);
			exit;
		}
		else
		{
			echo json_encode($this->Auth_model->utility($_POST,'verify_registration_data'));
			
		}
	}
	public function getProducts()
	{
		echo json_encode($this->Auth_model->getProducts());
	}
	public function add_product(){
		$data = file_get_contents("php://input");
		$_POST = json_decode($data, true);
		// echo "<pre>";print_r($_POST);die;
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
			echo json_encode($data);
			exit;
		}
		else
		{
			
			$config = array(
               array(
                     'field'   => 'ptitle',
                     'label'   => 'Title',
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'pdesc',
                     'label'   => 'Description',
                     'rules'   => 'trim|required'
                )
	        );				
		}
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
			echo json_encode($data);
			exit;
		}
		else
		{
			echo json_encode($this->Auth_model->utility($_POST,'insert_product_data'));
		}
	}
	public function update_product(){
		$data = file_get_contents("php://input");
		$_POST = json_decode($data, true);
		// echo "<pre>";print_r($_POST);die;
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
			echo json_encode($data);
			exit;
		}
		else
		{
			
			$config = array(
               array(
                     'field'   => 'ptitle',
                     'label'   => 'Title',
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'pdesc',
                     'label'   => 'Description',
                     'rules'   => 'trim|required'
                )
	        );				
		}
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
			echo json_encode($data);
			exit;
		}
		else
		{
			echo json_encode($this->Auth_model->utility($_POST,'update_product_data'));
		}
	}
	public function delete_product()
	{
		$data = file_get_contents("php://input");
		$_POST = json_decode($data, true);
		echo json_encode($this->Auth_model->utility($_POST,'delete_product'));
	}
}