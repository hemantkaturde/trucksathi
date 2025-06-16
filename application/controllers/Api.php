<?php
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

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
            $random_otp = random_int(100000, 999999);
            $data = array('mobile_number' => $this->input->post('mobile_number'),'otp'=>$random_otp);
            $saveotptodatabase = $this->api_model->submitOTP($data);
          
            if($saveotptodatabase){
             $send_otp_to_devoice = sendotp($data);
             if($send_otp_to_devoice){
                $status = 'Success';
                $message = 'OTP Genrated';
                $data = array('mobile_number' => $this->input->post('mobile_number'),'otp'=>$random_otp);
             }else{
                $status = 'Failure';
                $message = 'OTP Not Genrated';
                $data = array('mobile_number' =>'','otp'=>'');
             }
          
            }
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
            $data = array('mobile_number' => $this->input->post('mobile_number'),'otp' => $this->input->post('otp'));
    
            $verify_otp = $this->api_model->verify_otp($data);
            if($verify_otp){
                if($verify_otp[0]['otp']==trim($this->input->post('otp'))){

                    $userid =  $verify_otp[0]['id'];
                    /* Check if Basic Details are Filled or not */
                    $check_basic_details = $this->api_model->check_if_basic_details_are_filled_or_not($userid);
                    if($check_basic_details){
                        $userinfo = $check_basic_details;
                    }else{
                        $userinfo = array();
                    }

                    $check_kyc_details = $this->api_model->check_if_kyc_details_are_filled_or_not($userid);
                    if($check_kyc_details){
                        $kyc_info = $check_kyc_details;
                    }else{
                        $kyc_info = array();
                    }
            
                    $status = 'Success';
                    $message = 'OTP verified';
                    $data = array('mobile_number' => $this->input->post('mobile_number'),'otp' => $this->input->post('otp'),'userid' => $userid,'userinfo'=> $userinfo,'kyc_info'=>$kyc_info);
                }else{
                    $status = 'Failure';
                    $message = 'OTP verification Failed';
                    $data = array('mobile_number' => '','otp' => '');
                }
            }else{
                $status = 'Failure';
                $message = 'OTP verification Failed';
                $data = array('mobile_number' => '','otp' => '');
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
                $base  = "https://".$_SERVER['HTTP_HOST'];
                $base .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

                $icon1 = $base.'assets/images/TRUCK OWNER.webp';
                $icon2 = $base.'assets/images/DRIVER.webp';
                $icon3 = $base.'assets/images/AGENT.webp';
                $icon4 = $base.'assets/images/MENUFECTURE.webp';
                
                $array_owner  = array('cat_id'=>1,'category_head'=>'Owner','category_subhead'=>'this us for owner only','category_icon'=>$icon1);
                $array_driver  = array('cat_id'=>2,'category_head'=>'Driver','category_subhead'=>'this us for driver only','category_icon'=>$icon2);
                $array_booking_agent  = array('cat_id'=>3,'category_head'=>'Booking Agent','category_subhead'=>'this us for booking agen only','category_icon'=>$icon3);
                $array_manufacturer  = array('cat_id'=>4,'category_head'=>'Manufacturer','category_subhead'=>'this us for manufacturer agen only','category_icon'=>$icon4);


            
                $categorylist = array($array_owner,$array_driver,$array_booking_agent,$array_manufacturer);
             
                $status = 'Success';
                $message = 'OTP verified';
                $data = array('mobile_number' => $this->input->post('mobile_number'),'categorylist' => $categorylist);
          
        }

        $responseData = array('status' => $status,'message'=> $message,'data' => $data);
		setContentLength($responseData);


    }

    public function submitdetails_post(){

        $post_submit = $this->input->post();

        $this->form_validation->set_rules('userid', 'Userid', 'trim|required');
        $this->form_validation->set_rules('category_id', 'categoryid', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim');
        $this->form_validation->set_rules('address', 'address', 'trim');
        $this->form_validation->set_rules('city', 'city', 'trim');
        $this->form_validation->set_rules('pincode', 'pincode', 'trim');

        if ($this->form_validation->run() == FALSE)
		{
            $status = 'Failure';
			$message = 'Validation error';
			$data = array('userid' =>strip_tags(form_error('userid')),'category_id'=>strip_tags(form_error('category_id')),'name' =>strip_tags(form_error('name')),'mobile' =>strip_tags(form_error('mobile')),'email' =>strip_tags(form_error('email')),'address' =>strip_tags(form_error('address')),'city' =>strip_tags(form_error('city')),'pincode' =>strip_tags(form_error('pincode')));
        }else{

            $data = array('app_user_id'=> $this->input->post('userid'),'category_id'=>$this->input->post('category_id'),'name' => $this->input->post('name'),'mobile'=>$this->input->post('mobile'),'email'=>$this->input->post('email'),'address'=>$this->input->post('address'),'city'=>$this->input->post('city'),'pincode'=>$this->input->post('pincode'));
            $submitdetails = $this->api_model->submitbasicdetails('',$data);

             if($submitdetails){
                $status = 'Success';
                $message = 'Data Submitted';
                $data = array('userid' => $this->input->post('userid'),'category_id'=>$this->input->post('category_id'),'name'=>$this->input->post('name'),'mobile'=>$this->input->post('mobile'),'email'=>$this->input->post('email'),'address'=>$this->input->post('address'),'city'=>$this->input->post('city'),'pincode'=>$this->input->post('pincode'));
             }else{
                $status = 'Failure';
                $message = 'Failure data not Submitted';
                $data = array('userid' => '','category_id'=>'','name'=>'','mobile'=>'','email'=>'','address'=>'','city'=>'','pincode'=>'');
             }

            $responseData = array('status' => $status,'message'=> $message,'data' => $data);
            setContentLength($responseData);
        }

    }

    public function submitkyc_details_post(){

        $post_submit = $this->input->post();

        $this->form_validation->set_rules('userinfoid', 'userinfoid', 'trim|required');
        $this->form_validation->set_rules('userid', 'Userid', 'trim|required');
        $this->form_validation->set_rules('category_id', 'categoryid', 'trim|required');
        // $this->form_validation->set_rules('aadhar_card', 'Adhar Card', 'trim|required');
        // $this->form_validation->set_rules('pan_card', 'Pan Card', 'trim|required');
        // $this->form_validation->set_rules('licence', 'Licence', 'trim|required');
        // $this->form_validation->set_rules('gst', 'GST', 'trim|required');
        // $this->form_validation->set_rules('rc_book', 'RC Book', 'trim|required');
        // $this->form_validation->set_rules('user_photo', 'User Photo', 'trim|required');
    
        if ($this->form_validation->run() == FALSE)
		{
            $status = 'Failure';
			$message = 'Validation error';
			$data = array('userinfoid'=>strip_tags(form_error('userinfoid')),'userid' =>strip_tags(form_error('userid')),'category_id'=>strip_tags(form_error('category_id')),'adhar_card'=>strip_tags(form_error('adhar_card')),'pan_card'=>strip_tags(form_error('pan_card')),'licence'=>strip_tags(form_error('licence')),'gst'=>strip_tags(form_error('gst')),'rc_book'=>strip_tags(form_error('rc_book')),'user_photo'=>strip_tags(form_error('user_photo')));
        }else{

                if(!empty($_FILES['aadhar_card']['name'])){

                    $file = rand(1000,100000)."-".$_FILES['aadhar_card']['name'];
                    $filename = str_replace(' ','_',$file);
    
                    $config['upload_path'] = 'uploads/aadhar_card'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size'] = '100000'; // max_size in kb 
                    $config['file_name'] = $filename; 
           
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('aadhar_card')){ 
                       $aadhar_card = $filename; 
                    }else{
                        $aadhar_card =trim($this->input->post('existing_img'));
                    }
    
                }else{
                    $aadhar_card = trim($this->input->post('existing_img'));
                }


                if(!empty($_FILES['pan_card']['name'])){

                    $file = rand(1000,100000)."-".$_FILES['pan_card']['name'];
                    $filename = str_replace(' ','_',$file);
    
                    $config['upload_path'] = 'uploads/pan_card'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size'] = '100000'; // max_size in kb 
                    $config['file_name'] = $filename; 
           
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('pan_card')){ 
                       $pan_card = $filename; 
                    }else{
                        $pan_card =trim($this->input->post('existing_img'));
                    }
    
                }else{
                    $pan_card = trim($this->input->post('existing_img'));
                }


                if(!empty($_FILES['licence']['name'])){

                    $file = rand(1000,100000)."-".$_FILES['licence']['name'];
                    $filename = str_replace(' ','_',$file);
    
                    $config['upload_path'] = 'uploads/licence'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size'] = '100000'; // max_size in kb 
                    $config['file_name'] = $filename; 
           
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('licence')){ 
                       $licence = $filename; 
                    }else{
                        $licence =trim($this->input->post('existing_img'));
                    }
    
                }else{
                    $licence = trim($this->input->post('existing_img'));
                }


                if(!empty($_FILES['gst']['name'])){

                    $file = rand(1000,100000)."-".$_FILES['gst']['name'];
                    $filename = str_replace(' ','_',$file);
    
                    $config['upload_path'] = 'uploads/gst'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size'] = '100000'; // max_size in kb 
                    $config['file_name'] = $filename; 
           
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('gst')){ 
                       $gst = $filename; 
                    }else{
                       $gst =trim($this->input->post('existing_img'));
                    }
    
                }else{
                    $gst = trim($this->input->post('existing_img'));
                }

                
                if(!empty($_FILES['rc_book']['name'])){

                    $file = rand(1000,100000)."-".$_FILES['rc_book']['name'];
                    $filename = str_replace(' ','_',$file);
    
                    $config['upload_path'] = 'uploads/rc_book'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size'] = '100000'; // max_size in kb 
                    $config['file_name'] = $filename; 
           
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('rc_book')){ 
                       $rc_book = $filename; 
                    }else{
                       $rc_book =trim($this->input->post('existing_img'));
                    }
    
                }else{
                    $rc_book = trim($this->input->post('existing_img'));
                }


                if(!empty($_FILES['user_photo']['name'])){

                    $file = rand(1000,100000)."-".$_FILES['user_photo']['name'];
                    $filename = str_replace(' ','_',$file);
    
                    $config['upload_path'] = 'uploads/user_photo'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size'] = '100000'; // max_size in kb 
                    $config['file_name'] = $filename; 
           
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('user_photo')){ 
                       $user_photo = $filename; 
                    }else{
                       $user_photo =trim($this->input->post('existing_img'));
                    }
    
                }else{
                    $user_photo = trim($this->input->post('existing_img'));
                }


                      $data = array(
                        //   'userinfoid'=> $this->input->post('userinfoid'),
                        //   'userid'=>$this->input->post('userid'),
                        //   'category_id'=>$this->input->post('category_id'),
                          'aadhar_card'=> $aadhar_card,
                          'pan_card'=>$pan_card,
                          'licence'=>$licence,
                          'gst'=>$gst,
                          'rc_book'=>$rc_book,
                          'user_photo'=>$user_photo,
                          'kyc_status'=>1
                        );

            $submitdetails = $this->api_model->submitbasicdetails($this->input->post('userinfoid'),$data);

             if($submitdetails){
                $status = 'Success';
                $message = 'KYC Submitted';
			    $data = array('userinfoid'=>$this->input->post('userinfoid'),'userid' =>$this->input->post('userid'),'category_id'=>$this->input->post('category_id'),'adhar_card'=>$this->input->post('adhar_card'),'pan_card'=>$this->input->post('pan_card'),'licence'=>$this->input->post('licence'),'gst'=>$this->input->post('gst'),'rc_book'=>$this->input->post('rc_book'),'user_photo'=>$this->input->post('user_photo'));
             }else{
                $status = 'Failure';
                $message = 'Failure data not Submitted';
			    $data = array('userinfoid'=>strip_tags(form_error('userinfoid')),'userid' =>strip_tags(form_error('userid')),'category_id'=>strip_tags(form_error('category_id')),'adhar_card'=>strip_tags(form_error('adhar_card')),'pan_card'=>strip_tags(form_error('pan_card')),'licence'=>strip_tags(form_error('licence')),'gst'=>strip_tags(form_error('gst')),'rc_book'=>strip_tags(form_error('rc_book')),'user_photo'=>strip_tags(form_error('user_photo')));
             }

            $responseData = array('status' => $status,'message'=> $message,'data' => $data);
            setContentLength($responseData);
        }
    }


}
