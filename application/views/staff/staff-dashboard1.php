           <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="overview-wrap">
                                    <h2 class="title-1">Staff Dashboard</h2>
                                    
                                   </div>
                               </div>
                            </div>  <br> 
                            <div class="row m-t-30 ">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                  <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>staff</th>
                                                <th class="staff_type">type</th>
                                                <th>shift</th>
                                                <th>date</th>
                                                <th>start time</th>
                                                <th>end time</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($result))
                                                {
                                                    foreach($result as $row)
                                                    {
                                                        $date=date('d-M-Y', strtotime($row->date));
                                                        $start_time=date('h:i A', strtotime($row->shift_start_time));
                                                                $end_time=date('h:i A', strtotime($row->shift_end_time));
                                                         echo "
                                                                 <tr>
                                                                        
                                                                        <td class=name'> <a class='fullname' href='http://localhost:8081/Thanal/index.php//admin/staff-profile/$row->id'> $row->name </a></td>
                                                                        
                                                                        <td>$row->staff_type</td>
                                                                        <td>$row->shift_name</td>
                                                                        <td>$date</td>
                                                                        <td>$start_time</td>
                                                                        <td>$end_time</td>
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
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>

                                            <i class="zmdi zmdi-account-calendar"></i>
                                                                                        <?php   
                                                                                            echo date("d ");
                                                                                            $current_month=date("m");
                                                                                            if (strcmp($current_month,"6")) 
                                                                                            {
                                                                                                echo ("June, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"1")) 
                                                                                            {
                                                                                                echo ("January, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"11")) 
                                                                                            {
                                                                                                echo ("November, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"2")) 
                                                                                            {
                                                                                                echo ("February, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"3")) 
                                                                                            {
                                                                                                echo ("March, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"4")) 
                                                                                            {
                                                                                                echo ("April, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"5")) 
                                                                                            {
                                                                                                echo ("May, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"7")) 
                                                                                            {
                                                                                                echo ("July, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"8")) 
                                                                                            {
                                                                                                echo ("August, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"9")) 
                                                                                            {
                                                                                                echo ("September, ");
                                                                                            }
                                                                                            elseif (strcmp($current_month,"10")) 
                                                                                            {
                                                                                                echo ("October, ");
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                    echo ("December, ");
                                                                                            }
                                                                                            echo date("Y");
                                                
                                                                                         ?>
                                                                                        </h3>
                                        <button class="au-btn-plus">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task__title">
                                            <p>Tasks for <?php echo $name; ?></p>
                                        </div>
                                        <div class="au-task-list js-scrollbar3">
                                            <div class="au-task__item au-task__item--danger">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Meeting at Conference Hall</a>
                                                    </h5>
                                                    <span class="time">10:00 AM</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--warning">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Create new inmate.</a>
                                                    </h5>
                                                    <span class="time">11:00 AM</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--primary">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Consult Inmates with the Doctor.</a>
                                                    </h5>
                                                    <span class="time">02:00 PM</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--success">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Add new medicine.</a>
                                                    </h5>
                                                    <span class="time">03:30 PM</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--danger js-load-item">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Inmate B'day Celebration</a>
                                                    </h5>
                                                    <span class="time">10:00 AM</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--warning js-load-item">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Place new medicines.</a>
                                                    </h5>
                                                    <span class="time">11:00 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-task__footer">
                                            <button class="au-btn au-btn-load js-load-btn">load more</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="mail">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('<?php echo base_url(); ?>assets/images/bg-title-02.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
                                        <button class='au-btn-plus' data-toggle='modal' message-id='$id' data-target='#scrollmodal'>
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                    </div>
                                    <div class="au-inbox-wrap">
                                        <div class="au-message">
                                            <div class="au-message__noti">
                                                <p>You Have
                                                    <span><?php echo $message_count; ?></span>

                                                    new messages
                                                </p>
                                            </div>
                                            <div class="au-message-list">
                                                <?php 
                                                    if(!empty($message_show))
                                                    {
                                                        foreach($message_show as $row)
                                                        {
                                                            if($row->from_type=="guardian")
                                                            {
                                                                $name1=$row->guardian_name;
                                                            }
                                                            elseif($row->from_type=="admin")
                                                            {
                                                                $name1=$row->fullname;
                                                            }
                                                            else
                                                            {
                                                                    $name1=$row->name;
                                                            }
                                                            echo "
                                                                    <div class='au-message__item unread to-message' message-id='$row->id'>
                                                                        <div class='au-message__item-inner'>
                                                                            <div class='au-message__item-text'>
                                                                                <div class='avatar-wrap'>
                                                                                    <div class='avatar'>
                                                                                        <img src='http://localhost:8081/Thanal/assets/images/icon/avatar-02.jpg' alt='John Smith'>
                                                                                    </div>
                                                                                </div>
                                                                            <div class='text'>
                                                                                <h5 class='name'>$name1</h5>
                                                                                    <p>$row->subject</p>
                                                                            </div>
                                                                        </div>
                                                                    <div class='au-message__item-time'>
                                                                        <span>$row->date_created</span>
                                                                        <br>
                                                                <span class='lowercase'> $row->from_type</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            ";
                                                        }
                                                    }
                                                 ?>
                                            </div>

                                                 <div class="au-task__footer">
                                            <button class="au-btn au-btn-load js-load-btn">load more</button>
                                        </div>
                                            </div>
                                            <div class="au-chat">
                                            <div class="au-chat__title">
                                                <div class="au-chat-info">
                                                    <div class="avatar-wrap online">
                                                        <div class="avatar avatar--small">
                                                            <img src="http://localhost:8081/Thanal/assets/images/icon/avatar-02.jpg" alt="John Smith">
                                                        </div>
                                                    </div>
                                                    <span class="table_message_name_display">
                                                        
                                                    </span>
                                                    <br>
                                                    
                                                </div>
                                            </div>
                                            <div class="au-chat__content">
                                                <div class="recei-mess-wrap">
                                                    <span class="table_message_date_created"></span>
                                                    <div class="recei-mess__inner">
                                                        <div class="avatar avatar--tiny">
                                                            <img src="http://localhost:8081/Thanal/assets/images/icon/avatar-02.jpg" alt="John Smith">
                                                        </div>
                                                        <div class="recei-mess-list">
                                                            <div class="table_message_name_message recei-mess"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="au-task__footer">
                                            <button class="au-btn au-btn-load js-load-btn view_all">view all message</button>
                                        </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p> </p>
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
            <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
             <form action="<?php echo base_url(); ?>index.php/staff/create-message" method="post" novalidate="novalidate">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollmodalLabel">New Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row form-group">
                                     <div class="col-md-6">
                                         <h6 class="pb-2 display-6">Type</h6>
                                                <select name="to_type" id="type_select" class="form-control">
                                                        <option value="staff">Please Select</option>
                                                         <option value="admin">Admin</option>
                                                        <option value="staff">Staff</option>
                                                        <option value="inmate">Inmate</option>
                                                        <option value="guardian">Guardian</option>
                                                </select>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="pb-2 display-6">Name</h6>
                                            <select name="to_id" id="select" class="form-control select_name">
                                            </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                               <h6 class="pb-2 display-6">Subject</h6>
                                                <input id="cc-pament" name="subject" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                                            </div>
                            <div class="row form-group">
                                                
                                                <div class="col-md-12">
                                                    <h6 class="pb-2 display-6">Message</h6>
                                                    <textarea name="message" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea>
                                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="" class="btn btn-success message-confirm" value="Send">
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

        $(".view_all").click(function(){
            $("#mail").hide();
            $(".au-chat").hide();
            $("#mail").show();
            $(".au-message-list").show();
            }); 
        $(".to-delete").click(function(){
            var deleteId = $(this).attr('message-id');
            $(".delete-confirm").attr('href','http://localhost:8081/Thanal/index.php/admin/medicine-delete/'+deleteId);

        });
        $("#type_select").change(function () {
            $("option").remove(".get_select_name");
        var type_send = this.value;
        $.ajax({
                type : "POST",
                url : "<?php echo base_url();?>/index.php/staff/get-result",
                data : {type_send:type_send},
                dataType: 'json',
                success : function(response) {
                    if (type_send==="guardian") 
                    {
                            $.each(response.result, function(index) {
                        var row = "<option value='"+response.result[index].id+"' "+"class='get_select_name'>"+response.result[index].guardian_name+"</option>";
                            $('.select_name').append(row);
                            });
                    }
                    
                    else
                    {
                        if(type_send==="admin")
                        {
                        $.each(response.result, function(index) {
                        var row = "<option value='"+response.result[index].id+"' "+"class='get_select_name'>"+response.result[index].fullname+"</option>";
                            $('.select_name').append(row);
                            });
                        }
                        else
                        {
                            $.each(response.result, function(index) {
                        var row = "<option value='"+response.result[index].id+"' "+"class='get_select_name'>"+response.result[index].name+"</option>";
                            $('.select_name').append(row);
                            });
                        }
                        
                    }
                    
                
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
                url : "<?php echo base_url();?>/index.php/staff/get-message",
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
                        else if(response.result[index].from_type==="admin") 
                        {
                            $('.table_message_name_display').append(response.result[index].fullname);
                            $('.table_message_date_created').append(response.result[index].date_created);
                            $('.table_message_name_message').append(response.result[index].message);  
                            $('.table_message_from_type').append(response.result[index].from_type);  
                        }
                        else
                        {
                           $('.table_message_name_display').append(response.result[index].name);   
                            $('.table_message_date_created').append(response.result[index].date_created);
                            $('.table_message_name_message').append(response.result[index].message);  
                            $('.table_message_from_type').append(response.result[index].from_type);
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
