
<?php
// $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
// if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
//     echo "No direct page access allowed";
//     exit;
//    }
?>

      <form action="" method="post" id="my-form-banner" enctype="multipart/form-data">
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4"> 
            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Ads Banner</h3>
                                <div class="loaderdiv"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?php echo base_url('admin/ads_banner');?>"><button type="button" class="btn btn-primary giod custom_top_btn_css btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                                </div>
                                <div class="col-md-6">
                                <button type="submit" class="btn btn-primary giod custom_top_btn_css btn-set-task w-sm-100 py-2 px-5 text-uppercase s">Save</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">
                                  <input type="hidden" class="form-control" name="editv" id="editv" value="<?php echo $this->uri->segment(3);?>">

                                  <?php
                                //    echo "<pre>";
                                //    print_r($banner_details);
                                //    die();
                                //    echo "</pre>";
                                  ?>
                                  
                                    
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-5">
                                                <label  class="form-label">Header</label>
                                                <input type="text" class="form-control" name="text1" id="text1" value="<?php echo ($banner_details!=0) ? $banner_details[0]->text1 :'';?>" required>
                                                <span id="text1-error" class="text-danger"></span>
                                            </div>
                                            <div class="col-md-5">
                                                <label  class="form-label">Link</label><br>
                                                <input type="text" class="form-control" name="link" onkeyup="validateLink()" id="link" value="<?php echo ($banner_details!=0) ? $banner_details[0]->button_link :'';?>" required>
                                                <span id="link-error" class="text-danger"></span>
                                            
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <label  class="form-label">Active</label><br>
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <button type="button" class="btn  custom_flip_btn_css py-2 text-uppercase w-sm-100">
                                               <label class="switch">
                                                    <input type="checkbox" id="btn-status" onclick="UpdateBlogStatus(<?php echo $banner_details[0]->banner_id ?>,<?php echo $banner_details[0]->status ?>)" value="<?php echo ($banner_details!=0) ? $banner_details[0]->status :'';?>" <?php if($banner_details[0]->status == 1) { echo 'checked';} ?>  >
                                                   <span class="slider round"></span>
                                                 </label>
                                               </button>
                                               </div>
                                            </div> -->

                                         
                                       <div class="col-md-4">
                                            <label class="form-label">Ad Banner Image<span style="color:red;">*</span></label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="userfile" id="userfile" <?php echo ($banner_details == 0) ? 'required' : ''; ?>>
                                                <input type="hidden" class="form-control" name="desk_imgPath" id="desk_imgPath" value="<?php echo ($banner_details != 0) ? $banner_details[0]->desk_image : ''; ?>">

                                                <?php
                                                if ($banner_details != 0) {
                                                    ?>
                                                    <img src="<?php echo base_url() . 'uploads/banner/' . $banner_details[0]->desk_image; ?>" style="width:37px;height: 37px;">
                                                    <?php
                                                }
                                                ?>  
                                            </div>
                                            <span style="color:red;font-size: 13px;">Image dimension should be 760 X 760 Px.</span>
                                        </div>

                                        </div>
                                    </div>

                                </div>
                            
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
            </div>    
    
        </div>      

    </div>
</form>
   



<script>

function UpdateBlogStatus(baner_id,status_value) {
    console.log('baner_id JS=> ',baner_id);
    console.log('status_value JS=>', status_value);

    $.ajax({
        url: "<?php echo base_url('Admin/update_banner_Status'); ?>",
        type: "POST",
        data: { baner_id: baner_id, status_value: status_value},
        dataType: "json",
        success: function(response) {
            
            console.log(response);

            if (response == 'True') {
                Swal.fire(
                    'Updated!',
                    'Banner status has been updated.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            } 
            else {
                Swal.fire(
                    'Failed!',
                    'Failed to update blog status.',
                    'error'
                );
            }
        }
        // ,
        // error: function() {
        //     Swal.fire(
        //         'Error!',
        //         'Error updating blog status.',
        //         'error'
        //     );
        // }
    })
}


</script>






