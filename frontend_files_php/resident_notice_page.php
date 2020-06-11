<?php include './_navbar_resident.php';?>

<div class="page-header">
<h2 >Homepage</h2>
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="resident.php">Homepage</a></li>
            <li class="breadcrumb-item active"><a>notices</a></li>
          </ol>
        </nav>
</div>

<div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
             
                 <button id="ind" class="btn btn-default btn-block btn-gradient-info">Individual Notices</button><br>
                  <div class="newspart border" >
                <div style="font-size:18px;background-color:#d7e0fc;" class="border-bottom p-3">General Notices <small>(Click to expand)</small></div> <br>
                  <div class="noticee">
                  </div>
            </div>
</div>
</div>
</div>
</div>

<div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="newspart border" >
                <div style="font-size:18px;background-color:#d7e0fc;" class="border-bottom p-3">Individual Notices <small>(Click to expand)</small></div> <br>
                  <div class="indinoticee">
                  </div>
            </div>
</div>
</div>
</div>
</div>


<?php  include './footer.html';?>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
 
<script>
 

  $(document).ready(function(){
  	//readRecords();
    readnotice();
    indinotice();
     
  });

  function readnotice(){
    var notice = "notice";
    // var flat_no = '< ?= $_SESSION['username'] ?>';
    $.ajax({
      url : "../backend_files/resident_notice_page.inc.php",
      type : "post",
      data :{ notice:notice },
      success:function(data,status){
        $('.noticee').html(data);
        $('#general').DataTable();
      }
    });
  }

 function indinotice(){
    var indi = "indi";
    var flat_no =  '<?= $_SESSION['username'] ?>';
 console.log(flat_no);
    $.ajax({
      url : "../backend_files/resident_notice_page.inc.php",
      type : "post",
      data :{ indi:indi,flat_no:flat_no  },
      success:function(data,status){
        $('.indinoticee').html(data);
        $('#individual').DataTable();
      }
    });
 }

 $("#ind").click(function (){
      $('html, body').animate({
          scrollTop: $(".indinoticee").offset().top
      }, 2000);
  });





  </script>