

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

	public function getDeviceCount($params){
		
		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->group_start(); // Open bracket (
			$this->db->like('tbl_device_master.device_name', $params['search']['value']);
			$this->db->or_like('tbl_device_master.model_number', $params['search']['value']);
			$this->db->or_like('tbl_device_master.serial_number', $params['search']['value']);
			$this->db->or_like('tbl_device_master.price', $params['search']['value']);
			$this->db->or_like('tbl_device_master.description', $params['search']['value']);
            $this->db->group_end(); // Close bracket )
        }
        $query = $this->db->get('tbl_device_master');
        $rowcount = $query->num_rows();
        return $rowcount;
	}

	public function getDevicedata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->group_start(); // Open bracket (
			$this->db->like('tbl_device_master.device_name', $params['search']['value']);
			$this->db->or_like('tbl_device_master.model_number', $params['search']['value']);
			$this->db->or_like('tbl_device_master.serial_number', $params['search']['value']);
			$this->db->or_like('tbl_device_master.price', $params['search']['value']);
			$this->db->or_like('tbl_device_master.description', $params['search']['value']);
            $this->db->group_end(); // Close bracket )
        }
        $query = $this->db->get('tbl_device_master');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
                $data[$counter]['device_image'] = "<img class='img-fluid' style='width: 30px;' src='".base_url().'uploads/device_image/'.ucwords($value['device_image'])."'>'.";
				$data[$counter]['device_name'] = $value['device_name'];
				$data[$counter]['device_type'] = $value['device_type'];
                $data[$counter]['model_number'] = $value['model_number'];
				$data[$counter]['serial_number'] = $value['serial_number'];
				$data[$counter]['price'] = $value['price'];
				// $data[$counter]['description'] = $value['description'];
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'device/editdevice/'.output($value['id']).'"><i class="fa fa-edit"></i></a> | 
				<a data-toggle="modal" href="" onclick="confirmation('.base_url()."device/deletedevice".'","'.output($value['id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				';
              
                $counter++; 
            }
        }

        return $data;
        
		
	}
} 