
<?php
// echo "<pre>";
// print_r($actAcx);
// print_r($session['admin_type']);
// echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>
<!-- Body: Body -->
<style type="text/css">
   th{
    text-align: center;
   } 
</style>
<div class="body d-flex py-3">
<div class="container-xxl">
<div class="row align-items-center">
<div class="border-0">
<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
<div class="mob_back_btn">
   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
</div>
<h3 class="fw-bold mb-0">Ads Banner List</h3>
 <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
    <a href="<?php echo base_url('admin/add_ads_banner');?>"><button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Add Ads Banner</button></a>
<?php } ?>
</div>
</div>
</div> <!-- Row end  -->


<div class="row g-3 mb-3">
<div class="col-md-12">
<div class="card category_list_css">
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle mb-0" style="width: 100%;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Header</th>
                <!-- <th>Header-2</th> -->
                <!-- <th>Description</th> -->
                <th>Link</th>
                <th>Image</th>
                <!-- <th>Mobile Image</th> -->
                <th>Created By</th>
                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                <th>Status</th>
                 <?php } ?>

                <th>Date</th>
                  <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx) || in_array('setting',$actAcx)) || $session['admin_type']=='A'){ ?>
                <th><span style="">Action</span></th>
                 <?php } ?>
            </tr>
        </thead>
        <tbody class="row_position_banner">
            <?php  
            if($ads_banner_list!=0){
                $index=0;
                ;
                foreach(array_reverse($ads_banner_list) as $value){
                    
                   $index++;
                    ?>

                     <tr id="<?php echo $value->banner_id;?>">
                        <td style="text-align:right"><strong><?php echo $index;?></strong></td>
                        
                        <td style="text-align:left"><?php echo $value->text1;?></td>
                        <!-- <td><?php //echo $value->text2;?></td> -->
                         <!-- <td><?php //echo getShortData($value->description,30);?></td> -->
                         <td style="text-align:center;"><?php echo $value->button_link;?></td>
                         <td>
                            <?php
                              $filePath=(($value->desk_image!="") ? './uploads/banner/'.$value->desk_image :'');
                            if(file_exists($filePath)){
                               $imgFile=base_url().'uploads/banner/'.$value->desk_image;
                            }else{
                              $imgFile=base_url().'include/assets/default_product_image.png';
                            }

                            ?>
                            <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">
                        </td>

                        <!-- <td> -->
                            <?php
                            //   $mobilefilePath=(($value->mobile_image!="") ? './uploads/banner/'.$value->mobile_image :'');
                            // if(file_exists($mobilefilePath)){
                            //    $mobileimgFile=base_url().'uploads/banner/'.$value->mobile_image;
                            // }else{
                            //   $mobileimgFile=base_url().'include/assets/default_product_image.png';
                            // }

                            ?>
                            <!-- <img src="<?php //echo $mobileimgFile;?>" style="width:40px; height:40px;border:1px solid grey; "> -->
                        <!-- </td> -->

                        
                        <td style="text-align:center;"><?php echo $value->updated_by;?></td>
                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                        <td>
                             <label class="switch">
                               <input type="checkbox" data-id="<?php echo base64_encode($value->banner_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                               <span class="slider round"></span>
                            </label>
                        </td>
                    <?php } ?>
                         <td style="text-align:right;"><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                        
                        
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">


                                 <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                <a href="<?php echo base_url('admin/add_ads_banner/'.$value->banner_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                            <?php } ?>
                              <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->banner_id;?>" data-id="<?php echo base64_encode($value->banner_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
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
