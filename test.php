<?php

// example 1 
$time1 = "08:00:00"; 
$time2 = "13:40:00"; 

echo "Time difference: ".get_time_difference($time1, $time2)." hours<br/>"; 

// example 2 
$time1 = "22:00:00"; 
$time2 = "04:00:00"; 

echo "Time difference: ".get_time_difference($time1, $time2)." hours<br/>"; 

/*function get_time_difference($time1, $time2) 
{ 
    $time1 = strtotime("1/1/1980 $time1"); 
    $time2 = strtotime("1/1/1980 $time2"); 
     
    if ($time2 < $time1) 
    { 
        $time2 = $time2 + 86400; 
    } 
     
    return ($time2 - $time1) / 3600; 
     
} */
function get_time_difference($time1, $time2) {
    $time1 = strtotime("1980-01-01 $time1");
    $time2 = strtotime("1980-01-01 $time2");
    
    if ($time2 < $time1) {
        $time2 += 86400;
    }
    
    return date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1));
} 
?>

