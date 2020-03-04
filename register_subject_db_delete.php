<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
/*echo  "<script>alert($_GET[subject_name])</script>";
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
echo "The URL of current page: ".$CurPageURL."<br>";
$sub=strpos($CurPageURL,"=");
$subject_name=substr($CurPageURL,$sub+1); 
*/
$class_id=$_POST["class_id"];
$table_name="register_subject_".$class_id;
//echo $table_name;
$subject_name=$_POST["subject_name"];
$url=$_POST["url"];
echo $subject_name;

if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	
	if(mysqli_query($conn,"delete from $table_name where Subject_name=\"$subject_name\" ")==1)
	{echo "<script>alert('Data Deleted');</script>";}
	else{echo "<script>alert('Data Not Deleted');</script>";}
	header("location:$url");

?>