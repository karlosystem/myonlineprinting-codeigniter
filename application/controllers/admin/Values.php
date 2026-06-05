<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Values extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/value_model");
		$this->load->model("admin/common_model");
	}
	public function manage_values()
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
		#$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$tbl_name = 'exp_tbl_attribute_values';


		$total_rows = $this->common_model->get_all_list($tbl_name);

		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);


		$params["value"] = $result;

		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/values/manage_values";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$params["title"] = "Manage Values";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/values/manage_values');
		$this->load->view('acceso/panel/footer');
	}

	public function add_value()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$params["title"] = "Add Value";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/values/add_value');
		$this->load->view('acceso/panel/footer');
	}

	public function save_value()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$tbl_name = "exp_tbl_attribute_values";
		$data = array(
			'att_id' => $this->input->post('att_id'),
			'value_name' => $this->input->post('value_name'),
			'status' => "1"

		);
		##$result = $this->common_model->insert_data($data, $tbl_name);
		$result = $this->db->insert("exp_tbl_attribute_values", $data);
		$value_id = $this->db->insert_id();

		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Value added successfully");
			redirect(base_url() . "admin/values/add_value");
		} else {

			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/values/add_value");
		}
	}


	public function edit_value()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}
		$value_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_attribute_values";
		$col = "value_id";
		$value = $value_id;
		$params["value"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$params["title"] = "Edit Attribute";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/values/edit_value');
		$this->load->view('acceso/panel/footer');
	}


	public function update_value()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$value_id = $this->input->post("value_id");
		$tbl_name = "exp_tbl_attribute_values";
		$data = array(

			'att_id' => $this->input->post('att_id'),
			'value_name' => $this->input->post('value_name'),


		);
		$cnd_arr = array(
			"value_id" => $value_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Value Updated successfully");
			redirect(base_url() . "admin/values/edit_value/" . $value_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/values/edit_value/" . $value_id);
		}
	}
	public function check_duplicate_value()
	{
		$att_id = $this->input->post("att_id");
		$value_name = $this->input->post("value_name");
		$result = $this->value_model->check_duplicate_value($att_id, $value_name);
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}
}
