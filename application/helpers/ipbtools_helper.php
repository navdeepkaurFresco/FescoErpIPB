<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if (!function_exists('hash_password'))
	{
		function hash_password($number)
		{
			$md5 = MD5($number);
			return $md5;
		}
	}

	if (!function_exists('uploadFile'))
	{
		function uploadFile($filename,$allowed_types,$columnName)
		{
		if(isset($filename))
		{
			$base_url = base_url();
			if($base_url == 'http://localhost/ipbaspring/'){
				$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/ipbaspring/uploads/';
			}else{
				$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
			}
        //$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $config['allowed_types'] = $allowed_types;
        $config['file_name'] = $filename;
        
        $image = & get_instance();
        $image->load->library('upload',$config);
        $image->upload->initialize($config);

        if($image->upload->do_upload($columnName))
        {
          $uploadData = $image->upload->data();
          //$profileImage = base_url().'uploads/'.$uploadData['file_name'];          
			$profileImage = $uploadData['file_name'];

        }else
        {	
        	$error = array('error' => $image->upload->display_errors());
					$profileImage = '';
          return $error;
        }
		    }else
		    {
		      $profileImage = '';
		    }
		    return $profileImage;
			}
	}
	if (!function_exists('test_email')){ 
		function test_email($to,$subject,$message,$attach = ''){
			$config = array(
							//'protocol' => 'smtp',
							'smtp_host' => 'smtp.gmail.com',
							'smtp_crypto' => 'ssl',
							'smtp_port' => '465',
							'smtp_user' => 'ipbelearning@gmail.com',
							'smtp_pass' => 'Fresco@ipb',
							'mailtype' => 'html',
							'charset' => 'iso-8859-1',
							'wordwrap' => TRUE
						);
			$CI =& get_instance();
			$CI->email->initialize($config);
			$CI->email->set_newline("\r\n");
			$CI->email->from('ipbelearning@gmail.com', 'IPB-E Learning');
			$CI->email->to($to);
			$CI->email->subject($subject);
			$CI->email->attach($attach);
			$CI->email->message($message);
			//$this->email->send();
			if ($CI->email->send())
			{
			       return 'send';
			}else{
				//echo"Email not send";
				//show_error($CI->email->print_debugger());
			}
		}
	}

	if (!function_exists('dateFormat'))
	{
		function dateFormat($name)
		{
			$date = date('Y-m-d', strtotime($name));
			return $date;
		}
	}


	if (!function_exists('send_email'))
	{
		function send_email($email, $title, $body)
		{
			$mailer = & get_instance();
		        
		    $mailer->load->library('Phpmailer');

		    $mail = new CI_PhpMailer();
	        $subject = $title;
	        $body = $body;
	        $email = $email;

	        $mail->CharSet = 'UTF-8';
	        $mail->SetFrom('ipbelearning@gmail.com','IPB-E Learning');

	        $mail->AddAddress($email);

	        $mail->Subject = $subject;
	        $mail->Body = $body;

	        $mail->IsHTML(true);

	        //Send email via SMTP
	        $mail->IsSMTP();
	        $mail->SMTPAuth   = true; 
	        $mail->SMTPSecure = "ssl";  //tls
	        $mail->Host       = "smtp.googlemail.com";
	        $mail->Port       = 465; //you could use port 25, 587, 465 for googlemail
	        $mail->Username   = "ipbelearning@gmail.com";
	        $mail->Password   = "Fresco@ipb";
	        return $mail;
		}
	}

	if (!function_exists('randomString'))
	{
		function randomString()
		{
			$maxlength = 10;
		    $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", 
		    				"r", "s", "t", "u", "v", "w", "x", "y", "z",
		               		"0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
		                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P","Q", 
		                    "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

		    $return_str = "";
		    for ($x=0; $x<$maxlength; $x++) 
		    {
		        $return_str .= $chary[rand(0, count($chary)-1)];
		    }
		    return $return_str;
		}
	}



	/*
	* Function Call - to encrypt IDs to pass in url
	*/
	if (!function_exists('encryptID'))
	{
		function encryptID($key,$encrypt)
		{
			$secretValue = $encrypt.'|'.$key;
			$serialized = serialize($secretValue);
		    $encoded = base64_encode($serialized);
		    return $encoded;
		}
	}



	/*
	* Function Call - to decrypt IDs to pass in url
	*/
	if (!function_exists('decryptID'))
	{
		function decryptID($decrypt)
		{
		    $decoded = base64_decode($decrypt);	
		    $unserialized = unserialize($decoded);
			$decrypted = explode('|', $unserialized);
		    return $decrypted;
		}
	}


	/*
	* Function Call - to show existing modules in main menu
	*/
	if (!function_exists('allModulesforMenus'))
	{
		function allModulesforMenus()
		{
			$CI =& get_instance();

			$allModulesforMenus = $CI->frontend->getAllModules();
			
			return $allModulesforMenus;
		}
	}

	/*
	* Function Call - To send SMS to users
	*/
	if (!function_exists('sendSMS'))
	{
		function sendSMS($mobiles,$SMSmessage)
		{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?country=".SMS_COUNTRY_CODE."&sender=".SMS_SENDER."&route=4&mobiles=".$mobiles."&authkey=".MSG91_AUTHKEY."&encrypt=&message=".$SMSmessage."&flash=&unicode=&response=&campaign=",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  return "cURL Error #:" . $err;
			} else {
			  return $response;
			}
		}
	}

	if(!function_exists('educationList')){
		
		function educationList(){

			$list = array("Post Graduation", "Graduation", "Under Graduation");
			return $list;
		}
	}

	/*
	* Function call for mandrill mail
	*/
	if(!function_exists('mandrill_mail')){
		
		function mandrill_mail($data){

		$mail = & get_instance();

		$mail->load->library('Mandrill');

		try{
		    $mail->mandrill->init("ZOd8olAStGhYn_w8CXFaXw");
		    $mandrill_ready = TRUE;
		}catch(Mandrill_Exception $e){
		    $mandrill_ready = FALSE;
		}
		if( $mandrill_ready ) 
			{

			    $message = array(
				    'subject' 	=> $data["subject"],
				    'from_email'=> 'no-reply@getwork.construction',
				    'from_name'	=> "IPB-E Learning",
				    'to' 		=> array(array('email' => $data["to_email"]))
				);

			    $response = $mail->mandrill->messages_send_template($data["template_name"], $data["template_content"], $message);

			    // $mail->sendToMandrill($response);
			    return $response;
			}
		}
	}

	/*
	* Function call for calculate Date time difference
	*/

	if (!function_exists('timeDifference'))
	{
		function timeDifference($Second_datetime)
		{
			$first_datetime = new DateTime();
			$Second_datetime = $first_datetime->diff(new DateTime($Second_datetime));
			if ($Second_datetime->d != 0){
				if ($Second_datetime->d <= 1) {
					$time_difference = $Second_datetime->d.' day'."\n";
				}else{
					$time_difference = $Second_datetime->d.' days'."\n";
				}
				return $time_difference;
			}
			if ($Second_datetime->h == 0) {
				if ($Second_datetime->i != 0){
					$time_difference = $Second_datetime->i." Minutes";
					return $time_difference;
				}
			}
			if ($Second_datetime->i == 0){
				$time_difference = $Second_datetime->s." Seconds";
				return $time_difference;
			}
			if ($Second_datetime->h != 0) {
				$time_difference = $Second_datetime->h." Hour ";
				return $time_difference;
			}
		}
	}


	/*
	* Function call - To generate random string
	*/
	if (!function_exists('generateOTP')) 
	{
		function generateOTP($count) { 

	    $numbers = "1357902468"; 	  
	    $result = "";   
	    for ($i = 1; $i <= $count; $i++) { 
	      $result .= substr($numbers, (rand()%(strlen($numbers))), 1); 
	    }
	    // Return result 
	    return $result; 
		} 
	}
?>