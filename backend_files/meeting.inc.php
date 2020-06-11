<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['readrecord'])){

 $data =  '';
 $displayquery = "SELECT * FROM meeting WHERE isdone=0";
 $result = mysqli_query($conn,$displayquery);

 if(mysqli_num_rows($result) > 0){
	 while ($row = mysqli_fetch_array($result)) {
        if($row['attendance']){
            $attendance=1;
        }
        else{
           $attendance=0;
        }
        if($row['minutes']){
            $minutes=1;
        }
        else{
           $minutes=0;
        }
		 $data .= '<tr>
                <td>'.$row['name'].'</td>
                <td>'.$row['date'].'</td>
                <td>';
                    if(!$row['attendance']){
                        $data.='<button class="btn btn-block text-primary" onclick="check_attendance('.$attendance.','.$row['id'].',\''.$row['type'].'\')">Attendance</button>';
                    }
                    else{
                        $data.='<button class="btn btn-block disabled" style="background-color:#ccc;" disabled">Submitted</button>';
                    }
                    
                $data.='</td>
                <td>';
                    if(!$row['minutes']){
                        $data.='<button class="btn btn-block text-primary" onclick="check_minutes('.$minutes.','.$row['id'].')">Minutes</button>';
                    }
                    else{
                        $data.='<button class="btn btn-block disabled" style="background-color:#ccc;">Submitted</button>';
                    }
                $data.='</td>
                <td>';
                    if($row['attendance'] && $row['minutes']){
                        $data.='<button onclick="close_meeting('.$row['id'].')" class="btn btn-block border text-danger">Close</button>';
                    }
                    else{
                        $data.='<button class="btn btn-block text-secondary"style="background-color:#ddd;" disabled">Close<small class="text-danger">&nbsp;&nbsp;( Add Minutes and Attendance to close.)</small></button>';
                    }
                $data.='</td>
			 </tr>';
	 }
 }
	$data .= '';
	echo $data;

}

if(isset($_POST['submit_details'])){
    $name=$_POST['name'];
    $date=$_POST['date'];
    $newDate = date("d-m-Y", strtotime($date));
    $type=$_POST['meeting_type'];

    $sql="INSERT INTO meeting (name, type, date) VALUES ('$name','$type','$date')";
    mysqli_query($conn, $sql);
    $data ="done!  ".$newDate;

    if($type == "general"){

        $subject = $type.' meeting on '.$newDate;
        $bdy = ' '.$type.' meeting on <b>'.$name.'</b> will be held on <b>'.$newDate.'.</b><br>You are requested to be present.<hr><br>Regards,<br>Secretary,Ambika Heritage.';
        $sql="SELECT flat_owner1_email FROM flat_owner_details
            UNION DISTINCT
            SELECT email1 FROM shop_owner_details";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $recipient = $row['flat_owner1_email'];
            require '../mail.php';
        }
        echo $data;
    }
    else{
        $subject = $type.' meeting on '.$newDate;
        $bdy = ' '.$type.' meeting on <b>'.$name.'</b> will be held on <b>'.$newDate.'.</b><br>You are requested to be present.<hr><br>Regards,<br>Secretary,Ambika Heritage.';
        $sql="SELECT  flat_owner1_email
                FROM flat_owner_details
                JOIN society_committee
                ON flat_owner_details.flat_no = society_committee.flat_no";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $recipient = $row['flat_owner1_email'];
            require '../mail.php';
        }
        echo $data;
    }
}

if(isset($_POST['submit_attendance_resident'])){
    $meeting_id=$_POST['meeting_id_resident'];
    $sql="SELECT flat_no, flat_owner1_name FROM flat_owner_details";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        if(isset($_POST[$row['flat_no']])){
            $flat_no=$row['flat_no'];
            $name=$row['flat_owner1_name'];
            echo $flat_no.' '.$name;
            $iquery="INSERT INTO meeting_attendance (meeting_id, flat_no, member_name) VALUES('$meeting_id','$flat_no', '$name')";
            mysqli_query($conn, $iquery);
        }
    }
    $sql="SELECT shop_no,name1 FROM shop_owner_details";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        if(isset($_POST[$row['shop_no']])){
            $shop_no=$row['shop_no'];
            $name=$row['name1'];
            echo $flat_no.' '.$name;
            $iquery="INSERT INTO meeting_attendance (meeting_id, flat_no, member_name) VALUES('$meeting_id','$shop_no', '$name')";
            mysqli_query($conn, $iquery);
        }
    }
    $iquery="UPDATE meeting SET attendance='submitted' WHERE id='$meeting_id'";
    mysqli_query($conn, $iquery);
}

if(isset($_POST['submit_attendance_committee'])){
    $meeting_id=$_POST['meeting_id_committee'];

    $sql="SELECT id, name, role FROM society_committee";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        if(isset($_POST[$row['id']])){
            $name=$row['name'];
            $role=$row['role'];
            echo $name.' '.$role;
            $iquery="INSERT INTO meeting_attendance (meeting_id, member_name, role) VALUES('$meeting_id','$name', '$role')";
            mysqli_query($conn, $iquery);
            $iquery="UPDATE meeting SET attendance='submitted' WHERE id='$meeting_id'";
            mysqli_query($conn, $iquery);
        }
    }
}

if(isset($_POST['submit_minutes'])){
    $meeting_id=$_POST['meeting_id_m'];
    $minutes=$_POST['minutes'];
    $newarray =array();
    $newarray = explode(PHP_EOL, $minutes);

    $iquery="SELECT name,date FROM meeting WHERE id='$meeting_id'";
    $rew = mysqli_query($conn, $iquery);
    $res = mysqli_fetch_assoc($rew);
    $dat = 'Done!';
    $subject = 'Minutes of Meeting:'.$res['name'];
    $bdy = '<h3>The Minutes Of the Meeting are: </h3><br><ol>';
    foreach($newarray as $value){
        $bdy .='<li><h5>'.$value.'</h5></li>';
      }
    
    $bdy.='</ol><br><h3>Regards,<br>Secretary,<br>Ambika Heritage.</h3>';
    $sql="SELECT flat_owner1_email FROM flat_owner_details
        UNION DISTINCT
        SELECT email1 FROM shop_owner_details";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $recipient = $row['flat_owner1_email'];
        // require '../mail.php';
    }

    // echo $dat;
    $filename='../CSVs/meeting_minutes/'.$meeting_id.'.txt';
    $file=fopen($filename,'w');
    fwrite($file,$minutes);
    fclose($file);
    $iquery="UPDATE meeting SET minutes='submitted' WHERE id='$meeting_id'";
    mysqli_query($conn, $iquery);
}

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $filename='../CSVs/meeting_attendance/'.$_POST['id'].'.csv';
    $file=fopen($filename,'w');
    $headers=array('id','meeting_id','flat_no','member_name','role');
    fputcsv($file,$headers);
    $sql="SELECT * FROM meeting_attendance WHERE meeting_id='$id'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        fputcsv($file,$row);
    }
    fclose($file);
    $sql="DELETE FROM meeting_attendance WHERE meeting_id='$id'";
    mysqli_query($conn,$sql);
    $sql="UPDATE meeting SET isdone=1 WHERE id='$id'";
    mysqli_query($conn,$sql);
}

?>
