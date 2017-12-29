<?php require_once('inc_pagetitle.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo getPageTitle($_SESSION['pagetitle']);?></title>
    <link href="../../../public_lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/default_agenda.css?v=<?php echo rand(5, 15);?>" rel="stylesheet" />
    <link type="text/css" href="css/media_queries.css?v=<?php echo rand(5, 15);?>" rel="stylesheet" media="screen" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="../../../public_lib/bootstrap/js/jquery-1.11.1.min.js"></script>	

	
	

  </head>
  <body>
  
	<div class="container-fluid main_bg">
		<div class="row-fluid">
			<div class="span12 bg_fade">
				
				<div id="main_content_wrapper" class="container">
				<!-- Start Main Content Section -->
				<!--<div class="content_wrapper">	-->			
                	<!--<div id="logo_mainbox" class="logo_mainbox"></div>-->
					<div id="main_content" class="main_content">					                                                          
					<?php display() ?>	
                    <div class="clear"></div>				
					</div><!-- ./main_content -->
					
				<!--</div><!-- ./content_wrapper -->

				</div><!-- ./container -->
				<!-- End Main Content Section -->

			</div>
		</div>
	</div>
    <script type="text/javascript" src="../../../public_lib/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
