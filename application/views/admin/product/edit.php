<?php
defined('BASEPATH') or exit('No direct script access allowed');

$session = $this->session->userdata('admin');
$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();

// Categories
?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="<?php echo base_url('admin/product/update/' . $tdata['product_id']); ?>" id="form_product" name="form_product" method="POST" enctype="multipart/form-data" onsubmit="addProductInfo();return false;">

            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="mob_back_btn">
                            <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                        </div>
                        <h3 class="fw-bold mb-0">Update Product</h3>
                        <a href="<?php echo base_url('admin/product'); ?>" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</a>
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
                                            <label class="form-label">Product name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control pname" id="product-name" name="product_name" value="<?php echo isset($tdata['product_name']) ? stripslashes($tdata['product_name']) : ''; ?>" required placeholder="Please product name" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Product Slug <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="slug" name="slug" value="<?php echo isset($tdata['slug']) ? stripslashes($tdata['slug']) : ''; ?>" required placeholder="Please enter slug" readonly>
                                        </div>
                                    </div>
                                    <!-- Description Section -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="uom" class="form-label">Description</label>
                                            <input type="hidden" name="increment" id="increment" value="<?php echo ($product_disc_list != 0) ? count($product_disc_list) : 1; ?>">
                                            <table class="table">
                                                <?php
                                                $otherInfo = isset($tdata['other_info']) ? unserialize($tdata['other_info']) : array();
                                                if (is_array($otherInfo) && count($otherInfo) > 0) {
                                                    $index = 0;
                                                    foreach ($otherInfo as $record) {
                                                        $index++;
                                                ?>
                                                        <tr class="add-tr<?php echo ($index == count($otherInfo)) ? '' : $index; ?>">
                                                            <td class="tbl-td">
                                                                <div class="row">
                                                                    <div class="col-sm-11 width_80">
                                                                        <input type="text" class="form-control" id="heading<?php echo $index; ?>" name="heading[]" placeholder="Heading" value="<?php echo isset($record['heading']) ? stripslashes($record['heading']) : ''; ?>">
                                                                    </div>
                                                                    <div class="col-sm-1 width_20">
                                                                        <?php if (($index) == count($otherInfo)) { ?>
                                                                            <button type="button" class="btn btn-info add-more">+</button>
                                                                        <?php } else { ?>
                                                                            <button type="button" class="btn btn-danger remove-btn" data-id="<?php echo $index; ?>">-</button>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <textarea class="form-control" id="description<?php echo $index; ?>" name="description[]" placeholder="Description" style="margin-bottom: 6px;"><?php echo isset($record['description']) ? stripslashes($record['description']) : ''; ?></textarea>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr class="add-tr">
                                                        <td class="tbl-td">
                                                            <div class="row">
                                                                <div class="col-sm-11 width_80">
                                                                    <input type="text" class="form-control" id="heading1" name="heading[]" placeholder="Heading" value="">
                                                                </div>
                                                                <div class="col-sm-1 width_20">
                                                                    <button type="button" class="btn btn-info add-more">+</button>
                                                                </div>
                                                            </div>
                                                            <textarea class="form-control" id="description1" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Image Section -->
                                    <div class="card mb-3">
                                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                            <h6 class="mb-0 fw-bold">Images <span style="color:red;font-size: 13px;">(Image dimension should be 700x700 Px.)</span></h6>
                                        </div>
                                        <div class="row card-body">
                                            <?php
                                            $images = ['image1', 'image2', 'image3', 'image4', 'image5', 'image6'];
                                            foreach ($images as $key => $image_field) {
                                                $image_path = isset($tdata[$image_field]) ? './uploads/' . $tdata[$image_field] : 'include/assets/default_product_image.png';
                                                $imgFile = file_exists($image_path) ? base_url() . 'uploads/' . $tdata[$image_field] : base_url() . 'include/assets/default_product_image.png';
                                            ?>
                                                <div class="col-sm-2">
                                                    <div class="center" style="text-align: center;">
                                                        <a href="#" class="close-image" data-id="<?php echo $key + 1; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                        <div class="form-input">
                                                            <div class="preview">
                                                                <img id="file-ip-<?php echo $key + 1; ?>-preview" src="<?php echo $imgFile; ?>" style="width: 100%; height: auto;">

                                                                <input type="text" class="Remove<?php echo $key + 1; ?>" name="image_path<?php echo $key + 1; ?>" id="image_path<?php echo $key + 1; ?>" value="<?php echo isset($tdata[$image_field]) ? $tdata[$image_field] : ''; ?>" hidden>
                                                            </div>
                                                            <label for="file-ip-<?php echo $key + 1; ?>">Image-<?php echo $key + 1; ?></label>
                                                            <input type="file" id="file-ip-<?php echo $key + 1; ?>" name="<?php echo $image_field; ?>" accept="image/*" onchange="showPreview(event,<?php echo $key + 1; ?>);" hidden>
                                                            <?php if ($key < 5): ?>
                                                                <span class="required" style="text-align: center;">Required</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
        </form>
    </div>
</div>

<?php $this->load->view('admin/footer'); ?>

<script>
    $(document).on('click', '.add-more', function() {
        var increment = $('#increment').val();
        increment++;
        $('#increment').val(increment);
        var html = '<tr class="add-tr' + increment + '">' +
            '<td class="tbl-td">' +
            '<div class="row">' +
            '<div class="col-sm-11">' +
            '<input type="hidden" id="disc-id' + increment + '" name="input_disc_id[]" value="">' +
            '<input type="text" class="form-control" id="heading' + increment + '" name="heading[]" placeholder="Heading">' +
            '</div>' +
            '<div class="col-sm-1">' +
            '<button type="button" class="btn btn-danger remove-btn" data-id="' + increment + '">-</button>' +
            '</div>' +
            '</div>' +
            '<textarea class="form-control" id="description' + increment + '" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>' +
            '</td>' +
            '</tr>';
        $('table').append(html);
    });

    $(document).on('click', '.remove-btn', function() {
        var id = $(this).data('id');
        $('.add-tr' + id).remove();
    });

    function showPreview(event, index) {
        // alert('Preview');
        var input = event.target;
        var preview = document.getElementById('file-ip-' + index + '-preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        // $('#image_path'+index).val('');
    }

    function addProductInfo() {
        var formData = new FormData($('#form_product')[0]);
        var fileInput = $('#form_product input[type="file"]');
        var valid = true;

        fileInput.each(function() {
            var file = this.files[0];
            if (file) {
                var img = new Image();
                img.src = URL.createObjectURL(file);
                img.onload = function() {
                    if (img.width !== 700 || img.height !== 700) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Image Dimensions',
                            text: 'All images must be 700x700 pixels.',
                        });
                        valid = false;
                        return false; // Exit loop
                    }
                };
            }
        });

        // Proceed with AJAX only if all images are valid
        setTimeout(function() {
            if (valid) {
                $.ajax({
                    type: 'post',
                    url: $('#form_product').attr('action'),
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Optional: Add any pre-request actions here
                    },
                    success: function(res) {
                        if (res.error == 0) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Product updated successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?php //echo base_url('AdminPanel/product'); 
                                                            ?>";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res.err_msg || 'An error occurred!',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Log the response text for debugging
                    }
                });
            }
        }, 1000); // Delay to ensure the validation has finished
    }




    $(document).ready(function() {
        $(document).on('click', '.close-image', function(e) {
            e.preventDefault();
            var imageId = $(this).data('id');
            // $('#image_path'+imageId).val('');
            $('#image_path' + imageId).attr('value', '');
            // document.getElementById('image_path'+imageId).value = '';

            // Reset the image preview
            $('#file-ip-' + imageId + '-preview').attr('src', '<?php echo base_url('include/assets/default_product_image.png'); ?>');

            // Clear the file input field
            $('#file-ip-' + imageId).val('');

        });
    });
</script>