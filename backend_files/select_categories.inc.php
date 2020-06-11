<?php

$strip = '';
$add = 0.0;
$flag = 0;
$more =array();
$tab = NULL;
$conn = mysqli_connect('localhost','root','','house');
if(isset($_POST['all'])){

    $sql = "SELECT * FROM `bank_record_temp` ORDER BY `id` ASC";
    $result = mysqli_query($conn,$sql);
    
    $p = 0;
    if(mysqli_num_rows($result) > 0){
    $tab .="
     <table class='table table-bordered' id = 'temptable'>
         <thead>
         <th>Bank Statement <span class='float-right'>Sort by Date</span></th>
         </thead>
         <tbody>
         ";
        while ($row = mysqli_fetch_array($result)) {

			if($flag==0){
				$more = explode('-',$row['month']);
				$flag=1;
				$month = $more[0];
				$year = $more[1];
			}

			   if($row['crdr']=='CR'){
					$strip = preg_replace('/[^a-zA-Z0-9\s.]/', '', $row['amount']);
					$add += floatval($strip);
						$tab .="
					<tr>
					<td>
						<div class='card-body' >
							<div class='row'>
								<div class='col-lg-6 col-12'>

									<p class='h5'><span><b>Date</b></span> : ".date('Y-m-d',strtotime($row['dato']))."</p><br>  
									<input type='hidden' value='".$row['dato']."' id='date_".$p."'>

									<p class='h5 text-wrap'><span><b>Description</b></span>  : ".$row['description']."</p><br>   
									<input type='hidden' value='".$row['description']."' id='desc_".$p."'>

									<p class='h5'><span><b>Amount</b></span> : ".$strip."</p><br>
									<input type='hidden' value='".$strip."' id='amount_".$p."'>

									<p style='color:#3AB809 ' class='h4'><b><i class='las la-check-circle'></i> Credited</b></p>

								</div>
								<div class='col-lg-6 col-12'>
									<div class='row'>
										<label for='sel_".$p."'  class='h5'>Select Category</label>
										<select class='form-control' id='sel_".$p."'>
											<option value='null'>Choose..</option>
											<option value='MMC'>MMC</option>
											<option value='Rent'>Rent</option>
											<option value='BankInterest'>Bank Interest</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</td>
					</tr>";
					}  
                    else{ 
                       
                $strip = preg_replace('/[^a-zA-Z0-9\s.]/', '', $row['amount']);
                $add += floatval($strip);
                      $tab .="
                      <tr>
                      <td>
                    <div class='card-body' >
                        <div class='row'>
							<div class='col-lg-6 col-12'>
							
									<p class='h5'><span><b>Date</b></span> : ".date('Y-m-d',strtotime($row['dato']))."</p><br>  
									<input type='hidden' value='".date('Y-m-d',strtotime($row['dato']))."' id='date_".$p."'>

									<p class='h5 text-wrap'><span><b>Description</b></span>  : ".$row['description']."</p><br>   
									<input type='hidden' value='".$row['description']."' id='desc_".$p."'>

									<p class='h5'><span><b>Amount</b></span> : ".$strip."</p><br>
									<input type='hidden' value='".$strip."' id='amount_".$p."'>

									<p style='color:red' class='h4'><b><i class='mdi mdi-minus-circle-outline'></i> Debited</b></p>

                            </div>
							<div class='col-lg-6 col-12'>
								<div class='row'>
									<label for='sel_".$p."'  class='h5 '>Select Category</label>
									<select class='form-control ' onchange='changecategory(".$p.")' id='sel_".$p."'>
										<option value='null'>Choose..</option>
										<option value='AMC'>AMC</option>
										<option value='Salary'>Salary</option>
										<option value='Electricity_Bill'>Electricity Bill</option>
										<option value='CIDCO_Water_Bill'>CIDCO Water Bill</option>
										<option value='Water_Tanker'>Water Tanker</option>
										<option value='Petty_Cash'>Petty Cash</option>
										<option value='Maintenance_And_Repair'>Maintenance & Repairs</option>
										<option value='Infrastructure_Development'>InfraStructure Development</option>
										<option value='Miscellaneous'>Miscellaneous</option>
									</select>
								</div>
								<br>
								<div class='row' id='amc_sub_row_".$p."' style='display:none;'>
									<label for='amc_cat_".$p."'  class='h5'>Select Sub-Category</label>
									<select class='form-control' id='amc_cat_".$p."'>
										<option selected value=''>Choose AMC type</option>";
										$cateresult = mysqli_query($conn,"SELECT * FROM `categories`");
										while($cati = mysqli_fetch_array($cateresult)){
											$tab.='<option value="'.$cati['category_name'].'" >'.$cati['category_name'].'</option>';
										}
									$tab.="</select>
								</div>
								<div class='row' id='misc_sub_row_".$p."' style='display:none;'>
									<label for='misc_description_".$p."' class='h5'>Add Description for Miscellaneous Expense</label>
									<input val='' id='misc_description_".$p."' type='text' class='form-control'>
								</div>
								<div class='row' id='salary_sub_row_".$p."' style='display:none;'>
									<label for='salary_description_".$p."' class='h5'>Add Description for Salary Expense</label>
									<input val='' id='salary_description_".$p."' type='text' class='form-control'>
								</div>
								<div class='row' id='infra_sub_row_".$p."' style='display:none;'>
									<label for='infra_description_".$p."' class='h5'>Add Description for Infrastructure Expense</label>
									<input val='' id='infra_description_".$p."' type='text' class='form-control'>
								</div>
								<div class='row' id='maintrep_sub_row_".$p."' style='display:none;'>
									<label for='maintandrep_description_".$p."' class='h5'>Add Description for Maintenance and Repair Expense</label>
									<input val='' id='maintandrep_description_".$p."' type='text' class='form-control'>
								</div>
                          	</div>
                          </div>
                        </div>
                      </td>
                      </tr>";
					}
					$p++;                 
                  }
                  $tab .= "
					</tbody>
						<tfoot>
							<td align='center'>
								<button class='btn-lg mb-2 mx-3 btn btn-primary' onclick='save()'>Save</button>
								<button class='btn-lg mb-2 mx-3 btn btn-danger'>Cancel</button>
								<h5>Press Save Once All Categories have been filled</h5>
							</td>
						</tfoot>
					</table>";
                  $new = array(
                      'tab'=>$tab,
                      'p'=>$p,
                      'year'=>$month,
                      'month'=>$year,
                    );
                    echo json_encode($new) ;
              }
			}
			

			if(isset($_POST['bank_description']))
			{
				$red = "INSERT INTO `finance_records`(`crdr`,`bank_description`, `amount`, `date`, `type`, `subtype_or_desc`, `month`, `year`) 
				VALUES ('".$_POST['crdr']."','".$_POST['bank_description']."','".$_POST['amount']."','".$_POST['ddate']."','".$_POST['dtype']."','".$_POST['subtype_or_desc']."','".$_POST['month']."','".$_POST['year']."')";
				$insertrecord = mysqli_query($conn,$red);
				if($insertrecord){
					echo 'JaiMahismati';
				}else{
					echo 'no mashismati';
				}
			}
			if(isset($_POST['delete'])){
				mysqli_query($conn,"TRUNCATE TABLE `bank_record_temp`");
			}
			if(isset($_POST['monthcheck'])){
				$result = mysqli_query($conn,"SELECT `month` FROM `finance_records` WHERE `month` = '".$_POST['monthcheck']."' and `year` = '".$_POST['yearcheck']."'");
				$row = mysqli_fetch_assoc($result);
				if(mysqli_num_rows($result)>0){
					echo 'datapresent';
				}
			}
