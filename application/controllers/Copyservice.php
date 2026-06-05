<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Copyservice extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
		$this->load->model("users_model");
		$this->load->model("products_model");
	}
	public function index()
	{
		$tbl_name = "exp_tbl_main_slider";
		$data['sliders'] = $this->common_model->get_all_list($tbl_name);

		$tbl_name1 = "exp_tbl_products";
		$data['slider_products'] = $this->common_model->get_all_list($tbl_name1, 0, 10);

		$tbl_name2 = 'exp_tbl_products';
		$data["product_array"] = $total_rows = $this->common_model->get_all_list($tbl_name2, 0, 0, 'ASC', 'p_order');

		$data['title'] = 'Miami Printing Company High Quality';

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();

		$data['title_header_page'] = 'Miami Printing Company High Quality';
		$data['description_header_page'] = 'We are your local printing company in Miami, Low prices, Miami Printing, We specialize in Business Card, CAD Plotting, Banners, PostCards, Flyer, Folders, Bookmarks, Letterheads, Door Hanger, Invoices';
		$data['keywords_header_page'] = 'postcards, folders, flyers, brochures. Printing Miami, Florida. Low prices';

		$this->load->view('template/header', $data);
		$this->load->view('template/index');
		$this->load->view('template/footer');
	}


	public function delete_artwork()
	{

		$data['title'] = "Shopping Basket";
		$data['description_header_page'] = "Template Designs";
		$data['keywords_header_page'] = "Template Designs";

		$r_id = $this->uri->segment(3);

		$this->common_model->delete_artwork($r_id);

		$this->session->set_userdata("valid_box", "1");
		$this->session->set_userdata("success_message", "ArtWork file delete successfully.");
		redirect(base_url() . "cart");
	}


	public function upload_artwork()
	{


		$temp_id = $this->input->post("r_id");


		$res = $this->users_model->delete_data($temp_id);


		$file = $_FILES["artwork_file"];


		if ($file["error"] == UPLOAD_ERR_OK) {

			$file_name = clean_filename($file["name"]);
			$file_name = $file_name;
			if (!file_exists("uploads")) {
				mkdir("uploads", DIR_WRITE_MODE);
			}
			if (!file_exists("uploads/artworks")) {
				mkdir("uploads/artworks", DIR_WRITE_MODE);
			}
		}

		$tbl_name = "exp_tbl_artwork";
		$data = array(
			"r_id" => $temp_id,
			"file_name" => $file_name

		);


		$result = $this->common_model->insert_data($data, $tbl_name);
		$artwork_id = $this->db->insert_id();
		if ($result) {

			if ($file["name"] != '') {
				if (!file_exists("uploads/artworks/" . 	$temp_id)) {
					mkdir("uploads/artworks/" . $temp_id, DIR_WRITE_MODE);
				}
				chmod("uploads/artworks/" . $temp_id, DIR_WRITE_MODE);

				$dir = "uploads/artworks/" . $temp_id;

				$file_path =  $dir . "/" . $file_name;

				$imgFiles1 = glob("uploads/artworks/" . $temp_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}


				move_uploaded_file($file["tmp_name"], $file_path);
			}
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "ArtWork file added successfully.");
			redirect(base_url() . "cart");
		}
	}
}
