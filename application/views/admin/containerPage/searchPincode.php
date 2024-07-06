 <?php  
 // $actAcx
               $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
                if($pincode_list!=0){
                    $index=0;
                    ;
                    foreach($pincode_list as $value){
                       $index++;
                        ?>

                         <tr>
                            <td><strong><?php echo $index;?></strong></td>
                            <td><?php echo $value->pincode;?></td>
                            <td><?php echo $value->delivery_city;?></td>
                            <td>
                               <?php //if($werehouse_list!=0) {
                                    // $wrHosuCode=array_filter(explode(',',$value->werehouse));
                                ?>
                                 <?php //foreach ($werehouse_list as $key => $whvalue) { 
                                       //$exploreV=end(explode('_',$whvalue->werehouse_code));
                                       //$checked = (in_array($exploreV,$wrHosuCode)) ? 'checked':'';
                                    ?>
                                      <!-- &nbsp;<label class="checkbox-inline checkboocss upt-mappi" data-id="<?php //echo $value->pincode_id;?>"><input type="checkbox" name="wh_code<?php //echo $value->pincode_id;?>" value="<?php //echo $exploreV;?>" <?php //echo $checked;?>> <?php //echo $whvalue->werehouse_name;?></label> -->
                                       
                                  <?php //} ?>
                               <?php //} ?>

                               <?php echo $value->werehouse;?>
                                
                             <!-- <div class="loaderdiv<?php //echo $value->pincode_id;?>"></div> -->
                           </td>
                            <td><?php echo $value->updated_by;?></td>
                            <td class="date_css"> <div class="date_css"><?php echo date('d-m-Y',strtotime($value->add_date));?></div></td>

                            <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                            <td>
                                 <label class="switch">
                                   <input type="checkbox" data-id="<?php echo base64_encode($value->pincode_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                   <span class="slider round"></span>
                                </label>
                            </td>
                        <?php } ?>
                            
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                     <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>

                                      <a href="<?php echo base_url('admin/add_pincode/'.$value->pincode_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                   <?php } ?>
                                     
                                     <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                       <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->pincode_id;?>" data-id="<?php echo base64_encode($value->pincode_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                    <?php } ?>

                                </div>
                            </td>
                        </tr>

                        <?php
                    }
                }

                ?>
                <tr>
                  <td colspan="8">
                   <div id="pagint-div" style="float: right;">
                    <?php echo $links;?>
                   </div>
                   </td>
                </tr>