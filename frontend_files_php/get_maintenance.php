<?php
    // echo $type.' '.$flat_no.' '.$row['isdue']."\n";
    $int1=0;
    $dueyr=0;
    $finalamount=0;
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


    $daysloop = $days_due;

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
    $finalamount = $int1 + ($maintperquarter*$num_quarters);
    if($type=='duesq'){
        $finalamount+=$maintperquarter;
    }
    else if($type=='duesy'){
        $am=$maintperquarter*($remaining_q+1);
        if(($remaining_q+1)==2)
            $am-=($am*(2/100));
        else if(($remaining_q+1)==3)
            $am-=($am*(3/100));
        else if(($remaining_q+1)==4)
            $am-=($am*(4/100));

        $finalamount+=$am;
    }
    else if($type=='duesn'){
        $am=$maintperquarter*($noq);
        if(($noq)==2)
            $am-=($am*(2/100));
        else if(($noq)==3)
            $am-=($am*(3/100));
        else if(($noq)>=4)
            $am-=($am*(4/100));

        $finalamount+=$am;
    }
    echo round($finalamount,2);

?>