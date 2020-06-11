<?php
error_reporting(E_NOTICE && E_WARNING);
$conn = new mysqli('localhost', 'root', '', 'house') or die(mysqli_error($conn));

if (isset($_POST['allexp'])) {
    $data = '';
    $categs = array();
    $subcategs = array();
    $temp_subcategs = array();
    $jsonarray = array();
    $graphdata = array();
    $year = date('Y') - 1;
    $dr = mysqli_query($conn, "SELECT `type` FROM `finance_records` WHERE `crdr`='DR' GROUP BY `type`");
    $number_of_categs = mysqli_num_rows($dr);
    while ($typesofdr = mysqli_fetch_array($dr)) {
        array_push($categs, $typesofdr['type']);
    }
    $data .= '<div class="row">
            <div class="col-12 col-md-5 ">
            <label for="select_subtype">Select Type :</label>
                <select onchange="changesubtypes();" class="form-control" id="select_subtype">
                <option value="null">All</option> ';
    foreach ($categs as $a) {
        $data .= '<option value="' . $a . '">' . $a . '</option>';
    }
    $data .= '</select>
            </div>
            <div class="col-12 col-md-3 " style="display:none;">
            <label for="select_timeline">View By :</label>
                <select class="form-control" onchange="changetimeline();" id="select_timeline">
                <option value="null">All</option> 
                    <option value="Yearly">Yearly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>
            <div class="col-12 col-md-3" id="sel_year" style="display:none;">
            <label for="select_year">Select Year :</label>
                <select class="form-control" id="select_year">
                    <option value="null">Choose..</option> ';
    $yearquery = mysqli_query($conn, "SELECT `year` FROM `finance_records` WHERE `crdr`='DR' GROUP BY `year`");
    while ($typeyear = mysqli_fetch_array($yearquery)) {
        $data .= '<option value="' . $typeyear['year'] . '">' . $typeyear['year'] . '</option>';
    }

    $data .= '</select>
            </div>
            <div class="col-12 col-md-3 " id="sel_mon" style="display:none;">
                <label for="select_month">Select Month :</label>
                <input type="month" class="form-control" id="select_month">
            </div>
            </div>
            <hr>
            <table id="allexptable" class="table table-bordered">
            <thead>
                <th>Dated</th>
                <th>Type</th>
                <th>Description</th>
                <th>Amount</th>
            </thead>
            <tbody>
            ';
    $newquery = mysqli_query($conn, "SELECT `month`,`year`,`type`,`subtype_or_desc`,`amount` FROM `finance_records` WHERE `crdr`='DR'");
    while ($thatsit = mysqli_fetch_array($newquery)) {
        $data .= '
        <tr>
            <td>' . $thatsit['month'] .'-'.$thatsit['year'] . '</td>
            <td>' . $thatsit['type'] . '</td>
            <td>' . $thatsit['subtype_or_desc'] . '</td>
            <td>' . $thatsit['amount'] . '</td>
        </tr>';
    }
    $data .= '</tbody>
        </table>';
    $graphquery = mysqli_query($conn, "SELECT `type` , SUM(amount) as sum  FROM `finance_records` WHERE `crdr`='DR' GROUP BY `type`");
    while($row = mysqli_fetch_array($graphquery)){
        array_push($graphdata, array('value' => $row['type'],'sum'=>intval($row['sum'])));
    }
    $sending = array(
        'table'=>$data,
        'graph1'=>json_encode($categs),
        'graph2'=>json_encode($graphdata2),
    );
    echo json_encode($sending);
}

if (isset($_POST['specexp'])) {
    $data = '';
    $categs = array();
    $subcategs = array();
    $temp_subcategs = array();
    $jsonarray = array();
    $graphdata = array();
    $year = date('Y') - 1;
    $subtype = $_POST['subtype'];
    $dr = mysqli_query($conn, "SELECT `type` FROM `finance_records` WHERE `crdr`='DR' GROUP BY `type`");
    $number_of_categs = mysqli_num_rows($dr);
    while ($typesofdr = mysqli_fetch_array($dr)) {
        array_push($categs, $typesofdr['type']);
    }
    $data .= '<div class="row">
            <div class="col-12 col-md-5 ">
            <label for="select_subtype">Select Type :</label>
                <select onchange="changesubtypes();" class="form-control" id="select_subtype">
                <option value="null">All</option> ';
    foreach ($categs as $a) {
        $data .= '<option value="' . $a . '">' . $a . '</option>';
    }
    $data .= '</select>
            </div>
            <div class="col-12 col-md-3 " style="display:none;">
            <label for="select_timeline" >View By :</label>
                <select class="form-control" onchange="changetimeline();" id="select_timeline">
                <option value="null">All</option> 
                    <option value="Yearly">Yearly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>
            <div class="col-12 col-md-3" id="sel_year" style="display:none;">
            <label for="select_year">Select Year :</label>
                <select class="form-control" id="select_year">
                    <option value="null">Choose..</option> ';
    $yearquery = mysqli_query($conn, "SELECT `year` FROM `finance_records` WHERE `crdr`='DR' GROUP BY `year`");
    while ($typeyear = mysqli_fetch_array($yearquery)) {
        $data .= '<option value="' . $typeyear['year'] . '">' . $typeyear['year'] . '</option>';
    }

    $data .= '</select>
            </div>
            <div class="col-12 col-md-3 " id="sel_mon" style="display:none;">
                <label for="select_month">Select Month :</label>
                <input type="month" class="form-control" id="select_month">
            </div>
            </div>
            <hr>
            <table id="allexptable" class="table table-bordered">
            <thead>
                <th>Type</th>
                <th>Description</th>
                <th>Amount</th>
            </thead>
            <tbody>
            ';
            $newquery = mysqli_query($conn, "SELECT SUM(`amount`) as amount, `subtype_or_desc` as `top` FROM `finance_records` WHERE `crdr`='DR' and `type`='".$subtype."' GROUP BY `subtype_or_desc`");
    while ($thatsit = mysqli_fetch_array($newquery)) {
        $data .= '
        <tr>
            <td>' . $subtype . '</td>
            <td>' . $thatsit['top'] . '</td>
            <td>' . $thatsit['amount'] . '</td>
        </tr>';
    }
    $data .= '</tbody>
        </table>';
    $graphquery = mysqli_query($conn, "SELECT `type` , SUM(amount) as sum  FROM `finance_records` WHERE `crdr`='DR' GROUP BY `type`");
    while($row = mysqli_fetch_array($graphquery)){
        array_push($graphdata, array('value' => $row['type'],'sum'=>intval($row['sum'])));
    }
    $sending = array(
        'table'=>$data,
        'graph1'=>json_encode($categs),
        'graph2'=>json_encode($graphdata2),
    );
    echo json_encode($sending);
}