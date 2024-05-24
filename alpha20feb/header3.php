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
                      
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button" id="fullscreen-button" style="margin-top:20px" >
                            <h4> <i class="fas fa-expand-arrows-alt"></i></h4>
                             </a>

                            
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
        
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

 
 <div class="left side-menu" style="background-color: #0a0203;">

       <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="index.php" class="nav-link" style="color: #C2C7D0;" >
              <i class="nav-icon fas fa-tachometer-alt" style="font-size:1.1rem;"></i>
              <p style="margin:-20px 0px 3px 27px">
                Dashboard
                
              </p>
            </a>
           
          </li>

          

          <li class="nav-item">
                <a href="#" class="nav-link" style="color: #C2C7D0;">
                    <i class="nav-icon fas fa-hospital" style="font-size:1.1rem;"></i>
                   
                    <p style="margin:-20px 0px -5px 27px">
                      Data Source Consumption 
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li>

            <li class="nav-item">
                        <a href="datasource.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Data Source </p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="datagroup.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                        <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Data Source Group</p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="datasubcategory.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                        <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Data Source Subcategory</p>
                        </a>
            </li>
            
            <li class="nav-item">
                        <a href="table_consumption.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                        <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Consumption</p>
                        </a>
            </li>

            <li class="nav-item">
                <a href="project.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                    <i class="nav-icon fas fa-address-card" style="font-size:1.1rem;"></i>
                   
                    <p style="margin:-20px 0px -5px 27px">
                       Project
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                    <i class="zmdi zmdi-widgets" style="font-size:1.1rem; margin-top:9px;"></i>
                   
                    <p style="margin:-20px 0px -5px 27px">
                       Configurations
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li>

            <li class="nav-item">
                        <a href="item_category.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Item Category </p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="item_unit.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Item Unit </p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="item.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Item </p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="location.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Location </p>
                        </a>
            </li><li class="nav-item">
                        <a href="table_emission.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:10px; font-size:1.1rem;"></i>
                            <p style="margin:-20px 0px -5px 33px">
                              Emission Factors </p>
                        </a>
            </li>

            

        </ul>

       </nav>

            </div>


            <style>
                .app-search {display: none;}
            </style>
            <footer class="footer">
                <?php 
                echo date("Y");
                 ?> &copy; Alpha Nero
            </footer> 
            

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


        