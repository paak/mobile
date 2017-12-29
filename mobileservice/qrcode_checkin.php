<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();

$SID =  trim(protect_quote($_GET['SID'])); 
$attendeeID = trim(protect_quote($_GET['attendeeID'])); 
$companyID = trim(protect_quote($_GET['companyID'])); 

//----$path_qrcode_img  , config at ID.php--------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
		if ($attendeeID=="" or $attendeeID==NULL ) {
			$messageArray=array(MSG=>"Invalid : attendeeID");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
		if ($companyID=="" or $companyID==NULL ) {
			$messageArray=array(MSG=>"Invalid : companyID");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
$SQL="select t2.compid as CompID,t2.memid as attendeeID,concat(rtrim(ltrim(t2.name)),' ',t2.middle_name,' ',t2.last_name) as
attendeeName,replace(rtrim(ltrim(t1.commonCompany)),'`','') as CompanyName,
CASE WHEN t2.qrcode_img IS NULL or t2.qrcode_img = '' THEN ''
ELSE concat('".$path_qrcode_img."',t2.qrcode_img) END
AS 'qrcode_img'
from company t1 inner join  memmeet t2  on t1.compid =t2.compid
where t2.memid = ".$attendeeID ." and t2.compid =".$companyID." ";

$FIELD_ATT_INFO = array("CompID","attendeeID","attendeeName","CompanyName","qrcode_img"); 

$messageArray=get_obj_info($SQL,$FIELD_ATT_INFO);

//---------------------------------------------------------------------------------------------------------------------------------------//

echo json_encode($messageArray);

//---------------------------------------------------------------------------------------------------------------------------------------//
?>