<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$session=$this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array(); 
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
              
    <h3 class="fw-bold mb-0">Offers List</h3>
    
    <!-- <a href="<?php // echo base_url('admin/offers/create');?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add</a> -->


<a href="<?php echo base_url('admin/offers/create');?>"><button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Add Offer</button></a>

      <!-- ===== -->


      <!-- ==== -->

</div>
</div>
</div> <!-- Row end  -->


<!-- filters -->

<?php

// print_r($array_data);

// die();



?>


<div class="row g-3 mb-3">
<div class="col-xl-12 col-lg-12">

<div class="card mb-3">

    <div class="card-body">

        <div class="row">
           
            <div class="col-md-3">
                <div class="filter-search">
                    <form action="#" id="search-form" method="post"  enctype="multipart/form-data">
                        <label class="form-label">Search Offers</label>
                        <input type="text" placeholder="" class="form-control" name="name"  id="Search_offer">
                    </form>
                </div>
            </div>

            <?php if(in_array('import',$actAcx) || $session['admin_type']=='A'){ ?>

            <div class="col-md-1 width_20 d-none">
                  <form action="<?php //echo base_url('admin/importSVC');?>" method="post" class="fordi" id="my-form-import" enctype="multipart/form-data">
                        <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="fileupload" accept="csv/*">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Import </span>
                    </label>
                   
                  </form>
                   <div class="loaderdiv" style="margin-top: 35%;"></div>
                  

            </div>
          <?php } ?>

          <?php if(in_array('export',$actAcx) || $session['admin_type']=='A'){ ?>

                <div class="col-md-1 width_50 d-none">
                        <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload" >
                        <a href="<?php echo base_url('exportCSV');?>" style="color:white;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></a>
                       </label>
                </div>
           <?php } ?>

          
           
        </div>
        <br>
      

    </div>

</div>

</div>
</div>    



<?php

// echo "<pre>";
// print_r($array_data);
// die();
?> 


<!-- filters end -->
<div class="row g-3 mb-3">
<div class="col-md-12">
<div class="card">
    <div class="card-body">

    <!-- <input type="text" value="<?php //echo $keyval->id; ?>"> -->

        <div class="table-responsive">
        <table class="table mb-0" style="width: 100%;">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Offer Type</th>
                    <th>Description</th>
                    <th>Value</th>
                    <th>Product</th>
                    <th>Product Variant</th>
                    <th>Action</th>
                </tr>
            </thead>
            
             <tbody id="datalist"><?php  echo isset($array_data) ? $array_data : "";?></tbody>
           
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


$(document).ready(function() {
    $('#Search_offer').keyup(function() {

        $.ajax({
            url: "<?php echo base_url('AdminPanel/Offers/Search_offer') ?>",
            type: 'POST',
            data: { searchText: $('#Search_offer').val() },
            success: function(response) {
                $('#datalist').html(response);
            }
        });


    });
});




function deleteRowtablesub(id) {
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
                url: "<?php echo base_url('AdminPanel/Offers/delete_offer'); ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(response) {
                    if (response == 'True') {
                        Swal.fire(
                            'Deleted!',
                            'Offer has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Failed!',
                            'Failed to delete Offer.',
                            'error'
                        );
                    }
                }
            });
        }
    });
}









</script>