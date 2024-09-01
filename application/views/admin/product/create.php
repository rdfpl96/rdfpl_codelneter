<?php
defined('BASEPATH') or exit('No direct script access allowed');

$session = $this->session->userdata('admin');


$this->load->view('admin/headheader');

$actAcx = ($getAccess['inputAction'] != "") ? $getAccess['inputAction'] : array();



// print_r($actAcx);
// exit();
// if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
//     echo "No direct page access allowed";
//     exit;
//    }
// Categories

?>

<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">
    <form action="<?php echo base_url("admin/product/save"); ?>" id="form_product" name="form_product" method="POST" enctype="multipart/form-data" onsubmit="addProductInfo();return false;">
      <div class="row align-items-center">
        <div class="border-0 mb-4">
          <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <div class="mob_back_btn">
              <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
            </div>

            <h3 class="fw-bold mb-0">Add Product</h3>
            <!-- <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3) == "") ? 'Add' : 'Edit'; ?> <?php echo ucfirst($this->uri->segment(4)); ?> Products</h3> -->
            <!-- <div class="col-md-6" style="margin-left: 900px;">
                                    <a href="<?php //echo base_url('admin/banner');
                                              ?>"><button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
                                </div> -->
            <a <button type="submit" href="<?php echo base_url('admin/product'); ?>" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase ">Back</button></a>
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
                      <label class="form-label">Product name <span style="color:red;">*</span></label>
                      <input type="text" class="form-control pname" id="product-name" name="product_name" value="" required placeholder="Please product name">
                    </div>


                    <div class="col-md-6">
                      <label class="form-label">Product Slug <span style="color:red;">*</span></label>
                      <input type="text" class="form-control url" id="slug" name="slug" value="" required placeholder="Please enter slug">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="uom" class="form-label">Description</label>
              <input type="hidden" name="increment" id="increment" value="<?php echo ($product_disc_list != 0) ? count($product_disc_list) : 1; ?>">
              <table class="table" id="descriptionTable">
                <tr class="add-tr">
                  <td class="tbl-td">
                    <div class="row">
                      <div class="col-sm-11 width_80">
                        <input type="text" class="form-control" id="heading1" name="heading[]" placeholder="Heading" value="">
                      </div>
                      <div class="col-sm-1 width_20">
                        <button type="button" class="btn btn-info add-more">+</button>
                      </div>
                    </div>
                    <textarea class="form-control" id="description1" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>
                  </td>
                </tr>
              </table>
            </div>
          </div>


          <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
              <h6 class="mb-0 fw-bold ">Images <span style="color:red;font-size: 13px;">(Image dimension should be 700x700 Px.)</span></h6>

            </div>
            <div class="row card-body">
              <div class="col-sm-2">
                <div class="center" style="text-align: center;">
                  <a href="#" class="close-image" data-id="1"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  <div class="form-input">
                    <div class="preview">
                      <?php

                      if ($product_list != 0) {

                        $filePath1 = (($product_list[0]->image1 != "") ? './uploads/' . $product_list[0]->image1 : '');
                        if (file_exists($filePath1)) {
                          $imgFile1 = base_url() . 'uploads/' . $product_list[0]->image1;
                        } else {
                          $imgFile1 = base_url() . 'include/assets/default_product_image.png';
                        }
                      } else {
                        $imgFile1 = base_url() . 'include/assets/default_product_image.png';
                      }


                      // $imga1=($product_list!=0) ? (($product_list[0]->image1!="") ? 'uploads/'.$product_list[0]->image1 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                      ?>
                      <img id="file-ip-1-preview" src="<?php echo $imgFile1; ?>">
                      <input type="text" name="image_path1" id="image_path1" value="<?php echo ($product_list != 0) ? $product_list[0]->image1 : ''; ?>">
                    </div>
                    <label for="file-ip-1">Image-1</label>
                    <input type="file" id="file-ip-1" name="image1" accept="image/*" onchange="showPreview(event,1);" hidden>
                    <span class="required" style="text-align: center;">Required</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="center" style="text-align: center;">
                  <a href="#" class="close-image" data-id="2"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  <div class="form-input">
                    <div class="preview">
                      <?php

                      if ($product_list != 0) {
                        $filePath2 = (($product_list[0]->image2 != "") ? './uploads/' . $product_list[0]->image2 : '');
                        if (file_exists($filePath2)) {
                          $imgFile2 = base_url() . 'uploads/' . $product_list[0]->image2;
                        } else {
                          $imgFile2 = base_url() . 'include/assets/default_product_image.png';
                        }
                      } else {
                        $imgFile2 = base_url() . 'include/assets/default_product_image.png';
                      }
                      // $imga2=($product_list!=0) ? (($product_list[0]->image2!="") ? 'uploads/'.$product_list[0]->image2 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                      ?>
                      <img id="file-ip-2-preview" src="<?php echo $imgFile2; ?>">
                      <input type="text" name="image_path2" id="image_path2" value="<?php echo ($product_list != 0) ? $product_list[0]->image2 : ''; ?>">
                    </div>
                    <label for="file-ip-2">Image-2</label>
                    <input type="file" id="file-ip-2" name="image2" accept="image/*" onchange="showPreview(event,2);" hidden>
                  </div>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="center" style="text-align: center;">
                  <a href="#" class="close-image" data-id="3"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  <div class="form-input">
                    <div class="preview">
                      <?php

                      if ($product_list != 0) {

                        $filePath3 = (($product_list[0]->image3 != "") ? './uploads/' . $product_list[0]->image3 : '');
                        if (file_exists($filePath3)) {
                          $imgFile3 = base_url() . 'uploads/' . $product_list[0]->image3;
                        } else {
                          $imgFile3 = base_url() . 'include/assets/default_product_image.png';
                        }
                      } else {
                        $imgFile3 = base_url() . 'include/assets/default_product_image.png';
                      }
                      // $imga3=($product_list!=0) ? (($product_list[0]->image3!="") ? 'uploads/'.$product_list[0]->image3 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                      ?>
                      <img id="file-ip-3-preview" src="<?php echo $imgFile3; ?>">
                      <input type="text" name="image_path3" id="image_path3" value="<?php echo ($product_list != 0) ? $product_list[0]->image3 : ''; ?>">
                    </div>
                    <label for="file-ip-3">Image-3</label>
                    <input type="file" id="file-ip-3" name="image3" accept="image/*" onchange="showPreview(event,3);" hidden>
                  </div>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="center" style="text-align: center;">
                  <a href="#" class="close-image" data-id="4"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  <div class="form-input">
                    <div class="preview">
                      <?php
                      if ($product_list != 0) {

                        $filePath4 = (($product_list[0]->image4 != "") ? './uploads/' . $product_list[0]->image4 : '');
                        if (file_exists($filePath4)) {
                          $imgFile4 = base_url() . 'uploads/' . $product_list[0]->image4;
                        } else {
                          $imgFile4 = base_url() . 'include/assets/default_product_image.png';
                        }
                      } else {
                        $imgFile4 = base_url() . 'include/assets/default_product_image.png';
                      }

                      ?>
                      <img id="file-ip-4-preview" src="<?php echo $imgFile4; ?>">
                      <input type="text" name="image_path4" id="image_path4" value="<?php echo ($product_list != 0) ? $product_list[0]->image4 : ''; ?>">
                    </div>
                    <label for="file-ip-4">Image-4</label>
                    <input type="file" id="file-ip-4" name="image4" accept="image/*" onchange="showPreview(event,4);" hidden>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="center" style="text-align: center;">
                  <a href="#" class="close-image" data-id="5"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  <div class="form-input">
                    <div class="preview">
                      <?php
                      if ($product_list != 0) {

                        $filePath5 = (($product_list[0]->image5 != "") ? './uploads/' . $product_list[0]->image5 : '');
                        if (file_exists($filePath5)) {
                          $imgFile5 = base_url() . 'uploads/' . $product_list[0]->image5;
                        } else {
                          $imgFile5 = base_url() . 'include/assets/default_product_image.png';
                        }
                      } else {
                        $imgFile5 = base_url() . 'include/assets/default_product_image.png';
                      }
                      // $imga4=($product_list!=0) ? (($product_list[0]->image4!="") ? 'uploads/'.$product_list[0]->image4 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                      ?>
                      <img id="file-ip-5-preview" src="<?php echo $imgFile5; ?>">
                      <input type="text" name="image_path5" id="image_path5" value="<?php echo ($product_list != 0) ? $product_list[0]->image5 : ''; ?>">
                    </div>
                    <label for="file-ip-5">Image-5</label>
                    <input type="file" id="file-ip-5" name="image5" accept="image/*" onchange="showPreview(event,5);" hidden>
                  </div>
                </div>
              </div>


              <div class="col-sm-2">
                <div class="center" style="text-align: center;">
                  <a href="#" class="close-image" data-id="6"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  <div class="form-input">
                    <div class="preview">
                      <?php
                      if ($product_list != 0) {

                        $filePath6 = (($product_list[0]->image6 != "") ? './uploads/' . $product_list[0]->image6 : '');
                        if (file_exists($filePath6)) {
                          $imgFile6 = base_url() . 'uploads/' . $product_list[0]->image6;
                        } else {
                          $imgFile6 = base_url() . 'include/assets/default_product_image.png';
                        }
                      } else {
                        $imgFile6 = base_url() . 'include/assets/default_product_image.png';
                      }
                      // $imga4=($product_list!=0) ? (($product_list[0]->image4!="") ? 'uploads/'.$product_list[0]->image4 : 'include/assets/default_product_image.png') :'include/assets/default_product_image.png';
                      ?>
                      <img id="file-ip-6-preview" src="<?php echo $imgFile6; ?>">
                      <input type="text" name="image_path6" id="image_path6" value="<?php echo ($product_list != 0) ? $product_list[0]->image6 : ''; ?>">
                    </div>
                    <label for="file-ip-6">Image-6</label>
                    <input type="file" id="file-ip-6" name="image6" accept="image/*" onchange="showPreview(event,6);" hidden>
                  </div>
                </div>
              </div>

            </div>
          </div>
        
          <button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase " onsubmit="addProductInfo()">Save</button>
    </form>
  </div>
</div>



<!--  </div>
  </div>  -->
<?php $this->load->view('admin/footer'); ?>
<script>
  $(document).on('click', '.add-more', function() {
    var increment = $('#increment').val();
    increment++;
    $('#increment').val(increment);
    var html = '<tr class="add-tr' + increment + '">' +
      '<td class="tbl-td">' +
      '<div class="row">' +
      '<div class="col-sm-11">' +
      '<input type="hidden" id="disc-id' + increment + '" name="input_disc_id[]" value="">' +
      '<input type="text" class="form-control" id="heading' + increment + '" placeholder="Heading" name="heading[]">' +
      '</div>' +
      '<div class="col-sm-1">' +
      '<button type="button" class="btn btn-danger remove-btn" data-id="' + increment + '">-</button>' +
      '</div>' +
      '</div>' +
      '<textarea class="form-control" id="description' + increment + '" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>' +
      '</td>' +
      '</tr>';
    $('.add-tr').before(html);

    // alert('hiiii');
  })




  $(document).on('click', '.remove-btn', function() {
    var rowId = $(this).data('id');
    $('.add-tr' + rowId).remove();
  });



  $(document).ready(function() {
    $(".pname").keyup(function() {
      var Text = $(this).val();
      Text = Text.toLowerCase();
      Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
      $("#slug").val(Text);
    });
  });


 

function addProductInfo() {
 
    var formData = new FormData($('#form_product')[0]);
    var fileInput = $('#form_product input[type="file"]');
    var valid = true;
    fileInput.each(function() {
        var file = this.files[0];
        if (file) {
            var img = new Image();
            img.src = URL.createObjectURL(file);
            img.onload = function() {
      
                if (img.width !== 700 || img.height !== 700) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Image Dimensions',
                        text: 'All images must be 700x700 pixels.',
                    });
                    valid = false;
                    return false; // Exit loop
                }

                if (valid) {
                    $.ajax({
                        type: 'post',
                        url: $('#form_product').attr('action'),
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.error == 0) {
                                $('#form_product')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Product added successfully!',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?php echo base_url('AdminPanel/product'); ?>";
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Product already exists!',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        },
                    });
                }
            }
        }
    });
}

$(document).ready(function() {
 
    $(document).on('click', '.close-image', function(e) {
        e.preventDefault(); 
        var imageId = $(this).data('id'); 
        $('#file-ip-' + imageId + '-preview').attr('src', '<?php echo base_url('include/assets/default_product_image.png'); ?>');
        $('#file-ip-' + imageId).val('');
        $('#image_path' + imageId).val('');
    });
});


</script>