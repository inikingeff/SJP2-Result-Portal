<?php

//$session = $_POST['session'];
//$term = $_POST['term'];

$term = "SECOND_TERM";
$session = "2021_2022";
$subjects_Q = "SELECT SUBJECT_NAME FROM SENIOR_SUBJECTS ORDER BY SUBJECT_NAME";
$subjectsQR = mysqli_query($conn, $subjects_Q);

//CREATE SUBJECT RESULT TABLE FOR SENIOR SUBJECTS
while($subjectRow = mysqli_fetch_array($subjectsQR))
{
$subject = $subjectRow['SUBJECT_NAME'];
$subjectT = str_replace(' ', '_', $subject);
$subject_table_name = $subjectT."_S_"."_".$session;
//INSERT STUDENTS INTO SUBJECT TABLE

$students_for_subject_Q = "SELECT * FROM SENIOR_STUDENTS_SUBJECTS_OFFERED WHERE $subjectT = 1";
$students_for_subject_Q_R = mysqli_query($conn, $students_for_subject_Q);

while($students_for_subject = mysqli_fetch_array($students_for_subject_Q_R))
{
	$std_id = $students_for_subject['STUDENTS_ID'];
	//echo"$std_id";
$std_class_name = getStudentsClassName($std_id, $session);
//echo"$std_class_name";
//INSERT STUDENTS INTO SUBJECTS TABLE
$insert_students_Q = "INSERT INTO $subject_table_name (STUDENTS_ID, CLASS_NAME, TERM_NAME) VALUES ('$std_id', '$std_class_name', $term)";
mysqli_query($conn, $insert_students_Q);
}

}






?>
