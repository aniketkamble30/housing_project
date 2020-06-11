<?php
    extract($_POST);
    if(isset($_POST['submit_details'])){
        $conn = mysqli_connect( 'localhost','root',"",'house' );
        $flat_no=$_POST['flat_no'];
        $sql="SELECT flat_no FROM flat_owner_details WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn, $sql); 
        if(mysqli_num_rows($result)==0){
            $response['error']='Flat Number is not valid';
            echo json_encode($response);
        } 
        else{
            $flat_no=$flat_no.'T';
            $sql="SELECT flat_no FROM tenant_details WHERE flat_no='$flat_no'";
            $result=mysqli_query($conn, $sql); 
            if(mysqli_num_rows($result)==0){
               
                
                
                $image1 = $_FILES['image1']['tmp_name'];
                $size1 = $_FILES['image1']['size'];
                $array1=explode('.',$_FILES['image1']['name']);
                $ext1=end($array1);
                $d=date('Y-m-d',strtotime('today'));

                if(in_array(strtolower($ext1),array("jpg","jpeg","png","pdf","gif")) &&($size1<=100000000))
                {
    
                      if(!is_dir("../DB_docs_images/flat_tenant/$flat_no"))
                      {
                        mkdir("../DB_docs_images/flat_tenant/$flat_no");
                      }
                      $filename1 = 'owner1-'.$d.'.'.$ext1;
                      $dest1 = '../DB_docs_images/flat_tenant/'.$flat_no.'/'.$filename1;
                      move_uploaded_file($image1,$dest1);
                    }
                if(isset($_POST ['member1_name'])){
                $member1_name=$_POST ['member1_name'];
                }
                else{ $member1_name="" ;}
                if(isset($_POST ['member2_name'])){
                    $member2_name=$_POST ['member2_name'];
                    }
                else{ $member2_name="" ;}
                if(isset($_POST ['member3_name'])){
                    $member3_name=$_POST ['member3_name'];
                    }
                else{ $member3_name="" ;}
                if(isset($_POST ['member4_name'])){
                    $member4_name=$_POST ['member4_name'];
                    }
                else{ $member4_name="" ;}

                $agreement_holder_name=$_POST['agreement_holder_name'];
                $agreement_holder_email=$_POST['agreement_holder_email'];
                $agreement_holder_mobile=$_POST['agreement_holder_mobile'];
                $agreement_holder_dob=$_POST['agreement_holder_dob'];
                $tenant_count_of_members=$_POST['tenant_count_of_members'];
                $tenant_move_in_date=$_POST['tenant_move_in_date'];
                $result=array();
                $sql="INSERT INTO `tenant_details`
                (`flat_no`,
                 `tenant_count_of_members`,
                `member1`,
                `member2`,
                `member3`,
                `member4`,
                `agreement_holder_name`,
                 `agreement_holder_mobile`,
                 `agreement_holder_email`,
                 `agreement_holder_dob`,
                 `tenant_move_in_date`,
                `image` ) 
                VALUES ('$flat_no',
                '$tenant_count_of_members',
                '$member1_name',
                '$member2_name',
                '$member3_name',
                '$member4_name',
                '$agreement_holder_name',
                '$agreement_holder_mobile',
                '$agreement_holder_email',
                '$agreement_holder_dob',
                '$tenant_move_in_date',
                '$filename1')";

                if(mysqli_query($conn, $sql)){
                    $f_no=substr($flat_no,0,-1);
                    $sql="UPDATE flat_details SET flat_status='rented' WHERE flat_no='$f_no'";
                    if(mysqli_query($conn, $sql)){
                        $username=$flat_no;
                        $password=sha1('admin');
                        $sql="INSERT INTO login (username, password, usertype) VALUES('$username', '$password', 'tenant')";
                        if(mysqli_query($conn, $sql)){
                            if(!is_dir('../DB_docs_images/forms/'.$flat_no)){

                                mkdir('../DB_docs_images/forms/'.$flat_no);
                            }
                            $response['success']='Tenant Added Successfully';
                            echo json_encode($response);
                        }
                        else{
                            $response['error']='Error while adding Tenant';
                            echo json_encode($response);
                        }
                    }
                    else{
                        $response['error']='Error while adding Tenant';
                        echo json_encode($response);
                    }
                }
                else{
                    $response['error']='Error while adding Tenant';
                    echo json_encode($response);
                }
            }
            else{
                $response['error']='Tenant with the flat no is already added';
                echo json_encode($response);
            }
        } 
    }
?>