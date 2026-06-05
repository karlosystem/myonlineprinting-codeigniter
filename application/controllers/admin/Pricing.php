<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
		$this->load->model("admin/admin_model");
		$this->load->model("admin/assign_attribute_model");
	}

	public function all_products_pricing()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

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

		$tbl_name = 'exp_tbl_products';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);
		$params["product_array"] = $result;
		$params["title"] = "Seleccionar el producto para asignar precios";
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/pricing/all_products_pricing";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/precios/all_pricing_products');
		$this->load->view('acceso/panel/footer');
	}
	public function manage_price()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
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

		$tbl_name = 'exp_tbl_pricing';
		$orderby = 'DESC';
		$col = "date_add";
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, 1000, ($page - 1) * 1000, $orderby, $col);

		$params["price_array"] = $result;
		$params["title"] = "All Prices of Products";
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/pricing/manage_price";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/precios/all_prices');
		$this->load->view('acceso/panel/footer');
	}

	public function all_subproducts()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$p_id = $this->uri->segment(4);
		$tbl = "exp_tbl_sub_products";
		$col = "p_id";
		$value = $p_id;
		$params['sub_products'] = $this->common_model->get_result_array_by_id($tbl, $col, $value);
		$params["title"] = "All Subproducts";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/precios/all_pricing_subproducts');
		$this->load->view('acceso/panel/footer');
	}

	public function set_price()
	{
		$p_id = $this->uri->segment(4);
		$sp_id = $this->uri->segment(5);
		$params['attributes_names'] = $this->admin_model->get_all_attributes($p_id, $sp_id);

		$params["title"] = "Set Price";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/precios/add_pricing');
		$this->load->view('acceso/panel/footer');
	}


	public function save_price()
	{

		$values = $this->input->post("value_array");
		$value_string = implode(",", $values);

		$p_id = $this->input->post("p_id");
		$sp_id = $this->input->post("sp_id");

		$data = array(
			"p_id" => $this->input->post("p_id"),
			"sp_id" => $this->input->post("sp_id"),
			"combination" => $value_string,
			"quantity" => $this->input->post("quantity"),
			"size" => $this->input->post("size"),
			"price" => $this->input->post("price")

		);
		$resultado = $this->db->insert("exp_tbl_pricing", $data);
		if ($resultado) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Price added successfully");
			redirect(base_url() . "admin/pricing/set_price/" . $p_id . "/" . $sp_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/pricing/set_price/" . $p_id . "/" . $sp_id);
		}
	}
	public function check_duplicate_price()
	{
		$p_id = $this->input->post("p_id");
		$sp_id = $this->input->post("sp_id");
		$qty = $this->input->post("qty");
		$size = $this->input->post("size");
		//$price=$this->input->post("price");
		$combination = $this->input->post("combination");
		$comb = rtrim($combination, ",");
		$result = $this->assign_attribute_model->check_duplicate_price($p_id, $sp_id, $comb, $qty, $size);
		//debug($result);die;
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function edit_pricing()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}

		$pricing_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_pricing";
		$col = "pricing_id";
		$value = $pricing_id;
		$params["pricing"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$params["title"] = "Edit Pricing of Products";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/precios/edit_pricing');
		$this->load->view('acceso/panel/footer');
	}

	public function update_pricing()
	{

		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$pricing_id = $this->input->post("pricing_id");
		$tbl_name = "exp_tbl_pricing";
		$data = array(
			'price' => $this->input->post('price'),
		);

		$cnd_arr = array(
			"pricing_id" => $pricing_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Value Updated successfully");
			redirect(base_url() . "admin/pricing/edit_pricing/" . $pricing_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/pricing/edit_pricing/" . $pricing_id);
		}
	}
}
