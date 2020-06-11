<?php
 extract($_POST);
 extract($_FILES);

$conn = new mysqli('localhost','root','','house') or die(mysqli_error($conn));

if(isset($_POST['form'])){
    $flat_no=$_POST['flat_no'];
    $data='';
    $type='';
    $head=array();
    if(substr($flat_no,0,1)=='S'){
        if(substr($flat_no,-1)=='T'){
            $type='shop_tenant';
        }
        else{
            $type='shop';
        }
    
    }
    else{
        if(substr($flat_no,-1)=='T'){
            $type='tenant';
        }
        else{
            $type='resident';
        }
    }

    if($type=='resident'){
        $sql="SELECT * FROM forms WHERE flat_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms";
    }
    else if($type=='tenant'){
        $sql="SELECT * FROM forms_tenant WHERE flat_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms_tenant";
    }
    else if($type=='shop'){
        $sql="SELECT * FROM forms_shop WHERE shop_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms_shop";
    }
    else if($type=='shop_tenant'){
        $sql="SELECT * FROM forms_shop_tenant WHERE shop_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms_shop_tenant";
    }

    $result=mysqli_query($conn, $sql);
    $result2=mysqli_query($conn, $sql2);
    $response=array();
    while($row2=mysqli_fetch_array($result2,MYSQLI_NUM)){
        array_push($head,$row2[0]);
    }
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        $data.='<input type="hidden" id="user_flat_no" name="user_flat_no" value="'.$flat_no.'">';     
        $n=count($row);
        for($i=2; $i<$n; $i++){
            $str=$head[$i];
            $data.='
          <div class="form-row">
            <div class="form-group col-8">';
            if($row[$i]){
                $data.='<p>'.$str.' <span class="text-success">&nbsp;&nbsp;[Submitted]</span>
                <span class="text-primary">&nbsp;(Click Below to change/update Document)</span></p>
                <div class="row">
                    <div class="col col-lg-8">
                        <div class="custom-file">
                        <input type="file" name='.$str.' class="custom-file-input" id='.$str.'  accept="application/pdf">
                        <label class="custom-file-label" for="'.$str.'">Choose file</label>
                        </div>
                    </div>
                    <div class="col col-lg-2">
                        <a onclick="view(\''.$flat_no.'\',\''.$str.'\')" class="btn btn-success shadow">View</a>
                    </div>
                </div><hr>';             
            }
            else{
                $data.='
                <label for='.$str.'>'.$str.'<span class="text-danger">&nbsp;&nbsp;[Not Submitted]</span></label>
                <div class="row">
                    <div class="col col-lg-8">
                        <div class="custom-file">
                            <input type="file" name='.$str.' class="custom-file-input" id='.$str.'  accept="application/pdf">
                            <label class="custom-file-label" for="'.$str.'">Choose File</label>
                        </div>    
                    </div>
                </div>
                <hr>';
            }
            $data.='</div>
                    </div>';
        }
        $data.='<input type="hidden" id="update_form_details" name="update_form_details" value="update_form_details">
                <button type="submit" class="btn btn-primary">Update Details</button>';
        $response['data']=$data;
    }
    else{
        if($type=='tenant' || $type=='shop_tenant'){
            $response['error']='You dont have a tenant registered with this number.';
        }
        else{
            $response['error']='Invalid Flat/Shop No.';
        }
    }
    echo json_encode($response);
}

if(isset($_POST['update_form_details'])){
    $flat_no=$_POST['user_flat_no'];
    if(substr($flat_no,0,1)=='S'){
        if(substr($flat_no,-1)=='T'){
            $type='shop_tenant';
        }
        else{
            $type='shop';
        }
    }
    else{
        if(substr($flat_no,-1)=='T'){
            $type='tenant';
        }
        else{
            $type='resident';
        }
    }
    if($type=='resident'){
        $sql="SELECT * FROM forms WHERE flat_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms";
    }
    else if($type=='tenant'){
        $sql="SELECT * FROM forms_tenant WHERE flat_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms_tenant";
    }
    else if($type=='shop'){
        $sql="SELECT * FROM forms_shop WHERE shop_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms_shop";
    }
    else if($type=='shop_tenant'){
        $sql="SELECT * FROM forms_shop_tenant WHERE shop_no='$flat_no'";
        $sql2 = "SHOW COLUMNS FROM forms_shop_tenant";
    }
    $head=array();
    $result=mysqli_query($conn, $sql);
    $result2=mysqli_query($conn, $sql2);
    while($row2=mysqli_fetch_array($result2,MYSQLI_NUM)){
        array_push($head,$row2[0]);
    }
    $row=mysqli_fetch_array($result,MYSQLI_NUM);  
    $n=count($row);
        
    for($i=2; $i<$n; $i++){
        $str=$head[$i];
        $a=explode(' ',$str);
        if(isset($_FILES[$a[0]]) && $_FILES[$a[0]]['name']!=''){
            $filename=$_FILES[$a[0]]['name'];
            $array=explode('.',$filename);
            $ext=strtolower(end($array));
            $tempname=$_FILES[$a[0]]['tmp_name'];
            $destination='../forms/'.$_POST['user_flat_no'].'/'.$a[0].'.'.$ext;
            if(file_exists($destination)){
                unlink($destination);
            }
            move_uploaded_file($tempname,$destination);
            if($type=='resident'){
                $sql="UPDATE forms SET `$str`='submitted' WHERE `flat_no`='$flat_no'";
            }
            else if($type=='tenant'){
                $sql="UPDATE forms_tenant SET `$str`='submitted' WHERE `flat_no`='$flat_no'";
            }
            else if($type=='shop'){
                $sql="UPDATE forms_shop SET `$str`='submitted' WHERE `shop_no`='$flat_no'";
            }
            else if($type=='shop_tenant'){
                $sql="UPDATE forms_shop_tenant SET `$str`='submitted' WHERE `shop_no`='$flat_no'";
            }
            mysqli_query($conn, $sql);
        }
    }
    session_start();
    if($_SESSION['username']=='admin'){
        header('Location: ../form_admin.php');
    }
    else if($type=='resident'){
        header('Location: ../form_user.php');
    }
    else if($type=='tenant'){
        header('Location: ../form_tenant.php');
    }
    else if($type=='shop'){
        header('Location: ../form_user.php');
    }
    else if($type=='shop_tenant'){
        header('Location: ../form_tenant.php');
    }
    else{
        header('Location: ../form_admin.php');
    }
    
}

if(isset($_POST['add'])){
    $field=$_POST['field'];
    $for=$_POST['for'];
    $response=array();
    if($for=='st'){
        $conn->query("ALTER TABLE `forms_shop_tenant` ADD `$field` TEXT NULL DEFAULT NULL AFTER `shop_no`") or die($conn->error);
        $response['success']="successfully added field";
    }
    else if($for=='t'){
        $conn->query("ALTER TABLE `forms_tenant` ADD `$field` TEXT NULL DEFAULT NULL AFTER `flat_no`") or die($conn->error);
        $response['success']="successfully added field";
    }
    else if($for=="fo"){
        $conn->query("ALTER TABLE `forms` ADD `$field` TEXT NULL DEFAULT NULL AFTER `flat_no`") or die($conn->error);
        $response['success']="successfully added field";
    }
    else if($for=='so'){
        $conn->query("ALTER TABLE `forms_shop` ADD `$field` TEXT NULL DEFAULT NULL AFTER `shop_no`") or die($conn->error);
        $response['success']="successfully added field";
    }
    echo json_encode($response);
}


if(isset($_POST['show_forms'])){
        $resident =NULL;
        $tenant =NULL;
        $shop =NULL;
        $shoptenant =NULL;

        $resident.='<h3 class="mt-3">Resident forms</h3>';
        $sql='show columns from forms';
        $result=mysqli_query($conn,$sql); 
        $resident.='<table class="table table-bordered table-striped" id="myMeetings"><thead class="bg-secondary text-white">
        <tr>
          <th >Form name</th>
          <th width="30%"></th>
        </tr>';
        $resident.='</thead>';
        $resident.='<tbody>';
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
          $resident.='<tr>';
          $resident.='<td >'.$row[0].'</td>';
          $resident.='<td ><button onclick="rmowner(\''.$row[0].'\')" class="btn btn-block  btn-outline-danger">Delete</button></td>';
          $resident.='</tr>';
        }
        $resident.='</tbody></table>';

      
        $tenant.='<h3 class="mt-3">Tenant forms</h3>';
        $sql='show columns from forms_tenant';
        $result=mysqli_query($conn,$sql); 
        $tenant.='<table class="table table-bordered table-striped" id="myMeetings"><thead class="bg-secondary text-white">
        <tr>
          <th >Form name</th>
          <th width="30%"></th>
        </tr>';
        $tenant.='</thead>';
        $tenant.='<tbody>';
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
          $tenant.='<tr>';
          $tenant.='<td >'.$row[0].'</td>';
          $tenant.='<td ><button onclick="rmtenant(\''.$row[0].'\')" class="btn btn-block  btn-outline-danger">Delete</button></td>';
          $tenant.='</tr>';
        }
        $tenant.='</tbody></table>';

        $shop.='<h3 class="mt-3">Shop forms</h3>';
        $sql='show columns from forms_shop';
        $result=mysqli_query($conn,$sql); 
        $shop.='<table class="table table-bordered table-striped" id="myMeetings"><thead class="bg-secondary text-white">
        <tr>
          <th >Form name</th>
          <th width="30%"></th>
        </tr>';
        $shop.='</thead>';
        $shop.='<tbody>';
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
          $shop.='<tr>';
          $shop.='<td >'.$row[0].'</td>';
          $shop.='<td ><button onclick="rmshop(\''.$row[0].'\')" class="btn btn-block  btn-outline-danger">Delete</button></td>';
          $shop.='</tr>';
        }
        $shop.='</tbody></table>';

        $shoptenant.='<h3 class="mt-3">Shop tenant forms</h3>';
        $sql='show columns from forms_shop_tenant';
        $result=mysqli_query($conn,$sql); 
        $shoptenant.='<table class="table table-bordered table-striped" id="myMeetings"><thead class="bg-secondary text-white">
        <tr>
          <th >Form name</th>
          <th width="30%"></th>
        </tr>';
        $shoptenant.='</thead>';
        $shoptenant.='<tbody>';
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
          $shoptenant.='<tr>';
          $shoptenant.='<td >'.$row[0].'</td>';
          $shoptenant.='<td ><button onclick="rmshoptenant(\''.$row[0].'\')" class="btn btn-block  btn-outline-danger">Delete</button></td>';
          $shoptenant.='</tr>';
        }
        $shoptenant.='</tbody></table>';
        $data = array(
            'resident'=>$resident,
            'tenant'=>$tenant,
            'shop'=>$shop,
            'shoptenant'=>$shoptenant
        );

        echo json_encode($data);
    }


    if(isset($_POST['rmowner'])){
        
        $directory = '../forms/';
        $response=array();
        foreach (scandir($directory) as $file) {
            if ($file !== '.' && $file !== '..') {
                $n=explode(" ",$name);
                if(file_exists($directory.''.$file.'/'.$n[0].'.pdf')){
                    // echo $directory.''.$file.'/'.$n[0].'.pdf';
                    unlink($directory.''.$file.'/'.$n[0].'.pdf');
                }
            }
        }

        $name=$_POST['name'];
        $sql="ALTER TABLE `forms` DROP `$name`";
        if(mysqli_query($conn,$sql)){
            $response['success']="true";
            echo json_encode($response);
        }
        else{
            $response['error']="true";
            echo json_encode($response);
        }
        
    
    }
    if(isset($_POST['rmtenant'])){
        $directory = '../forms/';

        foreach (scandir($directory) as $file) {
            if ($file !== '.' && $file !== '..') {
                $n=explode(" ",$name);
                if(file_exists($directory.''.$file.'/'.$n[0].'.pdf')){
                    // echo $directory.''.$file.'/'.$n[0].'.pdf';
                    unlink($directory.''.$file.'/'.$n[0].'.pdf');
                }
            }
        }
        $name=$_POST['name'];
        $sql="ALTER TABLE `forms_tenant` DROP `$name`";
        if(mysqli_query($conn,$sql)){
            $response['success']="true";
            echo json_encode($response);
        }
        else{
            $response['error']="true";
            echo json_encode($response);
        }

    }
    if(isset($_POST['rmshop'])){
        $directory = '../forms/';

        foreach (scandir($directory) as $file) {
            if ($file !== '.' && $file !== '..') {
                $n=explode(" ",$name);
                if(file_exists($directory.''.$file.'/'.$n[0].'.pdf')){
                    // echo $directory.''.$file.'/'.$n[0].'.pdf';
                    unlink($directory.''.$file.'/'.$n[0].'.pdf');
                }
            }
        }
        $name=$_POST['name'];
        $sql="ALTER TABLE `forms_shop` DROP `$name`";
        if(mysqli_query($conn,$sql)){
            $response['success']="true";
            echo json_encode($response);
        }
        else{
            $response['error']="true";
            echo json_encode($response);
        }

    }
    if(isset($_POST['rmshoptenant'])){
        $directory = '../forms/';

        foreach (scandir($directory) as $file) {
            if ($file !== '.' && $file !== '..') {
                $n=explode(" ",$name);
                if(file_exists($directory.''.$file.'/'.$n[0].'.pdf')){
                    // echo $directory.''.$file.'/'.$n[0].'.pdf';
                    unlink($directory.''.$file.'/'.$n[0].'.pdf');
                }
            }
        }
        $name=$_POST['name'];
        $sql="ALTER TABLE `forms_shop_tenant` DROP `$name`";
        if(mysqli_query($conn,$sql)){
            $response['success']="true";
            echo json_encode($response);
        }
        else{
            $response['error']="true";
            echo json_encode($response);
        }

    }