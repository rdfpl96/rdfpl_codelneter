
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
                                <h3 class="fw-bold mb-0">Newsletter Subscription</h3>
                                  



                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row customer_list_css clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                   <?php if(in_array('export',$actAcx) || $session['admin_type']=='A'){ ?>
                                          <label class="form-label btn btn-sm btn-secondary btn-upload" style="margin-left: 95%;">
                                              <a href="<?php echo base_url('export_NewsletterList');?>" style="color:white;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></a>
                                          </label>
                               <?php } ?>

                                    <div class="table-responsive">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Email</th>
                                                <th>Date</th>
                                                 <?php if((in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th>Actions</th> 
                                                <?php } ?> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- customer_list -->

                                            <?php 
                                           if($newSletter_list!=0){
                                            $index=0;
                                            foreach($newSletter_list as $value){
                                               
                                                $index++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index;?></td>
                                                       
                                                        <td>
                                                            <?php echo $value->email;?>
                                                        </td>

                                                         <td>
                                                            <?php echo $value->add_date;?>
                                                        </td>
                                                       
                                                      
                                                        <td>

                                                           <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                             <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->newsletter_id;?>" data-id="<?php echo base64_encode($value->newsletter_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                              
                                                          <?php } ?>
                                                        </div>

                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                           }
                                            ?>
                                         <tr>
                                          <td colspan="12">
                                           <div id="pagint-div" style="float: right;">
                                            <?php echo $links;?>
                                           </div>
                                           </td>
                                        </tr>
                                          
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>