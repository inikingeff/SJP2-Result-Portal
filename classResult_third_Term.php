<?php

//include('functions.php');
include ('jp2_db_connect.php');

//$subject = str_replace(" ", "_", $subjects);
//$subject_table = $subject."_".$sessions;
//echo"$subject_table";
//echo"$subject_table";
//echo"$classes";
//echo"$terms";
$classResultQ = "SELECT * FROM $subject_table WHERE CLASS_NAME='$classes' AND TERM_NAME = '$terms'";
$classResult_Query_result = mysqli_query($conn, $classResultQ);
$entireClassResult = array();
//$indexC = 0;
while($classResult=mysqli_fetch_array($classResult_Query_result))
{
	$classworkk = $classResult['CLASSWORK'];
	$assignmentt  = $classResult['ASSIGNMENT'];
	$project_222 = $classResult['PROJECT'];
	$test_11 = $classResult['TEST_ONE'];
	$test_22 = $classResult['TEST_TWO'];
	$examm_111 = $classResult['EXAMINATION'];
	//$proj_assignment = $project + $assignment;
	$entireClassResult[] = $classworkk + $assignmentt + $test_11 + $test_22 + $examm_111 + $project_222;	
}
//array_filter($entireClassResult);
$class_max = round( max($entireClassResult));
$class_min =  round(min($entireClassResult));
$class_average = round(array_sum($entireClassResult)/count(array_filter($entireClassResult)));
//echo"$class_average";
?>