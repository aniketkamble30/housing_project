<?php
$conn = mysqli_connect('localhost','root','','house');
session_start();
$flat_no = $_SESSION['username'];

if(isset($_POST['seesaw'])){
  $d=date('Y-m-d');
  $data = "";
  $query = "SELECT * FROM qa where flat_no='$flat_no'";
  $res = mysqli_query($conn,$query);
  $c=0;
    while($row=mysqli_fetch_assoc($res)){
      if(($row['comment']== "" || NULL) && ($row['question']!="") && $d<$row['end_date']){
        $data .=  '
      <form>
      <p class="m-3">'.$row['question'].'</p>
      <input type="hidden" name="flat_no" id="flat" value="'.$_SESSION['username'].' ">
  	  <textarea class="form-control p-3" id="comment" placeholder="Your Suggestion Here....." ></textarea>
     <center> <button type="button" style="width:135px;" onclick="postt()" class="btn btn-info m-2">Post</button></center>
      </form>';
}
else{
  $data.="<p class='p-3 text-dark ' align='center'>Nothing Added</p>";
}
}
echo $data;
}


if(isset($_POST['comment'])){

$comment = $_POST['comment'];
$query = "UPDATE `qa` SET `comment`= '$comment', date=now() WHERE flat_no = '$flat_no'";
 mysqli_query($conn, $query);
   $qer = 'UPDATE `useralerts` SET `qa`= 0 WHERE flat_no = "'. $_SESSION['username'].'"';
   mysqli_query($conn,$qer);
 echo $data='suggestion added successfully!';
}
?>
