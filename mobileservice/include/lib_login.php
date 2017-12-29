<?php
//--------------------------
function CheckSuspended($compid){
							$SQL_Suspended="select companyid from meeting_photo.company_terminate where companyid  =".$compid."";
							$result= get_obj_info($SQL_Suspended, array("companyid"));
							if (count($result)>0) {$FlagSuspended ="true";
							}else{$FlagSuspended ="false";}
							return $FlagSuspended;
}//function
//--------------------------