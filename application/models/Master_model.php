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
    // =========================================================
    //      START PROMOTION MASTER 
    public function add_promotion($data) 
	{
		// print_r($data); die;
		if(!empty($_FILES)) {
			$config['upload_path'] = 'uploads/promotion';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx'; 
			$this->load->library('upload', $config); 
			if(!empty($_FILES['promo_banner']['name'][0])){ 
				$uploadData = '';
				$this->upload->initialize($config); 
				$_FILES['file']['name']     = $_FILES['promo_banner']['name']; 
				$_FILES['file']['type']     = $_FILES['promo_banner']['type']; 
				$_FILES['file']['tmp_name'] = $_FILES['promo_banner']['tmp_name']; 
				$_FILES['file']['error']     = $_FILES['promo_banner']['error']; 
				$_FILES['file']['size']     = $_FILES['promo_banner']['size']; 
				if($this->upload->do_upload('file')){ 
					$uploadData = $this->upload->data();
					$data['promo_banner'] = $uploadData['file_name'];
				}
			}
		}
		return	$this->db->insert('tbl_promotion_master',$data);
	} 

    public function get_promotiondetails($id) { 
		return $this->db->select('*')->from('tbl_promotion_master')->where('promo_id',$id)->get()->result_array();
	}

    public function update_promotion(){
        if(!empty($this->input->post('promo_banner_old'))){
			if(!empty($_FILES)) {
				$config['upload_path'] = 'uploads/promotion';
				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx'; 
				$this->load->library('upload', $config); 
				if(!empty($_FILES['promo_banner']['name'][0])){ 
					$uploadData = '';
					$this->upload->initialize($config); 
					$_FILES['file']['name']     = $_FILES['promo_banner']['name']; 
					$_FILES['file']['type']     = $_FILES['promo_banner']['type']; 
					$_FILES['file']['tmp_name'] = $_FILES['promo_banner']['tmp_name']; 
					$_FILES['file']['error']     = $_FILES['promo_banner']['error']; 
					$_FILES['file']['size']     = $_FILES['promo_banner']['size']; 
					if($this->upload->do_upload('file')){ 
						$uploadData = $this->upload->data();
						$_POST['promo_banner'] = $uploadData['file_name'];
						if (file_exists($config['upload_path'].'/'.$_POST['promo_banner_old'])) {
							unlink($config['upload_path'].'/'.$_POST['promo_banner_old']);
						}
					}
				}
			}else{
				$_POST['promo_banner'] = $this->input->post('promo_banner_old');
			}
		}
			
		unset($_POST['promo_banner_old']);
		// print_r($_POST); die;
		$this->db->where('promo_id',$this->input->post('promo_id'));
		return $this->db->update('tbl_promotion_master',$this->input->post());
    }

    public function getPromotionCount($params){
		
		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_promotion_master.promo_title LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_promotion_master.promo_url LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_promotion_master.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_promotion_master');
        $rowcount = $query->num_rows();
        return $rowcount;

	}


	public function getPromotiondata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_promotion_master.promo_title LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_promotion_master.promo_url LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_promotion_master.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_promotion_master');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
                $data[$counter]['prom_banner'] = "<img class='img-fluid' style='width: 30px;' src='".base_url().'uploads/promotion/'.ucwords($value['promo_banner'])."'>";
				$data[$counter]['promo_title'] = $value['promo_title'];
                $data[$counter]['promo_url'] = $value['promo_url'];
				// $data[$counter]['status'] = "<span class='badge badge-success'>".($value['status']=='1') ? 'Active' : 'Inactive'."</span>";
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'master/editpromotion/'.output($value['promo_id']).'"><i class="fa fa-edit"></i></a> | 
				<a data-toggle="modal" href="" onclick="confirmation('.base_url().'master/deletepromotion'.','.output($value['promo_id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				';

                $counter++; 
            }
        }

        return $data;
        
		
	}
    // ==============================================================
}