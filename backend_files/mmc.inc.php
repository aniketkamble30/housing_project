 <?php 
 error_reporting(E_PARSE & ~E_NOTICE);
$conn = mysqli_connect('localhost','root','','house');

   if(isset($_POST['justshow'])){
    $data ='';
    // $sink = $_POST['sink'];
    // $rep= $_POST['rep'];
    $const_cost = $_POST['construction'];
    $insurance= $_POST['insu'];
    $sqftarea = $_POST['sqftarea'];
    $water = $_POST['water'];
    $electricity = $_POST['elec'];
    $service = $_POST['servico'];
    $water_shop = $_POST['water_shop'];
    $electricity_shop = $_POST['elec_shop'];
    $service_shop = $_POST['servico_shop'];
    $lift = $_POST['lifto'];
    $security = $_POST['security'];

    $te= "SELECT `flat_no`,`flat_dimensions` FROM `flat_details` WHERE 1";
    $res = mysqli_query($conn,$te);
    $shop = "SELECT `shop_no`,`shop_dimensions` FROM `shop_details` WHERE 1";
    $sow = mysqli_query($conn,$shop);
    if(mysqli_num_rows($res) > 0){
      // $num = mysqli_num_rows($res);
      $num=136;
      
      $data .='';
      $data .=' 
            <div class="row align-items-center" style="width:100%">
              <div class="col-6">
                <h3 >Member Per Month Charges</h3>
              </div>
              <div class="col-6 border-left">
                <button class="btn w-75 float-right btn-dark m-2" onclick="applycharges()">Click Here to Apply These charges <i class="far fa-edit"></i></button>
              </div>
              </div><hr class="border-bottom border-dark">
                <div class="pb-3 pt-3 border-bottom border-top border-secondary" style="width:100%">
                  <nav class="nav nav-pills border-bottom border-top  m-2  nav-justified">      
                    <a class="nav-item nav-link active" id="ftogo" href="JavaScript:void(0);" onclick="ftog()">Flat</a>
                    <a class="nav-item nav-link" id="stogo" href="JavaScript:void(0);" onclick="stog()">Shop</a>
                  </nav>
                </div>
                  <div id="flat" class="table-responsive p-2">
                  <table class="table table-condensed table-bordered" id="mmctable">
                    <thead style="background-color:#ededed;">
                      <tr>
                        <th>Flat No</th>
                        <th>Flat Dimensions</th>
                        <th>Sinking Funds</th>
                        <th>Repair Funds</th>
                        <th>Insurance Charges</th>
                        <th>Water Charges</th>
                        <th>Electricity Charges</th>
                        <th>Lift Charges</th>
                        <th>Security Charges</th>
                        <th>Service Charges</th>
                        <th>Total Charges</th>
                      </tr>
                    </thead>
                    <tbody>';
      while ($row = mysqli_fetch_array($res)) {
             $data .='<tr>
                        <td>'.$row['flat_no'].'</td>
                        <td>'.$row['flat_dimensions'].'</td>
                        <td>'.number_format((($row['flat_dimensions']*$const_cost*(0.25))/1200),2).'</td>
                        <td>'.number_format((($row['flat_dimensions']*$const_cost*(0.75))/1200),2).'</td>
                        <td>'.number_format((($insurance/12)/$num),2).'</td>
                        <td>'.number_format((($water/12)/$num),2).'</td>
                        <td>'.number_format((($electricity/12)/$num),2).'</td>
                        <td>'.number_format((($lift/12)/$num),2).'</td>
                        <td>'.number_format((($security/12)/$num),2).'</td>
                        <td>'.number_format((($service/12)/$num),2).'</td>
                        <td style="background-color:#eee;">
                        '.(number_format(
                            (($row['flat_dimensions']*$const_cost*(0.25))/1200)+
                            (($row['flat_dimensions']*$const_cost*(0.75))/1200)+
                            (($insurance/12)/$num)+
                            (($water/12)/$num)+
                            (($electricity/12)/$num)+
                            (($lift/12)/$num)+
                            (($security/12)/$num)+
                            (($service/12)/$num),2
                            )).'</td>
                      </tr>';
        }
           $data .='</tbody>
                  </table>
                  </div>';
      }
          if(mysqli_num_rows($sow) > 0){   
            $data .='<div id="shop" class="table-responsive p-2" style="display:none;">
            <table class="table table-condensed table-bordered" id="smmct">
              <thead style="background-color:#ededed;">
                <tr>
                  <th>Shop No</th>
                  <th>Shop Dimensions</th>
                  <th>Sinking Funds</th>
                  <th>Repair Funds</th>
                  <th>Insurance Charges</th>
                  <th>Water Charges</th>
                  <th>Electricity Charges</th>
                  <th>Lift Charges</th>
                  <th>Security Charges</th>
                  <th>Service Charges</th>
                  <th>Total Charges</th>
                </tr>
              </thead>
              <tbody>';
            while ($ser = mysqli_fetch_array($sow)) {   
              $data .='<tr>
                        <td>'.$ser['shop_no'].'</td>
                        <td>'.$ser['shop_dimensions'].'</td>
                        <td>'.number_format((($ser['shop_dimensions']*$const_cost*(0.25))/1200),2).'</td>
                        <td>'.number_format((($ser['shop_dimensions']*$const_cost*(0.75))/1200),2).'</td>
                        <td>'.number_format((($insurance/12)/$num),2).'</td>
                        <td>'.number_format((($water_shop/12)/$num),2).'</td>
                        <td>'.number_format((($electricity_shop/12)/$num),2).'</td>
                        <td>'.number_format((($lift/12)/$num),2).'</td>
                        <td>'.number_format((($security/12)/$num),2).'</td>
                        <td>'.number_format((($service_shop/12)/$num),2).'</td>
                        <td style="background-color:#eee;">
                        '.(number_format(
                            (($ser['shop_dimensions']*$const_cost*(0.25))/1200)+
                            (($ser['shop_dimensions']*$const_cost*(0.75))/1200)+
                            (($insurance/12)/$num)+
                            (($water/12)/$num)+
                            (($electricity/12)/$num)+
                            (($lift/12)/$num)+
                            (($security/12)/$num)+
                            (($service/12)/$num),2
                            )).'</td>
                      </tr>';  
            }                  
              $data .='</tbody>
                    </table>
                  </div>';
            
          }
    
    echo ($data);
}

if(isset($_POST['apply'])){
  $const_cost = $_POST['construction'];
  $security= $_POST['security'];
  $insurance= $_POST['insu'];
  $water_shop = $_POST['water_shop'];
  $electricity_shop = $_POST['elec_shop'];
  $service_shop = $_POST['servico_shop'];
  $water = $_POST['water'];
  $electricity = $_POST['elec'];
  $service = $_POST['servico'];
  $lift = $_POST['lifto'];
  $interest = $_POST['interest'];
  $rebate = $_POST['rebate'];
  $apply = $_POST['apply'];

$query = "UPDATE `charges` SET 
`const_cost`='$const_cost',
`security`='$security',
`interest`='$interest',
`rebate`='$rebate',
`insurance`='$insurance',
`lift_char`='$lift',
`water_char`='$water',
`elec_char`='$electricity',
`serv_char`='$service',
`water_shop`='$water_shop',
`elec_shop`='$electricity_shop',
`serv_shop`='$service_shop'
 WHERE 1";

  $output = mysqli_query($conn,$query);
  if($output){
    echo 'done';
  }
}

if(isset($_POST['getmmc'])){
  
  $tec= "SELECT * FROM `charges` WHERE 1";
  $res1 = mysqli_query($conn,$tec);
           $rop = mysqli_fetch_array($res1);   
           $data .='
           <table class="table table-bordered">
           <tr style="background-color:#e6e6e6;">
             <td colspan="4" class="font-weight-bold">A. Area Wise Contribution</td>
           </tr>
           <tr>
             <td colspan="2" style="background-color:#f9f9f9;">Construction Costs : </td>
             <td colspan="2">'.$rop['const_cost'].'</td>
           </tr>
           <tr style="background-color:#e6e6e6;">
             <td colspan="4" class="font-weight-bold">B. Equal Contribution</td>
           </tr>
           <tr>
             <td colspan="2" style="background-color:#f9f9f9;">Interest For Late/Due Payments(Yearly %) : </td>
             <td colspan="2">'.$rop['interest'].'</td>
           </tr>
           <tr>
             <td colspan="2" style="background-color:#f9f9f9;">Rebate for Early Payments(Yearly %): </td>
             <td colspan="2">'.$rop['rebate'].'</td>
           </tr>
           <tr>
             <td colspan="2" style="background-color:#f9f9f9;">Annual Building Insurance Amount : </td>
             <td colspan="2">'.$rop['insurance'].'</td>
           </tr>
           <tr>
             <td colspan="2" style="background-color:#f9f9f9;">Annual Security Charges : </td>
             <td colspan="2">'.$rop['security'].'</td>
           </tr>
           <tr>
             <td colspan="2" style="background-color:#f9f9f9;">Annual Lift Charges : </td>
             <td colspan="2">'.$rop['lift_char'].'</td>
           </tr>
           <tr style="background-color:#e6e6e6;">
             <td colspan="2" class="font-weight-bold">Flat Charges</td>
             <td colspan="2" class="font-weight-bold">Shop Charges</td>
           </tr>
           <tr>
             <td style="background-color:#f9f9f9;">Annual Water Charges : </td>
             <td>'.$rop['water_char'].'</td>
             <td style="background-color:#f9f9f9;">Annual Water Charges : </td>
             <td>'.$rop['water_shop'].'</td>
             </tr>
             <tr>
             <td style="background-color:#f9f9f9;">Annual Electricity Charges : </td>
             <td>'.$rop['elec_char'].'</td>
             <td style="background-color:#f9f9f9;">Annual Electricity Charges : </td>
             <td>'.$rop['elec_shop'].'</td>
             </tr>
             <tr>
             <td style="background-color:#f9f9f9;">Annual Service Charges </td>
             <td>'.$rop['serv_char'].'</td>
             <td style="background-color:#f9f9f9;">Annual Service Charges : </td>
             <td>'.$rop['serv_shop'].'</td>
           </tr>
         </table>';
echo $data;
                  }
?>