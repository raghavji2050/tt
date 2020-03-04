<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ERROR | E_PARSE);


$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
mysqli_select_db($conn,"time_table");
$sql="select * from duration_info";
$result=mysqli_query($conn,$sql);
echo "<table style='color:black; text-decoration:none; font-size:20px; ' align='center' cellspacing='30'>";
echo "<tr>";
while($row=mysqli_fetch_array($result))
{

echo "<td>".$row['Class_name']."</td>";
echo "<td>".$row['Semester']."</td>";
echo "<td>";
echo "<a href='register_class_db_delete.php?class_name=$row[Class_name]'>";
echo "Delete"."</a>";
echo "</td>";

}
echo "</tr>";
?>
