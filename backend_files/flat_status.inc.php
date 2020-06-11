<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

extract($_POST);
if(isset($_POST['findemptyflats'])){ 
    $data ="";
    $query = "SELECT flat_no FROM flat_details";
    $output = mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($output)){
    $data .="<p>".$row['flat_no']."</p><br>";
    }
    echo $data;
}


if(isset($_POST['readAllRecord'])){

	$data =  '';
	$displayquery = "SELECT * FROM flat_details ";
	$result = mysqli_query($conn,$displayquery);
   
   
	if(mysqli_num_rows($result) > 0){
	   $data.='
	   <table class="table table-bordered table-hover" id="mynewtable">
	   <thead>
		   <th>Flat Number.</th>
		   <th>Flat Status</th>
		   <th>View</th>
	   </thead>
	   <tbody>';
	   while ($row = mysqli_fetch_array($result)) {
   
			$data .= '<tr>
   
				<td class="text-center  ">'.$row['flat_no'].'</td>';
           if($row['flat_status'] == 'rented'){
            $data.=	'<td style="color:#1bc9e0;font-weight:bold;" >'.$row['flat_status'].'</td>';
           }
            else if($row['flat_status'] == 'self-use'){
                $data.=	'<td class="text-center  " style="color:#047d00;font-weight:bold;">'.$row['flat_status'].'</td>';
            }
            else{
                $data.=	'<td style="color:#FF1100;font-weight:bold;">'.$row['flat_status'].'</td>';
            }
				
			$data.=	'<td width="20%">
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-block btn-inverse-primary btn-fw" >View</button>
				</td>
				</tr>';
	   }
	   $data.='</tbody>
		   </table><p style="display:none;">'.$row['id'].'</p>';
	}
	else{
	   $data.='<h4 class="text-danger align-center">No Flats in the database</h4>';
	}
	echo $data;
   }


   if(isset($_POST['id']) && isset($_POST['id']) != "")
   {
		$user_id = $_POST['id'];
		$query = " SELECT * FROM flat_details WHERE id = '$user_id'";
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