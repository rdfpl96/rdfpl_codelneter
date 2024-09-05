// var base_url=$('.base_url').val();

// $(function() {

//   var url = window.location.pathname;
//   var filename = url.substring(url.lastIndexOf('/')+1);

// if(filename=='product_order'){
//   // var base_url=$('#base_url').val();
//     var myfinal=setInterval(function(){ 
//        // window.location.reload();
    
//       // $("#trRow").load(window.location + " #trRow");
//        // $("#trRow").load();
//        // var getdivCount=$('.new-ord-count').text();
//      // var getupdatecount=getUpdateCount(base_url);
//      // console.log(getdivCount + ''+getupdatecount );
//      // if(getdivCount!=getupdatecount){
//         // getNewOrders(base_url);
//         // getCountNewOrder(base_url);
//      // }
//      },3000);
//   }
//   // clearInterval(myVar);
// });




 
//  function getNewOrders(base_url){
//     $.ajax({
//       url:base_url+'get-new-orders',
//       type:'POST',
//       success:function(data){
//         $('.new-order-row').html(data)
//         }
//    });
// }

// function getCountNewOrder(base_url){
//   $.ajax({
//       url:base_url+'get-count-new-orders',
//       type:'POST',
//       success:function(data){
//         $('.new-ord-count').text(data);
//         }
//    });

// }




// var url_base=$('.urlClass').val();
//        function validation(id,message){
// 	      $('.'+id+'Err').remove('');
// 	      const countAll = document.querySelectorAll('.'+id+'Err').length;
// 	      if(countAll==0){
		    
// 		    	$('#'+id).after('<p class="'+id+'Err" style="color:red;">'+message+'</p>');
		     
// 	        }
// }

// function removeValidation(id){
// 	$('.'+id+'Err').remove('');
// }

  
    function validation(idName,message,color,className){
		  if(!$('.'+className).hasClass(className)) {
		      $('#'+idName).after('<p class="'+className+'" style="color:'+color+';">'+message+'</p>');
		    }
     }

	function removeValidation(className){
	  $('.'+className).remove();
	}



function loading(attr,displayValue){
  var html_loading='<div class="lds-ring '+attr+'"><div></div><div></div><div></div><div></div></div>';
  $('.'+attr).html(html_loading);
  $('.'+attr).css('display',displayValue);
}

$(document).on('click','.clean-tab-textarea',function(){
   $('#tags-email').tagsinput('removeAll');s
})

$(document).on('click','.checkTypecsss',function(){
   var getCheckValue=$("input[name='checkType']:checked").val();
   var coupon_id=$('#coupon_id').val();
    var email_clone=$('#email-clone').val();
   if(getCheckValue=="individual"){
    $('.group-div').css('display','block');
    $('#tags-email').tagsinput('add', email_clone);
   }else{
    $('.group-div').css('display','none');
    $('#tags-email').tagsinput('removeAll');
   }
   
})



$(document).on('click','.foodHabitate-save',function(){
   
      var food_habitat=$('#food-habitat').val();
      var food_id=$('#get-food-id').val();
        // console.log('ccc=>',cat_id);

      if(food_habitat=="" || food_habitat==null){
      	  validation('food-habitat','Enter your food habitats.','red','food-habitat-error');
          return false;
       }else{
       	  removeValidation('food-habitat-error');
         var status=1;
        }

       if(status==1){
         loading('loaderdiv','block');
        $('.food-cl').removeClass('foodHabitate-save');
	       $.ajax({ 
	            type: "POST",
	            dataType:"JSON",
	            url: base_url+'ajax_function/foodHabitats_ajax',
	            data:({food_habitat:food_habitat,food_id:food_id}),
	            success: function(result){
                   
                    if(result.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: result.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                    document.location.href=base_url+'admin/food_habitats';
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: result.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.food-cl').addClass('foodHabitate-save');
                               });
                            
                          }


                     loading('loaderdiv','none');
                    
	             }
	         });
         }
})



$(document).on('click','.units-save',function(){
   
      var units=$('#units').val();
      var units_id=$('#get-units-id').val();
        // console.log('ccc=>',cat_id);

      if(units=="" || units==null){
          validation('units','Enter your units.','red','units-error');
          return false;
       }else{
          removeValidation('units-error');
         var status=1;
        }

       if(status==1){
         loading('loaderdiv','block');
        $('.un-cl').removeClass('units-save');


         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/units_ajax',
              data:({units:units,units_id:units_id}),
              success: function(result){

                    if(result.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: result.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                     document.location.href=base_url+'admin/units_manage';
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: result.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.un-cl').addClass('units-save');
                               });
                            
                          }

                    

                     loading('loaderdiv','none');
                    

               }
           });
         }
})


$(document).on('click','.period-save',function(){

      var period=$('#period').val();
      var period_id=$('#get-period-id').val();
      //   // console.log('ccc=>',cat_id);


      if(period=="" || period==null){
          validation('period','Enter your period type.','red','period-error');
          return false;
       }else{
          removeValidation('period-error');
         var status=1;
        }

        // alert(period);
       if(status==1){

         loading('loaderdiv','block');
        $('.per-bt').removeClass('period-save');

         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/period_type_ajax',
              data:({period:period,period_id:period_id}),
              success: function(result){

                if(result.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: result.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                   document.location.href=base_url+'admin/period_type';
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: result.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.per-bt').addClass('period-save');
                               });
                            
                          }

                  

                    
                     loading('loaderdiv','none');
               }
           });
         }
})


$(document).on('click','.cate-save',function(){

      var formData = new FormData($('#catForm')[0]);
     var category=$('#category').val();
     var cat_id=$('#get-cat-id').val();

   if(category=="" || category==null){
          validation('category','Enter your category.','red','category-error');
          return false;
       }else{
          removeValidation('category-error');
         var status=1;
        }

    if(status==1){
        loading('loaderdiv','block');
        $('.cat-bt').removeClass('cate-save');

     

         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/category_ajax',
              // data:({category:category,cat_id:cat_id}),
              data: formData,
              processData: false,
              contentType: false,
              success: function(result){
                    if(result.status==1){

                      Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                             document.location.href=base_url+'admin/category';
                          });

                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                          $('.cat-bt').addClass('cate-save');
                           });
                    }

                     loading('loaderdiv','none');
                    

               }
           });


         }

})


$(document).on('click','.sub-cat-save',function(){
      
      var formData = new FormData($('#catForm')[0]);
      var sub_category=$('#sub-category').val();
      var cat_id=$('#get-cat-id').val();
      var sub_cat_id=$('#sub-cat-id').val();

      // alert(sub_cat_id);
      
      if(sub_category=="" || sub_category==null){
          validation('sub-category','Enter your sub category.','red','sub-category-error');
          return false;
       }else{
          removeValidation('sub-category-error');
         var status=1;
        }


        if(status==1){
          loading('loaderdiv','block');
        $('.subcat-bt').removeClass('sub-cat-save');


         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/sub_category_ajax',
              // data:({sub_category:sub_category,cat_id:cat_id,sub_cat_id:sub_cat_id}),
              data: formData,
              processData: false,
              contentType: false,
              success: function(result){
                    if(result.status==1){
                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                             document.location.href=base_url+'admin/sub_category/'+cat_id;
                          });
                     
                     
                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                          $('.subcat-bt').addClass('sub-cat-save');
                           });
                    }

                    loading('loaderdiv','none');
               }
           });


         }

})


$(document).on('click','.ads-save',function(){
    var message=$('#message').val();
   var ads_id=$('#get-ads-id').val();

   if(message=="" || message==null){
          validation('message','Enter your message.','red','message-error');
          return false;
       }else{
          removeValidation('message-error');
         var status=1;
        }

    if(status==1){
       loading('loaderdiv','block');
      $('.ads-cl').removeClass('ads-save');

         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/message_ajax',
              data:({message:message,ads_id:ads_id}),
              success: function(result){
                    if(result.status==1){
                      Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                            document.location.href=base_url+'admin/message';
                          });
                      
                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                             $('.ads-cl').addClass('ads-save');
                           });
                    }

                     loading('loaderdiv','none');
                          

               }
           });


         }
})


$(document).on('click','.action-ads',function(){
   
   $.ajax({ 
            type: "POST",
            dataType:"JSON",
            url: base_url+'ajax_function/active_ads_ajax',
            // data:({message:message,ads_id:ads_id}),
            success: function(result){

              if(result.status==1){
                      Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                          
                          });
                      
                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                            
                           });
                    }
                  
             }
         });


})



$(document).on('click','.adss-status',function(){

   var ads_id=$(this).data('id');
     $.ajax({ 
            type: "POST",
            dataType:"JSON",
            url: base_url+'ajax_function/set_default_message',
            data:({ads_id:ads_id}),
            success: function(result){
              if(result.status==1){
                 location.reload();
               }
            }
     });
})

// $(document).on('click','.shipdress-mobile',function(){
//    var addre_id=$('.shipdress-mobile:checked').val();
//    updateShippingAddr(addre_id);
// })

// function updateShippingAddr(addre_id){

// }


$(document).on('click','.login-admin',function(event){

   event.preventDefault();
     var username=$('#username').val();
     var userpassword=$('#userpassword').val();
     
      if(username=="" || username==null){
          validation('username','Field is required.','red','username-error');
          return false;
        }else{
          removeValidation('username-error');
          status=1;
        }


         if(userpassword=="" || userpassword==null){
          validation('userpassword','Field is required.','red','userpassword-error');
          return false;
        }else{
          removeValidation('userpassword-error');
          status=1;
        }


       if(status==1){

                    loading('loaderdiv','block');
                   $('.log-cl').removeClass('login-admin');

                   $.ajax({
                             url:base_url+'ajax_function/admin_login',
                             type:'POST',
                             dataType:'JSON',
                             data:({username:username,userpassword:userpassword}),
                             success:function(data){

                                  if(data.status==1){
                                       Swal.fire({
                                            position: 'top-end',
                                            // icon: 'success',
                                            title: data.message,
                                            showConfirmButton: false,
                                            color:'white',
                                            background: '#689F39',
                                            timer: 3000
                                               }).then((result) => {
                                                  document.location.href=base_url+"admin/dashboard";
                                              });
                                      
                                  }else{
                                     Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 3000
                                           }).then((result) => {
                                          $('.log-cl').addClass('login-admin');
                                         });
                                  }

                                   loading('loaderdiv','none');
                                 


                             }

                             
                           });

                }
     // alert('hiiii');
  });







$(document).on('click','.cate-stock-status',function(){
        var status='';
    if($(this).is(':checked')){
        status=1;
    }else{
        status=0;
    }
// alert('dd');
     var value=$(this).data('id');
        $.ajax({
            url:base_url+'ajax_function/activeStockStatusRow',
            type:'POST',
            dataType:'JSON',
            data:({status:status,value:value}),
            success:function(data){
           
               if(data.status==1){
                    // location.reload();
                }
                
            }
        });
    
  })


$(document).on('click','.cate-sub-stock-status',function(){
        var status='';
    if($(this).is(':checked')){
        status=1;
    }else{
        status=0;
    }
// alert('dd');
     var value=$(this).data('id');
        $.ajax({
            url:base_url+'ajax_function/activeSubStockStatusRow',
            type:'POST',
            dataType:'JSON',
            data:({status:status,value:value}),
            success:function(data){
           
               if(data.status==1){
                    // location.reload();
                }
                
            }
        });
    
  })

$(document).on('click','.product-stock-status',function(){
        var status='';
    if($(this).is(':checked')){
        status=1;
    }else{
        status=0;
    }
// alert('dd');
     var value=$(this).data('id');
     // console.log(value);
        $.ajax({
            url:base_url+'ajax_function/activeProductStockStatusRow',
            type:'POST',
            dataType:'JSON',
            data:({status:status,value:value}),
            success:function(data){
               if(data.status==0){
                    Swal.fire({
                      position: 'top-end',
                      // icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      color:'white',
                      background: '#689F39',
                      timer: 3000
                         }).then((result) => {
                                $('#p'+data.id[0]).prop("checked", false);
                        });
               
                }
                   
            }
        });
    
  })

 



$(document).on('click','.cate-status',function(){
        var status='';
    if($(this).is(':checked')){
        status=1;
    }else{
        status=0;
    }
// alert('dd');
     var value=$(this).data('id');
        $.ajax({
            url:base_url+'ajax_function/activeInactiveStatusRow',
            type:'POST',
            dataType:'JSON',
            data:({status:status,value:value}),
            success:function(data){
           
               if(data.status==1){
                    // location.reload();
                }
                
            }
        });
    
  })


$(document).on('click','.set-default',function(){
        var status='';
    if($(this).is(':checked')){
        status=1;
    }else{
        status=0;
    }

     var value=$(this).data('id');
        $.ajax({
            url:base_url+'ajax_function/slotSetDefault',
            type:'POST',
            dataType:'JSON',
            data:({status:status,value:value}),
            success:function(data){
           
               if(data.status==1){
                    location.reload();
                }
                
            }
        });
    
  })



$('.deleteRowClass').click(function(){

    var value=$(this).data('id');
    if(confirm('Are you sure.Do you want to delete.')){
         $('#loader').css('display','block');
        $.ajax({
            url:base_url+'ajax_function/deleteRowtable',
            type:'POST',
            dataType:'JSON',
            data:({value:value}),
            success:function(data){
                   var alertShow="";
                   var alert="";
                if(data.status==1){
                      alertShow=data.message;
                      alert='alert-success';
                    location.reload();
                }else{
                    alertShow=data.message;
                    alert='alert-danger';
               } 
              var html='<div class="alert '+alert+' alert-dismissible fade show" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                           '</button>'+
                            '<strong>Thank you!</strong> '+alertShow+
                        '</div>';

                               setTimeout(function(){
                                    $(".message").fadeOut();
                                    }, 1500);
                                  
                                  $('.message').html(html).fadeIn();         
                                $('#loader').css('display','none');
            }

        });

    }
  
  });


$(document).on('change','.category-action',function(){
      var category_id=$(this).val();
      $.ajax({
            url:base_url+'ajax_function/getSubCategory_byCatId',
            type:'POST',
            dataType:'JSON',
            data:({category_id:category_id}),
            success:function(result){
                var html="";
                html +='<option value="">-Select-</option>';
                if(result.data.length!=0){
                   result.data.forEach(function(value,index){
                     html +='<option value="'+value.sub_cat_id+'">'+value.subCat_name+'</option>';
                   })
                }

                $('.sub-category-action').html(html);
            }

          });
})


$(document).on('click','.add-more',function(){
  var increment=$('#increment').val();
      increment++;
    $('#increment').val(increment);
     var html='<tr class="add-tr'+increment+'">'+
            '<td class="tbl-td">'+
            '<div class="row">'+
                '<div class="col-sm-11">'+
                  '<input type="hidden" id="disc-id'+increment+'" name="input_disc_id[]" value="">'+
                  '<input type="text" class="form-control" id="heading'+increment+'" placeholder="Heading" name="heading[]">'+
                '</div>'+
                '<div class="col-sm-1">'+
                 '<button type="button" class="btn btn-danger remove-btn" data-id="'+increment+'">-</button>'+
               '</div>'+
            '</div>'+
             '<textarea class="form-control" id="description'+increment+'" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>'+
           '</td>'+
       '</tr>';
    $('.add-tr').before(html);

  // alert('hiiii');
})






$(document).on('click','.add-more-varients',function(){
  
   $.ajax({
            url:base_url+'ajax_function/getUnits',
            type:'POST',
            dataType:'JSON',
            success:function(result){

          var increment=$('#increment_varients').val();
              increment++;
            $('#increment_varients').val(increment);

             var getUnits= $('#units1').val();

              var splitv=getUnits.split('__');

             // console.log(getUnits);

             var html='<tr class="add-tr-varients'+increment+'">'+
                         '<td>'+
                         ' <input type="hidden" name="variant_id[]" class="variant_id" id="variant_id'+increment+'" value="">'+
                            '<input type="hidden" name="inc_num[]" id="inc_num'+increment+'" value="'+increment+'">'+
                            ' <input type="hidden" class="ext_sku_id" name="ext_sku_id[]" id="ext_sku_id'+increment+'" value="">'+
                            '<input type="text" class="form-control sku-class" id="sku-id'+increment+'" name="sku_id[]" value="">'+
                          '</td>'+
                          '<td>'+
                            '<input type="number" class="form-control packSize-class" name="pack_size[]" id="pach-size'+increment+'" data-id="'+increment+'" value=""  readonly="readonly">'+
                          '</td>'+
                          '<td>'+
                          '<select type="text" class="form-control units-class" data-id="'+increment+'" id="units'+increment+'" name="units[]"><option value="">-Select-</option>';
                               // console.log(result);
                               result.forEach(function(value,index){
                                
                                var selected=(value.units_name==splitv[1]) ?'selected' :'';

                            html +='<option value="'+value.units_id+'__'+value.units_name+'" '+selected+'>'+value.units_name+'</option>';
                            
                           });

                      html += '</select>'+
                        '</td>'+
                          '<td>'+
                            '<input type="number" class="form-control price-class" name="price[]" id="price'+increment+'" value="">'+
                          '</td>'+
                          '<td>'+
                            '<input type="number" class="form-control price-class" name="beforeOffprice[]" id="beforeOffprice'+increment+'" value="">'+
                          '</td>'+
                          '<td>'+
                            '<input type="number" class="form-control stock-class" name="stock[]" id="stock'+increment+'" value="">'+
                          '</td>'+
                          //  '<td>'+
                          //   '<input type="number" class="form-control conv-class" name="conversion_factor[]" id="conversion-factor'+increment+'" value="">'+
                          // '</td>'+
                           '<td>'+
                             '<button type="button" class="btn btn-danger remove-more-varients" data-id="'+increment+'__none">-</button>'+
                          '</td>'+
                     '</tr>';

 // console.log(html);
            $('.add-tr-varients').before(html);
            
            if(getUnits!=""){
              document.getElementById('pach-size'+increment).readOnly  = false;
             }

  }

});

  // alert('hiiii');
})


    $(document).on('click','.remove-more-varients',function(){
     var getid=$(this).data('id');

     var splitValue=getid.split('__');
      // console.log(splitValue[1]);
      if(splitValue[1]!="none"){

          if(confirm('Are you sure. Do you want to delete?')){   
          $.ajax({
                url:base_url+'ajax_function/deleteRowtable',
                type:'POST',
                dataType:'JSON',
                data:({value:splitValue[1]}),
                success:function(data){
                  $('.add-tr-varients'+splitValue[0]).remove();
                 }
              })
        }

    }else{
       $('.add-tr-varients'+splitValue[0]).remove();
    }

})



$(document).on('keyup','#igst,#sgst,#cgst',function(){
 
   var igst=$('#igst').val();
   var cgst=$('#cgst').val();
   var sgst=$('#sgst').val();

   if(igst=="" || sgst=="" || cgst==""){
   }else{

       var igst_number=Number(igst);
       var cgst_number=Number(cgst);
       var sgst_number=Number(sgst);

       var addition_gst=cgst_number + sgst_number;

            if(addition_gst!=igst_number){
              removeValidation('gstErr-error');
                validation('gstErr','invalid GST.','red','gstErr-error');
                return false;
            }else{
                removeValidation('gstErr-error');
              }
    }


})


   $(document).on('keyup','.packSize-class',function(){
      
      var get_data_id=$(this).data('id');
      var get_packsize=$(this).val();
      var units=$('#units'+get_data_id).val();
      if(units=="" || units==null){
         $('#units'+get_data_id).css('border','1px solid red');
         return false;
      }else{
         $('#units'+get_data_id).css('border','1px solid #CCCCCC');
      }

      // if(units=='Kg'){
      //  var kg= get_packsize;
      //   $('#conversion-factor'+get_data_id).val(kg);
      // }


      // if(units=='Gram'){
      //  var kg= get_packsize/1000;
      //   $('#conversion-factor'+get_data_id).val(kg);
      // }

   })


$(document).on('change','.units-class',function(){
      var get_data_id=$(this).data('id');
      var units=$('#units'+get_data_id).val();
      var get_packsize=$('#pach-size'+get_data_id).val();


      if(units=="" || units==null){
        document.getElementById('pach-size'+get_data_id).readOnly  = true;
        $('#pach-size'+get_data_id).val('');
        $('#conversion-factor'+get_data_id).val('');
      }else{
        document.getElementById('pach-size'+get_data_id).readOnly  = false;
      }

      //  if(units=='Kg'){
      //  var kg= get_packsize;
      //   console.log(kg);
      //   $('#conversion-factor'+get_data_id).val(kg);
      // }


      // if(units=='Gram'){
      //  var kg= get_packsize/1000;
      //   $('#conversion-factor'+get_data_id).val(kg);
      // }


      // if(units=='Pices'){
      //  // var kg= get_packsize/1000;
      //   $('#conversion-factor'+get_data_id).val('');
      // }

      //  if(units=='Package'){
      //  // var kg= get_packsize/1000;
      //   $('#conversion-factor'+get_data_id).val('');
      // }



})


$(document).on('click','.edit-variants',function(){

  var variant_id=$(this).data('id');


  var sku_id=$('#sku-id'+variant_id).val();
  var pach_size=$('#pach-size'+variant_id).val();
  var units=$('#units'+variant_id).val();
  var price=$('#price'+variant_id).val();
  var beforeOffprice=$('#beforeOffprice'+variant_id).val();
  var stock=$('#stock'+variant_id).val();
  // var conversion_factor=$('#conversion-factor'+variant_id).val();
  
   var ext_sku_id=$('#ext_sku_id'+variant_id).val();
  


        if(sku_id=="" || sku_id==null){
          $('#sku-id'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#sku-id'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


         if(pach_size=="" || pach_size==null){
          $('#pach-size'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#pach-size'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


         if(units=="" || units==null){
          $('#units'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#units'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

           if(price=="" || price==null){
          $('#price'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#price'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


        if(stock=="" || stock==null){
          $('#stock'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#stock'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

        // if(conversion_factor=="" || conversion_factor==null){
        //   $('#conversion-factor'+variant_id).css('border','1px solid red');
        //   return false;
        // }else{
        //    $('#conversion-factor'+variant_id).css('border','1px solid #CCCCCC');
        //    status=1;
        // }


    if(status==1){

           $.ajax({
            url:base_url+'ajax_function/edit_Variants',
            type:'POST',
            dataType:'JSON',
            data:({
              variant_id:variant_id,
              sku_id:sku_id,
              pach_size:pach_size,
              units:units,
              price:price,
              beforeOffprice:beforeOffprice,
              stock:stock,
              conversion_factor:'',
              ext_sku_id:ext_sku_id
            }),
            success:function(data){


              if(data.status==1){

                     Swal.fire({
                      position: 'top-end',
                      // icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      color:'white',
                      background: '#689F39',
                      timer: 3000
                         }).then((result) => {
                            location.reload();
                        });
                     
                  }else{
                     Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 3000
                         }).then((result) => {
                        // location.reload();
                       });
                    
                  }
                
                  // if(result.status==1){
                  //     alert(result.message);
                  //    location.reload();
                  // }else{
                  //   alert(result.message);
                  // }


            }

          });
    }


})





// function getInputMore(increment){
//   var html='<tr class="add-tr'+increment+'">'+
//             '<td class="tbl-td">'+
//             '<div class="row">'+
//                 '<div class="col-sm-11">'+
//                   '<input type="text" class="form-control" id="heading'+increment+'" placeholder="Heading" name="heading[]">'+
//                 '</div>'+
//                 '<div class="col-sm-1">'+
//                  '<button type="button" class="btn btn-danger remove-btn" data-id="'+increment+'">-</button>'+
//                '</div>'+
//             '</div>'+
//              '<textarea class="form-control" id="description'+increment+'" name="description[]" placeholder="Description" style="margin-bottom: 6px;"></textarea>'+
//            '</td>'+
//        '</tr>';
//        return html;
// }


   $(document).on('click','.remove-btn',function(){
     var getid=$(this).data('id');
     var getdisc_id=$('#disc-id'+getid).val();
    $.ajax({
            url:base_url+'ajax_function/delete_description',
            type:'POST',
            data:({getdisc_id:getdisc_id}),
            success:function(result){
              $('.add-tr'+getid).remove();

            }

          });




  // $('.add-tr'+getid).remove();

})



$(document).on('click','.save-product',function(){
    
     var formData = new FormData($('#form-product')[0]);  
     var product_id=$('#product_id').val();
     var product_verients=$('#product_verients').val();
     var quickDesc=$('#quickDesc').val();

     // var sku_id=$('input[name="sku_id[]"]').
     var inc_num=$('input[name="inc_num[]"]').map(function(){
                  return this.value;
           }).get();

      var sku_id=$('input[name="sku_id[]"]').map(function(){
                  return this.value;
           }).get();

      var pack_size=$('input[name="pack_size[]"]').map(function(){
                  return this.value;
           }).get();

      var units=$('input[name="units[]"]').map(function(){
                  return this.value;
           }).get();

       var price=$('input[name="price[]"]').map(function(){
                  return this.value;
           }).get();

        var beforeOffprice=$('input[name="beforeOffprice[]"]').map(function(){
                  return this.value;
           }).get();


        var keywords=$('input[name="search_keywords[]"]').map(function(){
                  return this.value;
           }).get();
        
         var delivery_palce=$('input[name="delivery_palce[]"]:checked').map(function(){
                  return this.value;
           }).get();

        // var conversion_factor=$('input[name="conversion_factor[]"]').map(function(){
        //           return this.value;
        //    }).get();


      // var delivery_palce=$('input[name="delivery_palce[]"]:checked').map(function(){
      //             return this.value;
      //      }).get();

      // var food_habit=$('input[name="food_habit[]"]:checked').map(function(){
      //             return this.value;
      //      }).get();


       
      // console.log(delivery_palce);
       var item_code=$('#item-code').val();
       if(item_code=="" || item_code==null){
         $('#item-code').css('border','1px solid red');
          // validation('item-code','Field is required.','red','item_code-error');
          return false;
        }else{
          $('#item-code').css('border','1px solid #CCCCCC');
          // removeValidation('item_code-error');
          status=1;
        }

       var product_name=$('#product-name').val();
       if(product_name=="" || product_name==null){
        $('#product-name').css('border','1px solid red');
          // validation('product-name','Field is required.','red','product_name-error');
          return false;
        }else{
             $('#product-name').css('border','1px solid #CCCCCC');
          // removeValidation('product_name-error');
          status=1;
        }



        var cat_id=$('input[name="category_id[]"]:checked').map(function(){
                  return this.value;
           }).get();

        var subCat_id=$('input[name="subCategory[]"]:checked').map(function(){
                  return this.value;
           }).get();

        var childCat_id=$('input[name="childCategory[]"]:checked').map(function(){
                  return this.value;
           }).get();

        // console.log('cat_id->',cat_id);
        //  console.log('subCat_id->',subCat_id);
        //   console.log('childCat_id->',childCat_id);


    if(cat_id.length!=0){ 
       var collectArr=[];
          cat_id.forEach(function(value,index){
                 var collectAction=[];
                 subCat_id.forEach(function(value_aciton,index_action){
                             var splitValue=value_aciton.split(':::');
 
                             if(splitValue[0]==value){
                                 collectAction.push(splitValue[1]);
                             }
                      });

                collectArr.push({cat_id:value,subCate_id:collectAction});
          });
           var arrvali=[];
           collectArr.forEach(function(subvA,sub_ind){
            $('.uldiv'+subvA.cat_id).addClass('show');
              if(subvA.subCate_id.length==0){
                 arrvali.push(0);
              }
           });

           // console.log('arrvali->',arrvali);

           if(arrvali.includes(0)){

                Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: 'Select your sub category input.',
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                          $('.pro-ad').addClass('save-product');
                           });
              
               return false;
            }

          status=1;
     }else{

       Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Select your category input',
              showConfirmButton: false,
              timer: 2000
                 }).then((result) => {
              $('.pro-ad').addClass('save-product');
               });

       return false;
     }




    // console.log(cat_id);
    // console.log(subCat_id);
    // console.log(collectArr);

       //  var cat_id=$('#cat-id').val();
       // if(cat_id=="" || cat_id==null){
       //    validation('cat-id','Field is required.','red','cat-id-error');
       //    return false;
       //  }else{
       //    removeValidation('cat-id-error');
       //    status=1;
       //  }
       

       // var sub_cat_id=$('#sub_cat_id').val();
       // if(sub_cat_id=="" || sub_cat_id==null){
       //    validation('sub_cat_id','Field is required.','red','sub_cat_id-error');
       //    return false;
       //  }else{
       //    removeValidation('sub_cat_id-error');
       //    status=1;
       //  }




            var hsn_code=$('#gsearchsimple').val();
            if(hsn_code=="" || hsn_code==null){
                   $('#gsearchsimple').css('border','1px solid red');
              // removeValidation('gstErr-error');
              // validation('gsearchsimple','Field is required.','red','hsn_code-error');
              return false;
            }else{
                 $('#gsearchsimple').css('border','1px solid #CCCCCC');
              // removeValidation('hsn_code-error');
              status=1;
            }

             var igst=$('#igst').val();
                if(igst=="" || igst==null){
                     $('#igst').css('border','1px solid red');
                  // removeValidation('gstErr-error');
                  // validation('gstErr','Field is required.','red','gstErr-error');
                  return false;
                }else{
                    $('#igst').css('border','1px solid #CCCCCC');
                  // removeValidation('gstErr-error');
                  status=1;
                }

             var cgst=$('#cgst').val();
            if(cgst=="" || cgst==null){
                  $('#cgst').css('border','1px solid red');
              // removeValidation('gstErr-error');
              // validation('gstErr','Field is required.','red','gstErr-error');
              return false;
            }else{
                $('#cgst').css('border','1px solid #CCCCCC');
              // removeValidation('gstErr-error');
              status=1;
            }

            

             var sgst=$('#sgst').val();
            if(sgst=="" || sgst==null){
                 $('#sgst').css('border','1px solid red');
              // removeValidation('gstErr-error');
              // validation('gstErr','Field is required.','red','gstErr-error');
              return false;
            }else{
                   $('#sgst').css('border','1px solid #CCCCCC');
              // removeValidation('gstErr-error');
              status=1;
            }


             var igst_number=Number(igst);
             var cgst_number=Number(cgst);
             var sgst_number=Number(sgst);

            var addition_gst=cgst_number + sgst_number;
            if(addition_gst!=igst_number){
                 removeValidation('gstErr-error');
                validation('gstErr','invalid GST.','red','gstErr-error');
                return false;
             }else{
                removeValidation('gstErr-error');
                  status=1;
              }


            // console.log(delivery_palce.length);
            // if(delivery_palce.length==0){
            //    validation('checkErr','Please select your delivery type.','red','checkErr-error');
            //    return false;
            // }else{
            //    removeValidation('checkErr-error');
            //    status=1;
            // }
            

            // if(food_habit.length==0){
            //    validation('checkfoodErr','Please select your food habitats.','red','checkfoodErr-error');
            //    return false;
            // }else{
            //    removeValidation('checkfoodErr-error');
            //    status=1;
            // }





            // var uom=$('#uom').val();
            // if(uom=="" || uom==null){
            //   validation('uom','Field is required.','red','uom-error');
            //   return false;
            // }else{
            //   removeValidation('uom-error');
            //   status=1;
            // }

             // var shelf_life=$('#shelf_life').val();
             //  if(shelf_life=="" || shelf_life==null){
             //    validation('shelf_life','Field is required.','red','shelf_life-error');
             //    return false;
             //  }else{
             //    removeValidation('shelf_life-error');
             //    status=1;
             //  }

            
             // var ingredients=$('#ingredients').val();
             //  if(ingredients=="" || ingredients==null){
             //    validation('ingredients','Field is required.','red','ingredients-error');
             //    return false;
             //  }else{
             //    removeValidation('ingredients-error');
             //    status=1;
             //  }
           

            // var period=$('#period').val();
            //   if(period=="" || period==null){
            //     validation('errShef','Field is required.','red','errShef-error');
            //     return false;
            //   }else{
            //     removeValidation('errShef-error');
            //     status=1;
            //   }



           
             // var storage_condition=$('#storage_condition').val();
             //  if(storage_condition=="" || storage_condition==null){
             //    validation('storage_condition','Field is required.','red','storage_condition-error');
             //    return false;
             //  }else{
             //    removeValidation('storage_condition-error');
             //    status=1;
             //  }

               // var tags=$('#tags').val();
              // if(tags=="" || tags==null){
              //   validation('tags','Field is required.','red','tags-error');
              //   return false;
              // }else{
              //   removeValidation('tags-error');
              //   status=1;
              // }


            loading('loaderdiv','block');

          if(status==1){

                formData.append('collectArr', JSON.stringify(collectArr));
            
          $.ajax({
                  url: base_url+'ajax_function/validate_Varients',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                  // console.log(data);
                
                       if(data.status=='vli'){

                            data.validate.forEach(function(value,index){
                              
                                    var sku_id_val=value.sku_id;
                                    if(sku_id_val==0){
                                      $('#sku-id'+value.inc_num).css('border','1px solid red');
                                      return false;
                                    }else{
                                     
                                      $('#sku-id'+value.inc_num).css('border','1px solid #CCCCCC');
                                       status=1;
                                    }


                                   var pack_size_val=value.pack_size;
                                  if(pack_size_val==0){
                                    $('#pach-size'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                   
                                    $('#pach-size'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }


                                   var units_val=value.units;
                                  if(units_val==0){
                                    $('#units'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                   
                                    $('#units'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }

                                  var price_val=value.price;
                                  if(price_val==0){
                                    $('#price'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                   
                                    $('#price'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }


                                  var stock_val=value.stock;
                                  if(stock_val==0){
                                    $('#stock'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                    
                                    $('#stock'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }

                                  // var conversion_factor_val=value.conversion_factor;
                                  // if(conversion_factor_val==0){
                                  //   $('#conversion-factor'+value.inc_num).css('border','1px solid red');
                                  //   return false;
                                  // }else{
                                  
                                  //    $('#conversion-factor'+value.inc_num).css('border','1px solid #CCCCCC');
                                  //    status=1;
                                  // }


                            })


                       }else if(data.status==1){
                             getSubmitProduct(formData,product_id);
                       }
                    loading('loaderdiv','none');
                  }
              });
      }

})



     function getSubmitProduct(formData,product_id){

           if(product_id!=""){
              var urls=base_url+'ajax_function/update_product';
            }else{
              urls=base_url+'ajax_function/add_product';
            }

             loading('loaderdiv','block');
             $('.pro-ad').removeClass('save-product');


         $.ajax({
                  url: urls,
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(result){
                     if(result.status==1){
                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: result.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                   document.location.href=base_url+'admin/product_list';
                                });

                       
                      }else if(result.status=='check_sku'){
                            $('#sku-id'+result.valuesdata.incName).css('border','1px solid red');

                            Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: result.message,
                              showConfirmButton: false,
                              timer: 2000
                                 }).then((result) => {
                              $('.pro-ad').addClass('save-product');
                               });
                          
                      }else{
                        Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                          $('.pro-ad').addClass('save-product');
                           });
                      }

                       loading('loaderdiv','none');
                      
                }
         });
}




                     
       



$(document).on('click','.close-image',function(){
    var get_id=$(this).data('id');
    $('#file-ip-'+get_id).val('');
    $('#image_path'+get_id).val('');
    document.getElementById('file-ip-'+get_id+'-preview').src=base_url+'/include/assets/default_product_image.png'; 
})

$( document ).ready(function() {

  var category_id=$('#get-cat-id').val();
  var get_sub_cat_id=$('#get-sub-cat-id').val();
  

   $.ajax({
            url:base_url+'ajax_function/getSubCategory_byCatId',
            type:'POST',
            dataType:'JSON',
            data:({category_id:category_id}),
            success:function(result){


                var html="";
                html +='<option value="">-Select-</option>';
                if(result.data.length!=0){
                   result.data.forEach(function(value,index){
                        var subcat=(get_sub_cat_id==value.sub_cat_id) ? 'selected':'';
                        html +='<option value="'+value.sub_cat_id+'" '+subcat+'>'+value.subCat_name+'</option>';
                   })
                }

                $('.sub-category-action').html(html);

              // var html='';
              // result.data.forEach(function(value,index){
              // })
              // console.log(result);

            }

          });


})


$(document).on('click','.delete-products',function(){

    var get_id=$(this).data('id');
    if(confirm('Are you sure.Do you want to delete.')){
         $('#loader').css('display','block');
        $.ajax({
            url:base_url+'ajax_function/delete_product',
            type:'POST',
            dataType:'JSON',
            data:({get_id:get_id}),
            success:function(data){
                   var alertShow="";
                   var alert="";
                if(data.status==1){
                      alertShow=data.message;
                      alert='alert-success';
                    location.reload();
                }else{
                    alertShow=data.message;
                    alert='alert-danger';
               } 

                var html='<div class="alert '+alert+' alert-dismissible fade show" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                           '</button>'+
                            '<strong>Thank you!</strong> '+alertShow+
                        '</div>';

                 setTimeout(function(){
                      $(".message").fadeOut();
                      }, 1500);
                    
                    $('.message').html(html).fadeIn();         
                    $('#loader').css('display','none');
                }


        });

    }

    //   $.ajax({
    //         url:base_url+'ajax_function/delete_product',
    //         type:'POST',
    //         dataType:'JSON',
    //         data:({get_id:get_id}),
    //         success:function(result){
    //         }
    //       });
    //     alert(get_id);

})


$(document).on('click','.slot-save',function(){

    var get_date=$('#get-date').val();
    var start_time=$('#start-time').val();
    var end_time=$('#end-time').val();
    var get_slot_id=$('#get-slot-id').val();
     

     if(get_date=="" || get_date==null){
        validation('get-date','Field is required.','red','get-date-error');
        return false;
      }else{
        removeValidation('get-date-error');
        status=1;
      }


      if(start_time=="" || start_time==null){
        validation('start-time','Field is required.','red','start-time-error');
        return false;
      }else{
        removeValidation('start-time-error');
        status=1;
      }

       if(end_time=="" || end_time==null){
        validation('end-time','Field is required.','red','end-time-error');
        return false;
      }else{
        removeValidation('end-time-error');
        status=1;
      }


    if(status==1){

       
          $.ajax({
            url:base_url+'ajax_function/delivery_slot',
            type:'POST',
            dataType:'JSON',
            data:({get_date:get_date,
              start_time:start_time,
              end_time:end_time,
              get_slot_id:get_slot_id}),
            success:function(data){


              if(data.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: data.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                    location.reload();
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                // location.reload();
                               });
                            
                          }

                      
            }
          });



      // alert('hiiii');
    }

})








$(document).on('click','.update-order-status',function(){
  
  var order_status=$('#order-status').val();
  var order_ids =$('#order-ids').val();

  // var take_away_value =$('#take_away_value').val();

  
     var length=$('#length').val();
     var breadth=$('#breadth').val();
     var height=$('#height').val();
     var weight=$('#weight').val();


 if(order_status!='Pending'){

    if(length==null || length==""){
        $('#length').css('border','1px solid red');
        return false;
      }else{
        $('#length').css('border','1px solid #CCCCCC');
        status=1;
      }
  
  if(breadth==null || breadth==""){
        $('#breadth').css('border','1px solid red');
        return false;
  }else{
    $('#breadth').css('border','1px solid #CCCCCC');
    status=1;
  }

   if(height==null || height==""){
    $('#height').css('border','1px solid red');
    return false;
  }else{
    $('#height').css('border','1px solid #CCCCCC');
    status=1;
  }

   if(weight==null || weight==""){
    $('#weight').css('border','1px solid red');
    return false;
  }else{
    $('#weight').css('border','1px solid #CCCCCC');
    status=1;
  }

    
if(status==1){

  loading('loaderdiv','block');

  // if(order_status!='Shipped'){
     $('.und-ot').removeClass('update-order-status');
  //  }
   // take_away_value:take_away_value
   $.ajax({
            url:base_url+'ajax_function/delivery_status',
            type:'POST',
            dataType:'JSON',
            data:({order_ids:order_ids,
                  order_status:order_status,length:length,breadth:breadth,height:height,weight:weight}),
            success:function(data){

                 if(data.status==1){
                     var html = '<div class="alert alert-success" role="alert">'+data.message+'</div>';
                      setTimeout(function() {
                           location.reload();
                      }, 3000 );

                   // Swal.fire({
                   //    position: 'center',
                   //    icon: 'success',
                   //    title: data.message,
                   //    showConfirmButton: false,
                   //    timer: 3000
                   //       }).then((result) => {
                   //         
                   //      });
                // }
                // else if(data.status=='shipped'){
                //     $('#no-of-parcels').val(1);
                //     $('.order-id-div').text(data.values.order_id);
                //     $('#status-value').val(data.values.ord_status);
                //     $('#orders-id').val(data.values.order_id);
                //     $('#myModal_courier').modal('show');

                }else if(data.status=='ready_to_ship'){
                    $('#myModal_courier').modal('show');
                }else{

                 // Swal.fire({
                 //    position: 'center',
                 //    icon: 'error',
                 //    title: data.message,
                 //    showConfirmButton: false,
                 //    timer: 3000
                 //       }).then((result) => {
                 //      $('.und-ot').addClass('update-order-status');
                 //     });

                    var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
                    $('.und-ot').addClass('update-order-status');
                }

                 $('.alertmess').html(html);

             loading('loaderdiv','none');
            }

          });
     }  // status

 } // !Pending

})


$(document).on('click','.ship-now',function(){
  
   var checkvalue = $("input[type='radio'][name='courierCheck']:checked").val();
   var shipment_id = $(this).data('id');
   var status_value=$('#order-status').val();
   loading('loaderdiv-cour','block');
    $.ajax({
            url:base_url+'ajax_function/delivery_status_On_shipped_action',
            type:'POST',
            dataType:'JSON',
            data:({courier_id:checkvalue,
              shipment_id:shipment_id,
              status_value:status_value
             }),
            success:function(data){

                   if(data.status==1){
                     var html = '<div class="alert alert-success" role="alert">'+data.message+'</div>';
                      setTimeout(function() {
                           location.reload();
                      }, 3000 );
                   }else{
                      var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
                   }
                 $('.alertmess_errr').html(html);

                 loading('loaderdiv-cour','none');
            }
        });

   })


$(document).on('click','.schedule-pickup',function(){
  if(confirm('Are you sure. Do you want to schedule courier pickup.')){
    var shipment_id = $(this).data('id');
     if(shipment_id=="" || shipment_id==null){
     }else{
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/schedule_pickup',
            type:'POST',
            dataType:'JSON',
            data:({shipment_id:shipment_id}),
            success:function(data){

              if(data.status==1){
                 var html = '<div class="alert alert-success" role="alert">'+data.message+'</div>';
                  setTimeout(function() {
                       location.reload();
                  }, 3000 );
               }else{
                  var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
               }
             $('.alertmess_perr').html(html);

              loading('loaderdiv-pickup','none');
            }
        });
     }
 }

})


$(document).on('click','.download-manifest',function(){
  
    var shipment_id = $(this).data('id');

     if(shipment_id=="" || shipment_id==null){
     }else{
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/download_manifest',
            type:'POST',
            dataType:'JSON',
            data:({shipment_id:shipment_id}),
            success:function(data){

                   console.log(data);

              // if(data.status==1){
              //    var html = '<div class="alert alert-success" role="alert">'+data.message+'</div>';
              //     setTimeout(function() {
              //          location.reload();
              //     }, 3000 );
              //  }else{
              //     var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
              //  }
             // $('.alertmess_perr').html(html);

              loading('loaderdiv-pickup','none');
            }
        });
     }
 
})



$(document).on('click','.print-manifest',function(){
  
    var order_ids = $(this).data('id');

     if(order_ids=="" || order_ids==null){
     }else{
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/print_manifest',
            type:'POST',
            dataType:'JSON',
            data:({order_ids:order_ids}),
            success:function(data){
              document.location.href=data.downlaodUrl;
              loading('loaderdiv-pickup','none');
            }
        });
     }
 
})

$(document).on('click','.download-label',function(){
  
    var shipment_id = $(this).data('id');

     if(shipment_id=="" || shipment_id==null){
     }else{
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/download_label',
            type:'POST',
            dataType:'JSON',
            data:({shipment_id:shipment_id}),
            success:function(data){
               if(data.status==1){
                 document.location.href=data.downlaodUrl;
                }else{
                   var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
                   $('.alertmess_perr').html(html);
                } 
              loading('loaderdiv-pickup','none');
            }
        });
     }
 
})


$(document).on('click','.download-invoice',function(){

   var order_ids = $(this).data('id');
     if(order_ids=="" || order_ids==null){
     }else{
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/download_invoice',
            type:'POST',
            dataType:'JSON',
            data:({order_ids:order_ids}),
            success:function(data){
              if(data.status==1){
                 document.location.href=data.downloadUrl;
                }else{
                   var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
                   $('.alertmess_perr').html(html);
                } 

              loading('loaderdiv-pickup','none');
            }
        });
     }
})


$(document).on('click','.cancel-shipment',function(){

 if(confirm('Are you sure. Do you want to cancel shipment.')){   
   
   var awbs = $(this).data('id');
   var shipment_id = $(this).data('value');
     if(awbs=="" || awbs==null){
     }else{

        $('.und-ot').removeClass('cancel-shipment');
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/cancel_shipment',
            type:'POST',
            dataType:'JSON',
            data:({awbs:awbs,shipment_id:shipment_id}),
            success:function(data){
               
              if(data.status==1){
                  var html = '<div class="alert alert-success" role="alert">'+data.message+'</div>';
                  setTimeout(function() {
                   location.reload();
                    }, 3000 );

                }else{
                  var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
                } 

              $('.alertmess_perr').html(html);
               $('.und-ot').addClass('cancel-shipment');
              loading('loaderdiv-pickup','none');
            }
        });
      }
    }

})

$(document).on('click','.cancel-order',function(){
   if(confirm('Are you sure. Do you want to cancel order.')){   
   var order_id = $(this).data('id');
     if(order_id=="" || order_id==null){
     }else{

        $('.und-ot-c').removeClass('cancel-shipment');
        loading('loaderdiv-pickup','block');
         $.ajax({
            url:base_url+'ajax_function/cancel_order',
            type:'POST',
            dataType:'JSON',
            data:({order_id:order_id}),
            success:function(data){

              if(data.status==1){
                  var html = '<div class="alert alert-success" role="alert">'+data.message+'</div>';
                  setTimeout(function() {
                   location.reload();
                    }, 3000 );

                }else{
                  var html = '<div class="alert alert-danger" role="alert">'+data.message+'</div>';
                } 

              $('.alertmess_perr').html(html);
               $('.und-ot-c').addClass('cancel-shipment');
              loading('loaderdiv-pickup','none');
            }
        });
      }
  }

})

$(document).on('click','#modalClose',function(){
  $('#myModal_courier').modal('toggle');
  });

 

 // $(document).on('click','.shipt-order',function(){
   
 //     var courier_name=$('#courier-name').val();
 //     var traking_no=$('#traking-no').val();
 //     var traking_url=$('#traking-url').val();
 //     var no_of_parcels=$('#no-of-parcels').val();
 //     var status_value=$('#status-value').val();
 //     var orders_id=$('#orders-id').val();

 //    if(courier_name=="" || courier_name==null){
 //        validation('courier-name','Courier name is required.','red','courier-name-error');
 //        return false;
 //      }else{
 //        removeValidation('courier-name-error');
 //        status=1;
 //      }

 //      if(traking_no=="" || traking_no==null){
 //        validation('traking-no','Traking No(AWB) is required.','red','traking-no-error');
 //        return false;
 //      }else{
 //        removeValidation('traking-no-error');
 //        status=1;
 //      }

 //      if(traking_url=="" || traking_url==null){
 //        validation('traking-url','Traking url is required.','red','traking-url-error');
 //        return false;
 //      }else{
 //        removeValidation('traking-url-error');
 //        status=1;
 //      }


 //       if(no_of_parcels=="" || no_of_parcels==null){
 //        validation('no-of-parcels','Enter your No of parcels.','red','no-of-parcels-error');
 //        return false;
 //      }else{
 //        removeValidation('no-of-parcels-error');
 //        status=1;
 //      }


 //    if(status==1){
 //       loading('loaderdiv_courier','block');
 //        $('.und-ot').removeClass('update-order-status');
 //         $.ajax({
 //            url:base_url+'ajax_function/delivery_status_On_shipped_action',
 //            type:'POST',
 //            dataType:'JSON',
 //            data:({courier_name:courier_name,
 //              traking_no:traking_no,
 //              no_of_parcels:no_of_parcels,
 //              status_value:status_value,
 //              traking_url:traking_url,
 //              orders_id:orders_id}),
 //            success:function(data){
 //                  $('#myModal_courier').modal('toggle');
 //                if(data.status==1){
                   
 //                   Swal.fire({
 //                      position: 'center',
 //                      icon: 'success',
 //                      title: data.message,
 //                      showConfirmButton: false,
 //                      timer: 2000
 //                         }).then((result) => {
 //                            location.reload();
 //                        });
                  
                 
 //                }else{
 //                 Swal.fire({
 //                    position: 'center',
 //                    icon: 'error',
 //                    title: data.message,
 //                    showConfirmButton: false,
 //                    timer: 2000
 //                       }).then((result) => {
 //                      $('.und-ot').addClass('update-order-status');
 //                     });
 //                 }

 //                loading('loaderdiv_courier','none');

 //              }

 //            });


 //      }



 // });

// $('#modal').modal('toggle');

$(document).on('change','#inputImage',function(){

         var formData = new FormData($('#my-form-import')[0]);  

          loading('loaderdiv','block');
          $('.fordi').css('display','none');

          $.ajax({
                  url: base_url+'admin/importSVC',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.response,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        // timer: 5000
                           }).then((result) => {
                            $('#inputImage').val('');
                            location.reload(); 
                          });
                       
                    }else{
                      Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.response,
                              showConfirmButton: false,
                              // timer: 5000
                                 }).then((result) => {
                                $('#inputImage').val('');
                                // location.reload();
                               });
 
                    }
                   
                      loading('loaderdiv','none');
                      $('.fordi').css('display','block');
                   }

              });


})


$(document).on('click','.save-customer',function(){
  
    var formData = new FormData($('#my-form-customer')[0]);  

    var firstname=$('#c_fname').val();
    var lastname=$('#c_lname').val();
     var mobilename=$('#mobile').val();
    var emailAddress=$('#email').val();
    var new_password=$('#password').val();
    var confirm_password=$('#conf_password').val();
    var cust_id=$('#cust_id').val();
    
    var oldemail=$('#oldemail').val();

    

      var regexEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
     var pattern = /^\d{10}$/;

    if(firstname=="" || firstname==null){
          $('#c_fname').css('border','1px solid red');
         return false;
        }else{
           $('#c_fname').css('border','1px solid #CCCCCC');
           var status=1;
       }


       if(lastname=="" || lastname==null){
          $('#c_lname').css('border','1px solid red');
         return false;
        }else{
           $('#c_lname').css('border','1px solid #CCCCCC');
           var status=1;
       }
    
    if(mobilename=="" || mobilename==null){
          $('#mobile').css('border','1px solid red');
         return false;
        }else if(!pattern.test(mobilename)){

          $('#mobile').css('border','1px solid red');

        }else{
           $('#mobile').css('border','1px solid #CCCCCC');
           var status=1;
        }

         if(emailAddress=="" || emailAddress==null){
          $('#email').css('border','1px solid red');
         return false;
        }else if(!emailAddress.match(regexEmail)){

          $('#email').css('border','1px solid red');

        }else{
           $('#email').css('border','1px solid #CCCCCC');
           var status=1;
        }

      var regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
     if(cust_id=="" || cust_id==null){

        if(new_password=="" || new_password==null){
          $('#password').css('border','1px solid red');
         return false;
        }else if(!new_password.match(regexPassword)){
            alert('Your password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.');
            return false;
        }else{
           $('#password').css('border','1px solid #CCCCCC');
           var status=1;
       }

        if(confirm_password=="" || confirm_password==null){
          $('#conf_password').css('border','1px solid red');
         return false;
        }else if(new_password!=confirm_password){
            $('#conf_password').css('border','1px solid red');
            return false;
        }else{
           $('#conf_password').css('border','1px solid #CCCCCC');
           var status=1;
       }

     }else{
       
            if(new_password!="" || new_password!=null){

              if(new_password!=confirm_password){
                $('#conf_password').css('border','1px solid red');
                return false;
            }

        }


     }
       
       if(status==1){

        loading('loaderdiv','block');
     $('.ust-fd').removeClass('save-customer');
          $.ajax({
                  url: base_url+'Ajax_function/add_customer',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'customer_list';
                          });
                       
                    }else{

                      Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.ust-fd').addClass('save-customer');
                               });

                     
                    }


                   
                      loading('loaderdiv','none');
                   }

              });

        }
})


$(document).on('change','.change-type-delv',function(){
   var valueData=$(this).val();
    if(valueData=='national_delivery' || valueData=='excluding_local_hyperlocal'){
      $('.natonal-or-within-mh').css('display','block');
      $('.hyperlocal-delver').css('display','none');
      $('.local-delver').css('display','none');

    }else if (valueData=='hyperlocal_delivery') {
      $('.natonal-or-within-mh').css('display','none');
      $('.hyperlocal-delver').css('display','block');
      $('.local-delver').css('display','none');

    }else if(valueData=='local_delivery'){
      $('.natonal-or-within-mh').css('display','none');
      $('.hyperlocal-delver').css('display','none');
      $('.local-delver').css('display','block');

    }else{
     $('.natonal-or-within-mh').css('display','none');
     $('.hyperlocal-delver').css('display','none');
     $('.local-delver').css('display','none');
    }
})


$(document).on('click','.shipping-charges-save',function(){
   
  var valueData=$('.change-type-delv').val();
  var getid=$('#get-shp-id').val();
 
   if(valueData=='national_delivery' || valueData=='excluding_local_hyperlocal'){
         var qty=$('#qty').val();
         var unit=$('#unit').val();
         var amount=$('#amount').val();
         var getData={'qty':qty,'unit':unit,'amount':amount,'getid':getid,'deliveryType':valueData};
         // console.log(getData);
     }else if (valueData=='hyperlocal_delivery') {
       
        var range_qty1=$('input[name="range_qty1[]"]').map(function(){
                  return this.value;
           }).get();

        var range_qty2=$('input[name="range_qty2[]"]').map(function(){
                  return this.value;
           }).get();
        
        var range_unit=$('input[name="range_unit[]"]').map(function(){
                  return this.value;
           }).get();

        var range_amount=$('input[name="range_amount[]"]').map(function(){
                  return this.value;
           }).get();

       var getData={'range_qty1':range_qty1,'range_qty2':range_qty2,'range_unit':range_unit,'range_amount':range_amount,'getid':getid,'deliveryType':valueData};
        
        // console.log(getData);
     }else if(valueData=='local_delivery'){

           var maxAmount=$('#maxAmount').val();
           var max_charges_amount=$('#max_charges_amount').val();

           var minAmount=$('#minAmount').val();
           var min_charges_amount=$('#min_charges_amount').val();

           var getData={'maxAmount':maxAmount,'max_charges_amount':max_charges_amount,'minAmount':minAmount,'min_charges_amount':min_charges_amount,'getid':getid,'deliveryType':valueData};
           // console.log(getData);
       }

        loading('loaderdiv','block');
      $('.shi-cl').removeClass('shipping-charges-save');


      $.ajax({
            url:base_url+'ajax_function/shipping_charges_manage',
            type:'POST',
            dataType:'JSON',
            data:getData,
            success:function(data){
  
                  if(data.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: data.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                    // document.location.href=base_url+'admin/blogs';
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                 $('.shi-cl').addClass('shipping-charges-save');
                               });
                            
                          }

                           loading('loaderdiv','none');
                         


                          //  if(data.status==1){
                          //   alert(data.message);
                          //   location.reload();
                          // }else{
                          //   alert(data.message);
                          // }
            }

          });

})

function insertParam(key, value) {
  var newParam ="";
   key = escape(key); value = escape(value);
  var url= document.location.search;
    newParam = key+"="+value;
    if(value==""){
      value=false;
      newParam = key+"="+value;
    }
    // alert(newParam);
    var result = url.replace(new RegExp("(&|\\?)"+key+"=[^\&|#]*"), '$1' + newParam);
    if (result === url) { 
        result = (url.indexOf("?") != -1 ? url.split("?")[0]+"?"+newParam+"&"+url.split("?")[1] 
           : (url.indexOf("#") != -1 ? url.split("#")[0]+"?"+newParam+"#"+ url.split("#")[1] 
              : url+'?'+newParam));
    }

    return result;
}







$(document).on('keyup','#search-product',function(){
    var getKeywords=$(this).val();
    $.ajax({
            url:base_url+'ajax_function/searchProducts',
            type:'POST',
            dataType:'JSON',
            data:({'getKeywords':getKeywords}),
             success:function(data){
               $('#trRow').html(data.pro_list);
               $('#pagint-div').html(data.links);
             }

           });

})


$(document).on('keyup','#search-orders',function(){
  let status = $(".btn-status-class:checked").map((i, el) => el.value).get();
  var getKeywords=$(this).val();
  var fromDate=$('#fromDate').val();
  var toDate=$('#toDate').val();
 // const d1_fromDate = new Date(fromDate).getTime();
 // const d1_toDate = new Date(toDate).getTime();
   loading('loaderdiv','block');
    $.ajax({
            url:base_url+'ajax_function/searchOrders',
            type:'POST',
             dataType:'JSON',
             data:({'fromDate':fromDate,'toDate':toDate,'getKeywords':getKeywords,'orderStatus':status}),
             success:function(data){
               

               $('#trRow').html(data.order_list);
               $('#pagint-div').html(data.links);
               $('.tot-Amu').html(data.totalAmount);
               loading('loaderdiv','none');
             }
           });
})


$(document).on('change','.searchDate',function(){
  let status = $(".btn-status-class:checked").map((i, el) => el.value).get();
  var fromDate=$('#fromDate').val();
  var toDate=$('#toDate').val();
  var getKeywords=$('#search-orders').val();

 const d1_fromDate = new Date(fromDate).getTime();
 const d1_toDate = new Date(toDate).getTime();
 
 if(d1_fromDate <= d1_toDate){
     loading('loaderdiv','block');
       $.ajax({
          url:base_url+'ajax_function/searchOrders',
          type:'POST',
           dataType:'JSON',
          data:({'fromDate':fromDate,'toDate':toDate,'getKeywords':getKeywords,'orderStatus':status}),
           success:function(data){
             

             $('#trRow').html(data.order_list);
             $('#pagint-div').html(data.links);
             $('.tot-Amu').html(data.totalAmount);
             loading('loaderdiv','none');
           }
         });

 }


});


$(document).on('click','.btn-status-class',function(){
  let status = $(".btn-status-class:checked").map((i, el) => el.value).get();
  var fromDate=$('#fromDate').val();
  var toDate=$('#toDate').val();
  var getKeywords=$('#search-orders').val();
  loading('loaderdiv','block');
   $.ajax({
          url:base_url+'ajax_function/searchOrders',
          type:'POST',
          dataType:'JSON',
          data:({'fromDate':fromDate,'toDate':toDate,'getKeywords':getKeywords,'orderStatus':status}),
           success:function(data){
            $('#trRow').html(data.order_list);
            $('#pagint-div').html(data.links);
            $('.tot-Amu').html(data.totalAmount);
            
            // console.log(data.links);
             // 
             loading('loaderdiv','none');
           }
         });
  // console.log(opts);
})



$(document).on('change','#inputHSN',function(){

         var formData = new FormData($('#my-form-import')[0]);  

         loading('loaderdiv','block');
          $('.fordi').css('display','none');

          $.ajax({
                  url: base_url+'admin/importHSN_SVC',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.response,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                            $('#inputHSN').val('');
                            location.reload(); 
                          });
                       
                    }else{
                        Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.response,
                              showConfirmButton: false,
                              timer: 5000
                                 }).then((result) => {
                                $('#inputHSN').val('');
                                $('.fordi').css('display','block');
                               });
                       
                    }
                   
                      loading('loaderdiv','none');
                      
                   }

              });


})




$(document).on('click','.save-hsn',function(){
  
    var formData = new FormData($('#my-form-hsn')[0]);  

          loading('loaderdiv','block');
          $('.hsn-cl').removeClass('save-hsn');

          $.ajax({
                  url: base_url+'Ajax_function/add_hsn',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/hsn_code';
                          });
                       
                    }else{
                          Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.hsn-cl').addClass('save-hsn');
                               });
                    }

                     loading('loaderdiv','none');
                     

                   

                   }

              });
})




$(document).on('keyup','#search-hsn',function(){

  var getKeywords=$(this).val();
  sessionStorage.setItem('hsnSearchQuery', getKeywords);
 loading('loaderdiv-searchs','block');
    $.ajax({
            url:base_url+'ajax_function/searchHsn',
            type:'POST',
            // dataType:'JSON',
            data:({'getKeywords':getKeywords}),
             success:function(data){
               $('#trRow').html(data);
              
              loading('loaderdiv-searchs','none');
             }
             
           });

})

$(document).ready(function() {
  var savedKeywords = sessionStorage.getItem('hsnSearchQuery');
  if (savedKeywords) {
    $('#search-hsn').val(savedKeywords);
  }
});

$(document).on('change','.purchase_class',function(){

    var getPurchaseType=$(this).val();
    if(getPurchaseType=='amount_purchase'){
       $('.purchase_label').text('Min. Purchase Amt (₹)');
       $('.purchase_input').attr('id', 'min_purch_amt');
       $('.purchase_input').attr('name', 'min_purch_amt');
       $('.purchase_input').val('');
    }else if(getPurchaseType=='qty_purchase'){
       $('.purchase_label').text('Min. Purchase qty (Kg)');
       $('.purchase_input').attr('id', 'min_purch_qty');
       $('.purchase_input').attr('name', 'min_purch_qty');
       $('.purchase_input').val('');
    }else{
       $('.purchase_label').text('Min. Purchase product');
       $('.purchase_input').attr('id', 'min_purch_product');
       $('.purchase_input').attr('name', 'min_purch_product');
       $('.purchase_input').val('');
    }
})

$(document).on('change','.disc_class',function(){

     var getDiscType=$(this).val();
     if(getDiscType=="fixed_amt"){
       $('.disc_lable').text('Discount Amt');
       $('.disc_input').attr('id', 'disc_amt');
       $('.disc_input').attr('name', 'disc_amt');
       $('.disc_input').val('');
     }else{
        $('.disc_lable').text('Discount Per (%)');
        $('.disc_input').attr('id', 'disc_per');
        $('.disc_input').attr('name', 'disc_per');
        $('.disc_input').val('');
     }
})


$(document).on('keyup','#disc_per',function(){
   var perValue=$(this).val();
   if(perValue>100){
    $(this).val('');
   }
})

$(document).on('change','#start_date',function(){
  var getDate=$(this).val();
  $('#end_date').attr('min', getDate);
  $('#end_date').val('');
})


$(document).on('click','.save-coupon',function(){
    
    var coupon_id=$('#coupon_id').val();
    var couponsstatus=$('input[name="coupons_status"]:checked').val();
    var start_date=$('#start_date').val();
    var end_date=$('#end_date').val();
    var coupon_code=$('#coupon_code').val();

    var purchase_type=$('#purchase_type').val();
    if(purchase_type=='amount_purchase'){
      var min_purch_amt=$('#min_purch_amt').val();
      var min_purch_qty=0;
      var min_purch_product='';
    }else if(purchase_type=='qty_purchase'){
      var min_purch_amt=0;
      var min_purch_qty=$('#min_purch_qty').val();
      var min_purch_product='';
    }else{
      var min_purch_amt=0;
      var min_purch_qty=0;
      var min_purch_product=$('#min_purch_product').val();
    }

    var disc_type=$('#disc_type').val();
    if(disc_type=='fixed_amt'){
      var disc_amt=$('#disc_amt').val();
      var disc_per=0;
    }else{
      var disc_amt=0;
      var disc_per=$('#disc_per').val();
    }


   var purchase_input = $('.purchase_input').val();
   $('.purchase_input').css('border-color','#dadada');
   if(purchase_input=="" || purchase_input==null){
    $('.purchase_input').css('border-color','red');
    return false;
   }

   var disc_input = $('.disc_input').val();
   $('.disc_input').css('border-color','#dadada');
   if(disc_input=="" || disc_input==null){
    $('.disc_input').css('border-color','red');
    return false;
   }

    var start_date = $('#start_date').val();
    $('#start_date').css('border-color','#dadada');
   if(start_date=="" || start_date==null){
    $('#start_date').css('border-color','red');
    return false;
   }

    var end_date = $('#end_date').val();
    $('#end_date').css('border-color','#dadada');
   if(end_date=="" || end_date==null){
    $('#end_date').css('border-color','red');
    return false;
   }


   var tags_email=$('#tags-email').val();
   var checkUses=$('input[name="checkUses"]:checked').val();
   var checkType=$('input[name="checkType"]:checked').val();
   
    // console.log(checkUses);
    // console.log(checkType);
    // console.log(tags_email);
  var arrPost={
                'coupons_status':couponsstatus,
                'start_date':start_date,
                'end_date':end_date,
                'coupon_code':coupon_code,
                'purchase_type':purchase_type,
                'min_purch_amt':min_purch_amt,
                'min_purch_qty':min_purch_qty,
                'min_purch_product':min_purch_product,
                'disc_type':disc_type,
                'disc_amt':disc_amt,
                'disc_per':disc_per,
                'coupon_id':coupon_id,
                'checkUses':checkUses,
                'checkType':checkType,
                'tags_email':tags_email
              };
  
   
      loading('loaderdiv','block');
      $('.con-cl').removeClass('save-coupon');

   $.ajax({
            url:base_url+'ajax_function/coupon_manage',
            type:'POST',
            dataType:'JSON',
            data:arrPost,
            success:function(data){

              if(data.status==1){

                     Swal.fire({
                      position: 'top-end',
                      // icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      color:'white',
                      background: '#689F39',
                      timer: 3000
                         }).then((result) => {
                             document.location.href=base_url+'admin/coupon_list';
                        });
                     
                  }else{
                     Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 3000
                         }).then((result) => {
                        // location.reload();
                       });
                    
                  }

               

                loading('loaderdiv','none');
                $(this).addClass('save-coupon');

            }

          });

    
})


$(document).on('click','.save-blogs',function(){
    
       var blog_header=$('#blog_header').val();
       var blog_category=$('#blog_category').val();
       var blog_description=$('#blog_description').val();
       var blog_image=$('#blog_image').val();
       // var blog_tag_field=$('#blog_tag_field').val();


       if(blog_header=="" || blog_header==null){
          validation('blog_header','Blog Header is required.','red','blog-header-error');
          return false;
        }else{
          removeValidation('blog-header-error');
          status=1;
        }



       if(blog_category=="" || blog_category==null){
          validation('blog_category','Category is required.','red','blog_category-error');
          return false;
        }else{
          removeValidation('blog_category-error');
          status=1;
        }

        if(blog_description=="" || blog_description==null){
          validation('blog_description','Description is required.','red','blog_description-error');
          return false;
        }else{
          removeValidation('blog_description-error');
          status=1;
        }

        if(blog_image=="" || blog_image==null){
          validation('blog_image','Image is required.','red','blog_image-error');
          return false;
        }else{
          removeValidation('blog_image-error');
          status=1;
        }


        // if(blog_tag_field=="" || blog_tag_field==null){
        //   validation('blog_tag_field','Field is required.','red','blog_tag_field-error');
        //   return false;
        // }else{
        //   removeValidation('blog_tag_field-error');
        //   status=1;
        // }

  if(status==1){
         loading('loaderdiv','block');
        $('.blo-cl').removeClass('save-blogs');

        var formData = new FormData($('#form-blogs')[0]);
        $.ajax({
                  url: base_url+'ajax_function/blog_manage',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){
                
                      if(data.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: data.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                    document.location.href=base_url+'admin/blogs';
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 5000
                                 }).then((result) => {
                                // location.reload();
                               });
                            
                          }


                          loading('loaderdiv','none');
                          $('.blo-cl').addClass('save-blogs');

                    }
             });
      }

});


$(document).on('click','.offer-apply',function(){

   var get_id=$(this).data('id');

   var splitValue=get_id.split('_');
   var variant_id=splitValue[0];
   var offer_id=splitValue[1];

  var start_date=$('#start-date'+variant_id).val();
  var end_date=$('#end-date'+variant_id).val();
  var product_name_purchase=$('#product-name-purchase'+variant_id).val();
  var min_qty=$('#min-qty'+variant_id).val();

  // $('input[name]=products')
  var pname=$('input[name="products'+variant_id+'"]:checked').val();

  var offer_cate=$('#offer-cate'+variant_id).val();

  // var pname=$('#pname'+variant_id).val();
  var psize=$('#offer-packsize'+variant_id).val();
  // var offer_units=$('#offer-units'+variant_id).val();
  var pqty=$('#pqty'+variant_id).val();
  // var img_pro_path=$('#img_pro_path'+variant_id).val();
  



        if(start_date=="" || start_date==null){
          $('#start-date'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#start-date'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


         if(end_date=="" || end_date==null){
          $('#end-date'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#end-date'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


         if(product_name_purchase=="" || product_name_purchase==null){
          $('#product-name-purchase'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#product-name-purchase'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

           if(min_qty=="" || min_qty==null || min_qty < 1){
          $('#min-qty'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#min-qty'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


        if(pname=="" || pname==null){
          $('#pnameerr'+variant_id).html('<p style="color:red;">Select your product name</p>');
          return false;
        }else{
          $('#pnameerr'+variant_id).html('');
           status=1;
        }

        if(psize=="" || psize==null){
          $('#psize'+variant_id).css('border','1px solid red');
          return false;
        }else{
           $('#psize'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

        //  if(offer_units=="" || offer_units==null){
        //   $('#offer-units'+variant_id).css('border','1px solid red');
        //   return false;
        // }else{
        //    $('#offer-units'+variant_id).css('border','1px solid #CCCCCC');
        //    status=1;
        // }

        if(pqty=="" || pqty==null || pqty < 1){
          $('#pqty'+variant_id).css('border','1px solid red');
          return false;
         }else{
           $('#pqty'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }



 // console.log('variant_id=>',variant_id);
 //   console.log('offer_id=>',offer_id);
 //    console.log('start_date=>',start_date);
 //     console.log('end_date=>',end_date);
 //      console.log('product_name_purchase=>',product_name_purchase);
 //       console.log('min_qty=>',min_qty);
      
 //         console.log('pname=>',pname);
 //            console.log('psize=>',psize);
 //               console.log('pqty=>',pqty);
   var formData = new FormData($('#myforms'+variant_id)[0]);  

        formData.append('variant_id',variant_id);
        formData.append('start_date',start_date);
        formData.append('end_date',end_date);
        formData.append('product_name_purchase',product_name_purchase);                 
        formData.append('min_qty',min_qty);
        formData.append('pname',pname);
        formData.append('psize',psize);
        // formData.append('offer_units',offer_units);
        formData.append('pqty',pqty);
        formData.append('offer_id',offer_id);
        formData.append('offer_cate',offer_cate);
        

    if(status==1){

           $.ajax({

              url: base_url+'ajax_function/apply_product_offers',
              data: formData,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'JSON',
              success:function(data){

                 if(data.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: data.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                    location.reload();
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                // location.reload();
                               });
                            
                          }
                
                 


            }

          });
    }

})


 // url:base_url+'ajax_function/apply_product_offers',
 //            type:'POST',
 //            dataType:'JSON',
 //            data:({
 //              variant_id:variant_id,
 //              start_date:start_date,
 //              end_date:end_date,
 //              product_name_purchase:product_name_purchase,
 //              min_qty:min_qty,
 //              pname:pname,
 //              psize:psize,
 //              offer_units:offer_units,
 //              pqty:pqty,
 //              offer_id:offer_id
 //            }),


$(document).on('click','.offer-delete',function(){

 var value=$(this).data('id');
    if(confirm('Are you sure.Do you want to delete.')){
         $('#loader').css('display','block');
        $.ajax({
            url:base_url+'ajax_function/deleteProductOffer',
            type:'POST',
            dataType:'JSON',
            data:({value:value}),
            success:function(data){
                   // var alertShow="";
                   // var alert="";

                   if(data.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: data.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                    location.reload();
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                // location.reload();
                               });
                            
                          }

               
            }


        });

    }
})



$(document).on('click','.save-user',function(){

    var c_fname=$('#c_fname').val();
    // var c_lname=$('#c_lname').val();
    var username=$('#username').val();
    var mobile=$('#mobile').val();
    var email=$('#email').val();
    var designation=$('#designation').val();
    
    var password=$('#password').val();
    var conf_password=$('#conf_password').val();
    var imgPath=$('#imgPath').val();
    var editv=$('#editv').val();
    var oldusername=$('#oldusername').val();

    var oldemail=$('#oldemail').val();
    
    


        if(c_fname=="" || c_fname==null){
          $('#c_fname').css('border','1px solid red');
          return false;
        }else{
          $('#c_fname').css('border','1px solid #CCCCCC');
           status=1;
        }

        // if(c_lname=="" || c_lname==null){
        //   $('#c_lname').css('border','1px solid red');
        //   return false;
        // }else{
        //   $('#c_lname').css('border','1px solid #CCCCCC');
        //    status=1;
        // }

        if(username=="" || username==null){
          $('#username').css('border','1px solid red');
          return false;
        }else{
          $('#username').css('border','1px solid #CCCCCC');
           status=1;
        }



          var pattern = /^\d{10}$/;
         if(mobile=="" || mobile==null){
          $('#mobile').css('border','1px solid red');
          return false;

        }else if(!pattern.test(mobile)){
           alert('invalid contact number.');
           return false;

        }else{
          $('#mobile').css('border','1px solid #CCCCCC');
           status=1;
        }


        var regexEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       if(email=="" || email==null){
          $('#email').css('border','1px solid red');
          return false;
        }else if(!email.match(regexEmail)){
            alert('invalid email id.');
            return false;
        }else{
          $('#email').css('border','1px solid #CCCCCC');
           status=1;
        }

        if(editv==""){

            if(password=="" || password==null){
              $('#password').css('border','1px solid red');
              return false;

            }else if(password!=conf_password){
               alert('Password not match.');
                return false;

            }else{
               $('#password').css('border','1px solid #CCCCCC');
               status=1;
            }


      }else{

           if(password=="" || password==null){}else{

                if(password=="" || password==null){
                  $('#password').css('border','1px solid red');
                  return false;

                }else if(password!=conf_password){
                   alert('Password not match.');
                    return false;

                }else{
                   $('#password').css('border','1px solid #CCCCCC');
                   status=1;
                }

           }


      }


 
        var formData = new FormData($('#my-form-user')[0]);  

            formData.append('c_fname',c_fname);
            // formData.append('c_lname',c_lname);
            formData.append('username',username);
            formData.append('mobile',mobile);
            formData.append('email',email);
            formData.append('password',password);
            formData.append('imgPath',imgPath);
            formData.append('editv',editv);
            formData.append('oldusername',oldusername);
            formData.append('designation',designation);
            formData.append('oldemail',oldemail);
            
          if(status==1)  {

             loading('loaderdiv','block');
            $('.us-cl').removeClass('save-user');


          $.ajax({
                  url: base_url+'Ajax_function/add_user',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/user_list';
                          });
                       
                    }else{
                           Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.us-cl').addClass('save-user');
                               });

                    }

                     loading('loaderdiv','none');
                    

                   

                   }

              });
        }

})


$(document).on('click','.menus-access-save',function(){

  var user_id=$('#user-id').val();

    var menuName=$('input[name="menuName[]"]:checked').map(function(){
                  return this.value;
           }).get();

   
    var action_mode=$('input[name="action_mode[]"]:checked').map(function(){
                  return this.value;
           }).get();

  
   if(menuName.length!=0){

       var collectArr=[];
    
          menuName.forEach(function(value,index){
                 var collectAction=[];
                 action_mode.forEach(function(value_aciton,index_action){
                             var splitValue=value_aciton.split(':::');

                             if(splitValue[1]==value){
                                 collectAction.push(splitValue[0]);
                             }
                      })

                collectArr.push({menu_id:value,inputAction:collectAction});
          })


          // console.log(collectArr);


             $.ajax({
                  url:base_url+'ajax_function/add_setting_user',
                  type:'POST',
                  dataType:'JSON',
                  data:({collectArr:collectArr,user_id:user_id}),
                  success:function(data){

                     if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/user_list';
                          });
                       
                    }else{
                      alert(data.message);
                    }

                  }
                })






   }else{
      alert('Select your input.');
   }


   
})


$(document).on('click','.menuclass,.sub-menu',function(){
   var getActive=$(this).val();

   if($(this).is(':checked')){
     $('.actionClass'+getActive).removeAttr("disabled");
     $('.submenues').removeAttr("disabled");
   }else{
     $('.actionClass'+getActive).attr("disabled", "disabled");
     $('.actionClass'+getActive).prop("checked", false);
   }

})

$(document).on('click','.sub-menuAction',function(){
   var getActive=$(this).val();

   if($(this).is(':checked')){
    $('.menuclass'+getActive).removeAttr("disabled");
   }else{
     $('.menuclass'+getActive).attr("disabled", "disabled");
     $('.menuclass'+getActive).prop("checked", false);
     $('.act_all'+getActive).prop("checked", false);
      $('.act_all'+getActive).attr("disabled", "disabled");
     
   }
})


$(document).on('click','.remove-access',function(){

  if(confirm('Are you sure. Want to remove.')){
    
    var user_id=$('#user-id').val();
     $.ajax({
            url:base_url+'ajax_function/remove_setting_user',
            type:'POST',
            dataType:'JSON',
            data:({user_id:user_id}),
            success:function(data){
             
               if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/user_list';
                          });
                       
                    }else{
                      alert(data.message);
                    }
               }
          });

    }


})



$(document).on('click','.galleryTag-save',function(){
   
      var gallery_tag=$('#gallery-tag').val();
      var tag_id=$('#get-tag-id').val();
        // console.log('ccc=>',cat_id);

      if(gallery_tag=="" || gallery_tag==null){
          validation('gallery-tag','Enter your Gallery tag name.','red','gallery-tag-error');
          return false;
       }else{
          removeValidation('gallery-tag-error');
         var status=1;
        }

       if(status==1){

         loading('loaderdiv','block');
        $('.ga_cl').removeClass('galleryTag-save');


         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/galleryTag_ajax',
              data:({gallery_tag:gallery_tag,tag_id:tag_id}),
              success: function(result){

                if(result.status==1){

                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: result.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                   document.location.href=base_url+'admin/gallery_tag_list';
                                });
                             
                          }else{
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: result.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.ga_cl').addClass('galleryTag-save');
                               });
                            
                          }

                    loading('loaderdiv','none');
                   
               }
           });
         }
})


$(document).on('click','.add-more-gallery',function(){
  var increment=$('#increment').val();

  var get_tagid=$('#get_tagid').val();
  // alert(get_tagid);
      increment++;
    $('#increment').val(increment);
     var html='<tr class="add-tr'+increment+get_tagid+'">'+
            '<td class="tbl-td">'+
            '<div class="row">'+
                '<div class="col-sm-11">'+
                  '<input type="hidden" id="img-id'+increment+'" name="input_img_id'+get_tagid+'[]" value="">'+
                  '<input type="text" class="form-control" id="heading'+increment+'" placeholder="Image name" name="heading'+get_tagid+'[]">'+
                '</div>'+
            '</div>'+
           '</td>'+

           '<td>'+
           '<input type="file" name="galleryImg'+get_tagid+'[]" id="galleryImg'+increment+'" class="form-control" accept="image/*">'+
          '<input type="hidden" name="imagePath'+get_tagid+'[]"  id="imagePath'+increment+'" class="form-control">'+
           '</td>'+

           '<td>'+
             '<div class="col-sm-1">'+
                 '<button type="button" class="btn btn-danger remove-btn-galle" data-id="'+increment+'">-</button>'+
               '</div>'+
           '</td>'+
       '</tr>';
    $('.add-tr'+get_tagid).before(html);
})


 $(document).on('click','.remove-btn-galle',function(){
     var getid=$(this).data('id');
     var getdisc_id=$('#img-id'+getid).val();
      var get_tagid=$('#get_tagid').val();
      // alert(getid+get_tagid);
    // $.ajax({
    //         url:base_url+'ajax_function/delete_description',
    //         type:'POST',
    //         data:({getdisc_id:getdisc_id}),
    //         success:function(result){
              $('.add-tr'+getid+get_tagid).remove();

          //   }

        // });
});

$(document).on('click','.add-gallery-images',function(){
 var tag_id=$(this).data('id');

  var formData = new FormData($('#gallery-form'+tag_id)[0]); 

  var input_img_id=$('input[name="input_img_id'+tag_id+'[]"]').map(function(){
                  return this.value;
           }).get();

  var heading=$('input[name="heading'+tag_id+'[]"]').map(function(){
                  return this.value;
           }).get();

 var imagePath=$('input[name="imagePath'+tag_id+'[]"]').map(function(){
                  return this.value;
           }).get();
  


            formData.append('input_img_id', input_img_id);
            formData.append('heading', heading);
            formData.append('tag_id', tag_id);
            formData.append('imagePath', imagePath);
             
            loading('loaderdiv','block');
           $.ajax({
            url:base_url+'ajax_function/upload_gallery_images',
               data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                         $('.galscc').css('z-index','999');
                             Swal.fire({
                              position: 'top-end',
                              // icon: 'success',
                              title: data.message,
                              showConfirmButton: false,
                              color:'white',
                              background: '#689F39',
                              timer: 3000
                                 }).then((result) => {
                                  $('.galscc').css('z-index','');
                                   location.reload();
                                });
                             
                          }else{
                            $('.galscc').css('z-index','999');
                             Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 9000000
                                 }).then((result) => {
                                // location.reload();
                                $('.galscc').css('z-index','');
                               });
                            
                          }

                
                 loading('loaderdiv','none');

            }

          });
 


})



$(document).on('click','.save-contact',function(){
  
    var formData = new FormData($('#my-form-contact')[0]);  

      var address=$('#address').val();
      var mobile=$('#mobile').val();
      var email=$('#email').val();
      var get_id=$('#get_id').val();
      // var short_information=$('#short_information').val();
      // var youtube_video=$('#youtube_video').val();

      // var heading=$('#heading').val();
      // var historyDetails=$('#historyDetails').val();
      // var imagePath=$('#imagePath').val();

       
       // var fassai_no=$('#fassai_no').val();
       // var cin_no=$('#cin_no').val();
       var gst_no=$('#gst_no').val();
       var state=$('#state').val();
       var state_code=$('#state_code').val();
       var pincode=$('#pincode').val();
       var location=$('#location').val();

      
      
        if(address=="" || address==null){
          $('#address').css('border','1px solid red');
          return false;
        }else{
          $('#address').css('border','1px solid #CCCCCC');
           status=1;
        }


       var regexEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       if(email=="" || email==null){
          $('#email').css('border','1px solid red');
          return false;
        }else if(!email.match(regexEmail)){
            alert('invalid email id.');
            return false;
        }else{
          $('#email').css('border','1px solid #CCCCCC');
           status=1;
        }


      // var pattern = /^\d{10}$/;
      //    if(mobile=="" || mobile==null){
      //     $('#mobile').css('border','1px solid red');
      //     return false;

      //   }else if(!pattern.test(mobile)){
      //      alert('invalid contact number.');
      //      return false;

      //   }else{
      //     $('#mobile').css('border','1px solid #CCCCCC');
      //      status=1;
      //   }


     
if(status==1){

            formData.append('address', address);
            formData.append('email', email);
            formData.append('mobile', mobile);
            formData.append('get_id', get_id);
            // formData.append('short_information', short_information);
            // formData.append('youtube_video', youtube_video);

            // formData.append('heading', heading);
            // formData.append('historyDetails', historyDetails);
            // formData.append('imagePath', imagePath);

            // formData.append('fassai_no', fassai_no);
            // formData.append('cin_no', cin_no);
            formData.append('gst_no', gst_no);
            formData.append('state', state);
            formData.append('state_code', state_code);
            formData.append('pincode', pincode);
            formData.append('location', location);
            
           loading('loaderdiv','block');
          $('.rotf').removeClass('save-contact');

          $.ajax({
                  url: base_url+'Ajax_function/contact_add',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/contact_manager';
                          });
                       
                    }else{
                           Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.rotf').addClass('save-contact');
                               });

                    }
                   
                     loading('loaderdiv','none');
                    

                   }

              });
        }
})



$(document).on('click','.save-teams',function(){

    var name=$('#name').val();
    var designation=$('#designation').val();
    var short_details=$('#short_details').val();
    var fb_link=$('#fb_link').val();
    var twitter_link=$('#twitter_link').val();
    var insta_link=$('#insta_link').val();
    var linkedin_link=$('#linkedin_link').val();

    var imgPath=$('#imgPath').val();
    var editv=$('#editv').val();
  

        if(name=="" || name==null){
          $('#name').css('border','1px solid red');
          return false;
        }else{
          $('#name').css('border','1px solid #CCCCCC');
           status=1;
        }

        // if(designation=="" || designation==null){
        //   $('#designation').css('border','1px solid red');
        //   return false;
        // }else{
        //   $('#designation').css('border','1px solid #CCCCCC');
        //    status=1;
        // }

         if(short_details=="" || short_details==null){
          $('#short_details').css('border','1px solid red');
          return false;
        }else{
          $('#short_details').css('border','1px solid #CCCCCC');
           status=1;
        }


        var formData = new FormData($('#my-form-team')[0]);  

            formData.append('name',name);
            formData.append('designation',designation);
            formData.append('short_details',short_details);
            formData.append('fb_link',fb_link);
            formData.append('twitter_link',twitter_link);
            formData.append('insta_link',insta_link);
            formData.append('linkedin_link',linkedin_link);
            
            formData.append('imgPath',imgPath);
            formData.append('editv',editv);
            
           loading('loaderdiv','block');
          $('.tm-cl').removeClass('save-teams');

          $.ajax({
                  url: base_url+'Ajax_function/add_team',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/team_manager';
                          });
                       
                    }else{
                            Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.tm-cl').addClass('save-teams');
                               });

                    }

                     loading('loaderdiv','none');
                     

                   

                   }

              });

})



$(document).on('click','.save-testimonial',function(){

    var name=$('#name').val();
    var designation=$('#designation').val();
    var short_details=$('#short_details').val();
    var editv=$('#editv').val();
  

        if(name=="" || name==null){
          $('#name').css('border','1px solid red');
          return false;
        }else{
          $('#name').css('border','1px solid #CCCCCC');
           status=1;
        }

        // if(designation=="" || designation==null){
        //   $('#designation').css('border','1px solid red');
        //   return false;
        // }else{
        //   $('#designation').css('border','1px solid #CCCCCC');
        //    status=1;
        // }

         if(short_details=="" || short_details==null){
          $('#short_details').css('border','1px solid red');
          return false;
        }else{
          $('#short_details').css('border','1px solid #CCCCCC');
           status=1;
        }


        var formData = new FormData($('#my-form-team')[0]);  

            formData.append('name',name);
            formData.append('designation',designation);
            formData.append('short_details',short_details);
            formData.append('editv',editv);
            
           loading('loaderdiv','block');
          $('.tm-cl').removeClass('save-testimonial');

          $.ajax({
                  url: base_url+'Ajax_function/add_testimonial',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/testimonial';
                          });
                       
                    }else{
                        Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.tm-cl').addClass('save-testimonial');
                               });
                    }


                     loading('loaderdiv','none');
                   

                   }

              });

})




$(document).on('click','.save-kyf',function(){

    var name=$('#name').val();
    var short_details=$('#short_details').val();
    var imgPath=$('#imgPath').val();
    var editv=$('#editv').val();
  

        // if(name=="" || name==null){
        //   $('#name').css('border','1px solid red');
        //   return false;
        // }else{
        //   $('#name').css('border','1px solid #CCCCCC');
        //    status=1;
        // }

        

         if(short_details=="" || short_details==null){
          $('#short_details').css('border','1px solid red');
          return false;
        }else{
          $('#short_details').css('border','1px solid #CCCCCC');
           status=1;
        }


        var formData = new FormData($('#my-form-kyf')[0]);  

            formData.append('name',name);
            formData.append('short_details',short_details);
            formData.append('imgPath',imgPath);
            formData.append('editv',editv);

             loading('loaderdiv','block');
           $('.frrr').removeClass('save-kyf');

 
          $.ajax({
                  url: base_url+'Ajax_function/add_kyf',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/kyf';
                          });
                       
                    }else{
                           Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                              $('.frrr').addClass('save-kyf');
                               });

                    }


                    loading('loaderdiv','none');
                          
                   

                   }

              });

})



// $(document).on('click','.save-choose',function(){
  
//     var formData = new FormData($('#my-form-choose')[0]);  


//       var heading=$('#heading').val();
//       var historyDetails=$('#historyDetails').val();
//       var imagePath=$('#imagePath').val();
//       var get_id=$('#get_id').val();

      
      
//       // if(heading=="" || heading==null){
//       //   $('#heading').css('border','1px solid red');
//       //   return false;
//       // }else{
//       //   $('#heading').css('border','1px solid #CCCCCC');
//       //    status=1;
//       // }

//       if(historyDetails=="" || historyDetails==null){
//         $('#historyDetails').css('border','1px solid red');
//         return false;
//       }else{
//         $('#historyDetails').css('border','1px solid #CCCCCC');
//          status=1;
//       }


      

     
// if(status==1){

//             formData.append('heading', heading);
//             formData.append('historyDetails', historyDetails);
//             formData.append('imagePath', imagePath);
//             formData.append('get_id', get_id);
            
//              loading('loaderdiv','block');
//             $('.codeee').removeClass('save-choose');



            
//           $.ajax({
//                   url: base_url+'Ajax_function/why_choose_us',
//                   data: formData,
//                   processData: false,
//                   contentType: false,
//                   type: 'POST',
//                   dataType:'JSON',
//                   success: function(data){

//                     if(data.status==1){

//                        Swal.fire({
//                         position: 'top-end',
//                         // icon: 'success',
//                         title: data.message,
//                         showConfirmButton: false,
//                         color:'white',
//                         background: '#689F39',
//                         timer: 3000
//                            }).then((result) => {
//                               document.location.href=base_url+'admin/why_choose_us';
//                           });
                       
//                     }else{
//                              Swal.fire({
//                               position: 'center',
//                               icon: 'error',
//                               title: data.message,
//                               showConfirmButton: false,
//                               timer: 3000
//                                  }).then((result) => {
//                               $('.codeee').addClass('save-choose');
//                                });

//                     }

//                      loading('loaderdiv','none');
                    
                   

//                    }

//               });
//         }
// })




// $(document).on('click','.save-banner',function(){

    
//     var text1=$('#text1').val();
//     // var text2=$('#text2').val();
//     var short_details=$('#short_details').val();
//     var link=$('#link').val();
//     var desk_imgPath=$('#desk_imgPath').val();
//     // var mobile_imgPath=$('#mobile_imgPath').val();
//     var editv=$('#editv').val();

//      if($('#btn-status').is(':checked')){
//        var btn_status=1;
//      }else{
//       btn_status=0;
//      }
  

      
//         var formData = new FormData($('#my-form-banner')[0]);  

//             formData.append('text1',text1);
//             // formData.append('text2',text2);
//             formData.append('short_details',short_details);
//             formData.append('link',link);
//             formData.append('desk_imgPath',desk_imgPath);
//             // formData.append('mobile_imgPath',mobile_imgPath);
//             formData.append('editv',editv);
//             formData.append('btn_status',btn_status);
            

//              loading('loaderdiv','block');
//              $('.giod').removeClass('save-banner');

 
//           $.ajax({
//                   url: base_url+'Ajax_function/add_banner',
//                   data: formData,
//                   processData: false,
//                   contentType: false,
//                   type: 'POST',
//                   dataType:'JSON',
//                   success: function(data){

//                     if(data.status==1){

//                        Swal.fire({
//                         position: 'top-end',
//                         // icon: 'success',
//                         title: data.message,
//                         showConfirmButton: false,
//                         color:'white',
//                         background: '#689F39',
//                         timer: 3000
//                            }).then((result) => {
//                               document.location.href=base_url+'admin/banner';
//                           });
                       
//                     }else{
//                        Swal.fire({
//                               position: 'center',
//                               icon: 'error',
//                               title: data.message,
//                               showConfirmButton: false,
//                               timer: 3000
//                                  }).then((result) => {
//                                 $('.giod').addClass('save-banner');
//                               });

//                     }
                   

//                    loading('loaderdiv','none');
                   

//                    }

//               });

// })


// $(document).on('click','.save-banner-ads',function(){

    
//     var text1=$('#text1').val();
//     // var text2=$('#text2').val();
//     // var short_details=$('#short_details').val();
//     var link=$('#link').val();
//     var desk_imgPath=$('#desk_imgPath').val();
//     // var mobile_imgPath=$('#mobile_imgPath').val();
//     var editv=$('#editv').val();

//      if($('#btn-status').is(':checked')){
//        var btn_status=1;
//      }else{
//       btn_status=0;
//      }
  

      
        // var formData = new FormData($('#my-form-banner')[0]);  

        //     formData.append('text1',text1);
        //     // formData.append('text2',text2);
        //     // formData.append('short_details',short_details);
        //     formData.append('link',link);
        //     formData.append('desk_imgPath',desk_imgPath);
        //     // formData.append('mobile_imgPath',mobile_imgPath);
        //     formData.append('editv',editv);
        //     formData.append('btn_status',btn_status);
            

        //      loading('loaderdiv','block');
        //      $('.giod').removeClass('save-banner-ads');

 
          // $.ajax({
          //         url: base_url+'Ajax_function/add_banner_ads',
          //         data: formData,
          //         processData: false,
          //         contentType: false,
          //         type: 'POST',
          //         dataType:'JSON',
          //         success: function(data){

          //           if(data.status==1){

          //              Swal.fire({
          //               position: 'top-end',
          //               // icon: 'success',
          //               title: data.message,
          //               showConfirmButton: false,
          //               color:'white',
          //               background: '#689F39',
          //               timer: 3000
          //                  }).then((result) => {
          //                     document.location.href=base_url+'admin/ads_banner';
          //                 });
                       
          //           }else{
          //              Swal.fire({
          //                     position: 'center',
          //                     icon: 'error',
          //                     title: data.message,
          //                     showConfirmButton: false,
          //                     timer: 3000
          //                        }).then((result) => {
          //                       $('.giod').addClass('save-banner-ads');
          //                     });

          //           }
                   

          //          loading('loaderdiv','none');
                   

          //          }

          //     });

//})


$(document).on('click','.save-home-testimonial',function(){
    
    var header=$('#header').val();
    var name=$('#name').val();
    var designation=$('#designation').val();
    var short_details=$('#short_details').val();
    var editv=$('#editv').val();
     var imgPath=$('#imgPath').val();
    
  

     // if(header=="" || header==null){
     //      $('#header').css('border','1px solid red');
     //      return false;
     //    }else{
     //      $('#header').css('border','1px solid #CCCCCC');
     //       status=1;
     //    }

        // if(name=="" || name==null){
        //   $('#name').css('border','1px solid red');
        //   return false;
        // }else{
        //   $('#name').css('border','1px solid #CCCCCC');
        //    status=1;
        // }

        // if(designation=="" || designation==null){
        //   $('#designation').css('border','1px solid red');
        //   return false;
        // }else{
        //   $('#designation').css('border','1px solid #CCCCCC');
        //    status=1;
        // }

         if(short_details=="" || short_details==null){
          $('#short_details').css('border','1px solid red');
          return false;
        }else{
          $('#short_details').css('border','1px solid #CCCCCC');
           status=1;
        }


        var formData = new FormData($('#my-form-home-testi')[0]);  
            formData.append('header',header);
            formData.append('name',name);
            formData.append('designation',designation);
            formData.append('short_details',short_details);
            formData.append('editv',editv);
             formData.append('imgPath',imgPath);
             loading('loaderdiv','block');
      $('.hmss').removeClass('save-home-testimonial');

 

            

          $.ajax({
                  url: base_url+'Ajax_function/add_home_testimonial',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/home_testimonial';
                          });
                       
                    }else{
                       Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                               $('.hmss').addClass('save-home-testimonial');
                               });

                    }
                   

                   loading('loaderdiv','none');
                          

                   }

              });

})

$(document).on('click','.save-policy',function(){
  var designation=$('#summernote').val();
  var field_type=$('#field-type').val();
  var editv=$('#edits_id').val();

     if(designation=="" || designation==null){
       validation('errr','Field is required.','red','errr-error');
       return false;
    }else{
       removeValidation('errr-error');
      var status=1;
     }

   
        loading('loaderdiv','block');
       $('.tm-cl').removeClass('save-policy');

       $.ajax({
               url: base_url+'common/policy_ajax',
               type: 'POST',
               dataType:'JSON',
                data: ({designation:designation,editv:editv,field_type:field_type}),
               success: function(data){

                 if(data.status==1){

                    Swal.fire({
                     position: 'top-end',
                     // icon: 'success',
                     title: data.message,
                     showConfirmButton: false,
                     color:'white',
                     background: '#689F39',
                     timer: 3000
                        }).then((result) => {
                           
                           if(field_type=='terms-condition'){
                             document.location.href=base_url+'admin/terms_of_service';
                           }else if(field_type=='refund-cancelation'){
                              document.location.href=base_url+'admin/refund_and_cancelation_policy';
                           }else if(field_type=='Privacy-policy'){
                             document.location.href=base_url+'admin/privacy_policy';
                           }else if(field_type=='shipping-policy'){
                             document.location.href=base_url+'admin/shipping_policy';
                           }else if(field_type=='faq'){
                             document.location.href=base_url+'admin/faq';
                           }else if(field_type=='disclaimer'){
                             document.location.href=base_url+'admin/disclaimer';
                           }

                           
                       });
                    
                 }else{
                         Swal.fire({
                           position: 'center',
                           icon: 'error',
                           title: data.message,
                           showConfirmButton: false,
                           timer: 3000
                              }).then((result) => {
                             $('.tm-cl').addClass('save-policy');
                            });

                 }

                  loading('loaderdiv','none');
                  

                

                }

           });


})




//   $(document).on('click','.save-ads-banner',function(){
  
//     var formData = new FormData($('#my-form-ads-banner')[0]);  
//       var get_id=$('#get_id').val();
//       var imagePath=$('#imagePath').val();
      

//             formData.append('get_id', get_id);
//             formData.append('imagePath', imagePath);
            
//            loading('loaderdiv','block');
//           $('.ads-cl').removeClass('save-ads-banner');

//           $.ajax({
//                   url: base_url+'Ajax_function/add_ads_bnner',
//                   data: formData,
//                   processData: false,
//                   contentType: false,
//                   type: 'POST',
//                   dataType:'JSON',
//                   success: function(data){

//                     if(data.status==1){

//                        Swal.fire({
//                         position: 'top-end',
//                         // icon: 'success',
//                         title: data.message,
//                         showConfirmButton: false,
//                         color:'white',
//                         background: '#689F39',
//                         timer: 3000
//                            }).then((result) => {
//                               document.location.href=base_url+'admin/offer_banner';
//                           });
                       
//                     }else{
//                            Swal.fire({
//                               position: 'center',
//                               icon: 'error',
//                               title: data.message,
//                               showConfirmButton: false,
//                               timer: 3000
//                                  }).then((result) => {
//                                 $('.ads-cl').addClass('save-ads-banner');
//                                });

//                     }
                   
//                      loading('loaderdiv','none');
                    

//                    }

//               });
        
// })



//   $(document).on('click','.action-ads-banner',function(){
   
//    $.ajax({ 
//             type: "POST",
//             dataType:"JSON",
//             url: base_url+'ajax_function/active_ads_banner_ajax',
//             // data:({message:message,ads_id:ads_id}),
//             success: function(result){

//               if(result.status==1){
//                       Swal.fire({
//                         position: 'top-end',
//                         // icon: 'success',
//                         title: result.message,
//                         showConfirmButton: false,
//                         color:'white',
//                         background: '#689F39',
//                         timer: 3000
//                            }).then((result) => {
                          
//                           });
                      
//                     }else{
//                       Swal.fire({
//                           position: 'center',
//                           icon: 'error',
//                           title: result.message,
//                           showConfirmButton: false,
//                           timer: 2000
//                              }).then((result) => {
                            
//                            });
//                     }
                  
//              }
//          });


// })


  $(document).on('keyup','.search-product',function(){

    var getid=$(this).data('id');
    var splitvalue=getid.split('_');

    var get_data_id=splitvalue[0];
    var offer_id=splitvalue[1];

    var getKeyword=$(this).val();

    console.log(splitvalue);
     
       $.ajax({ 
            type: "POST",
            // dataType:"JSON",
            url: base_url+'ajax_function/search_product_dropdown',
            data:({get_data_id:get_data_id,getKeyword:getKeyword,select_param:offer_id}),
            success: function(result){
                $('#ul-list'+get_data_id).html(result);
            }
          });

  })

$(document).on('change','.prochecked',function(){
    var get_data_id=$(this).data('id');
    var getProduct_id=$(this).val();


    // var select_param

   $.ajax({ 
            type: "POST",
            // dataType:"JSON",
            url: base_url+'ajax_function/search_packsize_dropdown',
            data:({getProduct_id:getProduct_id,get_data_id:get_data_id}),
            success: function(result){
                $('#offer-packsize'+get_data_id).html(result);
            }
          });

})




$(document).on('click','.child-cat-save',function(){
      
      var child_category=$('#child-category').val();
      var cat_id=$('#get-cat-id').val();
      var sub_cat_id=$('#sub-cat-id').val();

      var child_cat_id=$('#child-cat-id').val();

      // alert(sub_cat_id);
      
      if(child_category=="" || child_category==null){
          validation('child-category','Enter your child category.','red','child-category-error');
          return false;
       }else{
          removeValidation('child-category-error');
         var status=1;
        }


        if(status==1){
          // loading('loaderdiv','block');
        // $('.subcat-bt').removeClass('sub-cat-save');
         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/child_category_ajax',
              data:({child_category:child_category,cat_id:cat_id,sub_cat_id:sub_cat_id,child_cat_id:child_cat_id}),
              success: function(result){

                    if(result.status==1){
                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                             document.location.href=base_url+'admin/child_category/'+cat_id+'/'+sub_cat_id;
                          });
                     
                     
                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 2000
                             }).then((result) => {
                          // $('.subcat-bt').addClass('sub-cat-save');
                           });
                    }

                    // loading('loaderdiv','none');
               }
           });


         }

})


$(document).on('click','.filter-link',function(){
   
     var category_id=$('#category-id').val();
     var sub_category_id=$('#sub-category-id').val();
     var customer=$('#customer').val();
     var product=$('#product').val();
     var fromDate=$('#fromDate').val();
     var toDate=$('#toDate').val();
     var order_status=$('#order-status').val();
     
     loading('loaderdiv','block');
      $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/filter_report_ajax',
              data:({
                category_id:category_id,
                sub_category_id:sub_category_id,
                customer:customer,
                product:product,
                fromDate:fromDate,
                toDate:toDate,
                order_status:order_status
                }),
              success: function(result){

                 if(result.status==1){
                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 10000
                           }).then((result) => {
                             document.location.href=base_url+'admin/report';
                          });
                     
                     
                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 3000
                             }).then((result) => {
                          // $('.subcat-bt').addClass('sub-cat-save');
                           });
                    }
                loading('loaderdiv','none');
              }

          });

})


$(document).on('click','.werehouse-save',function(){

      var formData = new FormData($('#catForm')[0]);
     var werehouse=$('#werehouse').val();
     var wh_id=$('#get-wh-id').val();

   if(werehouse=="" || werehouse==null){
          validation('werehouse','Enter your werehouse.','red','werehouse-error');
          return false;
       }else{
          removeValidation('werehouse-error');
         var status=1;
        }

    if(status==1){
        loading('loaderdiv','block');
        $('.cat-bt').removeClass('werehouse-save');

     

         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/werehouse_ajax',
             
              data: formData,
              processData: false,
              contentType: false,
              success: function(result){
                    if(result.status==1){

                      Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                             document.location.href=base_url+'admin/werehouse';
                          });

                    }else{
                      Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: result.message,
                          showConfirmButton: false,
                          timer: 3000
                             }).then((result) => {
                          $('.cat-bt').addClass('werehouse-save');
                           });
                    }

                     loading('loaderdiv','none');
                    

               }
           });


         }
})


$(document).on('click','.save-pincode',function(){
  
    var formData = new FormData($('#my-form-pinode')[0]);  

      var werehouse_code = $('input[name="werehouse_code[]"]:checked').map(function() {
            return this.value;
        }).get();

      
      var pincode=$('#pin-code').val();
      var city_name=$('#city-name').val();
      var courier_type=$('#courier-type').val();

      var pin_code_id=$('#pin_code_id').val();

         if(werehouse_code.length==0){
              $('#werehouse-code-error').html('Select your werehouse code.');
              return false;
           }else{
               $('#werehouse-code-error').html('');
             var status=1;
            }




            var pattern = /^\d{6}$/;
           if(pincode=="" || pincode==null){
              validation('pin-code','Enter your pincode.','red','pin-code-error');
              return false;
           }else if(!pattern.test(pincode)){
             validation('pin-code','Invalid Pincode.','red','pin-code-error');
              return false;

           }else{
              removeValidation('pin-code-error');
             var status=1;
            }

            if(city_name=="" || city_name==null){
              validation('city-name','Enter your city name.','red','city-name-error');
              return false;
           }else{
              removeValidation('city-name-error');
             var status=1;
            }

            if(courier_type=="" || courier_type==null){
              validation('courier-type','Select your courier type.','red','courier-type-error');
              return false;
           }else{
              removeValidation('courier-type-error');
             var status=1;
            }
         
         if(status==1){
          loading('loaderdiv','block');
          // $('.hsn-cl').removeClass('save-pincode');
        
          $.ajax({
                  url: base_url+'Ajax_function/add_pincode',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){
                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/pincode';
                          });
                       
                    }else{
                          Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                // $('.hsn-cl').addClass('save-pincode');
                               });
                        }

                     loading('loaderdiv','none');
                     
                   }

              });
      }
})



$(document).on('click','.upt-mappi',function(){

   var getpId=$(this).data('id');

     const ele=[];
     $("input:checkbox[name=wh_code"+getpId+"]:checked").each(function(){                  
        ele.push($(this).val());
        });
    // loading('loaderdiv'+getpId,'block');
    $.ajax({
          url: base_url+'Ajax_function/pincodeMappingWithWHCode',
          type: 'POST',
          dataType:'JSON',
          data: ({ele:ele,getpId:getpId}),
          success: function(data){
             // loading('loaderdiv'+getpId,'none');
          }
      })

})



$(document).on('keyup','#search-pincode',function(){

  var getKeywords=$(this).val();
 loading('loaderdiv-searchs','block');
    $.ajax({
            url:base_url+'ajax_function/searchPincode',
            type:'POST',
            // dataType:'JSON',
            data:({'getKeywords':getKeywords}),
             success:function(data){
               $('#trRow').html(data);
              
              loading('loaderdiv-searchs','none');
             }
             
           });

})



$(document).on('change','#inputPincode',function(){

         var formData = new FormData($('#my-form-import')[0]);  

          loading('loaderdiv','block');
          $('.fordi').css('display','none');

          $.ajax({
                  url: base_url+'admin/importPincode_SVC',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.response,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        // timer: 5000
                           }).then((result) => {
                            $('#inputPincode').val('');
                            location.reload(); 
                          });
                       
                    }else{
                      Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.response,
                              showConfirmButton: false,
                              // timer: 5000
                                 }).then((result) => {
                                $('#inputPincode').val('');
                                // location.reload();
                               });
                        }
                   
                      loading('loaderdiv','none');
                      $('.fordi').css('display','block');
                   }

              });


})



$(document).on('click','.save-werehouse-details',function(){
  
    var formData = new FormData($('#my-form-contact')[0]);  
      var get_id=$('#get_id').val();
       var wh_old=$('#wh_old').val();
      

      var werehouse_code=$('#werehouse-code').val();
      var email=$('#email').val();
      var mobile=$('#mobile').val();
      var fassai_no=$('#fassai_no').val();
      var cin_no=$('#cin_no').val();
      var gst_no=$('#gst_no').val();
      var pan_no=$('#pan_no').val();
      var state_code=$('#state_code').val();
      var tin_no=$('#tin_no').val();
      var state=$('#state').val();
      var pincode=$('#pincode').val();
      var address=$('#address').val();

       if(werehouse_code=="" || werehouse_code==null){
          $('#werehouse-code').css('border','1px solid red');
          return false;
        }else{
          $('#werehouse-code').css('border','1px solid #CCCCCC');
           status=1;
        }
      
      
       var regexEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       if(email=="" || email==null){
          $('#email').css('border','1px solid red');
          return false;
        }else if(!email.match(regexEmail)){
            alert('invalid email id.');
            return false;
        }else{
          $('#email').css('border','1px solid #CCCCCC');
           status=1;
        }

         
         var pattern = /^\d{10}$/;
         if(mobile=="" || mobile==null){
          $('#mobile').css('border','1px solid red');
          return false;

        }else if(!pattern.test(mobile)){
           alert('Invalid contact number.');
           return false;

        }else{
          $('#mobile').css('border','1px solid #CCCCCC');
           status=1;
        }


        if(state_code=="" || state_code==null){
          $('#state_code').css('border','1px solid red');
          return false;
        }else{
          $('#state_code').css('border','1px solid #CCCCCC');
           status=1;
        }

         if(tin_no=="" || tin_no==null){
          $('#tin_no').css('border','1px solid red');
          return false;
        }else{
          $('#tin_no').css('border','1px solid #CCCCCC');
           status=1;
        }


        

         if(state=="" || state==null){
          $('#state').css('border','1px solid red');
          return false;
        }else{
          $('#state').css('border','1px solid #CCCCCC');
           status=1;
        }


         var pattern_pincode = /^\d{6}$/;
        if(pincode=="" || pincode==null){
          $('#pincode').css('border','1px solid red');
          return false;
        }else if(!pattern_pincode.test(pincode)){
           alert('Invalid Pincode.');
           return false;

        }else{
          $('#pincode').css('border','1px solid #CCCCCC');
           status=1;
        }



        if(address=="" || address==null){
          $('#address').css('border','1px solid red');
          return false;
        }else{
          $('#address').css('border','1px solid #CCCCCC');
           status=1;
        }

     
if(status==1){
              
            formData.append('get_id', get_id);
            formData.append('werehouse_code', werehouse_code);
            formData.append('email', email);
            formData.append('mobile', mobile);
            formData.append('fassai_no', fassai_no);
            formData.append('cin_no', cin_no);
            formData.append('gst_no', gst_no);
            formData.append('pan_no', pan_no);
            formData.append('state_code', state_code);
            formData.append('tin_no', tin_no);
            formData.append('state', state);
            formData.append('pincode', pincode);
            formData.append('address', address);
            formData.append('wh_old', wh_old);
            
            
           loading('loaderdiv','block');
          $('.rotf').removeClass('save-werehouse-details');

          $.ajax({
                  url: base_url+'Ajax_function/add_werehouse_details',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){

                    if(data.status==1){

                       Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        color:'white',
                        background: '#689F39',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/werehouse_details';
                          });
                       
                    }else{
                           Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: data.message,
                              showConfirmButton: false,
                              timer: 3000
                                 }).then((result) => {
                                $('.rotf').addClass('save-werehouse-details');
                               });

                    }
                   
                     loading('loaderdiv','none');
                    

                   }

              });
        }
})

function isNumeric(event) {
        var keyCode = event.which ? event.which : event.keyCode;
        if (keyCode < 48 || keyCode > 57) {
            event.preventDefault();
            return false;
        }
        return true;
    }

function validateIgst() {
        var igstInput = document.getElementById('igst');
        var igstValue = igstInput.value.replace(/[^0-9]/g, '');
        if (igstValue < 0) {
            igstValue = 0;
        }
        if (igstValue > 100) {
            return;
        }
        igstInput.value = igstValue;
    }
    
function validateCgst() {
        var igstInput = document.getElementById('cgst');
        var igstValue = igstInput.value.replace(/[^0-9]/g, '');
        if (igstValue < 0) {
            igstValue = 0;
        }
        if (igstValue > 100) {
            return;
        }
        igstInput.value = igstValue;
    }

function validateSgst() {
        var igstInput = document.getElementById('sgst');
        var igstValue = igstInput.value.replace(/[^0-9]/g, '');
        if (igstValue < 0) {
            igstValue = 0;
        }
        if (igstValue > 100) {
            return;
        }
        igstInput.value = igstValue;
    } 

var priceInputs = document.getElementsByClassName('price-class');
    for (var i = 0; i < priceInputs.length; i++) {
        priceInputs[i].addEventListener('input', function () {
            validatePrice(this);
        });
    }
  function validatePrice(input) {
        //alert("wwwww");
        var priceValue = input.value.replace(/[^0-9]/g, '');
        if (priceValue < 0) {
            priceValue = 0;
        }
        if (priceValue > 100) {
            return;
        }
        input.value = priceValue;
    }  

var stockInputs = document.getElementsByClassName('stock-class');
    for (var i = 0; i < stockInputs.length; i++) {
        stockInputs[i].addEventListener('input', function () {
            validatePrice(this);
        });
    }
  function validatePrice(input) {
        //alert("wwwww");
        var stockValue = input.value.replace(/[^0-9]/g, '');
        if (stockValue < 0) {
            stockValue = 0;
        }
        if (stockValue > 100) {
            return;
        }
        input.value = stockValue;
    }         

function validateNonNegativeNumber(inputElement) {
    var inputValue = inputElement.value;
    inputValue = inputValue.replace(/[^0-9]/g, '');
    inputElement.value = inputValue;
}

function validateCharactersonly(inputElement) {
    var inputValue = inputElement.value;
    inputValue = inputValue.replace(/[^a-zA-Z]/g, '');
    inputElement.value = inputValue;
}

function validateMobile(inputElement) {
    var inputValue = inputElement.value;
    inputValue = inputValue.replace(/\D/g, '');
    inputValue = inputValue.substring(0, 10);
    inputElement.value = inputValue;
}

function togglePassword() {
    var passwordInput = document.getElementById('password');
    var toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function toggleconPassword() {
    var passwordInput = document.getElementById('conf_password');
    var toggleIcon = document.getElementById('toggleconPassword');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function validateHSNCode() {
    var hsnCodeInput = document.getElementById('hsn_code');
    var hsnCodeValue = hsnCodeInput.value.replace(/[^0-9]/g, '');
    hsnCodeInput.value = hsnCodeValue;
}

//Add Banner header text field validation.
$(document).ready(function () {
        $('#text1').keyup(function () {
            var inputValue = $(this).val();
            if (inputValue.length > 100) {
                $('#text1-error').text('Please enter less than 100 characters.');
            } else {
                $('#text1-error').text('');
            }
        });
    });

//Add Banner Link text field validation.
function validateLink() {
    var linkValue = $('#link').val();
    var urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
    if (!urlRegex.test(linkValue) && linkValue.length > 0) {
        var correctedURL = 'http://' + linkValue;
        if (!urlRegex.test(correctedURL)) {
            $('#link-error').text('Please enter a valid URL.');
        } else {
            $('#link-error').text('');
        }
    } else {
        $('#link-error').text('');
    }
}

function validateDesignation() {
    var designationInput = document.getElementById("designation").value;
    var pattern = /^[a-zA-Z ]+$/;

    if (pattern.test(designationInput)) {
        document.getElementById("designation-error").innerText = "";
    } else {
        document.getElementById("designation-error").innerText = "Please enter only alphabets.";
    }
}

function validateName() {
    var nameInput = document.getElementById("name").value;
    var pattern = /^[a-zA-Z\s]*$/; 

    if (pattern.test(nameInput)) {
        document.getElementById("name-error").innerText = "";
    } else {
        document.getElementById("name-error").innerText = "Enter only alphabets.";
    }
}


function addOthetProduct(){
   
    var formData = new FormData($('#form-other-product')[0]);
    formData.append('form_action', 'submitform');
          $.ajax({
            type: 'post',
            url: base_url+'Ajax_function/add_other_product',
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                 
            },

            success: function(res) {
              
                if(res.error==0){
                    $('#form-other-product')[0].reset();
                    Swal.fire('Success','success'); 

                }
                else{
                   Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!',
                    })
                }
            },
            complete: function() {
                 //$.unblockUI();
              // $('#btn1').css('display', 'block');
              // $('#btn2').css('display', 'none');
            },
            error: function(xhr, status, error) {
              console.log(error);
            },
          });

}