<?php
    extract($_POST);
    $conn = mysqli_connect( 'localhost','root',"",'house' );
    if(isset($_POST['get'])){
        include '../frontend_files_php/current_quarter.php';

        $sql="SELECT * from due WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);   

        $due_noti='';

        $due_date=$row['due_date'];
        $due_date_year=substr($due_date,0,4);
        $days_due=$row['days_due'];
        // $maitenanceperm=330;
        include '../frontend_files_php/due_date_quarter.php';
        
        if($row['status']=='pending'){
            $due_noti.='<h3 class="alert alert-success">Your Payment is marked pending by admin, please wait for admin\'s approval</h3>';
            exit();
        }
        
        if($row['isdue']==1){

            if($due_date_q==4){
                $num_quarters=intdiv($row['days_due']+2,91)+1;  
            }
            else
                $num_quarters=intdiv($row['days_due'],91)+1;    
        }
        else{
            $num_quarters=0;
        }

        if(substr($flat_no,0,1)=='S'){
            $usertype='shop';
        }
        else{
            $usertype='resident';
        }
        include '../frontend_files_php/get_all_maintenance.php';
        include './due_noti_helper.inc.php';

        $ref = array('due_noti'=> $due_noti);
        echo json_encode($ref);
    }
       
    
    if(isset($_POST['normalpay'])){
    
        include '../frontend_files_php/current_quarter.php';
     
        $sql="SELECT * from due WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);   

  
        $due_date=$row['due_date'];
        $due_date_year=substr($due_date,0,4);
        include '../frontend_files_php/due_date_quarter.php';
        $due_noti='';
        if($row['isdue']==1){

            if($due_date_q==4){
                $num_quarters=intdiv($row['days_due']+2,91)+1;  
            }
            else
                $num_quarters=intdiv($row['days_due'],91)+1;  
        }
        else{
            $num_quarters=0;
        }
   
    
        $due_date_year=substr($due_date,0,4);

        
        $dues_noti="";
        $duesquarts="";
        
        
        $dues_noti.="Dues are\n";
        
        for($i=0; $i<$num_quarters; $i++){
            $duesquarts.=$due_date_q."-".$due_date_year.",";
            $dues_noti.=$due_date_q."-".$due_date_year."\n";
            if($due_date_q==4){
                $due_date_q=1;
                $due_date_year++;
            }
            else{
                $due_date_q++;
            }

        }

        
        if($type=="dues"){ 

            $next_quarter=$due_date_q."-".$due_date_year;
            $payquarts=",";

        }
        else if($type=="duesq"){
            $pay_noti="";
            $payquarts="";
    
            $pay_noti.="Pay are\n";

            for($i=0; $i<1; $i++){
                $payquarts.=$due_date_q."-".$due_date_year.",";
                $pay_noti.=$due_date_q."-".$due_date_year."\n";
                if($due_date_q==4){
                    $due_date_q=1;
                    $due_date_year++;
                }
                else{
                    $due_date_q++;
                }
    
            }

            $next_quarter=$due_date_q."-".$due_date_year;

        }
        else if($type=="duesy"){
            $pay_noti="";
            $payquarts="";
    
            $pay_noti.="Pay are\n";
            $d=$due_date_q;
            // echo $d." ";
            for($i=$d; $i<=4; $i++){

                $payquarts.=$due_date_q."-".$due_date_year.",";
                $pay_noti.=$due_date_q."-".$due_date_year."\n";
                if($due_date_q==4){
                    $due_date_q=1;
                    $due_date_year++;
                }
                else{
                    $due_date_q++;
                }
    
            }

            $next_quarter=$due_date_q."-".$due_date_year;
        }
        $response=array();
        if($row['isdue']!=1){
            $type=substr($type,-1);
            echo $type;
        }
        if($modeofpayment=='cash'){
            $sql="INSERT INTO admin_accounts (flat_no,duesquarts,paytype,payquarts,amount,mode_of_payment,next_quarter,approved) VALUES('$flat_no','$duesquarts','$type','$payquarts','$amount','cash','$next_quarter','no')";
        }
        else if($modeofpayment=='cheque'){
            $sql="INSERT INTO admin_accounts (flat_no,duesquarts,paytype,payquarts,amount,mode_of_payment,next_quarter,approved,chequeno,cheque_date,bank_name) VALUES('$flat_no','$duesquarts','$type','$payquarts','$amount','cheque','$next_quarter','no','$chequeno','$cheque_date','$bank_name')";
        }
        else if($modeofpayment=='online'){
            $sql="INSERT INTO admin_accounts (flat_no,duesquarts,paytype,payquarts,amount,mode_of_payment,next_quarter,approved,transaction_id,transaction_date) VALUES('$flat_no','$duesquarts','$type','$payquarts','$amount','online','$next_quarter','no','$transaction_id','$transaction_date')";
        }

        if(mysqli_query($conn,$sql)){
            echo 'success';
        }
        else{
            echo "unsuccess";
        }
    }

    if(isset($_POST['nquarterpay'])){
        include '../frontend_files_php/current_quarter.php';
        $sql="SELECT * from due WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);   

        $due_date=$row['due_date'];
        $due_date_year=substr($due_date,0,4);
        include '../frontend_files_php/due_date_quarter.php';
        $due_noti='';

        if($row['isdue']==1){

            if($due_date_q==4){
                $num_quarters=intdiv($row['days_due']+2,91)+1;  
            }
            else
                $num_quarters=intdiv($row['days_due'],91)+1;  
        }
        else{
            $num_quarters=0;
        }
        

        $due_date_year=substr($due_date,0,4);

        
        $dues_noti="";
        $duesquarts="";
        $dues_noti.="Dues are\n";
        $str="";
        $flag=0;
        // echo $noq;
        if($noq == 1){$str.="";}
        else if($noq == 2){$str .= ' <p class="h5 text-primary p-2">Applicable Rebate : '.(2).'%</p> ';}
        else if($noq == 3){$str .= ' <p class="h5 text-primary p-2">Applicable Rebate : '.(3).'%</p> ';}
        else if($noq >= 4){$str .= ' <p class="h5 text-primary p-2">Applicable Rebate : '.(4).'%</p> ';}   

        $str.="<table class='table table-bordered'>";
        for($i=0; $i<$num_quarters; $i++){
            if($flag==0)
            {

                $str.='<tr style="background-color:rgba(129,129,129,0.3);"><td>Financial Year '.$due_date_year.'-'.($due_date_year+1).'</td><td>';
                $str.='<li>Quarter '.$due_date_q.' of '.$due_date_year.'-'.($due_date_year+1).'</li>';
            }
            else{
                $str.='<li>Quarter '.$due_date_q.' of '.$due_date_year.'-'.($due_date_year+1).'</li>'; 
            }
            $duesquarts.=$due_date_q."-".$due_date_year.",";
            $dues_noti.=$due_date_q."-".$due_date_year."\n";
            if($due_date_q==4){
                $due_date_q=1;
                $due_date_year++;
                $flag=0;
                $str.='</td></tr>';
            }
            else{
                $due_date_q++;
                $flag=1;
            }

        }

        // echo $dues_noti."\n"; 
        $pay_noti="";
        $payquarts="";

        $pay_noti.="Pay are\n";
        $flag=0;
        for($i=0; $i<$noq; $i++){
            if($flag==0){

                $str.="<tr><td>Financial Year ".$due_date_year."-".($due_date_year+1)."</td><td>";
                $str.='<li>Quarter '.$due_date_q.' of '.$due_date_year.'-'.($due_date_year+1).'</li>';
            }
            else{
                $str.='<li>Quarter '.$due_date_q.' of '.$due_date_year.'-'.($due_date_year+1).'</li>'; 
            }
            $payquarts.=$due_date_q."-".$due_date_year.",";
            $pay_noti.=$due_date_q."-".$due_date_year."\n";
            if($due_date_q==4){
                $due_date_q=1;
                $due_date_year++;
                $flag=0;
                $str.='</td></tr>';
            }
            else{
                $due_date_q++;
                $flag=1;
            }

        }

        $next_quarter=$due_date_q."-".$due_date_year;
  

        $str.=" <tr><td align='right'><b>Total Amount to be Paid : </b></td>
            <td><b>Rs. ".number_format($amount,2)."</b></td></tr>
            </table>";
 
        $response['duesquarts']=$duesquarts;
        $response['payquarts']=$payquarts;
        $response['amount']=$amount;
        $response['next_quarter']=$next_quarter;
        $response['confirm_text']=$str;

        echo json_encode($response); 
    }
    
    if(isset($_POST['pay'])){
        $sql="SELECT * from due WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result); 
        if($row['isdue']!=1){
            $paytype=substr($paytype,-1);
            echo $type;
        }
        if($modeofpayment=='cash'){
            $sql="INSERT INTO admin_accounts (flat_no,duesquarts,paytype,payquarts,amount,mode_of_payment,next_quarter,approved) VALUES('$flat_no','$duesquarts','$type','$payquarts','$amount','cash','$next_quarter','no')";
        }
        else if($modeofpayment=='cheque'){
            $sql="INSERT INTO admin_accounts (flat_no,duesquarts,paytype,payquarts,amount,mode_of_payment,next_quarter,approved,chequeno,cheque_date,bank_name) VALUES('$flat_no','$duesquarts','$type','$payquarts','$amount','cheque','$next_quarter','no','$chequeno','$cheque_date','$bank_name')";
        }
        else if($modeofpayment=='online'){
            $sql="INSERT INTO admin_accounts (flat_no,duesquarts,paytype,payquarts,amount,mode_of_payment,next_quarter,approved,transaction_id,transaction_date) VALUES('$flat_no','$duesquarts','$type','$payquarts','$amount','online','$next_quarter','no','$transaction_id','$transaction_date')";
        }
        if(mysqli_query($conn,$sql)){
            echo 'success';
        }
        else{
            echo "unsuccess";
        }
    }

    if(isset($_POST['getamount'])){
        // echo 'back';
        include '../frontend_files_php/current_quarter.php';
        $sql="SELECT * from due WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);   
        $due_date=$row['due_date'];
        $days_due=$row['days_due'];
        $due_date_year=substr($due_date,0,4);
        include '../frontend_files_php/due_date_quarter.php';
        if(substr($flat_no,0,1)=='S'){
            $usertype='shop';
        }
        else{
            $usertype='resident';
        }
        if($row['isdue']==1){
            if($due_date_q==4){
                $num_quarters=intdiv($row['days_due']+2,91)+1;  
            }
            else
                $num_quarters=intdiv($row['days_due'],91)+1;
           
            include '../frontend_files_php/get_maintenance.php';
        }
        else{
            $num_quarters=0;
            include '../frontend_files_php/get_maintenance.php';
        }

    }



?>