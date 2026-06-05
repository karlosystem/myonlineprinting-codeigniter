<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends CI_Controller 
{

	public function __construct() {
			parent::__construct();
			$this->load->model("admin/common_model");
			
			
	}	
	public function index()
	{
		$this->forgot();

	}
	public function forgot()
	{
		$data["title"]="Forgot Password";
		$data['description_header_page'] = 'description Forgot Password';
		$data['keywords_header_page'] = 'keywords Forgot Password';

		$this->load->view("header",$data);
		$this->load->view("forgot_password");
		//$this->load->view("right_sidebar");
		$this->load->view("footer");
	}
	public function get_new_password()
	{	
		
		$email=$this->input->post("email");
		
		//get user information
		
		$tbl_name="exp_tbl_users";
		$col="u_email";
		$value=$email;
		$user_array = $this->common_model->get_item_by_id($tbl_name,$col,$value);
		//debug($user_array);
		//--------------------------------------------------------------
				
		//generate rendom password		
		$word = "a,b,c,d,e,f,g,h,i,j,k,l,m,1,2,3,4,5,6,7,8,9,0"; 
		$array=explode(",",$word); 
		shuffle($array); 
		$newstring = implode($array,""); 
		$new_password= substr($newstring,0,6); 
		//--------
	
		$data=array(
			"u_password"=>md5($new_password)
		
		);
		$cnd_arr=array(
			"u_email"=>$email
		);
		$tbl_name="exp_tbl_users";
		
		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		
		if($result)
		{
			$admin_tbl="exp_tbl_paypal_setting";
			$data=$this->common_model->get_all_list($admin_tbl);
			$admin_email=$data[0]['business_email'];
			//mail functionality starts
			$user_email = $this->input->post("email");
					
			$this->load->library('email');
			$config['mailtype'] = 'html';				
			$this->email->initialize($config);
			$this->email->from($admin_email, "My Online Printing" );
			$this->email->to( $user_email );
			$this->email->subject("My Online Printing - Forgot Password.");
			$message_d = @file_get_contents("templetes/forgot_password.html");
			$message_d = str_replace("[CUSTOMER_NAME]", $user_array['u_name'], $message_d);
			$message_d = str_replace("[CUSTOMER_USERNAME]", $user_array['u_name'] , $message_d);
			
			
			$message_d = str_replace("[CUSTOMER_PASSWORD]", $new_password, $message_d);
			$logo_url = base_url() . "images/logo.png";
			$login_url = base_url() . "users/login";
			$message_d = str_replace("[CUSTOMER_LOGIN_URL]", $login_url, $message_d);
			$message_d = str_replace("[IMAGE_PATH]", $logo_url, $message_d);
		
			$this->email->message($message_d); 		 
			$this->email->send();
			
			//mail functionality ends
			
			$this->session->set_userdata("valid_box","1");
			$this->session->set_userdata("success_message","New password has been sent on your email address. Please check your email address.");
			redirect(base_url()."forgot");
		
		}
		else{
			$this->session->set_userdata("error_box","1");
			$this->session->set_userdata("success_message","Error occurred");
			redirect(base_url()."forgot");
		
		}
		
		
	
	}
	
}
