<?php 
include("include/DBconfig.php");
include("include/lib_question.php");
include("include/session.php");
//------------------------------------------------
$SID = protect_quote_q($_GET['SID']); 

//--conect db--*/
$mssql=connect_DB_MSSQL();
$table_Question = "QN_WCAFIRST2016_Question";
$table_QuestionAnswer = "QN_WCAFIRST2016_QAnswer";

//--------Question---------------------------------------
$SQL_Question="SELECT QID,QText,QTextCN,QNumberDisplay,Qsub,OrderNo FROM ".$table_Question."  where QID in (select QID from  ".$table_QuestionAnswer.")  order by OrderNo asc ";
$result=mssql_query($SQL_Question,$mssql);
$row=mssql_num_rows($result); 
		if($row>0){
		$i=0;
		while ($row = mssql_fetch_object($result)){	
					$QArray[$i]['QID'] =(int)$row->QID;
					$QArray[$i]['QText'] =$row->QText;

					if ($row->Qsub <> ""){
						$ShowMainQuestion = GetMainQuestion($row->Qsub);
						$QArray[$i]['QText'] =$ShowMainQuestion." ".$QArray[$i]['QText'];
					}else{
						$QArray[$i]['QText'] =$row->QText;
					}

					$QArray[$i]['QNumberDisplay'] =$row->QNumberDisplay;

					$SQL_Answer="SELECT AnswerID,t2.QID,AnswerValue,AnswerText,AnswerType,SkipToQID
					FROM ".$table_QuestionAnswer." t1 inner join ".$table_Question." t2 on t1.QID = t2.QID
					where t2.QID in (".$QArray[$i]['QID'].") order by t2.OrderNo  asc ";

					$resultAns=mssql_query($SQL_Answer,$mssql);
					$rowAns=mssql_num_rows($resultAns); 
					if($rowAns>0){
						$j=0;
						while ($rowAns = mssql_fetch_object($resultAns)) {
							$AnsArray[$j]['AnswerValue']=$rowAns->AnswerValue;
							$AnsArray[$j]['AnswerDisplay']=$rowAns->AnswerText;
							$AnsArray[$j]['AnswerType']=$rowAns->AnswerType;
							$AnsArray[$j]['SkipToQID']=$rowAns->SkipToQID;
							$j=$j+1;
						}
						$QArray[$i]['answer'] =$AnsArray;
					}else{
						$array = array();
						$QArray[$i]['answer'] =$array;
					}//end if

				
					$AnsArray="";

					$i=$i+1;

					$ShowMainQuestion ="";
			}//end while
		}//end if 



/*echo "<pre>";
var_dump($QArray);
die();*/


echo json_encode($QArray);

//------------------------------------------

mssql_close();

?>