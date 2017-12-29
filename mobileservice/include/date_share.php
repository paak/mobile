<?php 
// This lib request lib.php for fill_zero() function

class dateTime_structure{
	var $year;
	var $month;
	var $day;
	var $hour;
	var $minute;
	var $secound;

	var $date;
	var $time;

	function dateTime_structure($dateTime){
		$this->year=substr($dateTime,0,4);
		$this->month=substr($dateTime,5,2);
		$this->day=substr($dateTime,8,2);
		$this->hour=substr($dateTime,11,2);
		$this->minute=substr($dateTime,14,2);
		$this->second=substr($dateTime,17,2);

		$this->date=substr($dateTime,0,10);
		$this->time=substr($dateTime,11,8);
	}
}

// require fill_zero() in lib.php for function pack_dateinput
$YEARtoSTART=2009;
$YEARtoSTOP_NO=2;
$MONTHtoSTART=1;
$MONTHtoSTOP_NO=12;


$short_month_array = array("","Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov","Dec");
$full_month_array = array("","January","February","March","April","May","June","July","August","September","October","November","December");
//===================================================================================================
function show_date_input($arg ,$date ){
global $YEARtoSTART;
global $YEARtoSTOP_NO;
global $MONTHtoSTART;
global $MONTHtoSTOP_NO;
global $short_month_array;

// Sorry for interim
$FIX_END_DAY=31;

$day=substr($date,8,2);
$month=substr($date,5,2);
$year=substr($date,0,4);
?>

<select name="<?php  print( $arg );?>_day" class=td_input>
	<option value="" ></option>
	<?php  for( $i=1; $i<=$FIX_END_DAY; $i++) {?>
		<option value="<?php  print( $i ); ?>" <?php if ($day==$i) print " selected "?>><?php  print($i); ?></option>
	<?php }?>
</select >
<select name="<?php  print( $arg);?>_month"  class=td_input>
	<option value="" ></option>
	<?php for($i=$MONTHtoSTART;$i<$MONTHtoSTART+$MONTHtoSTOP_NO ;$i++) {?>
		<option value="<?php  print( $i);?>" <?php if ($month==$i) print " selected "?>><?php  print $short_month_array[$i]; ?></option>
	<?php }?>
</select >
<select name="<?php  print( $arg);?>_year"  class=td_input>
	<option value="" ></option>
	<?php  for($i=$YEARtoSTART;$i<=( intval(date("Y")) + $YEARtoSTOP_NO) ;$i++) {?>
		<option value="<?php  print( $i  ); ?>" <?php if ($year==$i) print " selected "?>><?php  print($i); ?></option>
	<?php }?>
</select >
<?php 
}//===================================================================================================

//==========================================Yoo:2011 Aug 25==========================================
function show_date_input_present_year($arg ,$date, $toyear ){
global $YEARtoSTART;
global $YEARtoSTOP_NO;
global $MONTHtoSTART;
global $MONTHtoSTOP_NO;
global $short_month_array;

// Sorry for interim
$FIX_END_DAY=31;

$day=substr($date,8,2);
$month=substr($date,5,2);
$year=substr($date,0,4);
?>

<select name="<?php  print( $arg );?>_day" >
	<option value="" ></option>
	<?php  for( $i=1; $i<=$FIX_END_DAY; $i++) {?>
		<option value="<?php  print( $i ); ?>" <?php if ($day==$i) print " selected "?>><?php  print($i); ?></option>
	<?php }?>
</select >
<select name="<?php  print( $arg);?>_month" >
	<option value="" ></option>
	<?php for($i=$MONTHtoSTART;$i<$MONTHtoSTART+$MONTHtoSTOP_NO ;$i++) {?>
		<option value="<?php  print( $i);?>" <?php if ($month==$i) print " selected "?>><?php  print $short_month_array[$i]; ?></option>
	<?php }?>
</select >
<select name="<?php  print( $arg);?>_year" >
	<option value="" ></option>
	<option value="<?php print $toyear ?>" <?php if ($year==$toyear) print " selected "?> ><?php print $toyear ?></option>
</select >
<?php 
}

//===================================================================================================
function show_time_input($arg,$date,$flag="AMPM" ){ // $date should be date with AM/PM
//Yoo: 2011 Sep 6: Add $flag
$hour=substr($date,11,2);
$minute=substr($date,14,2);

if($hour=="" && $minute=="") $check_null=true;
$AMPM=substr($date,17,2);

$maxHrs = ($flag=="AMPM")?12:24; //Yoo: 2011 Sep 6
?>

<select name="<?php  print($arg);?>_hour" class=td_input>
	<option value="" <?php print $check_null?" selected ":""?>></option>
	<?php  for($i=1;$i<=$maxHrs;$i++){?><!--Yoo: 2011 Sep 6: 12 -> $maxHrs -->
		<option value="<?php print(($i==24)?0:$i); ?>" <?php if (intval($hour)==(($i==24)?0:$i) && intval($check_null)==false) print " selected "?>><?php print fill_zero((($i==24)?0:$i),2);?></option>
	<?php }?>
</select >
<select name="<?php  print($arg);?>_minute" class=td_input>
	<option value="" <?php print $check_null?" selected ":""?>></option>
	<?php  for($i=0;$i<=59;$i+=5) {?>
		<option value="<?php  print( $i);?>" <?php if(intval($minute)==$i && intval($check_null)==false)print " selected "?>><?php print fill_zero($i,2);?></option>
	<?php }?>
</select>

<!----Yoo: 2011 Sep 6---->
<?php if($flag=="AMPM"){ ?>
<!----------------------->
	<select name="<?php  print($arg);?>_AmPm" class=td_input>
		<option value="0" <?php if($AMPM!="PM")print " Selected"?>>AM</option>
		<option value="12" <?php if($AMPM=="PM")print " Selected"?>>PM</option>
	</select >
<!----------------------->
<?php } ?>
<!----------------------->

<?php 
}
//===================================================================================================
// Don't use AM PM from function strftime("%p") because it had been bug;
//Example can not convert from "2003-12-12 00:55" to "2003-12-11 12:55 PM"
//===================================================================================================
function dateTime_2_AMPM($dateTime_arg){
	if(mkdate($dateTime_arg)==-1)return "";
	$dateTime=new dateTime_structure($dateTime_arg);
	if($dateTime->second != "11"){ // Time is null
			$AMPM="AM";
			if($dateTime->hour==0){
				$AMPM="PM";
				$dateTime->hour = 12;
				$dateTime->date=strftime("%Y-%m-%d", dateAdd("d",-1,mkdate($dateTime_arg)  ));
			}
			if($dateTime->hour > 12){
				$dateTime->hour -=12;
				$AMPM="PM";
			}

			$dateTime->time=fill_zero($dateTime->hour,2).":".fill_zero($dateTime->minute,2)." ".$AMPM;
	}else{
			$dateTime->time="";
	}
	return $dateTime->date." ".$dateTime->time;
}
//===================================================================================================
function AMPM_dateTime($dateTime_arg){
	if(mkdate($dateTime_arg)==-1)return "";
	$dateTime=new dateTime_structure($dateTime_arg);
	if($dateTime->second != "11"){ // Time is null
			$AMPM="AM";
			if($dateTime->hour==0){
				$dateTime->date=strftime("%Y-%m-%d", dateAdd("d",1,mkdate($dateTime_arg)  ));
			}
			$dateTime->time=fill_zero($dateTime->hour,2).":".fill_zero($dateTime->minute,2);
	}else{
			$dateTime->time="00:00:11";
	}
	return $dateTime->date." ".$dateTime->time;
}
//===================================================================================================
function pack_date_input($arg){
	global ${$arg. "_day"};
	global ${$arg. "_month"};
	global ${$arg. "_year"};
	//if(${$arg. "_year"} =="" ||  ${$arg. "_month"} =="" ||  ${$arg. "_day"}=="" ) return "";   <<---- don't enable this line because put time in database will be error
	return fill_zero(${$arg. "_year"},4) ."-". fill_zero(${$arg. "_month"},2) ."-". fill_zero(${$arg. "_day"},2);
}
//===================================================================================================
function pack_time_input($arg){
	global ${$arg. "_hour"};
	global ${$arg. "_minute"};
	global ${$arg. "_AmPm"};
	if(${$arg. "_hour"}=="" || ${$arg. "_minute"}=="")return "";
	${$arg. "_hour"} += ${$arg. "_AmPm"};
	if(${$arg. "_hour"}>23)${$arg. "_hour"}=0;
	return fill_zero(${$arg. "_hour"},2) .":". fill_zero(${$arg. "_minute"},2);
}
//===================================================================================================
function dateAdd ($interval,  $number, $date) {
	if ($number ==0 ) return $date;

	$date_time_array  = getdate($date);
	$hours =  $date_time_array["hours"];
	$minutes =  $date_time_array["minutes"];
	$seconds =  $date_time_array["seconds"];
	$month =  $date_time_array["mon"];
	$day =  $date_time_array["mday"];
	$year =  $date_time_array["year"];

	switch ($interval) {
		case "yyyy":
		    $year +=$number;
		    break;        
		case "q":
		    $year +=($number*3);
		    break;        
		case "m":
		    $month +=$number;
		    break;        
		case "y":
		case "d":
		case "w":
		     $day+=$number;
		    break;        
		case "ww":
		     $day+=($number*7);
		    break;        
		case "h":
		     $hours+=$number;
		    break;        
		case "n":
		     $minutes+=$number;
		    break;        
		case "s":
		     $seconds+=$number;
		    break;        

	}    
	$timestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
	return $timestamp;
}
//===================================================================================================
function  check_now($date){
	//global $NEW_ITEM_DAY;
	//return dateDiff($date,strftime("%Y-%m-%d", dateAdd("d",$NEW_ITEM_DAY,time()) ));
	return dateDiff($date,strftime( "%Y-%m-%d", time()));
}
//===================================================================================================
function mkdate($date){
	//  Hour,Month,sec,month , day , year
	return mktime( intval(substr($date, 11,2)) ,intval(substr($date, 14,2)) , 0 ,  intval(substr($date, 5,2)) , intval(substr($date, 8, 2)) , intval(substr($date, 0 , 4)) );
}
//===================================================================================================
function short_month_format($date){
	global $short_month_array;
	if(mkdate($date)<0)return "";
	return substr($date, 8,2) ." ". $short_month_array[intval(substr($date, 5, 2))]." ". substr($date, 0 , 4);
}

//===================================================================================================
function short_month_format2($date){
	global $short_month_array;
	if(mkdate($date)<0)return "";
	return  $short_month_array[intval(substr($date, 5, 2))]." ".substr($date, 8,2) ." ". substr($date, 0 , 4);
}
//===================================================================================================

function invoice_format($date){
	//global $short_month_array;
	if(mkdate($date)<0)return "";
	return substr($date, 5, 2)."/".substr($date, 8,2) ."/". substr($date, 0 , 4);
}
//===================================================================================================
function full_time_format($dateTime){
	global $short_month_array;
	global $full_month_array;
	if(mkdate($dateTime)<0)return "";
	return $full_month_array[ intval( substr($dateTime, 5, 2) ) ]." ".substr($dateTime, 8,2).", ".substr($dateTime, 0 , 4)." at ".substr($dateTime, 10);
}
function full_time_format_noti($dateTime){
	global $short_month_array;
	global $full_month_array;
	if(mkdate($dateTime)<0)return "";
	return $full_month_array[ intval( substr($dateTime, 5, 2) ) ]." ".substr($dateTime, 8,2).", ".substr($dateTime, 0 , 4)." at".substr($dateTime, 10,6);
}
//===================================================================================================
function dateToDays($day,$month,$year)
{
        $century = substr($year,0,2);
        $year = substr($year,2,2);

        if($month > 2)
            $month -= 3;
        else
        {
            $month += 9;
            if($year)
                $year--;
            else
            {
                $year = 99;
                $century --;
            }
        }

        return ( floor((  146097 * $century)    /  4 ) +
                floor(( 1461 * $year)        /  4 ) +
                floor(( 153 * $month +  2) /  5 ) +
                    $day +  1721119);

}
//===================================================================================================
function dateDiff($date1,$date2, $separ="-") {
    $data_exp1=explode("$separ", $date1);
    $data_exp2=explode("$separ", $date2);

    $giorno1=intval($data_exp1[2]);
    $mese1=intval($data_exp1[1]);
    $anno1=intval($data_exp1[0]);

    $giorno2=intval($data_exp2[2]);
    $mese2=intval($data_exp2[1]);
    $anno2=intval($data_exp2[0]);

    $D1= dateToDays($giorno1,$mese1,$anno1);
    $D2= 	dateToDays($giorno2,$mese2,$anno2);

    return($D1-$D2);
    }
//================================================ FOR CUSTOMIZE FUNCTION =====================================================
function init_date_function(){
?>
<Script>
<!--
	function date_clear( obj_dateName ){
		eval("document.forms[0]."+obj_dateName+"_day").value=0;
		eval("document.forms[0]."+obj_dateName+"_month").value=0;
		eval("document.forms[0]."+obj_dateName+"_year").value=0;
	}
	function date_today( obj_dateName ){
		eval("document.forms[0]."+obj_dateName+"_day").value=<?php print date("d")?>;
		eval("document.forms[0]."+obj_dateName+"_month").value=<?php print date("m")?>;
		eval("document.forms[0]."+obj_dateName+"_year").value=<?php print date("Y")?>;
	}
	function last_day(arg_month,arg_year)
	{
			if( arg_month == 2 )
					if (arg_year % 4 == 0)
							return 29;
					else
							return 28;
			if ( arg_month == 4 || arg_month == 6 || arg_month == 9 || arg_month ==11 )
					return 30;
			else 
					return  31;
	}

	function verifyDate(dayObj,monthObj,yearObj){
		if(dayObj.value!="" || monthObj.value!="" || yearObj.value!=""){
			if(dayObj.value==""){
				alert("Please check day");
				dayObj.focus()
				return false;
			}
			if(monthObj.value==""){
				alert("Please check month");
				monthObj.focus()
				return false;
			}
			if(yearObj.value==""){
				alert("Please check year");
				yearObj.focus()
				return false;
			}
		}
		return true;
	}
//-->
</Script>
<?php }

//===================================================================================================
function dayOfWeek($dateTime_arg){
	$dateTime=new dateTime_structure($dateTime_arg);
	return date("l", mktime(0, 0, 0, $dateTime->month, $dateTime->day, $dateTime->year));
}
//===================================================================================================
function FullMonthName($dateTime_arg){
	$dateTime=new dateTime_structure($dateTime_arg);
	return date("F", mktime(0, 0, 0, $dateTime->month, $dateTime->day, $dateTime->year));
}
?>