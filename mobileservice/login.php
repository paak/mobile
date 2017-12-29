<?php
header('Content-Type: application/json');
echo json_encode(['status'=>true]);
exit();

include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
include("include/lib_login.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
checkSchedulerOpen($G_MEETING_1ON1_STATUS);
//---------------------------------------------------------------------------------------------------------------------------------------//
$username = stripslashes(rtrim(ltrim(protect_quote($_GET['username']))));
$password =  stripslashes(rtrim(ltrim(protect_quote($_GET['password']))));

$ID = protect_quote($_GET['ID']);
$devicetoken = protect_quote($_GET['devicetoken']);
$app_device=checkAppDevice();

//---------------------------------------------------------------------------------------------------------------------------------------//
//-----event---------
//---Config global variable : $name_abbr,$path_comp_logo,$url,$id in file : include/id.php
//-----------------------

/*$messageArray = array(MSG => "One-on-One Meeting Scheduler for handheld devices will open on Tuesday,20th  February, 2018 at 12:00 hrs (Thailand time, GMT+7).");
echo json_encode($messageArray);
die();*/

/*if (strtolower($username)!="o@wcaworld.com" && strtolower($username)!="demoapp@wcaworld.com")  {  // for test notification*/
if (strtolower($username)!="demoapp@wcaworld.com") {  // for test notification
	$messageArray = array(MSG => "One-on-One Meeting Scheduler for handheld devices will open on Tuesday,20th  February, 2018 at 12:00 hrs (Thailand time, GMT+7).");
	echo json_encode($messageArray);
	die();
}

//-----------------------
/*if (strtolower($username)=="" ||  strtolower($password)=="") {
$messageArray = array(MSG => "Please input username and password.");
echo json_encode($messageArray);
die();
}*/
//----------------------------------------
## login ---------------
//--check case sensitive (upper and lower)


$SQL_memeet="select memid,compid,username ,password,paid,status  from memmeet where username='".$username."' and MD5(password) = MD5('".$password."') and  (status is null or  status ='')  ";

$userLogin=get_obj_info($SQL_memeet, array("compid","memid","paid","status"));

if(NULL==$userLogin) {
//$messageArray = array(MSG => "Invalid username or password, please make sure you enter the individual username and password (not the office username and password).");

$messageArray = array(MSG => "Invalid username or password.");

}else {

$ChkCompanyID=$userLogin[0]->compid;
$ChkattendeeID=$userLogin[0]->memid;
$paid=$userLogin[0]->paid;
$status=$userLogin[0]->status;
//---------CheckSuspended---------------*/
$FlagSuspended=CheckSuspended($ChkCompanyID);
//-----------------------------

if ($FlagSuspended=="true"){
$SUPPORT_MAIL="conference@wcaworld.com";
$MSG= "We apologize for the inconvenience (Suspended),Please contact ".$SUPPORT_MAIL." to check attend to ".$G_MEETING_NAME.".";
$messageArray = array(MSG => $MSG);
echo json_encode($messageArray);
die();
}
//------------------------*/
//---------------------------------------------
//---Check paid and Allow at : myAttendeeID.php because user can view another data
//---------------------------------------------
$SQL_comp="select compid,if(company.commonCompany is not null && length(company.commonCompany) >0,company.commonCompany,company.name)  as companyName,BranchCity,BranchCountry,
CASE WHEN company.logo IS NULL or company.logo = '' THEN ''
ELSE concat('".$path_comp_logo."',company.logo) END
AS 'logo'  from company where compid in (".$ChkCompanyID.")";


$objLogin=get_obj_info($SQL_comp, array("compid","companyName","logo"));

$companyID=$objLogin[0]->compid;
$companyName=$objLogin[0]->companyName;
$CompanyLogo=$objLogin[0]->logo;

if(NULL != $objLogin) {
if (!($login=check_session($SID,"login"))){
$username=$ChkattendeeID;
$permission="app";
if( !($SID = create_session("login" ,$username , 4800) )){
$messageArray = array(MSG => "Create Session Error");
echo json_encode($messageArray);
exit();
}
add_session($SID , "permission" ,$permission);
}
//---Config data---------------------//
//companyID
//CompanyName
//CompanyLogo
//SID
$AboutURL=$url. "about.php";
$AgendaURL=$url. "agenda.php";
$FloorURL=$url. "floor_detail.php";
$AttendeeURL=$url. "AttendeeList.php";
$ScheduleURL=$url. "myScheduler.php";
$SponsorURL=$url. "sponsor.php";
$VenueURL=$url. "venue.php";
//-----$latitude & ---$longitude  (config at include/ID.php)-----------------------
//----wca event phae3--------------------
$AnnouncementURL=$url."announcement.php";
$QuestionnaireURL=$url."questionnaire.php";
$ContactURL=$url."contact.php";
$SocialURL=$url."social.php";
$BoothURL=$url."boothlist.php";

//---Shuttle bus----/
//if ($ShowShuttleBus==true){$ShuttlebusURL=$url."shuttlebus_main.php";}else{$ShuttlebusURL="";}
$ShuttlebusURL=$url."shuttlebus_main.php";
//---Banner----/
$AdURL="";
//$AdURL=$url."banner.php";
//---Notification---/
$NotificationURL=$url."notification.php";
//----Return array---------------------
//---For Announcement show number at ICON
$AnnouncementNo =GetNumAnnouncement($NETWORK,$companyID,$ChkattendeeID);
//---Questionaire----------------------------------------
//---Notification---/
if ($ShowQN==true){
$QNenable="TRUE";
$QNmessage="";
}else{
$QNenable="FALSE";
$QNmessage="";
}
//------------------------------
$meeting_version="1";
//-------------------------//
$myAttendeeIDURL=$url."myAttendeeID.php";
//----wca event phae4--------------------
$SettingURL ="setting_main.php";
$ChangePwdURL ="change_pwd.php";
$ForgotPwdURL ="forgot_pwd.php";
$FAQURL="faq.php";
$CalendarURL ="event_calendar.php";
$QRCodeURL ="qrcode_checkin.php";
//-------Config menu----Show/Hide----(16 Menus)-----------------------
$MenuAbout="Show";
$MenuAttendeeList="Show";
$MenuFloorPlan="Show";
$MenuBooths="Show";
$MenuScheduler="Show";
$MenuSposnors="Show";
$MenuMap="Show";
$MenuQN="Hide";
$MenuANN="Show";
$MenuSocial="Show";
$MenuContact="Show";
$MenuShuttleBus="Hide";
$MenuQRCode="Hide";
$MenuFAQ="Show";
$MenuEvent="Show";
$MenuSetting="Show";
//-----------------------------------------
$messageArray= array(MSG => "Login Success!", companyID=>$companyID, CompanyName =>$companyName,CompanyLogo=>$CompanyLogo,SID=>$SID,AboutURL=>$AboutURL,AgendaURL=>$AgendaURL,FloorURL=>$FloorURL,AttendeeURL=>$AttendeeURL,ScheduleURL=>$ScheduleURL,SponsorURL=>$SponsorURL,VenuesURL=>$VenueURL,
latitude=>$latitude,longitude=>$longitude,meeting_version=>$meeting_version,AnnouncementURL=>$AnnouncementURL,QuestionnaireURL=>$QuestionnaireURL,ContactURL=>$ContactURL,
SocialURL=>$SocialURL,BoothURL=>$BoothURL,ShuttlebusURL=>$ShuttlebusURL,AdURL=>$AdURL,NotificationURL=>$NotificationURL,AnnouncementNo=>$AnnouncementNo,QNenable=>$QNenable,QNmessage=>$QNmessage,attendeeID=>$ChkattendeeID,myAttendeeIDURL=>$myAttendeeIDURL,SettingURL=>$SettingURL,ChangePwdURL=>$ChangePwdURL,ForgotPwdURL=>$ForgotPwdURL,FAQURL=>$FAQURL,CalendarURL=>$CalendarURL,QRCodeURL=>$QRCodeURL,
MenuAbout=>$MenuAbout,
MenuAttendeeList=>$MenuAttendeeList,
MenuFloorPlan=>$MenuFloorPlan,
MenuBooths=>$MenuBooths,
MenuScheduler=>$MenuScheduler,
MenuSposnors=>$MenuSposnors,
MenuMap=>$MenuMap,
MenuQN=>$MenuQN,
MenuANN=>$MenuANN,
MenuSocial=>$MenuSocial,
MenuContact=>$MenuContact,
MenuShuttleBus=>$MenuShuttleBus,
MenuQRCode=>$MenuQRCode,
MenuFAQ=>$MenuFAQ,
MenuEvent=>$MenuEvent,
MenuSetting=>$MenuSetting
);
//-----End Return Array---------------------


}else {
$messageArray = array(MSG => "Invalid : Company name");
}//objLogin

}//userLogin


//-----Save token device : update : 26/11/2014------------------------//
if ($devicetoken != "" && $ID != "" && $conf_name != ""&& $companyID != "" && $devicetoken != null){
///connect_DB_Event();
/*---Save log when login to app-* tb : app_device_log */
$SQL_Device="insert into conferencedb.app_device_log(login_date,conf_name,compid,app_device,conferenceID,devicetoken,attendeeID) values(now(),'".$conf_name."',".$companyID.",'".$app_device."',".$ID.",'".$devicetoken."','".$ChkattendeeID."')";

if(!mysql_query($SQL_Device)){
$messageArray=array(MSG=>"Can't add app device log");
echo json_encode($messageArray);
die();
}

//-------Save devicetoken lastest for send notification-------------------*/
//--Clear old device token----------- tb : app_device_noti--*/
$SQL_DeviceDel ="delete from conferencedb.app_device_noti where attendeeID='".$ChkattendeeID."' and conferenceID=".$ID." ";
if(!mysql_query($SQL_DeviceDel)){
$messageArray=array(MSG=>"Can't delete  app_device_noti");
echo json_encode($messageArray);
die();
}else{
$SQL_DeviceNoti="insert into conferencedb.app_device_noti(attendeeID,compid,app_device,conferenceID,devicetoken,UpdateDate,network) values('".$ChkattendeeID."','".$ChkCompanyID."','".$app_device."','".$ID."','".$devicetoken."',now(),'".$NETWORK."')";

if(!mysql_query($SQL_DeviceNoti)){
$messageArray=array(MSG=>"Can't add app device");
echo json_encode($messageArray);
die();
}
}//SQL_DeviceDel
//-------Save devicetoken lastest for send notification-------------------*/

}//devicetoken



//-------End Token device-----------------------------------------------------//

echo json_encode($messageArray);


//var_dump($messageArray);

//---------------------------------------------------------------------------------------------------------------------------------------//

?>