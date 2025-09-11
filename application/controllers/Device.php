<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {

	 function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('device_model');
          $this->load->helper(array('form', 'url','string'));
          $this->load->library('form_validation');
          $this->load->library('session');
     }

	public function index()
	{
		$data['devicelist'] = $this->device_model->getall_device();
		$this->template->template_render('device_master',$data);
	}

	public function fetchDevicelist(){
		$params = $_REQUEST;
        $totalRecords = $this->device_model->getDeviceCount($params); 
        $queryRecords = $this->device_model->getDevicedata($params); 

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

    public function addnew_device(){
        $this->template->template_render('device_add');
    }

    public function insertdevice()
	{
		// $testxss = xssclean($_POST);
		// if($testxss){
			$_POST['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
			$exist = $this->db->select('*')->from('tbl_device_master')->where('device_name',$this->input->post('device_name'))->get()->num_rows();
			if($exist == 0) {
				$response = $this->device_model->add_device($this->input->post());

				if($response) {
					$this->session->set_flashdata('successmessage', 'New Device added successfully..');
				} else {
					$this->session->set_flashdata('warningmessage', 'Something went wrong.');
				}
			} else {
				$this->session->set_flashdata('warningmessage', 'Device name already exist.');
			}
			redirect('device');
		// } else {
		// 	$this->session->set_flashdata('warningmessage', 'Error! Your input are not allowed.Please try again');
		// 	redirect('device');
		// }
	}

    public function editdevice(){
        $id = $this->uri->segment(3);
		$data['devicedetails'] = $this->device_model->get_devicedetails($id);
		$this->template->template_render('device_add',$data);
    }

    public function updatedevice(){

        // $testxss = xssclean($_POST);
		// if($testxss){
			$_POST['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
            $exist = $this->db->select('*')->from('tbl_device_master')->where('id !=',$this->input->post('id'))->where('device_name',$this->input->post('device_name'))->get()->num_rows();
			if($exist == 0) {
                $response = $this->device_model->update_device($this->input->post());

				if($response) {
					$this->session->set_flashdata('successmessage', 'Device updated successfully..');
				} else
				{
					$this->session->set_flashdata('warningmessage', 'Something went wrong..Try again');
				}
            }else{
                $this->session->set_flashdata('warningmessage', 'Device name already exist.');
            }
            redirect('device');
			    
		// } else {
		// 	$this->session->set_flashdata('warningmessage', 'Error! Your input are not allowed.Please try again');
		// 	redirect('device');
		// }
    }

    public function deletedevice(){
        $id = $this->input->post('del_id');
        
		$deleteresp = $this->db->delete('tbl_device_master', array('id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'Device deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('device');
    }

	// ==========================================

	public function device_order(){
		$this->template->template_render('device_order');
	}

	public function fetchDeviceOrderlist(){
		$params = $_REQUEST;
        $totalRecords = $this->device_model->getDeviceOrderCount($params); 
        $queryRecords = $this->device_model->getDeviceOrderdata($params);

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
	// ==========================================
}
?>