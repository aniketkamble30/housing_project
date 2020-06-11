<?php
session_start();
$conn =new mysqli('localhost','root','','house') or die(mysqli_error($conn));
extract($_POST);
if(isset($_POST['faq'])){
    $faq = '';
    $i = 1;
    $query = "SELECT * FROM `faq`";
    $res = mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
           while($row = mysqli_fetch_array($res)){
            $faq .='
            <table class="table table-borderless" id="faqtable">
                    <thead>
                        <th></th>
                    </thead>
                    <tbody>
                    <tr>
                    <td>
                    <div class="card-body p-3 m-0" style="background-color:#c9e8ff" id="heading'.$i.'" class="" data-toggle="collapse" data-target="#collapse'.$i.'">Q.  '.$row['question'].'<i class="mdi mdi-plus float-right"></i></div>				                          
                        <div id="collapse'.$i.'" class="border collapse" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
                            <p class="p-3"><b>Answer: &nbsp;</b>'.$row['answer'].'</p>
                            <p class="small ml-3">Posted on : '.$row['posted'].' ';
                            if($_SESSION['role']=='shop'){
                                $faq .='<span class="float-right mb-3 mr-3 btn btn-sm btn-danger" onclick="delfaq('.$row['id'].')">Delete Faq</span>';
                            }
                            $faq .='</p>
                        </div>
                    </td>
                    </tr>
                    </tbody>            
            </table>'
            
            ;
            $i++;
        }
    } 
    echo $faq;
}

if(isset($_POST['cont'])){
    $faq = '';
    $i = 1;
    $query5 = "SELECT * FROM `emgcontacts` ORDER BY `type` ASC";
    $ufo = mysqli_query($conn,$query5);
    if(mysqli_num_rows($ufo)>0){
        $faq .=' <div class="px-5">
        <table class="table-bordereless" cellpadding="10" style="width:100%;" id="conttable">
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>';
                            if($_SESSION['role']=='admin'){
                            $faq .='<td></td>';
                            }
                $faq .='</tr>
                    </thead>
                    ';
           while($top = mysqli_fetch_array($ufo)){
            $faq .='<tr class="border-bottom">
                        <td>'.$top['type'].'</td>
                        <td><i class="mdi mdi-phone"></i>  &nbsp;'.$top['number'].'</td>';
                        if($_SESSION['role']=='admin'){
                            $faq .='<td> <button class="btn border border-danger  btn-sm mb-1" onclick="delcont('.$top['id'].')">Remove</button></td> ';
                        }
                    $i++;
                }
                $faq .='</tr>
                </table>';
    } 
    echo $faq;
}

if(isset($_POST['faqquest'])){
    $faqquest = mysqli_real_escape_string($conn,$_POST['faqquest']);
    $faqans = mysqli_real_escape_string($conn,$_POST['faqans']);
    $adrply='';
    $query1 = "INSERT INTO `faq`(`question`, `answer`) VALUES ('$faqquest','$faqans')";
    $res = mysqli_query($conn,$query1);
    if($res){
        $adrply .= '<p class=" m-2 alert alert-success">FAQ Added Successfully.</p>';
    }
    else{
        $adrply .= '<p class=" m-2 alert alert-warning">Error Adding FAQ.</p>';
    }
 echo $adrply;
}

if(isset($_POST['conttype'])){
    $conttype = mysqli_real_escape_string($conn,$_POST['conttype']);
    $contnum = mysqli_real_escape_string($conn,$_POST['contnum']);
    $adr='';
    $query6 = "INSERT INTO `emgcontacts`(`type`, `number`) VALUES ('$conttype','$contnum')";
    $res = mysqli_query($conn,$query6);
    if($res){
        $adr .= '<p class=" m-2 alert alert-success">Contact Added Successfully.</p>';
    }
    else{
        $adr .= '<p class=" m-2 alert alert-warning">Error Adding Contact.</p>';
    }
 echo $adr;
}

if(isset($_POST['faqsearch'])){
    // $faqsearch = $_POST['faqsearch'];
    $faqsearch = "%".$_POST['faqsearch']."%";
    $sea ='';
    $i =1;
    $query2 = "SELECT * FROM `faq` WHERE answer LIKE '$faqsearch'  OR question LIKE '$faqsearch' ";
    $ans = mysqli_query($conn,$query2);
    if(mysqli_num_rows($ans)>0){
        while($rop = mysqli_fetch_array($ans)){
            $sea .='<div class="row mb-2" style="width:100%">
                        <div class="card-body" style="background-color:#c9e8ff"  id="heading'.$i.'" class="" data-toggle="collapse" data-target="#collapse'.$i.'">Q.  '.$rop['question'].'<i class="mdi mdi-plus float-right"></i></div>				                          
                        <div id="collapse'.$i.'"style="width:100%" class="border collapse" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
                            <p class="p-3"><b>Answer: &nbsp;</b>'.$rop['answer'].'</p>
                            <p class="small ml-3">Posted on : '.$rop['posted'].'';
                            if($_SESSION['role']=='admin'){
                                $sea .='<span class="float-right mb-3 mr-3 btn btn-sm btn-danger" onclick="delfaq('.$rop['id'].')">Delete Faq</span>';
                            }
                          $sea .=' </div>                          
                    </div>';
                    $i++;
        }
    }
    else{
        $sea .= '<p class=" m-2 alert alert-warning">No results.</p>';
    }
 echo $sea;
}

if(isset($_POST['fid'])){
    $fid = $_POST['fid'];
    $rply='';
    $query3 = "DELETE FROM `faq` WHERE id = '$fid'";
    $res = mysqli_query($conn,$query3);
    if($res){
        $rply .= '<p class=" m-2 alert alert-success">FAQ Deleted Successfully.</p>';
    }
    else{
        $rply .= '<p class=" m-2 alert alert-warning">Error Deleting FAQ.</p>';
    }
 echo $rply;
}
if(isset($_POST['cid'])){
    $cid = $_POST['cid'];
    $crp='';
    $query4 = "DELETE FROM `emgcontacts` WHERE id = '$cid'";
    $res = mysqli_query($conn,$query4);
    if($res){
        $crp .= '<p class=" m-2 alert alert-success">Contact Deleted Successfully.</p>';
    }
    else{
        $crp .= '<p class=" m-2 alert alert-warning">Error Deleting Contact.</p>';
    }
 echo $crp;
}

