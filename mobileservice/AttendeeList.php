<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSchedulerOpen($G_MEETING_1ON1_STATUS);
//---------------------------------------------------------------------------------------------------------------------------------------//
 switch($MEETING_ID) {
		CASE "WCAS":
				$where_extension=" and  (join_wca='Y' or join_wcaf='Y') ";  //CrossNetwork
				break;
 			CASE "WCAFS":
				$where_extension=" and  (join_wca='Y' or join_wcaf='Y') ";  //CrossNetwork
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
//---------------------------------------------------------------------------------------------------------------------------------------//

//Path photo company and Attendeed must change by Meeting

//---Send 2 data : Company  and Attendee -----/
//----1. Company Data ---------------------------------------------------------------/

$SQL_comp="select compid,replace(rtrim(ltrim(company.commonCompany)),'`','') as companyName,BranchCity,BranchCountry,
CASE WHEN company.logo IS NULL or company.logo = '' THEN ''
ELSE concat('".$path_comp_logo."',company.logo) END
AS 'logo' from company where  compid in (select compid from  memmeet where (memmeet.status='' or memmeet.status is NULL)
" .$where_extension.") order by compid asc";

$FIELD_Comp_INFO = array("compid","companyName","BranchCity","BranchCountry","logo"); 

$CompanyArray=get_obj_info($SQL_comp,$FIELD_Comp_INFO);
//---------------------------------------------------------------//

	if ($FIELD_Comp_INFO == NULL) {
		$messageArray1 = array(MSG=>"No Company"); 
	}else{
		$messageArray1 = $CompanyArray;
	}
//----2. Attendee Data ---------------------------------------------------------------/

$SQL_att="SELECT company.compid,memmeet.memid as attendeeID ,memmeet.NoShow,
concat(rtrim(ltrim(memmeet.name)),' ',memmeet.middle_name,' ',memmeet.last_name) as
attendeeName,memmeet.position as title ,repCity,repCountry,memmeet.ContactNumber as contactNumber ,CASE WHEN Imgpath IS NULL or Imgpath = ''  or imgprove <> 'Y'
or imgprove IS NULL   THEN ''
ELSE concat('".$path_comp_face."',Imgpath) END
AS 'photo',memmeet.paid as paid,CASE WHEN memmeet.paid = 'Y' THEN 'Active' ELSE 'No' END AS 'Status', '' as ErrMsg,memmeet.emailadd,memmeet.join_wca,memmeet.join_wcaf FROM company, memmeet  WHERE (company.compid=memmeet.compid)
and (memmeet.status='' or memmeet.status is NULL) ". $where_extension ."  ";


$FIELD_ATT_INFO = array("compid","attendeeID","attendeeName","repCity","repCountry","paid","Status","ErrMsg","photo","contactNumber","title","emailadd","join_wca","join_wcaf","NoShow"); 

$attendeeArray=get_obj_info($SQL_att,$FIELD_ATT_INFO);

//---------------------------------------------------------------------------------------------------------------------------------------//

	if ($FIELD_ATT_INFO == NULL) {
		$messageArray2 = array(MSG=>"No Attendee Registered!"); 
	}else{
		//$messageArray2 = $attendeeArray;
			$row= count($attendeeArray);
			$i = 0;
			while ($i < $row) {
				$chk_companyID= $attendeeArray[$i]->compid;
			//----------Check status -------------//
			if ($attendeeArray[$i]->Status !="Active" ){
				$SQL_comp = " select CompId from allow_nonmember_1on1 where compid=".$chk_companyID." ";
				$FIELD_comp_INFO = array("CompId"); 
				$CompArray=get_obj_info($SQL_comp,$FIELD_comp_INFO);

				if (count($CompArray) == 0) {
					$attendeeArray[$i]->Status = "No";
					$attendeeArray[$i]->ErrMsg = "This attendee is still not able to make appointments at this time.Please check again later.";
				}else{
					$attendeeArray[$i]->Status = "Active";
					$attendeeArray[$i]->ErrMsg = "";
				}//end if
			}//end if Status

				//-------Check Star --Phase :4------------
				//$emailadd=rtrim(ltrim($attendeeArray[$i]->emailadd));
				$noshow=rtrim(ltrim($attendeeArray[$i]->NoShow));
				if ($noshow =='Y'){$attendeeArray[$i]->star="N" ;}else{$attendeeArray[$i]->star="Y"; }
				
				//----old---*/
				//$emailadd=rtrim(ltrim($attendeeArray[$i]->emailadd));
				//$noshow=CheckNoShow($emailadd);
				//if ($noshow =='Y'){$attendeeArray[$i]->star="N" ;}else{$attendeeArray[$i]->star="Y"; }
				//-------Check Network color---Phase :4 ---------------
				if ($attendeeArray[$i]->join_wca ==NULL || $attendeeArray[$i]->join_wca =="" ) {
						$join_wca ='';
					} else {
						$join_wca= $attendeeArray[$i]->join_wca;
				}
				if ($attendeeArray[$i]->join_wcaf ==NULL || $attendeeArray[$i]->join_wcaf =="" ) {
						$join_wcaf ='';
					} else {
						$join_wcaf= $attendeeArray[$i]->join_wca;
				}
				//-----------------------------------------------------------
				if ($MEETING_ID=="WCAS" || $MEETING_ID=="WCAFS"){
					if ( $attendeeArray[$i]->join_wca =="Y" &&  $attendeeArray[$i]->join_wcaf =="Y"){
						$ShowText ="";
					}else{
							if ( $attendeeArray[$i]->join_wca =="Y"){
								$ShowText ="(WCA First)";
							}
							if ($attendeeArray[$i]->join_wcaf =="Y"){
								$ShowText ="(WCA Worldwide)";
							}
					}//end if
				}//MEETING_ID
				//---------------------------------------------------------------
				$attendeeArray[$i]->attendeeName  = $attendeeArray[$i]->attendeeName . "  ".$ShowText."";
				//---------------------------------------------------------
				$color=CheckNetworkColor($chk_companyID,$join_wca,$join_wcaf,$attendeeArray[$i]->Status);
				$attendeeArray[$i]->color=	$color;
				//---------------------------------------

			$i++;  
	}//end while


	$messageArray2 = $attendeeArray;

	} //end  else
	

//---------------------------------------------------------------------------------------------------------------------------------------//
echo json_encode(array($messageArray1,$messageArray2));

?>
