<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
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
		$tbl_name = 'exp_tbl_static_pages';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);
		$params["pages"] = $result;

		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/pages";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/pages/manage_pages');
		$this->load->view('acceso/panel/footer');
	}
	public function add_page()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$this->load->library('CKEditor');
		$this->load->library('CKFinder');

		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		$this->ckeditor->config['width'] = '510px';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['toolbar'] = array(
			array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
		);

		//configure base path of ckeditor folder 
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');
		$params['title'] = "Add Page";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/pages/add_page');
		$this->load->view('acceso/panel/footer');
	}
	public function save_page()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			exit;
		}

		$image = $_FILES["page_image"];
		if ($image["error"] == UPLOAD_ERR_OK) {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
			if (!file_exists("assets/images/admin/main_page_image")) {
				mkdir("assets/images/admin/main_page_image", DIR_WRITE_MODE);
			}
		}
		$tbl_name = "exp_tbl_static_pages";

		$data = array(
			"page_name" => $this->input->post("page_name"),
			"page_title" => $this->input->post("page_title"),
			"page_leyenda" => $this->input->post("page_leyenda"),
			"page_icono" => $this->input->post("page_icono"),
			"page_meta_title" => $this->input->post("page_meta_title"),
			"page_meta_description" => $this->input->post("page_meta_description"),
			"page_meta_keywords" => $this->input->post("page_meta_keywords"),
			"page_description" => $this->input->post("page_description"),
			"page_status" => (int)$this->input->post("page_status"),
			"page_portada" => (int)$this->input->post("page_portada")
		);
		$result = $this->common_model->insert_data($data, $tbl_name);
		$page_id = $this->db->insert_id();
		if ($result) {
			if ($image["name"] != '') {
				if (!file_exists("assets/images/admin/main_page_image/" . $page_id)) {
					mkdir("assets/images/admin/main_page_image/" . $page_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_page_image/" . $page_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/admin/main_page_image/" . $page_id . "/" . "/thumbs")) {
					mkdir("assets/images/admin/main_page_image/" . $page_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_page_image/" . $page_id . "/" . "/thumbs", DIR_WRITE_MODE);

				$dir = "assets/images/admin/main_page_image/" . $page_id;
				$image_path =  $dir . "/" . $image_name;
				$imgFiles1 = glob("assets/images/admin/main_page_image/" . $page_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("assets/images/admin/main_page_image/" . $page_id . "/thumbs/*.*");

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
				$config['width'] = 557;
				$config['height'] = 396;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$data_arr = array(
					"page_image" => $image_name
				);
				$cnd_arr = array(
					"page_id" => $page_id
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Page added successfully");
			redirect(base_url() . "admin/pages");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/pages");
		}
	}


	public function edit_page()
	{

		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}

		$page_id = $this->uri->segment(4);

		$this->load->library('CKEditor');
		$this->load->library('CKFinder');

		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		$this->ckeditor->config['width'] = '510px';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['toolbar'] = array(
			array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
		);

		//configure base path of ckeditor folder 
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');

		$tbl_name = "exp_tbl_static_pages";
		$col = "page_id";
		$value = $page_id;
		$params["page"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$params["title"] = "Edit Page";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/pages/edit_page');
		$this->load->view('acceso/panel/footer');
	}

	public function update_page()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			exit;
		}

		/************image **************/
		$image = $_FILES["page_image"];
		//debug($image);die;		
		if ($image["name"] != '') {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
		} else {
			$image_name = $this->input->post('old_image');
		}
		$tbl_name = "exp_tbl_static_pages";
		$page_id = $this->input->post("page_id");

		$data = array(
			"page_name" => $this->input->post("page_name"),
			"page_title" => $this->input->post("page_title"),
			"page_leyenda" => $this->input->post("page_leyenda"),
			"page_icono" => $this->input->post("page_icono"),
			"page_meta_title" => $this->input->post("page_meta_title"),
			"page_meta_description" => $this->input->post("page_meta_description"),
			"page_meta_keywords" => $this->input->post("page_meta_keywords"),
			"page_description" => $this->input->post("page_description"),
			"page_status" => (int)$this->input->post("page_status"),
			"page_portada" => (int)$this->input->post("page_portada")
		);
		$cnd_arr = array(
			"page_id" => $page_id
		);
		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			if ($image["name"] != '') {
				if (!file_exists("assets/images/admin/main_page_image/" . $page_id)) {
					mkdir("assets/images/admin/main_page_image/" . $page_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_page_image/" . $page_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/admin/main_page_image/" . $page_id . "/" . "/thumbs")) {
					mkdir("assets/images/admin/main_page_image/" . $page_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_page_image/" . $page_id . "/" . "/thumbs", DIR_WRITE_MODE);

				$dir = "assets/images/admin/main_page_image/" . $page_id;
				$image_path =  $dir . "/" . $image_name;
				$imgFiles1 = glob("assets/images/admin/main_page_image/" . $page_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("assets/images/admin/main_page_image/" . $page_id . "/thumbs/*.*");
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
				$config['width'] = 557;
				$config['height'] = 396;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data_arr = array(
					"page_image" => $image_name
				);
				$cnd_arr = array(
					"page_id" => $page_id
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Page Updated successfully");
			redirect(base_url() . "admin/pages/edit_page/" . $page_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/pages/edit_page/" . $page_id);
		}
	}
}
