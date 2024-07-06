<div class="modal fade" id="myModal_offers_<?php echo $view_data->variant_id;?>" role="dialog">
  <div class="modal-dialog">



    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $product_names;?> (<?php echo $view_data->pack_size;?><?php echo $view_data->units;?>) </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
          <?php
          // echo "<pre>";
          // print_r($offers);
            ?>

          <form class="form-horizontal" action="#" method="post">
            <div class="row">
            <div class="form-group col-sm-6">
              
              <label class="control-label col-sm-5" for="email">Start Date:</label>
              <div class="col-sm-12">
                <input type="date" class="form-control" min="<?php echo date('Y-m-d');?>" id="start-date<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_start_date :''; ?>">
              </div>
            </div>
            <div class="form-group col-sm-6">
              <label class="control-label col-sm-5" for="pwd">End date:</label>
              <div class="col-sm-12">
                <input type="date" class="form-control" min="<?php echo date('Y-m-d');?>" id="end-date<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_end_date :''; ?>">
              </div>
            </div>
            <p>&nbsp;</p>

            <div class="form-group col-sm-12" style="padding: 0px 10px 10px;">
              <label class="control-label col-sm-5" for="pwd">Purchase Product Name:</label>
              <div class="col-sm-12">
                 <input type="text" class="form-control" id="product-name-purchase<?php echo $view_data->variant_id;?>" value="<?php echo $product_names;?>">
              </div>
            </div>

          </div>

             


            <div class="form-group" style="padding: 0px 0 10px;">
              <label class="control-label col-sm-5" for="pwd">Min. Qty:</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" id="min-qty<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_min_qty :''; ?>">
              </div>
            </div>

             <div class="form-group" style="padding: 0px 0 10px;">
              <label class="control-label col-sm-5" for="qty">Free Offer:</label>
              <div class="col-sm-12">
                <table class="table">
                  <tr>
                    <th style="padding: 10px 0px 10px;">Product name</th>
                    <th style="padding: 10px 0px 10px;">Pack Size | Unit</th>
                    <th style="padding: 10px 0px 10px;">Qty</th>
                  </tr>
                   <tr>
                    <th style="padding: 10px 10px 10px 0px;">
                      <input type="text" class="form-control" id="pname<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_product_name :''; ?>"></th>
                     <th style="padding: 10px 10px 10px 0px;">

                         <div class="input-group">
                          <input type="number" class="form-control" id="psize<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_packsize :''; ?>">
                          <select class="form-control" id="offer-units<?php echo $view_data->variant_id;?>">
                            <option value="">-Select-</option>
                              <?php
                                if($units_list!=0){
                                  foreach($units_list as $value){
                                    $getUnits=($offers!=0)? $offers[0]->offer_units :'';
                                     $selected_offer= ($value->units_name==$getUnits) ? 'selected':'';
                                    ?>
                                      <option value="<?php echo $value->units_name;?>" <?php echo $selected_offer;?>><?php echo $value->units_name;?></option>
                                    <?php
                                  }
                                }
                              ?>
                            </select>
                        </div>

   
                    </th>
                    <th style="padding: 10px 10px 10px 0px;"><input type="number" class="form-control" id="pqty<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_qty :'1'; ?>"></th>
                  </tr>

                </table>
              </div>
            </div>

              <div class="form-group">
              <div class="col-sm-12">
               

                <button type="button" class="btn btn-primary offer-apply" data-id="<?php echo $view_data->variant_id;?>_<?php echo ($offers!=0)? $offers[0]->offer_id :''; ?>" style="float: right;"> <?php echo ($offers!=0)? 'Edit Offer' :'Add Offer'; ?></button>
                <?php if($offers!=0){ ?>
                 <button type="button" class="btn btn-info offer-delete" data-id="<?php echo ($offers!=0)? $offers[0]->offer_id :''; ?>" style="float: right;margin-right: 10px;color:white;">Delete</button>
               <?php } ?>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>