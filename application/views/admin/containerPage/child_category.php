
 <?php

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
    <?php

        $desabledAtrr=(in_array('edit',$actAcx) && $this->uri->segment(4)!="") ?'' :((in_array('add',$actAcx)) ? '': (($session['admin_type']=='A') ?'':'disabled'));

      if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ 
        ?>

       <button type="submit" class="btn btn-primary subcat-bt custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100 child-cat-save" <?php echo $desabledAtrr;?>>Save</button>

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
        <form action="#" method="POST">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label  class="form-label">Child category</label>
                    <input type="text" class="form-control" id="child-category" value="<?php echo ($childCat_detaials!=0) ? $childCat_detaials[0]->childCat_name : '';?>">

                     <input type="hidden" class="orm-control" id="get-cat-id" value="<?php echo $this->uri->segment(3);?>">

                    <input type="hidden" class="form-control" id="sub-cat-id" value="<?php echo $this->uri->segment(4);?>">

                    <input type="hidden" class="form-control" id="child-cat-id" value="<?php echo $this->uri->segment(5);?>">

                   
                    <!-- get-cat-id -->
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
        <th>SerNo</th>
        <!-- <th>Category Id</th> -->
        <!-- <th>Sub Category Id</th> -->

        <th>Child Categories</th>
        <th>Date</th>
         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
            <th>Status</th>
         <?php } ?>
        <?php //if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
           <!-- <th>Stock</th> -->
          <?php //} ?>
        <th>Action</th>
    </tr>
</thead>
<tbody class="row_position_childcate">
    <?php
 if($subcategory_list!=0){
   $index=0;
    foreach (array_reverse($subcategory_list) as $key => $value) {
            // echo "<pre>";
            // print_r($value);
            // echo "<pre>";
        $index++;
        ?>
         <tr id="<?php echo $value->sub_cat_id.'__'.$value->cat_id.'__'.$value->child_cat_id;?>">
            <td><strong><?php echo $index;?></strong></td>
            <!-- <td><?php echo $value->sub_cat_id;?></td> -->
            <td><?php echo $value->childCat_name;?></td>
            <td><?php echo date('d-m-Y',strtotime($value->update_date));?></td>
             <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
            <td>
                 <label class="switch">
                   <input type="checkbox" data-id="<?php echo base64_encode($value->child_cat_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                   <span class="slider round"></span>
                </label>
            </td>
             <?php } ?>
            <?php //if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
          <!--  <td>
                <label class="switch">
                       <input type="checkbox" data-id="<?php //echo base64_encode($value->child_cat_id.':::'.implode(',',$in_stock_active_inactive));?>" class="cate-sub-stock-status" <?php //echo ($value->in_stock_status==1) ?'checked' :'';?>>
                       <span class="slider round"></span>
                    </label>
            </td> -->
               <?php //} ?>

            <td>
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    
                    <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                    <a href="<?php echo base_url('admin/child_category/'.$value->cat_id.'/'.$value->sub_cat_id.'/'.$value->child_cat_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                    <?php } ?>
                    
                    <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                      <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->child_cat_id;?>" data-id="<?php echo base64_encode($value->child_cat_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
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

<!-- -------------------------- -->


</div>
</div>

</div>
</div><!-- Row end  --> 

</div>
</div>  