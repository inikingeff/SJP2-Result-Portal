<?php
include ('functions.php');
include ('jp2_db_connect.php');
//RETRIEVE SESSION AND TERM FROM FORM





$subjects_Q = "SELECT SUBJECT_NAME FROM SUBJECTS ORDER BY SUBJECT_NAME";
$subjectsQR = mysqli_query($conn, $subjects_Q);
$term = "SECOND_TERM";
$session = "2021_2022";
//CREATE SUBJECT RESULT TABLE FOR SENIOR SUBJECTS
while($subjectRow = mysqli_fetch_array($subjectsQR))
{
$subject = $subjectRow['SUBJECT_NAME'];
$subjectT = str_replace(' ', '_', $subject);
$subject_table_name = $subjectT."_J_"."_".$session;

$delEntry = "DELETE FROM $subject_table_name WHERE TERM_NAME = '$term' ";
mysqli_query($conn, $delEntry);
}





?>