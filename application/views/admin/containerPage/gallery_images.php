
 <?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
if(!in_array('gallery-image',$actAcx) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }

 $gtypename=$this->my_libraries->getGalleryTag_name($this->uri->segment(3));
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

    <h3 class="fw-bold mb-0">Gallery Images (<?php echo $gtypename;?>)</h3>
    
     <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

     
    <?php

        $desabledAtrr=(in_array('edit',$actAcx) && $this->uri->segment(4)!="") ?'' :((in_array('add',$actAcx)) ? '': (($session['admin_type']=='A') ?'':'disabled'));

      if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ 
        ?>

       <div class="btn-group" role="group" style="padding: 0 5px 0;">
        <button type="submit"  class="btn btn-primary custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100" data-toggle="modal" data-target="#myModal_gallery<?php echo $this->uri->segment(3);?>" <?php echo $desabledAtrr;?>>Upload Images</button>
       </div>
        <?php 
           $data1['img_id']=$this->uri->segment(3);
           $data1['tag_names']=$this->my_libraries->getGalleryTag_name($this->uri->segment(3));
           $data1['details']=0;
           $this->load->view('admin/containerPage/gallery_image_upload_modal',$data1);
      ?>

     <?php } ?>

      <a href="<?php echo base_url('admin/gallery_tag_list');?>"><button type="button" class="btn btn-primary custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100">Back</button></a>

  </div>

</div>
</div>
</div> <!-- Row end  -->  

<div class="row g-3 mb-3">

<div class="col-lg-12">
<div class="card mb-3">

 
    
    <div class="card-body">

         <?php //if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ ?>
        <!-- <form action="#" method="POST"> -->
            <!-- <div class="row g-3 align-items-center"> -->
                <!-- <div class="col-md-6"> -->
                    <!-- <label  class="form-label">Select Tag</label> -->

                    <!-- <input type="text" class="form-control" id="sub-category" value="<?php echo ($subCat_detaials!=0) ? $subCat_detaials[0]->subCat_name : '';?>"> -->
                    <!-- <input type="hidden" class="form-control" id="sub-cat-id" value="<?php echo ($subCat_detaials!=0) ? $subCat_detaials[0]->sub_cat_id :'';?>"> -->
                    <!-- <input type="hidden" class="orm-control" id="get-cat-id" value="<?php echo $this->uri->segment(3);?>"> -->
                    <!-- get-cat-id -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </form> -->
        <?php //} ?>
         <!-- ------------------------------------ -->
      <p>&nbsp;</p>
         <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                      <?php 
                                        // echo "<pre>";
                                        // print_r($this->my_libraries->getProductImage($gtypename));
                                        // echo "</pre>";
                                      ?>
                                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;white-space: nowrap;">
                                            <thead>
                                                <tr>
                                                    <th>SerNo</th>
                                                    <th>Image Name</th>
                                                    <th>Iamge</th>
                                                    <th>Date</th>
                                                     <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                    <th>Status</th>
                                                    <?php } ?>
                                                     <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                    <th>Action</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody class="row_position_imgs____">
                                                <?php
                                                $productimage_list=$this->my_libraries->getProductImage($gtypename);
                                                $imageGallery=($imageList_list!=0) ? $imageList_list :array();
                                                $arrayMerge=array_merge($productimage_list,$imageGallery);
                                               if($arrayMerge!=0){

                                               $index=0;
                                                foreach (array_reverse($arrayMerge) as $key => $value) {
                                                  if($value->gallery_id!=0){
                                                    $value->image_type='gallery_image';
                                                    }

                                                    $index++;
                                                    ?>
                                                     <tr id="<?php echo $value->gallimg_id;?>">
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        <td><?php echo $value->image_name;?></td>

                                                        <td>
    							                               <?php
                                                    
                                                    $imgFile_=$this->my_libraries->getproductImageGallery($value->image_type,$value);

    							                                //  $filePath=(($value->gallery_images!="") ? './uploads/gallery_image/'.$value->gallery_images :'');
    							                                // if(file_exists($filePath)){
    							                                //    $imgFile=base_url().'uploads/gallery_image/'.$value->gallery_images;
    							                                // }else{
    							                                //   $imgFile=base_url().'include/assets/default_product_image.png';
    							                                // }
    							                                ?>
							                                <img src="<?php echo $imgFile_;?>" style="width:40px; height:40px;border:1px solid grey; ">
							                             </td>
                                                       
                                                        <td><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                                                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>

                                                          <?php if($value->image_type=="gallery_image"){ ?>

                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->gallimg_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                          <?php } ?>

                                                        </td>
                                                         <?php } ?>
                                                        

                                                        <td>
                                                           <?php if($value->image_type=="gallery_image"){ ?>

                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                                <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                

                                                                 <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#myModal_gallery<?php echo $this->uri->segment(3).'_'.$value->gallimg_id;?>"><i class="icofont-edit text-success"></i></a>

                                                                 <?php 
                          														          $data2['img_id']=$this->uri->segment(3).'_'.$value->gallimg_id;
                          														           $data2['tag_names']=$this->my_libraries->getGalleryTag_name($this->uri->segment(3));
                          														           $data2['details']=$value;
                          														           $this->load->view('admin/containerPage/gallery_image_upload_modal',$data2);
                          														      ?>

                                                                
                                                                <?php } ?>
                                                                
                                                                <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->gallimg_id;?>" data-id="<?php echo base64_encode($value->gallimg_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                                <?php } ?>
                                                            </div>

                                                          <?php } ?>
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