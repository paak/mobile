<?php
include("include/DBconfig.php");
include("include/lib.php");
include("include/session.php");
//---------------------------------------------------------------------------------------------------------------------------------------//
checkHTTPS();
//---------------------------------------------------------------------------------------------------------------------------------------//
checkSession($SID);
//---------------------------------------------------------------------------------------------------------------------------------------//
switch ($MEETING_ID) {
			//config : $url_ref in ID.php
		case "WCAS":
			/*$messageArray1 = array('id' => '1','name' => 'LEVEL 4', 
			'FloorImg' => ''.$url.'/images/floorplan/Level_4.png', 'URL' =>''.$url.'/floor_detail_level4.php','ImgWidth' =>'445','ImgHeight' =>'c',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level_4.png', 'URL' => ''.$url.'/floor_detail_level4.php','ImgWidthIpad' =>'820','ImgHeightIpad' =>'108');

			$messageArray2 = array('id' => '2','name' => 'LEVEL 3', 
			'FloorImg' => ''.$url.'/images/floorplan/Level_3.png', 'URL' =>''.$url.'/floor_detail_level3.php','ImgWidth' =>'445','ImgHeight' =>'445',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level_3.png', 'URL' => ''.$url.'/floor_detail_level3.php','ImgWidthIpad' =>'820','ImgHeightIpad' =>'108');

			echo json_encode(array($messageArray1,$messageArray2));*/

			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/11-12_Iphone_up.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'445','ImgHeight' =>'c',
			'FloorImgIpad' => ''.$url.'/images/floorplan/11-12March_ipad.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'820','ImgHeightIpad' =>'108');
			echo json_encode(array($messageArray1));

			break;
		case "WCAFS":
			
			/*$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level_4.png', 'URL' =>''.$url.'/floor_detail_level4.php','ImgWidth' =>'445','ImgHeight' =>'c',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level_4.png', 'URL' => ''.$url.'/floor_detail_level4.php','ImgWidthIpad' =>'820','ImgHeightIpad' =>'108');

			$messageArray2 = array('id' => '2','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level_3.png', 'URL' =>''.$url.'/floor_detail_level3.php','ImgWidth' =>'445','ImgHeight' =>'445',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level_3.png', 'URL' => ''.$url.'/floor_detail_level3.php','ImgWidthIpad' =>'820','ImgHeightIpad' =>'108');

			echo json_encode(array($messageArray1,$messageArray2));*/


			/*$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/11-12_Iphone_up.png', 'URL' =>''.$url.'/floor_detail_11_12.php','ImgWidth' =>'445','ImgHeight' =>'c',
			'FloorImgIpad' => ''.$url.'/images/floorplan/11-12March_ipad.png', 'URL' => ''.$url.'/floor_detail_11_12.php','ImgWidthIpad' =>'820','ImgHeightIpad' =>'108');
			echo json_encode(array($messageArray1));*/

			break;
		case "GAA":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;
	
		case "SINO":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;

			case "WCAPN":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;

			case "WSLF":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;

		

			case "LOGNET":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;

			case "SPECIALTY":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;

			case "AMERICAS":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;


			case "ECOM":
			$messageArray1 = array('id' => '1','name' => 'FLOOR PLAN', 
			'FloorImg' => ''.$url.'/images/floorplan/Level1.png', 'URL' =>''.$url.'/floor_detail.php','ImgWidth' =>'359','ImgHeight' =>'69',
			'FloorImgIpad' => ''.$url.'/images/floorplan/Level1.png', 'URL' => ''.$url.'/floor_detail.php','ImgWidthIpad' =>'359','ImgHeightIpad' =>'69');

			echo json_encode(array($messageArray1));

			break;
			
}//switch
//---------------------------------------------------------------------------------------------------------------------------------------//
?>