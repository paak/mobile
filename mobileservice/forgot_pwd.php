<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
include("include/emailMessage.php");
include("include/lib_setting.php");
include("include/lib_mailConfig.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//-----1. change valid username (email)------------------------------------------------------------------------------------------------------//
//-----2. if valid send password to email------------------------------------------------------------------------------------------------------//

$MSG="One-on-One Meeting Scheduler for handheld devices will open on Tuesday,20th  February, 2018 at 12:00 hrs (Thailand time, GMT+7).";
echo json_encode(array($MSG));
die();


$chk_username = rtrim(ltrim(protect_quote($_GET['username'])));
//-------------------------------------
if ($chk_username==""){
		//$MSG="Please input username";
		$MSG="One-on-One Meeting Scheduler for handheld devices will open on Tuesday,20th  February, 2018 at 12:00 hrs (Thailand time, GMT+7).";
		echo json_encode(array($MSG));
		die();
}else{


		switch($MEETING_ID) {
					CASE "WCAS":
						$where_extension=" and join_wca='Y'";
						break;
 					CASE "WCAFS":
						$where_extension=" and join_wcaf='Y'";
						break;
					CASE "SPECIALTY":
						$where_extension=" and join_specialty='Y'";
						break;
 					CASE "AMERICAS":
							$where_extension=" and join_americas='Y'";
					break;
						CASE "LOGNET":
						$where_extension=" and join_lognet='Y'";
					break;
						CASE "ECOM":
						$where_extension=" and join_ecom='Y'";
					break;
			}//end swtich

			
			$SQL="Select  memmeet.join_wca,memmeet.join_wcaf,concat(memmeet.title_name, ' ', memmeet.name, ' ', memmeet.last_name) as name, memmeet.compid, memmeet.emailadd, memmeet.username, memmeet.password from memmeet, company where (status is NULL or status=''   $G_STATUS_EXT) and memmeet.username = '$chk_username' and (memmeet.compid=company.compid) " .$where_extension."";
			
			$registerObj=get_obj_info($SQL, array("emailadd", "compid", "username", "password", "name"));

			if(count($registerObj)==0) {
				$MSG="Invalid username.";
			}elseif(count($registerObj)==1) {

				$emailadd=$registerObj[0]->emailadd;
				//---Body mail--------------------//
				$mailMessage = sprintf($mailMsg['mailPassword'],$registerObj[0]->name ,$registerObj[0]->username,$registerObj[0]->password,$G_REFERENT_URL."info/eng/1on1.php", $G_REFERENT_URL."info/eng/1on1.php");
				//---Body mail--------------------//

				if(send_mailer_1on1($mailMessage,$emailadd,$SUPPORT_MAIL, $G_MEETING_NAME . " : Username and Password") ==1){
					$MSG="Your username and password has been sent to ".$emailadd."";
				}else{
					$MSG="Can not send email,Please contact ".$SUPPORT_MAIL."";
				}
				
			}elseif(count($registerObj)>1) {
				$MSG="There are duplicate email found, please contact ".$SUPPORT_MAIL."";
			}

			echo json_encode(array($MSG));
}// if null chk_username

//----------------------------------------------------------------------------------------------------------------------------//

//echo json_encode(array($MSG));

//----------------------------------------------------------------------------------------------------------------------------//
?>