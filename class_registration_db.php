<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
if(isset($_POST['submit']))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$class_id = $_POST["class_id"];
		$class_year = $_POST["class_year"];
		$class_semester =$_POST["class_semester"];
		$class_strength =$_POST["class_strength"];
		$class_minimum = $_POST["class_minimum"];
		$class_maximum = $_POST["class_maximum"];
echo $class_id."<br>";		
echo $class_year."<br>";
echo $class_semester."<br>";		
echo $class_strength."<br>";
echo $class_minimum."<br>";
echo $class_maximum."<br>";		
}
if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	mysqli_query($conn,"create table class_registration(Class_id varchar(10) primary key,Class_year int,Class_Semester int,Class_strength int,class_minimum int,class_maximum int)");
	if(mysqli_query($conn,"insert into class_registration values(\"$class_id\",\"$class_year\",\"$class_semester\",\"$class_strength\",\"$class_minimum\",\"$class_maximum\")")==1)
	{echo "Data Inserted";}
	else{echo "Data Not Inserted";}
}
?>