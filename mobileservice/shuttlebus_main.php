<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//


$messageArray1 = array('PlaceID' => '1','PlaceName' =>'SHUTTLE BUS', 
'PlaceImg' => ''.$url.'images/shutterbus/ShuttleBus_2017.jpg',
'PlaceURL' =>''.$url.'shuttlebus_detail.php',
'ImgWidth' =>'528','ImgHeight' =>'76', 
'PlaceImgIpad' => ''.$url.'images/shutterbus/ShuttleBus_2017.jpg',
'ImgWidthIpad' =>'820','ImgHeightIpad' =>'130');



echo json_encode(array($messageArray1));

?>