<?php
$conn = mysqli_connect('localhost','root','','house');

if(isset($_POST['readhistory'])){

$data='';
$displayquery = "SELECT * FROM qarecord ORDER BY id DESC";
$result = mysqli_query($conn,$displayquery);


if(mysqli_num_rows($result) > 0){


  $data.='
    <table class="table table-hover table-bordered" id="mycomp">
      <thead>
        <th>id</th>
        <th>question</th>
        <th>started on</th>
        <th>ended on</th>
      </thead>
      <tbody>';
  $number = 1;
  while ($row = mysqli_fetch_array($result)) {

    $data.= '<tr onclick="file('.$row['file_name'].')">
      <td style="width:10%;">'.$number.'</td>
      <td style="width:50%;">'.$row['question'].'</td>
      <td style="width:20%;">'.date('d-m-Y',strtotime($row['start_date'])).'     
     <td style="width:20%;">'.date('d-m-Y',strtotime($row['end_date'])).'</td>
      </tr>';
      $number++;

}
$data .='</tbody></table>';
echo $data;
}
}


if(isset($_POST['id']) && isset($_POST['id']) != ""){

$filename=$_POST['id'];
$data ='';
$www = "SELECT * FROM qarecord where file_name=$filename";
$ult=mysqli_query($conn,$www);
$toe=mysqli_fetch_assoc($ult);
$quest=$toe['question'];
$data.="<table class='table mt-3'><tr>
        <td><b>Question : </b> ".$quest."</td>
        <td><b>Added On :</b> ".date('d-m-Y',strtotime($toe['start_date']))."</td>
        <td><b>Ended On :</b> ".date('d-m-Y',strtotime($toe['end_date']))."</td>
        <tr></table>";


$file=fopen("../CSVs/suggestion/".$filename.".csv","r");

$data .='
<table class="table table-bordered">
                  <thead>
                  <th width="10%">id</th>
                  <th width="10%">Flat No</th>
                  <th width="60%">Comment</th>
                  <th width="20%">Date</th>
                  </thead>';

while(!feof($file)){
$fields = fgetcsv($file);
$data .= '<tr>';

if(@count($fields)>1){
  for($i =0 ;$i<3;$i++){
   $data .= '<td>'.$fields[$i].'</td>';
  }
  $fields[3] == '0000-00-00 00:00:00'  ? ($data .="<td>No Comment Added</td>") 
                              : ($data .="<td>".date('d-m-Y',strtotime($fields[3]))."</td>") ;
  ;
//  foreach ($fields as $field) {
//    $data .= '<td>'.$field.'</td>';
//  }
}
$data .= '</tr>';
}

$data .= '
</table>';

echo $data;

}
error_reporting(E_WARNING);
