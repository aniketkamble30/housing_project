<?php include './_navbar.php';?>

<div class="page-header">
<h2 class="text-info">Pervious Polls</h2>
  <hr>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php" id="dashboardbox1">Homepage</a></li>
      <li class="breadcrumb-item"><a href="admin_poll.php" id="dashboardbox1">Opinion Poll</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pervious polls</li>
    </ol>
  </nav>
</div>

<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <div class="col-2"></div>
<div class="col-8 border border-dark p-5" id="gola" style="display:none">
<button class="btn btn-sm btn-success" id="band">close</button>
<canvas id="nilu"></canvas>
</div><br>
<div class="tinu"></div>
    </div>
</div>

<?php  include './footer.html';?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js'></script>
<script>
    $('.tinu').click(function(){
    $('#gola').show();
});
$('#band').click(function(){
    $('#gola').hide();
});

$(document).ready(function(){
readpolls();
});

function readpolls(){
    var read="read";
    $.ajax({
        url:'../backend_files/poll_history.inc.php',
        type:'post',
        data: {read:read},
        success:function(data,success){
            $('.tinu').html(data);
        }
    });
}

function pollres(id,opt1,y,opt2,n,nt,Q){
  //  var nt = (5-y-n);
    console.log(nt);
    new Chart(document.getElementById("nilu"), {
            type: 'pie',
            data: {
                    labels: [opt1,opt2, "No response"],
                    datasets: [
                        {
                             label: "Opinion poll result",
                             backgroundColor: ["#e7235c", "#473bb1","#3cba9f", "#abcedf"],
                             data: [y,n,nt]
                         }]
            },
            options: {
            title: {
                display: true,
                text: Q
            }
            }
        });

}
</script>