<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
if(isset($_POST['submit']))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$teacher_id = trim($_POST["teacher_id"]);
		$teacher_name = trim($_POST["teacher_name"]);
		$course_name = trim($_POST["course_name"]);
		$class_name = trim($_POST["class_name"]);
		$class_incharge = trim($_POST["class_incharge"]);
		$duration_from = $_POST["duration_from"];
		$duration_to = $_POST["duration_to"];
echo $teacher_id."<br>";		
echo $teacher_name."<br>";
echo $course_name."<br>";		
echo $class_name."<br>";
echo $class_incharge."<br>";
echo $duration_from."<br>";		
echo $duration_to."<br>";
}
if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	//mysqli_query($conn,"create table teacher_registration(Teacher_id varchar(10) primary key,Teacher_name varchar(50),Course_name varchar(30),Class_name varchar(30),class_incharge varchar(30),Duration_from time, Duration_to time)");
	if(mysqli_query($conn,"insert into teacher_registration values(\"$teacher_id\",\"$teacher_name\",\"$course_name\",\"$class_name\",\"$class_incharge\",\"$duration_from\",\"$duration_to\")")==1)
	{echo "Data Inserted";}
	else{echo "Data Not Inserted";}
}
?>