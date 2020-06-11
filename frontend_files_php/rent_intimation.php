<?php include './_navbar.php';?>

<div class="page-header">
    <h3 class="page-title ">Rent Intimations</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item"><a href="fintabs.php">Finance And Accounting</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rent Intimations</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-body">
        <div  class="my-3 alert alert-success success" style='display: none;'><span class="success-text"></span><span style="float:right; cursor: pointer;" class="success-close">&times;</span></div>
          <div  class="my-3 alert alert-danger error" style='display: none;'> <span class="error-text"></span><span style="float:right; cursor: pointer;" class="error-close">&times;</span></div>
          
        <div class="row m-3" >
            <div class="col col-xl-10 col-lg-10 col-xs-10 col-12">
                <h3>Add new rent Intimation</h3>
                <hr>
                <form class="add_amc">

                    <div class="form-row">
                        <div class="form-group col-12 col-md-8">
                            <label for="purpose">Purpose</label>
                            <input required type="text" id="purpose" name="purpose" class="form-control">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-12 col-md-8">
                            <label for="nex">Date</label>
                            <input required type="date" id="dateofrent" name="dateofrent" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 col-md-8">
                            <label for="amount">Amount</label>
                            <input required type="number" pattern="[0-9]" id="amount" name="amount" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn w-50 btn-success">Add</button>
            </div>
            </form>
            <!-- row ends -->
        </div>
    </div>
</div>

<?php  include './footer.html';?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
<script>


    $('.add_amc').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: '../backend_files/rent_intimation.inc.php',
        type: 'post',
        data: $('.add_amc').serialize(),
        success: function(data){
          var response =JSON.parse(data);
          if(response.success){
            $('#miscbtn').show();
            $('.success-text').text(response.success);
            $('.success').show();
            $('.add_amc').trigger('reset');
            $('.showmisc').slideUp(300);
            $(".success").delay(4000).slideUp(300);
            readamc();
          }
          else{
            $('.error-text').text(response.error);
            $('.error').show();
          }
          
        }
      });
    });
    $('.success-close').click(function(){
      $('.success').hide();
    });
    $('.error-close').click(function(){
      $('.error').hide();
    });
  </script>
