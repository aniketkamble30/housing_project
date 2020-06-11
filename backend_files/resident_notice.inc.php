<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

extract($_POST);


if(isset($_POST['notice'])){
 $flat_no=$_POST['flat_no'];
  $data ="";
  $auery = "SELECT `subject` FROM notice ORDER BY notice_id DESC LIMIT 3";
  $res =mysqli_query($conn,$auery);
  $tes = "SELECT `subject` FROM `notice_user` WHERE `receiver`='$flat_no' ORDER BY `id` DESC LIMIT 3";
  $tytt=mysqli_query($conn,$tes);

  if(mysqli_num_rows($res)>0 || mysqli_num_rows($tytt)>0){
    $number=1;
    $data .='';
    while ($row = mysqli_fetch_array($res)) {
      $data .='
      <a href="../frontend_files_php/resident_notice_page.php" style="text-decoration:none;" ><div class="alert alert-info" style="margin-top:2px;">
         '.$number.'. '.$row['subject'].'</div></a>
      ';
              $number++;

        }
        while($roww = mysqli_fetch_array($tytt)){
          $data .='
          <a href="../frontend_files_php/resident_notice_page.php" style="text-decoration:none;" ><div class="alert alert-info" style="margin-top:2px;">
             '.$number.'. '.$roww['subject'].'</div></a>
          ';
                  $number++;
        }
      }
else if(mysqli_num_rows($res)==0){
  $data .='<p class="m-3"> No New Notices</p>';
}

echo $data;
}
