<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//------Mobile device--------------------
include("include/lib_notification.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
$attendeeID = protect_quote($_GET['attendeeID']); 
$SID = protect_quote($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
		if (isset($_GET["attendeeID"])) {
			$attendeeID = trim(protect_quote($_GET['attendeeID'])); 
		}else {
			$messageArray=array(MSG=>"Invalid : attendeeID");
			echo json_encode($messageArray);
			die(); 
		}
//------------------------------------------------------
$app_device=checkAppDevice();
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSchedulerOpen($G_MEETING_1ON1_STATUS);
//---------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------//
	if ($MEETING_ID =="WCAS" || $MEETING_ID =="WCAFS"){
		$SQL_memeet="select memid,join_wca,join_wcaf from memmeet where memid=".$attendeeID."   ";
		$userLogin=get_obj_info($SQL_memeet, array("join_wca","join_wcaf"));
		$join_wca=$userLogin[0]->join_wca;
		$join_wcaf=$userLogin[0]->join_wcaf;

	}//MEETING_ID

		
	switch ($MEETING_ID) {
			case "WCAS":
				$WhereNetwork="and (network='$NETWORK' or network='2NET')";
				if ($join_wca <>"Y") {
							$ChkDate = "and (left(meetingtime,10) ='2018-03-05' )"; 
							$ChkMeetingDate = "and (left(meetingdate,10) ='2018-03-05') "; 
				} //fix day 
				break;
			case "WCAFS":
				$WhereNetwork="and (network='$NETWORK' or network='2NET')";
				if ($join_wcaf <>"Y") {
							$ChkDate = "and (left(meetingtime,10) ='2018-03-05') "; 
							$ChkMeetingDate = "and (left(meetingdate,10) ='2018-03-05') "; 
				}//fix day 
				break;
			default:
				$WhereNetwork="and network='$NETWORK'  ";	
				break;
    }//end switch
//---------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------//
	$SQL="select A.meetingTime "
			.", B.waiterID, B.joinerID, B.tableNumber,B.comment"
			.", if(B.waiterID is NULL and B.joinerID is NULL,'Available',if(B.waiterID=B.joinerID and B.waiterID=".$attendeeID.",'Blocked',if(B.waiterID=".$attendeeID.",'Invited', 'Make') )) as status"
			." from agenda as A left join oneonone as B on (A.meetingTime=B.meeting_time and (B.waiterID=".$attendeeID." or B.joinerID=".$attendeeID."))"
			." where event='1on1'".$WhereNetwork."  ". $ChkDate . " "
			." order by meetingTime";

	/*echo "$SQL"; //die();
	echo "<hr>";*/

	$agendaArray=get_obj_info($SQL , array("meetingTime","waiterID", "joinerID", "tableNumber","status","comment"));

     //---check open all---//
	$SQL3=" select meetingdate,isopen from oneononedate where isopen = 'Y'  ".$WhereNetwork."  ". $ChkMeetingDate . " order by meetingdate  ";
	$ArrOpenAll=get_obj_info($SQL3 , array("meetingdate"));

	if (count($ArrOpenAll) == 0 ){
		$display_all= "Y";
	}else{
		$display_all= "N";
	}
	//---find date closed
	$SQL2=" select meetingdate,isopen from oneononedate where isopen<>'Y'  ".$WhereNetwork."  ". $ChkMeetingDate . "  order by meetingdate  ";
	$ArrDateClose=get_obj_info($SQL2 , array("meetingdate"));

	if (count($ArrDateClose) ==0 ){
		$FlagOpenAll= "Y";
	}else{
		$FlagOpenAll= "N";
	}

	//---find date closed---//
	$FlagDisplay="";
	for($i=0; $i<count($agendaArray); $i++) {
		 $meetingTime=$agendaArray[$i]->meetingTime;
		 $waiterID=$agendaArray[$i]->waiterID;
		 $joinerID=$agendaArray[$i]->joinerID;
		 $tableNumber=$agendaArray[$i]->tableNumber;
		 $comment=$agendaArray[$i]->comment;

			if($tableNumber==NULL || $tableNumber==0)$tableNumber=''; else $tableNumber=$tableNumber;
		 $status=$agendaArray[$i]->status;
			 if($status=="Invited") {
					$memberInfo=get_member_info($joinerID);
					$memberID=$joinerID;
			 }elseif($status=="Make") {
					$memberInfo=get_member_info($waiterID);
					$memberID=$waiterID;
			 }else {
					$memberInfo=get_member_info(0);
					$memberID="";
			 }
			 
			//echo $meetingTime. " | ".$status. " | ".$memberID. " | ".$memberInfo->name. " | ".$memberInfo->company. " | ".$memberInfo->repCountry. " | ".$tableNumber."<br>";
			//----------------------------------------------------------------------------------			
			$schedulerArray[$i]->meetingTime=$meetingTime;
			$schedulerArray[$i]->status=$status;
			$schedulerArray[$i]->memberID=$memberID;
			$schedulerArray[$i]->memberName=$memberInfo->name;
			$schedulerArray[$i]->memberCompany=$memberInfo->company;
			$schedulerArray[$i]->memberRepCountry=$memberInfo->repCountry;
			$schedulerArray[$i]->tableNumber=booth_info($tableNumber);
			
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
			
			//----add 02/01/2014--------------//
			if ($comment=='f') {
				$schedulerArray[$i]->display="Y";
			}else{
				$schedulerArray[$i]->display=$FlagDisplay;
			}
			//----add 11/08/2015--------------//
			$IsAppRead="Y"; //fix no show icon 
			if ($schedulerArray[$i]->display <> "Y"){
				if ($OpenNotification1on1=="true"){
					$IsUnRead =ChkIsAppRead_Noti($attendeeID,$chk_meetingTime);
					if (ChkIsAppRead_Noti($attendeeID,$chk_meetingTime)=="true"){
						$IsAppRead="";
					}else{
						$IsAppRead="Y"; 
					}
				}//$OpenNotification1on1
			}else{
					$IsAppRead="Y"; 
			}//display
			//-------------------------------------------------
			$schedulerArray[$i]->IsAppRead=$IsAppRead;
			//--------Phase 4 : add 15/12/2015----(Like and NoShow)------------------------------------
			if ($FlagDisplay!='Y' ) {
				$schedulerArray[$i]->NoShow="";
				$schedulerArray[$i]->Like="";
			}else{
				$BntLike=ChkIsLike($attendeeID,$chk_meetingTime);
				$BntNoShow=ChkIsNoShow($attendeeID,$chk_meetingTime);

				$schedulerArray[$i]->NoShow=$BntNoShow;
				$schedulerArray[$i]->Like=$BntLike;
			}
			//-------------------------------------------------
	} //end for

//echo "<hr>";
$messageArray1 = array('display_all' => $display_all);
$messageArray2 = $schedulerArray;
//----Add check open all day----------------



//---------------------------------------------------------------------------------------------------------------------------------------//

//echo json_encode($messageArray);

//----Update status read notification----------------------------//

if ($OpenNotification1on1==true){
		$SQL_Update="update conferencedb.history_noti set IsRead='Y' where (device_memid =".$attendeeID.") and (IsRead='' or IsRead is null) and network='".$NETWORK."' and conferenceid =".$id." and section='1on1' ";

		if(!mysql_query($SQL_Update)){
										$messageArray=array(MSG=>"Can't update history_noti");
										echo json_encode($messageArray);
										die();
		}//SQL_Update
}//OpenNotification1on1

//-------------------------------------------------------------------------------//
echo json_encode(array($messageArray1,$messageArray2));

//---------------------------------------------------------------------------------//



?>

	