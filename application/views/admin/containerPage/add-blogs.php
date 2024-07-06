<?php
   $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
   if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
?> 

<style type="text/css">
    .btn-close{
    background-color: #2dffec;
    filter: invert(1);
    border-radius: 30px;
    padding: 6px;
    }
    .dropdown-menu>li>a{
        padding:3px 8px;
    }
</style>

  <!-- <div id="summernote"><p>Hello Summernote</p></div> -->

 <!-- <textarea type="text" class="form-control" name="abc" id="abc" rows="9"></textarea> -->

 <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                   <form action ="#" id="form-blogs" name="form_blogs" method="POST" enctype="multipart/form-data">
                
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Blogs</h3>
                                <div class="loaderdiv"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="<?php echo base_url('admin/blogs'); ?>"><button type="button" class="btn btn-primary btn-set-task blo-cl w-sm-100 py-2 px-5 text-uppercase">Back</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-set-task blo-cl w-sm-100 py-2 px-5 text-uppercase save-blogs">Save</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>   
                  
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <!-- <div class="card mb-3"> -->
                                <!-- <div class="card-body"> -->
 
                                       <input type="hidden" class="form-control" name="blog_id" id="blog_id" value="<?php echo $this->uri->segment(3);?>">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label  class="form-label">Header Name <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="blog_header" name="blog_header" value="<?php echo ($product_list!=0)? $product_list[0]->blog_header :'';?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label  class="form-label">Category <span style="color:red;">*</span></label>
                                                 <!-- <input type="hidden" name="blog_category" id="blog_category" value="<?php //echo ($product_list!=0)? $product_list[0]->cat_id :'';?>"> -->
                                                 <select type="text" class="form-control category-action" id="blog_category" name="blog_category">
                                                    <option value="">-Select-</option>
                                                    <?php
                                                    if($category_list!=0){
                                                        foreach($category_list as $value){
                                                          $cate_id=($product_list!=0)? $product_list[0]->blog_category :'';
                                                          $selected=($value->cat_id==$cate_id) ? 'selected':'';
                                                          ?>
                                                          <option value="<?php echo $value->cat_id;?>" <?php echo $selected;?>><?php echo $value->category;?></option>
                                                          <?php
                                                        }
                                                      }
                                                    ?>
                                                  </select>
                                                  <p id="cat-err"></p>
                                            </div>
                                        </div>
                                   <!-- </div> -->
                               <!-- </div> -->

                             <div class="row">
                                <div class="col-md-12">
                                  <label for="" class="form-label">Description<span style="color: red;">*</span></label>
                                  <!-- <textarea type="text" class="form-control" name="blog_description" id="blog_description" rows="9"><?php //echo ($product_list!=0)? $product_list[0]->blog_description :'';?></textarea> -->

                                   <textarea class="form-control" name="blog_description" id="blog_description"><?php echo ($product_list!=0)? $product_list[0]->blog_description :'';?></textarea>

                                  <!-- <div class="col-md-12">
                                  <label class="form-label">Product Description</label>
                                    <div id="editor">
                                       <h4>Enter Product Description Here</h4>
                                  </div>
                                  </div> -->

                              

                             <!--  <div class="col-md-12">
                                <label for="Tags" class="form-label">Tags(Optional)</label>
                                   <input type="text" class="form-control" id="blog_tag_field" name="blog_tag_field" data-role="tagsinput" style="display: none;" value="<?php //echo ($product_list!=0)? $product_list[0]->blog_tag_field :'';?>">        
                              </div> -->

                            <div class="col-md-12">
                                 <label for="Tags" class="form-label">Image<span style="color: red;">*</span> </label>
                                 <input type="file" class="form-control" id="blog_image" name="blog_image">     

                                 

                                  <?php
                                  if($product_list!=0){
                                    ?>
                                     <input type="hidden" name="image_path" id="image_path" value="<?php echo ($product_list!=0)? $product_list[0]->blog_image :'';?>">  
                                    <?php
                                      $filePath=(($product_list[0]->blog_image!="") ? './uploads/blogs_image/'.$product_list[0]->blog_image :'');
                                    if(file_exists($filePath)){
                                       $imgFile=base_url().'uploads/blogs_image/'.$product_list[0]->blog_image;
                                    }else{
                                      $imgFile=base_url().'include/assets/default_product_image.png';
                                    }

                                    ?>
                                    <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">

                                  <?php } ?>

                                  <span style="color:red;font-size: 13px;">Image dimension should be 2000 X 950 Px.</span>
                            </div>
                        </div>
                      </div>
                  </div>
            
                
          </div>
          </form>
     </div>




    <!--  <script>
        $(document).ready(function() {
        //Ch-editer
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
            //Datatable
            $('#myCartTable')
            .addClass( 'nowrap' )
            .dataTable( {
                responsive: true,
                columnDefs: [
                    { targets: [-1, -3], className: 'dt-body-right' }
                ]
            });
            $('.deleterow').on('click',function(){
            var tablename = $(this).closest('table').DataTable();  
            tablename
                    .row( $(this)
                    .parents('tr') )
                    .remove()
                    .draw();

 

            } );
           //Multiselect
           $('#optgroup').multiSelect({ selectableOptgroup: true });
        });

 

        $(function() {
            $('.dropify').dropify();

 

            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

 

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

 

            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-dÃ©posez un fichier ici ou cliquez',
                    replace: 'Glissez-dÃ©posez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'DÃ©solÃ©, le fichier trop volumineux'
                }
            });
        });

</script>
 -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script> -->
     
            
                                
         
     <!--  </div>
  </div>  -->