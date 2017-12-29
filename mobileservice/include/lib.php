<?php 
include("ID.php");
//------------------------------------------------------------------------------------------------------------------------------------------
$MEETING_TOTAL_TIME=23;
$MEETING_START_TIME="08:00";
$MEETING_TIME_INTERVAL=30; // default 30 minute
//------------------------------------------------------------------------------------------------------------------------------------------

$MEETING_PROFILE = array("meetingID", "password", "companyName", "name", "conferencePlace", "conferenceDate", "shortName", "mail_sender", "mail_admin", "mail_notice", "mail_contact", "mail_hotel", "mail_advertising", "mail_exhibition", "mail_sponsor", "mail_support", "mail_miscellaneous", "mail_accounting", "mail_cc_notice", "mail_cc_notice_chinese", "registerStatus", "registerMSG", "oneononeStatus", "oneononeMSG", "referentURL", "infoPath", "registerPath", "infoLoginURL", "backSite", "targetNumber", "enableHotel", "enableTour", "enableGolf", "enableAdvertising", "enableMerchandise", "enableAdvertising", "enableBooth", "enableSponsor", "enableLimusine","enableTranslator","enableSanctionCoun","enableForceSanctionToCifa",
"enableRequireApproval","enableBlockSanctionFromRegist","enableRMBForCifa", "enableEditRepCityCounMember", "enableEditRepCityCounNonMember", "enableLognetAsWCAF", "enableOnlyOneononeAvailable", "golfForm", "tourForm","mail_cifa", "showConferenceLetter", "cutOffGBDate", "HTMLtitle");//Yoo 2011 Mar 10, 2011 Jun 16, 2011 Aug 18

//,"timeStamp"e
$ELEMENT_MEETING_PROFILE["meetingID"] = new field_structure("Meeting ID",0,0,"Display");
$ELEMENT_MEETING_PROFILE["companyName"] = new field_structure("Company Name",255,70);
$ELEMENT_MEETING_PROFILE["name"] = new field_structure("Meeting Name",255,70);
$ELEMENT_MEETING_PROFILE["conferencePlace"] = new field_structure("Being held at",255,70);
$ELEMENT_MEETING_PROFILE["conferenceDate"] = new field_structure("Conference Date",255,70);
$ELEMENT_MEETING_PROFILE["shortName"] = new field_structure("Short Name",20,20);
$ELEMENT_MEETING_PROFILE["password"] = new field_structure("Change Administrator Password",20,20,"password");
$ELEMENT_MEETING_PROFILE["mail_sender"] = new field_structure("Sender E-mail",150,70);
$ELEMENT_MEETING_PROFILE["mail_admin"] = new field_structure("Administrator E-mail <BR><font color=#3333FF size=1>(For inform error or program problem)</font>",150,70);
$ELEMENT_MEETING_PROFILE["mail_notice"] = new field_structure("Notice E-mail",150,70);
$ELEMENT_MEETING_PROFILE["mail_contact"] = new field_structure("Contact E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_hotel"] = new field_structure("Hotel  Reservation E-mail",150,70);
$ELEMENT_MEETING_PROFILE["mail_advertising"] = new field_structure("Advertising E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_exhibition"] = new field_structure("Exhibition E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_sponsor"] = new field_structure("Sponsor E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_support"] = new field_structure("Support E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_conference"] = new field_structure("Conference E-mail ",150,70); //--update : 08/09/2017
$ELEMENT_MEETING_PROFILE["mail_miscellaneous"] = new field_structure("Miscellaneous E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_accounting"] = new field_structure("Accounting E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_cc_notice"] = new field_structure("CC Notice E-mail ",150,70);
$ELEMENT_MEETING_PROFILE["mail_cc_notice_chinese"] = new field_structure("CC Notice E-mail Chinese",150,70);
$ELEMENT_MEETING_PROFILE["registerStatus"] = new field_structure("Registration Status",0,0,"Display");
$ELEMENT_MEETING_PROFILE["registerMSG"] = new field_structure("MSG",1000,42);
$ELEMENT_MEETING_PROFILE["oneononeStatus"] = new field_structure("1on1 Scheduler Status",0,0,"Display");
$ELEMENT_MEETING_PROFILE["oneononeMSG"] = new field_structure("MSG",1000,42);
$ELEMENT_MEETING_PROFILE["referentURL"] = new field_structure("Referent URL <font color=#3333FF size=1>(Home Page)",255,70);
$ELEMENT_MEETING_PROFILE["infoPath"] = new field_structure("information Path",150,70);
$ELEMENT_MEETING_PROFILE["registerPath"] = new field_structure("Registration Path",150,70);
$ELEMENT_MEETING_PROFILE["infoLoginURL"] = new field_structure("Login URL",150,70);
$ELEMENT_MEETING_PROFILE["backSite"] = new field_structure("Back Site",150,70);
$ELEMENT_MEETING_PROFILE["enableAdvertising"] = new field_structure("Enable Advertising",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableSponsor"] = new field_structure("Enable Sponsor",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableBooth"] = new field_structure("Enable Booth",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableHotel"] = new field_structure("Enable Hotel",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableTour"] = new field_structure("Enable Tour",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableGolf"] = new field_structure("Enable Golf",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableMerchandise"] = new field_structure("Enable Merchandise",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableLimusine"] = new field_structure("Enable Limusine",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableTranslator"] = new field_structure("Enable Translator",0,0,"Display");
$ELEMENT_MEETING_PROFILE["golfForm"] = new field_structure("Show Form",0,0, "Display");
$ELEMENT_MEETING_PROFILE["tourForm"] = new field_structure("Program",0,0, "Display");
$ELEMENT_MEETING_PROFILE["cutOffGBDate"] = new field_structure("Cut Off Guidebook Date",255,70);
$ELEMENT_MEETING_PROFILE["enableSanctionCoun"] = new field_structure("Sanction Country",255,70);
$ELEMENT_MEETING_PROFILE["enableForceSanctionToCifa"] = new field_structure("Force Sanction to CIFA",255,70);
$ELEMENT_MEETING_PROFILE["enableRequireApproval"] = new field_structure("Approval Requirement",255,70);
$ELEMENT_MEETING_PROFILE["enableBlockSanctionFromRegist"] = new field_structure("Block Sanction from Registration",255,70);
$ELEMENT_MEETING_PROFILE["enableRMBForCifa"] = new field_structure("Show RMB For CIFA",255,70);

//--------------Yoo: 2011 Jun 16--------------
$ELEMENT_MEETING_PROFILE["enableEditRepCityCounMember"] = new field_structure("Enable Member to edit RepCityCountry",0,0,"Display");
$ELEMENT_MEETING_PROFILE["enableEditRepCityCounNonMember"] = new field_structure("Enable NonMember to edit RepCityCountry",0,0,"Display");

//----------------------------------------------------------------------------------------------------------------------------------------
//print "Select * from meetingProfile where meetingID = '$MEETING_ID' ";
if(NULL == ($GLOBAL_meetingProfile = get_obj_info("Select * from meetingprofile where meetingID = '$MEETING_ID' ",$MEETING_PROFILE))) errMSG("Error: Meeting Profile is not define") ;

//------------Yoo: 2011 Jan 26----------
if($MEETING_ID=="WCAS" || $MEETING_ID=="WCAFS"){
	
	//--Yoo: 2011 Sep 8---
	if(NULL == ($GLOBAL_meetingProfile_WCAS = get_obj_info("Select name, shortName, conferencePlace, conferenceDate from meetingprofile where meetingID = 'WCAS'",array("name","shortName","conferencePlace","conferenceDate") ))) errMSG("Error: WCAS Meeting Profile is not define") ; 
	$G_MEETING_NAME_WCAS				= $GLOBAL_meetingProfile_WCAS[0]->name;
	$G_MEETING_NAME_SHORT_WCAS			= $GLOBAL_meetingProfile_WCAS[0]->shortName;
	$G_CONFERENCE_PLACE_WCAS			= $GLOBAL_meetingProfile_WCAS[0]->conferencePlace;
	$G_CONFERENCE_DATE_WCAS				= $GLOBAL_meetingProfile_WCAS[0]->conferenceDate;
	//--------------------

	if(NULL == ($GLOBAL_meetingProfile_WCAFS = get_obj_info("Select name, shortName, conferencePlace, conferenceDate from meetingprofile where meetingID = 'WCAFS'",array("name","shortName","conferencePlace","conferenceDate") ))) errMSG("Error: WCAFS Meeting Profile is not define") ; //"enableNewRegister",
	//$G_ENABLE_NEW_REGISTER_WCAFS		= $GLOBAL_meetingProfile_WCAFS[0]->enableNewRegister;
	$G_MEETING_NAME_WCAFS				= $GLOBAL_meetingProfile_WCAFS[0]->name;
	$G_MEETING_NAME_SHORT_WCAFS			= $GLOBAL_meetingProfile_WCAFS[0]->shortName;
	$G_CONFERENCE_PLACE_WCAFS			= $GLOBAL_meetingProfile_WCAFS[0]->conferencePlace;
	$G_CONFERENCE_DATE_WCAFS			= $GLOBAL_meetingProfile_WCAFS[0]->conferenceDate;

}else {
	
	//--Yoo: 2011 Sep 8---
	$G_MEETING_NAME_WCAS			= "";
	$G_MEETING_NAME_SHORT_WCAS		= "";
	$G_CONFERENCE_PLACE_WCAS		= "";
	$G_CONFERENCE_DATE_WCAS			= "";
	//--------------------

	//$G_ENABLE_NEW_REGISTER_WCAFS	= "1";
	$G_MEETING_NAME_WCAFS			= "";
	$G_MEETING_NAME_SHORT_WCAFS		= "";
	$G_CONFERENCE_PLACE_WCAFS		= "";
	$G_CONFERENCE_DATE_WCAFS		= "";
}
//---------------------------------------

$SENDER_MAIL=$GLOBAL_meetingProfile[0]->mail_sender;
$ADMIN_MAIL=$GLOBAL_meetingProfile[0]->mail_admin;
$SUPPORT_MAIL=$GLOBAL_meetingProfile[0]->mail_contact;
$NOTICE_US_MAIL=$GLOBAL_meetingProfile[0]->mail_notice;
$G_MEETING_NAME=$GLOBAL_meetingProfile[0]->name;
$G_MEETING_NAME_SHORT=$GLOBAL_meetingProfile[0]->shortName;
$G_MEETING_COMPANYNAME=$GLOBAL_meetingProfile[0]->companyName;
$G_MEETING_REGISTER_STATUS=$GLOBAL_meetingProfile[0]->registerStatus;
$G_MEETING_REGISTER_MESSAGE=$GLOBAL_meetingProfile[0]->registerMSG;
$G_MEETING_1ON1_STATUS=$GLOBAL_meetingProfile[0]->oneononeStatus;
$HOTELRESERVATION_MAIL = $GLOBAL_meetingProfile[0]->mail_hotel;
$ADVERTISING_MAIL = $GLOBAL_meetingProfile[0]->mail_advertising;
$EXHIBITION_MAIL = $GLOBAL_meetingProfile[0]->mail_exhibition;
$SPONSOR_MAIL = $GLOBAL_meetingProfile[0]->mail_sponsor;
//$SUPPORT_MAIL =$GLOBAL_meetingProfile[0]->mail_support;
$SUPPORT_MAIL =$GLOBAL_meetingProfile[0]->mail_conference;  // change : 08/09/2017

$MISCELLANEOUS_MAIL = $GLOBAL_meetingProfile[0]->mail_miscellaneous;
$ACCOUNTING_MAIL = $GLOBAL_meetingProfile[0]->mail_accounting;
$CONTACT_MAIL	= $GLOBAL_meetingProfile[0]->mail_contact;
$NOTICE_US_MAIL =$GLOBAL_meetingProfile[0]->mail_notice;
$CC1_NEW_COMPANY_NOTICE = $GLOBAL_meetingProfile[0]->mail_cc_notice;
$CC2_NEW_COMPANY_NOTICE_CHINESE =$GLOBAL_meetingProfile[0]->mail_cc_notice_chinese;
$G_TITLE=$GLOBAL_meetingProfile[0]->HTMLtitle;
$G_INFO_PATH = $GLOBAL_meetingProfile[0]->infoPath;
$G_REFERENT_URL = $GLOBAL_meetingProfile[0]->referentURL;
$G_REGISTER_PATH = $GLOBAL_meetingProfile[0]->registerPath;
$G_INFO_LOGIN_URL = $GLOBAL_meetingProfile[0]->infoLoginURL;
$G_BACK_SITE = $GLOBAL_meetingProfile[0]->backSite;
$G_TARGET_NUMBER= $GLOBAL_meetingProfile[0]->targetNumber;
$G_ENABLE_HOTEL = $GLOBAL_meetingProfile[0]->enableHotel;
$G_ENABLE_TOUR = $GLOBAL_meetingProfile[0]->enableTour;
$G_ENABLE_GOLF = $GLOBAL_meetingProfile[0]->enableGolf;
$G_ENABLE_MERCHANDISE = $GLOBAL_meetingProfile[0]->enableMerchandise;
$G_ENABLE_RIMUSINE = $GLOBAL_meetingProfile[0]->enableLimusine;
$G_ENABLE_ADV = $GLOBAL_meetingProfile[0]->enableAdvertising;
$G_ENABLE_SPONSOR = $GLOBAL_meetingProfile[0]->enableSponsor;
$G_ENABLE_BOOTH = $GLOBAL_meetingProfile[0]->enableBooth;
$G_ENABLE_BILLBOARD= $GLOBAL_meetingProfile[0]->enableBillboard;
$G_ENABLE_TRANSLATOR= $GLOBAL_meetingProfile[0]->enableTranslator;
$G_ENABLE_GOLF_MINI_FORM= $GLOBAL_meetingProfile[0]->golfForm;
$G_tourForm= $GLOBAL_meetingProfile[0]->tourForm;

//--------------------------------------------------------------------
//--------------------------//Yoo 2011 Mar 10
if ($G_tourForm) {
	$G_ENABLE_TOUR_MINI_FORM=1;		
	$G_ENABLE_TOUR_MINI_FORM_radio=0;
}else {
	$G_ENABLE_TOUR_MINI_FORM=1;		
	$G_ENABLE_TOUR_MINI_FORM_radio=1;
}
//---------------Yoo------2011 Jan 06--------------------
$G_CUTOFF_GB_DATE			= $GLOBAL_meetingProfile[0]->cutOffGBDate;
$G_CONFERENCE_LOGO_FILE		= $GLOBAL_meetingProfile[0]->conferenceLogoFile;
//------------------------------------------------------

//--------------Yoo: 2010 Aug 18--------------Sanction country----------
$G_ENABLE_SANCTION_COUNTRIES		= $GLOBAL_meetingProfile[0]->enableSanctionCoun;
$G_ENABLE_FORCE_SANCTION_TO_CIFA	= $GLOBAL_meetingProfile[0]->enableForceSanctionToCifa;

$G_ENABLE_REQUIRE_APPROVAL			= $GLOBAL_meetingProfile[0]->enableRequireApproval;
$G_ENABLE_BLOCK_SANCTION_FROM_REGIST= $GLOBAL_meetingProfile[0]->enableBlockSanctionFromRegist;

$G_SANCTION_COUN_NAME = NULL;
$G_ENABLE_RMB_FOR_CIFA	= $GLOBAL_meetingProfile[0]->enableRMBForCifa;

//---------------Yoo------2011 Jan 06--------------------
$G_CUTOFF_GB_DATE			= $GLOBAL_meetingProfile[0]->cutOffGBDate;
$G_CONFERENCE_LOGO_FILE		= $GLOBAL_meetingProfile[0]->conferenceLogoFile;

//---------------Yoo: 2011 Jun 16------------------------
$G_ENABLE_EDIT_REP_CITY_COUN_MEMBER		= $GLOBAL_meetingProfile[0]->enableEditRepCityCounMember;
$G_ENABLE_EDIT_REP_CITY_COUN_NONMEMBER	= $GLOBAL_meetingProfile[0]->enableEditRepCityCounNonMember;
$G_NOT_APPLICABLE_TEXT = "N/A";
$G_NOT_APPLICABLE = "<center><i>$G_NOT_APPLICABLE_TEXT</i></center>";
$G_ENABLE_SHOW_RMB_FOR_CART = 0;
//------------------------------------------------------

//---------------Yoo: 2011 Sep 2------------------------
$G_ENABLE_LOGNET_AS_WCAF				= $GLOBAL_meetingProfile[0]->enableLognetAsWCAF;
$G_ENABLE_ONLY_ONEONONE_AVAILABLE		= $GLOBAL_meetingProfile[0]->enableOnlyOneononeAvailable;

$nonMemberObj = get_obj_info("select compid, memberType from allow_nonmember_1on1 where  memberType  <> 'Lognet Member' ",array("compid", "memberType"));
for ($i=0;$i<count($nonMemberObj);$i++) {
	$G_ALLOW_NON_MEMBER_1ON1_COMPID[$i] = $nonMemberObj[$i]->compid;
	
	$G_ALLOW_NON_MEMBER_1ON1[$i]->compid = $nonMemberObj[$i]->compid;
	$G_ALLOW_NON_MEMBER_1ON1[$i]->memberType = $nonMemberObj[$i]->memberType;
}
//-----------------------------------------------------

//--------------Puth: 2011 Mar 25 -------------//

$G_CONFERENCE_PLACE	= $GLOBAL_meetingProfile[0]->conferencePlace;
$G_CONFERENCE_DATE	= $GLOBAL_meetingProfile[0]->conferenceDate;
//------------------------------------------------//

//--------------Puth: 2011 May 13-----------------
$CIFA_MAIL = $GLOBAL_meetingProfile[0]->mail_cifa;
//--------------Puth: 2011 May 13-----------------

//--------------Yoo: 2011 Aug 18------------------
$G_SHOW_INVITATION_LETTER = $GLOBAL_meetingProfile[0]->showConferenceLetter;
//------------------------------------------------


if($G_ENABLE_SANCTION_COUNTRIES){
	$sanction_coun_array=get_obj_info("select countryCode, countryName from countries where countryCode in (select countryCode from sanction_countries)",array("countryCode", "countryName"));
	
	for ($i=0;$i<count($sanction_coun_array);$i++) {
		$G_SANCTION_COUN_NAME[$i] = $sanction_coun_array[$i]->countryName;
	}
}

//--------------Yoo: 2011 Jan 11---Edit Profile Msg------------------
$G_STR_NON_EDITABLE	= "The profile has been updated. Now, it is non-editable. Would you like to release the profile?";
$G_STR_NON_EDITABLE_ALERT	= "The profile has been updated. Now, it is non-editable.\\n\\nWould you like to release the profile?";
if($MEETING_ID=="LOGNET"){
	$G_STR_WAIT_APP = "The updated profile has been sent to Lognet, please wait for approval.";	
	$G_PROFILE_APPROVAL = "nuttapong@lognetglobal.com";
}else{
	$G_STR_WAIT_APP = "The updated profile has been sent to WCA Family, please wait for approval.";	
	$G_PROFILE_APPROVAL = "jacky@wcaworld.com";
}

//----------------------Yoo: 2011 Jan 26----Register wait list-------------------------
//$G_ENABLE_NEW_REGISTER		= $GLOBAL_meetingProfile[0]->enableNewRegister;
$G_MSG_REGISTER_WAIT_LIST	= "We apologize, but are unable to accept anymore registrations because we have already filled up the capacity of the conference venue and hotels.\\n\\nDo you wish to be placed on a wait list?";
$G_WAIT_LIST_NOTIFICATION_EMAIL = "num@wcaworld.com, yoo@wcaworld.com";

//----------------------------------------------------------------------
$CC_SALES_REP_CHINA		= "dwang@wcaworld.com";			//10
$CC_SALES_REP_CUS_SER	= "arobins@wcaworld.com";			//18
$CC_SALES_REP_INDIA		= ""; //"a.v.patil@wcaworld.com";	
$CC_SALES_REP_EUROPE	= "monica@wcaworld.com";			//17
$CC_SALES_REP_LATIN		= "mmairowitz@wcaworld.com";		//14
$CC_SALES_REP_SPECIALTY	= "brian@wcaworld.com";			//16
$CC_SALES_REP_ASIA		= "kyokeum@wcaworld.com";			//15
$CC_SALES_REP_AFRICA	= "giyer@wcaworld.com";			//33
$CC_SALES_REP_ME		= "thanna@wcaworld.com";			//43

$CC_SALES_REP = "$CC_SALES_REP_CHINA, $CC_SALES_REP_CUS_SER, $CC_SALES_REP_EUROPE, $CC_SALES_REP_LATIN, $CC_SALES_REP_SPECIALTY, $CC_SALES_REP_ASIA, $CC_SALES_REP_AFRICA, $CC_SALES_REP_ME"; //$CC_SALES_REP_INDIA,

$NONMEMBER_MONITOR_REP="jacky@wcaworld.com";
//--------------------------//Yoo 2011 Mar 10
$US_ACCOUNT_NOTIFY_EMAIL = "bbarnhart@wcaworld.com";//Yoo 2011 Jan 05

//-----------Yoo: 2011 Aug 30---------------
$G_CONFERENCE_YEAR = substr ($G_MEETING_NAME_SHORT, -4) ;//str_replace($NETWORK,"",$G_MEETING_NAME_SHORT); 
//substr ($G_MEETING_NAME_SHORT, -4);


//----------------------------------------- AGENDA & MEETING INITIAL --------------------------------------------------------------------
class event_structure{
	var $event;
	var $bgColor;
	var $fontColor;
	function event_structure($event,$bgColor="",$fontColor=""){
		$this->event = $event;
		$this->bgColor = $bgColor;
		$this->fontColor = $fontColor;
	}
}

$EVENT_ARRAY[] = new event_structure("1on1","#EEFFEE","#000000");
$EVENT_ARRAY[] = new event_structure("Lunch","#F0F0FF","#559955");
$EVENT_ARRAY[] = new event_structure("Break","#F0F0FF","#909090");
$EVENT_ARRAY[] = new event_structure("No Event","#FFFFFF","#FF0000");
$EVENT_ARRAY[] = new event_structure("Block","#FFFFFF","#FF0000");//Yoo--2010 Nov 5---

//-----------------------------------------------------------------------------------------------------------------------------------------
class meeting_structure extends  event_structure{
	var $time_;
	var $tableNumber;
	function meeting_structure($time_,$tableNumber,$event,$bgColor="",$fontColor=""){
		$this->event_structure($event,$bgColor,$fontColor);
		$this->time_ = $time_;
		$this->tableNumber = $tableNumber;
	}
}

//-------------------------------------------------------------this function for adminAgenda.php file----------------------------------------------
function defineMeetingTime(){

	$SQL="select * from agenda where event<>'' order by meetingTime";
	$agendaArray=get_obj_info($SQL , array("meetingTime","event"));
	for($i=0;$i<count($agendaArray);$i++){
		$meetingTime = $agendaArray[$i]->meetingTime;
		$meetingTime_array[$i] = strftime("%H:%M", mkdate($meetingTime));
	}
	
	return $meetingTime_array;
}
//------------------------------------------------------------------------------------------------------------------------------------------

$AGENDA_ARRAY=array("meetingTime","event","comment");
//------------------------------------------------------------------------------------------------------------------------------------------

function defineMeetingTimeOld($MEETING_START_TIME,$MEETING_TIME_INTERVAL,$MEETING_TOTAL_TIME){
 if($MEETING_START_TIME=="")die("No define START_TIME value. Please contract administrator.");
                if($MEETING_TIME_INTERVAL=="")die("No define MEETING_TIME_INTERVAL value. Please contract administrator.");
                if($MEETING_TOTAL_TIME=="")die("No define TOTAL_TIME value. Please contract administrator.");
                $dateTime_index = "2005-01-01 ".$MEETING_START_TIME;
                $dateTime_number = dateAdd("n",-$MEETING_TIME_INTERVAL,mkdate($dateTime_index));
                //print "dateTime_number = ".$dateTime_number."<br>";
                $dateTime_index = strftime("%Y-%m-%d %H:%M",$dateTime_number);
                //print "dateTime_index = ".$dateTime_index."<br>";
                for($T=0;$T<$MEETING_TOTAL_TIME;$T++){
                                $dateTime_number = dateAdd("n",$MEETING_TIME_INTERVAL,mkdate($dateTime_index));
                                $dateTime_index = strftime("%Y-%m-%d %H:%M",$dateTime_number);
                                $meetingTime_array[$T] = strftime("%H:%M",$dateTime_number);
                                //print $meetingTime_array[$T];
                }             
                return $meetingTime_array;
}

//------------------------------------------------------------------------------------------------------------------------------------------
$ADMIN_MAIL="conference@wcaworld.com";

$MAX_TABLE_NUMBER=250;
$MAX_ROW_SEPARATE=20;

$UPLOAD_PATH = "../upload";
//------------------------------------------------------------------------------------------------------------------------------------------

$serviceArray = array("Air","Ocean","Truck","Warehouse","Customs Brokerage");
$FIELD_SERVICE = array("serviceID","type","name");

//------------------------------------------------------------------------------------------------------------------------------------------
$FIELD_COMPANY = array("name","commonCompany","freeze","contactEmail","profile","address","phone","fax","website", "contactName", "branchCity", "branchCountry", "approval", "approvalNote", "marketTarget");
if($MEETING_ID=="SINO") {
	$FIELD_COMPANY=array_merge($FIELD_COMPANY, array("cifaID","cnCompanyName","cnContactPerson","cnAddress", "cnPostCode")); 
	}
$ELEMENT_FIELD_COMPANY["name"] = new field_structure("Company Name",255,50);
$ELEMENT_FIELD_COMPANY["profile"] = new field_structure("Profile",0,0,"textarea");
$ELEMENT_FIELD_COMPANY["serviceProvided"] = new field_structure("Services Provided",255,50,"text");
$ELEMENT_FIELD_COMPANY["freeze"] = new field_structure("Freeze",0,0,"checkbox");
$ELEMENT_FIELD_COMPANY["contactEmail"] = new field_structure("Contact Email",0,0,"text");
$ELEMENT_FIELD_COMPANY["contactName"] = new field_structure("Contact Name",0,0,"text");
$ELEMENT_FIELD_COMPANY["address"] = new field_structure("address",0,0,"textarea");
$ELEMENT_FIELD_COMPANY["phone"] = new field_structure("Phone",100,50,"text");
$ELEMENT_FIELD_COMPANY["fax"] = new field_structure("Fax",100,50,"text");
$ELEMENT_FIELD_COMPANY["website"] = new field_structure("Website",255,50,"text");
$ELEMENT_FIELD_COMPANY["marketTarget"] = new field_structure("Cities Interested",255,50,"textarea");
if($MEETING_ID=="SINO") {
		$ELEMENT_FIELD_COMPANY["cifaID"] = new field_structure("CIFA ID",10,10,"text");
		$ELEMENT_FIELD_COMPANY["cnCompanyName"] = new field_structure("Chinese Company Name",100,50,"text");
		$ELEMENT_FIELD_COMPANY["cnContactPerson"] = new field_structure("Chinese Contact Person",100,50,"text");
		$ELEMENT_FIELD_COMPANY["cnAddress"] = new field_structure("Chinese Address",255,50,"text");
		$ELEMENT_FIELD_COMPANY["cnPostCode"] = new field_structure("Chinese Post Code",10,10,"text");
}
$ELEMENT_FIELD_COMPANY["approval"] = new field_structure("Approval",10,10);
$ELEMENT_FIELD_COMPANY["approvalNote"] = new field_structure("Remark ",6,50,"textarea");

//------------------------------------------------------------------------------------------------------------------------------------------

$FIELD_COUNTRY = array("countryCode","countryName");

//------------------------------------------------------------------------------------------------------------------------------------------

$FIELD_REGISTER_INFO=array_merge(
	array("invoiceBy","compid","repCity","repCountry","title_name","name","middle_name","last_name","position","emailadd","invitationLetter","arrival","arrival_flight","arrival_limousine","arrival_destination","departure","departure_flight","departure_limousine","departure_destination","note", "indianFood", "lognetDinner")
	,array("translator", "paid","paymentComment","status")
);

if($MEETING_ID== "WCAFS" || $MEETING_ID== "WCAS"){
	//$FIELD_REGISTER_INFO = array_merge($FIELD_REGISTER_INFO,array("join_wca","join_apln","join_igln")); <--- this is for WCAF meeting_id
	$FIELD_REGISTER_INFO = array_merge($FIELD_REGISTER_INFO,array("join_wca", "join_wcaf", "join_dgla", "join_pla", "join_relo"));
}

//,"dinner"
//,"force_companyName","country","city"
$FIELD_REGISTER_MEM = array_merge(array("memid"),$FIELD_REGISTER_INFO);

$ELEMENT_FIELD_REGISTER_MEM["invoiceBy"] = new field_structure("Issue Invoice By",0,0);

$ELEMENT_FIELD_REGISTER_MEM["memid"] = new field_structure("Attendee ID",0,0);
$ELEMENT_FIELD_REGISTER_MEM["country"] = new field_structure("Country",0,0);
$ELEMENT_FIELD_REGISTER_MEM["city"] = new field_structure("City",0,0);

$ELEMENT_FIELD_REGISTER_MEM["force_country"] = new field_structure("Force Country",0,0);
$ELEMENT_FIELD_REGISTER_MEM["force_city"] = new field_structure("Force City",0,0);
$ELEMENT_FIELD_REGISTER_MEM["force_companyName"] = new field_structure("Force Company Name",0,0);

$ELEMENT_FIELD_REGISTER_MEM["title_name"] = new field_structure("Title Name",0,0);
$ELEMENT_FIELD_REGISTER_MEM["name"] = new field_structure("First Name",0,0);
$ELEMENT_FIELD_REGISTER_MEM["middle_name"] = new field_structure("Middle Name",0,0);
$ELEMENT_FIELD_REGISTER_MEM["last_name"] = new field_structure("Last Name",0,0);

$ELEMENT_FIELD_REGISTER_MEM["paid"] = new field_structure("Paid",0,0);
$ELEMENT_FIELD_REGISTER_MEM["paidTime"] = new field_structure("Paid Time",0,0);
$ELEMENT_FIELD_REGISTER_MEM["paymentComment"] = new field_structure("Payment Comment",0,0);

$ELEMENT_FIELD_REGISTER_MEM["position"] = new field_structure("Position / Title",0,0);
$ELEMENT_FIELD_REGISTER_MEM["emailadd"] = new field_structure("E-mail Address",0,0);
$ELEMENT_FIELD_REGISTER_MEM["note"] = new field_structure("Note",0,0);

$ELEMENT_FIELD_REGISTER_MEM["dinner"] = new field_structure("Dinner",0,0);
$ELEMENT_FIELD_REGISTER_MEM["internet_kit"] = new field_structure("Internet Kit",0,0);
$ELEMENT_FIELD_REGISTER_MEM["advertisement"] = new field_structure("Advertisement",0,0);

$ELEMENT_FIELD_REGISTER_MEM["invitationLetter"] = new field_structure("Required Invitation Letter",0,0);

$ELEMENT_FIELD_REGISTER_MEM["arrival"] = new field_structure("Arrival Time",0,0);
$ELEMENT_FIELD_REGISTER_MEM["arrival_flight"] = new field_structure("Arrival Flight",0,0);
$ELEMENT_FIELD_REGISTER_MEM["arrival_limousine"] = new field_structure("Arrival Limousine",0,0);
$ELEMENT_FIELD_REGISTER_MEM["arrival_destination"] = new field_structure("Arrival Destination",0,0);
$ELEMENT_FIELD_REGISTER_MEM["departure"] = new field_structure("Departure Time",0,0);
$ELEMENT_FIELD_REGISTER_MEM["departure_flight"] = new field_structure("Departure Flight",0,0);
$ELEMENT_FIELD_REGISTER_MEM["departure_limousine"] = new field_structure("Departure Limousine",0,0);
$ELEMENT_FIELD_REGISTER_MEM["departure_destination"] = new field_structure("Pick up Place",0,0);


$ELEMENT_FIELD_REGISTER_MEM["compid"] = new field_structure("Company ID",0,0);
$ELEMENT_FIELD_REGISTER_MEM["compname"] = new field_structure("Company Name.",0,0);
$ELEMENT_FIELD_REGISTER_MEM["register_time"] = new field_structure("Register Time",0,0);
$ELEMENT_FIELD_REGISTER_MEM["status"] = new field_structure("Status",0,0);

$ELEMENT_FIELD_REGISTER_MEM["repCity"] = new field_structure("Representative City",30,0);
$ELEMENT_FIELD_REGISTER_MEM["repCountry"] = new field_structure("Representative Country",30,0);

$ELEMENT_FIELD_REGISTER_MEM["indianFood"] = new field_structure("Indian Vegetarian Meal",30,0);
$ELEMENT_FIELD_REGISTER_MEM["lognetDinner"] = new field_structure("Lognet Dinner",30,0);

//-------------------------------------------------------------------------------------------------------------------------

$FIELD_GOLF = array("golf_handicap", "golf_score", "golf_rentClub", "golf_rentClub_handed", "golf_rentShoes", "golf_rentShoes_size", "golf_additional", "golfSponsorship", "spouse");

//-------------------------------------------------------------------------------------------------------------------------

$FIELD_TOUR = array("tour","tour_detail","spouse");

//-------------------------------------------------------------------------------------------------------------------------

$FIELD_SPOUSE = array("attendeeID", "title_name","name","middle_name","last_name","passportNum");
$ELEMENT_FIELD_SPOUSE["title_name"] = new field_structure("Title Name",0,0);
$ELEMENT_FIELD_SPOUSE["name"] = new field_structure("First Name",0,0);
$ELEMENT_FIELD_SPOUSE["middle_name"] = new field_structure("Middle Name",0,0);
$ELEMENT_FIELD_SPOUSE["last_name"] = new field_structure("Last Name",0,0);
$ELEMENT_FIELD_SPOUSE["passportNum"] = new field_structure("Passport Number",0,0);


//-------------------------------------------------------------------------------------------------------------------------

//$FIELD_VISA = array("attendeeID", "companyName","passportName","title_name","nationality","occupation","position","visaCountry","passportNumber","expiryDate","arrivalDate","departureDate","address","contactPhone", "emailadd");
$FIELD_VISA = array("attendeeID", "requiredType", "companyName","passportName", "position", "passportCountry", "passportNumber","expiryDate","arrivalDate","departureDate","address","contactPhone", "emailadd");

$ELEMENT_FIELD_VISA["attendeeID"] = new field_structure("Attendee ID",50,0,"text");
$ELEMENT_FIELD_VISA["requiredType"] = new field_structure("Required Type",100,0,"text");
$ELEMENT_FIELD_VISA["companyName"] = new field_structure("Company Name",255,0,"text");
$ELEMENT_FIELD_VISA["passportName"] = new field_structure("Full Name (as appear in passport)",50,0,"text");
//$ELEMENT_FIELD_VISA["title_name"] = new field_structure("Title",50,0,"text");
//$ELEMENT_FIELD_VISA["nationality"] = new field_structure("Nationality",50,0,"text");
//$ELEMENT_FIELD_VISA["occupation"] = new field_structure("Occupation",50,0,"text");
$ELEMENT_FIELD_VISA["position"] = new field_structure("Job Title",50,0,"text");
$ELEMENT_FIELD_VISA["passportCountry"] = new field_structure("Passport Country",50,0,"text");
$ELEMENT_FIELD_VISA["passportNumber"] = new field_structure("Passport Number",50,0,"text");
$ELEMENT_FIELD_VISA["expiryDate"] = new field_structure("Expiry Date",50,0,"text");
$ELEMENT_FIELD_VISA["arrivalDate"] = new field_structure("Arrival Date",50,0,"text");
$ELEMENT_FIELD_VISA["departureDate"] = new field_structure("Departure Date",50,0,"text");
$ELEMENT_FIELD_VISA["address"] = new field_structure("Contact Address",50,0,"text");
$ELEMENT_FIELD_VISA["contactPhone"] = new field_structure("Contact Phone",50,0,"text");

//-------------------------------------------------------------------------------------------------------------------------------------------------------

class OneOnOne_structure{
	var $time_;
	var $joinerID;
	var $waiterID;
	var $table_number;
	var $participantID;
	var $groupID;
	var $comment;
	function OneOnOne_structure($time_,$joinerID,$waiterID,$tableNumber=0,$participantID=NULL, $groupID=NULL, $comment=NULL){
		$this->time_ = $time_;
		$this->joinerID = $joinerID;
		$this->waiterID = $waiterID;
		$this->tableNumber = $tableNumber;
		$this->participantID=$participantID;
		$this->groupID=$groupID;
		$this->comment = $comment;
		}
}
//------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------
// ****** edit *****//
function write_history($userID,$section,$MSG, $login=NULL){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;
	global $HTTP_SERVER_VARS;

	connect_DB();
	$SQL = "Insert into history(timeStamp,userID,section,MSG,IP,updateBy) values(NOW(),$userID,'$section','".protect_quote($MSG)."','".$_SERVER['REMOTE_ADDR']."', '$login')";
	
		//print "<br>history = ".$SQL."<HR>";
	
	if(!($result=mysql_query($SQL))){
			//print "Internal error function write_history()";
			//die;
	}
}
//------------------------------------------------------------------------------------------------------------------------------------------
function errMSG( $str ){
	global $ADMIN_MAIL;
	print("$str <BR>please contact <a href='mailto:".$ADMIN_MAIL."?subject=$str date(" .date("Y-m-d H:i:s").")'>Support</a><BR>");
	die;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function errMSG1( $str ){
	global $ADMIN_MAIL;
	print("$str");
	die;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function warningMSG( $str ){
	print("<div align=center><font color='red'>$str ! </font><b><BR><BR><font color='blue'><A  onMouseOver=\"style.cursor='hand'\" onClick='window.history.back();' > plaese back to correct it</a></font></b></div>");
	die;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function protect_quote($str){
	$ret = addslashes($str);
	$ret = str_replace("'","`", $ret);
	$ret = str_replace("<b>","", $ret);
	$ret = str_replace("</b>","", $ret);
	$ret = str_replace("<u>","", $ret);
	$ret = str_replace("</u>","", $ret);
	$ret = str_replace("<i>","", $ret);
	$ret = str_replace("</i>","", $ret);
	$ret = str_replace("<br>"," ", $ret);
	return $ret;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function protect_URL_link($str){
	$URL_link = " ".$str;
	if(strpos($URL_link,"http://")!=1)$URL_link = "http://".$str;
	return $URL_link;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function deQuote($str){
		  $str = str_replace("<"," ",$str);
		  $str = str_replace(">"," ",$str);
		   return   str_replace( "`"  ,"'", $str );
}
//------------------------------------------------------------------------------------------------------------------------------------------
function get_index($array,$key,$value){
	for($i=0;$i<count($array);$i++){
			if($array[$i]->$key==$value) return $i;
	}
	return -1;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function  str_duplicate( $number , $str ){
	$ret = "";
	while( $number>0){
			--$number;
			$ret .= $str;
	}
	return $ret;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function fill_zero($arg_number , $lenght ){
		return str_duplicate( $lenght - strlen($arg_number),"0") . $arg_number;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function onlyEnglish($str){
	$str_temp="";
	for($i=0;$i<strlen($str);$i++){
		if($str[$i] =="�" || $str[$i]=="`"){ // Skip quote
			$str_temp .= $str[$i];
		}elseif(ord($str[$i])>127){
			if($str_temp != ""){
					if($str_temp[strlen($str_temp) -1] != " "){
							$str_temp .=" ";
					}
			}else{
					$str_temp .=" ";
			}
			
		}else $str_temp .= $str[$i];

	}
	return $str_temp;
}
//------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------
function define_obj_value($S_obj ,$OBJ_FILED){
		for($F=0;$F<count($OBJ_FILED);$F++){
			$D_obj->$OBJ_FILED[$F] = $S_obj->$OBJ_FILED[$F];
		}
		return $D_obj;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function get_obj_info( $SQL,$OBJ_FILED,$row_limit=99999,$row_index=0,$group_ID=0){ // be careful for use group_ID
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;

	if($SQL=="" || $OBJ_FILED=="" ) errMSG("Internal error : function get_obj_info()");
	if(count($OBJ_FILED) <1) errMSG("Internal error : function get_obj_info() has not OBJ_FILED");

	connect_DB();
	//print "<br>$SQL<BR>";
	if(!($result=mysql_query($SQL))){
			print "<font color=silver>Warning, can't get obj info <font size=1>SQL( $SQL )</font></font><BR>";
			//print "<font color=silver>Warning, can't get obj info</font><BR>";
			return NULL;
	}

	if( ($row_number = mysql_num_rows ($result))<1 ){
			//print "No data!";
			return NULL;
	}
	if($row_index>=$row_number)$row_index=$row_number-1;  // <== this has bug at    >=  ,for corect use  only > sign but it has error page_separate() function
	if($row_index<0)$row_index=0;

	$i = -1;
	$R=0;
	if($group_ID){
			if($row_index>1){
					mysql_data_seek($result, $row_index-1);
					$new=NULL;
					do{
							++$i;
							$old_ID=$new_ID;
							$row=mysql_fetch_object($result);
							$new_ID=$row->$OBJ_FILED[0];
					}while(($row && $old_ID==$new_ID)|| !$i);
					$obj[$R++]=define_obj_value($row,$OBJ_FILED);
			}
	}else {
					mysql_data_seek($result, $row_index);
	}
	
	while ($row=mysql_fetch_object($result)){
		++$i;
		if($i >= $row_limit){
				if(!$group_ID || $i>($row_limit+$group_ID) )break;
				if($i>$row_limit){
						if($old_ID != $row->$OBJ_FILED[0]) break;
				}
				$old_ID=$row->$OBJ_FILED[0];
				
		}
		$obj[$R++]=define_obj_value($row,$OBJ_FILED);
	}
	$obj[0]->property_rows_number=$row_number;
	return $obj;
	//return str_replace("<", "&lt;", $obj);
}
//------------------------------------------------------------------------------------------------------------------------------------------
function get_obj_info_event( $SQL,$OBJ_FILED,$row_limit=99999,$row_index=0,$group_ID=0){ // be careful for use group_ID
	global $DBhost_event;
	global $DBuser_event;
	global $DBpasswd_event;
	global $DBname_event;
	global $mysql_event;

	if($SQL=="" || $OBJ_FILED=="" ) errMSG("Internal error : function get_obj_info()");
	if(count($OBJ_FILED) <1) errMSG("Internal error : function get_obj_info() has not OBJ_FILED");

	connect_DB_Event();
	//print "<br>$SQL<BR>";
	if(!($result=mysql_query($SQL))){
			print "<font color=silver>Warning, can't get obj info <font size=1>SQL( $SQL )</font></font><BR>";
			//print "<font color=silver>Warning, can't get obj info</font><BR>";
			return NULL;
	}

	if( ($row_number = mysql_num_rows ($result))<1 ){
			//print "No data!";
			return NULL;
	}
	if($row_index>=$row_number)$row_index=$row_number-1;  // <== this has bug at    >=  ,for corect use  only > sign but it has error page_separate() function
	if($row_index<0)$row_index=0;

	$i = -1;
	$R=0;
	if($group_ID){
			if($row_index>1){
					mysql_data_seek($result, $row_index-1);
					$new=NULL;
					do{
							++$i;
							$old_ID=$new_ID;
							$row=mysql_fetch_object($result);
							$new_ID=$row->$OBJ_FILED[0];
					}while(($row && $old_ID==$new_ID)|| !$i);
					$obj[$R++]=define_obj_value($row,$OBJ_FILED);
			}
	}else {
					mysql_data_seek($result, $row_index);
	}
	
	while ($row=mysql_fetch_object($result)){
		++$i;
		if($i >= $row_limit){
				if(!$group_ID || $i>($row_limit+$group_ID) )break;
				if($i>$row_limit){
						if($old_ID != $row->$OBJ_FILED[0]) break;
				}
				$old_ID=$row->$OBJ_FILED[0];
				
		}
		$obj[$R++]=define_obj_value($row,$OBJ_FILED);
	}
	$obj[0]->property_rows_number=$row_number;
	return $obj;
	//return str_replace("<", "&lt;", $obj);
}
//------------------------------------------------------------------------------------------------------------------------------------------

function get_obj_infoDB($nameDB, $SQL,$OBJ_FILED,$row_limit=99999,$row_index=0,$group_ID=0){ // be careful for use group_ID
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	//global $DBname;
	global $mysql;

	if($SQL=="" || $OBJ_FILED=="" ) errMSG("Internal error : function get_obj_infoDB()");
	if(count($OBJ_FILED) <1) errMSG("Internal error : function get_obj_infoDB() has not OBJ_FILED");

	newConnect_DB($nameDB);
	//print "<br><br>$SQL<BR>";
	if(!($result=mysql_query($SQL))){
			print "<font color=silver>Warning, can't get obj infoDB <font size=1>SQL( $SQL )</font></font><BR>";
			return NULL;
	}

	if( ($row_number = mysql_num_rows ($result))<1 ){
			//print "No data!";
			return NULL;
	}
	if($row_index>=$row_number)$row_index=$row_number-1;  // <== this has bug at    >=  ,for corect use  only > sign but it has error page_separate() function
	if($row_index<0)$row_index=0;

	$i = -1;
	$R=0;
	if($group_ID){
			if($row_index>1){
					mysql_data_seek($result, $row_index-1);
					$new=NULL;
					do{
							++$i;
							$old_ID=$new_ID;
							$row=mysql_fetch_object($result);
							$new_ID=$row->$OBJ_FILED[0];
					}while(($row && $old_ID==$new_ID)|| !$i);
					$obj[$R++]=define_obj_value($row,$OBJ_FILED);
			}
	}else {
					mysql_data_seek($result, $row_index);
	}
	
	while ($row=mysql_fetch_object($result)){
		++$i;
		if($i >= $row_limit){
				if(!$group_ID || $i>($row_limit+$group_ID) )break;
				if($i>$row_limit){
						if($old_ID != $row->$OBJ_FILED[0]) break;
				}
				$old_ID=$row->$OBJ_FILED[0];
				
		}
		$obj[$R++]=define_obj_value($row,$OBJ_FILED);
	}
	$obj[0]->property_rows_number=$row_number;
	return $obj;
}
//------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
function get_member_info($id, $whereExt=""){//Yoo: 2011 AUg 29: Add $whereExt
$SQL="
select 
company.compid as companyID
,company.masterCompanyID as masterCompanyID
,if(company.commonCompany is not null && length(company.commonCompany) >0,company.commonCompany,company.name) as company
,memmeet.memid as memid 
,concat(memmeet.title_name,' ',memmeet.name,' ',memmeet.middle_name,' ',memmeet.last_name) as name 
,memmeet.emailadd as email
,memmeet.position as position
,memmeet.repCountry as repCountry
,memmeet.repCity as repCity
from memmeet,company
where memmeet.compid = company.compid
and memmeet.memid=$id
$whereExt
order by company.name,memmeet.name
";//Yoo: 2011 Aug 29: Add "and (memmeet.status ='' or memmet.status is null)"

if(NULL==($obj=get_obj_info($SQL,array("company","memid","name","city","country","email","companyID", "masterCompanyID", "position","repCountry","repCity","memid")) ) ){
	//---------Yoo: 2011 Aug 29-----------
	//print "Error get member info please contact administrator";	
	return null;
	//-----------------------------------
	die;
}
	$member->companyID=$obj[0]->companyID;
	$member->masterCompanyID=$obj[0]->masterCompanyID;
	$member->company=$obj[0]->company;
	$member->name=$obj[0]->name;
	$member->email=$obj[0]->email;
	$member->position=$obj[0]->position;
	$member->repCountry=$obj[0]->repCountry;
	$member->repCity=$obj[0]->repCity;
	$member->memid=$obj[0]->memid;
	
	return $member;
}
//===================================  DATA STRUCTURE =============================================================
class field_structure{
	var $display;
	var $type;
	var $maxlength;
	var $size;
	function field_structure($display="",$maxlength=50,$size=50,$type="text"){
		$this->display = $display;
		$this->type = $type;
		$this->maxlength = $maxlength;
		$this->size = $size;
	}
}

//-------------------------------------------- SET BOOTH INFO ------------------------------------------------------------------
function booth_info($tableNumber){
           	global $NETWORK;

                //--Yoo: 2011 Jun 26: use display instead for both booth & table---------
				if($tableNumber<0){
						$SQL_Booth="select display from fixTableNumber where tablenumber = '".$tableNumber."' and network='".$NETWORK."' ";
						$boothObj=get_obj_info($SQL_Booth,array("display"));

								if($boothObj==NULL){
										$boothName = ""; 
								}else{
										$boothName = $boothObj[0]->display;
								}
								return $boothName;
								
                //--Yoo: 2011 Jun 26
				}else{
                                return $tableNumber;
                }
}

//--------------------------For WCA,WCAF only ----------------------------------------------------------------------------------------------------
/*function booth_info($tableNumber){
                //--Yoo: 2011 Jun 26: use display instead for both booth & table---------
				if($tableNumber<0){
                                //return "Booth[". -$tableNumber . "]";
								$boothObj=get_obj_info("select concat(display,'\nZ: ',floor,':',zone) as show_display from fixTableNumber_floor_zone  where tablenumber= '".$tableNumber."'",array("show_display"));
								if($boothObj==NULL){
										//$boothName = "Error!"; //--Yoo: 2011 Jun 26
										$boothName = "";
								}else{
										$boothName = $boothObj[0]->show_display;
								}
								return $boothName;
								
                //--Yoo: 2011 Jun 26
				}else{
                               // return $tableNumber;

							   $boothObj=get_obj_info("select concat(display,'\nZ: ',floor,':',zone) as show_display from fixTableNumber_floor_zone  where tablenumber= '".$tableNumber."'",array("show_display"));
								if($boothObj==NULL){
										//$boothName = "Error!"; //--Yoo: 2011 Jun 26
										$boothName = "";
								}else{
										$boothName = $boothObj[0]->show_display;
								}
								return $boothName;
                }
}*/
//------------------------------------------------------------------------------------------------------------------------------

//----------------------------------one on one available time -------------------------------------------//

function updateAvailableTime($command, $memid) {
/*---
	switch ($command){
 		case "update": 
			$SQL="delete from oneononeFree where attendeeID=$memid";
			//print $SQL."<hr>";
			mysql_query($SQL);
			
			$SQL="select meetingTime from agenda where event='1on1' and meetingTime not in
  				      (select meeting_time from oneonone where joinerID=$memid or waiterID=$memid)";
			//print $SQL."<hr>";
			if($result=mysql_query($SQL)){
					$i=0;
					while ($row=mysql_fetch_object($result)){
						$meetingTime = $row->meetingTime;
						$SQL="insert into oneononeFree (meeting_time, attendeeID) VALUE ('$meetingTime', '$memid')";
						//print $SQL."<br>";
						if(!mysql_query($SQL)) {
							die("Error when update available time");
						}
					++$i;
					} //end while
			}// end if
			break;

		case "add":
			$SQL="select meetingTime from agenda where event='1on1' order by meetingTime";
			if($result=mysql_query($SQL)){
					$i=0;
					while ($row=mysql_fetch_object($result)){
						$meetingTime = $row->meetingTime;
						$SQL="insert into oneononeFree (meeting_time, attendeeID) VALUE ('$meetingTime', '$memid')";
						//print $SQL."<br>";
						if(!mysql_query($SQL)) {
							die("Error when add available time");
						}		
					++$i;
					} //end while
				}// end if
			break;

		case "delete":
			$SQL="delete from oneononeFree where attendeeID=$memid";
			//print $SQL."<hr>";
			mysql_query($SQL);
			break;
	}// end switch
---*/
}// end function
//----------------------------------one on one available time -------------------------------------------//

//===================================================================================//
//-------------------------------------------------
function GetNumAnnouncement($NETWORK,$companyID,$attendeeID){

global $NETWORK;

$SQL_Ann = "select *   from announcement where network= '".$NETWORK."'";


$objAnn=get_obj_info($SQL_Ann, array("Announcementid"));
$TotalAnn = count($objAnn);


$SQL_AnnRead = "select *   from announcement_log where  compid =".$companyID.""; 


if ($attendeeID!=""){
	$SQL_AnnRead  = $SQL_AnnRead  ." and attendeeID =".$attendeeID." ";

}

$objAnnRead=get_obj_info($SQL_AnnRead, array("Announcementid"));
$TotalRead = count($objAnnRead);

if ($TotalRead < $TotalAnn){
		$NumNotRead =  $TotalAnn - $TotalRead;
}else{
		$NumNotRead =0;

}
return $NumNotRead;

}//end func
//----------------------------------------------
function GetReadStatus($NETWORK,$AnnouncementID,$companyID,$attendeeID){

global $NETWORK;

$SQL_AnnTotal = "select Announcementid   from announcement_log where  compid =".$companyID." and AnnouncementID = ". $AnnouncementID.""; 

if ($attendeeID!=""){
	$SQL_AnnTotal  = $SQL_AnnTotal  ." and attendeeID =".$attendeeID." ";

}

$objAnnRead=get_obj_info($SQL_AnnTotal, array("Announcementid"));

$TotalRead = count($objAnnRead);

if ($TotalRead == 0 ){
		$ReadStatus ="FALSE";
}else{
		$ReadStatus ="TRUE";
}

return $ReadStatus;

}//end func
//--------------------------------------------------
function GetReadANN_Noti($NETWORK,$AnnouncementID,$companyID,$attendeeID){

global $id;

$SQL_AnnTotal  =" select device_memid   from  conferencedb.history_noti  where section ='ann' and conferenceid =".$id."  and  Announcementid = ". $AnnouncementID." and (IsRead ='Y') ";

if ($attendeeID!=""){
	$SQL_AnnTotal  = $SQL_AnnTotal  ." and device_memid =".$attendeeID." ";
}

$objAnnRead=get_obj_info($SQL_AnnTotal, array("device_memid"));

if ($objAnnRead == NULL ){
		$ReadStatus ="FALSE";
}else{
		$ReadStatus ="TRUE";
}

return $ReadStatus;

}//end func

//--------Update 24/02/2015------------------------------
function CheckBlackList($memid){
							$SQL="select memid,show_msg from oneonone_block  where expired_date is null and memid =".$memid."";
							$result= get_obj_info($SQL, array("memid","show_msg"));
							if (count($result)>0) {
									$show_msg=$result[0]->show_msg;
							}else{
									$show_msg ="";
							}
							return $show_msg;
}
//-----------------------------------------
function CheckAllowOneOnOne($compid){
							$SQL="select compid from allow_nonmember_1on1  where compid =".$compid."";
							$result= get_obj_info($SQL, array("compid"));
							if (count($result)>0) {$FlagAllow ="true";
							}else{$FlagAllow ="false";}
							return $FlagAllow;
}
//--------Function for Notifications--------------------------

function GetNumOneOnOne($NETWORK,$attendeeID,$daymeeting_time){

global $NETWORK;

if ($attendeeID <> ""){
	$SQLTotal = "select  meeting_time,joinerid,waiterid from  oneonone  where (joinerid =".$attendeeID." or waiterid =".$attendeeID.") and (joinerid <> waiterid) and day(meeting_time) in (".$daymeeting_time.")";

	$objOneOnOne=get_obj_info($SQLTotal, array("meeting_time"));
	$TotalOneOnOne = count($objOneOnOne);

}else{
	$TotalOneOnOne ="0";

}
return $TotalOneOnOne;

}//end func

//--------------------
function GetDayOfOneOnOne($NETWORK){

global $NETWORK;

$SQL="select distinct(day(meetingtime))  as daymeetingtime from agenda  where event  ='1on1' and network ='$NETWORK'
order by meetingtime asc ";

$obj=get_obj_info($SQL, array("daymeetingtime"));

	for ($i=0; $i<count($obj);$i++)	{
		if ($i==0){
			$send_meetingtime ="'".$obj[$i]->daymeetingtime."'";
		}else{
			$send_meetingtime =$send_meetingtime.",'".$obj[$i]->daymeetingtime."'";
		}//end if
			
	}//for

return $send_meetingtime;

}//end func

//-------------------------------------------------------------
function write_history_noti($userID,$section,$MSG, $login=NULL,$device_memid,$network,$meetingTime,$attendeeID,$memberID,$message,$deviceToken,$app_device){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;
	global $HTTP_SERVER_VARS;
	global $id;
	//connect_DB();



	$SQL_noti = "Insert into conferencedb.history_noti(timeStamp,userID,section,MSG,IP,updateBy,device_memid,network,meeting_time,joinerid,waiterid,conferenceID,messageEmail,flagSend,updatedate,deviceToken,app_device) values(NOW(),$userID,'$section','".protect_quote($MSG)."','".$_SERVER['REMOTE_ADDR']."','$login',".$device_memid.",'".$network."','".$meetingTime."','".$attendeeID."','".$memberID."',".$id.",'".protect_quote($message)."','N',now(),'".$deviceToken."','".$app_device."')";
	
		if(!mysql_query($SQL_noti)){
										print "Internal error function write_history_noti()";
										die();
		}
	
}//function
//------------------------------------------------------------
function ChkIsAppRead($attendeeID,$meetingTime){ 

	global $NETWORK;
	global $MEETING_ID;

	//--------------------------------------------------------------------------------------------------------------------------------------//
	if ($MEETING_ID =="WCAS" || $MEETING_ID =="WCAFS"){
		$WhereNetwork = "and (network='$NETWORK' or network='2NET' )";
	}else{
		$WhereNetwork = "and network='$NETWORK' ";
	}//end if
	//---------------------------------------------------------------------------------------------------------------------------------------//

	$SQL="select joinerid,waiterid,IsRead,meeting_time from history_noti where  device_memid =".$attendeeID."  and meeting_time='".$meetingTime."' and (IsRead='' or IsRead is null) ".$WhereNetwork." ";

	$obj=get_obj_info($SQL, array("IsRead"));

	if (count($obj) > 0){$IsAppRead=false; }else{$IsAppRead=true;}
	return $IsAppRead;

}//end func
//-----------------------------------------------
include("lib_app.php");

?>