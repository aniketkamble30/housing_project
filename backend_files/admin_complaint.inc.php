<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

extract($_POST);

if(isset($_POST['readrecord'])){

 $data =  '';
 $displayquery = "SELECT * FROM complaint WHERE status ='pending' ORDER BY complaint_id DESC";
 $result = mysqli_query($conn,$displayquery);


 if(mysqli_num_rows($result)==0){
   $data.='<div class="row pl-5 text-center" style=" color:red">
     <h4> NO NEW COMPLAINTS</h4>
     </div>
   ';
 }

 if(mysqli_num_rows($result) > 0){

   $data .='<div class="table-responsive pr-3">
     <table class="table table-hover "  id="myData">
                        <thead class="bg-secondary text-white">
                          <th>Sr No.</th>
                          <th>Flat No</th>
                          <th>Subject</th>
                          <th>Add Remark</th>
                          <th>Status</th>
                          </thead>
                        <tbody>';

	 $number = 1;
	 while ($row = mysqli_fetch_array($result)) {
     $data .= '<tr>
       <td>'.$number.'</td>
       <td>'.$row['flat_no'].'</td>
       <td><button type="button" onclick="viewdes('.$row['complaint_id'].')" class="btn
        btn-block text-primary" id="ttrr">'.$row['subject'].'</button></td>';




$data .=
        '<form id="c">
        <td>
        <textarea class="form-control" id="remark" name="remark"></textarea>
        </td>
          <td>
          <button type="button" onclick="yesset('.$row['complaint_id'].')" class="btn btn-block btn-outline-success">Acknowledge</button>
          </td>
          </form>

			 </tr>';
			 $number++;

   }
 }
   $data .= ' </tbody>
 </table>
 </div>';
		 echo $data;

}


if(isset($_POST['id']) && isset($_POST['id']) != "")
{
	 $user_id = $_POST['id'];
   $remark=$_POST['remark'];
	 $query = "UPDATE `complaint` SET `status`= 'seen',`remark`= '$remark' WHERE complaint_id = '$user_id'";
  $RESULT = mysqli_query($conn,$query);

}

if(isset($_POST['iid']) && isset($_POST['iid']) != "")
{
   $complaint_id = $_POST['iid'];
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
// else
// {
// 	 $response['status'] = 200;
// 	 $response['message'] = "Invalid Request!";
// }
