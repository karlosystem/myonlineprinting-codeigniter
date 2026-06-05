<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
		$this->load->model("admin/admin_model");
	}
	public function index()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		//code for pagination
		$extraparams = "&" . $_SERVER["QUERY_STRING"];
		$extraparams = explode("&", $extraparams);
		foreach ($extraparams as $key => $pp) {
			$temp = explode("=", $pp);
			if ($temp[0] == "page") {
				unset($extraparams[$key]);
			}
		}
		//$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$tbl_name = 'exp_tbl_users';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN, "DESC", "u_id");

		$params["users"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/users";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params['title'] = "Manage user";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/users/manage_users');
		$this->load->view('acceso/panel/footer');
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
		$u_id = $this->input->post("user_id");
		$result = $this->admin_model->check_duplicate_email_update($u_email, $u_id);
		//debug($result);die;
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function add_user()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$params['title'] = "Add user";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/users/add_user');
		$this->load->view('acceso/panel/footer');
	}
	public function save_user()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$tbl_name = "exp_tbl_users";
		$data = array(
			"u_name" => $this->input->post("u_name"),
			"u_password" => md5($this->input->post("u_password")),
			"u_comp" => $this->input->post("u_comp"),
			"u_country" => $this->input->post("u_country"),
			"u_state" => $this->input->post("u_state"),
			"u_add_line1" => $this->input->post("u_address1"),
			"u_add_line2" => $this->input->post("u_address2"),
			"u_postcode" => $this->input->post("u_postcode"),
			"u_email" => $this->input->post("u_email"),
			"u_phone" => $this->input->post("u_phone"),
			"u_status" => 0

		);
		$result = $this->common_model->insert_data($data, $tbl_name);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "user added successfully");
			redirect(base_url() . "admin/users");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/users");
		}
	}
	public function edit_user()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$u_id = $this->uri->segment(4);

		$tbl_name = "exp_tbl_users";
		$col = "u_id";
		$value = $u_id;

		$params['result'] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$params['title'] = "Edit user";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/users/edit_user');
		$this->load->view('acceso/panel/footer');
	}


	public function update_user()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$user_id = $this->input->post("user_id");


		$tbl_name = "exp_tbl_users";
		$data = array(
			"u_name" => $this->input->post("u_name"),

			"u_comp" => $this->input->post("u_comp"),
			"u_country" => $this->input->post("u_country"),
			"u_state" => $this->input->post("u_state"),
			"u_add_line1" => $this->input->post("u_address1"),
			"u_add_line2" => $this->input->post("u_address2"),
			"u_postcode" => $this->input->post("u_postcode"),
			"u_email" => $this->input->post("u_email"),
			"u_phone" => $this->input->post("u_phone")

		);
		$cnd_arr = array(
			"u_id" => $user_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "user Updated successfully");
			redirect(base_url() . "admin/users/edit_user/" . $user_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/users/edit_user/" . $user_id);
		}
	}
}
