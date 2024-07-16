
<?php
   // echo "<pre>";
   // print_r($getAccess['inputAction']);
   // print_r($session['admin_type']);
   // echo "</pre>";
 $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

<style type="text/css">
    .table-bordered {
    border-collapse: collapse;
    width: 100%;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
.fomatText{
    text-align: center !important;

}
</style>
 <!-- Body: Body -->
 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Blogs L111ist</h3>
                               <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                    <a href="<?php echo base_url('admin/add-blogs');?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100">Add Blogs</a>
                              <?php } ?>
                                
                            </div>
                        </div>
                    </div> <!-- Row end  -->


                    <div class="row blogs_css g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- table table-bordered -->
                                    <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="fomatText">Sr.No.</th>
                                                <th class="fomatText">Header Name</th>
                                                <th class="fomatText">Categorie</th>
                                                <th class="fomatText">Image</th>
                                                <th class="fomatText">Updated By</th>
                                                <th class="fomatText">Date</th>
                                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th class="fomatText">Status</th>
                                              <?php } ?>
                                               <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th><span style="float: right;">Action</span></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row_position_blogs33">
                                            <?php  
                                            if($blogs_list!=0){
                                                $index=0;
                                                ;
                                                foreach($blogs_list as $value){
                                                   $index++;
                                                    ?>

                                                     <tr id="<?php //echo $value->blog_id;?>">
                                                        <td tyle="text-align:right"><strong><?php echo $index;?></strong></td>
                                                         <td title="<?php echo $value->blog_header;?>"><?php echo getShortData($value->blog_header,60);?></td>
                                                        <td><?php echo $this->my_libraries->getCate_name($value->blog_category);?></td>
                                                        <td>

                                                            <?php
                                                              $filePath=(($value->blog_image!="") ? './uploads/blogs_image/'.$value->blog_image :'');
                                                            if(file_exists($filePath)){
                                                               $imgFile=base_url().'uploads/blogs_image/'.$value->blog_image;
                                                            }else{
                                                              $imgFile=base_url().'include/assets/default_product_image.png';
                                                            }

                                                            ?>
                                                           
                                                            <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">
                                                        </td>
                                                        <td style="text-align:center;"><?php echo $value->updated_by;?></td>
                                                        <td style="text-align:right"><?php echo date('d-m-Y',strtotime($value->blog_add_date));?></td>

                                                         <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->blog_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->blog_status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                      <?php } ?>
                                                        
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                              <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <a href="<?php echo base_url('admin/add_blogs/'.$value->blog_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                                 <?php } ?>
                                                              <?php //if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->blog_id;?>" data-id="<?php echo base64_encode($value->blog_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                                <?php //} ?>
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