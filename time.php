<?php 

function sum_the_time($time1, $time2) {
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }

$a="08:30:00";
$b="00:55:00";
$a=date("H:i:s",strtotime($a));
echo $a;
$b=date("H:i:s",strtotime($b));
echo $b;
echo sum_the_time($a,$b);
if($a==$b){echo "same time";}
else{echo "time not same";}
?>