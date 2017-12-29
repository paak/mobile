<?php 
error_reporting(E_ALL);
ini_set("display_errors", 0);

include("include/DBconfig.php");
global $db_class_array;
$db_class_array = array(
	'host' => $DBhost,
	'username' => $DBuser,
	'password' => $DBpasswd,
	'db_name' => $DBname
);		
include('../../public_lib/phpclass/class.db.php');
//---------------------------------------------------------------------------------------------------------------------------------------//
	$_SESSION['pagetitle'] = 'Agenda';
	require_once('template/layout_agenda.php');
?>
<?php function display() { 
include("include/lib.php");
include("include/session.php");	
?>
<div class="panel panel-success">
<script type="text/javascript" src="js/agenda_tab.js"></script>	
<link href="css/agenda_tab.css" rel="stylesheet" />
<!---Head-->
<div class="tab">
<?php
$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',06=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
$day = array (1=>'Sun',2=>'Mon',3=>'Tue',4=>'Wed',5=>'Thu',6=>'Fri',7=>'Sat');
?>
<?php
$SQL="select distinct(meeting_date) as meeting_date,DAYOFWEEK(meeting_date) as showdate from agenda_detail  where network='".$NETWORK."' order by meeting_date  asc";

$AgendaObj=get_obj_info($SQL, array("meeting_date","showdate"));

for ($i = 0; $i <count($AgendaObj); $i++) {
	$DayOfWeek=$day[(int)$AgendaObj[$i]->showdate];
	$meeting_date=substr($AgendaObj[$i]->meeting_date,0,10); //2017-06-24
	$Date=substr($meeting_date,8,2);
	$Month=substr($meeting_date,5,2);
	$Showmonth=$months[(int)$Month];
	$TabID="Tab".$i;
	if ($i==0){$default=" id='defaultOpen' ";}
	?>
	<button class="tablinks" onclick="openTab(event,'<?php echo $TabID?>')"  <?php echo$default?>><font size='1'><?php echo  $a.$DayOfWeek ?>
	<br /><?php echo $Showmonth ?> <?php echo $Date ?></font></button>
	<?php
}// for
?>
</div>
<!---Detail-->
<?php
$SQL="select distinct(meeting_date) as meeting_date,DAYOFWEEK(meeting_date) as showdate from agenda_detail  where network='".$NETWORK."' order by meeting_date asc";

$AgendaObj=get_obj_info($SQL, array("meeting_date","showdate"));
$NumAgendaObj=count($AgendaObj);

for ($i = 0; $i <$NumAgendaObj; $i++) {

		$meeting_date=substr($AgendaObj[$i]->meeting_date,0,10); //2017-06-24
		$TabID="Tab".$i;
		$SQL="select meeting_date,FromTime,ToTime,ProgramDetail,Venue,DressCode from agenda_detail 
		where network ='".$NETWORK."' and meeting_date='".$meeting_date."' order by orderno asc ";
		$AgendaDetailObj=get_obj_info($SQL, array("meeting_date","FromTime","ToTime","ProgramDetail","Venue","DressCode"));
?>
<div id="<?php echo $TabID;?>" class="tabcontent">
  <table width="100%" border="0" >
  <?php 
	
$NumcountAgendaDetailObj=count($AgendaDetailObj) ;
for ($j = 0; $j <$NumcountAgendaDetailObj; $j++) {
		$FromTime=$AgendaDetailObj[$j]->FromTime;
		$ToTime=$AgendaDetailObj[$j]->ToTime;
		$ProgramDetail=$AgendaDetailObj[$j]->ProgramDetail;
		$Venue=rtrim(ltrim($AgendaDetailObj[$j]->Venue));
		$DressCode=$AgendaDetailObj[$j]->DressCode;

		if ($Venue!=""){$ShowVenue= "Venue : ".$Venue ."";}else{$ShowVenue="";}

		if ($ToTime!=""){
				$ShowTime=$FromTime." - ".$ToTime;
		}else{
				$ShowTime=$FromTime;
		}
		if ($j==0){$ShowTime="<br>".$ShowTime;}
?>

 <tr>
  <td width="100%" align="left" valign="top"><?php echo $ShowTime?></td>
  </tr>
   <tr>
  <td align="left" valign="middle" width="100%">
    <b><?php echo str_replace("<hr />","<br>",$ProgramDetail);?></b>
	<!--<b><?php echo $ProgramDetail;?></b>-->
	<br><?php echo $ShowVenue;?>
	</td>
  </tr>
  <?php if ($j !=$NumcountAgendaDetailObj-1){ ?>
  <tr><td width="100%"><hr></td></tr>
  <?php }//j ?>
  <?php
		}//end for
?>
</table>
  </tr>
</div>

<?php 

}//end for
?>

<br><br>
</div>

<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<!------------------------------------------------ -->
</div><!-- ./panel-success -->
<?php }// End of display() ?>