<!DOCTYPE html>
        <html lang="en">
        <head>
        
        <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/favicon.ico">       
        <title>Alpha Nero Emission</title>       
		<link rel="stylesheet" href="plugins/morris/morris.css">
        <!-- Switchery css -->
        <link href="plugins/switchery/switchery.min.css" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		 <link href="assets/css/custom-style.css" rel="stylesheet" type="text/css" />
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
        
        <!-- end headre page -->
              <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

        </head>

         <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

        <?php 
        // require 'topbar.php';
         ?>


            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left" style="height: 75px;">
                    <a href="/" class="logo"><img src="assets/images/logo-noir.png" class="img-responsive"></a>
                </div>

                <nav class="navbar-custom" >

                    <ul class="list-inline float-right mb-0" >
                      

                        <li class="list-inline-item dropdown notification-list">
                        
                            <!-- <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                            </a> -->

                            <a class="nav-link" data-widget="fullscreen" href="#" role="button" id="fullscreen-button" style="margin-top:20px" >
                            <h4> <i class="fas fa-expand-arrows-alt"></i></h4>
                             </a>

                            <!-- <a href="#" id="fullscreen-button">Toggle Full Screen</a> -->




                            <!-- <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview"> -->
                                <!-- item-->
                                <!-- <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Richard Payne</small> </h5>
                                </div> -->

                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a> -->

                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                </a> -->

                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>
                                </a> -->

                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i>
                                    <span>Logout</span>
                                </a> -->

                            <!-- </div> -->
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0" >
                        <li class="float-left col-md-4" >
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="zmdi zmdi-menu" style="margin-top:20px;"></i>
                            </button>
                        </li>

                        
                        <li class="float-left col-md-7">
                           <p style="font-size:xx-large; font-weight:700; color:white; margin-top:10px ; margin-left:-130px; ">ALPHA NERO </p>
                        </li>
                        
                       
                        <li class="float-left">
                        <form action="logout.php" method="Post">
                      <h6 style="display: inline-block; margin-left:-250px; color:white;" >Welcome <?php echo $_SESSION['auth_user']['username']?>!
                      <button type="logout" name="logout" style="border: none; background-color:none; margin-top:25px;">Log Out</button></h6>
         
                </form>
                                    </li>
                     

                        <li class="hidden-mobile app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


        <?php 
        // require 'leftbar.php'; 
        ?>
        
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

 
 <div class="left side-menu" style="background-color: #343A40;">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu" >
                        <ul>
                            <li class="text-muted menu-title"></li>

                            <li class="has_sub">                               
                                <a href="index.php" class="waves-effect" style="color: #C2C7D0;"><span class="badge badge-pill badge-primary float-right"></span><i class="nav-icon fas fa-tachometer-alt"></i><span> Dashboard </span> </a>
                            </li>

                            
                            <li class="has_sub">
                                <a href="consumption.php" class="waves-effect" style="color: #C2C7D0;"> <i class="nav-icon fas fa-hospital"></i> <span>Data Source Consumption</span></a>
                               
                            </li>
                            <ul class="list-unstyled">
                                    
                                    <li><a href="datasource.php" style="margin-left:-30px ;color: #C2C7D0;" ><i class="nav-icon fas fa-plus"></i>Data Source</a></li>
									<li><a href="datagroup.php" style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Data Source Group</a></li>
									<li><a  href="datasubcategory.php" style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Data Source Subcategory</a></li>
                                    <li><a  href="table_consumption.php" style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Consumption</a></li>

                                </ul>
                            <li class="has_sub">
                                <a href="project.php" style="color: #C2C7D0;"> <i class="nav-icon fas fa-address-card"></i>Project</a>
                                                              
                            </li>                           

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect subdrop" ><i class="zmdi zmdi-widgets" style="color: #C2C7D0;"></i> <span style="color: #C2C7D0;"> Configurations </span> <span class="menu-arrow"></span></a>

                                
                            </li>

                            <ul class="list-unstyled">
                                <li><a href="item_category.php"style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Item Category</a></li>
                                <li><a href="item_unit.php"style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Item Unit</a></li>
    
                                <li><a href="item.php" style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Item</a></li>
									<li><a href="location.php" style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Location</a></li>
									<li><a  href="table_emission.php" style="margin-left:-30px ;color: #C2C7D0;"><i class="nav-icon fas fa-plus"></i>Emission Factors</a></li>
									
                                </ul>

                            

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->


            <style>
                .app-search {display: none;}
            </style>

            

</body>

<script>
  // Function to toggle full-screen mode
  function toggleFullScreen() {
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
      // If not in full-screen mode, enter full-screen
      const element = document.documentElement; // This is the root element (the <html> tag)
      if (element.requestFullscreen) {
        element.requestFullscreen();
      } else if (element.mozRequestFullScreen) { // Firefox
        element.mozRequestFullScreen();
      } else if (element.webkitRequestFullscreen) { // Chrome, Safari, and Opera
        element.webkitRequestFullscreen();
      } else if (element.msRequestFullscreen) { // Internet Explorer
        element.msRequestFullscreen();
      }
    } else {
      // If in full-screen mode, exit full-screen
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) { // Firefox
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) { // Chrome, Safari, and Opera
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) { // Internet Explorer
        document.msExitFullscreen();
      }
    }
  }

  // Add an event listener to the anchor tag
  const fullscreenButton = document.getElementById('fullscreen-button');
  fullscreenButton.addEventListener('click', toggleFullScreen);
</script>

        
        </html>


        