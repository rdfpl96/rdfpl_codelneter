<?php
// Check if the user has access to add or edit
// $actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
// if ((!in_array('add', $actAcx) && !in_array('edit', $actAcx)) && $session['admin_type'] != 'A') {
//     echo "No direct page access allowed";
//     exit;
//}

// Fetch user details if in edit mode
$user_id = $this->uri->segment(3);
$user_details = array();
if (!empty($user_id)) {
    $userDetails = $this->sqlQuery_model->sql_select_where('tbl_admin', array('admin_id' => $user_id));
    if (!empty($userDetails)) {
        $user_details = $userDetails[0];
    }
}

// Flash messages
if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif;

if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
<?php 
if(!empty($user_id)){
    $action = 'update_user';
}else{
    $action = 'add_user';
}
//  ? 'update_user' : 'add_user')
?>
<form action="<?php echo base_url('admin/'.$action); ?>" method="post" enctype="multipart/form-data">
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
                            <h3 class="fw-bold mb-0"><?php echo empty($user_id) ? 'Add' : 'Edit'; ?> User</h3>
                            <button href="'<?= base_url('admin/user_list') ?>'" class="btn btn-primary" style="margin-left: 600px;">Back</button>
                            <button type="submit" class="btn btn-primary" id="update_user">Save</button>
                        </div>
                    </div>

                </div> <!-- Row end -->
                <div class="row g-3 mb-3">
                    <div class="col-xl-12 col-lg-12">
                        <div class="sticky-lg-top">
                            <div class="card mb-3">
                                <input type="hidden" class="form-control" name="editv" id="editv"  value="<?php echo $user_id; ?>">

                                <div class="card-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" name="c_fname" id="c_fname" value="<?php echo !empty($user_details) ? $user_details->admin_name : ''; ?>" oninput="validateCharactersonly(this)" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Username</label>
                                            <input type="hidden" class="form-control" name="oldusername" id="oldusername" value="<?php echo !empty($user_details) ? $user_details->admin_username : ''; ?>">
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo !empty($user_details) ? $user_details->admin_username : ''; ?>" oninput="validateCharactersonly(this)" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo !empty($user_details) ? $user_details->admin_mobile : ''; ?>" oninput="validateMobile(this)" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Email</label>
                                            <input type="hidden" class="form-control" name="oldemail" id="oldemail" value="<?php echo !empty($user_details) ? $user_details->admin_email : ''; ?>">
                                            <input type="text" class="form-control" name="email" id="email" value="<?php echo !empty($user_details) ? $user_details->admin_email : ''; ?>" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Designation (Optional)</label>
                                            <input type="text" class="form-control" name="designation" id="designation" value="<?php echo !empty($user_details) ? $user_details->admin_designation : ''; ?>" oninput="validateCharactersonly(this)">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="<?php echo !empty($user_details) ? base64_decode($user_details->admin_password) : ''; ?>" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Conf-Password</label>
                                            <input type="password" class="form-control" name="conf_password" id="conf_password" value="<?php echo !empty($user_details) ? base64_decode($user_details->admin_password) : ''; ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Profile Image</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="image" id="image">
                                            </div>
                                            <span style="color:red;font-size: 13px;">Image dimension should be 300 X 300 Px.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row end -->
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>




// $('#update_user').click(function() {
//     var userId = $('#editv').val();

//     $.ajax({
//         url: "<?php echo base_url('Admin/update_user'); ?>",
//         type: 'POST',
//         data: {
//             var userId = <?php echo base_url('Admin/add_user'); ?>;
//             type: 'POST',
//             dataType: "json",
//         },
//         success: function(response) {
            
//             console.log(response);
//         },
//         error: function(xhr, status, error) {
            
//             console.error(error);
//         }
//     });
// });







</script>
