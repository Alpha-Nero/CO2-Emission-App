<?php
        include 'auth.php';
        // require 'includes/header_start.php';
        

        include 'database.php';
        ?>

                <!--Morris Chart CSS -->
                <link rel="stylesheet" href="plugins/morris/morris.css">
                <style>
                    .model{

                        height:100%;
                        width:100%;
                        background-color: rgba(0,0,0,0.5);
                        top:0;
                        left:0;
                        position:fixed;
                        z-index: 10;
                        display:none;
                    }
                    .modelbox{

                        width: 40%;
                        height:68%;
                        background-color: white;
                        margin-top:12%;
                        margin-left:30%;
                        border-radius:10px;
                    }
                    .model2{

                    height:100%;
                    width:100%;
                    background-color: rgba(0,0,0,0.5);
                    top:0;
                    left:0;
                    position:fixed;
                    z-index: 10;
                    display:none;
                    }
                    .modelbox2{

                    width: 40%;
                    height:55%;
                    background-color: white;
                    margin-top:12%;
                    margin-left:30%;
                    border-radius:10px;
                    }
                    .model_edit{

                    height:100%;
                    width:100%;
                    background-color: rgba(0,0,0,0.5);
                    top:0;
                    left:0;
                    position:fixed;
                    z-index: 10;
                    display:none;
                    }
                    .modelbox_edit{

                    width: 30%;
                    height:45%;
                    background-color: white;
                    margin-top:15%;
                    margin-left:35%;
                    border-radius:10px;
                    }
                    .model_edit2{

                    height:100%;
                    width:100%;
                    background-color: rgba(0,0,0,0.5);
                    top:0;
                    left:0;
                    position:fixed;
                    z-index: 10;
                    display:none;
                    }
                    .modelbox_edit2{

                    width: 33%;
                    height:50%;
                    background-color: white;
                    margin-top:15%;
                    margin-left:35%;
                    border-radius:10px;
                    }
                    .model3{

                    height:100%;
                    width:100%;
                    background-color: rgba(0,0,0,0.5);
                    top:0;
                    left:0;
                    position:fixed;
                    z-index: 10;
                    display:none;
                    }
                    .modelbox3{

                    width: 33%;
                    height:50%;
                    background-color: white;
                    margin-top:15%;
                    margin-left:35%;
                    border-radius:10px;
                    }
                    #confirm {
                    display: none;
                    background-color: #F3F5F6;
                    color: #000000;
                    border: 1px solid #aaa;
                    position: fixed;
                    width: 270px;
                    height: 100px;
                    left: 40%;
                    top:40%;
                    margin-left: -100px;
                    padding: 10px 20px 10px;
                    box-sizing: border-box;
                    text-align: center;
                }

                    #confirm button {
                        background-color: #FFFFFF;
                        display: inline-block;
                        border-radius: 12px;
                        border: 4px solid #aaa;
                        padding: 5px;
                        text-align: center;
                        width: 60px;
                        cursor: pointer;
                    }

                    #confirm .message {
                        text-align: left;
                    }
            </style>

        <?php
        // require 'includes/header_end.php'; 
        require 'header.php';
        $project_master_id = $_GET['id'];
        ?>

                    <!-- ============================================================== -->
                    <!-- Start right Content here -->

                    <!-- 
                        <div class="card-body">
                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:0px; display:inline-block" class="card-title"> Description </p>
                                                        <hr>
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5;" class="col-md-4"> <?php echo $data_project['project_master_end_date'] ?> </p>
                                                    

                                                    </div>-->
                    <!-- ============================================================== -->
                    <div class="content-page">
                        <!-- Start content -->
                        <div class="content">
                            <div class="container-fluid">
                            <div class="col-sm-6">
        <!--                    <h4 style="margin-left: 22px;">Project </h4>
        -->            </div>


                    <!-- ============================================================== -->
                    <!-- index.php emission code Start right here -->
                    <!-- ============================================================== -->


                <?php

                // fetching data from particular id 
                $sql_date = "SELECT * FROM project_master 
                        where  project_master_id =$project_master_id;";
                $result_date = mysqli_query($conn, $sql_date);
                $data_date = mysqli_fetch_array($result_date);


                //fetching data from data source table
                $sql_ds = "SELECT * FROM data_source where is_visibility=1; ";
                $result_ds = mysqli_query($conn, $sql_ds);
                $data_ds = array();
                while ($row = mysqli_fetch_assoc($result_ds)) {
                    // $data_ds[]=$row;
                
                    //giving feilds to array
                    $data_ds[] = array(
                        'data_source_id' => $row['data_source_id'],
                        'icon' => $row['icon'],
                        'data_source_name' => $row['data_source_name'],
                        'data_source_emission' => 0,
                    );
                }

                // print_r($data_ds);
                

                ///assinging start date and end date   
                $project_name = $data_date['project_name'];
                $string_sd = $data_date['project_master_start_date'];
                $string_ed = $data_date['project_master_end_date'];
                $start_date = new DateTime($data_date['project_master_start_date']);
                $end_date = new DateTime($data_date['project_master_end_date']);
                // echo $string_sd;
                
                //calculating the days between star and end date 
                // Calculate the difference in days
                $interval = $start_date->diff($end_date);
                $days = $interval->days;


                //arraya containg all emission value
                $data_all_emission = array();


                //declaring scope varible as 0
                $scope_1_emission = 0;
                $scope_2_emission = 0;
                $scope_3_emission = 0;
                $scope_red_emission = 0;


                $data_consumption_project = 0;
                $i = 1;


                // first loop for running no. of dates //
                while ($start_date <= $end_date) {



                    $scope_1_emission = 0;
                    $scope_2_emission = 0;
                    $scope_3_emission = 0;
                    $scope_red_emission = 0;

                    //echo $i;
                    $i++;

                    $month = 0;


                    $date = $start_date->format('Y-m-d'); // Get the date in 'Y-m-d' format
                    $month_name = $start_date->format('F'); // Get the month name
                    $year_name = $start_date->format('Y');

                    // echo "date=>".$date ."<br>";
                


                    // echo $project_master_id;
                    //query for fetching particular project area
                    $sql_pro_location = "SELECT *, lp.add_number_of_location*lm.location_master_area as project_area FROM project_master as pm
                                            join add_location_to_project as lp on pm.project_master_id=lp.add_Location_to_project_project_id
                                            join location_master as lm on lp.add_Location_to_project_location_id=lm.location_master_id
                                            where  pm.project_master_id=$project_master_id;";

                    $result_pro_location = mysqli_query($conn, $sql_pro_location);
                    $data_pro_location = mysqli_fetch_assoc($result_pro_location);

                    // storing particular project area value
                    $project_area = $data_pro_location['project_area'] ?? 0;
                    //  echo "project area =>".$project_area."<br>";
                
                    // echo $project_area."<br>";
                
                    //query for fetching total  project area for that dat
                    $sql_total_location = " SELECT *, sum(lp.add_number_of_location*lm.location_master_area) as total_project_area  FROM project_master as pm 
                        join add_location_to_project as lp on pm.project_master_id= lp.add_Location_to_project_project_id
                        join location_master as lm on lp.add_Location_to_project_location_id=lm.location_master_id
                        WHERE '$date' BETWEEN pm.project_master_start_date AND pm.project_master_end_date ";

                    $result_total_location = mysqli_query($conn, $sql_total_location);
                    $data_total_location = mysqli_fetch_assoc($result_total_location);

                    // storing total project area value
                    $total_project_area = $data_total_location['total_project_area'] ?? 0;
                    //  echo " total project area =>".$total_project_area."<br>";
                
                    //echo $total_project_area ."<br>";
                

                    //if  $project_area is zero it gave fetal error so if any one is zero fraction is 1
                    if ($project_area == 0 || $total_project_area == 0) {
                        $fraction = 1;
                    } else {
                        $fraction = $project_area / $total_project_area;
                    }
                    // echo "fraction value =>".$fraction."<br>"; 
                





                    //$date = '2023-06-15';
                    $month = date('m', strtotime($date)); //assining month string in variable 
                
                    // echo "Month number: $month";
                

                    // query for fetching emission values 
                    $sql = "SELECT *, c.consumption_value*ef.emission_factors_value as emission_value FROM tbl_month_consumption_sub as c
        join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
        join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
        join data_source as ds on dss.data_source_id = ds.data_source_id
        where c.month='$month_name' and c.year=$year_name and ef.year=$year_name and dss.is_reduction='no'";

                    $result = mysqli_query($conn, $sql);
                    $data_dss = 0;


                    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year_name);

                    //  echo "There are $days_in_month days in the month of $month/$year_name.";
                
                    while ($row = mysqli_fetch_assoc($result)) {

                        $scope_1 = ($row['scope'] == 'Scope 1') ? 'yes' : 'no';
                        $scope_2 = ($row['scope'] == 'Scope 2') ? 'yes' : 'no';
                        $scope_3 = ($row['scope'] == 'Scope 3') ? 'yes' : 'no';

                        $scope_reduction = ($row['is_reduction'] == 'no') ? 'no' : 'yes';
                        $data_all_emission[] = array(

                            'ds_id' => $row['data_source_id'],
                            'ds_name' => $row['data_source_name'],
                            'dss_id' => $row['data_source_subcategory_id'],

                            'scope_1' => $scope_1,
                            'scope_2' => $scope_2,
                            'scope_3' => $scope_3,
                            'scope_reduction' => $scope_reduction,
                            'dss_emission' => ($row['emission_value'] / $days_in_month) * $fraction,



                        );
                        // echo  "subcateogry emission =>".$row['emission_value']."<br>";
                        // echo "no of days =>".$days_in_month."<br>";
                        // echo "fraction =>".$fraction."<br>";
                        // echo "array stored data emission value".$data_all_emission['dss_emission']."<br>";
                        // echo "<br>";
                


                        //data emission value per day
                        $data_dss += $row['emission_value'] / $days_in_month;

                        //  echo "<br> dss consumption _value =>".$data_dss;
                        //loop2
                    }

                    //storing all emission by day in scope varibale
                    $scope_id = 0;
                    foreach ($data_all_emission as $value) {
                        if ($data_all_emission[$scope_id]['scope_1'] == 'yes') {
                            //  print_r($data_all_emission[$scope_id]['scope_1']);
                            $scope_1_emission += $data_all_emission[$scope_id]['dss_emission'];
                        } elseif ($data_all_emission[$scope_id]['scope_2'] == 'yes') {
                            $scope_2_emission += $data_all_emission[$scope_id]['dss_emission'];
                        } elseif ($data_all_emission[$scope_id]['scope_3'] == 'yes') {
                            $scope_3_emission += $data_all_emission[$scope_id]['dss_emission'];
                        } elseif ($data_all_emission[$scope_id]['scope_reduction'] == 'yes') {
                            $scope_red_emission += $data_all_emission[$scope_id]['dss_emission'];
                        }
                        $scope_id++;
                    }


                    // Iterate through $data_ds
                    foreach ($data_ds as &$data_source) {
                        // Initialize the emission value to 0 for this data source
                        $data_source['data_source_emission'] = 0;

                        // Iterate through $data_all_emission to find matching data sources
                        foreach ($data_all_emission as $emission_data) {
                            if ($data_source['data_source_name'] === $emission_data['ds_name']) {
                                // Add the emission value for this data source
                                $data_source['data_source_emission'] += $emission_data['dss_emission'];
                            }
                        }
                    }
                    //unset($data_source); // Unset the reference to avoid potential issues
                
                    // Print the updated $data_ds array with emission values
                






                    // echo "sum up value of emission=>". $data_dss;
                
                    // echo "fraction value =>".$fraction;
                
                    //total emission value of that day = total data source subcategory of that day * fraction 
                    $emission_dss = $data_dss * $fraction;

                    //echo "emission value =>".$emission_dss;
                
                    //total data emission value of every day add on
                    $data_consumption_project += $emission_dss;


                    // echo "$date $year_name  $month_name<br>"; // Display date and month name
                
                    $start_date->add(new DateInterval('P1D')); // Increment the date by one day
                


                    //loop end foreach
                }


                // print_r($data_ds);
                
                //declarying array 
                $data_ds_name = array();
                //declaring arr for icon
                $data_ds_icon = array();
                //declarying array 
                $data_ds_value = array();
                //declarying varible
                $total_donut_value = 0;

                foreach ($data_ds as $value) {
                    $data_ds_name[] = $value['data_source_name'];
                    $data_ds_icon[] = $value['icon'];
                    $data_ds_value[] = $value['data_source_emission'];
                    $total_donut_value += $value['data_source_emission'];

                }



                ?>


                    <!-- ============================================================== -->
                    <!--  index.php emission code End right here -->
                    <!-- ============================================================== -->
                




                            <div class="card">
                                <div class="card-body">

                                <?php

                                //delete div bbox
                                if (isset($_GET['delete'])) {
                                    $delete = $_GET['delete'];

                                } else {
                                    $delete = "";
                                }

                                ?>

                                    <?php if (!empty($delete)): ?>
                                                <div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="delete-message">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                                        <?php echo $delete; ?>
                                                        </div>
                                    
                                    
                                    <?php endif; ?>


                                        <?php
                                        //update div box
                                        if (isset($_GET['update'])) {
                                            $update = $_GET['update'];

                                        } else {
                                            $update = "";
                                        }

                                        ?>

                                    <?php if (!empty($update)): ?>
                                                <div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="update-message">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                                        <?php echo $update; ?>
                                                        </div>
                                    
                                    
                                    <?php endif; ?>

                                        <?php
                                        //success div bbox
                                        if (isset($_GET['success'])) {
                                            $success = $_GET['success'];

                                        } else {
                                            $success = "";
                                        }

                                        ?>

                                    <?php if (!empty($success)): ?>
                                                <div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="success-message">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                                        <?php echo $success; ?>
                                                        </div>
                                    
                                    
                                    <?php endif; ?>


                                        <?php
                                        //error div bbox
                                        if (isset($_GET['error'])) {
                                            $errorMessage = $_GET['error'];

                                        } else {
                                            $errorMessage = "";
                                        }

                                        ?>

                                    <?php if (!empty($errorMessage)): ?>
                                                <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" >
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                                        <?php echo $errorMessage; ?>
                                                        </div>
                                    
                                    <?php endif; ?>


                                    <?php

                                    //fetching data of project by project id
                                    $sql_project = "SELECT * FROM project_master where project_master_id=$project_master_id;";
                                    $result_project = mysqli_query($conn, $sql_project);

                                    $data_project = mysqli_fetch_array($result_project);
                                    // print_r($data_project);
                                    
                                    ?>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 style="margin-left: 1%;">Project Details View</h4>
                                            </div>  
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <!--Displaying project name-->
                                                <h3 style="font-size:x-large">Project Name : <?php echo $data_project['project_name'];
                                                $url = "editable_template.php?id=" . $project_master_id;

                                                ?></h3>
                                                <div class="col-md-4" style="text-align: center; ">


                                                <a href="<?php echo $url; ?>"><h6 >Create Project Report</h6></a>
                                                </div>
                                            </div>

                                            <hr style="width: 50%;">

                                        
                                            <div class="row">
                                            <div class="col-md-6">
                                            <!-- displaying projects details-->
                                            

                                                    <div class="card" style="margin-top:20px;">
                                                        <div class="card-body">
                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:10px; display:inline-block" class="col-md-7"> Start Date </p>
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5;display:inline-block" class="col-md-4"> <?php echo $data_project['project_master_start_date'] ?></p>
                                                    
                                                        
                                                        </div>
                                                    </div>
                                            
                                                    <div class="card" style="margin-top:20px;">
                                                        <div class="card-body">
                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:10px; display:inline-block" class="col-md-7"> Project Total Days </p>
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5;display:inline-block" class="col-md-4"> <?php echo $days . " Days" ?> </p>
                                                    
                                                        </div>
                                                    </div>
                                            
                                            
                                                <!--./col-md-6-->
                                                </div>
                                        
                                                <div class="col-md-6" >

                                                    <div class="card" style="margin-top:20px;">
                                                        <div class="card-body">
                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:10px; display:inline-block" class="col-md-7"> End Date </p>
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5;display:inline-block" class="col-md-4">  <?php echo $data_project['project_master_end_date']; ?> </p>
                                                    
                                                        </div>
                                                    </div>
                                            
                                                    <div class="card" style="margin-top:20px;">

                                                    <?php
                                                    //fetching item emission value of the project and storing it in varible
                                                    $sql_item_emission = "SELECT *,
                                                    SUM(ip.add_Item_to_project_item_quantity * it.item_emission_factor * 
                                                    COALESCE(NULLIF(ip.add_Item_to_project_item_quantity2, 0), 1)
                                                    ) as emission_item_project
                                                FROM project_master as pm
                                                JOIN add_item_to_project as ip ON pm.project_master_id = ip.add_Item_to_project_assign_id
                                                JOIN item as it ON ip.add_Item_to_project_item_id = it.item_id
                                                WHERE ip.add_Item_to_project_assign_id = $project_master_id
                                                    AND ip.add_Item_to_project_is_visibility = 1;";
                                                    $result_item_emission = mysqli_query($conn, $sql_item_emission);
                                                    // echo $sql_item_emission;
                                                    $data_item_emission = mysqli_fetch_array($result_item_emission);

                                                    // $add_Item_to_project_item_quantity2 = ($data_items[$i]['add_Item_to_project_item_quantity2']=='' || $data_items[$i]['add_Item_to_project_item_quantity2']==NULL || $data_items[$i]['add_Item_to_project_item_quantity2']== 0  ) ? 1 : $data_items[$i]['add_Item_to_project_item_quantity2'] ;

                                                                    //   $add_Item_to_project_item_quantity2 = !empty($data_item_emission['add_Item_to_project_item_quantity2']) ? $data_item_emission['add_Item_to_project_item_quantity2'] : 1;
                                                                    //   $totalEmission=0;
                                                                    //      $emission = (float) $data_item_emission['emission_item_project'];
                                                                    //      $quantity = (float) $add_Item_to_project_item_quantity2;
                                                                    //      $totalEmission += $emission * $quantity;
                                                                    //      echo number_format( $totalEmission, 2, '.', ',') . " tCO<sub>2</sub>e" 
                                                                    


                                                    ?>
                                                        <div class="card-body">

                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:10px; display:inline-block" class="col-md-7.8"> Total Item Emission of the Project </p>
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5;display:inline-block;margin-left:6 %" > <?php echo number_format($data_item_emission['emission_item_project'], 2, '.', ',') ?> </p>
                                                
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5; display:inline-block;margin-left:3%;"> <?php echo " tCO<sub>2</sub>e" ?> </p>
                                                        </div>
                                                    </div>
                                            
                                                
                                                    <!--./col -md-6-->
                                                </div>
                                                <!-- ./row-->
                                                </div>

                                                
                                                <div class="card" style="margin-top:20px;">
                                                        <div class="card-body">
                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:10px; display:inline-block" class="col-md-4"> Total Emission by all Data Sources </p>
                                                        <p style="font-size:large; font-weight:600;line-height:0.6;color:#4B4BC5;display:inline-block; margin-left:10px"  > <?php echo number_format($total_donut_value, 2, '.', ',') ?> </p>
                                                        <p style="font-size:medium; font-weight:500;line-height:0.6;color:#4B4BC5;display:inline-block; margin-left:10px" > <?php echo " tCO<sub>2</sub>e" ?> </p>
                            
                                                        </div>
                                                    </div>

                                                <div class="card" style="margin-top:20px;">
                                                        <div class="card-body">
                                                            <div class="row">
                                                        <p style="font-size: medium; font-weight:500;line-height:0.6;margin-top:10px;margin-left:10px; " class="col-md-4 "> Description </p>
                                                        <p style="font-size:medium; font-weight:500;line-height:1.2;color:#4B4BC5;" class="col-md-7"><?php echo $data_project['project_master_description'] ?></p>
                                                        </div>

                                                    </div>
                                                    </div>





                                            <!-- ./displaying projects details-->
                                            <hr>
                                           
                                            <!-- row3-->
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                        <div class="row">    
                                                        <h5 style="margin-left:10px ;" class="col-md-6">Add Items into Project </h5>
                                                        <!-- button for popup upload file-->
                                                    
                                                        <button id="openFormBtn3" style="margin-left:27%;" class="btn btn-info btn-primary col-md-2.5" >Upload File</button>

                                                        <!-- button for popup inserting data into form file-->
                                                            <button id="openFormBtn" class="btn btn-info btn-primary col-md-2.5" style="margin-left:auto;">Add Item</button>
                                                            </div>
                                                            <hr>
                                                            <!-- link for downloading-->
                                                            <a href="documents/Project_Item_Template.xlsx">Download Items Upload Sheet</a>
                                                            <!-- row3.1-->
                                                        <div class="row">
                                                        


                                                                <!-- Hidden form for adding items 1 popup for adding item detail-->
                                                                <div id="addItemForm" style="display: none;" class="model">
                                                                <div class="modelbox">

                                                                <?php
                                                                //fetching data from item table to display into drop down
                                                                // $sql_item = "SELECT * FROM item as it join item_unit as iu on it.item_unit=iu.item_unit_name where it.item_is_visibility=1 order by item_code asc;";
                                                                $sql_item = "SELECT * FROM item as it Where it.item_is_visibility=1 order by item_code asc;";

                                                                $result_item = mysqli_query($conn, $sql_item);
                                                                $data_item = array();
                                                                while ($row = mysqli_fetch_assoc($result_item)) {

                                                                    $data_item[] = $row;
                                                                }
                                                                //  print_r($data_item);

                                                                $sql_item_category = "SELECT * FROM item_category";

// Perform the query
$result_category = mysqli_query($conn, $sql_item_category);

// Initialize an empty array to store category data
$item_categories = array();

// Fetch associative array rows of the result and store in $item_categories
while ($row = mysqli_fetch_assoc($result_category)) {
    $item_categories[] = $row;
}
                                                                
                                                                ?>

                                                                
                                                                  
                                                                   <!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                    <h5 class="col-md-11">Add Items into Project </h5>
                                                                    <a href="#" id="closeFormBtn" class="close-button" style="font-size: x-large; margin-left:4%; margin-top:-2%">&times;</a>
                                                                    </div>
                                                                    <hr>
                                                                    <form id="itemForm" method="POST" action="project_item_code.php">


                                                                    
                                                                    <div class="form-group ">
                                                                            <label for="item_category_id">Select Item Category</label>
             <!-- Your HTML select element -->
             <select name="item_code" class="form-control" id="item_name" onchange="showSelectedValue(this)">
    <option value="">Choose Items</option>
    <?php foreach ($item_categories as $category): ?>
        <option value="<?php echo $category['item_category_id']; ?>">
            <?php/* echo $category['item_category_id'] . " " */?><?php echo $category['item_category_name']; ?>
        </option>
    <?php endforeach; ?>
</select>
    </div>


<!-- A paragraph to display the selected item ID -->


<!-- PHP and JavaScript code on the same page -->



<script>
function showSelectedValue(selectElement) {
    var selectedValue = selectElement.value;
    console.log(selectedValue);
    $('#item_name_item').empty();
    // Send the selectedValue to the server using AJAX
    $.ajax({
        url: 'itemselect.php',
        type: 'POST',
        data: { selectedValue: selectedValue },
        success: function(data) {
            data = JSON.parse(data);
 
            // Append new options based on the data received
            data.forEach(function(option) {
                $('#item_name_item').append(`<option value="${option.item_id}" data-unit2="${option.item_unit2}">
                    ${option.item_code} (${option.item_unit}) (${option.item_unit2})
                </option>`);
            });
        }
    });
}




</script>
                                                                        

                                                                        <!-- Form fields go here -->
                                                                        <div class="form-group ">
                                                                            <label for="item_category_id">Select Item</label>
                                                                        
                                                                            <select name="item_code" class="form-control" id="item_name_item">
                                                                            <option value="">Choose Items</option>

                                                                            <?php foreach ($data_item as $value) { ?>
                <option value="<?php echo $value['item_id'] ?>" data-unit2="<?php echo $value['item_unit2'] ?>">
                    <?php echo $value['item_code'] ?> (<?php echo $value['item_unit'] ?>) (<?php echo $value['item_unit2'] ?>)
                </option>
    <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                      
                                                                        <div class="row" >
                                                                        <div class="form-group col-md-12">
                                                                            <label for="item_quantity">Item Quantity</label>
                                                                            <input type="text" class="form-control" name="item_quantity" id="quantity_input" placeholder="Enter Quantity " required>
        <input type="hidden" class="form-control" name="project_master_id" value="<?php echo $project_master_id ?>" id="project_id" placeholder="Enter Quantity">
        <input type="text" class="form-control" style="margin-top: 10px;" name="item_quantity2" id="quantity_input2" placeholder="Enter Quantity " required>
        <br>
                                                                        <script>
                                                                            $(document).ready(function() {
    $('#item_name_item').change(function() {
        var selectedOption = $(this).find(':selected');
        var unit2 = selectedOption.data('unit2');
        console.log(unit2);

        if (unit2 !== '') {
            $('#quantity_input').attr('type', 'text').attr('name', 'item_quantity').attr('placeholder', 'Enter Quantity ').attr('required', 'required');

            $('#quantity_input2').attr('type', 'text').attr('name', 'item_quantity2').attr('placeholder', 'Enter Quantity ').attr('required', 'required');

        } else {

            $('#quantity_input2').attr('type', 'hidden').attr('name', 'item_quantity2').attr('placeholder', 'Enter Quantity').removeAttr('required');
        }
    });
});

                                                                        </script>


                                                                        </div>

                                                                        </div>


                                                                    


                                                                        <button type="submit" class="btn btn-info btn-primary col-md-2" name="submit">Submit</button>
                                                                    </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                //script for inserting data through form
                                                                document.getElementById("openFormBtn").addEventListener("click", function () {
                                                                    document.getElementById("addItemForm").style.display = "block";
                                                                });

                                                                document.getElementById("closeFormBtn").addEventListener("click", function () {
                                                                    document.getElementById("addItemForm").style.display = "none";
                                                                });
                                                                </script>
                                                                <!-- ./item adding details 1 end here-->
                                                        </div>
                                                            <!-- ./row3.1-->










                                                                                                                    
                                                                <!-- pop up for uploading file -->

                                                                <!-- Hidden form for adding items -->
                                                                <div id="addItemForm3" style="display: none;" class="model3">
                                                                <div class="modelbox3">

                                                                
                                                                
                                                                    

                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                    <h5 class="col-md-11">Upload Project Item Detail File </h5>
                                                                    <a href="#" id="closeFormBtn3" class="close-button" style="font-size: x-large; margin-left:4%; margin-top:-2%">&times;</a>
                                                                    </div>
                                                                    <hr>
                                                                    <form id="itemForm3" method="POST" action="project_file_code.php" enctype="multipart/form-data">
                                                                        

                                                                        <!-- Form fields go here -->
                                                                        <div class="form-group ">
                                                                            <label for="item_category_id">Select Item</label>
                                                                            <input type="file" name="item_doc" class="form-control" style="height: 40px;">
                                                                        
                                                                        
                                                                        </div>
                                                                    
                                                                        <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="hidden" class="form-control" name="project_master_id" value="<?php echo $project_master_id ?>" placeholder="Enter Qunatity" >


                                                                        </div>

                                                                        </div>


                                                                    

                                                                        <br>

                                                                        <button type="submit" class="btn btn-info btn-primary col-md-12" name="submit">Submit</button>
                                                                    </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    //script for inserting data through uploading file
                                                                document.getElementById("openFormBtn3").addEventListener("click", function () {
                                                                    document.getElementById("addItemForm3").style.display = "block";
                                                                });

                                                                document.getElementById("closeFormBtn3").addEventListener("click", function () {
                                                                    document.getElementById("addItemForm3").style.display = "none";
                                                                });
                                                                </script>
                                                                
                                                                <!-- pop up for uploading file end here-->


                                                        
                                                            <!-- table-->
                                                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px;">
    <thead>
        <tr>
            <th style="width:5%">S.no</th>
            <th style="width:12%">Item Code</th>
            <th style="width:10%">Unit</th>
            <th style="width:10%">Qty I</th>
            <th style="width:10%">Qty II</th>
            <th style="width:20%">Emission</th>
            <th style="width:5%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php

                        // echo $project_master_id;
                                                                    
                                                                    //declaring data_month as array variable
                                                                    $data_month = array();

                                                                    //fetchin data from table consumption
                                                                    // $sql_item = "SELECT *, ip.add_Item_to_project_item_quantity*it.item_emission_factor as emission_item FROM add_item_to_project as ip
                                                                    // join item as it on ip.add_Item_to_project_item_id=it.item_id
                                                                    // join item_unit as iu on it.item_unit=iu.item_unit_name
                                                                    // join item_category as ic on it.item_category_id=ic.item_category_id

                                                                    // WHERE ip.add_Item_to_project_assign_id=$project_master_id and ip.add_Item_to_project_is_visibility=1
                                                                    // order by add_Item_to_project_id desc ;";
                                                                    $sql_item="SELECT *,(ip.add_Item_to_project_item_quantity*it.item_emission_factor) as emission_item FROM project_master as pm 
                                                                    JOIN add_item_to_project as ip ON pm.project_master_id = ip.add_Item_to_project_assign_id 
                                                                    JOIN item as it ON ip.add_Item_to_project_item_id = it.item_id
                                                                    join item_unit as iu on it.item_unit=iu.item_unit_name WHERE 
                                                                        ip.add_Item_to_project_assign_id =$project_master_id AND 
                                                                        ip.add_Item_to_project_is_visibility = 1;";
// echo $sql_item;
                                                                    $result_item = mysqli_query($conn, $sql_item);

                                                                    //declaring data_item as array variable
                                                                    $data_items = array();

                                                                    //storing item table data in $data_consumption variable
                                                                    if (mysqli_num_rows($result_item) > 0) {

                                                                        while ($row = mysqli_fetch_assoc($result_item)) {
                                                                            //storing data in $data_consumption array
                                                                            $data_items[] = $row;
                                                                            // print_r($row);
                                                                        }

                                                                    }

                                                                    //  print_r($data_items);
                                                                    // counting $data_consumption array rows
                                                                    $count = count($data_items);

                                                                    // echo count($data_item);
        $z = 1;
        // loop for printing data
        for ($i = 0; $i < $count; $i++) {
            $add_Item_to_project_item_quantity2 = ($data_items[$i]['add_Item_to_project_item_quantity2'] == '' || $data_items[$i]['add_Item_to_project_item_quantity2'] == NULL || $data_items[$i]['add_Item_to_project_item_quantity2'] == 0) ? 1 : $data_items[$i]['add_Item_to_project_item_quantity2'];
            $emission = (float) $data_items[$i]['emission_item'];
            $quantity = (float) $add_Item_to_project_item_quantity2;
            ?>
            <tr>
                <td style="font-size:smaller;"><?php echo $z; ?></td>
                <td style="font-size:smaller;"><?php print_r($data_items[$i]['item_code']); ?></td>
                <td style="font-size:smaller;"><?php print_r($data_items[$i]['item_unit_name']); ?></td>
                <td style="font-size:smaller;"><?php print_r($data_items[$i]['add_Item_to_project_item_quantity']); ?></td>
                <td style="font-size:smaller;"><?php print_r(($data_items[$i]['add_Item_to_project_item_quantity2'] != 0) ? $data_items[$i]['add_Item_to_project_item_quantity2'] : ''); ?></td>
                <td style="font-size:smaller;"><?php print_r(number_format($emission * $quantity, 2, '.', ',') . " tCO<sub>2</sub>e"); ?></td>
                <td>
                    <?php
                    $item_id = $data_items[$i]['add_Item_to_project_id'];
                    $del = "delete_item_project.php?delete_id=" . $item_id . "&pro_id=" . $project_master_id;
                    // $edit="item_update.php?item_id=".$item_id;
                    ?>
                    <a href="#" class="edit-btn2" data-item-id="<?php echo $data_items[$i]['add_Item_to_project_id']; ?>">
                        <i class="zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i> 
                    </a>|
                    <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete' style="margin-right:0px; color:#b28250;"></i></a>
                </td>
            </tr>
            <?php
            $z++;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width:5%">S.no</th>
            <th>Item Code</th>
            <th>Unit</th>
            <th>Qty I</th>
            <th>Qty II</th>
            <th>Emission</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

                                            
                                                            <!--./ table-->
                                                            <!--edit form popup for items-->
                                                            <!-- Hidden form for adding items -->
                                                            <div id="addItemForm_edit2" style="display: none;" class="model_edit2">
                                                            <div class="modelbox_edit2">

                                                            <?php
                                                            //fetching data from location master table to display in dropdown
                                                            $sql_location = "SELECT * FROM location_master WHERE location_master_is_visibility=1";
                                                            $result_location = mysqli_query($conn, $sql_location);
                                                            $data_location = array();
                                                            while ($row = mysqli_fetch_assoc($result_location)) {

                                                                $data_location[] = $row;
                                                            }
                                                            //  print_r($data_item);
                                                            
                                                            ?>
                                                            
                                                                

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                <h5 class="col-md-11">Edit Item Quantity</h5>
                                                                <a href="#" id="closeFormBtn2" class="close-button2" style="font-size: x-large; margin-left:4%; margin-top:-2%">&times;</a>
                                                                </div>
                                                                <hr>
                                                                <form id="editForm2" method="POST" action="edit_item_qty.php">

                                                                <div class="row">

                                                               
    <div class="form-group col-md-12">
        <label for="item_quantity">Item Quantity</label>
        <input type="text" class="form-control" name="item_quantity" id="equantity_input1" placeholder="Enter Quantity 1" required>
        

        <input type="text" class="form-control" style="margin-top: 8px;" name="item_quantity2" id="equantity_input2" placeholder="Enter Quantity 2" required>

        <input type="hidden" class="form-control" name="project_master_id" value="<?php echo $project_master_id ?>" id="project_id" placeholder="Enter Quantity">
    </div>
</div>


                                                                    
                                                                        <input type="hidden" id="item_id" name="item_id">
                                                                    
                                                                        <button type="submit" name="submit" class="btn btn-info btn-primary col-md-12">Save</button>
                                                                </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                //script for fetching data of location into project throught form 
                                                            document.getElementById("openFormBtn2").addEventListener("click", function () {
                                                                document.getElementById("addItemForm2").style.display = "block";
                                                            });

                                                            document.getElementById("closeFormBtn_add").addEventListener("click", function () {
                                                                document.getElementById("addItemForm2").style.display = "none";
                                                            });

                                                            
                                                            </script>
        

                                                                <!--./form popup -->

                                                                <!-- Modal HTML -->


                                                                <!-- JavaScript to open and close the modal -->
                                                                <script>
                                                                
                                                                const editButtons2 = document.querySelectorAll('.edit-btn2');
                                                                    const editModal2 = document.getElementById('addItemForm_edit2');
                                                                    const closeBtn2 = document.querySelector('.close-button2');
                                                                    const itemIdInput = document.getElementById('item_id');
                                                                //    const countInput = document.getElementById('count');

                                                                 // Open modal when Edit button is clicked
                                                                 editButtons2.forEach((button) => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const itemId = button.getAttribute('data-item-id');
        itemIdInput.value = itemId;

        const quantityInput1 = document.getElementById('equantity_input1');
        const quantityInput2 = document.getElementById('equantity_input2');
    

        $.ajax({
            url: 'edit_item_qty_check.php',
            method: 'POST',
            data: {
                itemId: itemId,
                action: 'fetch_item_quantity'
            },
            success: function(datas) {
  

            if (datas.trim() !== '1') {

                // alert('I am in if condition');
                quantityInput1.style.display = 'block';
                $('#equantity_input2').attr('type', 'text').attr('name', 'item_quantity2').attr('placeholder', 'Enter Quantity 2').attr('required', 'required');

            } else {

                // alert('I am in else condition');
                quantityInput1.style.display = 'block';
                // quantityInput2.style.display = 'none';
                $('#equantity_input2').attr('type', 'hidden').attr('name', 'item_quantity2').attr('placeholder', 'Enter Quantity 2').attr('required', 'required');
            }



                editModal2.style.display = 'block';
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});



                                                                    // Close modal when close button is clicked
                                                                    closeBtn2.addEventListener('click', () => {
                                                                        editModal2.style.display = 'none';
                                                                    });

                                                                    // Close modal when outside the modal is clicked
                                                                    window.addEventListener('click', (e) => {
                                                                        if (e.target === editModal2) {
                                                                            editModal2.style.display = 'none';
                                                                        }
                                                                    });
                                                                </script>
                                                            
                                                            <!--./edit form popup for items-->
  
                                                            



                                                        </div>
                                                    </div>
                                                </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                            <h5 style="margin-left:10px ;" class="col-md-8">Add Location into Project </h5>
                                                            <button id="openFormBtn2" class="btn btn-info btn-primary" style="margin-left:auto;">Add Location</button>
                                                            </div>
                                                        
                                                            <!-- row3.1-->
                                                        <div class="row">
                                                        

                                                            <!-- Hidden form for adding items -->
                                                            <div id="addItemForm2" style="display: none;" class="model2">
                                                            <div class="modelbox2">

                                                            <?php
                                                            //fetching data from location master table to display in dropdown
                                                            $sql_location = "SELECT * FROM location_master WHERE location_master_is_visibility=1 order by location_master_name asc";
                                                            $result_location = mysqli_query($conn, $sql_location);
                                                            $data_location = array();
                                                            while ($row = mysqli_fetch_assoc($result_location)) {

                                                                $data_location[] = $row;
                                                            }
                                                            //  print_r($data_item);
                                                            
                                                            ?>
                                                            
                                                                

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                <h5 class="col-md-11">Add Location into Project </h5>
                                                                <a href="#" id="closeFormBtn_add" class="close-button" style="font-size: x-large; margin-left:4%; margin-top:-2%">&times;</a>
                                                                </div>
                                                                <hr>
                                                                <form id="itemForm2" method="POST" action="project_location_code.php">
                                                                    

                                                                    <!-- Form fields go here -->
                                                                    <div class="form-group ">
                                                                        <label for="item_category_id">Select Location</label>
                                                                        <select name="location_master_id" class="form-control" id="item_name">
                                                                        <option value="">Choose Location</option>

                                                                        <?php
                                                                        foreach ($data_location as $value) {
                                                                            ?>
                                                                                        <!-- Populate options dynamically if needed -->
                                                                                        <option value="<?php echo $value['location_master_id'] ?>"><?php echo $value['location_master_name'] ?>  ( Location Area Value : <?php echo $value['location_master_area'] ?> )</option>

                                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        </select>
                                                                    </div>
                                                                
                                                                    <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="item_quantity">Add Number of Location</label>
                                                                        <input type="text" class="form-control" name="add_number_of_location" placeholder="Enter Qunatity" required>
                                                                        <input type="hidden" class="form-control" name="project_master_id" value="<?php echo $project_master_id ?>" placeholder="Enter Qunatity" >

                                                                    </div>

                                                                

                                                                    </div>


                                                                

                                                                    <br>

                                                                    <button type="submit" class="btn btn-info btn-primary col-md-2" name="submit">Submit</button>
                                                                </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                //script for fetching data of location into project throught form 
                                                            document.getElementById("openFormBtn2").addEventListener("click", function () {
                                                                document.getElementById("addItemForm2").style.display = "block";
                                                            });

                                                            document.getElementById("closeFormBtn_add").addEventListener("click", function () {
                                                                document.getElementById("addItemForm2").style.display = "none";
                                                            });
                                                            </script>
        
                                                        </div>
                                                            <!-- ./row3.1-->
                                                        <hr>
                                                            <!-- table-->
                                                            <table id="example1" class="table table-bordered table-striped" >
                                                                <br>
                                                                <thead>

                                                                
                                                                <tr>
                                                                                        <th style="width:5%">S.no</th>
                                                                                        <th style="width:12%">Location Name</th>
                                                                                        
                                                                                        <th style="width:7%">Count</th>
                                                                                        <th style="width:7%">Area</th>
                                                                                        <th style="width:20%">Description</th>
                                                                                        <th style="width:7%">Action</th>
                                                                                        </tr>
                                                                </form>
                                                                </thead>
                                                                <tbody>



                                                                    <?php

                                                                    //declaring data_month as array variable
                                                                    $data_month = array();

                                                                    //fetchin data from table consumption
                                                                    $sql = "SELECT * FROM add_location_to_project as lp
                                                                    join location_master as lm on lp.add_Location_to_project_location_id=lm.location_master_id
                                                                    where lp.add_Location_to_project_project_id=$project_master_id and lp.add_Location_to_project_is_visibility=1
                                                                    order by add_Location_to_project_id desc";

                                                                    $result = mysqli_query($conn, $sql);

                                                                    //declaring data_item as array variable
                                                                    $data_location = array();

                                                                    //storing item table data in $data_consumption variable
                                                                    if (mysqli_num_rows($result) > 0) {

                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            //storing data in $data_consumption array
                                                                            $data_location[] = $row;
                                                                        }

                                                                    }

                                                                    //   print_r($data_item);
                                                                    // counting $data_consumption array rows
                                                                    $count = count($data_location);

                                                                    // echo count($data_item);
                                                                    
                                                                    $z = 1;

                                                                    //loop for printing month and year 
                                                                    for ($i = 0; $i < $count; $i++) {

                                                                        //  echo "ok1";
                                                                        ?>
                                                                            <tr>
                                                                            <td> <?php echo $z; ?> </td>
                                                                            <td> <?php print_r($data_location[$i]['location_master_name']); ?></td>
                                                                            
                                                                            <td> <?php print_r($data_location[$i]['add_number_of_location']); ?></td>
                                                                            <td> <?php print_r($data_location[$i]['location_master_area']); ?></td>
                                                                            <td> <?php print_r($data_location[$i]['location_master_description']); ?></td>
                                                                            <td>
                                                                                <?php
                                                                                $location_id = $data_location[$i]['add_Location_to_project_id'];
                                                                                $del = "delete_location_project.php?delete_id=" . $location_id . "&pro_id=" . $project_master_id;
                                                                                // $edit="item_update.php?item_id=".$item_id;
                                                                                ?>
                                                                                <a href="#" class="edit-btn" data-location-id="<?php echo $data_location[$i]['add_Location_to_project_id']; ?>">
                                                                                    <i class="zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i>
                                                                                </a>
|
                                                                                <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete'style="margin-right:0px; color:#b28250;"></i></a>
                                                                                </td>

                                                                                
                                                                            <?php
                                                                            $z++;
                                                                    }

                                                                    ?>

                                                                
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                                        <th>S.no</th>
                                                                                        <th >Location Name</th>
                                                                                        <th >Count</th>
                                                                                        <th >Area</th>
                                                                                        <th > Description</th>
                                                                                        <th >Action</th>
                                                                                            </tr>
                                                                </tfoot>
                                                                </table>

                                                                <!--form popup -->
                                                                <!-- Hidden form for adding items -->
                                                            <div id="addItemForm_edit" style="display: none;" class="model_edit">
                                                            <div class="modelbox_edit">

                                                            <?php
                                                            //fetching data from location master table to display in dropdown
                                                            $sql_location = "SELECT * FROM location_master WHERE location_master_is_visibility=1";
                                                            $result_location = mysqli_query($conn, $sql_location);
                                                            $data_location = array();
                                                            while ($row = mysqli_fetch_assoc($result_location)) {

                                                                $data_location[] = $row;
                                                            }
                                                            //  print_r($data_item);
                                                            
                                                            ?>
                                                            
                                                                

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                <h5 class="col-md-11">Edit Count</h5>
                                                                <a href="#" id="closeFormBtn_edit" class="close-button-edit" style="font-size: x-large; margin-left:4%; margin-top:-2%">&times;</a>
                                                                </div>
                                                                <hr>
                                                                <form id="editForm" method="POST" action="edit_location.php">

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="item_quantity">Count</label>
                                                                        <input type="text" class="form-control" name="add_number_of_location" placeholder="Enter Count" required>
                                                                        <input type="hidden" class="form-control" name="project_master_id" value="<?php echo $project_master_id ?>" placeholder="Enter Qunatity" >

                                                                    </div>
                                                                    </div>

                                                                    <br>
                                                                    <br>
                                                                        <input type="hidden" id="locationId" name="locationId">
                                                                    
                                                                        <button type="submit" name="submit" class="btn btn-info btn-primary col-md-12">Save</button>
                                                                </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        
        

                                                                <!--./form popup -->

                                                                <!-- Modal HTML -->


                                                                <!-- JavaScript to open and close the modal -->
                                                                <script>
                                                                
                                                                const editButtons = document.querySelectorAll('.edit-btn');
                                                                    const editModal = document.getElementById('addItemForm_edit');
                                                                    const closeBtn_edit = document.querySelector('.close-button-edit');
                                                                    const locationIdInput = document.getElementById('locationId');
                                                                    const countInput = document.getElementById('count');

                                                                    // Open modal when Edit button is clicked
                                                                    editButtons.forEach((button) => {
                                                                        button.addEventListener('click', (e) => {
                                                                            e.preventDefault();
                                                                            const locationId = button.getAttribute('data-location-id');
                                                                            locationIdInput.value = locationId;
                                                                            editModal.style.display = 'block';
                                                                        });
                                                                    });

                                                                    // Close modal when close button is clicked
                                                                    closeBtn_edit.addEventListener('click', () => {
                                                                        editModal.style.display = 'none';
                                                                    });

                                                                    // Close modal when outside the modal is clicked
                                                                    window.addEventListener('click', (e) => {
                                                                        if (e.target === editModal) {
                                                                            editModal.style.display = 'none';
                                                                        }
                                                                    });
                                                                </script>

                                                            <!--./ table-->


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                
                                            <!-- ./row3-->


                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                                

                            </div> <!-- container -->

                        </div> <!-- content -->


                    </div>
                    <!-- End content-page -->

                    <script>
                        const successMessage = document.getElementById('success-message');

                // Function to hide the success message
                const hideSuccessMessage = () => {
                    successMessage.style.display = 'none';
                };

                // Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(hideSuccessMessage, 1000);



                const updateMessage = document.getElementById('update-message');

                // Function to hide the success message
                const hideUpdateMessage = () => {
                    updateMessage.style.display = 'none';
                };

                // Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(hideUpdateMessage, 1000);



                const deleteMessage = document.getElementById('delete-message');

                // Function to hide the success message
                const hideDeleteMessage = () => {
                    deleteMessage.style.display = 'none';
                };

                // Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(hideDeleteMessage, 1000);



                        </script>


                    <!-- ============================================================== -->
                    <!-- End Right content here -->
                    <!-- ============================================================== -->


        <?php //require 'includes/footer_start.php' ?>

                <!--Morris Chart-->
                <script src="plugins/morris/morris.min.js"></script>
                <script src="plugins/raphael/raphael.min.js"></script>

                <!-- Page specific js -->
                <script src="assets/pages/jquery.dashboard.js"></script>

        <?php //require 'includes/footer_end.php' ?>
