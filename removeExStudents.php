<?php
include('functions.php');
include ('jp2_db_connect.php');
$juniorSubjects = getJuniorSubjects ();
$class_arm = "J";
$sessions = "2021_2022";
$terms = "SECOND_TERM";
$std_id = '4';
while ($Subject_Name = mysqli_fetch_array($juniorSubjects))
		  $subject = str_replace(" ", "_", $Subject_Name);
    $subject_table = $subject."_".$class_arm."__".$sessions;
	
	$removeFromTable = "DELETE FROM $subject_table WHERE STUDENTS_ID = '$std_id' AND TERM_NAME = '$terms'"
mysqli_query($removeFromTable);


?>