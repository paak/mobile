<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);

if ($companyID==""){
		$messageArray=array(MSG=>"No company ID");
		echo json_encode($messageArray);
		die;	
}

$AnnouncementNo =GetNumAnnouncement($NETWORK,$companyID,$attendeeID);
//-------------------------------------------
$messageArray = array(AnnouncementNo=>$AnnouncementNo); 
//-----End Return Array---------------------

echo json_encode($messageArray);
//var_dump($messageArray);

//---------------------------------------------------------------------------------------------------------------------------------------//

?>