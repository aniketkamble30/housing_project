<?php include './_navbar.php';?>
<style>

</style>
<div class="page-header">
    <h3 class="page-title ">Income Expense Statement </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item "><a href="fintabs.php">Finance And Accounting</a></li>
            <li class="breadcrumb-item "><a href="analysis.php">Analysis</a></li>
            <li class="breadcrumb-item ">Income Expense Statement</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-body">
        
        <!-- <div><button  class="btn float-right m-2 btn-info btn-sm">Expense Analysis</button></div>
        <div><button class="btn float-right m-2 btn-info btn-sm">Income Analysis</button></div> -->
        <form action="printInExp.php" method="post">
            <div><button type="submit" name="printTable" value="printTable" class="btn float-right m-2 btn-success btn-sm">Print Statement</button></div>
        </form>
        <!-- <div class="btn-group float-right dropleft">
            <button type="button" class="btn btn-sm btn-dark mb-2" data-toggle="dropdown">
                <i class="las la-ellipsis-v"></i>More Options
            </button>
            <div style="width:fit-content;" class="dropdown-menu bg-light">
                <div><button class="btn btn-light btn-block text-info">PRINT Statement</button></div>
            </div>
        </div> -->
        <div id="inexp"></div>
    </div>
</div>

<?php  include './footer.html';?>
<script>
    $(document).ready(function () {
        readInExp();
    });

    function readInExp() {
        $.ajax({
            type: "post",
            url: "../backend_files/inexpdetails.inc.php",
            data: {
                analysis: 'analysis'
            },
            success: function (response) {
                $('#inexp').html(response);
            }
        });
    }
</script>