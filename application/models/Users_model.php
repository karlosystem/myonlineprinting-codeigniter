<?php 
class users_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }

	 public function check_login($user_name,$password)
	{
		
		$sql="SELECT * FROM exp_tbl_users where u_name='$user_name' AND u_password='$password' AND u_status=1";
		//echo $sql;die;
		$result=$this->db->query($sql);
		return $result->row_array();
	
	
	}
	public function check_duplicate_email_update($u_email,$u_id)
	{
		$sql="SELECT * FROM exp_tbl_users where u_email='$u_email' AND u_id  != $u_id";
		//echo $sql;die;
		$result=$this->db->query($sql);
		return $result->result_array();
	
	}
	
	 public function delete_data($temp_id)
	{
		
		$sql="DELETE FROM exp_tbl_artwork  WHERE r_id = '$temp_id'";
		$query = $this->db->query($sql);
	
	
	}

	

}
