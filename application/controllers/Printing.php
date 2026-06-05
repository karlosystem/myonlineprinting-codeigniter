<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Printing extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("users_model");
		$this->load->model("products_model");
		$this->load->model("admin/common_model");
	}

	public function printing_cards()
	{
		$product_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_sub_products";
		$col = "p_id";
		$value = $product_id;

		$data["subproduct_array"] = $this->common_model->get_result_array_by_id($tbl_name, $col, $value);
		$tbl_name_seo = "exp_tbl_products";
		$product_seo = $this->common_model->get_item_by_id($tbl_name_seo, $col, $product_id);

		$data['title'] = $product_seo['p_meta_title'];
		$data['description_header_page'] = $product_seo['p_meta_description'];
		$data['keywords_header_page'] = $product_seo['p_meta_keywords'];
		//fin de SEO

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();


		$this->load->view("template/header", $data);
		$this->load->view("template/products_detail");
		#$this->load->view("right_sidebar");
		$this->load->view("template/footer");
	}
	public function order_print()
	{
		/*if (!$this->session->userdata("u_id")) {
			redirect(base_url() . 'users/register');
			exit;
		}*/
		//product id
		$p_id = $this->uri->segment(3);

		//sub product id
		$s_p_id = $this->uri->segment(4);

		//status
		$status = $this->uri->segment(5);

		$data['p_id'] = $p_id;
		$data['s_p_id'] = $s_p_id;
		$tbl_name_seo = "exp_tbl_sub_products";
		$col = "sp_id";
		$product_seo = $this->common_model->get_item_by_id($tbl_name_seo, $col, $s_p_id);

		if (isset($data["sub_pro_detail"]["p_name"])) {
			$data['title'] = $product_seo['sp_meta_title'];
			$data['description_header_page'] = $product_seo['sp_meta_description'];
		} else {
			$data['title'] = $product_seo['sp_meta_title'];
			$data['description_header_page'] = $product_seo['sp_meta_description'];
			$data['keywords_header_page'] = 'keywords Home';
		}
		$data['status'] = $status;

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();


		$this->load->view("template/header", $data);
		$this->load->view("template/sub_product_detail");
		$this->load->view("template/footer");
	}
}
