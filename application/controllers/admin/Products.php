<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/products_model");
		$this->load->model("admin/common_model");
	}

	public function index()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		redirect(base_url() . 'admin/products/manage_products');
	}

	public function add_product()
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

		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$data['title'] = "Add Products";
		$this->load->view('acceso/panel/header', $data);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/products/add_product');
		$this->load->view('acceso/panel/footer');
	}


	public function save_product()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$image = $_FILES["p_image"];
		//debug($image);

		if ($image["error"] == UPLOAD_ERR_OK) {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
			if (!file_exists("assets/images/products")) {
				mkdir("assets/images/products", DIR_WRITE_MODE);
			}
		}
		$data = array(
			"p_name" => $this->input->post("p_name"),
			"p_order" => $this->input->post("p_order"),
			"p_discription" => $this->input->post("p_desc"),
			"p_about" => $this->input->post("p_about"),
			"p_paper_type" => $this->input->post("p_paper"),
			"p_trunaround" => $this->input->post("p_turnaround"),
			"p_free_artwork_guide" => $this->input->post("p_artwork"),
			"p_meta_title" => $this->input->post("p_metatitle"),
			"p_meta_description" => $this->input->post("p_metadescription"),
			"p_meta_keywords" => $this->input->post("p_metakeywords"),
			"p_destacado" => (int)$this->input->post("p_destacado"),
			"p_promocion" => (int)$this->input->post("p_promocion"),
			"date" => $this->input->post("p_date"),
		);
		$tbl_name = "exp_tbl_products";
		$result = $this->common_model->insert_data($data, $tbl_name);
		$p_id = $this->db->insert_id();

		// if ($result) {

		//uploading image
		if ($image["name"] != '') {
			if (!file_exists("assets/images/products/" . $p_id)) {
				mkdir("assets/images/products/" . $p_id, DIR_WRITE_MODE);
			}
			chmod("assets/images/products/" . $p_id, DIR_WRITE_MODE);

			if (!file_exists("assets/images/products/" . $p_id . "/" . "/thumbs")) {
				mkdir("assets/images/products/" . $p_id . "/" . "/thumbs", DIR_WRITE_MODE);
			}
			chmod("assets/images/products/" . $p_id . "/" . "/thumbs", DIR_WRITE_MODE);

			if (!file_exists("assets/images/products/" . $p_id . "/" . "/profile")) {
				mkdir("assets/images/products/" . $p_id . "/" . "/profile", DIR_WRITE_MODE);
			}
			chmod("assets/images/products/" . $p_id . "/" . "/profile", DIR_WRITE_MODE);

			$dir = "assets/images/products/" . $p_id;
			$image_path =  $dir . "/" . $image_name;
			$imgFiles1 = glob("assets/images/products/" . $p_id . "/*.*");
			foreach ($imgFiles1 as $img1) {
				@unlink($img1);
			}
			$imgFilesThumbs1 = glob("assets/images/products/" . $p_id . "/thumbs/*.*");
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
				"p_image" => $image_name
			);
			$cnd_arr = array(
				"p_id" => $p_id
			);
			$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
		}
		$this->session->set_userdata("valid_box", "1");
		$this->session->set_userdata("success_message", "Product added successfully");
		redirect(base_url() . "admin/products/add_product");
		// 	} else {
		// 		$this->session->set_userdata("error_box", "1");
		// 		$this->session->set_userdata("success_message", "Error occurred");
		// 		redirect(base_url() . "admin/products/add_product");
		// 	}
	}



	public function edit_product()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$this->load->library('CKEditor');
		$this->load->library('CKFinder');

		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');

		$p_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_products";
		$col = "p_id";
		$value = $p_id;
		$params['result'] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$params['title'] = "Edit Product";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/products/edit_products');
		$this->load->view('acceso/panel/footer');
	}

	public function update_product()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$image = $_FILES["p_image"];
		if ($image["name"] != '') {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
		} else {
			$image_name = $this->input->post('old_image');
		}
		$p_id = $this->input->post('p_id');
		$data = array(
			"p_name" => $this->input->post("p_name"),
			"p_order" => $this->input->post("p_order"),
			"p_discription" => $this->input->post("p_desc"),
			"p_about" => $this->input->post("p_about"),
			"p_paper_type" => $this->input->post("p_paper"),
			"p_trunaround" => $this->input->post("p_turnaround"),
			"p_free_artwork_guide" => $this->input->post("p_artwork"),
			"p_meta_title" => $this->input->post("p_metatitle"),
			"p_meta_description" => $this->input->post("p_metadescription"),
			"p_meta_keywords" => $this->input->post("p_metakeywords"),
			"p_destacado" => $this->input->post("p_destacado"),
			"p_promocion" => (int)$this->input->post("p_promocion"),
			"date" => (int)$this->input->post("p_date"),
		);

		$cnd_arr = array(
			"p_id" => $p_id
		);
		$tbl_name = "exp_tbl_products";
		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {

			if ($image["name"] != '') {
				//echo "sd";die;
				if (!file_exists("assets/images/products/" . $p_id)) {
					mkdir("assets/images/products/" . $p_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/products/" . $p_id . "/" . "/thumbs")) {
					mkdir("assets/images/products/" . $p_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_id . "/" . "/thumbs", DIR_WRITE_MODE);

				if (!file_exists("assets/images/products/" . $p_id . "/" . "/profile")) {
					mkdir("assets/images/products/" . $p_id . "/" . "/profile", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_id . "/" . "/profile", DIR_WRITE_MODE);

				$dir = "assets/images/products/" . $p_id;

				$image_path =  $dir . "/" . $image_name;

				$imgFiles1 = glob("assets/images/products/" . $p_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}

				$imgFilesThumbs1 = glob("assets/images/products/" . $subproduct_id . "/thumbs/*.*");

				foreach ($imgFilesThumbs1 as $thumbs1) {
					@unlink($thumbs1);
				}

				$imgFilesThumbs2 = glob("assets/images/products/" . $subproduct_id . "/profile/*.*");

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
					"p_image" => $image_name

				);
				$cnd_arr = array(
					"p_id" => $p_id

				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Product editted successfully");
			redirect(base_url() . "admin/products/edit_product/" . $p_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/products/edit_product/" . $p_id);
		}
	}

	public function delete_product()
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

		$this->common_model->delete_item($table, $column, $value);
	}



	public function manage_products()
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
		#$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$tbl_name = 'exp_tbl_products';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN, "ASC", "p_order");
		$params["products"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/products/manage_products";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["admin_main_link"] = "MANAGE_PRODUCTS";
		$params['title'] = "Manage Products";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/products/manage_products');
		$this->load->view('acceso/panel/footer');
	}

	public function manage_product_cat()
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
		$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$tbl_name = 'exp_tbl_products_cat';

		$products_cat = $this->common_model->get_all_list($tbl_name);

		$all_products_cat = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);


		$params["all_products_cat"] = $all_products_cat;
		$params["total_rows"] = count($products_cat);

		$params["url"] = base_url() . "admin/products/manage_product_cat";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "Manage Products Categories";
		$params["admin_main_link"] = "MANAGE_PRODUCTS";
		$this->load->view('admin/header', $params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_product_cat');
		$this->load->view('admin/footer');
	}


	public function add_product_cat()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$data['title'] = "Add New Product Catgeories";
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_product_cat');
		$this->load->view('admin/footer');
	}

	public function save_cat()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$tbl_name = 'exp_tbl_products_cat';
		$p_cat_name = $this->input->post('p_cat_name');
		$image = $_FILES["p_cat_image"];

		if ($image["error"] == UPLOAD_ERR_OK) {

			$image_name = clean_filename($image["name"]);

			$image_name = time() . "_" . $image_name;

			if (!file_exists("images/admin/category")) {
				mkdir("images/admin/category", DIR_WRITE_MODE);
			}
		}

		$data = array(
			'p_cat_name' => $this->input->post('p_cat_name'),
			'p_cat_description' => $this->input->post('p_cat_description'),
			'p_cat_about' => $this->input->post('p_cat_about'),
			'p_cat_paper' => $this->input->post('p_cat_paper'),
			'p_cat_turnaround' => $this->input->post('p_cat_turnaround'),
			'p_cat_artwork' => $this->input->post('p_cat_artwork'),
		);

		$status = $this->common_model->insert_data($data, $tbl_name);
		$cat_id = $this->db->insert_id();
		if ($status === true) {

			if ($image["name"] != '') {
				if (!file_exists("images/admin/category/" . $cat_id)) {
					mkdir("images/admin/category/" . $cat_id, DIR_WRITE_MODE);
				}
				chmod("images/admin/category/" . $cat_id, DIR_WRITE_MODE);

				if (!file_exists("images/admin/category/" . $cat_id . "/" . "/thumbs")) {
					mkdir("images/admin/category/" . $cat_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("images/admin/category/" . $cat_id . "/" . "/thumbs", DIR_WRITE_MODE);

				$dir = "images/admin/category/" . $cat_id;

				$image_path =  $dir . "/" . $image_name;

				$imgFiles1 = glob("images/admin/category/" . $cat_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("images/admin/category/" . $cat_id . "/thumbs/*.*");

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
				$config['width'] = 150;
				$config['height'] = 100;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$data_arr = array(
					"p_cat_image" => $image_name

				);
				$cnd_arr = array(
					"p_cat_id" => $cat_id

				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}

			$this->session->set_userdata("valid_box", '1');
			$this->session->set_userdata("success_message", "Product categories added successfully ");
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to add product categories");
		}

		redirect(base_url() . 'admin/products/manage_product_cat');
	}

	public function edit_p_cat()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_cat = $this->uri->segment("4");
		$tbl_name = 'exp_tbl_products_cat';
		$p_cat_id = 'p_cat_id';

		$data['product_cat'] = $this->common_model->get_item_by_id($tbl_name, $p_cat_id, $p_cat);
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$data['title'] = "Edit Product Catgeories";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/edit_product_cat');
		$this->load->view('admin/footer');
	}


	public function save_edit_cat()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_cat_id = $this->input->post('p_cat_id');
		$p_cat_name = $this->input->post('p_cat_name');


		$image = $_FILES["p_cat_image"];

		if ($image["name"] != '') {

			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
		} else {

			$image_name = $this->input->post('old_image');
			//debug($image_name);die;

		}

		$data_arr = array(
			'p_cat_name' => $this->input->post('p_cat_name'),
			'p_cat_description' => $this->input->post('p_cat_description'),
			'p_cat_about' => $this->input->post('p_cat_about'),
			'p_cat_paper' => $this->input->post('p_cat_paper'),
			'p_cat_turnaround' => $this->input->post('p_cat_turnaround'),
			'p_cat_artwork' => $this->input->post('p_cat_artwork'),
		);

		$cnd_arr = array(
			'p_cat_id' => $p_cat_id
		);


		$tbl_name = 'exp_tbl_products_cat';

		$status = $this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);

		if ($status) {


			if ($image["name"] != '') {


				if (!file_exists("images/admin/category/" . $p_cat_id)) {
					mkdir("images/admin/category/" . $p_cat_id, DIR_WRITE_MODE);
				}
				chmod("images/admin/category/" . $p_cat_id, DIR_WRITE_MODE);

				if (!file_exists("images/admin/category/" . $p_cat_id . "/" . "/thumbs")) {
					mkdir("images/admin/category/" . $p_cat_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("images/admin/category/" . $p_cat_id . "/" . "/thumbs", DIR_WRITE_MODE);

				$dir = "images/admin/category/" . $p_cat_id;

				$image_path =  $dir . "/" . $image_name;

				$imgFiles1 = glob("images/admin/category/" . $p_cat_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("images/admin/category/" . $p_cat_id . "/thumbs/*.*");

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
				$config['width'] = 150;
				$config['height'] = 110;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$data_arr = array(
					"p_cat_image" => $image_name

				);
				$cnd_arr = array(
					"p_cat_id" => $p_cat_id

				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}



			$this->session->set_userdata("valid_box", '1');
			$this->session->set_userdata("success_message", "Product categories update successfully.");
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to update product categories.");
		}

		redirect(base_url() . 'admin/products/manage_product_cat');
	}

	public function check_duplicate_p_cat()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$p_cat_id = $this->input->post('p_cat_id');
		$p_cat_name = $this->input->post('p_cat_name');
		$status = $this->products_model->check_duplicate_cat_name($p_cat_name, $p_cat_id);
		if ($status <=  0) {
			echo "ok";
		} else {
			echo "exist";
		}
		die;
	}


	public function manage_product_attribute()
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
		$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$products_attribute = $this->products_model->get_all_products_attribute();

		$all_products_attribute = $this->products_model->get_all_products_attribute(PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);

		$params["all_products_attribute"] = $all_products_attribute;
		$params["total_rows"] = count($products_attribute);

		$params["url"] = base_url() . "admin/products/manage_product_attribute";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "Manage Products Attribute";
		$params["admin_main_link"] = "MANAGE_PRODUCTS";
		$this->load->view('admin/header', $params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_product_attribute');
		$this->load->view('admin/footer');
	}

	public function add_product_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$tbl_name = 'exp_tbl_products_cat';
		$data['all_products_cat'] = $this->common_model->get_all_list($tbl_name);
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$data['title'] = "Add New Product Attribute";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_product_attribute');
		$this->load->view('admin/footer');
	}


	public function save_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		//debug($_POST);
		//die;

		$image = $_FILES["p_a_image"];
		$image_name = "";
		if ($image["error"] == UPLOAD_ERR_OK) {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
			if (!file_exists("assets/images/products")) {
				mkdir("assets/images/products", DIR_WRITE_MODE);
			}
			chmod("assets/images/products", DIR_WRITE_MODE);
		}

		$tbl_name = 'exp_tbl_products_attribute';
		$p_a_name = $this->input->post('p_a_name');
		$p_c_id = $this->input->post('p_cat_id');
		$color_side = $this->input->post('color_side');
		$p_turnaround = $this->input->post('p_turnaround');

		$data = array(
			'p_a_type' => $p_a_name,
			'p_c_id' => $p_c_id,
			'p_a_image' => $image_name,
			'p_a_about' => $this->input->post('p_a_about'),
			'p_a_print_status' => $color_side,
			'p_a_turnaround_status' => $p_turnaround,
			'p_a_status' => '1'
		);


		$status = $this->common_model->insert_data($data, $tbl_name);

		$p_a_id = $this->db->insert_id();

		if ($status === true) {
			if ($image["error"] == UPLOAD_ERR_OK) {

				if (!file_exists("assets/images/products/" . $p_a_id)) {
					mkdir("assets/images/products/" . $p_a_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id, DIR_WRITE_MODE);


				if (!file_exists("assets/images/products/" . $p_a_id . "/thumbs")) {
					mkdir("assets/images/products/" . $p_a_id . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id . "/thumbs", DIR_WRITE_MODE);

				if (!file_exists("assets/images/products/" . $p_a_id . "/big")) {
					mkdir("assets/images/products/" . $p_a_id . "/big", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id . "/big", DIR_WRITE_MODE);

				if (!file_exists("assets/images/products/" . $p_a_id . "/profile")) {
					mkdir("assets/images/products/" . $p_a_id . "/profile", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id . "/profile", DIR_WRITE_MODE);

				$dir = "assets/images/products/" . $p_a_id;

				$image_path =  $dir . "/" . $image_name;

				move_uploaded_file($image["tmp_name"], $image_path);

				$this->load->library('image_lib');

				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 150;
				$config['height'] = 110;

				$config['new_image'] = $dir . "/thumbs/" . $image_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();

				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 218;
				$config['height'] = 146;

				$config['new_image'] = $dir . "/big/" . $image_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();

				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 376;
				$config['height'] = 280;

				$config['new_image'] = $dir . "/profile/" . $image_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->session->set_userdata("valid_box", '1');
				$this->session->set_userdata("success_message", "Product attribute added successfully ");
			}
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to add product attribute");
		}

		redirect(base_url() . 'admin/products/manage_product_attribute');
	}

	public function edit_p_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_a_id = $this->uri->segment("4");
		$tbl_name = 'exp_tbl_products_cat';
		$data['all_products_cat'] = $this->common_model->get_all_list($tbl_name);
		$data['product_cat'] = $this->products_model->get_products_attribute_with_id($p_a_id);
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$data['title'] = "Edit Product Attribute";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/edit_product_attribute');
		$this->load->view('admin/footer');
	}


	public function save_edit_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$old_a_image = $this->input->post('old_a_image');


		$image = $_FILES["p_a_image"];
		$image_name = "";

		if ($image["error"] == UPLOAD_ERR_OK) {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
			if (!file_exists("assets/images/products")) {
				mkdir("assets/images/products", DIR_WRITE_MODE);
			}
			chmod("assets/images/products", DIR_WRITE_MODE);
		} else {
			$image_name = $old_a_image;
		}

		$p_a_name = $this->input->post('p_a_name');
		$p_c_id = $this->input->post('p_cat_id');
		$p_a_id = $this->input->post('p_a_id');
		$color_side = $this->input->post('color_side');

		$data_arr = array(
			'p_a_type' => $p_a_name,
			'p_c_id' => $p_c_id,
			'p_a_image' => $image_name,
			'p_a_about' => $this->input->post('p_a_about'),
			'p_a_print_status' => $color_side
		);


		$cnd_arr = array(
			'p_a_id' => $p_a_id
		);

		$tbl_name = 'exp_tbl_products_attribute';

		$status = $this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);

		if ($status === true) {

			if ($image["error"] == UPLOAD_ERR_OK) {

				if (!file_exists("assets/images/products/" . $p_a_id)) {
					mkdir("assets/images/products/" . $p_a_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id, DIR_WRITE_MODE);


				if (!file_exists("assets/images/products/" . $p_a_id . "/thumbs")) {
					mkdir("assets/images/products/" . $p_a_id . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id . "/thumbs", DIR_WRITE_MODE);

				if (!file_exists("assets/images/products/" . $p_a_id . "/big")) {
					mkdir("assets/images/products/" . $p_a_id . "/big", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id . "/big", DIR_WRITE_MODE);

				if (!file_exists("assets/images/products/" . $p_a_id . "/profile")) {
					mkdir("assets/images/products/" . $p_a_id . "/profile", DIR_WRITE_MODE);
				}
				chmod("assets/images/products/" . $p_a_id . "/profile", DIR_WRITE_MODE);

				$dir = "assets/images/products/" . $p_a_id;

				$image_path =  $dir . "/" . $image_name;


				$imgFiles = glob("assets/images/products/" . $p_a_id . "/*.*");

				foreach ($imgFiles as $img) {
					@unlink($img);
				}

				$imgFiles = glob("assets/images/products/" . $p_a_id . "/thumbs/*.*");

				foreach ($imgFiles as $img) {
					@unlink($img);
				}

				$imgFiles = glob("assets/images/products/" . $p_a_id . "/profile/*.*");

				foreach ($imgFiles as $img) {
					@unlink($img);
				}


				$imgFiles = glob("assets/images/products/" . $p_a_id . "/big/*.*");

				foreach ($imgFiles as $img) {
					@unlink($img);
				}

				move_uploaded_file($image["tmp_name"], $image_path);

				$this->load->library('image_lib');

				move_uploaded_file($image["tmp_name"], $image_path);

				$this->load->library('image_lib');

				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 150;
				$config['height'] = 110;

				$config['new_image'] = $dir . "/thumbs/" . $image_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();

				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 218;
				$config['height'] = 146;

				$config['new_image'] = $dir . "/big/" . $image_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();

				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 376;
				$config['height'] = 280;

				$config['new_image'] = $dir . "/profile/" . $image_name;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->session->set_userdata("valid_box", '1');
				$this->session->set_userdata("success_message", "Product attribute update successfully ");
			} else {
				$this->session->set_userdata("valid_box", '1');
				$this->session->set_userdata("success_message", "Product attribute update successfully.");
			}
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to update product attribute.");
		}

		redirect(base_url() . 'admin/products/manage_product_attribute');
	}

	public function check_duplicate_p_attribute()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$p_cat_id = $this->input->post('p_cat_id');
		$p_a_name = $this->input->post('p_a_name');
		$p_a_id = $this->input->post('p_a_id');
		$status = $this->products_model->check_duplicate_attribute_name($p_a_name, $p_a_id, $p_cat_id);
		if ($status <=  0) {
			echo "ok";
		} else {
			echo "exist";
		}
		die;
	}

	public function manage_product_qty_option()
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
		$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$products_qty = $this->products_model->get_all_products_qty_option();

		$all_products_qty = $this->products_model->get_all_products_qty_option(PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);

		$params["all_products_qty"] = $all_products_qty;
		$params["total_rows"] = count($products_qty);

		$params["url"] = base_url() . "admin/products/manage_product_qty_option";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "Manage Products Qty Option";
		$params["admin_main_link"] = "MANAGE_PRODUCTS";
		$this->load->view('admin/header', $params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_product_qty');
		$this->load->view('admin/footer');
	}

	public function add_product_qty_option()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$data['title'] = "Add New Product Qty Option";
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$tbl_name = 'exp_tbl_products_cat';
		$data['all_products_cat'] = $this->common_model->get_all_list($tbl_name);
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_product_qty_option');
		$this->load->view('admin/footer');
	}

	public function save_qty_option()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$tbl_name = 'exp_tbl_products_qty_option';
		$p_qty_name = $this->input->post('p_qty_name');
		$p_cat_id = $this->input->post('p_cat_id');
		$data = array(
			'p_qty_option_name' => $p_qty_name,
			'p_qty_cat_id' => $p_cat_id
		);

		$status = $this->common_model->insert_data($data, $tbl_name);

		if ($status === true) {
			$this->session->set_userdata("valid_box", '1');
			$this->session->set_userdata("success_message", "Product qty option added successfully ");
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to add qty option categories");
		}

		redirect(base_url() . 'admin/products/manage_product_qty_option');
	}


	public function edit_p_qty_option()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_qty_option_id  = $this->uri->segment("4");
		$tbl_name = 'exp_tbl_products_attribute';
		$data['all_products_cat'] = $this->common_model->get_all_list($tbl_name);
		$data['product_cat'] = $this->products_model->get_products_qty_option_with_id($p_qty_option_id);
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$data['title'] = "Edit Product Qty Option";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/edit_product_qty_option');
		$this->load->view('admin/footer');
	}

	public function save_edit_qty_option()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_qty_name = $this->input->post('p_qty_name');
		$p_c_id = $this->input->post('p_cat_id');
		$p_qty_option_id = $this->input->post('p_qty_option_id');
		$color_side = $this->input->post('color_side');

		$data_arr = array(
			'p_qty_option_name' => $p_qty_name,
			'p_qty_cat_id' => $p_c_id
		);


		$cnd_arr = array(
			'p_qty_option_id' => $p_qty_option_id
		);

		$tbl_name = 'exp_tbl_products_qty_option';

		$status = $this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);

		if ($status === true) {
			$this->session->set_userdata("valid_box", '1');
			$this->session->set_userdata("success_message", "Product attribute update successfully ");
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to update product attribute.");
		}

		redirect(base_url() . 'admin/products/manage_product_qty_option');
	}

	public function check_duplicate_p_qty_option()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$p_cat_id = $this->input->post('p_cat_id');
		$p_qty_name = $this->input->post('p_qty_name');
		$p_qty_option_id = $this->input->post('p_qty_option_id');
		$status = $this->products_model->check_duplicate_qty_option($p_qty_name, $p_qty_option_id, $p_cat_id);
		if ($status <=  0) {
			echo "ok";
		} else {
			echo "exist";
		}
		die;
	}


	public function manage_product_qty_option_price()
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
		$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$products_qty_price = $this->products_model->get_all_products_qty_option_price();

		$all_products_qty_price = $this->products_model->get_all_products_qty_option_price(PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);

		$params["all_products_qty_pric"] = $all_products_qty_price;
		$params["total_rows"] = count($products_qty_price);

		$params["url"] = base_url() . "admin/products/manage_product_qty_option_price";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		$params["title"] = "Manage Products Qty Option Price";
		$params["admin_main_link"] = "MANAGE_PRODUCTS";
		$this->load->view('admin/header', $params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_product_qty_price');
		$this->load->view('admin/footer');
	}

	public function add_product_qty_option_price()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$data['title'] = "Add New Product Qty Option Price";
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$tbl_name = 'exp_tbl_products_cat';
		$data['all_products_cat'] = $this->common_model->get_all_list($tbl_name);


		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_product_qty_option_price');
		$this->load->view('admin/footer');
	}


	public function get_all_attribute()
	{

		$p_c_id = $this->input->post("p_c_id");
		$all_attributes = $this->products_model->get_all_attributes($p_c_id);

		$str = "";


		$str .= "
								<select class='slctfield_search' id='p_a_type' name='p_a_type' onchange='get_other_attibute(this.value,$p_c_id);' >
									<option value=''>Please Select</option>";
		foreach ($all_attributes as $val) {
			$str .= "<option value='" . $val['p_a_id'] . "' >" . $val['p_a_type'] . "</option>";
		}
		$str .= "</select>
							
						";

		echo $str;
	}

	public function get_other_attribute()
	{

		$p_a_id = $this->input->post("p_a_id");
		$p_c_id = $this->input->post("p_c_id");

		$all_other_attributes = $this->products_model->get_other_attributes($p_a_id);
		$all_all_qty = $this->products_model->get_all_qty($p_c_id);

		$str = "";
		$str1 = "";
		$str2 = "";
		$str3 = "";
		$str1 .= "
								<select class='slctfield_search' id='p_turnaround' name='p_turnaround' >
									<option value=''>Please Select</option>";
		if ($all_other_attributes['p_a_turnaround_status'] == '3') {
			$str1 .= "<option value='1' >48 Hour Dispatch</option>";
			$str1 .= "<option value='2' >5 Day Dispatch (SAVE 10%)</option>";
		} else if ($all_other_attributes['p_a_turnaround_status'] == '2') {
			$str1 .= "<option value='2' >5 Day Dispatch (SAVE 10%)</option>";
		} else if ($all_other_attributes['p_a_turnaround_status'] == '1') {
			$str1 .= "<option value='1' >48 Hour Dispatch</option>";
		}
		$str1 .= "	</select>";

		$str2 .= "<select class='slctfield_search' id='p_color' name='p_color' >
									<option value=''>Please Select</option>";
		if ($all_other_attributes['p_a_print_status'] == '3') {
			$str2 .= "<option value='1' >Full Colour 1 Side</option>";
			$str2 .= "<option value='2' >Full Colour 2 Side</option>";
		} else if ($all_other_attributes['p_a_print_status'] == '2') {
			$str2 .= "<option value='2' >Full Colour 2 Side</option>";
		} else if ($all_other_attributes['p_a_print_status'] == '1') {
			$str2 .= "<option value='1' >Full Colour 1 Side</option>";
		}
		$str2 .= "	</select>";

		$str3 .= "<select class='slctfield_search' id='p_o_qty' name='p_o_qty' >
									<option value=''>Please Select</option>";
		foreach ($all_all_qty as $val) {
			$str3 .= "<option value='" . $val['p_qty_option_id'] . "' >" . $val['p_qty_option_name'] . "</option>";
		}
		$str3 .= "	</select>";

		echo $str = $str1 . '~' . $str2 . '~' . $str3;
	}
	public function save_attribute_qty_price()
	{

		$p_cat_id = $this->input->post("p_cat_id");
		$p_a_type = $this->input->post("p_a_type");
		$p_turnaround = $this->input->post("p_turnaround");
		$p_color = $this->input->post("p_color");
		$p_o_qty = $this->input->post("p_o_qty");
		$p_qty = $this->input->post("p_qty");
		$p_price = $this->input->post("p_price");
		$tbl_name = 'exp_tbl_products_qty_price';
		$data = array(
			'p_price_cat_id' => $p_cat_id,
			'p_q_atr_id' => $p_a_type,
			'p_turnaround' => $p_turnaround,
			'p_color' => $p_color,
			'p_qty_option_id' => $p_o_qty,
			'p_qty' => $p_qty,
			'p_price' => $p_price
		);


		$status = $this->common_model->insert_data($data, $tbl_name);



		if ($status) {
			echo "ok";
		} else {
			echo "exist";
		}
		die;
	}


	public function edit_p_qty_option_price()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_qty_option_price_id  = $this->uri->segment("4");
		$all_products_cat = $this->products_model->get_all_products_qty_option_price_with_id($p_qty_option_price_id);

		$p_price_cat_id = $all_products_cat['p_q_atr_id'];
		$tbl_name = 'exp_tbl_products_attribute';
		$p_a_id = 'p_a_id';
		$data['all_attribute'] = $this->common_model->get_item_by_ids($tbl_name, $p_a_id, $p_price_cat_id);

		$p_qty_option_id 	 = $all_products_cat['p_qty_option_id'];
		$tbl_name1 = 'exp_tbl_products_qty_option';
		$p_qty_id 	 = 'p_qty_option_id';
		$data['all_qty'] = $this->common_model->get_item_by_ids($tbl_name1, $p_qty_id, $p_qty_option_id);

		//debug($data['all_qty']);

		$tbl_name = 'exp_tbl_products_cat';
		$data['products_cat'] = $this->common_model->get_all_list($tbl_name);
		$data['all_products_cat'] = $all_products_cat;
		$data["admin_main_link"] = "MANAGE_PRODUCTS";
		$data['title'] = "Edit Product Qty Option Price";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/edit_product_qty_option_price');
		$this->load->view('admin/footer');
	}


	public function save_edit_qty_price()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		$p_qty_price_id = $this->input->post('p_qty_price_id');
		$p_cat_id = $this->input->post('p_cat_id');
		$p_a_type = $this->input->post('p_a_type');
		$p_turnaround = $this->input->post('p_turnaround');
		$p_color = $this->input->post('p_color');
		$p_qty = $this->input->post('p_qty');
		$p_price = $this->input->post('p_price');
		$p_o_qty = $this->input->post('p_o_qty');

		$data_arr = array(
			'p_q_atr_id' => $p_a_type,
			'p_price_cat_id' => $p_cat_id,
			'p_turnaround' => $p_turnaround,
			'p_color' => $p_color,
			'p_qty' => $p_qty,
			'p_qty' => $p_qty,
			'p_qty_option_id' => $p_o_qty
		);


		$cnd_arr = array(
			'p_qty_price_id' => $p_qty_price_id
		);

		$tbl_name = 'exp_tbl_products_qty_price';

		$status = $this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);

		if ($status === true) {
			$this->session->set_userdata("valid_box", '1');
			$this->session->set_userdata("success_message", "Product attribute qty price update successfully ");
		} else {
			$this->session->set_userdata("error_box", '0');
			$this->session->set_userdata("success_message", "Error to update product attribute qty price.");
		}

		redirect(base_url() . 'admin/products/manage_product_qty_option_price');
	}
}
