<?php
$html ="";
date_default_timezone_set("Asia/Calcutta");
  $today = date("d-m-y");
  $conn = mysqli_connect( 'localhost','root',"",'house' );

$flatno = $_POST['id'];
$displayquery = "SELECT * FROM shop_owner_details WHERE shop_no ='$flatno'";
$result = mysqli_query($conn,$displayquery);
$row = mysqli_fetch_array($result);

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
$html .= '
<html>
<head>
<style>
</style>
</head>
<body style="font-family:calibri;padding: 5px;">
  <h2>Details of Shop: '.$row['shop_no'].'</h2>
  <br>
  <div style="border:1px solid white">
    <table width="100%">
    <tr>
      <td>Owner 1:</td>
      <td>Owner 2:</td>
    </tr>
    <tr>';
    $row['image1'] != NULL ? $html .='<td><img style="border:1px solid black;width:200px;height:150px;margin:20px" src="../DB_docs_images/shop_owner/'.$row['shop_no'].'/'.$row['image1'].'"/></td>' 
    : $html.='<td width="30%">No Image Added</td>';
    $row['image2'] != NULL ? $html .='<td><img style="border:1px solid black;width:200px;height:150px;margin:20px" src="../DB_docs_images/shop_owner/'.$row['shop_no'].'/'.$row['image2'].'"/></td>' 
    : $html.='<td width="30%">No Image Added</td>';
    // <td><img  style="border:1px solid black;width:250px;height:250px;margin:20px" src="../DB_docs_images/shop_owner/'.$row['shop_no'].'/'.$row['image1'].'" ></td>
    // <td><img  style="border:1px solid black;width:250px;height:250px;margin:20px" src="../DB_docs_images/shop_owner/'.$row['shop_no'].'/'.$row['image2'].'" ></td>
   $html.=' 
    </tr>
        <tr>
        <td  colspan="2" style="font-size:15pt;border-bottom: 1px solid gray;">
            <p>Shop Details</p></td>
          </tr>
          <tr><td colspan="2" height="15pt"></td></tr>
      <tr>
        <td>
          <b>Owner Name: </b>'.$row['name1'].'
        </td>
        <td>
          <b>Shop Ownership Type:</b> '.$row['type_of_ownership'].'
        </td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>
      <tr> 
        <td>
          <b>Move In Date :</b>'.date('d-m-Y',strtotime($row['indate'])).'
        </td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>



      <!-- owner 1 details -->
      <tr>
        <td  colspan="2" style="font-size:17pt;border-bottom: 1px solid gray;">
          <p>Owner 1 Details:</p>
        </td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>
      <tr>
        <td colspan="2"><b>Name :</b>'.$row['name1'].'</td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>
      <tr>
        <td><b>Date Of Birth:</b>'.date('d-m-Y',strtotime($row['dob1'])).'</td>
        <td><b>Email:</b>'.$row['email1'].'</td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>
      <tr>
        <td colspan="2"><b>Mob:</b>'.$row['phoneno1'].'</td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>';


      if($row['type_of_ownership']=='joint'){
      $html.='<tr>
      <td  colspan="2" style="font-size:17pt;border-bottom: 1px solid gray;">
          <p>Owner 2 Details:</p>
        </td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>
      <tr>
        <td><b>Date Of Birth:</b>'.$row['dob2'].'</td>
        <td><b>Email:</b>'.$row['email2'].'</td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>
      <tr>
        <td colspan="2"><b>Mob:</b>'.$row['phoneno2'].'</td>
      </tr>
      <tr><td colspan="2" height="15pt"></td></tr>';
      }


      $html .='
        <tr>
          <td colspan="2" style="font-size:17pt;border-bottom: 1px solid gray;">
          <p>Other Details</p></td>
        </tr>
        <tr><td colspan="2" height="15pt"></td></tr>
        <tr>
        <td height="15pt"><b>In Date :</b> '.$row['indate'].'</td>
        <td  align="left" height="15pt"><b>Out Date :</b> '.$row['outdate'].'</td>
        </tr>';
       
      $html .='
    </table>
  </div>
</body>
</html>
';
$invoicename = $row['shop_no'].'.pdf';

// $mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Maintenance Invoice");
$mpdf->SetAuthor("Co-operative Housing society");
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
