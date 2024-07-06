
 <?php  
 // $actAcx
               $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
                                            if($hsn_list!=0){
                                                $index=0;
                                                ;
                                                foreach(array_reverse($hsn_list) as $value){
                                                   $index++;
                                                    ?>

                                                     <tr>
                                                        <td style="text-align:right"><strong><?php echo $index;?></strong></td>
                                                        <td style="text-align:right"><?php echo $value->hsn_code;?></td>
                                                        <td style="width:300px;"><div class="" style="width:300px;"><?php echo $value->description;?></div></td>
                                                        <td style="text-align:center;"><?php echo $value->updated_by;?></td>
                                                        <td class="date_css" style="text-align:right"> <div class="date_css"><?php echo date('d-m-Y',strtotime($value->add_date));?></div></td>

                                                        <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->hsn_code_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    <?php } ?>
                                                        
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                                 <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>

                                                                  <a href="<?php echo base_url('admin/add_hsn/'.$value->hsn_code_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                               <?php } ?>
                                                                 
                                                                 <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                   <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->hsn_code_id;?>" data-id="<?php echo base64_encode($value->hsn_code_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                                <?php } ?>

                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            }

                                            ?>
                                            <tr>
                                              <td colspan="7">
                                               <div id="pagint-div" style="float: right;">
                                                <?php echo $links;?>
                                               </div>
                                               </td>
                                            </tr>