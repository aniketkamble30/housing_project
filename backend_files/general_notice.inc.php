<?php
session_start();
$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

	$data =  '';

	$displayquery = " SELECT * FROM notice ORDER BY `Date` DESC";
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){

		$number = 1;
		while ($row = mysqli_fetch_array($result)) {

			$data .= '<tr onclick="alldet('.$row['notice_id'].')">
				<td>'.$number.'</td>
				<td>'.$row['receiver'].'</td>
				<td>'.$row['subject'].'</td>
				<td>'.$row['Description'].'</td>
				<td>'.date('d-m-Y',strtotime($row['Date'])).'</td>
    		</tr>';
    		$number++;

		}
	}
	 $data .= '';
    	echo $data;
}

if(isset($_POST['highlight'])){
	$i = $_POST['highlight'];
	
	$displayquery = " SELECT * FROM notice WHERE `notice_id` = '$i'";
	$result = mysqli_query($conn,$displayquery);
	$data=NULL;
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$data.='<div class="row p-3">
		<div class="col-12 border-bottom border-secondary pb-4"><span class="font-weight-bold">Dated : </span>'.date('d-m-Y',strtotime($row['Date'])).'
		</div>
		<div class="col-12 border-bottom border-secondary p-4"><span class="font-weight-bold">Subject : </span><br>'.$row['subject'].'
		</div>
		<div class="col-12 border-bottom border-secondary p-4"><span class="font-weight-bold">Description : </span><br>'.$row['Description'].'
		</div>
	</div>';
		
	}
	echo $data;

}
if(isset($_POST['subject']) && isset($_POST['Description']) )
{
	$query = "  INSERT INTO  `notice` VALUES ( '','All', '$subject', '$Description',now()) ";
	mysqli_query($conn,$query);
	$bdy=$Description;
	$sql="	SELECT flat_owner1_email FROM flat_owner_details
			UNION DISTINCT
			SELECT email1 FROM shop_owner_details";
	$result = mysqli_query($conn,$sql);
	$data ="done !";
	while($row = mysqli_fetch_array($result)){
		$recipient = $row['flat_owner1_email'];
		// require '../frontend_files_php/mail.php';
	}
	$qer = 'UPDATE `useralerts` SET `gennotice` = 1 ';
	mysqli_query($conn,$qer);
	echo $data;
}

///delete user record

if(isset($_POST['notice_id'])){

	$userid= $_POST['notice_id'];
	$deletequery = "DELETE FROM notice WHERE notice_id= '$userid' ";
	mysqli_query($conn,$deletequery);
	echo "have a good";

}

//notice to be sent to particular flatid

?>
