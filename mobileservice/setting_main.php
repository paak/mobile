<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();

$SID = protect_quote($_GET['SID']); 
$attendeeID = protect_quote($_GET['attendeeID']); 
$companyID = protect_quote($_GET['companyID']); 

//$url_ref="http://dev.conference.wcaworld.com/sino2015/mobileservice/";  // user for banner

//---------------------------------------------------------------------------------------------------------------------------------------//

$messageArray1 = array('TitleID' => '1','TitleName' => 'CHANGE PASSWORD','URL' => $url.'change_pwd.php?SID='.$SID.'&attendeeID='.$attendeeID.'&companyID='.$companyID,'ImgIpad'=> $url_ref.'images/setting/iPad-ChangePwd.jpg','ImgIphone'=> $url_ref.'images/setting/iPhone-ChangePwd.jpg','ImgWidth' =>'359','ImgHeight' =>'69',
'ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');


echo json_encode(array($messageArray1));


?>