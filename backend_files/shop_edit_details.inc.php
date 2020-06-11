<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

 $data =  '';

 $displayquery = "SELECT p.*,g.* FROM shop_details AS p JOIN shop_owner_details AS g WHERE p.shop_no=g.shop_no";
 $result = mysqli_query($conn,$displayquery);

 if(mysqli_num_rows($result) > 0){

	$data.='<table class="table table-bordered table-hover bg-light" id="myTable">
	<thead>
			<tr>
				<th>Shop No.</th>
				<th >Owner Name</th>
				<th>status</th>
				<th>Options</th>
			</tr>
		</thead>
	<tbody>';
	 while ($row = mysqli_fetch_array($result)) {

		 $data .= '<tr>

			 <td class="njo"><button type="button" onclick="viewdetails(\''.$row['shop_no'].'\')" class="btn
        btn-block text-primary">'.$row['shop_no'].'</button></td>
			 <td>'.$row['name1'].'</td>
			 <td>'.$row['shop_status'].'</td>
			 <td>
			 <div class="btn-group dropleft">
			 <button type="button" class="btn btn-outline-primary " data-toggle="dropdown">
			 <i class="las la-ellipsis-v"></i>Options
			 </button>
			 <div class="dropdown-menu bg-light border-dark">
			 <div class="">   
				 <button onclick="getdetails(\''.$row['shop_no'].'\')" class="btn btn-light btn-block text-dark" >Edit details</button>
				 </div>
			 <div class="">			 <button onclick="zoomimg(\''.$row['shop_no'].'\')" class="btn btn-light btn-block text-dark"">Edit Photos</button>
			 </div>
			<div class="">
				<button onclick="remove(\''.$row['shop_no'].'\')" class="btn btn-light btn-block text-dark">Remove</button>
			</div>
			<div class="">
			<form action="printshop.php" method="post">
				 <input type="hidden" value="'.$row['shop_no'].'" name="id">
				 <button type="submit" class="btn btn-light btn-block text-dark">Print</button>
				 </form>
			</div>
			</div>
			</div>
	 </td>
			 </tr>';
	 }
	 $data.='</tbody></table>';
 }
 else{
	$data.='<h4 class="text-danger">No Owner Data in the database</h4>';
 }
		 echo $data;

}


if(isset($_POST['no']) && isset($_POST['no']) != "")
{
	 $shop_no = $_POST['no'];
	 $query = " SELECT d.*,od.* FROM shop_details AS d JOIN shop_owner_details AS od USING (shop_no) WHERE shop_no='$shop_no'";
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

if(isset($_POST['hidden_user_idupd'])){
	$shop_status=$_POST['shop_status'];
    // $shop_dimensions=$_POST['shop_dimensions'];
    $type_of_ownership=$_POST['type_of_ownership'];
    $business_type=$_POST['business_type'];
    $name1=$_POST['name1'];
    $email1=$_POST['email1'];
    $phoneno1=$_POST['phoneno1'];
    $dob1=$_POST['dob1'];
 	$hidden_user_idupd = $_POST['hidden_user_idupd'];	
	$response=array();
	// ANIKET
	 $query = "UPDATE shop_details SET										
	 `shop_status`='$shop_status'WHERE shop_no= '$hidden_user_idupd'";
	 if(mysqli_query($conn,$query)){
		if($type_of_ownership=='joint'){
			$name2=$_POST['name2'];
			$email2=$_POST['email2'];
			$phoneno2=$_POST['phoneno2'];
			$dob2=$_POST['dob2'];
			$query = "UPDATE shop_owner_details SET
			`type_of_ownership`='$type_of_ownership',
			`name1`='$name1',
			`email1`='$email1',
			`phoneno1`='$phoneno1',
			`dob1`='$dob1',
			`name2`='$name2',
			`email2`='$email2',
			`phoneno2`='$phoneno2',
			`dob2`='$dob2',
			`business_type`='$business_type' WHERE shop_no='$hidden_user_idupd'";
			if(mysqli_query($conn,$query)){
				$response['success']='Successfully updated details';
			}
			else{
				$response['error']='Error while updating details';
			}
		 }
		 else{
			$query = "UPDATE shop_owner_details SET
			`type_of_ownership`='$type_of_ownership',
			`name1`='$name1',
			`email1`='$email1',
			`phoneno1`='$phoneno1',
			`dob1`='$dob1',
			`business_type`='$business_type' WHERE shop_no='$hidden_user_idupd'";
			if(mysqli_query($conn,$query)){
				$response['success']='Successfully updated details';
			}
			else{
				$response['error']='Error while updating details';
			}
		 }
	 }
	 else{
		 $response['error']='Error while updating details';
	 }
	 echo json_encode($response);
	
}
if(isset($_POST['delete_shop_no']))
{
	$shop_no=$_POST['delete_shop_no'];
	$sql="SELECT shop_no from shop_tenant_details WHERE shop_no='$shop_no'";
	$result=mysqli_query($conn,$sql);
	$response=array();
	if(mysqli_num_rows($result)==0){
		$sql = "SELECT  `shop_no`, `type_of_ownership`, `business_type`, `name1`, `email1`, `phoneno1`, `dob1`, `name2`, `email2`, `phoneno2`, `dob2`, `indate`, `image1`, `image2` FROM shop_owner_details WHERE shop_no='$shop_no'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		array_push($row,date('Y-m-d',strtotime('today')));
		$filename='../CSVs/history/shop_owner.csv';
		$file=fopen($filename,'a');
		fputcsv($file,$row);
		fclose($file);
		
		if(mysqli_query($conn,$sql)){
			$sql = "DELETE FROM shop_owner_details WHERE shop_no='$shop_no'";
			if(mysqli_query($conn,$sql)){
				$uquery = "UPDATE shop_details SET shop_status='vacant' WHERE shop_no='$shop_no'";
				if(mysqli_query($conn,$uquery)){
					$dquery = "DELETE FROM forms_shop WHERE shop_no='$shop_no'";
					if(mysqli_query($conn,$dquery)){
						$dquery = "DELETE FROM login WHERE username='$shop_no'";
						if(mysqli_query($conn,$dquery)){
							$dquery = "DELETE FROM useralerts WHERE flat_no='$shop_no'";
							if(mysqli_query($conn,$dquery)){
									$response['success']='Successfully deleted Shop owner';
								}
								else{
									$response['error']='Error while deleting data';	
								}
							}
						else{
							$response['error']='Error while deleting data';
						}
					}
					else{
						$response['error']='Error while deleting data';
					}
				}
				else{
					$response['error']='Error while deleting data';
				}
			}
			else{
				$response['error']='Error while deleting data';
			}
		}
		else{
			$response['error']='Error while deleting data';
		}
	}
	else{
		$response['error']='First remove the tenant registered with the shop';
	}
	echo json_encode($response);
}


if(isset($_POST['shenga'])){

    $shop_no =$_POST['fl']; 
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
    if(!is_dir("../DB_docs_images/shop_owner/$shop_no")){
                      mkdir("../DB_docs_images/shop_owner/$shop_no");
                    }
                    $filename1 = 'owner1-'.$d.'.'.$ext ;
                    $dest1 = '../DB_docs_images/shop_owner/'.$shop_no.'/'.$filename1;   
                    if(move_uploaded_file($image1,$dest1)){
                      $tyty="SELECT shop_no FROM shop_owner_details WHERE shop_no='$shop_no'";
                      $ryry=mysqli_query($conn,$tyty);
                        if(mysqli_num_rows($ryry)>0){
                              $qq="UPDATE shop_owner_details SET image1='$filename1' WHERE shop_no='$shop_no' ";
                              if(mysqli_query($conn,$qq))
                                $response['success']='Updated photos successfully';
                        }
                        else if(mysqli_num_rows($ryry)==0){
                              $qq="INSERT INTO shop_owner_details (shop_no,image1) VALUES ('$shop_no','$filename1')";
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
    if(!is_dir("../DB_docs_images/shop_owner/$shop_no")){
                      mkdir("../DB_docs_images/shop_owner/$shop_no");
                    }
                    $filename2 = 'owner2-'.$d.'.'.$ext ;
                    $dest1 = '../DB_docs_images/shop_owner/'.$shop_no.'/'.$filename2;   
                    if(move_uploaded_file($image1,$dest1)){
                      $tyty="SELECT shop_no FROM shop_owner_details WHERE shop_no='$shop_no'";
                      $ryry=mysqli_query($conn,$tyty);
                        if(mysqli_num_rows($ryry)>0){
                              $qq="UPDATE shop_owner_details SET image2='$filename2' WHERE shop_no='$shop_no' ";
                              if(mysqli_query($conn,$qq))
                                $response['success']='Updated photos successfully';
                        }
                        else if(mysqli_num_rows($ryry)==0){
                              $qq="INSERT INTO shop_owner_details (shop_no,image2) VALUES ('$shop_no',$filename2')";
                                if(mysqli_query($conn,$qq))
                                  $response['success']='Updated photos successfully';
                      }
                        else
                            $response['error']='error while updating owner 2 photo';
                    }
                    }
  }

                  $query = " SELECT `image1`,`image2` FROM shop_owner_details WHERE shop_no = '$shop_no'";
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
