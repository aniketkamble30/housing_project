<?php include './_navbar_resident.php';
error_reporting(0);
?>

<div class="page-header">
<h2 class="ml-3">Add Tenant Details:</h2>
  <div class="">
          <p aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item "><a href="resident.php">Homepage</a></li>
			<li class="breadcrumb-item ">Add Payment Intimation</li>
          </ol>
        </p>
        </div>
</div>

<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <div class="container-fluid">
  <div id="re" class="mt-3 mb-0 alert alert-success success" style='display: none;'><span class="success-text"></span><span style="float:right; cursor: pointer;" class="success-close">&times;</span></div><br>
  <div id="re" class="mt-3 mb-0 alert alert-danger error" style='display: none;'> <span class="error-text"></span><span style="float:right; cursor: pointer;" class="error-close">&times;</span></div><br>
<!-- formstarts -->


<div class="row noneditable">
        <div class="col-12">
            <h3>Tenant Added</h3><br>
            <center><img src="" width="300" id="img"height="200" class="thumbnail"></center><br>
          
                  
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
                            <td class="font-weight-bold">member count : </td>
                            <td><input type="number" id="count" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Member 1 : </td>
                            <td><input type="text" id="m1" class="form-control" readonly></td>
                        </tr>
                       
                        <tr id="mm2">
                            <td class="font-weight-bold">Member 2 : </td>
                            <td><input type="text" id="m2" class="form-control" readonly ></td>
                        </tr>
                      
                      
                        <tr id="mm3">
                            <td class="font-weight-bold">Member 3 : </td>
                            <td><input type="text" id="m3" class="form-control" readonly ></td>
                        </tr>
                      
                        
                        <tr id="mm4">
                            <td class="font-weight-bold">Member 4 : </td>
                            <td><input type="text" id="m4" class="form-control" readonly ></td>
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







<div class="dikha">
  <div class="row ">
    <div class="col col-xl-10 col-lg-10 col-xs-10">
      <form id='tenant-form' enctype="multipart/form-data">        
        <div class="row">
          <h4 class="ml-3">Agreement Holder's:</h4>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="hidden" name="flat_no" id="flat_no">
            <label for="inputEmail4">Name:</label>
            <input type="text" name='agreement_holder_name' class="form-control"  pattern="[a-zA-Z\s.]{3,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">EmailID:</label>
            <input type="email" name='agreement_holder_email' class="form-control"  required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Contact</label>
            <input type="text" name='agreement_holder_mobile' class="form-control"   pattern="[+]\d{2}[0-9]{10}|[0-9]{10}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')">
          </div>
          <!-- <div class="form-group col-md-6">
            <label for="inputEmail4">Occupation</label>
            <input type="text" class="form-control"  required>
          </div> -->
          <div class="form-group col-md-6">
            <label for="inputEmail4">Date of birth</label>
            <input type="date" name='agreement_holder_dob' class="form-control"  required>
          </div>
        </div>
        <hr>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Number of members</label>
            <input type="number" name='tenant_count_of_members' class="form-control"  min=0>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Name of member 1</label>
            <input type="text" class="form-control"    pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Name of member 2</label>
            <input type="text" class="form-control"   pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Name of member 3</label>
            <input type="text" class="form-control"   pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Name of member 4</label>
            <input type="text" class="form-control"   pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Move in date</label>
            <input type="date" name='tenant_move_in_date' class="form-control"  required>
          </div>


</div>
        <hr>
    <div class="text-danger"><h6></h6></div>
    <div class="form-row">
    <div class="form-group col-md-4">
      <label >tenant's image</label>
      <input class="form-control-file" type="file" name="image1" id="File1" required>
    </div> 
    </div>
    <hr>



        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Maid name</label>
            <input type="text" name='maid_name' class="form-control"  pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
        </div>
        <div class="form-group">
          <div class="col-auto my-1">
            <input type="hidden" name='submit_details' value='submit_details'>
          </div>
        </div>
        <button type="submit" class="btn btn-primary text-center" name="addtenant" value="addtenant">Add Details</button>
      </form>
    </div> 
  </div> 

</div>
    </div>
</div>
</div>

<?php  include './footer.html';?>
    <script>

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
        $('#flat_no').val('<?php echo $_SESSION['username']?>');
        console.log($('#flat_no').val());
        check();
    });
    $('#tenant-form').on('submit',function(e){
      e.preventDefault();
      var form=$("#tenant-form");
      var params = form.serializeArray();

      var files = $("#File1")[0].files;

      var ele = $('#File1');  
      var pop = ele.attr("name"); 
      var formData = new FormData(); 
      formData.append(pop, files[0]);
      $(params).each(function (index, element) {
                formData.append(element.name, element.value);
            });
      console.log(formData);
      $.ajax({
        url: '../backend_files/add_flat_tenant_details.inc.php',
        type: "POST",
        contentType:false,
        processData:false,
        cache:false,
        data: formData,
        success: function(data, status){
          console.log(data);
          var response=JSON.parse(data);
          if(response.success){
            $('.success-text').text(response.success);
            $('.success').show();
            $('#tenant-form').trigger("reset");
            $('html, body').animate({ scrollTop: $(".success").offset().top },100);
            check();
          }
          else{
            $('.error-text').text(response.error);
           // alert(response.error);
            $('.error').show();
            $('html, body').animate({ scrollTop: $(".success").offset().top },100);
          }
        }
      });
    });

function check(){
  var flat_no = '<?php echo $_SESSION['username']; ?>';
    $.ajax({
        url:"../backend_files/add_flat_tenant_details.inc.php",
      type:"POST",
      data:{check:flat_no},
      success:function(data,status){
          console.log(data);
          var response=JSON.parse(data);
          if(response.nonedit){
              $('.noneditable').show();
              $('.dikha').hide();

              $('#name').val(response.agreement_holder_name);
              $('#email').val(response.agreement_holder_email);
              $('#dob').val(response.agreement_holder_dob);
              $('#move_in').val(response.tenant_move_in_date);
              $('#contact').val(response.agreement_holder_mobile);
              $('#count').val(response.tenant_count_of_members);
              $('#m1').val(response.member1);
              if(response.member2!=''){
                $('#mm2').show();
                $('#m2').val(response.agreement_holder_mobile);
              }
              else{$('#mm2').hide(); }
              if(response.member3!=''){
                $('#mm3').show();
                $('#m3').val(response.agreement_holder_mobile);
              }
              else{$('#mm3').hide(); }
              if(response.member4!=''){
                $('#mm4').show();
                $('#m4').val(response.agreement_holder_mobile);
              }
              else{$('#mm4').hide(); }

              var path = '../DB_docs_images/flat_tenant/'+response.flat_no+'/'+response.image;
             $('#img').attr('src',path);
          }
          else{
            $('.noneditable').hide();
              $('.dikha').show();
          }
      }

    });
}


    $('.success-close').click(function(){
      $('.success').hide();
    });
    $('.error-close').click(function(){
      $('.error').hide();
    });
    $("#menu-toggle").click(function(e) {
       e.preventDefault();
       $("#wrapper").toggleClass("toggled");
     });
     $('.container-fluid').click(function() {
   $('#wrapper').removeClass("toggled");
});
   </script>