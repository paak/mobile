<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
		$memberID = protect_quote($_GET['memberID']); 
		$attendeeID = protect_quote($_GET['attendeeID']); 
		$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["memberID"])) {
			$memberID = trim(protect_quote($_GET['memberID'])); 
		}else {
			$messageArray=array(MSG=>"Invalid : memberID");
			echo json_encode($messageArray);
			die(); 
		}
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["attendeeID"])) {
			$attendeeID = trim(protect_quote($_GET['attendeeID'])); 
		}else {
			$messageArray=array(MSG=>"Invalid : attendeeID");
			echo json_encode($messageArray);
			die(); 
		}
//--------------------------------------------------------------------------------------
if ($memberID ==$attendeeID){
			$messageArray=array(MSG=>"You can not make one-on-one to yourself : memberID=".$memberID ." and  attendeeID=".$attendeeID ."");
			echo json_encode($messageArray);
			die(); 
}
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSchedulerOpen($G_MEETING_1ON1_STATUS);
//---------------------------------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------------------------------------//
if ($MEETING_ID =="WCAS"  || $MEETING_ID =="WCAFS" ){
	if ($attendeeID <> ""){
	$SQL="select join_wca,join_wcaf from memmeet where memid  =".$attendeeID.""; // 
	$ConfArray=get_obj_info($SQL , array("join_wca","join_wcaf"));
	if (count($ConfArray) > 0){
		$join_wca=trim(ltrim($ConfArray[0]->join_wca));
		$join_wcaf=trim(ltrim($ConfArray[0]->join_wcaf));
	}//ConfArray
	}//memberID

	if ($memberID <> ""){
	$SQL="select join_wca,join_wcaf from memmeet where memid  =".$memberID.""; // 
	$ConfArray=get_obj_info($SQL , array("join_wca","join_wcaf"));
	if (count($ConfArray) > 0){
		$join_wca_mem=trim(ltrim($ConfArray[0]->join_wca));
		$join_wcaf_mem=trim(ltrim($ConfArray[0]->join_wcaf));
	}//ConfArray
	}//memberID

}//end ii meeting
//---------------------------------------------------------------------------------------------------------------------------------------//
switch ($MEETING_ID) {
			case "WCAS":
				$NETWORK ="WCA";
				$WhereNetwork="and (network='$NETWORK' or network='2NET')";
				if ($join_wca <>"Y") {$ChkDate = "and (left(meetingtime,10) ='2018-03-05' )"; } //fix day 
				if ($join_wca_mem <>"Y") {$ChkDate = "and (left(meetingtime,10) ='2018-03-05' )"; } //fix day 
				break;
			case "WCAFS":
				$NETWORK ="WCAF";
				$WhereNetwork="and (network='$NETWORK' or network='2NET')";
				if ($join_wcaf <>"Y") {$ChkDate = "and (left(meetingtime,10) ='2018-03-05' )"; } //fix day 
				if ($join_wcaf_mem <>"Y") {$ChkDate = "and (left(meetingtime,10) ='2018-03-05' )"; } //fix day 
				break;
			case "WCARELO":
				$NETWORK ="WCARELO";
				$WhereNetwork="and network='$NETWORK'  ";	
				break;
			default:
				$NETWORK =$MEETING_ID;
				$WhereNetwork="and network='$NETWORK'  ";	
				break;
}//end switch
//---------------------------------------------------------------------------------------------------------------------------------------//
	$SQL="select A.meetingTime "
			.", B.waiterID, B.joinerID, B.tableNumber"
			.", if(B.waiterID is NULL and B.joinerID is NULL,'A','N') as status"
			." from agenda as A left join oneonone as B on (A.meetingTime=B.meeting_time and (B.waiterID=".$memberID." or B.joinerID=".$memberID."))"
			." where event='1on1'  ".$WhereNetwork."  ". $ChkDate . " "
			." order by meetingTime";

//---------------------------------------------------------------------------------------------------------------------------------------//
	$agendaArray=get_obj_info($SQL , array("meetingTime"));
//---------------------------------------------------------------------------------------------------------------------------------------//
	$member_schedulerArray=get_obj_info($SQL , array("meetingTime","status"));
//---------------------------------------------------------------------------------------------------------------------------------------//
	$SQL="select A.meetingTime "
			.", B.waiterID, B.joinerID, B.tableNumber"
			.", if(B.waiterID is NULL and B.joinerID is NULL,'A','N') as status"
			." from agenda as A left join oneonone as B on (A.meetingTime=B.meeting_time and (B.waiterID=".$attendeeID." or B.joinerID=".$attendeeID."))"
			." where event='1on1'   ".$WhereNetwork." ". $ChkDate . " "
			." order by meetingTime";
//---------------------------------------------------------------------------------------------------------------------------------------//
	$my_schedulerArray=get_obj_info($SQL , array("meetingTime","waiterID", "joinerID", "tableNumber","status"));
//---------------------------------------------------------------------------------------------------------------------------------------//
	//---find date closed
	$SQL2=" select meetingdate,isopen from oneononedate where isopen<>'Y'   ".$WhereNetwork."    order by meetingdate  "; 
	$ArrDateClose=get_obj_info($SQL2 , array("meetingdate"));

	if (count($ArrDateClose) ==0 ){
		$FlagOpenAll= "Y";
	}else{
		$FlagOpenAll= "N";
	}
	//---------------------------------------------------------------------------------------------------------------------------------------//

  //---check open all---//
	$SQL3=" select meetingdate,isopen from oneononedate where isopen = 'Y'    ".$WhereNetwork."  order by meetingdate  "; 
	$ArrOpenAll=get_obj_info($SQL3 , array("meetingdate"));

	if (count($ArrOpenAll) == 0 ){
		$display_all= "Y";
	}else{
		$display_all= "N";
	}
	//-------------------------------------
	
	for($i=0; $i<count($agendaArray); $i++) {
		/*--
		print $agendaArray[$i]->meetingTime . " : ";
		print $my_schedulerArray[$i]->status ." | ". $member_schedulerArray[$i]->status . " | " ;
		if(($my_schedulerArray[$i]->status=="A") && ($my_schedulerArray[$i]->status == $member_schedulerArray[$i]->status)) print "Available"; else print "Not-Available";
		print "<br>";
		---*/
		if(($my_schedulerArray[$i]->status=="A") && ($my_schedulerArray[$i]->status == $member_schedulerArray[$i]->status)) $status= "Available"; else $status= "Not-Available";
		$schedulerArray[$i]->meetingTime=$agendaArray[$i]->meetingTime;
		$schedulerArray[$i]->status=$status;

		
		//----check display--------------
		$meetingTime=$agendaArray[$i]->meetingTime;
		$chk_meetingTime=trim(ltrim($meetingTime));

			if ($FlagOpenAll=="N"){
								for($j=0; $j<count($ArrDateClose); $j++) {
										$meetingdate = $ArrDateClose[$j]->meetingdate;
										if (substr($chk_meetingTime,0,10) == $meetingdate){
												$FlagDisplay="Y";
												break;
										}else{
												$FlagDisplay="";
										}
										//die();
								}//end for

			}//end if
			$schedulerArray[$i]->display=$FlagDisplay;
		//-------------------------------------------

	}//end for


$messageArray=$schedulerArray;
//-----------------------------------------

$messageArray1 = array('display_all' => $display_all);
$messageArray2 = $messageArray;

echo json_encode(array($messageArray1,$messageArray2));

//---------------------------------------------------------------------------------------------------------------------------------------//

?>

	