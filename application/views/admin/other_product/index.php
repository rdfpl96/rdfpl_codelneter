  <?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
  $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

<?php


// echo "<pre>";

// print_r($productList);
// die();

?>


  <!-- Body: Body -->       
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                 <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Manage Other Product</h3>
                                <?php //if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                <div class="">
                                    <a href="<?php echo base_url('admin/other-product/add');?>" class="btn btn-primary btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Add </a>
                                </div>
                            <?php //} ?>

                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row coupon_list_css clearfix g-3">
                    <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Product Type</th>
                                                <th>Product Name</th>
                     
                                                <th>Actions</th>  
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(is_array($productList) && count($productList)>0 ){

                                            foreach($productList as $values){
                                                 $name=$this->customlibrary->productTypeName($values->product_type_id);
                                                ?>
                                                <tr>
                                                <td>
                                                    <span class="fw-bold ms-1"><?php echo $name ?></span><br>
                                                </td>
                                                <td>
                                                    <span class="fw-bold ms-1"><?php echo $values->product_name;?></span><br>
                                                </td>
                                            
                                                                                            
                                                <td>
                                                    <a href="javascript:deleteRowtablesub(<?php echo $values->product_id; ?>)"
                                                    class="btn btn-primary btn-xs"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Delete">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </td>

                                            </tr>

                                                <?php
                                            }
                                          }
                                        ?>
                                        <tr>
                                          <td colspan="15">
                                           <div id="pagint-div" style="float: right;">
                                            <?php echo $links;?>
                                           </div>
                                           </td>
                                        </tr>
                

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div><!-- Row End -->
                </div>
            </div>







            <script>


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
                url: "<?php echo base_url('admin/delete_Other_Product'); ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(response) {
                    if (response == 'True') {
                        Swal.fire(
                            'Deleted!',
                            'Other Product has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } 
                    // else {
                    //     Swal.fire(
                    //         'Failed!',
                    //         'Failed to Other Product.',
                    //         'error'
                    //     );
                    // }
                },
                // error: function() {
                //     Swal.fire(
                //         'Error!',
                //         'Error Other Product.',
                //         'error'
                //     );
                // }
            });
        }
    });
}







            </script>