<?php
ob_start();
$total_days=6;
//error_reporting(E_ERROR | E_PARSE);
$url=$_POST["url"];
$teacher=$_POST["teacher"];
echo $url."<br>";
 
$conn=mysqli_connect("localhost","root","");

if(mysqli_connect_errno())
{
	echo  '<script>alert("Database Connection Error".mysqli_connect_error())</script>'; 
}

mysqli_select_db($conn,"time_table");
$table_name=$_POST["table_name"];
$table_name_temp=$table_name;
$sql="select * from $table_name_temp";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
	$temp_for_subject=$row['Subject_name'];
	$In_week=$row['In_week'];
	echo $In_week."<br>";
	mysqli_query($conn,"update $table_name_temp set In_week_temp=\"$In_week\" where Subject_name=\"$temp_for_subject\"");
	//echo $row['In_week_temp']."<br>";
}

$sql="select * from $table_name_temp";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
	echo $row['In_week_temp']."<br>";
}



$day=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

$table_name="generate_".$table_name;
echo $table_name."<br>";

$sql="select * from duration_info where class_type=\"PERIOD\"";
$record_to_be_complete=mysqli_num_rows(mysqli_query($conn,$sql));
echo $record_to_be_complete;
$record_index=0;

$sql="select * from $table_name";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){mysqli_query($conn,"truncate $table_name");}

	mysqli_query($conn,"create table $table_name(Day varchar(9),Peroid varchar(10),Subject_name varchar(20),Teacher varchar(20))");
	$temp=0;
	$subject_index=0;
	$selected_today_subjects;
	$selected_today_subjects_index=0;
	
	
	// TOTAL LECTURES
	$sql="select In_week,In_day from $table_name_temp";
	$result=mysqli_query($conn,$sql);
	$total_lectures_sum=0;
	while($total_lectures=mysqli_fetch_array($result))
	{
		//echo $total_lectures["In_week"]."<br>";
		$total_lectures_sum+=$total_lectures['In_week']*$total_lectures['In_day'];
	}
	//echo "Total Lectures Entered -->  ".$total_lectures_sum."<br>";
	// TOTAL LECTURES
	// TABLE SIZE
	$table_size=$record_to_be_complete*$total_days;
	//echo "Table Size".$record_to_be_complete*total_days;
	//echo "<br>";
	// TABLE SIZE 
	
	
	if($total_lectures_sum<=$table_size)
	{
		$week_in=0;
		$total_lectures_today=ceil($total_lectures_sum/$total_days);
		$total_lectures_free=$record_to_be_complete-$total_lectures_today;
		echo "MAXIMUM LECTURES IN DAY POSSIBLE -->  ".$total_lectures_today;
		echo "MAXIMUM LECTURES FREE IN DAY POSSIBLE -->  ".$total_lectures_free;
	for($i=0;$i<$total_days;$i++)
	{	
		$day_in=0;
		$next_record=0;
		//$subject_index=0;
		$In_week_temp=$total_days;
		$selected_today_subjects_index=0;
	while($record_index<$record_to_be_complete)
	{	
		echo "DAY-->  ".$day[$i]."<br>";
		echo "Subject Index-->  ".$subject_index."<br>";
		$In_week_temp=$total_days-$next_record;
		$sql="select * from $table_name_temp where In_week_temp=\"$In_week_temp\"";
		echo "next_record-->";
		echo $total_days-$next_record."<br>";
		if($total_days-$next_record<0){break;}
		echo $table_name_temp."<br>";
		$result=mysqli_query($conn,$sql);
		echo "DAY IN-->  ".$day_in."<br>";
		if(mysqli_num_rows($result))
		{
		while($row=mysqli_fetch_array($result))
		{
			echo "<br> Selected Subject in loop --> ".$row['Subject_name']."<br>";
			echo "<br> In week Temp value-->".$row['In_week_temp']."<br>";
			if($row['In_week_temp']>0)
			{
				echo "DAY IN-->  ".$day_in."<br>";
				if($day_in<$total_lectures_today)
				{
					echo "Selected subject--> ".$row['Subject_name']."  on -->".$subject_index."<br>";
					$selected_today_subjects[$selected_today_subjects_index]=$row['Subject_name'];
					$selected_today_subjects_index++;
					if($row['In_day_temp']==2){
												$record_index++;
												$selected_today_subjects[$selected_today_subjects_index]=$row['Subject_name'];
												$selected_today_subjects_index++;
												$subject_array[$subject_index]=$row['Subject_name']; 
												$subject_index++;
												$day_in++; 
												$week_in++;
											}
					//if($row['In_day_temp']==3){$record_index+=2;}
					//$temp_for_subject=$row['In_week_temp'];
					//$temp_for_subject--;
					//mysqli_query($conn,"update $table_name_temp set In_week_temp=\"$temp_for_subject\" where Subject_name=\"$row[Subject_name]\"");
					$subject_array[$subject_index]=$row['Subject_name'];
					$subject_index++;
					$record_index++;
					$day_in++;
					$week_in++;
				}
				if($day_in==$record_to_be_complete){$record_index=$record_to_be_complete; echo "ROW COMPLETED SUCCESSFULLY<BR>";}
				else if($day_in>=$total_lectures_today)
				{ $record_index++; $record_index=$record_to_be_complete;}
				if($week_in==$total_lectures_sum){$record_index=$record_to_be_complete; break;}
			}
			
		}
		}
		else{
			//$subject_index++;
			if($week_in==$total_lectures_sum){$record_index=$record_to_be_complete; break;}
			if($day_in==$record_to_be_complete){$record_index=$record_to_be_complete;}
			else if($day_in>=$total_lectures_today)
				{ $record_index++; $record_index=$record_to_be_complete;}
		}
		//$record_index++;
		$next_record++;
		echo "Record Index-->  ".$record_index."<br>";
		echo "Subject Index-->  ".$subject_index."<br>";
		
	}
	//shuffle($subject_array);
	$subject_index=0;
	$sql="select Class_type from duration_info";
	$result=mysqli_query($conn,$sql);
		$temp=1;
		while($row=mysqli_fetch_array($result))
		{
			if($row['Class_type']=="PERIOD")
			{	
				echo "DATA INSERTED ON TABLE<BR><HR>";
				if(mysqli_query($conn,"insert into $table_name values(\"$day[$i]\",\"PERIOD$temp\",\"$subject_array[$subject_index]\",\"Null\")")==1)
				{	echo "Data Inserted";
					echo $day[$i]."<br>";
					echo "PERIOD.$temp"."<br>";
					echo $teacher."<br>";
					if(mysqli_query($conn,"update $teacher set Available=0 where Day=\"$day[$i]\" and Period=\"PERIOD.$temp\""))
					{echo "Data Updated Successfully"."<br>";}
					else{echo "Data Updated Unsuccessful"."<br>";}
				
				}
				else{echo "Data Not Inserted";}
				$temp++;
				$subject_index++;
			}
		}
		for($temp_i=0;$temp_i<$selected_today_subjects_index;$temp_i++)
		{
			echo "DECREMENT ON A DAY<BR><HR>";
			echo $temp_i."<br>";
			echo $selected_today_subjects_index."<br>";
			echo "<br>".$selected_today_subjects[$temp_i];
			$temp_temp=$selected_today_subjects[$temp_i];
			$sql="select * from $table_name_temp where Subject_name=\"$temp_temp\"";
			if($result=mysqli_query($conn,$sql)){echo "YES"."<br>";}else{echo "NO"."<BR>";}
			echo "Total Rows-->".mysqli_num_rows($result)."<br>";
			while($row=mysqli_fetch_array($result))
			{
			$temp_for_subject=$row['In_week_temp'];
			$temp_for_subject--;
			echo "Subject now in week-->".$temp_for_subject."<br>";
		    mysqli_query($conn,"update $table_name_temp set In_week_temp=\"$temp_for_subject\" where Subject_name=\"$row[Subject_name]\"");
				echo "All subjects were decremented.-->  ".$row['In_week_temp'];
				echo $selected_today_subjects[$temp_i]."<br>";
			}
		}
		$next_record=0;
		$subject_index=0;
		$In_week_temp=$total_days;
		$temp=0;
		$record_index=0;
		unset($subject_array);
		echo "At the End Subject Index -->".$subject_index."<br>";
	}
	}
	else{
		echo "Time Table Creation not possible.";
	}
    echo $url;
    //header("Location:$url");
	ob_end_flush();
?>