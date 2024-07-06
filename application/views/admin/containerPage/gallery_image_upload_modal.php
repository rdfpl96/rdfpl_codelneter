<div class="modal fade galscc" id="myModal_gallery<?php echo $img_id;?>" role="dialog">
  <div class="modal-dialog" style="max-width: 1000px;">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $tag_names;?> <span style="color:red;font-size: 13px;">(Image dimension should be 1000 X 1000 Px.)</span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php 
       // echo "<pre>";
       // print_r($details);
       // echo '</pre>';
        ?>
          <form class="form-horizontal" id="gallery-form<?php echo $img_id;?>" action="#" method="post" enctype="multipart/form-data">
            
                <div class="col-md-12">
                    <input type="hidden" name="increment" id="increment" value="1">
                    <input type="hidden" name="get_tagid" id="get_tagid" value="<?php echo $img_id;?>">
                    <table class="table">
                  
                     <tr class="add-tr<?php echo $img_id;?>">
                        <td class="tbl-td">
                        <div class="row"> 
                            <div class="col-sm-11 width_80">
                              <input type="hidden" name="input_img_id<?php echo $img_id;?>[]" id="img-id1" value="<?php echo ($details!=0) ? $details->gallimg_id :'';?>">
                              <input type="text" class="form-control" id="heading1" name="heading<?php echo $img_id;?>[]" placeholder="Image name" value="<?php echo ($details!=0) ? $details->image_name :'';?>">
                            </div>
                        </div>
                       </td>
                        <td>
                          <input type="file" name="galleryImg<?php echo $img_id;?>[]" id="galleryImg1" class="form-control" accept="image/*">
                          <input type="hidden" name="imagePath<?php echo $img_id;?>[]"  id="imagePath1" class="form-control" value="<?php echo ($details!=0) ? $details->gallery_images :'';?>">
                          <?php
                          if($details!=0) {

                           $filePath=(($details->gallery_images!="") ? './uploads/gallery_image/'.$details->gallery_images :'');
                              if(file_exists($filePath)){
                                 $imgFile=base_url().'uploads/gallery_image/'.$details->gallery_images;
                              }else{
                                $imgFile=base_url().'include/assets/default_product_image.png';
                              }
                          ?>
                          <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">

                        <?php } ?>
                       </td>
                       <td>
                         <?php
                          if($details==0) { ?>
                            <div class="col-sm-1 width_20">
                              <button type="button" class="btn btn-info add-more-gallery">+</button>
                           </div>
                         <?php } ?>

                       </td>
                    </tr>
               </table>
           </div>

            <div class="form-group">
              <div class="col-sm-12">
                  <?php $updt_id=($details!=0) ?'_'.$details->gallimg_id :'';?>

                  <div class="loaderdiv"></div>
                  <button type="button" class="btn btn-primary add-gallery-images" data-id="<?php echo $img_id;?>" style="float: right;"><?php echo ($details==0) ? 'Add' :'Update'; ?></button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>