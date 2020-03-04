<?php

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
//echo "The URL of current page: ".$CurPageURL."<br>";
$sub=strpos($CurPageURL,"class_id=");
$find=strpos($CurPageURL,"?",$sub);
$class_id=substr($CurPageURL,$sub+9,$find-($sub+9)); 
//echo $class_id."<br>";
$sub=strpos($CurPageURL,"class_name=");
$find=strpos($CurPageURL,"?",$sub);
$class_name=substr($CurPageURL,$sub+11,$find-($sub+11));
//echo $class_name."<br>";
$sub=strpos($CurPageURL,"section=");
$find=strpos($CurPageURL,"?",$sub);
$section=substr($CurPageURL,$sub+8,$find-($sub+8));
//echo $section."<br>";
$sub=strpos($CurPageURL,"class_incharge=");
$class_incharge=substr($CurPageURL,$sub+15);
$teacher="2020_".$class_incharge;
//echo $teacher;
//echo $class_incharge."<br>";
$table_name="register_subject_".$class_id;
//echo $table_name;
?>
<html>
<head>
<title>Register Subject</title>
</head>
<body>
<table>
<form method="post" action="register_subject_db.php" >

<?php
echo "<tr><td>Class_ID</td><td><input type=\"text\" name=class_id value=\"$class_id\" required readonly=\"readonly\" ><input type=\"hidden\" name=\"url\" value=\"$CurPageURL\"></input></td></tr>";

$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
mysqli_select_db($conn,"time_table");
$sql="select Class_name from register_class";
$result=mysqli_query($conn,$sql);
echo "<tr><td>Class Name</td><td><input type=\"text\" name=\"class_name\" value=\"$class_name\" required readonly=\"readonly\"></td></tr>";
echo "<tr><td>Section</td><td><input type=\"text\" name=\"section\" value=\"$section\" required readonly=\"readonly\"></td></tr>";
echo "<tr><td>Class Incharge</td><td><input type=\"text\" name=\"class_incharge\" value=\"$class_incharge\" required readonly=\"readonly\"></td></tr>";
?>
<tr><td>Subject Name</td><td><input type="text" name="subject_name"  required></td></tr>
<tr><td>Classes in a Week</td><td>
<input type="radio" name="in_week" value="6" required>6</input>
<input type="radio" name="in_week" value="5" required>5</input>
<input type="radio" name="in_week" value="4" required>4</input>
<input type="radio" name="in_week" value="3" required>3</input>
<input type="radio" name="in_week" value="2" required>2</input>
<input type="radio" name="in_week" value="1" required>1</input>
</td></tr>
<tr><td>Classes in a Day</td><td>
<input type="radio" name="in_day" value="1" required>1</input>
<input type="radio" name="in_day" value="2" required>2</input>
</td></tr>
<tr><td><input type="submit" name="submit" value="Enter Subject"></td></tr>
</form>
</table>
<form method="post" action="timetable_generate.php">
<?php
echo "<input type=\"hidden\" name=\"table_name\" value=\"$table_name\">";
echo "<input type=\"hidden\" name=\"teacher\" value=\"$teacher\">";
echo "<input type=\"hidden\" name=\"url\" value=\"$CurPageURL\"></input>";
?>
<input type="submit" name="submit" value="Generate">
</form>
<form method="post" action="display.php">
<?php
$display_table_name="generate_".$table_name;
echo "<input type=\"hidden\" name=\"table_name\" value=\"$display_table_name\">";
echo "<input type=\"hidden\" name=\"url\" value=\"$CurPageURL\"></input>";
?>
<input type="submit" name="submit" value="Display">
</form>
<?php
error_reporting(E_ERROR | E_PARSE);

$conn=mysqli_connect("localhost","root","");

if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}

mysqli_select_db($conn,"time_table");

$sql="select * from $table_name";
$result=mysqli_query($conn,$sql);
echo "<table style='color:black; text-decoration:none; font-size:20px; text-align:center;' align='center' cellspacing='30'>";
echo "<tr><th>Class ID</th><th>Subject Name</th><th>Class Name</th><th>Section</th><th>Subject Teacher</th><th>In Week</th><th>In Day</th><th>Delete</th></tr>";
while($row=mysqli_fetch_array($result))
{
echo "<tr  valign=top align='center'>";
echo "<td>".$row['Class_id']."</td>";
echo "<td>".$row['Subject_name']."</td>";
echo "<td>".$row['Class_name']."</td>";
echo "<td>".$row['Section']."</td>";
echo "<td>".$row['Class_incharge']."</td>";
echo "<td>".$row['In_week']."</td>";
echo "<td>".$row['In_day']."</td>";
echo "<td>";
echo "<form method=\"post\" action=\"register_subject_db_delete.php\">";
echo "<input type=\"hidden\" name=\"subject_name\" value=\"$row[Subject_name]\"></input>";
echo "<input type=\"hidden\" name=\"class_id\" value=\"$row[Class_id]\"></input>";
echo "<input type=\"hidden\" name=\"url\" value=\"$CurPageURL\"></input>";?>
<input type="submit" name="submit" value="Delete" style="border:2; height:20; width:60; font-size:15; font-family: serif; font-weight: bold;">
<?php
echo "</form>";
echo "</td>";
echo "</tr>";
}
?>
</body>
</html>