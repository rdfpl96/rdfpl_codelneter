<?php 

                // echo "<pre>";
                // print_r($actAcx);
                // echo "</pre>";
                $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array(); 
                if($product_list!=0){

                    foreach($product_list as $value){

                      // echo "<pre>";
                      // print_r($value->pro_ci_sub_cat_name);
                      // echo "</pre>";

                              $getVarients=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variants_unique_number'=>trim($value->unique_number)));

                              $stockStatus=$this->my_libraries->checkstockActivationStatus($value->unique_number,$value->pro_ci_cat_name,$value->pro_ci_sub_cat_name);

                              // echo $mappedCategory .'<br>';
                        ?>

                        <tr>
                            <td>
                                <?php echo $value->product_name;?><br>
                                 <a class="variant-btn" data-bs-toggle="collapse" href="#varient_it<?php echo $value->product_id;?>" role="button" aria-expanded="true">Variant (<?php echo ($getVarients!=0) ? count($getVarients) :0 ;?>)</a> <?php echo $this->my_libraries->checkedOfferAdded($value->unique_number); ?>
                                
                            </td>

                            <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                            <td>
                               <label class="switch">
                                   <input type="checkbox" data-id="<?php echo base64_encode($value->product_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                   <span class="slider round"></span>
                                </label>
                            </td>
                          <?php } ?>

                             <?php 
                              if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ 

                                  if($value->in_stock_status==1){
                                        $checked="checked";
                                    }else{
                                        $checked="";
                                    }
                                
                                $disabledStuck=($stockStatus=='active_stock') ? $checked:' disabled';

                              ?>
                             <td> 
                                <label class="switch">
                                     <input type="checkbox" data-id="<?php echo base64_encode($value->product_id.':::'.implode(',',$in_stock_active_inactive).':::'.$value->cat_id.':::'.$value->sub_cat_id);?>" class="product-stock-status" id="p<?php echo $value->product_id?>" <?php echo $disabledStuck;?>>
                                   <span class="slider round"></span>
                                </label>
                            </td>
                            <?php } ?>
                            <td>
                              <?php

                                 

                                  $catName=$this->my_libraries->getCategoryByItemsCode($value->unique_number,'category');
                                  echo implode('<br>', $catName);
                              ?>
                              <?php //echo $value->category;?>
                          </td>
                            <td>
                              <div>
                               <?php
                                  $subcatName=$this->my_libraries->getCategoryByItemsCode($value->unique_number,'sub-category');
                                  echo implode('<br>', $subcatName);
                              ?>
                              <?php //echo $value->sub_category;?>
                              </td>
                           
                            <td><strong><?php echo  $value->unique_number;?></strong></td>
                            <td><?php echo date('Y-m-d',strtotime($value->add_date));?></td>
                            <td>

                                <?php
                                 // $filePath='./uploads/'.(($value->image1!="") ? $value->image1 :'');
                                  $filePath=(($value->image1!="") ? './uploads/'.$value->image1 :'');
                                if(file_exists($filePath)){
                                   $imgFile=base_url().'uploads/'.$value->image1;
                                }else{
                                  $imgFile=base_url().'include/assets/default_product_image.png';
                                }

                                ?>
                                <?php //echo base_url().'uploads/'.(($value->image1!="") ? $value->image1 :'include/assets/default_product_image.png');?>

                                <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">


                            </td>
                        
                             <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">

                                  <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                    <a href="<?php echo base_url('admin/add_product/'.$value->unique_number);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                  <?php } ?>
                                  
                                   <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                    <button type="button" class="btn btn-outline-secondary delete-products"data-id="<?php echo $value->unique_number;?>"><i class="icofont-ui-delete text-danger"></i></button>
                                  <?php } ?>
                                </div>
                            </td>
                        </tr>


                            


                             <tr style="background-color: lightgrey; padding: 0 !important;">
                                <td colspan="11"  class="tb-class">
                                    <div class="collapse" id="varient_it<?php echo $value->product_id;?>">
                                <!-- <div class="filter-search"> -->
                                      <table class="table tbl-class-vari">
                                        <tbody class="body-duv">
                                            
                                            <tr>
                                                <th>SKU ID</th>
                                                <th>Pack Size</th>
                                                <th>Units</th>
                                                <th>Price</th>
                                                <th>Before Off Price</th>
                                                <th>Qty Stock</th>
                                                <!-- <th>Conversion factor(Kg)</th> -->
                                                <!-- <th>Offers</th> -->
                                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                  <th>Status</th>
                                                 <?php } ?>
                                                  <?php if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                 <th>In Stock</th>
                                                 <?php } ?>
                                                <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th>Action</th>
                                                <?php } ?>
                                            </tr>

                                            <?php  
                                          if($getVarients!=0){

                                            foreach($getVarients as $vari_Value){

                                                ?>

                                                   <tr>
                                                        <td><?php echo $vari_Value->sku_id;?></td>
                                                        <td><?php echo $vari_Value->pack_size;?></td>
                                                        <td><?php echo $vari_Value->units;?></td>
                                                        <td><?php echo $vari_Value->price;?></td>
                                                        <td><?php echo $vari_Value->before_off_price;?></td>
                                                        <td><?php echo $vari_Value->stock;?></td>
                                                        <!-- <td><?php //echo $vari_Value->conversion_factor;?></td> -->
                                                         <!-- <td>
                                                          <a href="javasript:void(0);"  data-toggle="modal" data-target="#myModal_offers_<?php //echo $vari_Value->variant_id;?>"><?php //echo $this->my_libraries->getAddedOfferBtn($value->unique_number,$vari_Value->variant_id);?></a>

                                                          <?php 
                                                              $data['view_data']=$vari_Value;
                                                              $data['product_names']=$value->product_name;
                                                              $data['offers']=$this->my_libraries->getAddedOffer($value->unique_number,$vari_Value->variant_id);
                                                              $data['pro_unique_number']=$value->unique_number;
                                                              $this->load->view('admin/containerPage/apply_offer_modal.php' ,$data);
                                                              ?>

                                                         </td> -->

                                                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                         <td> 
                                                             <label class="switch">
                                                                   <input type="checkbox" data-id="<?php echo base64_encode($vari_Value->variant_id.':::'.implode(',',$ActiveInactive_ActionArr_varient));?>" class="cate-status" <?php echo ($vari_Value->variants_status==1) ?'checked' :'';?>>
                                                                   <span class="slider round"></span>
                                                                </label>
                                                        </td>
                                                      <?php } ?>

                                                        <?php if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                           <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($vari_Value->variant_id.':::'.implode(',',$in_stock_active_inactive_variant));?>" class="cate-status" <?php echo ($vari_Value->variants_in_stock_status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                       <?php } ?>
                                                         

                                                        <td>
                                                           <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                             <a href="#"  class="btn btn-outline-secondary" data-toggle="modal" data-target="#myModal_variant_<?php echo $vari_Value->variant_id;?>"><i class="icofont-edit text-success"></i></a>
                                                           <?php } ?>

                                                             <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                              <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $vari_Value->variant_id;?>" data-id="<?php echo base64_encode($vari_Value->variant_id.':::'.implode(',',$deleteActionArr_variants));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                              <?php } ?>

                                                              <?php 
                                                              $data['view_data']=$vari_Value;
                                                              $data['product_names']=$value->product_name;
                                                              $this->load->view('admin/containerPage/product_variant_edit_modal.php' ,$data);
                                                              ?>
                                                        </td>
                                                    </tr>                                                                               
                                                <?php
                                            }
                                          }

                                            ?>

                                         
                                        </tbody>
                                     </table>
                              <!-- </div> -->
                              </div>
                                </td>
                            </tr>

                      

                  <?php
                    }
               } 
         ?>

         <tr>
          <td colspan="9">
           <div id="pagint-div" style="float: right;">
            <?php echo $links;?>
           </div>
           </td>
        </tr>
                