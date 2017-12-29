<?php

function getPageTitle($pagename='') {
	$pagetitle = '';
	
	switch ($pagename) {
		case 'aboutus':
			$pagetitle = 'About Us';
		break;
		case 'agenda':
			$pagetitle= 'Agenda';
		break;
		case 'venue':
			$pagetitle = 'Venue';
		break;	
		case 'contact':
			$pagetitle= 'Contact';
		break;
		case 'shutterbus_awe':
			$pagetitle = 'Shutterbus';
		break;
		case 'floor_detail':
			$pagetitle= 'Booths';
		break;	
		case 'sponsor':
			$pagetitle= 'Sponsor';
		break;									
	}
	
	return $pagetitle;
}

?>