<nav aria-label="breadcrumb" >
    <ol class="breadcrumb">
        <li class="breadcrumb-item" onClick="showMain()" style="cursor: pointer; color: blue;">Back to Dashboard</li>
        <li class="ml-auto" style="margin-top: -1em;">
            <div class="clearfix resi-invoice">
                        
            </div>
        </li>
    </ol>

</nav>

<div class="stretch-card pt-3">
    <div class="card">
        <div class="card-body p-0 p-2">
            <div class="row main">
                <div class="col-md-4 stretch-card pt-3" onClick="showFinance()" style="cursor: pointer;">
                    <div class="card card-icon text-center">
                        <div class="card-body">
                            <img src="../assets/image/wallet.svg" width="48px" class="mt-5" alt="">
                            <h4 class="mt-4 pb-2">Finance</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card pt-3 " style="cursor: pointer;">
                    <div class="card card-icon text-center">
                        <div class="card-body">
                            <img src="../assets/image/expense.svg" width="55px" class="mt-5 pt-1" alt="">
                            <h4 class="mt-3 pb-2">Details</h4>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 stretch-card pt-3 " onClick="showHelp()" style="cursor: pointer;"> 
                    <div class="card card-icon text-center">
                        <div class="card-body">
                            <img src="../assets/image/expense.svg" width="55px" class="mt-5 pt-1" alt="">
                            <h4 class="mt-3 pb-2">Help and Support</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row finance-sub" style="display: none;">
                    <div class="col-md-6 stretch-card pt-3" style="cursor: pointer;">
                        <div class="card card-icon text-center">
                            <div class="card-body">
                                <img src="../assets/image/wallet.svg" width="48px" class="mt-5" alt="">
                                <h4 class="mt-4 pb-2">Add Payment Intimation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card pt-3 " style="cursor: pointer;">
                        <div class="card card-icon text-center">
                            <div class="card-body">
                                <img src="../assets/image/expense.svg" width="55px" class="mt-5 pt-1" alt="">
                                <h4 class="mt-3 pb-2">Your Transactions</h4>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row help-sub" style="display: none;">
                    <div class="col-md-6 stretch-card pt-3" style="cursor: pointer;">
                        <div class="card card-icon text-center">
                            <div class="card-body">
                                <img src="../assets/image/wallet.svg" width="48px" class="mt-5" alt="">
                                <h4 class="mt-4 pb-2">Complaints</h4>
                             </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card pt-3 " style="cursor: pointer;">
                        <div class="card card-icon text-center">
                            <div class="card-body">
                                <img src="../assets/image/expense.svg" width="55px" class="mt-5 pt-1" alt="">
                                <h4 class="mt-3 pb-2">Q and A</h4>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
  function showFinance(){
    console.log('here');
    $('.main').hide();
    $('.finance-sub').show();
  }
  function showHelp(){
    $('.main').hide();
    $('.help-sub').show();
  }
  function showMain(){
    $('.help-sub').hide();
    $('.finance-sub').hide();
    $('.main').show();
  }
</script>