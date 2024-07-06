<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Company_pages extends CI_Controller {

    function __construct(){
         parent::__construct();
         $this->load->library('my_libraries');
        $this->load->model('sqlquery_model','sqlquery');
         $this->load->model('common_model');
    }
 public function blog(){

        $search_blog=$this->input->get('sr');
        $pr_list_count=$this->sqlQuery_model->sql_select('tbl_blog','blog_id');
         if($search_blog!=""){
             $searchKeyword="AND (blog_header LIKE '%".$search_blog."%' OR blog_cat_name LIKE'%".$search_blog."%')";
           }else{
             $searchKeyword="";
           }

       $url_link=base_url('blog');
         $limit_per_page = 12;
         $getVariable=$this->input->get('per_page');
         $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0 ) : 0;

         $total_records = ($pr_list_count!=0) ? count($pr_list_count) : 0;
         $config=createPaginationProduct($total_records,$url_link,$limit_per_page);

         $this->pagination->initialize($config);
         $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;
        
          $querys="SELECT * FROM tbl_blog WHERE blog_status=1 $searchKeyword ORDER BY blog_id DESC $sql_limit";
          $data['blogs_list']=$this->sqlQuery_model->sql_query($querys);

         $data["links"] = $this->pagination->create_links();

        $getCategoryList="SELECT count(blog_category) as blog_count,blog_cat_name FROM tbl_blog WHERE blog_status=1 GROUP BY blog_category";
        $data['blogs_cat_list']=$this->sqlQuery_model->sql_query($getCategoryList);

       $data['content']='frontend/company_pages/blog';
       $this->load->view('frontend/template',$data);
   }

public function about_us(){   
      $teamList=$this->sqlquery->sql_select_where_desc('tbl_teams','position',array('status'=>1));
      $data['team_list']=$teamList;

       $data['content']='frontend/company_pages/about_us';
      $this->load->view('frontend/template',$data);
   }
public function contact(){

       $data['content']='frontend/company_pages/contact';
      $this->load->view('frontend/template',$data);
   }
public function contact_form_submit() {
    $data = array(
        'first_name' => $this->input->post('fname'),
        'last_name' => $this->input->post('lname'),
        'email' => $this->input->post('email'),
        'mobile' => $this->input->post('mobile'),
        'subject' => $this->input->post('subject'),
        'message' => $this->input->post('message')
    );

    if ($this->common_model->insert_contact($data)) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message']);
    }
}   
      
public function refund_cancelation_policy(){
        $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
        $data['content']='frontend/company_pages/refund_cancelation_policy';
        $this->load->view('frontend/template',$data);
    }
public function terms_and_conditions(){

        $data['policy_details']=$this->sqlquery->sql_select_where('tbl_policy',array('status'=>1));
        $data['content']='frontend/company_pages/terms_and_conditions';
        $this->load->view('frontend/template',$data);
    }

public function privacy_policy(){
        $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
        $data['content']='frontend/company_pages/privacy_policy';
        $this->load->view('frontend/template',$data);
    }

public function shipping_policy(){
        $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
        $data['content']='frontend/company_pages/shipping_policy';
        $this->load->view('frontend/template',$data);
    }

public function faq(){
        $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
        $data['content']='frontend/company_pages/faq';
        $this->load->view('frontend/template',$data);
    }

public function disclaimer(){
        $data['policy_details']=$this->sqlQuery_model->sql_select_where('tbl_policy',array('status'=>1));
        $data['content']='frontend/company_pages/disclaimer';
        $this->load->view('frontend/template',$data);
    }             

}

?>