<?php
// echo "<pre>";
// print_r($actAcx);
// print_r($session['admin_type']);
// echo "</pre>";
$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
?>
<style>
    th {
        text-align: center;
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
                    <h3 class="fw-bold mb-0">Banner List</h3>
                    <?php //if (in_array('add', $actAcx) || $session['admin_type'] == 'A') { ?>
                        <a href="<?php echo base_url('admin/banner_edit_add'); ?>"><button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Add Banner</button></a>
                        <!-- <h3 class="fw-bold mb-0"><?php //echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Ads Banner</h3> -->
                    <?php //} ?>
                </div>
            </div>
        </div> 
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card category_list_css">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Header</th>
                                        <!-- <th>Header-2</th> -->
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th>Image</th>
                                        <!-- <th>Mobile Image</th> -->
                                        <th>Created By</th>
                                        <?php if (in_array('status', $actAcx) || $session['admin_type'] == 'A') { ?>
                                            <th>Status</th>
                                        <?php } ?>

                                        <th>Date</th>

                                        <th><span style="float: right;">Action</span></th>

                                    </tr>
                                </thead>
                                <tbody class="row_position_banner">
                                    <?php
                                    if ($banner_list != 0) {
                                        $index = 0;;
                                        foreach (array_reverse($banner_list) as $value) {

                                            $index++;
                                    ?>

                                            <tr id="<?php echo $value->banner_id; ?>">
                                                <td style="text-align:right"><strong><?php echo $index; ?></strong></td>

                                                <td style="text-align:left"><?php echo $value->text1; ?></td>
                                                <!-- <td><?php //echo $value->text2;
                                                            ?></td> -->
                                                <td><?php echo getShortData($value->description, 30); ?></td>
                                                <td style="text-align:center;"><?php echo $value->button_link; ?></td>
                                                <td>
                                                    <?php
                                                    $filePath = (($value->desk_image != "") ? './uploads/banner/' . $value->desk_image : '');
                                                    if (file_exists($filePath)) {
                                                        $imgFile = base_url() . 'uploads/banner/' . $value->desk_image;
                                                    } else {
                                                        $imgFile = base_url() . 'include/assets/default_product_image.png';
                                                    }

                                                    ?>
                                                    <img src="<?php echo $imgFile; ?>" style="width:40px; height:40px;border:1px solid grey; ">
                                                </td>



                                                <td style="text-align:center;"><?php echo $value->updated_by; ?></td>
                                                <?php if (in_array('status', $actAcx) || $session['admin_type'] == 'A') { ?>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" data-id="<?php echo base64_encode($value->banner_id . ':::' . implode(',', $ActiveInactive_ActionArr)); ?>" class="cate-status" <?php echo ($value->status == 1) ? 'checked' : ''; ?>>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                <?php } ?>
                                                <td><?php echo date('d-m-Y', strtotime($value->add_date)); ?></td>


                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">



                                                        <a href="<?php echo base_url('admin/add_banner/' . $value->banner_id); ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>


                                                       
                                                        <button type="button" class="btn btn-outline-secondary deleteRowBtn" id="deleteRow" data-id="<?php echo $value->banner_id;?>"> <i class="icofont-ui-delete text-danger"></i></button>

                                                    </div>
                                                </td>
                                            </tr>

                                    <?php
                                        }
                                    }

                                    ?>
                                </tbody>
                            </table>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var base_url = "<?php echo base_url(); ?>";




    $('.deleteRowBtn').click(function() {
    var value = $(this).data('id');

    if (confirm('Are you sure? Do you want to delete?')) {
        $.ajax({
            url: base_url + 'admin/banner_Delete',
            type: 'POST',
            dataType: 'JSON',
            data: { value: value },
            success: function(data) {
                if (data== 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload page on success
                    });
                 }

                else {
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
            },
            complete: function() {
                //  Optional: Hide loader if you have one
                 $('#loader').css('display', 'none');
            }
        });
    }
});





</script>
