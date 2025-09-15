

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
				<a data-toggle="modal" href="" onclick="confirmation('."'".base_url()."device/deletedevice"."',".output($value['id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				';
              
                $counter++; 
            }
        }

        return $data;
        
		
	}

	// ===================================================

	public function getDeviceOrderCount($params){
		// $this->db->select('*');
		$this->db->select('tbl_appuser_info.id as user_id,tbl_appuser_info.name,tbl_device_order.id as id, tbl_device_order.*');
        if($params['search']['value'] != "") 
        {
			$this->db->group_start(); // Open bracket (
			$this->db->like('tbl_device_order.theft_protection', $params['search']['value']);
			$this->db->or_like('tbl_device_order.theft_protection_amount', $params['search']['value']);
			$this->db->or_like('tbl_device_order.device_count', $params['search']['value']);
			$this->db->or_like('tbl_device_order.device_amount', $params['search']['value']);
			$this->db->or_like('tbl_device_order.gst_percentage', $params['search']['value']);
			$this->db->or_like('tbl_device_order.gst_value', $params['search']['value']);
			$this->db->or_like('tbl_device_order.grand_total', $params['search']['value']);
			$this->db->or_like('tbl_appuser_info.name', $params['search']['value']);
			$this->db->or_like('tbl_device_master.device_name', $params['search']['value']);
			$this->db->group_end(); // Close bracket )
        }
        $this->db->from('tbl_device_order');
		$this->db->join('tbl_appuser_info', 'tbl_appuser_info.id=tbl_device_order.userid','left');
		$this->db->join('tbl_device_master', 'tbl_device_master.id=tbl_device_order.deviceid','left');
		$query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
	}

	public function getDeviceOrderdata($params){
		$this->db->select('tbl_appuser_info.id as user_id,tbl_appuser_info.name,tbl_device_order.id as id, tbl_device_order.*');
		// $this->db->select('*');
        if($params['search']['value'] != "") 
        {
			$this->db->group_start();
			$this->db->like('tbl_device_order.theft_protection', $params['search']['value']);
			$this->db->or_like('tbl_device_order.theft_protection_amount', $params['search']['value']);
			$this->db->or_like('tbl_device_order.device_count', $params['search']['value']);
			$this->db->or_like('tbl_device_order.device_amount', $params['search']['value']);
			$this->db->or_like('tbl_device_order.gst_percentage', $params['search']['value']);
			$this->db->or_like('tbl_device_order.gst_value', $params['search']['value']);
			$this->db->or_like('tbl_device_order.grand_total', $params['search']['value']);
			$this->db->or_like('tbl_appuser_info.name', $params['search']['value']);
			$this->db->or_like('tbl_device_master.device_name', $params['search']['value']);
			$this->db->group_end();
        }
        $this->db->from('tbl_device_order');
		$this->db->join('tbl_appuser_info', 'tbl_appuser_info.id=tbl_device_order.userid','left');
		$this->db->join('tbl_device_master', 'tbl_device_master.id=tbl_device_order.deviceid','left');
		$query = $this->db->get();

        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['name'] = $value['name'];
				$data[$counter]['device_name'] = $value['device_name'];
                // $data[$counter]['theft_protection'] = $value['theft_protection'];
				if($value['theft_protection']=='1'){
					$data[$counter]['theft_protection'] = "<span class='badge badge-success'>YES</span>";
				}else{
					$data[$counter]['theft_protection'] = "<span class='badge badge-danger'>NO</span>";
				}
				$data[$counter]['theft_protection_amount'] = $value['theft_protection_amount'];
				$data[$counter]['device_count'] = $value['device_count'];
				$data[$counter]['device_amount'] = $value['device_amount'];
				$data[$counter]['gst_percentage'] = $value['gst_percentage'];
				$data[$counter]['gst_value'] = $value['gst_value'];
				$data[$counter]['grand_total'] = $value['grand_total'];
				
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'device/download_invoice/'.output($value['id']).'"><i class="fa fa-download" title="Download Invoice"></i></a> | 
											<a class="icon text-success" href="#"><i class="fa fa-file" title="Certificate"></i></a> 
				';
              
                $counter++; 
            }
        }
        return $data;
	}

	public function getInvoicedata($id){
		// $this->db->select('tbl_appuser_info.id as user_id,tbl_appuser_info.name,tbl_device_order.id as id, tbl_device_order.*');
		$this->db->select('do.*, ai.id as user_id, ai.name as name, ai.mobile_number, ai.email, ai.address, ai.company_name, dm.id as device_id, dm.device_name');
        $this->db->from('tbl_device_order do');
		$this->db->join('tbl_appuser_info ai', 'ai.id=do.userid','left');
		$this->db->join('tbl_device_master dm', 'dm.id=do.deviceid','left');
		$this->db->where('do.id',$id);
		$query = $this->db->get();
        $fetch_result= $query->result_array();

		// $fetch_result['customerData'] = $this->db->select('*')->from('tbl_appuser_info')->where('id',$u_id)->get()->row();

        return $fetch_result;
	}

	// ===================================================
} 