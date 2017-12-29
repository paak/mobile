<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//--------------------------------------------------------------------------------------------------------------------------------------//
?>

<?php
$_SESSION['pagetitle'] = 'sponsor';
//require_once('template/layout.php');

require_once('template/layout_fl.php');
?>
<?php function display() {
	global $MEETING_ID;	
?>
 <?php
//---------------------------------------------------------------------------------------------------------------------------------------//
switch ($MEETING_ID) {
			//config : $url_ref in ID.php
		case "WCAS":
				$ShowTitle="CONFERENCE SPONSORS";
				//$ShowImg="<img src='images/sponsor/WCA-First2017Thanks-02_07022017.jpg' class='img-responsive' />";
				$ShowImg="Under construction.";

			break;
		case "WCAFS":
				$ShowTitle="CONFERENCE SPONSORS";
				//$ShowImg="<img src='images/sponsor/Sponsor_WCAF_1.jpg' class='img-responsive' /><img src='images/sponsor/Sponsor_WCAF_2.jpg' class='img-responsive' />";
				$ShowImg="Under construction.";
			break;
		case "GAA":
				$ShowTitle="CONFERENCE SPONSORS";
				$ShowImg="<img src='images/sponsor/GAA_31082017.gif' class='img-responsive' />";
				//$ShowImg="Under construction.";

			break;
		case "LOGNET":
				$ShowTitle="CONFERENCE SPONSORS";
				$ShowImg="<img src='images/sponsor/LognetSponsors1.jpg' class='img-responsive' />";
				//$ShowImg="Under construction.<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";

			break;
		case "SPECIALTY":
				$ShowTitle="CONFERENCE SPONSORS";
				$ShowImg="<img src='images/sponsor/WSLFSponsors1.jpg' class='img-responsive' />";
				//$ShowImg="Under construction.<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";

			break;
		case "AMERICAS":
				$ShowTitle="CONFERENCE SPONSORS";
				$ShowImg="<img src='images/sponsor/AmericasSponsors1.jpg' class='img-responsive' />";
				//$ShowImg="Under construction.<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";

			break;
		case "ECOM":
				$ShowTitle="CONFERENCE SPONSORS";
				//$ShowImg="<img src='images/floorplan/Hall4_update.gif' class='img-responsive' />";
				$ShowImg="Under construction.<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";

			break;
		case "SINO":
				$ShowTitle="<font color='#993333'>CONFERENCE SPONSORS</font>";
				$ShowImg="<img src='images/sponsor/SINO_Sponsor_31102017.gif' class='img-responsive' alt='Sponsor' />";
				//$ShowImg="	<font color='#333333'>Under Construction.</font>";
			break;

		case "WCAPN":
				$ShowTitle="CONFERENCE SPONSORS";
				//$ShowImg="<img src='images/sponsor/Sponsor_WCAProjects2016.jpg' class='img-responsive' />";
				$ShowImg="<font color='#905926' size='3'>Under construction.</font><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR></font>";

			break;
			
			
}//switch
//---------------------------------------------------------------------------------------------------------------------------------------//

?> 
  <div class="panel panel-success">  
    <!--<div class="panel-heading">
      <h1 class="panel-title page_title"><?php echo $ShowTitle;?></h1>
    </div>-->
    <div class="panel-body">
		<center>
				<?php echo $ShowImg;?>
		</center>
		<br> <br>   
    </div><!-- ./panel-body -->
  </div>

<?php }// End of display() ?>    