
 
<?php
   
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <div class="mob_back_btn">
                        <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                    <h3 class="fw-bold mb-0">User List</h3>
                    <a href="<?php echo base_url('admin/add_user'); ?>" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100 add-user">Add User</a>
                </div>
            </div>
        </div> <!-- Row end -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card category_list_css">
                    <div class="card-body">
                        <!-- table table-bordered -->
                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SerNo</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email ID</th>
                                    <th>Mobile</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th><span style="float: right;">Action</span></th>
                                </tr>
                            </thead>
                            
                            <tbody class="row_position">

                            <?php  
                                if($users_list) {
                                    
                                    $index = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
                                    foreach($users_list as $value) {
                                        $index++;
                                ?>
 
                                    <tr id="<?php echo $value->cat_id;?>">
                                        <td><strong><?php echo $index;?></strong></td>
                                        <td><?php echo $value->admin_name;?></td>
                                        <td><?php echo $value->admin_username;?></td>
                                        <td><?php echo $value->admin_email;?></td>
                                        <td><?php echo $value->admin_mobile;?></td>
                                        <td><?php echo $value->updated_by;?></td>
                                        <td>
                                            <label class="switch">
                                                <input 
                                                    type="checkbox" 
                                                    id="Status<?php echo htmlspecialchars($value->admin_id); ?>"  
                                                    name="Status[]" 
                                                    value="<?php echo $value->status; ?>"  
                                                    onclick="UpdateUserStatus(<?php echo htmlspecialchars($value->admin_id); ?>)"
                                                    <?php echo ($value->status == 1) ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td><?php echo date('d-m-Y',strtotime($value->add_date));?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                <a href="<?php echo base_url('admin/user_setting/'.$value->admin_id);?>" class="btn btn-outline-secondary"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                                <a href="<?php echo base_url('admin/add_user/'.$value->admin_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->admin_id;?>" data-id="<?php echo base64_encode($value->admin_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No users found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="pagination-links">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

function UpdateUserStatus(id){
    
    var status = $('#Status' + id).val();
    $.ajax({
        url: "<?php echo base_url('Admin/updateuserStatus'); ?>",
        type: "POST",
        data: { user_id: id, status: status },
        dataType: "json",
        success: function(response) {
            if (response == 'True') {
                Swal.fire(
                    'Updated!',
                    'user status has been updated.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            } 
            // else {
            //     Swal.fire(
            //         'Failed!',
            //         'Failed to update user status.',
            //         'error'
            //     );
            // }
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