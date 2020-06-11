<?php include './_navbar.php';?>

<div class="page-header">
  <h3 class="page-title"> Edit Resident Details </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                <li class="breadcrumb-item"><a href="flat_tabs.php">Manage Flats</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Resident Details</li>
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
             <?php  require './footer.html';?> 

<div class="modal dueModal" id="due_error">
  <div class="modal-dialog-center modal-lg modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #c2ffbd;">
        <h4 class="modal-title" style="font-family: solway; color: #203f61;">Please Clear Pending Maintenance</h4>
        <button type="button" class="close" data-dismiss="modal" style="color: #203f61; font-family: roboto">&times;</button>
      </div>

    </div>
  </div>
</div>


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
              <div class="col-4">Spouse : </div>
          </div>
          <div class="row center-align">
            <div class="col-4">
              <img id="owner1_image1" alt="no image added" width="150px" height="150px" class="img-thumbnail">
            </div>
            <div class="col-4">
              <img id="owner2_image1" alt="no image added" width="150px" height="150px" class="img-thumbnail">
            </div>
            <div class="col-4">
              <img id="spouse_image1" alt="no image added" width="150px" height="150px" class="img-thumbnail">
            </div>
          </div><hr>
          <div class="row mt-4">
            <div class="col">
              <mark><b>Owner 1 :&nbsp;&nbsp;</b><div class="d-inline "></div></mark><hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Name:&nbsp;&nbsp;</b><div class="d-inline " id="name1"></div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Email:&nbsp;&nbsp;</b><div class="d-inline " id="email1"></div>
            </div>
            <div class="col">
              <b>Contact:&nbsp;&nbsp;</b><div class="d-inline " id="phoneno1"></div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Occupation:&nbsp;&nbsp;</b><div class="d-inline " id="occup1"></div><hr>
            </div>
            <div class="col">
              <b>DOB:&nbsp;&nbsp;</b><div class="d-inline " id="dob1"></div><hr>
            </div>
          </div>

          <div class='owner2' id='owner2'>
            <div class="row">
              <div class="col">
                <mark><b>Owner 2 :&nbsp;&nbsp;</b><div class="d-inline "></div></mark><hr>
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
                <b>Occupation:&nbsp;&nbsp;</b><div class="d-inline " id="occup2"></div><hr>
              </div>
              <div class="col">
                <b>DOB:&nbsp;&nbsp;</b><div class="d-inline " id="dob2"></div><hr>
              </div>
            </div>
          </div>
          <!-- <hr> -->
          <!-- ANIKET -->
          <div class="row mt-4">
            <div class="col">
              <mark><b>Nominee :&nbsp;&nbsp;</b><div class="d-inline "></div></mark><hr>
            </div>
          </div>
          <!-- ANIKET -->
          <div class="row">
            <div class="col">
              <b>Nominee Name:</b><div class="d-inline p-2 "id="nominee"></div>
            </div>        
            <div class="col">
              <b>Members Count:</b><div class="d-inline p-2 "id="members_count"></div>
            </div>        
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Assosciate members's name:</b><div class="d-inline p-2 "id="assosciate_members_name"></div>
            </div>    
          </div>    
          <hr>
          <div class="row"> 
            <div class="col">
              <b>Assosciate members's relation with owner:</b><div class="d-inline p-2 "id="assosciate_members_reln"></div>
            </div>        
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Member 2 name:</b><div class="d-inline p-2 "id="memname2"></div>
            </div>    
          </div>    
          <hr>
          <!-- ANIKET -->
          <div class="allMembers">   
          <!-- ANIKET -->
            <div class="row"> 
              <div class="col">
                <b>Relation:</b><div class="d-inline p-2 "id="memname2reln"></div>
              </div>        
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <b>Member 3 name:</b><div class="d-inline p-2 "id="memname3"></div>
              </div>    
            </div>    
            <div class="row"> 
              <div class="col">
                <b>Relation:</b><div class="d-inline p-2 "id="memname3reln"></div>
              </div>        
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <b>Member 4 name:</b><div class="d-inline p-2 "id="memname4"></div>
              </div>    
            </div>    
            <div class="row"> 
              <div class="col">
                <b>Relation:</b><div class="d-inline p-2 "id="memname4reln"></div>
              </div>        
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <b>Member 5 name:</b><div class="d-inline p-2 "id="memname5"></div>
              </div>    
            </div>    
            <div class="row"> 
              <div class="col">
                <b>Relation:</b><div class="d-inline p-2 "id="memname5reln"></div>
              </div>        
            </div>
          </div>
          <hr>
          <!-- ANIKET -->
          <div class="row mt-4">
            <div class="col">
              <mark><b>Flat Details :&nbsp;&nbsp;</b><div class="d-inline "></div></mark><hr>
            </div>
          </div>
          <!-- ANIKET -->
          <div class="row">
            <div class="col">
              <b>Ownership Type:</b><div class="d-inline p-2 "id="flat_type_of_ownership"></div>
            </div>
            <div class="col">
              <b>BHK:</b><div class="d-inline p-2 "id="bhk"></div>
            </div>
        
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <b>Dimensions :</b><div class="d-inline p-2 " id="flat_dimensions"></div>
            </div>
            <div class="col">
              <b>Current Status :</b><div class="d-inline p-2 " id="flat_status"></div>
            </div>
          </div>
          <hr>

          <!-- ANIKET EDIT -->
          <div class="row mt-4">
            <div class="col">
              <mark><b>Other Details :&nbsp;&nbsp;</b><div class="d-inline "></div></mark><hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Vehicle Count :</b><div class="d-inline p-2 " id="flat_vehicle_count"></div>
            </div>

            <div class="col">
              <b>Vehicle Description :</b><div class="d-inline p-2 " id="flat_vehicle_desc"></div>
            </div>
          </div>
          
          <hr>

          <div class="row">
            <div class="col">
                <b>Pet Count :</b><div class="d-inline p-2 " id="flat_petcount"></div>
              </div>

              <div class="col">
                <b>Pet Description :</b><div class="d-inline p-2 " id="flat_pet_desc"></div>
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
  <div class="modal-dialog" >
    <div class="modal-content bg-light">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Update Flat Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
			<div class="modal-body">
      <form id="UpdateForm">
          <input type="hidden" id='flat_no' value=''>
          <div class="row">
            <div class="col">
              <mark><b>Owner 1 :&nbsp;&nbsp;</b></mark><hr>
            </div>
          </div>
          <div class="form-group">
            <label for="update_owner1_name"> Update Owner 1 Name:</label>
            <input type="text" name="" id="update_owner1_name" class="form-control" placeholder="" id='agreement_holder_name' pattern="[a-zA-Z\s.]{5,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group">
            <label for="update_owner1_email"> Update Owner 1 Email:</label>
            <input type="email" name="" id="update_owner1_email" class="form-control" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="update_owner1_phoneno"> Update Owner 1 Phone no:</label>
            <input type="text" name="" id="update_owner1_phoneno" class="form-control" placeholder="" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')" >
          </div>
          <div class="form-group">
            <label for="update_owner1_occup"> Update Owner 1 Occupation:</label>
            <input type="text" name="" id="update_owner1_occup" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="update_owner1_dob"> Update Owner 1 Birth Date:</label>
            <input type="date" name="" id="update_owner1_dob" class="form-control" placeholder="">
          </div>

          <div class="form-group">
            <label for="update_flat_type_of_ownership">Update Type Of Ownership:</label>
           <select required class="custom-select mr-sm-2" name="flat_type_of_ownership" id='update_flat_type_of_ownership' required>
            <option value="">Select</option>
            <option value="single">Single</option>
            <option value="joint">Joint</option>
          </select>
        </div>


          <div class="owner2">
            <div class="row">
              <div class="col">
                <mark><b>Owner 2 :&nbsp;&nbsp;</b></mark><hr>
              </div>
            </div>
            <div class="form-group">
              <label for="update_owner2_name"> Update Owner 2 Name:</label>
              <input type="text" name="" id="update_owner2_name" class="form-control" placeholder="" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
            </div>
            <div class="form-group">
              <label for="update_owner2_email"> Update Owner 2 Email:</label>
              <input type="email" name="" id="update_owner2_email" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="update_owner2_phoneno"> Update Owner 2 Phone no:</label>
              <input type="text" name="" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')"  id="update_owner2_phoneno" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="update_owner2_occup"> Update Owner 2 Occupation:</label>
              <input type="text" name="" id="update_owner2_occup" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="update_owner2_dob"> Update Owner 2 Birth Date:</label>
              <input type="date" name="" id="update_owner2_dob" class="form-control" placeholder="">
            </div>
          </div>
          <!-- ANIKET -->
          <div class="Nominee">
            <div class="row">
              <div class="col">
                <mark><b>Nominee:&nbsp;&nbsp;</b></mark><hr>
              </div>
            </div>
            <!-- ANIKET -->
          <div class="form-group">
            <label for="update_nominee"> Update Nominee Name:</label>
            <input type="text" name="" id="update_nominee" class="form-control" pattern="[a-zA-Z\s.]{5,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group">
            <label for="update_nominee"> Assosciate member's name:</label>
            <input type="text" name="" id="update_assosciate_members_name" class="form-control" pattern="[a-zA-Z\s.]{5,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group">
            <label for="update_nominee"> Assosciate member's relation with owner:</label>
            <input type="text" name="" id="update_assosciate_members_reln" class="form-control" pattern="[a-zA-Z\s.]{2,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid format')">
          </div>
          <div class="form-group">
            <label for="update_member_count"> Update Member Count:</label>
            <input type="number" name="" id="update_member_count" class="form-control" min=0 required>
          </div>
          
          <div class="form-group">
            <label for="update_member_count"> Member 2 name:</label>
            <input type="text" name="" id="upmemname2" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')" >
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 2 relation:</label>
            <input type="text" name="" id="upmemname2reln" class="form-control" pattern="[a-zA-Z\s.]{2,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid format')">
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 3 name:</label>
            <input type="text" name="" id="upmemname3" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name') >
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 3 relation:</label>
            <input type="text" name="" id="upmemname3reln" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid format')">
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 4 name:</label>
            <input type="text" name="" id="upmemname4" class="form-control" pattern="[a-zA-Z\s.]{5,40}"oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')" >
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 4 relation:</label>
            <input type="text" name="" id="upmemname4reln" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid format')" >
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 5 name:</label>
            <input type="text" name="" id="upmemname5" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
          </div>
          <div class="form-group">
            <label for="update_member_count"> Member 5 relation:</label>
            <input type="text" name="" id="upmemname5reln" class="form-control" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid format')">
          </div>
          </div>
          
          <div class="row">
              <div class="col">
                <mark><b>Other Details:&nbsp;&nbsp;</b></mark><hr>
              </div>
          </div>

          <div class="form-group">
            <label for="update_flat_status">Update Status :</label>
            <select required class="custom-select mr-sm-2" name="flat_type_of_ownership" id='update_flat_status'>
            <option value="">Select</option>
            <option value="self-use">self-use</option>
            <option value="rented">rented</option>
            <option value="vacant">vacant</option>
          </select>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" onclick="updateuserdetail()">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="hidden" name="" id="hidden_user_id" value="">
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
          <div class="modal-header">
            <h4 class="modal-title" id="view_flat_no" >Edit Owner Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body">
          <p class="text-danger text-small">*Picture should be of format jpg,jpeg,png</p>
      <input type="hidden" value="" name="fl" id="fl">
      <input type="hidden" name="shenga" value="shenga">
      <div class="form-group">
        	<label for="proof">Owner1 picture:</label>
        	<input type="file" name="File11" id="ffiillee1" class="form-control-file">
        </div>
        <div class="form-group">
        	<label for="proof">Owner2 picture:</label>
        	<input type="file" name="File12" id="ffiillee2" class="form-control-file">
        </div>
        <div class="form-group">
        	<label for="proof">Spouse picture:</label>
        	<input type="file" name="File13" id="ffiillee3" class="form-control-file">
        </div>

        <div class="modal-footer">
      	<input type="button" id="btnUpload" value="Submit" style="font-size:14px;" class="btn btn-outline-success" onclick="updateimg()">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
      </div>
</div>
</div>
</div>
</form>
   
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
 
<script>
  $(document).ready(function(){
    
    // readAllRecord();
    $('#update_flat_type_of_ownership').change(function(){
          if($('#update_flat_type_of_ownership').val()=='joint'){
            $(".owner2").show();
          }
          else{
          $('.owner2').hide();
          $('#update_owner2_name').val('');
        $('#update_owner2_email').val('');
        $('#update_owner2_phoneno').val('');
        $('#update_owner2_occup').val('');
        $('#update_owner2_dob').val('');
        }
        }).change();
        readRecords();
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


 
  // -------------soumya---------------------------------
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
        var files2 = $("#ffiillee2")[0].files; 
        var pop2 = $('#ffiillee2').attr("name");  
        var files3 = $("#ffiillee3")[0].files; 
        var pop3 = $('#ffiillee3').attr("name");  

        var formData = new FormData();
        formData.append(pop1, files1[0]);
        formData.append(pop2, files2[0]);
        formData.append(pop3, files3[0]);

    $(params).each(function (index, element) {
        formData.append(element.name, element.value);
    });
    //  for (var pair of formData.entries()) {
    //  console.log(pair[0]+ ' - ' + pair[1]);
    // } 
 
      $.ajax({
  		url:'../backend_files/flat_edit_details.inc.php',
  		type:'post',
			contentType:false,
			processData:false,
			cache:false,
  			data: formData,
			success:function(data,status){
        console.log(data);
        $('#imgmodal').modal("hide");
        var response=JSON.parse(data);
        console.log(response);
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




 		function readRecords(){
			var readrecord = "readrecord";

			$.ajax({
				url : '../backend_files/flat_edit_details.inc.php',
				type : "post",
				data :{ readrecord:readrecord },
				success:function(data,status){
					$('.tbody').html(data);
          $('#myTable').DataTable();
				}
			});
		}    


		function DeleteUser(deleteid){
			var conf = confirm("Do you want to delete ?");
			if(conf == true){
				$.ajax({
					url : '../backend_files/flat_edit_details.inc.php',
					type:"post",
					data:{ deleteid:deleteid },
					success:function(data,status){
						readRecords();
					}
				});
			}
		}

    function viewuserdetails(id){
      // $('#hidden_user_id').val(id);
      $.post('../backend_files/flat_edit_details.inc.php',{
        id:id
      },function(data,status){
        var dekhle = JSON.parse(data);
        $('#view_flat_no').text(dekhle.flat_no);
        var path1 = '../DB_docs_images/flat_owner/'+dekhle.flat_no+'/'+dekhle.owner1_image1;
        var path2 = '../DB_docs_images/flat_owner/'+dekhle.flat_no+'/'+dekhle.owner2_image1;
          var path3 = '../DB_docs_images/flat_owner/'+dekhle.flat_no+'/'+dekhle.spouse_image1;
          $('#owner1_image1').attr('src',path1);
          $('#owner2_image1').attr('src',path2);
          $('#spouse_image1').attr('src',path3);
         
        $('#name1').text(dekhle.flat_owner1_name);
        $('#email1').text(dekhle.flat_owner1_email);
        $('#phoneno1').text(dekhle.flat_owner1_mob);
        $('#occup1').text(dekhle.flat_owner1_occup);
        $('#dob1').text(dekhle.flat_owner1_dob);
        $('#members_count').text(dekhle.flat_member_count);
        $('#name2').text(dekhle.flat_owner2_name);
        $('#email2').text(dekhle.flat_owner2_email);
        $('#phoneno2').text(dekhle.flat_owner2_mob);
        $('#occup2').text(dekhle.flat_owner2_occup);
        $('#dob2').text(dekhle.flat_owner2_dob);
        if(dekhle.flat_type_of_ownership=='joint'){
          $('.owner2').show();
        }
        else{
          $('.owner2').hide();
        }
        $('#memname2').text(dekhle.flat_member2_name);
        $('#memname2reln').text(dekhle.flat_member2_reln);
        $('#memname3').text(dekhle.flat_member3_name);
        $('#memnae3reln').text(dekhle.flat_member3_name);
        $('#memnae4').text(dekhle.flat_member4_name);
        $('#memnae4reln').text(dekhle.flat_member4_reln);
        $('#memnae5').text(dekhle.flat_member5_name);
        $('#memnae5reln').text(dekhle.flat_member5_reln);

        $('#nominee').text(dekhle.nominee);
        $('#assosciate_members_name').text(dekhle.assosciate_member_name);
        $('#assosciate_members_reln').text(dekhle.assosciate_member_reln);
        $('#flat_type_of_ownership').text(dekhle.flat_type_of_ownership);
        $('#flat_dimensions').text(dekhle.flat_dimensions);
        $('#flat_status').text(dekhle.flat_status);
        $('#bhk').text(dekhle.BHK);

        // ANIKET EDIT
        $('#flat_vehicle_count').text(dekhle.flat_vehicle_count);
        $('#flat_vehicle_desc').text(dekhle.flat_vehicle_description);
        $('#flat_petcount').text(dekhle.flat_pet_count);
        $('#flat_pet_desc').text(dekhle.flat_pet_description);
        // ANIKET EDIT 

        //$('#view_flat_parking').text(dekhle.flat_parking);
        });
      $('#viewmodal').modal("show");

    }


		function GetUserDetails(id){
			$('#hidden_user_id').val(id);
			$.post('../backend_files/flat_edit_details.inc.php',{
				id:id
			},function(data,status){
				var user = JSON.parse(data);
        $('#flat_no').val(user.flat_no);
        $('#update_flat_type_of_ownership').val(user.flat_type_of_ownership);
        $('#update_flat_status').val(user.flat_status);
        $('#update_owner1_name').val(user.flat_owner1_name);
        $('#update_owner1_email').val(user.flat_owner1_email);
        $('#update_owner1_phoneno').val(user.flat_owner1_mob);
        $('#update_owner1_occup').val(user.flat_owner1_occup);
        $('#update_owner1_dob').val(user.flat_owner1_dob);
        $('#update_owner2_name').val(user.flat_owner2_name);
        $('#update_owner2_email').val(user.flat_owner2_email);
        $('#update_owner2_phoneno').val(user.flat_owner2_mob);
        $('#update_owner2_occup').val(user.flat_owner2_occup);
        $('#update_owner2_dob').val(user.flat_owner2_dob);
        if(user.flat_type_of_ownership=='joint'){
          $('.owner2').show();
        }
        else{
          $('.owner2').hide();
          $('#update_owner2_name').val('');
        $('#update_owner2_email').val('');
        $('#update_owner2_phoneno').val('');
        $('#update_owner2_occup').val('');
        $('#update_owner2_dob').val('');
        }

        $('#update_nominee').val(user.nominee);
        $('#update_assosciate_members_name').val(user.assosciate_member_name);
        $('#update_assosciate_members_reln').val(user.assosciate_member_reln);
        $('#update_member_count').val(user.flat_member_count);
				$('#upmemname2').val(dekhle.flat_member2_name);
        $('#upmemname2reln').val(dekhle.flat_member2_reln);
        $('#upmemname3').val(dekhle.flat_member3_name);
        $('#upmemnae3reln').val(dekhle.flat_member3_reln);
        $('#upmemnae4').val(dekhle.flat_member4_name);
        $('#upmemnae4reln').val(dekhle.flat_member4_reln);
        $('upmemnae5').val(dekhle.flat_member5_name);
        $('#upmemnae5reln').val(dekhle.flat_member5_reln);
        $('#update_flat_dimensions').val(user.flat_dimensions);
        $('#update_flat_type_of_ownership').val(user.flat_type_of_ownership);
        $('#update_flat_status').val(user.flat_status);
        // $('#update_flat_bhk').val(user.BHK);
        //$('#update_flat_parking').val(user.flat_parking);
        // $('#update_vehicle_count').val(user.flat_vehicle_count);
        // $('#update_flat_petcount').val(user.flat_petcount);

			});
			$('#update_user_modal').modal("show");
		}
		function remove(no){
      var conf = confirm("Do you want to delete ?");
			if(conf == true){
      $.post('../backend_files/flat_edit_details.inc.php',{
				delete_flat_no:no
			},function(data,status){
        var response=JSON.parse(data);
        console.log(data);
        if(response.success){
          $('.success-text').text(response.success);
          $('.success').show();
          $('html, body').animate({scrollTop: $($('.success')[0]).offset().top - offset }, delay);
        
        }
        else if(response.due_error){
          $('.error-text').text(response.due_error);
          $('#due_error').modal("show"); 
          $('html, body').animate({scrollTop: $($('.error')[0]).offset().top - offset }, delay);
        
        }
        else{
          $('.error-text').text(response.error);
          $('.error').show();
          $('html, body').animate({scrollTop: $($('.error')[0]).offset().top - offset }, delay);
        
        }
        readRecords();
			});
      }
		}


    function updateuserdetail(){
      $('#UpdateForm').on('submit',function(e){
       e.preventDefault();
      var hidden_user_idupd=$('#hidden_user_id').val();
      var flat_no=$('#flat_no').val();
      var flat_owner1_name=$('#update_owner1_name').val();
      var flat_owner1_email=$('#update_owner1_email').val();
      var flat_owner1_mob=$('#update_owner1_phoneno').val();
      var flat_owner1_occup=$('#update_owner1_occup').val();
      var flat_owner1_dob=$('#update_owner1_dob').val();
      var flat_owner2_name=$('#update_owner2_name').val();
      var flat_owner2_email=$('#update_owner2_email').val();
      var flat_owner2_mob=$('#update_owner2_phoneno').val();
      var flat_owner2_occup=$('#update_owner2_occup').val();
      var flat_owner2_dob=$('#update_owner2_dob').val();

      var nominee=$('#update_nominee').val();
      var assosciate_member_name=$('#update_assosciate_members_name').val();
      var assosciate_member_reln=$('#update_assosciate_members_reln').val();
      var flat_member_count=$('#update_member_count').val();
			var flat_member2_name=$('#upmemname2').val();        
      var flat_member2_reln=$('#upmemname2reln').val();
			var flat_member3_name=$('#upmemname3').val();        
      var flat_member3_reln=$('#upmemname3reln').val();
			var flat_member4_name=$('#upmemname4').val();        
      var flat_member4_reln=$('#upmemname4reln').val();
			var flat_member5_name=$('#upmemname5').val();        
      var flat_member5_reln=$('#upmemname5reln').val();
      // var flat_dimensions=$('#update_flat_dimensions').val();
      var flat_type_of_ownership=$('#update_flat_type_of_ownership').val();
      var flat_status=$('#update_flat_status').val();
      // var BHK=$('#update_flat_bhk').val();
      //$('#update_flat_parking').val(user.flat_parking);
      var flat_vehicle_count=$('#update_vehicle_count').val();
      var flat_petcount=$('#update_flat_petcount').val();

      $.post('../backend_files/flat_edit_details.inc.php',{
        hidden_user_idupd:hidden_user_idupd,
        flat_no: flat_no,
        flat_owner1_name:flat_owner1_name,
        flat_owner1_email: flat_owner1_email,
        flat_owner1_mob: flat_owner1_mob,
        flat_owner1_occup: flat_owner1_occup,
        flat_owner1_dob: flat_owner1_dob,
        nominee: nominee,
        assosciate_member_name:assosciate_member_name,
        assosciate_member_reln:assosciate_member_reln,
				flat_member2_name:flat_member2_name,
        flat_member2_reln:flat_member2_reln,
				flat_member3_name:flat_member3_name,
        flat_member3_reln:flat_member3_reln,
				flat_member4_name:flat_member4_name,
        flat_member4_reln:flat_member4_reln,
				flat_member5_name:flat_member5_name,
        flat_member5_reln:flat_member5_reln,
        flat_owner2_name: flat_owner2_name,
        flat_owner2_email: flat_owner2_email,
        flat_owner2_mob: flat_owner2_mob,
        flat_owner2_occup: flat_owner2_occup,
        flat_owner2_dob: flat_owner2_dob,
        flat_member_count: flat_member_count,
        // flat_dimensions: flat_dimensions,
        flat_status: flat_status,
        flat_type_of_ownership: flat_type_of_ownership,
        // BHK: BHK
      }, function(data,status){
       // console.log(data);
        var response=JSON.parse(data);
        // console.log(response);
        $('#update_user_modal').modal("hide");
          readRecords();
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
      });
    });
    }
    
    $('.success-close').click(function(){
      $('.success').hide();
    });
    $('.error-close').click(function(){
      $('.error').hide();
    });
  </script>