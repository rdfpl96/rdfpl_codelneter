 <?php


 if($mostSoldProducts!=0){
 ?>

 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    <div class="card">
         <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
            <h6 class="m-0 fw-bold">Most Sold Products</h6>
        </div>
         <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
        <table class="table border-bottom-1" style="text-align:center;">
            <thead>
            <tr>
            	<?php foreach ($mostSoldProducts as $key => $value) { ?>
            		<th><?php echo strtoupper($value->pro_product_name);?></th>
            	<?php } ?>
            </tr>
        </thead>
        <tbody>
            <tr>
            	<?php foreach ($mostSoldProducts as $key => $value1) { ?>
            		<td><span class="fs-6 fw-bold me-2"><?php echo strtoupper($value1->total_sold);?></span></td>
            	<?php } ?>
            </tr>
        </tbody>
        </table>
    </div>
    </div>
</div>
<?php } ?>