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
        <style>
          .underline {
            position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%; /* Adjust this value to control the length of the line */
    height: 1px; /* Adjust this value to control the thickness of the line */
    color: white
}
[type="submit"] {
  padding-top: 8px !important;
}
.btn{
  padding-top: 9px !important;
}

.dashboard:hover{
background-color:#b28250;
width:239px;
border-top-right-radius:50px;
border-bottom-right-radius:50px;
color:white;
}

.dashboard:hover img,
.dashboard:hover i, 
.dashboard:hover span, 
.dashboard:hover p {
  filter: brightness(0) invert(1);
}


.loging{
  filter: brightness(0) invert(1);
 
}
.logings{
  filter: brightness(1) invert(0);
 
}
span, p{
  font-size:13px;
}

::-webkit-scrollbar {
  width: 12px;
  background-color: #0a0203; /* Change this to the background color you want */
}

::-webkit-scrollbar-thumb {
  background-color: black; /* Change this to the scrollbar color you want */
}


        </style>

        </head>

         <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

        <?php 
         ?>


            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left" style="height: 88px; background-color:black;">
                    <!-- <a href="/" class="logo"><img src="assets/images/logo-noir.png" class="img-responsive" height="60px" style="margin-top:10px;"></a> -->
                    <a href="#" class="logo"><img src="media/logoalpha2.jpg" class="img-responsive" height="112px" style="margin-top:-26px;"></a>
                </div>

                <nav class="navbar-custom" >

                    <ul class="list-inline float-right mb-0"  >
                      

                        <li class="list-inline-item dropdown notification-list" style="padding-right:20px;">
                      
                        <a class="nav-link loging" data-widget="fullscreen" href="#" role="button" id="fullscreen-button" style="margin-top:20px">
    <!-- Replace 'path_to_your_image' with the actual path to your image -->
    <img src="icons/expand_8944339-removebg-preview.png" alt="Fullscreen" style="height: 30px; width: 30px; ">
</a>


                            
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0" >
                        <li class="float-left col-md-4" >
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <!-- <i class="zmdi zmdi-menu" style="margin-top:20px;"></i> -->
                            </button>
                        </li>

                        
                        <li class="float-left col-md-7">
                           <p style="font-size:xx-large; font-weight:700; color:white; margin-top:10px ; margin-left:-130px; ">ALPHA NERO </p>
                        </li>
                        
                       
                        <li class="float-left">
                        <!-- <form action="logout.php" method="Post">
                      <h6 style="display: inline-block; margin-left:-250px; color:white;" >Welcome <?php echo $_SESSION['auth_user']['username']?>!
                      <button type="logout" name="logout" style="border: none; background-color:none; margin-top:25px;">Log Out</button></h6>
         
                </form> -->

                <form action="logout.php" method="Post" style="display:flex;align-items:center;">
    <h6 style="display: inline-block; margin-top:28px; margin-left: -250px; color: white;">
        Welcome <?php echo $_SESSION['auth_user']['username']?>!
        
      </h6>
      <a href="logout.php">
      
      <button type="logout" name="logout" style="border: none; background:none; background-color:none; margin-top:18px;"><img class="loging" src="icons/log-out-removebg-preview.png" alt="Logout" style="width: 40px; height: 40px;  color:white;"></button></h6>
</a>
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

 
 <div class="left side-menu" style="background-color: #0a0203; overflow-y:auto; padding:0px;">

       <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- <li class="nav-item">
            <a href="index.php" class="nav-link" style="color: #C2C7D0;" >
              <i class="nav-icon fas fa-tachometer-alt" style="font-size:1.1rem;"></i>
              <p style="margin:-20px 0px 3px 27px">
                Dashboard
                
              </p>
            </a>
           
          </li> -->
          <?php
          
                  $facility_id_login=$_SESSION['auth_user']['facility_id'];

                  if($facility_id_login===0)
                  {
          ?>
          <li class="nav-item " style="margin-left: -2px;">
    <a href="index.php" class="nav-link dashboard " style="color: #C2C7D0; display: flex; align-items: center; margin-bottom: 30px;padding-top: 10px;">
    
    
        <img src="icons/dashboard11.png" alt="Icon Image" style=" width: 30px;  margin-top:-5px; ">
        <span class="" style="margin-left: 7px; margin-top:-0px; ">Dashboard</span>
       
    </a>
</li>

<!-- <li class="nav-item">
    <a href="project.php" class="nav-link dashboard" style="color: #C2C7D0; display: flex; align-items: center;margin-top:15px; margin-bottom:30px; ">
        <img src="dashboard1.png" alt="Icon Image" style=" width: 30px; margin-top:-5px;   margin-top: px;">
        <span style="margin-left: 7px; margin-top:  10px;">Projects</span>
    </a>
</li> -->

<hr class="fade-in" style="border:1px solid #b28250;width:77.5%;margin-left:55px;margin-top:-25px; opacity:0.2;">


          

            <li class="nav-item" style="margin-left: -2px;margin-top: -9px;">
                  <a href="#" class="nav-link dashboard" style="color: #C2C7D0; display: flex; align-items: center; margin-bottom: 15px;height: 44px;">
                      <!-- <i class="nav-icon fas fa-hospital" style=" margin-left:5px;font-size:1.1rem;"></i> -->
                      <img class="logings" src="icons/datasource.png" alt="Icon Image" style=" width: 45px;heigth:46px; margin-left:-8px;">

                      <span style="margin-left:px;margin-top: 5px; ">
                        Data&nbsp;Source Consumption 
                        <!-- <i class="fas fa-angle-left right"></i>-->
</span>
                  </a>
              </li>
              <br>
              <hr style="border:1px solid #b28250;width:77.5%; margin-left:55px; margin-top:-30px; opacity:0.2;">

  


              <!-- <li class="nav-item">
    <a href="#" class="nav-link" style="color: #C2C7D0;">
        <img src="dashboard.png" alt="Icon Image" style="width: 3rem; height: rem; margin-right: 10px;">
        <p style="margin: -20px 0px -5px 27px;">
            Data Source Consumption  -->
            <!-- <i class="fas fa-angle-left right"></i>-->
        <!-- </p>
    </a>
</li> -->


            <li class="nav-item">
                        <a href="datasource.php" class="nav-link dashboard" style="color: #C2C7D0;">
                            <i class="nav-icon fas fa-plus" style="margin-left:25px; color:#b28250; margin-bottom:4px; vertical-align:middle; font-size:0.4rem; "></i>
                            <span style="margin-left:0px">
                              Data Source </span>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="datagroup.php" class="nav-link dashboard" style="color: #C2C7D0; display: flex; align-items: center;    padding-top: 10px; ">
                        <i class="nav-icon fas fa-plus" style="margin-left:25px; color:#b28250; margin-bottom:4px; vertical-align:middle; font-size:0.4rem;"></i>
                            <span style="margin-left:2px">
                              Data Source Group</span>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="datasubcategory.php" class="nav-link dashboard" style="color: #C2C7D0;display: flex; align-items: center;    padding-top: 10px;
 ">
                        <i class="nav-icon fas fa-plus" style="margin-left:25px;color:#b28250; margin-bottom:4px; vertical-align:middle; font-size:0.4rem;"></i>
                            <span style="margin-left:2px">
                              Data Source Subcategory</span>
                        </a>
            </li>
            
            <li class="nav-item">
                        <a href="table_consumption.php" class="nav-link dashboard" style="color: #C2C7D0;     padding-top: 10px;">
                        <i class="nav-icon fas fa-plus" style="margin-left:25px; color:#b28250; margin-bottom:4px; vertical-align:middle; font-size:0.4rem;"></i>
                            <span style="margin:0px;">
                              Consumption</span>
                        </a>
            </li>
            <hr style="border:1px solid #b28250;width:79.5%;margin-left:50px; margin-bottom:-6px;opacity:0.2;">

            <!-- <li class="nav-item">
                <a href="project.php" class="nav-link" style="color: #C2C7D0; margin-top:8px;">
                    <i class="nav-icon fas fa-address-card" style="font-size:1.1rem;"></i>
                   
                    <p style="margin:-20px 0px -5px 27px">
                       Project -->
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    <!-- </p>
                </a>
            </li> -->        

            <!-- <li class="nav-item " >
    <a href="index.php" class="nav-link  " style="color: #C2C7D0; display: flex; align-items: center; margin-bottom: 30px;">
    <div class="dashboard" style="">
    
        <img src="dashboard11.png" alt="Icon Image" style=" width: 30px;  margin-top:-5px; mix-blend-mode: difference;">
        <span class="" style="margin-left: 7px; margin-top:-10px; ">Dashboard</span>
        </div>
    </a>
</li> -->

            <li class="nav-item" style="margin-left: -2px;">
    <a href="project.php" class="nav-link dashboard" style="color: #C2C7D0; display: flex; align-items: center;margin-top:15px; margin-bottom:30px; padding-top: 0px; ">
        <img src="icons/dashboard1.png" alt="Icon Image" style=" width: 30px; margin-top:3px;">
        <span style="margin-left: 7px; margin-top:  10px;">Projects</span>
    </a>
</li>


<hr style="border:1px solid #b28250;width:79.5%;margin-left:50px;margin-top:-20px;opacity:0.2;">

            <li class="nav-item" style="margin-left: -2px;">
                <a href="#" class="nav-link dashboard" style="color: #C2C7D0; margin-top:-10px;padding-bottom: 17px;">
                <img src="icons/configurtion.png" alt="Icon Image" style=" width: 46px; margin-top:-5px;   margin-left: -10px;">
                   
                    <p style="margin:-30px 0px -5px 36px">
                       Configurations
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li><br>
            <hr style="border:1px solid #b28250;width:79.5%;margin-left:50px;margin-top:-14px;opacity:0.2;">
<!-- 
            <li class="nav-item">
                        <a href="table_consumption.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:8px;">
                        <i class="nav-icon fas fa-plus" style="margin-left:18px; color:#b28250; font-size:0.6rem;"></i>
                            <p style="margin:-13px 0px -5px 33px">
                              Consumption</p>
                        </a>
            </li> -->

            <li class="nav-item">
    <a href="item_category.php" class="nav-link dashboard " style="color: #C2C7D0; margin-top:-6px; display: flex; align-items: center;    padding-top: 10px;">
        <i class="nav-icon fas fa-plus" style="margin-left: 25px; color: #b28250; margin-bottom:3px; vertical-align:middle; font-size: 0.4rem;"></i>
        <span style="margin-left: 4px">Item Category</span>
    </a>
</li>


            <li class="nav-item">
                        <a href="item_unit.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:8px;    padding-top: 10px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:25px; margin-bottom:3px; vertical-align:middle; color:#b28250; font-size:0.4rem;"></i>
                            <p style="margin:-13px 0px -5px 33px">
                              Item Unit </p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="item.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:8px;    padding-top: 10px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:25px; margin-bottom:3px; vertical-align:middle; color:#b28250; font-size:0.4rem;"></i>
                            <p style="margin:-13px 0px -5px 33px">
                              Item </p>
                        </a>
            </li>

            <li class="nav-item">
                        <a href="location.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:8px;    padding-top: 10px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:25px; margin-bottom:3px; vertical-align:middle; color:#b28250; font-size:0.4rem;"></i>
                            <p style="margin:-13px 0px -5px 33px">
                              Location </p>
                        </a>
            </li><li class="nav-item">
                        <a href="table_emission.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:8px;padding-top: 10px;">
                            <i class="nav-icon fas fa-plus" style="margin-left:25px; margin-bottom:3px; vertical-align:middle; color:#b28250; font-size:0.4rem;"></i>
                            <p style="margin:-13px 0px -5px 33px">
                              Emission Factors </p>
                        </a>
            </li>
            <br>
            <br>
            <hr style="border:1px solid #b28250;width:79.5%;margin-left:50px;margin-top:-26px;opacity:0.2;">

            <li class="nav-item" style="margin-left: -2px;">
                <a href="retro_plan.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:-8px;padding-bottom: 17px;">
                <img src="media/restro_plan3.png" alt="Icon Image" style=" width: 46px; margin-top:-5px;   margin-left: -10px;">
                   
                    <p style="margin:-30px 0px -5px 36px">
                    Emission Factor Repository
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li>
            <br>
            <hr style="border:1px solid #b28250;width:79.5%;margin-left:50px;margin-top:-14px;opacity:0.2;">

            <li class="nav-item" style="margin-left: -2px;">
                <a href="client_add.php" class="nav-link dashboard" style="color: #C2C7D0; margin-top:-10px;padding-bottom: 17px;">
                <img src="media/client2.png" alt="Icon Image" style=" width: 46px; margin-top:-5px;   margin-left: -10px;">
                   
                    <p style="margin:-30px 0px -5px 36px">
                       Clients
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li>
            <hr style="border:1px solid #b28250;width:79.5%;margin-left:50px; margin-bottom:-6px;opacity:0.2;    margin-top: 6px;">
<?php }else{ ?>
  <li class="nav-item " style="margin-left: -2px;">
    <a href="index.php" class="nav-link dashboard " style="color: #C2C7D0; display: flex; align-items: center; margin-bottom: 30px;padding-top: 10px;">
    
    
        <img src="icons/dashboard11.png" alt="Icon Image" style=" width: 30px;  margin-top:-5px; ">
        <span class="" style="margin-left: 7px; margin-top:-0px; ">Dashboard</span>
       
    </a>
</li>

            <hr style="border:1px solid #b28250;width:79.5%;margin-left:50px;margin-top:-20px;opacity:0.2;">

            <li class="nav-item" style="margin-left: -2px;">
                <a href="retro_plan_excel/Alpha_Nero_Emission_sheet.xlsx" class="nav-link dashboard" style="color: #C2C7D0; margin-top:-10px;padding-bottom: 17px;">
                <img src="media/restro_plan3.png" alt="Icon Image" style=" width: 46px; margin-top:-5px;   margin-left: -10px;">
                   
                    <p style="margin:-30px 0px -5px 36px">
                    Emission Factor Repository
                       <!-- <i class="fas fa-angle-left right"></i>-->
                    </p>
                </a>
            </li>
  <?php } ?>
            

        </ul>

       </nav>
<img src="media/logofooter3.jpg" alt="" srcset="" style="width:195px; height:187px; margin-left:96px;">
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


        