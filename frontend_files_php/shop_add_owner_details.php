<?php include './_navbar.php';?>
<div class="page-header">
<h3 class="page-title">Add Shop Owner Details</h3>
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="admin.php">Homepage</a></li>
            <li class="breadcrumb-item"><a href="shop_tabs.php"> Manage Shops</a></li>   
            <li class="breadcrumb-item active"><a>add shop owner details</a></li>           
          </ol>
        </nav>
</div>


<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <?php 
        error_reporting(E_PARSE & ~E_NOTICE);
    $s = $_GET['success'];
    $e=$_GET['error'];
    if($s==1){
      echo '<div id="re" class="mt-3 mb-0 alert alert-success">Flat Owner added successfully<a href="" style="float:right"data-dismiss="alert" data-target="#re">&times;</a></div><br>';
    }
    else if ($e){
      echo '<div id="re" class="mt-3 mb-0 alert alert-danger">'.$e.'<a href="" style="float:right;"data-dismiss="alert" data-target="#re">&times;</a></div><br>';
     }
   ?>

  <div class="row ">
    <div class="col col-xl-10 col-lg-10 col-xs-10">
      <form enctype="multipart/form-data" action="../backend_files/shop_add_owner_details.inc.php" id='shop-owner-details' method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><b>Shop No:*</b></label>
            <input type="text" name='shop_no' class="form-control" id="inputEmail4" placeholder="Eg:S1" pattern="[S]\d{1,4}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid shop format');">
          </div>
          <div class="form-group col-md-5">
            <label for="inputEmail4">Type of Business</label><br>
            <input  type="text" class="form-control" name="business_type" placeholder="" required>
          </div>
          <div class="form-group col-md-6">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Type of Ownership</label>
            <select class="custom-select mr-sm-2" name='type_of_ownership' id="type_of_ownership">
              <option value='single'>Single</option>
              <option value="joint">Joint</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><b>Owner-1:*</b></label><br>
            <label for="inputEmail4">Name:</label>
            <input type="text" class="form-control" name='name1' id="inputEmail4" placeholder="First Middle Last" pattern="[a-zA-Z\s]{3,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
            <label for="inputEmail4">Email:</label>
            <input type="email" class="form-control" name='email1' id="inputEmail4" placeholder="abc@example.com" required>
            <label for="inputEmail4">Contact no.:</label>
            <input type="tel" class="form-control" name='phoneno1' id="inputEmail4" placeholder="10-digit mobile no." pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')"  >
            <label for="inputEmail4">Date of Birth:</label>
            <input type="date" class="form-control" name='dob1' id="inputEmail4" required>
            <br>
            <label >owner1 image:</label>
          <input type="file" class="" id="image1" name="image1" required>
          </div>
          <div class="form-group col-md-6 owner2">
            <label for="inputEmail4"><b>Owner-2:</b></label><br>
            <label for="inputEmail4">Name:</label>
            <input type="text" class="form-control" name='name2' id="inputEmail4" placeholder="First Middle Last" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
            <label for="inputEmail4">Email:</label>
            <input type="email" class="form-control" name='email2' id="inputEmail4" placeholder="abc@example.com">
            <label for="inputEmail4">Contact no.:</label>
            <input type="tel" class="form-control" name='phoneno2' id="inputEmail4" placeholder="10-digit mobile no." pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')" >
            <label for="inputEmail4">Date of Birth:</label>
            <input type="date" class="form-control" name='dob2' id="inputEmail4">
            <br>
            
          <label >owner2 image:</label>
          <input type="file" class="" name="image2" id="image2">
          </div>
        </div>
        <br>
        <div class="form-row">
        <div class="form-group col-6">
          <label >In Date</label>
          <input type="date" class="form-control" name="indate">
        </div>
      <!--  <div class="form-group col-md-2">
          <label for="inputZip">Parking Slot</label>
          <input type="text" class="form-control" id="inputZip" placeholder="P302">
        </div>-->
        </div>
        <div class="form-group">
          <div class="col-auto my-1">

          </div>
        </div>
        <div class="form-row">
        <div class="form-group col-4">

        </div>
  
        </div>
        <input type="hidden" name='submit_details' value='submit_details'>
        <button type="submit" name="submit_owner_details" class="btn btn-primary text-center">Add Details</button>
      </form>
    </div>
  </div>
</div>

    </div>
</div>

<?php  include './footer.html';?>
<script type="text/javascript">

var delay = 0;
var offset = 150;

document.addEventListener('invalid', function(e){
   $(e.target).addClass("invalid");
   $('html, body').animate({scrollTop: $($(".invalid")[0]).offset().top - offset }, delay);
}, true);
document.addEventListener('change', function(e){
   $(e.target).removeClass("invalid")
}, true);

    $(document).ready(function(){ 
      $('[data-toggle="popover"]').popover();
      $('#type_of_ownership').change(function(){
          if($('#type_of_ownership').val()=='joint'){
            $(".owner2").show();
          }
          else{
            $(".owner2").hide();
          }
        }).change();
    });
      //   var form=$('#shop-owner-details');
      // var params = form.serializeArray();

      // var files1 = $("#image1")[0].files;
      // var files2 = $("#image2")[0].files;

      // var ele = $('#image1').attr("name");  
      // var pop = $('#image2').attr("name"); 
      // var formData = new FormData(); 
      // formData.append(ele, files1[0]);
      // formData.append(pop, files2[0]);
      // $(params).each(function (index, element) {
      //           formData.append(element.name, element.value);
      //       });
      // console.log(formData);
      //   $.ajax({
      //     url : "./includes/shop_owner_details.inc.php",
      //     type: "POST",
      //     contentType:false,
      //     processData:false,
      //     cache:false,
      //     data: formData,
      //     success:function(data){
      //       var response=JSON.parse(data);
      //       if(response.success){
      //         $('.success-text').text(response.success);
      //         $('.success').show();
      //         $('#shop-owner-details').trigger('reset');
      //       }
      //       else{
      //         $('.error-text').text(response.error);
      //         $('.error').show();
      //       }
      //     }
			//   });
     // });
      $('.success-close').click(function(){
        $('.success').hide();
      });
      $('.error-close').click(function(){
        $('.error').hide();
      });
      </script>