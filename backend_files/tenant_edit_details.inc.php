<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

 $data = '';
 $displayquery = "SELECT * FROM tenant_details";
 $result = mysqli_query($conn,$displayquery);

 if(mysqli_num_rows($result) > 0){
	$data.='<table class="table table-bordered table-striped" id="myTable">
                <thead>
					<tr>
						<th>Flat No.</th>
						<th >Agreement Holder Name</th>
						<th>Options</th>
					</tr>
                </thead>
            <tbody >';
	 while ($row = mysqli_fetch_array($result)) {

		 $data .= '<tr class="bg-white">
				<td><button type="button" onclick="viewdetails(\''.$row['flat_no'].'\')" class="btn
					btn-block btn-inverse-primary">'.$row['flat_no'].'</button></td>
				<td>'.$row['agreement_holder_name'].'</td>
                <td>
                <div class="btn-group dropleft">
                    <button type="button" class="btn btn-inverse-info " data-toggle="dropdown">
                    <i class="las la-ellipsis-v"></i>Options
                    </button>
                    <div class="dropdown-menu bg-light border-dark">
                    <div class="">  
                    <button onclick="getdetails(\''.$row['flat_no'].'\')" class="btn btn-block btn-light text-info " >Edit details</button>
				</div> 
				<div class="">                        
				<button onclick="zoomimg(\''.$row['flat_no'].'\')" class="btn btn-light btn-block text-dark">Edit Photos</button>
			</div>
                        <div class="">                                
                        <button onclick="remove(\''.$row['flat_no'].'\')" class="btn btn-block btn-light text-dark " >Remove</button>
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
	 $data.='<h4 class="text-danger">No Tenants Added</h4>';
 }
	echo $data;
}


if(isset($_POST['no']) && isset($_POST['no']) != "")
{
	 $flat_no = $_POST['no'];
	 $query = " SELECT * FROM tenant_details WHERE flat_no='$flat_no'";
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

	 echo json_encode($response);
}
else
{
	 $response['status'] = 200;
	 $response['message'] = "Invalid Request!";
}


///update table

if(isset($_POST['hidden_user_idupd'])){
	$agreement_holder_name=$_POST['agreement_holder_name'];
    $agreement_holder_email=$_POST['agreement_holder_email'];
    $agreement_holder_mobile=$_POST['agreement_holder_mobile'];
    $agreement_holder_dob=$_POST['agreement_holder_dob'];
	$tenant_move_in_date=$_POST['tenant_move_in_date'];	
	$update_member_count=$_POST['update_member_count'];	
	$member1=$_POST['member1'];
	$member2=$_POST['member2'];
	$member3=$_POST['member3'];
	$member4=$_POST['member4'];
 	$hidden_user_idupd = $_POST['hidden_user_idupd'];	

	 $query = "UPDATE tenant_details SET
	 agreement_holder_name='$agreement_holder_name',
     agreement_holder_email='$agreement_holder_email',
     agreement_holder_mobile='$agreement_holder_mobile',
     agreement_holder_dob='$agreement_holder_dob',
     tenant_move_in_date='$tenant_move_in_date',
	 tenant_count_of_members='$update_member_count',
	 member1='$member1',
	 member2='$member2',
	 member3='$member3',
	 member4='$member4'
	 
	  WHERE flat_no= '$hidden_user_idupd'";

     $response=array();
	 if(mysqli_query($conn,$query)){
        $response['success']='Tenant Details Updated successfully';
        echo json_encode($response);
     }
	 else{
        $response['error']='Error while updating tenant details';
        echo json_encode($response);
     }
	 //  if (!$result = mysqli_query($conn,$query)) {
	 //     exit(mysqli_error());
	 // }
}
if(isset($_POST['delete_flat_no']))
{
	$flat_no=$_POST['delete_flat_no'];
	$sql = "SELECT `flat_no`, `tenant_count_of_members`, `member1`, `member2`, `member3`, `member4`, `agreement_holder_name`, `agreement_holder_mobile`, `agreement_holder_email`, `agreement_holder_dob`, `tenant_move_in_date`, `image` FROM tenant_details WHERE flat_no='$flat_no'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	array_push($row,date('Y-m-d',strtotime('today')));
	$filename='../CSVs/history/flat_tenant.csv';
	$file=fopen($filename,'a');
	fputcsv($file,$row);
	fclose($file);
	$response=array();
 	if(mysqli_query($conn,$sql)){
		$sql = "DELETE FROM tenant_details WHERE flat_no='$flat_no'";
		$flat_no_p=substr($flat_no,0,-1);
		if(mysqli_query($conn,$sql)){
			$uquery = "UPDATE flat_details SET flat_status='self-use' WHERE flat_no='$flat_no_p'";
			if(mysqli_query($conn,$uquery)){
				$dquery = "DELETE FROM login WHERE username='$flat_no'";
				if(mysqli_query($conn,$uquery)){
					$response['success']='Tenant removed successfully';
				}
				else{
					$response['error']='Error while changing flat status';
				}
				
			}
			else{
				$response['error']='Error while changing flat status';
			}
		}
		else{
			$response['error']='Error while changing flat status';
		}
	}
	else{
		$response['error']='Error while changing flat status';
	}
	echo json_encode($response);
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
if(in_array(strtolower($ext),array("jpg","jpeg","png"))){
// array_push($ext,end($array1));
$d=rand();
if(!is_dir("../DB_docs_images/flat_tenant/$flat_no")){
				  mkdir("../DB_docs_images/flat_tenant/$flat_no");
				}
				$filename1 = 'owner1-'.$d.'.'.$ext ;
				$dest1 = '../DB_docs_images/flat_tenant/'.$flat_no.'/'.$filename1;   
				if(move_uploaded_file($image1,$dest1)){
				  $tyty="SELECT flat_no FROM tenant_details WHERE flat_no='$flat_no'";
				  $ryry=mysqli_query($conn,$tyty);
					if(mysqli_num_rows($ryry)>0){
						  $qq="UPDATE tenant_details SET `image`='$filename1' WHERE flat_no='$flat_no' ";
						  if(mysqli_query($conn,$qq))
							$response['success']='Updated photos successfully';
					}
				// 	else if(mysqli_num_rows($ryry)==0){
				// 		  $qq="INSERT INTO flat_owner_details (flat_no,owner1_image1) VALUES ('$flat_no','$filename1')";
				// 			if(mysqli_query($conn,$qq))
				// 		   // echo 'hey';
				// 			  $response['success']='Updated photos successfully';
				//   }
					else
						$response['error']='error while updating photo';
				}
				  
				}
				}
			// 	$query = " SELECT `owner1_image1`,`owner2_image1`,`spouse_image1` FROM flat_owner_details WHERE flat_no = '$flat_no'";
			// 	if (!$result = mysqli_query($conn,$query)) {
			// 		exit(mysqli_error());
			// 	}
			// 	if(mysqli_num_rows($result) > 0) {
			// 	  while ($row = mysqli_fetch_assoc($result)) {
			// 		  $response = $row;
			// 	  }
			// 	  $response['success']='Updated photos successfully';
			//   }
				echo json_encode($response);
}


?>
