
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">Duty Assign</h2>
                                            
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    <br>
                                        <div class="row">
                                                <div class="col-4 offset-2">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">From</label>
                                                        <input id="cc-exp" name="from" type="date" class="form-control cc-exp" value="<?php echo date('Y/m/d'); ?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder="DD-MM_YYYY"
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label for="x_card_code" class="control-label mb-1">To</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="to" type="date" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code"
                                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                    <div class="row m-t-30 ">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>staff</th>
                                                <th class="staff_type">type</th>
                                                <?php 
                                                        if(!empty($no_shift))
                                                        {
                                                             foreach($no_shift as $row)
                                                             {
                                                                $start_time=date('h:i A', strtotime($row->shift_start_time));
                                                                $end_time=date('h:i A', strtotime($row->shift_end_time));
                                                                echo "<th>$row->shift_name<br>$start_time-$end_time</th>";
                                                             }
                                                        }
                                                    ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                                        $count=0;
                                                        $count1=0;
                                                        if(!empty($no_staff))
                                                        {   
                                                            $count=1;
                                                             foreach($no_staff as $row)
                                                            {
                                                                echo "<tr><td>$row->name</td><td>$row->staff_type</td><input type='hidden' name='id-$count' value=$row->id>";
                                                                     if(!empty($no_shift))
                                                                    {
                                                                        $count1=1;
                                                                         foreach($no_shift as $row1)
                                                                         {
                                                                            if($count==1)
                                                                            {
                                                                                echo "<input type='hidden' name='shift-$count1' value='$row1->id'>";
                                                                            }
                                                                            
                                                                            echo "
                                                                                        <td>
                                                                                        <label class='switch switch-3d switch-success mr-3'>
                                                                                        <input class='switch-input' name='$row1->id-$count' type='checkbox' value='1'>
                                                                                        <span class='switch-label'></span>
                                                                                        <span class='switch-handle'></span>
                                                                                        </label>
                                                                                        </td>
                                                                                    ";
                                                                                $count1++;

                                                                         }
                                                                    }
                                                                    echo "</tr>";
                                                                $count++;
                                                             }
                                                        }
                                                        echo "<input type='hidden' name='count_staff' value='$count'><input type='hidden' name='count_shift' value='$count1' >";
                                                    ?>
                                        
                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Assign</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                </form>
                    
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
