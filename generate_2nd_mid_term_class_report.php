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

  $studentsQ = getStudentsInGivenClass($classes, $sessions);
  $register = "STUDENTS_REGISTER_".$sessions;
  $class_arm = substr($classes, 0, 1);
include("class_report_header_2nd_mid_term.php");
  while($student = mysqli_fetch_array($studentsQ))
  {
	  $subjectScores = array('MAT'=>0, 'ENG'=>0, 'BST'=>0, 'CCA'=>0, 'NVE'=>0, 'PVS'=>0, 'USI'=>0, 'CRS'=>0, 'HIS'=>0, 'FRE'=>0, 'BUS'=>0);
	  $subjectGrades = array('MAT'=>'', 'ENG'=>'', 'BST'=>'', 'CCA'=>'', 'NVE'=>'', 'PVS'=>'', 'USI'=>'', 'CRS'=>'', 'HIS'=>'', 'FRE'=>'', 'BUS'=>'');
	  $gradeCounter = array('A'=>0, 'B'=>0,'C'=>0,'D'=>0,'E'=>0,'U'=>0, );
	  $std_id = $student['STUDENTS_ID'];
	  $std_adm_num = $student['ADMISSION_NUMBER'];
	  $std_name = ucwords (strtolower(getStudentName($std_id, $sessions)));
	  //$std_NAME = ucwords
	  
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
	
	// CLASS REPORT HEADER html
	


if ($class_arm == "J")
{
    $newSubjectCodes = array("PVS", "BST", "NVE", "CCA");
    $newSubjectNames = array("PVS"=>"Prevocational Studies", "BST"=>"Basic Science and Technology", "NVE"=>"National Value Education", "CCA"=>"Cultural and Creative Art");
    $PVS = array("Agricultural Science", "Home Economics");
	$NVE = array("Civic Education", "Social Studies");
	$BST = array("Basic Science", "Basic Technology", "Information and Communication Technology", "Physical and Health Education");
	$CCA = array("Music", "Fine Art");
    
	  while ($subjects = mysqli_fetch_array($Jsubject_query_result))
{
	$subject_name = $subjects['SUBJECT_NAME'];
	$subject_code = $subjects['SUBJECT_CODE'];
	$subject_NAME = "";
	//include("classResult_first_term.php");
	  $classwork =0;
  $assignment = 0;
  $test_1 = 0;
  $test_2=0;
  $mid_term = 0;
	if(in_array($subject_code, $newSubjectCodes))
	{
	  //START COMPUTING RESULT FOR NEW SUBJECT
	  //GET OLD SUBJECTS FOR NEW SUBJECT NAME
	  $getSubjectsQ = "SELECT * FROM SUBJECTS WHERE SUBJECT_CODE = '$subject_code' ";
	  $getSubjects = mysqli_query($conn, $getSubjectsQ);
	  $count = 0;
	  $classSize = getClassSize($classes, $sessions);
	  $entireClassResult = array();
	  $entireClassResult = array_fill(0, $classSize, 0);
	  // GET AND FIND AVERAGE OF COMPONENT SUBJECTS
	  while ($newSubjectsArray = mysqli_fetch_array($getSubjects))
	  {
		  $newSubject_Name = $newSubjectsArray['SUBJECT_NAME'];
		  $subject = str_replace(" ", "_", $newSubject_Name);
    $subject_table = $subject."_".$class_arm."__".$sessions;
    $subject_NAME = ucwords(strtolower($subject_name));
//	echo"$subject_table";
	//include("midTermClassResult.php");
	
	$student_resultQ = "SELECT * FROM $subject_table WHERE STUDENTS_ID='$std_id' AND TERM_NAME = '$terms'";
	$student_Qresult = mysqli_query($conn, $student_resultQ);
	$student_result = mysqli_fetch_array($student_Qresult);
	$classwork += $student_result['CLASSWORK'] *2;
	$assignment += $student_result['ASSIGNMENT']*2;
	//$project += $student_result['PROJECT'];
	$test_1 += $student_result['TEST_ONE'] * 2;
	$test_2 += $student_result['TEST_TWO']*4;
	$count = $count + 1;
	  }
	  $class_max = round(max($entireClassResult)/$count);
      $class_min = round(min($entireClassResult)/$count);
	  $class_average = round((array_sum($entireClassResult)/count(array_filter($entireClassResult)))/$count);
	$classwork = round($classwork/$count);
	$assignment = round($assignment/$count);
	//$project = round($project/$count);
	$test_1 = round($test_1/$count);
	$test_2 = round($test_2/$count);
	$mid_term = $classwork + $assignment + $test_1 + $test_2;
	//$count = 0;
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
	$classwork = round($student_result['CLASSWORK'] *2);
	$assignment = round($student_result['ASSIGNMENT']*2);
	//$project = round($student_result['PROJECT']);
	$test_1 = round($student_result['TEST_ONE']*2);
	$test_2 = round($student_result['TEST_TWO']*4);
	$mid_term = $classwork + $assignment + $test_1 + $test_2;
	//$test_2 = round($student_result['TEST_TWO']);
	//$exam = round($student_result['EXAMINATION']);
	$comment = $student_result['COMMENT'];
	//$proj_assignment = $project + $assignment;
	//$third_term = round($classwork + $assignment + $project + $test_1 + $test_2 + $exam);
	
	
	//GRADE SCORE
     //midTermGrade();
	}
	// END OF OLD SUBJECTS RESULTS CALCULATION
	
	
	//GRADE MID TERM SCORES
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
	$subjectScores[$subject_code] = $mid_term;
	$subjectGrades[$subject_code] = $term_grade;
	++$gradeCounter[$term_grade];

	
}
$content .= '<tr><td style="text-align:left; border: 1px solid #ccc; width:220px;font-size:12px">'.$std_name.'</td>';
    $subjectsCODEQueryList = getNewJuniorSubjects();
	while($subjectsList = mysqli_fetch_array($subjectsCODEQueryList))
	{
		        $Subjcode =  $subjectsList['SUBJECT_CODE'];
				$subject_score = $subjectScores[$Subjcode];
				$subject_Grade = $subjectGrades[$Subjcode];
                $content .= '<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$subject_score.'</td>';
	}
	$A = $gradeCounter['A']; $B = $gradeCounter['B']; $C = $gradeCounter['C']; $D = $gradeCounter['D']; $E = $gradeCounter['E']; $U = $gradeCounter['U'];
	$content .= '<td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$A.'</td><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$B.'</td><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$C.'</td><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$D.'</td><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$E.'</td><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$U.'</td>';
}// END FOR JUNIOR STUDENT

// START FOR SENIOR CLASS 
{

}
//END FOR SENIOR CLASS
$content .= '</tr>';
  }
  $content .= '</table>
  <table style="width:800px">
<tr><td style="text-align:right;font-size:12px;font-weight:bold;padding-top:40px">Principal\'s Signature: <img style="width:80px" src="' . $Psignature_logo_base64 . '"></td></tr></table>';


$content .= '<table><tr><th>SUBJECT CODE</th><th>SUBJECT TITLE</th></tr>';
    $subjectssCODEQueryList = getNewJuniorSubjects();
	while($subjectQueryListt = mysqli_fetch_array($subjectssCODEQueryList))
	{
		        $Subjcodee =  $subjectQueryListt['SUBJECT_CODE'];
				 $Subjtitle =  $subjectQueryListt['SUBJECT_NAME'];
				$subject_score = $subjectScores[$Subjcodee];
				$subject_Grade = $subjectGrades[$Subjcodee];
                $content .= '<tr><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$Subjcodee.'</td><td style="text-align:center; border: 1px solid #ccc;font-size:12px">'.$Subjtitle.'</td></tr>';
	}
	$content .= '</table>';





  $dompdf = new DOMPDF();
	$dompdf->load_html($content);
	$content = "";
	// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A3', 'portrait'); 
	$dompdf->render();
	//$dompdf->stream();
	$putout= $dompdf->output();
	file_put_contents("class_report_pdf/$classes.pdf", $putout);
?>