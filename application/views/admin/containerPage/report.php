           
 <?php

  $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
 ?>
            <div class="body d-flex py-3">  
                <div class="container-xxl"> 
                    <div class="row align-items-center"> 
                        <div class="border-0 mb-4"> 
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                 <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Reports</h3>
                                 <div class="loaderdiv" style="position: absolute;z-index: 99999999;float: right;margin-left: 70%;"></div>

                                 <?php if(in_array('filter',$actAcx) || $session['admin_type']=='A'){ ?>
                                    <a href="javascript:void(0);" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100 filter-link">Filter</a>
                                  <?php } ?>

                            </div>
                        </div>
                    </div> <!-- Row end  -->
                     <!-- ============================================================ -->

                     <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">
                <div class="card mb-3">
                <div class="card-body">
                  <form action="<?php //echo base_url('admin/export_OrderList');?>" method="POST">

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select type="text" class="form-control category-action" name="category_id" id="category-id">
                                <option value="">-Select-</option>
                                <?php if($category_list!=0){ ?>
                                    <?php foreach (array_reverse($category_list) as $key => $value) { ?>
                                           <option value="<?php echo $value->cat_id;?>"><?php echo $value->category;?></option>
                                       <?php } ?>
                                    }?>
                               
                            <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sub Category</label>
                             <select type="text" class="form-control sub-category-action" name="sub_category_id" id="sub-category-id">
                            </select>
                        </div>

                      </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Customer</label>
                             <select type="text"class="form-control customerClass" name="customer" id="customer">
                                <option value="">-Select-</option>
                                 <?php if($customer_list!=0){ ?>
                                    <?php foreach (array_reverse($customer_list) as $key => $value) {
                                        $nameCustomer = getCustDetailsName($value);
                                     ?>
                                           <option value="<?php echo $nameCustomer['customer_id'];?>"><?php echo $nameCustomer['name'];?></option>
                                       <?php } ?>
                                    }?>
                               
                            <?php } ?>
                            </select>
                           
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Product Name</label>
                            <select type="text"class="form-control productClass" name="product" id="product">
                                <option value="">-Select-</option>
                                <?php if($product_list!=0){ ?>
                                    <?php foreach (array_reverse($product_list) as $key => $value) { ?>
                                           <option value="<?php echo $value->product_id;?>"><?php echo $value->product_name;?></option>
                                       <?php } ?>
                               <?php } ?>
                                </select>
                        </div>

                      </div>
                     
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control w-100 searchDate" name="fromDate" id="fromDate">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control w-100 searchDate" id="toDate" name="toDate">
                            </div> 
                        </div>

                     <div class="row">
                      <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select type="text"class="form-control" name="order_status" id="order-status">
                                <option value="">-Select-</option>
                                <?php if($order_status!=0){ ?>
                                    <?php foreach (array_reverse($order_status) as $key => $value) { ?>
                                           <option value="<?php echo $value->order_status;?>"><?php echo $value->order_status;?></option>
                                       <?php } ?>
                               <?php } ?>
                                </select>
                        </div>
                    </div>


                </form>
                </div>
                </div>
                </div>  



       

                    <!-- ========================================= -->
                    <div class="g-3 mb-3"> 
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-body" style="padding: 0px 2% 2% !important;"> 

                                   
                                    <table id="" class="table table-hover align-middle mb-0">  
                                        <thead>
                                            <tr>
                                                <th><span>&nbsp;</span><br>Ser No</th>
                                                <th><span>&nbsp;</span><br>Report file name</th>
                                                <th style="width: 30%;"><span>&nbsp;</span><br>Input Value</th>
                                                <th><span>&nbsp;</span><br>Created By</th>
                                                <th><span>&nbsp;</span><br>Create Date</th>
                                                <th><span>&nbsp;</span><br>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($report_list!=0){ ?>
                                                <?php foreach ($report_list as $key => $value) {

                                                    if(in_array('export',$actAcx) || $session['admin_type']=='A'){
                                                     $exportLink = $value->report_download_link;
                                                     $icon = '<i class="icofont-download"></i>';
                                                    }else{
                                                      $exportLink ="";  
                                                      $icon ="";
                                                    }
                                                 ?>
                                                    <tr>
                                                        <td><?php echo ($key+1);?></td>
                                                        <td><a href="<?php echo $exportLink;?>"><?php echo $icon;?> <?php echo $value->report_name;?></a></td>
                                                        <td><?php 

                                                        if($value->input_value!=""){
                                                             $expore = explode(':::',$value->input_value);
                                                            foreach ($expore as $key => $value_inp) {
                                                               echo '<span class="badge bg-success" style="background-color: #689F39 !important">'.$value_inp.'</span> ';
                                                            }
                                                        }
                                                        ?>
                                                            
                                                        </td>
                                                        <td><?php echo $value->create_by;?></td>
                                                        <td><?php echo $value->add_date;?></td>
                                                        <td>
                                                         <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                            <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->report_id;?>" data-id="<?php echo base64_encode($value->report_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                        <?php } ?>

                                                        </td>
                                                    </tr>
                                                   <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                 <br>
                                 <div id="pagint-div" style="float: right;">
                                  <?php echo $links;?>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>