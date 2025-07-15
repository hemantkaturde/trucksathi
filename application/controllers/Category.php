<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	 function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('category_model');
          $this->load->helper(array('form', 'url','string'));
          $this->load->library('form_validation');
          $this->load->library('session');
     }

	public function index()
	{
		$data['categorylist'] = $this->category_model->getall_category();
		$globle['pagetitle'] = 'Category List';
		$this->template->template_render('category_master',$data,$globle);
	}

    public function addnew_category(){
        $this->template->template_render('category_add');
    }

    public function insertcategory()
	{
		$testxss = xssclean($_POST);
		if($testxss){

			$exist = $this->db->select('*')->from('tbl_category_master')->where('category_head',$this->input->post('category_head'))->get()->num_rows();
			if($exist == 0) {
				$response = $this->category_model->add_category($this->input->post());

				if($response) {
					$this->session->set_flashdata('successmessage', 'New category added successfully..');
				} else {
					$this->session->set_flashdata('warningmessage', 'Something went wrong.');
				}
			} else {
				$this->session->set_flashdata('warningmessage', 'category name already exist.');
			}
			redirect('category');
		} else {
			$this->session->set_flashdata('warningmessage', 'Error! Your input are not allowed.Please try again');
			redirect('category');
		}
	}

    public function editcategory(){
        $id = $this->uri->segment(3);
		$data['categorydetails'] = $this->category_model->get_categorydetails($id);
		$this->template->template_render('category_add',$data);
    }

    public function updatecategory(){
		
        $testxss = xssclean($_POST);
		if($testxss){
            $exist = $this->db->select('*')->from('tbl_category_master')->where('cat_id !=',$this->input->post('cat_id'))->where('category_head',$this->input->post('category_head'))->get()->num_rows();
			if($exist == 0) {
                $response = $this->category_model->update_category($this->input->post());
				if($response) {
					$this->session->set_flashdata('successmessage', 'category updated successfully..');
				} else
				{
					$this->session->set_flashdata('warningmessage', 'Something went wrong..Try again');
				}
            }else{
                $this->session->set_flashdata('warningmessage', 'category name already exist.');
            }
            redirect('category');
			    
		} else {
			$this->session->set_flashdata('warningmessage', 'Error! Your input are not allowed.Please try again');
			redirect('category');
		}
    }

    public function deletecategory(){
        $id = $this->input->post('del_id');
        
		$deleteresp = $this->db->delete('tbl_category_master', array('cat_id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'category deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('category');
    }
}
?>