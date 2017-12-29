<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
include("include/date_share.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
		$AnnouncementID = protect_quote($_GET['AnnouncementID']); 
		$companyID= protect_quote($_GET['companyID']); 
		$attendeeID = protect_quote($_GET['attendeeID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
		$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
		checkSession($SID);
		$app_device=checkAppDevice();
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["AnnouncementID"])) {
			$AnnouncementID = trim(protect_quote($_GET['AnnouncementID'])); 
		}else {
			$messageArray=array(MSG=>"No data of AnnouncementID");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["companyID"])) {
			$companyID = trim(protect_quote($_GET['companyID'])); 
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
		$SQL="select announcementid  from announcement_log where announcementid =".$AnnouncementID."  and compid =".$companyID."  and attendeeID =".$attendeeID.""; 
		//echo $SQL."<hr>";
//---------------------------------------------------------------------------------------------------------------------------------------//

			$AnnObj=get_obj_info($SQL, array("announcementid"));

			if ($AnnObj == null){

			//announcement_log
			
			 $SQL="insert into announcement_log(announcementid,compid,attendeeID,updatedate) values (".$AnnouncementID. ",".$companyID.",".$attendeeID.",now())";

					if(!mysql_query($SQL)){
								$messageArray=array(MSGAnnouncement=>"Save Error");
						}else {
								$messageArray=array(MSGAnnouncement=>"Save Completed");
						}
			//----------------------------------------------------------------------------
			// update read noti announcement

			if ($OpenNotification1on1==true && $app_device =="IOS"){
					$SQL_Update="update conferencedb.history_noti set IsRead='Y' where (device_memid =".$attendeeID.") and (IsRead='' or IsRead is null) and network='".$NETWORK."' and conferenceid =".$id." and section='ann' ";

					if(!mysql_query($SQL_Update)){
										$messageArray=array(MSGAnnouncement=>"Can't update history_noti");
										echo json_encode($messageArray);
											die();
				}//SQL_Update
			}//OpenNotification1on1


			//--------------------------------------------------------------------


			}else {
				$messageArray=array(MSGAnnouncement=>"Duplicate");
			}

//---------------------------------------------------------------------------------------------------------------------------------------//


echo json_encode($messageArray);

//---------------------------------------------------------------------------------------------------------------------------------------//

?>

	