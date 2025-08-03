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
                <a href="'.base_url().'master/delbodyType/'.output($value['btype_id']).'" class="icon text-danger"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }
        return $data;
	}
    // <a data-toggle="modal" href="" onclick="confirmation('.base_url()."master/deletebodyType".'","'.output($value['btype_id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a> |

    public function get_bodytype_details($id){
        return $this->db->select('*')->from('tbl_body_type')->where('btype_id',$id)->get()->result_array();
    }
    // =====================================================

    //          START TYRE MASTER
    public function get_tyreCount($params){
        $this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_tyre.tyre_name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_tyre.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_tyre');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_tyredata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_tyre.tyre_name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_tyre.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_tyre');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['tyre_name'] = $value['tyre_name'];
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'tyre_master/'.output($value['tyre_id']).'"><i class="fa fa-edit"></i></a> | 
                <a href="'.base_url().'master/deltyre/'.output($value['tyre_id']).'" class="icon text-danger"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }
        return $data;
	}
    public function get_tyre_details($id){
        return $this->db->select('*')->from('tbl_tyre')->where('tyre_id',$id)->get()->result_array();
    }

    // =====================================================
    //          START CAPACITY MASTER

    public function getcapacityCount($params){
        $this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_capacity.capacity LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_capacity.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_capacity');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function getcapacitydata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_capacity.capacity LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_capacity.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_capacity');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['capacity'] = $value['capacity'];
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'capacity/'.output($value['capacity_id']).'"><i class="fa fa-edit"></i></a> | 
                <a href="'.base_url().'master/deletecapacity/'.output($value['capacity_id']).'" class="icon text-danger"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }
        return $data;
	}
    public function get_capacity_details($id){
        return $this->db->select('*')->from('tbl_capacity')->where('capacity_id',$id)->get()->result_array();
    }

    // =====================================================
    //          START VEHICLE SIZE MASTER
    
    public function getvehiclesizeCount($params){
        $this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_vehicle_size.vsize_name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_vehicle_size.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_vehicle_size');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function getvehiclesizedata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_vehicle_size.vsize_name LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_vehicle_size.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_vehicle_size');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['vsize_name'] = $value['vsize_name'];
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'vehicle_size/'.output($value['vsize_id']).'"><i class="fa fa-edit"></i></a> | 
                <a href="'.base_url().'master/deletevehiclesize/'.output($value['vsize_id']).'" class="icon text-danger"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }
        return $data;
	}
    public function get_vehiclesize_details($id){
        return $this->db->select('*')->from('tbl_vehicle_size')->where('vsize_id',$id)->get()->result_array();
    }
}