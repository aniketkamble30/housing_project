<?php

$conn = mysqli_connect( 'localhost','root',"",'house' );

//adding records

extract($_POST);

if(isset($_POST['notice'])){
 
	   $data ="";
	   $auery = "SELECT * FROM notice ORDER BY notice_id DESC";
	   $res =mysqli_query($conn,$auery);
	 
	   if(mysqli_num_rows($res)>0){
		 $number=1;
		 $i = 1;
         $data .='';
         $data.='<table class="table" id="general"><thead><th></th></thead><tbody>
         ';
	     while ($row = mysqli_fetch_array($res)) {
           $data .='<tr>
           <td>
			
                        <div class="card-header border-bottom" style="width:100%" id="heading'.$i.'" data-toggle="collapse" data-target="#collapse'.$i.'">'.$row['subject'].'<i class="mdi mdi-plus float-right"></i></div>				                          
                        <div id="collapse'.$i.'"style="width:100%;background-color:#eee;" class="border collapse" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
                            <p class="p-3">'.$row['Description'].'</p>
                            <p class="small ml-3">Posted on : '.date('d-m-Y',strtotime($row['Date'])).'</p></div>                          
                   </td></tr>';
				   $number++;
				   $i++;
	 
             }
             $data.='</tbody></table>';
	       }
	 else if(mysqli_num_rows($res)==0){
	   $data .='<p class="m-3"> No New Notices</p>';
	 }
	 
	 echo $data;
	 }

     if(isset($_POST['indi'])){
        $flat_no=$_POST['flat_no'];
        $data ="";
        $query = " SELECT * FROM notice_user WHERE `receiver`='$flat_no' ORDER BY id DESC";
        $res =mysqli_query($conn,$query);
      
        if(mysqli_num_rows($res)>0){
          $number=1;
          $i = 1;
          $data .='<table class="table" id="individual"><thead><th></th></thead><tbody>';
          while ($row = mysqli_fetch_array($res)) {
            $data .='<tr><td>
           
                         <div class="card-header border-bottom" style="width:100%" id="indiheading'.$i.'" data-toggle="collapse" data-target="#indicollapse'.$i.'">'.$row['subject'].'<i class="mdi mdi-plus float-right"></i></div>				                          
                         <div id="indicollapse'.$i.'"style="width:100%;background-color:#eee;" class="border collapse" aria-labelledby="indiheading'.$i.'" data-parent="#accordionExample">
                             <p class="p-3">'.$row['description'].'</p>
                             <p class="small ml-3">Posted on : '.date('d-m-Y',strtotime($row['datentime'])).'</p></div>                          
                  </td></tr>';
                    $number++;
                    $i++;
      
              }
              $data.='</tbody></table>';
            }
      else if(mysqli_num_rows($res)==0){
        $data .='<p class="m-3"> No New Notices</p>';
      }
      
      echo $data;
      }
 

