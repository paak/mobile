<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//--------------------------------------------------------------------------------------------------------------------------------------//
?>
<?php
//---------------------------------------------------------------------------------------------------------------------------------------//
$_SESSION['pagetitle'] = 'contact';
require_once('template/layout.php');
?>
<?php function display() {
global $MEETING_ID;	
?>
<style type="text/css">
aaa {
	font-weight: bold;
}
</style>

  <div class="panel panel-success">
  
    <div class="panel-heading">
      <h1 class="panel-title page_title">CONTACTS</h1>
    </div>
    <div class="panel-body">
	<center>
		Under construction.</font><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
	</center>
	
	<!--<p>
     If you require any other assistance or advice then please feel free to contact any staff of CIFA or WCA.
	  </p>


<style type="text/css">
.font {
	color: #FFFFFF;
}
.font2 {
	color: #cc0000;
}
body p {
	font-family: Verdana, Geneva, sans-serif;
}
body p {
	font-size: 9px;
}
body p {
	font-size: 12px;
}
</style>

<table border="0" cellspacing="2" cellpadding="2"  width="100%">
  <tr>
    <td  bgcolor="#cc0000" align="center"><strong><font color='#FFFFFF'>Emergency  Contacts (24 hrs)</strong></td>
  </tr>
  </table>
<table border="0" cellspacing="2" cellpadding="2"  class="std_table"  width="80%">
  <tr>
    <td  colspan="4" bgcolor="#cc0000"><p align="center" class="font"><strong>Emergency    Contacts (</strong><strong>24 hrs)</strong><strong> </strong></p></td>
  </tr>
  <tr>
    <td width="20%" align="center"><strong>Name
		<br> (<font color='red' size='1'>* Speaks Mandarin</font><strong>)</strong> 
	</td>
    <td width="30%"><p align="center"><strong>Cell Phone</strong></p></td>
  </tr>
  <tr>
    <td width="20%"><p>Julia Zhao<font color='red'>*</font><br><font size='1'> (Membership Development,CIFA) </font></p></td>
    <td width="30%"><p align="left">+86 136 8147 9075</p></td>
 </tr>
 
 <tr>
    <td width="20%"><p>Fiona Wang<font color='red'>*</font><br />
      <font size='1'>(CIFA) </font></p></td>
    <td width="30%"><p align="left">+86 152 1055 7153</p></td>
 </tr>
  <tr>
    <td width="20%"><p>Douglas Archer<br><font size='1'> (Conference Manager, WCA) </font></td>
    <td width="30%"><p align="left">+86 183 2113 2073</p></td>
 </tr>
   <tr>
    <td width="20%"><p>Aui<br />
     <font size='1'> (Conference    Manager, WCA)</font> </p></td>
    <td width="30%"><p align="left">+86 183 2115 6197</p></td>
 </tr>
   <tr>
    <td width="20%"><p>Pui <br />
    <font size='1'>  (Accommodations, WCA) </font></td>
    <td width="30%"><p align="left">+86 183 2115 6207 </p></td>
	</tr>
 <tr>
    <td width="20%"><p>Dominic Wang<font color='red'>*</font> <br />
     <font size='1'> (VP China, WCA)</font></td>
    <td width="30%"><p align="left">+86 159 2166 2716</p></td>
 </tr>
  <tr>
    <td width="20%"><p>Juliet Shen<font color='red'>*</font> <br />
    <font size='1'>  (WCA China) </font></td>
    <td width="30%"><p align="left">+86 135 2408 3443</p></td>
 </tr>
  <tr>
    <td  width="20%"><p>Ken Yokeum<br />
      <font size='1'>(VP   Asia-Pacific, WCA) </font></p></td>
    <td  width="30%"><p align="left">+66 89 771 1797</p></td>
  </tr>
  
  <tr>
    <td  width="20%"><p>Dan March<br />
    <font size='1'>  (CEO, WCA) </font></td>
    <td  width="30%">
      <p align="left">+44 (0) 792 103 8568</p></td>
  </tr>

  <tr>
    <td  width="20%"><p>Brian Majerus <br />
     <font size='1'> (MD, GAA, Lognet) </font></td>
    <td  width="30%"><p align="left">+1 847 800 7226</p></td>
  </tr>

  <tr>
    <td  width="20%"><p>Monica Tappi <br />
      <font size='1'>(VP Europe, WCA) </font></td>
    <td  width="30%"><p align="left">+31 6 5554 4690</p></td>
  </tr>

  <tr>
    <td  width="20%"><p>Charles Goli <br><font size='1'>(GM -Africa, WCA) </font></td>
    <td  width="30%"><p align="left">+233 24164 22 72</p></td>
  </tr>
 
  <tr>
    <td  width="20%"><p>Simge Erdag  <br><font size='1'>(Regional Manager - CIS, Black Sea and Near East, WCA) </font></td>
    <td  width="30%"><p align="left">+90 532 420 2715</p></td>
  </tr>
 
  <tr>
    <td  width="20%"><p>Rita Ramojela <br><font size='1'>(Regional Manager-India, WCA) </font></td>
    <td  width="30%"><p align="left">+91 845 4844 289</p></td>
  </tr>
</table>

		<!--<p><strong>REMINDERS:</strong></p>
        <ol start="1" type="1">
          <li><strong>Please       wear your badge at all times</strong>.        Badges are essential – you will not be admitted to ANY function       areas without it. Please also do not lose your badge because a replacement       will only be issued on production of a passport or government ID card.  A business card or other forms of ID       will not be accepted.         </li>
        </ol>
        <ol start="2" type="1">
          <li><strong>Always       carry a sufficient supply of business cards</strong> so that you       won&rsquo;t have to run up to your room to get new ones.</li>
      </ol>
        <ol start="3" type="1">
          <li><strong>Please       show up on time for all of your meeting appointments</strong>. If you       cannot make it to a meeting appointment for any reason then please have       the courtesy to inform your meeting partner by contacting our staff to       fill out a "<u>One on One Communication Form</u>".</li>
        </ol>

    </div><!-- ./panel-body -->
  </div>

    
<?php }// End of display() ?>    