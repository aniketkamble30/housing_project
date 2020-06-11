<?php include './_navbar.php';?>

<div class="page-header">
<h3 class="page-title">View/ Edit Shop Details</h3>
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="admin.php">Homepage</a></li>
            <li class="breadcrumb-item"><a href="shop_tabs.php"> Manage Shops</a></li>   
            <li class="breadcrumb-item active"><a>view/edit shop details</a></li>           
          </ol>
        </nav>
</div>


<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <div id="re" class="mt-3 mb-0 alert alert-success success" style='display: none;'><span class="success-text"></span><span style="float:right; cursor: pointer;" class="success-close">&times;</span></div><br>
  <div id="re" class="mt-3 mb-0 alert alert-danger error" style='display: none;'> <span class="error-text"></span><span style="float:right; cursor: pointer;" class="error-close">&times;</span></div><br>

  <div class="tbody"></div>

  	<!-- The Modal -->


<div class="modal" id="viewmodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-light">
        <h4 class="modal-title" id="view_flat_no"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <div class="modal-body">
        <div class="row">
              <div class="col-4">Owner 1:</div>
              <div class="col-4">Owner 2:</div>
          </div>
          <div class="row center-align">
            <div class="col-4">
              <img id="image1" alt="no image added" width="150px" height="150px" class="img-thumbnail">
            </div>
            <div class="col-4">
              <img id="image2" alt="no image added" width="150px" height="150px" class="img-thumbnail">
            </div>
          </div><hr>
          <div class="row mt-4">
            <div class="col">
              <mark><b>Owner 1 :&nbsp;&nbsp;</b><div class="d-inline "></div></mark><hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Name:&nbsp;&nbsp;</b><div class="d-inline " id="name1"></div><hr>
            </div>
            <div class="col">
              <b>Email:&nbsp;&nbsp;</b><div class="d-inline " id="email1"></div><hr>
            </div>
            <div class="col">
              <b>Contact:&nbsp;&nbsp;</b><div class="d-inline " id="phoneno1"></div><hr>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <b>DOB:&nbsp;&nbsp;</b><div class="d-inline " id="dob1"></div><hr>
            </div>
          </div>

          <div class='owner2'>
            <div class="row">
              <div class="col">
                <mark><b>Owner 2 :&nbsp;&nbsp;</b><div class="d-inline " id="name1"></div></mark><hr>
              </div>
              
            </div>
            <div class="row">
              <div class="col">
                <b>Name:&nbsp;&nbsp;</b><div class="d-inline " id="name2"></div><hr>
              </div>
              <div class="col">
                <b>Email:&nbsp;&nbsp;</b><div class="d-inline " id="email2"></div><hr>
              </div>
              <div class="col">
                <b>Contact:&nbsp;&nbsp;</b><div class="d-inline " id="phoneno2"></div><hr>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <b>DOB:&nbsp;&nbsp;</b><div class="d-inline " id="dob2"></div><hr>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Shop no:</b><div class="d-inline p-2 " id="shop_no"></div>
            </div>
            <div class="col">
              <b>Ownership Type:</b><div class="d-inline p-2 "id="type_of_ownership"></div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Dimensions :</b><div class="d-inline p-2 " id="shop_dimensions"></div>
            </div>
            <div class="col">
              <b>Current Status :</b><div class="d-inline p-2 " id="shop_status"></div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Business Type:</b><div class="d-inline p-2 "id="business_type"></div>
            </div>
          </div>

        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>




<!-- update modal////////////////////////////////// -->
<div class="modal" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">UPDATE SHOP DETAILS</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
			<div class="modal-body">
      <form id="updateform">
          <div class="row">
            <div class="col">
              <mark><b>Owner 1 :&nbsp;&nbsp;</b><div class="d-inline " id="name1"></div></mark><hr>
            </div>
          </div>
          <div class="form-group">
            <label for="update_name1"> Owner Name:</label>
            <input type="text" name="" id="update_name1" class="form-control" attern="[a-zA-Z\s.]{3,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>

          <div class="form-group">
            <label for="update_email1">Owner Email:</label>
            <input type="email" name="" id="update_email1" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="update_phoneno1">Owner Phone No:</label>
            <input type="text" name="" id="update_phoneno1" class="form-control" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')" >
          </div>

          <div class="form-group">
            <label for="update_dob1">Owner Date Of Birth:</label>
            <input type="date" name="" id="update_dob1" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="update_type_of_ownership">Update Ownership Type:</label>
            <select class="custom-select mr-sm-2" name='type_of_ownership' id="update_type_of_ownership" required>
                   <option value="">Select</option>
                  <option value="single">Single</option>
                 <option value="joint">Joint</option>
            </select>
          </div>

          <div class="owner2">
            <div class="row">
              <div class="col">
                <mark><b>Owner 2 :&nbsp;&nbsp;</b><div class="d-inline " id="name1"></div></mark><hr>
              </div>
            </div>
            <div class="form-group">
              <label for="update_name2"> Owner Name:</label>
              <input type="text" name="" id="update_name2" class="form-control" pattern="[a-zA-Z\s.]{3,40}"oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
            </div>

            <div class="form-group">
              <label for="update_email2">Owner Email:</label>
              <input type="email" name="" id="update_email2" class="form-control">
            </div>

            <div class="form-group">
              <label for="update_phoneno2">Owner Phone No:</label>
              <input type="text" name="" id="update_phoneno2" class="form-control"  pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')" >
            </div>

            <div class="form-group">
              <label for="update_dob2">Owner Date Of Birth:</label>
              <input type="date" name="" id="update_dob2" class="form-control">
            </div>
          </div>
          <hr>
          <div class="form-group">
            <label for="update_shop_dimensions"> Update Dimensions:</label>
            <input type="text" name="" id="update_shop_dimensions" class="form-control">
          </div>

          <div class="form-group">
            <label for="update_shop_status">Update Status :</label>
            <input type="text" name="" id="update_shop_status" class="form-control">
          </div>

          <div class="form-group">
            <label for="updadte_business_type">Update Business Type :</label>
            <input type="text" name="" id="update_business_type" class="form-control">
          </div>
          <input type="hidden" name="" id="hidden_user_id" value="">

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="submit" class="btn btn-danger" onclick="updateuserdetail()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				
      </div>
      </form>

    </div>
  </div>
</div>
</div>

<!-- -------------soumya--------------------------------- -->
<form enctype="multipart/form-data" id="MyForm1">
<div class="modal" id="imgmodal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #b0e7ff;">
            <h4 class="modal-title" id="view_flat_no" style="color: #4a0f5c; font-family: solway">Edit Owner Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body">
          <p class="text-danger text-small">*Picture should be of format jpg,jpeg,png</p>
      <input type="hidden" value="" name="fl" id="fl">
      <input type="hidden" name="shenga" value="shenga">
      <div class="form-group">
        	<label for="proof">Owner1 picture:</label>
        	<input type="file" name="File11" id="ffiillee1" class="form-control">
        </div>
        <div class="form-group">
        	<label for="proof">Owner2 picture:</label>
        	<input type="file" name="File12" id="ffiillee2" class="form-control">
        </div>

        <div class="modal-footer">
      	<input type="button" id="btnUpload" value="submit" class="btn btn-success" onclick="updateimg()">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
      </div>
</div>
</div>
</div>
</form>

    </div>
</div>

<?php  include './footer.html';?>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>

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
    $('#update_type_of_ownership').change(function(){
          if($('#update_type_of_ownership').val()=='joint'){
            $(".owner2").show();
          }
          else{
            $(".owner2").hide();
            $('#update_name2').val('');
            $('#update_email2').val('');
            $('#update_phoneno2').val('');
            $('#update_dob2').val('');
          }
        }).change();
    readRecords();

  });


 		function readRecords(){
			var readrecord = "readrecord";

			$.ajax({
				url : "../backend_files/shop_edit_details.inc.php",
				type : "post",
				data :{ readrecord:readrecord },
				success:function(data,status){
					$('.tbody').html(data);
					$('#shoptable').DataTable();

				}
			});
		}
		// }

    function viewdetails(no){
      $.post("../backend_files/shop_edit_details.inc.php",{
        no:no
      },function(data,status){
          var dekhle = JSON.parse(data);
          var path2 = '../DB_docs_images/shop_owner/'+dekhle.shop_no+'/'+dekhle.image1;
          var path3 = '../DB_docs_images/shop_owner/'+dekhle.shop_no+'/'+dekhle.image2;
          $('#image1').attr('src',path2);
          $('#image2').attr('src',path3);
          $('#view_flat_no').text(dekhle.shop_no);
          $('#shop_no').text(dekhle.shop_no);
          $('#name1').text(dekhle.name1);
          $('#email1').text(dekhle.email1);
          $('#phoneno1').text(dekhle.phoneno1);
          $('#dob1').text(dekhle.dob1);
          if(dekhle.type_of_ownership=='joint'){
            $('#name2').text(dekhle.name2);
            $('#email2').text(dekhle.email2);
            $('#phoneno2').text(dekhle.phoneno2);
            $('#dob2').text(dekhle.dob2);
            $('.owner2').show();
          }
          else{
            $('.owner2').hide();
          }
          $('#type_of_ownership').text(dekhle.type_of_ownership);
          $('#shop_dimensions').text(dekhle.shop_dimensions);
          $('#shop_status').text(dekhle.shop_status);
          $('#business_type').text(dekhle.business_type);
        });
      $('#viewmodal').modal("show");

    }





		function getdetails(no){
			$('#hidden_user_id').val(no);
			$.post("../backend_files/shop_edit_details.inc.php",{
				no:no
			},function(data,status){
				var dekhle = JSON.parse(data);
        $('#update_shop_status').val(dekhle.shop_status);
        $('#update_shop_dimensions').val(dekhle.shop_dimensions);
        $('#update_type_of_ownership').val(dekhle.type_of_ownership);
        $('#update_business_type').val(dekhle.business_type);
        $('#update_name1').val(dekhle.name1);
        $('#update_email1').val(dekhle.email1);
        $('#update_phoneno1').val(dekhle.phoneno1);
        $('#update_dob1').val(dekhle.dob1);
        $('#update_name2').val(dekhle.name2);
        $('#update_email2').val(dekhle.email2);
        $('#update_phoneno2').val(dekhle.phoneno2);
        $('#update_dob2').val(dekhle.dob2);
        $('#update_type_of_ownership').val(dekhle.type_of_ownership);
        if(dekhle.type_of_ownership=='joint'){
          $('.owner2').show();
        }
        else{
          $('.owner2').hide();
          $('#update_name2').val('');
          $('#update_email2').val('');
          $('#update_phoneno2').val('');
          $('#update_dob2').val('');
        }
			});
			$('#update_user_modal').modal("show");
		}
    function remove(no){
      var conf = confirm('Do you Want Delete Shop Details?');
      if (conf == true){
      $.post("../backend_files/shop_edit_details.inc.php",{
				delete_shop_no:no
			},function(data,status){
        var response=JSON.parse(data);

        if(response.success){
          $('.success-text').text(response.success);
          $('.success').show();
          $('html, body').animate({scrollTop: $($('.success')[0]).offset().top - offset }, delay);
        }
        else{
          $('.error-text').text(response.error);
          $('.error').show();
          $('html, body').animate({scrollTop: $($('.error')[0]).offset().top - offset }, delay);
        }
        readRecords();
			});
		}}

    function updateuserdetail(){
      $('#updateform').on('submit',function(e){
        e.preventDefault();
      
      var shop_status=$('#update_shop_status').val();
      var shop_dimensions=$('#update_shop_dimensions').val();
      var type_of_ownership=$('#update_type_of_ownership').val();
      var business_type=$('#update_business_type').val();
      var name1=$('#update_name1').val();
      var email1=$('#update_email1').val();
      var phoneno1=$('#update_phoneno1').val();
      var dob1=$('#update_dob1').val();
      var name2=$('#update_name2').val();
      var email2=$('#update_email2').val();
      var phoneno2=$('#update_phoneno2').val();
      var dob2=$('#update_dob2').val();
      var hidden_user_idupd = $('#hidden_user_id').val();

      $.post("../backend_files/shop_edit_details.inc.php",{
        hidden_user_idupd: hidden_user_idupd,
        shop_status: shop_status,
        shop_dimensions: shop_dimensions,
        type_of_ownership: type_of_ownership,
        business_type: business_type,
        name1: name1,
        email1: email1,
        phoneno1: phoneno1,
        dob1: dob1,
        name2: name2,
        email2: email2,
        phoneno2: phoneno2,
        dob2: dob2
      }, function(data,status){
        $('#update_user_modal').modal("hide");
        var response=JSON.parse(data);
        if(response.success){
          $('.success-text').text(response.success);
          $('.success').show();
          $('html, body').animate({scrollTop: $($('.success')[0]).offset().top - offset }, delay);
        }
        else{
          $('.error-text').text(response.error);
          $('.error').show();
          $('html, body').animate({scrollTop: $($('.error')[0]).offset().top - offset }, delay);
        }
        readRecords();
      });
    });

    }

      // -------------soumya---------------------------------
      function zoomimg(fl){
        $('#imgmodal').modal("show");
        $('#fl').val(fl);
      }

      function updateimg(){
        var df = '<?php echo $_SESSION['username']; ?>' ;
         var shenga="shenga";
         var flat_no='<?php echo $_SESSION['username']?>';
        var form = $("#MyForm1");
        var params = form.serializeArray();

        var files1 = $("#ffiillee1")[0].files; 
        var pop1 = $('#ffiillee1').attr("name");  
        var files2 = $("#ffiillee2")[0].files; 
        var pop2 = $('#ffiillee2').attr("name");  
    
        var formData = new FormData();
        formData.append(pop1, files1[0]);
        formData.append(pop2, files2[0]);

    $(params).each(function (index, element) {
        formData.append(element.name, element.value);
    });
    //  for (var pair of formData.entries()) {
    //  console.log(pair[0]+ ' - ' + pair[1]);
    // } 
 
      $.ajax({
  		url:'../backend_files/shop_edit_details.inc.php',
  		type:'post',
			contentType:false,
			processData:false,
			cache:false,
  			data: formData,
			success:function(data,status){
        $('#imgmodal').modal("hide");
        var response=JSON.parse(data);
        if(response.success){
          $('.success-text').text(response.success);
          $('.success').show();
          $('html, body').animate({scrollTop: $($('.success')[0]).offset().top - offset }, delay);
        }
        else{
          $('.error-text').text(response.error);
          $('.error').show();
          $('html, body').animate({scrollTop: $($('.error')[0]).offset().top - offset }, delay);
        }
			}
			});
      }
  // -------------soumya---------------------------------

  </script>