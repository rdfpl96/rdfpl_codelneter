 <!-- Body: Body -->
 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Delivery Slot</h3>
                               
                                 <button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100 slot-save">Save</button>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                    <div class="card-body">
                    <form>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3">
                                <label  class="form-label">Date</label>
                                <input type="hidden" id="get-slot-id" value="<?php echo ($slot_detaials!=0) ? $slot_detaials[0]->slot_id :'';?>">
                                <input type="date" class="form-control" id="get-date" name="get_date" value="<?php echo ($slot_detaials!=0) ? $slot_detaials[0]->slot_date :'';?>">
                            </div>


                            <div class="col-md-3">
                                <label  class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start-time" name="start_time" value="<?php echo ($slot_detaials!=0) ? $slot_detaials[0]->start_time :'';?>">
                            </div>

                            <div class="col-md-3">
                                <label  class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end-time" name="end_time" value="<?php echo ($slot_detaials!=0) ? $slot_detaials[0]->end_time :'';?>">
                            </div>
                          
                        </div>
                    </form>
                </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Updated By</th>
                                                <th>Add Date</th>
                                                <th>Status</th>
                                                <th>Default Set</th>
                                                <th><span style="float: right;">Action</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                            if($delivery_slot!=0){
                                                $index=0;
                                                foreach($delivery_slot as $value){
                                                   $index++;
                                                    ?>

                                                     <tr>
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        <td><?php echo $value->slot_date;?></td>
                                                        <td><?php echo $value->start_time;?></td>
                                                        <td><?php echo $value->end_time;?></td>
                                                        <td><?php echo $value->updated_by;?></td>
                                                         <td><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                                                        <td>
                                                            
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->slot_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                             <label class="switch">
                                                             <input type="checkbox" data-id="<?php echo base64_encode($value->slot_id.':::'.implode(',',$ActiveInactive_ActionArr_default));?>" class="set-default" <?php echo ($value->default_set==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                             </label>
                                                        </td>
                                                        </td>
                                                       
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                                
                                                                
                                                                <a href="<?php echo base_url('admin/delivery_slot/'.$value->slot_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>

                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->slot_id;?>" data-id="<?php echo base64_encode($value->slot_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>

                                                              
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