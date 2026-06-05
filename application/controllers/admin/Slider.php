<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
	}

	public function index()
	{
		$this->manage_main_slider();
	}

	public function manage_main_slider()
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
		#$extraparams = implode($extraparams, "&");
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if (empty($limit_start)) {
			$limit_start = 0;
		}

		$tbl_name = 'exp_tbl_main_slider';
		$total_rows = $this->common_model->get_all_list($tbl_name);
		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN);
		$params["title"] = "Manage Main Slider";
		$params["slider"] = $result;
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/slider";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/sliders/manage_main_slider');
		$this->load->view('acceso/panel/footer');
	}

	public function add_main_slider()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$this->load->library('CKEditor');
		$this->load->library('CKFinder');
		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		$this->ckeditor->config['width'] = '410px';
		$this->ckeditor->config['height'] = '180px';
		$this->ckeditor->config['toolbar'] = array(
			array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
		);
		//configure base path of ckeditor folder 
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');
		$params['title'] = "Add Slider";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/sliders/add_main_slider');
		$this->load->view('acceso/panel/footer');
	}


	public function save_main_slider()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$image = $_FILES["slider_image"];
		if ($image["error"] == UPLOAD_ERR_OK) {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
			if (!file_exists("assets/images/admin/main_slider_image")) {
				mkdir("assets/images/admin/main_slider_image", DIR_WRITE_MODE);
			}
		}
		$tbl_name = "exp_tbl_main_slider";
		$data = array(
			"banner_title" => $this->input->post("slider_name"),
			"banner_title_gray" => $this->input->post("slider_name_gray"),
			"banner_link" => $this->input->post("banner_link"),
			"banner_description" => $this->input->post("banner_description"),
			"banner_data-x-1" => $this->input->post("banner_data-x-1"),
			"banner_data-y-1" => $this->input->post("banner_data-y-1"),
			"banner_data-hoffset" => $this->input->post("banner_data-hoffset")
		);
		$resultado = $this->db->insert("exp_tbl_main_slider", $data);
		$slider_id = $this->db->insert_id();
		if ($resultado) {
			if ($image["name"] != '') {
				if (!file_exists("assets/images/admin/main_slider_image/" . $slider_id)) {
					mkdir("assets/images/admin/main_slider_image/" . $slider_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_slider_image/" . $slider_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/admin/main_slider_image/" . $slider_id . "/" . "/thumbs")) {
					mkdir("assets/images/admin/main_slider_image/" . $slider_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_slider_image/" . $slider_id . "/" . "/thumbs", DIR_WRITE_MODE);

				$dir = "assets/images/admin/main_slider_image/" . $slider_id;
				$image_path =  $dir . "/" . $image_name;
				$imgFiles1 = glob("assets/images/admin/main_slider_image/" . $slider_id . "/*.*");

				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("assets/images/admin/main_slider_image/" . $slider_id . "/thumbs/*.*");

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
				$config['width'] = 1920;
				$config['height'] = 598;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$data_arr = array(
					"banner_image" => $image_name

				);
				$cnd_arr = array(
					"banner_id" => $slider_id

				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Slider added successfully");
			redirect(base_url() . "admin/slider/add_main_slider");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/slider/add_main_slider");
		}
	}


	public function delete_main_slider()
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
				$file = FPATH_BASE . "assets/images/admin/main_slider_image/" . $a . "/";
				rrmdir($file);
			}
			echo 1;
		}
	}
	public function edit_main_slider()
	{

		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}

		$slider_id = $this->uri->segment(4);
		$tbl_name = "exp_tbl_main_slider";
		$col = "banner_id";
		$value = $slider_id;
		$params["slider"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$this->load->library('CKEditor');
		$this->load->library('CKFinder');

		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
		$this->ckeditor->config['language'] = 'es';
		$this->ckeditor->config['width'] = '380px';
		$this->ckeditor->config['height'] = '148px';
		$this->ckeditor->config['toolbar'] = array(
			array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
		);

		//configure base path of ckeditor folder 
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../assets/ckfinder/');

		$params["title"] = "Edit Slider";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/sliders/edit_main_slider');
		$this->load->view('acceso/panel/footer');
	}


	public function update_main_slider()
	{
		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}
		/************image **************/
		$image = $_FILES["slider_image"];
		//debug($image);die;		
		if ($image["name"] != '') {
			$image_name = clean_filename($image["name"]);
			$image_name = time() . "_" . $image_name;
		} else {
			$image_name = $this->input->post('old_image');
		}
		$tbl_name = "exp_tbl_main_slider";
		$slider_id = $this->input->post('slider_id');
		$data = array(
			"banner_title" => $this->input->post("slider_name"),
			"banner_title_gray" => $this->input->post("slider_name_gray"),
			"banner_link" => $this->input->post("banner_link"),
			"banner_description" => $this->input->post("banner_description"),
			"banner_data-x-1" => $this->input->post("banner_data-x-1"),
			"banner_data-y-1" => $this->input->post("banner_data-y-1"),
			"banner_data-hoffset" => $this->input->post("banner_data-hoffset")
		);
		$cnd_arr = array(
			"banner_id" => $slider_id
		);
		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			if ($image["name"] != '') {
				if (!file_exists("assets/images/admin/main_slider_image/" . $slider_id)) {
					mkdir("assets/images/admin/main_slider_image/" . $slider_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_slider_image/" . $slider_id, DIR_WRITE_MODE);

				if (!file_exists("assets/images/admin/main_slider_image/" . $slider_id . "/" . "/thumbs")) {
					mkdir("assets/images/admin/main_slider_image/" . $slider_id . "/" . "/thumbs", DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/main_slider_image/" . $slider_id . "/" . "/thumbs", DIR_WRITE_MODE);
				$dir = "assets/images/admin/main_slider_image/" . $slider_id;
				$image_path =  $dir . "/" . $image_name;
				$imgFiles1 = glob("assets/images/admin/main_slider_image/" . $slider_id . "/*.*");
				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				$imgFilesThumbs1 = glob("assets/images/admin/main_slider_image/" . $slider_id . "/thumbs/*.*");
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
				$config['width'] = 1920;
				$config['height'] = 598;
				$config['new_image'] = $dir . "/thumbs/" . $image_name;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data_arr = array(
					"banner_image" => $image_name
				);
				$cnd_arr = array(
					"banner_id" => $slider_id
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}

			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Slider added successfully");
			redirect(base_url() . "admin/slider/edit_main_slider/" . $slider_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/slider/edit_main_slider/" . $slider_id);
		}
	}
}
