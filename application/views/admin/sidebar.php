
            <!-- sidebar -->
        <div class="sidebar px-4 py-4 py-md-4 me-0">
            <div class="d-flex flex-column h-100">
                <a href="<?php echo base_url('admin/dashboard');?>" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="bi bi-bag-check-fill fs-4"></i>
                    </span>
                  

                    <div class="logo">
                       <a href=""><img src="<?php echo base_url()?>include/frontend/assets/imgs/footer-logo.png" alt="img" style="width: 60%;
    margin-left: auto;
    margin-right: auto;
    display: grid;"></a>
                    </div>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3" id="sidebar_nav">
                     <?php
                       if($sidebarMenus!=array()){
                        foreach($sidebarMenus as $value){

                            if($value!=array()){
                              $collapsed=($value['submenu']!=array()) ? 'class="collapsed"' :'';
                              $data_bs_toggle=($value['submenu']!=array()) ? 'data-bs-toggle="collapse"' :'';
                              $data_bs_target=($value['submenu']!=array()) ? 'data-bs-target="#menu-Componentsone-'.$value['menus_id'].'"' :'';
                              $idArr=($value['submenu']!=array()) ? 'id="menu-Componentsone-'.$value['menus_id'].'"' :'';
                              
                              $href=($value['submenu']!=array()) ? '#' :base_url($value['menu_url']);

                              $span=($value['submenu']!=array()) ? '<span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span>' :'';

                              $active=($page_menu_id==$value['menus_id']) ? 'active':'';
                            
                            ?>

                            <li <?php echo $collapsed;?>>
                                <a class="m-link <?php echo $active;?>" <?php echo $data_bs_toggle;?> <?php echo $data_bs_target;?> href="<?php echo $href;?>"><i
                                        class="<?php echo $value['icon_html_code'];?>"></i> <span><?php echo $value['menu_name'];?></span> <?php echo $span;?></a>
                             
                               <?php 
                                 if($value['submenu']!=array()){  
                                ?>
                                    <ul class="sub-menu collapse" <?php echo $idArr;?>>
                                        <?php 
                                        foreach ($value['submenu'] as $key => $sub_value) {
                                            if($sub_value!=array()){
                                            ?>
                                             <li><a class="ms-link" href="<?php echo base_url($sub_value['menu_url']);?>"><?php echo $sub_value['menu_name'];?> </a></li>
                                            <?php
                                            }
                                         }
                                        ?>
                                    </ul>
                            <?php } ?>
                            </li>

                            <?php
                           }
                        }
                       }
                     ?>



               
                </ul>
              
            </div>
        </div>
             <div class="main px-lg-4 px-md-4">


<script>

    var header = document.getElementById("sidebar_nav");  
// console.log('header=>', header);

    var btns = header.getElementsByClassName("m-link"); 
// console.log('btns=>', btns);

// console.log('btns length=>', btns.length);

    for (var i = 0; i < btns.length; i++) {  
// console.log('for loop');

      btns[i].addEventListener("click", function() {  
// console.log('click=>');
          var current = document.getElementsByClassName("active");  
// console.log('current=>', current);

// console.log('current length=>', current.length);


          if (current.length > 0) {   
            console.log('if');
            current[0].className = current[0].className.replace(" active", "");  
          }  
          this.className += " active";  
      });  
    }  

// document.querySelectorAll(".m-link").forEach((ele) =>
//   ele.addEventListener("click", function (event) {
//     event.preventDefault();
//     document
//       .querySelectorAll(".m-link")
//       .forEach((ele) => ele.classList.remove("active"));
//     this.classList.add("active")
//   })
// );
</script>
