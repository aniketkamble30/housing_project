<?php
$conn = mysqli_connect('localhost','root','','house');
if (mysqli_num_rows(mysqli_query($conn,"SELECT `id` FROM `bank_record_temp` LIMIT 1")) > 0){
    include './_navbar.php';
}
else{
     echo "<script>window.location.href='./fintabs.php'</script>";
}
?>
<style>
.loadbliss{
    position:absolute;
    top:0;
    left:0;
    z-index:1;
    opacity:0.6;
    background-color:white;
    height:100%;
    width:100%;
}
</style>
<div class="page-header">
    <h3 class="page-title ">Add Categories</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item"><a href="fintabs.php">Finance And Accounting</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Categories</li>
        </ol>
        </nav>
</div>
<div class="card">
    <div class="card-body">
        <div class="loadbliss" id="loadbliss" style="display:none;">

        </div>
        <div id="firstid"></div>
        <div id="lastid"></div>
        <div id="tablo">
        
        </div>
    </div>
</div>

<div class="modal fade" id="transuc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">              
      <div class="modal-body text-center"> 
			<i class=" mdi mdi-checkbox-marked-circle-outline text-success" style="font-size:125px;"></i>
        <h3 class="text-dark">Records Saved</h3>
      </div>
	  <div class="modal-footer">
		<a class="w-25 p-2 float-right text-center border border-success text-success proceed" id="done" data-dismiss="modal" >Close</a>
	  </div>
    </div>
  </div>
</div>

<?php  include './footer.html';?>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>

<script>

$('#done').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "../backend_files/select_categories.inc.php",
        data: {delete:'clear'}
    });
    window.location.href =='./fintabs.php';
});
    var p = 0;
    var month=0;
    var year = 0;
    $(document).ready(function (){
       $.ajax({
           type: "post",
           url: "../backend_files/select_categories.inc.php",
           data: {all:'all'},
           success: function (response) {
            //    alert(response);
               var data = JSON.parse(response);
               $('#tablo').html(data.tab);

            //    $('#firstid').html(data.p);
               p = data.p;
               month = data.month;
               year = data.year;
                $('#temptable').DataTable({
                    "paging":   false,
                    "info":     false,
                    'language':{
                    "search":"",
                    'searchPlaceholder':'Search Transaction'
                    }
                });
           }
       });
    });

    function changecategory(id){
        var selectedvalue = $('#sel_'+id).val();
        // alert(selectedvalue);

        if(selectedvalue == 'AMC'){
            $('#amc_sub_row_'+id).show();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();
        }
        if(selectedvalue == 'Salary'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).show();
        }
        if(selectedvalue == 'Maintenance_And_Repair'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).show();
            $('#salary_sub_row_'+id).hide();
        }
        if(selectedvalue == 'Infrastructure_Development'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).show();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();
        }
        if(selectedvalue == 'Miscellaneous'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).show();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();
        }
        if(selectedvalue == 'Electricity_Bill'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();            
        }
        if(selectedvalue == 'CIDCO_Water_Bill'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();            
        }
        if(selectedvalue == 'Water_Tanker'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();            
        }
        if(selectedvalue == 'Petty_Cash'){
            
            $('#amc_sub_row_'+id).hide();    
            $('#misc_sub_row_'+id).hide();
            $('#infra_sub_row_'+id).hide();
            $('#maintrep_sub_row_'+id).hide();
            $('#salary_sub_row_'+id).hide();            
        }
    }
    function save(){
        var j=0;
        var amcfine = true;
        var miscfine = true;
        var maintfine = true;
        var infrafine = true;
        var flag =0;
        var gotoid=0;
        var b = 0;

        for(var i=0;i<p;i++){
            if($('#sel_'+i).val() == 'null'){
                b++;
                $('#sel_'+i).css('border','2px solid red');
                amcfine = false;
                if(flag == 0){
                    gotoid = '#sel_'+i;
                    flag=1;
                }
            }else{
                b++;
                if($('#sel_'+i).val() == 'AMC' && (($('#amc_cat_'+i).val()).trim().length == 0)) {
                        $('#amc_cat_'+i).css('border','2px solid red');
                        amcfine = false;
                        if(flag == 0){
                            gotoid = '#sel_'+i;
                            flag=1;
                        }
                }else{
                        $('#amc_cat_'+i).css('border','1px solid lightgrey');                        
                }
                if($('#sel_'+i).val() == 'Miscellaneous' && (($('#misc_description_'+i).val()).trim().length == 0)) {
                    $('#misc_description_'+i).css('border','2px solid red');
                    miscfine = false;
                    if(flag == 0){
                        gotoid = '#sel_'+i;
                        flag=1;
                    }
                }else{
                        $('#misc_description_'+i).css('border','1px solid lightgrey');                        
                }
                if($('#sel_'+i).val() == 'Infrastructure_Development' && (($('#infra_description_'+i).val()).trim().length == 0)) {
                    $('#infra_description_'+i).css('border','2px solid red');
                        infrafine = false;
                        if(flag == 0){
                            gotoid = '#sel_'+i;
                            flag=1;
                        }
                }else{
                        $('#infra_description_'+i).css('border','1px solid lightgrey');                        
                }
                if($('#sel_'+i).val() == 'Salary' && (($('#salary_description_'+i).val()).trim().length == 0)) {
                    $('#salary_description_'+i).css('border','2px solid red');
                        maintfine = false;
                        if(flag == 0){
                            gotoid = '#sel_'+i;
                            flag=1;
                        }
                }else{
                        $('#maintandrep_description_'+i).css('border','1px solid lightgrey');                        
                    }
                if($('#sel_'+i).val() == 'Maintenance_And_Repair' && (($('#maintandrep_description_'+i).val()).trim().length == 0)) {
                    $('#maintandrep_description_'+i).css('border','2px solid red');
                        maintfine = false;
                        if(flag == 0){
                            gotoid = '#sel_'+i;
                            flag=1;
                        }
                }else{
                        $('#maintandrep_description_'+i).css('border','1px solid lightgrey');                        
                    }
                $('#sel_'+i).css('border','1px solid lightgrey');
            }
            // console.log(b);
        }
        if(amcfine == false || miscfine == false || maintfine == false || infrafine == false){
                // alert(gotoid);
                var el = $(gotoid);
                var elOffset = el.offset().top;
                var elHeight = el.height();
                var windowHeight = $(window).height();
                var offset;

                if (elHeight < windowHeight) {
                    offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
                }
                else {
                    offset = elOffset;
                }
                $('html, body').animate({
                    scrollTop: offset
                }, 1000);
        }
        if(amcfine == true && miscfine == true && maintfine == true && infrafine == true && b==p){

            $('#loadbliss').show();
            // alert('can save');  
            var last = p-1;         
            for(var i=0;i<p;i++){
                var selectedvalue = $('#sel_'+i).val();
                var descself='';
                var crdr = 'CR';
                if(selectedvalue == 'AMC'){
                    descself = $('#amc_cat_'+i).val();
                    crdr = 'DR';
                }
                if(selectedvalue == 'Miscellaneous'){
                    descself = $('#misc_description_'+i).val();
                    crdr = 'DR';
                }
                if(selectedvalue == 'Infrastructure_Development'){
                    descself = $('#infra_description_'+i).val();
                    crdr = 'DR';
                }
                if(selectedvalue == 'Maintenance_And_Repair'){
                    descself = $('#maintandrep_description_'+i).val();
                    crdr = 'DR';
                }
                if(selectedvalue == 'Salary'){
                    descself = $('#salary_description_'+i).val();
                    crdr = 'DR';
                }
                if(selectedvalue == 'Electricity_Bill' || selectedvalue == 'CIDCO_Water_Bill' || selectedvalue == 'Water_Tanker' || selectedvalue == 'Petty_Cash'){
                    descself = 'general';
                    crdr = 'DR';
                }
                console.log($('#desc_'+i).val()+'---'+
                $('#amount_'+i).val()+'---'+
                $('#date_'+i).val()+'---'+
                $('#sel_'+i).val()+'---'+
                descself+'---'+
                crdr+'---'+
                month+'---'+
                year+'---');
                $.ajax({
                    type: "post",
                    url: "../backend_files/select_categories.inc.php",
                    data: {
                        bank_description:$('#desc_'+i).val(),
                        amount:$('#amount_'+i).val(),
                        ddate:$('#date_'+i).val(),
                        dtype: $('#sel_'+i).val(),
                        subtype_or_desc:descself,
                        crdr:crdr,
                        month:month,
                        year:year,
                    }
                });
                
            if(last == i){
                    $('#transuc').modal('show');
                    $('#loadbliss').hide();
                    setTimeout(() => {
                        $.ajax({
                        type: "post",
                        url: "../backend_files/select_categories.inc.php",
                        data: {delete:'clear'}
                    });
                        window.location.href="./fintabs.php";
                    }, 2500);
            }
            }
        }
    }

</script>