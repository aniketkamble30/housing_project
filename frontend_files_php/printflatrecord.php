<?php
extract($_POST);
$html ="";
date_default_timezone_set("Asia/Calcutta");
  $today = date("d-m-y");
  $conn = mysqli_connect( 'localhost','root',"",'house' );
if(isset($_POST['rownum'])){

$flatno = $_POST['rownum'];

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf([
  	'margin_left' => 5,
  	'margin_right' => 5,
  	'margin_top' => 8,
  	'margin_bottom' => 8,
  	'margin_header' => 10,
  	'margin_footer' => 10
  ]);
  $mpdf->showImageErrors = true;
$html .= '
<html>
<head>
<style>
</style>
</head>
<body style="font-family:calibri;padding: 5px;">';
  $seperator=",";
  $file_name='../CSVs/history/flat_owner.csv';
  $file=fopen($file_name,'r');
  $size=filesize($file_name);
  $rep=fgetcsv($file,$size,$seperator);
$r=0;
        $file__toread_name='../CSVs/history/flat_owner.csv';
        $row = 1;
        $mycsvfile = array(); //define the main array.
        $response = array();
        if (($hand = fopen("$file__toread_name", "r")) != FALSE) {
        while (($data = fgetcsv($hand, 1000, ",")) != FALSE) {
            $num = count($data);
            $row++;
            $mycsvfile[] = $data; //add the row to the main array.
        }
        fclose($hand);
        }
        echo '<script>console.log("../DB_docs_images/flat_owner/'.$mycsvfile[$flatno][0].'/'.$mycsvfile[$flatno][30].'");</script>';
        $html.=' <h2>Details of Flat: '.$mycsvfile[$rownum][0].'</h2>
          <table class="">
          <tr>
            <td style="margin-left:20pt">Owner 1 Photo:</td>
            <td style="margin-left:20pt">Owner 2 Photo:</td>
            <td style="margin-left:20pt">Spouse Photo:</td>
          </tr>
            <tr>';
            if($mycsvfile[$flatno][30] != ''){
            $html.=' <td><img src="../DB_docs_images/flat_owner'.$mycsvfile[$flatno][0].'/'.$mycsvfile[$flatno][30].' " alt="" width="150pt" height="150pt" style="margin:20pt"></td>';
            }
            else{
              $html.='<td><img src="../assets/image/notfound.jpg" alt="image not added" width="150pt" height="150pt" style="margin:20pt"></td>';
            }  
            if($mycsvfile[$flatno][31] != ''){
            $html.=' <td><img src="../DB_docs_images/flat_owner'.$mycsvfile[$flatno][0].'/'.$mycsvfile[$flatno][31].' " alt="" width="150pt" height="150pt" style="margin:20pt"></td>';
            }
            else{
              $html.='<td><img src="../assets/image/notfound.jpg" alt="image not added" width="150pt" height="150pt" style="margin:20pt"></td>';
            }  
            if($mycsvfile[$flatno][32] != ''){
            $html.=' <td><img src="../DB_docs_images/flat_owner'.$mycsvfile[$flatno][0].'/'.$mycsvfile[$flatno][32].' " alt="" width="150pt" height="150pt" style="margin:20pt"></td>';
            }
            else{
              $html.='<td><img src="../assets/image/notfound.jpg" alt="image not added" width="150pt" height="150pt" style="margin:20pt"></td>';
            }  
    $html.='</tr>
            <tr><td style="border-bottom:1px solid lightgray;" colspan="3" height="35pt"></td></tr>
          </table>
        <table width="100%">';

for($i=0;$i<17;$i++){ 
  $html.='<tr> ';
    for($j=0;$j<2;$j++){
      if($r == 30||$r == 31||$r==32){}
        else{
          $html.='<td>
         <b>'.$rep[$r].':</b>'.$mycsvfile[$flatno][$r].'             
        </td>';           
        }
    $r++;
  }
  if($r != 30 && $r != 31 &&  $r != 32){
  $html.='</tr><tr><td style="border-bottom:1px solid lightgray;" colspan="2" height="15pt"></td></tr>';
}

}


$html.='
</table>
</body>
</html>
';
$invoicename = $mycsvfile[$flatno][0].'.pdf';
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
// $mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Flat Records");
$mpdf->SetAuthor("Co-operative Housing society");
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
}












//------------------------------------------------------------------------------
if($_POST['trownum']){

  
$flatno = $_POST['trownum'];

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
  'margin_left' => 5,
  'margin_right' => 5,
  'margin_top' => 8,
  'margin_bottom' => 8,
  'margin_header' => 10,
  'margin_footer' => 10
]);
$mpdf->showImageErrors = true;
$html .= '
<html>
<head>
<style>
</style>
</head>
<body style="font-family:calibri;padding: 5px;">';
$seperator=",";
$file_name='../CSVs/history/flat_tenant.csv';
$file=fopen($file_name,'r');
$size=filesize($file_name);
$rep=fgetcsv($file,$size,$seperator);
$r=0;
      $file__toread_name='../CSVs/history/flat_tenant.csv';
      $row = 1;
      $mycsvfile = array(); //define the main array.
      $response = array();
      if (($hand = fopen("$file__toread_name", "r")) != FALSE) {
      while (($data = fgetcsv($hand, 1000, ",")) != FALSE) {
          $num = count($data);
          $row++;
          $mycsvfile[] = $data; //add the row to the main array.
      }
      fclose($hand);
      }
      
      $html.=' <h2>Details of Flat: '.$mycsvfile[$trownum][0].'</h2>
        <table class="">
        <tr>
          <td style="margin-left:20pt">Owner Photo:</td>
        </tr>
        <tr>';
            if($mycsvfile[$flatno][11] != ''){
            $html.=' <td><img src="../DB_docs_images/flat_tenant/'.$mycsvfile[$flatno][0].'/'.$mycsvfile[$flatno][11].' " alt="" width="150pt" height="150pt" style="margin:20pt"></td>';
            }
            else{
              $html.='<td><img src="css/notfound.jpg"alt="image not added" width="150pt" height="150pt" style="margin:20pt"></td>';
            }  
    $html.='</tr>
        </table>
      <table width="100%">';

for($i=0;$i<8;$i++){ 
$html.='<tr> ';
        $html.='<td>
       <b>'.$rep[$r].':</b>'.$mycsvfile[$flatno][$r].'             
      </td>';     
  $r++;
  $html.='</tr>
  <tr><td style="border-bottom:1px solid lightgray;" colspan="2" height="15pt"></td></tr>';
}




$html.='
</table>
</body>
</html>
';
$invoicename = $mycsvfile[$trownum][0].'.pdf';
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
// $mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Tenant Records");
$mpdf->SetAuthor("Co-operative Housing society");
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
}


//-----------------------shop below-----------------------------------------
if($_POST['srownum']){

  
  $flatno = $_POST['srownum'];
  
  $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
  require_once $path . '/vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf([
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 8,
    'margin_bottom' => 8,
    'margin_header' => 10,
    'margin_footer' => 10
  ]);
  $mpdf->showImageErrors = true;
  $html .= '
  <html>
  <head>
  <style>
  </style>
  </head>
  <body style="font-family:calibri;padding: 5px;">';
  $seperator=",";
  $file_name='../CSVs/history/shop_owner.csv';
  $file=fopen($file_name,'r');
  $size=filesize($file_name);
  $rep=fgetcsv($file,$size,$seperator);
  $r=0;
        $file__toread_name='../CSVs/history/shop_owner.csv';
        $row = 1;
        $mycsvfile = array(); //define the main array.
        $response = array();
        if (($hand = fopen("$file__toread_name", "r")) != FALSE) {
        while (($data = fgetcsv($hand, 1000, ",")) != FALSE) {
            $num = count($data);
            $row++;
            $mycsvfile[] = $data; //add the row to the main array.
        }
        fclose($hand);
        }
        
        $html.=' <h2>Details of Shop: '.$mycsvfile[$srownum][0].'</h2>
          <table class="">
          <tr>
            <td style="margin-left:20pt">Owner Photo:</td>
          </tr>
            <tr>';
            if($mycsvfile[$flatno][12] != ''){
            $html.='<td><img src="../DB_docs_images/shop_owner/'.$mycsvfile[$flatno][0].'/'.$mycsvfile[$flatno][12].' " alt="" width="150pt" height="150pt" style="margin:20pt"></td>';
            }
            else{
              $html.='<td><img src="css/notfound.jpg"alt="image not added" width="150pt" height="150pt" style="margin:20pt"></td>';
            }  
    $html.='</tr>
          </table>
        <table width="100%">';
  
  for($i=0;$i<11;$i++){ 
  $html.='<tr> ';
          $html.='<td>
         <b>'.$rep[$r].':</b>'.$mycsvfile[$flatno][$r].'             
        </td>';     
    $r++;
    $html.='</tr>
    <tr><td style="border-bottom:1px solid lightgray;" colspan="2" height="15pt"></td></tr>';
  }
  
  
  
  
  $html.='
  </table>
  </body>
  </html>
  ';
  $invoicename = $mycsvfile[$srownum][0].'.pdf';
  $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
  // $mpdf->SetProtection(array('print'));
  $mpdf->SetTitle("Shop Records");
  $mpdf->SetAuthor("Co-operative Housing society");
  $mpdf->SetDisplayMode('fullpage');
  $mpdf->WriteHTML($html);
  $mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
  }