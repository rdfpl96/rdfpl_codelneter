        
<?php

$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2">
                        <div class="col">
                            <div class="alert-success alert mb-0">
                                <div class="d-flex align-items-center">
                                    <!-- <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-inr fa-lg"></i></div> -->
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Today Earning</div>
                                         <div id="apex-basic-column"></div>
                                        <!-- <span class="small">₹<?php echo ($totalSaleToday[0]->totalSale!="") ? $totalSaleToday[0]->totalSale : 0.00;?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-danger alert mb-0">
                                <div class="d-flex align-items-center">
                                    <!-- <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-inr"></i></div> -->
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Weekly Earning</div>
                                        <div id="apex-basic-column2"></div>
                                        <!-- <span class="small">₹<?php echo ($totalSaleWeek[0]->totalSale!="") ? $totalSaleWeek[0]->totalSale :0.00;?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <div class="d-flex align-items-center">
                                    <!-- <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-inr"></i></div> -->
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Monthly Earning</div>
                                        <div id="apex-basic-column3"></div>
                                        <!-- <span class="small">₹<?php echo ($totalSaleMonth[0]->totalSale!="") ? $totalSaleMonth[0]->totalSale :0.00;?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-info alert mb-0">
                                <div class="d-flex align-items-center">
                                    <!-- <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-inr" aria-hidden="true"></i></div> -->
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Yearly Earning</div>
                                        <div id="apex-basic-column4"></div>
                                        <!-- <span class="small">₹<?php echo ($totalSaleYear[0]->totalSale!="") ? $totalSaleYear[0]->totalSale :0.00;?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->

                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="tab-filter d-flex align-items-center justify-content-between mb-3 flex-wrap">
                                <ul class="nav nav-tabs tab-card tab-body-header rounded  d-inline-flex w-sm-100">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#summery-today" >Today</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-week" >Week</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-month" >Month</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-year" >Year</a></li>
                                </ul>
                                
                            </div>
                            <div class="tab-content mt-1">
                                <div class="tab-pane fade show active" id="summery-today">
                                  
                                    <div class="row g-1 g-sm-3 mb-3 row-deck">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Order</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php //echo count($countOrderToday);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Customers</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php //echo count($countCustomerToday);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Sale</span>
                                                        <div><span class="fs-6 fw-bold me-2">₹<?php //echo ($totalSaleToday[0]->totalSale!="") ? $totalSaleToday[0]->totalSale :0.00;?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Products</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php //echo count($totalProduct);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-bag fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php 
                                    $sold['mostSoldProducts']=$mostSoldProductToday;
                                    $this->load->view('admin/containerPage/most_sold_products',$sold);
                                    ?>
                                      
                                      
                                        
                                    </div> <!-- row end -->
                                </div>
                                <div class="tab-pane fade" id="summery-week">
                                    <div class="row g-3 mb-4 row-deck">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Order</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($countOrderWeek);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Customers</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($countCustomerWeek);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Sale</span>
                                                        <div><span class="fs-6 fw-bold me-2">₹<?php echo ($totalSaleWeek[0]->totalSale!="") ? $totalSaleWeek[0]->totalSale :0.00;?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Products</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($totalProduct);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-bag fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                          $soldweek['mostSoldProducts']=$mostSoldProductWeek;
                                          $this->load->view('admin/containerPage/most_sold_products',$soldweek);
                                        ?>
                                        
                                      
                                    </div> <!-- row end -->
                                </div>
                                <div class="tab-pane fade" id="summery-month">
                                    <div class="row g-3 mb-4 row-deck">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Order</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($countOrderMonth);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Customers</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($countCustomerMonth);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Sale</span>
                                                        <div><span class="fs-6 fw-bold me-2">₹<?php echo ($totalSaleWeek[0]->totalSale!="") ? $totalSaleWeek[0]->totalSale :0.00;?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Products</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($totalProduct);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-bag fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         <?php
                                          $soldmonth['mostSoldProducts']=$mostSoldProductMonth;
                                          $this->load->view('admin/containerPage/most_sold_products',$soldmonth);
                                        ?>
                                        
                                        
                                    </div> <!-- row end -->
                                </div>
                                <div class="tab-pane fade" id="summery-year">
                                    <div class="row g-3 mb-4 row-deck">
                                         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Order</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($countOrderYear);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Customers</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($countCustomerYear);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Sale</span>
                                                        <div><span class="fs-6 fw-bold me-2">₹<?php echo ($totalSaleYear[0]->totalSale!="") ? $totalSaleYear[0]->totalSale :0.00;?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Total Products</span>
                                                        <div><span class="fs-6 fw-bold me-2"><?php echo count($totalProduct);?></span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-bag fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                          $soldyear['mostSoldProducts']=$mostSoldProductYear;
                                          $this->load->view('admin/containerPage/most_sold_products',$soldyear);
                                        ?>
                                       
                                       
                                    </div> <!-- row end -->
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->

                 


                     <div class="row g-3 mb-3"> 
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">Today Order</h6>
                                </div>
                                <div class="card-body"> 

                                
                                     <div class="table-responsive">
                                    <table id="" class="table table-hover align-middle mb-0" style="white-space: nowrap;width: 100%;">  
                                        <thead>
                                            <tr>
                                                <th><span>&nbsp;</span><br>Id</th>
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
                    </div><!-- Row end  -->

                    <div class="row g-3 mb-3">
                        <div class="col-xxl-12 col-xl-12">
                           
                            <div class="card">

                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">Selling Product</h6>
                                </div>
                                <div class="card-body">
                                    <div id="topselling"></div>
                                </div>
                            </div>
                        </div>

                    </div><!-- Row end  -->

                    <div class="row g-3 mb-3 row-deck">
                      
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                             

 

                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">

                                   
                                     <div class="col-lg-8 col-md-8">
                                    <h6 class="m-0 fw-bold">Earning</h6>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                    
                                </div>
                              


                                </div>
                                <div class="card-body">

                                
                                    <div class="h2 mb-0">&#8377;<?php echo sprintf('%.2f',array_sum(json_decode($this->my_libraries->getEarningGgraphBar())));?></div>
                                    <!-- <span class="text-muted small">Avg Expense Costs All Month</span> -->
                                    <div id="apex-expense"></div>  
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->

                   
                    
                </div>
            </div>
        
     
          
            
        </div>