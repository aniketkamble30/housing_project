<?php 
$conny = mysqli_connect("localhost","root","","house");
require_once('../frontend_files_php/vendor/excelphp/php-excel-reader/excel_reader2.php');
require_once('../frontend_files_php/vendor/excelphp/SpreadsheetReader.php');
extract($_POST);

if (isset($_POST["import"]))
{   $montho = '';
    $montho = $_POST['month'];
    echo 'got smth';
 if($montho == ''){
    echo '<script>alert("Select Correct Month !"); </script>';
 }
else{
    echo 'got smth';
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = '../frontend_files_php/vendor/uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
                $txndate = "";
                if(isset($Row[0])) {
                    $timestamp = strtotime($Row[0]);
                    $dmy = date("Y-m-d h:i:s", $timestamp);
                    $txndate = $dmy;
                }                
                $description = "";
                if(isset($Row[1])) {
                    $description = $Row[1];
                }
                $chequeno = "";
                if(isset($Row[1])) {
                    $chequeno = $Row[2];
                }
                $crdr = "";
                if(isset($Row[1])) {
                    $crdr = $Row[3];
                }
                $amount = "";
                if(isset($Row[1])) {
                    $amount = $Row[4];
                } 
                
                if (!empty($txndate) || !empty($description)|| !empty($chequeno)|| !empty($crdr)|| !empty($amount)) {
                    $sql = ("SELECT * FROM `bank_record_temp` WHERE dato = '".$txndate."' AND description = '".$description."' AND amount = '".$amount."' ");
                    $req = mysqli_query($conny, $sql);
                    $ress = mysqli_fetch_assoc($req);
                    if($ress){
                        $type = "danger";
                        $message = "Problem in Importing Excel Data.<br>The Data may Already Exist in the Database Please Check Before Inserting.";
                        }
                        else{
                            $query = "INSERT INTO `bank_record_temp`(`dato`, `description`, `chequeno`, `crdr`, `amount`,`month`) 
                        values('".$txndate."','".$description."','".$chequeno."','".$crdr."','".$amount."','".$montho."')";
                        $result = mysqli_query($conny, $query);
                    }
                    
                    if (! empty($result)) {
                        // $requery = "INSERT IGNORE INTO `bankrecord`(`month`) VALUES ('".$montho."')";
                        // $tes = mysqli_query($conny,$requery);
                        $type = "success";
                        $message = "Excel Data Imported into the Database"; 
                    } 
                    else if(empty($result)) {
                        $type = "danger";
                        $message = "Problem in Importing Excel Data.<br>The Data may Already Exist in the Database Please Check Before Inserting.";
                    }
                }
             }
         }
    }
  else  { 
        $type = "danger";
        $message = "Invalid File Type. Upload Excel File.";
        }
}
echo $message;
}
?>