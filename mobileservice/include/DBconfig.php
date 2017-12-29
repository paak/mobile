<?php 
//-------ConferenceConfig--------------------------//
/*$DBhost="localhost";
$DBuser="access1";
$DBpasswd="4accessDB";
$DBname="meeting_WCAworld2018"; */
//-----------------------------------------//
$DBhost="conferencedev.culih2elk3jw.ap-southeast-1.rds.amazonaws.com";
$DBuser="user1";
$DBpasswd="4conferenceDB";
$DBname="dev_meeting_wcaworld2018"; 
//-----------------------------------------------------------------------------------------------------------------------------
function connect_DB(){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;

	if(!$mysql) {
		if(!($mysql=mysql_connect($DBhost,$DBuser,$DBpasswd))) {
				print "Error to connect mysql!.";
				die;
		}
		if(!mysql_select_db($DBname)){
				print "Error : select DB ";
				die;
		}
	}
}
//-------EventConfig--------------------------//

//---event----
$DBhost_event="localhost";
$DBuser_event="access1";
$DBpasswd_event="4accessDB";
$DBname_event="conferenceDB"; 


//---------------
function connect_DB_Event(){
	global $DBhost_event;
	global $DBuser_event;
	global $DBpasswd_event;
	global $DBname_event;
	global $mysql_event;

	if(!$mysql_event) {
		if(!($mysql_event=mysql_connect($DBhost_event,$DBuser_event,$DBpasswd_event))) {
				print "Error to connect mysql!.";
				die;
		}
		if(!mysql_select_db($DBname_event)){
				print "Error : select DB ";
				die;
		}
	}
}
//-------MSSQLConfig--------------------------//

//------Production-------------------
$G_MSSQL_username="QN2013";
$G_MSSQL_password="R8hqnBs51a";
$G_MSSQL_DB="QN_DB";
//---------------------------------

$G_MSSQL_host="172.16.172.184";

//------------------------------------------------
function connect_DB_MSSQL(){

    global $G_MSSQL_host;
	global $G_MSSQL_username;
	global $G_MSSQL_password;
	global $G_MSSQL_DB;
	global $mssql;

	if(!$mssql) {
		if(!($mssql=mssql_connect($G_MSSQL_host,$G_MSSQL_username,$G_MSSQL_password))) {
				print "Error to connect mssql!.";
				die;
		}
		if(!mssql_select_db($G_MSSQL_DB)){
				print "Error : select DB ";
				die;
		}
	}

	return $mssql;
}
//------------------------------------------------------
function connect_DB_ConfNoti($chkdbname){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $mysql_noti;

	if(!$mysql_noti) {
		if(!($mysql_noti=mysql_connect($DBhost,$DBuser,$DBpasswd))) {
				print "Error to connect mysql!.";
				die;
		}
		
		if(!mysql_select_db($chkdbname,$mysql_noti)){
				print "Error : select DB ";
				die;
		}
	}
}//end func
//------------------------------------------
?>