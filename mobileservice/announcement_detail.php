<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
		$EventID = protect_quote($_GET['EventID']);
		$AnnouncementID = protect_quote($_GET['AnnouncementID']);
		$companyID = protect_quote($_GET['companyID']);
		$attendeeID = protect_quote($_GET['attendeeID']);
//---------------------------------------------------------------------------------------------------------------------------------------//
$where_network=" network = '".$NETWORK."'";
 //---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["AnnouncementID"])) {
			$AnnouncementID = trim(protect_quote($_GET['AnnouncementID'])); 
		}else {
			$messageArray=array(MSG=>"No data of AnnouncementID");
			echo json_encode($messageArray);
			die(); 
		}
 //---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["EventID"])) {
			$EventID = trim(protect_quote($_GET['EventID'])); 
		}else {
			$messageArray=array(MSG=>"No data of EventID");
			echo json_encode($messageArray);
			die(); 
		}
 //---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET['companyID'])) {
			$companyID = trim($companyID); 
		}else {
			$messageArray=array(MSG=>"No data of companyID");
			echo json_encode($messageArray);
			die(); 
		}
 //---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["attendeeID"])) {
			$attendeeID = trim(protect_quote($_GET['attendeeID'])); 
		}else {
			$messageArray=array(MSG=>"No data of attendeeID");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
$SQL= "select AnnouncementID,AnnouncementDateTime,AnnouncementTitle,AnnouncementMessage,AnnouncementDetail from announcement  where AnnouncementID = ".$AnnouncementID."";

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

		
			$AnnouncementArray[$i]->AnnouncementID=$AnnouncementID;
			$AnnouncementArray[$i]->AnnouncementDateTime=$AnnouncementDateTime;
			$AnnouncementArray[$i]->AnnouncementTitle=$AnnouncementTitle;
			$AnnouncementArray[$i]->AnnouncementDetail=$AnnouncementDetail;
			$AnnouncementArray[$i]->EventID=$EventID;
			 

		}//end for

		$messageArray = $AnnouncementArray;

	} //end  else


//----------------------------------------------------------------------
//--Update status read------------------//
			$SQL_Update="update conferencedb.history_noti set IsRead='Y' where (device_memid =".$attendeeID.") and (IsRead='' or IsRead is null) and network='".$NETWORK."' and conferenceid =".$id." and section='ann' and AnnouncementID=".$AnnouncementID." ";

					if(!mysql_query($SQL_Update)){
										//$messageArray=array(MSGAnnouncement=>"Can't update history_noti");
										//echo json_encode($messageArray);
										//die();
				}//SQL_Update

			 $SQL="insert into announcement_log(announcementid,compid,attendeeID,updatedate) values (".$AnnouncementID. ",".$companyID.",".$attendeeID.",now())";

					if(!mysql_query($SQL)){
								//$messageArray=array(MSGAnnouncement=>"Save Error");
						}else {
								//$messageArray=array(MSGAnnouncement=>"Save Completed");
						}

//---------------------------------------------------------------------------------------------------------------------------------------//
 echo json_encode($messageArray);
//---------------------------------------------------------------------------------------------------------------------------------------//
?>	