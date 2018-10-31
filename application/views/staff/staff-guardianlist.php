
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">Guardian listing</h2>
                                            <a href="<?php echo base_url()?>index.php/staff/add-guardian">
                                            <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add guardian</button>
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
                                                <th>gender</th>
                                                <th>mobile</th>
                                                <th>inmate name</th>
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
                                                        <td>$row->guardian_name</td>
                                                        <td>$row->email</td>
                                                        <td>$row->gender</td>
                                                        <td>$row->mobile</td>
                                                        <td>$row->name</td>
                                                        <td><a href= 'http://localhost:8081/Thanal/index.php/staff/guardian-edit/$row->id'>
                                                            <button class='btn btn-success btn-sm edit_btn'>
                                                            Edit
                                                             </button>
                                                             </a>
                                                        </td>
                                                        <td><a href= 'http://localhost:8081/Thanal/index.php/staff/inmate-d/$row->id'>
                                                            <button type='button' class='btn btn-secondary btn-sm schdl_btn'>History</button>
                                                            </a>
                                                        </td>
                                                            <td><button type='button' class='btn btn-danger btn-sm to-delete' data-toggle='modal' delete-id='$row->id' data-target='#staticModal'>
                                                                 Delete
                                                               </button>
                                                             </td>
                                                      </tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
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
    <script type="text/javascript">
    $(document).ready(function(){
        $(".to-delete").click(function(){
            var deleteId = $(this).attr('delete-id');
            $(".delete-confirm").attr('href','http://localhost:8081/Thanal/index.php/staff/guardian-delete/'+deleteId);

        });
    });
    </script>
</body>

</html>
<!-- end document-->
