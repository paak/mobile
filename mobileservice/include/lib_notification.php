<?php
//--------------------------------------------------------------------------------//
function send_notification($appDevice,$mode,$deviceToken,$message,$AnnouncementID,$EventID,$TotalLVapp){
if ($appDevice=="IOS") {
//----------------------------//
//$mode="PRODUCTION";
// Put your device token here (without spaces):
//$deviceToken = 'e50740f095c8d9dbb805112a5d6bb88edad8d08675860478145ea4790013f253'; // O's iPhone 6
//$deviceToken = '15316a08ab64710b7f3df84b43b419f6af84d624551a650a17580244bad36bb6'; // Muay's ipad
//$deviceToken = '9ee0fad4df5c81022a5eeca406f5292df4d60792b0371ab248195727ed6e133e'; // Pornthipa iPhone Plus
// d24d1ab85bd93e34f10bc3c13d5aaef44d608a4b4ec06f3232eea3690f8c1880 // chompu
// Put your private key's passphrase here:
$passphrase = 'abzolute'; //passphase ที่ใช้ในการ encrypt private key
// Put your alert message here:
//$message = 'test push noti';
////////////////////////////////////////////////////////////////////////////////
//$TotalNoti=0;  //reset
//--------------------------------
//$pemFile = "wca_production.pem";
if ($mode=="PRODUCTION"){
	   $pemFile = "../../service/wca_aps_cert_with_key.pem";
}else{
		$pemFile = "../../../meeting/service/wca2016_development.pem";
}
//------------------------------------------------------------------------------
if(!file_exists($pemFile))	exit("pem file is missing. ".$pemFile );

$ctx = stream_context_create();
if($mode=="PRODUCTION"){
	stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/../../service/wca_aps_cert_with_key.pem');
}else {
	stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/../../service/wca_development.pem'); 
}
stream_context_set_option($ctx, 'ssl', 'local_cert',$pemFile ); //certificate+private key ของแต่ละ app
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
//stream_context_set_option($ctx, 'ssl', 'capath', dirname(__FILE__) . '\ca');
stream_context_set_option($ctx, 'ssl', 'allow_self_signed',TRUE);
stream_context_set_option($ctx, 'ssl', 'peer_certificate_chain',TRUE);

// Open a connection to the APNS server
if($mode=="PRODUCTION"){
	$apn_server="ssl://gateway.push.apple.com:2195";
}else{
	$apn_server="ssl://gateway.sandbox.push.apple.com:2195";
}

$fp = stream_socket_client(
	$apn_server, $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);


if (!$fp)
	exit("<HR>Failed to connect: $err $errstr" . PHP_EOL);

//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
//--------------------------------------
if ( $AnnouncementID =="" ||   $AnnouncementID ==null){
		$from ="Announcement";
}else{
		$from ="OneOnOne";
}
//--------------------------------------

$body['aps'] = array(
	'alert' => $message,
	'sound' => 'default',
	'AnnouncementID' => $AnnouncementID,
	'EventID' => $EventID,
	'badge' => $TotalLVapp, // show on app icon 
	'from' => $from, // alert from 
	);

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;



// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

/*if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;
*/

if (!$result){
	 $status="Not Completed";
}else{
	 $status="Completed";
}


// Close the connection to the server
fclose($fp);
} //IOS
//------------------------------------------------------------
if ($appDevice=="ANDROID") {

	//Google Account: WCA
	$ServerKey="AIzaSyBSD7i0R1k1d0IfO-WYauiirJx4dB0O_ec";
	$SenderID="639039318369";

	//$RegID="e03tkQeYrG0:APA91bElTJTvXDLg-NwoAHyaBWRRoFGN6DLj7DwEU_BcCdHpQWvkNPwlqUJWi6tHvl7KVog26IAvgn2QksOVZnlvZ-JM5ZoaXUCp21LY4xxoTvkW-7BdO2Z05x3V8dfpRGNrnLF0IUwK";  // Phupha

	$url = 'https://gcm-http.googleapis.com/gcm/send';

	if ($AnnouncementID!=""){
		$aps = array(
		'alert' => $message,
		'sound' => 'default',
		'AnnouncementID' => $AnnouncementID, 
		'EventID' => $EventID
		);
	}else{
		$aps = array(
		'alert' => $message,
		'sound' => 'default',
		'AnnouncementID' => '', //IF SCHEDULER PUT BLANK ''
		'EventID' => $EventID
		);
	}//AnnouncementID
	
	$fields = array(
		'to' => $deviceToken,
		'data' => $aps,
	);
	$headers = array(
		'Authorization: key='.$ServerKey,
		'Content-Type: application/json'
	);
	// Open connection
	$ch = curl_init();
	// Set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Disabling SSL Certificate support temporarly
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	// Execute post
	$result = curl_exec($ch);

	if ($result === FALSE) {
		die('Curl failed: ' . curl_error($ch));
		 $status="Not Completed";
	}else{
		 $status="Completed";
	}

	// Close connection
	curl_close($ch);

	
}//ANDROID
//----------------------------------------------

return $status;

}//end function
//###########################################################-
//--------NUMBER------------------------------------------------------------------------------------------------------------//
function GetTotalNoti($LV,$ID,$devicetoken,$NotificationMenu,$mode){
//--------------------------
if ($LV=='' ){
		$messageArray = array(MSG=>"LV is not available"); 
	    echo json_encode($messageArray);
		die();
}
//--------------------------
if ($LV!='app' && $LV!='menu' && $LV!='detail' && $LV!='event' ){
		$messageArray = array(MSG=>"LV is not correct"); 
	    echo json_encode($messageArray);
		die();
}
//------------------------------------
if ($LV=='menu' || $LV=='detail' ){
		if ($ID=='' ){
			$messageArray = array(MSG=>"ID is not available"); 
			echo json_encode($messageArray);
			die();
		}
}
//------------------------
if ($devicetoken==''){
		if ($devicetoken=='' ){
			$messageArray = array(MSG=>"devicetoken is not available"); 
			echo json_encode($messageArray);
			die();
		}
}
//----1.-Find attendee id ---------------------
$device_memid=GetAttendeeIdByDeviceToken2($devicetoken);


//----set default--------
$TotalOneOnOne=0; 
$TotalAnn=0; 
$TotalApp=0;
if ($device_memid!=""){
//-----2.Find total number-by database--------------------
	$result=GetConferenceActive($mode);
	$num_row=mysql_numrows($result);
	if ($num_row > 0 ) {
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$network_app=$row['name_abbr'] ;
			$dbname=rtrim(ltrim($row['db']));
			$numOneOnOne = GetHistoryNoti_1on1($device_memid,$network_app,$dbname);
			$numAnn = GetHistoryNoti_ann($device_memid,$network_app,$dbname);
	
			$TotalOneOnOne = $TotalOneOnOne+$numOneOnOne;
			$TotalAnn = $TotalAnn+$numAnn;
		
		}//while
	}//num row
}//devicetoken
//------------------------------------------------------------------------------
if ($LV=="app" ){ $TotalApp=$TotalOneOnOne+$TotalAnn;}
if ($LV=="menu" && $NotificationMenu=="SCHEDULER" ){$TotalApp=$TotalOneOnOne;}
if ($LV=="menu" && $NotificationMenu=="ANNOUNCEMENT" ){$TotalApp=$TotalAnn;}
//------------------------------------------------------------------------------

echo $TotalOneOnOne;
echo "<BR>";
echo $TotalAnn;
echo "<BR>";
///---------------------------------
return  $TotalApp;


}//end function

//##############Function############################
function GetConferenceActive($mode){
	//--Connect by db----------
	global $DBhost_event;
	global $DBuser_event;
	global $DBpasswd_event;
	global $DBname_event;
	global $mysql_event;

	 connect_DB_Event();
	//--Query db----------
	if ($mode =="PRODUCTION"){
		$SQL = " Select ID,name,name_abbr,status,version,db from event  where  status = 'Active' and effectiveDateFrom  <= date(now()) and effectiveDateTo  >= date(now())  and version ='meeting' and IsNoti='Y'  limit 1";
	}else{
		$SQL = " Select ID,name,name_abbr,status,version,db from event  where  status = 'Inactive' and effectiveDateFrom  <= date(now()) and effectiveDateTo  >= date(now())  and version ='dev' and IsNoti='Y'  limit 1";
	}

	$result=mysql_query($SQL);

	if($result === FALSE) { 
			   echo "GetConferenceActive";
		    die(mysql_error()); // TODO: better error handling
	}

	mysql_close();

	return $result;

}//end function
//--------------------------------------------------------------------

function GetAttendeeIdByDeviceToken2($devicetoken){
	global $DBhost_event;
	global $DBuser_event;
	global $DBpasswd_event;
	global $DBname_event;
	global $mysql_event;

	if(!$mysql_event) {
		if(!($mysql_event=mysql_connect($DBhost_event,$DBuser_event,$DBpasswd_event))) {
				print "Error to connect mysql!.";
				die;
		}
		if(!mysql_select_db($DBname_event)){
				print "Error : select DB ";
				die;
		}
	}

	//--Query db----------
	if ($mode =="PRODUCTION"){
		$SQL="select   attendeeid    from  app_device_noti where devicetoken='".$devicetoken."' 
		        and conferenceid in (Select ID from event  where  status = 'Active' and effectiveDateFrom  <= date(now()) and effectiveDateTo  >= date(now())  and version ='meeting' and IsNoti='Y')  order by updatedate desc limit 1";

	}else{
		$SQL="select attendeeid  from  app_device_noti where devicetoken='".$devicetoken."' 
		and conferenceid in ( Select ID from event  where  status = 'Inactive' and effectiveDateFrom  <= date(now()) and effectiveDateTo  >= date(now())  and version ='dev' and IsNoti='Y' )  order by updatedate desc  limit 1 ";
	}

	$result= mysql_query($SQL,$mysql_event);

	echo count($result);

	if($result === FALSE) { 
		    echo "GetAttendeeIdByDeviceToken";
		    die(mysql_error()); // TODO: better error handling
	}


	while($row = mysql_fetch_array($result)){
						$attendeeid = $row["attendeeid"];
	}//while


	
	return $attendeeid;



}//end function
//--------------------------------------------------------------------
function GetDeviceTokenByAttendeeID($attendeeID,$EventID){
	//--Connect by db----------
	global $DBhost_event;
	global $DBuser_event;
	global $DBpasswd_event;
	global $DBname_event;
	global $mysql_event;
	 connect_DB_Event();
	//--Query db----------

	$SQL="select devicetoken  from  app_device_noti where attendeeid =".$attendeeID." and conferenceid =".$EventID."";

	$result=mysql_query($SQL);

	if($result === FALSE) { 
			echo "GetDeviceTokenByAttendeeID";
		    die(mysql_error()); // TODO: better error handling
	}

	mysql_close();
	return $result;

}//end function
//--------------------------------------------------------------------
function GetHistoryNoti_1on1($device_memid,$network,$dbname){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $mysql_noti;

	//--Connect by db----------
	connect_DB_ConfNoti($dbname);
	//--Query db----------
	$SQL="select device_memid from history_noti where device_memid=".$device_memid." and
	(IsRead ='' or IsRead is null) and network='".$network."' and section='1on1'";

	$result=mysql_query($SQL);

	if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
	}


	if ($result !="" ){
		$num=mysql_numrows($result);
	}else{
		$num=0;
	}
	//--Return data----------
	return $num;

	mysql_close();

}//end function
function GetHistoryNoti_ann($device_memid,$network,$dbname){
	//--Connect by db----------
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $mysql_noti;

	connect_DB_ConfNoti($dbname);
	//--Query db----------
	/*$SQL="select announcementid from announcement
	where announcementid not in (select announcementid from announcement_log where attendeeid =".$device_memid.") ";*/

    $SQL="select device_memid from history_noti where device_memid=".$device_memid." and
	(IsRead ='' or IsRead is null) and network='".$network."' and section='ann'";

	$result=mysql_query($SQL);

	if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
	}


	if ($result !="" ){
		$num=mysql_numrows($result);
	}else{
		$num=0;
	}
	//--Return data----------
	return $num;
		mysql_close();

}//end function
//---------------------------------------------------------------------------------------
//##############Function############################
?>