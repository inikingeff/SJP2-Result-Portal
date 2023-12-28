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
$content .= '<table  style="width:1000px; border-collapse: collapse" ><tr ><td class="banner" style="width:200px"><img style="width:160px" src="' . $woocommerce_gift_coupon_logo_base64 . '"></td><td class="banner" style="width:550px;padding-left:50px" align="left"><h1>SAINT JOHN PAUL II COLLEGE</h1><h2 align="center">SHELTER AFRIQUE, UYO</h2><h3 align="center">FIRST TERM 2021/2022 ACADEMIC SESSION</h3><h4 align="center">MID TERM RESULT</h4>

<table  ><tr><th></th><th></th><th></th></tr></table></DIV><td class="banner" style="width:200px"><img style="width:160px" src="' . $path_logo_base64 . '"></td></tr></table>

<table  style="width:1000px; border-collapse: collapse;padding-top:20px">
<tr><th colspan="4" style="width:400px">NAME :'.$std_name.' </th>
<th colspan="3" >ADMISSION NO. : '.$std_adm_num.'</th>
<th colspan="4">CLASS :'.$classes.'</th>
</tr>
<tr><th colspan="4" style="width:400px; padding-top:15px"></th>
<th colspan="3" ></th>
<td style="padding-bottom:10px; font-size:12px; font-weight:bold" colspan="4">School Resumes : Nov. 1st., 2021</td>
</tr>
<tr><th style="width:150px; border: 1px solid #ccc">SUBJECTS</th>
<th colspan="10" style="width:520p; border: 1px solid #cccx">PERFORMANCE</th>
</tr>
<tr>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px"></td>
<td colspan="10"></td>
</tr>

<tr><td style="text-align:center; border: 1px solid #ccc;font-size:12px"></td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">CLASS WORK</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">ASSIGNMENT</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Welcome TEST</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Mid Term TEST</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">TOTAL</td>

<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Class Avg.</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Class High Score</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Class Low Score</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Grade</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px">Effort</td>
</tr>

<tr><td style="text-align:center; border: 1px solid #ccc;font-size:12px"></td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable"  align="center">20</td>
<td  style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold " class="obtainable" align="center">20</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable" align="center" >20</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable" align="center" >40</td>
<td  style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable" align="center" >100</td>

<td  style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable" align="center" >100</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable"  align="center" > 100</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px; font-weight:bold" class="obtainable"  align="center" >100</td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px" class="obtainable"  align="center" ></td>
<td style="text-align:center; border: 1px solid #ccc;font-size:12px"></td>
</tr>';

?>