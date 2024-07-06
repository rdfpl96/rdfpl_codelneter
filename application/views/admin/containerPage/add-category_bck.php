
<!-- Body: Body -->
<div class="body d-flex py-3">
<div class="container-xxl">
<form class="form" id="category-form" action="" method="POST">
<div class="row align-items-center">
<div class="border-0">
<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
    <h3 class="fw-bold mb-0">Add Category</h3>
    <button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100 cate-save">Save</button>
</div>
</div>
</div> <!-- Row end  -->  

<div class="row g-3 mb-3">

    <?php
 // echo "<pre>";
 // print_r($category_detaials[0]->category);
 // echo "</pre>";

    ?>

<div class="col-lg-12">
<div class="card mb-3">
    
    <div class="card-body">
        <form>
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label  class="form-label">Category</label>
                    <input type="hidden" id="get-cat-id" value="<?php echo ($category_detaials!=0) ? $category_detaials[0]->cat_id :'';?>">
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo ($category_detaials!=0) ? $category_detaials[0]->category :'';?>">
                </div>
               <!--  <div class="col-md-6">
                    <label class="form-label">Page Title</label>
                    <input type="text" class="form-control">
                </div> -->
                
            </div>
        </form>
    </div>
</div>

</div>
</div><!-- Row end  --> 
</form>
</div>
</div>  