<?php
//print_r($categories);

defined('BASEPATH') OR exit('No direct script access allowed');

$session=$this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array(); 
?>

<?php if ($this->session->flashdata('success_message')): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    Swal.fire({
        icon: 'success',
        title: '<?php echo $this->session->flashdata('success_message'); ?>',
        showConfirmButton: false,
        timer: 1500
    });
    </script>
<?php elseif ($this->session->flashdata('error_message')): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo $this->session->flashdata('error_message'); ?>'
    });
    </script>
<?php endif; ?>
 <!-- Body: Body --> 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                 <!-- <form action="<?php //echo base_url('admin/subcategory/store'); ?>" method="post"> -->
                    <form action="<?php echo base_url('admin/offers/store'); ?>" method="post">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>

                                <h3 class="fw-bold mb-0">Add Offers</h3>

                                <!-- <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> <?php echo ucfirst($this->uri->segment(4));?> Products</h3> -->
                            <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/offers');?>"><button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Save</button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>   
                    <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                           
                         <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        
                                        <div class="row g-3 align-items-center mb-3">
                                                
                                        <div class="col-md-6">
                                            <label class="form-label">Offer Type<span style="color:red;">*</span></label>
                                            <select class="form-control" id="offer_type" name="offer_type" required>
                                                <option value="">Please select Offer Type</option>
                                                <option value="1">Percentage</option>
                                                <option value="0">Fixed Amount</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label  class="form-label">Description <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="description" name="description" value="" required placeholder="Please enter Description">
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Value <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control url" id="value" name="value" value="" required placeholder="Please enter Amount">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Product<span style="color:red;">*</span></label>
                                            <select class="form-select" name="product_id[]" id="product_id" data-placeholder="Choose product ..."  multiple required>
                                                <option value="">Select</option>
                                                <?php
                                                    foreach($productList as $precord){
                                                        echo '<option value="'.$precord['product_id'].'">'.$precord['product_name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        </div>

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
    $('#category').change(function() {
        var selectedCat = $(this).val();
        $('#subcategory .subcat-option').hide(); // Hide all subcategory options
        $('#subcategory').val(''); // Reset subcategory selection
        if (selectedCat) {
            $('#subcategory .subcat-option[data-category-id="' + selectedCat + '"]').show(); // Show relevant subcategory options
        }
    });
});
</script>