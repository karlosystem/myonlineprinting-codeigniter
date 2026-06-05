<?php
class Admin_Model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function check_login($user_name, $password)
	{

		$sql = "SELECT * FROM exp_tbl_admins where username='$user_name' AND password='$password'";
		$result = $this->db->query($sql);
		return $result->row_array();
	}
	public function check_password($old_p)
	{
		$this->db->where('password', $old_p);
		$query = $this->db->get('exp_tbl_admins');
		return $query->num_rows();
	}
	public function update($tbl_name, $data)
	{
		$this->db->update($tbl_name, $data);
		$rows = $this->db->affected_rows();
		return $rows;
	}
	public function get_all_attributes($p_id, $sp_id)
	{
		$sql = "SELECT * FROM exp_tbl_assigned_attributes 
				LEFT JOIN exp_tbl_attributes ON  exp_tbl_assigned_attributes.att_id=exp_tbl_attributes.att_id
				where p_id='$p_id' AND sp_id='$sp_id' GROUP BY exp_tbl_assigned_attributes.att_id ";
		//echo $sql;die;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_values($p_id, $sp_id, $att_id)
	{
		$sql = "SELECT * FROM exp_tbl_assigned_attributes 
				LEFT JOIN exp_tbl_attribute_values ON  exp_tbl_assigned_attributes.val_id=exp_tbl_attribute_values.value_id
				where p_id='$p_id' AND sp_id='$sp_id'  AND  exp_tbl_assigned_attributes.att_id= '$att_id'   ";
		//echo $sql;die;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function check_duplicate_email_update($u_email, $u_id)
	{
		$sql = "SELECT * FROM exp_tbl_users where u_email='$u_email' AND u_id  != $u_id";
		//echo $sql;die;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
}
