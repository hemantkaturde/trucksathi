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


	public function getCategoryCount($params){
		
		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_category_master.category_head LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_category_master.category_subhead LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_category_master.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_category_master');
        $rowcount = $query->num_rows();
        return $rowcount;

	}


	public function getCategorydata($params){

		$this->db->select('*');
        if($params['search']['value'] != "") 
        {
            $this->db->where("(tbl_category_master.category_head LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_category_master.category_subhead LIKE '%".$params['search']['value']."%'");
            $this->db->or_where("tbl_category_master.created_date LIKE '%".$params['search']['value']."%')");
        }
        $query = $this->db->get('tbl_category_master');
        $fetch_result = $query->result_array();

        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0)
        {
            foreach ($fetch_result as $key => $value)
            {
				$data[$counter]['id'] = $counter+1;
                $data[$counter]['category_icon'] = "<img class='img-fluid' style='width: 30px;' src='".base_url().'uploads/category/'.ucwords($value['category_icon'])."'>'.";
				$data[$counter]['category_head'] = $value['category_head'];
                $data[$counter]['category_subhead'] = $value['category_subhead'];
				// $data[$counter]['status'] = "<span class='badge badge-success'>".($value['status']=='1') ? 'Active' : 'Inactive'."</span>";
				if($value['status']=='1'){
					$data[$counter]['status'] = "<span class='badge badge-success'>Active</span>";
				}else{
					$data[$counter]['status'] = "<span class='badge badge-danger'>Inactive</span>";
				}
				
                $data[$counter]['action'] = '<a class="icon" href="'.base_url().'category/editcategory/'.output($value['cat_id']).'"><i class="fa fa-edit"></i></a>
				<a data-toggle="modal" href="" onclick="confirmation('.base_url()."category/deletecategory".'","'.output($value['cat_id']).')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				';
              
                $counter++; 
            }
        }

        return $data;
        
		
	}


	
} 