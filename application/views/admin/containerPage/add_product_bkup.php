 <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Add Product</h3>
                                <a href="<?php echo base_url('admin/add_category');?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Product</a>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                           

                                           <!-- <div class="container"> -->
      <!-- <div class="row"> -->
        <!-- <div class="col-md-12"> -->
            <div class="vertical-tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-active-set" role="tablist">

                     <li role="presentation" class="active">
                        <a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Category</a>
                    </li>

                     <li role="presentation">
                        <a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Images</a>
                    </li>

                     <li role="presentation">
                        <a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Product Details</a>
                    </li>

                     <!-- <li role="presentation">
                        <a href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">Section 4</a>
                    </li> -->

                     <!-- <li role="presentation">
                        <a href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">Section 5</a>
                    </li> -->

                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">

                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                              <label for="product-name" class="form-label">Product name</label>
                                               <input type="text" class="form-control" name="product_name" id="product-name">
                                           </div>
                                         
                                            <div class="col-md-6">
                                                <label  class="form-label">Name</label>
                                                <select type="text" class="form-control">
                                                    <option>Category</option>
                                                    <option>Category2</option>
                                                    <option>Category3</option>
                                                    <option>Category4</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Page Title</label>
                                                 <select type="text" class="form-control">
                                                    <option>Sub Category</option>
                                                    <option>Sub Category2</option>
                                                    <option>Sub Category3</option>
                                                    <option>Sub Category4</option>
                                                </select>
                                            </div>
                                        </div>

                         <a href="#" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100 cate-next"> Next</a>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                          
                       <div class="row row-custom">
                        <div class="col-sm-4">
                            <div class="center">
                                <a href="#" class="close-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <div class="form-input">
                                <div class="preview">
                                  <img id="file-ip-1-preview" src="<?php echo base_url();?>include/assets/default_product_image.png">
                                </div>
                                <label for="file-ip-1">Image-1</label>
                               <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event,1);" hidden>
                              </div>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="center">
                                  <a href="#" class="close-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <div class="form-input">
                                <div class="preview">
                                  <img id="file-ip-2-preview" src="<?php echo base_url();?>include/assets/default_product_image.png">
                                </div>
                                <label for="file-ip-2">Image-2</label>
                               <input type="file" id="file-ip-2" accept="image/*" onchange="showPreview(event,2);" hidden>
                              </div>
                            </div> 
                        </div>

                        <div class="col-sm-4">
                            <div class="center">
                                  <a href="#" class="close-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <div class="form-input">
                                <div class="preview">
                                  <img id="file-ip-3-preview" src="<?php echo base_url();?>include/assets/default_product_image.png">
                                </div>
                                <label for="file-ip-3">Image-3</label>
                               <input type="file" id="file-ip-3" accept="image/*" onchange="showPreview(event,3);" hidden>
                              </div>
                            </div> 
                        </div>

                         <div class="col-sm-4">
                            <div class="center">
                                  <a href="#" class="close-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <div class="form-input">
                                <div class="preview">
                                  <img id="file-ip-4-preview" src="<?php echo base_url();?>include/assets/default_product_image.png">
                                </div>
                                <label for="file-ip-4">Image-4</label>
                               <input type="file" id="file-ip-4" accept="image/*" onchange="showPreview(event,4);" hidden>
                              </div>
                            </div> 
                        </div>



                         <div class="col-sm-4">
                            <div class="center">
                                  <a href="#" class="close-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <div class="form-input">
                                <div class="preview">
                                  <img id="file-ip-5-preview" src="<?php echo base_url();?>include/assets/default_product_image.png">
                                </div>
                                <label for="file-ip-5">Image-5</label>
                               <input type="file" id="file-ip-5" accept="image/*" onchange="showPreview(event,5);" hidden>
                              </div>
                            </div> 
                        </div>


                        <div class="col-sm-4">
                            <div class="center">
                                  <a href="#" class="close-image"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <div class="form-input">
                                <div class="preview">
                                  <img id="file-ip-6-preview" src="<?php echo base_url();?>include/assets/default_product_image.png">
                                </div>
                                <label for="file-ip-6">Image-6</label>
                               <input type="file" id="file-ip-6" accept="image/*" onchange="showPreview(event,6);" hidden>
                              </div>
                            </div> 
                        </div>




                      </div>


                        <a href="#" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100 cate-next"> Next</a>
                      


                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                       
                              
                    <section>
                    <!-- <h6 class="title collapsed fw-bold" id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Your Personal Details </h6> -->
                    <div class="checkout-steps-form-content collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample" >
                        <form class="mt-3">
                            <div class="row g-3 align-items-center">
                                
                                <div class="col-md-6">
                                    <label for="sku-id" class="form-label">SKU ID</label>
                                    <input type="text" class="form-control" name="sku_id" id="sku-id">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" id="price">
                                </div>

                                <div class="col-md-6">
                                    <label for="units" class="form-label">Units</label>
                                      <div class="input-group input-group-multi">
                                          <div class="col-xs-6">
                                            <input type="text" class="form-control">
                                         </div>
                                          <div class="col-xs-6 no-gutters">
                                            <select type="text" class="form-control" id="units">
                                                <option>Kg</option>
                                                <option>Gram</option>
                                                <option>Pices</option>
                                                <option>Package</option>
                                            </select>
                                        </div>
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="text" class="form-control" name="stock" id="stock">
                                </div>

                                 <div class="col-md-6">
                                    <label for="hsn-code" class="form-label">HSN Code</label>
                                    <input type="text" class="form-control" name="hsn_code" id="hsn-code">
                                 </div>

                                  <div class="col-md-6">
                                    <label for="gst" class="form-label">GST(%)</label>
                                    <input type="text" class="form-control" name="gst" id="gst">
                                 </div>

                                 <div class="col-md-6">
                                    <label for="uom" class="form-label">UOM</label>
                                    <input type="text" class="form-control" name="uom" id="uom">
                                 </div>


                               

                               <!--  <div class="col-md-12">
                                    <label class="form-label">Shipping Address</label>
                                    <input type="email" class="form-control" required>
                                </div> -->
                              <!--   <div class="col-md-6">
                                    <label for="cityblock1" class="form-label">City</label>
                                    <input type="text" class="form-control" id="cityblock1" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="postcode1" class="form-label">Post Code</label>
                                    <input type="text" class="form-control" id="postcode1" required>
                                </div>
                                <div class="col-md-6">
                                    <label  class="form-label">Country</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Country Option</option>
                                        <option value="1">India</option>
                                        <option value="2">Australia</option>
                                        <option value="3">Italy</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label  class="form-label">State</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>State Option</option>
                                        <option value="1">Gujrat</option>
                                        <option value="2">Kerela</option>
                                        <option value="3">Rajesthan</option>
                                    </select>
                                </div>-->
                               <!--  <div class="col-md-12">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked>
                                    <label class="form-check-label" for="flexCheckChecked1">
                                        My delivery and Shipping addresses are the same.
                                    </label>
                                    </div>
                                </div>  -->
                                <div class="col-md-12">
                                     <label  class="form-label">Description</label>

                                     <table class="table">

                                        <tr>
                                            <td class="tbl-td">
                                            <div class="row"> 
                                                <div class="col-sm-11">
                                                  <input type="text" class="form-control" id="heading" placeholder="Heading">
                                                </div>
                                                <div class="col-sm-1">
                                                <!--  <button type="button" class="btn btn-info">+</button> -->
                                               </div>
                                            </div>
                                             <textarea class="form-control" name="description" placeholder="Description" style="margin-bottom: 6px;"></textarea>
                                           </td>
                                       </tr>

                                        <tr>
                                            <td class="tbl-td">
                                            <div class="row"> 
                                                <div class="col-sm-11">
                                                  <input type="text" class="form-control" id="heading" placeholder="Heading">
                                                </div>
                                                <div class="col-sm-1">
                                                 <button type="button" class="btn btn-danger">-</button>
                                               </div>
                                            </div>
                                             <textarea class="form-control" name="description" placeholder="Description" style="margin-bottom: 6px;"></textarea>
                                           </td>
                                       </tr>

                                       <tr>
                                            <td class="tbl-td">
                                            <div class="row"> 
                                                <div class="col-sm-11">
                                                  <input type="text" class="form-control" id="heading" placeholder="Heading">
                                                </div>
                                                <div class="col-sm-1">
                                                 <button type="button" class="btn btn-info">+</button>
                                               </div>
                                            </div>
                                             <textarea class="form-control" name="description" placeholder="Description" style="margin-bottom: 6px;"></textarea>
                                           </td>
                                       </tr>



                                    </table>

                                </div> 
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4 px-5 text-uppercase cate-next">Save</button>
                        </form>
                    </div>
                    </section>



                    </div>
                    
                     <div role="tabpanel" class="tab-pane fade" id="Section4">
                        <h3>Section 3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                    
                     <div role="tabpanel" class="tab-pane fade" id="Section5">
                        <h3>Section 3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                    
                </div>
            </div>
        <!-- </div> -->
    <!-- </div> -->
<!-- </div>   -->





                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>