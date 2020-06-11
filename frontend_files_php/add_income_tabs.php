<?php include './_navbar.php';?>
<div class="page-header">
    <h3 class="page-title ">Income Intimations</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item"><a href="fintabs.php">Finance And Accounting</a></li>
            <li class="breadcrumb-item active" aria-current="page">Income Intimations</li>
        </ol>
        </nav>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 stretch-card pt-3 ">
                <div class="card card-icon card-shadow-success text-center">
                    <a href="adminpayresi.php" style="color:#000;">
                        <div class="card-body">
                            <img src="../assets/image/upayint.svg" width="58px" class="mt-5" alt="">
                            <h4 class="mt-3 pb-2">Resident Payment Intimation</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 stretch-card pt-3 ">
                <div class="card card-icon card-shadow-success text-center">
                    <a href="rent_intimation.php" style="color:#000;">
                        <div class="card-body">
                            <img src="../assets/image/rent.svg" width="58px" class="mt-5" alt="">
                            <h4 class="mt-3 pb-2">Rent intimations</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  include './footer.html';?>