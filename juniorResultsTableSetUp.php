<?php
// THIS FILE IS RUN EVERY TERM TO ADD STUDENTS TO EACH OF THE SUBJECT RESULTS TABLE

//RETRIEVE SESSION AND TERM FROM FORM





//$subjects_Q = "SELECT SUBJECT_NAME FROM SUBJECTS WHERE SECTION='JUNIOR' OR SECTION='ALL' ORDER BY SUBJECT_NAME";
//$subjectsQR = mysqli_query($conn, $subjects_Q);
$term = "FIRST_TERM";
$session = "2021_2022";
//CREATE SUBJECT RESULT TABLE FOR SENIOR SUBJECTS
//while($subjectRow = mysqli_fetch_array($subjectsQR))

//$subject = $subjectRow['SUBJECT_NAME'];
//$subjectT = str_replace(' ', '_', $subject);
//$subject_table_name = $subjectT."_J_"."_".$session;
$studentRegister = "STUDENTS_REGISTER_".$session;
$resultTable = "JUNIOR_SCHOOL_RESULTS"."_".$session;
$students_for_subject_Q = "SELECT * FROM $studentRegister WHERE SECTION = 'JUNIOR' ";
$students_for_subject_Q_R = mysqli_query($conn, $students_for_subject_Q);

while($students = mysqli_fetch_array($students_for_subject_Q_R))
{
	
	$std_id = $students['STUDENTS_ID'];
	$class = $students['CLASS_NAME']; 
	
	//echo"$std_id";
//$std_class_name = getStudentsClassName($std_id, $session);
//echo"$std_class_name";
//INSERT STUDENTS INTO SUBJECTS TABLE
$insert_students_Q = "INSERT INTO $resultTable (STUDENTS_ID, CLASS, TERM) VALUES ('$std_id', '$class', '$term')";
mysqli_query($conn, $insert_students_Q);
}






?>
