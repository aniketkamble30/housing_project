<?php
extract($_POST);
$conn = new mysqli('localhost', 'root', '', 'house');
if (isset($_POST['readrecord'])) {
  $data =  '';

  $displayquery = "SELECT * FROM `admin_accounts` WHERE flat_no = '$flat_no' AND (approved='yes' OR approved='denied')";
  $result = mysqli_query($conn, $displayquery);


  if (mysqli_num_rows($result) == 0) {
    $data .= '<div class="row m-5 text-center" style="width:100%; color:gray">
  
  <img src="dist/png/notrans.png" alt=""><h3>No Transactions found</h3></div>';
  }

  if (mysqli_num_rows($result) > 0) {

    $data .= '
   <table id="example" class="table table-borderless "  style="width:100%; font-family: \'roboto\';">';

    $number = 1;
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
      $data .= '  
      <tr>
      <td>';
      if ($row['approved'] == 'pending') {
        $data .= '<div class="card border border-secondary" id=div_' . $i . '>';
      } else {
        $data .= '
          <div class="card border border-secondary" id=div_' . $i . '>';
      }
      if ($row['approved'] == 'yes') {
        $data .= '<table class="table table-borderless" style="background-color: lightgreen">';
      }
      else if ($row['approved'] == 'pending'){
        $data .= '<table class="table table-borderless" style="background-color: lightyellow">';
      }
      else if ($row['approved'] == 'denied'){
        $data .= '<table class="table table-borderless" style="background-color: lightred">';
      }
      
      $data .= '
          <tr>
          <td><b>Date Of Intimation:</b> ' . $row['Date'] . '</td>
          <td colspan=2 align="right" id="' . $row['id'] . '"><b>Tid:</b> ' . $row['id'] . '</td>
          </tr>
          <tr>
              <td><b>Flat No.: </b>' . $row['flat_no'] . '</td>
              <td><b>Purpose: </b> ' . $row['purpose'] . '</td>';
      if ($row['approved'] == 'yes') {
        $data .= ' <td rowspan="3"><h3>Approved</h3></td>';
      } else {
        $data .= '<td rowspan="3"><h3>' . $row['approved'] . '</h3></td>';
      }
      $data .= '
          </tr>
          <tr>';
      if ($row['paytype'] == 'duesn')
        $data .= '<td><b>Paid For:</b> Dues + N Quarters<br><br><b>Dues:</b> ' . $row['duesquarts'] . '<br><br><b>Quarters:</b> ' . $row['payquarts'] . '</td>';
      else if ($row['paytype'] == 'dues') {
        $data .= '<td><b>Paid For:</b> Dues <br><br><b>Dues:</b> ' . $row['duesquarts'] . '</td>';
      } else if ($row['paytype'] == 'duesy') {
        $data .= '<td><b>Paid For:</b> Dues + Current Year <br><br><b>Dues:</b> ' . $row['duesquarts'] . '<br><br><b>Quarters:</b> ' . $row['payquarts'] . '</td>';
      } else if ($row['paytype'] == 'duesq') {
        $data .= '<td><b>Paid For:</b> Dues + 1 Quarter <br><br><b>Dues:</b> ' . $row['duesquarts'] . '<br><br><b>Quarters:</b> ' . $row['payquarts'] . '</td>';
      } else if ($row['paytype'] == 'n') {
        $data .= '<td><b>Paid For:</b> N Quarters <br><br><b>Quarters:</b> ' . $row['payquarts'] . '</td>';
      } else if ($row['paytype'] == 'q') {
        $data .= '<td><b>Paid For:</b> 1 Quarters <br><br><b>Quarters:</b> ' . $row['payquarts'] . '</td>';
      } else if ($row['paytype'] == 'y') {
        $data .= '<td><b>Paid For:</b> Current Year <br><br><b>Quarters:</b> ' . $row['payquarts'] . '</td>';
      }
      $data .= '<td><b>Amount:</b> ' . $row['amount'] . '</td>
              
          </tr>
          <tr>
          
              <td><b>Mode Of Payment: </b>' . $row['mode_of_payment'] . '</td>';
      if ($row['mode_of_payment'] == 'cheque') {
        $data .= '<td><b>Cheque Number:</b> ' . $row['chequeno'] . '<br><br><b>Cheque Date:</b> ' . $row['cheque_date'] . '</td>';
      } else if ($row['mode_of_payment' == 'cash']) {
        $data .= '
          <td></td>';
      }
      if ($row['approved'] == 'pending') {
        $data .= '<td></td>';
      } else {
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
