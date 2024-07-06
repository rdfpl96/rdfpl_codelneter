
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
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
  font-family: var(--title-font);
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
  font-family: var(--body-font);
  margin: 0 0 18px 0;
  color: var(--body-color);
  line-height: 1.571;
}


  </style>
  <body style="width:50%; border:2px solid black;padding: 2%; margin-left: auto; margin-right: auto;">
    <div class="invoice-container-wrap">
      <div class="invoice-container">

        <?php
//       echo "<pre>";
//       print_r($ordManage[0]->order_customer_remark);
//       echo "</pre>";
// exit;
      // echo "<pre>";
      // print_r($order);
      // echo "</pre>";
        ?>
        
                    <table class="table" style="text-align: center; width: 100%;">
                       <tr><td>Govind Kolte Foods Private Limited</td></tr>
                       <tr><td>
                        <!-- <b>Mahalaxmi Sweets & Namkeen</b> -->
                        <p><?php  echo $this->my_libraries->getContactDetails('address');?></p>
                        <!-- <p>#5, Shilpali CHSL, Opp.Aaradhana Cinema</p>
                        <p>Panch Pakhadi, Thane(W)</p>
                        <p> Thane- 4006032, Maharashtra, India</p> -->
                       </td>
                       </tr>
                    </table>

                     <table class="table" style="text-align: center; width: 100%;">
                      <tr>
                        <td><b style="font-size:18px;">Packing Slip</b></td>
                      </tr>
                    </table>

                    <table class="table" style="text-align: center; width: 100%;">
                      <tr>
                        <td>
                          <p><b>Order No : <?php echo $ordManage[0]->order_generated_order_id;?></b></p>
                          <p><b>Order Dt : <?php echo date('d/m/Y',strtotime($ordManage[0]->order_date));?></b></p></td>
                      </tr>
                    </table>

                     <table class="table" style="text-align: left; width: 100%;">
                      <tr>
                        <td>
                            <p><b><?php echo $ordManage[0]->order_name;?>,</b></p>
                            <p><b><?php echo $ordManage[0]->order_address;?></b></p>
                            <p><b><?php echo $ordManage[0]->order_city;?></b></p>
                            <p><b><?php echo $ordManage[0]->order_landmark;?></b></p>
                            <p><b>State : <?php echo $ordManage[0]->order_state;?></b></p>
                        </td>
                      </tr>
                      <?php if($ordManage[0]->order_customer_remark!="") { ?>
                           <tr><td><b>Remarks :</b> <?php echo $ordManage[0]->order_customer_remark;?></td></tr>
                         <?php } ?>
                    </table>

                     <table class="table" style="width: 100%;">
                      <tr style="border:1px solid black;">
                        <td style="border: 1px solid black;">Sr.No</td>
                        <td style="border: 1px solid black;">Product name</td>
                        <td style="border: 1px solid black;">HSN Code</td>
                        <td style="border: 1px solid black;">UOM</td>
                        <td style="border: 1px solid black;">Qty</td>
                        
                        <td style="border: 1px solid black;">Alt Qty</td>
                      </tr>

                     <?php
                     if($order!=0){
                      $qtyValue=0;
                      foreach ($order as $key => $value) {
                         $qtyValue+=$value->pro_product_qty;

      //                    echo "<pre>";
      // print_r($value->packsize);
      // echo "</pre>";

      // exit;
                       ?>
                        <tr style="border:1px solid black;">
                         <td style="border: 1px solid black;"><?php echo $key+1;?></td>
                         <td style="border: 1px solid black;"><?php echo $value->pro_product_name;?></td>
                         <td style="border: 1px solid black;"><?php echo $value->pro_hsn_code;?></td>
                        <td style="border: 1px solid black;"><?php echo $value->packsize.''.$value->units;?></td>
                         <td style="border: 1px solid black;"><?php echo $value->pro_product_qty;?></td>
                         <td style="border: 1px solid black;"><?php echo $value->pro_product_qty;?></td>
                      </tr>
                       <?php
                      }
                     }
                     ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black;">Total</td>
                        <td style="border: 1px solid black;"><?php echo $qtyValue;?></td>
                      </tr>
                    </table>


                    <table class="table" style="width: 100%;">
                      <tr>
                        <td>Notes:</td>
                      </tr>
                      <tr>
                        <td>__________________________________________</td>
                      </tr>
                      <tr>
                        <td>__________________________________________</td>
                      </tr>
                      <tr>
                        <td>__________________________________________</td>
                      </tr>
                    </table>


                   <table class="table" style="width: 100%;">
                      <tr>
                        <td>Packed By:</td>
                      </tr>
                      <tr><td>__________________________________________</td></tr>
                    </table>

          </div>
    </div>
  </body>
  
  </html>