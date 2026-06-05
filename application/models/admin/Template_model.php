<?php 
class Template_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }


   public function save_template_option($data,$tbl_name)
   {
				$result = $this->db->insert($tbl_name, $data); 
				return ( $this->db->_error_number() === 0 );
	 }
	 
	 public function all_template_option_name()
	 {
			$sql="select * from exp_tbl_template_options";
			$query=$this->db->query($sql);
			return $query->result_array();
	 }
	 
	  public function all_template_option_attributes()
	 {
			$sql="select * from exp_tbl_template_options_attributes";
			$query=$this->db->query($sql);
			return $query->result_array();
	 }
	 
	 public function check_template_option_name($opt_name)
	 {
			$sql="select * from exp_tbl_template_options where template_option_name='$opt_name' ";
			$query=$this->db->query($sql);
			$tot_rows = $query->num_rows();
			return $tot_rows;
	 
	 }
	 
	 public function save_template_option_attributes($data,$tbl_name)
	 {
				$result = $this->db->insert($tbl_name, $data); 
				return ( $this->db->_error_number() === 0 );
	 
	 
	 }
	 
	 public function get_temp_opt_name($template_opt_id)
	 {
				$sql="select * from exp_tbl_template_options where template_option_id='$template_opt_id' ";
				$query=$this->db->query($sql);
				return $query->row_array();
				
	 
	 }
	 public function save_turnaround_time($data,$tbl_name)
	 {
				$result = $this->db->insert($tbl_name, $data); 
				return ( $this->db->_error_number() === 0 );
	 
	 }
	 
	 
	 public function get_turnaroud_time($opt_id)
	 {
			$sql="select * from exp_tbl_turnaround_time where template_optn_id='$opt_id'";
			$query=$this->db->query($sql);
			return $query->result_array();
			
	 }
	 
	 public function get_turnaround_name($tun_time_id)
	 {	
				$sql="select * from exp_tbl_turnaround_time where turn_time_id='$tun_time_id' ";
				$query=$this->db->query($sql);
				return $query->row_array();
		
	 }
	 
	 public function check_duplicate_turnaround($option_id)
		{
						$sql="select * from exp_tbl_turnaround_time where 	template_optn_id=$option_id";
						$query=$this->db->query($sql);
						return $query->row_array();
		}

}
