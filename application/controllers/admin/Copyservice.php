<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Copyservice extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
	}
	public function index()
	{
		$params["title"] = "Admin Login";
		$this->load->view('acceso/header', $params);
		$this->load->view('acceso/login');
		$this->load->view('acceso/footer');
	}

	public function home()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_products');
		$this->load->view('admin/footer');
	}
	public function change_contact_address()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$tbl_name = "exp_tbl_contact_address";
		$params["contact_array"] = $this->common_model->get_all_list($tbl_name);
		$params["title"] = "Edit Profile MyOnlinePrinting.net";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/contact/contact_page');
		$this->load->view('acceso/panel/footer');
	}

	public function list_contact_us()
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

		$tbl_name = "exp_tbl_contact";

		$total_rows = $this->common_model->get_all_list($tbl_name);

		$result = $this->common_model->get_all_list($tbl_name, PAGINATION_PER_PAGE_ADMIN, ($page - 1) * PAGINATION_PER_PAGE_ADMIN, "DESC", "id");
		$params["contacts"] = $result;

		$params["title"] = "Contact Us List";

		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/copyservice/list_contact_us";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/contact/contact_page_list');
		$this->load->view('acceso/panel/footer');
	}

	public function preview_contact()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$u_id = $this->uri->segment(4);

		$tbl_name = "exp_tbl_contact";
		$col = "id";
		$value = $u_id;
		$params['result'] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$params['title'] = "Preview Contact";
		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view('acceso/panel/contact/edit_contact');
		$this->load->view('acceso/panel/footer');
	}

	public function delete_contact()
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
			echo 1;
		}
	}


	public function update_contact_page()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}

		/************image **************/
		$banner01 = $_FILES["banner01"];
		$banner02 = $_FILES["banner02"];
		$banner03 = $_FILES["banner03"];
		/***************************** */
		if ($banner01["name"] != '') {
			$image_name01 = clean_filename($banner01["name"]);
			$image_name01 = time() . "_" . $image_name01;
		} else {
			$image_name01 = $this->input->post('old_image01');
		}
		/**/
		if ($banner02["name"] != '') {
			$image_name02 = clean_filename($banner02["name"]);
			$image_name02 = time() . "_" . $image_name02;
		} else {
			$image_name02 = $this->input->post('old_image02');
		}
		/**/
		if ($banner03["name"] != '') {
			$image_name03 = clean_filename($banner03["name"]);
			$image_name03 = time() . "_" . $image_name03;
		} else {
			$image_name03 = $this->input->post('old_image03');
		}
		/** */


		$contact_id = $this->input->post("contact_id");
		$tbl_name = "exp_tbl_contact_address";
		$data = array(
			"heading" => $this->input->post("heading"),
			"address" => $this->input->post("address"),
			"tel" => $this->input->post("tel"),
			"fax" => $this->input->post("fax"),
			"zip_code" => $this->input->post("zip_code"),
			"email" => $this->input->post("email"),
			"whastapp" => $this->input->post("whastapp"),
			"opening_hours" => $this->input->post("opening_hours"),
		);
		$cnd_arr = array(
			"id" => $contact_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			/** grabar banner 01 */
			if ($banner01["name"] != '') {
				if (!file_exists("assets/images/admin/publicidad/" . $contact_id)) {
					mkdir("assets/images/admin/publicidad/" . $contact_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/publicidad/" . $contact_id, DIR_WRITE_MODE);
				$dir01 = "assets/images/admin/publicidad/" . $contact_id;
				$image_path01 =  $dir01 . "/" . $image_name01;
				$imgFiles1 = glob("assets/images/admin/contact/" . $contact_id . "/*.*");
				foreach ($imgFiles1 as $img1) {
					@unlink($img1);
				}
				move_uploaded_file($banner01["tmp_name"], $image_path01);
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path01;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 849;
				$config['height'] = 227;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data_arr = array(
					"banner01" => $image_name01
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			/** */
			/** grabar banner 02 */
			if ($banner02["name"] != '') {
				if (!file_exists("assets/images/admin/publicidad/" . $contact_id)) {
					mkdir("assets/images/admin/publicidad/" . $contact_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/publicidad/" . $contact_id, DIR_WRITE_MODE);
				$dir02 = "assets/images/admin/publicidad/" . $contact_id;
				$image_path02 =  $dir02 . "/" . $image_name02;
				$imgFiles2 = glob("assets/images/admin/contact/" . $contact_id . "/*.*");
				foreach ($imgFiles2 as $img2) {
					@unlink($img2);
				}
				move_uploaded_file($banner02["tmp_name"], $image_path02);
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path02;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 264;
				$config['height'] = 444;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data_arr = array(
					"banner02" => $image_name02
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			/** */
			/** grabar banner 03 */
			if ($banner03["name"] != '') {
				if (!file_exists("assets/images/admin/publicidad/" . $contact_id)) {
					mkdir("assets/images/admin/publicidad/" . $contact_id, DIR_WRITE_MODE);
				}
				chmod("assets/images/admin/publicidad/" . $contact_id, DIR_WRITE_MODE);
				$dir03 = "assets/images/admin/publicidad/" . $contact_id;
				$image_path03 =  $dir03 . "/" . $image_name03;
				$imgFiles3 = glob("assets/images/admin/contact/" . $contact_id . "/*.*");
				foreach ($imgFiles3 as $img3) {
					@unlink($img3);
				}
				move_uploaded_file($banner03["tmp_name"], $image_path03);
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_path03;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'width';
				$config['width'] = 1141;
				$config['height'] = 200;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data_arr = array(
					"banner03" => $image_name03
				);
				$this->common_model->update_item_by_id($tbl_name, $data_arr, $cnd_arr);
			}
			/** */
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Contact Information  Updated successfully");
			redirect(base_url() . "admin/copyservice/change_contact_address");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/copyservice/change_contact_address");
		}
	}
}
