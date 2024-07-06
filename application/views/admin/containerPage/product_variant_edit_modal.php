<div class="modal fade" id="myModal_variant_<?php echo $view_data->variant_id;?>" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $product_names;?></h4>
      </div>
      <div class="modal-body">
        <?php 
       // echo "<pre>";
       // print_r($view_data);
       // echo '</pre>';
        ?>
          <form class="form-horizontal" action="#" method="post">
            <div class="form-group">
               <input type="hidden" class="ext_sku_id" name="ext_sku_id" id="ext_sku_id<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->sku_id;?>">
              <label class="control-label col-sm-5" for="email">SKU ID:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="sku-id<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->sku_id;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-5" for="pwd">Pack Size:</label>
              <div class="col-sm-7">
                <input type="number" class="form-control packSize-class" data-id="<?php echo $view_data->variant_id;?>" id="pach-size<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->pack_size;?>">
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-sm-5" for="pwd">Units:</label>
              <div class="col-sm-7">
                <select type="text" class="form-control units-class" data-id="<?php echo $view_data->variant_id;?>" id="units<?php echo $view_data->variant_id;?>">
                <option value="">-Select-</option>
                  <?php
                    if($units_list!=0){
                      foreach($units_list as $value){
                         $selected= ($value->units_name==$view_data->units) ? 'selected':'';
                        ?>
                          <option value="<?php echo $value->units_id.'__'.$value->units_name;?>" <?php echo $selected; ?>><?php echo $value->units_name;?></option>
                        <?php
                      }
                    }
                  ?>
                </select>

                <!-- <input type="text" class="form-control" id="edit_units<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->units;?>"> -->
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-sm-5" for="pwd">Price:</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" id="price<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->price;?>">
              </div>
            </div>

              <div class="form-group">
              <label class="control-label col-sm-5" for="pwd">Before Off Price:</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" id="beforeOffprice<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->before_off_price;?>">
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-sm-5" for="qty">QTY Stock:</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" id="stock<?php echo $view_data->variant_id;?>" value="<?php echo $view_data->stock;?>">
              </div>
            </div>

            <!--  <div class="form-group">
              <label class="control-label col-sm-5" for="conv">Conversion Factor (Kg):</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" id="conversion-factor<?php //echo $view_data->variant_id;?>" value="<?php echo $view_data->conversion_factor;?>">
              </div>
            </div> -->
            
            <div class="form-group">
              <div class="col-sm-12">
                <button type="button" class="btn btn-primary edit-variants" data-id="<?php echo $view_data->variant_id;?>" style="float: right;">Edit</button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>