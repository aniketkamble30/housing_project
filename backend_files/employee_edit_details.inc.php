<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

 $data =  '';

 $displayquery = "SELECT * FROM society_employee ORDER BY `id` DESC";
 $result = mysqli_query($conn,$displayquery);

 if(mysqli_num_rows($result) > 0){
	$data.='<table class="table table-striped" id="myTable">
                <thead>
					<tr>
						<th>Employee Id</th>
						<th >Name</th>
						<th>Type</th>
						<th>View</th>

					</tr>
                </thead>
            <tbody>';
	while ($row = mysqli_fetch_array($result)) {

		 $data .= '<tr>
			 <td><button type="button" onclick="viewdetails('.$row['id'].')" class="btn
            btn-block text-primary">'.$row['emp_id'].'</button></td>
			 <td class=>'.$row['emp_name'].'</td>
			 <td class="" >'.$row['emp_type'].'</td>
			 <td>
			 <div class="btn-group dropleft">
			 <button type="button" class="btn btn-outline-primary" data-toggle="dropdown">
			 <i class="las la-ellipsis-v"></i>Options
			 </button>
			 <div class="dropdown-menu bg-light border-dark">
			 <div>
				 <button onclick="getdetails(\''.$row['emp_id'].'\')" class="btn btn-light btn-block text-dark" style="border-radius:10px;">Edit</button>
			 </div>
			 <div>
			 <button onclick="idproof(\''.$row['id_proof'].'\')" class="btn btn-light btn-block text-dark" style="border-radius:10px;">View id proof</button>
			 </div>
			 <div>
			 <button onclick="otherdoc(\''.$row['other_doc'].'\')" class="btn btn-light btn-block text-dark" style="border-radius:10px;">View other docs</button>
			 </div>
			 <div>
				<button onclick="remove(\''.$row['emp_id'].'\')" class="btn btn-light btn-block text-dark" style="border-radius:10px;">Remove</button>
			 </div>

			 </div>
			 </div>
			 </td>';

	}
	$data.='</tbody></table>';
 }
 else{
	$data.='<h4 class="text-danger">No Employee\'s in the database</h4>';
 }
 echo $data;
}

if(isset($_POST['deleteid'])){

 $userid= $_POST['deleteid'];
 $deletequery = "DELETE FROM flat_details WHERE id= '$userid' ";
 mysqli_query($conn,$deletequery);
}

/// get userid for update
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
	 $id = $_POST['id'];
	 $query = "SELECT * FROM society_employee WHERE id = '$id'";
    //    $query = "SELECT * FROM flat_details WHERE id = '$user_id'";
	 if (!$result=mysqli_query($conn,$query)) {
			//  exit(mysqli_error());
	 }

	 $response = array();

	 if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result);
            $response = $row;
	 }else
	 {
			 $response['status'] = 200;
			 $response['message'] = " not found!";
	 }

	 echo json_encode($response);
}

///update table
if(isset($_POST['hidden_user_idupd'])){
    $id=$_POST['hidden_user_idupd'];
	$emp_id=$_POST['emp_id'];
    $emp_name=$_POST['emp_name'];
    $agency=$_POST['agency'];
    $emp_mob=$_POST['emp_mob'];
    $emp_salary=$_POST['emp_salary'];
	$emp_yearly_incr=$_POST['emp_yearly_incr'];
	$response=array();
	 $query = "UPDATE society_employee SET
	 `emp_id`='$emp_id',
	 `emp_name`='$emp_name',
	 `agency`='$agency',
	 `emp_mob`='$emp_mob',
	 `emp_salary`='$emp_salary',
	 `emp_yearly_incr`='$emp_yearly_incr' WHERE emp_id='$id'";
	if(!mysqli_query($conn,$query)){
        $response['error'] ='Error while updating info';  
	}
	else{
		$response['success'] ='Successfully updated data';  
	}
	echo json_encode($response);
}
if(isset($_POST['delete_employee']))
{
	$id=$_POST['delete_employee'];
	$sql = "SELECT * FROM society_employee WHERE emp_id='$id'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	array_push($row,date('Y-m-d',strtotime('today')));
	$filename='../CSVs/history/employee.csv';
	$file=fopen($filename,'a');
	fputcsv($file,$row);
	fclose($file);
	
 	if(mysqli_query($conn,$sql)){
		$sql = "DELETE FROM society_employee WHERE emp_id='$id'";
		if(mysqli_query($conn,$sql)){
			$response['success']='Successfully deleted employee';
		}
		else{
			$response['error']='Error while deleting employee';
		}
	}
	else{
		$response['error']='Error while deleting employee';
	}
	echo json_encode($response);
}
?>
