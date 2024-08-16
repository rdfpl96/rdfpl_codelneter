<?php
//print_r($categories);

defined('BASEPATH') or exit('No direct script access allowed');

$session = $this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();
?>

<?php

// echo "<pre>";
// print_r($responve);
// die();

?>
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="#" method="post">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <div class="mob_back_btn">
                            <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                        </div>

                        <h3 class="fw-bold mb-0">Add Childcategory</h3>

                        <!-- <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3) == "") ? 'Add' : 'Edit'; ?> <?php echo ucfirst($this->uri->segment(4)); ?> Products</h3> -->
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/childcategory'); ?>"><button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row g-3 align-items-center mb-3">

                                     <div class="col-md-6">
                                        <label class="form-label">Category <span style="color:red;">*</span></label>
                                        <select name="cat_id" class="form-control"  id="cat_id" required>
                                            <option>Please select a category</option>
                                            <?php foreach ($category as $cat): ?>
                                                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['category']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                        <div class="col-md-6">
                                            <label class="form-label">Subcategory Name<span style="color:red;">*</span></label>
                                            <select name="Subcategory"  id="Subcategory" class="form-control" required>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Childcategory Name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="ChildcategoryName" name="ChildcategoryName" value="" required placeholder="Please enter Category name...">

                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Childcategory Slug <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="slug" name="slug" value="" required placeholder="Please enter slug">

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
        </form>
    </div>
</div>




<!--  </div>
  </div>  -->
<?php $this->load->view('admin/footer'); ?>
<script>
$(document).ready(function() {
    $('#cat_id').change(function() {
        var cat_id = $('#cat_id').val();
        $.ajax({
            url: "<?php echo base_url('AdminPanel/Childcategory/get_subcategories')?>",
            type: "POST",
            data: {
                cat_id: cat_id
            },
            success: function(response) {
                $('#Subcategory').html(JSON.parse(response));
            }
        });
    });
});


$(document).ready(function (){
    $("#ChildcategoryName").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#slug").val(Text);        
    });
});

$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault(); 
        
        $.ajax({
            url: "<?php echo base_url('AdminPanel/ChildCategory/store'); ?>",
            type: 'POST',
            data: $(this).serialize(), 
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Child category added successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                     
                        window.location.href = "<?php echo base_url('AdminPanel/ChildCategory'); ?>";
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                
                console.log('An error occurred: ' + error);
            }
        });
    });
});








</script>
