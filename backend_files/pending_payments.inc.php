<?php
    if(isset($_POST['readrecord'])){
        
        $disp='';
        $conn = mysqli_connect('localhost','root','','house');
        $sql ="SELECT * FROM due WHERE isdue=1";
        $result=mysqli_query($conn,$sql);

    
        while($row=mysqli_fetch_assoc($result)){
            $flat_no=$row['flat_no'];
            $due_date=$row['due_date'];
            $due_date_year=substr($due_date,0,4);
            if(substr($flat_no,0,1)=='S')
                $usertype='shop';
            else if(substr($flat_no,0,1)=='A')
                $usertype='resident';
            
            if(substr($due_date,5,2)>=1 && substr($due_date,5,2)<=3){
                $due_date_q=4;
                $due_date_q1=4;
            }
            else if(substr($due_date,5,2)>=3 && substr($due_date,5,2)<=6){
                $due_date_q=1;
                $due_date_q1=4;
            }
            else if(substr($due_date,5,2)>=6 && substr($due_date,5,2)<=9){
                $due_date_q=2;
                $due_date_q1=4;
            }
            else{
                $due_date_q=3;
                $due_date_q1=4;
            }
            if($due_date_q==4){
                $due_date_year -= 1;
            }
    
            if($due_date_q==4){
                $num_quarters=intdiv($row['days_due']+2,91)+1;  
            }
            else
                $num_quarters=intdiv($row['days_due'],91)+1;   
    
            $int1=0;
            if($usertype=='resident'){
    
                $sql ="SELECT p.flat_dimensions,a.*,d.*
                FROM flat_details AS p
                INNER JOIN charges AS a
                INNER JOIN due AS d WHERE p.flat_no = '$flat_no' AND d.flat_no = '$flat_no'";
                $nes = mysqli_query($conn,$sql);
                $riw = mysqli_fetch_assoc($nes);
                $flat_dimensions=$riw['flat_dimensions'];
            }
            else if($usertype=='shop'){
                $sql ="SELECT p.shop_dimensions,a.*,d.*
                FROM shop_details AS p
                INNER JOIN charges AS a
                INNER JOIN due AS d WHERE p.shop_no = '$flat_no' AND d.flat_no = '$flat_no'";
                $nes = mysqli_query($conn,$sql);
                $riw = mysqli_fetch_assoc($nes);
                $flat_dimensions=$riw['shop_dimensions'];
            }
    
            // $flat_dimensions=$riw['flat_dimensions'];
    
            $disp.='<tr>';
            $interestrate = $riw['interest'];
            $intperday = $interestrate/36500;
            $numberofduedays = $riw['days_due'];
        
            $num = 136;
            $sink =         ($flat_dimensions*$riw['const_cost']*(0.25))/1200;
            $repair =       ($flat_dimensions*$riw['const_cost']*(0.75))/1200;
        
        
            $insurance =    ($riw['insurance']/12)/$num;
            $water =        ($riw['water_char']/12)/$num;
            $electricity =  ($riw['elec_char']/12)/$num;
            $lift =         ($riw['lift_char']/12)/$num;
            $security =     ($riw['security']/12)/$num;
            $service =      ($riw['serv_char']/12)/$num;
            $maintenancepm =( $sink + $repair  )+ ($insurance + $water + $electricity + $lift + $security + $service);
        
            $maintpersqft = $maintenancepm /$flat_dimensions;
            $maintperquarter = ($maintenancepm*3);
        
        
            $daysloop = $row['days_due'];
        
            for($r=0;$r<$num_quarters;$r++) {
                if($due_date_q1 == 4){
                    $int1 += $maintperquarter * $intperday * $daysloop;
                    $daysloop-=89;
                    $due_date_q1=1;
                }
                else{
                    $int1 += $maintperquarter * $intperday * $daysloop;
                    $daysloop-=92;
                    $due_date_q1+=1;
                }
            }
            $duesquarts='<ul>';
            for($i=0; $i<$num_quarters; $i++){
                $duesquarts.='<li>Quarter '.$due_date_q.' of '.$due_date_year.'-'.($due_date_year+1).'</li>';
                if($due_date_q==4){
                    $due_date_q=1;
                    $due_date_year++;
                }
                else{
                    $due_date_q+=1;
                }
                
            }
            $duesquarts.='</ul>';

            $amount=$int1 + ($maintperquarter*$num_quarters);
            if($usertype=='resident')
                $disp.='<td>'.$row['flat_no'].'</td>';
            else if($usertype=='shop')
                $disp.='<td>'.$row['flat_no'].'</td>';
                
            $disp.='<td>₹ '.round($amount,0).'</td>
                <td>'.$duesquarts.'</td>';
    
            $disp.='</tr>';
        }
    
        echo $disp;
    }
        // $resp.push($int1 + ($maintperquarter*$num_quarters));
    
?>