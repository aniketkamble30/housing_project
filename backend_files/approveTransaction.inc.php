<?php
$conn = new mysqli('localhost', 'root', '', 'house');
if (isset($_POST['readrecord'])) {

    $data =  '';

    $displayquery = "SELECT * FROM `admin_accounts` WHERE approved ='no' OR approved = 'pending'";
    $result = mysqli_query($conn, $displayquery);


    if (mysqli_num_rows($result) == 0) {
        $data .= '<div class="row m-5 text-center" style="width:100%; color:gray">
        <img src="dist/png/notrans.png" alt=""><h3>No Transactions found</h3></div>';
    }

    if (mysqli_num_rows($result) > 0) {

        $data .= '
     <table id="example" class="table table-borderless "  style="width:100%; font-family: \'roboto\';">
      <thead>
          <th></th>
      </thead>
      <tbody id="rows">';


        $number = 1;
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $data .= '  
            <tr>
            <td>';
            if ($row['approved'] == 'pending') {
                $data .= '<div class="card border border-secondary" style="background-color: yellow;" id=div_' . $i . '>';
            } else {
                $data .= '
                <div class="card border border-secondary" id=div_' . $i . '>';
            }
            $data .= '
            
                <table class="table table-borderless">
                <tr>
                <td><b>Date Of Intimation:</b> ' . $row['Date'] . '</td>
                <td colspan=2 align="right" id="' . $row['id'] . '">Tid: ' . $row['id'] . '</td>
                </tr>
                <tr>
                    <td>Flat No.: ' . $row['flat_no'] . '</td>
                    <td>Purpose: ' . $row['purpose'] . '</td>
                    <td><button class="btn btn-block btn-outline-success" onclick="approveAlert(' . $row['id'] . ', \'div_' . $i . '\')" id=approve_btn_' . $i . '>Approve</button></td>    
                </tr>
                <tr>';
            if ($row['paytype'] == 'duesn')
                $data .= '<td>Paid For: Dues + N Quarters <br><br>Dues: ' . $row['duesquarts'] . '<br><br>Quarters: ' . $row['payquarts'] . '</td>';
            else if ($row['paytype'] == 'dues') {
                $data .= '<td>Paid For: Dues <br><br>Dues: ' . $row['duesquarts'] . '</td>';
            } else if ($row['paytype'] == 'duesy') {
                $data .= '<td>Paid For: Dues + Current Year <br><br>Dues: ' . $row['duesquarts'] . '<br><br>Quarters: ' . $row['payquarts'] . '</td>';
            } else if ($row['paytype'] == 'duesq') {
                $data .= '<td>Paid For: Dues + 1 Quarter <br><br>Dues: ' . $row['duesquarts'] . '<br><br>Quarters: ' . $row['payquarts'] . '</td>';
            } else if ($row['paytype'] == 'n') {
                $data .= '<td>Paid For: N Quarters <br><br>Quarters: ' . $row['payquarts'] . '</td>';
            } else if ($row['paytype'] == 'q') {
                $data .= '<td>Paid For: 1 Quarters <br><br>Quarters: ' . $row['payquarts'] . '</td>';
            } else if ($row['paytype'] == 'y') {
                $data .= '<td>Paid For: Current Year <br><br>Quarters: ' . $row['payquarts'] . '</td>';
            }
            $data .= '<td>Amount: ' . $row['amount'] . '</td>
                    <td><button class="btn btn-block btn-outline-danger"  onclick="denyAlert(' . $row['id'] . ', \'div_' . $i . '\')" id=deny_btn_' . $i . '>Deny</button></td>
                </tr>
                <tr>
                
                    <td>Mode Of Payment: ' . $row['mode_of_payment'] . '</td>';
            if ($row['mode_of_payment'] == 'cheque') {
                $data .= '<td>Cheque Number: ' . $row['chequeno'] . '<br><br>Cheque Date: ' . $row['cheque_date'] . '</td>';
            } else if ($row['mode_of_payment' == 'cash']) {
                $data .= '
                <td></td>';
            }
            if ($row['approved'] == 'pending') {
                $data .= '<td></td>';
            } else {
                $data .= '
                <td><button class="btn btn-block btn-outline-info" onclick="pendingAlert(' . $row['id'] . ', \'div_' . $i . '\')" id=pending_btn_' . $i . '>Pending</button></td>';
            }
            $data .= ' 
                </tr>
                </table>
                </div>
            </td>
            </tr>
            ';
            // $data .= '<tr>
            //             <td>                                        
            //                 Date of payment: <span><b>' . date("d-m-Y", strtotime($row['Date'])) . '</b></span>
            //                 <span class="tid" style="float: right;"><b>TID</b>: AH' . $row['id'] . '</span>


            //                 <span>Flat No.: ' . $row['flat_no'] . '</span><br>
            //                 <span>Purpose: ';

            // if ($row['purpose'] == 'maintenance') {
            //     $data .= ' ' . $row['purpose'] . '</span>';
            // } else {
            //     $data .= ' ' . $row['otherpurpose'] . '</span>';
            // }

            // $data .= '<br>
            //           <span>Amount: ' . $row['amount'] . '</span><br>
            //           <span>Mode: ' . $row['mode_of_payment'] . '</span>
            //           <br>';
            // if ($row['mode_of_payment'] == 'cheque') {s
            //     $data .= '<span>Cheque No.: ' . $row['chequeno'] . '</span><br>
            //               <span>Bank Name: ' . $row['bank_name'] . '</span>
            //               <span>Cheque Date: ' . date("d-m-Y", strtotime($row['cheque_date'])) . '</span>

            // ';
            // }

            // $data .= '</td><td>
            // <div id="col_' . $i . '" class="col-2" >
            //                 <center><h4>Status</h4></center>
            //             <div class="card-body" style="border-radius: 20%;">
            //                 <center><span id="status_' . $i . '"></span></center>
            //                 <button  id="id_check_' . $i . '" onclick="get(\'id_check_' . $i . '\',\'col_' . $i . '\',\'status_' . $i . '\')"            class="btn btn-sm tick btn-outline-success mb-2 check">
            //                     <i class="mdi mdi-check"></i><span>Approve</span>
            //                 </button><br>

            //                 <button  id="id_cross_' . $i . '" onclick="get(\'id_cross_' . $i . '\',\'col_' . $i . '\',\'status_' . $i . '\')"            class="btn btn-sm tick btn-outline-danger mb-2 cross">
            //                     <i class="mdi mdi-close"></i><span>Deny</span>
            //                 </button><br>
            //                 <button id="id_pending_' . $i . '" onclick="get(\'id_pending_' . $i . '\',\'col_' . $i . '\',\'status_' . $i . '\')"  class="btn btn-sm tick btn-outline-info mb-2 hourglass">
            //                     <i class="las la-hourglass"></i><span>Pending</span>
            //                 </button></div></div>
            //                 </td>
            // </tr>';
            $number++;
            $i++;
        }
        $data .= ' </tbody>
          </table>';
    }
    echo $data;
}

// $y = "SELECT * FROM `admin_accounts` WHERE id='52'";
// $result=mysqli_query($conn,$y);
// if($result){
//     $row= mysqli_fetch_array($result);
//     $getsub = substr($row['cqyr'],0,6);
//             $pieces = explode('-',$getsub);
//             $fromq = $pieces[0]; 
//             $fromy = $pieces[1];
//             for($i = 0;$i<$row['noq'];$i++){
//                 if($fromq == 4){ $fromq = 1;$fromy+=1; }
//                 else{$fromq+=1;}
//             }
//             if($fromq == 1){$setdate = $fromy.'-04-30';}
//             else if($fromq == 2){$setdate = $fromy.'-07-31';}
//             else if($fromq == 3){$setdate = $fromy.'-10-31';}
//             else if($fromq == 4){$setdate = ($fromy+1).'-01-31';}
//             echo $setdate;
// }
if (isset($_POST['updateRecordId'])) {
    $id = $_POST['updateRecordId'];
    $sql = "SELECT flat_no,next_quarter FROM admin_accounts WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $flat_no = $row['flat_no'];
    $next_quarter = $row['next_quarter'];
    // echo $flat_no.'  '.$next_quarter;
    include '../frontend_files_php/quarter_to_date.php';
    // echo $next_date;
    $sql = "UPDATE due SET due_date='$next_date', status='' WHERE flat_no='$flat_no'";
    mysqli_query($conn, $sql);
    $sql = "UPDATE admin_accounts SET approved='yes' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'unsuccess';
    }
}

if (isset($_POST['denyRecordId'])) {
    $id = $_POST['denyRecordId'];
    $sql = "UPDATE admin_accounts SET approved='denied' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'unsuccess';
    }
    // echo $data;
}

if (isset($_POST['pendingRecordId'])) {
    $id = $_POST['pendingRecordId'];
    $sql = "UPDATE admin_accounts SET approved='pending' WHERE id = $id";
    mysqli_query($conn, $sql);
    $sql = "SELECT flat_no from admin_accounts WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $flat_no = $row['flat_no'];
    // echo $flat_no;
    $sql = "UPDATE due SET status='pending' WHERE flat_no='$flat_no'";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'unsuccess';
    }
}

// if (isset($_POST['approveid'])) {
    //     require '../current_quarter.php';
//     $id = $_POST['approveid'];
//     $y = "SELECT * FROM `admin_accounts` WHERE id='$id'";
//     $result = mysqli_query($conn, $y);
//     if ($result) {
    //         $row = mysqli_fetch_array($result);
//         if ($row['purpose'] == 'maintenance') {
    //             $fltno = $row['flat_no'];
//             $purp = $row['purpose'];
//             $cq = $current_q;
//             $year = date('Y');

//             $paytype = $row['paytype'];
//             if ($paytype == 'dues') {
    //                 $sub1 = substr($row['duesquarts'], 0, 1);
//                 $piz = explode(',', $row['duesquarts']);
//                 $pizshrt = array_pop($piz);
//                 $endval = end($piz);
//                 $dq = substr($endval, 0, 1);
//                 $dyr = substr($endval, 2, 4);
//                 if ($dq == 1) {
    //                     $setdate = $dyr . '-' . '07' . '-' . '31';
//                 } else if ($dq == 2) {
    //                     $setdate = $dyr . '-' . '10' . '-' . '31';
//                 } else if ($dq == 3) {
    //                     $setdate = ($dyr + 1) . '-' . '01' . '-' . '31';
//                 } else if ($dq == 4) {
    //                     $setdate = ($dyr + 1) . '-' . '04' . '-' . '30';
//                 }
//             } else if ($paytype == 'dueqt1') {
    //                 $$getsub = substr($row['cqyr'], 0, 6);
//                 $pieces = explode('-', $getsub);
//                 $fromq = $pieces[0];
//                 $fromy = $pieces[1];
//                 if ($fromq == 1) {
    //                     $setdate = $fromy . '-' . '07' . '-' . '31';
//                 } else if ($fromq == 2) {
    //                     $setdate = $fromy . '-' . '10' . '-' . '31';
//                 } else if ($fromq == 3) {
    //                     $setdate = ($fromy) . '-' . '01' . '-' . '31';
//                 } else if ($fromq == 4) {
    //                     $setdate = ($fromy + 1) . '-' . '04' . '-' . '30';
//                 }
//             } else if ($paytype == 'due+yr') {
    //                 $getsub = substr($row['cqyr'], 0, 6);
//                 $pieces = explode('-', $getsub);
//                 $fromq = $pieces[0];
//                 $fromy = $pieces[1];
//                 for ($i = 0; $i < $row['noq']; $i++) {
    //                     if ($fromq == 4) {
        //                         $fromq = 1;
//                         $fromy += 1;
//                     } else {
    //                         $fromq += 1;
//                     }
//                 }
//                 $setdate = $fromy . '-04-30';
//             } else if ($paytype == 'dueqt') {
    //                 $getsub = substr($row['cqyr'], 0, 6);
//                 $pieces = explode('-', $getsub);
//                 $fromq = $pieces[0];
//                 $fromy = $pieces[1];
//                 for ($i = 0; $i < $row['noq']; $i++) {
    //                     if ($fromq == 4) {
        //                         $fromq = 1;
//                         $fromy += 1;
//                     } else {
    //                         $fromq += 1;
//                     }
//                 }
//                 if ($fromq == 1) {
//                     $setdate = $fromy . '-04-30';
//                 } else if ($fromq == 2) {
    //                     $setdate = $fromy . '-07-31';
//                 } else if ($fromq == 3) {
    //                     $setdate = $fromy . '-10-31';
//                 } else if ($fromq == 4) {
    //                     $setdate = ($fromy + 1) . '-01-31';
//                 }
//             } else if ($paytype == 1 || $paytype == 2 || $paytype == 3 || $paytype == 4) {
    //                 if ($row['paytype'] == 1) {
        //                     $setdate = $fromy . '-04-30';
//                 } else if ($row['paytype'] == 2) {
    //                     $setdate = $fromy . '-07-31';
//                 } else if ($row['paytype'] == 3) {
    //                     $setdate = $fromy . '-10-31';
//                 } else if ($row['paytype'] == 4) {
    //                     $setdate = ($fromy + 1) . '-01-31';
//                 }
//             } else if ($paytype == 'thisyr') {
    //                 $getsub = substr($row['cqyr'], 0, 6);
//                 $pieces = explode('-', $getsub);
//                 $fromq = $pieces[0];
//                 $fromy = $pieces[1];
//                 $setdate = ($fromy + 1) . '-04-30';
//             } else if ($paytype == 'nquat') {
    //                 $getsub = substr($row['cqyr'], 0, 6);
//                 $pieces = explode('-', $getsub);
//                 $fromq = $pieces[0];
//                 $fromy = $pieces[1];
//                 for ($i = 0; $i < $row['noq']; $i++) {
    //                     if ($fromq == 4) {
        //                         $fromq = 1;
//                         $fromy += 1;
//                     } else {
    //                         $fromq += 1;
//                     }
//                 }
//                 if ($fromq == 1) {
    //                     $setdate = $fromy . '-04-30';
//                 } else if ($fromq == 2) {
    //                     $setdate = $fromy . '-07-31';
//                 } else if ($fromq == 3) {
    //                     $setdate = $fromy . '-10-31';
//                 } else if ($fromq == 4) {
    //                     $setdate = ($fromy + 1) . '-01-31';
//                 }
//             }
//             $fno = substr($fltno, 0, 1);
//             if ($fno == 'A' || $fno == 'B') {
    //                 $mquery = "SELECT flat_owner1_email FROM flat_owner_details WHERE flat_no='$fltno'";
//                 $m = mysqli_query($conn, $mquery);
//                 $rip = mysqli_fetch_assoc($m);
//                 $newDate = date("d-m-Y", strtotime($row['Date']));
//                 $subject = 'Approval of Payment';
//                 $bdy = '<h2 style="color:black;">Your payment Dated ' . $newDate . ' of Amount ₹' . $row['amount'] . ' has been approved.To Download Invoice Click On the Link Below.</h2>
//                 <center><button style="background-color:rgb(63, 130, 255);padding: 10px;border-radius: 8px;border:none;"><a style="color:white;text-decoration: none;" href="http://192.168.0.102/project/make1.php?idd=' . $id . '">Download invoice</a></button></center>';
//                 $recipient = $rip['flat_owner1_email'];
//                 require "../mail.php";
//             } else if ($fno == 'S') {
    //                 $mquery = "SELECT email1 FROM shop_owner_details WHERE shop_no ='$fltno'";
//                 $m = mysqli_query($conn, $mquery);
//                 $rip = mysqli_fetch_assoc($m);
//                 $newDate = date("d-m-Y", strtotime($row['Date']));
//                 $subject = 'Approval of Payment';
//                 $bdy = '<h2 style="color:black;">Your payment Dated ' . $newDate . ' of Amount ₹' . $row['amount'] . ' has been approved.To Download Invoice Click On the Link Below.</h2>
//                     <center><button style="background-color:rgb(63, 130, 255);padding: 10px;border-radius: 8px;border:none;"><a style="color:white;text-decoration: none;" href="http://192.168.0.102/project/make1.php?idd=' . $id . '">Download invoice</a></button></center>';
//                 $recipient = $rip['email1'];
//                 require "../mail.php";
//             }
//             $update = "UPDATE `due` SET `due_date` = '$setdate' WHERE `flat_no` = '$fltno'";
//             if (mysqli_query($conn, $update)) {
    //                 $update1 = "UPDATE `admin_accounts` SET `approved` = 'yes' WHERE id = '$id'";
//                 mysqli_query($conn, $update1);
//             }
//         } else {
    //             $approveoth = "UPDATE `accounts` SET `approved`= 'yes' WHERE id = '$id'";
//             $done = mysqli_query($conn, $approveoth);
//         }
//     } else {
    //         echo 'Error Occured. Please Try again Later.';
//     }
// }
