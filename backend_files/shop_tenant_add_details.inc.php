<?php
    $conn =mysqli_connect('localhost','root','','house');// or die(mysqli_error($conn));

    extract($_POST);
    if(isset($_POST['shop_no'])){
        $filename1="";
        $shop_no=$_POST['shop_no'];
        $shop_no_n=$shop_no.'T';
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phoneno=$_POST['phoneno'];
        $dob=$_POST['dob'];
        $move_in_date=$_POST['move_in_date'];
     
        $response=array();
        $query="SELECT shop_no FROM shop_owner_details WHERE shop_no='$shop_no'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            $query="SELECT shop_no FROM shop_tenant_details WHERE shop_no='$shop_no_n'";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                $response['error']='A tenant is already registered with this shop no';
            }
            else{
                $image1 = $_FILES['image1']['tmp_name'];
                $size1 = $_FILES['image1']['size'];
                $array1=explode('.',$_FILES['image1']['name']);
                $ext1=end($array1);
                $d=date('Y-m-d',strtotime('today'));

                              if(in_array(strtolower($ext1),array("jpg","jpeg","png")) &&($size1<=100000000))
                {
    
                      if(!is_dir("../DB_docs_images/shop_tenant/$shop_no_n"))
                      {
                        mkdir("../DB_docs_images/shop_tenant/$shop_no_n");
                      }
                      $filename1 = 'tenant-'.$d.'.'.$ext1;
                      $dest1 = '../DB_docs_images/shop_tenant/'.$shop_no_n.'/'.$filename1;
                      move_uploaded_file($image1,$dest1);
                    }





                $sql="INSERT INTO `shop_tenant_details`(`shop_no`, `agreement_holder_name`, `agreement_holder_email`, `agreement_holder_mobile`, `agreement_holder_dob`,`image`, `move_in_date`) VALUES ('$shop_no_n','$name','$email','$phoneno','$dob','$filename1','$move_in_date')";
                if(mysqli_query($conn,$sql)){
                    $query="INSERT INTO forms_shop_tenant (shop_no) VALUES ('$shop_no_n')";
                    if(mysqli_query($conn,$query)){
                        $conn->query("UPDATE shop_details SET shop_status='rented' WHERE shop_no='$shop_no'") or die($conn->error);
                        if(!is_dir('../DB_docs_images/forms/'.$shop_no_n)){

                            mkdir('../DB_docs_images/forms/'.$shop_no_n);
                        }
                        $response['success']='Successfully added shop tenant';
                    }
                    else{
                        $response['error']='Error while adding shop tenant';
                    }
                }
                else{
                    $response['error']='Error while adding shop tenant';
                }
            }    
        }
        else{
            $response['error']='Invalid Shop no';
        }
        echo json_encode($response);
    }

if(isset($_POST['check'])){
  //  $response=array();
    $shop_no=$_POST['check'];
    $shop_no_n=$shop_no.'T';
    $query="SELECT * FROM shop_tenant_details WHERE shop_no='$shop_no_n'";
    $result=mysqli_query($conn,$query);
    $response = array();

    if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                 $response = $row;
            }
        $response['nonedit']='not editable';
    }
    // else{
    //     $response['edit']='this shop no';
    // }
    echo json_encode($response);
}
?>