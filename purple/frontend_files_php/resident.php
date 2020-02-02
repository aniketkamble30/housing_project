<?php
    include '_navbar_resident.php';
?>
<style>
.card:hover {
    cursor:pointer;
     webkit-transform: translateY(-4px) scale(1.01);
     -moz-transform: translateY(-4px) scale(1.01);
     -ms-transform: translateY(-4px) scale(1.01);
     -o-transform: translateY(-4px) scale(1.01);
     -webkit-transform: translateY(-4px) scale(1.01);
     transform: translateY(-4px) scale(1.01);
     -webkit-box-shadow: 0 14px 24px rgba(62, 57, 107, 0.1);
     box-shadow: 0 14px 24px rgba(62, 57, 107, 0.1)
 }

</style>
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-danger card-img-holder text-white">

                            <span class="badge " id="paymentalert" style="display:none;background-color:red;color:white;position:absolute;top:10px;right:25px;">New Alert</span>

                                <div class="card-body">
                                <a href="account_resident.php" class=" text-dark">
                                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
                                        alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Weekly Sales <i
                                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">Accounting</h2>
                                    <h6 class="card-text"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                            <span class="badge " id="meetingalert" style="display:none;background-color:red;color:white;position:absolute;top:10px;right:15px;">New Meeting</span>
                                <div class="card-body">
                                     <a href="resident_meeting.php" class=" text-dark">
                                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
                                        alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3"><i
                                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">Meetings</h2>
                                    <h6 class="card-text"></h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                <a href="resident_complaint.php" class=" text-dark">
                                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
                                        alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3"><i
                                            class="mdi mdi-diamond mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">Help & Support</h2>
                                    <h6 class="card-text"></h6>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <h4 class="card-title float-left">Opinion Poll</h4>
                                        <div id="visit-sale-chart-legend"
                                            class="rounded-legend legend-horizontal legend-top-right float-right">   
                                         </div>      
                                    </div>
                            
<?php
$dp = "SELECT * FROM pollrecord ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn,$dp);
$row = mysqli_fetch_assoc($result); 
$d=date('Y-m-d');
$opt1 =$row['option1'];
$opt2 =$row['option2'];
$cnt1 =$row['count1'];
$cnt2 =$row['count2'];
$dd=$row['end_date'];
if($row['questions']==NULL || ($d>=$dd)){
  echo'No Poll Added';
  $rey="UPDATE opoll SET quest1=NULL, response1=NULL";
  mysqli_query($conn,$rey);
}
else {?>
  <h4 style="text-align:center;"><u>Question</u> : <?php echo $row['questions'];?> </h4>
  <canvas id="pie-chart" ></canvas><br>
  <!-- <button class="mt-4 btn btn-danger btn-block reset-btn" onclick="terminatepoll()"> Terminate Poll</button></div> -->
<?php }?>
<?php 
$y=0;$n=0;$my=0;$nt=0;$num=0; 
$duop = "SELECT * FROM opoll";
$ret = mysqli_query($conn,$duop);
if(mysqli_num_rows($ret) > 0){
  while ($ip = mysqli_fetch_array($ret)) {
    $num+=1;
    $pizza  = $ip['response1'];
    if($pizza == $opt1){
        $y=$y+1;
        mysqli_query($conn,"UPDATE pollrecord SET count1 ='$y'");
    }
    else if($pizza == $opt2){
        $n=$n+1;
      mysqli_query($conn,"UPDATE pollrecord SET count2 ='$n'");

     }   
  //    else if($pizza == $opt3){ 
  //      $my=$my+1;
  // }
  // $nt=5-$y-$n-$my;
  $nt=$num-$y-$n;
  mysqli_query($conn,"UPDATE pollrecord SET count3 ='$num'");
}}
?>
<p>Your opinion</p>
<div class="opipo"></div>





                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Suggestion needed!</h4>
<!-- ------------------------------------------------------------------------------------------------- -->

<div class="mt-3 font-weight-bold pp" style="display:none"><p class="text-danger">*Please comment before Submitting.</p></div>
          <div class=" mt-3 font-weight-light" style="border:1px solid lightgray;">
                <div class="sugg">
                </div>
          </div>
<hr>
          <h4>Recent Notices</h4>
 <div class="noticee"></div>
<!-- ------------------------------------------------------------------------------------------------------ -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Project Status</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> Name </th>
                                                    <th> Due Date </th>
                                                    <th> Progress </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> 1 </td>
                                                    <td> Herman Beck </td>
                                                    <td> May 15, 2015 </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-success"
                                                                role="progressbar" style="width: 25%" aria-valuenow="25"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> 2 </td>
                                                    <td> Messsy Adam </td>
                                                    <td> Jul 01, 2015 </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-danger"
                                                                role="progressbar" style="width: 75%" aria-valuenow="75"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> 3 </td>
                                                    <td> John Richards </td>
                                                    <td> Apr 12, 2015 </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-warning"
                                                                role="progressbar" style="width: 90%" aria-valuenow="90"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> 4 </td>
                                                    <td> Peter Meggik </td>
                                                    <td> May 15, 2015 </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-primary"
                                                                role="progressbar" style="width: 50%" aria-valuenow="50"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> 5 </td>
                                                    <td> Edward </td>
                                                    <td> May 03, 2015 </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-danger"
                                                                role="progressbar" style="width: 35%" aria-valuenow="35"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> 5 </td>
                                                    <td> Ronald </td>
                                                    <td> Jun 05, 2015 </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info"
                                                                role="progressbar" style="width: 65%" aria-valuenow="65"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-white">Todo</h4>
                                    <div class="add-items d-flex">
                                        <input type="text" class="form-control todo-list-input"
                                            placeholder="What do you need to do today?">
                                        <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn"
                                            id="add-task">Add</button>
                                    </div>
                                    <div class="list-wrapper">
                                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                            <li>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox"> Meeting with Alisa
                                                    </label>
                                                </div>
                                                <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>
                                            <li class="completed">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox" checked> Call John
                                                    </label>
                                                </div>
                                                <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox"> Create invoice </label>
                                                </div>
                                                <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox"> Print Statements
                                                    </label>
                                                </div>
                                                <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>
                                            <li class="completed">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox" checked> Prepare for
                                                        presentation </label>
                                                </div>
                                                <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox"> Pick up kids from
                                                        school </label>
                                                </div>
                                                <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include './footer.html';?>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js'></script>
 <script>
  $(document).ready(function(){
        // $('#loader').show().delay(2000).fadeOut();
        // $('#body-clone').delay(2200).fadeIn();   
    viewpoll();
    needsugg();
    readnotice();
  });


     function viewpoll(){
    var viewpoll = "viewpoll";
    var flat_no = '<?= $_SESSION['username'] ?>';
    $.ajax({
      url : "../backend_files/pollquest.inc.php",
      type : "post",
      data :{ viewpoll:viewpoll,flat_no:flat_no },
      success:function(data,status){
        $('.opipo').html(data);
      }
    });
  }
  function subpoll(){
    var subpoll = "subpoll";
    var ans = $('[name="purpose"]').val();
    
    var flat_no = '<?= $_SESSION['username'] ?>';
    $.ajax({
      url : "../backend_files/pollquest.inc.php",
      type : "post",
      data :{ subpoll:subpoll,ans :ans,flat_no:flat_no },
      success:function(data,status){
        $('[name="purpose"]').val('');
        viewpoll();
      }
    });
  }

  //--------------------------------soumya------------------------------------------

function needsugg(){
  var seesaw="seesaw";
  $.ajax({
    url:"../backend_files/resident_suggestion.inc.php",
    type:"post",
    data:{seesaw:seesaw},
    success:function(data,success){
      $('.sugg').html(data);
    }
  });
}

function postt(){
var comment=$('#comment').val();
if(comment == ''){
  $('.pp').show().delay(10000).fadeOut('slow');
}
else{
$.ajax({
  url:"../backend_files/resident_suggestion.inc.php",
  type:"post",
  data:{
        comment:comment,
  },
  success:function(data,status){
    $('.pp').hide();
    needsugg();
  }
});

}
}

new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
            labels: ["<?php echo $opt1; ?>", "<?php echo $opt2; ?>", "No response"],
            datasets: [{
                label: "Opinion poll result",
                backgroundColor: ["#e7235c", "#473bb1","#3cba9f", "#abcedf"],
                data: [<?php echo $y; ?>,<?php echo $n; ?>,<?php echo $nt; ?>]
            }]
            },
            options: {
            title: {
                display: true,
                text: 'Opinion Poll Results'
            }
            }
        });

function readnotice(){
    var notice = "notice";
    // var flat_no = '< ?= $_SESSION['username'] ?>';
    $.ajax({
      url : "../backend_files/resident_notice.inc.php",
      type : "post",
      data :{ notice:notice },
      success:function(data,status){
          console.log(data);
        $('.noticee').html(data);
      }
    });
  }
//-------------------------soumya--------------------------------------------------


 </script>