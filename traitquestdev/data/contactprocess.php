<?php
	include "../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	
	if (isset($_POST['name']))				            $name		= trim($_POST ['name']);
	if (isset($_POST['email']))			                $email 		= trim($_POST ['email']);
	if (isset($_POST['subject']))				        $subject	= trim($_POST ['subject']);
	if (isset($_POST['message']))			            $message 	= $_POST ['message'];
	
	if(!trim($_POST['name'])){
		$data['name'] = "Enter your name";
		$validated = false;
	}
	if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))){
		$data['email'] = "Enter a valid email address";
		$validated = false;
	}
	if(!trim($_POST['message'])){
		$data['message'] = "Enter your message";
		$validated = false;
	}
	
	if($validated == true){
		$to = 'hello@traitquest.com';
        $content = '<html>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><body>'.$message.'<br/> From,<br/>'.$name.'</body>
					</html>';
					
		$headers = "From: ".$email."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to, $subject, $content, $headers);
		$data['response'] = 'Thank you for your message. We will be in touch with you in 3 working days.';
		$data['sentMessage'] = true;
	}
	else{
		$data['sentMessage'] = false;
	}
	
	echo json_encode($data);
?>