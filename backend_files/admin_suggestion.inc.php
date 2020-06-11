<?php
$conn = mysqli_connect('localhost','root','','house');
$d=date('Y-m-d');
if(isset($_POST['readquestion'])){
 
  $data ='';
  $you = "SELECT * FROM qa ORDER BY date DESC";
  $mark = mysqli_query($conn,$you);
  $r = mysqli_fetch_assoc($mark);
  $quest =$r['question'];
  if($r['question']!='' && ($d<$r['end_date'])){

$data.=' <h4>Current Suggestion :</h4><br><p class="h5"> '.$r['question'].'</p>
<input type="button" class="mt-2 btn btn-outline-danger btn-md reset-btn" value="End Suggestion" onclick="badaalert()">';
//<p id="end" name="end"  class="btn btn-outline-danger btn-md" onclick="terminate()">End Current Suggestion</p>
//<input type="button" class="mt-2 btn btn-outline-danger btn-md reset-btn" value="End Suggestion" onclick="badaalert()">
}
else if($d>=$r['end_date'] && $r['question']!='') {
  //--------------------------------------------------

  $query = "SELECT qa_id,flat_no,comment,date from qa";
  mysqli_query($conn,$query);
  $result = mysqli_query($conn, $query);
      $filename =rand().'.csv';
      $output = fopen("../CSVs/suggestion/".$filename, "w");
      while($row = mysqli_fetch_assoc($result)){
        if($row['comment']!="")
        {
           fputcsv($output,$row);
         }
        }
      fclose($output);

  $eee = "SELECT * from qa ORDER BY date DESC";
  $result = mysqli_query($conn, $eee);
  $rowz = mysqli_fetch_assoc($result);
  $sdaate = $rowz['start_date'];
  $edaate= $rowz['end_date'];
  $ques = $rowz['question'];


$qqq = "INSERT INTO qarecord values ('','$ques','$filename','$sdaate','$edaate')";
mysqli_query($conn, $qqq);

$d = "UPDATE qa set question='', comment='', `date`='', `start_date`='', end_date=''";
mysqli_query($conn,$d);

  //--------------------------------------------------
  $data.='<p style="font-size:20px;"> No New Suggestion Added </p>
<button type="button" id="end" name="end"  class="btn btn-danger btn-md disabled" >End Suggestion</button>';
}
else{
  $data.='<p style="font-size:20px;"> No New Suggestion Added </p>
  <button type="button" id="end" name="end"  class="btn btn-danger btn-md disabled" >End Suggestion</button>';
}
echo $data;
}


if(isset($_POST['end'])){
  $data="";
  $query = "SELECT qa_id,flat_no,comment,`date` from qa";
  mysqli_query($conn,$query);
  $result = mysqli_query($conn, $query);
      $filename =rand().'.csv';
      $output = fopen("../CSVs/suggestion/".$filename, "w");
      while($row = mysqli_fetch_assoc($result)){
        if($row['comment']!="")
        {
           fputcsv($output,$row);
         }
        }
      fclose($output);

  $rrtt="UPDATE qa SET end_date='$d'";
  mysqli_query($conn,$rrtt);
  $eee = "SELECT question,`start_date`,end_date from qa ORDER BY `date` DESC";
  $result = mysqli_query($conn, $eee);
  $rowz = mysqli_fetch_assoc($result);
  $sdaate = $rowz['start_date'];
  $edaate = $rowz['end_date'];
  $ques = $rowz['question'];


$qqq = "INSERT INTO qarecord values ('','$ques','$filename','$sdaate','$edaate')";
mysqli_query($conn, $qqq);

$d = "UPDATE qa set question='', comment='', `date`='', `start_date`='', end_date=''";
mysqli_query($conn,$d);
$data.='<p style="font-size:20px;"> No New Suggestion Added </p>
<button type="button" id="end" name="end"  class="btn btn-danger btn-md disabled" >terminate</button>';
 echo $data;
}

if(isset($_POST['limit']) && isset($_POST['start'])){
//if(isset($_POST['suggest'])){
  $d= date('Y-m-d');
  $data="";
  $limit = $_POST['limit'];
 $start = $_POST['start'];
  $query="SELECT * FROM qa ORDER BY date DESC LIMIT $start,$limit";
  $re=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($re))
    {
      if($row['date']!='0000-00-00 00:00:00' && $row['comment']!='' && $row['question']!="" && ($d<$row['end_date']))
      {
        $data.='<div class="card p-2"><div class="card-header" style="border-bottom:1px solid #dee0df">'. $row['flat_no'].': '.$row['comment'].'</div></div>';
      }
    }
echo $data;
}


if(isset($_POST['question']) && isset($_POST['endgame']) && $_POST['endgame']!="" && $_POST['question']!=""){
  $daata="";
$question = $_POST['question'];
$endgame = $_POST['endgame'];
$startdate= date('Y-m-d');
$check = "SELECT * FROM qa";
$result = mysqli_query($conn,$check);
$row = mysqli_fetch_assoc($result);
  if($row['question']==''){

    $qu = "UPDATE qa SET question='$question', comment=NULL, date=null, start_date='$startdate',end_date='$endgame'";
    mysqli_query($conn,$qu);
    $qer= 'UPDATE `useralerts` SET `qa`= 1';
    mysqli_query($conn,$qer);
      // $filename =rand().'.csv';
      // $output = fopen("./suggestion/".$filename, "w");
      // while($row = mysqli_fetch_assoc($result))
      // {
      //      fputcsv($output,$row);
      // }
      // fclose($output);
  //header('location:qa.php');
}
 elseif ($row['question']!='') {
        $daata.='nhi';
}

echo $daata;
}
