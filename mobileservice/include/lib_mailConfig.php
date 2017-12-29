<?php

//-------------------------------------------------------------------------------------------------------------------------------------//

function MSG_body($command, $time, $host_email,$host_name,$host_company , $guest_email , $guest_name,$guest_company){
	global $G_MEETING_NAME;
	//$time= substr($time,0,10) . ", ".substr($time,11,5);

	switch ($command){
		case "host_notice":
					$MSG="
					Dear <B>$host_name</B>,
						<BR><BR>
						Your one-on-one meeting invitation on <B>$time</B> has been successfully sent to <B>$guest_name</B> of <B>$guest_company</B>.
					";
		break;
		case "guest_invite":
					$MSG="
					Dear <B>$guest_name</B>,
						<BR><BR> 
						&nbsp;&nbsp;&nbsp;<B>$host_name</B>&nbsp; of &nbsp; <B>$host_company</B>&nbsp;has scheduled a one-on-one meeting with you during $G_MEETING_NAME, on <B>$time</B>.
						<BR><BR>
						<B>The appointment is automatically confirmed.</B>
						<BR><BR> 
						<font color='red'>If you would like to <B><i><u>contact</u></i>, reschedule or cancel</B> this appointment, please contact <a href='mailto:$host_email'><B>$host_email</B></A></font>.
					";
		break;
		case "host_cancel":
					$MSG="
					Dear <B>$host_name</B>,
						<BR><BR>
						You have cancelled your one-on-one meeting with <B>$guest_name</B>&nbsp; of &nbsp; <B>$guest_company</B> on <B>$time</B>.
					";
					//  was  canceled by <B>".$joiner_name->name."</B>
		break;
		case "guest_cancel":
					$MSG="
					Dear <B>$guest_name</B>,
						<BR><BR>
						Your one-on-one meeting on <B>$time</B> with <B>$host_name</B>&nbsp; of &nbsp; <B>$host_company</B> has been cancelled by <B>$host_name</B>.
					";
		break;

	//----------------------------------group meeting -----------------------------------//
		case "host_cancelGroup":
					$MSG="
					Dear <B>$host_name</B>,
						<BR><BR>
						You have cancelled the Group Meeting of <B>$guest_name</B> on <B>$time</B>.
					";
					//  was  canceled by <B>".$joiner_name->name."</B>
		break;

		case "guest_cancelGroup":
					$MSG="
					Dear <B>$guest_name</B>,
						<BR><BR>
						Your Group meeting on <B>$time</B> with <B>$host_name</B>&nbsp; of &nbsp; <B>$host_company</B> has been cancelled by <B>$host_name</B>.
					";
					//$MSG .= "<BR><BR>This time slot is now available for re-scheduling.";
		break;
	//---------------------------------group meeting -----------------------------------//

	}
	if($command != "host_cancel") $MSG .= "<BR><BR>Thank you for participating in $G_MEETING_NAME.";
	//$MSG .= "<BR><BR><BR><div align=center><img src='http://www.worldcargoalliance.net/wcameeting/images/bkkmeeting.jpg'></div>";
	//print "<HR> $MSG <HR>";
	return $MSG;
}
//-----------------------------------------------
function MSG_body_NewFormat($command, $time, $host_email,$host_name,$host_company,$host_repcountry, $guest_email , $guest_name,$guest_company,$guest_repcountry){
	global $G_MEETING_NAME;

	//$time= substr($time,0,10) . ", ".substr($time,11,5);
	switch ($command){
		
		
		case "guest_invite":

				$MSG="
				Dear <B>$guest_name</B>,
				<BR><BR> 
				This email is to inform you that you have a new appointment as below.  This appointment will remain confirmed in the system unless you cancel it yourself.
				<BR><BR>
				<B>$host_name</B>,&nbsp;<B>$host_company</B>,&nbsp;<B>$host_repcountry</B>
				<BR><BR>$time";
				

					
		break;
		
		case "guest_cancel":
		
				$MSG="
				Dear <B>$guest_name</B>,
				<BR><BR> 
				This email is to inform you that your appointment with the below mentioned was cancelled by their request:
				<BR><BR>
				<B>$host_name</B>,&nbsp;<B>$host_company</B>,&nbsp;<B>$host_repcountry</B>
				<BR><BR>$time";
		break;

	

	}
	
	return $MSG;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//=================================================================================//
function send_mailer_1on1($message,$mailTo,$mailFrom, $subject){
global $G_MEETING_NAME;
global $G_MEETING_NAME_SHORT;
global $G_MAIL_USERNAME;
global $G_MAIL_PASSWORD;
global $MEETING_ID;
global $SUPPORT_MAIL;

	if($mailTo==""){
						print "<BR>Sending Mail Error !! No receiver email !! <BR>";
						return 0;
	}

	require_once('PHPMailer/class.phpmailer.php');
	$mailer_host = "smtp.office365.com";
	$mailer_port = "587";
	$mailer_name = $G_MEETING_NAME_SHORT." Meeting Scheduler";

	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->SMTPSecure = 'tls';
	$mailer->SMTPAuth = true;
	$mailer->Host = $mailer_host;
	$mailer->Port = $mailer_port;
	$mailer->Username = $G_MAIL_USERNAME;
	$mailer->Password = $G_MAIL_PASSWORD;
	$mailer->SetFrom($G_MAIL_USERNAME, $mailer_name);	
	
	//--test
	$mailer->AddAddress('suda@wcaworld.com','');
	//--prod
	//$mailer->AddAddress($mailTo,'');
	//--BCC
	$mailer->AddBCC('conference_log@wcaworld.com','');

	$mailer->AddReplyTo($SUPPORT_MAIL, $SUPPORT_MAIL);

	//$NEW_SUPPORT_MAIL="conference@sinoconference.com";
	//$mailer->AddReplyTo($NEW_SUPPORT_MAIL, $NEW_SUPPORT_MAIL);

	$mailer->Subject = $subject;					
	$mailer->Body = $message;
	$mailer->isHTML(true);
	
	if(!$mailer->Send()) {
			  echo "Mailer Error: " . $mailer->ErrorInfo; die();
			}
	$mailer->ClearAddresses(); //***************very important*****************//	

	unset($mailer);

	return 1;

}//funciton

//=================================================================================//

?>