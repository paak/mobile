<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//------Mobile device--------------------
include("include/lib_notification.php");
//--------------------------------------------
$SID = protect_quote($_GET['SID']); 
$section = protect_quote($_GET['section']); 

//---------------------------------------------------------------------------------------------------------------------------------------//
//checkSession($SID);
//---Config------------------------//
/*$mode ="PRODUCTION" ; // ID.php
$AID=22;
$NETWORK="SINO";
$section="ann";*/
$section="ann";
$app_device="IOS";
//$AID=1;
$NETWORK="SINO"; // WCAF

//------------------------------------------------------Announcement-----------------------------------------------------------------//
if ($section =='ann' ){  
if ($AID != "" ) {
 $SQL_Noti="select AnnouncementID,announcementTitle from announcement  where AnnouncementID =".$AID." and network ='".$NETWORK."' ";
	 $show_array=get_obj_info($SQL_Noti, array("announcementTitle","AnnouncementID"));
	 if (count($show_array) >0 ){
		$message= rtrim(ltrim($show_array[0]->announcementTitle));
		$AnnouncementID= rtrim(ltrim($show_array[0]->AnnouncementID));
		$EventID= $id; // config at include/ID.php
	 }else{
		echo "No Announcement message.";
		die();
	 }
}else{
   echo "No data of AnnouncementID.";
   die();
}

/*echo $message;
echo "<BR>";
echo $AnnouncementID;
echo "<BR>";*/
//-------------------------
if ($message ==""){
		echo "No Message.";
		die();
}
//-----------------------
	//connect_DB_Event();
	if ($app_device ==""){
		echo "No app device";
		die();
	}

	if ($NETWORK=="WCAF"){
			$id=69;
			$EventID=69;
	}
	if ($NETWORK=="LOGNET"){
			$id=70;
			$EventID=70;
	}
	if ($NETWORK=="SINO"){
			$id=83;
			$EventID=83;
	}
//------Find device token--------------------------					
	/*$SQL_device="select distinct(devicetoken) as devicetoken,app_device,attendeeId from conferencedb.app_device_noti where  network='".$NETWORK."'  and conferenceID=".$id."  and (devicetoken is not null and  devicetoken <>'' and  devicetoken <>'(null)')  and app_device ='".$app_device."' and (flag_send is null or flag_send ='') order by updatedate desc limit 100 ";*/


	$SQL_device="select distinct(devicetoken) as devicetoken,app_device,attendeeId from conferencedb.app_device_noti where network='SINO' and conferenceID=83 and (devicetoken is not null and devicetoken <>'' and devicetoken <>'(null)') and app_device ='".$app_device."' and attendeeId not in ( select device_memid from conferencedb.history_noti where section ='ann' and conferenceid=83 and announcementid =".$AID." and app_device='".$app_device."' )";


 
	/*$SQL_device="select distinct(devicetoken) as devicetoken,app_device,attendeeId from conferencedb.app_device_noti where  network='".$NETWORK."'  and conferenceID=".$id."  and (devicetoken is not null and  devicetoken <>'' and  devicetoken <>'(null)')  and app_device ='".$app_device."'  and attendeeId=98   ";*/


	/*echo  $SQL_device;
			echo "<BR>";

	die();*/


	$result= mysql_query($SQL_device);
	if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
			echo $SQL_device;
			echo "<BR>";

	}
	//---------------------------------------------------------------
	$i=0;  // for DT : DeviceToken Array , AT : AttendeeID
	while($row = mysql_fetch_array($result)){
			$deviceToken=rtrim(ltrim($row["devicetoken"]));
			$app_device=rtrim(ltrim($row["app_device"]));
			$attendeeId=rtrim(ltrim($row["attendeeId"]));
			$DT[$i] = $deviceToken;
			$AT[$i] = $attendeeId;
			$i =$i+1;
	}//while
	//---------------------------------------------------------------
	$arrlength = count($DT);
	if ($arrlength ==0){
			echo "No device token data";
			die();
	}
	//-----Write log---------------------------
				
	for($x = 0; $x < $arrlength; $x++) {
		$attendeeid= $AT[$x];
		if ($attendeeid != "" && $attendeeid !="(null)"){
				$SQL_noti = "Insert into conferencedb.history_noti(timeStamp,userID,section,MSG,IP,updateBy,device_memid,AnnouncementID,network,conferenceID,app_device) values(NOW(),".$attendeeid.",'ann','".protect_quote($message)."','".$_SERVER['REMOTE_ADDR']."','admin',".$attendeeid.",".$AnnouncementID.",'".$NETWORK."',".$EventID.",'IOS')";

				/*echo 	$SQL_noti;
				echo "<BR>";*/
				$result= mysql_query($SQL_noti);
					if($result === FALSE) { 
						 die(mysql_error()); // TODO: better error handling
					}
		}// if
	}//for 
	//------------Send noti---------------------------------------------------
	for($x = 0; $x < $arrlength; $x++) {
		$deviceToken= $DT[$x];
		$attendeeId= $AT[$x];

		if ($deviceToken != "" && $deviceToken !="(null)" && $attendeeId !=""){
			$SQL="select count(device_memid) as total_noti from conferencedb.history_noti where device_memid=".$attendeeId." and (IsRead ='' or IsRead is null) and network='".$NETWORK."' and  (section='1on1' or section='ann')  and conferenceID='".$id."'";

			//echo $SQL;
			//echo "<hr>";

			$result= mysql_query($SQL);
			while($row = mysql_fetch_array($result)){
					$TotalLVapp=rtrim(ltrim($row["total_noti"]));
			}//while

			//echo 	$SQL;
			//echo "<BR>";
			$result=send_notification($app_device,$mode,$deviceToken,$message,$AnnouncementID,$EventID,$TotalLVapp);

			sleep(1); // use for many devices 
			
			echo $result."  To devicetoken : ".$deviceToken." / Attendee ID : ".$attendeeId." / Total app  : ".$TotalLVapp."<br>";

			//----update
			$SQL="update  conferencedb.app_device_noti  set flag_send='Y' where  attendeeId =".$attendeeId."  ";
			$result= mysql_query($SQL);
		
		}// if
	}//for 
	//--------------------------------------
}//ann

?>	
<button onclick="goBack()"> < Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>