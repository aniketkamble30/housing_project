<?php
$conn = mysqli_connect( 'localhost','root',"",'house' );
if(isset($_POST['pollquest'])){
    $pollquest = $_POST['pollquest'];
    $option1 = $_POST['option1'];
      $option2 = $_POST['option2'];
      $enddate=$_POST['enddate'];
    $ty="SELECT `quest1` FROM opoll";
    $lt=mysqli_query($conn,$ty);
    $me = mysqli_fetch_assoc($lt);
      if($me['quest1']!=NULL){
        echo "terminate";
      }

    else{
    $startdate= date('Y-m-d');
    $query = "  UPDATE opoll SET quest1='$pollquest',response1=NULL";
    mysqli_query($conn,$query);
    $qy = "  INSERT INTO pollrecord(questions,option1,option2,startdate,end_date) VALUES ('$pollquest','$option1','$option2','$startdate','$enddate')";
    mysqli_query($conn,$qy);
    }
}

if(isset($_POST['viewpoll'])){
    $viewpoll = $_POST['viewpoll'];
    $flat_no = $_POST['flat_no'];
    $d=date('Y-m-d');
    $data ="";
    $fuery = " SELECT * FROM pollrecord ORDER BY id DESC ";
    $res = mysqli_query($conn,$fuery);
    $row = mysqli_fetch_assoc($res);
    $q= $row['questions'];
    $dd=$row['end_date'];
    if($res && ($d<$dd)){

        $que="SELECT * FROM opoll WHERE quest1 ='$q' AND response1 != ''  AND flat_no='$flat_no'";
        $nes = mysqli_query($conn,$que);  
        $rope = mysqli_fetch_assoc($nes);
        if($rope){
            $data .="<p class='p-3 text-dark ' align='center'>No New Poll Added</p>";
          }
          else{
        $data .='<p class="m-3">'.$row['questions'].'</p>';
        $data .='<div class="p-3" >
                           <select required class="pollo custom-select mr-sm-2" name="purpose">
                             <option>Select</option>';

      if($row['option1'] != ''){
            $data .='<option value="'.$option1.'">'.$row['option1'].'</option>';
          }
        if($row['option2']!=''){   
              $data .='<option value='.$row['option2'].'>'.$row['option2'].'</option>';
            }
            $data .='</select>
          <input type="button"class="btn btn-info m-2" value="Vote" onclick="subpoll()"></p>
        </div>';
    }
  }
  else{
    $data .="<p class='p-3 text-dark ' align='center'>No New Poll Added</p>";
  }
  echo $data;
}

if(isset($_POST['ter'])){
  $d= date('Y-m-d');
  $ery="UPDATE pollrecord SET end_date='$d'" ;
  mysqli_query($conn,$ery);
  $rey="UPDATE opoll SET quest1=NULL, response1=NULL";
  mysqli_query($conn,$rey);
}

if(isset($_POST['pollresults'])){
  $pizza =  '';
  $displayquery = "SELECT response1 FROM opoll";
  $result = mysqli_query($conn,$displayquery);
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {
      $pizza  = $row['response1'];
      echo $pizza;
    }
  }
}
if(isset($_POST['subpoll'])){
  $subpoll = $_POST['subpoll'];
  $ans = $_POST['ans'];
  $flat_no = $_POST['flat_no'];
  $data ="";
    $fuery = " UPDATE opoll SET response1='$ans' WHERE flat_no='$flat_no'";
    $res = mysqli_query($conn,$fuery);
  

    // $ter="SELECT * FROM pollrecord";
    //   if($row['option1']==$ans){
    //     count1=+1
    //   }


}
