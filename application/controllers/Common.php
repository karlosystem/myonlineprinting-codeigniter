<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("users_model");
		$this->load->model("admin/common_model");
		$this->load->model("products_model");
	}

	public function get_states()
	{
		$tbl_name = "exp_tbl_states";
		$col = "country_id";
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
	public function static_pages()
	{
		$page_id = $this->uri->segment(3);

		$tbl_name = "exp_tbl_static_pages";
		$col = "page_id";
		$value = $page_id;
		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();
		$data["destacados"] = $this->products_model->get_products_destacados_portada();
		$data["page"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$title = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		if (isset($title["page_title"])) {
			$data["title"] = $title["page_meta_title"];
			$data['description_header_page'] = $title["page_meta_description"];
			$data['keywords_header_page'] = $title["page_meta_keywords"];
		} else {
			$data["title"] = $title["page_meta_title"];
			$data['description_header_page'] = $title["page_meta_description"];
			$data['keywords_header_page'] = $title["page_meta_keywords"];
		}
		$this->load->view("template/header", $data);
		$this->load->view("template/static_pages");
		$this->load->view("template/footer");
	}

	public function calculate_price()
	{
		$combination = $this->input->post("combination");
		$p_id = $this->input->post("p_id");
		$sp_id = $this->input->post("sp_id");
		$comb = rtrim($combination, ",");
		$comb;
		//	$price=$this->common_model->calculate_price($p_id,$sp_id,$comb);
		$size_arr = $this->common_model->get_available_sizes($p_id, $sp_id, $comb);
		$qty_arr = $this->common_model->get_available_qtys($p_id, $sp_id, $comb);

		$str = "";
		if (!empty($size_arr)) {

			$str .= '<tr><td style="background:#666666; color:#FFFFFF; width:80px;">
								<strong>Quantity</strong>
				</td>';
			foreach ($size_arr  as $sizes) {
				$str .= '<td style="background:#666666; color:#FFFFFF; width:105px;">
								<strong>' . $sizes["size_name"] . '</strong>
							</td>';
			}
			$str .= '<td style="background:#666666; color:#FFFFFF; width:50px;">
			<strong>Accion</strong></td>';
			$str .= '</tr>';

			foreach ($qty_arr  as $qty) {
				$str .= '<tr>';
				$str .= '<td>' . $qty["qty_name"] . '</td>'	. get_attr_pricing($qty["quantity"], $p_id, $sp_id, $comb);
				$str .= '</td>';
			}
		}
		echo $str;
	}
}
