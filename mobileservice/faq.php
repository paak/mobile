<?php 
//---------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------//
	$_SESSION['pagetitle'] = 'faq';
	require_once('template/layout.php');
?>
<?php function display() { ?>

<div class="panel panel-success">
    <div class="panel-heading">
      <h1 class="panel-title page_title">FAQ</h1>
    </div>
     <div class="panel-body">
		<!-------Collapsible----->
	 <link rel="stylesheet" href="css/jquery/jquery.mobile-1.4.5.min.css">
	<script src="css/jquery/jquery-1.11.3.min.js"></script>
	<script src="css/jquery/jquery.mobile-1.4.5.min.js"></script>
<!-------Collapsible----->
<!----------One-one-One meeting scheduler-------------------------------------- -->
<div id="faq" class="panel-group">
<b><font size='3'>One-one-One Meeting Scheduler</font></b>
<br><br>
<!----------One-one-One meeting scheduler-------------------------------------- -->
<div class="panel panel-default">	
	<div class="panel-heading">		
	<h4 class="panel-title active">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-1">How do I make appointments?</a>         </h4>       
	</div>       
	<div class="panel-collapse collapse out"  id="ans-1">            
		 <div class="panel-body">
		 Click Scheduler menu. Click (+) to bring up the Attendee List. Click attendee's name and select a meeting time. Click "Submit" button to complete the process.
		</div>	
	</div>
</div> 
<!------------------------------------------------ -->
<div class="panel panel-default">	
	<div class="panel-heading"   data-icon="plus">		
	<h4 class="panel-title active">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-2" >How do I cancel my appointments?</a>         </h4>       
	</div>       
	<div class="panel-collapse collapse out"  id="ans-2">            
		 <div class="panel-body">
		Click Scheduler menu. Click the "Cancel" button at the appointment you do not want to keep.
		</div>	
	</div>
</div> 
<!------------------------------------------------ -->
<div class="panel panel-default">	
	<div class="panel-heading"   data-icon="plus">		
	<h4 class="panel-title active">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-3" >How do I BLOCK/UN-BLOCK my scheduler?</a>         </h4>       
	</div>       
	<div class="panel-collapse collapse out"  id="ans-3">            
		 <div class="panel-body">
		Click Scheduler menu. Click the "Block" button at the appointment slot you would like to block. Click the "Cancel" button at the appointment slot you would like unblock. <br>
		<u>Remark</u> : To Unblock or Cancel One-on-One meetings use the "Cancel" button.
		</div>	
	</div>
</div> 
<!------------------------------------------------ -->
<div class="panel panel-default">	
	<div class="panel-heading"   data-icon="plus">		
	<h4 class="panel-title active">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-4" >What do the stars on Attendees List mean?</a>         </h4>       
	</div>       
	<div class="panel-collapse collapse out"  id="ans-4">            
		 <div class="panel-body">
		A Gold Star <img src="images/faq/gold_star.jpg"  /> in front of a name indicates 100% attendance for all pre-scheduled meeting appointments at previous conferences.
		</div>	
	</div>
</div> 
<!------------------------------------------------ -->
<div class="panel panel-default">	
	<div class="panel-heading"   data-icon="plus">		
	<h4 class="panel-title active">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-5" >What do the colors on Attendees List mean?</a>         
	</h4>       
	</div>       
	<div class="panel-collapse collapse out"  id="ans-5">            
		 <div class="panel-body">
		 The color shows which network(s) the company belongs to. See below for color chart. 
		 <br><br><img src="images/faq/network_color.jpg" width="99%" height="100%" border='0'  class='img-responsive' />
		</div>	
	</div>
</div> 
<!-----------One-on-One------------------------------------- -->
<!---------Account-------------------------------------- -->
<br>
<b><font size='3'><strong>Account</strong></font></b>
	<br><br>
<!---------Account-------------------------------------- -->
<div class="panel panel-default">	
	<div class="panel-heading">		
	<h4 class="panel-title active">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-6">How do I retrieve my password?</a>         </h4>       
	</div>       
	<div class="panel-collapse collapse out"  id="ans-6">            
		 <div class="panel-body">
			Go to Login page. Enter your email address and click on "FORGOT PASSWORD?". The system will send your username and password to the email address you entered.
		</div>	
	</div>
</div> 
<!------------------------------------------------ -->
<div class="panel panel-default">	
	<div class="panel-heading">		
	<h4 class="panel-title">			
		<a class="accordion-toggle collapsed"  data-toggle="collapse" data-parent="#faq" href="#ans-7">
		How do I change my password?</a>   
		</h4> 
	</div>       
	<div class="panel-collapse collapse out"  id="ans-7">            
<div class="panel-body">
	Go to Settings menu and input your current password, new password, and re-type new password. Click "Change Password" button. The system will show "Password Changed" and then bring up the Login page for you to Login with your new password.<br>
<u>Tip</u> : For higher security, please use a new password which incorporates as many as the below as possible :

 <table border="0" cellspacing="1" cellpadding="1"  class='table-responsive'>
              <tr>
                <td width="50%" valign="bottom" bgcolor="#CCCCCC" align='center'><strong>Character category</strong></td>
                <td width="50%" valign="bottom" bgcolor="#CCCCCC" align='center'><strong>Examples</strong></td>
              </tr>
              <tr>
                <td  valign="bottom" bgcolor="#FCE1FF">Uppercase letters</td>
                <td  valign="bottom" bgcolor="#FCE1FF">A, B, C</td>
              </tr>
              <tr>
                <td  valign="bottom" bgcolor="#FCE1FF">Lowercase letters</td>
                <td  valign="bottom" bgcolor="#FCE1FF">a, b, c</td>
              </tr>
              <tr>
                <td valign="bottom" bgcolor="#FCE1FF">Numbers</p></td>
                <td valign="bottom" bgcolor="#FCE1FF">0, 1, 2, 3, 4, 5, 6, 7, 8, 9</td>
              </tr>
            
            </table>
		</div>	
	</div>
</div> 
<!---------Other-------------------------------------- -->
<br>
<b><font size='3'><strong>Other</strong></font></b>
<br><br>
<!---------Account-------------------------------------- -->
<!------------------------------------------------ -->
<div class="panel panel-default">	
	<div class="panel-heading">		
	<h4 class="panel-title">			
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq" href="#ans-8">
		What is WCA's next conference?</a>         </h4>       
	</div>       
	<div class="panel-collapse collapse out" id="ans-8">
		 <div class="panel-body">
			Please click on "Event Calendar" menu. The system will display information for the next WCA related conference.
  
		</div>	
	</div>
</div> 
<!------------------------------------------------ -->

</div><!-- ./faq -->

<!------------------------------------------------ -->
    </div>
  </div><!-- ./panel-success -->
  

    
<?php }// End of display() ?>