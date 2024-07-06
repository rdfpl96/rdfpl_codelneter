<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

 <!-- Body: Body -->       
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Order Status</h3>
                                <div class="col-auto d-flex w-sm-100">
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row customer_list_css clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Order Status</th> 
                                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th>Status</th>
                                            <?php } ?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="order_status_css">

                                            <?php 
                                           if($orderStatus_list!=0){
                                            $index=0;
                                            foreach(array_reverse($orderStatus_list) as $value){
                                           
                                                $index++;
                                                ?>
                                                    <tr id="<?php echo $value->status_id;?>">
                                                        <td><?php echo $index;?></td>
                                                        <td><?php echo $value->order_status;?></td>
                                                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                            <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->status_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    <?php } ?>
                                                       
                                                    </tr>
                                                <?php
                                            }
                                           }
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>