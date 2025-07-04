<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model{
	
	public function add_category($data) 
	{
		// print_r($data); die;
		if(!empty($_FILES)) {
			$config['upload_path'] = 'uploads/category';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx'; 
			$this->load->library('upload', $config); 
			if(!empty($_FILES['category_icon']['name'][0])){ 
				$uploadData = '';
				$this->upload->initialize($config); 
				$_FILES['file']['name']     = $_FILES['category_icon']['name']; 
				$_FILES['file']['type']     = $_FILES['category_icon']['type']; 
				$_FILES['file']['tmp_name'] = $_FILES['category_icon']['tmp_name']; 
				$_FILES['file']['error']     = $_FILES['category_icon']['error']; 
				$_FILES['file']['size']     = $_FILES['category_icon']['size']; 
				if($this->upload->do_upload('file')){ 
					$uploadData = $this->upload->data();
					$data['category_icon'] = $uploadData['file_name'];
				}
			}
		}
		return	$this->db->insert('tbl_category_master',$data);
	} 
    public function getall_category() { 
		return $this->db->select('*')->from('tbl_category_master')->order_by('cat_id','desc')->get()->result_array();
	} 
	public function get_categorydetails($id) { 
		return $this->db->select('*')->from('tbl_category_master')->where('cat_id',$id)->get()->result_array();
	} 
	public function update_category() { 
		if(!empty($this->input->post('category_icon_old'))){
			if(!empty($_FILES)) {
				$config['upload_path'] = 'uploads/category';
				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx'; 
				$this->load->library('upload', $config); 
				if(!empty($_FILES['category_icon']['name'][0])){ 
					$uploadData = '';
					$this->upload->initialize($config); 
					$_FILES['file']['name']     = $_FILES['category_icon']['name']; 
					$_FILES['file']['type']     = $_FILES['category_icon']['type']; 
					$_FILES['file']['tmp_name'] = $_FILES['category_icon']['tmp_name']; 
					$_FILES['file']['error']     = $_FILES['category_icon']['error']; 
					$_FILES['file']['size']     = $_FILES['category_icon']['size']; 
					if($this->upload->do_upload('file')){ 
						$uploadData = $this->upload->data();
						$_POST['category_icon'] = $uploadData['file_name'];
						if (file_exists($config['upload_path'].'/'.$_POST['category_icon_old'])) {
							unlink($config['upload_path'].'/'.$_POST['category_icon_old']);
						}
					}
				}
			}else{
				$_POST['category_icon'] = $this->input->post('category_icon_old');
			}
		}
			
		unset($_POST['category_icon_old']);
		// print_r($_POST); die;
		$this->db->where('cat_id',$this->input->post('cat_id'));
		return $this->db->update('tbl_category_master',$this->input->post());
	}

	
} 