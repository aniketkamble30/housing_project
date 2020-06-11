<?php include './_navbar.php';?>
<div class="page-header">
<h4>Suggestion Records:</h4>
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin.php">Homepage</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="admin_suggestion.php">Suggestions - Q&A </a></li>
              <li class="breadcrumb-item active" aria-current="page">Suggestions History</li>
            </ol>
          </nav>
</div>


<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <div class="qahistory" id="qahistory">
        <div id="table"></div>
     </div>
      <div id="fileopen" style="display:none;">
          <button type="" class="btn btn-success btn-md"id="back" >All Suggestions</button> 
        <div class="row" id="res"></div>
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
  readhistory();

 $('#back').click(function(){
   $('#qahistory').show();
   $('#fileopen').hide();
   $('#abcd').show();
});
});

function readhistory(){
  var readhistory="readhistory";
  $.ajax({
    url:"../backend_files/suggestion_history.inc.php",
    type:"post",
    data:{readhistory:readhistory},
    success:function(data,success){
      $('#table').html(data);
      $('#mycomp').DataTable();
    }
  });
}


function file(id){
  $('#qahistory').hide();
   $('#fileopen').show();
   $('#abcd').hide();
  $.ajax({
    url:"../backend_files/suggestion_history.inc.php",
    type:"post",
    data:{id:id},
    success:function(data,status){
      $('#res').html(data);
    }
  });

}
</script>
