
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">Medicine Schedule History</h2>
                                            
                                        </div>
                                    </div>
                        </div>
                        <br>
                        <form action="" method="post">
                        <div class="row">
                            
                   
                                        
                                                <div class="col-4 offset-2">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">From Date</label>
                                                        <input id="cc-exp" name="from" type="date" class="form-control cc-exp" value="<?php echo date('Y/m/d'); ?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder="DD-MM_YYYY"
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label for="x_card_code" class="control-label mb-1">To Date</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="to" type="date" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code"
                                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                                
                                            
                             </div>
                             <div class="row">
                                 <div class="col-md-4 offset-5">
                                        <div class="overview-wrap">
                                            
                                            
                                            <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="fa fa-search"></i>Search</button>
                                        </div>
                                    </div>
                             </div>
                         </form>
                    </div>
                </div>
                    <div class="row m-t-30 ">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>time</th>
                                                <th>date</th>
                                                <th>medicine</th>
                                                <th>staff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($result))
                                                {
                                                    foreach($result as $row)
                                                    {
                                                        $date=date('d-M-Y', strtotime($row->medicine_date));
                                                        $time=date('h:i A', strtotime($row->time));
                                                         echo "
                                                                 <tr>
                                                                        <td>$time</td>
                                                                        <td>$date</td>
                                                                        <td>$row->medicine_name</td>
                                                                        <td class=name'> <a class='fullname' href='http://localhost:8081/Thanal/index.php//admin/staff-profile/$row->id'> $row->staff_name </a></td>
                                                                                </tr>
                                                                             ";
                                                    }
                                                }
                                                
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
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
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url(); ?>assets/vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/vendor/wow/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>

</html>
<!-- end document-->
