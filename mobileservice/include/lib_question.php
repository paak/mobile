<?php
function protect_quote_q($str){
	$ret = addslashes($str);
	$ret = str_replace("'","`", $ret);
	$ret = str_replace("<b>","", $ret);
	$ret = str_replace("</b>","", $ret);
	$ret = str_replace("<u>","", $ret);
	$ret = str_replace("</u>","", $ret);
	$ret = str_replace("<i>","", $ret);
	$ret = str_replace("</i>","", $ret);
	return $ret;
}
//---Fuction GetMainQuestion-------------
Function GetMainQuestion($Qsub){
	global $mssql;
	global $table_Question;
	$SQL="SELECT QID,QText,QNumberDisplay  FROM ".$table_Question." where QID =".$Qsub." ";
	$result1=mssql_query($SQL,$mssql);
	$row1=mssql_num_rows($result1); 
		if($row1>0){
		$i=0;
		while ($row1 = mssql_fetch_object($result1)){	
					$QNumberDisplay =$row1->QNumberDisplay;
					$MainQText =$QNumberDisplay.".".$row1->QText;
		}//while
	}// if

	return $MainQText;

} //end  function
//---Fuction GetMainQuestion-------------

?>