         
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Inmate Profile</h2>
                                    <a href="<?php echo base_url();?>index.php/inmate/edit-profile">
                                    <button class="au-btn au-btn-icon au-btn--blue" >
                                        <i class="zmdi zmdi-plus"></i>Edit</button>
                                        </a>
                                   </div>
                               </div>
                            </div>
                            <div class="row">
                             <div class="col-md-4 offset-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa fa-user"></i>
                                        <strong class="card-title pl-2">Profile Card</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class="rounded-circle mx-auto d-block" src="<?php echo base_url(); ?>assets/images/icon/avatar-01.jpg" alt="Card image cap">
                                            <h5 class="text-sm-center mt-2 mb-1"><?php echo $name; ?></h5>
                                            <div class="location text-sm-center">
                                                <i class="fa"></i> <?php echo $email; ?></div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#">
                                               <i class="fa fa-facebook-official"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-twitter pr-1"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-linkedin pr-1"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-pinterest pr-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="row">
              <div class="col-md-12">


                <div class="card">
                  <div class="card-header">
                    <strong class="card-title">Profile Details</strong>
                  </div>

                  <div class="card-body">
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Name</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $name; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Email</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $email; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Date of Birth</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $date_of_birth; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Gender</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php
                                        if($gender=='M')
                                        {
                                            echo "Male";
                                        }
                                        else
                                        {
                                            echo "Female";
                                        }
                                    ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Mobile Number</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $mobile; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Payment Per Month</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $payment_per_month; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Date Of Joining</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $date_of_joining; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Permanent Address</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $permanent_address; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ">
                        <div class="col-md-4">
                         <div class="typo-headers">
                      
                             <h4 class="pb-2 display-5">Present Address</h4>
                         </div>
                         </div>
                         <div class="col-md-7 offset-md-1">
                            <div class="typo-articles">
                                  <p>
                                    <?php echo $present_address; ?> 
                                </p>
                            </div>
                        </div>
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

            

    