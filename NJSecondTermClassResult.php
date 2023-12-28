<?php



//$subject = str_replace(" ", "_", $subjects);
//$subject_table = $subject."_".$sessions;
//echo"$subject_table";
//echo"$subject_table";
//echo"$classes";
//echo"$terms";
$classResultQ = "SELECT * FROM $subject_table WHERE CLASS_NAME='$classes' AND TERM_NAME = '$terms'";
$classResult_Query_result = mysqli_query($conn, $classResultQ);
$//entireClassResult = array();
//$indexC = 0;
$icount = 0;
while($classResult=mysqli_fetch_array($classResult_Query_result))
{
	$classworkk = $classResult['CLASSWORK'];
	$assignmentt  = $classResult['ASSIGNMENT'];
	$project = $classResult['PROJECT'];
	$test_11 = $classResult['TEST_ONE'];
	$test_22 = $classResult['TEST_TWO'];
	$examm = $classResult['EXAMINATION'];
	//$proj_assignment = $project + $assignment;
	$entireClassResultt[$icount++] += $classworkk + $assignmentt + $test_11 + $test_22 + $examm + $project;
	echo"$icount ";
}
$icount = 0;
//foreach($entireClassResult as $value)
//++$allSubjects[] += $value;
//array_filter($entireClassResult);
//$class_max = max($entireClassResult);
//$class_min = min($entireClassResult);
//$class_average = round(array_sum($entireClassResult)/count(array_filter($entireClassResult)));
//echo"$class_average";
?>
