<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
$attendeeID = protect_quote($_GET['attendeeID']); 
$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
//---Config global variable : $name_abbr,$path_comp_logo,$url,$id,$latitude,$longitude in file : include/id.php
 switch($name_abbr) {
			CASE "WCAS":
				$where_extension=" and join_wca='Y'";
			break;
 			CASE "WCAFS":
				$where_extension=" and join_wcaf='Y'";
			break;
			CASE "LOGNET":
				$where_extension=" and join_lognet='Y'";
				break;
			CASE "SPECIALTY":
				$where_extension=" and join_specialty='Y'";
				break;
 			CASE "AMERICAS":
				$where_extension=" and join_americas='Y'";
				break;
			CASE "ECOM":
				$where_extension=" and join_ecom='Y'";
				break;
 }
//-----------------Update : one user per one login----------------//
if ($attendeeID <> ""){

$where_memid=" and memmeet.memid=".$attendeeID."";

$SQL="SELECT company.commonCompany as companyName, memmeet.compid as CompId, memmeet.memid as attendeeID " 
		.", concat(memmeet.title_name,' ',memmeet.name,' ',memmeet.middle_name,' ',memmeet.last_name) as attendeeName" 
		.", memmeet.emailadd as email, memmeet.paid as paid ,memmeet.position as title ,repCity,repCountry,memmeet.ContactNumber as contactNumber,CASE WHEN memmeet.paid = 'Y' THEN 'Active' ELSE 'No' END AS 'Status', '' as ErrMsg ,CASE WHEN Imgpath IS NULL or Imgpath = ''   or imgprove <> 'Y' or imgprove IS NULL  THEN '' 
        ELSE concat('".$path_comp_face."',Imgpath) END
		AS 'photo' "
			." FROM company, memmeet "
			." WHERE (company.compid=memmeet.compid) "
			." and (memmeet.status='' or memmeet.status is NULL) "
			." ". $where_extension."".$where_memid.""; 
			
			//echo $SQL;

$FIELD_ATT_INFO=array("CompId","companyName","attendeeID","attendeeName","email","paid","Status","ErrMsg","title","repCity","repCountry","contactNumber","photo"); 
$attendeeArray=get_obj_info($SQL,$FIELD_ATT_INFO);

//---------------------------------------------------------------------------------------------------------------------------------------//
if ($FIELD_ATT_INFO == NULL) {
		$messageArray1 = array(MSG=>"No Attendee Registered!"); 
	}else{
		$row= count($attendeeArray);
		$i = 0;
		while ($i < $row) {
			
				//----check block one-on-one-----------------------
				$memid=$attendeeArray[$i]->attendeeID;
				$companyID=$attendeeArray[$i]->CompId;
				$SQL_mem = "select memid from oneonone_block where expired_date is null and memid =".$memid." ";
				$FIELD_memid_INFO = array("memid"); 
				$MemIdArray=get_obj_info($SQL_mem,$FIELD_memid_INFO);
				if ($MemIdArray <> NULL) {
					$attendeeArray[$i]->Status = "No";
					$BlackMsg=CheckBlackList($ChkattendeeID);
					$attendeeArray[$i]->ErrMsg = "We apologize for the inconvenience, however our records show that your organization still has not paid for ".$BlackMsg.". Please contact accounting@wcaworld.com.";
				}else{
				//----check  not paid other------------------------
			if ($attendeeArray[$i]->Status !="Active" ){
				$SQL_comp = " select CompId from allow_nonmember_1on1 where compid=".$companyID." ";
				$FIELD_comp_INFO = array("CompId"); 
				$CompArray=get_obj_info($SQL_comp,$FIELD_comp_INFO);
				if (count($CompArray) == 0) {
					$attendeeArray[$i]->Status = "No";
					$attendeeArray[$i]->ErrMsg = "This attendee is still not able to make appointments until conference fees have been paid.  Please contact accounting@wcaworld.com.";
				}else{
					$attendeeArray[$i]->Status = "Active";
					$attendeeArray[$i]->ErrMsg = "";
				}
			} //end if Active
			} //$MemIdArray
			$i++;  
		}//end while
			$messageArray1 = $attendeeArray;
	} //end  FIELD_ATT_INFO

}//ChkattendeeID
//------------------------------------------------------

echo json_encode($messageArray1);

//var_dump($messageArray);

//---------------------------------------------------------------------------------------------------------------------------------------//

?>