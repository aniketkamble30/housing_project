<?php 
session_start();
include './_navbar_shop.php';?>
<style>

</style>
<?php include 'shop_dashboard_icons.php';?>
<div class="row mt-3">
  <div class="col-md-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="clearfix">
          <h4 class="card-title float-left">Opinion Poll</h4>
          <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right">   
          </div>      
        </div>
        <div id="disc">                       
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
            // echo'No Poll Added';
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
                $num=$num+1;
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
<!-- <p>Your opinion</p> -->
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

<?php  include './footer.html';?>
<script>
  $(document).ready(function(){
    resiinvoice();
    viewpoll();
    needsugg();
    readnotice();
  })
  function resiinvoice(){
    $.ajax({
      url:"user_invoice.php",
      type:'post',
      data: { get: 'get'},
      success:function(data){ 
        console.log(data);
        $('.resi-invoice').html(data);
      }
    });
  }
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
       // $('#disc').load('resident.php'+' #disc');
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
  var flat_no = '<?php echo $_SESSION['username'];?>';
  $.ajax({
    url : "../backend_files/resident_notice.inc.php",
    type : "post",
    data :{ notice:notice,flat_no:flat_no },
    success:function(data,status){
      $('.noticee').html(data);
    }
  });
}
  // function showFinance(){
  //   $('.main').hide();
  //   $('.fincance-sub').show();
  // }
  // function showHelp(){
  //   $('.main').hide();
  //   $('.help-sub').show();
  // }
  // function showMain()(){
  //   $('.help-sub').hide();
  //   $('.fincance-sub').hide();
  //   $('.main').show();
  // }
</script>
</body>
</html>