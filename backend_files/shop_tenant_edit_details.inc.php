<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

 $data =  '';

 $displayquery = "SELECT * FROM shop_tenant_details";
 $result = mysqli_query($conn,$displayquery);

 if(mysqli_num_rows($result) > 0){

	$data.='<table class="table table-bordered table-striped" id="myTable">
	<thead class="bg-secondary text-white">
			<tr>
				<th>Shop No.</th>
				<th >Agreement Holder\'s Name</th>
				<th>Edit Action</th>
				<th></th>
			</tr>
		</thead>
	<tbody>';
	 while ($row = mysqli_fetch_array($result)) {

		 $data .= '<tr>

			 <td class="njo"><button type="button" onclick="viewdetails(\''.$row['shop_no'].'\')" class="btn
        btn-block text-primary">'.$row['shop_no'].'</button></td>
			 <td class="njo">'.$row['agreement_holder_name'].'</td>
			 <td class="njo">
				 <button onclick="getdetails(\''.$row['shop_no'].'\')" class="btn btn-block text-info btn-outline-dark" style="border-radius:10px;">Edit</button>
			 </td>
			 <td>
				<button onclick="remove(\''.$row['shop_no'].'\')" class="btn btn-block text-dark btn-outline-danger" style="border-radius:10px;">Remove</button>
			</td>
			 </tr>';
	 }
	 $data.='</tbody></table>';
 }
 else{
	$data.='<h4 class="text-danger">No Shop tenant Data in the database</h4>';
 }
		 echo $data;

}


if(isset($_POST['no']) && isset($_POST['no']) != "")
{
	 $shop_no = $_POST['no'];

	 $query = "SELECT * FROM shop_tenant_details WHERE shop_no='$shop_no'";
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

	$agreement_holder_name=$_POST['agreement_holder_name'];
    $agreement_holder_email=$_POST['agreement_holder_email'];
    $agreement_holder_mobile=$_POST['agreement_holder_mobile'];
    $agreement_holder_dob=$_POST['agreement_holder_dob'];
    $move_in_date=$_POST['tenant_move_in_date'];
    $move_out_date=$_POST['tenant_move_out_date'];
    $hidden_user_idupd = $_POST['hidden_user_idupd'];	
	$response=array();
	$query = "UPDATE shop_tenant_details SET
		agreement_holder_name='$agreement_holder_name',
        agreement_holder_email='$agreement_holder_email',
        agreement_holder_mobile='$agreement_holder_mobile',
        agreement_holder_dob='$agreement_holder_dob',
        move_in_date='$move_in_date',
        move_out_date='$move_out_date' WHERE shop_no='$hidden_user_idupd'";
	if(mysqli_query($conn,$query)){
		$response['success']='Successfully updated details';
	}
	else{
		$response['error']='Error while updating details';
	}
		 
	echo json_encode($response);
	
}
if(isset($_POST['delete_shop_no']))
{
    $shop_no=$_POST['delete_shop_no'];
    $shop_no_o=substr($shop_no,0,-1);
	$sql = "SELECT shop_no,agreement_holder_name,agreement_holder_email,agreement_holder_mobile,agreement_holder_dob,move_in_date,move_out_date FROM shop_tenant_details WHERE shop_no='$shop_no'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	if($row['move_out_date']=='0000-00-00'){
		$row['move_out_date']=date('Y-m-d',strtotime('today'));
	}
	$filename='../CSVs/history/shop_tenant.csv';
	$file=fopen($filename,'a');
	fputcsv($file,$row);
	fclose($file);
		
	if(mysqli_query($conn,$sql)){
		$sql = "DELETE FROM shop_tenant_details WHERE shop_no='$shop_no'";
		if(mysqli_query($conn,$sql)){
			$uquery = "UPDATE shop_details SET shop_status='self-use' WHERE shop_no='$shop_no_o'";
			if(mysqli_query($conn,$uquery)){
				$dquery = "DELETE FROM forms_shop_tenant WHERE shop_no='$shop_no'";
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
    echo json_encode($response);
}
	

?>
