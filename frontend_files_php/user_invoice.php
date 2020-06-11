<?php 
    if(isset($_POST['get'])){
        $conn = mysqli_connect( 'localhost','root',"",'house' );
        session_start();
        $flat_no=$_SESSION['username'];
        $sql="SELECT due_date FROM due WHERE flat_no='$flat_no'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $due_date=strtotime('2019-10-31');
        
        $file=fopen("invoice.txt","r");
        $val=fgets($file);
        fclose($file);
        
        $today=strtotime(date('Y-m-d'));
        // echo $due_date.' '.$today;
        if($due_date<$today){
            $diff=0;
        }
        else{

            $diff = floor(($due_date-$today)/60/60/24);
        }
        // echo $diff;
        
        if($val==1 && $diff<180){
            if($_SESSION['role']=='resident')
                echo '<a href="makeinvoice.php?flat_no='.$flat_no.'&usertype=resident" class="btn btn-lg btn-success">Download Invoice</a>';
            else if($_SESSION['role']=='shop')
                echo '<a href="makeinvoice.php?flat_no='.$flat_no.'&usertype=shop" class="btn btn-lg btn-success">Download Invoice</a>';
        }
        
    }
    exit(); 
?>