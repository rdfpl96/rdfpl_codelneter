<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$session = $this->session->userdata('admin');
$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
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
                    <h3 class="fw-bold mb-0">Subcategory List</h3>
                    <?php if (in_array('add', $getAccess['inputAction']) || $session['admin_type'] == 'A') { ?>
                        <a href="<?php echo base_url('admin/category/create'); ?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add</a>
                    <?php } ?>
                    <a href="<?php echo base_url('admin/subcategory/create'); ?>"><button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase">Add Subcategory</button></a>
                </div>
            </div>
        </div> <!-- Row end -->
        <!-- filters -->
        <div class="row g-3 mb-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="filter-search">
                                    <form action="#" id="search-form" method="post" enctype="multipart/form-data">
                                        <label class="form-label">Search Subcategory</label>
                                        <input type="text" placeholder="" class="form-control" name="search-cat" id="search-cat">
                                    </form>
                                </div>
                            </div>
                           
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- filters end -->

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                         <th>category</th> 
                                        <th>Subcategory</th>
                                        <!-- <th>Slug</th> -->
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="datalist"><?php echo isset($array_data) ? $array_data : ""; ?></tbody>
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
</div>

<style type="text/css">
    .modal {
        z-index: 1055 !important;
    }
</style>

<?php $this->load->view('admin/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    // Check if success parameter is present in URL
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');

    // Display Swal alert if success parameter is true
    if (success === 'true') {
        Swal.fire({
            icon: 'success',
            title: 'Data Inserted Successfully!',
            showConfirmButton: false,
            timer: 1500
        });
    }

    function deleteRowtablesub(subCategoryId) {
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
                url: "<?php echo base_url('AdminPanel/Subcategory/deleteSubcategory'); ?>",
                type: "POST",
                data: { sub_cat_id: subCategoryId },
                dataType: "json",
                success: function(response) {
                    //console.log('deleteRowtablesub=> ', response);
                    if (response == 'True') {
                        Swal.fire(
                            'Deleted!',
                            'Subcategory has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Failed!',
                            'Failed to delete subcategory.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Error deleting subcategory.',
                        'error'
                    );
                }
            });
        }
    });
}





    ///$(document).ready(function() {
        
    $('#search-cat').keyup(function() {
        $.ajax({
            url: "<?php echo base_url('AdminPanel/Subcategory/search_subcat_list')?>",
            type: 'POST',
            data: {
                searchText:$('#search-cat').val(),
                
                  },
            success: function(response) {
                $('#datalist').html(response);
            }
        });

    });
//}


</script>
