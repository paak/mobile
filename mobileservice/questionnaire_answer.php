<?php
include("include/DBconfig.php");
include("include/lib_question.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
$SID = protect_quote_q($_GET['SID']); 
//---------------------------------------------------------------------------------------------------------------------------------------//
$mssql=connect_DB_MSSQL();
//--------Question---------------------------------------
$QArray=json_decode(str_replace('\\',"",$_POST['QArray']), true);
//---------------------------------------------------------
$count = count($QArray);
//-------------------------------
for ($i = 0; $i < $count; $i++) 
{
			$QID=strtolower($QArray[$i]["QID"]);
			$AnswerValue=strtolower($QArray[$i]["AnswerValue"]);
			$AnswerAdditionalText=str_replace("'","",strtolower(ltrim(rtrim($QArray[$i]["AnswerAdditionalText"]))));
			// O : Over all conference
			switch ($QID) { 
			case "1":$O_1 = $AnswerValue;break;
			case "2":$O_2 = $AnswerValue;break;
			case "3":$O_3 = $AnswerValue; if($AnswerAdditionalText <> ""){ $O_3_txt ="".$AnswerAdditionalText."";}break;
			case "4":$O_4 = $AnswerValue; break;
			case "5":$O_5 = $AnswerValue; break;
			case "6":$O_6 = $AnswerValue; break;
			case "7":$O_7 = $AnswerValue; break;
			case "8":$O_8 = $AnswerValue; break;
			case "9":$O_9 = $AnswerValue; break;
			case "10":$O_10 = $AnswerValue; break;
			case "11":$O_11 = $AnswerValue; break;
			case "12":$O_12 = $AnswerValue; break;
			case "13":$O_13 = $AnswerValue; break;
			case "14":$O_14 = $AnswerValue; break;
			case "15":$O_15 = $AnswerValue; break;
			case "16":$O_16 = $AnswerValue; break;
			case "17":$O_17 = $AnswerValue; break;
			case "18":$O_18 = $AnswerValue; break;
			case "19":$O_19 = $AnswerValue; break;
			case "20":$O_20 = $AnswerValue; break;
			case "21":$O_21 = $AnswerValue; break;
			case "22":$O_22 = $AnswerValue; break;
			case "23":$O_23 = $AnswerValue; break;
			case "24":$O_24 = $AnswerValue; break;
			case "25":$O_25 = $AnswerValue; break;
			case "26":$O_26 = $AnswerValue; break;
			case "27":$O_27 = $AnswerValue; break;
			case "28":$O_28 = $AnswerValue; break;
			case "29":$O_29 = $AnswerValue; break;
			case "30":$O_30 = $AnswerValue; break;
			case "31":$O_31 = $AnswerValue; break;
			case "32":if($AnswerAdditionalText <> ""){ $O_32_txt ="".$AnswerAdditionalText."";}  break;
			case "33":$O_33 = $AnswerValue; break;
			case "34":$O_34 = $AnswerValue; break;
			case "35":$O_35 = $AnswerValue; break;
			case "36":$O_36 = $AnswerValue; break;
			case "37":$O_37 = $AnswerValue; break;
			case "38":$O_38 = $AnswerValue; break;
			case "39":$O_39 = $AnswerValue; break;
			case "40":$O_40 = $AnswerValue; break;
			case "41":$O_41 = $AnswerValue; break;
			case "42":$O_42 = $AnswerValue; break;
			case "43":$O_43 = $AnswerValue; break;
			case "44":$O_44 = $AnswerValue; break;
			case "45":$O_45 = $AnswerValue; break;
			case "46":$O_46 = $AnswerValue; break; 
					if($AnswerAdditionalText <> ""){ $O_46_txt ="".$AnswerAdditionalText."";}  break;
			case "47":$O_47 = $AnswerValue; 
			case "48":$O_48 = $AnswerValue;
			case "49":$O_49 = $AnswerValue; 
			case "50":$O_50 = $AnswerValue;  if($AnswerAdditionalText <> ""){ $O_50_txt ="".$AnswerAdditionalText."";}  break;
			case "51":$O_51 = $AnswerValue; 
						 if($AnswerAdditionalText <> ""){ $O_51_txt ="".$AnswerAdditionalText."";}  break;
			case "52":$O_52 = $AnswerValue; break;
			case "53":$O_53 = $AnswerValue; break; 
			case "54":$O_54 = $AnswerValue; break; 
			case "55":if($AnswerAdditionalText <> ""){$O_55_txt ="".$AnswerAdditionalText."";}else{$O_55_txt ="";}break;
			case "56":
						if ($AnswerValue =="1"){$O_56_1 = $AnswerValue;}
						if ($AnswerValue =="2"){$O_56_2 = $AnswerValue;}
						if ($AnswerValue =="3"){$O_56_3 = $AnswerValue;}
						if ($AnswerValue =="4"){$O_56_4 = $AnswerValue;}
						if ($AnswerValue =="5"){$O_56_5 = $AnswerValue;}
						if ($AnswerValue =="6"){$O_56_6 = $AnswerValue;}
						if ($AnswerValue =="7"){$O_56_7 = $AnswerValue; }
						if($AnswerAdditionalText <> "" and $AnswerValue =="7"){
								$O_56_txt ="".$AnswerAdditionalText."";
						} else{
								$O_56_txt ="";
						}
						break;

			case "57":
						
						if ($AnswerValue =="1"){$O_57_1 = $AnswerValue;}
						if ($AnswerValue =="2"){$O_57_2 = $AnswerValue;}
						if ($AnswerValue =="3"){$O_57_3 = $AnswerValue;}
						if ($AnswerValue =="4"){$O_57_4 = $AnswerValue;}
						if ($AnswerValue =="5"){$O_57_5 = $AnswerValue;}
						if ($AnswerValue =="6"){$O_57_6 = $AnswerValue;}
						if ($AnswerValue =="7"){$O_57_7 = $AnswerValue; }
						
						if($AnswerAdditionalText <> "" and $AnswerValue =="7"){
								$O_57_txt ="".$AnswerAdditionalText."";
						} else{
								$O_57_txt ="";
						}
						break;
			case "58":
						$O_58_txt ="".$AnswerAdditionalText."";
						break;
				
			}//end switch

}//end for

//---------------------------------------------------------------------------------------------------------------------------------------//
//---data insert------------

if ($O_1 ==null ||$O_1==""){$O_1 = "0";}
if ($O_2 ==null ||$O_2==""){$O_2 = "0";}
if ($O_3 ==null ||$O_3=="") {$O_3 = "0";}
if ($O_3_txt ==null ||$O_3_txt==""){$O_3_txt = "";}

/*----Hotel-------------------*/

if ($O_3 =="6" ){ //other
	$O_4 = "NULL";
	$O_5 = "NULL";
	$O_6 = "NULL";
	$O_7 = "NULL";
}else{

	if ($O_3 == null || $O_3 == ""  || $O_3 == "0"){
		$O_4 = "NULL";
		$O_5 = "NULL";
		$O_6 = "NULL";
		$O_7 = "NULL";

	}else{
		if ($O_4 ==null  || $O_4=="" ){$O_4 = "0";}
		if ($O_5 ==null  || $O_5==""){$O_5 = "0";}
		if ($O_6 ==null  || $O_6==""){$O_6 = "0";}
		if ($O_7 ==null  || $O_7==""){$O_7 = "0";}
	}//O3
}//O_3


/*----Hotel-------------------*/


if ($O_8 ==null  || $O_8==""){$O_8 = "0";}
if ($O_9 ==null  || $O_9==""){$O_9 = "0";}
if ($O_10 ==null  || $O_10==""){$O_10 = "0";}
if ($O_11 ==null  || $O_11==""){$O_11 = "0";}
if ($O_12 ==null  || $O_12==""){$O_12 = "0";}
if ($O_13 ==null  || $O_13==""){$O_13 = "0";}
if ($O_14 ==null  || $O_14==""){$O_14 = "0";}
if ($O_15 ==null  || $O_15==""){$O_15 = "0";}
if ($O_16 ==null  || $O_16==""){$O_16 = "0";}
if ($O_17 ==null  || $O_17==""){$O_17 = "0";}
if ($O_18 ==null   || $O_18=="" ){$O_18 = "0";}
if ($O_19 ==null   || $O_19==""){$O_19 = "0";}
if ($O_20 ==null   || $O_20==""){$O_20 = "0";}
if ($O_21 ==null	|| $O_21==""){$O_21 = "0";}
if ($O_22 ==null   || $O_22==""){$O_22 = "0";}
if ($O_23 ==null   || $O_23==""){$O_23 = "0";}

/*----Tour ---------*/
if ($O_23 =="3" ){ //not attended
	$O_24 = "NULL";
}else{
		if ($O_23 ==null  || $O_23=="" || $O_23=="0"){
				$O_24 = "NULL";
		}else{
			if ($O_24 ==null  ||$O_24==""){$O_24 = "0";}
		}
}//O_23
/*----Tour ---------*/

if ($O_25 ==null   ||$O_25==""){$O_25 = "0";}
if ($O_26 ==null   ||$O_26==""){$O_26 = "0";}
if ($O_27 ==null   ||$O_27==""){$O_27 = "0";}
if ($O_28 ==null   ||$O_28==""){$O_28 = "0";}
if ($O_29 ==null   ||$O_29==""){$O_29 = "0";}
if ($O_30 ==null   ||$O_30==""){$O_30 = "0";}
if ($O_31 ==null   ||$O_31==""){$O_31 = "0";}
if ($O_32_txt ==null   ||$O_32_txt==""){$O_32_txt = "";}
if ($O_33 ==null  ||$O_33==""){$O_33 = "0";}
if ($O_34 ==null  ||$O_34==""){$O_34 = "0";}
if ($O_35 ==null  ||$O_35==""){$O_35 = "0";}
if ($O_36 ==null  ||$O_36==""){$O_36 = "0";}
if ($O_37 ==null  ||$O_37==""){$O_37 = "0";}
if ($O_38 ==null  ||$O_38==""){$O_38 = "0";}
if ($O_39 ==null  ||$O_39==""){$O_39 = "0";}
if ($O_40 ==null  ||$O_40==""){$O_40 = "0";}
if ($O_41 ==null  ||$O_41==""){$O_41 = "0";}
if ($O_42 ==null  ||$O_42==""){$O_42 = "0";}
if ($O_43 ==null  ||$O_43==""){$O_43 = "0";}
if ($O_44 ==null  ||$O_44==""){$O_44 = "0";}
if ($O_45 ==null  ||$O_45==""){$O_45 = "0";}
if ($O_46 ==null  ||$O_46==""){$O_46 = "0";}
if ($O_46_txt ==null  ||$O_46_txt==""){$O_46_txt = "";}
if ($O_47 ==null  ||$O_47==""){$O_47 = "0";}
if ($O_48 ==null  ||$O_48==""){$O_48 = "0";}
if ($O_49 ==null  ||$O_49==""){$O_49 = "0";}
if ($O_50_txt ==null  ||$O_50_txt==""){$O_50_txt = "";}
if ($O_51 ==null  ||$O_51==""){$O_51 = "0";}
if ($O_51_txt ==null  ||$O_51_txt==""){$O_51_txt = "";}
if ($O_52 ==null  ||$O_52==""){$O_52 = "0";}
if ($O_53 ==null  ||$O_53==""){$O_53 = "0";}
if ($O_54 ==null  ||$O_54==""){$O_54 = "0";}
if ($O_55_txt ==null ||$O_55_txt==""){$O_55_txt = "";}
if ($O_56_1 ==null  ||$O_56_1==""){$O_56_1 = "0";}
if ($O_56_2 ==null  ||$O_56_2==""){$O_56_2 = "0";}
if ($O_56_3 ==null  ||$O_56_3==""){$O_56_3 = "0";}
if ($O_56_4 ==null  ||$O_56_4==""){$O_56_4 = "0";}
if ($O_56_5 ==null  ||$O_56_5==""){$O_56_5 = "0";}
if ($O_56_6 ==null ||$O_56_6==""){$O_56_6 = "0";}
if ($O_56_7 ==null ||$O_56_7==""){$O_56_7 = "0";}
if ($O_56_txt ==null ||$O_56_txt==""){$O_56_txt = "";}
if ($O_57_1 ==null  ||$O_57_1==""){$O_57_1 = "0";}
if ($O_57_2 ==null  ||$O_57_2==""){$O_57_2 = "0";}
if ($O_57_3 ==null  ||$O_57_3==""){$O_57_3 = "0";}
if ($O_57_4 ==null  ||$O_57_4==""){$O_57_4 = "0";}
if ($O_57_5 ==null  ||$O_57_5==""){$O_57_5 = "0";}
if ($O_57_6 ==null ||$O_57_6==""){$O_57_6 = "0";}
if ($O_57_7 ==null ||$O_57_7==""){$O_57_7 = "0";}
if ($O_57_txt ==null ||$O_57_txt==""){$O_57_txt = "";}
if ($O_58_txt ==null ||$O_58_txt==""){$O_58_txt = "";}


$SQL ="exec InsertQN_WCAFirst2016_Report
$O_1,
$O_2,
$O_3,
'$O_3_txt',
$O_4,
$O_5,
$O_6,
$O_7,
$O_8,
$O_9,
$O_10,
$O_11,
$O_12,
$O_13,
$O_14,
$O_15,
$O_16,
$O_17,
$O_18,
$O_19,
$O_20,
$O_21,
$O_22,
$O_23,
$O_24,
$O_25,
$O_26,
$O_27,
$O_28,
$O_29,
$O_30,
$O_31,
'$O_32_txt',
$O_33,
$O_34,
$O_35,
$O_36,
$O_37,
$O_38,
$O_39,
$O_40,
$O_41,
$O_42,
$O_43,
$O_44,
$O_45,
$O_46,
'$O_46_txt',
$O_47,
$O_48,
$O_49,
'$O_50_txt',
$O_51,
'$O_51_txt',
$O_52,
$O_53,
$O_54,
'$O_55_txt',
$O_56_1,
$O_56_2,
$O_56_3,
$O_56_4,
$O_56_5,
$O_56_6,
$O_56_7,
'$O_56_txt',
$O_57_1,
$O_57_2,
$O_57_3,
$O_57_4,
$O_57_5,
$O_57_6,
$O_57_7,
'$O_57_txt',
'$O_58_txt'";


if(!mssql_query($SQL,$mssql)){
				$messageArray=array(MSG=>"Questionare Error");
}else{
				$messageArray=array(MSG=>"Thank you for your time. Your comments will enable us to better plan and execute future conferences to meet your needs");
} 

echo json_encode($messageArray);

//---------------------------------------------------------------------------------------------------------------------------------------//

?>

	