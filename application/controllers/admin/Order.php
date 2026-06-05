<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
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

		$tbl_name = 'exp_tbl_orders';
		$orderby = 'DESC';
		$col = "order_id";
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN, $orderby, $col);

		$params["order_array"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/order";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "Manage Orders";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/orders/manage_orders');
		$this->load->view('acceso/panel/footer');
	}

	function order_detail()
	{
		$order_id = $this->uri->segment(4);
		$tbl = "exp_tbl_orders";
		$col = "order_id";
		$value = $order_id;
		$params["order"] = $this->common_model->get_item_by_id($tbl, $col, $value);
		$params["title"] = "Order Detail";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/orders/order_detail');
		$this->load->view('acceso/panel/footer');
	}
}
