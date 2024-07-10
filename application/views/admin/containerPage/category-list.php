<?php
    $actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
?>

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <div class="mob_back_btn">
                        <h2 style="padding-top: 8px; color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                    <h3 class="fw-bold mb-0">Category List</h3>
                </div>
            </div>
        </div>

        <div class="card-body" style="padding:10px 0px;">
            <form class="form" id="catForm" method="POST" action="<?php echo base_url('admin/category/update/'.$category_detaials[0]->cat_id); ?>" enctype="multipart/form-data">
              
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <input type="hidden" id="get-cat-id" name="get_cat_id" value="<?php echo ($category_detaials != 0) ? $category_detaials[0]->cat_id : ''; ?>">
                        <input type="text" class="form-control" id="category" name="category" value="<?php echo ($category_detaials != 0) ? $category_detaials[0]->category : ''; ?>">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Category slug</label>
                        <input type="hidden" id="get-cat-id" name="get_cat_id" value="<?php echo ($category_detaials != 0) ? $category_detaials[0]->cat_id : ''; ?>">
                        <input type="text" class="form-control" id="slug" name="slug" value="<?php echo ($category_detaials != 0) ? $category_detaials[0]->slug : ''; ?>">
                    </div>
                    <div class="col-md-1">
                        <?php if ($category_detaials[0]->cat_image != "") { ?>
                            <img src="<?php echo base_url() . 'uploads/' . $category_detaials[0]->cat_image; ?>" style="width:30px;height: 30px;margin-top: 30%;">
                        <?php } ?>
                    </div>
                </div>
                <button type="submit" class="btn custom_top_btn_css btn-primary py-2 px-5 text-uppercase btn-set-task cat-bt w-sm-100">Save</button>
            </form>
        </div>

        <!-- Category List Table -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card category_list_css" style="display: none;">
                    <div class="card-body">
                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Category Id</th>
                                    <th>Categories</th>
                                    <th>Updated By</th>
                                    <th>Date</th>
                                    <?php if (in_array('status', $actAcx) || $session['admin_type'] == 'A') { ?>
                                        <th>Status</th>
                                    <?php } ?>
                                    <?php if (in_array('stock-status', $actAcx) || $session['admin_type'] == 'A') { ?>
                                        <th>Stock</th>
                                    <?php } ?>
                                    <th>Image</th>
                                    <?php if ((in_array('edit', $actAcx) || in_array('delete', $actAcx) || in_array('sub-category', $actAcx)) || $session['admin_type'] == 'A') { ?>
                                        <th><span style="float: right;">Action</span></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody class="row_position">
                                <?php
                                    if ($category_list != 0) {
                                        $index = 0;
                                        foreach (array_reverse($category_list) as $value) {
                                            $index++;
                                ?>
                                    <tr id="<?php echo $value->cat_id; ?>">
                                        <td><strong><?php echo $index; ?></strong></td>
                                        <td><?php echo $value->cat_id; ?></td>
                                        <td><?php echo $value->category; ?></td>
                                        <td><?php echo $value->updated_by; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($value->add_date)); ?></td>

                                        <?php if (in_array('status', $actAcx) || $session['admin_type'] == 'A') { ?>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" data-id="<?php echo base64_encode($value->cat_id . ':::' . implode(',', $ActiveInactive_ActionArr)); ?>" class="cate-status" <?php echo ($value->status == 1) ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        <?php } ?>

                                        <?php if (in_array('stock-status', $actAcx) || $session['admin_type'] == 'A') { ?>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" data-id="<?php echo base64_encode($value->cat_id . ':::' . implode(',', $in_stock_active_inactive)); ?>" class="cate-stock-status" <?php echo ($value->in_stock_status == 1) ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        <?php } ?>

                                        <td>
                                            <img src="<?php echo ($value->cat_image != "") ? base_url() . 'uploads/' . $value->cat_image : base_url() . 'include/default_cat.jpg'; ?>" style="width:80px;height: 80px;">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                <?php if (in_array('sub-category', $actAcx) || $session['admin_type'] == 'A') { ?>
                                                    <a href="<?php echo base_url('admin/sub_category/' . $value->cat_id); ?>" class="btn btn-outline-secondary">Sub Category</a>
                                                <?php } ?>
                                                <?php if (in_array('edit', $actAcx) || $session['admin_type'] == 'A') { ?>
                                                    <a href="<?php echo base_url('admin/category/' . $value->cat_id); ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                <?php } ?>
                                                <?php if (in_array('delete', $actAcx) || $session['admin_type'] == 'A') { ?>
                                                    <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->cat_id; ?>" data-id="<?php echo base64_encode($value->cat_id . ':::' . implode(',', $deleteActionArr)); ?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
