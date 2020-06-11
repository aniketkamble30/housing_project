<?php include './_navbar.php';?>
<style>
.hoja{
   border: 1px solid red;
   border-radius:5px;
 }
 </style>

<div class="page-header">
<h2 class="text-dark">Suggestions Forum</h2>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php" id="dashboardbox1">Homepage</a></li>
	      <li class="breadcrumb-item active" aria-current="page">Q&A - Suggestions</li>
    </ol>
  </nav>
</div>

<div class="row">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <button type="button" class="btn ml-auto btn-success" data-toggle="modal" data-target="#newsugg"> Ask new suggestion</button>
                  <!-- <a href="https://github.com/BootstrapDash/PurpleAdmin-Free-Admin-Template" target="_blank" class="btn ml-auto download-button">Download Free Version</a> -->
                  <a href="suggestion_history.php" class="btn purchase-button">View suggestion History</a>
                </span>
              </div>
</div>

<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
       
            <div class="question">
            </div>
        </div>
      </div>
</div>
</div>

      <div class="row mt-3">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4>Suggestions:</h4>
      
                    <div class="listyy" style="">  </div>
                        <div id="listi" style="display:none;">
                        </div>
                    </div>

                    </div>
                  </div>
</div>


       <div class="modal" id="newsugg">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ask new suggestion Here</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="sugg">
      <div class="modal-body">
        <div class="form-group">
          <label for="lastname">question:</label>
          <textarea name="Description" class="form-control" rows="3" cols="80" id="question" required></textarea>
        </div>
        <div class="form-group">
          <label for="lastname">Suggestion end date:</label>
          <input type="date" id="endgame" class="form-control" required>
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-success" data-dismiss="modal" onclick="addqa()">Add Suggestion</button>
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
        </div>
</div>

<!-- --------------------------------------------------------------- -->
<div class="modal fade" id="contermi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog hoja">
    <div class="modal-content">              
      <div class="modal-body text-center">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h3 class="modal-title" style="color:brown;"><i class="fas fa-exclamation-triangle"></i></h3>

      <h5><p class="row m-1" ><center style="width:100%; color:red;">Terminate the ongoing poll first.</center><p></h5>
      </div>
    </div>
  </div>
</div>

  <div class="modal" id="con">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
        <h3 class="modal-title" style="color:gray;"><i class="fas fa-exclamation-triangle"></i></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <h4><p class="row m-1 text-center" style="width:100%;">Are you sure you want to terminate ongoing suggestion?<p></h4>
              <center><p id="end" name="end"  class="btn btn-outline-danger btn-md" onclick="terminate()">End Current Suggestion</p></center>
        </div>
        </div>
        </div>
        </div>


<?php  include './footer.html';?>

<script type="text/javascript">
$("#menu-toggle").click(function(e) {
       e.preventDefault();
       $("#wrapper").toggleClass("toggled");
     });
     $('.container-fluid').click(function() {
   $('#wrapper').removeClass("toggled");
});

$(document).ready(function(){
 readquestion();
// //suggest();
 var limit=4;
 var start=0;
 var action='inactive';
 function readsugg(limit,start){
   $.ajax({
     url:"../backend_files/admin_suggestion.inc.php",
     type:"post",
     data:{limit:limit,
            start:start},
     success:function(data,status){
       $('.listyy').append(data);
       if(data==''){
         $('#listi').show();
         $('#listi').html("");
         action = "active";
       }
       else {
         $('#listi').html();
         action="inactive";
       }
     }
   });
 }

if(action == 'inactive'){
  action = 'active';
  readsugg(limit,start);
}
$(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $('.listyy').height() && action =='inactive'){
    action = 'active';
    start = start+limit;
    setTimeout(function(){
      readsugg(limit,start);
    },1000);
  }

});


});


function readquestion(){
  var readquestion ="readquestion";
  $.ajax({
    url:"../backend_files/admin_suggestion.inc.php",
    type:"post",
    data:{readquestion:readquestion},
    success:function(data,success){
      $('.question').html(data);
    }
  });
}

function addqa(){
      var question = $('#question').val();
      var endgame = $('#endgame').val();
      $.ajax({
        url:"../backend_files/admin_suggestion.inc.php",
        type:"post",
        data:{question:question,endgame:endgame},
        success:function(data,success){
          console.log(data);
          if(data=='nhi'){
            $('#newsugg').modal('show');
            $('#contermi').modal('show');
           // alert('terminate ongoing suggestion first');
            // $('#newsugg').modal('hide').on('hidden.bs.modal',function(e){
            //   $('#teri').modal('show');
            // });
          
          }
          else{
     //       $('#newsugg').modal('hide');
        //  $('.listyy').show();
          readquestion();
          }
   //     $('.yty').html(data);
     //  $('#listi').show();
        }
        });
    }
    function badaalert(){
        $('#con').modal('show');
      }


    // $("#newsugg").on("hidden.bs.modal",function(){
    //   sugg.reset();
    // });


function terminate(){
  var end = 'end';
//   var con = confirm("do you want to terminate");
 //if(con == true){
$.ajax({
  url:"../backend_files/admin_suggestion.inc.php",
  type:"post",
  data:{ end:end },
  success:function(data,status){
    location.reload();
    // readquestion();
    // $('.listy').html("");
    // $('.listi').html("");

  }
});
}

// function suggest(){
//   var suggest="suggest";
//   $.ajax({
//     url:"qaphp.php",
//     type:"post",
//     data:{ sugg:sugg },
//     success:function(data,status){
//       $('#list').html(data);
//   }
// });
// }


</script>
