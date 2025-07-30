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

    public function deletebodyType($id){
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
}
?>