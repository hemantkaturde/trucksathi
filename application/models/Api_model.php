<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model{
	
	public function add_postion($postarray) { 
		return	$this->db->insert('positions',$postarray);
	} 
    public function checkgps_auth($v_id) { 
        $this->db->where('v_api_username', $v_id);
        $query = $this->db->get("vehicles");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} 
	} 
	public function submitOTP($data){
		 // Prepare data array
		 $post_data = array(
			'mobile_number' => $data['mobile_number'],
			'otp' => $data['otp']
		);
		// Insert into the database
		if (!$this->db->insert('tbl_appuser_otp', $post_data)) {
			$error = $this->db->error();
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function verify_otp($data){
		$where = array('mobile_number>='=>$data['mobile_number'],'otp'=> $data['otp']);
		$otp_data = $this->db->select('*')->from('tbl_appuser_otp')->where($where)->order_by('id','desc')->limit(1)->get()->result_array();
		return $otp_data;
	}

	public function submitbasicdetails($id,$data){
		if($id != '') {
            $this->db->where('id', $id);
            if($this->db->update('tbl_appuser_info', $data)){
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if($this->db->insert('tbl_appuser_info', $data)) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
	}

	public function check_if_basic_details_are_filled_or_not($userid){
        $this->db->select('*');
		$this->db->where('app_user_id', $userid);
        $query = $this->db->get("tbl_appuser_info");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} 
	}


	public function check_if_kyc_details_are_filled_or_not($userid){
        $this->db->select('*');
		$this->db->where('kyc_status', 1);
		$this->db->where('app_user_id', $userid);
        $query = $this->db->get("tbl_appuser_info");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} 
	}



} 