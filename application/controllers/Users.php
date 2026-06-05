<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("users_model");
		$this->load->library("cart");
		$this->load->model("admin/common_model");
		$this->load->model("products_model");
	}

	public function index()
	{
		$tbl_name = "exp_tbl_main_slider";
		$data['sliders'] = $this->common_model->get_all_list($tbl_name);

		$data['title'] = 'Users';
		$data['description_header_page'] = 'description User';
		$data['keywords_header_page'] = 'keywords User';

		$this->load->view('header', $data);
		$this->load->view('index');
		$this->load->view('footer');
	}
	public function login()
	{
		$data['title'] = 'Login';
		$data['description_header_page'] = 'description Login';
		$data['keywords_header_page'] = 'keywords Login';
		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();

		$this->load->view('template/header', $data);
		$this->load->view('template/login');
		$this->load->view('template/footer');
	}
	public function ckeck_login()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$password1 = md5($password);
		$result = $this->users_model->check_login($username, $password1);
		$remember_chk = $this->input->post("remember");

		if (is_countable($result) && count($result) > 0) {

			$this->session->set_userdata("u_id", $result['u_id']);
			$this->session->set_userdata("u_name", $result['u_name']);

			//setting cookies
			if ($remember_chk == 1) {

				$this->load->helper('cookie');
				$user_arr = array(
					'name' => 'username',
					'value' => $username,
					'expire' => '86500'
				);
				set_cookie($user_arr);

				$pass_arr = array(
					'name' => 'password',
					'value' => $password,
					'expire' => '86500'
				);
				set_cookie($pass_arr);
			}
			redirect(base_url());
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Username AND Password mismatch");
			redirect(base_url() . "users/login");
		}
	}
	public function register()
	{
		$this->load->library('recaptcha');
		$data['title'] = 'Register';
		$data['description_header_page'] = 'description Register';
		$data['keywords_header_page'] = 'keywords Register';
		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();

		$this->load->view('template/header', $data);
		$this->load->view('template/register');
		$this->load->view('template/footer');
	}

	public function save_user()
	{
		$data = array(
			"u_name" => $this->input->post("u_name"),
			"u_password" => md5($this->input->post("u_password")),
			"u_comp" => $this->input->post("u_comp"),
			"u_add_line1" => $this->input->post("u_add_line1"),
			"u_add_line2" => $this->input->post("u_add_line2"),
			"u_country" => $this->input->post("u_country"),
			"u_state" => $this->input->post("u_state"),
			"u_state" => $this->input->post("u_state"),
			"u_postcode" => $this->input->post("u_postcode"),
			"u_phone" => $this->input->post("u_phone"),
			"u_email" => $this->input->post("u_email"),
			"u_status" => 1 //zqui modifico karlos
		);

		$tbl_name = "exp_tbl_users";
		$this->db->insert($tbl_name, $data);
		//$result = $this->common_model->insert_data($data, $tbl_name);
		$resultado = $this->db->insert("exp_tbl_users", $data);
		if ($resultado) {
			$admin_tbl = "exp_tbl_paypal_setting";
			$data = $this->common_model->get_all_list($admin_tbl);
			$admin_email = $data[0]['business_email'];
			//mail functionality starts
			$user_email = $this->input->post("u_email");
			$username = $this->input->post("u_name");
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($admin_email, "Shopingalaxy");
			$this->email->to($user_email);
			$this->email->subject("MyOnlinePrinting.net - Registration successful.");
			$message_d = @file_get_contents("templates/customer_register.html");
			$message_d = str_replace("[CUSTOMER_NAME]", $user_name, $message_d);
			$message_d = str_replace("[CUSTOMER_USERNAME]", $username, $message_d);
			$message_d = str_replace("[MESSAGE]", 'Thank you for registration.The login details of your account below.', $message_d);
			$pwd = $this->input->post("u_password");
			$message_d = str_replace("[CUSTOMER_PASSWORD]", $pwd, $message_d);
			$logo_url = base_url() . "assets/images/logo.png";
			$login_url = base_url() . "users/login";
			$message_d = str_replace("[CUSTOMER_LOGIN_URL]", $login_url, $message_d);
			$message_d = str_replace("[IMAGE_PATH]", $logo_url, $message_d);
			$this->email->message($message_d);
			$this->email->send();
			//mail functionality ends
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Registration Successfull");
			redirect(base_url() . "users/register");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "users/register");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("u_id");
		$this->session->unset_userdata("u_name");
		$this->cart->destroy();
		redirect(base_url());
	}
	public function my_account()
	{
		$u_id = '';
		if ($this->session->userdata("u_id")) {
			$u_id = $this->session->userdata("u_id");
		}

		$tbl = "exp_tbl_users";
		$col = "u_id";
		$value = $u_id;
		$data["detail"] = $this->common_model->get_item_by_id($tbl, $col, $value);

		$data['title'] = 'My Account';
		$data['description_header_page'] = 'description My Account';
		$data['keywords_header_page'] = 'keywords My Account';

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();
		$data["destacados"] = $this->products_model->get_products_destacados_portada();

		$this->load->view('template/header', $data);
		$this->load->view('template/my_account');
		$this->load->view('template/footer');
	}

	public function order_history()
	{
		$u_id = '';
		if (!$this->session->userdata("u_id")) {
			redirect(base_url());
		}

		if ($this->session->userdata("u_id")) {
			$u_id = $this->session->userdata("u_id");
		}

		$tbl = "exp_tbl_users";
		$col = "u_id";
		$value = $u_id;
		$data['title'] = 'Order History';
		$data['description_header_page'] = 'description Order History';
		$data['keywords_header_page'] = 'keywords Order History';

		$data["get_order_by_user_id"] = $this->common_model->get_order_by_user_id($value);
		$this->load->view('template/header', $data);
		$this->load->view('template/order_history');
		$this->load->view('template/footer');
	}

	public function check_duplicate_email()
	{
		$u_email = $this->input->post("email");
		$tbl_name = "exp_tbl_users";
		$col = "u_email";
		$value = $u_email;
		$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function check_duplicate_email_update()
	{
		$u_email = $this->input->post("email");
		$u_id = $this->session->userdata("u_id");
		$result = $this->users_model->check_duplicate_email_update($u_email, $u_id);
		//debug($result);die;
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function update_user()
	{

		$u_id = $this->session->userdata("u_id");



		$tbl_name = "exp_tbl_users";

		$data = array(
			"u_name" => $this->input->post("u_name"),
			//"u_password"=>md5($this->input->post("u_password")),
			"u_comp" => $this->input->post("u_comp"),
			"u_add_line1" => $this->input->post("u_add_line1"),
			"u_add_line2" => $this->input->post("u_add_line2"),
			"u_country" => $this->input->post("u_country"),
			"u_state" => $this->input->post("u_state"),
			"u_state" => $this->input->post("u_state"),
			"u_postcode" => $this->input->post("u_postcode"),
			"u_phone" => $this->input->post("u_phone"),
			"u_email" => $this->input->post("user_email"),

		);

		$cnd_arr = array(
			"u_id" => $u_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);

		if ($result) {

			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Information Updated Successfully");
			redirect(base_url() . "users/my_account");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/my_account");
		}
	}


	public function cust_order_detail()
	{
		$data['title'] = 'Customer Order Detail';
		$order_id = $this->uri->segment(3);
		$tbl = "exp_tbl_orders";
		$col = "order_id";
		$value = $order_id;
		$data["order"] = $this->common_model->get_item_by_id($tbl, $col, $value);
		$this->load->view('header', $data);
		$this->load->view('cust_order_detail');
		$this->load->view('footer');
	}
}
