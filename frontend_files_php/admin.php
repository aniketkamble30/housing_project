<?php
    include '_navbar.php';
?>
<style>
.card:hover {
    cursor:pointer;
     -webkit-transform: translateY(-4px) scale(1.01);
     -moz-transform: translateY(-4px) scale(1.01);
     -ms-transform: translateY(-4px) scale(1.01);
     -o-transform: translateY(-4px) scale(1.01);
     -webkit-transform: translateY(-4px) scale(1.01);
     transform: translateY(-4px) scale(1.01);
     -webkit-box-shadow: 0 14px 24px rgba(62, 57, 107, 0.1);
     box-shadow: 0 14px 24px rgba(62, 57, 107, 0.1)
 }

</style>
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>NEW UI</h3>
                            <h6>Hello world</h6>
                        </div>
                    </div>
                   <?php
               include './footer.html';
               ?>
              