// Pramod
var base_url = "http://rdfpl.com/";

// Pramod
//var base_url = "http://localhost/rdfpl";

// function showLogin(){
//     alert('hi');
//     $('#login-modal-user').modal({ show: true });
// }  

function searchProduct() {
    var pkeyword = $('#searchproduct').val();
    $('.search-product-list').html('');
    if (pkeyword.length >= 3) {
        $.ajax({
            url: base_url + '/product-search',
            type: 'POST',
            dataType: 'JSON',
            data: ({ 'pkeyword': pkeyword }),
            success: function (res) {
                console.log(res.data);
                $('.search-product-list').html(res.data);
            }

        });
    }
}

$(document).on('click', '.shipping-address-save', function (e) {
    //alert('Hii');
    e.preventDefault();
    
    // Get values from form
    let fname = $('#fname').val().trim();
    let lname = $('#lname').val().trim();
    let mobile = $('#mobile').val().trim();
    let address1 = $('#apart_house').val().trim();
    let address2 = $('#apart_name').val().trim();
    let area = $('#area').val().trim();
    let landmark = $('#street_landmark').val().trim();
    let state = $('#state').val().trim();
    let city = $('#city').val().trim();
    let pincode = $('#pincode').val().trim();
    let address_type = $('input[name="loc_type"]:checked').val();
    // let other_loc = $('#other_loc').val().trim();
    let other_loc = $('input[name="type"]:checked').val();

    // Validation
    let isValid = true;
    let pattern = /^\d{10}$/;

    function validateField(selector, condition) {
        if (condition) {
            $(selector).css('border', '1px solid red');
            isValid = false;
        } else {
            $(selector).css('border', '1px solid #CCCCCC');
        }
    }

    // Validate fields
    validateField('#fname', fname === "");
    validateField('#lname', lname === "");
    validateField('#mobile', mobile === "" || !pattern.test(mobile));
    validateField('#apart_house', apart_house === "");
    validateField('#apart_name', apart_name === "");
    validateField('#area', area === "");
    validateField('#street_landmark', street_landmark === "");
    validateField('.select2-selection-state', state === "");
    validateField('#pincode', pincode === "");
    validateField('#loc_type', address_type === "");

    if (address_type === "Other") {
        validateField('#other_loc', other_loc === "");
    }

    // If validation fails, stop the process
    if (!isValid) {
        return false;
    }

    // Prepare form data
    var formData = {
        fname: fname,
        lname: lname,
        mobile: mobile,
        address1: address1,
        address2: address2,
        area: area,
        landmark: landmark,
        state: state,
        city: city,
        pincode: pincode,
        address_type: address_type,
        other_loc: other_loc
    };

    console.log('Form Data:', formData); 
    // $.ajax({
    //     url: base_url + 'common/shipping_address_save',
    //     dataType : 'JSON',
    //     type: 'POST',
    //     data: formData,
    //     success: function (response) {
    //         let res = JSON.parse(response);
    //         if (res.status === 'success') {
    //             alert('Address saved successfully');
    //             window.location.reload();
    //         } else {
    //             alert(res.message || 'Failed to save address');
    //         }
    //     },
        
    //     error: function (xhr, status, error) {
    //         console.log('AJAX Error:', error);
    //         console.log('Response Text:', xhr.responseText); 
    //         alert('Error in saving address. Please check the console for details.');
    //     }
    // });



$.ajax({
    type: "POST",
    dataType: "JSON",
    url: base_url + '/common/shipping_address_save',
    data: formData,
    success: function (result) {
        console.log('xxxxx=> ', result);
    let res = JSON.parse(response);
    if (res.status === 'success') {
    alert('Address saved successfully');
    window.location.reload();
    } else {
    alert(res.message || 'Failed to save address');
    }

    },
    error: function (xhr, status, error) {
        console.log('AJAX Error:', error);
        console.log('Response Text:', xhr.responseText); 
        alert('Error in saving address. Please check the console for details.');
    }
})










});
//
// Add To WishList
// Previous code
// function addToWishlist(product_id){
//     $.ajax({
//         url:base_url+'add-to-wishlist',
//         type:'POST',
//         dataType:'JSON',
//         data:({'product_id':product_id}),
//          success:function(res){
//            if(res.status==1){
//                 $('#wishitcount').text(res.pcount);

//                 $('#Wishlist'+product_id).addClass('wishlistactive');
//            }
//            var x = document.getElementById("snackbar");
//           x.className = "show";
//           var message=res.message;
//           document.getElementById('snackbar').innerText=message;
//           setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
//         }
//     });
// }

// function addToWishlist(product_id) {
//     var isInWishlist = $('#Wishlist' + product_id).hasClass('wishlistactive');

//     $.ajax({
//         url: base_url + 'add-to-wishlist',
//         type: 'POST',
//         dataType: 'JSON',
//         data: { 'product_id': product_id },
//         success: function(res) {
//             if (res.status == 1) {
//                 $('#wishitcount').text(res.pcount);

//                 if (isInWishlist) {
//                     $('#Wishlist' + product_id).removeClass('wishlistactive');
//                     isInWishlist = false; 
//                 } else {
//                     $('#Wishlist' + product_id).addClass('wishlistactive');
//                     isInWishlist = true; 
//                 }
//             } else {
//                 // Handle error messages
//                 alert(res.message);
//             }

//             // Show message in snackbar
//             var x = document.getElementById("snackbar");
//             x.className = "show";
//             var message = res.message;
//             document.getElementById('snackbar').innerText = message;
//             setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//             alert('An error occurred. Please try again later.');
//         }
//     });
// }

function addToWishlist(product_id) {
    var isInWishlist = $('#Wishlist' + product_id).hasClass('wishlistactive');

    $.ajax({
        url: base_url + 'add-to-wishlist',
        type: 'POST',
        dataType: 'JSON',
        data: { 'product_id': product_id, 'action': isInWishlist ? 'remove' : 'add' },
        success: function (res) {
            if (res.status == 1) {
                $('#wishitcount').text(res.pcount);

                if (isInWishlist) {
                    $('#Wishlist' + product_id).removeClass('wishlistactive');
                } else {
                    $('#Wishlist' + product_id).addClass('wishlistactive');
                }
            } else {
                alert(res.message);
            }

            var x = document.getElementById("snackbar");
            x.className = "show";
            var message = res.message;
            document.getElementById('snackbar').innerText = message;
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred. Please try again later.');
        }
    });
}


function onHoverTopCat(thisobj, tocat_id) {
    console.log(tocat_id);
    $(this).addClass('active');
    if ($(this).hasClass('active')) {
        $(".link-filter").not(this).removeClass('active');
    }
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: base_url + 'getSubCategoryTopId/' + tocat_id,
        data: ({ cat_id: tocat_id }),
        success: function (res) {
            //console.log(res.subcategories);
            var html = '';
            if (res?.subcategories.length > 0) {
                res.subcategories.forEach((element, index) => {

                    var active = '';
                    if (index == 0) {

                        getChildDataBySubCatId(tocat_id, element.sub_cat_id);
                        active = 'active';
                    }
                    html += '<li><a href="' + base_url + 'shop/' + element.top_cat_slug + '/' + element.slug + '" id="sub-i" class="link-filter-sub ' + active + '">' + element.subCat_name + '</a></li>'
                });
            }
            $('#sub-cat').html(html);
        }
    });
}


function onHoverSubCat(thisobj, tocat_id, sub_cat_id) {
    console.log(tocat_id);
    getChildDataBySubCatId(tocat_id, sub_cat_id);
}


function getChildDataBySubCatId(tocat_id, sub_cat_id) {

    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: base_url + 'getChildDataBySubCatId/' + tocat_id + '/' + sub_cat_id,
        success: function (res) {
            var html1 = '';
            if (res?.chilcategories.length > 0) {
                res.chilcategories.forEach((element, index) => {

                    html1 += '<li><a href="' + base_url + 'shop/' + element.top_cat_slug + '/' + element.sub_cat_slug + '/' + element.slug + '" id="chi-sub-i" class="link-filter-child">' + element.childCat_name + '</a></li>';
                });
            }
            $('#child-cat').html(html1);
        }
    });
}




function eraseError() {
    $('#alertMess').html('');
}
function Login() {

    var email_mobi = $('#email_mobi').val();
    var html = '';
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'login',
        data: ({ email_mobi: email_mobi }),
        success: function (result) {
            if (result.status == 1) {
                document.getElementById('email_mobi').readOnly = true;

                $('#editfield').html('<div class="fa fa-pencil" onclick="editlogin()"></div>');

                setTimeout(function () {
                    $('.login-otp-input').fadeIn().css('display', 'block');
                }, 1000);

                html = '<div class="alert-success alert-div">' + '<strong>Success!</strong> ' + result.message + '</div>';
                $('#otpbtn').html(`<button type="button" class="btn btn-fill-out btn-block hover-up font-weight-bold oi confinue-login popup_login_btn" onclick="verifyOtp();return false;">Verify Otp</button>`);
            } else {
                html = '<div class="alert-danger alert-div">' +
                    '<strong>Oops!</strong> ' + result.message +
                    '</div>';
                $('.oi').addClass('confinue-login');
            }
            console.log(html);
            //loading('loaderdiv_login__','none');
            $('#alertMess').fadeIn().html(html);

        }
    })

}
//
// Edit email/mobile filed
//
function editlogin() {
    document.getElementById('email_mobi').readOnly = false;

    $('#editfield').html('');

    $('#otpbtn').html(`<button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold oi confinue-login popup_login_btn">Continue</button>`);

    $('.login-otp-input').fadeIn().css('display', 'none');
}

//
//Verification
//

function verifyOtp() {
    $('#alert-mess').html('');
    $('#error_msg').html('');

    var email_mobi = $('#email_mobi').val();
    let valueList = [];

    document.getElementsByName('otp[]').forEach(element => valueList.push(element.value));

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'otpVerification',
        data: ({ email_mobi: email_mobi, otp: valueList }),
        success: function (result) {
            if (result.status == 1) {
                location.reload();
            } else {
                $('#error_msg').html(`<div class="alert-danger alert-div">'+'<strong>Oops!</strong>` + result.message + `</div>`)
            }
        }

    })
}

function addToCartFromSearchBar(product_id, variant_id) {

    saveCart(product_id, variant_id, 1, 1)
}

function addToCartFromProduct(product_id) {
    var productItemId = $('#productItemId' + product_id).val();
    var qty = $('#qty' + product_id).val();

    saveCart(product_id, productItemId, qty, 2)
}

function addToCartFromCart(product_id) {
    var productItemId = $('#productItemId' + product_id).val();
    var qty = $('#qty' + product_id).val();

    saveCart(product_id, productItemId, qty, 2)

}

function addToCart(product_id) {
    var productItemId = $('#productItemId' + product_id).val();
    $('#addtobtn' + product_id).hide();
    $('#aquantitycontrols' + product_id).css('display', 'flex');

    saveCart(product_id, productItemId, 1, 2);
}

function itemtIncreament(product_id, type) {
    var productItemId = $('#productItemId' + product_id).val();
    var qty = $('#qty' + product_id).val();

    if (type == 2) {
        qty = parseInt(qty) + 1;
    }
    else if (type == 1) {
        if (parseInt(qty) > 1) {
            qty = parseInt(qty) - 1;
        } else {
            $('#addtobtn' + product_id).css('display', 'inline-block');
            $('#aquantitycontrols' + product_id).hide();
        }

    }

    $('#qty' + product_id).val(qty);
    saveCart(product_id, productItemId, 1, type)
}


function itemtIncreamentFromCart(product_id, type, price, mrp, cart_id) {
    var productItemId = $('#productItemId' + product_id).val();
    var qty = $('#qty' + product_id).val();

    if (type == 2) {
        qty = parseInt(qty) + 1;
    } else if (type == 1) {
        if (parseInt(qty) > 1) {
            qty = parseInt(qty) - 1;
        } else {
            deleteItem(cart_id);
            return; // Exit the function if item is deleted
        }
    }

    let subprice = parseInt(qty) * parseInt(price);
    let savePrice = parseInt(qty) * parseInt(mrp) - subprice;

    $('#subprice' + product_id).text(subprice);
    $('#savePrice' + product_id).text(savePrice);
    $('#qty' + product_id).val(qty);

    saveCart(product_id, productItemId, 1, type);

    // Refresh the page after the operations are done
    // location.reload();

}

function saveCart(product_id, variant_id, qty, cartType) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'cart/addToCart',
        data: ({ product_id: product_id, qty: qty, variant_id: variant_id, cartType: cartType }),
        success: function (result) {

            if (result.status == 1) {
                $('.total-items').text(result.total_items);
            }
            getCartList();
            var x = document.getElementById("snackbar");
            x.className = "show";
            var message = result.message;
            document.getElementById('snackbar').innerText = message;
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
        }

    });
}

function getCartList() {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'cart/index',
        success: function (res) {
            $('#cartlist').html(res.product);
        }

    });
}

//
// save to later
//
function saveToLater(cart_id) {

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'cart/save-to-later',
        data: ({ cart_id: cart_id }),
        success: function (result) {

            if (result.status == 1) {
                $('.total-items').text(result.total_items);
            }
            var x = document.getElementById("snackbar");
            x.className = "show";
            var message = result.message;
            document.getElementById('snackbar').innerText = message;
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
            location.reload();
        }

    });
}

function deleteItem(cart_id) {

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'cart/delete-item',
        data: ({ cart_id: cart_id }),
        success: function (result) {

            if (result.status == 1) {
                $('.total-items').text(result.total_items);
            }
            var x = document.getElementById("snackbar");
            x.className = "show";
            var message = result.message;
            document.getElementById('snackbar').innerText = message;
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);

            location.reload();
        }

    });
}

function saveGst() {
    $('.form-text').text();
    var formData = new FormData($('#gstform')[0]);
    $.ajax({
        type: 'post',
        url: $('#gstform').attr('action'),
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
        },
        success: function (res) {
            if (res.error == 0) {
                document.getElementById('errmsg').innerHTML = `<div class="alert alert-success">` + res.err_msg.err_msg + `</div>`;
                setTimeout(function () { document.getElementById('errmsg').innerHTML = "" }, 3000);
            }
            else if (res.error == 1) {
                // console.log(res.err_msg);
                res.err_msg.forEach(element => {
                    // console.log(element);
                    $('#' + element.error_tag).text(element.err_msg);
                })

            } else {
                document.getElementById('errmsg').innerHTML = `<div class="alert alert-danger">` + res.err_msg.err_msg + `</div>`;
                setTimeout(function () { document.getElementById('errmsg').innerHTML = "" }, 3000);
            }

        },
        complete: function () {
            //$.unblockUI();
            // $('#btn1').css('display', 'block');
            // $('#btn2').css('display', 'none');
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}


function saveGstDetails() {
    $('.form-text').text();
    var formData = new FormData($('#gstdetailsform')[0]);
    $.ajax({
        type: 'post',
        url: $('#gstdetailsform').attr('action'),
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
        },
        success: function (res) {
            if (res.error == 0) {
                document.getElementById('errmsg').innerHTML = `<div class="alert alert-success">` + res.err_msg.err_msg + `</div>`;
                setTimeout(function () { document.getElementById('errmsg').innerHTML = "" }, 3000);
            }
            else if (res.error == 1) {
                // console.log(res.err_msg);
                res.err_msg.forEach(element => {
                    // console.log(element);
                    $('#' + element.error_tag).text(element.err_msg);
                })

            } else {
                document.getElementById('errmsg').innerHTML = `<div class="alert alert-danger">` + res.err_msg.err_msg + `</div>`;
                setTimeout(function () { document.getElementById('errmsg').innerHTML = "" }, 3000);
            }

        },
        complete: function () {
            //$.unblockUI();
            // $('#btn1').css('display', 'block');
            // $('#btn2').css('display', 'none');
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

$(document).on('click', '.account-details', function () {
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var mobilename = $('#mobilename').val();
    var emailAddress = $('#emailAddress').val();
    var password = $('#password').val();
    var old_password = $('#old_password').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var country = $('#country').val();
    var oldmobilename = $('#oldmobilename').val();
    var oldemailAddress = $('#oldemailAddress').val();

    var regexEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var pattern = /^\d{10}$/;

    if (firstname === "" || firstname === null) {
        $('#firstname').css('border', '1px solid red');
        return false;
    } else {
        $('#firstname').css('border', '1px solid #CCCCCC');
    }

    if (lastname === "" || lastname === null) {
        $('#lastname').css('border', '1px solid red');
        return false;
    } else {
        $('#lastname').css('border', '1px solid #CCCCCC');
    }

    if (mobilename === "" || mobilename === null) {
        $('#mobilename').css('border', '1px solid red');
        return false;
    } else if (!pattern.test(mobilename)) {
        $('#mobilename').css('border', '1px solid red');
        return false;
    } else {
        $('#mobilename').css('border', '1px solid #CCCCCC');
    }

    if (emailAddress === "" || emailAddress === null) {
        $('#emailAddress').css('border', '1px solid red');
        return false;
    } else if (!emailAddress.match(regexEmail)) {
        $('#emailAddress').css('border', '1px solid red');
        return false;
    } else {
        $('#emailAddress').css('border', '1px solid #CCCCCC');
    }

    loading('loaderdiv', 'block');
    $('.sav-cha').removeClass('account-details');

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'common/add_user_details',
        data: {
            firstname: firstname,
            lastname: lastname,
            mobilename: mobilename,
            emailAddress: emailAddress,
            oldmobilename: oldmobilename,
            oldemailAddress: oldemailAddress,
            password: password,
            old_password: old_password,
            city: city,
            state: state,
            country: country
        },
        success: function (result) {
            if (result.status == 1) {
                alert(result.message);
            } else {
                alert(result.message);
            }

            $('.sav-cha').addClass('account-details');
            loading('loaderdiv', 'none');
        },
        error: function (xhr, status, error) {
            console.log("AJAX call error", xhr, status, error);
            loading('loaderdiv', 'none');
        }
    });
});

function saveToLaterpdp(product_id, variant_id = null) {
    $.ajax({
        url: base_url + 'cart/saveToLater',
        type: "POST",
        data: {
            product_id: product_id,
            variant_id: variant_id
        },
        success: function (response) {
            console.log("Raw response:", response);
            try {
                var result = JSON.parse(response);
                console.log(result);
                if (result.status == 1) {
                    alert(result.message);
                } else {
                    alert(result.message);
                }
            } catch (e) {
                console.error("Parsing error:", e);
                alert("Product add in save for later");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", xhr.responseText);
            alert("An error occurred. Please try again.");
        }
    });
}

$(document).on('click', '.billing-address-save', function () {
    //alert('step1');
    var addre_id = $(this).data('addr_id ');
    //console.log(addre_id);  
    var apart_house = $('#apart_house').val();
    var apart_name = $('#apart_name').val();
    var area = $('#area').val();
    var street_landmark = $('#street_landmark').val();

    var state = $('#state').val();
    var city = $('#city').val();
    var pincode = $('#pincode').val();

    var fname = $('#fname').val();

    var lname = $('#lname').val();
    var mobile = $('#mobile').val();

    var loc_type = $('input[name="type"]:checked').val();
    var other_loc = $('#other_loc').val();


    if (apart_house == "" || apart_house == null) {
        $('#apart_house').css('border', '1px solid red');
        return false;
    } else {
        $('#apart_house').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (apart_name == "" || apart_name == null) {
        $('#apart_name').css('border', '1px solid red');
        return false;
    } else {
        $('#apart_name').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (area == "" || area == null) {
        $('#area').css('border', '1px solid red');
        return false;
    } else {
        $('#area').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (street_landmark == "" || street_landmark == null) {
        $('#street_landmark').css('border', '1px solid red');
        return false;
    } else {
        $('#street_landmark').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (state == "" || state == null) {
        $('.select2-selection-state').css({ 'border': '1px solid red', 'border-radius': '10px' });
        return false;
    } else {
        $('.select2-selection-state').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    //   if(city=="" || city==null){
    //     $('.select2-selection-city').css({'border':'1px solid red','border-radius':'10px'});
    //      return false;
    //     }else{
    //      $('.select2-selection-city').css('border','1px solid #CCCCCC');
    //      var status=1;
    //  }

    if (pincode == "" || pincode == null) {
        $('#pincode').css('border', '1px solid red');
        return false;
    } else {
        $('#pincode').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (fname == "" || fname == null) {
        $('#fname').css('border', '1px solid red');
        return false;
    } else {
        $('#fname').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (lname == "" || lname == null) {
        $('#lname').css('border', '1px solid red');
        return false;
    } else {
        $('#lname').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    var pattern = /^\d{10}$/;
    if (mobile == "" || mobile == null) {
        $('#mobile').css('border', '1px solid red');
        return false;
    } else if (!pattern.test(mobile)) {
        alert('Invalid mobile number.');
        return false;
    } else {
        $('#mobile').css('border', '1px solid #CCCCCC');
        var status = 1;
    }

    if (loc_type == "" || loc_type == null) {
        $('#errf').html('<p style="color:red;">Select your location type.</p>');
        return false;
    } else {
        $('#errf').html('');
        var status = 1;
    }


    if (loc_type == "Other") {

        if (other_loc == "" || other_loc == null) {
            $('#other_loc').css('border', '1px solid red');
            return false;
        } else {
            $('#other_loc').css('border', '1px solid #CCCCCC');
            var status = 1;
        }

    }



    if (status == 1) {
        //alert('step2');
        $('.add-shi-sa').removeClass('billing-address-save');
        loading('loaderdiv_addrs', 'block');
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: base_url + 'common/add_billingaddress',
            data: ({
                addre_id: addre_id,
                apart_house: apart_house,
                apart_name: apart_name,
                area: area,
                street_landmark: street_landmark,
                mobile: mobile,
                state: state,
                city: city,
                pincode: pincode,
                fname: fname,
                lname: lname,
                loc_type: loc_type,
                other_loc: other_loc,
                add_type: 'billingAddress'
            }),
            success: function (result) {
                if (result.status == 1) {
                    $('.addred-div').css('display', 'block');
                    $('.add-addr-div').css('display', 'none');

                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    var message = result.message;
                    document.getElementById('snackbar').innerText = message;
                    setTimeout(function () { x.className = x.className.replace("show", ""); }, 1500);
                    setTimeout(function () {
                        document.location.href = base_url + 'my-address';
                    }, 2000);


                } else {
                    var html = '<div class="alert alert-danger" role="alert">' + result.message + '</div>';
                    $('.errmess_sle').fadeIn().html(html);
                    setTimeout(function () {
                        $('.errmess_sle').fadeOut("slow");
                    }, 3000);

                    $('.add-shi-sa').addClass('billing-address-save');
                }

                loading('loaderdiv_addrs', 'none');

            }
        })
    }



})