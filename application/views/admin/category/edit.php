<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$session=$this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array(); 



// print_r($actAcx);
// exit();
// if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
//     echo "No direct page access allowed";
//     exit;
//    }
// Categories

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
                 <form action="<?php echo base_url('admin/category/update/'.$category->cat_id); ?>" method="post">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>

                                <h3 class="fw-bold mb-0">Update Product</h3>

                                <!-- <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> <?php echo ucfirst($this->uri->segment(4));?> Products</h3> -->
                                
                                <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Save</button>
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
                                                    <label  class="form-label">Product name <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control pname" id="product-name" name="product_name" value="<?php echo $category->category; ?>" required placeholder="Please product name">
                                                </div>


                                                 <div class="col-md-6">
                                                    <label  class="form-label">Product Slug <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control url" id="slug" name="slug" value="<?php echo $category->slug; ?>" required placeholder="Please enter slug">
                                                </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                          </div>
                        
                          </div>
                        <div class="ship_ad_btn_css">
                            <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Save</button>
                            <div class="loaderdiv"></div>
                        </div>
                       </form>
                  </div>
            </div>
     
            
                                
         
     <!--  </div>
  </div>  -->
  <?php $this->load->view('admin/footer'); ?>
  <script>
    $(document).ready(function (){
       $(".pname").keyup(function() {
          var Text = $(this).val();
          Text = Text.toLowerCase();
          Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
          $("#slug").val(Text);        
    });
});

      function addProductInfo(){
        var formData = new FormData($('#form_product')[0]);
        
           $.ajax({
                type: 'post',
                url: $('#form_product').attr('action'),
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                     
                },

                success: function(res) {
                  
                    if(res.error==0){
                        
                        Swal.fire('Success','success'); 

                    }
                    else{
                       Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                        })
                    }
                },
                complete: function() {
                     //$.unblockUI();
                  // $('#btn1').css('display', 'block');
                  // $('#btn2').css('display', 'none');
                },
                error: function(xhr, status, error) {
                  console.log(error);
                },
              });
      }
  </script>