<?php
$conn=mysqli_connect('localhost','root','','house');

if(isset($_POST['read'])){
   // $tt="SELECT a.*,b.* FROM pollrecord AS a, opoll AS b ORDER BY end_date DESC";
   $tt="SELECT * FROM `pollrecord` ORDER BY `end_date` DESC";
   $vv="SELECT quest1 FROM `opoll`";
    $data='';
    $r=mysqli_query($conn,$tt);
    $rr=mysqli_query($conn,$vv);
    $roww=mysqli_fetch_array($rr);

    if(mysqli_num_rows($r) > 0){
        $data.='
        <table class="table table-hover table-bordered">
          <thead>
            <th>id</th>
            <th>question</th>
            <th>start date</th>
            <th>end date</th>
          </thead>
          <tbody>' ;
          $no=1;
          while ($row = mysqli_fetch_array($r)) {
             
            if($row['questions']==$roww['quest1']){
              continue;
            }

            $data.= '<tr onclick="pollres(\''.$row['id'].'\',\''.$row['option1'].'\',\''.$row['count1'].'\',\''.$row['option2'].'\',\''.$row['count2'].'\',\''.$row['count3'].'\',\''.$row['questions'].'\')" id='.$no.'>
              <td style="width:10%;">'.$no.'</td>
              <td style="width:50%;">'.$row['questions'].'</td>
              <td style="width:20%;">'.$row['startdate'].'</td>
              <td style="width:20%;">'.$row['end_date'].'</td>
              </tr>';
              $no++;
        
        
    }
        $data .='</tbody></table>';
        
    }
    echo $data;
}

?>