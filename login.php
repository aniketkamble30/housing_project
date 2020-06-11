<?php
session_start();
//He Mi kela
$conn =new mysqli('localhost','root','','house') or die(mysqli_error($conn));
$msg="";

if(isset($_POST['login'])){
  $username=mysqli_real_escape_string($conn,$_POST['usertype']) ;
  $password=mysqli_real_escape_string($conn,$_POST['username']);
  $password=sha1($password);
  $usertype=mysqli_real_escape_string($conn,$_POST['password']);

  $sql ="SELECT * FROM login WHERE username=? AND password=? AND usertype=?";
  $stmt=$conn->prepare($sql);
  $stmt->bind_param("sss",$username,$password,$usertype);
  $stmt->execute(); 
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
//   session_unset();
//   session_destroy();
  session_regenerate_id();
  $_SESSION['username'] =$row['username'];
  $_SESSION['role'] =$row['usertype'];
  $_SESSION['profile_pic'] =$row['profile_pic'];
  session_write_close();

  if($result->num_rows==1 && $_SESSION['role']=="admin"){
    header("location:./frontend_files_php/admin.php");
  }
  else if($result->num_rows==1 && $_SESSION['role']=="resident"){
    header("location:./frontend_files_php/resident.php");
  }
  else if($result->num_rows==1 && $_SESSION['role']=="tenant"){
    header("location:./frontend_files_php/tenant.php");
  }
  else if($result->num_rows==1 && $_SESSION['role']=="employee"){
    header("location:./frontend_files_php/employee.php");
  }
  else if($result->num_rows==1 && $_SESSION['role']=="shop"){
    header("location:./frontend_files_php/shop.php");
  }
  else{
    $msg="Username or password is incorrect !";
  }
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Raleway&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        * {
            font-family: 'Raleway', sans-serif;
        }

        .brand-log{
            padding:8%;
            font-weight: bold;
            font-size: 140%;
        }

        .content-wrapper {
            background-image: url("./assets/image/soc3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right center;
            /* background-blend-mode: luminosity; */

        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper  d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 my-auto">
                        <div class="auth-form-light shadow text-left p-5">
                            <div class=" brand-log" style="font-family: 'Josefin Sans';">SHREE AMBIKA
                                HERITAGE</div>
                            <form class="pt-3" action="login.php" method="post">
                                <div class="form-group">
                                    <label for="">UserName</label>
                                    <input type="text" required class="form-control form-control-lg" name="usertype"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select class="form-control"required name="password">
                                        <option selected>Choose..</option>
                                        <option value="admin">Admin</option>
                                        <option value="resident">Resident</option>
                                        <option value="shop">Shop Owner</option>
                                        <option value="tenant">Tenant</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" required class="form-control form-control-lg"
                                        name="username" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <input type="submit"  name="login" value="Login" class="btn btn-primary btn-block">
                                </div>
                            </form>

                            <h5 class="text-danger text-center p-3"><?= $msg; ?></h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
</body>

</html>
