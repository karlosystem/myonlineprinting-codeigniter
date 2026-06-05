<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Assign_attributes extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
		$this->load->model("admin/assign_attribute_model");
	}
	public function index()
	{
		$this->manage_assigned_attributes();
	}
	public function manage_assigned_attributes()
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

		$tbl_name = 'exp_tbl_assigned_attributes';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);

		$params["assigned_attributes"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/assign_attributes/manage_assigned_attributes";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$params["title"] = "Manage Assigned Attributes";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/atributos/manage_assigned_attributes');
		$this->load->view('acceso/panel/footer');
	}
	public function assign_new_attribute()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$params["title"] = "Assigned  New Attribute";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/atributos/assign_attribute');
		$this->load->view('acceso/panel/footer');
	}

	public function save()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}


		$tbl_name = "exp_tbl_assigned_attributes";
		$data = array(
			"p_id" => $this->input->post("p_id"),
			"sp_id" => $this->input->post("sp_id"),
			"att_id" => $this->input->post("att_id"),
			"val_id" => $this->input->post("value_id")
		);
		$result = $this->db->insert($tbl_name, $data);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Attribute assigned successfully");
			redirect(base_url() . "admin/assign_attributes/assign_new_attribute");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/assign_attributes/assign_new_attribute");
		}
	}


	public function edit()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_assigned_attributes";
		$col = "id";
		$value = $id;
		$params["assign_attributes"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$params["title"] = "Edit Assign Attribute";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/atributos/edit_assign_attribute');
		$this->load->view('acceso/panel/footer');
	}

	public function update()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$id = $this->input->post("id");
		$tbl_name = "exp_tbl_assigned_attributes";

		$data = array(
			"p_id" => $this->input->post("p_id"),
			"sp_id" => $this->input->post("sp_id"),
			"att_id" => $this->input->post("att_id"),
			"val_id" => $this->input->post("value_id")

		);
		$cnd_arr = array(
			"id" => $id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Assign attribute Updated successfully");
			redirect(base_url() . "admin/assign_attributes/edit/" . $id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/assign_attributes/edit/" . $id);
		}
	}
	public function check_duplicate_assigned_attribute()
	{
		$p_id = $this->input->post("p_id");
		$sp_id = $this->input->post("sp_id");
		$att_id = $this->input->post("att_id");
		$value_id = $this->input->post("value_id");
		$result = $this->assign_attribute_model->check_duplicate_assigned_attribute($p_id, $sp_id, $att_id, $value_id);
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}
}
