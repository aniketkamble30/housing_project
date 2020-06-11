<?php
$conn = mysqli_connect( 'localhost','root',"",'house' );
error_reporting(0);
if(isset($_POST['submit_owner_details'])){

  $filename1=NULL;
  $filename2=NULL;
  $filename3=NULL;


  $flat_no =$_POST['flat_no'];
  $sql="SELECT flat_no FROM flat_details WHERE flat_no='$flat_no'";
  $result=mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)>0){
    $sql="SELECT flat_no FROM flat_owner_details WHERE flat_no='$flat_no'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==0){
      // ---------------file upload

        // $owner1_image = addslashes($_FILES['owner1_image']['tmp_name']);	
        // $name = addslashes($_FILES['owner1_image']['name']);
        // $owner1_image = file_get_contents($owner1_image);
        // $owner1_image = base64_encode($owner1_image);	


        // $owner2_image = addslashes($_FILES['owner2_image']['tmp_name']);	
        // $name = addslashes($_FILES['owner2_image']['name']);
        // $owner2_image = file_get_contents($owner2_image);
        // $owner2_image = base64_encode($owner2_image);	


        // $spouse_image = addslashes($_FILES['spouse_image']['tmp_name']);	
        // $name = addslashes($_FILES['spouse_image']['name']);
        // $spouse_image = file_get_contents($spouse_image);
        // $spouse_image = base64_encode($spouse_image);	

  
        // save image to db

        //-------ffiiillleee---------------------------
        $ext = array();
            $image1 = $_FILES['owner1_image1']['tmp_name'];
            $image2 = $_FILES['owner2_image1']['tmp_name'];
            $image3 = $_FILES['spouse_image1']['tmp_name'];

            $size1 = $_FILES['owner1_image1']['size'];
            $size2 = $_FILES['owner2_image1']['size'];
            $size3 = $_FILES['spouse_image1']['size'];

            $array1=explode('.',$_FILES['owner1_image1']['name']);
            array_push($ext,end($array1));

          	$array2=explode('.',$_FILES['owner2_image1']['name']);
            array_push($ext,end($array2));
            
          	$array3=explode('.',$_FILES['spouse_image1']['name']);
            array_push($ext,end($array3));

            $d=date('Y-m-d',strtotime('today'));

          //   foreach ($ext as $r) {
          //     echo $r;
          // }
          //echo $ext[0];
          if(in_array("jpg",$ext) || 
          in_array("jpeg",$ext) ||
            in_array("png",$ext))
            {     
              

                  if(!is_dir("../DB_docs_images/flat_owner/$flat_no"))
                  {
                    mkdir("../DB_docs_images/flat_owner/$flat_no");
                  }
                  $filename1 = 'owner1-'.$d.'.'.$ext[0];

                  if($ext[1]!=''){$filename2 = 'owner2-'.$d.'.'.$ext[1];}
                  if($ext[2]!=''){$filename3 = 'spouse-'.$d.'.'.$ext[2];}

            

              $dest1 = './../DB_docs_images/flat_owner/'.$flat_no.'/'.$filename1;
              $dest2 = './../DB_docs_images/flat_owner/'.$flat_no.'/'.$filename2;
              $dest3 = './../DB_docs_images/flat_owner/'.$flat_no.'/'.$filename3;
              move_uploaded_file($image1,$dest1);
              move_uploaded_file($image2,$dest2);
              move_uploaded_file($image3,$dest3);
            }

        //----------ffiillee-----------------------------
        //=---------------------
        
      $flat_type_of_ownership =$_POST['flat_type_of_ownership'];
      $nominee=$_POST['nominee'];
      $flat_owner1_name =$_POST['flat_owner1_name'];
      $flat_owner1_email =$_POST['flat_owner1_email'];
      $flat_owner1_mob =$_POST['flat_owner1_mob'];
      $flat_owner1_occup =$_POST['flat_owner1_occup'];
      $flat_owner1_dob =$_POST['flat_owner1_dob'];
      $flat_owner2_name =$_POST['flat_owner2_name'];
      $flat_owner2_email =$_POST['flat_owner2_email'];
      $flat_owner2_mob =$_POST['flat_owner2_mob'];
      $flat_owner2_occup =$_POST['flat_owner2_occup'];
      $flat_owner2_dob =$_POST['flat_owner2_dob'];
      $flat_member_count =$_POST['flat_member_count'];
      $assosciate_member_name =$_POST['assosciate_member_name'];
      $assosciate_member_reln =$_POST['assosciate_member_reln'];
      $flat_member2_name =$_POST['flat_member2_name'];
      $flat_member2_reln =$_POST['flat_member2_reln'];
      $flat_member3_name =$_POST['flat_member3_name'];
      $flat_member3_reln =$_POST['flat_member3_reln'];
      $flat_member4_name =$_POST['flat_member4_name'];
      $flat_member4_reln =$_POST['flat_member4_reln'];
      $flat_move_in_date =$_POST['flat_move_in_date'];
      $flat_vehicle_count =$_POST['flat_vehicle_count'];
      $flat_vehicle_description =$_POST['flat_vehicle_description'];
      $flat_petcount =$_POST['flat_petcount'];
      $flat_petdescription =$_POST['flat_petdescription'];
      $flat_maid_name =$_POST['flat_maid_name'];
      $conn->query("INSERT INTO  flat_owner_details
      (flat_no, flat_type_of_ownership, flat_owner1_name,flat_owner1_email,flat_owner1_mob,flat_owner1_occup,flat_owner1_dob, nominee,flat_owner2_name,flat_owner2_email,flat_owner2_mob,flat_owner2_occup,flat_owner2_dob,flat_member_count,assosciate_member_name,assosciate_member_reln,flat_member2_name,flat_member2_reln,flat_member3_name,flat_member3_reln,flat_member4_name,flat_member4_reln,flat_move_in_date,flat_vehicle_count,flat_vehicle_description,flat_petcount,flat_petdescription,flat_maid_name,owner1_image1,owner2_image1,spouse_image1,c)
      VALUES ('$flat_no',
        '$flat_type_of_ownership',
        '$flat_owner1_name',
        '$flat_owner1_email',
        '$flat_owner1_mob',
        '$flat_owner1_occup',
        '$flat_owner1_dob',
        '$nominee',
        '$flat_owner2_name',
        '$flat_owner2_email',
        '$flat_owner2_mob',
        '$flat_owner2_occup',
        '$flat_owner2_dob',
        '$flat_member_count',
        '$assosciate_member_name',
        '$assosciate_member_reln',
        '$flat_member2_name',
        '$flat_member2_reln',
        '$flat_member3_name',
        '$flat_member3_reln',
        '$flat_member4_name',
        '$flat_member4_reln',
        '$flat_move_in_date',
        '$flat_vehicle_count',
        '$flat_vehicle_description',
        '$flat_petcount',
        '$flat_petdescription',
        '$flat_maid_name',
        '$filename1',
        '$filename2',
        '$filename3',
        0)")
      or die($conn->error);
      $password=sha1('admin');
      if(!is_dir('../DB_docs_images/forms/'.$flat_no)){
        mkdir('../DB_docs_images/forms/'.$flat_no);
      }
      $conn->query("UPDATE flat_details SET flat_status='self-use' WHERE flat_no='$flat_no'") or die($conn->error);
     // $conn->query("INSERT INTO  `login`(`username`, `password`, `usertype`)  VALUES ('$flat_no', '$password', 'resident')")  or die($conn->error);
      $conn->query("INSERT INTO  `opoll`(`flat_no`)  VALUES ('$flat_no')")  or die($conn->error);
      $conn->query("INSERT INTO  `forms`(`flat_no`)  VALUES ('$flat_no')")  or die($conn->error);
      $conn->query("INSERT INTO  `qa`(`flat_no`)  VALUES ('$flat_no')")  or die($conn->error);
      $conn->query("INSERT INTO  `useralerts`(`flat_no`)  VALUES ('$flat_no')")  or die($conn->error);
      require '../omkar/current_quarter.php';
      if($current_q==1){$cq = '2019-06-30';}
      else if($current_q==2){$cq = ''.date('Y').'-09-30';}
      else if($current_q==3){$cq = ''.date('Y').'-12-31';}
      else if($current_q==4){$cq = ''.date('Y').'-03-31';}
      
      
      // $sql = "UPDATE `flat_owner_details` SET `owner1_image` = '$owner1_image' ,`owner2_image` = '$owner2_image',`spouse_image`= '$spouse_image'  WHERE flat_no='$flat_no' ";
      // $result = mysqli_query($conn, $sql);


      $conn->query("INSERT IGNORE INTO  `due`(`flat_no`,`due_date`)  VALUES ('$flat_no','$cq')")  or die($conn->error);
      // if($result){
			// 	echo 'Success_imagesss';
			// }
			// else{
			// 	echo 'error';
			// }

      header('location:../frontend_files_php/flat_add_owner_details.php?success=1');
    }
    else{
      header('location:../frontend_files_php/flat_add_owner_details.php?error=Owner for this flat already exists');
    }
  }
  else{
    
    header('location:../frontend_files_php/flat_add_owner_details.php?error=Flat Number does not exist in flat details');
  }
}


 ?>
