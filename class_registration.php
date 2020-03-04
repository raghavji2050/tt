<html>
<head>
<title>Class Registration</title>
</head>
<body>
<table>
<form method="post" action="class_registration_db.php" >
<tr><td>Class Name</td><td><input type="text" name="class_id" required></td></tr>
<tr><td>year</td><td><input type="year" name="class_year" max="3" required></td></tr>
<tr><td>Semester</td><td><select name="class_semester"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></select></td></tr>
<tr><td>Strength</td><td><input type="number" max="100" name="class_strength"></td></tr>
<tr><td>Minimum Free</td><td><input type="number" name="class_minimum"></td></tr>
<tr><td>Maximum Free</td><td><input type="number" name="class_maximum"></td></tr>
<tr><td><input type="submit" name="submit" value="Enter Class"></td></tr>
</form>
</table>
</body>
</html>