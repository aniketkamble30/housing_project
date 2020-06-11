<?php
    session_start();
    extract($_POST);
    $conn = mysqli_connect( 'localhost','root',"",'house' );
    if(isset($_POST['update'])){
        $current=$_POST['current_password'];
        $new=$_POST['new_password'];
        $confirm=$_POST['confirm_password'];
        $role=$_SESSION['role'];
        $flat_no=$_SESSION['username'];
        $response=array();

        if($role=='admin'){
            $sql="SELECT password FROM login WHERE username='admin'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $current=sha1($current);
            if($current==$row['password']){
                $new=sha1($new);
                $confirm=sha1($confirm);
                if($new==$confirm){
                    $uquery="UPDATE login SET password='$new' WHERE username='admin'";
                    if(mysqli_query($conn,$uquery)){
                        $response['success']='updated';
                    }
                    else{
                        $response['error']='Error';
                    }
                }
                else{   
                    $response['error']='Error';
                }
            }
            else{
                $response['error']='Error1';
            }
            echo json_encode($response);
        }
        else if($role=='resident'){
            $sql="SELECT password FROM login WHERE username='$flat_no'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $current=sha1($current);
            if($current==$row['password']){
                $new=sha1($new);
                $confirm=sha1($confirm);
                if($new==$confirm){
                    $uquery="UPDATE login SET password='$new' WHERE username='$flat_no'";
                    if(mysqli_query($conn,$uquery)){
                        $response['success']='updated';
                    }
                    else{
                        $response['error']='Error';
                    }
                }
                else{   
                    $response['error']='Error';
                }
            }
            else{
                $response['error']='Error1';
            }
            echo json_encode($response);
        }
        else if($role=='tenant'){
            $sql="SELECT password FROM login WHERE username='$flat_no'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $current=sha1($current);
            if($current==$row['password']){
                $new=sha1($new);
                $confirm=sha1($confirm);
                if($new==$confirm){
                    $uquery="UPDATE login SET password='$new' WHERE username='$flat_no'";
                    if(mysqli_query($conn,$uquery)){
                        $response['success']='updated';
                    }
                    else{
                        $response['error']='Error';
                    }
                }
                else{   
                    $response['error']='Error';
                }
            }
            else{
                $response['error']='Error1';
            }
            echo json_encode($response);
        }
        else if($role=='shop'){
            $sql="SELECT password FROM login WHERE username='$flat_no'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $current=sha1($current);
            if($current==$row['password']){
                $new=sha1($new);
                $confirm=sha1($confirm);
                if($new==$confirm){
                    $uquery="UPDATE login SET password='$new' WHERE username='$flat_no'";
                    if(mysqli_query($conn,$uquery)){
                        $response['success']='updated';
                    }
                    else{
                        $response['error']='Error';
                    }
                }
                else{   
                    $response['error']='Error';
                }
            }
            else{
                $response['error']='Error1';
            }
            echo json_encode($response);
        }

    }
?>