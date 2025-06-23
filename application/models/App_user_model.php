<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_user_model extends CI_Model{
    
    public function getall_category() { 
		return $this->db->select('*')->from('tbl_category_master')->order_by('cat_id','desc')->get()->result_array();
	} 
    public function get_app_users_details($id) { 
		return $this->db->select('*')->from('tbl_appuser_info')->where('id',$id)->get()->result_array();
	} 

    public function getall_app_users_details() { 
		  $this->db->select("*");
		  $this->db->from('tbl_appuser_info');
		  $this->db->join('tbl_category_master', 'tbl_category_master.cat_id=tbl_appuser_info.category_id','left');
		  $query = $this->db->get();
		  return $query->result_array();
	}
	
} 