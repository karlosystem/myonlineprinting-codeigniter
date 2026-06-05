<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Right_sidebar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
	}




	public function edit_sidebar()
	{

		if (!$this->session->userdata("admin_id")) {
			redirect(base_url() . "admin");
			exit;
		}
		$id = $this->uri->segment(4);
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url() . 'ckeditor/';
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../ckfinder');
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$tbl_name = "exp_tbl_sidebar";
		$col = "id";
		$value = $id;
		$params["sidebar"] = $this->common_model->get_item_by_id($tbl_name, $col, $value);
		$params["title"] = "Edit Sidebar";

		$this->load->view('acceso/panel/header', $params);
		$this->load->view('acceso/panel/sidebar');
		$this->load->view("acceso/panel/sidebar/edit_sidebar");
		$this->load->view('acceso/panel/footer');
	}


	public function update_sidebar()
	{
		if (!$this->session->userdata('admin_id')) {
			redirect(base_url('admin/admin/login'));
			die;
		}
		$sidebar_id = $this->input->post("sidebar_id");
		$tbl_name = "exp_tbl_sidebar";
		$data = array(

			"sidebar_title" => $this->input->post("sidebar_title"),
			"sidebar_content" => $this->input->post("sidebar_content")

		);
		$cnd_arr = array(
			"id" => $sidebar_id
		);

		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if ($result) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "sidebar Updated successfully");
			redirect(base_url() . "admin/right_sidebar/edit_sidebar/" . $sidebar_id);
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "admin/right_sidebar/edit_sidebar/" . $sidebar_id);
		}
	}
}
