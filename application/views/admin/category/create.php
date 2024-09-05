<?php
defined('BASEPATH') or exit('No direct script access allowed');

$session = $this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
?>

<?php if ($this->session->flashdata('success_message')): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?php echo $this->session->flashdata('success_message'); ?>',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php elseif ($this->session->flashdata('error_message')): ?>
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
        <form action="<?php echo base_url('admin/category/store'); ?>" method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="mob_back_btn">
                            <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                        </div>

                        <h3 class="fw-bold mb-0">Add Category</h3>

                        <!-- <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3) == "") ? 'Add' : 'Edit'; ?> <?php echo ucfirst($this->uri->segment(4)); ?> Products</h3> -->
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/category'); ?>"><button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="row g-3 align-items-center mb-3">

                                        <div class="col-md-6">
                                            <label class="form-label">category name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control cname" id="category-name" name="category_name" value="" required placeholder="Please category name">
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label">Category Slug <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="slug" name="slug" value="" required placeholder="Please enter slug" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Category Image
                                                <span style="color:red;">
                                                    (Allowed extensions: jpg, jpeg, png, gif; Dimensions: 256x256 pixels)
                                                </span>

                                            </label>
                                            <input type="file" class="form-control url" id="cat_image" name="cat_image" value="" required placeholder="">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>




<!--  </div>
  </div>  -->
<?php $this->load->view('admin/footer'); ?>
<script>
$(document).ready(function (){
    $("#category-name").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#slug").val(Text);        
    });
});
</script>