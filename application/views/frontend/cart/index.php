<?php
// print_r($products);
// exit;
?>
<?php $this->load->view('frontend/header'); ?>
<main class="main">
   <!-- Modal -->
  
   <div class="container mb-80 mt-30">
        <div class="row">
            <div class="col-lg-9 mb-10">
                <h3 class="heading-2 mb-10">Your Basket</h3>
            </div>
        </div>
        <div id="cartlist">
            <?php echo $cartviews ;?>
        </div>
        

        <div class="row mt-60 cart_products">
            <?php if(count($saveProducts) > 0) { ?>
            <div class="col-12">
                <h3 class="mb-30 pt-30">Save For Later</h3>
            </div>
            <div class="co-12">
                <div class="row related-products">
                    <?php echo $this->load->view("frontend/component/productItem_checkout", array('productItems' => $saveProducts), true); ?>
                    
                </div>
            </div>
            <div class="custom_hr"></div>
            <?php } ?>

            <div class="col-12">
                <h3 class="mb-30 pt-30">Before you checkout</h3>
            </div>
            <div class="co-12">
                <div class="row related-products">
                    <?php echo $this->load->view("frontend/component/productItem_checkout", array('productItems' => $beforeCheckProducts,'pcol'=>5), true); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('frontend/footer'); ?>
