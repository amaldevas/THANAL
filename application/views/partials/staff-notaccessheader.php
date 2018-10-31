<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .staff_type,.fullname
        {
            cursor: pointer;
        }
        a.fullname
        {
            color: #8f8080;
        }
        .fullname123
        {
            color: #8f8080;
            float: left;
        }
        .lowercase 
                {
                    text-transform: capitalize;
                }
    </style>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin</title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo base_url(); ?>assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet" media="all">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <script type="text/javascript">
        $(document).ready(function()
        {
             $('.staff_type').click(function() 
            {
                window.location = "<?php echo base_url(); ?>index.php//admin/staff-type";
            });
            
        });
          
      </script>
   
    
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="<?php echo base_url();?>assets/images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                   <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="<?php echo base_url()?>index.php/staff/dashboard">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                </li>
                               <li class="has-sub">
                                  <a class="js-arrow" href="<?php echo base_url()?>index.php/staff/profile">
                                <i class="fas fa-tachometer-alt"></i>Profile</a>
                                </li>
                                <li class="has-sub">
                                  <a class="js-arrow" href="<?php echo base_url()?>index.php/staff/preshedule">
                                <i class="fas fa-tachometer-alt"></i>Schedule History</a>
                                </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="<?php echo base_url();?>assets/images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="<?php echo base_url()?>index.php/staff/dashboard">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                </li>
                                <li class="has-sub">
                                  <a class="js-arrow" href="<?php echo base_url()?>index.php/staff/profile">
                                <i class="fas fa-tachometer-alt"></i>Profile</a>
                                </li>
                                <li class="has-sub">
                                  <a class="js-arrow" href="<?php echo base_url()?>index.php/staff/preshedule">
                                <i class="fas fa-tachometer-alt"></i>Schedule History</a>
                                </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                               <div class="noti-wrap">
                                    
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <?php 
                                            if($message_count>0)
                                            {
                                                echo "
                                                        <span class='quantity'>$message_count</span>
                                                        ";
                                            }
                                            else
                                            {

                                            }
                                         ?>
                                        
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have <?php echo $message_count; ?> New Emails</p>
                                            </div>
                                            <?php 
                                                    if(!empty($message_show))
                                                    {
                                                        foreach($message_show as $row)
                                                        {
                                                            if($row->from_type=="guardian")
                                                            {
                                                                $name1=$row->guardian_name;
                                                            }
                                                            else
                                                            {
                                                                    $name1=$row->name;
                                                            }
                                                            echo "
                                                                    <div class='email__item'>
                                                                    <div class='image img-cir img-40'>
                                                                    <img src='http://localhost:8081/Thanal/assets/images/icon/avatar-02.jpg' alt='Cynthia Harvey' />
                                                                </div>
                                                                 <div class='content'>
                                                                <p>$row->subject</p>
                                                                <span>$name1, $row->date_created;</span>
                                                                <br>
                                                                <span class='lowercase'> $row->from_type</span>
                                                                </div>
                                                                </div>
                                                                ";
                                                        }
                                                    }
                                                ?>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?php echo base_url(); ?>assets/images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $name; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?php echo base_url(); ?>assets/images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $name; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $email; ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?php echo base_url()?>index.php/staff/profile">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="<?php echo base_url()?>index.php/staff/change-password">
                                                        <i class="zmdi zmdi-settings"></i>Change Password</a>
                                                </div>
                                                
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="<?php echo base_url()?>index.php/staff/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
