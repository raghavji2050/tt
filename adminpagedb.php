<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ERROR | E_PARSE);
		function timeformat($timenow)
{
		$hour=substr($timenow,0,2);
		$minute=substr($timenow,3,2);
		$seconds=substr($timenow,6,2);
	return date("H:i:s",mktime($hour,$minute,$seconds));
}






	function sum_the_time($time1, $time2) {
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }


include("dbconn.php");

if(isset($_POST['submit']))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$duration_from = timeformat($_POST["duration_from"]);
		$duration_to = timeformat($_POST["duration_to"]);
		$assembly_from = timeformat($_POST["assembly_from"]);
		$assembly_to = timeformat($_POST["assembly_to"]);
		$recess_from = timeformat($_POST["recess_from"]);
		$recess_to = timeformat($_POST["recess_to"]);
		$class_duration = date("H:i:s",mktime(0,$_POST["class_duration"],0));
echo $duration_from."<br>";		
echo $duration_to."<br>";
echo $assembly_from."<br>";		
echo $assembly_to."<br>";
echo $recess_from."<br>";
echo $recess_to."<br>";
echo $class_duration."<br>";		
}
if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	mysqli_select_db($conn,"time_table");
	$sql="select * from duration_info";
	$result=mysqli_query($conn,$sql);
	echo mysqli_num_rows($result);
	if(mysqli_num_rows($result)){
	mysqli_query($conn,"truncate duration_info");
	}
	$sql="select * from school_info";
	$result=mysqli_query($conn,$sql);
	echo mysqli_num_rows($result);
	if(mysqli_num_rows($result)){
	mysqli_query($conn,"truncate school_info");
	}
	if(mysqli_query($conn,"create table school_info(Duration_from time ,Duration_to time,Assembly_from time,Assembly_to time,Recess_from time,Recess_to time,Class_duration time)")==1)
	{echo "Table Created"."<br>";}
	else{echo "Table Not Created"."<br>";}
	if(mysqli_query($conn,"insert into school_info values(\"$duration_from\",\"$duration_to\",\"$assembly_from\",\"$assembly_to\",\"$recess_from\",\"$recess_to\",\"$class_duration\")")==1)
	{echo "Data Inserted"."<br>";}
	else{echo "Data Not Inserted"."<br>";}

}
mysqli_query($conn,"create table duration_info(Class_type varchar(10),Duration_from time ,Duration_to time)");
$end=$duration_to;
echo "End-->  ".strtotime($end)."<br>";
$type="";
while(1){
		if(strtotime(sum_the_time($duration_from,$class_duration))>strtotime($end)){ echo "<br> Duration_from-->  ".$duration_from."<br>".$end;break;}
		if(strtotime($duration_from)==strtotime($assembly_from)){ $type="ASSEMBLY"; $duration_to=$assembly_to;}
		else if(strtotime($duration_from)==strtotime($recess_from)){ $type="RECESS";   $duration_to=$recess_to;}
		else{ $type="PERIOD";
				$duration_to=sum_the_time($duration_from,$class_duration);
			}
			if(mysqli_query($conn,"insert into duration_info values(\"$type\",\"$duration_from\",\"$duration_to\")")==1)
				{echo "Data Inserted".$duration_from."<br>";}
		else{echo "Data Not Inserted"."<br>";}
		$duration_from=$duration_to;
}

header("Location:adminpage.php");
?>