<?php include './_navbar.php';?>
<div class="page-header">
  <h3 class="page-title"> View Tenant Details </h3>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
        <li class="breadcrumb-item"><a href="flat_tabs.php">Manage Flats</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Tenant Details</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-body">        

    <div id="re" class="mt-3 mb-0 alert alert-success success" style='display: none;'><span class="success-text"></span><span style="float:right; cursor: pointer;" class="success-close">&times;</span></div><br>
  <div id="re" class="mt-3 mb-0 alert alert-danger error" style='display: none;'> <span class="error-text"></span><span style="float:right; cursor: pointer;" class="error-close">&times;</span></div>
  <br>

        <div class="tbody"></div>
    </div>
</div>

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
            <div class="col">
              <img id="image" width="150px" height="150px" class="img-thumbnail" alt="no image added" srcset="">
            </div>
          </div>
          
          <div class="row mt-4">
            <div class="col">
              <b>Flat No. :&nbsp;&nbsp;</b><div class="d-inline " id='flat_no'></div><hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <mark><b>Agreement Holder Details :&nbsp;&nbsp;</b></mark><hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Name:&nbsp;&nbsp;</b><div class="d-inline " id="agreement_holder_name"></div><hr>
            </div>
            <div class="col">
              <b>Email:&nbsp;&nbsp;</b><div class="d-inline " id="agreement_holder_email"></div><hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Contact:&nbsp;&nbsp;</b><div class="d-inline " id="agreement_holder_mobile"></div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Date Of Birth:&nbsp;&nbsp;</b><div class="d-inline " id="agreement_holder_dob"></div>
            </div>
          </div> 
          <hr>
          <div class="row">
            <div class="col">
                <b>Member 1:&nbsp;&nbsp;</b><div class="d-inline " id="member1"></div>
            </div>
            <div class="col">
              <b>Member 2:&nbsp;&nbsp;</b><div class="d-inline " id="member2"></div>
            </div>
          </div>
          <div class="row">
            <div class="col">
                <b>Member 3:&nbsp;&nbsp;</b><div class="d-inline " id="member3"></div>
            </div>
            <div class="col">
              <b>Member 4:&nbsp;&nbsp;</b><div class="d-inline " id="member4"></div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Tenant Move In Date:&nbsp;&nbsp;</b><div class="d-inline " id="tenant_move_in_date"></div><hr>
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
  <div class="modal-dialog ">
    <div class="modal-content bg-white">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Tenant Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
		<div class="modal-body">
      <form id="updateform">
          <div class="row">
            <div class="col">
              <mark><b>Agreement Holder Details:&nbsp;&nbsp;</b><div class="d-inline " id="name1"></div></mark><hr>
            </div>
          </div>
          <div class="form-group">
            <label for="update_agreement_holder_name">Name:</label>
            <input type="text" name="" id="update_agreement_holder_name" pattern="[a-zA-Z\s.]{3,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')"class="form-control">
          </div>

          <div class="form-group">
            <label for="update_agreement_holder_email">Email:</label>
            <input type="email" name="" id="update_agreement_holder_email" class="form-control">
          </div>

          <div class="form-group">
            <label for="update_agreement_holder_mobile">Contact:</label>
            <input type="text" name="" id="update_agreement_holder_mobile" class="form-control" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')">
          </div>


          <div class="form-group">
            <label for="update_agreement_holder_dob">Date Of Birth:</label>
            <input type="text" name="" id="update_agreement_holder_dob" class="form-control" required>
          </div>
          <hr>
          <div class="form-group">
            <label for="update_member1">Member 1:</label>
            <input type="text" name="" id="update_member1" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
              <hr>
              
          <div class="form-group">
            <label for="update_member2">Member 2:</label>
            <input type="text" name="" id="update_member2" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
              <hr>
              
          <div class="form-group">
            <label for="update_member3">Member 3:</label>
            <input type="text" name="" id="update_member3" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
              <hr>
              
          <div class="form-group">
            <label for="update_member4">Member 4:</label>
            <input type="text" name="" id="update_member4" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>

          <hr>
          <div class="form-group">
            <label for="update_tenant_move_in_date">Move In Date:</label>
            <input type="text" name="" id="update_tenant_move_in_date" class="form-control">
          </div>
          
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="submit" class="btn btn-danger" onclick="updateuserdetail()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<input type="hidden" name="" id="hidden_user_id" value="">
      </div>
      </form>
    </div>
  </div>
</div>


<form enctype="multipart/form-data" id="MyForm1">
<div class="modal" id="imgmodal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="view_flat_no" >Edit Tenant Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body">
          <p class="text-danger text-small">*Picture should be of format jpg,jpeg,png</p>
      <input type="hidden" value="" name="fl" id="fl">
      <input type="hidden" name="shenga" value="shenga">
      <div class="form-group">
        	<label for="proof">picture:</label>
        	<input type="file" name="File11" id="ffiillee1" class="form-control-file">
        </div>
        <div class="modal-footer">
      	<input type="button" id="btnUpload" value="Submit" style="font-size:14px;" class="btn btn-outline-success" onclick="updateimg()">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
      </div>
</div>
</div>
</div>
</form>
   

<?php  include './footer.html';?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
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
    readRecords();
  });
  function readRecords(){
			var readrecord = "readrecord";

			$.ajax({
				url : "../backend_files/tenant_edit_details.inc.php",
				type : "post",
				data :{ readrecord:readrecord },
				success:function(data,status){
					$('.tbody').html(data);
                    $('#myTable').DataTable();
				}
			});
		}
    function viewdetails(no){
      $.post("../backend_files/tenant_edit_details.inc.php",{
        no:no
      },function(data,status){
          var dekhle = JSON.parse(data);
          var path = '../DB_docs_images/flat_tenant/'+dekhle.flat_no+'/'+dekhle.image;
          $('#image').attr('src',path);
          $('#view_flat_no').text(dekhle.flat_no);

          $('#flat_no').text(dekhle.flat_no);
          $('#agreement_holder_name').text(dekhle.agreement_holder_name);
          $('#agreement_holder_email').text(dekhle.agreement_holder_email);
          $('#agreement_holder_mobile').text(dekhle.agreement_holder_mobile);
          $('#agreement_holder_dob').text(dekhle.agreement_holder_dob);
          $('#member1').text(dekhle.member1);
          $('#member2').text(dekhle.member2);
          $('#member3').text(dekhle.member3);
          $('#member4').text(dekhle.member4);
          $('#tenant_move_in_date').text(dekhle.tenant_move_in_date);
        });
      $('#viewmodal').modal("show");
    }

		function getdetails(no){
			$('#hidden_user_id').val(no);
			$.post("../backend_files/tenant_edit_details.inc.php",{
				no:no
			},function(data,status){
				var dekhle = JSON.parse(data);
                $('#update_agreement_holder_name').val(dekhle.agreement_holder_name);
                $('#update_agreement_holder_email').val(dekhle.agreement_holder_email);
                $('#update_agreement_holder_mobile').val(dekhle.agreement_holder_mobile);
                $('#update_agreement_holder_dob').val(dekhle.agreement_holder_dob);
                $('#update_member1').val(dekhle.member1);
                $('#update_member2').val(dekhle.member2);
                $('#update_member3').val(dekhle.member3);
                $('#update_member4').val(dekhle.member4);
                $('#update_tenant_move_in_date').val(dekhle.tenant_move_in_date);
			});
			$('#update_user_modal').modal("show");
		}


    function updateuserdetail(){
      $('#updateform').on('submit',function(e){
       e.preventDefault();
     
        var agreement_holder_name=$('#update_agreement_holder_name').val();
        var agreement_holder_email=$('#update_agreement_holder_email').val();
        var agreement_holder_mobile=$('#update_agreement_holder_mobile').val();
        var agreement_holder_dob=$('#update_agreement_holder_dob').val();
        var tenant_move_in_date=$('#update_tenant_move_in_date').val();

        var member1=$('#update_member1').val();
        var member2=$('#update_member2').val();
        var member3=$('#update_member3').val();
        var member4=$('#update_member4').val();
        var hidden_user_idupd=$('#hidden_user_id').val();
        $.post("../backend_files/tenant_edit_details.inc.php",{
            hidden_user_idupd: hidden_user_idupd,
            agreement_holder_name:agreement_holder_name,
            agreement_holder_email:agreement_holder_email,
            agreement_holder_mobile:agreement_holder_mobile,
            agreement_holder_dob:agreement_holder_dob,
            tenant_move_in_date:tenant_move_in_date,
            member1:member1,
            member2:member2,
            member3:member3,
            member4:member4
        }, function(data,status){
            var response=JSON.parse(data);
          //  console.log(response);
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
            $('#update_user_modal').modal("hide");
            readRecords();
        });
      });
    }
    function remove(no){
      $.post("../backend_files/tenant_edit_details.inc.php",{
				delete_flat_no:no
			},function(data,status){
        var response=JSON.parse(data);
     //   console.log(response);
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
		}

    function zoomimg(fl){
        $('#fl').val(fl);
        $('#imgmodal').modal("show");
      }

      function updateimg(){
        var df = '<?php echo $_SESSION['username']; ?>' ;
         var shenga="shenga";
         var flat_no='<?php echo $_SESSION['username']?>';
        var form = $("#MyForm1");
        var params = form.serializeArray();
        var files1 = $("#ffiillee1")[0].files; 
        var pop1 = $('#ffiillee1').attr("name");  
        var formData = new FormData();
        formData.append(pop1, files1[0]);


    $(params).each(function (index, element) {
        formData.append(element.name, element.value);
    });
    //  for (var pair of formData.entries()) {
    //  console.log(pair[0]+ ' - ' + pair[1]);
    // } 
 
      $.ajax({
  		url:'../backend_files/tenant_edit_details.inc.php',
  		type:'post',
			contentType:false,
			processData:false,
			cache:false,
  			data: formData,
			success:function(data,status){
     //   console.log(data);
        $('#imgmodal').modal("hide");
        var response=JSON.parse(data);
      //  console.log(response);
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



    $('.success-close').click(function(){
      $('.success').hide();
    });
    $('.error-close').click(function(){
      $('.error').hide();
    });
  </script>
