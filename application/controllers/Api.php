<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
        $this->load->model('geofence_model');
        $this->load->library('form_validation');


    }
    public function index_get() {
         $write_content = var_export($_GET, true);
            file_put_contents("myloggets.php", $write_content);
    }

    public function index_post()   //Get GPS feed in device
    { 
       if(isset($_GET)) {
           $id = isset($_GET['id']) ? $_GET['id'] : ''; 
           $checklogin = $this->api_model->checkgps_auth($id);   
           if($checklogin) 
           { 
            echo $v_id = $checklogin[0]['v_id'];
            $lat = isset($_GET["lat"]) ? $_GET["lat"] : NULL;
            $lon = isset($_GET["lon"]) ? $_GET["lon"] : NULL;
            $timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : NULL;
            $altitude = isset($_GET["altitude"]) ? $_GET["altitude"] : NULL;
            $speed = isset($_GET["speed"]) ? $_GET["speed"] : NULL;
            $bearing = isset($_GET["bearing"]) ? $_GET["bearing"] : NULL;
            $accuracy = isset($_GET["accuracy"]) ? $_GET["accuracy"] : NULL;
            $comment = isset($_GET["comment"]) ? $_GET["comment"] : NULL;
            $postarray = array('v_id'=>$v_id,'latitude'=>$lat,'longitude'=>$lon,'time'=>date('Y-m-d h:i:s'),'altitude'=>$altitude,'speed'=>$speed,'bearing'=>$bearing,'accuracy'=>$accuracy,'comment'=>$comment);
            $this->api_model->add_postion($postarray);
            $this->checkgeofence($v_id,$lat,$lon);
            $response = array('error'=>false,'message'=>['v_id' => $v_id]);
            $this->set_response($response);
           } 
       } else {
           $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : ''; 
           $checklogin = $this->api_model->checkgps_auth($id);   
           if($checklogin) 
           { 
            echo $v_id = $checklogin[0]['v_id'];
            $lat = isset($_REQUEST["lat"]) ? $_REQUEST["lat"] : NULL;
            $lon = isset($_REQUEST["lon"]) ? $_REQUEST["lon"] : NULL;
            $timestamp = isset($_REQUEST["timestamp"]) ? $_REQUEST["timestamp"] : NULL;
            $altitude = isset($_REQUEST["altitude"]) ? $_REQUEST["altitude"] : NULL;
            $speed = isset($_REQUEST["speed"]) ? $_REQUEST["speed"] : NULL;
            $bearing = isset($_REQUEST["bearing"]) ? $_REQUEST["bearing"] : NULL;
            $accuracy = isset($_REQUEST["accuracy"]) ? $_REQUEST["accuracy"] : NULL;
            $comment = isset($_REQUEST["comment"]) ? $_REQUEST["comment"] : NULL;
            $postarray = array('v_id'=>$v_id,'latitude'=>$lat,'longitude'=>$lon,'time'=>date('Y-m-d h:i:s'),'altitude'=>$altitude,'speed'=>$speed,'bearing'=>$bearing,'accuracy'=>$accuracy,'comment'=>$comment);
            $this->api_model->add_postion($postarray);
            $this->checkgeofence($v_id,$lat,$lon);
            $response = array('error'=>false,'message'=>['v_id' => $v_id]);
            $this->set_response($response);
           } 
       }
    }

    public function positions_post()     //Postion feed to front end   
    {
        $this->db->select("*");
        $this->db->from('positions');
        $this->db->where('v_id',$this->post('t_vechicle'));
        $this->db->where('date(time) >=', date("Y-m-d", strtotime(str_replace('/', '-', $this->post('fromdate')))));
        $this->db->where('date(time) <=', date("Y-m-d", strtotime(str_replace('/', '-', $this->post('todate')))));
        $query = $this->db->get();
        $data = $query->result_array();
        $distancefrom = reset($data);
        $distanceto = end($data);
        $totaldist = $this->totaldistance($distancefrom,$distanceto);
        $returndata = array('status'=>1,'data'=>$data,'totaldist'=>$totaldist,'message'=>'data');
        $this->set_response($returndata);
    }

    public function totaldistance($distancefrom,$distanceto,$earthRadius = 6371000)
    {
        $latFrom = deg2rad($distancefrom['latitude']);
        $lonFrom = deg2rad($distancefrom['longitude']);
        $latTo = deg2rad($distanceto['latitude']);
        $lonTo = deg2rad($distanceto['longitude']);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
    public function currentpositions_get()     
    { 
        $data = array();
        $postions = array();
        $this->db->select("p.*,v.v_name,v.v_type,v.v_color");
        $this->db->from('positions p');
        $this->db->join('vehicles v', 'v.v_id = p.v_id');
        $this->db->where('v.v_is_active', 1);
        
        if(isset($_GET['uname'])) { $this->db->where('v.v_api_username',$_GET['uname']);  }

        if(isset($_GET['gr'])) { $this->db->where('v.v_group',$_GET['gr']);  }

        if(isset($_GET['v_id'])) { $this->db->where('v.v_id',$_GET['v_id']);  }

        $this->db->where('`id` IN (SELECT MAX(id) FROM positions GROUP BY `v_id`)', NULL, FALSE);
        $query = $this->db->get();
        $data = $query->result_array();
        if(count($data)>=1) {
            $resp = array('status'=>1,'data'=>$data);
        } else {
            $resp = array('status'=>0,'message'=>'No live GPS feed found');
        }
        $this->set_response($resp);
    }
    public function checkgeofence($vid,$lat,$log)     
    { 
        $vgeofence = $this->geofence_model->getvechicle_geofence($vid);
        if(!empty($vgeofence)) {
            $points = array("$lat $log");
            foreach($vgeofence as $geofencedata) {
                $lastgeo = explode(" ,",$geofencedata['geo_area']);
                $polygon = $geofencedata['geo_area'].$lastgeo[0];
                $polygondata = explode(' , ',$polygon);
                foreach($polygondata as $polygoncln) {
                    $geopolygondata[] = str_replace("," , ' ',$polygoncln); 
                }
                foreach($points as $key => $point) {
                    $geocheck = pointInPolygon($point, $geopolygondata,false);
                    if($geocheck=='outside' || $geocheck=='boundary' || $geocheck=='inside') {
                        $wharray = array('ge_v_id' => $vid, 'ge_geo_id' => $geofencedata['geo_id'], 'ge_event' => $geocheck,
                            'DATE(ge_timestamp)'=>date('Y-m-d'));
                        $geofence_events = $this->db->select('*')->from('geofence_events')->where($wharray)->get()->result_array();
                       
                        if(count($geofence_events)==0) {
                            $insertarray = array('ge_v_id'=>$vid,'ge_geo_id'=>$geofencedata['geo_id'],'ge_event'=>$geocheck,'ge_timestamp'=>
                                       date('Y-m-d h:i:s'));
                            $this->db->insert('geofence_events',$insertarray);
                        } 
                    }
                }
            }
        }
    }


    public function sendotp_post(){

        $post_submit = $this->input->post();
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$status = 'Failure';
			$message = 'Validation error';
			$data = array('mobile_number' =>strip_tags(form_error('mobile_number')));
		}
		else
		{
            $status = 'Success';
            $message = 'OTP Genrated';
            $data = array('mobile_number' => $this->input->post('mobile_number'));
            //$user_data = $this->Api_model->getAuthtoken($data);
            $data = array('otp' =>12345);
        }

        $responseData = array('status' => $status,'message'=> $message,'data' => $data);
		setContentLength($responseData);
    }


    public function verifyotp_post(){

        $post_submit = $this->input->post();
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required');
        $this->form_validation->set_rules('otp', 'OTP', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$status = 'Failure';
			$message = 'Validation error';
			$data = array('mobile_number' =>strip_tags(form_error('mobile_number')),'otp' =>strip_tags(form_error('otp')));
		}
		else
		{
            //$data = array('mobile_number' => $this->input->post('mobile_number'),'otp' => $this->input->post('otp'));
            //$user_data = $this->Api_model->getAuthtoken($data);

            if(trim($this->input->post('otp'))=='12345'){
                $status = 'Success';
                $message = 'OTP verified';
                $data = array('mobile_number' => $this->input->post('mobile_number'),'otp' => $this->input->post('otp'));
            }else{
                $status = 'Failure';
		    	$message = 'Validation error';
                $data = array('mobile_number' => $this->input->post('mobile_number'),'otp' => $this->input->post('otp'));
            }
        }

        $responseData = array('status' => $status,'message'=> $message,'data' => $data);
		setContentLength($responseData);
    }


    public function getcategory_post(){

        $post_submit = $this->input->post();
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$status = 'Failure';
			$message = 'Validation error';
			$data = array('mobile_number' =>strip_tags(form_error('mobile_number')));
		}
		else
		{

                $array_owner  = array('category'=>'owner','category_head'=>'owner','category_subhead'=>'this us for owner only');
                $array_driver  = array('category'=>'driver','category_head'=>'driver','category_subhead'=>'this us for driver only');
                $array_booking_agent  = array('category'=>'booking_agent','category_head'=>'booking agent','category_subhead'=>'this us for booking agen only');
                $array_manufacturer  = array('category'=>'manufacturer','category_head'=>'manufacturer','category_subhead'=>'this us for manufacturer agen only');
            
                $categorylist = array($array_owner,$array_driver,$array_booking_agent,$array_manufacturer);
             
                $status = 'Success';
                $message = 'OTP verified';
                $data = array('mobile_number' => $this->input->post('mobile_number'),'categorylist' => $categorylist);
          
        }

        $responseData = array('status' => $status,'message'=> $message,'data' => $data);
		setContentLength($responseData);


    }


}
