
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Admin</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Inmate</h3>
                                            <button class="au-btn au-btn-icon au-btn--blue">
                                        </div>
                                        <hr>
                                        <form action="<?php echo base_url(); ?>index.php/admin/update-inmate/<?php echo $id; ?>" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                                <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $name; ?>">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Email</label>
                                                <input id="cc-name" name="email" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" value="<?php echo $email; ?>">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Permanent Address</label>
                                                <input id="cc-number" name="permanent_address" type="tel" class="form-control cc-number identified visa" value="<?php echo $permanent_address; ?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Present Address</label>
                                                <input id="cc-number" name="present_address" type="tel" class="form-control cc-number identified visa" value="<?php echo $present_address; ?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Payment Per Month</label>
                                                <input id="cc-number" name="payment_per_month" type="tel" class="form-control cc-number identified visa" value="<?php echo $payment_per_month; ?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Date of Birth</label>
                                                        <input id="cc-exp" name="date_of_birth" type="date" class="form-control cc-exp" value="<?php echo $date_of_birth; ?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder="DD-MM_YYYY"
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Date of Joining</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="date_of_joining" type="date" class="form-control cc-cvc" value="<?php echo $date_of_joining; ?>" data-val="true" data-val-required="Please enter the security code"
                                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Emergency Contact Person</label>
                                                        <input id="cc-exp" name="emergency_contact_person" type="tel" class="form-control cc-exp" value="<?php echo $emergency_contact_person; ?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder=""
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Emergency Contact Number</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="emergency_contact_number" type="tel" class="form-control cc-cvc" value="<?php echo $emergency_contact_number; ?>" data-val="true" data-val-required="Please enter the security code"
                                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                   <div class="form-group">
                                                    <label for="select" class=" form-control-label">Gender</label>
                                                    <select name="gender" id="select" class="form-control">
                                                         <?php 
                                                        if($gender=="M")
                                                        {
                                                            echo 
                                                            "
                                                            <option value='M' selected>Male</option>
                                                            <option value='F'>Female</option>
                                                            ";
                                                        }
                                                        else
                                                        {
                                                            echo 
                                                            "
                                                            <option value='M'>Male</option>
                                                            <option value='F' selected>Female</option>
                                                            ";
                                                        }
                                                        
                                                        ?>
                                                    </select>
                                            </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Mobile Number</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="mobile" type="tel" class="form-control cc-cvc" value="<?php echo $mobile; ?>" data-val="true" data-val-required="Please enter the security code"
                                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
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
                        <div class="container-fluid">
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">medicine</h2>
                                            <button class="au-btn au-btn-icon au-btn--blue" data-target="#scrollmodal123" data-toggle="modal">
                                        <i class="zmdi zmdi-plus"></i>add medicine</button>
                                            
                                        </div>
                                    </div>
                        </div>
                    </div>
                         <div class="row m-t-30 ">
                            <div class="col-md-10 offset-md-2">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>medicine</th>
                                                <th>doze</th>
                                                <th>time</th>
                                                <th>starting date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table_content">
                                                <td>2018-09-29 05:57</td>
                                                <td>Mobile</td>
                                                <td>iPhone X 64Gb Grey</td>
                                                
                                                <td>$999.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    <div class="modal fade" id="scrollmodal_message" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
 
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollmodalLabel">Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="message-body">
                            
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="" class="btn btn-success message-confirm" id="message_modal_button" value="Ok" data-dismiss="modal">
                            
                            
                        </div>
                    </div>
                </div>
            </form>
            </div>
     <div class="modal fade" id="scrollmodal123" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
             <form action="" method="post" novalidate="novalidate">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollmodalLabel">Add Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row form-group">
                                    <div class="col-md-12">
                                        <h6 class="pb-2 display-6">Medicine</h6>
                                            <input id="medicines_name" name="medicine_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" list="medicine_list">
                                            <datalist id="medicine_list">
                                            </datalist>
                                    </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <h6 class="pb-2 display-6">Starting Date</h6>
                                                <input id="starting_date" name="starting_date" type="date" class="form-control" aria-required="true" aria-invalid="false" value="">
                                </div>
                                <div class="col-md-6">
                                    <h6 class="pb-2 display-6">Prescribed Time</h6>
                                                <input id="appt-time" name="appt-time" type="time" class="form-control"value="12:00">
                                                
                                </div>
                            </div>
                            <div class="row form-group">
                                                
                                                <div class="col-md-12">
                                                    <h6 class="pb-2 display-6">Doze</h6>
                                                <input id="quantity" name="quantity" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="" class="btn btn-success message-confirm" id="add_medicine" value="Add">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            
                        </div>
                    </div>
                </div>
            </form>
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
    <script type="text/javascript">
    $(document).ready(function(){
        var id=<?php echo $id; ?>;
        $(".table_content").remove();
        $.ajax({
                type : "POST",
                url : "<?php echo base_url();?>/index.php/admin/get-inmate-medicine",
                data : {id:id},
                dataType: 'json',
                success : function(response) {
                    
                    
                            $.each(response.result, function(index)
                            {
                                var row = "<tr class='table_content'><td>"+response.result[index].medicine_name+"</td><td>"+response.result[index].quantity+"</td><td>"+response.result[index].time+"</td><td>"+response.result[index].start_date+"</td></tr>";
                                $('tbody').append(row);
                            });
                },
                error: function() { 

                    alert("Something went wrong");
                }

            });
        $("#medicines_name").keyup(function()
        {
         
           $("option").remove(".get_medicine_search");
            var medicine_name = $("#medicines_name").val();
 
             $.ajax(
             {
                type : "POST",
                url : "<?php echo base_url();?>/index.php/admin/inmate-search-medicine",
                data : {medicine_name:medicine_name},
                dataType: 'json',
                success : function(response) {
                    if (response.success==="TRUE") 
                    {

                            $.each(response.result, function(index) {
                            var row = "<option class='get_medicine_search'>"+response.result[index].medicine_name+"</option>";
                            $('#medicine_list').append(row);
                            });
                    }
                    else
                    {
                        var row = "<option class='get_medicine_search'>"+medicine_name+"- Invalid Entry</option>";
                            $('#medicine_list').append(row);
                        
                    }
                    
                    
                
                },
                error: function() { 
                    alert("Something went wrong");
                }
            });

        }
        ); 
        $(".to-delete").click(function(){
            var deleteId = $(this).attr('message-id');
            $(".delete-confirm").attr('href','http://localhost:8081/Thanal/index.php/admin/medicine-delete/'+deleteId);

        });
        $("#add_medicine").click(function(e){
            e.preventDefault();
           
            
        var medicine_name = $("#medicines_name").val();
        
        var quantity = $("#quantity").val();
        var time = $("#appt-time").val();
        var starting_date = $("#starting_date").val();
        var id=<?php echo $id; ?>;
        $.ajax({
                type : "POST",
                url : "<?php echo base_url();?>/index.php/admin/inmate-add-medicine/<?php echo $id; ?>",
                data : {medicine_name:medicine_name,quantity:quantity,starting_date:starting_date,time:time},
                dataType: 'json',
                success : function(response) {
                    
                    var row = "<div class='add_message_modal'>"+response.message+"</div>";
                            $('#message-body').append(row);
                },
                error: function() { 

                    alert("Something went wrong");
                }

            });
        $('#scrollmodal123').modal('hide');
        $(".add_message_modal").remove();
        $(".table_content").remove();
        $('#scrollmodal_message').modal('show');
        $.ajax({
                type : "POST",
                url : "<?php echo base_url();?>/index.php/admin/get-inmate-medicine",
                data : {id:id},
                dataType: 'json',
                success : function(response) {
                    
                    
                            $.each(response.result, function(index)
                            {
                                var row = "<tr class='table_content'><td>"+response.result[index].medicine_name+"</td><td>"+response.result[index].quantity+"</td><td>"+response.result[index].time+"</td><td>"+response.result[index].start_date+"</td></tr>";
                                $('tbody').append(row);
                            });
                },
                error: function() { 

                    alert("Something went wrong");
                }

            });

    });
        $(".to-message").click(function () {
         var messageId = $(this).attr('message-id');
        $.ajax({
                type : "POST",
                url : "<?php echo base_url();?>/index.php/admin/get-message",
                data : {messageId:messageId},
                dataType: 'json',
                success : function(response) {
                    $.each(response.result, function(index) {
                        if (response.result[index].from_type==="guardian") 
                        {
                            $('.table_message_name_display').append(response.result[index].guardian_name);
                            $('.table_message_date_created').append(response.result[index].date_created);
                            $('.table_message_name_message').append(response.result[index].message);  
                            $('.table_message_from_type').append(response.result[index].from_type);  
                        }
                        else
                        {
                           $('.table_message_name_display').append(response.result[index].name);   
                            $('.table_message_date_created').append(response.result[index].date_created);
                            $('.table_message_name_message').append(response.result[index].message);  
                        }
                            });
                    
                    
                
                },
                error: function() { 
                    alert("Something went wrong");
                }
            });
    });
    });
    </script>

</body>

</html>
<!-- end document-->
