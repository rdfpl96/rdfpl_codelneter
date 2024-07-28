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

        <form id="update-coupon-form">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="mob_back_btn">
                            <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                        </div>

                        <h3 class="fw-bold mb-0">Update Coupon</h3>

                        <!-- <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3) == "") ? 'Add' : 'Edit'; ?> <?php echo ucfirst($this->uri->segment(4)); ?> Products</h3> -->
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/coupon'); ?>"><button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase update-coupon ">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

// echo "<pre>";

//  print_r($coupon);
//  die();
            ?>


            <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">

                                <input type="hidden" name="coupon_id" id="coupon_id"  value="<?php echo $coupon['coupon_id']; ?>" >
                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Coupons Code</label>
                                            <input type="text" class="form-control" name="coupon_code" id="coupon_code" value="<?php echo $coupon['coupon_code']; ?>" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Discount Type<span style="color:red;">*</span></label>
                                            <select class="form-control" id="disc_type" name="disc_type" required>
                                                <option value="fixed_amt" <?php echo ($coupon['disc_type'] == 'fixed_amt') ? 'selected' : ''; ?>>Fixed Amount</option>
                                                <option value="percentage" <?php echo ($coupon['disc_type'] == 'percentage') ? 'selected' : ''; ?>>Percentage</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Discount Per <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" id="disc_per" name="disc_per" value="<?php echo $coupon['disc_per']; ?>" required placeholder="Please enter Percentage">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Discount Amount <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" id="disc_amt" name="disc_amt" value="<?php echo $coupon['disc_amt']; ?>" required placeholder="Please enter Amount">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Start Date<span style="color:red;">*</span></label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $coupon['start_date']; ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">End Date<span style="color:red;">*</span></label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $coupon['end_date']; ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Coupon Code Status<span style="color:red;">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="radio" name="coupon_status" value="1" <?php echo ($coupon['coupons_status'] == '1') ? 'checked' : ''; ?> required><span style="padding-left:10px">Active</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" name="coupon_status" value="0" <?php echo ($coupon['coupons_status'] == '0') ? 'checked' : ''; ?>><span style="padding-left:10px">Inactive</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Coupon Time Uses<span style="color:red;">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="radio" name="coupon_time_uses" value="multi_use" <?php echo ($coupon['coupon_time_uses'] == 'multi_use') ? 'checked' : ''; ?> required><span style="padding-left:10px">Multiple time use</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" name="coupon_time_uses" value="single_use" <?php echo ($coupon['coupon_time_uses'] == 'single_use') ? 'checked' : ''; ?>><span style="padding-left:10px">One time use</span>
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
    </div>
</div>




<!--  </div>
  </div>  -->
<?php $this->load->view('admin/footer'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.update-coupon').on('click', function() {
            var formData = $('#update-coupon-form').serialize();
            var coupon_id = $('#coupon-id').val();
            $.ajax({
                url: '<?php echo base_url('AdminPanel/Coupon/update'); ?>',
                type: 'POST',
                data: formData,
                coupon_id:coupon_id,
                success: function(response) {
                
                       Swal.fire({
                        icon: 'success',
                        title: 'Coupon updated successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                            window.location.href = "<?php echo base_url('admin/coupon'); ?>";
                        });
                    
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Update failed. Please try again.'
                    });
                }
            });
        });
    });
</script>