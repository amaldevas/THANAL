

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">medicine listing</h2>
                                           
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
                                                <th>Mediciine</th>
                                                <th>doze</th>
                                                <th>time</th>
                                                <th>start_date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                                if(!empty($result))
                                                {
                                                    foreach($result as $row)
                                                    {
                                                        $date=date('d-M-Y', strtotime($row->start_date));
                                                        $time=date('h:i A', strtotime($row->time));
                                                         echo "
                                                                 <tr>
                                                                        
                                                                        <td class='fullname'> <a class='fullname' href='http://localhost:8081/Thanal/index.php//admin/medicine-profile/$row->id'> $row->medicine_name </a></td>
                                                                        
                                                                        <td>$row->quantity</td>
                                                                        <td>$time</td>
                                                                        <td>$date</td>
                                                                       
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

<!-- modal static -->
            <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
             data-backdrop="static">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a href="" class="btn btn-danger delete-confirm">Confirm</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal static -->

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
    <script type="text/javascript">
    $(document).ready(function(){
        $(".to-delete").click(function(){
            var deleteId = $(this).attr('delete-id');
            $(".delete-confirm").attr('href','http://localhost:8081/Thanal/index.php/admin/medicine-delete/'+deleteId);

        });
    });
    </script>
</body>

</html>
<!-- end document-->
