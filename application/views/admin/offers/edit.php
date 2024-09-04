<?php
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

<div class="body d-flex py-3">
    <div class="container-xxl">


<form action="#" id="updateOfferForm" name="updateOfferForm" method="POST" enctype="multipart/form-data" onsubmit="UpdateOffer(); return false;">

             
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="mob_back_btn">
                            <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                        </div>
                        <h3 class="fw-bold mb-0">update Offers</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/offers'); ?>"><button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="Submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase  Update-offer "  id="Update-offer" name="Update-offer">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($this->session->flashdata('msg')) : ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            <?php endif; ?>
            <?php
            $offer_name = $offer[0]['offer_name'];
            $description = $offer[0]['description'];
            $value = $offer[0]['value'];
            $offer_type = $offer[0]['offer_type'];
            ?>
            <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row g-3 align-items-center mb-3">
                                        <input type="hidden" id="old_product_id" name="old_product_id" value="<?php echo $offer[0]['product_id'];?>">
                                        <div class="col-md-6">
                                            <label class="form-label">Offer Name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="offer_name" name="offer_name" value="<?php echo htmlspecialchars($offer_name); ?>" required placeholder="Please enter Offer Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Offer Type <span style="color:red;">*</span></label>
                                            <select class="form-control" id="offer_type" name="offer_type" required>
                                                <option value="">Please select Offer Type</option>
                                                <option value="1" <?php echo ($offer_type == 1) ? 'selected' : ''; ?>>Percentage</option>
                                                <option value="0" <?php echo ($offer_type == 0) ? 'selected' : ''; ?>>Fixed Amount</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Description <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>" required placeholder="Please enter Description">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Value <span style="color:red;">*</span></label>
                                            <input type="number" class="form-control url" id="value" name="value" value="<?php echo htmlspecialchars($value); ?>" required placeholder="Please enter Amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Product <span style="color:red;">*</span></label>
                                            <select class="form-select" id="product_id" name="product_id" required>
                                                <?php foreach ($productList as $product) : ?>
                                                    <option value="<?php echo $product['product_id']; ?>" <?php echo ($product['product_id'] == $selectedProductId) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($product['product_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Product Variant<span style="color:red;">*</span></label>
                                            <select class="form-select" id="product_variant" name="product_variant[]" required multiple>
                                                <!-- <option value="1">Select</option>
                                               <option value="2">Select1</option>
                                               <option value="3">Select2</option>
                                               <option value="4">Select3</option> -->
                                            </select>
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

<?php $this->load->view('admin/footer'); ?>

<script>
    // Product dropdown selection script 
    selectProductDripdown();

    function selectProductDripdown() {
        var dropdown = document.getElementById('product_id');
        dropdown.value = <?php echo $offer[0]['product_id']; ?>;
        getProductVariantsDropdown();
    }

    function getProductVariantsDropdown() {
        var cat_id = $('#product_id').val();
        $.ajax({
            url: "<?php echo base_url('AdminPanel/offers/getvariantbycategory') ?>",
            type: "POST",
            data: {
                category_id: cat_id
            },
            success: function(response) {
                var variants = JSON.parse(response);
                $('#product_variant').html(variants);
                var selectedVariants = <?php echo json_encode(array_column($variant, 'variant_id')); ?>;
                $('#product_variant').val(selectedVariants);
                $('#product_variant').trigger('chosen:updated');
            },
            complete: function() {
                $('#product_variant').chosen();
            }
        });
    
    
    
    }





    $(document).ready(function() {
        $('#product_id').change(function() {
            var cat_id = $('#product_id').val();
            $.ajax({
                url: "<?php echo base_url('AdminPanel/offers/getvariantbycategory') ?>",
                type: "POST",
                data: { category_id: cat_id },
                success: function(response) {
                    $('#product_variant').html(JSON.parse(response));
                    $('#product_variant').trigger('chosen:updated');
                    $('#product_variant').chosen();
                   
                }
               
            });
        });
    });

    function UpdateOffer() {
    var formData = new FormData(document.getElementById('updateOfferForm'));
    $.ajax({
        url: "<?php echo base_url('AdminPanel/Offers/update'); ?>",
        type: 'POST',
        data: formData,
        contentType: false, 
        processData: false, 
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then(() => {
                    window.location.href = "<?php echo base_url('admin/offers'); ?>";
                });
            } 
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
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
}









</script>