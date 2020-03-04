<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
if(isset($_POST['submit']))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$class_name = strtoupper($_POST["class_name"]);
		$section=strtoupper($_POST["section"]);
		$class_incharge=strtoupper($_POST["class_incharge"]);
echo $class_name."<br>";		
echo $section."<br>";
$id="2020_".$class_name."_".$section;
$teacher_id="2020_".$class_incharge;
echo $teacher_id;
}
if(mysqli_query($conn,"use time_table")==0)
	{
		if(mysqli_query($conn,"create database time_table")==1){echo "Database Created";}
		else{echo "Database Creation Error";}
	}
	
	mysqli_query($conn,"create table register_class(Class_id varchar(10) primary key,Class_name varchar(20), Section varchar(5), Class_incharge varchar(50))");
	if(mysqli_query($conn,"insert into register_class values(\"$id\",\"$class_name\",\"$section\",\"$class_incharge\")")==1)
	{echo "<script>alert('Data Inserted');</script>";}
	else{echo "<script>alert('Data Not Inserted');</script>";}
	
	
	
	mysqli_query($conn,"create table $teacher_id(Day varchar(10),Period varchar(10),Available int)");
	$day=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

	$temp=0;
	for($i=0;$i<6;$i++)
	{	
	$sql="select Class_type from duration_info";
	$result=mysqli_query($conn,$sql);
		$temp=1;
		while($row=mysqli_fetch_array($result))
		{
			if($row['Class_type']=="PERIOD")
			{
				if(mysqli_query($conn,"insert into $teacher_id values(\"$day[$i]\",\"PERIOD.$temp\",1)")==1)
				{echo "<script>alert('Data Inserted');</script>";}
				else{echo "<script>alert('Data Not Inserted');</script>";}
				$temp++;
			}
			
		}
	}	
	header("location:register_class.php");
}
?>