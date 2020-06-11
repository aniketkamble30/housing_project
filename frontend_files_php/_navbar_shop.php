<?php
// session_start();
$conn = mysqli_connect('localhost','root','','house');
if(!isset($_SESSION['username']) || $_SESSION['role']!="shop"){
    header("location:../index.php");
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
    <link rel="stylesheet" href="../assets/vendors/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans|Raleway&display=swap">
    <link rel="shortcut icon" href="../assets/images/logo.png" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <style>
        * {
            font-family: 'Raleway', sans-serif;
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
  width: 16px;
  height: 16px;
  background: rgba(255,0,0, 0.8);
  border-radius: 50%;
  animation: shadow-pulse-danger 2s infinite;
}
.alert-pulse-info
{
  width: 16px;
  height: 16px;
  background: rgba(25, 138, 227, 0.8);
  border-radius: 50%;
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
<?php
$conn = mysqli_connect('localhost','root','','house');
$result = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM `shop_owner_details` WHERE `shop_no` = \''.$_SESSION['username'].' \' '));
$name = $result['name1'];
$email = $result['email1'];
$email2 = $result['email2'];
$phone = $result['phoneno1'];
$business_type = $result['business_type'];
$type_of_ownership  = $result['type_of_ownership'];
$dob  = $result['dob1'];
$dob2  = $result['dob2'];
$name2  = $result['name2'];
$phone2 = $result['phoneno2'];
$indate = $result['indate'];
?>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar shadow-sm col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div
                class="text-center navbar-brand-wrapper d-flex align-items-center font-weight-bold h3 justify-content-center">
                <div class="navbar-brand brand-logo" style="font-family: 'Josefin Sans';">AMBIKA HERITAGE</div>
                <div class="navbar-brand brand-logo-mini " style="font-family: 'Josefin Sans';">AH</div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
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
                        <a href="shop_profile.php" class="nav-link">
                            <div class="nav-profile-image">
                                <?php echo'<img src="../DB_docs_images/shop/profile_images/'.$_SESSION['username'].'/'.$_SESSION['profile_pic'].'" alt="profile">'; ?>
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold small mb-2">
                                    <?php echo ''.$name.''; ?>
                                </span>
                                <span class="text-dark text-small">
                                    <?php echo ''.$_SESSION['username'].''; ?>
                                </span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">
                            <span class="menu-title">Dashboard</span>
                            <i class="las la-braille menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="update_password.php">
                            <span class="menu-title">Update Password</span>
                            <i class="las la-edit menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop_add_tenant.php">
                            <span class="menu-title"> Add Tenant</span>
                            <i class="las la-user-plus menu-icon"></i>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="view_meeting.php">
                            <span class="menu-title">Meetings</span>
                            <i class="las la-handshake menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#meeting" aria-expanded="false"
                            aria-controls="meeting">
                            <span class="menu-title">Accounts/Finance</span>
                            <i class="menu-arrow"></i>
                            <i class="las la-rupee-sign menu-icon"></i>
                        </a>

                        <div class="collapse" id="meeting">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="user_payment.php">Add Payment Intimation</a></li>
                                <li class="nav-item"> <a class="nav-link" href="">My Transactions</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="form_tenant.php">
                            <span class="menu-title">Tenant Documents</span>
                            <i class="las la-file-pdf menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="form_user.php">
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