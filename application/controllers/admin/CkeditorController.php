<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class CkeditorController extends CI_Controller {
 
 public function __construct() {
 
    //parent::Controller();
    parent::__construct();
    
 }
 
 public function index() 
 {
     $this->load->library('CKEditor');
     $this->load->library('CKFinder');
 
     //Add Ckfinder to Ckeditor
     $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');  
     $this->load->view('admin/ckeditor');
 
 }
}