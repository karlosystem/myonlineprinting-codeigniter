<?php 
class Products_model extends CI_Model 
{
    function __construct() {
        parent::__construct();
    }
    public function search_product($keyword)
    {
		  $sql = "Select * from exp_tbl_products";
		  $cond="";
		  $cond .= ($cond == "") ? " WHERE " : " AND ";
		  $cond .= "p_name  LIKE '%".$this->db->escape_str($keyword)."%'";
			$sql .=$cond;		
		  $result = $this->db->query($sql);
		  return $result->result_array();
		}
		
		public function get_products_count()
		{
			 $sql="SELECT exp_tbl_products.p_id,exp_tbl_products.p_name,COUNT(exp_tbl_sub_products.sp_id) AS Total FROM exp_tbl_products LEFT JOIN exp_tbl_sub_products ON exp_tbl_products.p_id = exp_tbl_sub_products.p_id GROUP BY exp_tbl_products.p_id,exp_tbl_products.p_name;";
			 $query=$this->db->query($sql);
			 return $query->result_array();
		}

		public function get_products_top5()
		{
			 $sql="SELECT * FROM exp_tbl_products WHERE p_status=1 LIMIT 0,5;";
			 $query=$this->db->query($sql);
			 return $query->result_array();
		}

		public function get_products_destacados_portada()
		{
			 $sql="SELECT * FROM exp_tbl_products WHERE p_status=1 and p_destacado=1;";
			 $query=$this->db->query($sql);
			 return $query->result_array();
		}
		
		public function get_products_not_BussinessCard()
		{
			 $sql="SELECT exp_tbl_products.p_id,exp_tbl_products.p_name,COUNT(exp_tbl_sub_products.sp_id) AS Total FROM exp_tbl_products LEFT JOIN exp_tbl_sub_products ON exp_tbl_products.p_id = exp_tbl_sub_products.p_id WHERE exp_tbl_products.p_id <> 18 GROUP BY exp_tbl_products.p_id,exp_tbl_products.p_name;";
			 $query=$this->db->query($sql);
			 return $query->result_array();
		}
		
		public function get_products_bussiness_cards()
		{
			 $sql="SELECT sp_id, p_id, sp_name, sp_status FROM exp_tbl_sub_products WHERE p_id = 18 AND sp_status = 0";
			 $query=$this->db->query($sql);
			 return $query->result_array();
		}

		public function get_paginas_portadas()
		{
			 $sql="SELECT page_id, page_title, page_leyenda, page_name, page_icono, page_status, page_portada FROM exp_tbl_static_pages WHERE page_status = 1 AND page_portada = 1";
			 $query=$this->db->query($sql);
			 return $query->result_array();
		}

	  public function get_whats_new()
	  {
			$sql="select * from exp_tbl_sub_products ORDER BY sp_date DESC";
			$query=$this->db->query($sql);
			return $query->row_array();
	 }
	 public function get_special()
	 {
			$sql="select * from exp_tbl_sub_products  where special_status=1 ORDER BY rand() LIMIT 5";
			$query=$this->db->query($sql);
			return $query->row_array();
	 }
}
