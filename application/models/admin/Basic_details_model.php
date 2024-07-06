<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_details_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }
    public function get_all_details() {
        $query = $this->db->get('tbl_contact_details');
        return $query->result();
    }

    public function update_details($id, $data) {
        $this->db->where('contact_id', $id);
        return $this->db->update('tbl_contact_details', $data);
    }

  
}
?>