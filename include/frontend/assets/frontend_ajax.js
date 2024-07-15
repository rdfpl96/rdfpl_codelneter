@ -859,7 +859,107 @@ $(document).on('click','.billing-address-save',function(){
                  }
            })
     }
})

   
$(document).on('click','.newletter',function(){
    //alert("hdasjhd");
    var email = $('#newsletter-email').val();

      var regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
       if(email=="" || email==null){
         $('#newsletter-email').css('border','1px solid red');
        return false;
      }else if(!email.match(regexEmail)){
        $('#newsletter-email').css('border','1px solid red');
        return false;
      }else{
      $('#newsletter-email').css('border','1px solid #CCCCCC');
        status=1;
      }

       

 if(status==1){
         loading('loaderdiv-subs','block');
         $('.btn-dis').removeClass('newletter');
      $.ajax({
              url:base_url+'common/newletter',
              type:'POST',
              dataType:'JSON',
              data:({email:email}),
              success:function(data){

                if(data.status==1){

                      var x = document.getElementById("snackbar");
                      x.className = "show";
                      var message=data.message;
                      document.getElementById('snackbar').innerText=message;
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

                    }else{
                        
                        var x = document.getElementById("snackbar");
                          x.className = "show";
                          var message=data.message;
                          document.getElementById('snackbar').innerText=message;
                          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                          $('#snackbar').addClass('errrol');
                      }

                      $('.btn-dis').addClass('newletter');
                   loading('loaderdiv-subs','none');
                }

            });

   }


})

$(document).on('click','.wish-div',function(){
  var wish_list=$(this).data('id');
   $.ajax({ 
              type: "POST",
              dataType:"JSON",
              url: base_url+'wishlist/add_wishlist',
              data:({wish_list:wish_list}),
              success: function(result){
             
               if(result.status==1){
                 var getv=atob(wish_list);
                  if(result.message=='add'){
                      var mes='Added';
                      $('.idss'+getv).addClass('wishlistactive');
                  }else if(result.message=='remove'){
                      mes='Removed';
                      $('.idss'+getv).removeClass('wishlistactive');
                      $('.rediv'+getv).remove();
                      $(".refe-dv").load(location.href + " #refpa");
                   }

                   $(".wiscal").load(location.href + " #wishit");
                   $(".wismob").load(location.href + " #wissmob");

                   var x = document.getElementById("snackbar");
                  x.className = "show";
                  var message=mes;
                  document.getElementById('snackbar').innerText=message;
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  // $(".wiscout").load(location.href + " .wisli");
                   
                  }else{

                     var x = document.getElementById("snackbar");
                      x.className = "show";
                      $('#snackbar').addClass('errrol');
                      document.getElementById('snackbar').innerText=result.message;
                      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      
                  }

              }
         });

})