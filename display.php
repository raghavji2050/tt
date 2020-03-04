<?php
$table_name=$_POST["table_name"];
echo $table_name."<br>";
error_reporting(E_ERROR | E_PARSE);
$conn=mysqli_connect("localhost","root","");
if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}
mysqli_select_db($conn,"time_table");
$sql="select * from duration_info";
$result=mysqli_query($conn,$sql);

echo "<table style='color:black; text-align:center;text-decoration:none; font-size:20px; ' align='center' cellpadding='30' cellspacing='0' border='5' background='red'>";
echo "<tr>";
echo "<td>Timing--><br></td>";
while($row=mysqli_fetch_array($result))
{
	if($row['Class_type']=="PERIOD"){
		$val++;
		echo "<td>".$row['Class_type']." ".$val."<hr>".substr($row['Duration_from'],0,5)."-".substr($row['Duration_to'],0,5)."</td>";
	}
	else{
		echo "<td>".$row['Class_type']."<hr>".substr($row['Duration_from'],0,5)."-".substr($row['Duration_to'],0,5)."</td>";
	}
}
echo "</tr>";
$day=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$day_index=0;
$sql="select * from duration_info where Class_type=\"PERIOD\"";
$total_records=mysqli_num_rows(mysqli_query($conn,$sql));
//echo "TOTAL RECORDS-->".$total_records."<br>";
$sql="select * from duration_info";
$result=mysqli_query($conn,$sql);
$assembly_generate=0;
$assembly_on=0;
while($row=mysqli_fetch_array($result))
{
	echo $row['Class_type']."<br>";
	if($row['Class_type']=="ASSEMBLY"){$assembly_generate=1; break;}
	$assembly_on++;
}
if($assembly_generate==1){echo "ASSEMBLY on ".$assembly_on;}
else{echo "No assembly.";}
$sql="select * from $table_name";
$result=mysqli_query($conn,$sql);
$record_count_total=mysqli_num_rows($result);
//echo $record_count_total."<br>";
$i=0;
$record_count=0;
while($row=mysqli_fetch_array($result))
{
	if($i==0){echo "<tr>";
	echo "<td>$day[$day_index]</td>";
	}
	if($record_count<$record_count_total){
		if($assembly_generate==1){
			//echo "record_count-->".$record_count."<br>";
			//echo "assembly_on-->".$assmbly_on."<br>";
			if($record_count==($assembly_on)){echo "<td rowspan=6>ASSMEBLY</td>";}
		}
											echo "<td>";
											echo $row['Subject_name'];
											echo "</td>";
											$record_count++;
											//echo $record_count;			
		$i++;
	}
	if($i==$total_records)
	{
		echo "</tr>";
		$i=0;
		$day_index++;
	}
}
echo "</table>";
?>