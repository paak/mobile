<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
		$SID = protect_quote($_GET['SID']); 
		$companyID = protect_quote($_GET['companyID']); 
		$attendeeID = protect_quote($_GET['attendeeID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
$app_device=checkAppDevice();
//---------------------------------------------------------------------------------------------------------------------------------------//
	if ($MEETING_ID =="WCAS" || $MEETING_ID =="WCAFS"){	
		$where_network = " (network='".$NETWORK."' or network='2NET' )";

	}else{
		$where_network=" network = '".$NETWORK."'";
	}//end if
 //---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET['companyID'])) {
			$companyID = trim($companyID); 
		}else {
			$messageArray=array(MSG=>"No data of companyID");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET['attendeeID'])) {
			$attendeeID = trim(protect_quote($_GET['attendeeID'])); 
		}else {
			$messageArray=array(MSG=>"No data of attendeeID");
			echo json_encode($messageArray);
			die(); 
		}

//---------------------------------------------------------------------------------------------------------------------------------------//
$SQL= "select AnnouncementID,AnnouncementDateTime,AnnouncementTitle,AnnouncementMessage,AnnouncementDetail from announcement  where ".$where_network." order by AnnouncementDateTime desc";

$FIELD_INFO = array("AnnouncementID","AnnouncementDateTime","AnnouncementTitle","AnnouncementMessage","AnnouncementDetail"); 
$AnnArray=get_obj_info($SQL,$FIELD_INFO);

//---------------------------------------------------------------------------------------------------------------------------------------//
if (count($AnnArray) == 0 ) {
		$messageArray = array(MSG=>"No Announcement data!"); 
	}else{
		//$messageArray = $AnnArray;


		 for($i=0; $i<count($AnnArray); $i++) {
			 $AnnouncementID=$AnnArray[$i]->AnnouncementID;
			 $AnnouncementDateTime=$AnnArray[$i]->AnnouncementDateTime;
			 $AnnouncementTitle=$AnnArray[$i]->AnnouncementTitle;
			 $AnnouncementMessage=$AnnArray[$i]->AnnouncementMessage;
			 $AnnouncementDetail=$AnnArray[$i]->AnnouncementDetail;

			 if ($OpenNotification1on1=="true" && ($app_device =="IOS" || $app_device =="ANDROID" ) & $companyID !="" & $attendeeID !="" ){
					$ReadStatus=GetReadANN_Noti($NETWORK,$AnnouncementID,$companyID,$attendeeID); //use show red icon
			 }else{
					$ReadStatus=GetReadStatus($NETWORK,$AnnouncementID,$companyID,$attendeeID); //use show red icon from announcement_log
			 }

			 //$ReadStatus=GetReadANN_Noti($NETWORK,$AnnouncementID,$companyID,$attendeeID); //use show red icon

			$AnnouncementArray[$i]->AnnouncementID=$AnnouncementID;
			$AnnouncementArray[$i]->AnnouncementDateTime=$AnnouncementDateTime;
			$AnnouncementArray[$i]->AnnouncementTitle=$AnnouncementTitle;
			$AnnouncementArray[$i]->AnnouncementDetail=$AnnouncementDetail;
			$AnnouncementArray[$i]->ReadStatus=$ReadStatus;
			 

		}//end for

		$messageArray = $AnnouncementArray;

	} //end  else

//---------------------------------------------------------------------------------------------------------------------------------------//
 echo json_encode($messageArray);
//---------------------------------------------------------------------------------------------------------------------------------------//
?>	