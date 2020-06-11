<?php
            if($row['isdue']==1){

                $due_noti='
                    <div class="border border-secondary rounded p-2">
                    <div class="col-12" style="color:red;">
                    <p class="alert alert-danger text-danger">
                    <i class="mdi mdi-exclamation" style="font-size:20px"></i>'.$flat_no.' has missed the following payments</p>
                    </div>
                    <h5 class="ml-5">Due Date : '.date('d-m-Y',strtotime($row['due_date'])).'</h5>
                    <div class="col-12"><ul>';
            }
            else{
                $due_noti='
                    <div class="border border-secondary rounded p-2">
                    <div class="col-12" style="color:white;">
                    <p class="alert alert-success text-success">
          
                    <i class="mdi mdi-exclamation" style="font-size:20px"></i>'.$flat_no.' has no dues<br>&nbsp;&nbsp;&nbsp;&nbsp;Next Due Date is : '.date('d-m-Y',strtotime($row['due_date'])).'(Quarter '.$due_date_q.' of '.$due_date_year.')</p>

                    </div>
                    <div class="col-12"><ul>';
            }

            for($i=0; $i<$num_quarters; $i++){
                if($due_date_q==1){
                    $due_noti.='<li>Quarter 1(Apr,May,Jun) of  '.$due_date_year.'-'.substr(($due_date_year+1),2,2).'</li>';               
                }
                else if($due_date_q==2){
                    $due_noti.='<li>Quarter 2(Jul,Aug,Sept) of  '.$due_date_year.'-'.substr(($due_date_year+1),2,2).'</li>';               
                }
                else if($due_date_q==3){
                    $due_noti.='<li>Quarter 3(Oct,Nov,Dec) of  '.$due_date_year.'-'.substr(($due_date_year+1),2,2).'</li>';               
                }
                else{
                    
                    $due_noti.='<li>Quarter 4(Jan,Feb,Mar) of  '.$due_date_year.'-'.substr(($due_date_year+1),2,2).'</li>';               
                }
                
                if($due_date_q==4){
                    $due_date_q=1;
                    $due_date_year++;
                }
                else{
                    $due_date_q++;
                }

            }
            $due_noti.= '
                <br>
                <h5 class="m-1 text-primary">Maintenance Details</h5> 
                <table class="table table-bordered table-hover" style="background-color:rgba(129,129,129,0.1);width:100%">
                <tr><td width="70%">Flat Dimensions : </td><td> '.$flat_dimensions.'Sq.ft.</td></tr>                                                    
                <tr><td width="70%">Maintenance Per Month : </td><td>₹ '.($maintenancepm).'</td></tr>
                <tr><td width="70%">Maintenance Per Sq.Ft per Month:</td><td>'.$maintpersqft.'</td></tr>
                </table> ';
        $due_noti.= '
            <h5 class="m-1 text-primary">Payment Options (Inclusive of Interest)</h5>';
            if($row['isdue']){

                $due_noti.='<table class="table table-bordered table-hover" style="background-color:#eee;width:100%">
                    <tr><td width="70%">'.$num_quarters.' - Pending Dues  </td><td>₹ '.round($dues,2).'/-</td></tr>';
                $due_noti.='<tr><td width="70%">Pending (Dues + Current Quarter ) </td><td>₹ '.round($duesquarter,2).'/-</td></tr>';
                $due_noti.='<tr><td width="70%">Payfor Current Year (Dues + Current Year) </td><td>₹ '.round($duesyear,2).'/-</td></tr>
                </table>';
            }
            else{
                $due_noti.='<table class="table table-bordered table-hover" style="background-color:#eee;width:100%">';
                $due_noti.='<tr><td width="70%">Pay for Current Quarter</td><td>₹ '.round($quarter,2).'/-</td></tr>';
                 $due_noti.='<tr><td width="70%">Pay for Current Year </td><td>₹ '.round($year,2).'/-</td></tr>
                </table>';
            }
                $due_noti.='<hr>
            <p class="m-1" style="color:#666">Applicable Interest<sub>(per annum)</sub>= x%</p><hr>
            </div>
            </div>
    
                <hr>
                <div class="row mt-4" id="gg">
                            <div class="form-group col-12 col-lg-5">
                                        <label>Pay for:</label>
                                        <select class="custom-select" onchange="changeduepaytype()" name="duedrop" id="duedrop">
                                            <option value="">Select</option>';
                                    if($row['isdue']==1){

                                        $due_noti.='<option value="dues">Dues</option>';
                                        $due_noti.='<option value="duesq">Dues + Current Quarter '.$current_q.'</option>';
            
        
                                        $due_noti.='    <option value="duesy">Dues + Current Year  '.(date('Y')).'-'.(date('y')+1).'</option>';
                                        $due_noti.='    <option value="duesn">Dues + Further Quarters</option>
                                                    </select>';
                                        
                                    }
                                    else{
                                        $due_noti.='<option value="duesq">Current Quarter '.$current_q.'</option>';
                                        
                                        
                                        $due_noti.='    <option value="duesy">Current Year  '.(date('Y')).'-'.(date('y')+1).'</option>';
                                        $due_noti.='    <option value="duesn">Further Quarters</option></select>';
                                    }
                                    $due_noti.='</div><div class="form-group col-12 col-lg-5" id="noqdiv" style="display:none;">
                                        <label>Enter the No. of quarters:</label>
                                        <input type="number" onkeyup="finddueamt()" min="1" class="form-control" id="noq" max="30" name="noq">
                                    </div>
                                    
                       </div>
  
                       <hr>
                       <div class="row">
                            <div class="form-group col-12 col-lg-4">
                                <label>Amount</label>
                                <input type="number" disabled name="amount" id="vachi0" step="0.01" class="form-control"  >
                            </div>';

                                $due_noti.='<div class="form-group col-12 col-lg-4">                            
                                    <label for="modeofpayment">Mode Of Payment</label>
                                    <select  class="custom-select mainttype" onchange="modechange()" id="modeofpayment" name="modeofpayment">';
                                    if(isset($isresident)){
                                        $due_noti.='<option value="online">Online Transfer</option>';
                                    }
                                    else{
                                        $due_noti.='<option value="">Select</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="cash">Cash</option>';
                                    }
                                    $due_noti.='</select>
                                </div>
                            </div>
                            <hr>';
                            
                    if(isset($isresident)){
                        $due_noti.='<div class="row" id="onlinebox">
                            <div class="form-group col-12 col-lg-4">
                                <label>Transaction Id</label>
                                <input type="number" name="transaction_id" id="transaction_id" class="form-control"  >
                            </div>
        
                            <div class="form-group col-12 col-lg-4">
                                <label>Transaction Date</label>
                                <input type="date" name="transaction_date" id="transaction_date" class="form-control"  >
                            </div>
                        </div>';
                    }
                    else{

                        $due_noti.='<div class="row" id="chequebox" style="display:none;">
                         <div class="form-group col-12 col-lg-4">
                         <label>Cheque number</label>
                         <input type="number" name="chequeno" id="chequeno" class="form-control"  >
                         </div>
     
                         <div class="form-group col-12 col-lg-4">
                         <label>Cheque Date</label>
                         <input type="date" name="cheque_date" id="cheque_date" class="form-control"  >
                         </div>
     
                         <div class="form-group col-12 col-lg-4">
                         <label>Bank Name</label>
                         <input type="text" name="bank_name" id="bank_name" class="form-control"  >
                         </div>
                         </div>';
                    }
                    $due_noti.='<div><button class="btn btn-success btn-lg" onclick="pay()">Submit</button></div>
                    </div>';
?>