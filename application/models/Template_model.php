<?php 
class Template_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }

    public function get_template_opt_name()
    {
		  $sql = "Select * from exp_tbl_template_options";
		  $result = $this->db->query($sql);
		  return $result->result_array();
    }
		
		public function get_att_values($att_id)
		{
				$sql = "Select * from exp_tbl_template_options_attributes 
								LEFT JOIN exp_tbl_template_options  on exp_tbl_template_options.template_option_id =exp_tbl_template_options_attributes.template_opt_id
				where template_opt_id='$att_id' GROUP BY template_turnaroundtime";
				$result = $this->db->query($sql);
				return $result->row_array();
			
		
		}
		
		public function get_qty($att_id)
		{
				$sql = "Select * from exp_tbl_template_options_attributes	where template_opt_id='$att_id'";
				$result = $this->db->query($sql);
				return $result->result_array();
		
		}
		
		public function check_duplicat_instance_id($template_id)
		{
				$sql="select * from exp_tbl_saved_designs where template_id='$template_id'";
				$result = $this->db->query($sql);
				return $result->result_array();
			
		}
		
		public function insert_saved_design($template_id,$instance_id)
		{
				$sql="insert into exp_tbl_saved_designs set template_id='$template_id', instance_id='$instance_id' ";
				$result = $this->db->query($sql);
				return ( $this->db->_error_number() === 0 );
		
		}
		
		public function get_all_saved_design()
		{
				$sql="select * from exp_tbl_saved_designs";
				$result = $this->db->query($sql);
				return $result->result_array();
		
		}
		
		public function delete_saved_design($design_id)
		{
				$sql="delete from exp_tbl_saved_designs where design_id='$design_id' ";
				$result = $this->db->query($sql);
				return ( $this->db->_error_number() === 0 );
		}
		
		public function get_price($id)
		{
				$sql="select price from exp_tbl_template_options_attributes where template_option_attribute_id='$id'";
				$result = $this->db->query($sql);
				return $result->row_array();
		
		}
		
		public function get_all_quantities($qty_id)
		{
				$sql="select * from exp_tbl_template_options_attributes where template_opt_id='$qty_id'";
				$result = $this->db->query($sql);
				return $result->result_array();
		
		
		}
	

}
