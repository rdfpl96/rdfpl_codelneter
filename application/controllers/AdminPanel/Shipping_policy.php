
<?php
defined('BASEPATH') OR exit('No direct script access allowe');

class Shipping_policy extends CI_Controller{   
  
    public function __construct() {
        
        parent::__construct();
        
         date_default_timezone_set('Asia/Kolkata');

          $this->load->library('my_libraries');
          $this->load->model('sqlQuery_model');
          $session=$this->session->userdata('admin');
          
          $_SERVER['REQUEST_URI']="admin";

          if(basename($_SERVER['REQUEST_URI'])!='admin'){
               if(!isset($session) && $session['is_login']!=1){
                  // redirect(base_url('login'));
                   redirect(base_url('admin'));
               }
          }
  
    }

public function index(){
    //$menuIdAsKey=35;
    $data['getAccess']= $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id']=$menuIdAsKey;
    $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
    //print_r($data);
    $data['content']='admin/shipping_policy/shipping_policy';
    $this->load->view('admin/template',$data);

    // $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
    //     $data['content']='admin/shipping_policy/shipping_policy';
    //     $this->load->view('admin/template',$data);
}


}
?>