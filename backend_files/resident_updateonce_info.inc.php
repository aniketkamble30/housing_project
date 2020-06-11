<?php
$conn = mysqli_connect( 'localhost','root',"",'house' );

extract($_POST);

if(isset($_POST['df']) && isset($_POST['df']) != "")
{
	 $user_id = $_POST['df'];
	 $query = " SELECT * FROM flat_owner_details WHERE flat_no = '$user_id'";
	 if (!$result = mysqli_query($conn,$query)) {
			 exit(mysqli_error());
	 }
	 $response = array();

	 if(mysqli_num_rows($result) > 0) {
			 while ($row = mysqli_fetch_assoc($result)) {
         if($row['c']=='1' || $row['c']=='2'){
           $response['display']="nhi" ;
         }
         else{
           $response = $row;
         }
			 }
   }
   else
	 {
			 $response['status'] = 200;
			 $response['message'] = "Data not found!";
	 }

	 echo json_encode($response);
}
else
{
	 $response['status'] = 200;
	 $response['message'] = "Invalid Request!";
}



if(isset($_POST['id']) && isset($_POST['id']) != "")
{
	 $user_id = $_POST['id'];
	 $query = " SELECT d.*,od.* FROM flat_details AS d JOIN flat_owner_details AS od USING (flat_no) WHERE flat_no = '$user_id'";
    //    $query = "SELECT * FROM flat_details WHERE id = '$user_id'";
	 if (!$result = mysqli_query($conn,$query)) {
			 exit(mysqli_error());
	 }

	 $response = array();

	 if(mysqli_num_rows($result) > 0) {
			 while ($row = mysqli_fetch_assoc($result)) {

					 $response = $row;
			 }
   
  }
  echo json_encode($response);
}


if(isset($_POST['submit_owner_details'])){

      $flat_no =$_POST['flat_no'];
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

      $query = " SELECT * FROM flat_owner_details WHERE flat_no = '$flat_no'";
      if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
 
    if(mysqli_num_rows($result) > 0){

      $qq="UPDATE flat_owner_details SET
      flat_type_of_ownership='$flat_type_of_ownership', flat_owner1_name='$flat_owner1_name',flat_owner1_email='$flat_owner1_email',flat_owner1_mob='$flat_owner1_mob',flat_owner1_occup='$flat_owner1_occup',flat_owner1_dob='$flat_owner1_dob', nominee='$nominee',flat_owner2_name='$flat_owner2_name',flat_owner2_email='$flat_owner2_email',flat_owner2_mob='$flat_owner2_mob',flat_owner2_occup='$flat_owner2_occup',flat_owner2_dob='$flat_owner2_dob',flat_member_count='$flat_member_count',assosciate_member_name='$assosciate_member_name',assosciate_member_reln='$assosciate_member_reln',flat_member2_name='$flat_member2_name',flat_member2_reln='$flat_member2_reln',flat_member3_name='$flat_member3_name',flat_member3_reln='$flat_member3_reln',flat_member4_name='$flat_member4_name',flat_member4_reln='$flat_member4_reln',flat_move_in_date='$flat_move_in_date',flat_vehicle_count='$flat_vehicle_count',flat_vehicle_description='$flat_vehicle_description',flat_petcount='$flat_petcount',flat_petdescription='$flat_petdescription',flat_maid_name='$flat_maid_name', c=1 WHERE flat_no='$flat_no' " ;
     
      // $conn->query("INSERT INTO  flat_owner_temp
      // (flat_no, flat_type_of_ownership, flat_owner1_name,flat_owner1_email,flat_owner1_mob,flat_owner1_occup,flat_owner1_dob, nominee,flat_owner2_name,flat_owner2_email,flat_owner2_mob,flat_owner2_occup,flat_owner2_dob,flat_member_count,assosciate_member_name,assosciate_member_reln,flat_member2_name,flat_member2_reln,flat_member3_name,flat_member3_reln,flat_member4_name,flat_member4_reln,flat_move_in_date,flat_vehicle_count,flat_vehicle_description,flat_petcount,flat_petdescription,flat_maid_name)
      // VALUES ('$flat_no',
      //   '$flat_type_of_ownership',
      //   '$flat_owner1_name',
      //   '$flat_owner1_email',
      //   '$flat_owner1_mob',
      //   '$flat_owner1_occup',
      //   '$flat_owner1_dob',
      //   '$nominee',
      //   '$flat_owner2_name',
      //   '$flat_owner2_email',
      //   '$flat_owner2_mob',
      //   '$flat_owner2_occup',
      //   '$flat_owner2_dob',
      //   '$flat_member_count',
      //   '$assosciate_member_name',
      //   '$assosciate_member_reln',
      //   '$flat_member2_name',
      //   '$flat_member2_reln',
      //   '$flat_member3_name',
      //   '$flat_member3_reln',
      //   '$flat_member4_name',
      //   '$flat_member4_reln',
      //   '$flat_move_in_date',
      //   '$flat_vehicle_count',
      //   '$flat_vehicle_description',
      //   '$flat_petcount',
      //   '$flat_petdescription',
      //   '$flat_maid_name')")
      // or die($conn->error);


      if(mysqli_query($conn,$qq)){
        header('location:../frontend_files_php/resident_updateonce_info.php?success=1');
      }
      else{
        header('location:../frontend_files_php/resident_updateonce_info.php?error=Error while updating');
      }

}
else{
  $conn->query("INSERT INTO  flat_owner_details
  (flat_no, flat_type_of_ownership, flat_owner1_name,flat_owner1_email,flat_owner1_mob,flat_owner1_occup,flat_owner1_dob, nominee,flat_owner2_name,flat_owner2_email,flat_owner2_mob,flat_owner2_occup,flat_owner2_dob,flat_member_count,assosciate_member_name,assosciate_member_reln,flat_member2_name,flat_member2_reln,flat_member3_name,flat_member3_reln,flat_member4_name,flat_member4_reln,flat_move_in_date,flat_vehicle_count,flat_vehicle_description,flat_petcount,flat_petdescription,flat_maid_name,c)
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
    2)")
  or die($conn->error);


 // ----------------------------------------------------------------------------------------------
 $password=sha1('admin');
      if(!is_dir('../forms/'.$flat_no)){
        mkdir('../forms/'.$flat_no);
      }
 $conn->query("UPDATE flat_details SET flat_status='self-use' WHERE flat_no='$flat_no'") or die($conn->error);
 //$conn->query("INSERT INTO  `login`(`username`, `password`, `usertype`)  VALUES ('$flat_no', '$password', 'resident')")  or die($conn->error);
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
 header('location:../update_resi_info.php?success=1');
 //--------------------------------------------------------------------------------------------------

}
}
  
if(isset($_POST['shenga'])){

    $flat_no =$_POST['fl']; 
    $response = array();
//    $sql="SELECT owner1_image1,owner2_image1,spouse_image1 FROM flat_owner_details WHERE flat_no='$flat_no'";
  //  $result=mysqli_query($conn, $sql);
  if(!empty($_FILES['File11']['tmp_name'])){
    $image1 = $_FILES['File11']['tmp_name'];
    $size1 = $_FILES['File11']['size'];
    $arr1=explode('.',$_FILES['File11']['name']);
    $ext=end($arr1);
    if(in_array(strtolower($ext),array("jpg","jpeg","png","pdf"))){
   // array_push($ext,end($array1));
    $d=rand();
    if(!is_dir("../DB_docs_images/flat_owner/$flat_no")){
                      mkdir("../DB_docs_images/flat_owner/$flat_no");
                    }
                    $filename1 = 'owner1-'.$d.'.'.$ext ;
                    $dest1 = '../DB_docs_images/'.$flat_no.'/'.$filename1;   
                    if(move_uploaded_file($image1,$dest1)){
                      $tyty="SELECT flat_no FROM flat_owner_details WHERE flat_no='$flat_no'";
                      $ryry=mysqli_query($conn,$tyty);
                        if(mysqli_num_rows($ryry)>0){
                              $qq="UPDATE flat_owner_details SET owner1_image1='$filename1' WHERE flat_no='$flat_no' ";
                              if(mysqli_query($conn,$qq))
                                $response['success']='Updated photos successfully';
                        }
                        else if(mysqli_num_rows($ryry)==0){
                              $qq="INSERT INTO flat_owner_details (flat_no,owner1_image1) VALUES ('$flat_no','$filename1')";
                                if(mysqli_query($conn,$qq))
                               // echo 'hey';
                                  $response['success']='Updated photos successfully';
                      }
                        else
                            $response['error']='error while updating owner 1 photo';
                    }
                      
                    }
                    }

  if(!empty($_FILES['File12']['tmp_name'])){
    $image1 = $_FILES['File12']['tmp_name'];
    $size1 = $_FILES['File12']['size'];
    $arr1=explode('.',$_FILES['File12']['name']);
    $ext=end($arr1);
    if(in_array(strtolower($ext),array("jpg","jpeg","png","pdf"))){
   // array_push($ext,end($array1));
    $d=rand();
    if(!is_dir("../DB_docs_images/flat_owner/$flat_no")){
                      mkdir("../DB_docs_images/flat_owner/$flat_no");
                    }
                    $filename2 = 'owner2-'.$d.'.'.$ext ;
                    $dest1 = '../DB_docs_images/flat_owner/'.$flat_no.'/'.$filename2;   
                    if(move_uploaded_file($image1,$dest1)){
                      $tyty="SELECT flat_no FROM flat_owner_details WHERE flat_no='$flat_no'";
                      $ryry=mysqli_query($conn,$tyty);
                        if(mysqli_num_rows($ryry)>0){
                              $qq="UPDATE flat_owner_details SET owner2_image1='$filename2' WHERE flat_no='$flat_no' ";
                              if(mysqli_query($conn,$qq))
                                $response['success']='Updated photos successfully';
                        }
                        else if(mysqli_num_rows($ryry)==0){
                              $qq="INSERT INTO flat_owner_details (flat_no,owner2_image1) VALUES ('$flat_no',$filename2')";
                                if(mysqli_query($conn,$qq))
                                  $response['success']='Updated photos successfully';
                      }
                        else
                            $response['error']='error while updating owner 2 photo';
                    }
                    }
  }

  if(!empty($_FILES['File13']['tmp_name'])){
    $image1 = $_FILES['File13']['tmp_name'];
    $size1 = $_FILES['File13']['size'];
    $arr1=explode('.',$_FILES['File13']['name']);
    $ext=end($arr1);
    if(in_array(strtolower($ext),array("jpg","jpeg","png","pdf"))){
   // array_push($ext,end($array1));
    $d=rand();
    if(!is_dir("../DB_docs_images/flat_owner/$flat_no")){
                      mkdir("../DB_docs_images/flat_owner/$flat_no");
                    }
                    $filename3 = 'spouse-'.$d.'.'.$ext ;
                    $dest1 = '../DB_docs_images/flat_owner/'.$flat_no.'/'.$filename3;   
                    if(move_uploaded_file($image1,$dest1)){
                      $tyty="SELECT flat_no FROM flat_owner_details WHERE flat_no='$flat_no'";
                      $ryry=mysqli_query($conn,$tyty);
                        if(mysqli_num_rows($ryry)>0){
                              $qq="UPDATE flat_owner_details SET spouse_image1='$filename3' WHERE flat_no='$flat_no' ";
                              if(mysqli_query($conn,$qq))
                                $response['success']='Updated photos successfully';
                        }
                        else if(mysqli_num_rows($ryry)==0){
                              $qq="INSERT INTO flat_owner_details (flat_no,spouse_image1) VALUES ('$flat_no','$filename3')";
                                if(mysqli_query($conn,$qq))
                                  $response['success']='Updated photos successfully';
                      }
                        else
                            $response['error']='error while updating spouse photo';
                    }
                    }
                  }
                  $query = " SELECT `owner1_image1`,`owner2_image1`,`spouse_image1` FROM flat_owner_details WHERE flat_no = '$flat_no'";
                  if (!$result = mysqli_query($conn,$query)) {
                      exit(mysqli_error());
                  }
                  if(mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $response = $row;
                    }
                    $response['success']='Updated photos successfully';
                }
                  echo json_encode($response);
}

?>