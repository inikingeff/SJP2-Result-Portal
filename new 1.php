<?php 
include 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$content = '<style>

table th {
     border: 1px solid #ccc;
     text-align:center;
     vertical-align: middle;
 
}

</style>';

include('functions.php');
include ('jp2_db_connect.php');
  $studentsQ = getStudentsInGivenClass($classes, $sessions);
  $register = "STUDENTS_REGISTER_".$sessions;
  //include("classResult.php");
  while($student = mysqli_fetch_array($studentsQ))
  {
	  $std_id = $student['STUDENTS_ID'];
	  $std_adm_num = $student['ADMISSION_NUMBER'];
	  $std_name = ucwords (strtolower(getStudentName($std_id, $sessions)));
	  //$std_NAME = ucwords
	  $class_arm = substr($classes, 0, 1);
	  if($class_arm=="S")
	  $Ssubject_query_result = getSeniorSubjects();
  else
	  $Jsubject_query_result = getNewJuniorSubjects();
	   
	// RETRIEVE ADMISSION NUMBER PROFILE PICTURE
	//$admission_numberQ = "SELECT ADMISSION_NUMBER FROM $register WHERE STUDENTS_ID='$std_id' ";  
	//$admission_numberQresult = mysqli_query($conn, $admission_numberQ);
	//$admission_number_result = mysqli_fetch_array($admission_numberQresult); 
	//$adm_num = $admission_number_result['ADM_NUM'];
	         // END RETRIEVAL
	
	// REPORT HEADER html
	
include("report_header_first_term.php");
if ($class_arm == "J")
{
    $newSubjectCodes = array("PVE", "BST", "NVE", "CCA");
    $newSubjectNames = array("", "", "", "");
    $PVE = array("", "", "", "");
    
	  while ($subjects = mysqli_fetch_array($Jsubject_query_result))
{
	$subject_name = $subjects['SUBJECT_NAME'];
	$subject_code = $subjects['SUBJECT_CODE'];
	if(in_array($subject_code, $newSubjectCodes))
	{
	  //START COMPUTING RESULT FOR NEW SUBJECT
	  //GET OLD SUBJECTS FOR NEW SUBJECT NAME
	  $getSubjects = 
	  
	}
	else
	{
	$subject = str_replace(" ", "_", $subject_name);
    $subject_table = $subject."_".$class_arm."__".$sessions;
    $subject_NAME = ucwords(strtolower($subject_name));
//	echo"$subject_table";
	include("classResult_first_term.php");

	$student_resultQ = "SELECT * FROM $subject_table WHERE STUDENTS_ID='$std_id' AND TERM_NAME = '$terms'";
	$student_Qresult = mysqli_query($conn, $student_resultQ);
	$student_result = mysqli_fetch_array($student_Qresult);
	$classwork = round($student_result['CLASSWORK']) *2;
	$assignment =round( $student_result['ASSIGNMENT'])*2;
	$project = round($student_result['PROJECT']);
	$test_1 = round($student_result['TEST_ONE'])*6;
	$mid_term = $classwork + $assignment + $test_1;
	//$test_2 = round($student_result['TEST_TWO']);
	//$exam = round($student_result['EXAMINATION']);
	$comment = $student_result['COMMENT'];
	//$proj_assignment = $project + $assignment;
	//$third_term = round($classwork + $assignment + $project + $test_1 + $test_2 + $exam);
	
	
	//GRADE THIRD TERM SCORES
	$term_effort = "";
	$term_grade = "";
	if ($mid_term > 79)
	{
		$term_effort =1;
	    $term_grade = "A";
	} elseif ($mid_term > 69 AND $mid_term < 80)
	{
		$term_effort =2;
	    $term_grade = "B";
	}
	elseif ($mid_term > 59 AND $mid_term < 70)
	{
		$term_effort =3;
	    $term_grade = "C";
	}
	elseif ($mid_term > 49 AND $mid_term < 60)
	{
		$term_effort =4;
	    $term_grade = "D";
	}
	elseif ($mid_term > 39 AND $mid_term < 50)
	{
		$term_effort =5;
	    $term_grade = "E";
	}
	else
	{
		$term_effort =6;
	    $term_grade = "U";
	}
	}
	// END OF OLD SUBJECTS RESULTS CALCULATION
	
	
	//$first_termQ = "SELECT * FROM FIRST_AND_SECOND_TERM_SCORES WHERE STUDENTS_ID='$std_id' AND TERM_NAME = 'FIRST TERM' ";
	//$first_termQresult = mysqli_query($conn,$first_termQ);
	//$first_term_result = mysqli_fetch_array($first_termQresult);
	//if ($subject_name == "ENGLISH STUDIES")
	//	$first_term = round(($first_term_result['ENGLISH_LANGUAGE'] + $first_term_result['ENGLISH_LITERATURE'])/2);
	//else 
	//	$first_term = round($first_term_result[$subject]);
	//$second_termQ = "SELECT * FROM FIRST_AND_SECOND_TERM_SCORES WHERE STUDENTS_ID='$std_id' AND TERM_NAME = 'SECOND TERM' ";  
	//$second_termQresult = mysqli_query($conn,$second_termQ);
	//$second_term_result = mysqli_fetch_array($second_termQresult); 
	//if ($subject_name == "ENGLISH STUDIES")
	//	$second_term = round(($second_term_result['ENGLISH_LANGUAGE'] + $second_term_result['ENGLISH_LITERATURE'])/2);
	//else 
	//	$second_term = round(($second_term_result[$subject]));

	
	// CALCULATE SESSION ARRAY
	
	//$session_scores = array($first_term, $second_term, $third_term);
	
	//$sum = 0;
	//$counter =0;
	//foreach($session_scores as $score)
	//{
	//	if ($score > 0)
	//		++$counter;
	//	$sum += $sum;
	//}
	//$session_avg = round(array_sum($session_scores)/count(array_filter($session_scores)));
	
	
	//GRADE SESSION AVERAGE
	//$session_effort = "";
	//$session_grade = "";
	//if ($session_avg > 79)
	//{
	//	$session_effort =1;
	//    $session_grade = "A";
	//} elseif ($session_avg > 69 AND $session_avg < 80)
	//{
	//	$session_effort =2;
	//    $session_grade = "B";
	//}
	//elseif ($session_avg > 59 AND $session_avg < 70)
	//{
	//	$session_effort =3;
	//    $session_grade = "C";
	//}
	//elseif ($session_avg > 49 AND $session_avg < 60)
	//{
	//	$session_effort =4;
	//    $session_grade = "D";
	//}
	//elseif ($session_avg > 39 AND $session_avg < 50)
	//{
	//	$session_effort =5;
	//    $session_grade = "E";
	//}
	//else
	//{
	//	$session_effort =6;
	//    $session_grade = "U";
	//}
	
$content .='<tr>
<td style="text-align:left; border: 1px solid #ccc; width:220px;font-size:12px">'.$subject_NAME.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$classwork.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$assignment.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$test_1.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$mid_term.'</td>

<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$class_average.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$class_max.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$class_min.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$term_grade.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$term_effort.'</td>

</tr>';
	
  }
 // $form_teacher_comment_table = "FORM_TEACHER_COMMENT_".$sessions;
 // $formTeacherQ = "SELECT COMMENT FROM $form_teacher_comment_table WHERE //TERM_NAME='$terms' AND CLASS_NAME='$classes' AND STUDENTS_ID = '$std_id' ";
 // $formTeacherQResult = mysqli_fetch_array(mysqli_query($conn, $formTeacherQ));
 // $formTeacherComment = $formTeacherQResult['COMMENT'];
  
  $principal_comment_table = "PRINCIPAL_COMMENT_".$sessions;
 // $principalQ = "SELECT COMMENT FROM $principal_comment_table WHERE TERM_NAME='$terms' AND CLASS_NAME='$classes' AND STUDENTS_ID = '$std_id' ";
 // $principalQResult = mysqli_fetch_array(mysqli_query($conn, $principalQ));
 // $principalComment = $principalQResult['COMMENT'];
  
  $content .= '</table><table style="width:1000px"><tr>

<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">80 - 100 = A [1] (Excellecnt)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">70 - 79 = B [2] (Very good)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">60 - 69 = C [3] (Good)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">50 - 59 = D [4] (Average)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">40 - 49 = E [5] Fair</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">0 - 39 = U [6] (Ungraded)</td></tr></table>

<table style="width:800px">
<tr><td style="text-align:right;font-size:12px;font-weight:bold;padding-top:40px">Principal\'s Signature: <img style="width:80px" src="' . $Psignature_logo_base64 . '"></td></tr></table>';
?>

<?php
  // $out = ob_get_contents();
  // ob_end_flush();
   
   // Include autoloader 
//echo"$content";
$dompdf = new DOMPDF();
	$dompdf->load_html($content);
	$content = "";
	// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A3', 'portrait'); 
	$dompdf->render();
	//$dompdf->stream();
	$putout= $dompdf->output();
	file_put_contents("report_pdf/$std_name.pdf", $putout);
?>
<?php
  }
  if ($class_arm == "S")
  {
	  //HANDLE SENIOR STUDENTS RESULTS HERE
	  $subject="";
	  
	  	  while ($subjects = mysqli_fetch_array($Ssubject_query_result))
{
include ('jp2_db_connect.php');
	$subject_name = $subjects['SUBJECT_NAME'];
	$subject = str_replace(" ", "_", $subject_name);
    $subject_table = $subject."_".$class_arm."__".$sessions;
    $subject_NAME = ucwords(strtolower($subject_name));
	//echo"$subject_table";
	include("classResult_first_term.php");
// CHECK IF SENIOR STUDENT OFFERS SUBJECT
$subjectsOfferedQ = "SELECT * FROM SENIOR_STUDENTS_SUBJECTS_OFFERED WHERE STUDENTS_ID='$std_id'";
   // echo"$std_id";
	$subjectsOfferedQR = mysqli_query($conn, $subjectsOfferedQ);

	$subjectsOffered = mysqli_fetch_array($subjectsOfferedQR);
	$offeredSubject = $subjectsOffered[$subject];
   // echo"$offeredSubject";
	$student_resultQ = "SELECT * FROM $subject_table WHERE STUDENTS_ID='$std_id' AND TERM_NAME = '$terms'";
	$student_Qresult = mysqli_query($conn, $student_resultQ);
	$student_result = mysqli_fetch_array($student_Qresult);
	$classwork = round($student_result['CLASSWORK']) *2;
	$assignment =round( $student_result['ASSIGNMENT'])*2;
	$project = round($student_result['PROJECT']);
	$test_1 = round($student_result['TEST_ONE'])*6;
	$mid_term = $classwork + $assignment + $test_1;
	//$test_2 = round($student_result['TEST_TWO']);
	//$exam = round($student_result['EXAMINATION']);
	$comment = $student_result['COMMENT'];
	//$proj_assignment = $project + $assignment;
	//$third_term = round($classwork + $assignment + $project + $test_1 + $test_2 + $exam);
	//echo"CLASSWORK : ".$classwork;
	
	
	//GRADE THIRD TERM SCORES
	$term_effort = "";
	$term_grade = "";
	if ($mid_term > 79)
	{
		$term_effort =1;
	    $term_grade = "A";
	} elseif ($mid_term > 69 AND $mid_term < 80)
	{
		$term_effort =2;
	    $term_grade = "B";
	}
	elseif ($mid_term > 59 AND $mid_term < 70)
	{
		$term_effort =3;
	    $term_grade = "C";
	}
	elseif ($mid_term > 49 AND $mid_term < 60)
	{
		$term_effort =4;
	    $term_grade = "D";
	}
	elseif ($mid_term > 39 AND $mid_term < 50)
	{
		$term_effort =5;
	    $term_grade = "E";
	}
	else
	{
		$term_effort =6;
	    $term_grade = "U";
	}
	
	// SET SCORE VARIABLES TO EMPTY STRING IF SUBJECT IS NOT OFFERED
//	echo"SUBJECT OFFERED: $subject";
//	echo"$offeredSubject";
	if($offeredSubject == 0)
	{
		$term_effort ="";
		$term_grade ="";
		$classwork = "";
		$assignment="";
		$test_1="";
		$mid_term="";
		$class_average = "";
		$class_max="";
		$class_min="";
		
	}
	  
	//$first_termQ = "SELECT * FROM FIRST_AND_SECOND_TERM_SCORES WHERE STUDENTS_ID='$std_id' AND TERM_NAME = 'FIRST TERM' ";
	//$first_termQresult = mysqli_query($conn,$first_termQ);
	//$first_term_result = mysqli_fetch_array($first_termQresult);
	//if ($subject_name == "ENGLISH STUDIES")
	//	$first_term = round(($first_term_result['ENGLISH_LANGUAGE'] + $first_term_result['ENGLISH_LITERATURE'])/2);
	//else 
	//	$first_term = round($first_term_result[$subject]);
	//$second_termQ = "SELECT * FROM FIRST_AND_SECOND_TERM_SCORES WHERE STUDENTS_ID='$std_id' AND TERM_NAME = 'SECOND TERM' ";  
	//$second_termQresult = mysqli_query($conn,$second_termQ);
	//$second_term_result = mysqli_fetch_array($second_termQresult); 
	//if ($subject_name == "ENGLISH STUDIES")
	//	$second_term = round(($second_term_result['ENGLISH_LANGUAGE'] + $second_term_result['ENGLISH_LITERATURE'])/2);
	//else 
	//	$second_term = round(($second_term_result[$subject]));

	
	// CALCULATE SESSION ARRAY
	
	//$session_scores = array($first_term, $second_term, $third_term);
	
	//$sum = 0;
	//$counter =0;
	//foreach($session_scores as $score)
	//{
	//	if ($score > 0)
	//		++$counter;
	//	$sum += $sum;
	//}
	//$session_avg = round(array_sum($session_scores)/count(array_filter($session_scores)));
	
	
	//GRADE SESSION AVERAGE
	//$session_effort = "";
	//$session_grade = "";
	//if ($session_avg > 79)
	//{
	//	$session_effort =1;
	//    $session_grade = "A";
	//} elseif ($session_avg > 69 AND $session_avg < 80)
	//{
	//	$session_effort =2;
	//    $session_grade = "B";
	//}
	//elseif ($session_avg > 59 AND $session_avg < 70)
	//{
	//	$session_effort =3;
	//    $session_grade = "C";
	//}
	//elseif ($session_avg > 49 AND $session_avg < 60)
	//{
	//	$session_effort =4;
	//    $session_grade = "D";
	//}
	//elseif ($session_avg > 39 AND $session_avg < 50)
	//{
	//	$session_effort =5;
	//    $session_grade = "E";
	//}
	//else
	//{
	//	$session_effort =6;
	//    $session_grade = "U";
	//}
	
$content .='<tr>
<td style="text-align:left; border: 1px solid #ccc; width:220px;font-size:12px">'.$subject_NAME.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$classwork.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$assignment.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$test_1.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$mid_term.'</td>

<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$class_average.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$class_max.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$class_min.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$term_grade.'</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$term_effort.'</td>

</tr>';
	
  }
 // $form_teacher_comment_table = "FORM_TEACHER_COMMENT_".$sessions;
 // $formTeacherQ = "SELECT COMMENT FROM $form_teacher_comment_table WHERE //TERM_NAME='$terms' AND CLASS_NAME='$classes' AND STUDENTS_ID = '$std_id' ";
 // $formTeacherQResult = mysqli_fetch_array(mysqli_query($conn, $formTeacherQ));
 // $formTeacherComment = $formTeacherQResult['COMMENT'];
  
  $principal_comment_table = "PRINCIPAL_COMMENT_".$sessions;
 // $principalQ = "SELECT COMMENT FROM $principal_comment_table WHERE TERM_NAME='$terms' AND CLASS_NAME='$classes' AND STUDENTS_ID = '$std_id' ";
 // $principalQResult = mysqli_fetch_array(mysqli_query($conn, $principalQ));
 // $principalComment = $principalQResult['COMMENT'];
  
  $content .= '</table><table style="width:1000px"><tr>

<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">80 - 100 = A [1] (Excellecnt)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">70 - 79 = B [2] (Very good)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">60 - 69 = C [3] (Good)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">50 - 59 = D [4] (Average)</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">40 - 49 = E [5] Fair</td>
<td style="font-size:10px;font-weight:bold;text-align:left" colspan="3">0 - 39 = U [6] (Ungraded)</td></tr></table>

<table style="width:800px">
<tr><td style="text-align:right;font-size:12px;font-weight:bold;padding-top:40px">Principal\'s Signature: <img style="width:80px" src="' . $Psignature_logo_base64 . '"></td></tr></table>';
?>

<?php
  // $out = ob_get_contents();
  // ob_end_flush();
   
   // Include autoloader 
//echo"$content";
$dompdf = new DOMPDF();
	$dompdf->load_html($content);
	$content = "";
	// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A3', 'portrait'); 
	$dompdf->render();
	//$dompdf->stream();
	$putout= $dompdf->output();
	file_put_contents("report_pdf/$std_name.pdf", $putout);
?>
<?php
  }
	  
  }
  

?>

