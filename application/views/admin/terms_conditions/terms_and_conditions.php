<!-- View File: terms_and_conditions.php -->

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-info">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
<style type="text/css">
    .modal-backdrop.show {
    opacity: .5;
    display: none !important;
}
</style>    
<form action="<?php echo base_url('common/policy_save'); ?>" method="POST">
    <div class="main px-lg-4 px-md-4"> 
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="mob_back_btn">
                                <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                            </div>
                            <h3 class="fw-bold mb-0">Terms & Conditions</h3>
                            <button type="submit" class="btn btn-primary tm-cl btn-set-task w-sm-100 py-2 px-5 text-uppercase save-policy">Save</button>
                            <div class="loaderdiv" style="position: absolute;z-index: 99999999;float: right;margin-left: 20%;"></div>
                        </div>
                    </div>
                </div> 
                
                <div class="row g-3 mb-3">
                    <div class="col-xl-12 col-lg-12">
                        <div class="sticky-lg-top">
                            <div class="card mb-3">
                                <input type="hidden" class="form-control" name="field_type" id="field_type" value="admin/terms_conditions">
                                <input type="hidden" class="form-control" name="edits_id" id="edits_id" value="<?php echo ($policy_details != 0) ? $policy_details[0]->policy_id : '';?>">
                                <div class="card-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <textarea id="summernote" name="designation"><?php echo ($policy_details != 0) ? $policy_details[0]->terms_and_conditions_policy : ''; ?></textarea>
                                            <p id="errr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row end  --> 

                <script type="text/javascript">
                    $('#summernote').summernote({
                        placeholder: 'Hello bootstrap 4',
                        tabsize: 2,
                        height: 300
                    });
                </script>
                
            </div>
        </div>    
    </div>
</form>
