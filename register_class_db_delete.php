<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
/*$class_name = substr($_GET["class_name"],0,strpos($_GET["class_name"],"-1"));



$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
echo "The URL of current page: ".$CurPageURL."<br>";
$sub=strpos($CurPageURL,"section=");
$section=substr($CurPageURL,$sub+8); */
$class_id=$_POST["class_id"];
$class_id_register="register_subject_".$class_id;
echo $class_id_register."<br>";
$class_id_register_generate="generate_".$class_id_register;
echo $class_id_register_generate;
$class_name=$_POST["class_name"];
$section=$_POST["section"];
$class_incharge="2020_".$_POST["class_incharge"];

echo $class_name."<br>";
echo $section."<br>";
		
if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	
	if(mysqli_query($conn,"delete from register_class where Class_name=\"$class_name\" AND Section=\"$section\"")==1)
	{echo "<script>alert('Data Deleted');</script>";}
	else{echo "<script>alert('Data Not Deleted');</script>";}
	echo strtolower($class_incharge);
	
	mysqli_query($conn,"drop table $class_incharge");
	mysqli_query($conn,"drop table $class_id_register");
	mysqli_query($conn,"drop table $class_id_register_generate");
	header("location:register_class.php");

?>