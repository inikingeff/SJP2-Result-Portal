<?php


$classes = $_POST['classes'];
$sessions = $_POST['sessions'];
$terms = $_POST['terms'];
$termsection = $_POST['termsection'];

$terms = str_replace(" ", "_", $terms);

if($terms == "FIRST_TERM"){
    if($termsection=="End_Term")
	include("generate_first_term_ending_class_report.php");
	if($termsection=="Mid_Term")
	include("generate_1st_mid_term_class_report.php");
	//echo"$terms";
}
if($terms == "SECOND_TERM"){
    if($termsection=="End_Term")
	include("generate_second_term_ending_class_report.php");
	if($termsection=="Mid_Term")
	include("generate_2nd_mid_term_class_report.php");
}

if($terms == "THIRD_TERM"){
    if($termsection=="End_Term")
	include("generate_third_term_ending_class_report.php");
	if($termsection=="Mid_Term")
	include("generate_3rd_mid_term_class_report.php");
}




?>
