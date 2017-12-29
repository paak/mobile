<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//--------------------------------------------------------------------------------------------------------------------------------------//
//checkHTTPS();
//--------------------------------------------------------------------------------------------------------------------------------------//
?>
<?php
$_SESSION['pagetitle'] = 'venue';
require_once('template/layout.php');
?>
<?php function display() { 
	global $MEETING_ID;	
?>
   <!-- ------------------------------------------------------------------------------------------------------ -->
<?php  if ($MEETING_ID =="WCAS" || $MEETING_ID =="WCAFS"){ ?>

  <div class="panel panel-success">
  
    <div class="panel-heading">
      <h1 class="panel-title page_title">	EVENT LOCATION</h1>
    </div>
    <div class="panel-body">
    
        <div class="paragraph">

		  <h2 class="body_title"> PAN PACIFIC SIGNAGPORE HOTEL</h2>
			<b><font color='green'>(WCA First Conference during 1st - 4th Mar 2018)</font></b>
			<br />Address:	7 Raffles Blvd, Singapore 039595
			<br />Phone: +65 6336 8111
			
			<p>

      <h2 class="body_title"> SUNTEC, SINGAPORE</h2>
			<b><font color='blue'>(Combined with WCA Worldwide Conference during 4th -5th Mar 2018)</font></b>
			<br />Address:	1 Raffles Boulevard, Suntec City, <br />Singapore 039593
			<br />Tel: +(65) 6337 2888
			<br /><a href='http://www.suntecsingapore.com' target='_blank'>www.suntecsingapore.com</a>
			<br /><br /><img src='images/map/Map_Suntec.jpg' border='1'    class='img-responsive' style="border:1px solid #999999;" > 
        </div>

				
			<br />
       
    </div><!-- ./panel-body -->
  </div>
<?php } //end if ?>
 
   <!-- ------------------------------------------------------------------------------------------------------ -->
<?php  if ($MEETING_ID =="GAA"){ ?>
 <div class="panel panel-success">
  
    <div class="panel-heading">
      <h1 class="panel-title page_title"><font color='#993333'>Event Location</font></h1>
    </div>
    <div class="panel-body">
    
        <div class="paragraph">
            <h2 class="body_title">Sofitel Abu Dhabi Corniche Hotel</h2>
			<br />Address:	Corniche East Road - PO Box 44966
			<br />Abu Dhabi, United Arab Emirates
			<br />Tel: +971 2 813 7862 Fax: +971 2 813 7799
        </div>
        
     
        <div id="locationmap_mainbox" style="display: block;width: 100%;height:500px;">
        
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script type="text/javascript">
        function initialize() {
            var shape = {
              coords: [1, 1, 1, 20, 18, 20, 18 , 1],
              type: 'poly'
            };

            var mapOptions = {
              center: new google.maps.LatLng(24.498983,54.367451),

              zoom: 15,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
        
        
              // MAP CONTROLS (START)
              mapTypeControl: true,
        
              panControl: true,
              panControlOptions: {
              position: google.maps.ControlPosition.TOP_RIGHT
              },
        
              zoomControl: true,
              zoomControlOptions: {
              style: google.maps.ZoomControlStyle.LARGE,
              position: google.maps.ControlPosition.LEFT_TOP
              },
        
              streetViewControl: true,
              streetViewControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
              },
              // MAP CONTROLS (END)
        
        
        
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
                mapOptions);
        
        
            // -------------- MARKER 1 - 
            var image = 'images/icon_markpoint.png';
            var marker1 = new google.maps.Marker({
			position: new google.maps.LatLng(24.498983,54.367451),

            map: map,
            shape: shape,
            title: 'Sofitel Abu Dhabi Corniche Hotel',
            icon: image
            });
   
            // MARKER 1'S INFO WINDOW
            var infowindow1 = new google.maps.InfoWindow({
            content: 
            '<div class="map_info" style="font-weight:bold;">'+
              '<span class="body_title">Address:	Corniche East Road � PO Box 44966 </span><br />'+
              'Abu Dhabi, United Arab Emirates<br />'+
			  'Tel: +971 2 813 7862 Fax: +971 2 813 7799'+
              '</div>'	
            });
            // End of infowindow code
        
            // Adding a click event to the marker
            google.maps.event.addListener(marker1, 'mouseover', function() {
            // Calling the open method of the infoWindow
            infowindow1.open(map, marker1);
            });
            // -------- END OF 1st MARKER
        
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        
        <div id="map-canvas" style="height:100%;margin:0px;padding:0px"></div>
        
        </div><!-- ./locationmap_mainbox -->
    
    </div><!-- ./panel-body -->
  </div>

<?php } //end if ?>
   <!-- ------------------------------------------------------------------------------------------------------ -->
<?php  if ($MEETING_ID =="LOGNET"){ ?>
 <div class="panel panel-success">
  
    <div class="panel-heading">
      <h1 class="panel-title page_title"><font color='#993333'>Event Location</font></h1>
    </div>
    <div class="panel-body">
    
        <div class="paragraph">
            <h2 class="body_title">Sheraton Saigon Hotel And Towers</h2>
			Address:	88 Dong Khoi Street District 1
			<br /> Ho Chi Minh City,Vietnam
			<br />Tel:+84 (8) 3 827 2828 Fax: +84 (8) 3 827 2929
        </div>
        
     
        <div id="locationmap_mainbox" style="display: block;width: 100%;height:500px;">
        
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script type="text/javascript">
        function initialize() {
            var shape = {
              coords: [1, 1, 1, 20, 18, 20, 18 , 1],
              type: 'poly'
            };

            var mapOptions = {
              center: new google.maps.LatLng(1.2937,106.704132),

              zoom: 15,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
        
        
              // MAP CONTROLS (START)
              mapTypeControl: true,
        
              panControl: true,
              panControlOptions: {
              position: google.maps.ControlPosition.TOP_RIGHT
              },
        
              zoomControl: true,
              zoomControlOptions: {
              style: google.maps.ZoomControlStyle.LARGE,
              position: google.maps.ControlPosition.LEFT_TOP
              },
        
              streetViewControl: true,
              streetViewControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
              },
              // MAP CONTROLS (END)
        
        
        
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
                mapOptions);
        
        
            // -------------- MARKER 1 - 
            var image = 'images/icon_markpoint.png';
            var marker1 = new google.maps.Marker({
			position: new google.maps.LatLng(10.775743,106.704132),
            map: map,
            shape: shape,
            title: 'Sheraton Saigon Hotel And Towers',
            icon: image
            });
   
            // MARKER 1'S INFO WINDOW
            var infowindow1 = new google.maps.InfoWindow({
            content: 
            '<div class="map_info" style="font-weight:bold;">'+
              '<span class="body_title">Address:	88 Dong Khoi Street District 1 </span><br />'+
              'Ho Chi Minh City Vietnam<br />'+
			  'Tel: +84 (8) 3 827 2828 Fax: +84 (8) 3 827 2929'+
              '</div>'	
            });
            // End of infowindow code
        
            // Adding a click event to the marker
            google.maps.event.addListener(marker1, 'mouseover', function() {
            // Calling the open method of the infoWindow
            infowindow1.open(map, marker1);
            });
            // -------- END OF 1st MARKER
        
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        
        <div id="map-canvas" style="height:100%;margin:0px;padding:0px"></div>
        
        </div><!-- ./locationmap_mainbox -->
    
    </div><!-- ./panel-body -->
  </div>
<?php } //end if ?>
   <!-- ------------------------------------------------------------------------------------------------------ -->
<?php  if ($MEETING_ID =="SINO"){ ?>
  <div class="panel panel-success">
  
    <div class="panel-heading">
      <h1 class="panel-title page_title"><font color='#993333'>Event Location</font></h1>
    </div>
    <div class="panel-body">
    
        <div class="paragraph">
            <h2 class="body_title">SUNTEC, SINGAPORE</h2>
			<br />Address: 1 Raffles Boulevard, Suntec City, Singapore 039593
			<br />Phone:+86 21 6029 0070
			<br />Website: <a href='www.suntecsingapore.com' target='_blank'>www.suntecsingapore.com</a>
			<br />Tel:  +(65) 6337 2888
			
		

			<br /><br />
			<img src='images/map/Map.png' border='0'  class='img-responsive'> 
		

			<br />
        </div>
        

	
        
    

    </div><!-- ./panel-body -->
  </div>
<?php } //end if ?>
   <!-- ------------------------------------------------------------------------------------------------------ -->
       <!-- ------------------------------------------------------------------------------------------------------ -->
<?php  if ($MEETING_ID =="WCAPN"){ ?>
  <div class="panel panel-success">
  
    <div class="panel-heading">
      <h1 class="panel-title page_title">Event Location</h1>
    </div>
    <div class="panel-body">
    
        <div class="paragraph">
            <h2 class="body_title"> Altis Grand Hotel</h2>
			<br />Address: R. Castilho 11, 1269-072 Lisboa, Portugal
			Phone:+351 21 310 6000<br />
			Website: <a href='http://www.altishotels.com/EN/HotelAltisLisboa/Hotel-Lisbon' target='_blank'>Hotel Website</a><br />
        </div>
        
        <div id="locationmap_mainbox" style="display: block;width: 100%;height:500px;">
        
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script type="text/javascript">
        function initialize() {
            var shape = {
              coords: [1, 1, 1, 20, 18, 20, 18 , 1],
              type: 'poly'
            };

            var mapOptions = {
              center: new google.maps.LatLng(38.722363,-9.149612),

              zoom: 15,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
        
        
              // MAP CONTROLS (START)
              mapTypeControl: true,
        
              panControl: true,
              panControlOptions: {
              position: google.maps.ControlPosition.TOP_RIGHT
              },
        
              zoomControl: true,
              zoomControlOptions: {
              style: google.maps.ZoomControlStyle.LARGE,
              position: google.maps.ControlPosition.LEFT_TOP
              },
        
              streetViewControl: true,
              streetViewControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
              },
              // MAP CONTROLS (END)
        
        
        
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
                mapOptions);
        
        
            // -------------- MARKER 1 - AsiaWorld-Expo
            var image = 'images/icon_markpoint.png';
            var marker1 = new google.maps.Marker({
			position: new google.maps.LatLng(38.722363,-9.149612),

            map: map,
            shape: shape,
            title: ' Altis Grand Hotel ',
            icon: image
            });
   

        
            // MARKER 1'S INFO WINDOW
            var infowindow1 = new google.maps.InfoWindow({
            content: 
            '<div class="map_info" style="font-weight:bold;">'+
              '<span class="body_title">Address: R. Castilho 11, 1269-072 Lisboa, Portugal</span><br />'+
              'Phone:+351 21 310 6000<br />'+
              '</div>'	
            });
            // End of infowindow code
        
            // Adding a click event to the marker
            google.maps.event.addListener(marker1, 'mouseover', function() {
            // Calling the open method of the infoWindow
            infowindow1.open(map, marker1);
            });
            // -------- END OF 1st MARKER
        
        
           
        
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        
        <div id="map-canvas" style="height:100%;margin:0px;padding:0px"></div>
        
        </div><!-- ./locationmap_mainbox -->
    
    </div><!-- ./panel-body -->
  </div>
<?php } //end if ?>
<?php }// End of display() ?>    