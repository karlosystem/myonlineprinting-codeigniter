<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dynamic_dropdown extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("admin/common_model");
			
		}	
		public function index()
		{
			
		}
		public function get_subproducts()
		{
			$p_id=$this->input->post("p_id");
			$tbl_name="exp_tbl_sub_products";
			$col="p_id";
			$value= $p_id;
		 
		 $result = $this->common_model->get_result_array_by_id($tbl_name, $col,$value);
		// debug($result);
		 $str="";
		 if($result)
		 {
				foreach($result as $a)
				{
					$str.='<option value='.$a['sp_id'].'>'.$a['sp_name'].'</option>';
				}
				 
		 }
		 else{
				$str.='<option value="0">No subproduct found</option>';
		 }
		 echo $str;
		
		}
		
		
		public function get_attrib_value()
		{
						$att_id=$this->input->post("att_id");
						$tbl_name="exp_tbl_attribute_values";
						$col="att_id";
						$value= $att_id;
					 
					 $result = $this->common_model->get_result_array_by_id($tbl_name, $col,$value);
					 //debug($result);
					 $str="";
					 if($result)
					 {
							foreach($result as $a)
							{
								$str.='<option value='.$a['value_id'].'>'.$a['value_name'].'</option>';
							}
							 
					 }
					 else{
							$str.='<option value="0">No value found</option>';
					 }
					 echo $str;
		}
}

