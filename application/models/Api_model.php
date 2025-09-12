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

	public function check_user_exits_or_not($mobile_number){
        $this->db->select('id,app_user_id,category_id,category_name,name,mobile,pincode');
		$this->db->where('mobile', $mobile_number);
        $query = $this->db->get("tbl_appuser_info");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} 
	}

	public function check_KYC_filled_or_not($mobile_number){
        $this->db->select('*');
		$this->db->where('mobile', $mobile_number);
		$this->db->where('kyc_details_status', 1);
        $query = $this->db->get("tbl_appuser_info");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} 
	}

	public function check_KYC_Doc_filled_or_not($mobile_number){
        $this->db->select('*');
		$this->db->where('kyc_doc_status', 1);
		$this->db->where('mobile', $mobile_number);
        $query = $this->db->get("tbl_appuser_info");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} 
	}

	public function switch_account($userid,$data){

		    $this->db->where('id', $userid);
            if($this->db->update('tbl_appuser_info', $data)){
                return TRUE;
            } else {
                return FALSE;
            }

	}

	public function updateprofiledetails($id,$data){
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

	public function getuserdetails($data){

		$this->db->select('*,tbl_category_master.category_head as cat_name');
		$this->db->where('mobile_number', $data['mobile_number']);
		$this->db->join('tbl_category_master', 'tbl_category_master.cat_id = tbl_appuser_info.category_id');
        $query = $this->db->get("tbl_appuser_info");
		$fetch_result = $query->result_array();
        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['userid'] = $value['id'];
                $data[$counter]['category_id'] = $value['category_id'];
				$data[$counter]['category_name'] = $value['cat_name'];
				$data[$counter]['name'] = $value['name'];
                $data[$counter]['mobile_number'] = $value['mobile_number'];
				$data[$counter]['email'] = $value['email'];
				$data[$counter]['address'] = $value['address'];
                $data[$counter]['state'] = $value['state'];
				$data[$counter]['city'] = $value['city'];
				$data[$counter]['pincode'] = $value['pincode'];
				$data[$counter]['company_name'] = $value['company_name'];
				$data[$counter]['kyc_details_status'] = $value['kyc_details_status'];
				$data[$counter]['kyc_doc_status'] = $value['kyc_doc_status'];
				
				if($value['aadhar_card']){
					$aadhar_card = DOCUMENT_PATH.'/aadhar_card/'.$value['aadhar_card'];
				}else{
					$aadhar_card ='';
				}
				$data[$counter]['aadhar_card'] = $aadhar_card;


				if($value['pan_card']){
					$pan_card = DOCUMENT_PATH.'/pan_card/'.$value['pan_card'];
				}else{
					$pan_card ='';
				}

				$data[$counter]['pan_card'] = $pan_card;

				if($value['licence']){
					$licence = DOCUMENT_PATH.'/licence/'.$value['licence'];
				}else{
					$licence ='';
				}
				$data[$counter]['licence'] = $licence;


				if($value['gst']){
					$gst = DOCUMENT_PATH.'/gst/'.$value['gst'];
				}else{
					$gst ='';
				}
				$data[$counter]['gst'] = $gst;


				
				if($value['rc_book']){
					$rc_book = DOCUMENT_PATH.'/rc_book/'.$value['rc_book'];
				}else{
					$rc_book ='';
				}
				$data[$counter]['rc_book'] = $rc_book;


				if($value['user_photo']){
					$user_photo = DOCUMENT_PATH.'/user_photo/'.$value['user_photo'];
				}else{
					$user_photo ='';
				}
				$data[$counter]['user_photo'] = $user_photo;



				$data[$counter]['status'] = $value['status'];
				$data[$counter]['created_date'] = $value['created_date'];

			}

		}

		  return $data;
	}

	public function getdeviceinfo($data){

		$this->db->select('*');
        $query = $this->db->get("tbl_device_master");
		$fetch_result = $query->result_array();
        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['deviceid'] = $value['id'];
                $data[$counter]['device_name'] = $value['device_name'].'-'.$value['price'];
				// $data[$counter]['device_type'] = $value['device_type'];
				// $data[$counter]['model_number'] = $value['model_number'];
                // $data[$counter]['serial_number '] = $value['serial_number '];
				// $data[$counter]['price'] = $value['price'];
				// $data[$counter]['description'] = $value['description'];
                // $data[$counter]['years'] = $value['years'];

                //  if($value['device_image']){
                //     $device_image = DOCUMENT_PATH.'/device_image/'.$value['device_image'];
				//  }else{
                //     $device_image ='';
				//  }
				 
				 
				// $data[$counter]['device_image'] =  $device_image;
			}

		}

		  return $data;
	}

	public function getdevicedetails($data){

		$this->db->select('*');
		$this->db->where('id', $data['deviceid']);
        $query = $this->db->get("tbl_device_master");
		$fetch_result = $query->result_array();
        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['deviceid'] = $value['id'];
                $data[$counter]['device_name'] = $value['device_name'].'-'.$value['price'];
				$data[$counter]['device_type'] = $value['device_type'];
				$data[$counter]['model_number'] = $value['model_number'];
                $data[$counter]['serial_number '] = $value['serial_number '];
				$data[$counter]['price'] = $value['price'];
				$data[$counter]['description'] = $value['description'];
                $data[$counter]['years'] = $value['years'];
			    $data[$counter]['theft_price'] = $value['theft_protection_amount'];

                 if($value['device_image']){
                    $device_image = DOCUMENT_PATH.'/device_image/'.$value['device_image'];
				 }else{
                    $device_image ='';
				 }
				 
				 
				$data[$counter]['device_image'] =  $device_image;
			}

		}

		  return $data;
	}

	public function submitorderdetails($id,$data){
		if($id != '') {
            $this->db->where('id', $id);
            if($this->db->update('tbl_device_order', $data)){
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if($this->db->insert('tbl_device_order', $data)) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
	}

	public function getpromotaionmaster($data){

		$this->db->select('*');
		$this->db->where('status', 1);
        $query = $this->db->get("tbl_promotion_master");
		$fetch_result = $query->result_array();
        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['promo_id'] = $value['promo_id'];
                $data[$counter]['promo_title'] = $value['promo_title'];
                 if($value['promo_banner']){
                    $promo_banner = DOCUMENT_PATH.'/promotion/'.$value['promo_banner'];
				 }else{
                    $promo_banner ='';
				 }
				$data[$counter]['promo_banner'] =  $promo_banner;
				$data[$counter]['promo_url'] =  $promo_url;
			}

		}
		return $data;
	}

	public function getactiveplansdata($data){

		$this->db->select('*');
		$this->db->join('tbl_device_master', 'tbl_device_master.id = tbl_device_order.deviceid');
		$this->db->where('tbl_device_order.status', 1);
		$this->db->where('tbl_device_order.userid', $data['userid']);
        $query = $this->db->get("tbl_device_order");
		$fetch_result = $query->result_array();
        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {

				$data[$counter]['deviceid'] = $value['id'];
                $data[$counter]['device_name'] = $value['device_name'].'-'.$value['price'];
				$data[$counter]['device_type'] = $value['device_type'];
				$data[$counter]['model_number'] = $value['model_number'];
                $data[$counter]['serial_number '] = $value['serial_number '];
				$data[$counter]['price'] = $value['price'];
				$data[$counter]['description'] = $value['description'];
                $data[$counter]['years'] = $value['years'];
			    $data[$counter]['theft_price'] = $value['theft_protection_amount'];

                 if($value['device_image']){
                    $device_image = DOCUMENT_PATH.'/device_image/'.$value['device_image'];
				 }else{
                    $device_image ='';
				 }
				 
				 
				$data[$counter]['device_image'] =  $device_image;

			}

		}
		return $data;
	}

	


} 