<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	 function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('master_model');
          $this->load->helper(array('form', 'url','string'));
          $this->load->library('form_validation');
          $this->load->library('session');
     }

	public function body_type($id=NULL)
	{
		// $data['bodyTypelist'] = $this->master_model->getall_bodyType();
        $data['title'] = 'Body type';
        if(isset($id) && $id !=NULL){
            $data['btypedetails'] = $this->master_model->get_bodytype_details($id);
        }
		$this->template->template_render('master/bodyType_master',$data);
	}

    public function insert_bodyType(){
        $data = $this->input->post();
        // print_r($data); die;
        if(isset($data['btype_id'])){
            $exist = $this->db->select('*')->from('tbl_body_type')->where('btype_id !=',$this->input->post('btype_id'))->where('btype_name',$this->input->post('btype_name'))->get()->num_rows();
			if($exist == 0) {
                $data['updated_date'] = date("Y-m-d H:i:s");
                $data['updated_by'] = $_SESSION['session_data']['u_id'];
                $this->db->where('btype_id',$data['btype_id']);
                $response = $this->db->update('tbl_body_type',$data);
                if($response==1){
                    echo 2;
                }
            }else{
                echo 3;
            }
        }else{
            $exist = $this->db->select('*')->from('tbl_body_type')->where('btype_name',$this->input->post('btype_name'))->get()->num_rows();
            if($exist == 0) {
                $data['created_by'] = $_SESSION['session_data']['u_id'];
                $response = $this->db->insert('tbl_body_type',$data);
                if($response==1){
                    echo 1;
                }
            }else{
                echo 3;
            }
        }
    }

    public function bodytypelist(){
        $params = $_REQUEST;
        $totalRecords = $this->master_model->getbodyTypeCount($params); 
        $queryRecords = $this->master_model->getbodyTypedata($params); 

        // print_r($queryRecords); die;
        $data = array();
        foreach ($queryRecords as $key => $value)
        {
            $i = 0;
            foreach($value as $v)
            {
                $data[$key][$i] = $v;
                $i++;
            }
        }
        $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data   // total data array
            );
        echo json_encode($json_data);
    }

    public function deletebodyType(){
        $id = $this->input->post('del_id');
		$deleteresp = $this->db->delete('tbl_body_type', array('btype_id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'Body type deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('bodyType');
    }
    // ======================================================

    public function tyre_master($id=NULL)
	{
		// $data['bodyTypelist'] = $this->master_model->getall_bodyType();
        $data['title'] = 'Tyre Master';
        // echo "<pre>";print_r($_SESSION['session_data']['u_id']); die;
        if(isset($id) && $id !=NULL){
            $data['tyredetails'] = $this->master_model->get_tyre_details($id);
        }
		$this->template->template_render('master/tyre_master',$data);
	}

    public function insert_tyre(){
        $data = $this->input->post();
 
        if(isset($data['tyre_id'])){
            $exist = $this->db->select('*')->from('tbl_tyre')->where('tyre_id !=',$this->input->post('tyre_id'))->where('tyre_name',$this->input->post('tyre_name'))->get()->num_rows();
			if($exist == 0) {
                $data['updated_date'] = date("Y-m-d H:i:s");
                $data['updated_by'] = $_SESSION['session_data']['u_id'];
                $this->db->where('tyre_id',$data['tyre_id']);
                $response = $this->db->update('tbl_tyre',$data);
                if($response==1){
                    echo 2;
                }
            }else{
                echo 3;
            }
        }else{
            $exist = $this->db->select('*')->from('tbl_tyre')->where('tyre_name',$this->input->post('tyre_name'))->get()->num_rows();
            if($exist == 0) {
                $data['created_by'] = $_SESSION['session_data']['u_id'];
                $response = $this->db->insert('tbl_tyre',$data);
                if($response==1){
                    echo 1;
                }
            }else{
                echo 3;
            }
        }
    }

    public function tyrelist(){
        $params = $_REQUEST;
        $totalRecords = $this->master_model->get_tyreCount($params); 
        $queryRecords = $this->master_model->get_tyredata($params); 

        // print_r($queryRecords); die;
        $data = array();
        foreach ($queryRecords as $key => $value)
        {
            $i = 0;
            foreach($value as $v)
            {
                $data[$key][$i] = $v;
                $i++;
            }
        }
        $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data   // total data array
            );
        echo json_encode($json_data);
    }

    public function deletetyre(){
        $id = $this->input->post('del_id');
		$deleteresp = $this->db->delete('tbl_tyre', array('tyre_id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'Tyre deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('tyre_master');
    }
    // =============================================
    // =========== CAPCITY MASTER START ============
    public function capacity($id=NULL)
	{
        $data['title'] = 'Capacity';
        if(isset($id) && $id !=NULL){
            $data['capacitydetails'] = $this->master_model->get_capacity_details($id);
        }
		$this->template->template_render('master/capacity_master',$data);
	}

    public function insert_capacity(){
        $data = $this->input->post();
        if(isset($data['capacity_id'])){
            $exist = $this->db->select('*')->from('tbl_capacity')->where('capacity_id !=',$this->input->post('capacity_id'))->where('capacity',$this->input->post('capacity'))->get()->num_rows();
			if($exist == 0) {
                $data['updated_date'] = date("Y-m-d H:i:s");
                $data['updated_by'] = $_SESSION['session_data']['u_id'];
                $this->db->where('capacity_id',$data['capacity_id']);
                $response = $this->db->update('tbl_capacity',$data);
                if($response==1){
                    echo 2;
                }
            }else{
                echo 3;
            }
        }else{
            $exist = $this->db->select('*')->from('tbl_capacity')->where('capacity',$this->input->post('capacity'))->get()->num_rows();
            if($exist == 0) {
                $data['created_by'] = $_SESSION['session_data']['u_id'];
                $response = $this->db->insert('tbl_capacity',$data);
                if($response==1){
                    echo 1;
                }
            }else{
                echo 3;
            }
        }
    }

    public function capacitylist(){
        $params = $_REQUEST;
        $totalRecords = $this->master_model->getcapacityCount($params); 
        $queryRecords = $this->master_model->getcapacitydata($params); 

        // print_r($queryRecords); die;
        $data = array();
        foreach ($queryRecords as $key => $value)
        {
            $i = 0;
            foreach($value as $v)
            {
                $data[$key][$i] = $v;
                $i++;
            }
        }
        $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data   // total data array
            );
        echo json_encode($json_data);
    }

    public function deletecapacity(){
        $id = $this->input->post('del_id');
		$deleteresp = $this->db->delete('tbl_capacity', array('capacity_id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'Capacity deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('capacity');
    }
    // =========== CAPCITY MASTER END ============
    // =============================================
    // =========== VEHICLE SIZE MASTER START ============
    public function vehicle_size($id=NULL)
	{
        $data['title'] = 'Vehicle size';
        if(isset($id) && $id !=NULL){
            $data['vehiclesizedetails'] = $this->master_model->get_vehiclesize_details($id);
        }
		$this->template->template_render('master/vehicle_size_master',$data);
	}

    public function insert_vehiclesize(){
        $data = $this->input->post();
        if(isset($data['vsize_id'])){
            $exist = $this->db->select('*')->from('tbl_vehicle_size')->where('vsize_id !=',$this->input->post('vsize_id'))->where('vsize_name',$this->input->post('vsize_name'))->get()->num_rows();
			if($exist == 0) {
                $data['updated_date'] = date("Y-m-d H:i:s");
                $data['updated_by'] = $_SESSION['session_data']['u_id'];
                $this->db->where('vsize_id',$data['vsize_id']);
                $response = $this->db->update('tbl_vehicle_size',$data);
                if($response==1){
                    echo 2;
                }
            }else{
                echo 3;
            }
        }else{
            $exist = $this->db->select('*')->from('tbl_vehicle_size')->where('vsize_name',$this->input->post('vsize_name'))->get()->num_rows();
            if($exist == 0) {
                $data['created_by'] = $_SESSION['session_data']['u_id'];
                $response = $this->db->insert('tbl_vehicle_size',$data);
                if($response==1){
                    echo 1;
                }
            }else{
                echo 3;
            }
        }
    }

    public function vehiclesizelist(){
        $params = $_REQUEST;
        $totalRecords = $this->master_model->getvehiclesizeCount($params); 
        $queryRecords = $this->master_model->getvehiclesizedata($params); 

        // print_r($queryRecords); die;
        $data = array();
        foreach ($queryRecords as $key => $value)
        {
            $i = 0;
            foreach($value as $v)
            {
                $data[$key][$i] = $v;
                $i++;
            }
        }
        $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data   // total data array
            );
        echo json_encode($json_data);
    }

    public function deletevehiclesize(){
        $id = $this->input->post('del_id');

		$deleteresp = $this->db->delete('tbl_vehicle_size', array('vsize_id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'Vehicle size deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('vehicle_size');
    }

    // ===============================================
    // =========== PROMOTION MASTER START ============
    public function promotion($id=NULL)
	{
        $data['title'] = 'Promotion';
        // $data['promotionlist'] = $this->master_model->getall_promotion();
		$this->template->template_render('master/promotion_master',$data);
	}

    public function fetchPromotionlist()
	{
		$params = $_REQUEST;
        $totalRecords = $this->master_model->getPromotionCount($params); 
        $queryRecords = $this->master_model->getPromotiondata($params); 

        $data = array();
        foreach ($queryRecords as $key => $value)
        {
            $i = 0;
            foreach($value as $v)
            {
                $data[$key][$i] = $v;
                $i++;
            }
        }
        $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data   // total data array
            );
        echo json_encode($json_data);
	}

    public function addnew_promotion(){
        $this->template->template_render('master/promotion_add');
    }

    public function insertpromotion()
	{
		$testxss = xssclean($_POST);
		if($testxss){

			$exist = $this->db->select('*')->from('tbl_promotion_master')->where('promo_title',$this->input->post('promo_title'))->get()->num_rows();
			if($exist == 0) {
				$response = $this->master_model->add_promotion($this->input->post());

				if($response) {
					$this->session->set_flashdata('successmessage', 'New promotion added successfully..');
				} else {
					$this->session->set_flashdata('warningmessage', 'Something went wrong.');
				}
			} else {
				$this->session->set_flashdata('warningmessage', 'Promotion title already exist.');
			}
			redirect('promotion');
		} else {
			$this->session->set_flashdata('warningmessage', 'Error! Your input are not allowed.Please try again');
			redirect('promotion');
		}
	}

    public function editpromotion(){
        $id = $this->uri->segment(3);
		$data['promotiondetails'] = $this->master_model->get_promotiondetails($id);
		$this->template->template_render('master/promotion_add',$data);
    }

    public function updatepromotion(){
		
        $testxss = xssclean($_POST);
		if($testxss){
            $exist = $this->db->select('*')->from('tbl_promotion_master')->where('promo_id !=',$this->input->post('promo_id'))->where('promo_title',$this->input->post('promo_title'))->get()->num_rows();
			if($exist == 0) {
                $response = $this->master_model->update_promotion($this->input->post());
				if($response) {
					$this->session->set_flashdata('successmessage', 'promotion updated successfully..');
				} else
				{
					$this->session->set_flashdata('warningmessage', 'Something went wrong..Try again');
				}
            }else{
                $this->session->set_flashdata('warningmessage', 'promotion title already exist.');
            }
            redirect('promotion');
			    
		} else {
			$this->session->set_flashdata('warningmessage', 'Error! Your input are not allowed.Please try again');
			redirect('promotion');
		}
    }

    public function deletepromotion(){
        $id = $this->input->post('del_id');
        
		$deleteresp = $this->db->delete('tbl_promotion_master', array('promo_id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'Promotion deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('promotion');
    }

    // ===============================================
}
?>