<?php
    $conn = new mysqli('localhost','root','','house') or die(mysqli_error($conn));   
    extract($_POST);
    if(isset($_POST['readRecord'])){
        $sql="SELECT * FROM society_committee";
        $result=mysqli_query($conn, $sql);
        $data='';
        $data.='<table class="table table-responsive-lg border"><thead class="">
        <tr>
        <th>Name</th>
        <th>Role</th>
        <th>Details</th>
        <th>Update</th>
        <th>Remove</th></tr>
        </thead>
        <tbody>';
        while($row=mysqli_fetch_assoc($result)){
            $data.='<tr>';
            if($row['name']){$name=$row['name'];}
            else{$name="NA";}
            $data.='<td>'.$name.'</td>';
            $data.='<td>'.$row['role'].'</td>';
            $data.='<td><button onclick="get(\''.$row['role'].'\')" class="btn btn-block border border-secondary text-info" style="border-radius:10px;">View Details</button></td>';
            // $data.='<td><button onclick="edit(\''.$row['role'].'\')" class="btn btn-block border border-secondary text-info" style="border-radius:10px;">Edit Role</button></td>';
            $data.='<td><button onclick="update(\''.$row['role'].'\')" class="btn btn-block border border-secondary text-info" style="border-radius:10px;">Update Role</button></td>';
            $data.='<td><button onclick="delte(\''.$row['id'].'\')" class="btn btn-block border border-danger" style="border-radius:10px;">Remove</button></td>';
            $data.='</tr>';
        }
        $data.='</tbody></table>';
        echo $data;
    }
    
    if(isset($_POST['deletecomm'])){
        $role = $_POST['role'];
        $sql="SELECT name,role,flat_no,join_date FROM society_committee WHERE id='$role'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        array_push($row,date('Y-m-d',strtotime('today')));
        $filename='../CSVs/history/committee.csv';
        $file=fopen($filename,'a');
        fputcsv($file,$row);
        fclose($file);
        $sql="UPDATE society_committee SET `flat_no`= NULL ,`name` = NULL,`join_date`= NULL WHERE id='$role'";    
        if(mysqli_query($conn,$sql)){
            $response['success']='Successfully Updated Member';
        }else{
            $response['error']='Error Updating Member';
        }
    }


    if(isset($_POST['view_details'])){
        $role=$_POST['role'];
        $sql="SELECT s.name, s.role, s.flat_no, f.flat_owner1_mob, f.flat_owner1_email, s.join_date FROM society_committee AS s, flat_owner_details AS f WHERE role='$role' AND s.flat_no = f.flat_no";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $data='';
        if($row['name'] != NUll){
        $data.='<div class="row">   
                    <div class="col">
                        <b>Name:&nbsp;&nbsp;</b><div class="d-inline">'.$row['name'].'</div><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Role :&nbsp;&nbsp;</b><div class="d-inline ">'.$row['role'].'</div><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Flat no :&nbsp;&nbsp;</b><div class="d-inline ">'.$row['flat_no'].'</div><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Contact :&nbsp;&nbsp;</b><div class="d-inline ">'.$row['flat_owner1_mob'].'</div><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Email :&nbsp;&nbsp;</b><div class="d-inline ">'.$row['flat_owner1_email'].'</div><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Join Date :&nbsp;&nbsp;</b><div class="d-inline ">'.$row['join_date'].'</div><hr>
                    </div>
                </div>';
        }else{
            $data .='<div class="row">   
                        <div class="col">
                        <h2>No Member Added</h2>
                        </div>
                    </div>';
        }
        echo $data;
    }


    if(isset($_POST['update_details'])){
        $a = explode("-" , $_POST['flat_no']);
        $flag = 0;
        $flat_no = $a[0];
        $name = $a[1];
        $join_date=$_POST['join_date'];

        $response=array();
        $role=$_POST['update_role'];
        // $flat_no=$_POST['flat_no'];
        // $name=$_POST['name'];

        // $mob_no=$_POST['mob_no'];
        // $email=$_POST['email'];
        // $email = '';

        
        // $sql="SELECT s.name, s.role, s.flat_no, f.flat_owner1_mob, f.flat_owner1_email, s.join_date FROM society_committee AS s JOIN flat_owner_details AS f WHERE role='$role'";
        
        $sql="SELECT name,role,flat_no,join_date FROM society_committee WHERE role='$role'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        array_push($row,date('Y-m-d',strtotime('today')));
        $filename='../CSVs/history/committee.csv';
        $file=fopen($filename,'a');
        fputcsv($file,$row);
        fclose($file);

        
        //$sql="UPDATE society_committee SET flat_no='$flat_no',name='$name',join_date='$join_date',mob_no='$mob_no',email='$email' WHERE role='$role'";
        $sql="UPDATE society_committee SET flat_no='$flat_no',name='$name',join_date='$join_date' WHERE role='$role'";
        
        if(mysqli_query($conn,$sql)){
            $response['success']='Successfully Updated Member';
        }
        else{
            $response['error']='Error While updating member';
        }
        echo json_encode($response);
        // echo $_POST['flat_no'].$flat_no.$name;
    }

    // --------------Suggestion Code for flats

    if(isset($_POST["flat"])){
        if($_POST["flat"] != ''){

		$output = '';
		// $sql = "SELECT * FROM flat_owner_details WHERE flat_no LIKE '".$_POST["flat"]."%' AND flat_owner_details.flat_no NOT IN (select s.flat_no FROM society_committee AS s)";
        $sql = "SELECT * FROM flat_owner_details WHERE flat_no NOT IN (SELECT f.flat_no FROM flat_owner_details  AS f JOIN society_committee AS s ON f.flat_no = s.flat_no) AND flat_no LIKE '".$_POST['flat']."%' ";
        $result = mysqli_query($conn, $sql);
		$output = '<ul class = "list-unstyled">';
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$output .= '<li class="border p-2 bbg">'. $row["flat_no"]. ' - '. $row['flat_owner1_name'].'</li>';
			}
		}
		else{
			
			$output .= '<p class="text-center p-2">Not found</p>';
		}
        $output .= '</ul>';       
    }else{
        $output = '';
    }
		echo $output;
    }
    //---------------------------
    
?>