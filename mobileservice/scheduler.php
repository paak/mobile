<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/lib_mailConfig.php");
include("include/session.php");
include("include/date_share.php");
include("include/lib_date.php");
//------Mobile device--------------------
//include("include/lib_notification.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();

//?meetingTime=2013-03-04%2014:00:00&service=Make&attendeeID=1&memberID=824&SID=13601472485491
//---------------------------------------------------------------------------------------------------------------------------------------//
		$attendeeID = protect_quote($_GET['attendeeID']); 
		$memberID= protect_quote($_GET['memberID']); 
		$service= protect_quote($_GET['service']); 
		$meetingTime= protect_quote($_GET['meetingTime']); 

//---------------------------------------------------------------------------------------------------------------------------------------//
	$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
	checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
	checkSchedulerOpen($G_MEETING_1ON1_STATUS);
//---------------------------------------------------------------------------------------------------------------------------------------//
	$app_device=checkAppDevice();
//---------------------------------------------------------------------------------------------------------------------------------------//
	if (isset($service)) {
			$service=strtolower(trim(protect_quote($service)));//service [make, block , cancel,noshow,unnoshow,like,unlike]
		}else {
			$messageArray=array(MSG=>"Service Command Error");
			echo json_encode($messageArray);
			die(); 
		}

		if(!($service=="block" || $service=="make" || $service=="cancel" || $service=="like" || $service=="unlike" || $service=="noshow"|| $service=="unnoshow")){
			$messageArray=array(MSG=>"Incorrect Service Command");
			echo json_encode($messageArray);
			die(); 		
		
		}
		
//---------------------------------------------------------------------------------------------------------------------------------------//		
		if (isset($meetingTime)) {
			$meetingTime = trim(protect_quote($meetingTime)); 
		}else {
			$messageArray=array(MSG=>"Meeting Time Error");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//	
       if ($MEETING_ID=="WCAS" || $MEETING_ID="WCAFS"){
				$SQL="select meetingTime from agenda where meetingTime='".$meetingTime."' and (network='$NETWORK' or network='2NET')  and event='1on1' "; //echo $SQL;
	   }else{
			$SQL="select meetingTime from agenda where meetingTime='".$meetingTime."' and network='$NETWORK'   and event='1on1' ";  
	   }
	
		$meetingTimeObj=get_obj_info($SQL, array("meetingTime"));
		if(NULL==$meetingTimeObj){
			$messageArray=array(MSG=>"No Meeting Time Found");
			echo json_encode($messageArray);
			die(); 		
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($attendeeID)) {
			$attendeeID = trim(protect_quote($attendeeID)); 
		}else {
			$messageArray=array(MSG=>"Your Scdeduler Error");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($memberID)) {
			$memberID = trim(protect_quote($memberID)); 
		}else {
			$messageArray=array(MSG=>"Member Scheduler Error");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
$SENDER_EMAIL=$G_MAIL_USERNAME;
//------------------------------------------------------------------------------
if ($service=="make" || $service=="cancel" || $service=="block" )  {
$ChkMeetingDate = "and (left(meetingdate,10) ='".substr($meetingTime,0,10)."') ";   // format :meetingTime=2013-03-04

if ($ChkMeetingDate!=""){
	
	$SQL2=" select meetingdate,isopen from oneononedate where isopen ='N'  ".$WhereNetwork."  ". $ChkMeetingDate . "  ";
	$ArrDateClose=get_obj_info($SQL2 , array("meetingdate"));

	if (count($ArrDateClose)  > 0 ){ //$FlagClosed= "Y";
			$messageArray=array(MSG=>"One-on-One was closed.");
			echo json_encode($messageArray);
			die(); 
	}
}//ChkMeetingDate
}// make and cancel
//---------------------------------------------------------------------------------------------------------------------------------------//
switch(strtolower($service)) {

	case "block": // check available before block 
			$SQL="select * from oneonone where meeting_time='".$meetingTime."' and (joinerID=$attendeeID or waiterID=$attendeeID)"; //echo $SQL."<hr>";
			$blockTimeObj=get_obj_info($SQL, array("meeting_time"));
			if(NULL==$blockTimeObj) {
				
							$SQL="insert into OneOnOne(meeting_time,joinerID,waiterID,tableNumber,participantID,network1on1) values('" . $meetingTime . "',$attendeeID,$attendeeID,0,0,'".$NETWORK."')";

								//echo $SQL."<HR>";
						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"Block Time Error");
						}else {
								$messageArray=array(MSG=>"Block Time Completed");
						}
			}else {
				$messageArray=array(MSG=>"This time is blocked");
			}
		
	break;
	//-------------------------------------------------------------------------------------------------------------//
	case "cancel": 
		
		// 1 cancel the meeting [=> joinerID<>waiterID] and send message both $attendeeID and $memberID
		// 2 cancel blocked time [joinerID=waiterID]), no message  
			$SQL="select * from oneonone where meeting_time='".$meetingTime."' and (joinerID=$attendeeID or waiterID=$attendeeID)"; //echo $SQL."<hr>";
			$getMeetingObj=get_obj_info($SQL, array("meeting_time", "joinerID", "waiterID"));
			if (!(NULL==$getMeetingObj)) { 
					//---------------------------------------------------------------------------------------------------------------------------------------//	
					$joinerID= $getMeetingObj[0]->joinerID;
					$waiterID= $getMeetingObj[0]->waiterID;
					//---------------------------------------------------------------------------------------------------------------------------------------//	
					if($joinerID==$waiterID){
						if(!mysql_query("delete from oneonone where meeting_time='".$meetingTime."' and (joinerID=".$attendeeID.") and (waiterID=".$attendeeID.") ")){
								$messageArray=array(MSG=>"Cancel Error");
						}else {
								$messageArray=array(MSG=>"Cancel Completed");
						}	
					//---------------------------------------------------------------------------------------------------------------------------------------//		
					}else {

						//--------------------------------------------------------------------//
						if($attendeeID==$waiterID) {
								$hostID=$waiterID;			$host = get_member_info($waiterID); 
								$guestID=$joinerID;			$guest = get_member_info($joinerID);
								$flag_hostcancel="false";
						}elseif($attendeeID==$joinerID) {
								$hostID=$joinerID;			$host = get_member_info($joinerID); 	
								$guestID=$waiterID;			$guest = get_member_info($waiterID);		
								$flag_hostcancel="ture";
						}
						//----------------------------------------------------------------------//
						if(!mysql_query("delete from oneonone where meeting_time='".$meetingTime."' and (joinerID=".$joinerID.") and (waiterID=".$waiterID.") ")){
								$messageArray=array(MSG=>"Cancel Error");
						}else {

								//-------------------------------------------------//
								write_history($attendeeID,"1on1","[".$hostID."] ".$host->name." cancel appiontment -> [".$guestID."] ".$guest->name." [".$meetingTime."]", "app");
								//-------------------------------------------------//
							
								//$MSG1=MSG_body("host_cancel", full_time_format($meetingTime) , $host->email,$host->name,$host->company , $guest->email , $guest->name,$guest->company);

								$MSG1=MSG_body_NewFormat("host_cancel", GetDate1on1($meetingTime) , $host->email,$host->name,$host->company , $guest->email , $guest->name,$guest->company,$guest->repCountry);

								//echo  "<hr>".$MSG1."<hr>";
								
								
								//send_mailer_1on1($MSG1,$host->email,$SENDER_EMAIL, "Appointment Cancellation � ".$G_MEETING_NAME." (1on1)");
								//--Change to send email by scheduler task--------------
								$subject="Appointment Cancellation - ".$G_MEETING_NAME." (1on1)";

								$SQL_Email1="insert into history_email(service,message,mailTo,mailFrom,subject,flagSend,app_device,CreateDate,CreateBy,UpdateDate,UpdateBy) values('".$service."','". protect_quote($MSG1)."','".$host->email."','" . $SENDER_EMAIL."','". protect_quote($subject)."','N','".$app_device."',now(),'". $attendeeID."',now(),'".$attendeeID."')";
								
								mysql_query($SQL_Email1);

								//-------------------------------------------------//
								//$MSG2=MSG_body("guest_cancel", full_time_format($meetingTime) , $host->email,$host->name,$host->company , $guest->email , $guest->name,$guest->company);

								$MSG2=MSG_body_NewFormat("guest_cancel", GetDate1on1($meetingTime) , $host->email,$host->name,$host->company , $guest->email , $guest->name,$guest->company,$guest->repCountry);

								//echo  "<hr>".$MSG2."<hr>";
								//send_mailer_1on1($MSG2,$guest->email,$SENDER_EMAIL, "Appointment Cancellation � ".$G_MEETING_NAME." (1on1)");		
								//-----Send 1on1 notification to waiter only-----------------------------// 
								//--Change to send email by scheduler task--------------
								$subject="Appointment Cancellation -".$G_MEETING_NAME." (1on1)";
							    $SQL_Email2="insert into history_email(service,message,mailTo,mailFrom,subject,flagSend,app_device,CreateDate,CreateBy,UpdateDate,UpdateBy) values('".$service."','". protect_quote($MSG2)."','".$guest->email."','" . $SENDER_EMAIL."','". protect_quote($subject)."','N','".$app_device."',now(),'". $attendeeID."',now(),'".$attendeeID."')";
								
								mysql_query($SQL_Email2);

								///--Send noti ------------
								if ($OpenNotification1on1=="true"){
							
								//--------------------------------------
								if ($guestID<>""){
								$SQ_Device="select distinct(devicetoken) as devicetoken,app_device  from conferencedb.app_device_noti where   conferenceID=".$id."  and (devicetoken is not null or devicetoken <>'')  and attendeeID =".$guestID." order by updatedate desc limit 1   ";
								$result_noti = mysql_query($SQ_Device);
								while($row = mysql_fetch_array($result_noti)){
											$deviceToken = rtrim(ltrim($row["devicetoken"]));
											$mem_app_device = rtrim(ltrim($row["app_device"]));
								}//while
								}//memberID
								//-------End Get device token---------------
								if ($deviceToken != "" &&  $deviceToken != NULL){

										$oneoneone_time=full_time_format_noti($meetingTime);

										$NotificationTitle="Your one-on-one meeting on ".$oneoneone_time."  with ".$host->name." of ".$host->company." has been cancelled by ".$host->name.".";

										write_history_noti($attendeeID,"1on1", "[".$hostID."] ".$host->name." cancel appiontment-> [".$guestID."] ".$guest->name." [".$meetingTime."]", "app",$guestID,$NETWORK,$meetingTime,$hostID,$guestID,$NotificationTitle,$deviceToken,$mem_app_device);
								
									}//$deviceToken

								}//OpenNotification1on1

						

								//--Change to send email by scheduler task--------------
								$messageArray=array(MSG=>"Cancel Completed");
								//-------------------------------------------------//
						}	//mysql_query
						//--------------------------------------------------------------------//	
					}//$joinerID==$waiterID

				
				
			}else {
				$messageArray=array(MSG=>"No Meeting Found");
			}

		
			
	break;
	//-------------------------------------------------------------------------------------------------------------//
	case "make": // make the meeting and send message both $attendeeID and $memberID
			//----------------------------------------------------
			$SQL="select * from oneonone where meeting_time='".$meetingTime."' and (joinerID=$attendeeID or waiterID=$attendeeID)"; 
			$getMeetingObj=get_obj_info($SQL, array("meeting_time", "joinerID", "waiterID"));

			$SQL="select * from oneonone where meeting_time='".$meetingTime."' and (joinerID=$memberID or waiterID=$memberID)"; 
			$getMemberTime=get_obj_info($SQL, array("meeting_time", "joinerID", "waiterID"));

			if((NULL==$getMeetingObj) && (NULL==$getMemberTime)) {
				//--------------------------------------------------------------------------------------------------------------------------------//
				#check exist memberID
				$SQL="select memid from memmeet where memid=".$memberID." and (status is NULL or status='') ".$where_extension;
				$attendeeObj=get_obj_info($SQL, array("memid"));
					if(NULL==$attendeeObj){
						$messageArray=array(MSG=>"No Member Found"); 
						echo json_encode($messageArray);
						die();
					}
				//--------------------------------------------------------------------------------------------------------------------------------//
			$SQL="insert into OneOnOne(meeting_time,joinerID,waiterID,tableNumber,participantID,network1on1) values('" . $meetingTime . "',".$attendeeID.",".$memberID.",0,0,'".$NETWORK."')";
							//	echo $SQL."<HR>";
						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"Make Appontment Error");
						}else {
								$host=get_member_info($attendeeID);
								$guest=get_member_info($memberID);
								//-------------------------------------------------//
								$subject="Appointment Confirmation - ".$G_MEETING_NAME." (1on1)";
								//-------------------------------------------------//
								//-------------------------------------------------//
								write_history($attendeeID,"1on1", "[".$attendeeID."] ".$host->name." make appointment -> [".$memberID."] ".$guest->name." [".$meetingTime."]", "app");
								//-------------------------------------------------//
								
								//$MSG1=MSG_body("host_notice", full_time_format($meetingTime) , $host->email,$host->name,$host->company, $guest->email , $guest->name,$guest->company);	
								$MSG1=MSG_body_NewFormat("host_notice", GetDate1on1($meetingTime) , $host->email,$host->name,$host->company, $guest->email , $guest->name,$guest->company,$guest->repCountry);	
								

								//send_mailer_1on1($MSG1,$host->email, $SENDER_EMAIL, $subject);
								//--Change to send email by scheduler task--------------

								$SQL_Email1="insert into history_email(service,message,mailTo,mailFrom,subject,flagSend,app_device,CreateDate,CreateBy,UpdateDate,UpdateBy) values('".$service."','". protect_quote($MSG1)."','".$host->email."','" . $SENDER_EMAIL."','". protect_quote($subject)."','N','".$app_device."',now(),'". $attendeeID."',now(),'".$attendeeID."')";
								
								mysql_query($SQL_Email1);

								//--END : Change to send email by scheduler task--------------


								//-------------------------------------------------//
								//$MSG2=MSG_body("guest_invite", full_time_format($meetingTime) , $host->email,$host->name,$host->company , $guest->email , $guest->name,$guest->company);

								$MSG2=MSG_body_NewFormat("guest_invite", GetDate1on1($meetingTime) , $host->email,$host->name,$host->company , $guest->email , $guest->name,$guest->company);

								//send_mailer_1on1($MSG2,$guest->email, $SENDER_EMAIL, $subject);

								//--Change to send email by scheduler task--------------

								$SQL_Email2="insert into history_email(service,message,mailTo,mailFrom,subject,flagSend,app_device,CreateDate,CreateBy,UpdateDate,UpdateBy) values('".$service."','". protect_quote($MSG2)."','".$guest->email."','" . $SENDER_EMAIL."','". protect_quote($subject)."','N','".$app_device."',now(),'". $attendeeID."',now(),'".$attendeeID."')";
								
								mysql_query($SQL_Email2);

							
								//--END : Change to send email by scheduler task--------------
								//-----Send 1on1 notification to waiter only-----------------------------//

								if ($OpenNotification1on1=="true"){
								//--Get device token : $id =conference id
									
								//--------------------------------------
								if ($memberID<>""){
								$SQ_Device="select distinct(devicetoken) as devicetoken,app_device  from conferencedb.app_device_noti where   conferenceID=".$id."  and (devicetoken is not null or devicetoken <>'')  and attendeeID =".$memberID." order by updatedate desc limit 1   ";
								$result_noti = mysql_query($SQ_Device);
										while($row = mysql_fetch_array($result_noti)){
											$deviceToken = rtrim(ltrim($row["devicetoken"]));
											$mem_app_device = rtrim(ltrim($row["app_device"]));
										}//while
								}//memberID
								//-------End Get device token---------------
								if ($deviceToken != "" &&  $deviceToken != NULL &&  $mem_app_device != ""){
									
										//---Get total show in app icon wca event -----------//
										$oneoneone_time=full_time_format_noti($meetingTime);
										$NotificationTitle=$host->name." of ".$host->company." has scheduled a one-on-one meeting with you during ".$G_MEETING_NAME." on ".$oneoneone_time.".";
										//-----Send notification-----------------
									
									    //--Write history noti -------------------
										write_history_noti($attendeeID,"1on1", "[".$attendeeID."] ".$host->name." make appointment -> [".$memberID."] ".$guest->name." [".$meetingTime."]", "app",$memberID,$NETWORK,$meetingTime,$attendeeID,$memberID,$NotificationTitle,$deviceToken,$mem_app_device);


								}//$deviceToken

								}//OpenNotification1on1


								//-------------------------------------------------//
								//-------turn on /off send notifications-----ID.php-------------------------------------------------
								//---------------------------------------------------------
								$messageArray=array(MSG=>"Make Appointment Completed");
								//-------------------------------------------------//

						}//end if insert
			}else {
				$messageArray=array(MSG=>"Meeting is exist"); // there is prior meeting can not make new appointment	
			}
			//--------------------------------------------------------------------------------------//
		
	break;

	//------------------Phase 4-------------------------------------------------------------------------------------------//
	 case "like": 
		
		$SQL="select * from memmeet_like where updateid =".$attendeeID." and meeting_time ='".$meetingTime."' ";
		$LikeObj=get_obj_info($SQL, array("meeting_time"));

			if(NULL==$LikeObj) {
						$SQL="insert into memmeet_like(meeting_time,LikeID,UpdateID,UpdateDate) values('".$meetingTime . "',$memberID,$attendeeID,now())";
						
						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"Like Error");
						}else {
								$messageArray=array(MSG=>"Like Completed");
						}
			}else {
				$messageArray=array(MSG=>"This time is liked.");
			}
			break;
	 //-------------------------------------------------------------------------------------------------------------//
		 case "unlike": 
		
		$SQL="select * from memmeet_like where updateid =".$attendeeID." and meeting_time ='".$meetingTime."' ";
		$LikeObj=get_obj_info($SQL, array("meeting_time"));

			if(NULL <> $LikeObj) {
						$SQL="delete from  memmeet_like where meeting_time ='".$meetingTime . "' and  updateid =".$attendeeID." ";
						
						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"UnLike Error");
						}else {
								$messageArray=array(MSG=>"UnLike Completed");
						}
			}else {
				$messageArray=array(MSG=>"UnLike is exist.");
			}
			break;
		 //-------------------------------------------------------------------------------------------------------------//
		case "noshow": //

		$attendeeID_info = get_member_info($attendeeID);   //ownerid
		$member_info = get_member_info($memberID);  

		$SQL="select * from memmeet_noshow_detail where meeting_date ='".$meetingTime."' and memid =".$memberID."";

		$NoShowObj=get_obj_info($SQL, array("meeting_date"));

					if(NULL == $NoShowObj) {
						//---1 : memmeet_noshow-----------
						$SQL="insert into memmeet_noshow(memid,compid,masterCompanyID,emailadd,conf_name,company,fullName,memid_status,repCity,repCountry,UpdateBy,UpdateDate) values ('".$member_info->memid."','".$member_info->companyID."','".$member_info->masterCompanyID."','".$member_info->email."','".$conf_name."','".$member_info->company."','".$member_info->name."','".$noshow_status."','".$member_info->repCity."','".$member_info->repCountry."','".$attendeeID_info->memid."',now())";

						
						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"NoShow Main Error");
						}else {

								//---2 : memmeet_noshow_detail------------
							$txtRemark="updated by app.";
					
							$SQL="insert into memmeet_noshow_detail(memid,compid,masterCompanyID,emailadd,conf_name,company,fullName,inform_id,inform_compid,inform_masterCompanyID,inform_emailadd,inform_company,inform_fullName,meeting_date,comment,updateby,updatedate) values (".$member_info->memid.",".$member_info->companyID.",".$member_info->masterCompanyID.",'".$member_info->email."','".$conf_name."','".$member_info->company."','".$member_info->name."',".$attendeeID_info->memid.",". $attendeeID_info->companyID.",". $attendeeID_info->masterCompanyID.",'".$attendeeID_info->email."','".$attendeeID_info->company."','".$attendeeID_info->name."','".$meetingTime."','".$txtRemark."','".$attendeeID_info->memid."',now())";

						
							  if(!mysql_query($SQL)){
									$messageArray=array(MSG=>"NoShow Detail Error");
								}else {
									$messageArray=array(MSG=>"NoShow Completed");
								}
								//---------------------------------------------------
						}//if SQL*/
				}else {
						$messageArray=array(MSG=>"NoShow is exist.");
				}//LikeObj
			break;
		 //-------------------------------------------------------------------------------------------------------------//
		case "unnoshow": 

		$attendeeID_info = get_member_info($attendeeID);   //ownerid
		$member_info = get_member_info($memberID);  

		$SQL="select *  from memmeet_noshow_detail where meeting_date ='".$meetingTime."' and memid =".$memberID."";
	
		$NoShowObj=get_obj_info($SQL, array("meeting_date"));

					if(NULL <> $NoShowObj) {
						//---1 : memmeet_noshow_deail-----------
						$SQL="delete  from memmeet_noshow where memid ='".$member_info->memid."' and compid =".$member_info->companyID." and emailadd ='".$member_info->email."' and conf_name='".$conf_name."'" ;

						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"Un-NoShow Main Error");
						}else {
							//---2 : memmeet_noshow_main------------
								$SQL="delete  from memmeet_noshow_detail where meeting_date ='".$meetingTime."' and memid =".$memberID." and conf_name='".$conf_name."'" ;

							  if(!mysql_query($SQL)){
									$messageArray=array(MSG=>"Un-NoShow Detail Error");
								}else {
									$messageArray=array(MSG=>"Un-NoShow Completed");
								}
								//---------------------------------------------------
						}//if SQL*/
				}else {
						$messageArray=array(MSG=>"NoShow is not exist.");
				}//LikeObj
				break;
		 //------------------------------------------------------------------------------------------------------------//


}// end switch



//---------------------------------------------------------------------------------------------------------------------------------------//

//echo $messageArray;
//echo strtolower($service);
echo json_encode($messageArray);



//---------------------------------------------------------------------------------------------------------------------------------------//

?>