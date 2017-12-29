<?php
//-------MSSQLConfig--------------------------//

//------Production-------------------
$G_MSSQL_username_event="wcadblive";
$G_MSSQL_password_event="w2RjMd53Ka";
$G_MSSQL_DB_event="wcaadmin";
//---------------------------------

$G_MSSQL_host_event="172.16.172.184";

//------------------------------------------------
function connect_DB_MSSQL_Event(){

    global $G_MSSQL_host_event;
	global $G_MSSQL_username_event;
	global $G_MSSQL_password_event;
	global $G_MSSQL_DB_event;
	global $mssql_event;

	if(!$mssql_event) {
		if(!($mssql_event=mssql_connect($G_MSSQL_host_event,$G_MSSQL_username_event,$G_MSSQL_password_event))) {
				print "Error to connect mssql!.";
				die;
		}
		if(!mssql_select_db($G_MSSQL_DB_event)){
				print "Error : select DB ";
				die;
		}
	}

	return $mssql_event;
}

//------------------------------------------------
?>