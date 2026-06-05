<?php
class Order_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function save_order($data)
	{
		$this->db->insert('exp_tbl_orders', $data);
		return $this->db->insert_id();
	}
	public function save_order_item($data)
	{
		$this->db->insert('exp_tbl_order_items', $data);
		return ($this->db->error());
	}

	public function save_order_att($data)
	{
		$this->db->insert('exp_tbl_order_att_items', $data);
		return ($this->db->error());
	}

	public function get_orders($order_id)
	{
		$sql = "select o.*,oi.* from exp_tbl_orders as o
		LEFT JOIN exp_tbl_order_items as oi on o.order_id=oi.o_id
		where o.order_id='$order_id'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function get_customer_info($u_id)
	{
		$sql = "select * from exp_tbl_users where u_id='$u_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function get_product_name_with_id($p_id)
	{
		$sql = "select p_name from exp_tbl_products where p_id='$p_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function get_sub_product_name_with_id($sp_id)
	{
		$sql = "select sp_name,sp_image from exp_tbl_sub_products where sp_id='$sp_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}




	public function get_size_name_with_id($size)
	{
		$sql = "select size_name from tbl_size where size_id ='$size'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}



	public function get_attribute_info($order_id)
	{
		$sql = "select oa.*,av.*,a.*,p.p_name,sp.sp_name from exp_tbl_order_att_items as oa
	  LEFT JOIN exp_tbl_attribute_values as av on oa.att_id=av.value_id
	  LEFT JOIN exp_tbl_attributes as a on av.att_id=a.att_id
	  LEFT JOIN exp_tbl_order_items as oi on oa.o_id=oi.o_id
	  LEFT JOIN exp_tbl_sub_products as sp on oi.sp_id=sp.sp_id
	  LEFT JOIN exp_tbl_products as p on oi.p_id=p.p_id
	  WHERE oa.o_id ='$order_id' AND oi.p_id !=0
	  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
