
 <?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
 $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
 ?>
<!-- Body: Body -->
<div class="body d-flex py-3">
<div class="container-xxl">

<div class="row align-items-center">
<div class="border-0 mb-4">
<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
    
    <div class="mob_back_btn">
        <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
    </div>

    <h3 class="fw-bold mb-0">Sub Category (<?php echo $this->my_libraries->getCate_name($this->uri->segment(3));?>)</h3>
    <?php

        $desabledAtrr=(in_array('edit',$actAcx) && $this->uri->segment(4)!="") ?'' :((in_array('add',$actAcx)) ? '': (($session['admin_type']=='A') ?'':'disabled'));

      if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ 
        ?>

       <!-- <button type="submit" class="btn btn-primary subcat-bt custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100 sub-cat-save" <?php //echo $desabledAtrr;?>>Save</button> -->

    <div class="row"> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">       
            <a href="<?php echo base_url('Admin/category'); ?>"><button type="submit" class="btn btn-primary custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100">Back</button></a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">    
           <button type="submit" class="btn btn-primary subcat-bt custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100 sub-cat-save" <?php echo $desabledAtrr;?>>Save</button>
        </div>   
    </div>

     <?php } ?>

</div>
</div>
</div> <!-- Row end  -->  

<div class="row g-3 mb-3">

<div class="col-lg-12">
<div class="card mb-3">

 
    
    <div class="card-body">

         <?php if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ ?>
            <div class="loaderdiv lod-div"></div>
        <form class="form" id="catForm" action="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label  class="form-label">Sub category</label>

                    <input type="text" class="form-control" id="sub-category" name="sub_category" value="<?php echo ($subCat_detaials!=0) ? $subCat_detaials[0]->subCat_name : '';?>">
                    <input type="hidden" class="form-control" id="sub-cat-id" name="sub_cat_id" value="<?php echo ($subCat_detaials!=0) ? $subCat_detaials[0]->sub_cat_id :'';?>">
                    <input type="hidden" class="orm-control" id="get-cat-id" name="get_cat_id" value="<?php echo $this->uri->segment(3);?>">
                    <!-- get-cat-id -->
                </div>

                <div class="col-md-5">
                  <label  class="form-label">Image</label>
                     <input type="file" id="image-file" name="uplofile" class="form-control">
                     <input type="hidden" id="image-file-path" name="uplofile_path" class="form-control" value="<?php echo ($subCat_detaials!=0) ? $subCat_detaials[0]->subcat_image :'';?>">
                     <input type="hidden" id="subcat-ci" name="ci_sub_cat_name" class="form-control" value="<?php echo ($subCat_detaials!=0) ? $subCat_detaials[0]->ci_sub_cat_name :'';?>">
                </div>
                 <div class="col-md-1">
                    <?php if($subCat_detaials[0]->subcat_image!=""){ ?>
                     <img src="<?php echo base_url().'uploads/'.$subCat_detaials[0]->subcat_image;?>" style="width:30px;height: 30px;margin-top: 30%;">
                   <?php } ?>
                </div>
            </div>
        </form>
        <?php } ?>
         <!-- ------------------------------------ -->
      <p>&nbsp;</p>
         <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0" style="width: 100%;white-space: nowrap;">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Sub Category Id</th>
                                                    <th>Sub Categories</th>
                                                    <th>Date</th>
                                                     <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <th>Status</th>
                                                     <?php } ?>
                                                    <?php if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                       <th>Stock</th>
                                                      <?php } ?>
                                                       <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="row_position_subcate">
                                                <?php
                                             if($subcategory_list!=0){
                                               $index=0;
                                                foreach (array_reverse($subcategory_list) as $key => $value) {
                                                    $index++;
                                                    ?>
                                                     <tr id="<?php echo $value->sub_cat_id.'__'.$value->cat_id;?>">
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        <td><?php echo $value->sub_cat_id;?></td>
                                                        <td><?php echo $value->subCat_name;?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($value->update_date));?></td>
                                                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->sub_cat_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                         <?php } ?>
                                                        <?php if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                       <td>
                                                            <label class="switch">
                                                                   <input type="checkbox" data-id="<?php echo base64_encode($value->sub_cat_id.':::'.implode(',',$in_stock_active_inactive));?>" class="cate-sub-stock-status" <?php echo ($value->in_stock_status==1) ?'checked' :'';?>>
                                                                   <span class="slider round"></span>
                                                                </label>
                                                        </td>
                                                           <?php } ?>

                                                           <td><img src="

                                                            <?php 

                                                            if($value->subcat_image!=""){
                                                                   echo base_url().'uploads/'.$value->subcat_image;
                                                               }else{
                                                                  echo base_url().'include/default_cat.jpg';
                                                               }
                                                        ?>" style="width:80px;height: 80px;"></td>

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                 <a href="<?php echo base_url('admin/child_category/'.$value->cat_id.'/'.$value->sub_cat_id);?>" class="btn btn-outline-secondary">Child Category</a>


                                                                <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <a href="<?php echo base_url('admin/sub_category/'.$value->cat_id.'/'.$value->sub_cat_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                                <?php } ?>
                                                                
                                                                <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->sub_cat_id;?>" data-id="<?php echo base64_encode($value->sub_cat_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                   </tr>
                                                    <?php
                                                }
                                             }
     
                                                ?>
                                               
                                               
                                                <!-- <tr>
                                                    <td><strong>#0004</strong></td>
                                                    <td>Mobile</td>
                                                    <td>April  02, 2021</td>
                                                    <td><span class="badge bg-warning">Scheduled</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="categories-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                          
                                               
                                                
                                               
                                              
                                              
                                                <tr>
                                                    <td><strong>#0011</strong></td>
                                                    <td>Flower Port</td>
                                                    <td>February 08, 2021</td>
                                                    <td><span class="badge bg-success">Published</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="categories-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>#0012</strong></td>
                                                    <td>Accessories</td>
                                                    <td>March 28, 2021</td>
                                                    <td><span class="badge bg-success">Published</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="categories-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>#0013</strong></td>
                                                    <td>Bags</td>
                                                    <td>March 08, 2021</td>
                                                    <td><span class="badge bg-success">Published</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="categories-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

         <!-- -------------------------- -->


    </div>
</div>

</div>
</div><!-- Row end  --> 

</div>
</div>  