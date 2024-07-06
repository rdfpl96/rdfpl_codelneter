
<?php
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
// Categories

?>

 <!-- Body: Body --> 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                 <form action ="#" id="form-product" name="form_product" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> <?php echo ucfirst($this->uri->segment(4));?> Products</h3>
                                 <div class="loaderdiv"></div>
                                <button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase save-product">Save</button>
                            </div>
                        </div>
                    </div>   
                    <?php
                      // echo "<pre>";print_r($product_list);echo "</pre>";
                      // ($product_list!=0)? $product_list[0]->sku_id :''
                    ?>
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            
                         <div class="row">
                            <div class="col-md-9">

                            <div class="card mb-3" style="height: 97%;">
                             <input type="hidden" name="product_id" id="product_id" value="<?php echo ($product_list!=0)? $product_list[0]->product_id :'';?>">
                            <input type="hidden" name="uniq_number" id="uniq_number" value="<?php echo ($product_list!=0)? $product_list[0]->unique_number :'';?>">
                             <input type="hidden" name="product_verients" id="product_verients" value="<?php echo $this->uri->segment(4);?>">
                            
                                <div class="card-body">

                                           
                                        <div class="row g-3 align-items-center">
                                           <div class="col-md-2">
                                                <label  class="form-label">Item Code <span style="color:red;">*</span></label>
                                                <input type="number" class="form-control" id="item-code" name="item_code" value="<?php echo ($product_list!=0)? $product_list[0]->unique_number :'';?>"    <?php echo ($product_list!=0)? 'readonly' :'';?>>
                                            </div>


                                            <div class="col-md-2">
                                                <label  class="form-label">Product name <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" id="product-name" name="product_name" value="<?php echo ($product_list!=0)? $product_list[0]->product_name :'';?>">
                                            </div>
                                            

                                             <div class="col-md-2">
                                                <label for="hsn-code" class="form-label">HSN Code <span style="color:red;">*</span></label>
                                                <!-- <input type="number" class="form-control" name="hsn_code" id="hsn-code" value="<?php //echo ($product_list!=0)? $product_list[0]->hsn_code :'';?>"> -->
                                                <input type="text" id="gsearchsimple" class="hsn-code form-control input-lg" name="hsn_code" value="<?php echo ($product_list!=0)? $product_list[0]->hsn_code :'';?>" placeholder="Search..." onkeypress="return isNumeric(event)" />
                                                <ul class="list-group"></ul>
                                                <div id="localSearchSimple"></div>
                                             </div>


                                              <div class="col-md-6">
                                                <div class="input-group input-group-multi">
                                                    <div class="row">
                                                     <div class="col-md-3 no-gutters">
                                                          <label for="igst" class="form-label">IGST <span style="color:red;">*</span></label>
                                                         <input type="number" class="form-control" name="igst" id="igst" value="<?php echo ($product_list!=0)? $product_list[0]->igst :'';?>" oninput="validateIgst()" />
                                                       </div>

                                                      <div class="col-md-3">
                                                          <label for="cgst" class="form-label">CGST <span style="color:red;">*</span></label>
                                                        <input type="number" class="form-control" name="cgst" id="cgst" value="<?php echo ($product_list!=0)? $product_list[0]->cgst :'';?>" oninput="validateCgst()" />
                                                     </div>
                                                      
                                                       <div class="col-md-3 no-gutters">
                                                          <label for="sgst" class="form-label">SGST <span style="color:red;">*</span></label>
                                                         <input type="number" class="form-control" name="sgst" id="sgst" value="<?php echo ($product_list!=0)? $product_list[0]->sgst :'';?>" oninput="validateSgst()" />
                                                       </div>
                                                   </div>
                                                    </div>
                                                <span id="gstErr"></span>
                                                <!-- <label for="gst" class="form-label">GST(%)</label>
                                                <input type="text" class="form-control" name="gst" id="gst"> -->
                                             </div>

                                            <!--  <div class="col-md-4">
                                                <label for="uom" class="form-label">UOM</label>
                                                <input type="text" class="form-control" name="uom" id="uom" value="<?php //echo ($product_list!=0)? $product_list[0]->uom :'';?>">
                                             </div> -->
                                              
                                            
                                        </div>

                                        <?php
                                        if($product_list!=0){
                                          $getVarients=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variants_unique_number'=>trim($product_list[0]->unique_number)));


                                        }else{
                                          $getVarients=0;
                                         }
                                        ?>

                                      <input type="hidden" name="increment_varients" id="increment_varients" value="<?php echo ($getVarients!=0)? count($getVarients) : 1;?>">
                                    <br>
                                <div class="table-responsive varients_table">
                                <table class="table">

                                    <tr>
                                        <label class="form-label">Variants <span style="color:red;">*</span></label>
                                        <td>  <label for="uom" class="form-label">SKU ID</label></td>
                                        <td>  <label for="uom" class="form-label">Pack Size</label></td>
                                        <td>  <label for="uom" class="form-label">Units</label></td>
                                        <td>  <label for="uom" class="form-label">Selling Price</label></td>
                                        <td>  <label for="uom" class="form-label">Before Off Price</label></td>
                                        <td>  <label for="uom" class="form-label">Stock</label></td>
                                        <!-- <td>  <label for="uom" class="form-label">Conversion factor(Kg)</label></td> -->
                                        <td></td>
                                    </tr>

                                  <?php 

                                  if($product_list!=0){
                                     
                                     if($getVarients!=0){
                                       $index_v=0;
                                     
                                     foreach($getVarients as $edit_value){
                                      // echo "<pre>";print_r($edit_value);echo "</pre>";

                                       $index_v++;
                                      ?>
                                         
                                            <tr class="add-tr-varients<?php echo ($index_v==count($getVarients)) ? '' : $index_v;?>">
                                              <td>
                                                <input type="hidden" name="variant_id[]" class="variant_id" id="variant_id<?php echo $index_v;?>" value="<?php echo $edit_value->variant_id;?>">
                                               <input type="hidden" name="inc_num[]" id="inc_num<?php echo $index_v;?>" value="<?php echo $index_v;?>">

                                               <input type="hidden" class="ext_sku_id" name="ext_sku_id[]" id="ext_sku_id<?php echo $index_v;?>" value="<?php echo $edit_value->sku_id;?>">
                                                <input type="text" class="form-control sku-class" id="sku-id<?php echo $index_v;?>" name="sku_id[]" value="<?php echo $edit_value->sku_id;?>">
                                              </td>
                                              <td>
                                              
                                                <input type="number" class="form-control packSize-class" name="pack_size[]" data-id="<?php echo $index_v;?>" id="pach-size<?php echo $index_v;?>" value="<?php echo $edit_value->pack_size;?>">
                                              </td>
                                              <td style="width: 15%;">

                                                <?php
                                                   
                                                   // echo "<pre>";
                                                   // print_r($product_list);
                                                   // echo "</pre>";

                                                ?>
                                              
                                                <select type="text" class="form-control units-class" data-id="<?php echo $index_v;?>"  id="units<?php echo $index_v;?>" name="units[]">
                                                  <option value="">-Select-</option>
                                                    <?php
                                                      if($units_list!=0){
                                                        foreach($units_list as $value){
                                                        // echo  $units=($product_list!=0)? $product_list[0]->units :'';
                                                          $selected= ($edit_value->units==$value->units_name) ? 'selected':'';
                                                          ?>
                                                            <option value="<?php echo $value->units_id.'__'.$value->units_name;?>" <?php echo $selected;?>><?php echo $value->units_name;?></option>
                                                          <?php
                                                        }
                                                      }
                                                    ?>
                                                  </select>
                                              </td>
                                              <td>
                                              
                                                <input type="number" class="form-control price-class" name="price[]" id="price<?php echo $index_v;?>" value="<?php echo $edit_value->price;?>" oninput="validatePrice(this)" />
                                              </td>
                                               <td>
                                                    <input type="number" class="form-control price-class" name="beforeOffprice[]" id="beforeOffprice<?php echo $index_v;?>" value="<?php echo $edit_value->before_off_price;?>">
                                                  </td>
                                              <td>
                                             
                                                <input type="number" class="form-control stock-class" name="stock[]" id="stock<?php echo $index_v;?>" value="<?php echo $edit_value->stock;?>" oninput="validateStock(this)" />
                                              </td>
                                               <!-- <td>
                                                <input type="number" class="form-control conv-class" name="conversion_factor[]" id="conversion-factor<?php echo $index_v;?>" value="<?php echo $edit_value->conversion_factor;?>">
                                              </td> -->
                                               <td>
                                                 
                                                     <?php
                                                        
                                                        if(($index_v) == count($getVarients)){
                                                          ?>
                                                          <button type="button" class="btn btn-info add-more-varients">+</button>
                                                          <?php
                                                        }else{
                                                          ?>
                                                           <button type="button" class="btn btn-danger remove-more-varients" data-id="<?php echo $index_v;?>__<?php echo base64_encode($edit_value->variant_id.':::'.implode(',',$deleteActionArr_variants));?>">-</button>
                                                          <?php
                                                        }

                                                      ?>
                                              </td>
                                            </tr>
                                         <?php
                                          $getDiv=0;
                                       }

                                 }else{
                                  $getDiv=1;
                                 }

                                  }else{
                                       $getDiv=1;
                                   } ?>

                                  
                                  <?php
                                  if($getDiv==1){
                                    ?>
                                    <tr class="add-tr-varients">
                                      <td>
                                       <input type="hidden" name="inc_num[]" id="inc_num1" value="1">
                                        <input type="text" class="form-control sku-class" id="sku-id1" name="sku_id[]" value="">
                                          <input type="hidden" class="ext_sku_id" name="ext_sku_id[]" id="ext_sku_id1" value="">
                                           <input type="hidden" name="variant_id[]" class="variant_id" id="variant_id1" value="">
                                      </td>
                                      <td>
                                      
                                        <input type="number" class="form-control packSize-class" name="pack_size[]" data-id="1" id="pach-size1" value="" readonly="readonly">
                                      </td>
                                      <td style="width: 15%;">
                                      
                                        <select type="text" class="form-control units-class" data-id="1"  id="units1" name="units[]">
                                          <option value="">-Select-</option>
                                            <?php
                                              if($units_list!=0){
                                                foreach($units_list as $value){
                                                  $units=($product_list!=0)? $product_list[0]->units :'';
                                                  $selected= ($value->units_name==$units) ? 'selected':'';
                                                  ?>
                                                    <option value="<?php echo $value->units_id.'__'.$value->units_name;?>" <?php echo $selected;?>><?php echo $value->units_name;?></option>
                                                  <?php
                                                }
                                              }
                                            ?>
                                          </select>
                                      </td>
                                      <td>
                                        <input type="number" class="form-control price-class" name="price[]" id="price1" value="">
                                      </td>

                                      <td>
                                        <input type="number" class="form-control price-class" name="beforeOffprice[]" id="beforeOffprice1" value="">
                                      </td>
                                      <td>
                                     
                                        <input type="number" class="form-control stock-class" name="stock[]" id="stock1" value="">
                                      </td>
                                       <!-- <td>
                                        <input type="number" class="form-control conv-class" name="conversion_factor[]" id="conversion-factor1" value="">
                                      </td> -->
                                       <td>
                                         

                                         <button type="button" class="btn btn-info add-more-varients">+</button>
                                      </td>
                                    </tr>

                                    <?php
                                  }
 
                                  ?>


                                </table>
                                </div>

<!-- <span style="color:red;">*</span> -->
                                <div class="row">
                                    <div class="col-md-6">
                                     <label for="Werehouse" class="form-label">Werehouse</label>
                                  
                                        <ul class="deliv-ul">
                                          <?php
                                            if($werehouse_list!=0){
                                             foreach($werehouse_list as $were_value){
                                                
                                                $codes_w = end(explode('_',$were_value->werehouse_code));
                                                 $checked_wh=$this->my_libraries->getdWerehosueInput($product_list[0]->unique_number,$product_list[0]->product_id,$codes_w);
                                                ?>
                                                  <li><input type="checkbox" name="delivery_palce[]" id="deli1" value="<?php echo $codes_w;?>" <?php echo $checked_wh;?>> <?php echo $were_value->werehouse_name ;?></li>
                                                <?php
                                              }
                                            }

                                          ?>
                                          
                                        </ul>
                                        <div id="checkErr" style="color:red;"></div>
                                     </div>
                                 </div>
                                    <!--  <div class="col-md-6">
                                       <h5>Food Habitats</h5> -->
                                     <!-- <ul class="deliv-ul"> -->
                                          <?php
                                            //  $foodvel=($product_list!=0) ? explode(',', $product_list[0]->food_habitats) : array();
                                            // if($food_habitats_list!=0){
                                            //   foreach($food_habitats_list as $food_value){
                                            //      $checked_delv=(in_array($food_value->fh_unique_name,$foodvel)) ? 'checked' : '';
                                                ?>
                                                  <!-- <li><input type="checkbox" name="food_habit[]" id="food_habits" value="<?php //echo $food_value->fh_unique_name;?>" <?php //echo $checked_delv;?>> <?php //echo $food_value->fh_food_habitats ;?></li> -->
                                                <?php
                                            //   }
                                            // }
                                          ?>
                                        <!-- </ul> -->
                                        <!-- <div id="checkfoodErr" style="color:red;"></div> -->
                                   <!-- </div> -->
                                <!-- </div> -->



                              <label for="Search Keywords" class="form-label">Product Search keywords</label>
                              <table class="table"> 
                                <tr>
                                  <td><input type="text" class="form-control" id="search-keywords1" name="search_keywords[]" placeholder="Keywords-1" value="<?php echo ($product_list!=0)? $product_list[0]->keywords1 :'';?>"></td>
                                  <td><input type="text" class="form-control" id="search-keywords2" name="search_keywords[]" placeholder="Keywords-2" value="<?php echo ($product_list!=0)? $product_list[0]->keywords2 :'';?>"></td>
                                  <td><input type="text" class="form-control" id="search-keywords3" name="search_keywords[]" placeholder="Keywords-3" value="<?php echo ($product_list!=0)? $product_list[0]->keywords3 :'';?>"></td>
                                  <td><input type="text" class="form-control" id="search-keywords4" name="search_keywords[]" placeholder="Keywords-4" value="<?php echo ($product_list!=0)? $product_list[0]->keywords4 :'';?>"></td>
                              </tr>
                               <tr>
                                  <td><input type="text" class="form-control" id="search-keywords5" name="search_keywords[]" placeholder="Keywords-5" value="<?php echo ($product_list!=0)? $product_list[0]->keywords5 :'';?>"></td>
                                  <td><input type="text" class="form-control" id="search-keywords6" name="search_keywords[]" placeholder="Keywords-6" value="<?php echo ($product_list!=0)? $product_list[0]->keywords6 :'';?>"></td>
                                  <td><input type="text" class="form-control" id="search-keywords7" name="search_keywords[]" placeholder="Keywords-7" value="<?php echo ($product_list!=0)? $product_list[0]->keywords7 :'';?>"></td>
                                  <td><input type="text" class="form-control" id="search-keywords8" name="search_keywords[]" placeholder="Keywords-8" value="<?php echo ($product_list!=0)? $product_list[0]->keywords8 :'';?>"></td>
                              </tr>
                              </table>

                        
                                </div>
                               </div>

                             </div><!--col-md-8-->
                              <div class="col-md-3">

                                <div class="card mb-3">
                                    <div class="categories categories_css">
                                        <div class="filter-titled">
                                            <h5 class="font-weight-bold">Categories</h5>
                                        </div>
                                        <div  id="category" style="">
                                            
            <div class="filter-category">
                <ul class="category-list">
                  <?php

                    // echo "<pre>";
                    // print_r($cat_and_sub_catlist);
                    // echo "<pre>";


                    if($cat_and_sub_catlist!=array()){
                      $index=0;
                        foreach(array_reverse($cat_and_sub_catlist) as $key=>$values){
                          $index++;
                           if($product_list!=0){
                            $cate_checked=$this->my_libraries->getCategoryByItemsCodeChecked($product_list[0]->unique_number,$values['cat_id']);
                            $show=($cate_checked=='checked') ? 'show' :'';
                          }else{
                            $cate_checked='';
                            $show='';
                          }


                          ?>

                    <li><input class="form-check-input" type="checkbox" name="category_id[]" value="<?php echo $values['cat_id'];?>" id="cate<?php echo $values['cat_id'];?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $values['cat_id'];?>" class="collapsed" <?php echo $cate_checked;?>>

                     <label for="cate<?php echo $values['cat_id'];?>"><span data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $values['cat_id'];?>" class="collapsed">&nbsp;&nbsp; <?php echo $values['category'];?></span> </label><i class="fa fa-angle-down" aria-hidden="true"></i>

                        <ul id="collapse<?php echo $values['cat_id'];?>" class="sub-category uldiv<?php echo $values['cat_id'];?> collapse <?php echo $show;?>" data-parent="#category">
                          <?php //if($values['sub_cat']!=array()){ 
                             // $sub_index=0;
                             // foreach(array_reverse($values['sub_cat']) as $subValue){
                             //    $sub_index++;
                             //    if($product_list!=0){
                             //    $subcate_checked=$this->my_libraries->getCategoryByItemsCodeChecked($product_list[0]->unique_number,'',$subValue->sub_cat_id);

                             //     $show1=($subcate_checked=='checked') ? 'show' :'';
                             //  }else{
                             //    $subcate_checked='';
                             //     $show1='';
                             //  }
                            ?>
                            <?php
                            if (!empty($values['sub_cat'])) { 
                            foreach (array_reverse($values['sub_cat']) as $sub_index => $subValue) {
                                $subcate_checked = $show1 = '';
                                if ($product_list != 0) {
                                    $subcate_checked = $this->my_libraries->getCategoryByItemsCodeChecked($product_list[0]->unique_number, '', $subValue->sub_cat_id);
                                    $show1 = ($subcate_checked == 'checked') ? 'show' : '';
                                }
                                else{
                                    $subcate_checked='';
                                     $show1='';
                                  }
                            ?>

                             <li> 
                                  <input class="form-check-input" name="subCategory[]" type="checkbox" value="<?php echo $values['cat_id'].':::'.$subValue->sub_cat_id;?>" id="subcate<?php echo $subValue->sub_cat_id;?>" data-bs-toggle="collapse" data-bs-target="#collapse-child<?php echo $subValue->sub_cat_id;?>" <?php echo $subcate_checked;?>>

                                   <label for="subcate<?php echo $subValue->sub_cat_id;?>"> 
                                      <span data-bs-toggle="collapse" data-bs-target="#collapse-child<?php echo $subValue->sub_cat_id;?>" class="collapsed">&nbsp;&nbsp; <?php echo $subValue->subCat_name;?></span>
                                   </label>


                                    <?php
                                     $childCat =$this->my_libraries->childCategoryListInMenu($values['cat_id'],$subValue->sub_cat_id);
                                     echo ($childCat!=0) ? '<i class="fa fa-angle-down" aria-hidden="true"></i>':''; ?>
                                      <ul id="collapse-child<?php echo $subValue->sub_cat_id;?>" class="sub-category uldiv collapse <?php echo $show1;?>" data-parent="#childcategory">
                                    <?php 
                                      foreach ($childCat as $key => $value)
                                       {

                                        // $sub_index++;
                                            if($product_list!=0){
                                            $childcate_checked=$this->my_libraries->getCategoryByItemsCodeChecked($product_list[0]->unique_number,'','',$value->child_cat_id);
                                          }else{
                                            $childcate_checked='';
                                          }

                                     ?>
                                        <li> <label for="childcate<?php echo $value->child_cat_id;?>"><abbr>
                                            <input class="form-check-input" name="childCategory[]" type="checkbox" value="<?php echo $values['cat_id'].':::'.$subValue->sub_cat_id.':::'.$value->child_cat_id;?>" id="childcate<?php echo $value->child_cat_id;?>" <?php echo $childcate_checked;?>> <?php echo $value->childCat_name;?>
                                            </abbr></label>
                                        </li>
                                      <?php
                                      }
                                    ?>
                                </ul>
                             </li>

                          <?php } }  ?>
                        </ul>
                    </li>

                  <?php } }  ?>


               <?php 
                    
                ?>


                </ul>
            </div>
        </div>
    </div>
</div>


</div>
</div><!--row closed-->




                             <div class="row">
                                <!-- <div class="col-md-12">
                                  <label for="" class="form-label">Ingredients <span style="color:red;">*</span></label>
                                  <textarea type="text" class="form-control" name="ingredients" id="ingredients"><?php //echo ($product_list!=0)? $product_list[0]->ingredients :'';?></textarea>
                               </div> -->

                              <!-- <div class="col-md-4 shelf_life_css"> -->
                              <!-- <label for="" class="form-label">Shelf Life <span style="color:red;">*</span></label> -->
                              <!-- <div class="input-group input-group-multi"> -->
                                    <!-- <div class="col-md-6"> -->
                                      <!-- <input type="number" class="form-control" id="period" name="period" value="<?php echo ($product_list!=0)? $product_list[0]->shelf_life_period :'';?>"> -->
                                   <!-- </div> -->
                                    <!-- <div class="col-md-6 no-gutters"> -->
                                      <!-- <select type="text" class="form-control" id="period-type" name="period_type"> -->
                                      <?php
                                        // if($period_list!=0){
                                        //   foreach($period_list as $pvalue){
                                        //     $selected_p= ($product_list!=0)? (($product_list[0]->shelf_life_period_type==strtolower($pvalue->period_type)) ? 'selected':'') :'';
                                            ?>
                                             <!-- <option value="<?php //echo strtolower($pvalue->period_type);?>" <?php //echo $selected_p;?>><?php //echo $pvalue->period_type;?></option> -->
                                            <?php
                                         //  }
                                         // }
                                     ?>
                                      <!-- </select> -->
                                  <!-- </div> -->
                           <!-- </div> -->
                           <!-- <div id="errShef"></div> -->
                         <!-- </div> -->

                          <!-- <div class="col-md-4">
                              <label for="" class="form-label">Quick Description (Optional)</label>
                                <input type="text" class="form-control" name="quickDesc" id="quickDesc" value="<?php //echo ($product_list!=0)? $product_list[0]->quick_description :'';?>">
                               <div id="errShef22"></div>
                         </div> -->


                          <!-- <div class="col-md-12">
                                  <label for="" class="form-label">Storage Condition <span style="color:red;">*</span></label>
                                  <textarea type="text" class="form-control" name="storage_condition" id="storage_condition"><?php //echo ($product_list!=0)? $product_list[0]->storage_condition :'';?></textarea>
                          </div> -->
                           
                         <!-- </div> -->

                                <div class="col-md-12">
                               
                                    <label for="uom" class="form-label">Description</label>

                                    <input type="hidden" name="increment" id="increment" value="<?php echo ($product_disc_list!=0)? count($product_disc_list) : 1;?>">
                                    <table class="table">
                                      <?php 
                                      if($product_disc_list!=0){
                                         $index=0;
                                         foreach($product_disc_list as $value){
                                            
                                            $index++;
                                           ?>

                                             <tr class="add-tr<?php echo ($index==count($product_disc_list)) ? '' : $index;?>">
                                                <td class="tbl-td">
                                                <div class="row"> 
                                                    <div class="col-sm-11 width_80">
                                                      <input type="hidden" name="input_disc_id[]" id="disc-id<?php echo $index;?>" value="<?php echo $value->desc_id;?>">
                                                      <input type="text" class="form-control" id="heading<?php echo $index;?>" name="heading[]" placeholder="Heading" value="<?php echo $value->desc_header;?>">
                                                    </div>
                                                    <div class="col-sm-1 width_20">
                                                      <?php
                                                        
                                                        if(($index) == count($product_disc_list)){
                                                          ?>
                                                          <button type="button" class="btn btn-info add-more">+</button>
                                                          <?php
                                                        }else{
                                                          ?>
                                                          <button type="button" class="btn btn-danger remove-btn" data-id="<?php echo $index;?>">-</button>
                                                          <?php
                                                        }

                                                      ?>
                                                   </div>
                                                </div>
                                                 <textarea class="form-control" id="description<?php echo $index;?>" name="description[]" placeholder="Description" style="margin-bottom: 6px;"><?php echo $value->description;?></textarea>
                                               </td>
                                            </tr>
                                          
                                           <?php
                                        }

                                      }else{
                                         ?>
                                           <tr class="add-tr">
                                              <td class="tbl-td">
                                              <div class="row"> 
                                                  <div class="col-sm-11 width_80">
                                                    <input type="hidden" name="input_disc_id[]" id="disc-id1" value="">
                                                    <input type="text" class="form-control" id="heading1" name="heading[]" placeholder="Heading" value="">
                                                  </div>
                                                  <div class="col-sm-1 width_20">
                                                    <button type="button" class="btn btn-info add-more">+</button>
                                                 </div>
                                              </div>
                                               <textarea class="form-control" id="description1" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>
                                             </td>
                                          </tr>
                                        <?php
                                      }

                                    ?>
       
                                </table>
                           </div>

                           
                            </div>
                          </div>
                        
                          </div>
                           
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Images <span style="color:red;font-size: 13px;">(Image dimension should be 700x700 Px.)</span></h6>

                                </div>
                                <div class="row card-body">
                                  
                                <div class="col-sm-2">
                                    <div class="center" style="text-align: center;">
                                        <a href="#" class="close-image" data-id="1"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        <div class="form-input">
                                          <div class="preview">
                                            <?php
                                             
                                           if($product_list!=0){
                                              
                                                $filePath1=(($product_list[0]->image1!="") ? './uploads/'.$product_list[0]->image1 :'');
                                              if(file_exists($filePath1)){
                                                 $imgFile1=base_url().'uploads/'.$product_list[0]->image1;
                                              }else{
                                                $imgFile1=base_url().'include/assets/default_product_image.png';
                                              }

                                            }else{
                                              $imgFile1=base_url().'include/assets/default_product_image.png';
                                            }

                               
                                            // $imga1=($product_list!=0) ? (($product_list[0]->image1!="") ? 'uploads/'.$product_list[0]->image1 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                                            ?>
                                            <img id="file-ip-1-preview" src="<?php echo $imgFile1;?>">
                                            <input type="text" name="image_path1" id="image_path1" value="<?php echo ($product_list!=0)? $product_list[0]->image1 :'';?>">
                                          </div>
                                          <label for="file-ip-1">Image-1</label>
                                         <input type="file" id="file-ip-1" name="image1" accept="image/*" onchange="showPreview(event,1);" hidden>
                                         <span class="required" style="text-align: center;">Required</span>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-sm-2">
                                    <div class="center" style="text-align: center;">
                                          <a href="#" class="close-image" data-id="2"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                      <div class="form-input">
                                        <div class="preview">
                                           <?php
                                           
                                            if($product_list!=0){
                                               $filePath2=(($product_list[0]->image2!="") ? './uploads/'.$product_list[0]->image2 :'');
                                              if(file_exists($filePath2)){
                                                 $imgFile2=base_url().'uploads/'.$product_list[0]->image2;
                                              }else{
                                                $imgFile2=base_url().'include/assets/default_product_image.png';
                                              }
                                            }else{
                                              $imgFile2=base_url().'include/assets/default_product_image.png';
                                            }
                                            // $imga2=($product_list!=0) ? (($product_list[0]->image2!="") ? 'uploads/'.$product_list[0]->image2 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                                            ?>
                                          <img id="file-ip-2-preview" src="<?php echo $imgFile2;?>">
                                          <input type="text" name="image_path2" id="image_path2" value="<?php echo ($product_list!=0)? $product_list[0]->image2 :'';?>">
                                        </div>
                                        <label for="file-ip-2">Image-2</label>
                                       <input type="file" id="file-ip-2" name="image2" accept="image/*" onchange="showPreview(event,2);" hidden>
                                      </div>
                                    </div> 
                                </div>

                                <div class="col-sm-2">
                                    <div class="center" style="text-align: center;">
                                          <a href="#" class="close-image" data-id="3"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                      <div class="form-input">
                                        <div class="preview">
                                           <?php

                                             if($product_list!=0){
                                          
                                               $filePath3=(($product_list[0]->image3!="") ? './uploads/'.$product_list[0]->image3 :'');
                                              if(file_exists($filePath3)){
                                                 $imgFile3=base_url().'uploads/'.$product_list[0]->image3;
                                              }else{
                                                $imgFile3=base_url().'include/assets/default_product_image.png';
                                              }
                                            }else{
                                              $imgFile3=base_url().'include/assets/default_product_image.png';
                                            }
                                            // $imga3=($product_list!=0) ? (($product_list[0]->image3!="") ? 'uploads/'.$product_list[0]->image3 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                                            ?>
                                          <img id="file-ip-3-preview" src="<?php echo $imgFile3;?>">
                                          <input type="text" name="image_path3" id="image_path3" value="<?php echo ($product_list!=0)? $product_list[0]->image3 :'';?>">
                                        </div>
                                        <label for="file-ip-3">Image-3</label>
                                       <input type="file" id="file-ip-3" name="image3" accept="image/*" onchange="showPreview(event,3);" hidden>
                                      </div>
                                    </div> 
                                </div>

                                 <div class="col-sm-2">
                                    <div class="center" style="text-align: center;">
                                          <a href="#" class="close-image" data-id="4"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                      <div class="form-input">
                                        <div class="preview">
                                           <?php
                                           if($product_list!=0){
              
                                                $filePath4=(($product_list[0]->image4!="") ? './uploads/'.$product_list[0]->image4 :'');
                                              if(file_exists($filePath4)){
                                                 $imgFile4=base_url().'uploads/'.$product_list[0]->image4;
                                              }else{
                                                $imgFile4=base_url().'include/assets/default_product_image.png';
                                              }
                                            }else{
                                              $imgFile4=base_url().'include/assets/default_product_image.png';
                                            }
                                            
                                            ?>
                                         <img id="file-ip-4-preview" src="<?php echo $imgFile4;?>">
                                         <input type="text" name="image_path4" id="image_path4" value="<?php echo ($product_list!=0)? $product_list[0]->image4 :'';?>">
                                        </div>
                                        <label for="file-ip-4">Image-4</label>
                                       <input type="file" id="file-ip-4" name="image4" accept="image/*" onchange="showPreview(event,4);" hidden>
                                      </div>
                                    </div> 
                                  </div>


                                  <div class="col-sm-2">
                                    <div class="center" style="text-align: center;">
                                          <a href="#" class="close-image" data-id="5"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                      <div class="form-input">
                                        <div class="preview">
                                           <?php
                                           if($product_list!=0){
              
                                                $filePath5=(($product_list[0]->image5!="") ? './uploads/'.$product_list[0]->image5 :'');
                                              if(file_exists($filePath5)){
                                                 $imgFile5=base_url().'uploads/'.$product_list[0]->image5;
                                              }else{
                                                $imgFile5=base_url().'include/assets/default_product_image.png';
                                              }
                                            }else{
                                              $imgFile5=base_url().'include/assets/default_product_image.png';
                                            }
                                            // $imga4=($product_list!=0) ? (($product_list[0]->image4!="") ? 'uploads/'.$product_list[0]->image4 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                                            ?>
                                         <img id="file-ip-5-preview" src="<?php echo $imgFile5;?>">
                                         <input type="text" name="image_path5" id="image_path5" value="<?php echo ($product_list!=0)? $product_list[0]->image5 :'';?>">
                                        </div>
                                        <label for="file-ip-5">Image-5</label>
                                       <input type="file" id="file-ip-5" name="image5" accept="image/*" onchange="showPreview(event,5);" hidden>
                                      </div>
                                    </div> 
                                  </div>


                                   <div class="col-sm-2">
                                    <div class="center" style="text-align: center;">
                                          <a href="#" class="close-image" data-id="6"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                      <div class="form-input">
                                        <div class="preview">
                                           <?php
                                           if($product_list!=0){
              
                                                $filePath6=(($product_list[0]->image6!="") ? './uploads/'.$product_list[0]->image6 :'');
                                              if(file_exists($filePath6)){
                                                 $imgFile6=base_url().'uploads/'.$product_list[0]->image6;
                                              }else{
                                                $imgFile6=base_url().'include/assets/default_product_image.png';
                                              }
                                            }else{
                                              $imgFile6=base_url().'include/assets/default_product_image.png';
                                            }
                                            // $imga4=($product_list!=0) ? (($product_list[0]->image4!="") ? 'uploads/'.$product_list[0]->image4 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                                            ?>
                                         <img id="file-ip-6-preview" src="<?php echo $imgFile6;?>">
                                         <input type="text" name="image_path6" id="image_path6" value="<?php echo ($product_list!=0)? $product_list[0]->image6 :'';?>">
                                        </div>
                                        <label for="file-ip-6">Image-6</label>
                                       <input type="file" id="file-ip-6" name="image6" accept="image/*" onchange="showPreview(event,6);" hidden>
                                      </div>
                                    </div> 
                                  </div>


                           </div>
                      </div>

                       </form>
                  </div>
                    
                    <div class="ship_ad_btn_css">
                    <button type="button" class="btn btn-primary pro-ad add_product_submit_btn btn-set-task w-sm-100 py-2 px-5 text-uppercase save-product">Save</button>
                    <div class="loaderdiv"></div>
                   </div>
              </div>
     
            
                                
         
     <!--  </div>
  </div>  -->