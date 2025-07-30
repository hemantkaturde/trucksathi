<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_model extends CI_Model{
    public function getbodyTypeCount($params){
        $this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_body_type.btype_name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_body_type.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_body_type');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function getbodyTypedata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_body_type.btype_name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_body_type.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_body_type');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['btype_name'] = $value['btype_name'];
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'bodyType/'.output($value['btype_id']).'"><i class="fa fa-edit"></i></a> | 
				<a data-toggle="modal" href="" onclick="confirmation('.base_url()."master/deletebodyType".'","'.output($value['btype_id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }
        return $data;
	}

    public function get_bodytype_details($id){
        return $this->db->select('*')->from('tbl_body_type')->where('btype_id',$id)->get()->result_array();
    }
    // =====================================================
}