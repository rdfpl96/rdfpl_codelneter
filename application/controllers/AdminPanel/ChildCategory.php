
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class ChildCategory extends CI_Controller{   





    public function __construct() {
        
        parent::__construct();
        $this->load->library('my_libraries');

    }



 public function index(){

    $this->load->view('admin/containerPage/child_category');

 }







}
?>