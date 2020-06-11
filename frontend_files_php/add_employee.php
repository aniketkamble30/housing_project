<?php include './_navbar.php';?>

<div class="page-header">
<h2  style="color:teal;" class="mt-3">Add Employee</h2><hr>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php" id="dashboardbox1">Homepage</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
    </ol>
  </nav>
</div>

<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <div id="re" class="mt-3 mb-0 alert alert-success success" style='display: none;'><span class="success-text"></span><span style="float:right; cursor: pointer;" class="success-close">&times;</span></div>
          <div id="re" class="mt-3 mb-0 alert alert-danger error" style='display: none;'> <span class="error-text"></span><span style="float:right; cursor: pointer;" class="error-close">&times;</span></div><br>
        <div class="container-fluid">
<div class="row">
     <div class="col col-xl-10 col-lg-10 col-xs-10">
       <form id='employee_form' >
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Employee id</label>
              <input type="text" name='emp_id' class="form-control" id="" required> 
            </div>
            <div class="form-group col-md-6">
              <label for="">Employee name</label>
              <input type="text" class="form-control" name='emp_name' id="" pattern="[a-zA-Z\s.]{3,40}"oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
              </div>
            </div>
    <div class="form-row">
      <div class="form-group col-md-4">
      <label for="">Role of employee</label>
              <input type="text" name='emp_type' class="form-control" id="" required>
              </div>

      <div class="form-group col-md-4">
        <label for="inputZip">Agency name </label>
        <input type="text" class="form-control" id="agency" placeholder=" " name='agency' required>
      </div>

    <div class="form-group col-md-4">
      <label for="inputZip">Contact number</label>
      <input type="text" class="form-control" id="emp_mob" placeholder=" " name='emp_mob' required pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity (validity.valid ? '' :'invalid contact')" >
    </div>
  </div>


<hr>
    <div class="text-danger"><h6></h6></div>
    <div class="form-row">
    <div class="form-group col-md-4">
      <label >employee's image</label>
      <input class="form-control-file" type="file" name="image1" id="File1" required>
    </div> 

    <div class="form-group col-md-4">
      <label>Id proof</label>
      <input class="form-control-file" type="file" name="File2" id="File2" required>
    </div> 

    <div class="form-group col-md-4">
      <label>other doc</label>
      <input class="form-control-file" type="file" name="File3" id="File3">
    </div> 

    </div>
    <hr>


  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="move_in">Joining date</label>
      <input type="date" class="form-control" id="join_date" placeholder=" " name='join_date'>
    </div>
</div>

  <div class="form-row">
    <div class="form-group col-md-4">
        <label for="">Salary per month:</label>
        <input type="text" class="form-control" id="emp_salary" placeholder="Amount" name='emp_salary' pattern="[0-9,]{0,20}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid ')" >
      </div>
      <div class="form-group col-md-4">
          <label for="">Yearly Increment:</label>
          <input type="text" class="form-control" id="emp_yearly_incr" placeholder="Amount" name='emp_yearly_incr'pattern="[0-9,]{0,20}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid')" > 
        </div>
  </div>


  <div class="form-group">
    <div class="col-auto my-1">

    </div>
  </div>
  <input type="hidden" name="submit_details">
  <button type="submit" class="btn btn-primary text-center">Add Details</button>
</form>
</div>
</div>
    </div>
</div>

<?php  include './footer.html';?>
   <!-- Menu Toggle Script -->
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

     $('#employee_form').on('submit',function(e){
      e.preventDefault();

      var form=$("#employee_form");
      var params = form.serializeArray();

      var files1 = $("#File1")[0].files;
      var files2 = $("#File2")[0].files;
      var files3 = $("#File3")[0].files;
 
      var pop1 = $('#File1').attr("name"); 
      var pop2 = $('#File2').attr("name"); 
      var pop3 = $('#File3').attr("name"); 


      var formData = new FormData(); 
      formData.append(pop1, files1[0]);
      formData.append(pop2, files2[0]);
      formData.append(pop3, files3[0]);
      $(params).each(function (index, element) {
                formData.append(element.name, element.value);
            });
      
   for (var pair of formData.entries()) {
  // console.log(pair[0]+ ' - ' + pair[1]); 
}


      $.ajax({
        url: '../backend_files/add_employee.inc.php',
        type:'POST',
        contentType:false,
        processData:false,
        cache:false,
        data: formData,
        success: function(data){
        
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
          $('#employee_form').trigger('reset');
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


