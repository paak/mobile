<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
$messageArray1 = array('SocialID' => '1','SocialName' =>'facebook', 
'SocialImg' =>''.$url.'/images/social/facebook.png','ImgWidth' =>'60','ImgHeight' =>'60', 
'SocialImgIpad' =>''.$url.'/images/social/Facebook_iPad.png','ImgWidthIpad' =>'115','ImgHeightIpad' =>'115', 
'SocialURL' => "https://www.facebook.com/WCALtd",'ID' => '','Enable' => 'TRUE');

$messageArray2 = array('SocialID' => '2','SocialName' =>'linkedin', 
'SocialImg' => ''.$url.'/images/social/linkedin.png', 'ImgWidth' =>'60','ImgHeight' =>'60', 
'SocialImgIpad' =>''.$url.'/images/social/Linkedin_iPad.png','ImgWidthIpad' =>'115','ImgHeightIpad' =>'115', 
'SocialURL' => "https://www.linkedin.com/company/wca-family-of-logistic-networks",'ID' => '','Enable' => 'TRUE');

$messageArray3 = array('SocialID' => '3','SocialName' =>'twitter', 
'SocialImg' => ''.$url.'/images/social/twitter.png','ImgWidth' =>'60','ImgHeight' =>'60',  
'SocialImgIpad' =>''.$url.'/images/social/Twitter_iPad.png','ImgWidthIpad' =>'115','ImgHeightIpad' =>'115', 
'SocialURL' => "https://twitter.com/wca_world",'ID' => '','Enable' => 'TRUE');


$messageArray4 = array('SocialID' => '4','SocialName' =>'weibo', 
'SocialImg' => ''.$url.'/images/social/weibo.png','ImgWidth' =>'60','ImgHeight' =>'60',  
'SocialImgIpad' =>''.$url.'/images/social/Weibo_iPad.png','ImgWidthIpad' =>'115','ImgHeightIpad' =>'115', 
'SocialURL' => "http://weibo.cn/chinawca",'ID' => '','Enable' => 'TRUE');


$messageArray5 = array('SocialID' => '5','SocialName' =>'flickr', 
'SocialImg' => ''.$url.'/images/social/flickr.png','ImgWidth' =>'60','ImgHeight' =>'60',  
'SocialImgIpad' =>''.$url.'/images/social/flickr_iPad.png','ImgWidthIpad' =>'115','ImgHeightIpad' =>'115', 
'SocialURL' => "http://www.flickr.com/photos/wcaltd/",'ID' => '','Enable' => 'TRUE');
//---------------------------------------------------------------------------------------------------------------------------------------//
echo json_encode(array($messageArray1,$messageArray2,$messageArray3,$messageArray4,$messageArray5));
//---------------------------------------------------------------------------------------------------------------------------------------//
?>