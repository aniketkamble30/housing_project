    <?php
    $conn = mysqli_connect( 'localhost','root',"",'house' );
    extract($_POST);
    if(isset($_POST['readRecord'])){
        $sql="SELECT * FROM meeting WHERE isdone=1 ORDER BY date DESC";
        $result=mysqli_query($conn,$sql);
        $data='';
        $data.='<table class="table table-bordered table-striped" id="myMeetings"><thead class="bg-secondary text-white">';
        $data.='<tr>';
        $data.='<th class="njo">Name</th>';
        $data.='<th class="njo">Date</th>';
        $data.='<th class="njo">Type</th>';
        $data.='<th class="njo">View</th>';
        $data.='</tr>';
        $data.='</thead>';
        $data.='<tbody>';
        while($row=mysqli_fetch_assoc($result)){
            $data.='<tr>';
            $data.='<td class="njo">'.$row['name'].'</td>';
            $data.='<td class="njo">'.$row['date'].'</td>';
            $data.='<td class="njo">'.$row['type'].'</td>';
            $data.='<td class="njo"><button onclick="view('.$row['id'].')" class="btn btn-block text-info btn-outline-dark">View</button></td>';
            $data.='</tr>';
        }
        $data.='</tbody></table>';
        echo $data;
    }

    if(isset($_POST['get_details'])){
        //$date=$_POST['date'];
        $id=$_POST['id'];
        $sql="SELECT name,type FROM meeting WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $attendance_file='../CSVs/meeting_attendance/'.$id.'.csv';
        $file=fopen($attendance_file,'r');
        $size=filesize($attendance_file);
        $type=$row['type'];
        $seperator=",";
        $data='';
        $minutes='';
        $response=array();

        $response['id']=$id;
        $response['name']=$row['name'];
        $response['type']=$type;
        $row=fgetcsv($file,$size,$seperator);
        if($type=='general'){
            $data.='<table class="table table-bordered table-striped" id="myTable"><thead class="bg-secondary text-white">';
            $data.='<tr>';
            $data.='<th class="njo">Flat No./ Shop No.</th>';
            $data.='<th class="njo">Member Name</th>';
            $data.='</tr>';
            $data.='</thead><tbody>';
            while($row=fgetcsv($file,$size,$seperator)){
                $data.='<tr>';
                $data.='<td class="njo">'.$row[2].'</td>';
                $data.='<td class="njo">'.$row[3].'</td>';
                $data.='</tr>';
            }
            $data.='</tbody></table>';
            $response['data']=$data;
        }
        else{
            $data.='<table class="table table-bordered table-striped" ><thead class="bg-secondary text-white">';
            $data.='<tr>';
            $data.='<th class="njo">Name</th>';
            $data.='<th class="njo">Role</th>';
            $data.='</tr>';
            $data.='</thead><tbody>';
            while($row=fgetcsv($file,$size,$seperator)){
                $data.='<tr>';
                $data.='<td class="njo">'.$row[3].'</td>';
                $data.='<td class="njo">'.$row[4].'</td>';
                $data.='</tr>';
            }
            $data.='</tbody></table>';
            $response['data']=$data;
        }
        $minutes_file='../CSVs/meeting_minutes/'.$id.'.txt';
        $file=fopen($minutes_file,'r');
        if(filesize($minutes_file)>0){
            $txt=fread($file, filesize($minutes_file));
            $arr=explode("\n",$txt);
            foreach($arr as $elem){
                $minutes.='<li class="list-group-item">'.$elem.'</li>';
            }
            $response['minutes']=$minutes;
        }
        else{
            $response['minutes']='';
        }

        echo json_encode($response);
    }
?>