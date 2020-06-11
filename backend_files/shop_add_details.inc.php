<?php
    $conn=new mysqli('localhost','root','','house') or die(mysqli_error($conn));
    extract($_POST);
    if(isset($_POST['submit_details'])){
      $shop_no =$_POST['shop_no'];
      $sql="SELECT shop_no from shop_details WHERE shop_no='$shop_no'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==0){
        $shop_dimensions = $_POST['shop_dimensions'];
        $conn->query("INSERT INTO  shop_details (shop_no, shop_dimensions, shop_status) VALUES ('$shop_no','$shop_dimensions','vacant')") or die($conn->error);
        $response=array();
        $response['success']='Shop added successfully';
        echo json_encode($response);
      }
      else{
        $response['error']='Shop Number already exists';
        echo json_encode($response);
      }
    }
?>