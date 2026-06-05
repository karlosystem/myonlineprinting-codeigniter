<?php 
class Products_model extends CI_Model 
{
	public function check_duplicate_cat_name($p_cat_name,$p_cat_id)
	{			
		$query = $this->db->get_where( "exp_tbl_products_cat", array(
													"p_cat_name" => $this->db->escape_str($p_cat_name), 
													"p_cat_id != " => $p_cat_id
												)
					);
		
		return ( $query->num_rows());
	}
	
	public function check_duplicate_attribute_name($p_a_name,$p_a_id,$p_cat_id)
	{			
		$query = $this->db->get_where( "exp_tbl_products_attribute", array(
													"p_a_type" => $this->db->escape_str($p_a_name), 
													"p_c_id" => $p_cat_id,
													"p_a_id !="=>$p_a_id
												)
					);
					
		return ( $query->num_rows());
	}
	
	public function check_duplicate_qty_option($p_qty_name,$p_qty_option_id,$p_cat_id)
	{			
		$query = $this->db->get_where( "exp_tbl_products_qty_option", array(
													"p_qty_option_name" => $this->db->escape_str($p_qty_name), 
													"p_qty_cat_id" => $p_cat_id,
													"p_qty_option_id !="=>$p_qty_option_id
												)
					);
		return ( $query->num_rows());
	}

	public function get_all_products_attribute($limit = 0, $limit_start = 0)
	{	
		
		/*$this->db->select('pa.*, pc.p_cat_name')
		->from('exp_tbl_products_attribute pa')
		->join('exp_tbl_products_cat pc', 'pc.p_cat_id = pa.p_c_id', 'left')
		->order_by('pa.p_a_id', 'ASC')
		->limit($limit);
		
		$query = $this->db->get();
		echo $this->db->last_query();
		return $query->result_array();*/
		
		$sql = "SELECT pa.*, pc.p_cat_name FROM exp_tbl_products_attribute as pa
		LEFT JOIN exp_tbl_products_cat as pc on pa.p_c_id=pc.p_cat_id
		";
		
		$sql .= " ORDER BY  pa.p_a_id ASC";

		if ( $limit > 0 ) {
			$sql .= " LIMIT $limit_start, $limit ";
		}
		$result = $this->db->query($sql);
		return $result->result_array();
	
	}
	
	
	public function get_all_products_qty_option($limit = 0, $limit_start = 0)
	{	
		
		$sql = "SELECT pq.*, pc.p_cat_name FROM exp_tbl_products_qty_option as pq
		LEFT JOIN exp_tbl_products_cat as pc on pc.p_cat_id=pq.p_qty_cat_id 	
		";
		
		$sql .= " ORDER BY  pq.p_qty_option_id ASC";

		if ( $limit > 0 ) {
			$sql .= " LIMIT $limit_start, $limit ";
		}
	//	echo $sql;
		$result = $this->db->query($sql);
		return $result->result_array();
	
	}
	
	public function get_all_products_qty_option_price($limit = 0, $limit_start = 0)
	{	
		
		$sql = "SELECT pp.*, pa.*, pc.p_cat_name,pq.p_qty_option_name  FROM exp_tbl_products_qty_price as pp
		LEFT JOIN exp_tbl_products_qty_option as pq on pp.p_qty_option_id=pq.p_qty_option_id 	
		LEFT JOIN exp_tbl_products_attribute as pa on pp.p_price_cat_id =pa.p_c_id 	 	 		
		LEFT JOIN exp_tbl_products_cat as pc on pp.p_price_cat_id=pc.p_cat_id 	
		";
		
		$sql .= "GROUP BY pp.p_qty_price_id ORDER BY  pc.p_cat_name ASC";

		if ( $limit > 0 ) {
			$sql .= " LIMIT $limit_start, $limit ";
		}

		$result = $this->db->query($sql);
		return $result->result_array();
	
	}
	
	
	public function get_all_products_qty_option_price_with_id($p_qty_option_price_id)
	{	
		
		$sql = "SELECT pp.*, pa.*, pc.p_cat_name,pq.p_qty_option_name  FROM exp_tbl_products_qty_price as pp
		LEFT JOIN exp_tbl_products_qty_option as pq on pp.p_qty_option_id=pq.p_qty_option_id 	
		LEFT JOIN exp_tbl_products_attribute as pa on pp.p_price_cat_id =pa.p_c_id 	 	 		
		LEFT JOIN exp_tbl_products_cat as pc on pp.p_price_cat_id=pc.p_cat_id 
		WHERE 	pp.p_qty_price_id =$p_qty_option_price_id
		";
		$result = $this->db->query($sql);
		return $result->row_array();
	
	}
	
	
	public function get_products_attribute_with_id($p_a_id)
	{	
		
		$this->db->select('pa.*, pc.p_cat_name')
		->from('exp_tbl_products_attribute pa')
		->join('exp_tbl_products_cat pc', 'pc.p_cat_id = pa.p_c_id', 'left')
		->where('pa.p_a_id', $p_a_id);
		
		$query = $this->db->get();
		return $query->row_array();
	
	}
	
	public function get_products_qty_option_with_id($p_qty_option_id)
	{	
		
		$this->db->select('pq.*, pc.p_cat_name')
		->from('exp_tbl_products_qty_option pq')
		->join('exp_tbl_products_cat pc', 'pc.p_cat_id = pq.p_qty_cat_id ', 'left')
		->where('pq.p_qty_option_id ', $p_qty_option_id);
		
		$query = $this->db->get();
		return $query->row_array();
	
	}
	
	public function get_all_attributes($p_c_id)
	{	
		
		$sql = "SELECT pa.* from exp_tbl_products_attribute as pa
		WHERE 	pa.p_c_id=$p_c_id
		";
		$result = $this->db->query($sql);
		return $result->result_array();
	
	}
	
	
	public function get_all_qty($p_c_id)
	{	
		
		$sql = "SELECT pq.* from exp_tbl_products_qty_option as pq
		WHERE 	pq.p_qty_cat_id =$p_c_id
		";
		$result = $this->db->query($sql);
		return $result->result_array();
	
	}
	
	public function get_other_attributes($p_a_id)
	{	
		
		$sql = "SELECT pa.* from exp_tbl_products_attribute as pa
		WHERE 	pa.p_a_id=$p_a_id
		";
		$result = $this->db->query($sql);
		return $result->row_array();
	
	}
	

}
