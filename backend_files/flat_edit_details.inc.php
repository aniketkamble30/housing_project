<?php
 error_reporting(E_PARSE & ~E_NOTICE);
$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

 $data =  '';

 $displayquery = "SELECT p.*,g.* FROM flat_details AS p JOIN flat_owner_details AS g WHERE p.flat_no=g.flat_no";
 $result = mysqli_query($conn,$displayquery);


 if(mysqli_num_rows($result) > 0){
	$data.='<table class="table table-bordered table-hover bg-light" id="myTable">
	<thead>
        <th > Flat Number.
        </th>
		<th>Owner name</th>
		<th>Options</th>
	</thead>
	<tbody>';
	while ($row = mysqli_fetch_array($result)) {

		 $data .= '<tr >

			 <td ><p class="text-info">'.$row['flat_no'].'</p></td>
                <td  onclick="viewuserdetails('.$row['id'].')" style="cursor:pointer;"class="text-info"  >'.$row['flat_owner1_name'].'</td>
             <td >
             <div class="btn-group dropleft">
                    <button type="button" class="btn btn-outline-primary " data-toggle="dropdown">
                    <i class="las la-ellipsis-v"></i>Options
                    </button>
                    <div class="dropdown-menu bg-light border-dark">
                    <div class="">                            
                    <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-light btn-block text-dark">Edit Details</button>
                    </div>
                    
                        <div class="">                        
			                <button onclick="zoomimg(\''.$row['flat_no'].'\')" class="btn btn-light btn-block text-dark">Edit Photos</button>
                        </div>
                        
                        <div class="">
                            <button onclick="remove(\''.$row['flat_no'].'\')" class="btn btn-light btn-block text-dark">Remove Flat</button>
                        </div>
                        
                        <div class="">                                
                            <form action="printflat.php" method="post">
                            <input type="hidden" value="'.$row['flat_no'].'" name="id">
                            <button type="submit" class="btn btn-light btn-block text-dark">Print Info</button>
                            </form>
                        </div>
                    </div>
                </div>
		 </td>

			 </tr>';
	}
	$data.='</tbody>
		</table>';
 }
 else{
	$data.='<h4 class="text-danger align-center">No Flats in the database</h4>';
 }
 echo $data;
}


/// get userid for update
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
	 $user_id = $_POST['id'];
	 $query = " SELECT d.*,od.* FROM flat_details AS d JOIN flat_owner_details AS od USING (flat_no) WHERE id = '$user_id'";
    //    $query = "SELECT * FROM flat_details WHERE id = '$user_id'";
	 if (!$result = mysqli_query($conn,$query)) {
			 exit(mysqli_error());
	 }

	 $response = array();

	 if(mysqli_num_rows($result) > 0) {
			 while ($row = mysqli_fetch_assoc($result)) {

					 $response = $row;
			 }
	 }else
	 {
			 $response['status'] = 200;
			 $response['message'] = "Data not found!";
	 }
 //     PHP has some built-in functions to handle JSON.
// Objects in PHP can be converted into JSON by using the PHP function json_encode():
	 echo json_encode($response);
}
else
{
	 $response['status'] = 200;
	 $response['message'] = "Invalid Request!";
}


///update table

if(isset($_POST['hidden_user_idupd'])){
	$hidden_user_idupd = $_POST['hidden_user_idupd'];
	$flat_no = $_POST['flat_no'];
    $flat_owner1_name= $_POST['flat_owner1_name'];
    $flat_owner1_email= $_POST['flat_owner1_email'];
    $flat_owner1_mob= $_POST['flat_owner1_mob'];
    $flat_owner1_occup= $_POST['flat_owner1_occup'];
    $flat_owner1_dob= $_POST['flat_owner1_dob'];
    $flat_owner2_name= $_POST['flat_owner2_name'];
    $flat_owner2_email= $_POST['flat_owner2_email'];
    $flat_owner2_mob= $_POST['flat_owner2_mob'];
    $flat_owner2_occup= $_POST['flat_owner2_occup'];
    $flat_owner2_dob= $_POST['flat_owner2_dob'];
	$nominee= $_POST['nominee'];
	$flat_member2_name=$_POST['flat_member2_name'];
	$flat_member2_reln=$_POST['flat_member2_reln'];
	$flat_member3_name=$_POST['flat_member3_name'];
	$flat_member3_reln=$_POST['flat_member3_reln'];
	$flat_member4_name=$_POST['flat_member4_name'];
	$flat_member4_reln=$_POST['flat_member4_reln'];
	$flat_member5_name=$_POST['flat_member5_name'];
	$flat_member5_reln=$_POST['flat_member5_reln'];
    $assosciate_member_name= $_POST['assosciate_member_name'];
    $assosciate_member_reln= $_POST['assosciate_member_reln'];
    $flat_member_count= $_POST['flat_member_count'];
    $flat_dimensions= $_POST['flat_dimensions'];
    $flat_type_of_ownership= $_POST['flat_type_of_ownership'];
    $flat_status= $_POST['flat_status'];
    $BHK= $_POST['BHK'];
    // $flat_vehicle_count= $_POST['flat_vehicle_count'];
	// $flat_petcount= $_POST['flat_petcount'];
	
	$response=array();
	$query = "UPDATE flat_details SET
		flat_dimensions='$flat_dimensions',
		flat_status='$flat_status',
		BHK='$BHK' WHERE id= '$hidden_user_idupd'";
	mysqli_query($conn,$query);

	$query = "UPDATE flat_owner_details SET
		flat_owner1_name='$flat_owner1_name',
		flat_owner1_email='$flat_owner1_email',
		flat_owner1_mob='$flat_owner1_mob',
		flat_owner1_occup='$flat_owner1_occup',
		flat_owner1_dob='$flat_owner1_dob',
		flat_owner2_name='$flat_owner2_name',
		flat_owner2_email='$flat_owner2_email',
		flat_owner2_mob='$flat_owner2_mob',
		flat_owner2_occup='$flat_owner2_occup',
		flat_owner2_dob='$flat_owner2_dob',
		nominee='$nominee',
		assosciate_member_name='$assosciate_member_name',
		assosciate_member_reln='$assosciate_member_reln',
		flat_member_count='$flat_member_count',
		flat_member2_name='$flat_member2_name',
		flat_member2_reln='$flat_member2_reln',
		flat_member3_name='$flat_member3_name',
		flat_member3_reln='$flat_member3_reln',
		flat_member4_name='$flat_member4_name',
		flat_member4_reln='$flat_member4_reln',
		flat_member5_name='$flat_member5_name',
		flat_member5_reln='$flat_member5_reln',
		flat_type_of_ownership='$flat_type_of_ownership' WHERE flat_no= '$flat_no' ";
	 if(!mysqli_query($conn,$query)){
		$response['error']='Error while updating detils';
		echo json_encode($response);
	 }
	 else{
		$response['success']='Flat details updated successfully';
		echo json_encode($response);
	 }
	 
	 //  if (!$result = mysqli_query($conn,$query)) {
	 //     exit(mysqli_error());
	 // }
}
if(isset($_POST['delete_flat_no']))
{
	$flat_no=$_POST['delete_flat_no'];
	$response=array();
	$t_fno=$flat_no.'T';
	$sql = "SELECT isdue FROM due WHERE flat_no = '$flat_no'";
	$result = mysqli_query($conn, $sql);
	$isdue = 0;
	while ($row = mysqli_fetch_array($result)) 
	{
		$isdue = $row[0];  
	break;
    }
if($isdue != NULL){
	$response['due_error'] = 'Clear All Dues';
	echo json_encode($response);
}
else{
$sql = "SELECT flat_no FROM tenant_details WHERE flat_no='$t_fno'";
$result=mysqli_query($conn,$sql);
 	if(mysqli_num_rows($result)==0){

		$gql = "SELECT * FROM flat_owner_details WHERE flat_no='$flat_no'";
		$result=mysqli_query($conn,$gql);
		$row=mysqli_fetch_assoc($result);
		array_push($row,date('Y-m-d',strtotime('today')));
		$filename='../CSVs/history/flat_owner.csv';
		$file=fopen($filename,'a');
		fputcsv($file,$row);
		fclose($file);

		$sql = "DELETE FROM opoll WHERE flat_no='$flat_no'";
		mysqli_query($conn,$sql);
		
		$sql = "DELETE FROM complaint WHERE flat_no='$flat_no'";
		mysqli_query($conn,$sql);
		
		$sql = "DELETE FROM notice WHERE flat_no='$flat_no'";
		mysqli_query($conn,$sql);
		$sql = "DELETE FROM forms WHERE flat_no='$flat_no'";
		mysqli_query($conn,$sql);
		$sql = "DELETE FROM login WHERE flat_no='$flat_no'";
		mysqli_query($conn,$sql);
		$sql = "DELETE FROM useralerts WHERE flat_no='$flat_no'";
		mysqli_query($conn,$sql);
		$sql = "UPDATE society_committee SET `flat_no` = NULL, `name` = NULL, `join_date` = NULL WHERE society_committee.flat_no='$flat_no'";	
		mysqli_query($conn, $sql);
		$sql = "DELETE FROM flat_owner_details WHERE flat_no='$flat_no'";
		if(mysqli_query($conn,$sql)){
			$uquery = "UPDATE flat_details SET flat_status='vacant' WHERE flat_no='$flat_no'";
			if(mysqli_query($conn,$uquery)){
				$response['success']='Flat Owner deleted successfully';
				echo json_encode($response);
			}
			else{
				$response['error']='Could not change flat status';
				echo json_encode($response);
			}
			
		}
		else{
			$response['error']='Error while deleting';
			echo json_encode($response);
		}
	}
	else{
		$response['error']='First remove the tenant registered with the flat no';
        echo json_encode($response);
	}}
	
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
                    $dest1 = '../DB_docs_images/flat_owner/'.$flat_no.'/'.$filename1;   
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
