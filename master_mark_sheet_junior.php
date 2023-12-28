<?php
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf;
include('functions.php');
include ('jp2_db_connect.php');
session_start();
foreach ($_POST as $key => $value)
$$key = $value;

  $studentsQ = getStudentsInGivenClass($classes,$sessions);
  
  //include("classResult.php");
  include("master_mark_header.php");
  $masterContent='';
  while($student = mysqli_fetch_array($studentsQ))
  {
	  $std_id = $student['STUDENTS_ID'];
	  $std_name = ucwords (strtolower(getStudentName($std_id,$sessions)));
	  //$std_NAME = ucwords
	  $subject_query_result = getSubjects();
	  
	 
	 
	$studentGradeCounter = array("A"=>0, "B"=>0,"C"=>0,"D"=>0,"E"=>0,"U"=>0 );
	$studentSessionScore = array();
	$studentSessionGrade = array();
	$studentTermScore = array();
	 $masterContent .='<tr><td rowspan="2" style="border: 1px solid #ccc">'.$std_name.'</td>';
	 
	  while ($subjects = mysqli_fetch_array($subject_query_result))
{
	$subject_name = $subjects['SUBJECT_NAME'];
	$subject = str_replace(" ", "_", $subject_name);
    $subject_table = $subject."_".$sessions;
    $subject_NAME = ucwords(strtolower($subject_name));
	
	
	$student_resultQ = "SELECT * FROM $subject_table WHERE STUDENTS_ID='$std_id' AND TERM_NAME = '$terms'";
	$student_Qresult = mysqli_query($conn, $student_resultQ);
	$student_result = mysqli_fetch_array($student_Qresult);
	$classwork = round($student_result['CLASSWORK']);
	$assignment =round( $student_result['ASSIGNMENT']);
	$project = round($student_result['PROJECT']);
	$test_1 = round($student_result['TEST_ONE']);
	$test_2 = round($student_result['TEST_TWO']);
	$exam = round($student_result['EXAMINATION']);
	$proj_assignment = $project + $assignment;
	$session_avg = round($classwork + $assignment + $project + $test_1 + $test_2 + $exam);
	
	
	
	
	//GRADE SESSION AVERAGE
	$session_effort = "";
	$session_grade = "";
	if ($session_avg > 79)
	{
		$session_effort =1;
	    $session_grade = "A";
	} elseif ($session_avg > 69 AND $session_avg < 80)
	{
		$session_effort =2;
	    $session_grade = "B";
	}
	elseif ($session_avg > 59 AND $session_avg < 70)
	{
		$session_effort =3;
	    $session_grade = "C";
	}
	elseif ($session_avg > 49 AND $session_avg < 60)
	{
		$session_effort =4;
	    $session_grade = "D";
	}
	elseif ($session_avg > 39 AND $session_avg < 50)
	{
		$session_effort =5;
	    $session_grade = "E";
	}
	else
	{
		$session_effort =6;
	    $session_grade = "U";
	}

 ++$studentGradeCounter[$session_grade];
 	$studentSessionScore[$subject] = $session_avg;
	$studentSessionGrade[$subject] = $session_grade;
	//$studentTermScore[$subject] = $third_term;
//	echo"$studentTermScore[$subject]";

}

$grade = "grade";
//$masterContent .= '<td>Third Term</td>';
//foreach ($studentTermScore as $key_T => $value_T)
//$masterContent .= '<td style="border: 1px solid #ccc">'.$value_T.'</td>';
//$masterContent .= '<td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td></tr><tr>';
$masterContent .= '<td style="border: 1px solid #ccc">Session Avg</td>';
foreach ($studentSessionScore as $key => $value)
$masterContent .= '<td style="border: 1px solid #ccc">'.$value.'</td>';
$masterContent .= '<td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td></tr><tr>';
$masterContent .= '<td style="border: 1px solid #ccc">Session Grade</td>';
foreach ($studentSessionGrade as $key_g => $value_g)
$masterContent .= '<td style="border: 1px solid #ccc">'.$value_g.'</td>';
$masterContent .= '<td style="border: 1px solid #ccc">'.$studentGradeCounter["A"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["B"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["C"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["D"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["E"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["U"].'</td><td style="border: 1px solid #ccc"></td></tr>';

 }
 $masterContent .= '</table>';
 $content = $headerContent.$masterContent;
 $dompdf = new DOMPDF();
	$dompdf->load_html($content);
//	$masterContent = "";
	// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A3', 'landscape'); 
	$dompdf->render();
	$dompdf->stream();
?>