<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }


public function getUserDetailByEmailOrMobile($email_mob){
    $array_res=array();
    $this->db->select('*');
    $this->db->from('tbl_customer');
    $this->db->where('mobile',$email_mob);
    $this->db->or_where('email',$email_mob);
    $query=$this->db->get() ; 
    if($query->num_rows()>0){ 
      $array_res=$query->row_array();
    }
    return $array_res;
  }  

  public function insertNewUser($array_data){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_customer', $array_data);
    $last_id= $this->db->insert_id();

    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
    }
  }

  public function updateUserDataByUserId($customer_id,$array_data){
    $this->db->trans_begin(); 

    $this->db->where('customer_id', $customer_id);     
    $this->db->update('tbl_customer', $array_data);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    } 

  }  

  public function getChkValieOtp($customer_id,$otp){
      $array_res=false;
      $this->db->select('*');
      $this->db->from('tbl_customer');
      $this->db->where('customer_id',$customer_id);
      $this->db->where('otp',$otp);
     // $this->db->where('is_otp_verify',0);
      $query=$this->db->get() ; 
      if($query->num_rows()>0){ 
        $array_res=true;
      }
      return $array_res;
  } 

  public function updateOtpVerification($customer_id,$array_data){
    $this->db->trans_begin(); 

    $this->db->where('customer_id', $customer_id);     
    $this->db->update('tbl_customer', $array_data);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    } 

  } 
  
}

?>