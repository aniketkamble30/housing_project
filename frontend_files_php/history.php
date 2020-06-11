<?php include './_navbar.php';?>

<style>
#tablleee td:hover{
  cursor:pointer;
}
#view_idproof,#view_otherdoc{
  width: 100%;
}
#iiddddii,#ddiiiidd{
  width: 100%;
  height: 73vh;
}
@media screen and (max-width:468px){
  img{
  width:75px;
  height:75px;
}
}
</style>
<div class="page-header">
<h2  style="color:teal;" class="mt-3">Records</h2><hr>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php" id="dashboardbox1">Homepage</a></li>
      <li class="breadcrumb-item active" aria-current="page">Records</li>
    </ol>
  </nav>
</div>


<div class="card">
    <div class="card-body">        
        <!-- write your code here -->
        <div class="container-fluid">

  <form id="get_history">
    <div class="form-group col-md-6">
      <label class="mr-sm-2" for="inlineFormCustomSelect">About</label>
      <select class="custom-select mr-sm-2" name="type">
        <option value="fow">Flat Owner</option>
        <option value="ft">Flat Tenant</option>
        <option value="em">Employees</option>
        <option value="sow">Shop Owners</option>
        <option value="st">Shop Tenant</option>
        <option value="com">Committee</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="get_details" class="form-control" value="get_details">
      <button type="submit" class="btn btn-primary">Get History</button>
    </div>
    
  </form>

    <button id='close_result' style='display:none;' class="btn btn-danger mb-3">Close</button>
    <p class="d-sm-block d-md-none">Scroll to view all details</p>
  <div id="result" style='margin:0px;display:none;' class="table-responsive border p-1 pr-3">
    <table class="table table-hover table-striped" id="tablleee">

    </table>
  </div>




<div class="modal " id="csvmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light" id="view_flat_no"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <?php 
              $seperator=",";
              $file_name='../CSVs/history/flat_owner.csv';
              $file=fopen($file_name,'r');
              $size=filesize($file_name);
              $row=fgetcsv($file,$size,$seperator);
            $r=0;
            echo'
            <div class="row pb-5">
            <div class="col-3">
              <img width="150px" onclick="shomod(0)" height="150px" id="mm72">
            </div>
            <div class="col-3">
              <img width="150px" onclick="shomod(1)" height="150px" id="mm73">
            </div>
            <div class="col-3">
              <img width="150px" onclick="shomod(2)" height="150px" id="mm80">
            </div>
            <div class="col-3">
                <form action="printflatrecord.php" method="post">
                <input type="hidden" name="rownum" value="" class="rownumtoprint">
                <button type="submit" class="btn btn-block btn-outline-info mt-3">Print</button>
                </form>
            </div>
          </div>
            ';
            for($i=0;$i<9;$i++){
              echo'<div class="row ">';
              if($i==8){
                for($j=0;$j<2;$j++){
                  echo'<div class="col-6">
                  <b>'.$row[$r].':</b><div class="d-inline p-1" id="n'.$i.''.$j.'"></div>                
                </div>'; 
                $r++;
              }
              }
              else{
                for($j=0;$j<4;$j++){
                  echo'<div class="col-6">
                  <b>'.$row[$r].':</b><div class="d-inline p-1" id="n'.$i.''.$j.'"></div>                
                </div>'; 
                $r++;
              }
              }
              echo'</div><hr>';
            }
          ?>
      </div>
            
      <!-- Modal footer -->
      <div class="modal-footer bg-secondary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- --------------------------------------------------------------------------------------------------------- -->

<div class="modal " id="empmodal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light" id="view_flat_no"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

      <div class="row">
          <div class="col">
          <b>Employee's picture :&nbsp;&nbsp;</b><div class="d-inline " id="emp9"></div><hr>
          </div>
          </div>
          
          <?php
            $seperator=",";
            $file_name='../CSVs/history/employee.csv';
            $file=fopen($file_name,'r');
            $size=filesize($file_name);
            $row=fgetcsv($file,$size,$seperator);
            $r=1;
            for($i=1;$i<=5;$i++){
              echo'<div class="row">';
                for($j=1;$j<=2;$j++){
                  if($r==9){
                    break;
                  }
                  elseif($r==6){
                    continue;
                  }
                  echo'<div class="col-6">
                  <b>'.$row[$r].':</b><div class="d-inline p-1" id="emp'.$r.'"></div>                
                </div>'; 
                $r++;
              }
              echo '</div>';
              }
              echo '<div class="row"><div class="col-6"> <b>'.$row[6].':</b><div class="d-inline p-1" id="emp6"></div>
              </div><div class="col-6"> <b>'.$row[12].':</b><div class="d-inline p-1" id="emp12"></div>
              </div></div>'
          ?>
      </div>
            
      <!-- Modal footer -->
      <div class="modal-footer bg-green">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<div class="modal " id="view_idproof">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light" id="view_flat_no">Id Proof</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <embed src="" type="application/pdf" id="iiddddii">
      </div>
            
      <!-- Modal footer -->
      <div class="modal-footer bg-green">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal " id="view_otherdoc">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light" id="view_flat_no">Document</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div id="ddiiiid"></div>
      <embed src="" type="application/pdf" id="ddiiiidd">
      </div>
            
      <!-- Modal footer -->
      <div class="modal-footer bg-green">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>




<!-- --------------------------------------------------------------------------------------------------------- -->

<div class="modal " id="csvtenantmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light" id="view_tenant_no"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <?php 
              $seperator=",";
              $file_name='history/flat_tenant.csv';
              $file=fopen($file_name,'r');
              $size=filesize($file_name);
              $row=fgetcsv($file,$size,$seperator);
            $r=0;
            echo'
            <div class="row pb-5">
            <div class="col-3">
              <img width="150px" onclick="shomod(0)" height="150px" id="tt34">
            </div>
            <div class="col-3">
                <form action="printflatrecord.php" method="post">
                <input type="hidden" name="trownum" value="" class="trownumtoprint">
                <button type="submit" class="btn btn-block btn-outline-info mt-3">Print</button>
                </form>
            </div>
          </div>
            ';
            for($i=0;$i<11;$i++){
              echo'<div class="row ">';
                  echo'<div class="col-6">
                  <b>'.$row[$r].':</b><div class="d-inline p-1" id="t'.$i.'"></div>                
                </div>'; 
                $r++;
              echo'</div><hr>';
            }
          ?>
      </div>
            
      <!-- Modal footer -->
      <div class="modal-footer bg-secondary">
      <button class="btn btn-info ">Print</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body text-center">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  <div class="d-md-none d-lg-block" style="height:100px"></div>
        <img class="img-thumbnail shadow" id="imagemodal0" style="display:none;width:100%;height:100%" alt="">
        <img class="img-thumbnail shadow" id="imagemodal1" style="display:none;width:100%;height:100%" alt="">
        <img class="img-thumbnail shadow" id="imagemodal2" style="display:none;width:100%;height:100%" alt="">
		<div class="d-md-none d-lg-block" style="height:100px"></div>
      </div>
    </div>
  </div>
</div>
    
<div class="modal " id="shopmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
      <h4 class="modal-title text-light" id="so0"></h4>
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col">
              <b>Bussiness Name:&nbsp;&nbsp;</b><div class="d-inline " id="so2"></div>
            </div>
            <div class="col">
              <b>Type of Ownership:&nbsp;&nbsp;</b><div class="d-inline " id="so1"></div>
            </div>
          </div>
          <hr>
          <div class="row m-2"><h4><u>Owner 1:</u></h4></div>

          <div class="row">
            <div class="col">
              <b>Name:&nbsp;&nbsp;</b><div class="d-inline " id="so3"></div>
            </div>
            <div class="col">
              <b>Date of birth:&nbsp;&nbsp;</b><div class="d-inline " id="so6"></div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Email:&nbsp;&nbsp;</b><div class="d-inline " id="so4"></div>
            </div>
            <div class="col">
              <b>Mobile:&nbsp;&nbsp;</b><div class="d-inline " id="so5"></div>
            </div>
          </div>
          <hr>
          <br>
          <div class="row">
            <div class="col">
              <b>Owner 1:&nbsp;&nbsp;</b><div class="d-inline " id="so12"></div>
            </div>
            <div class="o2img">
            <div class="col">
              <b>Owner 2:&nbsp;&nbsp;</b><div class="d-inline " id="so13"></div>
            </div>
            </div>
          </div>
          <hr>
          <div class="owner2">
          <div class="row m-2"><h4><u>Owner 2:</u></h4></div>
          <div class="row">
            <div class="col">
              <b>Name:&nbsp;&nbsp;</b><div class="d-inline " id="so7"></div>
            </div>
            <div class="col">
              <b>Date of Birth:&nbsp;&nbsp;</b><div class="d-inline " id="so10"></div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <b>Email:&nbsp;&nbsp;</b><div class="d-inline " id="so8"></div>
            </div>
            <div class="col">
              <b>Mobile:&nbsp;&nbsp;</b><div class="d-inline " id="so9"></div>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col">
              <b>purchased on:&nbsp;&nbsp;</b><div class="d-inline " id="so11"></div>
            </div>
            <div class="col">
              <b>Out date:&nbsp;&nbsp;</b><div class="d-inline " id="so14"></div>
            </div>
          </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div>
</div> 


    </div>
</div>



<div class="modal " id="shoptenantmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light" id="view_shoptenant_no"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <?php 
              $seperator=",";
              $file_name='../CSVs/history/shop_tenant.csv';
              $file=fopen($file_name,'r');
              $size=filesize($file_name);
              $row=fgetcsv($file,$size,$seperator);
            $r=0;
            echo'
            <div class="row pb-5">
            <div class="col-3">
              <img width="150px" onclick="shomod(0)" height="150px" id="stt34">
            </div>
            <div class="col-3">
                <form action="printshoptenantrecord.php" method="post">
                <input type="hidden" name="strownum" value="" class="strownumtoprint">
                <button type="submit" class="btn btn-block btn-outline-info mt-3">Print</button>
                </form>
            </div>
          </div>
            ';
            for($i=0;$i<8;$i++){
              echo'<div class="row ">';
                  echo'<div class="col-6">
                  <b>'.$row[$r].':</b><div class="d-inline p-1" id="st'.$i.'"></div>                
                </div>'; 
                $r++;
              echo'</div><hr>';
            }
          ?>
      </div>
            
      <!-- Modal footer -->
      <div class="modal-footer bg-secondary">
      <button class="btn btn-info ">Print</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>










<?php  include './footer.html';?>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.18/af-2.3.3/b-1.5.6/b-html5-1.5.6/r-2.2.2/datatables.min.js"></script>
 
  <script>
    $('#get_history').on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url:'../backend_files/history.inc.php',
        data: $('#get_history').serialize(),
        success: function(data, status){
           
          $('table').html(data);
          $('#tablleee').DataTable();
          $('#close_result').show();
          $('#get_history').hide();
          $('#result').show();
        } 
      });
    });

    function shomod(num){
           if(num == 0){$('#imagemodal1').hide();$('#imagemodal2').hide();$('#imagemodal0').show();$('#imagemodal').modal('show');}
      else if(num == 1){$('#imagemodal0').hide();$('#imagemodal2').hide();$('#imagemodal1').show();$('#imagemodal').modal('show');}
      else if(num == 2){$('#imagemodal0').hide();$('#imagemodal1').hide();$('#imagemodal2').show();$('#imagemodal').modal('show');}
    }

    function alldetails(rownum,typo){
      $.ajax({
        type: 'POST',
        url:'../backend_files/history.inc.php',
        data: {rownum:rownum,
              typo:typo },
        success:function(data,status){
      $('.rownumtoprint').val(rownum);
          var ss=JSON.parse(data);
          console.log($('.rownumtoprint').val());
        //  $.each( ss , function( i, l ){           
        //   console.log( i+":"+ l );
        // });
        $('#view_flat_no').text(ss[0]);
        var m=0;
        for (var i = 0; i < 9; i++) {
          for (var j = 0; j < 4; j++) {
            var id ='#n'+i+j;
              var path = "../DB_docs_images/flat_owner"+ss[0]+"/"+ss[m];
            if(m == 30){ $('#mm72').attr("src", path); $('#imagemodal0').attr("src", path);}
            else if(m==31){ $('#mm73').attr("src", path); $('#imagemodal1').attr("src", path);}
            else if(m==32){ $('#mm80').attr("src", path); $('#imagemodal2').attr("src", path);}
            else{
            $(id).text(ss[m]);
            }
            m++;
          }
          }
      $('#csvmodal').modal('show');
        }
      });
    }

//-------------------------------------------------------------------------------------------------------
function empinfo(empid){
      $.ajax({
        type: 'POST',
        url:'../backend_files/history.inc.php',
        data: {empid:empid},
        success:function(data,status){
           
          var ee=JSON.parse(data);

          for(var i=1;i<=9;i++){
            var id = "#emp"+i
            console.log(id);
            $(id).text(ee[i]);
          }
            $('#emp12').text(ee[12]);
            $('#emp9').html('<center><img src="../DB_docs_images/employee/emp_image/'+ee[9]+'" width="200px" height="200px"></center>');

          $('#empmodal').modal('show');
        }

      });
}

function idproof(pp){
  var path='../DB_docs_images/employee/id_proof/'+pp ;
  console.log(path);
  $('#iiddddii').attr("src",path);
  $('#view_idproof').modal('show');
}

function otherdoc(pp){
  if(pp){
  var path='../DB_docs_images/employee/other_doc/'+pp ;
  console.log(path);
  $('#ddiiiidd').attr("src",path);
  $('#view_otherdoc').modal('show');
  }
  else{
    $('#ddiiiid').html("<center><b><p style='font-size:30px; padding-top:50px; color:red'> No File submitted </p></b></center>");
    $('#view_otherdoc').modal('show');
  }
}


//-------------------------------------------------------------------------------------------------------------

    function alltenantdetails(trownum,ttypo){
      $('#csvtenantmodal').modal('show')
      $.ajax({
        type: 'POST',
        url:'../backend_files/history.inc.php',
        data: {trownum:trownum,
              ttypo:ttypo },
        success:function(data,status){
      $('.trownumtoprint').val(trownum);
          var kk=JSON.parse(data);
          console.log($('.trownumtoprint').val());
        $('#view_tenant_no').text(kk[0]);
        var m=0;
        for (var i = 0; i < 13; i++) {
            var id ='#t'+i;
            if(m == 11){var path = "../DB_docs_images/flat_tenant/"+kk[0]+"/"+kk[m];}
            if(m == 11){ $('#tt34').attr("src", path); $('#imagemodal0').attr("src", path);}
            else{
            $(id).text(kk[m]);
            }
            m++;
          }
      $('#csvtenantmodal').modal('show');
        }
      });
    }

    function getshopownerhistory(shop_no){
      $('#shopmodal').modal('show');
      $.ajax({
        type: 'POST',
        url:'../backend_files/history.inc.php',
        data: {shop_no:shop_no},
        success:function(data,status){
          var ll=JSON.parse(data);
          if(ll[1]=="joint"){
            $('.owner2').show();
            $('.o2img').show();
          }
          else if(ll[1]=="single"){
            $('.owner2').hide();
            $('.o2img').hide();
          }
          for(var i=0;i<=12;i++){
            var yydd="#so"+i;
            $(yydd).text(ll[i]);
          }
          $('#so14').text(ll[14]);
          $('#so12').html('<center><img src="../DB_docs_images/shop_owner/'+ll[0]+'/'+ll[12]+'" width="200px" height="200px"></center>');
          $('#so13').html('<center><img src="../DB_docs_images/shop_owner/'+ll[0]+'/'+ll[13]+'" width="200px" height="200px"></center>');

        }
      });
    }

    $('#close_result').click(function(){
      $('#result').hide();
      $('#close_result').toggle();
      $('#get_history').show();
    });
    $("#menu-toggle").click(function(e) {
       e.preventDefault();
       $("#wrapper").toggleClass("toggled");
     });
     $('.container-fluid').click(function() {
   $('#wrapper').removeClass("toggled");
});

function shoptenantdetails(strownum,sttypo){
      $('#shoptenantmodal').modal('show')
      $.ajax({
        type: 'POST',
        url:'../backend_files/history.inc.php',
        data: {strownum:strownum,
              sttypo:sttypo },
        success:function(data,status){
      $('.strownumtoprint').val(strownum);
      console.log(data);
          var kk=JSON.parse(data);
          console.log($('.strownumtoprint').val());
        $('#view_shoptenant_no').text(kk[0]);
        var m=0;
        for (var i = 0; i < 8; i++) {
            var id ='#st'+i;
            if(m == 5){var path = "../DB_docs_images/shop_tenant/"+kk[0]+"/"+kk[m];}
            if(m == 5){ $('#stt34').attr("src", path); $('#imagemodal0').attr("src", path);}
            else{
            $(id).text(kk[m]);
            }
            m++;
          }
      $('#shoptenantmodal').modal('show');
        }
      });
    }


  </script>
