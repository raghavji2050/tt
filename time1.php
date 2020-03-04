<?php
function timeformat($timenow)
{
		$hour=substr($timenow,0,2);
		$minute=substr($timenow,3,2);
		$seconds=substr($timenow,6,2);
	return date("d-m-y H:i:s",mktime($hour,$minute,$seconds,1,1,2000));
}
function timedisplay($timenow,$abc){return date("d-m-y H:i:s",$timenow+"00:45:00");}
$a="10:30:00";
$b="00:45:00";
$t1=timeformat($a);
$t2=timeformat($b);
echo $t1."<br>";
echo $t2."<br>";
echo timedisplay($t1,$t2);
?>