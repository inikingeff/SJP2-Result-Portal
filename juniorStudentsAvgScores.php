<?php
include('functions.php');
include ('jp2_db_connect.php');
$sessions = "2021_2022";
foreach ($_POST as $key => $value)
$$key = $value;
$masterContent='';
$studentGradeCounter = array("A"=>0, "B"=>0,"C"=>0,"D"=>0,"E"=>0,"U"=>0 );
$studentGradeCounterT = array("A"=>0, "B"=>0,"C"=>0,"D"=>0,"E"=>0,"U"=>0 );
$avgQuery = "SELECT STUDENTS_ID, AVG(MATHS) AS MATHS, AVG(FRE) AS FRE, AVG(BUS) AS BUS, AVG(CRS) AS CRS, AVG(HIST) AS HIST, AVG(ENG) AS ENG, AVG(BST) AS BST, AVG(CCA) AS CCA, AVG(NVE) AS NVE, AVG(PVS) AS PVS, AVG(USI) AS USI FROM JUNIOR_SCHOOL_RESULTS_2021_2022 WHERE CLASS='$classes' GROUP BY STUDENTS_ID ORDER BY STUDENTS_ID";
$avgQueryResult = mysqli_query($conn, $avgQuery);

$thirdTermQuery = "SELECT * FROM JUNIOR_SCHOOL_RESULTS_2021_2022 WHERE TERM = 'THIRD_TERM' AND CLASS = '$classes' ORDER BY STUDENTS_ID";
$thirdTermQueryResult = mysqli_query($conn, $thirdTermQuery);
while ($scores = mysqli_fetch_array($thirdTermQueryResult))
{
	$std_id = $scores['STUDENTS_ID'];
	$std_name = ucwords (strtolower(getStudentName($std_id,$sessions)));
	$maths = $scores['MATHS']; $eng = $scores['ENG']; $crs = $scores['CRS']; $fre = $scores['FRE']; $bus = $scores['BUS'];
	$hist = $scores['HIST']; $bst = $scores['BST']; $nve = $scores['NVE']; $pvs = $scores['PVS']; $cca = $scores['CCA'];
	$usi = $scores['USI'];
	
	$mathsGrade = grader(maths);
	++studentGradeCounterT[$mathsGrade];
	$engGrade = grader($eng);
	++studentGradeCounterT[$engGrade];
	$crsGrade = grader($crs);
	++studentGradeCounterT[$crsGrade];
	$freGrade = grader($fre);
	++studentGradeCounterT[$freGrade];
	$busGrade = grader($bus);
	++studentGradeCounterT[$busGrade];
	$histGrade = grader($hist);
	++studentGradeCounterT[$histGrade];
	$bstGrade = grader($bst);
	++studentGradeCounterT[$bstGrade];
	$nveGrade = grader($nve);
	++studentGradeCounterT[$nveGrade];
	$pvsGrade = grader($pvs);
	++studentGradeCounterT[$pvsGrade];
	$ccaGrade = grader($cca);
	++studentGradeCounterT[$ccaGrade];
	$usiGrade = grader($usi);
	++studentGradeCounterT[$usiGrade];
	
}
while ($avg = mysqli_fetch_array($avgQueryResult))
{
	$maths = $avg['MATHS']; $eng = $avg['ENG']; $crs = $avg['CRS']; $fre = $avg['FRE']; $bus = $avg['BUS']; $hist = $avg['HIST'];
	$bst = $avg['BST']; $nve = $avg['NVE']; $pvs = $avg['PVS']; $cca = $avg['CCA']; $usi = $avg['USI'];
	$mathsGrade = grader(maths);
	++studentGradeCounter[$mathsGrade];
	$engGrade = grader($eng);
	++studentGradeCounter[$engGrade];
	$crsGrade = grader($crs);
	++studentGradeCounter[$crsGrade];
	$freGrade = grader($fre);
	++studentGradeCounter[$freGrade];
	$busGrade = grader($bus);
	++studentGradeCounter[$busGrade];
	$histGrade = grader($hist);
	++studentGradeCounter[$histGrade];
	$bstGrade = grader($bst);
	++studentGradeCounter[$bstGrade];
	$nveGrade = grader($nve);
	++studentGradeCounter[$nveGrade];
	$pvsGrade = grader($pvs);
	++studentGradeCounter[$pvsGrade];
	$ccaGrade = grader($cca);
	++studentGradeCounter[$ccaGrade];
	%usiGrade = grader($usi);
	++studentGradeCounter[$usiGrade];
}
?>