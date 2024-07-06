
<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

 <!-- Body: Body -->
 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Message List</h3>
                               

                           <div class="loaderdiv"></div>      
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                             <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                            <button type="button" class="btn btn-light custom_flip_btn_css py-2 px-5 text-uppercase w-sm-100">
                                 <label class="switch">
                                       <input type="checkbox" class="action-ads" <?php echo ($this->my_libraries->ads_ActiveStaus(1)==1) ?'checked' :'';?>>
                                     <span class="slider round"></span>
                                </label>
                             </button>
                         <?php } ?>

                              <?php
                                    $desabledAtrr=(in_array('edit',$actAcx) && $this->uri->segment(3)!="") ?'' :((in_array('add',$actAcx)) ? '': (($session['admin_type']=='A') ?'':'disabled'));

                                  if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ 
                                    ?>

                                <div class="btn-group" role="group">

                                   <button type="button" class="btn btn-primary ads-cl custom_message_css py-2 px-5 text-uppercase btn-set-task w-sm-100 ads-save" <?php echo $desabledAtrr;?>>Save</button>
                                </div>

                            <?php } ?>
                        </div>


                                

                                

                                
                            </div>
                        </div>
                    </div> <!-- Row end  -->

<!-- 
 -->
                    <div class="card-body" style="padding:10px 0px;">
                 <?php if((in_array('add',$actAcx) || in_array('edit',$actAcx)) || $session['admin_type']=='A'){ ?>
                    <form>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label  class="form-label">Message</label>
                                <input type="hidden" id="get-ads-id" value="<?php echo ($ads_detaials!=0) ? $ads_detaials[0]->ads_id :'';?>">
                                <textarea type="text" class="form-control" id="message" name="message"><?php echo ($ads_detaials!=0) ? $ads_detaials[0]->ads_message :'';?></textarea>
                            </div>
                          
                        </div>
                    </form>
                <?php } ?>
                </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card category_list_css">
                                <div class="card-body">
                                    <!-- table table-bordered -->
                                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Message</th>
                                                <th>Updated By</th>
                                                <th>Date</th>
                                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th>Status</th>
                                            <?php } ?>
                                             <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th><span style="float: right;">Action</span></th>
                                            <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row_position">
                                            <?php  
                                            if($ads_list!=0){
                                                $index=0;
                                                ;
                                                foreach(array_reverse($ads_list) as $value){
                                                   $index++;
                                                    ?>

                                                     <tr id="<?php echo $value->ads_id;?>">
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        <td><?php echo $value->ads_message;?></td>
                                                        <td><?php echo $value->updated_by;?></td>
                                                         <td><?php echo date('d-m-Y',strtotime($value->add_date));?></td>

                                                          <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                            
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo $value->ads_id;?>" class="adss-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>

                                                           
                                                        </td>
                                                    <?php } ?>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                                <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <a href="<?php echo base_url('admin/message/'.$value->ads_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                                 <?php } ?>

                                                                <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>

                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->ads_id;?>" data-id="<?php echo base64_encode($value->ads_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                                   <?php } ?>

                                                             
                                                            </div>
                                                        </td>
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
                </div>
            </div>

            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="loader"></div> -->
              <!-- <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    <p>Some text in the modal.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div> -->
            <!-- </div> -->