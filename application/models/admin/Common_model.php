<?php
class Common_model extends CI_Model
{
	public function insert_data($data, $tbl_name)
	{
		$this->db->insert($tbl_name, $data);
		##	return ($this->db->error() === 0);
	}

	public function insert_upload_contact($data, $tbl_name)
	{
		$sql = $this->db->insert($tbl_name, $data);
		return ($this->db->insert_id());
	}

	public function get_order_by_user_id($u_id)
	{
		$sql = "select t_o.*,t_u.* from exp_tbl_orders as t_o
							LEFT JOIN exp_tbl_users as t_u ON t_o.cust_id=t_u.u_id
					where t_o.cust_id='$u_id' ORDER BY t_o.order_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_all_list($tbl_name, $limit = 0, $limit_start = 0, $orderby = 0, $col = 0)
	{
		$sql = "SELECT * from $tbl_name";
		if ($orderby) {
			$sql .= " ORDER BY  $col $orderby";
		}

		if ($limit > 0) {
			$sql .= " LIMIT $limit_start, $limit";
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function change_status($table, $column, $value, $uniqueNameCol, $uniqueColValue)
	{
		$query = $this->db->query("UPDATE " . $table . " SET `" . $column . "` = '" . $value . "' WHERE `" . $uniqueNameCol . "` = '" . $uniqueColValue . "' ");
		return true;
	}

	public function delete_item($table, $column, $value)
	{
		$query = $this->db->query("DELETE FROM " . $table . " WHERE $column IN (" . $value . ") ");
		return true;
	}

	public function get_item_by_id($tbl_name, $col, $value)
	{
		$this->db->where($col, $value);
		$query = $this->db->get($tbl_name);

		if ($query->num_rows > 1) {
			return $query->result_array();
		} else {
			return $query->row_array();
		}
	}

	public function get_result_array_by_id($tbl_name, $col, $value)
	{
		$this->db->where($col, $value);
		$query = $this->db->get($tbl_name);
		return $query->result_array();
	}


	public function update_item_by_id($tbl_name, $data_arr, $cnd_arr)
	{
		$this->db->update($tbl_name, $data_arr, $cnd_arr);
		return ($this->db->error());
	}

	function calculate_price($p_id, $sp_id, $comb)
	{
		$sql = "SELECT * FROM exp_tbl_pricing WHERE  p_id=$p_id AND sp_id=$sp_id AND combination='$comb'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_available_sizes($p_id = 0, $sp_id = 0, $comb = "", $column = "")
	{
		$sql = "SELECT * FROM exp_tbl_pricing  LEFT JOIN tbl_size  ON exp_tbl_pricing.size=tbl_size.size_id  
			 WHERE  p_id=$p_id AND sp_id=$sp_id AND combination='$comb' 
			 GROUP BY size ORDER BY size";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_available_qtys($p_id = 0, $sp_id = 0, $comb = "", $column = "")
	{
		$sql = "SELECT * FROM exp_tbl_pricing  LEFT JOIN  exp_tbl_qty  ON  exp_tbl_pricing.quantity = exp_tbl_qty.qty_id 
			 WHERE  p_id=$p_id AND sp_id=$sp_id AND combination='$comb' 
			 GROUP BY quantity ORDER BY qty_name ASC";
		#echo $sql;
		#exit();
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_attr_pricing($qty = 0, $p_id = 0, $sp_id = 0, $comb = "")
	{
		$sql = "SELECT * FROM exp_tbl_pricing WHERE p_id=$p_id AND sp_id=$sp_id AND combination='$comb' AND quantity=$qty ORDER BY quantity ASC";
		##echo $sql;
		##exit();
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function get_subproduct_attributes($p_id, $sp_id)
	{
		$sql = "SELECT * FROM  exp_tbl_assigned_attributes  LEFT JOIN  exp_tbl_attributes 
			ON  exp_tbl_assigned_attributes.att_id=exp_tbl_attributes.att_id WHERE p_id=$p_id AND sp_id=$sp_id 
			GROUP BY  exp_tbl_assigned_attributes.att_id ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_subproduct_attribute_values($p_id, $sp_id, $att_id)
	{
		$sql = "SELECT * FROM  exp_tbl_assigned_attributes  LEFT JOIN  exp_tbl_attribute_values 
			ON  exp_tbl_assigned_attributes.val_id=exp_tbl_attribute_values.value_id WHERE p_id=$p_id AND sp_id=$sp_id  AND  exp_tbl_assigned_attributes.att_id=$att_id 	
			ORDER BY  exp_tbl_attribute_values.value_id";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_all_quantities_of_product($p_id, $sp_id, $combination, $size)
	{
		$sql = "SELECT * FROM  exp_tbl_pricing  LEFT JOIN  exp_tbl_qty 
			ON  exp_tbl_pricing.quantity=exp_tbl_qty.qty_id 
			WHERE p_id=$p_id AND sp_id=$sp_id  AND  combination='$combination'  AND size=$size ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}


	public function get_item_price($p_id, $sp_id, $combination, $size, $q)
	{
		$sql = "SELECT * FROM  exp_tbl_pricing 
			WHERE p_id= '$p_id' AND sp_id='$sp_id'  AND  combination='$combination'  AND size='$size' AND quantity='$q' ";
		$result = $this->db->query($sql);
		return $result->row_array();
	}



	public function get_all_state($tbl_name, $cntry_id)
	{
		$sql = "SELECT * from $tbl_name where country_id='$cntry_id'";

		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function paypal_credentials()
	{
		$sql = "Select * from exp_tbl_paypal_setting";
		$query = $this->db->query($sql);
		return $query->row_array();
	}



	public function get_upload_artwork($row_id)
	{
		$sql = "Select * from exp_tbl_artwork WHERE r_id = '$row_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function delete_artwork($row_id)
	{
		$sql = "DELETE FROM exp_tbl_artwork  WHERE up_id = '$row_id'";
		$query = $this->db->query($sql);
	}

	public function get_admin_detail()
	{
		$sql = "select * from exp_tbl_admins where admin_id='1'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function update_admin_detail($user_name, $email)
	{
		$sql = "update exp_tbl_admins set username='$user_name' ,email='$email' where admin_id='1'";
		$query = $this->db->query($sql);
		return ($this->db->_error_number() === 0);
	}
}
