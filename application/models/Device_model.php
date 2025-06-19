<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Device_model extends CI_Model{
	
	public function add_device($data) 
	{
		// print_r($data); die;
		if(!empty($_FILES)) {
			$config['upload_path'] = 'uploads/device_image';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx'; 
			$this->load->library('upload', $config); 
			if(!empty($_FILES['device_image']['name'][0])){ 
				$uploadData = '';
				$this->upload->initialize($config); 
				$_FILES['file']['name']     = $_FILES['device_image']['name']; 
				$_FILES['file']['type']     = $_FILES['device_image']['type']; 
				$_FILES['file']['tmp_name'] = $_FILES['device_image']['tmp_name']; 
				$_FILES['file']['error']     = $_FILES['device_image']['error']; 
				$_FILES['file']['size']     = $_FILES['device_image']['size']; 
				if($this->upload->do_upload('file')){ 
					$uploadData = $this->upload->data();
					$data['device_image'] = $uploadData['file_name'];
				}
			}
		}
		return	$this->db->insert('tbl_device_master',$data);
	} 
    public function getall_device() { 
		return $this->db->select('*')->from('tbl_device_master')->order_by('id','desc')->get()->result_array();
	} 
	public function get_devicedetails($id) { 
		return $this->db->select('*')->from('tbl_device_master')->where('id',$id)->get()->result_array();
	} 
	public function update_device() { 
		if(!empty($this->input->post('device_image_old'))){
			if(!empty($_FILES)) {
				$config['upload_path'] = 'uploads/device_image';
				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx'; 
				$this->load->library('upload', $config); 
				if(!empty($_FILES['device_image']['name'][0])){ 
					$uploadData = '';
					$this->upload->initialize($config); 
					$_FILES['file']['name']     = $_FILES['device_image']['name']; 
					$_FILES['file']['type']     = $_FILES['device_image']['type']; 
					$_FILES['file']['tmp_name'] = $_FILES['device_image']['tmp_name']; 
					$_FILES['file']['error']     = $_FILES['device_image']['error']; 
					$_FILES['file']['size']     = $_FILES['device_image']['size']; 
					if($this->upload->do_upload('file')){ 
						$uploadData = $this->upload->data();
						$_POST['device_image'] = $uploadData['file_name'];
						if (file_exists($config['upload_path'].'/'.$_POST['device_image_old'])) {
							unlink($config['upload_path'].'/'.$_POST['device_image_old']);
						}
					}
				}
			}else{
				$_POST['device_image'] = $this->input->post('device_image_old');
			}
		}
			
		unset($_POST['device_image_old']);
		$this->db->where('id',$this->input->post('id'));
		return $this->db->update('tbl_device_master',$this->input->post());
	}

	
} 