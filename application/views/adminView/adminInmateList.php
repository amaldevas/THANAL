
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">inmate listing</h2>
                                            <a href="<?php echo base_url(); ?>index.php/admin/add-inmate">
                                            <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add inmate</button>
                                            </a>
                                        </div>
                                    </div>
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
                                                <th>name</th>
                                                <th>email</th>
                                                 <th>mobile</th>
                                                <th>emergency contact number</th>
                                                <th>joining date</th>
                                                <th>edit</th>
                                                <th>history</th>
                                                <th>delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($result))
                                                {
                                                    foreach($result as $row)
                                                    {
                                                         echo "
                                                                 <tr>
                                                                        <td class='fullname'> <a class='fullname' href='http://localhost:8081/Thanal/index.php//admin/inmate-profile/$row->id'> $row->name </a></td>
                                                                        <td>$row->email</td>
                                                                        <td>$row->mobile</td>
                                                                        <td>$row->emergency_contact_number</td>
                                                                        <td>$row->date_of_joining</td>
                                                                        <td>
                                                                        <a href='http://localhost:8081/Thanal/index.php//admin/inmate-edit/$row->id'>
                                                                        <button class='btn btn-success btn-sm' value='$row->id'>

                                                         Edit
                                                                    </button>
                                                                    </a>
                                            
                                                                 
                                                                                </td>
                                                                                <td>
                                                                                <a href='http://localhost:8081/Thanal/index.php//admin/inmate-edit/$row->id'>
                                                                 <button type='button' class='btn btn-secondary btn-sm'>History</button>
                                                                 </button>
                                                                                </a>
                                                             </td>
                                                             <td>
                                                                <a href='http://localhost:8081/Thanal/index.php//admin/delete-inmate/$row->id'>
                                                                                    <button class='btn btn-danger btn-sm' value='$row->id'>

                                                                     Delete
                                                                                </button>
                                                                                </a>
                                                             </td>
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
