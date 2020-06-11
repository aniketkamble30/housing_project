<?php
require 'dbh.php';
$strip = '';
$add = 0.0;
$minus = 0.0;
$tab = NULL;

if(isset($_POST['newtype'])){
  $sql = "UPDATE `daily_product` SET `type` ='".$_POST['newtype']."' WHERE `id`='".$_POST['changetypeid']."'";
$result = mysqli_query($conn,$sql);
if($result) { echo 'done';
 } else{ echo 'notdone';}

}


  if(isset($_POST['from'])){
$f1 = $_POST['from'];
$j = strtotime($f1); 
$from = date("Y-m-d h:i:s",$j);
$t1 = $_POST['till'];
$i = strtotime($t1);
$till = date("Y-m-d h:i:s",$i);
// echo '<script>console.log("'.$from.'");</script>';
$sql = "SELECT * FROM daily_product WHERE dato >='".$from."' AND dato<='".$till."' ORDER BY dato ASC";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
$tab .="
 <table class='table table-bordered' id = 'myTable'>
     <thead bgcolor='#f6f6f6'>
     <th>Description</th>
     <th>Amount</th>
     <th>Credit/Debit</th>
     <th>Date</th>
     <th>Update Type</th>
     </thead>
     <tbody>
     ";
    while ($row = mysqli_fetch_array($result)) {
            $tab .="<tr>
            <td>".date('Y-m-d',strtotime($row['dato']))."</td>         
            <td>".$row['description']."</td>";

                if($row['crdr']=='CR'){
                    $strip = preg_replace('/[^a-zA-Z0-9\s.]/', '', $row['amount']);
                    $add += floatval($strip);
                    $tab .="<td>".$strip."</td>
                    <td class='text-success'><strong>Credited</strong></td>
                    <td width='30%'>
                    <div class='row'>
                      <div class='col-8'>
                      <select class='custom-select shadow-sm' ";
                        if($row['type'] == 'NotSet'){
                        }else{
                          
                          $tab .='disabled';
                        }
                      $tab.=" id='select_".$row['id']."'>
                       <option value='null'
                       ";if($row['type'] == 'NotSet'){
                         $tab .='selected';
                      }
                       $tab.=" >Choose..
                        </option><option value='MMC'
                        ";if($row['type'] == 'MMC'){
                           $tab .='selected';
                        }
                         $tab.=" >MMC</option>
                        <option value='Rent'
                        ";if($row['type'] == 'Rent'){
                           $tab .='selected';
                        }
                         $tab.=">Rent</option>
                         </select>
                        <p class='text-danger text-small' id='small-alert' style='display:none;'>Choose Some Value</p>
                      </div>
                      <div class='col-4'>";
                      if($row['type'] == 'NotSet'){
                        $tab.="<button class='mt-1 px-2 py-2 shadow-sm save-btn' id='update".$row['id']."' onclick=\"updatetype('".$row['id']."')\">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <button class='mt-1 px-2 py-2 shadow-sm btn btn-outline-danger'  style='display:none;' id='edit".$row['id']."' onclick=\"edittype('".$row['id']."')\">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>";
                      }else{
                        $tab .="<button class='mt-1 px-2 py-2 shadow-sm save-btn' style='display:none;' id='update".$row['id']."' onclick=\"updatetype('".$row['id']."')\">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <button class='mt-1 px-2 py-2 shadow-sm btn btn-outline-danger' id='edit".$row['id']."' onclick=\"edittype('".$row['id']."')\">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>";
                      }
                        
                        
                      $tab.="</div>
                    </div>
                    </td>";
                }
                else{
                    $strip = preg_replace('/[^a-zA-Z0-9\s.]/', '', $row['amount']);
                    $minus += floatval($strip);
                    $tab .="<td>".$strip."</td>
                    <td class='text-danger'><strong>Debited</strong></td>
                    <td width='30%'>
                    <div class='row'>
                      <div class='col-8'>
                      <select class='custom-select shadow-sm' ";
                        if($row['type'] == 'NotSet'){
                        }else{
                          
                          $tab .='disabled';
                        }
                      $tab.=" id='select_".$row['id']."'>
                       <option value='null'
                       ";if($row['type'] == 'NotSet'){
                         $tab .='selected';
                      }
                       $tab.=" >Choose..
                        </option><option value='AMC'
                        ";if($row['type'] == 'AMC'){
                           $tab .='selected';
                        }
                         $tab.=" >AMC</option>
                        <option value='PettyCash'
                        ";if($row['type'] == 'PettyCash'){
                           $tab .='selected';
                        }
                         $tab.=">Petty Cash</option>
                        <option value='Miscellaneous'
                        ";if($row['type'] == 'Miscellaneous'){
                           $tab .='selected';
                        }
                         $tab.=">Miscellaneous</option>
                      </select>
                      <p class='text-danger text-small' id='small-alert' style='display:none;'>Choose Some Value</p>
                      </div>
                      <div class='col-4'>
                     <button class='mt-1 px-2 py-2 shadow-sm save-btn' id='update".$row['id']."' onclick=\"updatetype('".$row['id']."')\">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;
                      </button>
                      <button class='mt-1 px-2 py-2 shadow-sm btn btn-outline-danger'style='display:none;' id='edit".$row['id']."' onclick=\"edittype('".$row['id']."')\">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;
                      </button>
                      </div>
                    </div>
                    </td>";
                }
                $tab .="
                </tr>
                ";
                
              }
              $tab .= "
              </tbody>
              <tfooter>
                <tr>
                    <td colspan='4' class='text-center'><b><span class='text-success'>Credited:</span> ₹ ".floatval($add)." /-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='text-danger'>Debited:</span> ₹ ".floatval($minus)."/-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class='text-info'>Balance:</span> ₹ ".floatval($add - $minus)."</b></td>
                </tr>
              </tfooter>
              </table>";
              
                $val1 = floatval($add);
                $val2 = floatval($minus);
                $val3 = floatval($add - $minus);
                $j=date('d-m-Y',$j);
                $i=date('d-m-Y',$i);
              $new = array(
                  'tab'=>$tab,
                  'val1'=>$val1,
                  'val2'=>$val2,
                  'val3'=>$val3,
                  'from'=>$j,
                  'till'=>$i
                );
                echo json_encode($new) ;
          }
          else{ $new = array(
            'tab'=>"<h3 class='text-danger'>Oops! no record found :(</h3>
            <a href='bankimport.php'>To add Record Click Here </a></div>",
          );
          echo json_encode($new) ;
          }
        }?>