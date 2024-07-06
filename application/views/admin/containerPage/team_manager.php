
<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>
<style>
    th{
        text-align: center;
    }
</style>
 <!-- Body: Body -->
 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Team List</h3>
                                <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Back</button>
                                </div>
                                <div class="col-md-6">
                                 <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                    <a href="<?php echo base_url('admin/add_team');?>"><button type="button" class="btn btn-primary py-2 px-6 text-uppercase btn-set-task w-sm-100 add-user">Add Teams</button></a>
                                <?php } ?>
                                </div>
                                </div>
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
                                                <th>Sr.No.</th>
                                                <th>Name</th>
                                                <th>Profile Image</th>
                                                <th>Designation</th>
                                                <th>Short Description</th>
                                                <th>Facebook Link</th>
                                                <th>Twitter Link</th>
                                                <th>Instagram Link</th>
                                                <th>Linkedin Link</th>
                                                <th>Created By</th>
                                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th>Status</th>
                                                 <?php } ?>

                                                <th>Date</th>
                                                  <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx) || in_array('setting',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th><span style="float: right;">Action</span></th>
                                                 <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row_position_team">
                                            <?php  
                                            if($team_list!=0){
                                                $index=0;
                                                ;
                                                foreach(array_reverse($team_list) as $value){
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                    // echo "</pre>";
                                                   $index++;
                                                    ?>

                                                     <tr id="<?php echo $value->team_id;?>">
                                                        <td style="text-align:right;"><strong><?php echo $index;?></strong></td>
                                                        
                                                        <td><?php echo $value->name;?></td>
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
                                                        <td style="text-align:left"><?php echo $value->designation;?></td>
                                                        <td><?php echo getShortData($value->short_details,30);?></td>
                                                        <td style="text-align:center"><?php echo $value->fb_link;?></td>
                                                         <td style="text-align:center"><?php echo $value->twitter_link;?></td>
                                                        <td style="text-align:center"><?php echo $value->insta_link;?></td>
                                                        <td style="text-align:center"><?php echo $value->linkedin_link;?></td>
                                                        <td style="text-align:center"><?php echo $value->updated_by;?></td>
                                                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->team_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    <?php } ?>
                                                         <td style="text-align:right;width:200px"><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                                                        
                                                        
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">


                                                                 <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <a href="<?php echo base_url('admin/add_team/'.$value->team_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <?php } ?>
                                                              <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->team_id;?>" data-id="<?php echo base64_encode($value->team_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
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
