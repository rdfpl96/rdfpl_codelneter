
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class Basic_details extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');
          $this->load->library('my_libraries');
		  $this->load->model('admin/Basic_details_model','basic_details');
          $this->load->helper(array('form', 'url'));
          $this->load->library('session'); 
		  $session=$this->session->userdata('admin');
		  
		  $_SERVER['REQUEST_URI']="admin";

		  if(basename($_SERVER['REQUEST_URI'])!='admin'){
		       if(!isset($session) && $session['is_login']!=1){
		          // redirect(base_url('login'));
		           redirect(base_url('admin'));
		       }
		  }
  
  	}


    public function edit() {
        //$data['subcategory'] = $this->subcategory->get_subcategory($id);
        $data['basic_Details'] = $this->basic_details->get_all_details();
        //print_r($data);
        // $data['basic_Details']='admin/basic_details/edit';
        // $this->load->view('admin/template',$data);

        $data['fileName']='basic_details';
        $data['content']='admin/basic_details/edit';
       // print_r($data);
        $this->load->view('admin/template',$data);
    }

    public function update($id) {
        $data = array(
            'contact_id' => $this->input->post('contact_id'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'contact' => $this->input->post('mobile'),
            'gst_no' => $this->input->post('gst_no'),
            'state' => $this->input->post('state'),
            'pincode' => $this->input->post('pincode'),
            'state_code' => $this->input->post('state_code'),
            'location' => $this->input->post('location'),
        );
        $this->basic_details->update_details($id, $data);
        $this->session->set_flashdata('success_message', 'Basic details updated successfully');
        // redirect('admin/basic_details/edit');
        redirect('admin/basic_details/edit');
    }


}
?>