<html>
<head>
<title>ADMIN PAGE</title>
</head>
<body>
<h1 align="center">ADMIN PAGE</h1>
<table>
<form method="post" action="adminpagedb.php">
<tr><td>Start Timing</td><td><input type="time" name="duration_from" min="07:00" max="14:00" required></td></tr>
<tr><td>End Timing</td><td><input type="time" name="duration_to" min="10:00" max="17:00" required></td></tr>
<tr><td>Assembly_from</td><td><input type="time" name="assembly_from" min="07:00" max="17:00"></td></tr>
<tr><td>Assembly_to</td><td><input type="time" name="assembly_to" min="07:00" max="17:00"></td></tr>
<tr><td>Recess_from</td><td><input type="time" name="recess_from" min="07:00" max="17:00"></td></tr>
<tr><td>Recess_to</td><td><input type="time" name="recess_to" min="07:00" max="17:00"></td></tr>
<tr><td>Class Duration</td><td><input type="number" name="class_duration" min="30" max="60" required></td></tr>
<tr><td><input type="submit" name="submit" Value="Enter in Record"></td></tr>
</form>
</table>
</body>
</html>