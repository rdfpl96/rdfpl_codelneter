<?php 
// $actAcx
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
  
    <h3 class="fw-bold mb-0">Product List</h3>
     <?php if(in_array('add',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
    <a href="<?php echo base_url('admin/add_product');?>" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Product</a>
  <?php } ?>

      <!-- ===== -->


      <!-- ==== -->

</div>
</div>
</div> <!-- Row end  -->


<!-- filters -->

<div class="row g-3 mb-3">
<div class="col-xl-12 col-lg-12">

<div class="card mb-3">

    <div class="card-body">

        <div class="row">
           
            <div class="col-md-3">
                <div class="filter-search">
                    <form action="#" id="search-form" method="post">
                        <label class="form-label">Search Product</label>
                        <input type="text" placeholder="" class="form-control" id="search-product">
                    </form>
                </div>
            </div>

            <?php if(in_array('import',$actAcx) || $session['admin_type']=='A'){ ?>

            <div class="col-md-1 width_20">
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

                <div class="col-md-1 width_50">
                        <label class="form-label mt-30 btn btn-sm btn-secondary btn-upload" >
                        <a href="<?php echo base_url('exportCSV');?>" style="color:white;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></a>
                       </label>
                </div>
           <?php } ?>

          
           
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                 <a href="<?php echo base_url('admin/product_list');?>"><button type="button" class="btn btn-primary">
                    Products <span class="badge text-maroon bg-secondary"><?php echo $product_count;?></span>
                </button></a>

                <div class="btn-group dropdown">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                      Category <span class="badge text-maroon bg-secondary"><?php echo ($countCategory!=0) ? count($countCategory) : 0;?></span>
                  </button>
                  <ul class="dropdown-menu" style="height: 300px;overflow: scroll;">
                    <?php 
                     if($countCategory!=0){
                      foreach($countCategory as $cat_value){
                        ?>
                        <li><a class="dropdown-item" href="<?php echo base_url('admin/product_list?cat='.$cat_value->ci_cat_name);?>"><?php echo $cat_value->category;?></a></li>
                        <?php
                      }
                     }
                    ?>
                  </ul>
                </div>

          
                <div class="btn-group dropdown">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                      SubCategory <span class="badge text-maroon bg-secondary"><?php echo ($countSubCategory!=0) ? count($countSubCategory) : 0;?></span>
                  </button>
                  <ul class="dropdown-menu" style="height: 300px;overflow: scroll;">
                   <?php 
                     if($countSubCategory!=0){
                      foreach($countSubCategory as $scat_value){
                        ?>
                        <li><a class="dropdown-item" href="<?php echo base_url('admin/product_list?subcat='.$scat_value->ci_sub_cat_name);?>"><?php echo $scat_value->subCat_name;?></a></li>
                        <?php
                      }
                     }
                    ?>
                  </ul>
                </div>

                 <a href="<?php echo base_url('admin/product_list?st=1');?>"><button type="button" class="btn btn-primary">
                    In Stock <span class="badge text-maroon bg-secondary"><?php echo ($product_list_in_stock!=0) ? count($product_list_in_stock) : 0;?></span>
                </button></a>

                <a href="<?php echo base_url('admin/product_list?st=0');?>"><button type="button" class="btn btn-primary">
                    Out Of Stock <span class="badge text-maroon bg-secondary"><?php echo ($product_list_out_of_stock!=0) ? count($product_list_out_of_stock) : 0;?></span>
                </button></a>

               <a href="<?php echo base_url('admin/product_list?act=1');?>"> <button type="button" class="btn btn-primary">
                    Active <span class="badge text-maroon bg-secondary"><?php echo ($product_list_active!=0) ? count($product_list_active) : 0;?></span>
                </button></a>

                <a href="<?php echo base_url('admin/product_list?act=0');?>"><button type="button" class="btn btn-primary">
                    In Active <span class="badge text-maroon bg-secondary"><?php echo ($product_list_in_active!=0) ? count($product_list_in_active) : 0;?></span>
                </button></a>

                

                 

            </div>
        </div>

    </div>

</div>

</div>
</div>    



<!-- filters end -->
<div class="row g-3 mb-3">
<div class="col-md-12">
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
        <table id="myDataTable" class="table mb-0" style="width: 100%;">
            <thead>
                <tr>
                    <th>Product Name</th>
                      <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                      <th>Status</th>
                     <?php } ?>
                      <?php if(in_array('stock-status',$actAcx) || $session['admin_type']=='A'){ ?>
                      <th>In Stock</th>
                    <?php } ?>
                    <th>Categories</th>
                    <th>Sub Categories</th>
                    <th>Item code</th>
                    <th>Date</th>
                    <th>Image</th>
                     <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="trRow">
              <?php 
                $data['product_list']=$product_list;
                $this->load->view('admin/containerPage/searchProduct',$data);
              ?>
              
            </tbody>
        </table>



        <!-- <div class="row"> -->
          
        <!-- <ul class="pagination">
          <li class="paginate_button page-item previous" >
            <a href="#" class="page-link">Previous</a></li>
          <li class="paginate_button page-item active">
            <a href="#" class="page-link">1</a>
          </li>
          <li class="paginate_button page-item">
            <a href="#" class="page-link">2</a>
          </li>
          <li class="paginate_button page-item next">
            <a href="#" class="page-link">Next</a>
          </li>
        </ul> -->
        <!-- </div> -->

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