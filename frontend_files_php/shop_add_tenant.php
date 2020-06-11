<?php include './_navbar_shop.php';?>

<div class="page-header">
    <h3 class="page-title ">Manage Tenants </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop Tenant</li>
        </ol>
</div>
<div class="card">
    <div class="card-body">

    <div id="re" class="mt-3 mb-0 alert alert-success success" style='display: none;'><span class="success-text"></span><span style="float:right; cursor: pointer;" class="success-close">&times;</span></div><br>
  <div id="re" class="mt-3 mb-0 alert alert-danger error" style='display: none;'> <span class="error-text"></span><span style="float:right; cursor: pointer;" class="error-close">&times;</span></div><br>

        <div class="row noneditable">
            <div class="col-12">
            <center><img src="" width="100" id="img"height="100"></center>
                    <h3>Added Tenant</h3>
                    <table class="table table-borderless table-responsive">
                        <tr>
                            <td class="font-weight-bold">Name : </td>
                            <td><input type="text" value="" id ="name" class="form-control" readonly></td>
                            <td class="font-weight-bold">Contact : </td>
                            <td><input type="text" value="" id="contact" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Email : </td>
                            <td><input type="text" value="" id="email" class="form-control" readonly></td>
                            <td class="font-weight-bold">Date Of Birth : </td>
                            <td><input type="date" id="dob" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Move In Date : </td>
                            <td><input type="date" id="move_in" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-block btn-info" style="font-size:15px;">Edit Details</button>
                            </td>
                            <td>
                                <button class="btn btn-block btn-danger " style="font-size:15px;">Remove Tenant</button>
                            </td>
                        </tr>
                    </table>
                </div>
            <!-- <div class="col-1">
                <div class="btn-group dropleft">
                    <i class="las la-ellipsis-v icon-md" style="cursor:pointer;" data-toggle="dropdown"></i>
                    <div class="dropdown-menu ">
                        <button class="btn btn-gradient-info mb-2" style="font-size:15px;">Edit Details</button>
                        <button class="btn btn-gradient-danger " style="font-size:15px;">Remove Tenant</button>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row fillupform">
            <div class="col col-xl-10 col-lg-10 col-xs-10">
                <form id='tenant-form'>
                    <h4 class="">Agreement Holder Details:</h4>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <input type="hidden" name="shop_no" id="shop_no" value="<?php echo $_SESSION['username']; ?>">
                            <label>Name:</label>
                            <input type="text" name='name' class="form-control" pattern="[a-zA-Z\s]{3,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>EmailID:</label>
                            <input type="email" name='email' class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label>Contact</label>
                            <input type="text" name='phoneno' class="form-control" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')" >
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Date of birth</label>
                            <input type="date" name='dob' class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Move in date</label>
                            <input type="date" name='move_in_date' class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="image">Agreement Holder's Image:</label>
      <input type="file" class="" id="File1" name="image1" required>
                        </div>
                    </div>


                    <!-- <div class="form-group">
                        <div class="col-auto my-1">
                            <input type="hidden" name='submit_details' value='submit_details'>
                        </div>
                    </div> -->
                    <div class="form-row">
  <button type="submit" class="btn btn-primary btn-sm text-center" >Add Details</button>
  </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php  include './footer.html';?>
<script>
$(document).ready(function(){
check();
});
var delay = 0;
var offset = 150;

document.addEventListener('invalid', function(e){
   $(e.target).addClass("invalid");
   $('html, body').animate({scrollTop: $($(".invalid")[0]).offset().top - offset }, delay);
}, true);
document.addEventListener('change', function(e){
   $(e.target).removeClass("invalid")
}, true);

function check(){
    var shop_no = '<?php echo $_SESSION['username']; ?>';
    $.ajax({
        url:"../backend_files/shop_tenant_add_details.inc.php",
      type:"POST",
      data:{check:shop_no},
      success:function(data,status){
          //console.log(data);
          var response=JSON.parse(data);
          if(response.nonedit){
              $('.noneditable').show();
              $('.fillupform').hide();

              $('#name').val(response.agreement_holder_name);
              $('#email').val(response.agreement_holder_email);
              $('#dob').val(response.agreement_holder_dob);
              $('#move_in').val(response.move_in_date);
              $('#contact').val(response.agreement_holder_mobile);
              var path = '../DB_docs_images/shop_tenant/'+response.shop_no+'/'+response.image;
             $('#img').attr('src',path);
          }
          else{
            $('.noneditable').hide();
              $('.fillupform').show();
          }
      }

    });
}

$('#tenant-form').on('submit',function(e){
    e.preventDefault();
    var form=$("#tenant-form");
      var params = form.serializeArray();

      var files = $("#File1")[0].files;

      var ele = $('#File1').attr("name");  
     // var pop = ele.attr("name"); 
      var formData = new FormData(); 
      formData.append(ele, files[0]);
      $(params).each(function (index, element) {
                formData.append(element.name, element.value);
            });
  //console.log(formData);
//console.log($('#tenant-form').serialize());
    $.ajax({
      url:"../backend_files/shop_tenant_add_details.inc.php",
      type:"POST",
      contentType:false,
      processData:false,
      cache:false,
      data: formData,
      // dataType:'json',
      success:function(data, status){
        //////console.log(data);
        var response=JSON.parse(data);
        if(response.success){
          $('.success-text').text(response.success);
          $('.success').show();
          $('#tenant-form').trigger('reset');
          $('html, body').animate({scrollTop: $($('.success')[0]).offset().top - offset }, delay);
        //   $('.fillupform').hide();
        //   $('.noneditable').show();
            check();
        }
        else if(response.error){
          $('.error-text').text(response.error);
          $('.error').show();
          $('html, body').animate({scrollTop: $($('.error')[0]).offset().top - offset }, delay);
        }
      }
    });
  });


    $('.success-close').click(function () {
        $('.success').hide();
    });
    $('.error-close').click(function () {
        $('.error').hide();
    });
</script>