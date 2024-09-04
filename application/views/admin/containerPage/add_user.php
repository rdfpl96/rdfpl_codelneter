<?php
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
if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif;

if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif;

// Determine action
$action = !empty($user_id) ? 'update_user' : 'add_user';
?>

<form action="<?php echo base_url('admin/' . $action); ?>" id="Userformdata" method="post" enctype="multipart/form-data">
    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">
        <!-- Body: Body -->
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-items-center">

                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="mob_back_btn">
                                <h2 style="padding-top: 8px; color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                            </div>
                            <h3 class="fw-bold mb-0"><?php echo empty($user_id) ? 'Add' : 'Edit'; ?> User</h3>
                            <div class="row">
                                <?php if ($admin_type != 'A') : // Only show buttons if not Admin 
                                ?>
                                    <div class="col-md-6">
                                        <a href="<?= base_url('admin/user_list') ?>">
                                            <button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase " id="update_user">Save</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <input type="hidden" class="form-control" name="editv" id="editv" value="<?php echo $user_id; ?>">
                            <input type="hidden" class="form-control" name="old_password" id="old_password" value="<?php echo !empty($user_details) ? $user_details->admin_password : ''; ?>">
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="c_fname" id="c_fname" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_name) : ''; ?>"  required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Username </label>
                                        <input type="hidden" class="form-control" name="oldusername" id="oldusername" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_username) : ''; ?>">
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_username) : ''; ?>"  required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_mobile) : ''; ?>" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Email</label>
                                        <input type="hidden" class="form-control" name="oldemail" id="oldemail" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_email) : ''; ?>">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_email) : ''; ?>" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Designation (Optional)</label>
                                        <input type="text" class="form-control" name="designation" id="designation" value="<?php echo !empty($user_details) ? htmlspecialchars($user_details->admin_designation) : ''; ?>" oninput="validateCharactersonly(this)">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="<?php echo !empty($user_details) ? $user_details->admin_password : ''; ?>" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Conf-Password</label>
                                        <input type="password" class="form-control" name="conf_password" id="conf_password" value="<?php echo !empty($user_details) ? $user_details->admin_password : ''; ?>" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Profile Image</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>
                                        <span style="color:red;font-size: 13px;">Image dimension should be 300 X 300 Px.</span>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">User Type</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="roleSuperAdmin" name="role[]" value="S" <?php echo (!empty($user_details) && in_array('S', explode(',', $user_details->admin_type))) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="roleSuperAdmin">
                                                Super Admin
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="roleAdmin" name="role" value="A" <?php echo (!empty($user_details) && in_array('A', explode(',', $user_details->admin_type))) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="roleAdmin">
                                                Admin
                                            </label>
                                        </div>

                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="roleUser" name="role[]" value="U" <?php //echo (!empty($user_details) && in_array('U', explode(',', $user_details->admin_type))) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="roleUser">
                                                User
                                            </label>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end -->
                </div>
            </div>
        </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            var formdata = new FormData($('#Userformdata')[0]);
            formdata.append('<?php echo $action; ?>', 'update_user');

            event.preventDefault();
            var password = $('#password').val();
            var confirmPassword = $('#conf_password').val();

            if (password !== confirmPassword) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Passwords do not match.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
            $.ajax({
                url: "<?php echo base_url('Admin/' . $action); ?>",
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = "<?php echo base_url('admin/user_list'); ?>";
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.errors,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
            });
        });
    });
</script>