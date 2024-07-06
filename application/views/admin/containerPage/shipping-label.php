
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"> -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  </head>
  <style type="text/css">
.text-right {
  text-align: right;
}

hr {
  margin: 0px !important;
}

p {
  margin-bottom: 0px !important;
  font-size: 14px;
}



body {
  font-family: 'Poppins';
  font-size: 14px;
  font-weight: 400;
  color: var(--body-color);
  line-height: 22px;
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
}

ul {
  list-style-type: disc;
}

ol {
  list-style-type: decimal;
}

table {
  margin: 0 0 1.5em;
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
}

th {
  font-weight: 700;
  color: var(--title-color);
}

td,th {
  padding: 9px 12px;
}

p {
  font-family: 'Poppins';
  margin: 0 0 18px 0;
  color: var(--body-color);
  line-height: 1.571;
}

</style>
  <body>
    <div class="invoice-container-wrap">
      <div class="invoice-container" style="border:3px solid black;padding: 1%; margin-left: auto; margin-right: auto;">

        <?php
         // echo "<pre>";
         // print_r($ordManage[0]->bill_order_alt_address);
         // echo "<pre>";

         // exit;

        ?>
                    <table class="table" style="text-align: left; width: 100%;">
                       <tr>
                          <td>
                             <b>To,</b><br>
                             <b><?php echo $ordManage[0]->order_name;?></b>
                             <p><?php echo $ordManage[0]->order_address;?></p>
                             <p><?php echo $ordManage[0]->order_alt_address;?></p>
                             <!-- <p><?php echo $ordManage[0]->order_city;?></p> -->
                             <p> <?php echo $ordManage[0]->order_city;?>- <?php echo $ordManage[0]->order_pincode;?>, <?php echo $ordManage[0]->order_state;?>, <?php echo $ordManage[0]->order_country;?></p>
                             <p><?php echo $ordManage[0]->order_landmark;?></p>
                             <p> Contact- +91-<?php echo $ordManage[0]->order_mobile_no;?></p>
                         </td>
                       </tr>
                        <tr>
                        <td style="width: 50%;">
                          <table class="table" style="width: 50%;">
                            <tr>
                              <td style="border:2px solid black;text-align: center;">
                              <!-- MESSAGE (Optional)  -->
                              <?php
                                if($ordManage[0]->order_customer_greating==""){
                                  echo '<br>';
                                }else{
                                   echo $ordManage[0]->order_customer_greating; 
                                 }
                               ?>
                            </td>
                            </tr>
                          </table>
                         
                       </td>
                       <?php 
                       if($ordManage[0]->same_address_delivery==0) {
                         if($ordManage[0]->bill_order_name!="" && $ordManage[0]->bill_order_address!="" && $ordManage[0]->bill_order_city!="" && $ordManage[0]->bill_order_pincode!="" && $ordManage[0]->bill_order_state!="" && $ordManage[0]->bill_order_country!="" && $ordManage[0]->bill_order_mobile_no!=""){
                        ?>
                          <td style="width: 50%;">
                            <b>From,</b><br>
                            <b><?php echo $ordManage[0]->bill_order_name;?></b>
                            <p><?php echo $ordManage[0]->bill_order_address;?></p>
                             <p><?php echo $ordManage[0]->bill_order_alt_addres;?></p>
                            
                            <p> <?php echo $ordManage[0]->bill_order_city;?>- <?php echo $ordManage[0]->bill_order_pincode;?>, <?php echo $ordManage[0]->bill_order_state;?>, <?php echo $ordManage[0]->bill_order_country;?></p>
                            <p><?php echo $ordManage[0]->bill_order_landmark;?></p>
                            <p> Contact- +91-<?php echo $ordManage[0]->bill_order_mobile_no;?></p>
                         </td>
                       <?php  } }  ?>
                       </tr>

                    </table>
                     <hr>
                     <table class="table" style="text-align: left; width: 100%;">
                       <tr>
                          <td style="width: 70%;">
                            <b>Packed & Couriered By,</b>
                            <p>Govind Kolte Foods Private Limited</p>
                            <p><?php  echo $this->my_libraries->getContactDetails('address');?></p>
                            <!-- <p>Mahalaxmi Sweets & Namkeen</p>
                            <p>#5, Shilpali CHSL, Opp.Aaradhana Cinema</p>
                            <p>Panch Pakhadi, Thane(W)</p>
                            <p> Thane- 4006032, Maharashtra, India</p> -->
                            <p> Contact- <?php echo $this->my_libraries->getContactDetails('contact');?></p>
                         </td>
                         <td style="width: 30%;">

                          <table class="table" style="width: 70%;">
                            <tr>
                              <td style="border:2px solid black;text-align: center;">HANDLE WITH CARE</td>
                            </tr>
                          </table>
                          
                         </td>
                    </table>
             </div>
             <span>&nbsp;</span>
             <div class="invoice-container" style="border:3px solid black;padding: 1%; margin-left: auto; margin-right: auto;">

                    <table class="table" style="text-align: center; width: 100%;">
                       <tr><td>Govind Kolte Foods Private Limited <br><?php echo $this->my_libraries->getContactDetails('location');?>, <?php echo $this->my_libraries->getContactDetails('pincode');?></td></tr>
                       <tr><td style="text-decoration-line: underline;font-weight: 600;">To, whomever it may concern</td></tr>

                       <tr><td>This parcel contains food packets (Sweets & Namkeen)<br>
                        It is not for resale & has commercial value &#8377; 0 /-<br>It is safe for transit by road, sea & air 
                      </td>
                    </tr>
                    </table>
                    
                      <table class="table" style="text-align: left; width: 100%;">
                       <tr>
                         <td><b style="font-weight: 600;">For,<br>Govind Kolte Foods Private Limited</b></td>
                      </tr>
                     </table>

             </div>
    </div>
  </body>
  
  </html>