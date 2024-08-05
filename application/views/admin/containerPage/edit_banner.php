<?php
$this->load->view('admin/headheader');
?>

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <div class="mob_back_btn">
                        <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                    <h3 class="fw-bold mb-0">Edit Banner</h3>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card category_list_css">
                    <div class="card-body">
                        <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="banner_id" value="<?php echo $banner->banner_id; ?>">

                            <div class="mb-3">
                                <label for="text1" class="form-label">Header</label>
                                <input type="text" class="form-control" id="text1" name="text1" value="<?php echo $banner->text1; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $banner->description; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="button_link" class="form-label">Link</label>
                                <input type="text" class="form-control" id="button_link" name="button_link" value="<?php echo $banner->button_link; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="desk_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="desk_image" name="desk_image">
                                <img src="<?php echo base_url('uploads/banner/' . $banner->desk_image); ?>" style="width:100px; margin-top:10px;">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                
                                                <label class="switch">
                                                <input 
                                                    type="checkbox" 
                                                    id="Status<?php echo htmlspecialchars($banner->banner_id); ?>"  
                                                    name="Status[]" 
                                                    value="<?php echo $banner->status; ?>"  
                                                    onclick="UpdateBannerStatus(<?php echo htmlspecialchars($banner->banner_id); ?>)"
                                                    <?php echo ($banner->status == 1) ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                  </label>
                                                    
                            </div>

                            <button type="submit" class="btn btn-primary">Update Banner</button>
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
    var base_url = "<?php echo base_url(); ?>";

    $('#editBannerForm').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: base_url + 'admin/banner_update',
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = base_url + 'admin/banner'; 
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'AJAX Error',
                    text: 'An error occurred: ' + textStatus
                });
            }
        });
    });


    

    function UpdateBannerStatus(id){
    var status = $('#Status' + id).val();
    $.ajax({
        url: "<?php echo base_url('Admin/updatebannerStatus'); ?>",
        type: "POST",
        data: { banner_id: id, status: status },
        dataType: "json",
        success: function(response) {
            if (response == 'True') {
                Swal.fire(
                    'Updated!',
                    'banner status has been updated.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            } 
            else {
                Swal.fire(
                    'Failed!',
                    'Failed to update user status.',
                    'error'
                );
            }
        },
        // error: function() {
        //     Swal.fire(
        //         'Error!',
        //         'Error updating user status.',
        //         'error'
        //     );
        // }
    });
}

</script>
