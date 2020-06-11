<?php include './_navbar.php'; ?>
<style media="screen">

  thead,
  tfoot {
    visibility: hidden;
  }

/* 
  img:hover {
    -webkit-animation: spin 4s linear infinite;
    -moz-animation: spin 4s linear infinite;
    animation: spin 4s linear infinite;
  } */


  .tick {
    width: 40px;
    border-radius: 5px;
    /* -webkit-transition: width 1s; */
    transition: width 0.5s;
  }

  .tick span {
    visibility: hidden;
  }

  .tick:hover span {
    font-size: 17px;

    visibility: visible;
  }

  .tick:hover {
    border-radius: 5px;
    transition: width 0.5s;
    width: 100px;
  }
/* 
  @-moz-keyframes spin {
    100% {
      -moz-transform: rotate(360deg);
    }
  }

  @-webkit-keyframes spin {
    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  } */



  /* 
  span {
    font-family: 'Roboto';
  }

  .tid {
    font-family: 'Roboto';
    float: right;
  } */
</style>
<div class="page-header">
    <h3 class="page-title ">Approve Intimations </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item "><a href="fintabs.php">Finance And Accounting</a></li>
            <li class="breadcrumb-item ">Approve Intimations</li>
        </ol>
    </nav>
</div>
<div class="card" >
  <div class="card-body">
    <div class="tbod table-responsive p-1">
      <center>
        <h3>Loading Please wait</h3>
        <img src="../assets/image/preloader.gif" width="200px" alt="">
      </center>
    </div>
  </div>
</div>

<?php include './footer.html'; ?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js'></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<script>
  $(document).ready(function() {
    readRecords();
  });



  function readRecords() {
    var readrecord = "readrecord";

    $.ajax({
      url: "../backend_files/approveTransaction.inc.php",
      type: "post",
      data: {
        readrecord: readrecord
      },
      success: function(data, status) {
        // alert(data);
        $('.tbod').html(data);
        $('#example').DataTable({
          "ordering": false,
          "info": false
        });
      }
    });
  }

  function updateRecords(idd) {
    var updateRecordId = idd;

    $.ajax({
      url: "../backend_files/approveTransaction.inc.php",
      type: "post",
      data: {
        updateRecordId: updateRecordId
      },
      success: alert("SuccessFully Approved !")
    });
  }

  function denyRecords(idd) {
    var denyRecordId = idd;

    $.ajax({
      url: "../backend_files/approveTransaction.inc.php",
      type: "post",
      data: {
        denyRecordId: denyRecordId
      },
      success: function(data, status) {
        alert("Denied Record Id: "+data);
      }
    });
  }

  function pendingRecords(idd) {
    var pendingRecordId = idd;

    $.ajax({
      url: "../backend_files/approveTransaction.inc.php",
      type: "post",
      data: {
        pendingRecordId: pendingRecordId
      },
      success: function(data, status) {
        alert("Pending Record Id: "+data);
        readRecords();
      }
    });
  }


  function approveAlert(x, y) {
    if (confirm("Do you want to Approve ?")) {
      $('#'+y).hide('slow', function() {
        $('#'+y).remove();
      });
      updateRecords(x);
      // readRecords();
    }
  }

  function denyAlert(x, y) {
    if (confirm("Do you want to Unapprove ?")) {
      $('#'+y).hide('slow', function() {
        $('#'+y).remove();
      });
      denyRecords(x);
      // readRecords();
    }
  }

  function pendingAlert(x, y) {
    if (confirm("Do you want to change status to Pending ?")) {
      $('#pending_btn_'+x).hide('slow', function() {
        $('#pending_btn_'+x).remove();
      });
      $('#'+y).css('background-color', '#FFFD90');
      pendingRecords(x);
      // readRecords();
    }
  }
</script> 