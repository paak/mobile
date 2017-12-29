<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//--------------------------------------------------------------------------------------------------------------------------------------//
$SID = protect_quote($_GET['SID']); 
$attendeeID = protect_quote($_GET['attendeeID']); 

//--------------------------------------------------------------------------------------------------------------------------------------//

			  /* $url_path="http://conference.wcaworld.com/wcafirst2018/mobileservice/";  // use for image

			    $messageArray1 = array('BannerID' => '1','BannerURL' => ''.$url_path.'/images/adv_banner/EverOK_V2-01.jpg',
				'BannerIpadURL' =>''.$url_path.'/images/adv_banner/EverOK_IPad_V2-01.jpg',
				'BannerLink'=>$url_ref.'banner_counter.php?SID='.$SID.'&bannerID=1&bannerURL=http://www.everokgroup.com/en/index/&attendeeID='.$attendeeID.'','RotateSecond' => '7');

				$messageArray2 = array('BannerID' => '2','BannerURL' => ''.$url_path.'/images/adv_banner/EverOK_V2-02.jpg',
				'BannerIpadURL' =>''.$url_path.'/images/adv_banner/EverOK_IPad_V2-02.jpg',
				'BannerLink'=>$url_ref.'banner_counter.php?SID='.$SID.'&bannerID=2&bannerURL=http://www.everokgroup.com/en/index/&attendeeID='.$attendeeID.'','RotateSecond' => '7');


				/*$messageArray3 = array('BannerID' => '3','BannerURL' => ''.$url_path.'/images/adv_banner/EverOK_V2-03.jpg',
				'BannerIpadURL' =>''.$url_path.'/images/adv_banner/EverOK_IPad_V2-03.jpg',
				'BannerLink'=>$url_ref.'banner_counter.php?SID='.$SID.'&bannerID=3&bannerURL=http://conference.wcaworld.com/sino2017/mobileservice/article.htm&attendeeID='.$attendeeID.'','RotateSecond' => '7');*/


				/*$messageArray3 = array('BannerID' => '3','BannerURL' => ''.$url_path.'/images/adv_banner/EverOK_V2-03.jpg',
				'BannerIpadURL' =>''.$url_path.'/images/adv_banner/EverOK_IPad_V2-03.jpg',
				'BannerLink'=>$url_ref.'banner_counter.php?SID='.$SID.'&bannerID=3&bannerURL=http://conference.wcaworld.com/sino2017/mobileservice/pdf/Article_LowRes19102017.pdf&attendeeID='.$attendeeID.'','RotateSecond' => '7');


				echo json_encode(array($messageArray1,$messageArray2,$messageArray3));*/

//--------------------------------------------------------------------------------

?>