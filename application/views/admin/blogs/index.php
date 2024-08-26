<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$session = $this->session->userdata('admin');
$this->load->view('admin/headheader');

$actAcx = isset($getAccess['inputAction']) ? $getAccess['inputAction'] : array();
?>

<!-- Body: Body -->
<div class="body d-flex py-3">
<div class="container-xxl">
<div class="row align-items-center">
<div class="border-0">
<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
    <div class="mob_back_btn">
        <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
    </div>
              
    <h3 class="fw-bold mb-0">Blogs List</h3>
    <?php //if (in_array('add', $actAcx) || $session['admin_type'] == 'A') { ?>
        <a href="<?php echo base_url('admin/blogs/create'); ?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100">
            <i class="icofont-plus-circle me-2 fs-6"></i> Add
        </a>
    <?php //} ?>
</div>
</div>
</div> <!-- Row end -->

<!-- Filters -->
<div class="row g-3 mb-3">
<div class="col-xl-12 col-lg-12">
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="filter-search">
                    <form action="#" id="search-form" method="post" enctype="multipart/form-data">
                        <label class="form-label">Search blog</label>
                        <input type="text" placeholder="Search blog......" class="form-control" name="search-blog" id="search-blog">
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
</div>
</div> <!-- Filters end -->

<div class="row g-3 mb-3">
<div class="col-md-12">
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>HEADER NAME</th>
                        <th>CATEGORY</th>
                        <th>IMAGE</th>
                        <th>UPDATED BY</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="datalist"><?php echo isset($array_data) ? $array_data : "<tr><td colspan='8' style='text-align: center;'>No records found</td></tr>"; ?></tbody>
            </table>

            <div class="pagination-links">
                <?php echo isset($pagination) ? $pagination : ''; ?>
            </div>
            
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<style type="text/css">
  .modal {
    z-index: 1055 !important;
  }
</style>
<?php $this->load->view('admin/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
const urlParams = new URLSearchParams(window.location.search);
const success = urlParams.get('success');

if (success === 'true') {
    Swal.fire({
        icon: 'success',
        title: 'Data Inserted Successfully!',
        showConfirmButton: false,
        timer: 1500
    });
}

$(document).ready(function() {
    $('#search-blog').keyup(function() {
        $.ajax({
            url: "<?php echo base_url('AdminPanel/Blogs/searchBlog') ?>",
            type: 'POST',
            data: { searchText: $('#search-blog').val() },
            success: function(response) {
                $('#datalist').html(response);
            }
        });
    });
});

function deleteRowtablesub(blog_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?php echo base_url('AdminPanel/Blogs/deleteblog'); ?>",
                type: "POST",
                data: { blog_id: blog_id },
                dataType: "json",
                success: function(response) {
                    if (response === 'True') {
                        Swal.fire(
                            'Deleted!',
                            'Blog has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Failed!',
                            'Failed to delete blog.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Error deleting blog.',
                        'error'
                    );
                }
            });
        }
    });
}

function UpdateBlogStatus(id){
    var status = $('#Status' + id).is(':checked') ? 1 : 0;

    $.ajax({
        url: "<?php echo base_url('AdminPanel/Blogs/updateBlogStatus'); ?>",
        type: "POST",
        data: { blog_id: id, status: status },
        dataType: "json",
        success: function(response) {
            if (response === 'True') {
                Swal.fire(
                    'Updated!',
                    'Blog status has been updated.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            } 
            else {
                Swal.fire(
                    'Failed!',
                    'Failed to update blog status.',
                    'error'
                );
            }
        },
        error: function() {
            Swal.fire(
                'Error!',
                'Error updating blog status.',
                'error'
            );
        }
    });
}
</script>
