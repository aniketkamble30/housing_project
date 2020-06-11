<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

extract($_POST);

if(isset($_POST['readrecord'])){

$data='';
$qq = "SELECT * FROM complaint order by complaint_id desc";
$re = mysqli_query($conn,$qq);
 if(mysqli_num_rows($re) > 0){

   $data .='<div>
   <table class="table table-condensed table-responsive-lg table-bordered table-hover" id="comtab">
                        <thead class="bg-secondary text-white">
                         <th>id</th>
                          <th >Flat No</th>
                          <th>Subject</th>
                          <th>Date</th>
                          <th>Status</th>
                          </thead>
                        <tbody>';

$no=1;
while($row=mysqli_fetch_array($re)){
  $data .=' <tr onclick="viedes('.$row['complaint_id'].')" >
    <td>'.$no.'</td>
    <td>'.$row['flat_no'].'</td>
    <td>'.$row['subject'].'</td>
    <td>'.$row['date'].'</td>
    <td>'.$row['status'].'</td>';
    $no++;
}
$data .="</tr></tbody></table></div>";
}
echo $data;
}





if(isset($_POST['iidii']) && isset($_POST['iidii']) != "")
{
	 $complaint_id = $_POST['iidii'];
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
