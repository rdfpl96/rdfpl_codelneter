<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          //load the login model
          $this->load->model('admin/adminlogin_model', 'adminlogin');
          $this->load->library('session');
     }

     public function index()
     {
         if ($this->input->post('login_submit') == "login") {
            
             $this->load->library('form_validation');
             $this->form_validation->set_rules('username', 'Username', 'required');
             $this->form_validation->set_rules('password', 'Password', 'required');
     
             // Check if form validation passes
             if ($this->form_validation->run() == FALSE) {
                 $this->load->view('admin/login');
             } else {
                 $username = $this->input->post('username');
                 $password = $this->input->post('password');
                 
                 // Check admin login credentials
                 $usr_result = $this->adminlogin->checkAdminLogin($username, $password);
     
               //   echo "<pre>";
               //   print_r($usr_result);
               //   die();

                 if ($usr_result) {
                     // Set session data
                     $sessiondata = array(
                         'name' => $usr_result['admin_name'],
                         'username' => $usr_result['admin_username'],
                         'admin_id' => $usr_result['admin_id'],
                         'admin_type' => $usr_result['admin_type'],
                         'admin_image'=>$usr_result['admin_image']
                     );

                   
                     $this->session->set_userdata($sessiondata);
                 

                    //  echo"<pre>";
                    //  print_r($this->session->set_userdata($sessiondata));
                    //  die();

                     redirect('admin/dashboard');
                 } else {
                     $this->session->set_flashdata('msg', '<p style="color:red">Username or password is incorrect!</p>');
                     $this->load->view('admin/login');
                 }
             }
         } else {
             $this->load->view('admin/login');
         }
     }
     



       public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy(); 
        redirect('admin/login');
    }
}
