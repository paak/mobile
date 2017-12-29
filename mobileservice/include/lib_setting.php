<?php

//----Phase4-------------
//--1.Forogt password :send_mailer_forgotpwd
//--2.Chnage password :IsSpecialChar ,valid_pass,Change1on1Password
//---------------------------
//----------------------------------------------//
function IsSpecialChar($mystring){
	if (preg_match("/'/", $mystring) || preg_match("/>/", $mystring) || preg_match("/</", $mystring) ||strpos($mystring, ' ') > 0) {
		 return "true";
	} else {
		 return "false";
	}
}//end fun
//----------------------------------------------//
function valid_pass($candidate) {
   $r1='/[A-Z]/';  //Uppercase
   $r2='/[a-z]/';  //lowercase
   $r3='/[0-9]/';  //numbers
   //$r4='/[!%&@#$^*?_~=]/';  // whatever you mean by 'special char' ; Not use :08/09/2015


   $strength =0;

  if(strlen($candidate) < 8) {
	   $strength=0;   //too short
  }else{
	 /*if(strlen($candidate) >7 )  $strength=$strength+1;*/

	  if(preg_match_all($r1,$candidate, $o)>0 || preg_match_all($r2,$candidate, $o)>0 || preg_match_all($r3,$candidate, $o)>0) {							$strength=$strength+1; //weak
	  }

	  if(preg_match_all($r1,$candidate, $o)>0 && preg_match_all($r3,$candidate, $o)>0 ) {							
		  $strength=$strength+1; //Good
	  }

	  if(preg_match_all($r2,$candidate, $o)>0 && preg_match_all($r3,$candidate, $o)>0 ) {							
		  $strength=$strength+1; //Good
	  }

	  if(preg_match_all($r1,$candidate, $o)>0 && preg_match_all($r2,$candidate, $o)>0 && preg_match_all($r3,$candidate, $o)>0  ) {						
		  $strength=$strength+1; //Strong
	  }


	 //if(preg_match_all($r4,$candidate, $o)>0)  $strength=$strength+1;
	}

    return $strength;

}//end func
//------------------------------------------------------------------
function Change1on1Password($memid,$compid,$newpwd){
	global $DBhost;
	global $DBuser;
	global $DBpasswd;
	global $DBname;
	global $mysql;
	global $HTTP_SERVER_VARS;
	//newpwd max len : 20 chars

	connect_DB();

	$SQL = "update memmeet set password ='".$newpwd."' where memid =".$memid." and compid =".$compid."";
	
	if(!($result=mysql_query($SQL))){
		$flagUpdate=false;
	}else{
		$flagUpdate=true;
	}
	return $flagUpdate;
}//end function
//-------------------------------------------------------------
?>