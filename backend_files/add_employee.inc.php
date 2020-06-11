<?php
$conn = mysqli_connect( 'localhost','root',"",'house' );
if(isset($_POST['submit_details'])){
    $emp_id= $_POST['emp_id'];
    $response = array();
//     $sql="SELECT emp_id FROM society_employee WHERE emp_id='$emp_id'";
//    $result=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($result)==0){


        $image1 = $_FILES['image1']['tmp_name'];
        $size1 = $_FILES['image1']['size'];
        $array1=explode('.',$_FILES['image1']['name']);
        $ext1=end($array1);

        $File2 = $_FILES['File2']['tmp_name'];
        $size2 = $_FILES['File2']['size'];
        $array2=explode('.',$_FILES['File2']['name']);
        $ext2=end($array2);

        if(!empty($_FILES['File3']['tmp_name'])){
        $File3 = $_FILES['File3']['tmp_name'];
        $size3 = $_FILES['File3']['size'];
        $array3=explode('.',$_FILES['File3']['name']);
        $ext3=end($array3);
        }
        else{
        $File3="";
        $filename3="";
        }
        $d=date('Y-m-d',strtotime('today'));

        if(in_array(strtolower($ext1),array("jpg","jpeg","png",)) &&($size1<=100000000))
        {
              $filename1 = 'empimg-'.$d.'-'.$emp_id.'.'.$ext1;
              $dest1 = '../DB_docs_images/employee/emp_image/'.$filename1;
              if(move_uploaded_file($image1,$dest1)){

                if(in_array(strtolower($ext2),array("pdf","doc","docx")) &&($size2<=100000000))
                {
                      $filename2 = 'empprf-'.$d.'-'.$emp_id.'.'.$ext2;
                      $dest2 = '../DB_docs_images/employee/id_proof/'.$filename2;
                    if( move_uploaded_file($File2,$dest2)){

                        if($File3!=""){
                            if(in_array(strtolower($ext3),array("pdf","doc","docx")) &&($size3<=100000000))
                            {
                    
                                $filename3 = 'empO-'.$d.'-'.$emp_id.'.'.$ext3;
                                $dest3 = '../DB_docs_images/employee/other_doc/'.$filename3;
                                if( move_uploaded_file($File3,$dest3)){
                                    $filename3 = 'empO-'.$d.'-'.$emp_id.'.'.$ext3;
                                }
                                else{
                                    $response['error']="error while uploading other document";
                                }
                            }
                            else{
                                $response['error']='image type or size does not match';
                            }
                    }

                        $emp_name= $_POST['emp_name'];
                        $emp_type= $_POST['emp_type'];
                        $agency= $_POST['agency'];
                        $emp_mob= $_POST['emp_mob'];
                        $join_date= date('Y/m/d',strtotime($_POST['join_date']));
                        $emp_salary= $_POST['emp_salary'];
                        $emp_yearly_incr= $_POST['emp_yearly_incr'];
                        $password=sha1('admin');
                        $response=array();
                        $sql = "INSERT INTO society_employee (emp_id, emp_name, emp_type, agency, emp_mob, join_date, emp_salary, emp_yearly_incr,emp_image,id_proof,other_doc)
                        VALUES ('$emp_id', '$emp_name', '$emp_type', '$agency', '$emp_mob','$join_date', '$emp_salary', '$emp_yearly_incr','$filename1','$filename2','$filename3')";
                        if(!mysqli_query($conn, $sql)){
                            $response['error']='Error while adding employee';
                        }
                        else{
                            $response['success']='Employee added successfully';
                        }

                    }
                    else{
                     $response['error']='Error while uploading id proof';
                    }
               }
               else{
                $response['error']='file type or size does not match';
               }
              }
              else{
                $response['error']='Error while uploading image';
              }
        }
        else{
            $response['error']='image type or size does not match';
        }
   // }
    // else{
    //     $response['error']='Error while adding employee';
    // }
    echo json_encode($response);
 }
?>
