<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$session = $this->session->userdata('admin');
$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
?>

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <div class="mob_back_btn">
                        <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                    <h3 class="fw-bold mb-0">Child category List</h3>
                   
                    <a href="<?php echo base_url('admin/childcategory/create'); ?>">
                        <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase">Add Childcategory</button>
                    </a>
                </div>
            </div>
        </div> 
     
        <div class="row g-3 mb-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="filter-search">
                                    <!-- <form action="#" id="search-form" method="post" enctype="multipart/form-data">
                                        <label class="form-label">Search Childcategory</label>
                                        <input type="text" placeholder="" class="form-control" name="search-cat" id="search-cat">
                                    </form> -->
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
                                        <th>Category</th> 
                                        <th>Subcategory</th>
                                        <th>Childcategory</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($childcatdetails)): ?>
                                        <?php foreach ($childcatdetails as $index => $detail): ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($detail['category']); ?></td>
                                                <td><?php echo htmlspecialchars($detail['subCat_name']); ?></td>
                                                <td><?php echo htmlspecialchars($detail['childCat_name']); ?></td>
                                                <td><?php echo ($detail['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                                <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($detail['update_date']))); ?></td>
                                                <td>
                                                   
                                                    <button type="button"class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase " onclick="deleteRowtablesub(<?php echo $detail['child_cat_id']; ?>)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No data available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="pagination-links">
                                <?php echo $pagination_links; ?>
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

    function deleteRowtablesub(child_cat_id) {
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
                    url: "<?php echo base_url('AdminPanel/ChildCategory/delete_child_category'); ?>",
                    type: "POST",
                    data: { child_cat_id: child_cat_id },
                    dataType: "json",
                    success: function(response) {
                        if (response == 'True') {
                            Swal.fire(
                                'Deleted!',
                                'Childcategory has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                        //  else {
                        //     Swal.fire(
                        //         'Failed!',
                        //         'Failed to delete subcategory.',
                        //         'error'
                        //     );
                        // }
                    },
                    // error: function() {
                    //     Swal.fire(
                    //         'Error!',
                    //         'Error deleting subcategory.',
                    //         'error'
                    //     );
                    // }
                });
            }
        });
    }



    $('#search-cat').keyup(function() {
        $.ajax({
            url: "<?php echo base_url('AdminPanel/Subcategory/search_subcat_list')?>",
            type: 'POST',
            data: {
                searchText: $('#search-cat').val(),
            },
            success: function(response) {
                $('#datalist').html(response);
            }
        });
    });
</script>
