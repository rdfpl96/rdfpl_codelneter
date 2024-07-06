<div class="modal fade" id="myModal_courier" role="dialog">
  <div class="modal-dialog" style="max-width: 1200px !important;">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Courier Details</h4>

        <button type="button" id="modalClose" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div style="height:450px;overflow-y: scroll;">
        <div class="table-responsive">
           <table class="table">
            <tr>
              <th></th>
              <th>Courier Name</th>
              <th>Min Weight</th>
              <th>Rating</th>
              <th>Expected Pickup</th>
              <th>Estimated Delivery</th>
              <th>Chargeable Weight</th>
              <th>Charges</th>
              <th>RTO Charges</th>
              <th>Action</th>
            </tr>
            <?php
               
                if(property_exists($resp,'data')){

                  $arrMinValue=array();
                  foreach ($resp->data->available_courier_companies as $key => $value1) {
                    array_push($arrMinValue,$value1->rate);
                  }

                  $getMinVa=min($arrMinValue);
                  foreach ($resp->data->available_courier_companies as $key => $value) {
                   // echo "<pre>";
                   // print_r($getMinVa);
                   // print_r($value->courier_company_id);
                   // echo "</pre>";
                    ?>
                     <tr>
                      <th><i class="icofont icofont-vehicle-delivery-van" style="font-size:36px;"></i></th>
                       <td><?php echo $value->courier_name;?><br><?php echo ($value->is_surface==1) ? 'Surface':'';?></td>
                       <td><?php echo $value->min_weight;?>Kg</td>
                       <td><?php echo $value->rating;?></td>
                       <td><?php echo getWeekName($value->pickup_availability);?></td>
                       <td><?php echo $value->etd;?></td>
                       <td><?php echo $value->charge_weight;?>Kg</td>
                       <td>₹<?php echo $value->rate;?></td>
                       <td>₹<?php echo $value->rto_charges;?></td>
                       <td><div class="form-check">
                          <input class="form-check-input courierbtn" value="<?php echo $value->courier_company_id;?>" type="radio" name="courierCheck" <?php echo ($getMinVa==$value->rate) ? 'checked':'';?>>
                        </div>
                      </td>
                     </tr>


                    <?php
                  }
        
                }

            ?>
            </table>
          </div>

          </div>

             <div class="alertmess_errr"></div>
             <div class="loaderdiv-cour"></div>
            <button type="button" class="btn btn-primary ship-now" style="margin-top: 15px;float: inline-end;" data-id="<?php echo $shipment_id;?>">Ship Now</button>
          
      </div>
    </div>
  </div>
</div>

