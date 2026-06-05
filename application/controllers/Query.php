<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Query extends CI_Controller
{
   
	public function __construct(){
		parent::__construct();
	}
    
	/**
	 * @Function Usage: Method to display  query_analyzer page
	 * @Params:  None	
	*/
	public function index(){
		$this->load->view('query_analyzer');
	}
	
	public function analyzer(){
		$this->load->view('query_analyzer');
	}
}
?>