 <?php
error_reporting(E_NOTICE && E_WARNING);
$conn = mysqli_connect('localhost','root','','house');
if(isset($_POST['k_s'])){

$dbMonth = array();
$dbMonth_debit = array();
$gers = array();
$totalcols = array();
$totalrows = array();
$months = array(4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3);
$cars = array("0", "JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC");
$query3  = "SELECT `fin_year`,`income`, `expense`,`types_inc`,`types_exp` FROM `inexp_ledger` WHERE id='".$_POST['k_s']."'";
$result3 = mysqli_query($conn,$query3);
$row3 = mysqli_fetch_array($result3);
$dbMonth = unserialize($row3['income']);
$dbMonth_debit = unserialize($row3['expense']);
$gers = unserialize($row3['types_exp']);
$gers_debit = unserialize($row3['types_inc']);
// print_r($dbMonth_debit);
$data = '';
$sum_inc = 0;
$resp = sizeof($gers);
$data .= '
    <div><button type="button" onclick="closee()" class="btn float-right m-2 btn-danger btn-sm">Close</button></div>
<form action="printInExp.php" method="post">
    <div><button type="submit" name="printLedger" value="'.$_POST['k_s'].'" class="btn float-right m-2 btn-success btn-sm">Print Statement</button></div>
    </form> <br>
<h4 class="text-primary">Income Expense Statement for Financial Year 2019</h4><hr>
<table id="inexptae" class="table shadow table-borderless table-responsive">
<tbody>
    <tr>
    <td style="background-color:#eee"></td>';
    for ($i = 0; $i <= 11; $i++) {
        if ($i > 8) {$year = substr($row3['fin_year'],5,2);}
        else {$year = substr($row3['fin_year'],2,2);} 
        $data .= '<td style="background-color:#eee">' . $cars[$months[$i]] . '-' . $year. '</td>';
    }
    $data .= '<td style="background-color:#eee">Total</td></tr>
    <tr align="center">
        <td colspan="14" style="background-color:#eee"><b>EXPENSE</b></td>
    </tr>
    <tr>';
    for ($o = 0; $o < $resp; $o++) {
        $data .= '<td style="background-color:#eee">' . $gers[$o] . '</td>';
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
'; $totalrows = array();
$totalcols = array();
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
}
if(isset($_POST['wantledger'])){
    
    $data = '
    <h4 class="text-grey"><i class="las la-server"></i> Records</h4><hr>';
    $query3  = mysqli_query($conn,"SELECT `id`,`fin_year` FROM `inexp_ledger`");
while ($a = mysqli_fetch_array($query3)){
    $data .= ' 
        <a onclick="getled('.$a['id'].')" class="p-2 m-2  h4 border d-block bg-light text-info" style="cursor:pointer;text-decoration:none;">Income Expense Ledger For : '.$a['fin_year'].'</a>
    ';
}
echo $data;
}
?>