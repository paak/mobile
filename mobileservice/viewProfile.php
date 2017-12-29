<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
$memberCID = protect_quote($_GET['companyID']); 
$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
if ($memberCID==""){
			$messageArray=array(MSG=>"No companyID");
			echo json_encode($messageArray);
			die;	
}
//------------------------------------
 switch($MEETING_ID) {
	CASE "WCAS":
		$where_extension=" and  (join_wca='Y' or join_wcaf='Y') ";  //CrossNetwork
		break; 
 	CASE "WCAFS":
		$where_extension="and  (join_wca='Y' or join_wcaf='Y' ) "; //CrossNetwork
		break;
	CASE "SPECIALTY":
		$where_extension=" and join_specialty='Y'";
		break;
 	CASE "AMERICAS":
		$where_extension=" and join_americas='Y'"; 
		break;
	CASE "LOGNET":
		$where_extension=" and join_lognet='Y'";
		break;
	CASE "ECOM":
		$where_extension=" and join_ecom='Y'";
		break;
 }
//---------------------------------------------------------------------------------------------------------------------------------------//


$SQL_comp="SELECT  company.compid,company.commonCompany as companyName, branchCity, branchCountry,
CASE WHEN company.logo IS NULL or company.logo = '' THEN ''
ELSE concat('".$path_comp_logo."',company.logo) END
AS 'logo'
,IFNULL(company.profile,'') as profile, company.address, company.phone, company.fax, company.website FROM company WHERE company.compid=".$memberCID.""; 
			
//echo $SQL_comp; die();

$FIELD_Comp_INFO = array("compid","profile", "logo", "address","phone","fax","website"); 

$profileObj=get_obj_info($SQL_comp,$FIELD_Comp_INFO);

for($i=0; $i<count($profileObj); $i++) {

		 $compid=$profileObj[$i]->compid;
		 $profile=$profileObj[$i]->profile;
		 $logo=$profileObj[$i]->logo;
		 $address=$profileObj[$i]->address;
		 $phone=$profileObj[$i]->phone;
		 $fax=$profileObj[$i]->fax;
		 $website=$profileObj[$i]->website;

		 $CompArray[$i]->compid=$compid;
		 if ($profile ==null || $profile =='null' ){$profile="";}
		 $CompArray[$i]->profile=$profile;
		 $CompArray[$i]->logo=$logo;
		 $CompArray[$i]->address=$address;
		 $CompArray[$i]->phone=$phone;
		 $CompArray[$i]->fax=$fax;
		 $CompArray[$i]->website=$website;

}//end for


//---------------------------------------------------------------------------------------------------------------------------------------//
	if ($profileObj == NULL) {
		$messageArray1 = array(MSG=>"No company profile"); 
	}else{
		//$messageArray1 = $profileObj;
		$messageArray1 = $CompArray;
	}
//---------------------------------------------------------------------------------------------------------------------------------------//

//echo json_encode($messageArray1);die();

$SQL_att="SELECT company.compid as compid,company.commonCompany as companyName, branchCity, branchCountry, company.logo"
		.", company.profile, company.address, company.phone, company.fax, company.website " 
		.", memmeet.memid as attendeeID " 
		.", concat(memmeet.title_name,' ',memmeet.name,' ',memmeet.middle_name,' ',memmeet.last_name) as attendeeName" 
		.", CASE WHEN Imgpath IS NULL or Imgpath = ''  or imgprove <> 'Y'
or imgprove IS NULL   THEN ''
ELSE concat('".$path_comp_face."',Imgpath) END
AS 'photo', memmeet.emailadd as email, memmeet.position as position"
			." FROM company, memmeet "
			." WHERE (company.compid=memmeet.compid) "
			." and (memmeet.status='' or memmeet.status is NULL) ".$where_extension
			." and memmeet.compid=".$memberCID; 
			
//echo $SQL_att; die();

$FIELD_Attendee_INFO = array("compid","attendeeID", "attendeeName", "position","photo"); 

$AttendeeObj=get_obj_info($SQL_att,$FIELD_Attendee_INFO);


//---------------------------------------------------------------------------------------------------------------------------------------//
	if ($AttendeeObj == NULL) {
		$messageArray2 = array(MSG=>"No Attendee Registered!"); 
	}else{
		$messageArray2 = $AttendeeObj;
	}
//---------------------------------------------------------------------------------------------------------------------------------------//
echo json_encode(array($messageArray1,$messageArray2));

//---------------------------------------------------------------------------------------------------------------------------------------//

?>