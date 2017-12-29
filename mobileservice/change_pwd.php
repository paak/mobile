<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
include("include/emailMessage.php");
include("include/lib_setting.php");
include("include/lib_mailConfig.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
//-----1. change valid username (email)------------------------------------------------------------------------------------------------------//
//-----2. if valid send password to email------------------------------------------------------------------------------------------------------//
$SID = rtrim(ltrim(protect_quote($_GET['SID'])));
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
$companyID = rtrim(ltrim(protect_quote($_GET['companyID'])));
$attendeeID = rtrim(ltrim(protect_quote($_GET['attendeeID'])));
//------------------------------------------------------------------------------------------------------------//
$currentpwd = rtrim(ltrim(protect_quote($_GET['currentpwd'])));
$newpwd = rtrim(ltrim(protect_quote($_GET['newpwd'])));
$retypepwd = rtrim(ltrim(protect_quote($_GET['retypepwd'])));
//------------------------------------------------------------------------------------------------------------//
if ($companyID=="") {
	
	$MSG="Invalid : companyID";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//------------------------------------------------------------------------------------------------------------//
if ($attendeeID=="") {
	$MSG="Invalid : attendeeID";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//----------------------------------------------------------------------------
if ($currentpwd=="") {

	$MSG="You cannot use a blank current password";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 


}
//------------------------------------------------------------------------------------------------------------//
if ($newpwd=="") {

	$MSG="You cannot use a blank new password.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
 
}
//------------------------------------------------------------------------------------------------------------//
if (strlen($newpwd) > 20 ) {  // can not use new password same old password
	
	$MSG="You cannot use more than 20 characters  in new password.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//------------------------------------------------------------------------------------------------------------//
if ($retypepwd=="") {

	$MSG="You cannot use a blank new password (re-type).";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 

}
//------------------------------------------------------------------------------------------------------------//
if (strlen($retypepwd) > 20 ) {  // can not use new password same old password
	
	$MSG="You cannot use more than 20 characters  in new password (re-type).";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//------------------------------------------------------------------------------------------------------------//
if (IsSpecialChar($newpwd)=="true") {
	
	$MSG="You cannot use special charactor (',<,>,space ) in new password.Please read more in FAQ.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 

}
//------------------------------------------------------------------------------------------------------------//
if (IsSpecialChar($retypepwd)=="true") {
	
	$MSG="You cannot use specail charactor (',<,>,space ) in new password (re-type).Please read more in FAQ.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//------------------------------------------------------------------------------------------------------------//
if (valid_pass($newpwd) < 2){

	$MSG="Your password must be 'Good' or 'Strong' in order to be accepted by the system.Please read more in FAQ.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//------------------------------------------------------------------------------------------------------------//
if (valid_pass($retypepwd) < 2 ){
	
	$MSG="Your password  (re-type)  must be 'Good' or 'Strong' in order to be accepted by the system.Please read more in FAQ.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 

}
//------------------------------------------------------------------------------------------------------------//
if ($newpwd!=$retypepwd) {

	$MSG="You must enter the same password twice in order to confirm it.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}
//------------------------------------------------------------------------------------------------------------//
if ($currentpwd==$newpwd) {  // can not use new password same old password
	
	$MSG="You cannot use current password same new password .Please try another password.";
	$ChangeStatus="Failed";

	$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
	echo json_encode($messageArray1);
	die(); 
}

//------------------------------------------------------------------------------------------------------------//	
	$SQLPwd="select memid,compid,emailadd,username,password,concat(memmeet.title_name,' ',memmeet.name,' ',memmeet.middle_name,' ',memmeet.last_name) as fullName from memmeet where (status is null or status ='' ".$G_STATUS_EXT.") and memid =".$attendeeID."
	and compid =".$companyID." and MD5(rtrim(ltrim(password)))=MD5('".$currentpwd."') " ;

	$ObjPwd = get_obj_info($SQLPwd,array("username","password","fullName","emailadd"));

		if ($ObjPwd == NULL ){
			
				$MSG="Your old password was incorrectly typed.";
				$ChangeStatus="Failed";

				$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
				echo json_encode($messageArray1);
				die(); 
		}else{
				///echo "OK";
				//-----------------update new password ------------------------------
				$fullName=$ObjPwd[0]->fullName;
				$password=$ObjPwd[0]->password;
				$emailadd=$ObjPwd[0]->emailadd;
		
				$chk=Change1on1Password($attendeeID,$companyID,$newpwd);
				if ($chk==false){
					$MSG="Password can not change ,please contact admin.";
					$ChangeStatus="Failed";
				}else{
					$MSG="Password has been changed.";
					$ChangeStatus="Success";
					
				//-----------------wirite log ------------------------------
					write_history($attendeeID,"1on1-pwd", "[".$attendeeID."] ".$fullName." change one-on-one password from  [".$password."] to  [".$newpwd."]", 'app');

					//---Send mail to user --------//
					$mailMessage = sprintf($mailMsg_chgpwd['mailPassword'],$fullName
					,$ObjPwd[0]->username,$newpwd,$G_REFERENT_URL."info/eng/1on1.php", $G_REFERENT_URL."info/eng/1on1.php");

					send_mailer_1on1($mailMessage,$emailadd,$SUPPORT_MAIL, $G_MEETING_NAME . " : Username and Password") ;

					$txtcurpwd="";
					$txtnewpwd="";
					$txtrenewpwd="";
				
				}//chk
				//-----------------send email to admin-----------------
				//-----------------------------------------------------------
			
		}//ObjPwd
//----------------------------------------------------------------------------------------------------------------------------//

//echo json_encode(array($MSG));
/*
if  ($ChangeStatus =="Success"){
		$messageArray1 = array('ChangeStatus' => $ChangeStatus);
		echo json_encode($messageArray1);
}else{
		$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
		echo json_encode($messageArray1);
}*/
//----------------------------------------------------------------------------------------------------------------------------//
$messageArray1 = array('ChangeStatus' => $ChangeStatus,'MSG' =>$MSG);
echo json_encode($messageArray1);


//----------------------------------------------------------------------------------------------------------------------------//
?>
