<?php
error_reporting(E_NOTICE && E_WARNING);
$html ="";
date_default_timezone_set("Asia/Calcutta");
$conn = mysqli_connect( 'localhost','root',"",'house' );

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 8,
    'margin_bottom' => 8,
    'margin_header' => 10,
    'margin_footer' => 10,
    'orientation' => 'L'
]);
$mpdf->showImageErrors = true;
if (isset($_POST['printTable'])) {
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
    $html = '';
    $sum_exp = 0;
    $sum_inc = 0;

    $dquery = mysqli_query($conn, "SELECT type FROM finance_records WHERE year='2019'and crdr = 'DR' GROUP BY `type`");
    while ($rop = mysqli_fetch_array($dquery)) {
        array_push($gers, $rop['type']);
    }
    for ($i = 0; $i <= 11; $i++) {
        if ($i > 8) {
            $year = date('Y');
        } else {
            $year = date('Y') - 1;
        }
        // $html.= '<br>' . $cars[$months[$i]] . $months[$i] . '<br>';
        array_push($temp_array, $cars[$months[$i]]);
        foreach ($gers as $a) {
            $newres = mysqli_query($conn, "SELECT SUM(amount) as total FROM finance_records WHERE year='" . $year . "'and`type`='" . $a . "' and month='" . $months[$i] . "'");
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
    // print_r($dbMonth);
    $resp = sizeof($gers);

    $html .= '
    <html>
    <head>
    <style>
    table, th, td {
        border: 1px solid grey;
      }
    </style>
    </head>
    <body style="font-family:calibri;padding: 5px;">
      <h2>Income Expense Statement </h2>
      <br>
<table style="width:100%; border-collapse: collapse;" cellpadding="10">
<thead><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></thead>
<tbody>
    <tr>
    <td style="background-color:#eee"></td>';
    for ($i = 0; $i <= 11; $i++) {
        if ($i > 8) {
            $year = date('Y');
        } else {
            $year = date('Y') - 1;
        }
        $html .= '<td style="background-color:#eee">' . $cars[$months[$i]] . '-' . substr($year, 2, 2) . '</td>';
    }
    $html .= '<td style="background-color:#eee">Total</td></tr>
    <tr align="center">
        <td colspan="14" style="background-color:#eee"><b>EXPENSE</b></td>
    </tr>
    <tr>';
    for ($o = 0; $o < $resp; $o++) {
        $html .= '<td style="background-color:#eee">' . str_replace("_"," ",$gers[$o]) . '</td>';
        for ($i = 0; $i <= 11; $i++) {
            $totalcols[$i] = $totalcols[$i] +  $dbMonth[$i][$o + 1];
            $totalrows[$o] = $totalrows[$o] + $dbMonth[$i][$o + 1];
            $html .= '<td >' . $dbMonth[$i][$o + 1] . '</td>';
        }
        $html .= '
    <td style="background-color:#f6f6f6">' .  $totalrows[$o] . ' </td></tr><tr>';
    }
    $html .= '</tr><tr><td style="background-color:#eee">Total</td>';
    foreach ($totalcols as $r) {
        $html .= '<td style="background-color:#f6f6f6">' . $r . '</td>';
        $sum_inc += $r;
    }
    $html .= '<td style="background-color:#e6e6e6">' . number_format($sum_inc) . '</td></tr>
';
// ------------------------------------
    $totalrows = array();
    $totalcols = array();
    $dquery = mysqli_query($conn, "SELECT type FROM finance_records WHERE year='2019'and crdr = 'CR' GROUP BY `type`");
    while ($rop = mysqli_fetch_array($dquery)) {
        array_push($gers_debit, $rop['type']);
    }
    for ($i = 0; $i <= 11; $i++) {
        if ($i > 8) {
            $year = date('Y');
        } else {
            $year = date('Y') - 1;
        }
        // $html.= '<br>' . $cars[$months[$i]] . $months[$i] . '<br>';
        array_push($temp_debit_array, $cars[$months[$i]]);
        foreach ($gers_debit as $a) {
            $newres = mysqli_query($conn, "SELECT SUM(amount) as total FROM finance_records WHERE year='" . $year . "'and`type`='" . $a . "' and month='" . $months[$i] . "'");
            $rest = mysqli_fetch_assoc($newres)['total'];
            if ($rest == null) {
                $rest = '&nbsp;-&nbsp;';
            }
            array_push($temp_debit_array, $rest);
        }
        array_push($dbMonth_debit, $temp_debit_array);
        $temp_debit_array = array();
    }
    // print_r($dbMonth_debit);
    $resp = sizeof($gers_debit);
    $html .= '<tr align="center">
<td colspan="14" style="background-color:#eee" ><b>INCOME</b></td>
</tr>
<tr>';
    for ($o = 0; $o < $resp; $o++) {
        $html .= '<td style="background-color:#eee">' . $gers_debit[$o] . '</td>';
        for ($i = 0; $i <= 11; $i++) {

            $totalcols[$i] = $totalcols[$i] +  $dbMonth_debit[$i][$o + 1];
            $totalrows[$o] = $totalrows[$o] + $dbMonth_debit[$i][$o + 1];
            $html .= '<td>' . $dbMonth_debit[$i][$o + 1] . '</td>';
        }
        $html .= '
    <td style="background-color:#f6f6f6">' .  $totalrows[$o] . ' </td>
    </tr>
    <tr>';
    }
    $html .= '</tr>
<tr><td style="background-color:#eee">Total</td>';
    foreach ($totalcols as $r) {
        $html .= '<td style="background-color:#f6f6f6">' . $r . '</td>';
        $sum_exp += $r;
    }
    $html .= '<td style="background-color:#e6e6e6">' . number_format($sum_exp) . '</td></tr>
</tbody>
</table>
<div class="row mt-4">
    <div class="col-12 p-2">
        <h3> Total Income : '.number_format($sum_exp).'<br>
         Total Expense : '.number_format($sum_inc).'<br>
        Balance : '.number_format($sum_exp-$sum_inc).'</h3>
    </div>
</div>
</div>
</body>
</html>
';
// }
$html .= '';
$invoicename = 'IncomeExpense.pdf';
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
// $mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Income");
$mpdf->SetAuthor("Co-operative Housing society");
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
}
if(isset($_POST['printLedger'])){

    $dbMonth = array();
    $dbMonth_debit = array();
    $gers = array();
    $totalcols = array();
    $totalrows = array();
    $months = array(4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3);
    $cars = array("0", "JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC");
    $query3  = "SELECT `fin_year`,`income`, `expense`,`types_inc`,`types_exp` FROM `inexp_ledger` WHERE id='".$_POST['printLedger']."'";
    $result3 = mysqli_query($conn,$query3);
    $row3 = mysqli_fetch_array($result3);
    $dbMonth = unserialize($row3['income']);
    $dbMonth_debit = unserialize($row3['expense']);
    $gers = unserialize($row3['types_exp']);
    $gers_debit = unserialize($row3['types_inc']);
    // print_r($dbMonth_debit);
    $html = '';
    $sum_inc = 0;
    $resp = sizeof($gers);
    $html .= '
    <html>
    <head>
    <style>
    table, th, td {
        border: 1px solid grey;
      }
    </style>
    </head>
    <body style="font-family:calibri;padding: 5px;">
      <h2>Income Expense Statement For Financial Year  '.$row3['fin_year'].'</h2>
      <br>
    <table style="width:100%; border-collapse: collapse;" cellpadding="10">
    <tbody>
        <tr>
        <td style="background-color:#eee"></td>';
        for ($i = 0; $i <= 11; $i++) {
            if ($i > 8) {$year = substr($row3['fin_year'],5,2);}
            else {$year = substr($row3['fin_year'],2,2);} 
            $html .= '<td style="background-color:#eee">' . $cars[$months[$i]] . '-' . ($year) . '</td>';
        }
        $html .= '<td style="background-color:#eee">Total</td></tr>
        <tr align="center">
            <td colspan="14" style="background-color:#eee"><b>EXPENSE</b></td>
        </tr>
        <tr>';
        for ($o = 0; $o < $resp; $o++) {
            $html .= '<td style="background-color:#eee">' . $gers[$o] . '</td>';
            for ($i = 0; $i <= 11; $i++) {
                $totalcols[$i] = $totalcols[$i] +  $dbMonth[$i][$o + 1];
                $totalrows[$o] = $totalrows[$o] + $dbMonth[$i][$o + 1];
                $html .= '<td >' . $dbMonth[$i][$o + 1] . '</td>';
            }
            $html .= '
        <td style="background-color:#f6f6f6">' .  $totalrows[$o] . ' </td></tr><tr>';
        }
        $html .= '</tr><tr><td style="background-color:#eee">Total</td>';
        foreach ($totalcols as $r) {
            $html .= '<td style="background-color:#f6f6f6">' . $r . '</td>';
            $sum_inc += $r;
        }
        $html .= '<td style="background-color:#e6e6e6">' . number_format($sum_inc) . '</td></tr>
    '; $totalrows = array();
    $totalcols = array();
    $resp = sizeof($gers_debit);
    $html .= '<tr align="center">
    <td colspan="14" style="background-color:#eee" ><b>INCOME</b></td>
    </tr>
    <tr>';
    for ($o = 0; $o < $resp; $o++) {
        $html .= '<td style="background-color:#eee">' . $gers_debit[$o] . '</td>';
        for ($i = 0; $i <= 11; $i++) {
    
            $totalcols[$i] = $totalcols[$i] +  $dbMonth_debit[$i][$o + 1];
            $totalrows[$o] = $totalrows[$o] + $dbMonth_debit[$i][$o + 1];
            $html .= '<td>' . $dbMonth_debit[$i][$o + 1] . '</td>';
        }
        $html .= '
    <td style="background-color:#f6f6f6">' .  $totalrows[$o] . ' </td>
    </tr>
    <tr>';
    }   
    $html .= '</tr>
    <tr><td style="background-color:#eee">Total</td>';
    foreach ($totalcols as $r) {
        $html .= '<td style="background-color:#f6f6f6">' . $r . '</td>';
        $sum_exp += $r;
    }
    $html .= '<td style="background-color:#e6e6e6">' . number_format($sum_exp) . '</td></tr>
    </tbody>
    </table>
    <div class="row mt-4">
        <div class="col-12 p-2">
            <h3> Total Income : '.number_format($sum_exp).'<br>
             Total Expense : '.number_format($sum_inc).'<br>
            Balance : '.number_format($sum_exp-$sum_inc).'</h3>
        </div>
    </div>
    </div>
    </body>
    </html>
    ';
    $html .= '';
    $invoicename = 'Income Expense Statement For Financial Year  '.$row3['fin_year'].'.pdf';
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    // $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle('Income Expense Statement For Financial Year : '.$row3['fin_year'].'');
    $mpdf->SetAuthor("Co-operative Housing society");
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($invoicename,\Mpdf\Output\Destination::INLINE);
    }
