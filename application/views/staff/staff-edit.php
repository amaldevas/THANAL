            <!-- MAIN CONTENT-->
            <di            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Staff</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Edit</h3>
                                            <button class="au-btn au-btn-icon au-btn--blue">
                                        </div>
                                        <hr>
                                        <form action="<?php echo base_url()?>index.php/staff/update-staff" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                                <input id="cc-pament" name="fullname" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $name; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Mobile</label>
                                                <input id="cc-pament" name="mobile" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $mobile; ?>">
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Email</label>
                                                <input id="cc-name" name="email" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" value="<?php echo $email; ?>">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                           <div class="form-group">
                                                    <label for="select" class=" form-control-label">Gender</label>
                                                    <select name="select" id="select" class="form-control">
                                                        <?php
                                                        if($gender=="M")
                                                        {
                                                            echo
                                                            "
                                                            <option value='M' selected>Male</option>
                                                            <option value='F'>Female</option>
                                                             <option value='O'>Others</option>
                                                            ";
                                                        }
                                                        elseif($gender=="F")
                                                        {
                                                            echo
                                                            "
                                                            <option value='M'>Male</option>
                                                            <option value='F' selected>Female</option>
                                                             <option value='O'>Others</option>
                                                            ";
                                                        }
                                                        else
                                                        {
                                                            echo
                                                            "
                                                            <option value='M'>Male</option>
                                                            <option value='F' >Female</option>
                                                             <option value='O'selected>Others</option>
                                                            ";
                                                        }
                                                       
                                                        ?>
                                                    </select>
                                            </div>
                                            <div class="row">
                                            <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Date of Birth</label>
                                                        <input id="cc-exp" name="date_of_birth" type="date" class="form-control cc-exp" value="<?php echo $date_of_birth; ?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder="DD-MM_YYYY"
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                  </div>  
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Permanent Address</label>
                                                <input id="cc-number" name="permanentaddress" type="tel" class="form-control cc-number identified visa" value="<?php echo $permanent_address; ?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Present Address</label>
                                                <input id="cc-number" name="presentaddress" type="tel" class="form-control cc-number identified visa" value="<?php echo $present_address; ?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div></div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Update</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo base_url();?>assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url();?>assets/vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/wow/wow.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>

</body>

</html>
<!-- end document-->
