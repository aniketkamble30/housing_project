<?php
$html ="";
date_default_timezone_set("Asia/Calcutta");
  $today = date("d-m-y");
  $conn = mysqli_connect( 'localhost','root',"",'house' );

$flat_no = $_GET['flat_no'];
$usertype= $_GET['usertype'];
if($usertype=='resident'){

	$sql ="SELECT p.flat_dimensions,a.*,d.*
	FROM flat_details AS p
	INNER JOIN charges AS a
	INNER JOIN due AS d WHERE p.flat_no = '$flat_no' AND d.flat_no = '$flat_no'";
	$nes = mysqli_query($conn,$sql);
	$riw = mysqli_fetch_assoc($nes);
	$flat_dimensions=$riw['flat_dimensions'];
	$query1="SELECT flat_owner1_name FROM flat_owner_details WHERE flat_no='$flat_no'";
	$result1 = mysqli_query($conn,$query1);
	$row1=mysqli_fetch_assoc($result1);
	$name=$row1['flat_owner1_name'];
}
else if($usertype=='shop'){
	$sql ="SELECT p.shop_dimensions,a.*,d.*
	FROM shop_details AS p
	INNER JOIN charges AS a
	INNER JOIN due AS d WHERE p.shop_no = '$flat_no' AND d.flat_no = '$flat_no'";
	$nes = mysqli_query($conn,$sql);
	$riw = mysqli_fetch_assoc($nes);
	$flat_dimensions=$riw['shop_dimensions'];
	$query1="SELECT name1 FROM shop_owner_details WHERE shop_no='$flat_no'";
	$result1 = mysqli_query($conn,$query1);
	$row1=mysqli_fetch_assoc($result1);
	$name=$row1['name1'];
}
// $query1="SELECT flat_owner1_name FROM flat_owner_details WHERE flat_no='$flat_no'";
// $result1 = mysqli_query($conn,$query1);
// $row1=mysqli_fetch_assoc($result1);

$query2="SELECT * FROM charges";
$result2 = mysqli_query($conn,$query2);
$row2=mysqli_fetch_assoc($result2);
	
$query3="SELECT * FROM due WHERE flat_no='$flat_no'";
$result3 = mysqli_query($conn,$query3);
$row3=mysqli_fetch_assoc($result3);

// $query4="SELECT flat_dimensions FROM flat_details WHERE flat_no='$flat_no'";
// $result4 = mysqli_query($conn,$query4);
// $row4=mysqli_fetch_assoc($result4);

if($row3['isdue']==1){
  $days_due = $row3['days_due'];
  $num_quarters=intdiv($days_due,93)+1;
}

$vyaj = ($flat_dimensions*$row2['mpsf']*$row2['interest'])/100;
$normal = $flat_dimensions*$row2['mpsf'];
$totalpending =   ($normal+$vyaj)*$num_quarters;

$current_month=explode('-',$today);
$current_month=intdiv($current_month[1],1);
$current_quarter=0;
if($current_month>=1 && $current_month<=3)
  $current_quarter=4;
else if($current_month>=3 && $current_month<=6)
  $current_quarter=1;
else if($current_month>=6 && $current_month<=9)
  $current_quarter=2;
else if($current_month>=9 && $current_month<=12)
  $current_quarter=3;

$num = 136;
$sink = ($flat_dimensions*$row2['const_cost']*(0.25))/1200;
$repair =($flat_dimensions*$row2['const_cost']*(0.75))/1200;

$insurance = ($row2['insurance']/12)/$num;
$water = ($row2['water_char']/12)/$num;
$electricity =($row2['elec_char']/12)/$num;
$lift =  ($row2['lift_char']/12)/$num;
$security =($row2['security']/12)/$num;
$service = ($row2['serv_char']/12)/$num;
$maintenancepm =( $sink + $repair  )+ ($insurance + $water + $electricity + $lift + $security + $service);

if($current_quarter==1){
  $amount1=$maintenancepm*3;
  $amount1=number_format($amount1,2);
  $amount2=$maintenancepm*6;
  $amount2=number_format($amount2,2);
  $amount3=$maintenancepm*12;
  $amount3=number_format($amount3,2);
}
else if($current_quarter==2){
  $amount1=$maintenancepm*3;
  $amount1=number_format($amount1,2);
  $amount2=$maintenancepm*6;
  $amount2=number_format($amount2,2);
  $amount3='NA';
}
else if($current_quarter==3){
  $amount1=$maintenancepm*3;
  $amount1=number_format($amount1,2);
  $amount2=$maintenancepm*6;
  $amount2=number_format($amount2,2);
  $amount3='NA';
}
else if($current_quarter==4){
  $amount1=$maintenancepm*3;
  $amount1=number_format($amount1,2);
  $amount2='NA';
  $amount3='NA';
}
// echo $totalpending;

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 48,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10
]);
$html .= '
<html>
<head>
<style>
body {font-family: calibri;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; text-align:center;}
.items td {
	border-bottom:0.1mm solid black;
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items th {
	font-size: 11pt;
	border-bottom:0.1mm solid black;
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #125d11;
	font-size: 12pt;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
.upper td{
	font-size:15px;
	margin-bottom:2px;
	text-align:left;

}
.ani table{
	border-collapse:collapse;
}
.ani table,.ani th,.ani td {
	border: 1px solid #000000;
	font-size:15px;
}
.note td{
	font-size:15px;
	font-weight:bold;
	width:800px;
	text-align:left;
}
.mar{
	margin-left:100px;
}
.last{
		font-size:15px;
}
</style>
</head>
<body>
<!--mpdf
<htmlpageheader name="myheader">
<table width="100%">
<tr>
<td width="10%" style="text-align: right;"><img src="css/logo.png" width="150pt" alt=""></td>
<td align="center" width="90%" style="color:#0000BB; ">
<span style="font-weight: bold; font-size: 18pt;">
SHREE AMBICA HERITAGE CO-OP HOUSING<br>SOCIETY</span>
<br><span style="font-size:12pt;">
Plot No. 1,
Sector-1, 
Kharghar, 
Navi Mumbai-410210</span>
<hr>
</td>
</tr>
<tr><td colspan=2 align="right" style="font-size:12pt"><b>Dated : '.$today.'</b></td></tr>
</table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->


<div style="width:100%;text-align:center;font-weight:bold;font-size:15pt;">INVOICE</div>
<div style="width:100%;text-align:center;font-weight:bold;font-size:15pt;"><u>SOCIETY MAINTANCE CHARGES</u></div>
<div class="upper">
<br>
<br>
<table>
<tr>
<td colspan="15">Bill To: Mr./Mrs. '.$name.'</td>
<td colspan="5">Bill No.<u>1234/II/</u></td>
</tr>
<tr>
<td colspan="14">Flat/Office/ Shop No.: '.$flat_no.'</td>
<td colspan="7">Due date (Payment): '.$row3['due_date'].'</td>
</tr>
<tr>
<td colspan="15">Bill Period: II Quater (Month:JULY,AUGUST,SEPTEMBER,2019) </td>
<tr>
</table><br>
</div>	
<div class="ani">
<table>
<tr>
<td colspan="4">Maintenance Charges Payable</td>
<td colspan="4">Arrears / Due payment</td>
<td colspan="4">Built-up area specified by Builder for your Flat/Shop & Office</td>
<td colspan="4">Amount Payable per Quater. (3 months)</td>
<td colspan="4">Amount Payable per Half Year(6 months)</td>
<td colspan="4">Amount Payable per Year (12 months)</td>
</tr>
<tr style="height:100px;">
<td colspan="4">@ Rs.2.50 per month per sqaure feet of Built-up area</td>
<td colspan="4">Rs. '.$totalpending.'</td>
<td colspan="4"> '.$flat_dimensions.' <b>Sq.ft</b></td>
<td colspan="4">Rs. '.$amount1.'</td>
<td colspan="4">Rs. '.$amount2.'</td>
<td colspan="4">Rs. '.$amount3.'</td>
</tr>
</table>
<br>
</div>
<div class="note">
<table>
<tr>
<td><b><u>NOTE:</u></b></td>
</tr>
<div class="mar">
<tr>
<td>1. Payment to be mabe by crossed cheque / Demand Draft drawn in favor of "SHREE AMBICA HERITAGE CO-OP. HOUSING SOCIETY (PROPOSED)" payable in Navi Mumbai.</td>
</tr>
<tr>
<td>2. Payment can alsi be made online by NEFT/IMPS Transfer to <u>BANK OF INDIA</u>, Branch- Sector 10, Kharghar, Account Number:<u>019210110002121</u>,IFSC code:<u>BKID0000192.</u></td>
</tr>
<tr>
<td>3. Once the online Transfer is completed, please inform the Society: member\'s Name,Flat/Shop/Office Number,Amount transfered for which period and Transaction Ref./Id of on online transfer on society WhatsApp or e-mail.This will help identify payment made and give credit to the concerned member\'s account.</td>
</tr>
<tr>
<td>4. Non-payment of II quater amount by <u>31-o7-2019</u> is liable to attract interest @21% p.a. from <u>01/08/2019.</u></td>
</tr>
<tr>
<td>5. The Provisional Committee is considering suitable rebate for payment before the due date for six months and twelve months maintenance charges at a time.</td>
</tr>
<tr>
<td>6. Request all members for prompt payment as Society bank balance is too low to meet its immediate commitments\'.</td>
</tr>
</div>
</table>
</div>
<br>
<div class="last">
<p>For Shree Ambica Heritage CHS. (Proposed)</p>
<br><br><br><br><br>
<p>Secretary / Treasurer</p>
</div>
</body>
</html>
';
$invoicename = $row['flat_no'].''.$row['Date'].'.pdf';

// $mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Maintenance Invoice");
$mpdf->SetAuthor("Co-operative Housing society");
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
