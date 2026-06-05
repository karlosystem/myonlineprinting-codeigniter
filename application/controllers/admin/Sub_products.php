<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sub_products extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/products_model");
		$this->load->model("admin/common_model");
	}
	public function index()
	{
	}
	public function manage_subproducts()
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

		$tbl_name = 'exp_tbl_sub_products';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);
		$params["subproducts"] = $result;

		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/sub_products/manage_subproducts";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$params["title"] = "Manage Subproducts";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/subproducts/manage_subproducts');
		$this->load->view('acceso/panel/footer');
	}

	public function add_subproduct()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$this->load->library('CKEditor');
		$this->load->library('CKFinder');

		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		//configure base path of ckeditor folder 
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');

		$params["title"] = "Add Subproducts";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/subproducts/add_subproduct');
		$this->load->view('acceso/panel/footer');
	}

	public function save_subproduct()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$image = $_FILES["sub_image"];
		//debug($image);die;
		if ($image["error"] == UPLOAD_ERR_OK) {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
			if (!file_exists("assets/images/subproducts")) {
				mkdir("assets/images/subproducts", DIR_WRITE_MODE);
			}
		}

		$tbl_name = "exp_tbl_sub_products";
		$data = array(
			"p_id" => $this->input->post("product_id"),
			"sp_name" => $this->input->post("sub_name"),
			"sp_description" => $this->input->post("sub_description"),
			"sp_meta_title" => $this->input->post("sp_meta_title"),
			"sp_meta_description" => $this->input->post("sp_meta_description"),
			"sp_date" => date("Y/m/d"),
			"sp_status" => 0,
			"special_status" => 0

		);
		##$result = $this->common_model->insert_data($data, $tbl_name);
		$resultado = $this->db->insert("exp_tbl_sub_products", $data);
		$sp_id = $this->db->insert_id();

		if ($resultado) {
			if ($image["name"] != '') {
				if (!file_exists("assets/images/subproducts/" . $sp_id)) {
					mkdir("assets/images/subproducts/" . $sp_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/subproducts/" . $sp_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/subproducts/" . $sp_id . "/" . "/thumbs")) {
					mkdir("assets/images/subproducts/" . $sp_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/subproducts/" . $sp_id . "/" . "/thumbs", DIR_WRITE_MODE);

				if (!file_exists("assets/images/subproducts/" . $sp_id . "/" . "/profile")) {
					mkdir("assets/images/subproducts/" . $sp_id . "/" . "/profile", DIR_WRITE_MODE);
				}
				chmod("assets/images/subproducts/" . $sp_id . "/" . "/profile", DIR_WRITE_MODE);
				$dir = "assets/images/subproducts/" . $sp_id;
				$image_path =  $dir . "/" . $image_name;
				$imgFiles1 = glob("assets/images/subproducts/" . $sp_id . "/*.*");
				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("assets/images/subproducts/" . $sp_id . "/thumbs/*.*");
				foreach ($imgFilesThumbs1 as $thumbs1) {
					@unlink($thumbs1);
				}
				move_uploaded_file($image["tmp_name"], $image_path);
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 800;
				$config['height'] = 600;
				$config['new_image'] = $dir . "/profile/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 400;
				$config['height'] = 300;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data_arr = array(
					"sp_image" => $image_name
				);
				$cnd_arr = array(
					"sp_id" => $sp_id
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Subproduct added successfully");
			redirect(base_url() . "admin/sub_products/add_subproduct");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/sub_products/add_subproduct");
		}
	}


	public function edit_subproduct()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}

		$this->load->library('CKEditor');
		$this->load->library('CKFinder');

		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		//configure base path of ckeditor folder 
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');
		$slider_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_sub_products";
		$col = "sp_id";
		$value = $slider_id;
		$params["subproduct"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$params["title"] = "Edit Subproduct";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/subproducts/edit_subproduct');
		$this->load->view('acceso/panel/footer');
	}


	public function update_subproduct()
	{

		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}
		/************image **************/
		$image = $_FILES["sub_image"];
		if ($image["name"] != '') {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
		} else {
			$image_name = $this->input->post('old_image');
		}
		//debug($image_name);die;
		$tbl_name = "exp_tbl_sub_products";
		$subproduct_id = $this->input->post('sp_id');

		$data = array(
			"p_id" => $this->input->post("product_id"),
			"sp_name" => $this->input->post("sub_name"),
			"sp_description" => $this->input->post("sp_description"),
			"sp_meta_title" => $this->input->post("sp_meta_title"),
			"sp_meta_description" => $this->input->post("sp_meta_description"),
		);
		$cnd_arr = array(
			"sp_id" => $subproduct_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {

			if ($image["name"] != '') {
				//echo "sd";die;
				if (!file_exists("assets/images/subproducts/" . $subproduct_id)) {
					mkdir("assets/images/subproducts/" . $subproduct_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/subproducts/" . $subproduct_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/subproducts/" . $subproduct_id . "/" . "/thumbs")) {
					mkdir("assets/images/subproducts/" . $subproduct_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/subproducts/" . $subproduct_id . "/" . "/thumbs", DIR_WRITE_MODE);

				if (!file_exists("assets/images/subproducts/" . $subproduct_id . "/" . "/profile")) {
					mkdir("assets/images/subproducts/" . $subproduct_id . "/" . "/profile", DIR_WRITE_MODE);
				}
				chmod("assets/images/subproducts/" . $subproduct_id . "/" . "/profile", DIR_WRITE_MODE);

				$dir = "assets/images/subproducts/" . $subproduct_id;

				$image_path =  $dir . "/" . $image_name;

				$imgFiles1 = glob("assets/images/subproducts/" . $subproduct_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}

				$imgFilesThumbs1 = glob("assets/images/subproducts/" . $subproduct_id . "/thumbs/*.*");

				foreach ($imgFilesThumbs1 as $thumbs1) {
					@unlink($thumbs1);
				}

				$imgFilesThumbs2 = glob("assets/images/subproducts/" . $subproduct_id . "/profile/*.*");

				foreach ($imgFilesThumbs2 as $thumbs2) {
					@unlink($thumbs2);
				}

				move_uploaded_file($image["tmp_name"], $image_path);

				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 380;
				$config['height'] = 290;
				$config['new_image'] = $dir . "/profile/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 180;
				$config['height'] = 170;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$data_arr = array(
					"sp_image" => $image_name

				);
				$cnd_arr = array(
					"sp_id" => $subproduct_id

				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}

			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Subproduct Updated successfully");
			redirect(base_url() . "admin/sub_products/edit_subproduct/" . $subproduct_id);
		} else {

			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/sub_productsedit_subproduct/" . $subproduct_id);
		}
	}
	public function delete_subproduct()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url('admin/admin/login'));
			exit;
		}

		function rrmdir($dir)
		{
			foreach (glob($dir . '/*') as $file) {
				if (is_dir($file))
					rrmdir($file);
				else
					unlink($file);
			}
			rmdir($dir);
		}

		$table = $this->input->post('table');
		$column = $this->input->post('uniqueNameCol');
		$value = $this->input->post('value');

		$re = $this->common_model->delete_item($table, $column, $value);
		if ($re) {

			$array_a = explode(",", $value);
			foreach ($array_a as $a) {

				$file = FPATH_BASE . "assets/images/subproducts/" . $a . "/";
				rrmdir($file);
			}
			echo 1;
		}
	}
}
