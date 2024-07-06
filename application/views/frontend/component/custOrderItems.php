  <!-- Modal -->
        <div class="modal fade order-item-cus" id="exampleModal<?php echo $keyid;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Items (<?php echo $values->order_generated_order_id;?>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="order_view_item">
                   <?php 
                    
                   if($itemData!=0){

                    foreach ($itemData as $key => $value) {

                        // echo "<pre>";
                        // print_r($value->pro_sys_product_id);
                        // echo "</pre>";

                          $filePath=(($value->pro_product_img!="") ? './uploads/'.$value->pro_product_img :'');
                            if(file_exists($filePath)){
                               $imgFile1=base_url().'uploads/'.$value->pro_product_img;
                            }else{
                              $imgFile1=base_url().'include/assets/default_product_image.png';
                          }
                        ?>
                        <!-- $itemData->pro_product_img -->

                            <div class="row mb-20 border-bottom">
                                <div class="col-md-1">
                                    <div class="search_img"><img src="<?php echo $imgFile1;?>"></div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="cat_prod2">
                                        <p><?php echo $value->pro_sub_cat_name;?></p>
                                        <h4><?php echo $value->pro_product_name;?></h4>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="weight">
                                        <p><?php echo $value->packsize.''.$value->units;?></p>
                                    </div>
                                </div>


                                <div class="col-md-4 mb-20">
                                    <?php if(!in_array('Canceled',$ordProcess) && in_array('Delivered',$ordProcess)){ ?> 
                                      <a href="<?php echo base_url('rating-review').'/?itm='.base64_encode($values->order_generated_order_id).'&por='.base64_encode($value->pro_sys_product_id);?>"><div class="btn btn_dark float-right" style="background-color: #f99100 !important;color: white !important; font-weight: 600;float: right;"><span class="material-symbols-outlined" style="padding: 0 5px 0;margin-top: -5px;">star</span>Rate & Review</div></a>
                                  <?php } ?>
                                </div>
                                


                            </div>

                        <?php
                        }
                    }
                   ?>

                </div>
              </div>
            </div>
          </div>
        </div>