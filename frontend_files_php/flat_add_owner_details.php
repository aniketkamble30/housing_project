<?php include './_navbar.php';?>
<div class="page-header">
    <h3 class="page-title ">Add Resident Details </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item"><a href="flat_tabs.php">Manage Flats</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Resident Details</li>
        </ol>
</div>
<div class="card">
    <div class="card-body">
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
            <div class="col col-xl-9 col-12 ">
                <form action="../backend_files/add_flat_owner_details.inc.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Flat Id:</label>
                            <input type="text" class="form-control" name="flat_no" placeholder="Eg: A302" required pattern="[A]\d{3,4}|[B]\d{3,4}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid flat format');">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Type of Ownership</label>
                            <select required class="form-control mr-sm-2" name="flat_type_of_ownership"
                                id='flat_type_of_ownership' required>
                                <option value="">Select</option>
                                <option value="single">Single</option>
                                <option value="joint">Joint</option>
                            </select>
                        </div>
                    </div>


                    <!--    <b>Owner 1 details:</b> <br>-->

                    <div class="row">
                        <h4 class="ml-3">Owner 1 details:</h4>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name:</label>
                            <input type="text" name="flat_owner1_name" class="form-control" placeholder="Name" pattern="[a-zA-Z\s.]{3,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
                        </div>
                        <div class="form-group col-md-6">
                            <label>EmailID:</label>
                            <input type="email" name="flat_owner1_email" class="form-control" placeholder="emailId">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Contact</label>
                            <input type="tel" class="form-control" name="flat_owner1_mob" placeholder="Contact" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Occupation</label>
                            <input type="text" class="form-control" name="flat_owner1_occup" placeholder="Occupation" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Date of birth</label>
                            <input type="date" class="form-control" name="flat_owner1_dob" placeholder="DOB">
                        </div>
                    </div>

                    <!--Owner 2 details:-->
                    <div class="owner2">
                        <div class="row" owner2>
                            <h4 class="ml-3">Owner 2 details:</h4>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name:</label>
                                <input type="text" name="flat_owner2_name" id="1" class="form-control" placeholder="Name"   pattern="[a-zA-Z\s.]{3,40}"oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
                            </div>
                            <div class="form-group col-md-6">
                                <label>EmailID:</label>
                                <input type="email" name="flat_owner2_email" id="2" class="form-control" placeholder="emailId">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Contact</label>
                                <input type="text" class="form-control" id="3" name="flat_owner2_mob" placeholder="Contact" pattern="[+]\d{2}[0-9]{10}|[0-9]{10,12}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid contact')" >
                            </div>
                            <div class="form-group col-md-7">
                                <label>Occupation</label>
                                <input type="text" class="form-control" id="4" name="flat_owner2_occup"
                                    placeholder="Occupation">
                            </div>
                            <div class="form-group col-md-5">
                                <label>Date of birth</label>
                                <input type="date" class="form-control" id="5" name="flat_owner2_dob" placeholder="DOB">
                            </div>
                        </div>
                    </div>



                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Owner 1</label>
                            <input class="form-control-file" type="file" name="owner1_image1" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Owner 2</label>
                            <input class="form-control-file" type="file" name="owner2_image1">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Spouse</label>
                            <input class="form-control-file" type="file" name="spouse_image1">
                        </div>

                    </div>
                    <hr>









                    <div class="row">
                        <h4 class="ml-3">Nominee:</h4>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Enter Nominee's name</label>
                            <input type="text" class="form-control" name="nominee" pattern="[a-zA-Z\s.]{5,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Number of members</label>
                            <input type="number" class="form-control" name="flat_member_count"
                                placeholder="Number of members" min=0>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Assosciate Member's Name</label><br><br>
                            <input type="text" class="form-control" name="assosciate_member_name"
                                placeholder="Name of member 1" pattern="[a-zA-Z\s.]{5,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invalid name')">
                        </div>
                        <div class="form-group col-md-6 mt-1">
                            <label>Assosciate Member's Relation with owner</label>
                            <input type="text" class="form-control" name="assosciate_member_reln"
                                placeholder="Relation with owner" pattern="[a-zA-Z\s/]{2,40}" required oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid format')">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name of member 2</label>
                            <input type="text" class="form-control" name="flat_member2_name"
                                placeholder="Name of member 2" pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid name')">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Relation with owner</label>
                            <input type="text" class="form-control" name="flat_member2_reln"
                                placeholder="Relation with owner" pattern="[a-zA-Z\s]{2,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid format')"
                                >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name of member 3</label>
                            <input type="text" class="form-control" name="flat_member3_name"
                                placeholder="Name of member 3" pattern="[a-zA-Z\s.]{3,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid name')">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Relation with owner</label>
                            <input type="text" class="form-control" name="flat_member3_reln"
                                placeholder="Relation with owner" pattern="[a-zA-Z\s]{2,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid format')">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Name of member 4</label>
                            <input type="text" class="form-control" name="flat_member4_name"
                                placeholder="Name of member 4" pattern="[a-zA-Z\s.]{5,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid name')">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Relation with owner</label>
                            <input type="text" class="form-control" name="flat_member4_reln"
                                placeholder="Relation with owner" pattern="[a-zA-Z\s]{2,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid format')">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Move in date</label>
                            <input type="date" class="form-control" name="flat_move_in_date"
                                placeholder="Vehical count">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Vehicle count</label>
                            <input type="number" class="form-control" name="flat_vehicle_count"
                                placeholder="Vehical count">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Vehicle description</label>
                            <input type="text" class="form-control" name="flat_vehicle_description"
                                placeholder="Vehical description">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Pet count</label>
                            <input type="number" class="form-control" name="flat_petcount" placeholder="Pet count">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pet description</label>
                            <input type="text" class="form-control" name="flat_petdescription"
                                placeholder="Pet description">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Maid name</label>
                            <input type="text" class="form-control" name="flat_maid_name" placeholder="Maid name" pattern="[a-zA-Z\s]{4,40}" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'invlaid name')">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-auto my-1">

                        </div>
                    </div>
                    <button type="submit" name="submit_owner_details" class="btn btn-primary text-center">Add
                        Details</button>
                </form>
            </div>



            <!-- formends -->


        </div>
    </div>
</div>

<?php  include './footer.html';?>   <script>

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
        $('#flat_type_of_ownership').change(function(){
          if($('#flat_type_of_ownership').val()=='joint'){
            $(".owner2").show();
          }
          else{
             $(".owner2").hide();
             $('#1').val('');
             $('#2').val('');
             $('#3').val('');
             $('#4').val('');
             $('#5').val('');
          }
        }).change();
      });

   </script>