           
 <?php
   // echo "<pre>";
   // print_r($getAccess['inputAction']);
   // print_r($session['admin_type']);
   // echo "</pre>";
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
                                <h3 class="fw-bold mb-0">Orders List</h3>
                                 <div class="loaderdiv" style="position: absolute;z-index: 99999999;float: right;margin-left: 70%;"></div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                     <!-- ============================================================ -->

                     <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">
                <div class="card mb-3">
                <div class="card-body">
                  <form action="<?php echo base_url('admin/export_OrderList');?>" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="filter-search">
                                <!-- <form action="#" id="search-form" method="post"> -->
                                    <label class="form-label">Search Orders</label>
                                    <input type="text" placeholder="Search" class="form-control" name="getKeywords" id="search-orders">
                                <!-- </form> -->
                            </div>
                        </div>
                      
                      <div class="col-md-9">
                        <div class="row">
                          <!-- <input type="text" id="inputUrl"> -->
                            <div class="col-md-4">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control w-100 searchDate" name="fromDate" id="fromDate" value="">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control w-100 searchDate" id="toDate" name="toDate" value="">
                            </div> 

                            <?php if(in_array('export',$actAcx) || $session['admin_type']=='A'){ ?>
                                  <div class="col-md-4">
                                        <button type="submit" class="form-label btn btn-sm btn-secondary btn-upload" style="color:white;margin-top: 10.9%;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></button>
                                    </div>  
                               <?php } ?>
                        </div>
                    </div>

                  

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 order_filter_btn">
                             <a href="<?php echo base_url('admin/product_order');?>"><button type="button" class="btn btn-primary btns">
                                Today Order <span class="badge text-maroon bg-secondary"><?php echo $countTodayOrder; ?></span>
                            </button></a>

                            <?php
                             foreach(array_reverse($order_status) as $v_btn){
                                $order_status_count=$this->sqlQuery_model->sql_select_where('tbl_order_manager',array('order_status'=>$v_btn->order_status));
                                  $countOrder=($order_status_count!=0) ? count($order_status_count) :0;

                                ?>
                                <button type="button" class="btn btn-primary btns" <?php echo getOrderStatusColor_wareIq($v_btn->order_status);?>>
                                  <label><input type="checkbox" id="<?php echo $this->my_libraries->replaceAll( $v_btn->order_status);?>" name="orderSttus[]" class="btn-status-class" value="<?php echo $v_btn->order_status;?>">
                                  <?php echo $v_btn->order_status;?> <span class="badge text-maroon bg-secondary"><?php echo $countOrder;?></span></label>
                                  </button>
                                <?php
                             }

                            
                            ?>

                         
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

                                    <?php
                                       // echo "<pre>";
                                       // print_r($order_amount[0]->total_amount);

                                    ?>
                                    <div class="table-responsive">
                                    <table id="" class="table table-hover align-middle mb-0 clssn" style="white-space: nowrap;width: 100%;">  
                                        <thead>
                                            <tr>
                                                <th><span>&nbsp;</span><br>Order Id</th>
                                                <!-- <th>Item</th> -->
                                                <th><span>&nbsp;</span><br>Customer Name</th>
                                                <th><span>&nbsp;</span><br>Location</th>
                                                <!-- <th>Payment</th> -->
                                                <th style="text-align: center;"><i class="fa fa-inr" aria-hidden="true" style="font-weight: bold;font-size: 17px;"></i> <span style="font-weight: bold;font-size: 19px;" class="tot-Amu"><?php echo ($order_list!=0) ? $order_amount[0]->total_amount : 0.00;?></span><br>Order amount</th>
                                                <th><span>&nbsp;</span><br>Status</th>
                                                <!-- <th><span>&nbsp;</span><br>Take Away</th> -->
                                                <th><span>&nbsp;</span><br>Pay Status</th>
                                                <th><span>&nbsp;</span><br>Order Date</th>
                                                <?php if(in_array('view',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th><span>&nbsp;</span><br>Details</th>
                                              <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody id="trRow">

                                            <?php 
                                            // echo "<pre>";
                                            // print_r($order_list);
                                            // echo "</pre>";
                                                $data['order_list']=$order_list;
                                                $this->load->view('admin/containerPage/orderSearch',$data);
                                              ?>
                                        </tbody>
                                    </table>
                                    </div>
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