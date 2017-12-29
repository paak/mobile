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

 switch($MEETING_ID) {
	CASE "WCAS":
		$where_network=" and network ='WCA'";
		break;
 	CASE "WCAFS":
		$where_network=" and network ='WCAF'";
		break;
	CASE "SPECIALTY":
			 $where_network=" and network ='SPECIALTY'";
		break;
 	CASE "AMERICAS":
			$where_network=" and network ='AMERICAS'";
		break;
	CASE "LOGNET":
			$where_network=" and network ='LOGNET'";
		break;
	CASE "ECOM":
			$where_network=" and network ='ECOM'";
	break;
 }//switch

//---------------------------------------------------------------------------------------------------------------------------------------//
$SQL="select BoothID,BoothName,t1.CompID,CompanyName,network,t2.mastercompanyid from booth_app t1
inner join company t2 on t1.compid =t2.compid where  1=1  ".$where_network." order by CompanyName  asc";

$FIELD_INFO = array("BoothID","BoothName","CompID","CompanyName","mastercompanyid"); 
$BoothArray=get_obj_info($SQL,$FIELD_INFO);

 //------------------------------------
if (count($BoothArray) < 1 ) {
		$messageArray = array(MSG=>"Under construction."); 
}else {
		for($i=0; $i<count($BoothArray); $i++) {
			$BoothID=$BoothArray[$i]->BoothID;
			$CompID=$BoothArray[$i]->CompID;
			$BoothName=$BoothArray[$i]->BoothName;
			$CompanyName=$BoothArray[$i]->CompanyName;
			$mastercompanyid=$BoothArray[$i]->mastercompanyid;
			$CompID=$BoothArray[$i]->CompID;

			/*if ($BoothID ==30){
					$mastercompanyid=30000000;  // Set for booth specail no attendee data  ( Fenix Apparel)
			}else{
					$mastercompanyid=$BoothArray[$i]->mastercompanyid;
			}

				
			if ($mastercompanyid <> ""){
				
				  //145 : Rotra Air & Ocean BV  (D25)
				 // 115 : Logistics Software Solutions B.V. (L.S.S.) (D22)
				 //164 ,171 ,172,37,41,42  : WCA1,WCA2,WCA3


				    /*if($BoothID=="145"){
						$CompID="12280,12324,48842";
					}elseif ($BoothID=="115"){
							$CompID=$BoothArray[$i]->CompID;
					}elseif ($BoothID=="164"|| $BoothID=="171" || $BoothID=="172" || $BoothID=="37" || $BoothID=="41" || $BoothID=="42"){
							$CompID="52495,50786,41876";
					}else{
						$CompID=GetAllCompid($mastercompanyid);
					}
					
					$CompID=GetAllCompid($mastercompanyid);

			}else{
					$CompID=$BoothArray[$i]->CompID;

			}*/

				$ShowBoothArray[$i]->BoothID=$BoothID;
				$ShowBoothArray[$i]->BoothName=$BoothName;
				$ShowBoothArray[$i]->CompanyName=$CompanyName;
				$ShowBoothArray[$i]->mastercompanyid=$mastercompanyid;
				$ShowBoothArray[$i]->CompID=$CompID;

	}// for

	$messageArray = $ShowBoothArray;

}//end count
//---------------------------------------------------------------------------------------------------------------------------------------//
 echo json_encode($messageArray);
//---------------------------------------------------------------------------------------------------------------------------------------//
?>	