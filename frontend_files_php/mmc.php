<?php 
error_reporting(E_PARSE & ~E_NOTICE);
 include './_navbar.php';?>

<style>
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }


</style>
<div class="page-header">
  <h3 class="page-title ">MMC Calculations</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
      <li class="breadcrumb-item"><a href="fintabs.php">Finance And Accounting</a></li>
      <li class="breadcrumb-item active" aria-current="page">MMC Calculations</li>
    </ol>
  </nav>
</div>
<div class="card">
  <div class="card-body">
    <!-- write your code here -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="mmcview-tab" data-toggle="tab" href="#mmcview" role="tab" aria-controls="mmcview"
          aria-selected="true">MMC Charges</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="mmcedit-tab" data-toggle="tab" href="#mmcedit" role="tab" aria-controls="mmcedit"
          aria-selected="false">Edit MMC Charges</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="showpdf-tab" data-toggle="tab" href="#showpdf" role="tab" aria-controls="showpdf"
          aria-selected="false">MMC Calculation</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane  p-3 fade show active" id="mmcview" role="tabpanel" aria-labelledby="mmcview-tab">

      </div>


      <div class="tab-pane fade" id="showpdf" role="tabpanel" aria-labelledby="showpdf-tab">
        <div class="">
          <h3 class="m-3 ">MMC Calculation Information</h3>
          <embed class="border shadow ppdf" src="./Housing.pdf" type="application/pdf" width="100%" height="700px">
        </div>
      </div>


      <div class="tab-pane fade p-3" id="mmcedit" role="tabpanel" aria-labelledby="mmcedit-tab">
        <div class="row ">
          <div class="col-12">
            <form id="formo" method="post" enctype="multipart/form-data">
              <table class="table table-bordered">
                <tr style="background-color:#e6e6e6;">
                  <td colspan="4">
                    <h4> Fill the Details</h4>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="font-weight-bold">A. Area Wise Contribution</td>
                </tr>
                <tr>
                  <td colspan="2">Construction Costs : </td>
                  <td colspan="2"><input min="1" placeholder="0" type="number" id="const_cost" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="font-weight-bold">B. Equal Contribution</td>
                </tr>
                <tr>
                  <td colspan="2">Interest For Late/Due Payments(Yearly %) : </td>
                  <td colspan="2"><input min="0" placeholder="0%" type="number" id="interest" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="2">Rebate for Early Payments(Yearly %): </td>
                  <td colspan="2"><input min="0" placeholder="0%" type="number" id="rebate" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="2">Annual Building Insurance Amount : </td>
                  <td colspan="2"><input min="1" placeholder="0" type="number" id="insurance" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="2">Annual Security Charges : </td>
                  <td colspan="2"><input min="1" placeholder="0" type="number" id="security" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="2">Annual Lift Charges : </td>
                  <td colspan="2"><input min="1" placeholder="0" type="number" id="lift" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="2" class="font-weight-bold">Flat Charges</td>
                  <td colspan="2" class="font-weight-bold">Shop Charges</td>
                </tr>
                <tr>
                  <td>Annual Water Charges : </td>
                  <td><input min="1" placeholder="0" type="number" id="water" class="form-control"></td>
                  <td>Annual Water Charges : </td>
                  <td><input min="1" placeholder="0" type="number" id="water_shop" class="form-control"></td>
                </tr>
                <tr>
                  <td>Annual Electricity Charges : </td>
                  <td><input min="1" placeholder="0" type="number" id="electricity" class="form-control"></td>
                  <td>Annual Electricity Charges : </td>
                  <td><input min="1" placeholder="0" type="number" id="electricity_shop" class="form-control"></td>
                </tr>
                <tr>
                  <td>Annual Service Charges </td>
                  <td><input min="1" placeholder="0" type="number" id="service" class="form-control"></td>
                  <td>Annual Service Charges : </td>
                  <td><input min="1" placeholder="0" type="number" id="service_shop" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="4"><input type="button" id="subi" class="btn btn-outline-success btn-block "
                      value="Submit"></td>
                </tr>
              </table>
            </form>
          </div>

        </div>

        <footer id="footer">
        </footer>
        <!-- <div class="meaage alert alert-success " style="display:none;">Charges Have been Successfully applied.</div> -->
        <div class="row m-3 " id="terer">
        </div>
      </div>
    </div>

  </div>
</div>

<?php  include './footer.html';?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  getmmc();
});
  $('#subi').click(function () {

    var construction = $('#const_cost').val();
    var insu = $('#insurance').val();
    var interest = $('#interest').val();
    var rebate = $('#rebate').val();
    var sqftarea = $('#sqft').val();
    var water = $('#water').val();
    var water_shop = $('#water_shop').val();
    var elec = $('#electricity').val();
    var elec_shop = $('#electricity_shop').val();
    var security = $('#security').val();
    var lifto = $('#lift').val();
    var servico = $('#service').val();
    var servico_shop = $('#service_shop').val();
    var justshow = 'show';
    if (insu == '' ||
      sqftarea == '' ||
      interest == '' ||
      rebate == '' ||
      water == '' ||
      water_shop == '' ||
      elec == '' ||
      elec_shop == '' ||
      lifto == '' ||
      security == '' ||
      servico == '' ||
      servico_shop == '') {
      alert('Please fill all the Amounts');
    } else {
      $('html, body').animate({
        scrollTop: $("#subi").offset().top
      }, 200);
      $.ajax({
        url: '../backend_files/mmc.inc.php',
        type: 'post',
        data: {
          justshow: justshow,
          construction: construction,
          insu: insu,
          interest: interest,
          rebate: rebate,
          lifto: lifto,
          security: security,
          water: water,
          elec: elec,
          servico: servico,
          water: water_shop,
          elec_shop: elec_shop,
          servico: servico_shop
        },
        success: function (data, status) {
          $('#terer').html(data);
          $('#mmctable').DataTable({
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
              extend: 'print',
              text: 'Print Flat Charges',
              className: 'btn-info',
              messageTop: 'Per Month Maintenance Charges for Flats',
            }],
          });
          $('#smmct').DataTable({
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
              extend: 'print',
              text: 'Print Shop Charges',
              className: 'btn-info',
              messageTop: 'Per Month Maintenance Charges for Shops',
            }],
          });
        }
      });
    }
  });

  function applycharges() {
    var construction = $('#const_cost').val() || 1;
    var insu = $('#insurance').val() || 1;
    var sqftarea = $('#sqft').val() || 1;
    var interest = $('#interest').val() || 1;
    var rebate = $('#rebate').val() || 1;
    var elec_shop = $('#electricity_shop').val() || 1;
    var water_shop = $('#water_shop').val() || 1;
    var servico_shop = $('#service_shop').val() || 1;
    var elec = $('#electricity').val() || 1;
    var water = $('#water').val() || 1;
    var servico = $('#service').val() || 1;
    var lifto = $('#lift').val() || 1;
    var security = $('#security').val() || 1;
    var apply = "apply";
    $.ajax({
      url: '../backend_files/mmc.inc.php',
      type: 'post',
      data: {
        apply: apply,
        construction: construction,
        insu: insu,
        water: water,
        elec_shop:elec_shop,
        interest: interest,
        water_shop:water_shop,
        rebate: rebate,
        servico_shop:servico_shop,
        elec: elec,
        security: security,
        lifto: lifto,
        servico: servico
      },
      success: function (data, status) {
        alert('Charges Have been Successfully applied.');
        // $('#terer').html(data);
        getmmc();
      }
    });

  }
  function getmmc(){
    $.ajax({
      type: "post",
      url: "../backend_files/mmc.inc.php",
      data: {getmmc:"getmmc"},
      success: function (response) {
        $('#mmcview').html(response);
      }
    });
  }

  function stog() {
    $('#flat').hide();
    $('#shop').show();
    $('#stogo').addClass('active');
    $('#ftogo').removeClass('active');
  }

  function ftog() {
    $('#flat').show();
    $('#shop').hide();
    $("#stogo").removeClass("active");
    $('#ftogo').addClass("active");
  }
</script>