<?php


//$path = 'sjp2_logo';


$woocommerce_gift_coupon_logo = "sjp_logo.jpg";
$woocommerce_gift_coupon_logo_type = pathinfo($woocommerce_gift_coupon_logo, PATHINFO_EXTENSION);
$woocommerce_gift_coupon_logo_data = file_get_contents($woocommerce_gift_coupon_logo);
$woocommerce_gift_coupon_logo_base64 = 'data:image/' . $woocommerce_gift_coupon_logo_type . ';base64,' . base64_encode($woocommerce_gift_coupon_logo_data);

// FORM TEACHER'S SIGNATURE BASE64 ENCODING
$Fsignature = 'images/'.$classes.'.jpg';
$Fsignature_type = pathinfo($Fsignature, PATHINFO_EXTENSION);
$Fsignature_data = file_get_contents($Fsignature);
$Fsignature_logo_base64 = 'data:image/' . $Fsignature_type . ';base64,' . base64_encode($Fsignature_data);

// PRINCIPAL'S SIGNATURE BASE64 ENCODING
$Psignature = 'images/principal.jpg';
$Psignature_type = pathinfo($Psignature, PATHINFO_EXTENSION);
$Psignature_data = file_get_contents($Psignature);
$Psignature_logo_base64 = 'data:image/' . $Psignature_type . ';base64,' . base64_encode($Psignature_data);


$path = 'profile_pic/'.$std_adm_num.'.jpg';
$path_type = pathinfo($path, PATHINFO_EXTENSION);
$path_data = file_get_contents($path);
$path_logo_base64 = 'data:image/' . $path_type . ';base64,' . base64_encode($path_data);






$content="";
$content .= '<table  style="width:1000px; border-collapse: collapse" ><tr ><td class="banner" style="width:200px"><img style="width:160px" src="' . $woocommerce_gift_coupon_logo_base64 . '"></td><td class="banner" style="width:550px;padding-left:50px" align="left"><h1>SAINT JOHN PAUL II COLLEGE</h1><h2 align="center">SHELTER AFRIQUE, UYO</h2><h3 align="center">'.$yterm.' '.$sessions.' ACADEMIC SESSION</h3><h4 align="center">'.$termsection.' RESULT</h4>

<table  ><tr><th></th><th></th><th></th></tr></table></DIV><td class="banner" style="width:200px"></td></tr></table>

<center><H1>MASTER MARK SHEET, '.$classes.'</H1></center>


<table  style="width:1000px; border-collapse: collapse;padding-top:20px">
<tr><th style="width:200px; border: 1px solid #ccc">FULL NAME</th>';
if($class_arm=="S")
$subjectsList = getSeniorSubjects();
else
$subjectsList = getNewJuniorSubjects();

while($subList=mysqli_fetch_array($subjectsList))
{
  $subCode = $subList['SUBJECT_CODE'];
$content .= '<th style="border: 1px solid #cccx">'.$subCode.'</th>';
}
$content .= '<th style="border: 1px solid #cccx">A</th><th style="border: 1px solid #cccx">B</th><th style="border: 1px solid #cccx">C</th><th style="border: 1px solid #cccx">D</th><th style="border: 1px solid #cccx">E</th><th style="border: 1px solid #cccx">U</th></tr>';

?>
