<?php
  extract($_POST);
  $conn=mysqli_connect('localhost','root','','house');
  if(isset($_POST['dateofrent'])){
    $purpose=$_POST['purpose'];
    $next=$_POST['dateofrent'];
    $amount=$_POST['amount'];
    $sql="INSERT INTO `rent_intimations` (`purpose`,`date`,`amount`) VALUES('$purpose','$next','$amount')";
    $response=array();
    if(mysqli_query($conn,$sql)){
      $response['success']='Intimation Saved.';
    }
    else{
      $response['error']='Error while adding Initmation';
    }
    echo json_encode($response);
  }

  if(isset($_POST['showamc'])){
    $data ='';
    $sum=0;
    $query = 'SELECT * FROM rent_intimations ';
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
      $data .='
      <table class="table table-bordered" id="amctba">
      <thead>
      <th>Sr No.</th>
      <th>Purpose</th>
      <th>Amount</th>
      <th>Date</th>
      <th>Manage</th>
      </thead>
      <tbody>
      ';
      $num = 1;
      while($row=mysqli_fetch_array($result)){
        $sum += $row['amount'];
        $data .='<tr>
        <td>'.$num.'</td>
        <td>'.$row['purpose'].'</td>
        <td>'.date('d-m-Y',strtotime($row['date'])).'</td>
        <td>'.$row['amount'].'</td>
        <td><button class="btn btn-outline-danger" onclick="delamc('.$row['id'].')">Delete</button></td>
        </tr>';
        $num++;
      }
      $data .='<tfoot>
      <td colspan="3" align="right"><b>Total</b></td>
      <td>'.$sum.'</td>
      <td></td>
      </tfoot>
      </tbody>
      </table>';
    }
    echo $data;
  }
if(isset($_POST['delamcid'])){
  $id=$_POST['delamcid'];
  $q1 = "DELETE FROM rent_intimations WHERE id = '$id'";
  if(mysqli_query($conn,$q1)){
    echo 'success';
  }
}
  if(isset($_POST['get_amc'])){
    $today=strtotime('today');
    $sql="SELECT * FROM amc";
    $result=mysqli_query($conn,$sql);
    $data='';
    if(mysqli_num_rows($result)>0){
  
      while($row=mysqli_fetch_assoc($result)){
   
        $diff=(strtotime($row['next'])-$today)/60/60/24;
        if($diff<8 && $diff>=0){
          $data.='<div class="font-weight-bold card bg-light"><p class="ml-3 text-danger">Your Payment for '.$row['purpose'].' of amount '.$row['amount'].' is due in '.$diff.' days on <span class="font-weight-bold text-dark">'.date("d-m-Y",strtotime($row['next'])).'</span></p>
          <button class="btn btn-sm btn-success btn-md ml-auto" onclick="checkdone('.$row['id'].')" style="width: 190px;">Disable Notification /<br> Mark as paid</button></div>';
        }
      }
    }
    echo $data;
  }
  if(isset($_POST['check'])){
    $id=$_POST['id'];
    $sql="SELECT next,days FROM amc WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $newdate=date('Y-m-d',strtotime($row['next'].'+'.$row['days'].' days'));
    echo $newdate;
    $sql="UPDATE amc SET next='$newdate' WHERE id='$id'";
    mysqli_query($conn,$sql);
  }
  
?>