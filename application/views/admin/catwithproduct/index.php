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
  
    <h3 class="fw-bold mb-0">Product With Category List</h3>
</div>
</div>
</div> <!-- Row end  -->


<!-- filters -->

<div class="row g-3 mb-3">
<div class="col-xl-12 col-lg-12">

<div class="card mb-3">

    <div class="card-body">
        <form  id="search-form" method="post"  enctype="multipart/form-data" onsubmit="mapingWithProduct();return false;">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control" id="top_cat_id" name="top_cat_id" required onchange="Search();getSubCategory()">
                            <?php echo isset($topcat) ? $topcat : '';?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" id="sub_cat_id" name="sub_cat_id" required onchange="Search();getChildCategory()">
                            <option value="">Select Sub Category</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" id="child_cat_id" name="child_cat_id" required onchange="Search()">
                           <option value="">Select child Category</option>
                    </select>
                </div>
                <div class="col-md-3">
                   <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
        <br>
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
            <table class="table mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Product Name</th>
                        <th>Top Cat Name</th>
                        <th>Sub Cat Name</th>
                        <th>Child Cat Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                 <tbody id="datalist"><?php  echo isset($array_data) ? $array_data : "";?></tbody>
            </table>
          <div id="pg"><?php  echo isset($pagination) ? $pagination : ''?></div> 
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
});    

    
 function change_page(page){
    var formData = new FormData($('#search-form')[0]);
    formData.append('page', page);
    formData.append('method','changepage');
    $.ajax({
        url:"<?php echo base_url(); ?>admin/categorywithproduct",
        type: "POST",
        data:formData,
        dataType:"json",
        processData: false,
        contentType: false,
        success:function(data){
            $('#datalist').html(data.array_data);
            $('#pg').html(data.pagination);
            }
        });  
    }
  function Search() {
    var page;    
    change_page(page);
} 


function deletRecord(id){
      
    var formData = new FormData($('#search-form')[0]);
    $.ajax({
        url:"<?php echo base_url(); ?>admin/categorywithproduct/delete/"+id,
        type: "POST",
        data:formData,
        dataType:"json",
        processData: false,
        contentType: false,
        success:function(res){
                var page;    
                change_page(page);
            }
        });  
}

function mapingWithProduct(){
    var formData = new FormData($('#search-form')[0]);
    formData.append('page', page);
    formData.append('method','changepage');
    $.ajax({
        url:"<?php echo base_url(); ?>admin/categorywithproduct/save",
        type: "POST",
        data:formData,
        dataType:"json",
        processData: false,
        contentType: false,
        success:function(data){
             var page;    
                change_page(page);
            }
        });  
}

function getSubCategory(){
   
    let top_cat_id=$('#top_cat_id').val();
    var formData = new FormData($('#search-form')[0]);
    $.ajax({
        url:"<?php echo base_url(); ?>subCategory/"+top_cat_id,
        type: "POST",
        data:formData,
        dataType:"json",
        processData: false,
        contentType: false,
        success:function(res){
                console.log(res.subcategories);
            $('#sub_cat_id').html(res.subcategories);    
            }
        });  

}

function getChildCategory(){
    var formData = new FormData($('#search-form')[0]);
    let top_cat_id=$('#top_cat_id').val();
    let sub_cat_id=$('#sub_cat_id').val();
    $.ajax({
        url:"<?php echo base_url(); ?>childcategoryn/"+top_cat_id+'/'+sub_cat_id,
        type: "POST",
        data:formData,
        dataType:"json",
        processData: false,
        contentType: false,
        success:function(res){
              $('#child_cat_id').html(res.chilcategories);    
            }
        });  
}
</script>