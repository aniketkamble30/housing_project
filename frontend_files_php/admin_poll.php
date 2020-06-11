<?php include './_navbar.php';?>
<style>
.hoja{
   border: 1px solid red;
   border-radius:5px;
 }
 </style>

<div class="page-header">
<h2 class="text-info">Opinion Poll Results</h2>
  <hr>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php" id="dashboardbox1">Homepage</a></li>
      <li class="breadcrumb-item active" aria-current="page">Opinion Poll</li>
    </ol>
  </nav>
</div>

<div class="row">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <a href="poll_history.php" class="btn purchase-button">Previous Polls</a>
                </span>
              </div>
</div>

<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  
                    <div class="form-group  pl-2 pr-2 pb-2">
                  <label> Question:</label><br>
                    <input type="textarea" class="form-control" id="pollquest" cols="27"><br>
                      Option1<input type="text" id="option1"  class="form-control" ><br>
                      Option2<input type="text" id="option2"  class="form-control" ><br>
                      End poll on<input type="date" id="enddate"  class="form-control" >
                      <button class="mt-3 btn btn-info btn-block reset-btn" onclick="addpoll()"> + Add Poll</button>
                  <!-- <div class="d-flex justify-content-center mt-2  "><a href="pollresults.php" class="btn btn-block btn-outline-primary">View Poll Results</a></div>  -->
           
   
                  </div>
                </div>
</div>
</div>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <h3>ONGOING POLL</h3><hr>
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
  <h3><u>Question</u> : <?php echo $row['questions'];?> </h3>
  <canvas id="pie-chart" ></canvas><br>
  <input type="button" class="mt-4 btn btn-danger btn-block reset-btn" value="Terminate poll" onclick="badaalert()">
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

                  </div>
                </div>
              </div>
            </div>
</div>

            <div class="modal fade" id="con">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center>  <h3 class="modal-title" style="color:gray;"><i class="fas fa-exclamation-triangle"></i></h3></center>
              <h4><p class="row m-1 text-center" style="width:100%;">Are you sure you want to terminate ongoing poll?<p></h4>
              <center><button class="mt-4 btn btn-outline-danger btn-block reset-btn" onclick="terminatepoll()"> Terminate Poll</button></center>
        </div>
            </div>
            </div>
            </div>

      <div class="modal fade" id="contermi">
      <div class="modal-dialog hoja">
        <div class="modal-content">
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center>  <h3 class="modal-title" style="color:brown;"><i class="fas fa-exclamation-triangle"></i></h3></center>
              <h4><p class="row m-1 text-center"><center style="width:100%; color:red;">Terminate the ongoing poll first.</center><p></h4>
             
            </div>
            </div>
            </div>



<?php  include './footer.html';?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js'></script>

<script>

function terminatepoll(){
  var ter="ter";
  $.ajax({
    url:'../backend_files/admin_poll.inc.php',
    type:'post',
    data:{ter:ter},
    success :function(data,status){
      pollresults();
      location.reload();
    }
  })
}

function pollresults(){
    var pollresults = "pollresults";
    $.ajax({
      url : "../backend_files/admin_poll.inc.php",
      type : "post",
      data :{ pollresults:pollresults},
      success:function(data,status){
        $('.showie').append(data);
      }
    });
  }
  
  function badaalert(){
        $('#con').modal('show');
      }


  function addpoll(){
      var pollquest = $('#pollquest').val();
      var option1 = $('#option1').val();
      var option2 = $('#option2').val();
      var enddate = $('#enddate').val();
      if($('#pollquest').val()==''){
        $('#pollquest').css('border','1.5px solid red');
        }
        else if($('#option1').val()==''){
        $('#option1').css('border','1.5px solid red');
        }
        else if($('#option2').val()==''){
        $('#option2').css('border','1.5px solid red');
        }
        else if($('#enddate').val()==''){
        $('#enddate').css('border','1.5px solid red');
      }
      else{
        $.post(
          "../backend_files/admin_poll.inc.php",
            { pollquest:pollquest,option1:option1,option2:option2,enddate:enddate},
            function(data,status){
              if(data=="terminate"){
                $('#contermi').modal('show');
               // alert('terminate ongoing poll first!');
              }
              else{
               // alert('poll added');
                location.reload();
              }
              pollresults();
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

</script>
