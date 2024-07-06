
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

  var base_url=$('.base_url').val();
    function validation(idName,message,color,className){
		  if(!$('.'+className).hasClass(className)) {
		      $('#'+idName).after('<p class="'+className+'" style="color:'+color+';">'+message+'</p>');
		    }
     }

	function removeValidation(className){
	  $('.'+className).remove();
	}



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

	       $.ajax({ 
	            type: "POST",
	            dataType:"JSON",
	            url: base_url+'ajax_function/foodHabitats_ajax',
	            data:({food_habitat:food_habitat,food_id:food_id}),
	            success: function(result){
	                  if(result.status==1){
	                  	alert(result.message);
	                  	document.location.href=base_url+'admin/food_habitats';
	                  }else{
	                  	alert(result.message);
	                  }
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

         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/units_ajax',
              data:({units:units,units_id:units_id}),
              success: function(result){
                    if(result.status==1){
                      alert(result.message);
                      document.location.href=base_url+'admin/units_manage';
                    }else{
                      alert(result.message);
                    }
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

         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/period_type_ajax',
              data:({period:period,period_id:period_id}),
              success: function(result){
                    if(result.status==1){
                      alert(result.message);
                      document.location.href=base_url+'admin/period_type';
                    }else{
                      alert(result.message);
                    }
               }
           });
         }
})


$(document).on('click','.cate-save',function(){
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
         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/category_ajax',
              data:({category:category,cat_id:cat_id}),
              success: function(result){
                    if(result.status==1){
                      alert(result.message);
                      document.location.href=base_url+'admin/category';
                    }else{
                      alert(result.message);
                    }
               }
           });


         }

})


$(document).on('click','.sub-cat-save',function(){
      
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
         $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'ajax_function/sub_category_ajax',
              data:({sub_category:sub_category,cat_id:cat_id,sub_cat_id:sub_cat_id}),
              success: function(result){
                    if(result.status==1){
                      alert(result.message);
                      document.location.href=base_url+'admin/sub_category/'+cat_id;
                    }else{
                      alert(result.message);
                    }
               }
           });


         }

})


$(document).on('click','.login-admin',function(){
     
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

                    $('#loader').css('display','block');
                   $.ajax({
                             url:base_url+'ajax_function/admin_login',
                             type:'POST',
                             dataType:'JSON',
                             data:({username:username,userpassword:userpassword}),
                             success:function(data){

                                  if(data.status==1){
                                      alert(data.message);
                                      document.location.href=base_url+"admin/dashboard";
                                  }else{
                                    alert(data.message);
                                  }

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
                   alert(data.message);
                   $('#p'+data.id[0]).prop("checked", false);
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
                            '<input type="number" class="form-control stock-class" name="stock[]" id="stock'+increment+'" value="">'+
                          '</td>'+
                           '<td>'+
                            '<input type="number" class="form-control conv-class" name="conversion_factor[]" id="conversion-factor'+increment+'" value="">'+
                          '</td>'+
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
  var stock=$('#stock'+variant_id).val();
  var conversion_factor=$('#conversion-factor'+variant_id).val();
  
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

        if(conversion_factor=="" || conversion_factor==null){
          $('#conversion-factor'+variant_id).css('border','1px solid red');
          return false;
        }else{
           $('#conversion-factor'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


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
              stock:stock,
              conversion_factor:conversion_factor,
              ext_sku_id:ext_sku_id
            }),
            success:function(result){
                
                  if(result.status==1){
                      alert(result.message);
                     location.reload();
                  }else{
                    alert(result.message);
                  }


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


        var conversion_factor=$('input[name="conversion_factor[]"]').map(function(){
                  return this.value;
           }).get();


      var delivery_palce=$('input[name="delivery_palce[]"]:checked').map(function(){
                  return this.value;
           }).get();

      var food_habit=$('input[name="food_habit[]"]:checked').map(function(){
                  return this.value;
           }).get();


       
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
          validation('product-name','Field is required.','red','product_name-error');
          return false;
        }else{
          removeValidation('product_name-error');
          status=1;
        }

      
        var cat_id=$('#cat-id').val();
       if(cat_id=="" || cat_id==null){
          validation('cat-id','Field is required.','red','cat-id-error');
          return false;
        }else{
          removeValidation('cat-id-error');
          status=1;
        }
       

       var sub_cat_id=$('#sub_cat_id').val();
       if(sub_cat_id=="" || sub_cat_id==null){
          validation('sub_cat_id','Field is required.','red','sub_cat_id-error');
          return false;
        }else{
          removeValidation('sub_cat_id-error');
          status=1;
        }


 


            var hsn_code=$('#gsearchsimple').val();
            if(hsn_code=="" || hsn_code==null){
              removeValidation('gstErr-error');
              validation('gsearchsimple','Field is required.','red','hsn_code-error');
              return false;
            }else{
              removeValidation('hsn_code-error');
              status=1;
            }

             var cgst=$('#cgst').val();
            if(cgst=="" || cgst==null){
              removeValidation('gstErr-error');
              validation('gstErr','Field is required.','red','gstErr-error');
              return false;
            }else{
              removeValidation('gstErr-error');
              status=1;
            }

             var igst=$('#igst').val();
            if(igst=="" || igst==null){
              removeValidation('gstErr-error');
              validation('gstErr','Field is required.','red','gstErr-error');
              return false;
            }else{
              removeValidation('gstErr-error');
              status=1;
            }

             var sgst=$('#sgst').val();
            if(sgst=="" || sgst==null){
              removeValidation('gstErr-error');
              validation('gstErr','Field is required.','red','gstErr-error');
              return false;
            }else{
              removeValidation('gstErr-error');
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

            if(delivery_palce.length==0){
               validation('checkErr','Please select your delivery type.','red','checkErr-error');
               return false;
            }else{
               removeValidation('checkErr-error');
               status=1;
            }
            

            if(food_habit.length==0){
               validation('checkfoodErr','Please select your food habitats.','red','checkfoodErr-error');
               return false;
            }else{
               removeValidation('checkfoodErr-error');
               status=1;
            }





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

            
             var ingredients=$('#ingredients').val();
              if(ingredients=="" || ingredients==null){
                validation('ingredients','Field is required.','red','ingredients-error');
                return false;
              }else{
                removeValidation('ingredients-error');
                status=1;
              }
           

            var period=$('#period').val();
              if(period=="" || period==null){
                validation('errShef','Field is required.','red','errShef-error');
                return false;
              }else{
                removeValidation('errShef-error');
                status=1;
              }



           
             var storage_condition=$('#storage_condition').val();
              if(storage_condition=="" || storage_condition==null){
                validation('storage_condition','Field is required.','red','storage_condition-error');
                return false;
              }else{
                removeValidation('storage_condition-error');
                status=1;
              }

               var tags=$('#tags').val();
              if(tags=="" || tags==null){
                validation('tags','Field is required.','red','tags-error');
                return false;
              }else{
                removeValidation('tags-error');
                status=1;
              }




    
          if(status==1){
            // if(product_id!="" && product_verients==""){
            //   var urls=base_url+'ajax_function/update_product';
            // }else{
            //   urls=base_url+'ajax_function/validate_Varients';
            // }

          $.ajax({
                  url: base_url+'ajax_function/validate_Varients',
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(data){
                
                       if(data.status=='vli'){

                            data.validate.forEach(function(value,index){
                              // alert(value.inc_num);
                                    var sku_id_val=value.sku_id;
                                  if(sku_id_val==0){
                                    $('#sku-id'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                    // $('#sku-id'+value.inc_num).css('border','1px solid #CCCCCC');
                                    $('#sku-id'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }


                                   var pack_size_val=value.pack_size;
                                  if(pack_size_val==0){
                                    $('#pach-size'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                    // $('#pach-size'+value.inc_num).css('border','1px solid #CCCCCC');
                                    $('#pach-size'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }


                                   var units_val=value.units;
                                  if(units_val==0){
                                    $('#units'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                    // $('#units'+value.inc_num).css('border','1px solid #CCCCCC');
                                    $('#units'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }

                                  var price_val=value.price;
                                  if(price_val==0){
                                    $('#price'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                    // $('#price'+value.inc_num).css('border','1px solid #CCCCCC');
                                    $('#price'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }


                                  var stock_val=value.stock;
                                  if(stock_val==0){
                                    $('#stock'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                      // $('#stock'+value.inc_num).css('border','1px solid #CCCCCC');
                                    $('#stock'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }

                                  var conversion_factor_val=value.conversion_factor;
                                  if(conversion_factor_val==0){
                                    $('#conversion-factor'+value.inc_num).css('border','1px solid red');
                                    return false;
                                  }else{
                                    // $('#conversion-factor'+data.validate.inc_num).css('border','1px solid #CCCCCC');
                                     $('#conversion-factor'+value.inc_num).css('border','1px solid #CCCCCC');
                                     status=1;
                                  }
                            })


                       }else if(data.status==1){
                         
                           getSubmitProduct(formData,product_id);

                       }
                 
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

  
         $.ajax({
                  url: urls,
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'JSON',
                  success: function(result){
                     if(result.status==1){
                          alert(result.message);
                          // document.location.href=base_url+"admin/dashboard";
                          location.reload();
                      }else if(result.status=='check_sku'){
                            $('#sku-id'+result.valuesdata.incName).css('border','1px solid red');
                           // console.log(result.valuesdata.incName);
                           alert(result.message);
                      }else{
                        alert(result.message);
                      }

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
                          alert(data.message);
                          location.reload();
                        }else{
                          alert(data.message);
                        }
            }
          });



      // alert('hiiii');
    }

})


$(document).on('click','.update-order-status',function(){
  
  var order_status=$('#order-status').val();
  var order_ids =$('#order-ids').val();

   $.ajax({
            url:base_url+'ajax_function/delivery_status',
            type:'POST',
            dataType:'JSON',
            data:({order_ids:order_ids,
                  order_status:order_status}),
            success:function(data){

                 if(data.status==1){
                  alert(data.message);
                  location.reload();
                }else{
                  alert(data.message);
                }
            }

          });


})



$(document).on('change','#inputImage',function(){

         var formData = new FormData($('#my-form-import')[0]);  

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
                        background: '#B12234',
                        timer: 3000
                           }).then((result) => {
                            $('#inputHSN').val('');
                            location.reload(); 
                          });
                       
                    }else{
                      alert(data.response);
                       $('#inputHSN').val('');
                    }
                   

                   }

              });


})


$(document).on('click','.save-customer',function(){
  
    var formData = new FormData($('#my-form-customer')[0]);  

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
                        background: '#B12234',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'/customer_list';
                          });
                       
                    }else{
                      alert(data.message);
                    }
                   

                   }

              });
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

      $.ajax({
            url:base_url+'ajax_function/shipping_charges_manage',
            type:'POST',
            dataType:'JSON',
            data:getData,
            success:function(data){

                 if(data.status==1){
                  alert(data.message);
                  location.reload();
                }else{
                  alert(data.message);
                }
            }

          });

})



$(document).on('keyup','#search-product',function(){

  var getKeywords=$(this).val();

    $.ajax({
            url:base_url+'ajax_function/searchProducts',
            type:'POST',
            // dataType:'JSON',
            data:({'getKeywords':getKeywords}),
             success:function(data){
               $('#trRow').html(data);
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
    $.ajax({
            url:base_url+'ajax_function/searchOrders',
            type:'POST',
            // dataType:'JSON',
             data:({'fromDate':fromDate,'toDate':toDate,'getKeywords':getKeywords,'orderStatus':status}),
             success:function(data){
               $('#trRow').html(data);
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

       $.ajax({
          url:base_url+'ajax_function/searchOrders',
          type:'POST',
          // dataType:'JSON',
          data:({'fromDate':fromDate,'toDate':toDate,'getKeywords':getKeywords,'orderStatus':status}),
           success:function(data){
             $('#trRow').html(data);
           }
         });

 }


});


$(document).on('click','.btn-status-class',function(){
  let status = $(".btn-status-class:checked").map((i, el) => el.value).get();
  var fromDate=$('#fromDate').val();
  var toDate=$('#toDate').val();
  var getKeywords=$('#search-orders').val();
   $.ajax({
          url:base_url+'ajax_function/searchOrders',
          type:'POST',
          data:({'fromDate':fromDate,'toDate':toDate,'getKeywords':getKeywords,'orderStatus':status}),
           success:function(data){
             $('#trRow').html(data);
           }
         });
  // console.log(opts);
})



$(document).on('change','#inputHSN',function(){

         var formData = new FormData($('#my-form-import')[0]);  

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
                        background: '#B12234',
                        timer: 3000
                           }).then((result) => {
                            $('#inputImage').val('');
                            location.reload(); 
                          });
                       
                    }else{
                      alert(data.response);
                       $('#inputImage').val('');
                    }
                   

                   }

              });


})


$(document).on('click','.save-hsn',function(){
  
    var formData = new FormData($('#my-form-hsn')[0]);  

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
                        background: '#B12234',
                        timer: 3000
                           }).then((result) => {
                              document.location.href=base_url+'admin/hsn_code';
                          });
                       
                    }else{
                      alert(data.message);
                    }
                   

                   }

              });
})


$(document).on('keyup','#search-hsn',function(){

  var getKeywords=$(this).val();

    $.ajax({
            url:base_url+'ajax_function/searchHsn',
            type:'POST',
            // dataType:'JSON',
            data:({'getKeywords':getKeywords}),
             success:function(data){
               $('#trRow').html(data);
             }

           });

})


$(document).on('change','.purchase_class',function(){

    var getPurchaseType=$(this).val();
    if(getPurchaseType=='amount_purchase'){
       $('.purchase_label').text('Min. Purchase Amt');
       $('.purchase_input').attr('id', 'min_purch_amt');
       $('.purchase_input').attr('name', 'min_purch_amt');
       $('.purchase_input').val('');
    }else if(getPurchaseType=='qty_purchase'){
       $('.purchase_label').text('Min. Purchase qty');
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
                'coupon_id':coupon_id
              };
  
   $.ajax({
            url:base_url+'ajax_function/coupon_manage',
            type:'POST',
            dataType:'JSON',
            data:arrPost,
            success:function(data){

                 if(data.status==1){
                  alert(data.message);
                  document.location.href=base_url+'admin/coupon_list';
                }else{
                  alert(data.message);
                }
            }

          });

    
})


$(document).on('click','.save-blogs',function(){
    
       var blog_header=$('#blog_header').val();
       var blog_category=$('#blog_category').val();
       var blog_description=$('#blog_description').val();
       var blog_tag_field=$('#blog_tag_field').val();


       if(blog_header=="" || blog_header==null){
          validation('blog_header','Field is required.','red','blog-header-error');
          return false;
        }else{
          removeValidation('blog-header-error');
          status=1;
        }



       if(blog_category=="" || blog_category==null){
          validation('blog_category','Field is required.','red','blog_category-error');
          return false;
        }else{
          removeValidation('blog_category-error');
          status=1;
        }

        if(blog_description=="" || blog_description==null){
          validation('blog_description','Field is required.','red','blog_description-error');
          return false;
        }else{
          removeValidation('blog_description-error');
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
                              background: '#B12234',
                              timer: 3000
                                 }).then((result) => {
                                    document.location.href=base_url+'admin/blogs';
                                });
                             
                          }else{
                            alert(data.message);
                          }
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

  var pname=$('#pname'+variant_id).val();
  var psize=$('#psize'+variant_id).val();
  var offer_units=$('#offer-units'+variant_id).val();
  var pqty=$('#pqty'+variant_id).val();
  var img_pro_path=$('#img_pro_path'+variant_id).val();

  


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

           if(min_qty=="" || min_qty==null){
          $('#min-qty'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#min-qty'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }


        if(pname=="" || pname==null){
          $('#pname'+variant_id).css('border','1px solid red');
          return false;
        }else{
          $('#pname'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

        if(psize=="" || psize==null){
          $('#psize'+variant_id).css('border','1px solid red');
          return false;
        }else{
           $('#psize'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

         if(offer_units=="" || offer_units==null){
          $('#offer-units'+variant_id).css('border','1px solid red');
          return false;
        }else{
           $('#offer-units'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

          if(pqty=="" || pqty==null || pqty < 1){
          $('#pqty'+variant_id).css('border','1px solid red');
          return false;
        }else{
           $('#pqty'+variant_id).css('border','1px solid #CCCCCC');
           status=1;
        }

var start_date=$('#start-date'+variant_id).val();
  var end_date=$('#end-date'+variant_id).val();
  var product_name_purchase=$('#product-name-purchase'+variant_id).val();
  var min_qty=$('#min-qty'+variant_id).val();

  var pname=$('#pname'+variant_id).val();
  var psize=$('#psize'+variant_id).val();
  var offer_units=$('#offer-units'+variant_id).val();
  var pqty=$('#pqty'+variant_id).val();
   var formData = new FormData($('#myforms'+variant_id)[0]);  

        formData.append('variant_id',variant_id);
        formData.append('start_date',start_date);
        formData.append('end_date',end_date);
        formData.append('product_name_purchase',product_name_purchase);                 
        formData.append('min_qty',min_qty);
        formData.append('pname',pname);
        formData.append('psize',psize);
        formData.append('offer_units',offer_units);
        formData.append('pqty',pqty);
        formData.append('offer_id',offer_id);
        formData.append('img_pro_path',img_pro_path);
        

    if(status==1){

           $.ajax({

              url: base_url+'ajax_function/apply_product_offers',
              data: formData,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'JSON',
              success:function(result){
                
                  if(result.status==1){
                      alert(result.message);
                     location.reload();
                  }else{
                    alert(result.message);
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
                    alert(data.message);
                    location.reload();
                   }else{
                    alert(data.message);
                   }

               //  if(data.status==1){
               //        alertShow=data.message;
               //        alert='alert-success';
               //      location.reload();
               //  }else{
               //      alertShow=data.message;
               //      alert='alert-danger';
               // } 

               //  var html='<div class="alert '+alert+' alert-dismissible fade show" role="alert">'+
               //              '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
               //                  '<span aria-hidden="true">&times;</span>'+
               //             '</button>'+
               //              '<strong>Thank you!</strong> '+alertShow+
               //          '</div>';

               //     setTimeout(function(){
               //          $(".message").fadeOut();
               //          }, 1500);
                      
               //        $('.message').html(html).fadeIn();         
               //      $('#loader').css('display','none');
            }


        });

    }
})

// $(document).on('click','.move-next',function(){
   
//    var getKeywords=$(this).val();

//     $.ajax({
//             url:base_url+'ajax_function/searchProducts',
//             type:'POST',
//             // dataType:'JSON',
//             data:({'getKeywords':getKeywords}),
//              success:function(data){
//                $('#trRow').html(data);
//              }

//         });
// });


