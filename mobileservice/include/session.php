<?php 
//time expire is timeout number from create time (1 time_expire = 1 second)
// require : include("./include/DBconfig.php"); for function connect_DB()

$SID_TIME_EXPIRE = 19200; // 3600 =1 ªÁ
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function create_session($variable_name ,$value , $time_expire)
{
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;

	connect_DB();
	$survival_time = $time_expire + time(); 
	$session_ID =  time().rand(1000,9999).str_replace(".","0",$REMOTE_ADDR); 
	$SQL = "insert into session(ID , s_name,s_value,survival_time,time_expire) values('$session_ID','$variable_name','$value',$survival_time,'$time_expire');";
	if($result=mysql_db_query($DBname,$SQL)){
					$ret = $session_ID;
	} else {
					$ret = 0;
	}
	return $ret;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//if you check variable by check_session() , all variable at same ID will update time expire
function check_session($session_ID,$variable_name)
{
	global $DBhost;
	global $DBuser; 
	global $DBpasswd;
	global $DBname;
	global $mysql;

	connect_DB();
	$SQL ="delete from session where survival_time < ".time();
	$result=mysql_query($SQL);

	$SQL = "select s_value, time_expire from session where ID='$session_ID' and s_name = '$variable_name';";
	$ret = 0;
	if($result=mysql_query($SQL)){
			if($row=mysql_fetch_object($result)){
				$ret = $row->s_value;
				$survival_time = time()+ $row->time_expire;
				$SQL = "update session SET survival_time = $survival_time where ID= '$session_ID'";
				if( !($x= mysql_query($SQL))){
						print "Error : update session";
						die;
				}
			}
	}
	return $ret;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//kill_session() for kill all variable of ID 
function kill_session($session_ID)
{
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;

	connect_DB();
	$SQL ="delete from session where ID = $session_ID";
	if($result=mysql_query($SQL)) {
					$ret = 1;
	} else	{
					$ret = 0;
	}
	return $ret;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//if you want to more security ,you must check session ID before add session 
//add_session is create session same ID different  variable , if ID not create return errror!
// add_session( ) don't update time expire ,if you want to update use check_session
function add_session($session_ID , $variable_name ,$value)
{
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;

	connect_DB();
	$SQL = "select survival_time , time_expire from session where ID='$session_ID'";
	$ret = 0;
	if($result=mysql_query($SQL)){
			if($row=mysql_fetch_object($result)){
				$survival_time = time()+ $row->time_expire;
			}else return 0;
	}else return 0;


	$time_expire = $row->time_expire;
	$survival_time = $row->survival_time;

	$SQL = "update session set s_value='$value' where ID='$session_ID' and s_name='$variable_name' ";
	$result=mysql_query($SQL);

	if( mysql_affected_rows($mysql) <1 ){
		$SQL = "insert into session(ID , s_name,s_value,survival_time,time_expire) values('$session_ID','$variable_name','$value',$survival_time,'$time_expire');";
		$result=mysql_query($SQL);
		if($result)
				return $session_ID;
		else 
				return 0;
	}else return $session_ID;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function remove_session($session_ID , $variable_name){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;

	connect_DB();
	$SQL = "delete from session where ID='$session_ID' and s_name='$variable_name' ";
	$result=mysql_query($SQL);
	if(($ret=mysql_affected_rows($mysql) )<1 )
				return 0;
	else 
				return $ret;
}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

/*
CREATE TABLE session(
	ID varchar(30) NOT NULL,
	s_name varchar(30) NOT NULL,
	s_value varchar(255) ,
	survival_time bigint  NOT NULL,
	time_expire int  NOT NULL,
	primary key(ID,s_name),
	index(survival_time)
);
*/
?>