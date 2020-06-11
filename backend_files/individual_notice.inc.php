<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records
extract($_POST);

if(isset($_POST['readrecord'])){

	$data =  '';

	$displayquery = " SELECT * FROM notice_user ORDER BY id DESC";
	$result = mysqli_query($conn,$displayquery);
	if(mysqli_num_rows($result) > 0){
		$number = 1;
		while ($row = mysqli_fetch_array($result)) {
			$data .= '<tr onclick="alldet('.$row['id'].')">
				<td>'.$number.'</td>
				<td>'.$row['receiver'].'</td>
				<td>'.$row['subject'].'</td>
				<td>'.$row['description'].'</td>
				<td>'.date('d-m-Y',strtotime($row['datentime'])).'</td>
				
    		</tr>';
    		$number++;

		}
	}
	 $data .= '';
    	echo $data;
}
if(isset($_POST['highlight'])){
	$i = $_POST['highlight'];
	
	$displayquery = " SELECT * FROM notice_user WHERE `id` = '$i'";
	$result = mysqli_query($conn,$displayquery);
	$data=NULL;
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$data.='<div class="row p-3 pb-0">
		<div class="col-6 border-bottom border-secondary float-left pb-4"><span class="font-weight-bold">Sent To : </span>'.$row['receiver'].'
		</div>
		<div class="col-6 border-bottom border-secondary float-right pb-4"><span class="font-weight-bold">Dated : </span>'.date('d-m-Y',strtotime($row['datentime'])).'
		</div>
		<div class="col-12 border-bottom border-secondary p-4"><span class="font-weight-bold">Subject : </span><br>'.$row['subject'].'
		</div>
		<div class="col-12 border-bottom border-secondary p-4"><span class="font-weight-bold">Description : </span><br>'.$row['description'].'
		</div>
		</div>	
	';
	}
	echo $data;

}

if(isset($_POST['receiver']) && isset($_POST['subject']) && isset($_POST['description']) )
{	
	$receiver=$_POST['receiver'];
	$array=explode(",",$receiver);
	foreach($array as $i){
		
		$q="SELECT flat_no,flat_owner1_email from flat_owner_details where flat_no='$i'";
		$u=mysqli_query($conn,$q);
		if($u){
			$subject=$_POST['subject'];
			$bdy = $_POST['description'];
			while($row=mysqli_fetch_array($u)){
				$recipient = $row['flat_owner1_email'];
				// require 'mail.php';
				$query = "INSERT INTO  notice_user (receiver, subject, description, datentime, isread) VALUES ('$i', '$subject', '$description',now(), 'no') ";
				mysqli_query($conn,$query);
				$qer = 'UPDATE `useralerts` SET `indnotice` = 1 WHERE flat_no= "'.$i.'"';
				mysqli_query($conn,$qer);
				echo $i;
			}	
		}

		$e="SELECT shop_no,email1 from shop_owner_details where shop_no='$i'";
		$r=mysqli_query($conn,$e);
		if(mysqli_num_rows($r)){
			$subject=$_POST['subject'];
			$bdy = $_POST['description'];
		while($row=mysqli_fetch_array($r)){
			$recipient = $row['email1'];
				require '../frontend_files_php/mail.php';
			$query = "INSERT INTO  notice_user (receiver, subject, description, datentime, isread) VALUES ('$i', '$subject', '$description',now(), 'no') ";
		mysqli_query($conn,$query);
		$qer = 'UPDATE `useralerts` SET `indnotice` = 1 WHERE flat_no= "'.$i.'"';
			mysqli_query($conn,$qer);
		}
		echo 'mail sent';
		}
	}
}


if(isset($_POST['mark_read'])){
	$id= $_POST['id'];
	$query = "UPDATE notice_user SET isread='yes' WHERE id= '$id'";
	mysqli_query($conn,$query);

}

?>
