<?php 
class Attributes_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }

   public function check_duplicate_attribute($tbl_name,$col,$value)
   {
			$sql="SELECT * FROM $tbl_name  Where $col LIKE  '$value'";
		
			$query=$this->db->query($sql);
			return $query->row_array();
   }

}