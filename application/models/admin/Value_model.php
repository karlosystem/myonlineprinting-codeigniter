<?php 
class Value_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }


   public function check_duplicate_value($att_id,$value_name)
   {
			$sql="SELECT * FROM exp_tbl_attribute_values  Where  att_id=$att_id AND value_name LIKE '$value_name'";
		
			$query=$this->db->query($sql);
			return $query->row_array();
   
   }

}