 <?php
$this->load->view('frontend/header',$data);
?>
 <main class="main">
        <div class="page-header mt-30 mb-20">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <div class="breadcrumb">
                                <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Blogs
                            </div>
                        </div>
                         <div class="col-xl-9 text-end d-none d-xl-block">
                            <ul class="tags-list">
                                 <?php
                                  if($blogs_cat_list!=0){
                                    foreach ($blogs_cat_list as $key => $value) {
                                       ?>
                                        <li class="hover-up">
                                            <a href="<?php echo base_url('blog').'/?sr='.$value->blog_cat_name;?>"><?php echo $value->blog_cat_name;?></a>
                                        </li>
                                       <?php
                                    }
                                  }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter mb-50">
                            <div class="totall-product">
                                <h2>Blogs</h2>
                            </div>
                            <div class="sort-by-product-area">
                                <!-- <div class="sort-by-cover mr-10"> -->
                                  <!--   <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div> -->
                                 <!--  <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">50</a></li>
                                            <li><a href="#">100</a></li>
                                            <li><a href="#">150</a></li>
                                            <li><a href="#">200</a></li>
                                            <li><a href="#">All</a></li>
                                        </ul>
                                    </div> -->
                                <!-- </div> -->
                               <!--  <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span>Featured <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">Featured</a></li>
                                            <li><a href="#">Newest</a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="loop-grid">
                            <div class="row">
                               
                               <?php
                               if($blogs_list !=0){

                                  foreach ($blogs_list as $key => $value) {
                                   
                                      ?>

                                       <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                        <div class="post-thumb">
                                            <a href="<?php echo base_url('single-blog/'.$this->my_libraries->replaceAll($value->blog_header)).'?bo='.base64_encode($value->blog_id);?>">
                                                <img class="border-radius-15" src="<?php echo base_url()?>uploads/blogs_image/<?php echo $value->blog_image;?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="entry-content-2">
                                            <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href=""><?php echo $this->my_libraries->getCate_name($value->blog_category);?></a></h6>
                                            <h4 class="post-title mb-15">
                                                <a href="<?php echo base_url('single-blog/'.$this->my_libraries->replaceAll($value->blog_header)).'?bo='.base64_encode($value->blog_id);?>"><?php echo getShortData($value->blog_header,45);?></a>
                                            </h4>
                                            <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                                <div>
                                                    <span class="post-on mr-10"><?php echo date('F d, Y',strtotime($value->blog_add_date));?></span>
                                                    <!-- <span class="hit-count has-dot mr-10">126k Views</span> -->
                                                    <!-- <span class="hit-count has-dot"><a href="">Admin</a></span> -->
                                                </div>
                                            </div></a>
                                        </div>
                                    </article>

                                      <?php
                                  }
                               }
                               ?>
                             
                                 
                                 

                            
                            </div>
                        </div>
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <?php echo $links;?>
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
$this->load->view('frontend/footer',$data);
?>    
    