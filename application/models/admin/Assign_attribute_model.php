<?php 
class Assign_attribute_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }


   public function check_duplicate_assigned_attribute($p_id,$sp_id,$att_id,$value_id)
   {
			$sql="SELECT * FROM   exp_tbl_assigned_attributes  WHERE  p_id=$p_id AND sp_id=$sp_id AND att_id=$att_id AND val_id=$value_id";
		
			$query=$this->db->query($sql);
			return $query->row_array();
   
   }
   public function check_duplicate_price($p_id,$sp_id,$comb,$qty,$size)
   {
		
			$sql="SELECT * FROM   exp_tbl_pricing  WHERE  p_id=$p_id 
			AND sp_id=$sp_id  AND combination='$comb' AND quantity=$qty AND size=$size ";
			
			//echo $this->db->last_query();
			
			$query=$this->db->query($sql);
			return $query->result_array();
   
   }

}