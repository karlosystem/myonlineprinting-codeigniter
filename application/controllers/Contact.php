<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/common_model");
		$this->load->model("products_model");
	}

	public function index()
	{
		$this->load->library('recaptcha');
		$this->load->model("products_model");
		$data["title"] = "Contact Us";
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


		$this->load->view('template/header', $data);
		$this->load->view('template/contact');
		$this->load->view('template/footer');
	}

	public function save()
	{
		$tbl_name = "exp_tbl_contact";
		$data = array(
			"name" => $this->input->post("name"),
			"mobile" => $this->input->post("mobile"),
			"email" => $this->input->post("email"),
			"enquiry" => $this->input->post("enquiry"),

		);
		$name = $this->input->post("name");
		$user_email = $this->input->post("email");
		$description = $this->input->post("enquiry");
		$result = $this->common_model->insert_data($data, $tbl_name);
		$admin_email = $this->common_model->get_admin_detail();
		$ad_email = $admin_email['email'];

		$image = base_url() . 'assets/images/logo.png';

		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($user_email, "MyOnlinePrinting");
		$this->email->to($ad_email);
		$this->email->subject('Contact-us');

		$message = file_get_contents(base_url() . "/templetes/contact.html");
		$message = str_replace("[CUSTOMER_USERNAME]", $name, $message);
		$message = str_replace("[CUSTOMER_Email]", $user_email, $message);
		$message = str_replace("[DESCRIPTION]", $description, $message);
		$message = str_replace("[IMAGE_PATH]", $image, $message);
		//	echo $message; die;
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Your query has been sent..We will contact you soon.");
			redirect(base_url() . "contact");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "contact");
		}
	}
	public function upload_contact_file()
	{
		$data["title"] = "Contact Us & Upload File";
		$data['description_header_page'] = 'description Home';
		$data['keywords_header_page'] = 'keywords Home';
		$this->load->view('header', $data);
		$this->load->view('upload_contact_file');
		$this->load->view('footer');
	}

	public function save_upload_file()
	{
		$tbl_name = "exp_tbl_upload_contact_file";
		$file = $_FILES['u_file'];
		$u_file = $file['name'];
		$data = array(
			"uf_name" => $this->input->post("name"),
			"uf_tel" => $this->input->post("mobile"),
			"uf_email" => $this->input->post("email"),
			"uf_job_desc" => $this->input->post("job_desc"),
			"uf_file" => $u_file

		);
		$name = $this->input->post("name");
		$user_email = $this->input->post("email");
		$description = $this->input->post("job_desc");
		$file_id = $this->common_model->insert_upload_contact($data, $tbl_name);
		if ($file_id) {
			if (!file_exists('uploads')) {
				mkdir("uploads", DIR_WRITE_MODE);
			}
			@chmod("uploads", DIR_WRITE_MODE);

			if (!file_exists('uploads/file')) {
				mkdir("uploads/file", DIR_WRITE_MODE);
			}
			@chmod("uploads/file", DIR_WRITE_MODE);

			if (!file_exists('uploads/file/' . $file_id)) {
				mkdir("uploads/file/" . $file_id, DIR_WRITE_MODE);
			}
			@chmod("uploads/file/" . $file_id, DIR_WRITE_MODE);

			$dir = 'uploads/file/' . $file_id;
			$img_path = $dir . "/" . $file['name'];
			move_uploaded_file($file['tmp_name'], $img_path);
			$this->load->library('image_lib');
			@chmod("uploads", DIR_WRITE_MODE);
			$download = '<a href="' . base_url() . 'contact/download_file?file_id=' . $file_id . '&file=' . $u_file . '" >
									' . $u_file . '</a>';
			$admin_email = $this->common_model->get_admin_detail();
			$ad_email = $admin_email['email'];
			$image = base_url() . 'images/logo.png';
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($user_email, "My Online Printing-Contact");
			$this->email->to($ad_email);
			$this->email->subject('My Online Printing - Contact Us');
			$message = @file_get_contents(base_url() . "templetes/contact&upload.html");
			$message = str_replace("[CUSTOMER_USERNAME]", ucfirst($name), $message);
			$message = str_replace("[CUSTOMER_Email]", $user_email, $message);
			$message = str_replace("[Email]", $user_email, $message);
			$message = str_replace("[Name]", $this->input->post("name"), $message);
			$message = str_replace("[Mobile]", $this->input->post("mobile"), $message);
			$message = str_replace("[DESCRIPTION]", $description, $message);
			$message = str_replace("[IMAGE_PATH]", $image, $message);
			$message = str_replace("[FILE]", $download, $message);
			//	echo $message; die;
			$this->email->message($message);
			$this->email->send();
			$this->session->set_userdata("valid_box", "1");
			$this->session->set_userdata("success_message", "Thank You. File Uploaded Successfully.");
			redirect(base_url() . "contact/upload_contact_file");
		} else {
			$this->session->set_userdata("error_box", "1");
			$this->session->set_userdata("success_message", "Error occurred");
			redirect(base_url() . "contact/upload_contact_file");
		}
	}

	public function download_file()
	{
		$file_name = $_REQUEST["file"];
		$file_id = $_REQUEST["file_id"];
		$file = 'uploads/file/' . $file_id . '/' . $file_name;
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header("Content-Type: application/force-download");
			header('Content-Disposition: attachment; filename=' . urlencode(basename($file)));
			// header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
	}
}
