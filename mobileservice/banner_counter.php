<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
include("include/date_share.php");
//---Get from banner.php-------------//
$SID = protect_quote($_GET['SID']); 
$bannerID = protect_quote($_GET['bannerID']); 
$bannerURL = protect_quote($_GET['bannerURL']); 
$attendeeID = protect_quote($_GET['attendeeID']); 
//--------------------------------------------------------------------------------------------------------------------------------------//
//checkHTTPS();
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
echo "Loading ...<img src='images/ajax-loader14.gif'/>";
//---Get from banner.php , ID.php-------------//
switch ($MEETING_ID) {
		case "WCAS":
				$url_path="http://conference.wcaworld.com/service/bannerImg/2018/";  // use for image
				if ($bannerID=="1"){$bannerImg=$url_path."Etihad/Etihad_Iphone.jpg";}
				if ($bannerID=="2"){$bannerImg=$url_path."CTC/CTC_Iphone.jpg";}
				if ($bannerID=="3"){$bannerImg=$url_path."SeaSky/Seasky_Iphone.jpg";}
			break;
		case "WCAFS":
				$url_path="http://conference.wcaworld.com/service/bannerImg/2018/";  // use for image
				if ($bannerID=="1"){$bannerImg=$url_path."Etihad/Etihad_Iphone.jpg";}
				if ($bannerID=="2"){$bannerImg=$url_path."CTC/CTC_Iphone.jpg";}
				if ($bannerID=="3"){$bannerImg=$url_path."SeaSky/Seasky_Iphone.jpg";}
			break;
		case "SINO":
				if ($bannerID=="1"){$bannerImg="http://conference.wcaworld.com/sino2017/mobileservice/images/adv_banner/EverOK_V2-01.jpg";}
				if ($bannerID=="2"){$bannerImg="http://conference.wcaworld.com/sino2017/mobileservice/images/adv_banner/EverOK_V2-02.jpg";}
				if ($bannerID=="3"){$bannerImg="http://conference.wcaworld.com/sino2017/mobileservice/images/adv_banner/EverOK_V2-03.jpg";}
			break;

		case "AMERICAS":
				if ($bannerID=="1"){$bannerImg="http://conference.wcaworld.com/americas2017/mobileservice/images/adv_banner/640x100/SeGlobal-640x100px-01.jpg";}
				if ($bannerID=="2"){$bannerImg="http://conference.wcaworld.com/americas2017/mobileservice/images/adv_banner/640x100/SeGlobal-640x100px-02.jpg";}
				if ($bannerID=="3"){$bannerImg="http://conference.wcaworld.com/americas2017/mobileservice/images/adv_banner/640x100/SeGlobal-640x100px-03.jpg";}
			break;
		case "GAA":
				$url_path="http://conference.wcaworld.com/gaa2017/mobileservice/images/adv_banner/";  // use for image
				if ($bannerID=="1"){$bannerImg=$url_path."Iphone_VDSPL1.jpg";}
				if ($bannerID=="2"){$bannerImg=$url_path."Iphone_Velji2_21802017.jpg";}
			break;
		case "LOGENT":
				
			break;
		default:
				
}//Switch
//---Save log -------------//
if ($attendeeID !="" && $bannerID!="" && $conf_name !="") {
	$SQL="insert into banner_app(conf_name,bannerID,bannerURL,bannerImg,memid,UpdateDate) values('".$conf_name."','".$bannerID."','".$bannerURL."','".$bannerImg."','".$attendeeID."',now())";
		
						if(!mysql_query($SQL)){
								$messageArray=array(MSG=>"Can't add banner log");
								echo json_encode($messageArray);
								die();
						}
}
//---Save log -------------//
header("Location:".$bannerURL);
//---------------------------------------------------------------------------------------------------------------------------------------//
?>