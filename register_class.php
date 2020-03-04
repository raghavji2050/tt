<html>
<head>
<title>Register Class</title>
</head>
<body>
<table>
<form method="post" action="register_class_db.php" >
<tr><td>Class</td><td><input type="text" name="class_name" required></td></tr>
<tr><td>Section</td><td><input type="text" name="section"  required></td></tr>
<tr><td>Class Incharge</td><td><input type="text" name="class_incharge" pattern="[A-Za-z]{3,50}" required></td></tr>
<tr><td><input type="submit" name="submit" value="Enter Class"></td></tr>
</form>
</table>

<?php
error_reporting(E_ERROR | E_PARSE);
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
mysqli_select_db($conn,"time_table");
$sql="select * from register_class";
$result=mysqli_query($conn,$sql);
echo "<table style='color:black; text-decoration:none; font-size:20px; text-align:center;' align='center' cellspacing='30'>";
echo "<tr><th>ID</th><th>Class</th> <th>Section</th> <th>Class_incharge</th><th>Register Subject</th><th>Operation</th></tr>";
while($row=mysqli_fetch_array($result))
{
echo "<tr   valign=top align='center'>";
echo "<td>".$row['Class_id']."</td>";
echo "<td>".$row['Class_name']."</td>";
echo "<td>".$row['Section']."</td>";
echo "<td>".$row['Class_incharge']."</td>";
echo "<td>";
echo "<a href='register_subject.php?class_id=$row[Class_id]?class_name=$row[Class_name]?section=$row[Section]?class_incharge=$row[Class_incharge]'>";
echo "Subject Page"."</a>";
echo "</td>";
echo "<td>";
?>
<form method="post" action="register_class_db_delete.php">
<?php
echo "<input type=\"hidden\" name=\"class_name\" value=\"$row[Class_name]\">";
echo "<input type=\"hidden\" name=\"section\" value=\"$row[Section]\">";
echo "<input type=\"hidden\" name=\"class_incharge\" value=\"$row[Class_incharge]\">";
echo "<input type=\"hidden\" name=\"class_id\" value=\"$row[Class_id]\">";
echo "<input type=\"hidden\" name=\"url\" value=\"$CurPageURL\"></input>";
?>
<input type="submit" name="submit" value="Delete">
</form>
<?php
echo "</td>";
echo "</tr>";
}
echo "</table>";
?>
</body>
</html>