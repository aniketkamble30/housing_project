<?php
extract($_POST);
if(isset($_POST['get_details'])){
    $data='';
    if($_POST['type']=='fow'){
        $seperator=",";
        $file_name='../CSVs/history/flat_owner.csv';
        $file=fopen($file_name,'r');
        $size=filesize($file_name);
        $row=fgetcsv($file,$size,$seperator);
        $data.='<thead class="bg-secondary text-white">';
        $data.='<tr><th>Srno.</th>';
        $x=0;
        for($x=0;$x<=4;$x++){
            $data.='<th>'.$row[$x].'</th>';
        }
        $data.='<th>'.$row[24].'</th>';
        $data.='<th>'.$row[33].'</th>';


        $data.='</tr>';
        $data.='</thead>';
        $data.='<tbody>';
        $w=0;
        $rownum =1;
        while($row=fgetcsv($file,$size,$seperator)){
            $data.='<tr onclick="alldetails(\''.$rownum.'\',\''.$_POST["type"].'\')">';
            $data.='<td>'.$rownum.'</td>';

                for($w=0;$w<=4;$w++){
            $data.='<td>'.@$row[$w].'</td>';   
           }

        $data.='<td>'.@$row[24].'</td>';
        $data.='<td>'.@$row[33].'</td>';
            
        $data.='</tr>';

           $rownum++;
        }

        $data.='</tbody>'; 
        echo $data;
    }
    else if($_POST['type']=='ft'){
        $seperator=",";
        $file_name='../CSVs/history/flat_tenant.csv';
        $file=fopen($file_name,'r');
        $size=filesize($file_name);
        $row=fgetcsv($file,$size,$seperator);
        $rownum = 1;
        $data.='<thead class="bg-secondary text-white">';
        $data.='<tr >';
            for($k=0;$k<11;$k++){
                $data.='<th>'.$row[$k].'</th>';
            }
        $data.='</tr>';
        $data.='</thead>';
        $data.='<tbody>';
        while($row=fgetcsv($file,$size,$seperator)){
            $data.='<tr  onclick="alltenantdetails(\''.$rownum.'\',\''.$_POST["type"].'\')">';
            for($k=0;$k<11;$k++){
                $data.='<td>'.$row[$k].'</td>';
            }
            $data.='</tr>';
            $rownum++;
        }
        $data.='</tbody>';
        echo $data;
    }



    else if($_POST['type']=='st'){
        $seperator=",";
        $file_name='../CSVs/history/shop_tenant.csv';
        $file=fopen($file_name,'r');
        $size=filesize($file_name);
        $row=fgetcsv($file,$size,$seperator);
        $rownum = 1;
        $data.='<thead class="bg-secondary text-white">';
        $data.='<tr >';
            for($k=0;$k<8;$k++){
                $data.='<th>'.$row[$k].'</th>';
            }
        $data.='</tr>';
        $data.='</thead>';
        $data.='<tbody>';
        while($row=fgetcsv($file,$size,$seperator)){
            $data.='<tr  onclick="shoptenantdetails(\''.$rownum.'\',\''.$_POST["type"].'\')">';
            for($k=0;$k<8;$k++){
                $data.='<td>'.$row[$k].'</td>';
            }
            $data.='</tr>';
            $rownum++;
        }
        $data.='</tbody>';
        echo $data;
    }









    // ------------------------------------------------------------------------------------------------------

    else if($_POST['type']=='em'){
        $seperator=",";
        $file_name='../CSVs/history/employee.csv';
        $file=fopen($file_name,'r');
        $size=filesize($file_name);
        $row=fgetcsv($file,$size,$seperator);
        $data.='<thead class="bg-secondary text-white">';
        $data.='<tr>
                <th>'.$row[1].'</th>
                <th>'.$row[2].'</th>
                <th>'.$row[10].'</th>
                <th>'.$row[11].'</th>
        </tr>';
        $data.='</thead>';
        $data.='<tbody>';
        while($row=fgetcsv($file,$size,$seperator)){
            $data.='<tr>
            <td onclick="empinfo(\''.$row[1].'\')" style="color:blue">'.$row[1].'</td>
            <td>'.$row[2].'</td>
            <td><input type="button" class="btn btn-primary btn-md" onclick="idproof(\''.$row[10].'\')" value="view"></td>
            <td><input type="button" class="btn btn-primary btn-md"  onclick="otherdoc(\''.$row[11].'\')" value="view"></td>
            </tr>';
        }
        $data.='</tbody>';
        echo $data;
    }

    //-----------------------------------------------------------------------------------------------------------


    else if($_POST['type']=='sow'){
        $seperator=",";
        $file_name='../CSVs/history/shop_owner.csv';
        $file=fopen($file_name,'r');
        $size=filesize($file_name);
        $row=fgetcsv($file,$size,$seperator);
        $data.='<thead class="bg-secondary text-white">';
        $data.='<tr>';
        for($i=0;$i<6;$i++){
            $data.='<th>'.$row[$i].'</th>';
        }
        $data.='<th>'.$row[11].'</th>
        <th>'.$row[14].'</th>';
        $data.='</tr>';
        $data.='</thead>';
        $data.='<tbody>';
        while($row=fgetcsv($file,$size,$seperator)){
            $data.='<tr onclick="getshopownerhistory(\''.$row[0].'\')">';
            for($i=0;$i<6;$i++){
                $data.='<td>'.$row[$i].'</td>';
            }
            $data.='<td>'.$row[11].'</td>
            <td>'.$row[14].'</td>';
            $data.='</tr>';
        }
        $data.='</tbody>';
        echo $data;
    }
    else if($_POST['type']=='com'){
        $seperator=",";
        $file_name='../CSVs/history/committee.csv';
        $file=fopen($file_name,'r');
        $size=filesize($file_name);
        $row=fgetcsv($file,$size,$seperator);
        $data.='<thead class="bg-secondary text-white">';
        $data.='<tr>';
        foreach($row as $x){
            $data.='<th>'.$x.'</th>';
        }
        $data.='</tr>';
        $data.='</thead>';
        $data.='<tbody>';
        while($row=fgetcsv($file,$size,$seperator)){
            $data.='<tr>';
            foreach($row as $x){
                $data.='<td>'.$x.'</td>';
            }
            $data.='</tr>';
        }
        $data.='</tbody>';
        echo $data;
    }
        
}

if(isset($_POST['gu']) && isset($_POST['type'])){

    $data='';
    if($_POST['type']=='fow'){
        $seperator=",";
        $file_name='../CSVs/history/flat_owner.csv';
        
        $search_str=$_POST['gu'];
        $row = 1;
        $mycsvfile = array(); //define the main array.
        $response = array();
        if (($handle = fopen("$file_name", "r")) != FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) != FALSE) {
            $num = count($data);
            $row++;
            $mycsvfile[] = $data; //add the row to the main array.
        }
        fclose($handle);
        }
            for($i=0;$i<=$num;$i++){
                if(isset($mycsvfile[$i][30])&&($mycsvfile[$i][30] == $search_str)){
                    // array_push($response,$mycsvfile[$i][3]);
                    for($j=0;$j<=33;$j++){
                        if(isset($mycsvfile[$i][$j])){
                            array_push($response,$mycsvfile[$i][$j]);
                        }
                    }
                }        
            }
        }
echo json_encode($response);

}

// -------------------------------------------------------------------

if(isset($_POST['empid'])){
    $daata="";

    $file_name='../CSVs/history/employee.csv';
        
    $search_str=$_POST['empid'];
    $row = 1;
    $mycsvfile = array(); //define the main array.
    $response = array();
    if (($handle = fopen("$file_name", "r")) != FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) != FALSE) {
        $num = count($data);
        $row++;
        $mycsvfile[] = $data; //add the row to the main array.
    }
    fclose($handle);
    }
        for($i=0;$i<=$num;$i++){
            if(isset($mycsvfile[$i][1])&&($mycsvfile[$i][1] == $search_str)){
                // array_push($response,$mycsvfile[$i][3]);
                for($j=0;$j<=14;$j++){
                    if(isset($mycsvfile[$i][$j])){
                        array_push($response,$mycsvfile[$i][$j]);
                    }
                }
            }        
        }
echo json_encode($response);

}
// ----------------------------------------------------------------------

if(isset($_POST['rownum']) && isset($_POST['typo'])){

    $data='';
    if($_POST['typo'] =='fow'){
        $seperator=",";
        $file_name='../CSVs/history/flat_owner.csv';
        
        $searchrow=$_POST['rownum'];
        $row = 1;
        $mycsvfile = array(); //define the main array.
        $response = array();
        if (($handle = fopen("$file_name", "r")) != FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) != FALSE) {
            $num = count($data);
            $row++;
            $mycsvfile[] = $data; //add the row to the main array.
        }
        fclose($handle);
        }
        for($j=0;$j<=33;$j++){
            if(isset($mycsvfile[$rownum][$j])){
                array_push($response,$mycsvfile[$rownum][$j]);
                }
            }
        }
echo json_encode($response);

}



if(isset($_POST['trownum']) && isset($_POST['ttypo'])){

    $data='';
    if($_POST['ttypo'] =='ft'){
        $seperator=",";
        $file_name='../CSVs/history/flat_tenant.csv';
        
        $searchrow=$_POST['trownum'];
        $row = 1;
        $mycsvfile = array(); //define the main array.
        $response = array();
        if (($handle = fopen("$file_name", "r")) != FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) != FALSE) {
            $num = count($data);
            $row++;
            $mycsvfile[] = $data; //add the row to the main array.
        }
        fclose($handle);
        }
        for($j=0;$j<13;$j++){
            if(isset($mycsvfile[$trownum][$j])){
                array_push($response,$mycsvfile[$trownum][$j]);
                }
            }
        }
echo json_encode($response);

}

if(isset($_POST['shop_no'])){

   // $daata="";

    $file_name='../CSVs/history/shop_owner.csv';
        
    $search_str=$_POST['shop_no'];
    $row = 1;
    $mycsvfile = array(); //define the main array.
    $response = array();
    if (($handle = fopen("$file_name", "r")) != FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) != FALSE) {
        $num = count($data);
        $row++;
        $mycsvfile[] = $data; //add the row to the main array.
    }
    fclose($handle);
    }
        for($i=0;$i<=$num;$i++){
            if(isset($mycsvfile[$i][0])&&($mycsvfile[$i][0] == $search_str)){
                // array_push($response,$mycsvfile[$i][3]);
                for($j=0;$j<=14;$j++){
                    if(isset($mycsvfile[$i][$j])){
                        array_push($response,$mycsvfile[$i][$j]);
                    }
                }
            }        
        }
echo json_encode($response);
}


if(isset($_POST['strownum']) && isset($_POST['sttypo'])){

    $data='';
    if($_POST['sttypo'] =='st'){
        $seperator=",";
        $file_name='../CSVs/history/shop_tenant.csv';
        
        $searchrow=$_POST['strownum'];
        $row = 1;
        $mycsvfile = array(); //define the main array.
        $response = array();
        if (($handle = fopen("$file_name", "r")) != FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) != FALSE) {
            $num = count($data);
            $row++;
            $mycsvfile[] = $data; //add the row to the main array.
        }
        fclose($handle);
        }
        for($j=0;$j<8;$j++){
            if(isset($mycsvfile[$strownum][$j])){
                array_push($response,$mycsvfile[$strownum][$j]);
                }
            }
        }
echo json_encode($response);

}



error_reporting(E_WARNING);
?>