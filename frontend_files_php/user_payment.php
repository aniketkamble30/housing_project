<?php
session_start();
if($_SESSION['role']=='resident')
	include './_navbar_resident.php';
else if($_SESSION['role']=='shop')
	include './_navbar_shop.php';
?>
<style>
.proceed:hover{
    cursor:pointer;
}
 @media screen and (max-width: 480px) {
.fltbtn{
		margin-top:400px;
		margin-left:0px;
	}
}
</style><div class="page-header">
    <h3 class="page-title ">Payment Intimation </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
				<li class="breadcrumb-item "><a href="resident.php">Homepage</a></li>
				<!-- <li class="breadcrumb-item "><a href="fintabs.php">Accounting</a></li> -->
			<li class="breadcrumb-item active">Add Resident Payment Intimation</li>
        </ol>
        </nav>
</div>
<div class="stretch-card pt-3">
    <div class="card">
        <div class="card-body">

	<p class="small text-center" id="rep"style="color:red;display:none;">Enter Valid Flat/Shop Number.</p>
	<hr class="bg-secondary">	
	<div class=" ftdet m-1">
	</div>		
	
</div>
</div>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">              
      <div class="modal-body "> 
        <h4> You are making payment for following Quarters : </h4>
        <div id="show"></div>
        
      </div>
      <div class="modal-footer d-flex">
		<a class="w-25 p-2 float-right text-center bg-success text-white proceed" onclick="handlenquarterpay()" >Procced</a>
		<a class="w-25 p-2 float-right text-center text-success proceed" id="" data-dismiss="modal" >Cancel</a>  
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="transuc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">              
      <div class="modal-body text-center"> 
			<i class=" mdi mdi-checkbox-marked-circle-outline text-success" style="font-size:125px;"></i>
        <h3 class="text-dark">Intimation Successful</h3>
      </div>
	  <div class="modal-footer">
		<a class="w-25 p-2 float-right text-center border border-success text-success proceed" id="okay" data-dismiss="modal" >Close</a>
	  </div>
    </div>
  </div>
</div>

<?php include './footer.html' ?>
<script>

	var flat_no='<?php echo $_SESSION['username'];?>';
	var amount=0;
	var next_quarter='';
	var payquarts=null;
	var duesquarts=null;
	var confirm_text=null;


	$(document).ready(function(){
		$.ajax({
			url:'../backend_files/adminpayresi.inc.php',
			type:'post',
			data:{flat_no: flat_no, get: 'get' , isresident: 1},
			success: function(data){
				alert(data);
				var response = JSON.parse(data);
				$('.ftdet').html(response.due_noti);
			}
		});
	})

	$('#abc').click(function(){
		$('#transuc').modal('show');
	});

	

	function pay(){
		
		var type =  $('#duedrop').val();
		var modeofpayment=$('#modeofpayment').val();
		var transaction_id=$('#transaction_id').val();
		var transaction_date=$('#transaction_date').val();
		if($('#duedrop').val() != 'duesn' && $('#noq').val()<=0){   
			$.ajax({
				url:'../backend_files/adminpayresi.inc.php',
				type:'post',
				data:{
				type: type, flat_no: flat_no, normalpay: 'normalpay', 
				amount: amount, modeofpayment: modeofpayment,
				transaction_id: transaction_id, transaction_date: transaction_date
				},
				success:function(data){
				console.log(data);
				}
			});
      	}
		else{   
			var noq=$('#noq').val();
			$.ajax({
				url:'../backend_files/adminpayresi.inc.php',
				type:'post',
				data:{type: type, noq: noq, flat_no: flat_no, nquarterpay: 'nquarterpay', amount: amount},
				success:function(data){
					var res= JSON.parse(data);          
					payquarts=res.payquarts;
					duesquarts=res.duesquarts;
					next_quarter=res.next_quarter;
					$('#show').html(res.confirm_text);
					$('#confirm').modal('show');
				}
			});
		}
	}

	function changeduepaytype(){

		if($('#duedrop').val()=='duesn'){
			$('#noqdiv').show();
		}
		else{
			$('#noqdiv').hide();
		}

		finddueamt();
	}
	function modechange(){
		if($('#modeofpayment').val()=='cheque')
			$('#chequebox').show();
		else
			$('#chequebox').hide();
	}	

	function finddueamt(){
		var type=$('#duedrop').val();
		// console.log('front');
		if(type!='duesn'){
			$.ajax({
                url:'../backend_files/adminpayresi.inc.php',
                type:'post',
                data:{getamount: 'getamount', type: type, flat_no: flat_no},
                success:function(data){
					amount=data;
					$('#vachi0').val(data);
				}
            });
		}
		else{
			var noq=$('#noq').val();
			if(noq>0){
				$.ajax({
					url:'../backend_files/adminpayresi.inc.php',
					type:'post',
					data:{getamount: 'getamount', type: type, noq: noq, flat_no: flat_no},
					success:function(data){
						amount=data;
						$('#vachi0').val(data);
					}
				});
			}
		}
	}

	function handlenquarterpay(){
		var type =  $('#duedrop').val();
		var modeofpayment=$('#modeofpayment').val();
		var transaction_id=$('#transaction_id').val();
		var transaction_date=$('#transaction_date').val();
		$.ajax({
            url:'../backend_files/adminpayresi.inc.php',
            type:'post',
            data:{
              pay: 'pay', flat_no: flat_no, paytype: type, duesquarts: duesquarts, 
              payquarts: payquarts, amount: amount, next_quarter: next_quarter,
              modeofpayment: modeofpayment, transaction_id: transaction_id, transaction_date: transaction_date
            },
            success:function(data){
				$('#show').html('null');
              	$('#confirm').modal('hide');
			}
     	});
	}
		
</script>
</body>
</html>