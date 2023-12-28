<?php

$sessions = "2021_2022";
$classes = "JS2A";
//foreach ($_POST as $key => $value)
//$$key = $value;
include("juniorMasterMarkSheetHeader.php");
$masterContent='';
$studentGradeCounter = array("A"=>0, "B"=>0,"C"=>0,"D"=>0,"E"=>0,"U"=>0 );
$studentGradeCounterT = array("A"=>0, "B"=>0,"C"=>0,"D"=>0,"E"=>0,"U"=>0 );
$avgQuery = "SELECT STUDENTS_ID, AVG(MATHS) AS MATHS, AVG(FRE) AS FRE, AVG(BUS) AS BUS, AVG(CRS) AS CRS, AVG(HIST) AS HIST, AVG(ENG) AS ENG, AVG(BST) AS BST, AVG(CCA) AS CCA, AVG(NVE) AS NVE, AVG(PVS) AS PVS, AVG(USI) AS USI FROM JUNIOR_SCHOOL_RESULTS_2021_2022 WHERE CLASS='$classes' GROUP BY STUDENTS_ID ORDER BY STUDENTS_ID";
$avgQueryResult = mysqli_query($conn, $avgQuery);

$thirdTermQuery = "SELECT * FROM JUNIOR_SCHOOL_RESULTS_2021_2022 WHERE TERM = 'THIRD_TERM' AND CLASS = '$classes' ORDER BY STUDENTS_ID";
$thirdTermQueryResult = mysqli_query($conn, $thirdTermQuery);
while ($scores = mysqli_fetch_array($thirdTermQueryResult) and $avg = mysqli_fetch_array($avgQueryResult))
{
	$std_id = $scores['STUDENTS_ID'];
	$std_name = ucwords (strtolower(getStudentName($std_id,$sessions)));
	$mathsT = $scores['MATHS']; $engT = $scores['ENG']; $crsT = $scores['CRS']; $freT = $scores['FRE']; $busT = $scores['BUS'];
	$histT = $scores['HIST']; $bstT = $scores['BST']; $nveT = $scores['NVE']; $pvsT = $scores['PVS']; $ccaT = $scores['CCA'];
	$usiT = $scores['USI'];
	$mathsGradeT = grader($mathsT);
	++$studentGradeCounterT[$mathsGradeT];
	$engGradeT = grader($engT);
	++$studentGradeCounterT[$engGradeT];
	$crsGradeT = grader($crsT);
	++$studentGradeCounterT[$crsGradeT];
	$freGradeT = grader($freT);
	++$studentGradeCounterT[$freGradeT];
	$busGradeT = grader($busT);
	++$studentGradeCounterT[$busGradeT];
	$histGradeT = grader($histT);
	++$studentGradeCounterT[$histGradeT];
	$bstGradeT = grader($bstT);
	++$studentGradeCounterT[$bstGradeT];
	$nveGradeT = grader($nveT);
	++$studentGradeCounterT[$nveGradeT];
	$pvsGradeT = grader($pvsT);
	++$studentGradeCounterT[$pvsGradeT];
	$ccaGradeT = grader($ccaT);
	++$studentGradeCounterT[$ccaGradeT];    #f2a9f5 ; background-color:#f2dd8f"
	$usiGradeT = grader($usiT);
	++$studentGradeCounterT[$usiGradeT];
	

	$maths = round($avg['MATHS']); $eng =round( $avg['ENG']); $crs = round($avg['CRS']); $fre = round($avg['FRE']); $bus = round($avg['BUS']); $hist = round($avg['HIST']);
	$bst = round($avg['BST']); $nve = round($avg['NVE']); $pvs = round($avg['PVS']); $cca = round($avg['CCA']); $usi = ($avg['USI']);
	$mathsGrade = grader(maths);
	++$studentGradeCounter[$mathsGrade];
	$engGrade = grader($eng);
	++$studentGradeCounter[$engGrade];
	$crsGrade = grader($crs);
	++$studentGradeCounter[$crsGrade];
	$freGrade = grader($fre);
	++$studentGradeCounter[$freGrade];
	$busGrade = grader($bus);
	++$studentGradeCounter[$busGrade];
	$histGrade = grader($hist);
	++$studentGradeCounter[$histGrade];
	$bstGrade = grader($bst);
	++$studentGradeCounter[$bstGrade];
	$nveGrade = grader($nve);
	++$studentGradeCounter[$nveGrade];
	$pvsGrade = grader($pvs);
	++$studentGradeCounter[$pvsGrade];
	$ccaGrade = grader($cca);
	++$studentGradeCounter[$ccaGrade];
	$usiGrade = grader($usi);
	++$studentGradeCounter[$usiGrade];
	
	if (!($stdIsSet == "Yes"))
	{
			 $masterContent .='<tr><td rowspan="4" style="border: 1px solid #ccc">'.$std_name.'</td>';
			 $stdIsSet = "Yes";
	}
	
	//THIRD_TERM GRADE AND SCORES
	$masterContent .= '<td style="border: 1px solid #ccc; background-color:#73f5ea">Third term</td>';
	$masterContent .= '<td style="border: 1px solid #ccc">'.$mathsT.'</td><td style="border: 1px solid #ccc">'.$engT.'</td>
	<td style="border: 1px solid #ccc">'.$bstT.'</td><td style="border: 1px solid #ccc">'.$pvsT.'</td><td style="border: 1px solid #ccc">'.$ccaT.'</td>
	<td style="border: 1px solid #ccc">'.$nveT.'</td><td style="border: 1px solid #ccc">'.$histT.'</td><td style="border: 1px solid #ccc">'.$busT.'</td>
	<td style="border: 1px solid #ccc">'.$freT.'</td><td style="border: 1px solid #ccc">'.$usiT.'</td>';
	$masterContent .= '<td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td></tr><tr>';
	$masterContent .= '<td style="border: 1px solid #ccc">Session Grade</td>';
	$masterContent .= '<td style="border: 1px solid #ccc">'.$mathsGradeT.'</td><td style="border: 1px solid #ccc">'.$engGradeT.'</td>
	<td style="border: 1px solid #ccc">'.$bstGradeT.'</td><td style="border: 1px solid #ccc">'.$pvsGradeT.'</td><td style="border: 1px solid #ccc">'.$ccaGradeT.'</td>
	<td style="border: 1px solid #ccc">'.$nveGradeT.'</td><td style="border: 1px solid #ccc">'.$histGradeT.'</td><td style="border: 1px solid #ccc">'.$busGradeT.'</td>
	<td style="border: 1px solid #ccc">'.$freGradeT.'</td><td style="border: 1px solid #ccc">'.$usiGradeT.'</td>';
$masterContent .= '<td style="border: 1px solid #ccc">'.$studentGradeCounterT["A"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounterT["B"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounterT["C"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounterT["D"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounterT["E"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounterT["U"].'</td><td style="border: 1px solid #ccc"></td></tr><tr>';

	
	
	//END OF SESSION GRADE AND SCORES
	$masterContent .= '<td style="border: 1px solid #ccc">Session Avg</td>';
	$masterContent .= '<td style="border: 1px solid #ccc">'.$maths.'</td><td style="border: 1px solid #ccc">'.$eng.'</td>
	<td style="border: 1px solid #ccc">'.$bst.'</td><td style="border: 1px solid #ccc">'.$pvs.'</td><td style="border: 1px solid #ccc">'.$cca.'</td>
	<td style="border: 1px solid #ccc">'.$nve.'</td><td style="border: 1px solid #ccc">'.$hist.'</td><td style="border: 1px solid #ccc">'.$bus.'</td>
	<td style="border: 1px solid #ccc">'.$fre.'</td><td style="border: 1px solid #ccc">'.$usi.'</td>';
	$masterContent .= '<td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td><td style="border: 1px solid #ccc"></td></tr><tr>';
	$masterContent .= '<td style="border: 1px solid #ccc">Session Grade</td>';
	$masterContent .= '<td style="border: 1px solid #ccc">'.$mathsGrade.'</td><td style="border: 1px solid #ccc">'.$engGrade.'</td>
	<td style="border: 1px solid #ccc">'.$bstGrade.'</td><td style="border: 1px solid #ccc">'.$pvsGrade.'</td><td style="border: 1px solid #ccc">'.$ccaGrade.'</td>
	<td style="border: 1px solid #ccc">'.$nveGrade.'</td><td style="border: 1px solid #ccc">'.$histGrade.'</td><td style="border: 1px solid #ccc">'.$busGrade.'</td>
	<td style="border: 1px solid #ccc">'.$freGrade.'</td><td style="border: 1px solid #ccc">'.$usiGrade.'</td>';
$masterContent .= '<td style="border: 1px solid #ccc">'.$studentGradeCounter["A"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["B"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["C"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["D"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["E"].'</td><td style="border: 1px solid #ccc">'.$studentGradeCounter["U"].'</td><td style="border: 1px solid #ccc"></td></tr>';
		
}
 $masterContent .= '</table>';
 $content = $headerContent.$masterContent;
 //$dompdf = new DOMPDF();
//	$dompdf->load_html($content);
//	$masterContent = "";
	// (Optional) Setup the paper size and orientation 
//$dompdf->setPaper('A3', 'landscape'); 
//	$dompdf->render();
//	$dompdf->stream();
 echo"$content";
?>
