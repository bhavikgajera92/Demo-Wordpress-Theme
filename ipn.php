<?php 


	
	// STEP 1: Read POST data

	// reading posted data from directly from $_POST causes serialization 
	// issues with array data in POST
	// reading raw POST data from input stream instead. 
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) 
	{
	  $keyval = explode ('=', $keyval);
	  if (count($keyval) == 2)
		 $myPost[$keyval[0]] = urldecode($keyval[1]);
	}

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) 
	{
	   $get_magic_quotes_exists = true;
	} 

	foreach ($myPost as $key => $value) 
	{        
	   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) 
	   { 
			$value = urlencode(stripslashes($value)); 
	   } 
	   else 
	   {
			$value = urlencode($value);
	   }
	   $req .= "&$key=$value";
	}

	// STEP 2: Post IPN data back to paypal to validate

	$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

	// In wamp like environments that do not come bundled with root authority certificates,
	// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
	// of the certificate as shown below.
	// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
	if( !($res = curl_exec($ch)) ) 
	{
		// error_log("Got " . curl_error($ch) . " when processing IPN data");
		curl_close($ch);
		exit;
	}
	curl_close($ch);
	 

	// STEP 3: Inspect IPN validation result and act accordingly

	if (strcmp ($res, "VERIFIED") == 0) 
	{
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $payer_id = $_POST['payer_id'];
	
	$custom = $_REQUEST['custom'];
	include("../../../wp-load.php");
	update_post_meta($custom,'payment_status',"Paid");
	update_post_meta($custom,'trans_id',$txn_id);
	
	
		if($payment_status=="Completed" && $txn_id!='' )
		{		
			# Send Mail Function
			function sendmail($to,$from,$subject,$msg_data)
			{
					/* To send HTML mail, you can set the Content-type header. */
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
					/* additional headers */
					$headers .= "From: ".$from."\r\n";
					//Header of mail
			
					mail($to,$subject,$msg_data,$headers);
			}				
			$args = array( 'post_type' => 'myclass', 'p' => $custom );
			$query = new WP_Query( $args );
			while ( $query->have_posts() ) : $query->the_post();
				$txt_fname = get_post_meta($post->ID, 'txt_fname', true);
				$txt_lname = get_post_meta($post->ID, 'txt_lname', true);
				$student_email = get_post_meta($post->ID, 'student_email', true);
				$trans_id = get_post_meta($post->ID, 'trans_id', true);	
				$student_city = get_post_meta($post->ID, 'student_city', true);	
				$program_fee = get_post_meta($post->ID, 'program_fee', true);	
				$payment_status = get_post_meta($post->ID, 'payment_status', true);	
			endwhile;
			$siteurl=get_bloginfo( 'template_url' );	
			
			# Admin Email Address
			$admin_email=get_option('email_id');
			
			# Send this Email to User Shipping Email Address For the Product You Purchased !
			$subject = "Dear ".ucfirst($txt_fname)."  ! Your Registration Detail from Step2CS !";
			
			$msg_data='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
			<title>Registation Detail From Step2CS !</title>
			<style>
				a,img{
					border:none;
					color:#F8F9F9;	
				}
			</style>
			</head>
			<body style="font-family:Open Sans, sans-serif; background: url('.$siteurl.'/images/body_bg.jpg); padding:10px 0;">
				<div id="mail_wrapper" style="display: table; width:600px; background: #FFFFFF; box-shadow:0 0 5px 3px #d7d7d7; margin:0px auto;  color:#000;">
					<div id="logo_wrapper" style="width:100%; float:left; background:#FFFFFF; padding:10px 0;">
						<div class="logo" style="width:300px; margin:0px auto;">
							<a href="'.$siteurl.'">
								<img src="'.$siteurl.'/images/logo.png" alt="Step2CS" style="width: 300px; height:auto;" />
							</a>
						</div>
					</div>
					<div id="mail_content" style="width:92%; float:left; padding:0 2%; margin:0 2%; background:#FFFFFF;">
						<div class="address_info" style="width:100%; float:left; text-align:center; font-size:22px;">
							<p style="color:#000; margin:0px;">You registration has been done to Step2CS !</p>
						</div>
					</div>		
					<div id="mail_content" style="width:100%; float:left; padding:1% 0% 5%; background:#FFFFFF; margin:0px;">
						<div class="address_info" style="width:100%; float:left; text-align:center; font-size:18px;">
							<p style="color:#000; margin:0px;">Your Registration details are as follows.</p>
						</div>
						
						<div class="shiiping_details" style=" float:left; width: 500px; margin: 15px 0 0 74px; font-size:16px; color:#000;">
								<div style="float:left; width:100%; margin:5px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Name  </span>: '.$txt_fname." ".$txt_lname.'</div>
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >E-mail </span>: '.$student_email.'</div>
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Registration ID </span>: '.$custom.'</div>
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Transaction ID </span>: '.$trans_id.'</div>
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Payment Status</span>: '.$payment_status.'</div>
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Program Fee </span>: '.$program_fee.'</div>			
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Address</span>: '.$student_city.'</div>								
						</div>
						
					</div>					
					<div id="mail_content" style="width:100%; float:left; padding:2% 0;background:#FFFFFF;  margin:0 0 12px;">
						<div style="float:left; margin-left: 40px;">Thank You,</br> <a href="'.$siteurl.'" style="color:#585257; text-decoration:none; float: left; width: 100%; padding: 5px 0;">Step2CS</a>
					</div>					
						
					</div>
				</div>
			</body>
			</html>
			';
			# Send Email to the Student
			$test_email="testineed@gmail.com";
			sendmail($student_email,$admin_email,$subject,$msg_data); 
			
			# Send this Email to Admin for the registration of student !
			$admin_subject = "Dear Admin ! The Registration Detail of ".ucfirst($txt_fname)." ".ucfirst($txt_lname)." from Step2CS !";
			
			$admin_msg_data='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
			<title>Registation Detail From Step2CS !</title>
			<style>
				a,img{
					border:none;
					color:#F8F9F9;	
				}
			</style>
			</head>
			<body style="font-family:Open Sans, sans-serif; background: url('.$siteurl.'/images/body_bg.jpg); padding:10px 0;">
				<div id="mail_wrapper" style="display: table; width:600px; background: #FFFFFF; box-shadow:0 0 5px 3px #d7d7d7; margin:0px auto;  color:#000;">
					<div id="logo_wrapper" style="width:100%; float:left; background:#FFFFFF; padding:10px 0;">
						<div class="logo" style="width:300px; margin:0px auto;">
							<a href="'.$siteurl.'">
								<img src="'.$siteurl.'/images/logo.png" alt="Step2CS" style="width: 300px; height:auto;" />
							</a>
						</div>
					</div>
					<div id="mail_content" style="width:92%; float:left; padding:0 2%; margin:0 2%; background:#FFFFFF;">
						<div class="address_info" style="width:100%; float:left; text-align:center; font-size:22px;">
							<p style="color:#000; margin:0px;">'.$txt_fname." ".$txt_lname.'has registred to Step2CS !</p>
						</div>
					</div>		
					<div id="mail_content" style="width:100%; float:left; padding:1% 0% 5%; background:#FFFFFF; margin:0px;">
						<div class="address_info" style="width:100%; float:left; text-align:center; font-size:18px;">
							<p style="color:#000; margin:0px;">The Registration details are as follows.</p>
						</div>
						
						<div class="shiiping_details" style=" float:left; width: 500px; margin: 15px 0 0 74px; font-size:16px; color:#000;">
								<div style="float:left; width:100%; margin:2px 0;"><span style="float: left; width: 200px; font-weight:bold;" >Name  </span>: '.$txt_fname." ".$txt_lname.'</div>
								<div style="float:left; width:100%;"><span style="float: left; width: 200px; font-weight:bold;" >E-mail </span>: '.$student_email.'</div>
								<div style="float:left; width:100%;"><span style="float: left; width: 200px; font-weight:bold;" >Registration ID </span>: '.$custom.'</div>
								<div style="float:left; width:100%;"><span style="float: left; width: 200px; font-weight:bold;" >Transaction ID </span>: '.$trans_id.'</div>
								<div style="float:left; width:100%;"><span style="float: left; width: 200px; font-weight:bold;" >Payment Status</span>: '.$payment_status.'</div>
								<div style="float:left; width:100%;"><span style="float: left; width: 200px; font-weight:bold;" >Program Fee </span>: '.$program_fee.'</div>			
								<div style="float:left; width:100%;"><span style="float: left; width: 200px; font-weight:bold;" >Address</span>: '.$student_city.'</div>								
						</div>
						
					</div>					
					<div id="mail_content" style="width:100%; float:left; padding:2% 0;background:#FFFFFF;  margin:0 0 12px;">
						<div style="float:left; margin-left: 40px;">Thank You,</br> <a href="'.$siteurl.'" style="color:#585257; text-decoration:none; float: left; width: 100%; padding: 5px 0;">Step2CS</a>
					</div>					
						
					</div>
				</div>
			</body>
			</html>
			';
			
			# Send Email to the Administrator
			$test_email="testineed@gmail.com";
			sendmail($test_email,$student_email,$admin_subject,$admin_msg_data); 
			
			
		
		}
	}
	else if (strcmp ($res, "INVALID") == 0) 
	{
		// log for manual investigation
	}
	?>