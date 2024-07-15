 <?php
$this->load->view('frontend/header',$data);
?>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Refund & Cancellation Policy
                </div>
            </div>
        </div>
        <div class="page-content pt-50">

            <div class="container">
                <div class="totall-product">
                    <h2>Refund & Cancellation Policy</h2>
                </div>
                 <div><?php  echo ($policy_details!=0) ? $policy_details[0]->refund_and_cancelation_policy :'';?></div>
            </div>
         
        </div>
    </main>
<?php
$this->load->view('frontend/footer',$data);
?>    