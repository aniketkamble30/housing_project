<?php
$conn =new mysqli('localhost','root','','house') or die(mysqli_error($conn));
extract($_POST);
$response=array();
if(isset($_POST['submit_details'])){
  
  if(isset($_POST['shop_no']))
  {$shop_no = $_POST['shop_no'];}
  $sql="SELECT shop_no FROM shop_details WHERE shop_no='$shop_no'";
  $result=mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)==0){
    header('location:../frontend_files_php/shop_add_owner_details.php?error=shop does not exits in shop details');
    $response['error']='Shop No does not exist';
    echo json_encode($response);
  }
  else{
    $sql="SELECT shop_no FROM shop_owner_details WHERE shop_no='$shop_no'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
      header('location:../frontend_files_php/shop_add_owner_details.php?error=Owner for this shop already exists');
      $response['error']='Owner with the Shop no is already added';
      echo json_encode($response);
    }
    else{
      $filename1=NULL;
      $filename2=NULL;

      if(isset($_POST['type_of_ownership']))
      {$type_of_ownership = $_POST['type_of_ownership'];}

      if(isset($_POST['business_type']))
      {$business_type = $_POST['business_type'];}

      if(isset($_POST['name1']))
      {$name1 = $_POST['name1'];}

      if(isset($_POST['email1']))
      {$email1 = $_POST['email1'];}

      if(isset($_POST['phoneno1']))
      {$phoneno1 = $_POST['phoneno1'];}

      if(isset($_POST['dob1']))
      {$dob1 = $_POST['dob1'];}

      if(isset($_POST['name2']))
      {$name2 = $_POST['name2'];}

      if(isset($_POST['email2']))
      {$email2 = $_POST['email2'];}

      if(isset($_POST['phoneno2']))
      {$phoneno2 = $_POST['phoneno2'];}

      if(isset($_POST['dob2']))
      {$dob2 = $_POST['dob2'];}

      if(isset($_POST['indate']))
      {$indate = $_POST['indate'];}
      $password=sha1('admin');

        $ext=array();
      $image11 = $_FILES['image1']['tmp_name'];
      $image22 = $_FILES['image2']['tmp_name'];

      $size1 = $_FILES['image1']['size'];
      $size2 = $_FILES['image2']['size'];

      $array1=explode('.',$_FILES['image1']['name']);
      array_push($ext,end($array1));
      
      $array2=explode('.',$_FILES['image2']['name']);
      array_push($ext,end($array2));	

      $d=date('Y-m-d',strtotime('today'));
    
      if(in_array("jpg",$ext) || 
      in_array("jpeg",$ext) || 
        in_array("png",$ext)){ 

            if(!is_dir("../DB_docs_images/shop_owner/$shop_no"))
            {
              mkdir("../DB_docs_images/shop_owner/$shop_no");
            }
       
        $filename1 = 'owner1-'.$d.'.'.$ext[0];
        if($ext[1] != ''){

          $filename2 = 'owner2-'.$d.'.'.$ext[1];
        }
        else{
          $filename2 = NULL;
        }
       // echo $filename1;
        //echo $filename2;

        $dest1 = '../DB_docs_images/shop_owner/'.$shop_no.'/'.$filename1;
        $dest2 = '../DB_docs_images/shop_owner/'.$shop_no.'/'.$filename2;

        move_uploaded_file($image11,$dest1);
        move_uploaded_file($image22,$dest2);
       }



      
      $conn->query("INSERT INTO  shop_owner_details (shop_no, type_of_ownership, business_type, name1, email1, phoneno1, dob1, name2, email2, phoneno2, dob2, indate, image1, image2, c) VALUES ('$shop_no','$type_of_ownership','$business_type','$name1','$email1','$phoneno1','$dob1','$name2','$email2','$phoneno2','$dob2','$indate','$filename1','$filename2', 0)") or die($conn->error);
      $conn->query("UPDATE shop_details SET shop_status='self-use'") or die($conn->error);
      $conn->query("INSERT INTO login (username,password,usertype) VALUES('$shop_no','$password','shop')") or die($conn->error);
      $conn->query("INSERT INTO forms_shop (shop_no) VALUES('$shop_no')") or die($conn->error);
      $conn->query("INSERT INTO  `qa`(`flat_no`)  VALUES ('$shop_no')")  or die($conn->error);
      $conn->query("INSERT INTO  `opoll`(`flat_no`)  VALUES ('$shop_no')")  or die($conn->error);
      $conn->query("INSERT INTO  `useralerts`(`flat_no`)  VALUES ('$shop_no')")  or die($conn->error);
      require '../omkar/current_quarter.php';
      if($current_q==1){$cq = '2019-06-30';}
      else if($current_q==2){$cq = ''.date('Y').'-09-30';}
      else if($current_q==3){$cq = ''.date('Y').'-12-31';}
      else if($current_q==4){$cq = ''.date('Y').'-03-31';}
      $conn->query("INSERT IGNORE INTO  `due`(`flat_no`,`due_date`)  VALUES ('$flat_no','$cq')")  or die($conn->error);
      mkdir('../DB_docs_images/forms/'.$shop_no);
      $response['success']='Owner added successfully';
      echo json_encode($response);
      header('location:../frontend_files_php/shop_add_owner_details.php?success=1');
    }
  }

}

header('location:../frontend_files_php/shop_add_owner_details.php?error=error while adding details');
?>
