<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Home extends CI_Controller{


     public function __construct(){
          parent::__construct();
          //load the login model
          $this->load->model('admin/adminlogin_model', 'adminlogin');

          if(!$this->adminlogin->isAdminLogin()){
               return redirect('admin/login');        
          }
     }

     public function index(){
         
          $this->load->view('admin/dashbord');
     }

         
}?>