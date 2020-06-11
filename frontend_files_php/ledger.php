<?php include './_navbar.php';?>
<div class="page-header">
    <h3 class="page-title ">Income Expense Ledger </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item "><a href="fintabs.php">Finance And Accounting</a></li>
            <li class="breadcrumb-item "><a href="analysis.php">Analysis</a></li>
            <li class="breadcrumb-item ">Income Expense Ledger</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-body">
        <div id="inexp1"></div>
        <div id="inexp" style="display:none;"></div>
    </div>
</div>

<?php  include './footer.html';?>
<script>
    $(document).ready(function () {
        readledgers();
    });
    function readledgers(){
        $.ajax({
            type: "post",
            url: "../backend_files/ledger.inc.php",
            data: {
                wantledger: 'wantledger'
            },
            success: function (response) {
                $('#inexp1').html(response);
            }
        });
    }
    function getled(k_s) {
        $.ajax({
            type: "post",
            url: "../backend_files/ledger.inc.php",
            data: {
                k_s: k_s
            },
            success: function (response) {
                // alert(response);
                $('#inexp1').hide('slow');
                $('#inexp').html(response);
                $('#inexp').show('slow');
            }
        });
    }
  function closee() { 
        $('#inexp1').show('slow');
        $('#inexp').hide('slow');        
    }
</script>