<?php
// print_r($querys);
// exit();
?>
<?php
$this->load->view('frontend/header',$data);
?>
<style>
        /* Add styles for the loader */
        #loaderdiv {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            z-index: 9999; /* Make sure it covers other elements */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }
</style>
 <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Email Addresses
                </div>
            </div>
        </div>
        <div class="page-content pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">
                        <div class="row">
                            <div class="col-md-2">
                               <?php 
                                 $p['pageType'] = 'account';
                                 $this->load->view('frontend/component/my_account_side_bar',$p); 
                               ?>
                            </div>

                            <div class="col-md-10">
                                <div class="account dashboard-content">
                                    
                                        <div class="card2">
                                            <div class="card-body">

                                                <div class="email_address_main">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="email_addresses_body text-muted">
                                                                <p class="text-muted">You can add additional email addresses to your account. Once a new email address is validated, you can log in to your account with that address or your primary email address registered with your account. Your password remains same across all the email addresses.</p>
                                                                <p class="text-muted">Please note that all the email communication is sent to your main email address specified on the account.</p>
                                                            </div>

                                                            <div class="create_new_email_address">
                                                                <div class="email_address_heading mb-10">
                                                                    <h5 class="font-weight-normal text-muted">Add Email Address</h5>
                                                                </div>
                                                            <div id="loaderdiv"></div> 
                                                            <form method="post"> 
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Email Address </label>
                                                                            <input type="email" id="email" name="email" placeholder="Enter Email Address" value="">
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <button type="button" id="submitEmailAdd" class="width_auto btn sub-regi btn-fill-out btn-base submit-registration">Save Changes</button>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <button type="button" id="submitEmailAdd" class="width_auto btn sub-regi btn-fill-out btn-base submit-registration">Save Changes</button>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </form>                               
                                                            </div>


                                                    <div class="email_addresses_list_table">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="emailTable">
                                                            
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>Email Address</th>
                                                                    <th>Added On</th>
                                                                    <!--<th>Status</th>
                                                                    <th>Remove</th> -->   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               <?php
                                                                foreach ($querys as $row) {
                                                                    if (!empty($row->email)) { // Check if email address is present
                                                                        echo "<tr>
                                                                        <td>" . $row->email . "</td>
                                                                    
                                                                        <td><button type='button' class='remove-email' data-id='" . $row->id . "'>Remove</button></td>
                                                                        </tr>";
                                                                    }
                                                                } 
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    
                                </div>
                            </div><!--col-10-->

                        </div><!--row close-->
                    </div><!--col-lg-12-->
                </div><!--row close-->
            </div><!--container close-->
        </div><!--page-content close-->
    </main>

     <!-- <table id="emailTable">
        <thead>
            <tr>
                <th>Email Address</th>
                <th>Status</th>
                <th>Added On</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> -->
<?php
$this->load->view('frontend/footer',$data);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loading(elementId, displayState) {
        document.getElementById(elementId).style.display = displayState;
    }

    $(document).ready(function() {
        $('#submitEmailAdd').on('click', function() {
            var email = $('#email').val();
            var regexEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            if (email === "" || email === null || !email.match(regexEmail)) {
                alert("Please enter a valid email address.");
                return false;
            }

            loading('loaderdiv', 'block');

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'common/add_account_email',
                data: {
                    email: email
                },
                success: function(result) {
                    console.log("AJAX call successful", result);
                    alert(result.message);
                    if (result.status === 1) {
                        var newRow = '<tr>' +
                            '<td>' + result.data.email + '</td>' +
                            '<td class="text-center"><a href="#" class="remove-email" data-id="' + result.data.id + '"><span class="material-symbols-outlined">cancel</span></a></td>' +
                            '</tr>';
                        $('#emailTable tbody').append(newRow);
                    }
                    loading('loaderdiv', 'none');
                },
                error: function(xhr, status, error) {
                    console.log("AJAX call error", xhr, status, error);
                    loading('loaderdiv', 'none');
                }
            });
        });

    $(document).on('click', '.remove-email', function() {
    var id = $(this).data('id');
    var row = $(this).closest('tr');

    loading('loaderdiv', 'block');

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + 'common/remove_account_email',
        data: {
            id: id
        },
        success: function(result) {
            if (result.status === 1) {
                row.remove();
            } else {
                alert(result.message);
            }
            loading('loaderdiv', 'none');
        },
        error: function(xhr, status, error) {
            console.log("AJAX call error", xhr, status, error);
            loading('loaderdiv', 'none');
        }
    });
});

});
</script>




