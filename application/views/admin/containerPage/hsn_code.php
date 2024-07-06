<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
    text-align: center;
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
                                <h3 class="fw-bold mb-0">HSN Code List</h3>
                                <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                     <a href="<?php echo base_url('admin/add_hsn');?>"><button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Add HSN Code</button></a>
                             <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->


                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3">
                            <div class="filter-search">
                                <form action="#" id="search-form" method="post">
                                    <label class="form-label">Search HSN</label>
                                    <input type="text" placeholder="" class="form-control" id="search-hsn">
                                    <div class="loaderdiv-searchs" style="position: absolute;"></div>
                                </form>
                            </div>
                        </div>

                         <?php if(in_array('import',$actAcx) || $session['admin_type']=='A'){ ?>

                        <div class="col-md-1 width_20">
                              <form action="" method="post" id="my-form-import" class="fordi" enctype="multipart/form-data">
                                    <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload" for="inputHSN" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputHSN" name="fileupload" accept="csv/*">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Import </span>
                                </label>
                              </form>

                              <div class="loaderdiv" style="margin-top: 35%;"></div>
                        </div>
                    <?php } ?>
                     
                      <?php if(in_array('export',$actAcx) || $session['admin_type']=='A'){ ?>

                          <div class="col-md-1 width_20">

                                    <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload" >
                                    <a href="<?php echo base_url('export_HSN_CSV');?>" style="color:white;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></a>
                                </label>
                           </div>
                      
                   <?php } ?>
                    </div>
                </div>
                    <div class="row hsn_code_list_css g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- table table-bordered -->
                                    <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>SR.NO.</th>
                                                <th>HSN Code</th>
                                                <th>HSN Description</th>
                                                <th>Updated By</th>
                                                <th>Date</th>
                                                <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                  <th>Status</th>
                                               <?php } ?>
                                                <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th><span style="">Action</span></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody id="trRow">
                                            <?php 
                                                $data['hsn_list']=$hsn_list;
                                                $this->load->view('admin/containerPage/searchHsn',$data);
                                              ?>
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