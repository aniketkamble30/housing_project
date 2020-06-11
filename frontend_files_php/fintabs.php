<?php include './_navbar.php';?>
<div class="page-header">
    <h3 class="page-title ">Finance And Accounting </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance And Accounting</li>
        </ol>
        </nav>
</div>
<div class="stretch-card pt-3">
    <div class="card">
        <div class="card-body p-0 p-2">
            <div class="row">
                <div class="col-md-3 stretch-card py-3">
                    <div class="card card-icon text-center">
                        <a href="add_income_tabs.php" style="color:#0026ff">
                            <div class="card-body">
                                <img src="../assets/image/wallet.svg" width="48px" class="mt-5" alt="">
                                <h4 class="mt-4 pb-2">Add Income Intimations</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="fintabs.php" style="color:#ff0303">
                            <div class="card-body">
                                <img src="../assets/image/expense.svg" width="55px" class="mt-5 pt-1" alt="">
                                <h4 class="mt-3 pb-2">Add Expense</h4>
                            </div>
                        </a>
                    </div>
                </div> -->
                <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="analysis.php" style="color:#ae00de">
                            <div class="card-body">
                                <img src="../assets/image/sales.svg" width="55px" class="mt-5 pt-1" alt="">
                                <h4 class="mt-3 pb-2">Analysis</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="approveTransaction.php" style="color:black;">
                            <div class="card-body">                                
                                <div class="alert-pulse-danger ml-auto text-light small">Alert </div>
                                    <!-- <p style="color:red;" class="ring-animate float-right mdi mdi-bell "> </p> -->
                                <!-- Unapproved Transactions</div> -->
                                <img src="../assets/image/unapprove.svg" width="48px" class="mt-5" alt="">
                                <h4 class="mt-3 pb-2">Unapproved Intimations</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="bankimport.php" style="color:#d100ff">
                            <div class="card-body">
                                <!-- <div class="alert-pulse-success ml-auto"></div> -->
                                <i class="las la-list-ul circle-icon mt-4 icon-lg"></i>
                                <h4 class="mt-3 pb-2">Add Bank Statements</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="mmc.php" style="color:teal;">
                            <div class="card-body">
                                <!-- <div class="alert-pulse-info ml-auto"></div> -->
                                <img src="../assets/image/mmc.svg" width="48px" class="mt-5 pt-1" alt="">
                                <h4 class="mt-3 pb-2">MMC Calculations</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="sendinvoice.php" style="color:#ff5e29">
                            <div class="card-body">
                                <!-- <div class="alert-pulse-danger text-white ml-auto">Alert</div> -->
                                <img src="../assets/image/send.svg" width="48px" class="mt-5 pt-1" alt="">
                                <!-- <img src="../assets/image/invoice.svg" width="48px" class="mt-5 pt-1" alt=""> -->
                                <h4 class="mt-3 pb-2">Send Invoice</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="ledger.php" style="color:#15b33f">
                            <div class="card-body">
                                <!-- <div class="alert-pulse-danger text-white ml-auto">Alert</div> -->
                                <img src="../assets/image/ledger.svg" width="48px" class="mt-5 pt-1" alt="">
                                <!-- <img src="../assets/image/invoice.svg" width="48px" class="mt-5 pt-1" alt=""> -->
                                <h4 class="mt-3 pb-2">Income Expense Yearly Ledger</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-md-3 stretch-card pt-3 ">
                    <div class="card card-icon text-center">
                        <a href="fintabs.php" style="color:#00d3d6;">
                            <div class="card-body">
                            <i class="las la-dollar-sign mt-5 pt-1 icon-lg"></i>
                                <h4 class="mt-3 pb-2">Manage Charges</h4>
                            </div>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>


<?php  
include './footer.html';
?>