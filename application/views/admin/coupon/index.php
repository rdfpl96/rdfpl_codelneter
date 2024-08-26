<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
                    <h3 class="fw-bold mb-0">Coupons List </h3>
                    <?php if (in_array('add', $getAccess['inputAction']) || $session['admin_type'] == 'A') { ?>
                        <a href="<?php echo base_url('admin/coupon/create'); ?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add</a>
                    <?php } ?>
                    <a href="<?php echo base_url('admin/coupon/create'); ?>"><button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Add Coupon</button></a>
                </div>
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
                                <form action="#" id="search-form" method="post">
                                    <label class="form-label">Search Coupon</label>
                                    <input type="text" placeholder="" class="form-control" name="Search-coupon" id="Search-coupon" value="<?php echo $_GET['q']; ?>">
                                </form>
                            </div>
                        </div>
                        <?php if (in_array('import', $actAcx) || $session['admin_type'] == 'A') { ?>
                            <div class="col-md-1 width_20 d-none">
                                <form action="<?php //echo base_url('admin/importSVC');
                                                ?>" method="post" class="fordi" id="my-form-import">
                                    <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="fileupload" accept="csv/*">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Import </span>
                                    </label>
                                </form>
                                <div class="loaderdiv" style="margin-top: 35%;"></div>
                            </div>
                        <?php }
                        if (in_array('export', $actAcx) || $session['admin_type'] == 'A') { ?>
                            <div class="col-md-1 width_50 d-none">
                                <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload">
                                    <a href="<?php echo base_url('exportCSV'); ?>" style="color:white;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></a>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Coupon COde</th>
                                    <th>Discount Type</th>
                                    <th>Discount Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="datalist"><?php echo isset($array_data) ? $array_data : ""; ?></tbody>
                        </table>
                        <div class="pagination-links" id="pl">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/footer'); ?>
    <script>
        // $(document).ready(function() {
        //     $('#Search-coupon').keyup(function() {
        //         $.ajax({
        //             url: "<?php echo base_url('admin/coupon') ?>",
        //             headers: {
        //                 "X-Ajax": "Yes"
        //             },
        //             type: 'GET',
        //             data: {
        //                 q: $('#Search-coupon').val(),
        //             },
        //             success: function(response) {
        //                 console.log('response=>',response);
        //                 const r = JSON.parse(response);
        //                 console.log('r=>',r);
        //                 $('#datalist').html('').html(r.array_data);
        //                 $('#pl').html('').html(r.pagination);
        //             }
        //         });

        //     });
        // });

  $.ajax({
    url: "<?php echo base_url('admin/coupon') ?>",
    headers: {
        "X-Ajax": "Yes"
    },
    type: 'GET',
    data: {
        q: $('#Search-coupon').val(),
    },
    success: function(response) {
        try {
            const r = JSON.parse(response);
            $('#datalist').html('').html(r.array_data);
            $('#pl').html('').html(r.pagination);
        } catch (e) {
            console.error('JSON parsing error:', e);
            console.error('Response received:', response);
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('AJAX error:', textStatus, errorThrown);
        console.error('Response:', jqXHR.responseText);
    }
});


        function deleteRowtablesub(coupon_id) {

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
                        url: "<?php echo base_url('AdminPanel/coupon/delete_coupon'); ?>",
                        type: "POST",
                        data: {
                            coupon_id: coupon_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response == 'True') {
                                Swal.fire(
                                    'Deleted!',
                                    'coupon has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete coupon.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Error deleting coupon.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>