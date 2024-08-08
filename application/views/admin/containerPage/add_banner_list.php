<?php
$this->load->view('admin/headheader');
?>
<style>
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        border-radius: 0.25rem;
        box-shadow: none;
    }
    .btn {
        border-radius: 0.25rem;
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
                    <h3 class="fw-bold mb-0">Add Banner</h3>
                </div>
            </div>
        </div> 
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card category_list_css">
                    <div class="card-body">
                        <form id="addBannerForm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="header">Header</label>
                                <input type="text" class="form-control" id="header" name="header" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" class="form-control" id="link" name="link" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <span style="color:red"> image must be 2300px wide and 780px tall.*</span>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Banner</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 
    $(document).ready(function() {
        $('#addBannerForm').on('submit', function(e) {
            e.preventDefault(); 
            
            var fileInput = $('#image')[0];
            var file = fileInput.files[0];

            if (file) {
                var img = new Image();
                img.onload = function() {
                    // Check image dimensions
                    if (this.width === 2300 && this.height === 780) {
                        // Proceed with form submission
                        var formData = new FormData($('#addBannerForm')[0]); 
                        $.ajax({
                            url: "<?php echo base_url('admin/banner_add_action'); ?>",
                            type: 'POST',
                            data: formData,
                            contentType: false, 
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Banner added successfully.',
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "<?php echo base_url('admin/banner'); ?>"; // Redirect on success
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'An error occurred: ' + textStatus
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Image Dimensions!',
                            text: 'The image must be 2300px wide and 780px tall.'
                        });
                    }
                };
                img.src = URL.createObjectURL(file);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'No File Selected!',
                    text: 'Please select an image file to upload.'
                });
            }
        });
    });
</script>


