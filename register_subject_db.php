<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
if(isset($_POST['submit']))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$subject_name = strtoupper($_POST["subject_name"]);
		$class_id=$_POST["class_id"];
		$class_name=$_POST["class_name"];
		$section= $_POST["section"];
		$class_incharge=$_POST["class_incharge"];
		$url=$_POST["url"];
		$in_week=$_POST["in_week"];
		$in_day=$_POST["in_day"];
echo $subject_name."<br>";
echo $class_name."<br>";		
echo $section."<br>";
echo $class_incharge."<br>";
echo $class_id."<br>";
echo $url."<br>";
echo $in_week."<br>";
echo $in_day."<br>";
$table_name="register_subject_".$class_id;
echo $table_name;
}
if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	mysqli_query($conn,"create table $table_name (Class_id varchar(10),Subject_name varchar(20) primary key,Class_name varchar(20),Section varchar(2),Class_incharge varchar(50),In_week int,In_day int,In_week_temp int,In_day_temp int)");
	if(mysqli_query($conn,"insert into $table_name values(\"$class_id\",\"$subject_name\",\"$class_name\",\"$section\",\"$class_incharge\",\"$in_week\",\"$in_day\",\"$in_week\",\"$in_day\")")==1)
	{echo "<script>alert('Data Inserted');</script>";}
	else{echo "<script>alert('Data Not Inserted');</script>";}
    header("location:$url");
}
?>