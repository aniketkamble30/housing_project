<?php
    if(isset($_POST['get'])){

        $file=fopen("invoice.txt","r");
        $val=fgets($file);
        fclose($file);
        $today=date('Y-m-d');
        $d=explode('-',$today);
        $y=substr($today,0,4);
        if($d[1]>=1 && $d[1]<=3){
            $q=4;
        }
        else if($d[1]>=3 && $d[1]<=6){
            $q=1;
        }
        else if($d[1]>=6 && $d[1]<=9){
            $q=2;
        }
        else{
            $q=3;
            $y=$y-1;
        }
        // echo $d.' '.$y;
        if($val==0){
            if(0<=$d[2] && $d[2]<=31 && ($d[1]==1 || $d[1]==4 || $d[1]==7 || $d[1]==10)){
                echo '<button class="btn btn-lg btn-success" onClick="sendinvoice()">Send Invoice</button>';
            }
        }
        else{
            if(0<=$d[2] && $d[2]<=31 && ($d[1]==1 || $d[1]==4 || $d[1]==7 || $d[1]==10)){
                echo '<p class="alert alert-success" style="width: fit-content;">You have already sent Invoice for Quarter '.$q.' of '.$y.'</p>';
            }
            else{
                $file=fopen("invoice.txt","w");
                fwrite($file,'0');
                fclose($file);
                echo '';
            }
        }
    }

    if(isset($_POST['send'])){
        echo 'hello';
        $file=fopen("invoice.txt","w");
        fwrite($file,'1');
        fclose($file);
    }


?>