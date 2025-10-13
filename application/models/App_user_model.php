<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_user_model extends CI_Model{
    
    public function getall_category() { 
		return $this->db->select('*')->from('tbl_category_master')->order_by('cat_id','desc')->get()->result_array();
	} 
    public function get_app_users_details($id) { 
		return $this->db->select('*')->from('tbl_appuser_info')->join('tbl_category_master', 'tbl_category_master.cat_id=tbl_appuser_info.category_id','left')->where('id',$id)->get()->result_array();
	} 

    public function getall_app_users_details() { 
		  $this->db->select("*");
		  $this->db->from('tbl_appuser_info');
		  $this->db->join('tbl_category_master', 'tbl_category_master.cat_id=tbl_appuser_info.category_id','left');
		  $query = $this->db->get();
		  return $query->result_array();
	}

	public function getappUsersCount($params){
		
		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_appuser_info.name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_appuser_info.mobile_number LIKE '%".$params['search']['value']."%'");
			$this->db->or_where("tbl_appuser_info.pincode LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_category_master.category_head LIKE '%".$params['search']['value']."%')");
        }
        $this->db->from('tbl_appuser_info');
		$this->db->join('tbl_category_master', 'tbl_category_master.cat_id=tbl_appuser_info.category_id','left');
		$query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
	}

	public function getappUsersdata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_appuser_info.name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_appuser_info.mobile_number LIKE '%".$params['search']['value']."%'");
			$this->db->or_where("tbl_appuser_info.pincode LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_category_master.category_head LIKE '%".$params['search']['value']."%')");
        }
        $this->db->from('tbl_appuser_info');
		$this->db->join('tbl_category_master', 'tbl_category_master.cat_id=tbl_appuser_info.category_id','left');
		$query = $this->db->get();

        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['name'] = '<a class="icon" href="'.base_url().'app_users/view_kycDoc/'.output($value['id']).'">'.$value['name'].'</a>';
                $data[$counter]['mobile_number'] = $value['mobile_number'];
				$data[$counter]['pincode'] = $value['pincode'];
				$data[$counter]['category_head'] = $value['category_head'];
				// $data[$counter]['status'] = "<span class='badge badge-success'>".($value['status']=='1') ? 'Active' : 'Inactive'."</span>";
				if($value['kyc_details_status']=='1'){
					$data[$counter]['kyc_details_status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['kyc_details_status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'app_users/editapp_users/'.output($value['id']).'"><i class="fa fa-edit"></i></a> | 
				<a data-toggle="modal" href="" onclick="confirmation('.base_url()."app_users/delete_app_users".'","'.output($value['id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }
        return $data;	
	}
	
} 