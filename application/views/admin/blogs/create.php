<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<?php
//print_r($categories);

defined('BASEPATH') or exit('No direct script access allowed');

$session = $this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
?>

<?php if ($this->session->flashdata('success_message')) : ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?php echo $this->session->flashdata('success_message'); ?>',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php elseif ($this->session->flashdata('error_message')) : ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $this->session->flashdata('error_message'); ?>'
        });
    </script>
<?php endif; ?>
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="#" id="form-blogs" name="form_blogs" method="POST" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="mob_back_btn">
                            <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                        </div>
                        <h3 class="fw-bold mb-0">
                                                    Add Blogs</h3>
                        <div class="loaderdiv"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/blogs'); ?>"><button type="button" class="btn btn-primary btn-set-task blo-cl w-sm-100 py-2 px-5 text-uppercase">Back</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-set-task blo-cl w-sm-100 py-2 px-5 text-uppercase  saved-blog ">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">
<?php 
// echo '<pre>';
// print_r($categories);
// die();
?>
                    <!-- <div class="card-body"> -->

                    <input type="hidden" class="form-control" name="blog_id" id="blog_id" value="<?php echo $this->uri->segment(3); ?>">
                    <div class="row">
                        <div class="col-md-9">
                            <label class="form-label">Header Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="blog_header" name="blog_header" value="<?php echo ($product_list != 0) ? $product_list[0]->blog_header : ''; ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Category <span style="color:red;">*</span></label>
                            <select type="text" class="form-control category-action" id="blog_category" name="blog_category">
                                <option value="">-Select-</option>
                                <?php


                                if ($categories != 0) {
                                    foreach ($categories as $value) {
                                        // echo '<pre>';
                                        // print_r($value);
                                        // $cate_id = ($product_list != 0) ? $product_list[0]->blog_category : '';
                                        // $selected = ($value->cat_id == $cate_id) ? 'selected' : '';
                                ?>
                                        <option value="<?php echo $value->cat_id; ?>"><?php echo $value->category; ?></option>
                                <?php
                                    }
                                }
                                ?>
                                
                                

                            </select>


                            <p id="cat-err"></p>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->

                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="form-label">Description<span style="color: red;">*</span></label>
                            <!-- <textarea type="text" class="form-control" name="blog_description" id="blog_description" rows="9"><?php //echo ($product_list!=0)? $product_list[0]->blog_description :'';
                                                                                                                                    ?></textarea> -->

                            <textarea class="form-control" name="blog_description" id="blog_description"><?php echo ($product_list != 0) ? $product_list[0]->blog_description : ''; ?></textarea>

                            <!-- <div class="col-md-12">
                                         <label class="form-label">Product Description</label>
                                           <div id="editor">
                                              <h4>Enter Product Description Here</h4>
                                         </div>
                                         </div> -->



                            <!--  <div class="col-md-12">
                                       <label for="Tags" class="form-label">Tags(Optional)</label>
                                          <input type="text" class="form-control" id="blog_tag_field" name="blog_tag_field" data-role="tagsinput" style="display: none;" value="<?php //echo ($product_list!=0)? $product_list[0]->blog_tag_field :'';
                                                                                                                                                                                ?>">        
                                     </div> -->

                            <div class="col-md-12">
                                <label for="Tags" class="form-label">Image<span style="color: red;">*</span> </label>
                                <input type="file" class="form-control" id="blog_image" name="blog_image">


                                <span style="color:red;font-size: 13px;">Image dimension should be 2000 X 950 Px.</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>




<?php $this->load->view('admin/footer'); ?>
<script>
    CKEDITOR.replace('blog_description');
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    
$(document).ready(function() {
    $('.saved-blog').on('click', function() {
        var formData = new FormData();
        formData.append('blog_header', $('#blog_header').val());
        formData.append('blog_category', $('#blog_category').val());
        formData.append('blog_image', $('#blog_image')[0].files[0]);
        formData.append('blog_description', CKEDITOR.instances.blog_description.getData());
        $.ajax({
            url: "<?php echo base_url('AdminPanel/Blogs/create'); ?>",
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false,
            success: function(response) {
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: responseData.message
                    }).then(() => {
                        window.location.href = "<?php echo base_url('admin/blogs'); ?>";
                    });
                }
                 else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: responseData.message
                    });
                }
            },
            // error: function(jqXHR, textStatus, errorThrown) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Error',
            //         text: 'Failed to send data. Please try again.'
            //     });
            //     console.error('Error sending data:', textStatus, errorThrown);
            // }
        });
    });
});









</script>