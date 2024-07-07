<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminlogin_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
         
     }

     public function checkAdminLogin1(){
return true;
     }

     public function checkAdminLogin($usr, $pwd)
          {
          $this->db->select('*');
          $this->db->from('tbl_admin');
          $this->db->where('admin_username',$usr);
          $this->db->where('admin_password',md5($pwd));   
          $this->db->where('status',1); 
          $query=$this->db->get() ; 
          if($query->num_rows()== 1)
               { 
                return $query->row_array(); //array
                    //return $query->row(); object
               }
          else
               {
               return false;
               }
          
          }
     public function chkValidAdmin ($admin_id)
          {
          $this->db->select('*');
          $this->db->from('tbl_admin');
          $this->db->where('admin_id',$admin_id);
          $query=$this->db->get() ; 
          if($query->num_rows()== 1)
               {
                return true;
               }
          else
               {
               return false;
               }
          
          }     
     public function isAdminLogin()
          {
          $return = false;
          $admin_id =$this->session->userdata('admin_id');
          
          if(isset($admin_id) && $admin_id> 0 && $this->session->userdata('admin_id')!= ''){
               if($this->chkValidAdmin($admin_id)){
                    return true;
               }  
          }
               return $return;     
          
          }     
}
?>