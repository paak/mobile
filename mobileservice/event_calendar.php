<?php require_once('template/inc_pagetitle.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo getPageTitle($_SESSION['pagetitle']);?></title>
    <link href="../../../public_lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/default.css?v=<?php echo rand(5, 15);?>" rel="stylesheet" />
    <link type="text/css" href="css/media_queries.css?v=<?php echo rand(5, 15);?>" rel="stylesheet" media="screen" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="../.././public_lib/bootstrap/js/jquery-1.11.1.min.js"></script>	
  </head>
  <body>
	<div class="container-fluid main_bg">
		<div class="row-fluid">
			<div class="span12 bg_fade">	
				<div id="main_content_wrapper" class="container">
				<!-- Start Main Content Section -->
				<div class="content_wrapper">				
                	<div id="logo_mainbox" class="logo_mainbox"><img src="images/logo_header_update2.png" alt="" /></div>
					<div id="main_content" class="main_content">					                                                          
					<!---->
 <div class="panel panel-success">
    <div class="panel-heading">
      <h4 class="panel-title page_title"><b>Event Calendar</b></h1>
    </div>
    <div class="panel-body">
<?php 
include("include/DBconfig_Event.php");
include("include/lib_question.php");
include("include/session.php");
include("include/date_share.php");
//------------------------------------------------
$SID = protect_quote_q($_GET['SID']); 

//--conect db--*/
$mssql_event=connect_DB_MSSQL_Event();
//------------------*/
//$conf_logo_path="http://wcaworld.com/common/images/conference_logo/";

$conf_logo_path="http://lib.wcaworld.com/common/images/conference_logo/";
///put image here : http/Common/wcaworld/common/images/conference_logo
//--------Event---------------------------------------
$SQL_Event="SELECT event_id,Event,CONVERT(varchar(10), Begin_Date, 121) as Begin_Date,CONVERT(varchar(10), Finish_Date, 121)  as Finish_Date,CONVERT(varchar(10), GETDATE(), 121) as CDate,year(Begin_Date) as YBegin_Date,Venue,MeetingSite,ExpectedAttendance,link_name,Website_link,line_order,show_website,conf_logo,show_mobile FROM wcaadmin.dbo.Event_Calendar where show_website=1  and (CONVERT(varchar(10), Finish_Date, 121) > CONVERT(varchar(10), GETDATE(), 121)
or CONVERT(varchar(10), Finish_Date, 121) = CONVERT(varchar(10), GETDATE(), 121)) order by line_order asc ,Begin_Date DESC";


$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');

$result=mssql_query($SQL_Event,$mssql_event);
$row=mssql_num_rows($result); 
if($row>0){
		$i=0;
		$CurrentDate=date("Y-m-d");
		while ($row = mssql_fetch_object($result)){	
				
					$event_id =$row->event_id;
					$Event =str_replace('<div align="center">','',$row->Event);
					$Event =str_replace('</div>','',$Event);
					$Event =str_replace('<br />','',$Event);
				
					$Begin_Date =$row->Begin_Date;
					$Finish_Date =$row->Finish_Date;
					$CDate =$row->CDate;
					$Venue =$row->Venue;
					$MeetingSite =$row->MeetingSite;
					$ExpectedAttendance =$row->ExpectedAttendance;
					$link_name =$row->link_name;
					$Website_link =rtrim(ltrim($row->Website_link));
					$line_order =$row->line_order;
					$show_website =$row->show_website;
					$conf_logo =$row->conf_logo;
					$YBegin_Date =$row->YBegin_Date;
					$conf_logo =rtrim(ltrim($row->conf_logo));
					//--------------------------------//
					if ($conf_logo!=""){
						if ($Website_link==""){
								$show_conf_logo="<img src='".$conf_logo_path."/".$YBegin_Date."/".$conf_logo."'  width='70px'   border='0' />";
						}else{	
								$show_conf_logo="<a href='".$Website_link."' target='_blank'><img src='".$conf_logo_path."/".$YBegin_Date."/".$conf_logo."'  width='70px'    border='0'  /></a>";
						}
					}else{
							$show_conf_logo="<img src='".$conf_logo_path."/BlankLogo.png' width='71' height='81' border='0' />";
					}
					//--------------------------------//
					if ($Website_link==""){
							$show_event_link="<font color='#000000'>".$Event."</font>";
							$show_icon_link="";
					}else{
						  	$show_event_link="<a href='".$Website_link."' target='_blank'><font color='#000000'>".$Event."</font></a>";
							$show_icon_link="<a href='".$Website_link."' target='_blank'><img src='".$conf_logo_path."/web_icon3.png'  width='20' height='20' border='0' /></a>";
					}
					//--------------------------------//

					$daydiff=dateDiff($Begin_Date,$CDate);
					if ($daydiff>1){
							$stylecss="conevent_pasttxt";
					}else{
							$stylecss="txt_body";
					}
				//---Show Year---//
				if ($oldYear!=$YBegin_Date){
						echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' valign='top' >";
						echo "<tr><td width='100%'align='center'  class='event_year' ><font color='#FFFFFF'><b>".$YBegin_Date."</b></font></td></tr>";
						echo "<tr>";
						echo "<td>";
				}
				//---Show Year---//
	//---Begin date---//
	$mBegin_Date=substr($Begin_Date,5,2);

	if (substr($Begin_Date,8,1) =="0"){
			$dBegin_Date=substr($Begin_Date,9,1);
	}else{
			$dBegin_Date=substr($Begin_Date,8,2);
	}

	$Bmonth=$months[(int)$mBegin_Date];
	$ShowBdate=substr(dayOfWeek($Begin_Date),0,3)." ".$dBegin_Date." ".substr($Begin_Date, 11,2)." ".$Bmonth;

	//---Finish date---//
	$mFinish_Date=substr($Finish_Date,5,2);
	
	if (substr($Finish_Date,8,1) =="0"){
			$dFinish_Date=substr($Finish_Date,9,1);
	}else{
			$dFinish_Date=substr($Finish_Date,8,2);
	}

	$YFinish_Date=substr($Finish_Date,0,4);
	$Fmonth=$months[(int)$Finish_Date];
	$ShowFdate=substr(dayOfWeek($Finish_Date),0,3)." ".$dFinish_Date." ".substr($Finish_Date, 11,2)." ".$Fmonth.", ".$YFinish_Date;
	//------------------------

$str_body="<table width='100%' border='0' cellspacing='0' cellpadding='0' background='images/calendar/bg-text.png'>";
$str_body.= "<tr>";
$str_body.= "<td width='5%'>&nbsp;</td>";
$str_body.= "<td width='20%' valign='top'><table width='63%' border='0' cellspacing='0' cellpadding='0'>";
$str_body.= " <tr>";
$str_body.= "<td height='20'>&nbsp;</td>";
$str_body.= "</tr>";
$str_body.= "<tr>";
$str_body.= "<td align='center' valign='top'>".$show_conf_logo."</td>";
$str_body.= "</tr>";
$str_body.= "</tr>";
$str_body.= "<tr>";
$str_body.= " <td height='20'>&nbsp;</td>";
$str_body.= "</tr>";
$str_body.= "</table></td>";
$str_body.= "<td width='5%'>&nbsp;<img src='images/calendar/Line.png' />&nbsp;</td>";
$str_body.= "<td width='60%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
$str_body.= "<tr>";
$str_body.= "<td><b>".$show_event_link."</b></td>";
$str_body.= " </tr>";
$str_body.= "<tr>";
$str_body.= " <td>".$ShowBdate." - ".$ShowFdate."</td>";
$str_body.= " </tr>";
$str_body.= "<tr>";
$str_body.= " <td>".$Venue."</td>";
$str_body.= " </tr>";
$str_body.= "<tr>";
$str_body.= "<td>".$MeetingSite."</td>";
$str_body.= " </tr>";
$str_body.= " </table>";
$str_body.= "<td width='20%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
$str_body.= "<tr>";
$str_body.= "<td></td>";
$str_body.= " </tr>";
$str_body.= "<tr>";
$str_body.= " <td></td>";
$str_body.= " </tr>";
$str_body.= "<tr>";
$str_body.= " <td></td>";
$str_body.= " </tr>";
$str_body.= "<tr>";
$str_body.= "<td>".$show_icon_link."</td>";
$str_body.= " </tr>";
$str_body.= " </table>";
$str_body.= "<td width='5%'></td>";
$str_body.= " </tr>";
$str_body.= " </table>";
echo $str_body;
	//------------------------

			if ($oldYear!=$YBegin_Date){
				echo "</tr>";
				echo "</td>";
				 echo "</table>";
			}
 	//------------------------
  
 
			$oldYear=$YBegin_Date;
			$i=$i+1;

					
			}//end while
}//end if 

//-----------------------------------------
//echo "</table>";

mssql_close();

?>

			<!---->	</div>
                    <div class="clear"></div>				
					</div><!-- ./main_content -->
					
				</div><!-- ./content_wrapper -->

				</div><!-- ./container -->
				<!-- End Main Content Section -->

			</div>
		</div>
	</div>
    <script type="text/javascript" src="../../public_lib/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
