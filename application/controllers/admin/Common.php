<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/products_model");
		$this->load->model("admin/common_model");
	}


	public function change_status()
	{

		if (!$this->session->userdata("admin_id")) {
			redirect(base_url('admin/admin/login'));
			exit;
		}
		$table = $this->input->post('table');
		$column = $this->input->post('column');
		$value = $this->input->post('value');
		$uniqueNameCol = $this->input->post('uniqueNameCol');
		$uniqueColValue = $this->input->post('uniqueColValue');
		$re = $this->common_model->change_status($table, $column, $value, $uniqueNameCol, $uniqueColValue);
	}

	public function delete_item()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url('admin/admin/login'));
			exit;
		}

		$this->load->model("admin/common_model");

		$table = $this->input->post('table');
		$column = $this->input->post('uniqueNameCol');
		$value = $this->input->post('value');

		$re = $this->common_model->delete_item($table, $column, $value);
		if ($re) {
			echo 1;
		}
	}



	public function fetch_by_id()
	{
		$tbl_name = $this->input->post("table");
		$col = $this->input->post("col");
		$value = $this->input->post("value");
		$result = $this->common_model->get_result_array_by_id($tbl_name, $col, $value);
		$str = "";
		if ($result) {
			foreach ($result as $a) {
				$str .= '<option value=' . $a['state_id'] . '>' . $a['state_name'] . '</option>';
			}
		}
		echo $str;
	}


	public function get_attributes()
	{
		$tbl_name = "exp_tbl_products_attribute";
		$col = "p_c_id";
		$value = $this->input->post("cat_id");

		$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$str = "";
		if ($result) {
			foreach ($result as $a) {
				$str .= '<option value=' . $a['p_a_id'] . '>' . $a['p_a_type'] . '</option>';
			}
		} else {
			$str .= '<option>No attribute</option>';
		}
		echo $str;
	}
	public function manage_quantities()
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
		$tbl_name = 'exp_tbl_qty';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);
		$params["qty_array"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/common/manage_quantities";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "All quantities";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/cantidades/manage_quantities');
		$this->load->view('acceso/panel/footer');
	}
	public function add_quantity()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$params["title"] = "Add new quantity";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/cantidades/add_quantity');
		$this->load->view('acceso/panel/footer');
	}
	public function save_quantity()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$tbl_name = "exp_tbl_qty";
		$data = array(

			"qty_name" => $this->input->post("qty_name"),


		);
		$result = $this->common_model->insert_data($data, $tbl_name);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Quantity added successfully");
			redirect(base_url() . "admin/common/add_quantity");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/common/add_quantity");
		}
	}
	public function check_duplicate_quantity()
	{
		$qty_name = $this->input->post("qty_name");
		$tbl_name = "exp_tbl_qty";
		$col = "qty_name";
		$value = $qty_name;
		$params = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		if ($params) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function edit_quantity()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}
		$qty_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_qty";
		$col = "qty_id";
		$value = $qty_id;
		$params["qty_detail"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$params["title"] = "Edit Quantity";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/cantidades/edit_quantity');
		$this->load->view('acceso/panel/footer');
	}

	public function update_quantity()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$qty_id = $this->input->post("qty_id");
		$tbl_name = "exp_tbl_qty";

		$data = array(

			"qty_name" => $this->input->post("qty_name"),


		);
		$cnd_arr = array(
			"qty_id" => $qty_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("check_success", "Quantity Updated successfully");
			redirect(base_url() . "admin/common/edit_quantity/" . $qty_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("check_success", "Error occurred");
			redirect(base_url() . "admin/common/edit_quantity/" . $qty_id);
		}
	}
	public function manage_sizes()
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
		$tbl_name = 'tbl_size';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);
		$params["size_array"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/common/manage_sizes";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "All Sizes";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/tamanos/manage_sizes');
		$this->load->view('acceso/panel/footer');
	}

	public function add_size()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$params["title"] = "Add new size";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/tamanos/add_size');
		$this->load->view('acceso/panel/footer');
	}
	public function save_size()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$tbl_name = "tbl_size";
		$data = array(

			"size_name" => $this->input->post("size_name"),


		);
		$result = $this->common_model->insert_data($data, $tbl_name);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "size added successfully");
			redirect(base_url() . "admin/common/add_size");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/common/add_size");
		}
	}
	public function check_duplicate_size()
	{
		$size = $this->input->post("size_name");
		$tbl_name = "tbl_size";
		$col = "size_name";
		$value = $size;
		$params = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		if ($params) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function edit_size()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}

		$size_id = $this->uri->segment(4);
		$tbl_name = "tbl_size";
		$col = "size_id";
		$value = $size_id;
		$params["size_detail"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$params["title"] = "Edit size";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/tamanos/edit_size');
		$this->load->view('acceso/panel/footer');
	}
	public function update_size()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$size_id = $this->input->post("size_id");
		$tbl_name = "tbl_size";

		$data = array(

			"size_name" => $this->input->post("size_name"),


		);
		$cnd_arr = array(
			"size_id" => $size_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "size Updated successfully");
			redirect(base_url() . "admin/common/edit_size/" . $size_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/common/edit_size/" . $size_id);
		}
	}
}
