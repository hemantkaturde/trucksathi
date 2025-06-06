<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function reformatDate($date, $to_format = 'Y-m-d') {
		$from_format = dateformat();
		$date_aux = date_create_from_format($from_format, $date);
		return date_format($date_aux,$to_format);
	}

	function reformatDatetime($date, $to_format = 'Y-m-d H:i') {
		$from_format = datetimeformat();
		$date_aux = date_create_from_format($from_format, $date);
		return date_format($date_aux,$to_format);
	}

	function xssclean($post)
	{
		$rtn = true; 
		if($post) {
			foreach ($post as $key => $data) {
				if (preg_match("/</i", $data, $match))  {
   					$rtn = false; 
   				}
			}
		}
		return $rtn;
	}

	function output($data) 
	{
		if(isset($data)) {
			return html_escape($data);
		} else {
			return '';
		}
	}
	function pointInPolygon($point, $polygon, $pointOnVertex = true) {
	    $pointOnVertex = $pointOnVertex;
	    $point = pointStringToCoordinates($point);
	    $vertices = array(); 
	    foreach ($polygon as $vertex) {
	        $vertices[] = pointStringToCoordinates($vertex); 
	    }
	    if ($pointOnVertex == true and pointOnVertex($point, $vertices) == true) {
	        return "vertex";
	    }
	    $intersections = 0; 
	    $vertices_count = count($vertices);
	    for ($i=1; $i < $vertices_count; $i++) {
	        $vertex1 = $vertices[$i-1]; 
	        $vertex2 = $vertices[$i];
	        if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
	            return "boundary";
	        }
	        if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
	            $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
	            if ($xinters == $point['x']) { // Check if lat lng is on the polygon boundary (other than horizontal)
	                return "boundary";
	            }
	            if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
	                $intersections++; 
	            }
	        } 
	    } 
	    if ($intersections % 2 != 0) {
	        return "inside";
	    } else {
	        return "outside";
	    }
	}

	function pointOnVertex($point, $vertices) {
	  foreach($vertices as $vertex) {
	      if ($point == $vertex) {
	          return true;
	      }
	  }
	}
	function pointStringToCoordinates($pointString) {
	    $coordinates = explode(" ", $pointString);
	    return array("x" => $coordinates[0], "y" => $coordinates[1]);
	}

	function sitedata() {
	  $CI =& get_instance();
	  $CI->db->from('settings');
	  $query = $CI->db->get();
	  $siteinfo = $query->result_array();
	  if(count($siteinfo)>=1) {
	    return $siteinfo[0];
	  } 
    }

    function userpermission($link) {
    	$permissons = $_SESSION['userroles'];
    	if($permissons[$link]==1) {
    		return true;
    	} else {
    		return false;
    	}
    }
	function dateformat() {
    	return substr(sitedata()['s_date_format'], 0, strrpos(sitedata()['s_date_format'], ' '));
    }
	function datetimeformat() {
    	return sitedata()['s_date_format'];
    }
	function traccar_call($service,$data,$method=false) {
        $traccaruname = sitedata()['s_traccar_username'];
        $traccarpassword = sitedata()['s_traccar_password'];
	    $CI =& get_instance();
	    $path=gethostbyname(sitedata()['s_traccar_url']).$service;
	    $ch = curl_init(); 
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    if($method) {
	        curl_setopt($ch, CURLOPT_URL, $path);
	        if($data) {
	            curl_setopt($ch, CURLOPT_POST, 1);
	            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	        }
	        if($method == 'PUT'){
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	        }
	        if($method == 'DELETE'){
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	        }
	    }
	    $headers = array(
		    'Content-Type:application/json',
		    'Authorization: Basic '. base64_encode($traccaruname.':'.$traccarpassword)
		);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $result = curl_exec($ch);
	    curl_close($ch);
      
	    return $result;
	}


	if (!function_exists('setContentLength'))
    {
		//Add content length header to response and echo it
		function setContentLength($data) 
		{
			$returnData = json_encode($data);
			header('Content-Length: '.strlen($returnData)); 
			echo $returnData;
			exit;	
		}	
   }


    if(!function_exists('sendotp')){
		//Add content length header to response and echo it
		function sendotp($data) 
		{	
				$mobile_number = '+91'.$data['mobile_number'];;
				$otp = $data['otp'];
				$template_id = '67fca817d6fc05536d016132';

				$postfield = [
					"template_id" => $template_id,
					"short_url" => "0",
					"realTimeResponse"=> "1", 
					"recipients" => [
						[
							"mobiles" => $mobile_number,
							"var1"=>$otp,
						]
					]
				];

				$curl = curl_init();
				curl_setopt_array($curl, [
				CURLOPT_URL => "https://control.msg91.com/api/v5/flow",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($postfield),
				CURLOPT_HTTPHEADER => [
					"accept: application/json",
					"authkey: 443673AH0H3QcrT67fcc3b6P1",
					"content-type: application/json"
				],
				]);

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  return $response;
				}
		}	
    }
