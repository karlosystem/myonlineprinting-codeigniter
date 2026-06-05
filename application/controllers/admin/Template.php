<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends CI_Controller {

	
	public function __construct() {
			parent::__construct();
			$this->load->model("admin/common_model");
			$this->load->model("admin/template_model");
			$this->load->model("admin/admin_model");
			$this->load->model("admin/assign_attribute_model");
	}	
	public function manage_template_options()
	{
		$params["title"] = "Template Options";
		$params["all_template_option_name"] = $this->template_model->all_template_option_name();
		$this->load->view('admin/header',$params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_template_options');
		$this->load->view('admin/footer');
	}
	
	public function add_template_options()
	{
		$params["title"] = "Add Template Options";
		$this->load->view('admin/header',$params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_template_options');
		$this->load->view('admin/footer');
	}
	
	public function save_template_option()
	{
			$tbl_name='exp_tbl_template_options';
			$opt_name=$this->input->post('template_option_name');
			$check_template_option_name=$this->template_model->check_template_option_name($opt_name);
			if($check_template_option_name>0)
			{
					$this->session->set_userdata('check_success','Template option name is already exists. Choose another one.');
					redirect("admin/template/add_template_options");
					
			
			}
			
			$data=array(
										'template_option_name' => $this->input->post('template_option_name')
								);
			$res=$this->template_model->save_template_option($data,$tbl_name);
			if($res){
						$this->session->set_userdata('add_success','Template option name has been added added successfully.');
						redirect("admin/template/manage_template_options");
			}
	
	}
	
	public function edit_option_name()
	{
			if ( !$this->session->userdata("admin_id") ) {
			redirect(base_url()."admin");
			exit;
		}
		
		$tmp_id = $this->uri->segment(4);
	
		
		
		$tbl_name="exp_tbl_template_options";
		$col="template_option_id";
		$value=$tmp_id;
		$params["templete_detail"] = $this->common_model->get_item_by_id($tbl_name,$col,$value);
		
		$params["title"] = "Edit Templete Option";

		$this->load->view("admin/header", $params);
		$this->load->view("admin/sidebar");
		$this->load->view("admin/edit_templete_option");
		$this->load->view("admin/footer");
	
	}
	public function update_templete_option()
	{
			if(!$this->session->userdata('admin_id'))
		{
			redirect( base_url('admin/admin/login'));
			die;
		}
		$templete_id=$this->input->post("templete_id");
		$tbl_name="exp_tbl_template_options";
		
		$data=array(
			
			"template_option_name"=>$this->input->post("template_option_name"),
			
		
		);
		$cnd_arr=array(
			"template_option_id"=>$templete_id
		);
		
		$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
		if($result)
		{
			$this->session->set_userdata("valid_box","1");
			$this->session->set_userdata("success_message","Templete Option Updated successfully");
			redirect(base_url()."admin/template/edit_option_name/".$templete_id);
		
		}
		else
		{
			$this->session->set_userdata("error_box","1");
			$this->session->set_userdata("success_message","Error occurred");
			redirect(base_url()."admin/template/edit_option_name/".$templete_id);
		
		}
	
	}
	public function manage_template_options_attributes()
	{
		$params["title"] = "Template Options Attributes";
		$params["all_template_option_attributes"] = $this->template_model->all_template_option_attributes();
		$this->load->view('admin/header',$params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_template_options_attributes');
		$this->load->view('admin/footer');
	
	}
	
	public function add_template_options_attributes()
	{
		$params["title"] = "Add Template Options Attributes";
		$params["get_all_option_name"] = $this->template_model->all_template_option_name();
		$this->load->view('admin/header',$params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_template_options_attributes');
		$this->load->view('admin/footer');
	
	}
	
	public function save_template_option_attributes()
	{
			$tbl_name='exp_tbl_template_options_attributes';
			// $opt_name=$this->input->post('template_option_name');
			// $check_template_option_name=$this->template_model->check_template_option_name($opt_name);
			// if($check_template_option_name>0)
			// {
					// $this->session->set_userdata('check_success','Template option name is already exists. Choose another one.');
					// redirect("admin/template/add_template_options");
					
			
			// }
			
			$data=array(
										'template_opt_id' => $this->input->post('template_option_id'),
										'template_turnaroundtime' => $this->input->post('turnaround_time'),
										'template_quantity' => $this->input->post('qty'),
										'price' => $this->input->post('price')
								);
			$res=$this->template_model->save_template_option_attributes($data,$tbl_name);
			if($res){
						$this->session->set_userdata('add_att_success','Template option Attribute name has been added added successfully.');
						redirect("admin/template/manage_template_options_attributes");
			}
			
	
	}
	
	public function add_turnaroundtime()
	{
		$params["title"] = "Add Turnaround Time";
		$params["get_all_option_name"] = $this->template_model->all_template_option_name();
		$this->load->view('admin/header',$params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/add_turnaroundtime');
		$this->load->view('admin/footer');
	
	}
	

	
	public function get_turnaroud_time()
	{
			$opt_id=$this->input->post('option_id');
			$res=$this->template_model->get_turnaroud_time($opt_id);
			$str='';
			$str .='<select name="turnaround_time" id="turnaround_time"  class="input-xlarge text">';
			$str .='<option value=""> Select Turnaround Time</option>';
			if($res)
			{
							foreach($res as $r)
							{
									$str .='<option value="'.$r['turn_time_id'].'">'.$r['turnaroundtime'].'</option>';
							}
			}
			else {
								$str .='';
			}
			$str .='</select>';
			
			echo $str;
	}
	public function edit_option_attributes()
	{
				 $attrib_id=$this->uri->segment(4);
			

					$tbl_name="exp_tbl_template_options_attributes";
					$col="template_option_attribute_id";
					$value=$attrib_id;
					$params["templete_attribute"] = $this->common_model->get_item_by_id($tbl_name,$col,$value);
					
					$params["title"] = "Edit Templete attribute";

					$this->load->view("admin/header", $params);
					$this->load->view("admin/sidebar");
					$this->load->view("admin/edit_templete_option_attribute");
					$this->load->view("admin/footer");
	

	}
	public function update_templete_attributes()
	{
		

					if(!$this->session->userdata('admin_id'))
					{
						redirect( base_url('admin/admin/login'));
						die;
					}

					$attrib_id=$this->input->post("attrib_id");
					$tbl_name="exp_tbl_template_options_attributes";
					$data=array(
						"template_opt_id"=>$this->input->post("option_id"),
						"template_turnaroundtime"=>$this->input->post("turnaround_id"),
						"template_quantity"=>$this->input->post("quantity"),
						"price"=>$this->input->post("price"),
		
					);

					$cnd_arr=array(
						"template_option_attribute_id"=>	$attrib_id
					);
		
					$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);
					if($result)
						{
							$this->session->set_userdata("valid_box","1");
							$this->session->set_userdata("success_message","Templete option attribute  Updated successfully");
							redirect(base_url()."admin/template/edit_option_attributes/".$attrib_id);
		
					}
					else
					{
							$this->session->set_userdata("error_box","1");
							$this->session->set_userdata("success_message","Error occurred");
							redirect(base_url()."admin/template/edit_option_attributes/".$attrib_id);
		
					}

	}
	public function manage_turnaround_time()
	{
			if(!$this->session->userdata('admin_id'))
		{
			redirect( base_url('admin/admin/login'));
			die;
		}
		//code for pagination
		$extraparams = "&" . $_SERVER["QUERY_STRING"];
		$extraparams = explode("&", $extraparams);
		foreach( $extraparams as $key => $pp ) {
			$temp = explode("=", $pp);
			if ($temp[0] == "page") 
			{
				unset($extraparams[$key]);
			}
		}
		$extraparams = implode($extraparams, "&");
		$page = isset( $_GET["page"] ) ? $_GET["page"] : 1;
		$limit_start = $this->uri->segment(4);
		if ( empty($limit_start) ) {
			$limit_start = 0;
		}
		
		$tbl_name='exp_tbl_turnaround_time';
	
	
		$total_rows = $this->common_model->get_all_list($tbl_name);

		$result = $this->common_model->get_all_list($tbl_name,PAGINATION_PER_PAGE_ADMIN, ($page - 1)*PAGINATION_PER_PAGE_ADMIN);


		$params["turnaround_array"] = $result;
		
		$params["total_rows"] = count($total_rows);
		$params["url"] = base_url() . "admin/pages";
		$params["limit"] = PAGINATION_PER_PAGE_ADMIN;
		$params["page"] = $page;
		$params["extraparams"] = $extraparams;
		
		$params["title"] = "Manage Turnarounds";

		$this->load->view('admin/header',$params);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/manage_turnaround_time');
		$this->load->view('admin/footer');
	}
	public function save_turnaround_time()
	{
			$tbl_name='exp_tbl_turnaround_time';
			$data=array(
										'template_optn_id' =>$this->input->post('template_option_id'),
										'turnaroundtime' =>$this->input->post('turnaround_time')
									);
									
			$res=$this->template_model->save_turnaround_time($data,$tbl_name);
			if($res){
						$this->session->set_userdata('add_turn_success','Turnaround Time has been added added successfully.');
						redirect("admin/template/manage_turnaround_time");
			}						
			
	
	}
	public function edit_turnaround()
	{
		if ( !$this->session->userdata("admin_id") ) {
			redirect(base_url()."admin");
			exit;
		}
		
		$id = $this->uri->segment(4);
	
		
	
		$tbl_name="exp_tbl_turnaround_time";
		$col="turn_time_id";
		$value=$id;
		$params["turnaround"] = $this->common_model->get_item_by_id($tbl_name,$col,$value);
		
		$params["title"] = "Edit Turnaround";

		$this->load->view("admin/header", $params);
		$this->load->view("admin/sidebar");
		$this->load->view("admin/edit_turnaround");
		$this->load->view("admin/footer");

	}

		public function update_turnaround_time()
		{
						if(!$this->session->userdata('admin_id'))
						{
										redirect( base_url('admin/admin/login'));
										die;
						}					
						$id=$this->input->post("turn_time_id");

						$data=array(
								"template_optn_id"=>$this->input->post("template_option_id"),
								"turnaroundtime"=>$this->input->post("turnaround_name")
						);
					
					
						$tbl_name="exp_tbl_turnaround_time";
						
						$cnd_arr=array(
							"turn_time_id"=>$id
						);
		
						$result = $this->common_model->update_item_by_id($tbl_name, $data, $cnd_arr);

						if($result)
						{
								$this->session->set_userdata("valid_box","1");
								$this->session->set_userdata("success_message","Turnaround Updated successfully");
								redirect(base_url()."admin/template/edit_turnaround/".$id);
		
						}
						else
						{
								$this->session->set_userdata("error_box","1");
								$this->session->set_userdata("success_message","Error occurred");
								redirect(base_url()."admin/template/edit_turnaround/".$id);
		
						}
		}
		
		public function check_duplicate_turnaround()
		{
						$option_id=$this->input->post("option_id");
						$turnaround=$this->input->post("turnaround");
					
						$result = $this->template_model->check_duplicate_turnaround($option_id);
						//debug($result);
						if($result)
						{
								echo 1;
						}
						else {
								echo 0;
						}
		}
		
		public function edit_template()
		{
			
			$params["title"] = "Edit Template";
			$this->load->view("admin/header", $params);
			
			$this->load->view("admin/edit_template");
			$this->load->view("admin/footer");
			
		}

}
