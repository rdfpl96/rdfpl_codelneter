<?php
// $actAcx
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
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
                                <h3 class="fw-bold mb-0">Gallery Tag List</h3>
                                <?php

                                    $desabledAtrr=(in_array('edit',$actAcx) && $this->uri->segment(3)!="") ?'' :((in_array('add',$actAcx)) ? '': (($session['admin_type']=='A') ?'':'disabled'));

                                  if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ 
                                    ?>
                                 
                                 <div class="loaderdiv"></div>
                                 <button type="button" class="btn btn-primary ga_cl custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100 galleryTag-save" <?php echo $desabledAtrr;?>>Save</button>

                                  <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

<!-- 
 -->
                    <div class="card-body">
                         <?php if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ ?>
                            <form>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <label  class="form-label">Gallery Tag</label>
                                        <input type="hidden" id="get-tag-id" value="<?php echo ($tag_detaials!=0) ? $tag_detaials[0]->gallery_id :'';?>">
                                        <input type="text" class="form-control" id="gallery-tag" name="gallery_tag" value="<?php echo ($tag_detaials!=0) ? $tag_detaials[0]->header_name :'';?>">
                                    </div>
                                  
                                </div>
                            </form>
                        <?php } ?>
                </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Gallery Tag Name</th>
                                                <th>Updated By</th>
                                                <th>Image Count</th>
                                                <th>Date</th>
                                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th>Status</th>
                                            <?php } ?>

                                            <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th><span style="">Action</span></th>
                                            <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row_position_tag">
                                            <?php  
                                            if($tag_list!=0){
                                                $index=0;
                                                foreach(array_reverse($tag_list) as $value){
                                                   $index++;
                                                    ?>

                                                     <tr id="<?php echo $value->gallery_id;?>">
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        <td><?php echo $value->header_name;?></td>
                                                        <td><?php echo $value->updated_by;?></td>
                                                        <td><?php echo $this->my_libraries->getGalleryImageCount($value->gallery_id,$value->header_name);?></td>
                                                         <td><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                                                          <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                            
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->gallery_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    <?php } ?>

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">


                                                            	<?php if(in_array('gallery-image',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                     <a href="<?php echo base_url('admin/gallery_images/'.$value->gallery_id);?>" class="btn btn-outline-secondary">Gallery Images</a>
                                                               <?php } ?> 
                                                              

                                                            <?php if($value->header_name!='Products') { ?>

                                                                   <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                    <a href="<?php echo base_url('admin/gallery_tag_list/'.$value->gallery_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                                <?php } ?>


                                                                   <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                    <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->gallery_id;?>" data-id="<?php echo base64_encode($value->gallery_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                                 <?php } ?>

                                                        <?php } ?>
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

          