<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attributes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/products_model");
		$this->load->model("admin/common_model");
		$this->load->model("admin/attributes_model");
	}


	public function manage_attributes()
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

		$tbl_name = 'exp_tbl_attributes';


		$total_rows = $this->common_model->get_all_list($tbl_name);

		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);


		$params["attributes"] = $result;

		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/attributes/manage_attributes";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$params["title"] = "Manage Attributes";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/atributos/manage_attributes');
		$this->load->view('acceso/panel/footer');
	}

	public function add_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$params["title"] = "Add Attributes";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/atributos/add_attribute');
		$this->load->view('acceso/panel/footer');
	}
	public function save_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$tbl_name = "exp_tbl_attributes";
		$data = array(

			"att_name" => $this->input->post("att_name"),

		);
		//debug($data);die;
		##$result = $this->common_model->insert_data($data, $tbl_name);
		$resultado = $this->db->insert("exp_tbl_attributes", $data);
		$sp_id = $this->db->insert_id();

		if ($resultado) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Attribute added successfully");
			redirect(base_url() . "admin/attributes/add_attribute");
		} else {

			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/attributes/add_attribute");
		}
	}


	public function edit_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$att_id = $this->uri->segment(4);

		$tbl_name = "exp_tbl_attributes";
		$col = "att_id";
		$value = $att_id;
		$params["attributes"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$params["title"] = "Edit Attributes";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/atributos/edit_attribute');
		$this->load->view('acceso/panel/footer');
	}


	public function update_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$att_id = $this->input->post("att_id");
		$tbl_name = "exp_tbl_attributes";
		$data = array(

			"att_name" => $this->input->post("att_name")

		);
		$cnd_arr = array(
			"att_id" => $att_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Attribute Updated successfully");
			redirect(base_url() . "admin/attributes/edit_attribute/" . $att_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/pages/edit_attribute/" . $att_id);
		}
	}
	public function check_duplicate_attribute()
	{
		$att_name = $this->input->post("att_name");
		$tbl_name = "exp_tbl_attributes";
		$col = "att_name";
		$value = $att_name;
		$params = $this->attributes_model->check_duplicate_attribute($tbl_name, $col, $value);

		if ($params) {
			echo 1;
		} else {
			echo 0;
		}
	}
}
