
<?php
   // echo "<pre>";
   // print_r($getAccess['inputAction']);
   // print_r($session['admin_type']);
   // echo "</pre>";
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
                                <h3 class="fw-bold mb-0">KYF List</h3>
                                 <?php if(in_array('add',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
                                    <a href="<?php echo base_url('admin/add_kyf');?>"><button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Add KYF</button></a>
                             <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->


                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card category_list_css">
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Header</th>
                                                <th>Image</th>
                                                <!-- <th>Description</th> -->
                                                <th>Created By</th>
                                                 <?php if(in_array('status',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
                                                <th>Status</th>
                                                 <?php } ?>

                                                <th>Date</th>
                                                  <?php if((in_array('edit',$getAccess['inputAction']) || in_array('delete',$getAccess['inputAction']) || in_array('setting',$getAccess['inputAction'])) || $session['admin_type']=='A'){ ?>
                                                <th><span style="float: right;">Action</span></th>
                                                 <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row_position_kyf">
                                            <?php  
                                            if($kyf_list!=0){
                                                $index=0;
                                                ;
                                                foreach(array_reverse($kyf_list) as $value){
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                    // echo "</pre>";
                                                   $index++;
                                                    ?>

                                                     <tr id="<?php echo $value->kyf_id;?>">
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        
                                                        <td><?php echo $value->header;?></td>
                                                         <td>
                                                            <?php
                                                              $filePath=(($value->image!="") ? './uploads/user/'.$value->image :'');
                                                            if(file_exists($filePath)){
                                                               $imgFile=base_url().'uploads/user/'.$value->image;
                                                            }else{
                                                              $imgFile=base_url().'include/assets/default_product_image.png';
                                                            }

                                                            ?>
                                                            <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">
                                                        </td>
                                                        <!-- <td><?php //echo getShortData($value->short_details,30);?></td> -->
                                                        <td><?php echo $value->updated_by;?></td>
                                                         <?php if(in_array('status',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->kyf_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    <?php } ?>
                                                         <td><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                                                        
                                                        
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">


                                                                 <?php if(in_array('edit',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
                                                                <a href="<?php echo base_url('admin/add_kyf/'.$value->kyf_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <?php } ?>
                                                              <?php if(in_array('delete',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->kyf_id;?>" data-id="<?php echo base64_encode($value->kyf_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
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
            </div>
