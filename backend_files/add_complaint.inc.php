<?php
$conn = mysqli_connect( 'localhost','root',"",'house' );
session_start();

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

	$data =  '';

	$displayquery = " SELECT * FROM complaint WHERE flat_no ='".$_SESSION['username']."' ORDER BY complaint_id DESC";
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) == 0){
		echo "<h4 class='mt-3 alert alert-warning' style='color:red'> No Complaints have been added yet.</h4>";
	}

	if(mysqli_num_rows($result) > 0){
			$data .='<div class="table-responsive table-hover mt-3">
			<table class="table"  id="ttaabbllee">
			<thead style="background-color:#e6e6e6;">
				<tr>
				<th>No.</th>
				<th>Subject</th>
				<th>status</th>
				<th>remark</th>
				</tr>
			</thead>
			<tbody>';
		$number = 1;
		while ($row = mysqli_fetch_array($result)) {

			$data .= '<tr  onclick="viewdes('.$row['complaint_id'].')">
				<td>'.$number.'</td>
				<td >'.$row['subject'].'</td>
				<td>'.$row['status'].'</td>
				<td>'.$row['remark'].'</td>
    		</tr>';
    		$number++;

		}
	}
    	echo $data;

}

if(isset($_POST['subject']) && isset($_POST['Description']) && isset($_POST['flat_no']))
{		
	$subject= ($_POST['subject']);
	$Description= ($_POST['Description']);
	$flat_no= ($_POST['flat_no']);

	//-----------files
	if($_FILES['File']['name'] == false){
		$quer1 = "UPDATE `admin_alerts` SET `complaintsalert`= 1 WHERE id = 1";
		mysqli_query($conn,$quer1);
		$query = "  INSERT INTO complaint (complaint_id, flat_no, subject, description,date,status,proof) VALUES ('', '$flat_no', '$subject', '$Description',now(),'pending',NULL) ";
		mysqli_query($conn,$query);
 
	}
	else{
		$tmp=$_FILES['File']['tmp_name'];
		$size=$_FILES['File']['size'];
		echo $size;
		$array=explode('.',$_FILES['File']['name']);
		$ext=end($array);
		
		if(in_array(strtolower($ext),array("jpg","jpeg","png","pdf","gif")) && ($size<=100000000)){
			if(!is_dir("../DB_doc_images/complaints/$flat_no")){
				mkdir("../DB_doc_images/complaints/$flat_no");
			}
			$filename = rand().'.'.$ext;
			$dest = '../DB_docs_images/complaints/'.$flat_no.'/'.$filename;
			$f=move_uploaded_file($tmp,$dest);
	
			if($f){
				$quer1 = "UPDATE `admin_alerts` SET `complaintsalert`= 1 WHERE id = 1";
				mysqli_query($conn,$quer1);
				$query = "  INSERT INTO complaint (complaint_id, flat_no, subject, description,date,status,proof) VALUES ('', '$flat_no', '$subject', '$Description',now(),'pending','$filename') ";
				mysqli_query($conn,$query);
			}
			echo '<h4>add sucessfully</h4>';
		}
	
		// else{
		// 	echo '<h4>error while adding data please check image size</h4>';
		// }

	}	

}


if(isset($_POST['iid']) && isset($_POST['iid']) != "")
{
	 $complaint_id = $_POST['iid'];
	// $query = " SELECT d.*,od.* FROM flat_details AS d JOIN flat_owner_details AS od USING (flat_no) WHERE id = '$user_id'";
    $query = "SELECT * FROM complaint WHERE complaint_id = '$complaint_id'";
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


?>
