<?php
error_reporting(E_NOTICE && E_WARNING);
$conn = new mysqli('localhost', 'root', '', 'house') or die(mysqli_error($conn));
// if (isset($_POST['analysis'])) {
    $months = array(4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3);
    $cars = array("0", "JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC");
    $temp_array = array();
    $year = date('Y') - 1;
    $dbMonth = array();
    $gers = array();
    $totalrows = array();
    $totalcols = array();
    $dbMonth_debit = array();
    $gers_debit = array();
    $temp_debit_array = array();
    $data = '';
    $sum_exp = 0;
    $sum_inc = 0;

    $dquery = mysqli_query($conn, "SELECT type FROM finance_records WHERE  crdr = 'DR' GROUP BY `type`");
    while ($rop = mysqli_fetch_array($dquery)) {
        array_push($gers, $rop['type']);
    }
    for ($i = 0; $i <= 11; $i++) {  
        if ($i > 8) {
            $year = date('Y');
            array_push($temp_array, ($cars[$months[$i]].'-'.($year)));
        } else {
            $year = date('Y') - 1;
            array_push($temp_array, ($cars[$months[$i]].'-'.($year)));
        }
        foreach ($gers as $a) {
            $newres = mysqli_query($conn, "SELECT SUM(amount) as total FROM finance_records WHERE `type`='" . $a . "' and month='" . $months[$i] . "'");
            $rest = mysqli_fetch_assoc($newres)['total'];
            if ($rest == null) {
                $rest = '&nbsp;-&nbsp;';
            }
            array_push($temp_array, $rest);
        }
        array_push($dbMonth, $temp_array);
        $temp_array = array();
    }
    $i = null;
    // echo $type;
    $resp = sizeof($gers);

    $data .= '
    <h4 class="text-primary">Income Expense Statement for Financial Year 2019</h4>
<table id="inexptae" class="table table-borderless  shadow table-responsive">
<tbody>
    <tr>
    <td style="background-color:#eee"></td>';
    for ($i = 0; $i <= 11; $i++) {
        if ($i > 8) {$year = date('Y');} 
        else {$year = date('Y') - 1;}
        $data .= '<td style="background-color:#eee">' . $cars[$months[$i]] . '-' . substr($year, 2, 2) . '</td>';
    }
    $data .= '<td style="background-color:#eee">Total</td></tr>
    <tr align="center">
        <td colspan="14" style="background-color:#eee"><b>EXPENSE</b></td>
    </tr>
    <tr>';
    for ($o = 0; $o < $resp; $o++) {
        $data .= '<td style="background-color:#eee" class="text-wrap">' . str_replace("_"," ",$gers[$o]) . '</td>';
        for ($i = 0; $i <= 11; $i++) {
            $totalcols[$i] = $totalcols[$i] +  $dbMonth[$i][$o + 1];
            $totalrows[$o] = $totalrows[$o] + $dbMonth[$i][$o + 1];
            $data .= '<td >' . $dbMonth[$i][$o + 1] . '</td>';
        }
        $data .= '
    <td style="background-color:#f6f6f6">' .  $totalrows[$o] . ' </td></tr><tr>';
    }
    $data .= '</tr><tr><td style="background-color:#eee">Total</td>';
    foreach ($totalcols as $r) {
        $data .= '<td style="background-color:#f6f6f6">' . $r . '</td>';
        $sum_inc += $r;
    }
    $data .= '<td style="background-color:#e6e6e6">' . number_format($sum_inc) . '</td></tr>
';
    // ------------------------------------
    $totalrows = array();
    $totalcols = array();
    $dquery = mysqli_query($conn, "SELECT type FROM finance_records WHERE  crdr = 'CR' GROUP BY `type`");
    while ($rop = mysqli_fetch_array($dquery)) {
        array_push($gers_debit, $rop['type']);
    }
    for ($i = 0; $i <= 11; $i++) {
        if ($i > 8) {
            $year = date('Y');
        } else {
            $year = date('Y') - 1;
        }
        // $data.= '<br>' . $cars[$months[$i]] . $months[$i] . '<br>';
        array_push($temp_debit_array, $cars[$months[$i]]);
        foreach ($gers_debit as $a) {
            $newres = mysqli_query($conn, "SELECT SUM(amount) as total FROM finance_records WHERE `type`='" . $a . "' and month='" . $months[$i] . "'");
            $rest = mysqli_fetch_assoc($newres)['total'];
            if ($rest == null) {
                $rest = '&nbsp;-&nbsp;';
            }
            array_push($temp_debit_array, $rest);
        }
        array_push($dbMonth_debit, $temp_debit_array);
        $temp_debit_array = array();
    }
    // print_r($dbMonth);
    $resp = sizeof($gers_debit);
    $data .= '<tr align="center">
<td colspan="14" style="background-color:#eee" ><b>INCOME</b></td>
</tr>
<tr>';
    for ($o = 0; $o < $resp; $o++) {
        $data .= '<td style="background-color:#eee">' . $gers_debit[$o] . '</td>';
        for ($i = 0; $i <= 11; $i++) {

            $totalcols[$i] = $totalcols[$i] +  $dbMonth_debit[$i][$o + 1];
            $totalrows[$o] = $totalrows[$o] + $dbMonth_debit[$i][$o + 1];
            $data .= '<td>' . $dbMonth_debit[$i][$o + 1] . '</td>';
        }
        $data .= '
    <td style="background-color:#f6f6f6">' .  $totalrows[$o] . ' </td>
    </tr>
    <tr>';
    }
    $data .= '</tr>
<tr><td style="background-color:#eee">Total</td>';
    foreach ($totalcols as $r) {
        $data .= '<td style="background-color:#f6f6f6">' . $r . '</td>';
        $sum_exp += $r;
    }
    $data .= '<td style="background-color:#e6e6e6">' . number_format($sum_exp) . '</td></tr>
</tbody>
</table>
<div class="row mt-4">
    <div class="col-12 p-2">
        <span class="m-2 h4"> Total Income :  <span  style="color:green;">' . number_format($sum_exp) . '</span></span>
        <span class="m-2 h4"> Total Expense :  <span  style="color:red;">' . number_format($sum_inc) . '</span></span>
        <span class="m-2 h4">Balance :  <span  class="text-info">' . number_format($sum_exp - $sum_inc) . '</span></span>
    </div>
</div>
';
    echo $data;
    
    $income = serialize($dbMonth);
    $expense = serialize($dbMonth_debit);
    $types1 = serialize($gers);
    $types2 = serialize($gers_debit);
    if(date('m') >99){
        echo date('m');
        $dquery = mysqli_query($conn, "INSERT INTO `inexp_ledger`(`fin_year`, `income`, `expense`,`types_inc`,`types_exp`) VALUES ('2019-20','".$income."','".$expense."','".$types2."','".$types1."')");
    }
// }