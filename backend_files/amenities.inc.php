<?php
$conn = mysqli_connect('localhost','root','','house');
session_start();
extract($_POST);
if(isset($_POST['newame'])){
    $ame = mysqli_real_escape_string($conn,$_POST['newame']);
    $query = "INSERT INTO `amenities`(`amenity`) VALUES ('$ame')";
    $result = mysqli_query($conn,$query);
}

if(isset($_POST['readame'])){
    $faq = '';
    $i = 1;
    $query1 = "SELECT * FROM `amenities`";
    $gop = mysqli_query($conn,$query1);
    if(mysqli_num_rows($gop)>0){
           while($top = mysqli_fetch_array($gop)){
            $faq .='<div class="card-body border border-secondary p-2 pt-3 bg-light">
                        <p class="ml-3">'.$i.'.&nbsp;&nbsp;'.$top['amenity'].'';
                        if($_SESSION['role']=='admin'){
                            $faq.='<button class="float-right mr-5 btn btn-sm btn-danger" onclick="delame('.$top['id'].')"> Remove</button></p>';
                        }
                        
                    $faq.='</div>';
                    
                $i++;
    } 
    echo $faq;
}
}

if(isset($_POST['aid'])){
    $aid = $_POST['aid'];
    $rply='';
    $query3 = "DELETE FROM `amenities` WHERE id = '$aid'";
    $res = mysqli_query($conn,$query3);
}