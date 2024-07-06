  <!-- Modal -->
        <div class="modal fade cancel-order-cusr" id="cancelModal<?php echo $keyid_;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Select a reason to cancel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="order_view_item">
                  
                        <!-- $itemData->pro_product_img -->

                            <div class="row mb-20">
                                <div class="col-md-12">
                                    <div>
                                        <div class="form-group">
                                            <input type="hidden" id="oid" value="<?php echo $orid;?>">
                                            <select type="text" id="reason" name="reason" class="form-control">
                                               <?php
                                                if($reason_list!=0){
                                                    foreach ($reason_list as $key => $value) {
                                                       ?>
                                                       <option value="<?php echo $value->reasons_id;?>"><?php echo $value->reasons;?></option>
                                                       <?php
                                                    }
                                                }
                                               ?>   
                                            </select>
                                        </div>
                                       <!--  <div class="form-group">
                                             <textarea type="text" class="form-control" rows="5" placeholder="Tell us What went wrong (Optional)"></textarea>
                                        </div> -->

                                         <div class="form-group">
                                             <button type="text" class="btn btn_dark float-right cancel-order" style="background-color:#FDD736 !important;">Cancel Order</button>
                                        </div>
                                       
                                    </div>
                                </div>
                                
                            </div>

                       

                </div>
              </div>
            </div>
          </div>
        </div>