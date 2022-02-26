<?php

class Auth_model extends CI_model {

    function __construct() { 
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s', time());
    }
    public function rand_number($length) {
        $chars = "0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }
    public function utility($data, $op, $stage = null) {
    	date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s', time());
	   	switch ($op){
	   		case 'insert_registration_data':
	   			$txtUsername = isset($data['username']) ? $data['username']:'';
				$txtPassword = isset($data['password']) ? $data['password']:'';
				$present = 0;
				
				$this->db->select('*');
				$this->db->from('reg_master');
				$this->db->where('username',$txtUsername);
				$this->db->where("password",$txtPassword);
				$this->db->limit(1);
				$result = $this->db->get();
				
				$present = $result->num_rows();
				if($present == 0) 
				{
					$new_data = array(
	                    'reg_user_id' => time(),
	                    'username' => $txtUsername,
	                    'password' => $txtPassword,
	                    'created_by' => $txtUsername,
	                    'created_on' => date('Y-m-d H:i:s')
	               	);
	               	$insert = $this->db->insert('reg_master', $new_data);
					if (!$insert)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Registred';
					}
					else
					{
						$dbstatus = TRUE;
						$dbmessage = 'Success';
					}
				}
				else
				{
					$dbstatus = TRUE;
					$dbmessage = 'Duplicate Entry';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
	   		break;
	   		case 'verify_registration_data':
	   			$dbstatus = TRUE;
				$dbmessage = "Logged In successfully";
				$key = $this->session->userdata('key');
				$this->session->unset_userdata('key');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				
				$username =isset($_POST['username'])?$_POST['username']:'';
				$password =isset($_POST['password'])?$_POST['password']:'';
				
				$this->db->select('*');
				$this->db->from('reg_master');
				$this->db->where('username',$username);
				$this->db->where("password",$password);
				$this->db->limit(1);
				$result = $this->db->get();
				//echo $this->db->last_query();die;
				
				$present = $result->num_rows();
				if($present==1) 
				{
					
					return array('status'=>$dbstatus);
				}
				else
				{
					$dbstatus = FALSE;
					return array('status'=>$dbstatus,'msg'=>"Incorrect data");
				}
	   		break;
	   		case 'get_emp_data':
	   			$reg_user_id =isset($_POST['reg_user_id'])?$_POST['reg_user_id']:'';
	   			$this->db->select('*');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die;
				return $result->result_array();
	   		break;
	   		case 'add_image':
		   		$date = date('Y-m-d', now());
	        	$dbstatus='';
	        	$dbmessage='';
				if(empty($_FILES['photo']['name']))
	        	{
					$dbstatus = FALSE;
					$dbmessage = 'No File Selected.';
				}
				else
				{
					$allowed_mime_type_arr = array('image/jpg','image/jpeg','image/png');
					$mime = get_mime_by_extension($_FILES['photo']['name']);
					$dot_count 	= substr_count($_FILES['photo']['name'],'.');
					$zero_count = substr_count($_FILES['photo']['name'],"%0"); 
					if(in_array($mime, $allowed_mime_type_arr))
					{
						if(($zero_count == 0 && $dot_count == 1))
						{
								$time = date('h_i_sa');
								$file_ext = substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'], '.') + 1);
								$filename=$time.md5(microtime()).'.'.$file_ext;
								$file_move_path  = 'public/upload';
								if(!is_dir($file_move_path))
								mkdir($file_move_path,0777,true);
								$config['upload_path'] 		= $file_move_path;
							    $config['file_name'] 		= $filename;
							    $config['allowed_types'] 	= 'jpg|jpeg|png'; 
								$config['max_size']     	= 10485760; //sizein KB form 
								$config['overwrite'] 		= TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if($this->upload->do_upload('photo'))
								{
										$data = array('upload_data' => $this->upload->data());
										$store_path  = 'public/upload/'.$filename ;
										$new_data = array( 
										"image_path"=>$store_path,
										"created_by"=>$this->session->userdata('reg_user_id'),
										"created_on"=>$date,
										);
										$image_tbl = $this->db->insert('image_tbl',$new_data);
										
										if(!$image_tbl){ 
										$dbstatus = FALSE;
										$dbmessage = 'Error While Inserting';
										}
										else
										{
										$dbstatus = TRUE;
										$dbmessage = 'Saved Successfully';
										}
								}
								else
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error While Uploading';
								}
						}
						else
						{
							$dbstatus = FALSE;
							$dbmessage = 'Invalid file  format. Please upload a jpg, jpeg or png file.';
						}
						
				    }
				    else
					{
						$dbstatus = FALSE;
						$dbmessage = 'Invalid file . Please upload a jpg, jpeg or png file.';
					}
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
        	break;
        	case 'insert_product_data':
        		$txtUsername = isset($data['username']) ? $data['username']:'';
        		$txtPtitle = isset($data['ptitle']) ? $data['ptitle']:'';
				$txtPdesc = isset($data['pdesc']) ? $data['pdesc']:'';
				
				$new_data = array(
                    'title' => $txtPtitle,
                    'description' => $txtPdesc,
                    'created_by' => $txtUsername,
                    'created_on' => date('Y-m-d H:i:s')
               	);
               	$insert = $this->db->insert('products', $new_data);
				if (!$insert)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error occur in adding';
				}
				else
				{
					$dbstatus = TRUE;
					$dbmessage = 'Success';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
        	break;
        	case 'update_product_data':
        		$txtId = isset($data['pid']) ? $data['pid']:'';
        		$txtUsername = isset($data['username']) ? $data['username']:'';
        		$txtPtitle = isset($data['ptitle']) ? $data['ptitle']:'';
				$txtPdesc = isset($data['pdesc']) ? $data['pdesc']:'';
				
				$new_data = array(
                    'title' => $txtPtitle,
                    'description' => $txtPdesc,
                    'created_by' => $txtUsername,
                    'created_on' => date('Y-m-d H:i:s')
               	);
               	$this->db->where('id', $txtId);
               	$insert = $this->db->update('products', $new_data);
				if (!$insert)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error occur in adding';
				}
				else
				{
					$dbstatus = TRUE;
					$dbmessage = 'Success';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
        	break;
        	case 'delete_product':
        		$id = isset($data) ? $data:'';
        		if($id != '')
        		{
					for($i=0;$i<count($id);$i++)
					{
						$this->db->where('id', $id[$i]);
		               	$delete = $this->db->delete('products');
		               	//echo $this->db->last_query();die;
		               	if (!$delete)
						{
							return array('status' => FALSE, 'msg' => 'FAILED');
						}
						
					}
					return array('status' => TRUE, 'msg' => 'SUCCESS');
				}
        		else
        		{
					return array('status' => FALSE, 'msg' => 'NO DATA');
				}
				
				
        	break;
	   	
		}
	}
	public function getProducts(){
		$this->db->select('*');
		$this->db->from('products');
		// $this->db->where('created_by',);
		$result = $this->db->get();
		return $result->result_array();
	}

}
