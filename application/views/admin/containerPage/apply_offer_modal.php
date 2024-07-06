<div class="modal fade" id="myModal_offers_<?php echo $view_data->variant_id;?>" role="dialog">
  <div class="modal-dialog" style="max-width: 700px!important;">

             <?php

             $sql=$this->sqlQuery_model->sql_select_where('tbl_product_apply_offer',array('offer_product_unique_id'=>$pro_unique_number,'offer_variant_id'=>$view_data->variant_id));

               $currentDate=date('Y-m-d');
               $startDate=date($offers[0]->offer_start_date);
               $endDate=date($offers[0]->offer_end_date);

               $numberCurrent=strtotime($currentDate);
               $numberstart=strtotime($startDate);
               $numberend=strtotime($endDate);

           if($numberstart <= $numberCurrent && $numberend >= $numberCurrent){ 
               $expire='';
            }else{
              $expire='<span style="color: red;border: 1px solid red;padding: 1px 10px 1px;border-radius: 10px;">Expired</span>';
            }
             
          ?>

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $product_names;?> (<?php echo $view_data->pack_size;?><?php echo $view_data->units;?>)</h4> <?php echo ($sql!=0) ? $expire :'';?> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
    
          <form class="form-horizontal" action="#" id="myforms<?php echo $view_data->variant_id;?>" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="form-group col-sm-6">
              
              <label class="control-label col-sm-5" for="Start Date">Start Date:</label>
              <div class="col-sm-12">
                <input type="date" class="form-control" min="<?php echo date('Y-m-d');?>" id="start-date<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_start_date :''; ?>">
              </div>
            </div>
            <div class="form-group col-sm-6">
              <label class="control-label col-sm-5" for="End date">End date:</label>
              <div class="col-sm-12">
                <input type="date" class="form-control" min="<?php echo date('Y-m-d');?>" id="end-date<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_end_date :''; ?>">
              </div>
            </div>
            

            <div class="form-group col-sm-6">
              <label class="control-label col-sm-5" for="product" style="padding: 10px 0 0;">Purchase Product Name:</label>
              <div class="col-sm-12">
                 <input type="text" class="form-control" id="product-name-purchase<?php echo $view_data->variant_id;?>" value="<?php echo $product_names;?>">
              </div>
            </div>

             <div class="form-group col-sm-3">
              <label class="control-label col-sm-5" for="category" style="padding: 10px 0 0;">Category:</label>
              <div class="col-sm-12">
                <?php echo $this->my_libraries->getCategoryDropdownHtml($view_data->variant_id,$pro_unique_number,$offers[0]->offer_category);?>
               
              </div>
            </div>

            <div class="form-group col-sm-3">
              <label class="control-label col-sm-5" for="min-qty" style="padding: 10px 0 0;">Min. Qty:</label>
              <div class="col-sm-12">
                <input type="number" class="form-control" id="min-qty<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_min_qty :''; ?>">
              </div>
            </div>

           


            <div class="form-group col-sm-12">
               <h5 class="control-label" for="qty" style="padding: 10px 0px 0px;">Free Offer</h5>
              <label class="control-label col-sm-5" for="pro">Product Name: <span style="font-weight: bold;"><?php echo $this->my_libraries->getProductNameUnique_id($offers[0]->offer_product_name,'pName');?></span></label>
                <input type="text" name="search_product" id="search_product" class="form-control search-product" data-id="<?php echo $view_data->variant_id;?>_<?php echo ($offers!=0)? $offers[0]->offer_product_name :''; ?>" placeholder="Search">
                 <ul style="height: 120px; overflow-y: scroll; list-style-type: none;padding: 10px 5px 0; background-color: white;" id="ul-list<?php echo $view_data->variant_id;?>">
                    <?php 
                     $data['view_data']=$view_data->variant_id;
                     $data['edit_value']=($offers!=0)? $offers[0]->offer_product_name : '';
                    $this->load->view('admin/containerPage/search_offer_product_div',$data);?>
                    </ul>
                    <p id="pnameerr<?php echo $view_data->variant_id;?>"></p>
                </div>


                <div class="form-group col-sm-6">
              <label class="control-label col-sm-5" for="Pack Size">Pack Size</label>
              <div class="col-sm-12">
                     <?php 
                     echo $this->my_libraries->getPacksizeDropdownHtml($view_data->variant_id,$offers[0]->offer_product_name,$offers[0]->offer_packsize);?>
              </div>
            </div>
            

            <div class="form-group col-sm-6">
              <label class="control-label col-sm-5" for="Qty">Qty:</label>
              <div class="col-sm-12">
                 <input type="number" class="form-control" id="pqty<?php echo $view_data->variant_id;?>" value="<?php echo ($offers!=0)? $offers[0]->offer_qty :'1'; ?>">
              </div>
            </div>
          </div>

             


              
              <div class="form-group">
                <p>&nbsp;</p>
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

