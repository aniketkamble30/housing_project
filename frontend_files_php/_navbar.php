<?php
session_start();
$conn = mysqli_connect('localhost','root','','house');
if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
    header("location:../login.php");
}

$aaj = date('Y-m-d');
$fuery = "SELECT * FROM due";
$fes = mysqli_query($conn,$fuery);
if(mysqli_num_rows($fes)>0){
  while($row =mysqli_fetch_array($fes)){
    $isdue=$row['isdue'];
    $due_date=$row['due_date'];
    if($isdue==NULL && $due_date<$aaj){
      $flat_no=$row['flat_no'];
      $mail = "SELECT `flat_owner1_email` FROM `flat_owner_details` WHERE `flat_no` = '$flat_no'";
      
      $result=mysqli_query($conn,$mail);
      $row2=mysqli_fetch_assoc($result);
      $recipient=$row2['flat_owner1_email'];
      $subject = 'Notice For Pending Dues.';
      $bdy = '<h3>You Have crossed the Due date for payment. You are requested to pay it at the earliest. </h3>';
      // require 'mail.php';
    }
    $tuery = "UPDATE due SET isdue = 1 WHERE due_date < '$aaj'";
    
    mysqli_query($conn,$tuery);
  }
}

$ruery = 'SELECT * FROM due WHERE isdue = 1';
$des = mysqli_query($conn,$ruery);
if(mysqli_num_rows($des)>0){
  while($row =mysqli_fetch_array($des)){
    $id = $row['id'];
    $today = strtotime(date('y-m-d'));
    $lastdin = strtotime($row['due_date']);
    $diff = floor(($today-$lastdin)/60/60/24);
    $tuery = "UPDATE  due SET days_due = '$diff' WHERE id ='$id'";
    mysqli_query($conn,$tuery);
  }
}

  $duery = "SELECT * FROM due";
  $mes = mysqli_query($conn,$duery);
  if(mysqli_num_rows($mes)>0){
    while($row =mysqli_fetch_array($mes)){
      $tuery = "UPDATE due SET isdue = NULL,days_due = NULL WHERE due_date > '$aaj'";
      mysqli_query($conn,$tuery);
    }
  }

$new = "SELECT * FROM `due` WHERE `isdue` = 1";
$ans = mysqli_query($conn,$new);
$ansout = mysqli_fetch_array($ans);
if($ansout){
  $query = "UPDATE `admin_alerts` SET `duealert` = 1 WHERE  id = 1";
  $re = mysqli_query($conn,$query);
} 
else{
  $query = "UPDATE `admin_alerts` SET `duealert` = 0 WHERE  id = 1";
  $re = mysqli_query($conn,$query);
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shree Ambika Hertiage</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet"  href="../assets/vendors/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Raleway|Muli&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../assets/images/logo.png" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

  <style>
        * {
            font-family: 'Muli', sans-serif;
        }

.bg-input-disabled{
    background-color:#e9ecef;
}
.img-profile{
    width: 60%;
    border-top-left-radius:10px;
    border-bottom-left-radius:10px;
    height: 100%;
}
.name-profile{
    padding: 0.75rem 1.25rem;
    width: 60%;
    border-top-right-radius:10px;
    border-bottom-right-radius:10px;
    height: 100%;

}

.alert-pulse-danger
{
  width: fit-content;
  /* width: 16px; */
  /* height: 16px; */
  padding:5px;
  background: rgba(255,0,0, 0.8);
  border-radius: 2%;
  animation: shadow-pulse-danger 2s infinite;
}
.alert-pulse-info
{
  width: 16px;
  height: 16px;
  background: rgba(25, 138, 227, 0.8);
  border-radius: 2%;
  animation: shadow-pulse-info 2s infinite;
}

 .editbtn {
  border:none;
  position: absolute;
  bottom:0%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  padding: 15px 15px;
  border-radius: 50%;
}
.alert-pulse-primary
{
  width: 16px;
  height: 16px;
  background: rgba(182, 109, 255, 0.8);
  border-radius: 50%;
  animation: shadow-pulse-primary 2s infinite;
}
.alert-pulse-success
{
  width: 16px;
  height: 16px;
  background: rgba(27, 207, 180, 0.8);
  border-radius: 50%;
  animation: shadow-pulse-success 2s infinite;
}
.alert-pulse-warning
{
  width: 16px;
  height: 16px;
  background: rgba(255,0,0, 0.8);
  border-radius: 50%;
  animation: shadow-pulse-warning 2s infinite;
}
.alert-pulse-hidden
{
  width: 16px;
  height: 16px;
  background: rgba(255,255,255, 0.8);
  border-radius: 50%;
  animation: shadow-pulse-hidden 2s infinite;
}

.ring-animate{
  width: 20px;
  height: 20px;
  font-size: 20px;
  color: #9e9e9e;
  animation: ring 5s infinite;
  transform-origin: 50% 4px;
}
@keyframes ring{
    0% { transform: rotate(0); }
  1% { transform: rotate(30deg); }
  3% { transform: rotate(-28deg); }
  5% { transform: rotate(34deg); }
  7% { transform: rotate(-32deg); }
  9% { transform: rotate(30deg); }
  11% { transform: rotate(-28deg); }
  13% { transform: rotate(26deg); }
  15% { transform: rotate(-24deg); }
  17% { transform: rotate(22deg); }
  19% { transform: rotate(-20deg); }
  21% { transform: rotate(18deg); }
  23% { transform: rotate(-16deg); }
  25% { transform: rotate(14deg); }
  27% { transform: rotate(-12deg); }
  29% { transform: rotate(10deg); }
  31% { transform: rotate(-8deg); }
  33% { transform: rotate(6deg); }
  35% { transform: rotate(-4deg); }
  37% { transform: rotate(2deg); }
  39% { transform: rotate(-1deg); }
  41% { transform: rotate(1deg); }

  43% { transform: rotate(0); }
  100% { transform: rotate(0); }
} 

@keyframes shadow-pulse-hidden
{
     0% {background: rgba(255,255,255, 0.3);box-shadow: 0 0 0 0px rgba(255, 255, 255, 0.2);}
     100% {background: rgba(255,255,255, 0.8);box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);}
}
@keyframes shadow-pulse-danger
{
     0% {background: rgba(255,0,0, 0.3);box-shadow: 0 0 0 0px rgba(252, 3, 42, 0.2);}
     100% {background: rgba(255,0,0, 0.8);box-shadow: 0 0 0 20px rgba(252, 3, 42, 0);}
}

@keyframes shadow-pulse-info
{
     0% {background: rgba(25, 138, 227, 0.3);box-shadow: 0 0 0 0px rgba(25, 138, 227, 0.2);}
     100% {background: rgba(25, 138, 227, 0.8);box-shadow: 0 0 0 20px rgba(25, 138, 227, 0);}
}

@keyframes shadow-pulse-warning
{
     0% {background: rgba(254, 215, 19, 0.3);box-shadow: 0 0 0 0px rgba(254, 215, 19, 0.2);}
     100% {background: rgba(254, 215, 19, 0.8);box-shadow: 0 0 0 20px rgba(254, 215, 19, 0);}
}

@keyframes shadow-pulse-success
{
     0% {background: rgba(27, 207, 180, 0.3);box-shadow: 0 0 0 0px rgba(27, 207, 180, 0.2);}
     100% {background: rgba(27, 207, 180, 0.8);box-shadow: 0 0 0 20px rgba(27, 207, 180, 0);}
}

@keyframes shadow-pulse-primary
{
     0% {background: rgba(182, 109, 255, 0.3);box-shadow: 0 0 0 0px rgba(182, 109, 255, 0.2);}
     100% {background: rgba(182, 109, 255, 0.8);box-shadow: 0 0 0 20px rgba(182, 109, 255, 0);}
}
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar shadow-sm col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center font-weight-bold h3 justify-content-center">
          <div class="navbar-brand brand-logo" style="font-family: 'Josefin Sans';">AMBIKA HERITAGE</div>
          <div class="navbar-brand brand-logo-mini " style="font-family: 'Josefin Sans';">AH</div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
          </button>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-lg-block">
                  <a class="nav-link" href="logout.php">LOGOUT&nbsp;
                      <i class="mdi mdi-power"></i>
                  </a>
              </li>
          </ul>
      </div>
  </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold h2 mb-2">Hello</span>
                        <span class="text-secondary h2 ">Admin</span>
                    </div>
                    <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <span class="menu-title">Dashboard</span>
                    <i class="las la-braille menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update_password.php">
                    <span class="menu-title"> Update Password</span>
                    <i class="las la-edit menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="flat_tabs.php">
                    <span class="menu-title">Manage Flats</span>
                    <i class="las la-user menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop_tabs.php">
                    <span class="menu-title">Manage Shop</span>
                    <i class="mdi mdi-cart-outline menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fintabs.php">
                    <span class="menu-title">Finance/Accounting</span>
                    <i class="las la-rupee-sign menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#employee" aria-expanded="false"
                    aria-controls="employee">
                    <span class="menu-title">Employee details</span>
                    <i class="menu-arrow"></i>
                    <i class="lar la-id-card menu-icon"></i>
                </a>

                <div class="collapse" id="employee">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="add_employee.php">Add New Employee</a></li>
                        <li class="nav-item"> <a class="nav-link" href="employee_edit_details.php">Edit Employee Details</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Notices" aria-expanded="false"
                    aria-controls="Notices">
                    <span class="menu-title">Notices</span>
                    <i class="menu-arrow"></i>
                    <i class="lar la-clipboard menu-icon"></i>
                </a>

                <div class="collapse" id="Notices">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="general_notice.php">General Notices</a></li>
                        <li class="nav-item"> <a class="nav-link" href="individual_notice.php">Individual Details</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#meeting" aria-expanded="false"
                    aria-controls="meeting">
                    <span class="menu-title">Meetings</span>
                    <i class="menu-arrow"></i>
                    <i class="lar la-handshake menu-icon"></i>
                </a>

                <div class="collapse" id="meeting">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="meeting.php">Add NewMeeting</a></li>
                        <li class="nav-item"> <a class="nav-link"href="meeting_records.php">Meeting Details</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="history.php">
                    <span class="menu-title">Records/History</span>
                    <i class="las la-server menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="committee.php">
                    <span class="menu-title">Committee</span>
                    <i class="las la-user-check menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="form_admin.php">
                    <span class="menu-title">Documents</span>
                    <i class="las la-file-invoice menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="amenities.php">
                    <span class="menu-title">Amenities</span>
                    <i class="las la-dumbbell menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rules.php">
                    <span class="menu-title">Rules & Regulations</span>
                    <i class="las la-book-open menu-icon"></i>
                </a>
            </li>
        </ul>
    </nav>

      <div class="main-panel">
        <div class="content-wrapper">