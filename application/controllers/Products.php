<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
		$this->load->model("products_model");
	}
	public function index()
	{
		$tbl_name = 'exp_tbl_products';
		$data["product_array"] = $total_rows = $this->common_model->get_all_list($tbl_name, 0, 0, 'ASC', 'p_order');
		$data["product_count"] = $this->products_model->get_products_count();
		$data["bussiness_cards"] = $this->products_model->get_products_bussiness_cards();
		$data["not_bussiness_cards"] = $this->products_model->get_products_not_BussinessCard();
		$data["title"] = "Printing Online, Offset & Digital";
		$data['description_header_page'] = 'Business Card,flyers,Bookmarks,Door Hanger,Full Color Artist Canvas,Folder,Foil Postcard,Invoices,Letterheads,Envelopes,Prescription Pads & Notepads,Table Tent Cards,CAD Plotting,Magnets,Curve Tube Display,Banner Display,Frame Display';
		$data['keywords_header_page'] = 'Print,online,Miami,Business card,Web,Prices';
		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();

		$this->load->view("template/header", $data);
		$this->load->view("template/product_listing");
		$this->load->view("template/footer");
	}
	public function search_product()
	{
		$keyword = $this->input->post("keyword");
		$data["product_array"] = $this->products_model->search_product($keyword);

		$data["title"] = "Search Result";
		$data['description_header_page'] = 'description Home';
		$data['keywords_header_page'] = 'keywords Home';

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();

		$this->load->view("template/header", $data);
		$this->load->view("template/product_listing");
		$this->load->view("template/footer");
	}
}
