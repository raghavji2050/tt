<html>
<head>
<title>Teacher Registration</title>

</head>
<body>
<table>
<form method="post" action="teacher_registration_db.php" >
<tr><td>Teacher ID</td><td><input type="text" name="teacher_id" required></td></tr>
<tr><td>Name</td><td><input type="text" name="teacher_name" required></td></tr>
<tr><td>Class</td><td>
<?php
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
mysqli_select_db($conn,"time_table");
$sql="select Class_name from register_class";
$result=mysqli_query($conn,$sql);
echo "<select name='class_name'>";
while($row=mysqli_fetch_array($result))
{
echo "<option value=\"$row[Class_name]\">";
echo $row["Class_name"];
echo "</option>";
}
echo "</select>";
?>
</td></tr>
<tr><td>Subject</td><td>
<select name="course_name">

</select>
</td></tr>
<tr><td>Incharge</td><td><input type="text" name="class_incharge"></td></tr>
<tr><td>Duration in College</td></tr>
<tr><td>From</td><td><input type="time" name="duration_from" min="08:30" max="16:00" required></td></tr>
<tr><td>To</td><td><input type="time" name="duration_to" min="08:30" max="16:00" required></td></tr>
<tr><td><input type="submit" name="submit" Value="Enter in Record"></td></tr>
</form>
</table>
</body>
</html>