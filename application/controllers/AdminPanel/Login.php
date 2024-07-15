<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          //load the login model
          $this->load->model('admin/adminlogin_model', 'adminlogin');
     }

     public function index()
     {
          if ($this->input->post('login_submit') == "login") {

               $username = $this->input->post("username");
               $password = $this->input->post("password");
               //
               $this->form_validation->set_rules("username", "Username", "trim|required");
               $this->form_validation->set_rules("password", "Password", "trim|required");
               if ($this->form_validation->run() == FALSE) {
                    $this->load->view('admin/login');
               } else {
                    $usr_result = $this->adminlogin->checkAdminLogin($username, $password);

                    if ($usr_result) {
                         $sessiondata = array('name' => $usr_result['name'], 'username' => $usr_result['username'], 'admin_id' => $usr_result['admin_id'], 'admin_type' => $usr_result['admin_type']);
                         $this->session->set_userdata($sessiondata);
                         redirect("admin/dashboard");
                    } else {
                         $this->session->set_flashdata('msg', '<p style="color:red">Username or password is wrong !</p>');
                         $this->load->view('admin/login');
                    }
               }
          } else {
               $this->load->view('admin/login');

               //get the posted values
          }
     }
}
