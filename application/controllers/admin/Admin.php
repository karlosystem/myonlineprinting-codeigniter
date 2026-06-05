<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/admin_model");
		$this->load->model("admin/common_model");
	}
	public function check_login()
	{
		$user_name = $this->input->post("username");
		$password = $this->input->post("password");
	
		$password = md5($password);
		$result = $this->admin_model->check_login($user_name, $password);

		if (is_countable($result) && count($result) > 0) {
		##if (count($result) > 0) {
			$this->session->set_userdata("admin_id", $result['admin_id']);
			redirect(base_url() . "admin/admin/home");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Username and Password mismatch");
			redirect(base_url() . "admin/admin/home");
		}
		
	}
	public function change_password()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$params["title"] = "Change Password";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/configuracion/change_password');
		$this->load->view('acceso/panel/footer');
	}
	public function update_password()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$old_p = $this->input->post("old_password");
		$old_p = md5($old_p);
		$new_p = $this->input->post("new_password");
		$confirm_p = $this->input->post("confirm_password");
		$result = $this->admin_model->check_password($old_p);
		if ($result > 0) {

			if ($new_p == $confirm_p) {
				$new_p = md5($new_p);
				$tbl_name = "exp_tbl_admins";
				$data = array(
					"password" => $new_p
				);
				$update_result = $this->admin_model->update($tbl_name, $data);
				if ($update_result > 0) {
					$this->session->set_userdata("valid_box", "1");
					$this->session->set_userdata("success_message", "Password changed successfully");
					redirect(base_url() . "admin/admin/change_password");
				}
			} else {

				$this->session->set_userdata("error_box", "1");
				$this->session->set_userdata("success_message", "Password mismatch");
				redirect(base_url() . "admin/admin/change_password");
			}
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Wrong password");
			redirect(base_url() . "admin/admin/change_password");
		}
	}
	public function login()
	{
		$params["title"] = "Admin Login";
		$this->load->view('acceso/header', $params);
		$this->load->view('acceso/login');
		$this->load->view('acceso/footer');
	}
	public function logout()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$this->session->unset_userdata("admin_id");
		redirect(base_url() . "admin/admin/login");
	}
	public function home()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$data['title'] = "Welcome";
		$this->load->view('acceso/panel/header', $data);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/welcome');
		$this->load->view('acceso/panel/footer');
	}

	public function site_setting()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$params['title'] = "Site Setting";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/configuracion/site_setting');
		$this->load->view('acceso/panel/footer');
	}
	public function update_site_setting()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$tbl_name = "exp_tbl_paypal_setting";

		$data = array(
			"business_email" => $this->input->post("b_email"),
			"api_username" => $this->input->post("api_username"),
			"api_password" => $this->input->post("api_password"),
			"api_signature" => $this->input->post("api_signature"),
			"enviroment" => $this->input->post("environment")

		);

		$cnd_array = array(
			"id" => 1
		);
		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_array);

		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Settings updated successfully");
			redirect(base_url() . "admin/admin/site_setting");
		} else {

			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/admin/site_setting");
		}
	}

	public function change_account()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$params['get_admin_detail'] = $this->common_model->get_admin_detail();
		$params["title"] = "Change Account Detail";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/configuracion/change_account');
		$this->load->view('acceso/panel/footer');
	}

	public function update_admin_detail()
	{
		$user_name = $this->input->post('user_name');
		$email = $this->input->post('email');
		$res = $this->common_model->update_admin_detail($user_name, $email);
		if ($res) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_detail_message", "Admin Detail has been updated successfully");
			redirect(base_url() . "admin/admin/change_account");
		}
	}
}
