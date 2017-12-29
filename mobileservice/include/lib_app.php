<?php 
//--------Check Perimssion-----------------------------------------------------------------------------------------------------------------------------//
function  checkHTTPS(){

		/*if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
			|| $_SERVER['SERVER_PORT'] == 443) {
			$secure_connection = true;
		}else {
			$messageArray = array(MSG=>"Access Deny!"); 
			echo json_encode($messageArray);
			die();
		}*/
	
}//
//---------------------------------------------------------------------------------------------------------------------------------------//
function  checkSession($SID){

		if (!($login=check_session($SID,"login"))){
			$messageArray=array(MSG=>"Time Out");
			echo json_encode($messageArray);
			die;	
		}
		return $login;
}

//---------------------------------------------------------------------------------------------------------------------------------------//
function checkSchedulerOpen($G_MEETING_1ON1_STATUS){

		/*if($G_MEETING_1ON1_STATUS=="CLOSE") {
			$messageArray=array(MSG=>"1on1 has been closed.");
			echo json_encode($messageArray);
			die;		
		}*/
}
//---------------------------------------------------------------------------------------------------------------------------------------//

function checkAppDevice(){

		$device = strtoupper($_SERVER['HTTP_ABZOLUTE_PLATFORM']);

		return $device; 
	
	}//end func
//--------Attendee list -------------------------------------------------------------------------------------------------------------------------------//
 function CheckNoShow($email) {
	
		   $email=rtrim(ltrim($email));

			$SQL="select emailadd from memmeet_noshow where emailadd ='$email'";
			$NoShowData=get_obj_info($SQL, array("emailadd"));

			if ($NoShowData==NULL) {$chkNoshow="N";
			}else{$chkNoshow="Y";}	
			return $chkNoshow;

	}	//end func
//--------------------------------------------------------------------------------------------------//
function CheckNetworkColor($chk_companyID,$join_wca,$join_wcaf,$att_status){

	global $MEETING_ID;

	if ($chk_companyID==""){
		$bgcolor="";
	}else{
	
		/*$SQL="select    compid,member_wca,member_vendors,member_cifa,member_igln,member_apln,member_cgln,member_pla,member_tcla,member_dgla,member_wcarelo,member_lognet,member_pharma,member_wcapn,member_gaa,member_ecom from company where compid =".$chk_companyID."";

	$NetworkArray=get_obj_info($SQL, array("member_wca","member_vendors","member_cifa","member_igln","member_apln","member_cgln","member_pla","member_tcla","member_dgla","member_wcarelo","member_lognet","member_pharma","member_wcapn","member_gaa","member_ecom"));*/


$SQL="select    compid,member_wca,member_vendors,member_cifa,member_igln,member_apln,member_cgln,member_pla,member_tcla,member_dgla,member_wcarelo,member_lognet,member_pharma,member_wcapn,member_gaa  from company where compid =".$chk_companyID."";

	$NetworkArray=get_obj_info($SQL, array("member_wca","member_vendors","member_cifa","member_igln","member_apln","member_cgln","member_pla","member_tcla","member_dgla","member_wcarelo","member_lognet","member_pharma","member_wcapn","member_gaa"));


			
		for($i=0; $i<count($NetworkArray); $i++) {
				$member_wca=$NetworkArray[$i]->member_wca;
				$member_vendors=$NetworkArray[$i]->member_vendors;
				$member_cifa=$NetworkArray[$i]->member_cifa;
				$member_igln=$NetworkArray[$i]->member_igln;
				$member_apln=$NetworkArray[$i]->member_apln;
				$member_cgln=$NetworkArray[$i]->member_cgln;
				$member_pla=$NetworkArray[$i]->member_pla;
				$member_tcla=$NetworkArray[$i]->member_tcla;
				$member_dgla=$NetworkArray[$i]->member_dgla;
				$member_wcarelo=$NetworkArray[$i]->member_wcarelo;
				$member_lognet=$NetworkArray[$i]->member_lognet;
				$member_pharma=$NetworkArray[$i]->member_pharma;
				$member_wcapn=$NetworkArray[$i]->member_wcapn;
				$member_gaa=$NetworkArray[$i]->member_gaa;
				//$member_ecom=$NetworkArray[$i]->member_ecom;
		}//end for

	switch ($MEETING_ID){
														
														case "WCAS":
																	if ($member_wca=="Y" || $member_wca=="A") {
																		$bgcolor="#71c385"; 

																    }else{
																			if ($join_wca=="Y") {
																				$bgcolor="#71c385"; 
																			} else{
																				//$bgcolor="#48a4cb"; 
																					if ($member_wca=='Y' ||$member_apln =='Y' ||
																						$member_cgln =='Y'|| $member_igln =='Y'|| 
																						$member_wcapn =='Y'||
																						$member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y'){
																						$bgcolor="#48a4cb"; 

																					}else{
																									if ($member_gaa=='Y' ){
																												$bgcolor="#cc0033";   //gaa-member
																									}else{
																												$bgcolor="#FFFFFF";   //non-member

																									}//end if
																					}//member_wca

																			}//end else join_wca
																	}
														break;

														case "WCAFS":

																	if ($member_wca=="Y" || $member_wca=="A") {
																		$bgcolor="#71c385"; 

																    }else{
																			if ($join_wca=="Y") {
																				$bgcolor="#71c385"; 
																			} else{
																				//$bgcolor="#48a4cb"; 
																					if ($member_wca=='Y' ||$member_apln =='Y' ||
																						$member_cgln =='Y'|| $member_igln =='Y'|| 
																						$member_wcapn =='Y'||
																						$member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y'){
																						$bgcolor="#48a4cb"; 

																					}else{
																									if ($member_gaa=='Y' ){
																												$bgcolor="#cc0033";   //gaa-member
																									}else{
																												$bgcolor="#FFFFFF";   //non-member

																									}//end if
																					}//member_wca

																			}//end else join_wca
																	}
																	
														break;

														case "WCARELO":
																if ($member_wcarelo=="Y") {
																		$bgcolor="#00b1b0"; 
																}else{
																		if($member_wca=='A' || $member_wca=='Y' ||$member_igln =='Y' ||$member_apln =='Y'||$member_cgln =='Y'||$member_tcla =='Y'||$member_dgla =='Y'){ 
																				$bgcolor="#48a4cb"; 
																		} else{
																				$bgcolor="#FFFFFF"; 
																		}
																}
														break;


														case "LOGNET":

																if ($member_lognet=="Y") {
																		$bgcolor="#f29605"; 
																}else{
																		$bgcolor="#FFFFFF"; 
																}
														break;

														
							
														case "SINO":

																if(($member_cifa=='Y') && ($member_wca=='Y' ||$member_igln =='Y' ||$member_apln =='Y'||$member_cgln =='Y'||$member_tcla =='Y'||$member_dgla =='Y'||$member_wcarelo =='Y'||$member_gaa =='Y' ||$member_lognet =='Y')){ 
																	$bgcolor ="#ffcb99"; //WCAF & CIFA orange
																}elseif($member_cifa=='Y' && $member_wca !='Y' && $member_vendors!='Y'){
																	$bgcolor ="#e8b6e9";  //CIFA
																}elseif($member_wca=='Y' && $member_vendors=='Y'){
																	$bgcolor ="#99ccff";
																}elseif($member_wca!='Y' && $member_vendors=='Y'){
																	$bgcolor ="#ffff00"; //Vendor yellow
																}elseif($member_vendors=='Y'){
																	$bgcolor ="#ffff00"; //Vendor yellow
																}elseif ($member_cifa=='N' && $member_wca=='N' &&$member_igln =='N' &&$member_apln =='N'&&$member_cgln =='N'&&$member_tcla =='N'&&$member_dgla =='N'&&$member_wcarelo =='N'&&$member_gaa =='N' && $member_lognet =='N' && $member_wcapn =='N') {		
																	$bgcolor="#FFFFFF";  //Non-Member 	
																}else{
																	$bgcolor ="#99ccff"; //WCA blue
																}
																
															//------Non member-------------
															/*if ($member_cifa!='Y' || $member_wca!='Y' ||$member_igln !='Y' ||$member_apln !='Y'||$member_cgln !='Y'||$member_tcla !='Y'||$member_dgla !='Y'||$member_wcarelo !='Y'||$member_gaa !='Y' ||$member_lognet !='Y') {	//Non-Member 		
																	$bgcolor="#FFFFFF"; 
															}
															//------------------------------------*/

														break;
															case "WCAPN":
															
															
																if ($member_wcapn=="Y") {
																		$bgcolor="#cc9966"; 
																}else{
																  if ($member_wca=='Y' ||$member_apln =='Y' ||$member_cgln =='Y'|| $member_igln =='Y'|| 
																			$member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y' || $member_cgln  =='Y') {
																			$bgcolor="#83d5f8"; //blue
																			$font_color="#FFFFFF";
																	 }else{
																			$bgcolor ="#ffffff"; //non-member
																			$font_color="#000000";		
																	}
																}//else

														break;

														case "SPECIALTY":

																	if ($member_wca=='Y' ||$member_apln =='Y' ||$member_cgln =='Y'|| $member_igln =='Y'|| 
																			$member_wcapn =='Y'|| $member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y' || $member_cgln  =='Y') {
																			$bgcolor="#83d5f8"; //blue
																			$font_color="#FFFFFF";
																    }elseif($member_gaa=='Y'){
																				$bgcolor ="#cc0033"; // GAA red 
																				$font_color="#FFFFFF";
																	 }elseif($member_lognet=='Y'){
																				$bgcolor="#f29605";  //orange
																				$font_color="#FFFFFF";
																	 }else{
																			$bgcolor ="#ffffff"; //non-member
																			$font_color="#000000";		
																	}
																	
														break;

														case "AMERICAS":
															    	if ($member_wca=='Y' ||$member_apln =='Y' ||$member_cgln =='Y'|| $member_igln =='Y'|| 
																			$member_wcapn =='Y'|| $member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y' || $member_cgln  =='Y') {
																			$bgcolor="#48a4cb"; //blue
																			$font_color="#FFFFFF";
																    }elseif($member_gaa=='Y'){
																				$bgcolor ="#de1e34"; // GAA red 
																				$font_color="#FFFFFF";
																	 }elseif($member_lognet=='Y'){
																				$bgcolor="#f6b304";  //orange
																				$font_color="#FFFFFF";
																	 }else{
																			$bgcolor ="#ffffff"; //non-member
																			$font_color="#000000";		
																	}
																	
														break;
														case "GAA":

																  if($member_gaa=='Y'){
																				$bgcolor ="#cc9999"; // GAA red   
																				$font_color="#FFFFFF";
															    	}elseif ($member_wca=='Y' ||$member_apln =='Y' ||$member_cgln =='Y'|| $member_igln =='Y'|| $member_wcapn =='Y'|| $member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y' ) {
																			$bgcolor="#48a4cb"; //blue
																			$font_color="#FFFFFF";
																	 }elseif($member_lognet=='Y'){
																				$bgcolor="#f29605";  //orange
																				$font_color="#FFFFFF";
																	 }else{
																			$bgcolor ="#ffffff"; //non-member
																			$font_color="#000000";		
																	}
																	
														break;
														/*----*/
															case "ECOM":
															    	
																    if($member_ecom=='Y'){
																				//$bgcolor ="#ff6600"; 
																				$bgcolor ="#ff9966"; 
																				$font_color="#FFFFFF";
																	 }else{
																			$bgcolor ="#ffffff"; //non-member
																			$font_color="#000000";		
																	}
																	
														break;
														//-------------------------------
														case "WSLF":
														if ($member_wca=='Y' ||$member_apln =='Y' ||$member_cgln =='Y'|| $member_igln =='Y'|| 
																			$member_wcapn =='Y'|| $member_pla =='Y'||$member_tcla =='Y'|| $member_dgla =='Y'|| $member_wcarelo =='Y'|| $member_pharma =='Y'|| $member_vendors =='Y' ) {
																			$bgcolor="#83d5f8"; //blue
																			$font_color="#FFFFFF";
																    }elseif($member_gaa=='Y'){
																				$bgcolor ="#cc0033"; // GAA red 
																				$font_color="#FFFFFF";
																	 }elseif($member_lognet=='Y'){
																				$bgcolor="#f29605";  //orange
																				$font_color="#FFFFFF";
																	 }else{
																			$bgcolor ="#ffffff"; //non-member
																			$font_color="#000000";		
																	}
															break;

														
															//-------------------------------
												}//end switch

												if ($att_status=="No"){ //not paid or not allow 1on1
													$bgcolor="#eaeaea";  //gray
												}
	}//end if else

		return $bgcolor;

}// end func
//----------Booth list--------------------------------------------------------------*/
function GetAllCompid($masterid){

		if ($masterid <> ""){
				$SQL="select compid from company where mastercompanyid =".$masterid." and compid in
					(select compid from memmeet	 where status is null or status ='') ";
						
					$FIELD_INFO = array("compid"); 
					$CompArray=get_obj_info($SQL,$FIELD_INFO);
							for($i=0; $i<count($CompArray); $i++) {
									if ($i==0){
										$AllCompid=$CompArray[$i]->compid;
									}else{
										$AllCompid= $AllCompid .",".$CompArray[$i]->compid;
									}
									

							}//end for

		}else{
			$AllCompid ="";
		}

			return $AllCompid;

}//func
//-----------------------------------------
//---------------------------------------------------------------------------------//
function ChkIsAppRead_Noti($attendeeID,$meetingTime){ 

	global $id;
	global $MEETING_ID;

	//--------------------------------------------------------------------------------------------------------------------------------------//
	if ($MEETING_ID =="WCAS" || $MEETING_ID =="WCAFS"){
		$WhereNetwork = "and (network='$NETWORK' or network='2NET' )";
	}else{
		$WhereNetwork = "and network='$NETWORK' ";
	}//end if
	//---------------------------------------------------------------------------------------------------------------------------------------//


	$SQL="select joinerid,waiterid,IsRead,meeting_time from conferencedb.history_noti where  device_memid =".$attendeeID."  and meeting_time='".$meetingTime."' and (IsRead='' or IsRead is null) and conferenceid =".$id." ";

	$objCheckRead=get_obj_info($SQL, array("IsRead"));

	if (count($objCheckRead) > 0){$IsUnRead="true"; }else{$IsUnRead="false";}

	return $IsUnRead;

}//end func
//--------------------------
//---------------------------------------------------------------------------------//
function ChkIsLike($attendeeID,$meetingTime){ 

	if ($attendeeID !="" &&  $meetingTime!=""){
			$SQL="select updateid from memmeet_like where updateid=".$attendeeID."  and  meeting_time ='".$meetingTime."' ";
			$objLike=get_obj_info($SQL, array("updateid"));
			if (count($objLike) > 0){$IsLike="Y"; }else{$IsLike="N";}
	}else{
			$IsLike="N";
	}

	return $IsLike;

}//end func
//--------------------------------------------------
function ChkIsNoShow($attendeeID,$meetingTime){ 
	global $conf_name;

	if ($attendeeID !="" && $meetingTime!=""){
			$SQL="select inform_id,meeting_date,conf_name from memmeet_noshow_detail where inform_id =".$attendeeID." and conf_name='". $conf_name."' and meeting_date='".$meetingTime."' ";
			$objNoShow=get_obj_info($SQL, array("inform_id"));
			if (count($objNoShow) > 0){$IsNoShow="Y"; }else{$IsNoShow="N";}
	}else{
			$IsNoShow="N";
	}

	return $IsNoShow;

}//end func
//--------------------------------------------------
?>
