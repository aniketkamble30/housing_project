<?php
$conn = mysqli_connect( 'localhost','root',"",'house' );
session_start();
 $username= $_SESSION['username'];
 $flat_no=$_SESSION['username'];

//     // $conn = mysqli_connect('localhost', 'root','','house');
//     $filename ="";   
//     $target_directory = "../DB_docs_images/profile_images/".$username;
//     if(!is_dir("../DB_docs_images/profile_images/$username")){
//         mkdir("../DB_docs_images/profile_images/$username");
//     }else{
        
//         rmdir("../DB_docs_images/profile_images/$username");
//         mkdir("../DB_docs_images/profile_images/$username");
//     }
//     $target_file = $target_directory.basename($_FILES['file']['name']);

//     $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//     $filename .= $_SESSION['username']."profimg.".$filetype;
//     $query="INSERT INTO login(profile_pic) VALUES('$filename')";

//         if(mysqli_query($conn,$query)){
//             $newfilename = $filename;
            
//             if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename)) echo $filename;
//             else echo $_FILES['file']['name'];
//     };

if(isset($_FILES['f']['name'])){

    $tmp=$_FILES['f']['tmp_name'];
    $array= explode('.',$_FILES['f']['name']);
    $ext=end($array);
    if(in_array(strtolower($ext),array("jpg","jpeg","png"))){

        if(!is_dir("../DB_docs_images/profile_images/$username")){
        mkdir("../DB_docs_images/profile_images/$username");
        }

    $dest='../DB_docs_images/profile_images/'.$username.'/'.$username.'.'.$ext;
    $name=$username.'.'.$ext;
    if(file_exists($dest)){
        unlink($dest);
    }
    $query="UPDATE login SET `profile_pic`='$name' WHERE `username` = '$username'";
    $res = mysqli_query($conn,$query);
    if($res){
    
    move_uploaded_file($tmp,$dest);}
}
}
    

if(isset($_POST['pic'])){
    $usname = $_POST['pic'];
 //   echo $usname;

    $py="SELECT * FROM `login` WHERE `username`= '$username' ";
    if (!$result = mysqli_query($conn,$py)) {
        exit(mysqli_error());
        }

    $response = array();

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
                $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
echo json_encode($response);
}


if(isset($_POST['pro'])){
    $data='';
      $type=null;
      if(substr($flat_no,0,1)=='S'){
          if(substr($flat_no,-1)=='T'){
              $type='shop_tenant';
          }
          else{
              $type='shop';
          }
  
      }
      else{
          if(substr($flat_no,-1)=='T'){
              $type='tenant';
          }
          else{
              $type='resident';
          }
      }
      // echo $type;
      if($type=='resident'){
          $you = "SELECT flat_owner1_mob,flat_owner1_email FROM flat_owner_details where flat_no='$flat_no'";
          $mark = mysqli_query($conn,$you);
          $row=mysqli_fetch_assoc($mark);
          $mob=$row['flat_owner1_mob'];
          $email=$row['flat_owner1_email'];
      }
      else if($type=='shop'){
          $you = "SELECT phoneno1,email1 FROM shop_owner_details where shop_no='$flat_no'";
          $mark = mysqli_query($conn,$you);
          $row=mysqli_fetch_assoc($mark);
          $mob=$row['phoneno1'];
          $email=$row['email1'];
      }
      else if($type=='tenant'){
          $you = "SELECT agreement_holder_mobile,agreement_holder_email FROM tenant_details where flat_no='$flat_no'";
          $mark = mysqli_query($conn,$you);
          $row=mysqli_fetch_assoc($mark);
          $mob=$row['agreement_holder_mobile'];
          $email=$row['agreement_holder_email'];
      }
      
  
  
      $data.= '<table class="table-borderless table table-responsive ">
      <tr>
          <td>
              <p class="ml-2 text-secondary">Contact Information</p>
          </td>
          <td>
              <p class="ml-2 text-secondary" style="float-left"><button id="editbutton" onclick="showw()" class="btn-gradient-secondary">Edit</button>
              </p>
          </td>
       
      </tr>
      <tr>
          <td class="font-weight-bold text-info">Phone</td>
          <td class="font-weight-bold text-info">'.$mob.'</td>
      </tr>
      <tr>
          <td class="font-weight-bold text-info">Email</td>
          <td class="font-weight-bold text-info">'.$email.'</td>
      </tr>

  </table>
      <br>
      <div >
      <table class="table-borderless table table-responsive" id="edittt" style="display:none;">
      <tr>
          <td>
              <p class="ml-2 text-secondary">Edit Contact Information</p>
          </td>

          <td>
            <p class="ml-2 text-secondary"><i class="las la-window-close h3" id="dmiss" onclick="dmiss()"></i></p>
            </td>
      </tr>
      <tr>
          <td class="font-weight-bold text-info">Phone</td>
          <td width="100%" class="font-weight-bold text-info">
           <input type="text" class="form-control" name="con" id="con" placeholder="Contact">
           </td>
           <td>
           <h3><i class="las la-chevron-circle-right conlk mt-3" id="tact" onclick="contact()"></i><h3>
          </td>
      </tr>
      <tr>
          <td  class="font-weight-bold text-info">Email</td>
          <td width="100%" class="font-weight-bold text-info">  
          <input type="email" class="form-control" name="e" id="e" placeholder="Email">
          </td>
          <td>
<h3><i class="las la-chevron-circle-right mt-3 conlk" id="mail" onclick="email()"></i></h3>
          </td>
      </tr>

  </table> 
  </div> 

     
      ';
  
  echo $data;
  }
  
  if(isset($_POST['con'])){
    $data="";
    $contact=$_POST['con'];
    if(substr($flat_no,0,1)=='S'){
        if(substr($flat_no,-1)=='T'){
            $type='shop_tenant';
        }
        else{
            $type='shop';
        }

    }
    else{
        if(substr($flat_no,-1)=='T'){
            $type='tenant';
        }
        else{
            $type='resident';
        }
    }

    if($type=='resident'){
        $tyty = "UPDATE flat_owner_details set flat_owner1_mob='$contact' where flat_no='$flat_no'";
        mysqli_query($conn,$tyty);
    }
    else if($type=='shop'){
        $tyty = "UPDATE shop_owner_details set phoneno1='$contact' where shop_no='$flat_no'";
        mysqli_query($conn,$tyty);
    }
    else if($type=='tenant'){
        $tyty = "UPDATE tenant_details set agreement_holder_mobile='$contact' where flat_no='$flat_no'";
        mysqli_query($conn,$tyty);
    }
        $data .='   <p class="alert alert-success">Updated Successfully !</p>';
    echo $data;
}

if(isset($_POST['email'])){
    $data ='';
  $email=$_POST['email'];
  if(substr($flat_no,0,1)=='S'){
        if(substr($flat_no,-1)=='T'){
            $type='shop_tenant';
        }
        else{
            $type='shop';
        }

    }
    else{
        if(substr($flat_no,-1)=='T'){
            $type='tenant';
        }
        else{
            $type='resident';
        }
    }

    if($type=='resident'){
        $tyty = "UPDATE flat_owner_details set flat_owner1_email='$email' where flat_no='$flat_no'";
        mysqli_query($conn,$tyty);
    }
    else if($type=='shop'){
        $tyty = "UPDATE shop_owner_details set email1='$email' where shop_no='$flat_no'";
        mysqli_query($conn,$tyty);
    }
    else if($type=='tenant'){
        $tyty = "UPDATE tenant_details set agreement_holder_email='$email' where flat_no='$flat_no'";
        mysqli_query($conn,$tyty);
    }
    
    $data .='   <p class="alert alert-success">Updated Successfully !</p>';
    echo $data;
}


?>


