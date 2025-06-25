<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_users extends CI_Controller {

	 function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('app_user_model');
          $this->load->helper(array('form', 'url','string'));
          $this->load->library('form_validation');
          $this->load->library('session');

          error_reporting(E_ALL);
        ini_set('display_errors', 1);

     }

	public function index()
	{
		$data['appuserslist'] = $this->app_user_model->getall_app_users_details();
		$this->template->template_render('app_users_list',$data);
	}

    public function addnew_app_user(){
        
        $data['categoryData'] = $this->app_user_model->getall_category();
        $this->template->template_render('app_user_add',$data);
    }

    public function insertApp_user(){
        $data = $this->input->post();
        if(isset($data['id'])){
            $exist = $this->db->select('*')->from('tbl_appuser_info')->where('id !=',$this->input->post('id'))->where('name',$this->input->post('name'))->get()->num_rows();
			if($exist == 0) {
                $this->db->where('id',$data['id']);
                $response = $this->db->update('tbl_appuser_info',$data);
                if($response==1){
                    echo 2;
                }
            }else{
                echo 3;
            }
        }else{
            $exist = $this->db->select('*')->from('tbl_appuser_info')->where('name',$this->input->post('name'))->get()->num_rows();
            if($exist == 0) {
                $response = $this->db->insert('tbl_appuser_info',$data);
                if($response==1){
                    echo 1;
                }
            }else{
                echo 3;
            }
        }
        
        
    }

    public function editapp_users($id){
        
        $id = $this->uri->segment(3);
		$data['appuserdetails'] = $this->app_user_model->get_app_users_details($id);
        $data['categoryData'] = $this->app_user_model->getall_category();
		$this->template->template_render('app_user_add',$data);
    }

    public function delete_app_users(){
        $id = $this->input->post('del_id');
		$deleteresp = $this->db->delete('tbl_appuser_info', array('id' => $id));
		if($deleteresp) {
			$this->session->set_flashdata('successmessage', 'category deleted successfully..');
		} else {
			$this->session->set_flashdata('warningmessage', 'Unexpected error..Try again');
		}
		redirect('app_users');
    }
}
?>