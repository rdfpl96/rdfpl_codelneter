
<?php
 $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
if(!in_array('setting',$actAcx) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
?>
   <!-- Body: Body -->
<div class="body d-flex py-3">
<div class="container-xxl">
<div class="row align-items-center">
<div class="border-0">
<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
    <div class="mob_back_btn">
       <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
    </div>
    <h3 class="fw-bold mb-0">Menu list <span style="font-size: 18px;color:grey;">(<?php echo $this->my_libraries->getUser_name($getuserId);?>)</span></h3>

    <div class="user_list_btn">
    <button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100 menus-access-save">Add</button>
    <button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100 remove-access" style="color:white;">Remove</button>
    </div>

</div>
</div>
</div> <!-- Row end  -->


<!-- filters end -->
<div class="row g-3 mb-3">
<div class="col-md-12">
<div class="card">
  <?php

  
 // echo "<pre>";
 //                         print_r($controlAccess);
 //                         echo "</pre>";
  ?>
    <div class="card-body">
        <div class="table-responsive">
           <input type="hidden" class="user-id" id="user-id" value="<?php echo $this->uri->segment(3);?>">
          
           <table class="table table-hover align-middle mb-0" style="width: 100%;white-space: nowrap;" >
                <thead>
                    <tr>
                        <th style="width: 20px;">SerNo</th>
                        <th style="width: 30px;">Select</th>
                        <th>Menu name</th>
                        <th style="width: 600px;">Action</th>
                    </tr>
                </thead>
                <tbody class="row_position_sidebar">
                    <?php  


                    if($menus_list!=0){
                        $index=0;
                        ;
                        foreach(array_reverse($menus_list) as $key=>$value){
    
                            $getSubMenu=$this->sqlQuery_model->sql_select_where_desc('tbl_sidebar_menus','position',array('sub_menu_id'=>trim($value->menus_id)));
                             $menusVal=$this->my_libraries->getSelectedUserAccess($getuserId,$value->menus_id);
                             $checkedInput=($menusVal['menu_id']==$value->menus_id) ?'checked': '';

                           
                            $index++;
                            ?>
                     
                             <tr id="<?php echo $value->menus_id;?>">
                                <td><strong><?php echo $index;?></strong></td>
                                <td><input type="checkbox" name="menuName[]" class="menuclass <?php echo ($getSubMenu!=0) ? 'sub-menuAction':'';?>" value="<?php echo $value->menus_id;?>" <?php echo $checkedInput;?>></td>
                                <td><a data-bs-toggle="collapse" href="#menus_it<?php echo $index;?>" role="button" aria-expanded="true"><?php echo $value->menu_name;?> <?php echo ($getSubMenu!=0) ? '<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 19px;padding:0 2% 0;"></i>':'';?></a></td>
                                <td>
                                 <?php
 
                                  if($value->action_option!=""){
                                    $explodeValue=explode(',', $value->action_option);
                                     if($explodeValue!=array()){
                                        foreach ($explodeValue as $key => $act_value) {
                                             $act_checked=(in_array($act_value,($menusVal['inputAction']!="") ? $menusVal['inputAction']:array())) ? 'checked':'';
                                             $act_disabled=(in_array($act_value,($menusVal['inputAction']!="") ? $menusVal['inputAction']:array())) ? '':'disabled';
                                             $act_disabled=($checkedInput=='checked') ? '':'disabled';
  
                                             
                                            ?>
                                             <label class="checkbox-inline"><input type="checkbox" class="actionClass<?php echo $value->menus_id;?>" name="action_mode[]" value="<?php echo $act_value;?>:::<?php echo $value->menus_id;?>" <?php echo $act_checked;?> <?php echo $act_disabled;?>> <?php echo $act_value;?></label>&nbsp;
                                            <?php

                                        }
                                     }
                                  }


                                 ?>

                                    
                                </td>

                            </tr>

                            <tr style="background-color: lightgrey; padding: 0 !important;">
                                <td colspan="11"  class="tb-class">
                                    <div class="collapse" id="menus_it<?php echo $index;?>">
                                      <table class="table tbl-class-vari">
                                        <tbody class="body-duv">
                                            <?php 

                                    
                                                if($getSubMenu!=0){
                                                  $menuChecked=$checkedInput;

                                                      $index1=0;
                                                    foreach ($getSubMenu as $key_sub => $sub_value) {
                                                        $index1++;
                                                        $menuSelection=$this->my_libraries->getSelectedUserAccess($getuserId,$sub_value->menus_id);


// echo "<pre>";
// print_r($menuSelection);
// echo "</pre>";
                                                     if($menuSelection!=array()){
                                                        $checkedInput=($menuSelection['menu_id']==$sub_value->menus_id) ? 'checked': (($menuChecked=='checked') ? '':'disabled') ;
                                                      }else{
                                                        $checkedInput='';
                                                      }
                                                                
                                                        
                                                       
                                                ?>
                                                    <tr>
                                                        <td style="width: 65px;"><strong></strong></td>
                                                        <td style="width: 68px;"><input type="checkbox" name="menuName[]" class="menuclass<?php echo $sub_value->sub_menu_id;?> sub-menu" value="<?php echo $sub_value->menus_id;?>" <?php echo $checkedInput;?>></td>
                                                        <td><?php echo $sub_value->menu_name;?></td>
                                                        <td style="width: 600px;">
                                                         <?php
                                                          if($sub_value->action_option!=""){
                                                            $explodeValuesub_value=explode(',', $sub_value->action_option);
                                                             if($explodeValuesub_value!=array()){
                                                                foreach ($explodeValuesub_value as $key => $sact_value) {


                                                                   if($menuSelection!=array()){

                                                                     $sub_act_checked=(in_array($sact_value,$menuSelection['inputAction'])) ? 'checked':'';

                                                                   // $sub_act_disabled=(in_array($sact_value,$menuSelection['inputAction'])) ? '':'disabled';

                                                                      $sub_act_disabled=($checkedInput=='checked') ? '':'disabled';
                                                                   }else{

                                                                    $sub_act_checked='';
                                                                    $sub_act_disabled='';

                                                                   }

                                                                    ?>
                                                                     <label class="checkbox-inline"><input type="checkbox" name="action_mode[]" class="actionClass<?php echo $sub_value->menus_id;?> act_all<?php echo $sub_value->sub_menu_id;?>" value="<?php echo $sact_value;?>:::<?php echo $sub_value->menus_id;?>" <?php echo $sub_act_checked;?> <?php echo $sub_act_disabled;?> > <?php echo $sact_value;?></label>&nbsp;
                                                                    <?php
                                                                }
                                                             }
                                                          }
                                                         ?>  
                                                        </td>
                                                   </tr> 
                                                <?php
                                                  }
                                                }
                                            ?>
                 
                                    </tbody>
                                     </table>
                         
                              </div>
                                </td>
                            </tr>

                        <?php
                        }
                    }

                    ?>

                </tbody>
            </table>
 



        

        </div>
        
    </div>
</div>
</div>
</div>
</div>
</div>





 
       

