    <?php
    include 'auth.php';
    include 'database.php';
    // error_reporting(0);
    // require 'includes/header_start.php'; ?>

            <!--Morris Chart CSS -->
            <link rel="stylesheet" href="plugins/morris/morris.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<style>
     #downloadButton {
    background: #b28250!important;
    border-color: #b28250!important;
}

#downloadButton:hover {
    background: black!important;
    border-color: black!important;
}

.btn:active {
  outline-color: none;
  cursor: pointer;
}

    #downloadButton2:hover{
        background: black;
    border-color: black;
    }
</style>

            <?php 
            // require 'includes/header_end.php';
            require 'header.php';
             ?>

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="content-page">
                    <!-- Start content -->
                    <div class="content">
                        <div class="container-fluid">


                <!-- ============================================================== -->
                <!-- Start Project emission value code here -->
                <!-- ============================================================== -->
                        


    <?php

                        $generate_pro_id=$_GET['id'];



                 // Initialize arrays for each scope
                    $scope1_chart = array();
                    $scope2_chart = array();
                    $scope3_chart = array();
                    $scope_red_chart=array();
    
    

                    // fetching data from particular id 
                        $sql_date="SELECT * FROM project_master 
                        where  project_master_id =$generate_pro_id;";
                        $result_date=mysqli_query($conn, $sql_date);
                        $data_date=mysqli_fetch_array($result_date);


                        //fetching data from data source table
                        $sql_ds="SELECT * FROM data_source as ds join data_source_subcategory as dss ON dss.data_source_id=ds.data_source_id where ds.is_visibility=1 ";
                        $result_ds=mysqli_query($conn,$sql_ds);
                        $data_ds=array();
                        while($row=mysqli_fetch_assoc($result_ds)){
                        // $data_ds[]=$row;

                        //giving feilds to array
                        $data_ds[]=array(

                            'data_source_id'=>$row['data_source_id'],
                            'icon'=>$row['icon'],
                            'data_source_name'=>$row['data_source_name'],
                            'data_source_subcategory_name'=>$row['data_source_subcategory_name'],
                            'data_source_emission'=>0,
                        );
                        $scope_red_chart[]=array(

                            'ds'=>$row['data_source_id'],
                            'emission'=>0,
                        );


                        }


                   //  print_r($scope_red_chart);


                        //array for data subcategory fetching data 




                        $sql_dss_array="SELECT DISTINCT dss.data_source_subcategory_id, dss.data_source_subcategory_name,
                        ds.data_source_name, ef.scope FROM data_source_subcategory as dss
                        join emission_factors as ef on dss.data_source_subcategory_id=ef.data_source_subcategory_id
                        join data_source as ds on dss.data_source_id= ds.data_source_id
                        where dss.is_visibility=1
                        ;";
                        $result_dss_array=mysqli_query($conn, $sql_dss_array);
                        $data_dss_array=array();
                        while($row2 =mysqli_fetch_assoc($result_dss_array)){
                            $data_dss_array[]=array(
                                'scope'=>$row2['scope'],
                                'data_source_name'=>$row2['data_source_name'],
                                'data_source_subcategory_name'=>$row2['data_source_subcategory_name'],
                                'dss_emission_value'=>0,

                            );

                        }



                    // print_r($data_dss_array);






                        ///assinging start date and end date   
                        $project_name=$data_date['project_name']  ;  
                        $string_sd=$data_date['project_master_start_date'];
                        $string_ed=$data_date['project_master_end_date'];
                        $start_date = new DateTime($data_date['project_master_start_date']);
                        $end_date   = new DateTime($data_date['project_master_end_date']);
                        // echo $string_sd;

                    //arraya containg all emission value
                    $data_all_emission=array();

                    
            

                    //declaring scope varible as 0
                    $scope_1_emission=0;
                    $scope_2_emission=0;
                    $scope_3_emission=0;
                    $scope_red_emission=0;


                    $data_consumption_project=0;
                    $data_reduction_project=0;
                    $i=1;


                    // first loop for running no. of dates //
                    while ($start_date <= $end_date) {

                    // $data_all_emission=array(0);
                    $scope1_chart = array(
                        "emission"=>[0,0,0],
                    );
                        $scope2_chart = array([0,0,0],
                    );
                        $scope3_chart = array([0,0,0],
                    );
                     $scope_red_chart=array(
                           
                            "emission"=>[0,0,0],
                    );

                    $scope_1_emission=0;
                    $scope_2_emission=0;
                    $scope_3_emission=0;
                    $scope_red_emission=0;

                    //echo $i;
                    $i++;

                    $month=0;


                        $date = $start_date->format('Y-m-d'); // Get the date in 'Y-m-d' format
                        $month_name = $start_date->format('F'); // Get the month name
                        $year_name = $start_date->format('Y');

                    // echo "date=>".$date ."<br>";



    // echo $generate_pro_id;
                        //query for fetching particular project area
                        $sql_pro_location="SELECT *, lp.add_number_of_location*lm.location_master_area as project_area FROM project_master as pm
                                            join add_location_to_project as lp on pm.project_master_id=lp.add_Location_to_project_project_id
                                            join location_master as lm on lp.add_Location_to_project_location_id=lm.location_master_id
                                            where  pm.project_master_id=$generate_pro_id;";

                        $result_pro_location=mysqli_query($conn, $sql_pro_location);
                        $data_pro_location=mysqli_fetch_assoc($result_pro_location);

                        // storing particular project area value
                        $project_area=$data_pro_location['project_area'] ?? 0;
                    //  echo "project area =>".$project_area."<br>";

                    // echo $project_area."<br>";

                        //query for fetching total  project area for that dat
                        $sql_total_location=" SELECT *, sum(lp.add_number_of_location*lm.location_master_area) as total_project_area  FROM project_master as pm 
                        join add_location_to_project as lp on pm.project_master_id= lp.add_Location_to_project_project_id
                        join location_master as lm on lp.add_Location_to_project_location_id=lm.location_master_id
                        WHERE '$date' BETWEEN pm.project_master_start_date AND pm.project_master_end_date ";

                        $result_total_location=mysqli_query($conn, $sql_total_location);
                        $data_total_location=mysqli_fetch_assoc($result_total_location);

                        // storing total project area value
                        $total_project_area=$data_total_location['total_project_area']?? 0;
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
        $month = date('m', strtotime($date));//assining month string in variable 

        // echo "Month number: $month";


        // query for fetching emission values 
        $sql = "SELECT *, c.consumption_value*ef.emission_factors_value as emission_value FROM tbl_month_consumption_sub as c
        join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
        join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
        join data_source as ds on dss.data_source_id = ds.data_source_id
        where c.month='$month_name' and c.year=$year_name and ef.year=$year_name ";//and dss.is_reduction='no'
    // echo $sql;
        $result = mysqli_query($conn, $sql);
        $data_dss=0;
        $data_dss_reduction=0;
        
    
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year_name);
        
        //  echo "There are $days_in_month days in the month of $month/$year_name.";
        
        while($row=mysqli_fetch_assoc($result)){

            $scope_1 = (($row['scope'] == 'Scope 1')&&($row['is_reduction'] == 'no'))? 'yes' : 'no';
            $scope_2 = (($row['scope'] == 'Scope 2')&&($row['is_reduction'] == 'no')) ? 'yes' : 'no';
            $scope_3 = (($row['scope'] == 'Scope 3')&&($row['is_reduction'] == 'no')) ? 'yes' : 'no';



            $scope_reduction = ($row['is_reduction'] == 'no') ? 'no' : 'yes';
            $data_all_emission[]=array(
            
            'ds_id'=>$row['data_source_id'],
            'ds_name'=>$row['data_source_name'],
            'dss_id'=>$row['data_source_subcategory_id'],
            'dss_name'=>$row['data_source_subcategory_name'],


    
            'scope'=>$row['scope'],
            'scope_1'=>$scope_1,
            'scope_2'=>$scope_2,
            'scope_3'=>$scope_3,
            'scope_reduction'=>$scope_reduction,
            'dss_emission'=>($row['emission_value']/$days_in_month)*$fraction,
            

        
            );
    //      echo "scope_reduction  =>".$scope_reduction;
        // echo  "subcateogry emission =>".$row['emission_value']."<br>";
        // echo "no of days =>".$days_in_month."<br>";
        // echo "fraction =>".$fraction."<br>";
        // echo "array stored data emission value".$data_all_emission['dss_emission']."<br>";
        // echo "<br>";
            


            //data emission value per day

        if($row['is_reduction']=='no'){
            $data_dss+=$row['emission_value']/$days_in_month;
        }else{
            $data_dss-=$row['emission_value']/$days_in_month;

        }




    /*      if($row['is_reduction']=='yes'){
            $data_dss_reduction+=$row['emission_value']/$days_in_month;
        }else{
        

        }
    */
        


    //loop2
        }

    
    //   echo "<br> dss consumption reduction =>".$data_dss_reduction;
        //storing all emission by day in scope varibale
        $scope_id=0;
        foreach($data_all_emission as $value){

            if($value['scope_1']=='yes'){
        //     print_r($value['scope_reduction']);
            $scope_1_emission+=$value['dss_emission'];
            }elseif($value['scope_2']=='yes'){
            $scope_2_emission+=$value['dss_emission'];
            }elseif($value['scope_3']=='yes'){
            $scope_3_emission+=$value['dss_emission'];
            }elseif($value['scope_reduction']=='yes'){
            //  print_r("reduction".$value['scope_reduction']);


                $scope_red_emission+=$value['dss_emission'];

                }
            $scope_id++;
        }

    // Process the data and organize it by scope
    foreach ($data_all_emission as $data) {
        $ds = $data['ds_id'];
        $emission = $data['dss_emission'];
        $scope = $data['scope'];

        // Check the scope and add the data to the corresponding array
        if ($data['scope_1'] === 'yes') {
            if (!isset($scope1_chart[$ds])) {
                $scope1_chart[$ds] = array('ds' => $ds, 'emission' => $emission); // Initialize only if not exists
            } else {
                $scope1_chart[$ds]['emission'] += $emission;
                
            }
            
        } elseif ($data['scope_2'] === 'yes') {
            if (!isset($scope2_chart[$ds])) {
                $scope2_chart[$ds] = array('ds' => $ds, 'emission' => $emission); // Initialize only if not exists
            } else {
                $scope2_chart[$ds]['emission'] += $emission;
            }
        } elseif ($data['scope_3'] === 'yes') {
            if (!isset($scope3_chart[$ds])) {
                $scope3_chart[$ds] = array('ds' => $ds, 'emission' => $emission); // Initialize only if not exists
            } else {
                $scope3_chart[$ds]['emission'] += $emission;
            }
        } 
        elseif ($data['scope_reduction'] === 'yes') {
            if (!isset($scope_red_chart[$ds])) {
              
                $scope_red_chart[$ds] = array('ds' => $ds, 'emission' => $emission); // Initialize only if not exists
            } else {

             
                $scope_red_chart[$ds]['emission'] += $emission;
            }
     
          
        }



          // Deduct emission value od subcategory acording scope value 
        if ($data['scope_reduction'] === 'yes') {
        if ($scope === 'Scope 1' && isset($scope1_chart[$ds])) {
            $scope1_chart[$ds]['emission'] -= $emission;
        } elseif ($scope === 'Scope 2' && isset($scope2_chart[$ds])) {
            $scope2_chart[$ds]['emission'] -= $emission;
        } elseif ($scope === 'Scope 3' && isset($scope3_chart[$ds])) {
            $scope3_chart[$ds]['emission'] -= $emission;
        }
    }
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








    // Iterate through $data_ds
    foreach ($data_dss_array as &$data_source) {
        // Initialize the emission value to 0 for this data source
        $data_source['dss_emission_value'] = 0;

        // Iterate through $data_all_emission to find matching data sources
        foreach ($data_all_emission as $emission_data) {
            if ($data_source['data_source_subcategory_name'] === $emission_data['dss_name']) {
                // Add the emission value for this data source
                $data_source['dss_emission_value'] += $emission_data['dss_emission'];
            }
        }
    }
    //unset($data_source); // Unset the reference to avoid potential issues

    // Print the updated $data_ds array with emission values







    // echo "sum up value of emission=>". $data_dss;

    // echo "fraction value =>".$fraction;

    //total emission value of that day = total data source subcategory of that day * fraction 
        $emission_dss=$data_dss*$fraction;

        //echo "emission value =>".$emission_dss;

        //total data emission value of every day add on
        $data_consumption_project+= $emission_dss;

        


        $emission_dss_red=$data_dss_reduction*$fraction;

        //echo "emission value =>".$emission_dss;

        //total data emission value of every day add on
        $data_reduction_project+= $emission_dss_red;





    // echo "$date $year_name  $month_name<br>"; // Display date and month name
    
        $start_date->add(new DateInterval('P1D')); // Increment the date by one day



        //loop end foreach
        }


        
    

    //declarying array 
    $data_ds_name=array();
    //declaring arr for icon
    $data_ds_icon=array();
    //declarying array 
    $data_ds_value=array();
    //declarying varible
    $data_dss=array();
    $total_donut_value = 0;

        foreach($data_ds as $value){
            $data_ds_name[]=$value['data_source_name'];
           $data_dss[]=$value['data_source_subcategory_name'];
            $data_ds_icon[]=$value['icon'];
            $data_ds_value[]=$value['data_source_emission'];
            $total_donut_value += $value['data_source_emission'];

        }



    /* // Calculate the percentage for each data point
        $data_percentage = array_map(function ($value) use ($total_donut_value) {
            return round(($value / $total_donut_value) * 100, 2);
        }, $data_ds_value);


    */
    

        // Use implode to concatenate elements with the single quotes
        $data_name = "'" . implode("', '", $data_ds_name) . "'";
        $data_dss_name = "'" . implode("', '", $data_dss) . "'";

        // Use implode to concatenate elements with the single quotes
        $data_value =implode(', ', $data_ds_value);
    

    //   print_r($data_all_emission);

    /*   for ($i=0;$i<count($data_all_emission);$i++){

            print_r($data_all_emission[]) ;

        }
    */
    // echo "scope 1".$scope_1_emission."<br>";
    // echo  "scope 1".$scope_2_emission."<br>";
    // echo  "scope 1".$scope_3_emission."<br>";
    //  echo  "scope 1".$scope_red_emission."<br>";
    // echo "reductio value ".$data_reduction_project."<br>";

        $emission_actual="SELECT  sum(ip.add_Item_to_project_item_quantity*it.item_emission_factor) as actual_emission 
                        FROM project_master as pm
                        join add_item_to_project as ip on pm.project_master_id = ip.add_Item_to_project_assign_id
                        join item as it on ip.add_Item_to_project_item_id= it.item_id
                        where pm.project_master_id = $generate_pro_id;";
        $result_actual=mysqli_query($conn, $emission_actual);
        $data_emission_actual=mysqli_fetch_array($result_actual);
        $emission_actual=$data_emission_actual['actual_emission'];
    //   echo $emission_actual;

        $total_emission_project=$emission_actual+$data_consumption_project;

    
                        ?>





                <!-- ============================================================== -->
                <!-- End Project emission value code here -->
                <!-- ============================================================== -->












                <?php
                            
                            // Create a new array with elements from the original array, excluding index 0
                            $scope1_chart_1 = array_slice($scope1_chart, 1);
                                                
                            // Create a new array with elements from the original array, excluding index 0
                            $scope2_chart_2 = array_slice($scope2_chart, 1);
                        
                                                
                            // Create a new array with elements from the original array, excluding index 0
                            $scope3_chart_3 = array_slice($scope3_chart, 1);
                                                
                            // Create a new array with elements from the original array, excluding index 0
                            $scope_red_chart_r = array_slice($scope_red_chart, 1);
                            //print_r($scope_red_chart);
                        
                            //print_r($water);
                        
                            //echo $scope_1_emission;
                        
                          //  $data=[$scope_1_emission, $scope_2_emission, $scope_3_emission, $scope_red_emission];
                            //print_r($data);
                        
                                                    //print_r($scope1_chart_1);
                                                    //   print_r($scope2_chart);
                                                    //  print_r($data_all_emission);
                                                    ?>



             

                <div class="card">
                    <div class="card-body">
                        <!-- download button-->
                    <button id="downloadButton2" class="btn btn-primary" style="margin-left:20px ;">Download PDF</button>
                    </div>
                </div>
                        <div class="card" id="element">
                            <div class="card-body" >
                            
                            <!--///////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                            <div class="row" style="margin-bottom: 5%;">
                                <div class="col-md-6">
                                <img src="assets/images/Screenshot (370).png" style="height: 65px; " alt="">
                                    
                                </div>
                                <div class="col-md-6 d-flex justify-content-end" >
                                <img src="assets/images/logo-noir.png" style="height: 65px; " alt="">
                                </div>
                            </div>

                        
                        
                            <h5 contenteditable="true" style="color: #17365D;">Alpha-Nero/<span style="color: #FF5500;">YSL </span> GHG Emissions Report 2021</h5>

                            <hr style="  border-top: 2px solid blueviolet; color:#4F81BD">
                            <h6 contenteditable="true" style="line-height: 2;">Table of Contents: </h6>

                            <ul style="list-style-type: none;">
                                <li contenteditable="true" style="margin-left:5% ;line-height: 3;">1.  Executive Summary</li>
                                <li contenteditable="true" style="margin-left:5% ; line-height: 3;">2.  Methodology
                                    <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:5%;">a. Primary vs Secondary Data</li>
                                        <li contenteditable="true" style="margin-left:5%;">b. Emissions Methodology Components</li>
                                    </ul>
                                </li>
                                <li contenteditable="true" style="margin-left:5% ;  line-height: 3;">3.  Key Findings
                                    <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">a.  Alpha-Nero/<span style="color: #FF5500;">YSL </span>  Project Emissions by Category</li>
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">b.  Alpha-Nero/<span style="color: #FF5500;">YSL </span>  Project Emissions by Scope</li>
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">c.  Alpha-Nero/<span style="color: #FF5500;">YSL </span>  Project Emissions by Scope and Category</li>
                                    </ul>
                                </li>
                                <li contenteditable="true" style="margin-left:5% ;  line-height: 3;">4. GHG Inventory Development Approach
                                    <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">a. Boundary Conditions, Inclusions & Exclusions</li>
                                    </ul>
                                </li>
                                <li contenteditable="true" style="margin-left:5% ;  line-height: 3;">5. Calculations
                                    <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">a. Emissions Methodology by Source: Scope 1 Vehicles</li>
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">b. Emissions Methodology by Source: Scope 2 Electricity Usage</li>
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 2;">c. Emissions Methodology by Source: Scope 3 Employee Commute</li>
                                        <li contenteditable="true" style="margin-left:5% ; line-height: 2;">d. Emissions Methodology by Source: Scope 3 Business Travel</li>
                                        <li contenteditable="true" style="margin-left:5% ; line-height: 2;">e. Emissions Methodology by Source: Scope 3 Shipping</li>
                                        <li contenteditable="true" style="margin-left:5% ; line-height: 2;">f. Emissions Methodology by Source: Scope 3 Products</li>
                                        <li contenteditable="true" style="margin-left:5% ;line-height: 2;">g. Emissions Methodology by Source: Scope 3 Waste</li>
                                    </ul>
                                </li>
                            </ul>

                            <!--////////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            
                            <div class="card-body" >
                            <div class="row" style="margin-top:10%">
                                <h5 style="font-weight: 700; line-height:3"  contenteditable="true">1.  Executive Summary</h5>
                            </div>
                            <p style="line-height: 1.7; font-size:16px"  contenteditable="true">
                            This Greenhouse Gas Inventory (“Inventory”) describes the Alpha-Nero/<span style="color: #FF5500;">YSL </span> project 
                            impact on the environment as measured in greenhouse gases (GHG) emitted in units 
                            of equivalent tons of carbon dioxide for a <span style="color: #FF5500;">5 week period spanning November and 
                            December in 2021</span>. The purpose of this inventory is to record and calculate the related 
                            project emissions and to provide a consistent methodology for documenting the 
                            emissions inventory on an ongoing basis. 
                            </p>

                            <p style="line-height: 1.7; font-size:16px"  contenteditable="true">
                            GreenFeet compiled the inventory with support from Alpha-Nero's team, who 
                            provided activity data from business activities.

                            </p>

                            <p style="line-height: 1.7; font-size:16px"  contenteditable="true">
                            In summary, the Alpha-Nero/<span style="color: #FF5500;">YSL </span> project estimated carbon footprint is 
                            <span style="color: #FF5500;">22.15 mtCO2e</span>. A breakdown by emission category is detailed below. 
                            </p>

                            <p style="line-height: 1.7; font-size:16px"  contenteditable="true"> 
                            Furthermore, Alpha-Nero has committed to a climate emergency strategy and is 
                            taking the following related actions:   
                            </p>
                            <ul style="list-style-type:none;">
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 1.7; font-size:16px">a. Emissions Methodology by Source: Scope 1 Vehicles</li>
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 1.7; font-size:16px">b. Emissions Methodology by Source: Scope 2 Electricity Usage</li>
                                        <li contenteditable="true" style="margin-left:5% ;  line-height: 1.7; font-size:16px">c. Emissions Methodology by Source: Scope 3 Employee Commute</li>
                                        <li contenteditable="true" style="margin-left:5% ; line-height: 1.7; font-size:16px">d. Emissions Methodology by Source: Scope 3 Business Travel</li>
                                        <li contenteditable="true" style="margin-left:5% ; line-height: 1.7; font-size:16px">e. Emissions Methodology by Source: Scope 3 Shipping</li>
                                        <li contenteditable="true" style="margin-left:5% ; line-height: 1.7; font-size:16px">f. Emissions Methodology by Source: Scope 3 Products</li>
                                        <li contenteditable="true" style="margin-left:5% ;line-height: 1.7;  font-size:16px">g. Emissions Methodology by Source: Scope 3 Waste</li>
                                    </ul>
                        
                    

                        </div>        
                    

                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                        
                        
                    
                    
                            <div class="card-body" >
                            <div class="row" style="margin-top:10%">
                                <h5 style="font-weight: 700; line-height:2"  contenteditable="true">2.  Methodology</h5>
                            </div>  
                            <p style="line-height: 1.7; font-size: 16px"  contenteditable="true">
                            This inventory is developed in accordance with the revised GHG Protocol Corporate 
                            Standard and the Corporate Value Chain Accounting and Reporting Standard.
                            Inventory development involves the collection and examination of documentation, 
                            testimony and data from internal and external sources. Development also includes a 
                            determination of completeness and accuracy of the data provided and calculations 
                            completed using this data.
                            </p>

                            <span style="font-size: 16px"  contenteditable="true"><i>a. Primary vs Secondary Data</i></span>

                            <p style="line-height: 1.7; font-size: 16px"  contenteditable="true">
                            Primary Data refers to activity data taken directly from meter readings, i.e., the “raw” 
                            utility bill data. Primary Data are generally considered to be the most accurate, and 
                            preferable to estimated data.
                            </p>

                            <p style="line-height: 1.7; font-size: 16px"  contenteditable="true">
                            Secondary Data, or estimated data, refers to the development and use of intensity 
                            factors and/or energy consumption models. Estimates are important for understanding 
                            and developing emissions control strategies, ascertaining the effects of sources and 
                            appropriate collection approaches, and prioritizing data sources to transition from 
                            Secondary to Primary (i.e. estimated to actual). In the development of an emissions 
                            inventory, trade offs must be made between data accuracy and effort required to 
                            collect Primary Data over Secondary Data. Where risks of adverse environmental 
                            effects or adverse regulatory outcomes are high, more sophisticated and more costly 
                            Primary Data collection methods may be necessary. Where the risks of using 
                            Secondary Data are low, and the costs of more extensive methods are unattractive, 
                            less expensive estimation methods, such as energy intensity factors and energy 
                            consumption models, may be both satisfactory and appropriate. Selecting the method 
                            to be used to estimate source-specific activity data warrants a case-by-case analysis 
                            considering the costs and risks in the specific situation.
                            </p>

                            

                            <p style="line-height:1.7; font-size: 16px"  contenteditable="true"><i>b. Emissions Methodology Components</br> Below the emissions methodology components are listed which are used to outline the 
                            calculation methodology and assumptions applied to each emission source.</i></p>
                            <!-- <p style="line-height: 1.7; font-size:medium"  contenteditable="true">
                           

                            </p> -->
                             <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                             <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                             <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <div class="row" style="margin-top:15%">

                            <p style="line-height: 1.7; font-size:16px"  contenteditable="true">Emissions Methodology Components</p>
                            <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">a.&nbsp&nbsp&nbsp Emissions scope: Classification of emissions source as scope 1, 2 or 3.</li>
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">b. &nbsp&nbsp&nbspActivity data: Source of reported raw activity data used in the inventory.</li>
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">c. &nbsp&nbsp&nbspKey assumptions: Assumptions made in the process of cleaning raw reported data,filling data gaps, and calculating emissions.</li>
                                        <li contenteditable="true" style="margin-left:2% ; line-height: 1.7; font-size:16px">d. &nbsp&nbsp&nbspKey assumptions: Assumptions made in the process of cleaning raw
    reported data, filling data gaps, and calculating emissions.</li>
                                        <li contenteditable="true" style="margin-left:2% ; line-height: 1.7; font-size:16px">e. &nbsp&nbsp&nbspEstimation parameters: The estimation approach and factors used to fill
    data gaps in reported raw activity data.
    </li>
                                        <li contenteditable="true" style="margin-left:2% ; line-height: 1.7; font-size:16px">f. &nbsp&nbsp&nbspEmissions factor source(s): Original publication source information for
    applied emissions factors.</li>
                                        <li contenteditable="true" style="margin-left:2% ;line-height: 1.7;  font-size:16px">g. &nbsp&nbsp&nbspCalculation details: Description of calculations to compute emissions.
    </li>                               <li contenteditable="true" style="margin-left:2% ;line-height: 1.7;  font-size:16px">h. &nbsp&nbsp&nbspAdditional details: Relevant info.

    </li>
                                    </ul>
                        
                    

                        </div>   
    </div>
                        
                        


                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="card-body" >
                            <div class="row" style="margin-top:20px">
                                <h5 style="font-weight: 700; line-height:2"  contenteditable="true">1.  Key Findings</h5>
                            </div>

                            <p style="line-height: 2; font-size:16px"  contenteditable="true">
                            The following tables and charts summarizes the Alpha-Nero/<span style="color: #FF5500;">YSL </span> project 

                            </p>


                            <div class="row">
                                <div class="col-md-5">
                              
                                <div class="card-body">
                                        
                                            
                                        <!-- displaying donut chart -->
                                        <canvas id="donutChart" style="min-height: 300px; height: 250px; max-height: 350px;width:250px; max-width:300px;"></canvas>

                                        
                                </div>
                 

                                <script>
                                    //- DONUT CHART -
                                    //-------------
                                    // Get context with jQuery - using jQuery's .get() method.
                                    // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                                    // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');

var donutData = {
    labels: [<?php echo $data_dss_name; ?>],
    datasets: [
        {
            data: [<?php echo $data_value; ?>],
            backgroundColor: ['#564182', '#DEAA78', '#305448', '#20394F', '#DAF2BC', '#ECCB6E', '#D0F0BF', '#01796F', '#043927', '#679267', '#39FF14',
                '#008080', '#004953', '#004953', '#4F7942', '#4F7942'],
        }
    ]
}

var donutOptions = {
    animation: {
        onComplete: function(animation) {
    var chartInstance = animation.chart;
    var ctx = chartInstance.ctx;
    var centerX = chartInstance.width / 2;

    // Set the desired margin from the top
    var marginTop = -18;
    var centerY = chartInstance.height / 2 - marginTop;

    var total = 0;
    for (var i = 0; i < chartInstance.data.datasets[0].data.length; i++) {
        total += chartInstance.data.datasets[0].data[i];
    }

    // Round to two decimal places
    total = total.toFixed(2);

    // Format the number with commas
    var formattedTotal = parseFloat(total).toLocaleString('en-US');

    var fontSize = 15;
    ctx.font = fontSize + "px Arial";
    ctx.fillStyle = "#000";
    ctx.textBaseline = "middle";
    ctx.textAlign = "center";

    // Set the text on the total
    var text = formattedTotal + ' ' + "tCO₂e";
    ctx.fillText(text, centerX, centerY);
}


    },
    plugins: {
        title: {
            display: true,
        },
        tooltip: {
            enabled: true,
        },
        legend: {
            display: false
        }
    },
};

// Assuming you have already created the chart and donutData variable
new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions,
});

// // Assuming you have already created the chart and donutData variable
// new Chart(donutChartCanvas, {
//     type: 'doughnut',
//     data: donutData,
//     options: donutOptions
// });


                                    </script>
                                
                                </div>
                                <div class="col-md-7" style="margin-top: 64px;padding-left:25px;">
                                    <?php

                                    //storing color value in array
                                    $color_bg=['#564182', '#DEAA78', '#305448','#20394F','#DAF2BC','#ECCB6E','#00A86B','#D0F0BF','#01796F','#043927','#679267','#39FF14',
                                    '#008080','#004953','#004953','#4F7942','#4F7942'];
                                 


                                    ?>

                                    <!-- <div class="card" style="margin-top:10px ;height:50px;"> -->
                                        <!-- <div class="card-body"> -->
                                            <div class="row" >
                                            
                                            <h6 style=" margin-left :2%; line-height:0.8" class="col-md-5">Category
                                            </h6>
                                           
                                            <h6 style=" line-height:0.8; margin-left:160px;" >
                                                tCO<sub>2</sub>e
                                            </h6>
                                           
                                        
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <?php
                                       $i=0;
                                       //declaring foreach loop for display in donut chart datasource emission value 
                                    foreach($data_dss as $value){
                                    ?>
                                    <div class="card" style="margin-top:10px ;height:25px;">
                                        <div class="card-body">
                                            <div class="row" >
                                            <div style="border-radius:20px;width: 5px;height :5px;margin-top:-10px; background-color:<?php echo $color_bg[$i]?>;" ></div>
                                            <h6 style="font-size: smaller;margin-top: -13px;" class="col-md-7"> <?php
                                            echo $value;
                                            ?>
                                            </h6>
                                            
                                            <div class="col-md-4" style="margin-top: -15px;">
                                            <span style="margin-left: 50px;font-size: smaller;"><?php
                                            echo number_format(round($data_ds_value[$i]), 0, '.', ',' );
                                            ?></span>
                                            </div>
                                        
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                    }
                                    ?>

                                </div>
                            </div>


                            <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true">
                            a. Total Alpha-Nero/<span style="color: #FF5500;">YSL </span> Project Emissions by Category


                            </p>
                            <div class="html2pdf__page-break"></div>

                            <div class="row" style="margin-top:65px;display: block;">
                                <div class="col-md-12">
                                  
                                    <?php
                                   //declaring color value in array 
                                    $color = ['#564182', '#DEAA78', '#305448','#20394F','#DAF2BC','#ECCB6E','#D0F0BF','#01796F','#043927','#679267','#39FF14',
                                    '#008080','#004953','#004953','#4F7942','#4F7942'];
                                  

                                    $data_ds_name=array();
                                    foreach($scope1_chart_1 as $value){

                                    //fetching data source name by data source id using  $scope1_chart_1
                                    $data_ds_name2= $value['ds'];
                                    $sql_ds_name2="SELECT * FROM data_source where is_visibility=1 and data_source_id='$data_ds_name2';";
                                    $result_ds_name2=mysqli_query($conn, $sql_ds_name2);
                                    $data_ds_name_id=mysqli_fetch_array($result_ds_name2);

                                    //storing all data source nam in array  
                                    $data_ds_name[]=   $data_ds_name_id['data_source_name'];

                
                                    }




                                    ?>
    
                                        <div class="card-body" style="display:flex;">

                                        <canvas id="myChart1" style="max-width:50%;margin: auto; max-height: 350px;min-height: 350px; "></canvas>
                                        

                                        <?php
$sqlscope = "select * from data_source_subcategory";
$resultscope = mysqli_query($conn, $sqlscope);
$scopedata = array();

if (mysqli_num_rows($resultscope) > 0) {
    while ($fetchscope = mysqli_fetch_assoc($resultscope)) {
        $scopedata[] = $fetchscope;
    }
}

$color1 = ['#564182', '#DEAA78', '#305448','#20394F','#DAF2BC','#ECCB6E','#D0F0BF','#01796F','#043927','#679267','#39FF14','#008080','#004953','#004953','#4F7942','#4F7942'];
$color2 = ['#DAF2BC','#ECCB6E','#D0F0BF','#01796F','#043927','#679267','#39FF14','#008080','#004953','#004953','#4F7942','#4F7942'];
$color3 = ['#043927','#679267','#39FF14','#008080','#004953','#004953','#4F7942','#564182', '#DEAA78', '#305448','#20394F','#DAF2BC','#ECCB6E','#D0F0BF','#01796F','#4F7942'];
?>

<script>
                                            
                                            
                                            var myContext = document.getElementById("myChart1").getContext('2d');
myContext.canvas.height = 270;

var datasets = []; // Array to store dataset objects

<?php
// Determine the maximum length among all arrays
$maxDataLength = max(count($scope1_chart_1), count($scope2_chart_2), count($scope3_chart_3));

for ($i = 0; $i < $maxDataLength; $i++) {
    $scope1_value = isset($scope1_chart_1[$i]['emission']) ? $scope1_chart_1[$i]['emission'] : 0;
    $scope2_value = isset($scope2_chart_2[$i]['emission']) ? $scope2_chart_2[$i]['emission'] : 0;
    $scope3_value = isset($scope3_chart_3[$i]['emission']) ? $scope3_chart_3[$i]['emission'] : 0;

    ?>
    datasets.push({
      
        backgroundColor: "<?php echo $color[$i] ?>",
        data: [
            <?php echo $scope1_value; ?>,
            <?php echo $scope2_value; ?>,
            <?php echo $scope3_value; ?>,
        ],
    });
<?php } ?>
// console.log(datasets);

var myChart = new Chart(myContext, {
    type: 'bar',
    data: {
        labels: ["Scope 1", "Scope 2", "Scope 3"],
        datasets: datasets,
    },
    options: {
        plugins: {
            title: {
                display: true,
            },
            tooltip: {
                enabled: false // Disable tooltips
            },
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                stacked: true,
                grid: {
                    display: false // Remove x-axis grid lines
                },
            },
            y: {
                stacked: true,
                ticks: {
                    display: true
                },
                grid: {
                    display: false // Remove y-axis grid lines
                },
            },
        },
        legend: {
            display: false
        },
        barThickness: 40, // Set the width of the bars (adjust the value as needed)
    }
});


    </script>

                                        
                                       
                                    </div>

                                </div>

                                <div class="col-md-12" >
                                    <!--///////////////////////-->
                                    <div class="col-md-12">
                                    <div class="card" style="height:5%;">
                                        <div class="card-body">
                                            <div class="row" style="margin-top: -15px;">
                                           
                                            <h6 style="margin-left:10px;line-height: 1.5">Scope 1</h6>
                                            </div>
                                            <?php
                                            $i=0;
                                            foreach($scope1_chart_1 as $value){
                                                $dsid=$value['ds'];
                                                $sql_d="select * from  data_source_subcategory where data_source_id='$dsid'";
                                                $resultd=mysqli_query($conn,$sql_d);
                                                $fetchd=mysqli_fetch_assoc($resultd);
                                                $dstsds=$fetchd['data_source_subcategory_name'];

                                            

                                            ?>
                                            <div class="row" style="margin-top: -10px;">
                                            <div style="width:5px;height :5px;border-radius:10px;margin-top:5px; background-color:<?php echo $color[$i] ?>;" ></div>
                                            <div class="col-md-6" >
                                              
                                                        
                                            <p style="font-size: smaller;"><?php echo $dstsds; ?></p>
                                            
                                           

                                            </div>

                                            <div class="col-md-5">
                                            <p  style="margin-left: 60%;font-size: smaller;"><?php echo number_format(round($value['emission']), 0, '.', ',' )." tCO<sub>2</sub>e"; ?></p>

                                            </div>

                                            </div>
                                            <?php
                                            $i++;
                                            }
                                            ?>
                                        

                                        </div>
                                    </div>
                                    </div>
                                    <br>
                                    <!--///////////////////////-->
                                                                    
                        <!--///////////////////////-->
                        <div class="col-md-12" style="margin-top: -14px;">
                                    <div class="card" >
                                        <div class="card-body" >
                                            <div class="row" style="margin-top:-15px;">
                                            <h6 style="margin-left:10px;line-height: 1.5">Scope 2</h6>
                                            </div>
                                            <?php
                                            $i=0;
                                            foreach($scope2_chart_2 as $value){
                                                $dsid=$value['ds'];
                                                $sql_d="select * from  data_source_subcategory where data_source_id='$dsid'";
                                                $resultd=mysqli_query($conn,$sql_d);
                                                $fetchd=mysqli_fetch_assoc($resultd);
                                                $dstsds=$fetchd['data_source_subcategory_name'];

                                            // print_r($value);

                                            ?>
                                            <div class="row" style="margin-top:-10px;">
                                            <div style="width:5px;height :5px;border-radius:10px;margin-top:5px; background-color:<?php echo $color[$i] ?>; " ></div>

                                            <div class="col-md-6" >
                                            <p style="font-size: smaller;"><?php echo $dstsds; ?></p>

                                            </div>

                                            <div class="col-md-5">
                                            <p  style="margin-left: 60%;font-size: smaller;"><?php echo number_format(round($value['emission']), 0, '.', ',' )." tCO<sub>2</sub>e"; ?></p>

                                            </div>

                                            </div>
                                            <?php
                                            $i++;
                                            }
                                            ?>
                                        

                                        </div>
                                    </div>
                                    </div>
                                    <!--///////////////////////-->
                                    
                                                                    
                            


<br>




                                    <!--///////////////////////-->
                                    <div class="col-md-12" style="margin-top: -14px;">
                                    <div class="card" >
                                        <div class="card-body" >
                                            <div class="row" style="margin-top:-15px;">
                                            <h6 style="margin-left:10px;line-height: 1.5">Scope 3</h6>
                                            </div>
                                            <?php
                                            $i=0;
                                            foreach($scope3_chart_3 as $value){
                                                $dsid=$value['ds'];
                                                $sql_d="select * from  data_source_subcategory where data_source_id='$dsid'";
                                                $resultd=mysqli_query($conn,$sql_d);
                                                $fetchd=mysqli_fetch_assoc($resultd);
                                                $dstsds=$fetchd['data_source_subcategory_name'];
                                            

                                            ?>
                                            <div class="row" style="margin-top:-10px;">
                                            <div style="width: 5px;height :5px;border-radius:10px;margin-top:5px; background-color:<?php echo $color[$i] ?>; line-height:1" ></div>

                                            <div class="col-md-6">
                                            <p  style="margin-left:6px;font-size: smaller;"><?php echo $dstsds; ?></p>

                                            </div>

                                            <div class="col-md-5">
                                            <p  style="margin-left: 60%;font-size: smaller;"><?php echo number_format(round($value['emission']), 0, '.', ',' )." tCO<sub>2</sub>e"; ?></p>

                                            </div>

                                            </div>
                                            <?php
                                            $i++;
                                            }
                                            ?>
                                        

                                        </div>
                                    </div>
                                    </div>
                                    <!--///////////////////////-->
                                                                    
                        <!--///////////////////////-->
                    <!--   <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                            <div style="width: 40px;height :10px;margin-top:10px; background-color:#C0504E; line-height:2" ></div>
                                            <h6 style="margin-left:10px;line-height: 2">Reduction</h6>
                                            </div>
                                            <?php
                                            $i=0;
                                            foreach($scope_red_chart_r as $value){

                                            

                                            ?>
                                            <div class="row">
                                            
                                            <div class="col-md-6">
                                            <p  style="line-height: 1;margin-left:6px"><?php echo $data_ds_name[$i] ?></p>

                                            </div>

                                            <div class="col-md-6">
                                            <p  style="line-height: 1;margin-left:20px"><?php echo number_format(round($value['emission']), 0, '.', ',' ); ?></p>

                                            </div>

                                            </div>
                                            <?php
                                            $i++;
                                            }
                                            ?>
                                        

                                        </div>
                                    </div>-->
                                    <!--///////////////////////-->
                                                                    
                                </div>



                                



                                    </div>
                                    
                            </div>
                            <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true">
                            b. Alpha-Nero/<span style="color: #FF5500;">YSL </span> Project Emissions Breakdown by Scope.


                            </p>


                            </div>
                    


                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                        
                    
                    
                            <div class="card-body" >

                    <div class="card">
                        <div class="card-body">


                        <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px;">
                    <thead>

                    
                    <tr>
                                            <th >S.no</th>
                                            <th style="width: 15%;">Scope</th>
                                            <th style="width: 15%;">Data Source</th>
                                            <th>Data Source Subcategory</th>
                                            <th style="width: 15%;" >Emission</th>
                                        
                                            </tr>
                    </form>
                    </thead>
                    <tbody>



                        <?php
                        
                        
                        
                    //   print_r($data_source);
                        // counting $data_consumption array rows
                    $count= count($data_dss_array);

                        // echo count($data_source);

                        $z=1;
                        
                        //loop for printing month and year 
                        for($i=0; $i<$count; $i++){

                    //  echo "ok1";
                    ?>
                    <tr>
                                <td> <?php echo $z; ?> </td>
                    <td> <?php print_r($data_dss_array[$i]['scope']); ?></td>
                    <td> <?php print_r($data_dss_array[$i]['data_source_name']); ?></td>
                    <td> <?php print_r($data_dss_array[$i]['data_source_subcategory_name']); ?></td>
                    <td> <?php print_r(number_format(round($data_dss_array[$i]['dss_emission_value']), 0, '.', ',' )." tCO<sub>2</sub>e"); ?></td>	       
                    

                                    
                    <?php
                                $z++;
                        }
                    
                            ?>

                    
                    </tbody>
                    <tfoot>
                    <tr>
                    <th >S.no</th>
                                            <th >Scope</th>
                                            <th >Data Source</th>
                                            <th>Data Source Subcategory</th>
                                            <th >Emission</th>
                                                                </tr>
                    </tfoot>
                    </table>



                        </div>
                        
                    </div>
                    <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true" >
                            b. Alpha-Nero/<span style="color: #FF5500;">YSL </span> Project Emissions Breakdown by Scope.


                            </p>

                            <h5 style="line-height: 2;"  contenteditable="true">
                            4. Alpha-Nero/<span style="color: #FF5500;">YSL </span> GHG Inventory Development Approach
                            </h5>
                    

                            <p style="line-height: 1.1; font-size:16px"  contenteditable="true">The report includes scope 1 and 2 emissions from Alpha-Nero’s vehicles and offices 
    in the following locations:</p>
                            <p style="line-height: 1.5; font-size:16px"  contenteditable="true">
                            Below the emissions methodology components are listed which are used to outline the 
                            calculation methodology and assumptions applied to each emission source.

                            </p>

                            <p style="line-height: 1.1; font-size:16px"  contenteditable="true">Dubai, United Arab Eremites</p>
                            <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.1; font-size:16px"> C07 warehouse, Dubai, UAE</li>
                                    </ul>
                                      <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->

                                    <!-- <div class="card" style=" margin-top:30px"> -->

                                    <p style="line-height: 1.5; font-size:16px;margin-top:100px;"  contenteditable="true">a. Boundary Conditions, Inclusions & Exclusions
    </p>
                            <p style="line-height: 1.3; font-size:16px"  contenteditable="true">
                            The basis for reporting resource consumption and emissions data from Alpha-Nero’s 
    partially owned or controlled assets is based on a Control Approach: operational 
    control criterion.
                            </p>     
                            <p style="line-height: 1.3; font-size:16px"  contenteditable="true">
                            An organization has operational control over a facility if the organization (or one of 
    its subsidiaries) has the full authority to introduce and implement its operating 
    policies (e.g. operating schedule, design, technologies, etc.). For Alpha-Nero, this 
    includes all spaces, including offices and warehouses in which the organization 
    operates.
                            </p>     
                            <p style="line-height: 1.3; font-size:16px"  contenteditable="true">
                            In addition to scope 1 and scope 2 emissions from Alpha-Nero’s vehicles, office and 
    warehouse locations, development of the Alpha-Nero/<span style="color: #FF5500;">YSL </span> project 2021 GHG 
    Inventory included an emissions screen of all 15 scope 3 categories. The results of 
    this screen, in conjunction with conversations with Alpha-Nero, identified the
                            </p>          
                        
                    
                <!-- </div> -->
                    
                    
                      
                
                    
                    
                            <div class="card-body" >


                            <p style="line-height: 1.7; font-size:16px"  contenteditable="true">following scope 3 categories that are applicable to the project and were included in 
    the Inventory:</p>      <p style="line-height: 1.7; font-size:16px"  contenteditable="true">Scope 3 Categories</p>
                            <ul style="list-style-type: none;">
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">a.  Business Travel (category 6)</li>
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">b.  Employee Commuting (category 7)</li>
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">c.  Waste generated in Operations (category 5)</li>
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">d.  Products/Purchased Goods and Services (category 1)</li>
                                        <li contenteditable="true" style="margin-left:2% ;  line-height: 1.7; font-size:16px">e.  Shipping/Transportation & Distribution (category 9 & 4)</li>
                                    </ul>

                    
                                    <p style="line-height: 1.7; font-size:16px"  contenteditable="true">Exclusions:</p>

                                    <p style="line-height: 1.7; font-size:16px"  contenteditable="true">Emissions from other scope 3 services beyond those listed above (e.g. water) were 
    deemed not to be material and while they may be included in the inventory
    calculations the were excluded from this report and the related calculations were not 
    discussed in detail. For more guidance on materiality see chapter 10 of the GHG 
    protocol here: <a href="https://ghgprotocol.org/sites/default/files/standards/ghg-protocol-revised.pdf" style="color:#0000FF ;"> https://ghgprotocol.org/sites/default/files/standards/ghg-protocol-revised.pdf</a> </p>
                    <!-- </div> -->
                    </div>
                    <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!-- <div class="row" style="margin-top:25px;"> -->

                            
                            <div class="card-body">
                            <h5 style="line-height: 2;margin-top:100px;"  contenteditable="true">
                            5. Calculations
                            </h5>
                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%; background-color:#9BBB59; color:white">Emissions Scope</th>
                                            <th style="width: 50%; background-color:#9BBB59;color:white">Scope 1</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true"> Vehicle activity data values reported by 
    Alpha-Nero via GHG Inventory Data 
    Request collection template. Included 
    exact vehicle type and milage 
    information. </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Key Assumptions </td>
                                <td  contenteditable="true"> Total emissions related to vehicles were 
    distributed on a per project basis using 
    timeframe of the project and the number 
    of concurrent projects. </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Emission Factor Sources </td>
                                <td  contenteditable="true"> DEFRA Emissions Factors (June 2021) </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true"> Distance/Mileage to Co2e using vehicle 
    type/fuel type emissions factors. </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true"> Detailed calculations and a full list of data 
    sources/activity data available, 
    documented and uploaded to GreenFeet 
    sustainability platform.  </td>
                    
                        </tr>
                    </tbody>
                
                    </table>

                    </div>


                    <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true" >
                    a. Emissions Methodology by Source: Scope 1 - Vehicles

                            </p>




                            <!-- </div> -->
                    
                        
                    

                    
                    
                    
                    
                    
                        <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                
                            <div class="card-body" >

                            <table id="example1" class="table table-bordered table-striped" style="margin-top:100px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#9BBB59; color:white"  contenteditable="true">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#9BBB59; color:white"  contenteditable="true">Scope 2</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true">Electricity usage values reported by 
    Alpha-Nero via GHG Inventory Data 
    Request collection template. Included 
    exact KWH usage. </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Key Assumptions </td>
                                <td  contenteditable="true"> Total emissions related to electricity were 
    distributed on a per project basis using 
    timeframe of the project and the number 
    of concurrent projects </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Emission Factor Sources </td>
                                <td  contenteditable="true" > Dubai Electricity and Water Authority
    </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true"> KWH to CO2e using location based 
    emissions factors accounting for local 
    electricity grid mix </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true">Detailed calculations and a full list of data 
    sources/activity data available, 
    documented and uploaded to GreenFeet 
    sustainability platform. </td>
                    
                        </tr>
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:16px; text-align:center"   contenteditable="true">
                    b. Emissions Methodology by Source: Scope 2 - Electricity Usage
                            </p>

 <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->



                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 100px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#9BBB59; color:white">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#9BBB59; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true">Employee commute patterns reported by 
    Alpha-Nero via GHG Inventory Data 
    Request collection template. </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Key Assumptions </td>
                                <td  contenteditable="true"> Assumed that the average daily 
    distance travelled was <span style="color :#FF5500 ">4km by bus and 
    20km by minibus </span> (based on employee 
    commute patterns provided by Alpha-Nero). GreenFeet Employee commute 
    survey was also used.  </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Emission Factor Sources </td>
                                <td   contenteditable="true">DEFRA 2021 Emissions Factors (June 
    2021) 
    </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true"> Distance per KM to Co2e coefficient was 
    utilized for the various transport modes
    </td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true">Detailed calculations and a full list of data 
    sources/activity data available, 
    documented and uploaded to GreenFeet 
    sustainability platform.</td>
                    
                        </tr>
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true" >
                    c. Emissions Methodology by Source: Scope 3 - Employee Commute

                            </p>

                            </div>
                    




                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                
                    
                            <div class="card-body" >


                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 60px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#9BBB59; color:white">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#9BBB59; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td   contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true">Business Travel reported by Alpha-Nero
    via GHG Inventory Data Request 
    collection template.  </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Emission Factor Sources</td>
                                <td  contenteditable="true">Distance per flight type (haul) and class 
    coefficient utilized</td>
                    
                        </tr>
                        <tr>
                                
                        <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true"> Distance per flight type (haul) and class 
    coefficient utilized
    </td>
                    
                        </tr>
                        <tr>
                        <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true">Detailed calculations and a full list of data 
    sources/activity data available, 
    documented and uploaded to GreenFeet 
    sustainability platform.  </td>
                    
                        </tr>
                        
                    
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:16px; text-align:center"   contenteditable="true">
                    d. Emissions Methodology by Source: Scope 3 – Business Travel
                            </p>





                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 10px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#9BBB59; color:white">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#9BBB59; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                    <tr>
                                <td  contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true">Shipping activity data including distance,
    transport mode and weight of shipments 
    reported by Alpha-Nero via GHG 
    Inventory Data Request collection 
    template. </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Emission Factor Sources</td>
                                <td  contenteditable="true">DEFRA Emissions Factors (June 2021) 
    for Freighting Goods</td>
                    
                        </tr>
                        <tr>
                                
                        <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true">Emissions calculated using
    distance/weight per transport mode
    </td>
                    
                        </tr>
                        <tr>
                        <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true">Detailed calculations and a full list of data 
    sources/activity data available, 
    documented and uploaded to GreenFeet 
    sustainability platform. </td>
                    
                        </tr>
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true" >
                    e. Emissions Methodology by Source: Scope 3 - Shipping


                            </p>

                            </div>
                    


                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                



                              <div class="card-body" >


                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 100px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%; background-color:#9BBB59; color:white">Emissions Scope</th>
                                            <th style="width: 50%; background-color:#9BBB59; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true">List of products, their material make up 
and weight per product reported by 
Alpha-Nero
via GHG Inventory Data Request 
collection template. </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Key Assumptions</td>
                                <td  contenteditable="true">Calculations cover the cradle-to-gate and 
are self-declared.</td>
                    
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Emission Factor Sources</td>
                                <td  contenteditable="true">Utilizes a range of internationally 
published emission factors as published in 
the GreenFeet documentation.</td>
                    
                        </tr>
                        <tr>
                                
                        <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true"> Emissions are calculated on average 
emissions factors for materials, energy 
consumption and transportation based on 
product category, total weight of product, 
the weight of unique materials used in 
each product (or packaging) part, location 
and distances between supplier, 
manufacturing facility and distribution 
center and modes of transport between 
each as well as the source of energy used 
in production.

    </td>
                    
                        </tr>
                        <tr>
                        <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true">Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to GreenFeet 
sustainability platform.  </td>
                    
                        </tr>
                        
                    
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true" >
                    f. Emissions Methodology by Source: Scope 3 - Products

                            </p>


                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                



                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 100px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%; background-color:#9BBB59; color:white">Emissions Scope</th>
                                            <th style="width: 50%; background-color:#9BBB59; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                    <tr>
                                <td  contenteditable="true"> Activity Data </td>
                                <td  contenteditable="true">A percentage of product waste and related 
waste weight was reported by Alpha-Nero
via GHG Inventory Data Request 
collection template.     </td>
                        </tr>
                        <tr>
                                
                                <td  contenteditable="true">Emission Factor Sources</td>
                                <td   contenteditable="true">DEFRA Emissions Factors (June 2021) 
for Waste</td>
                    
                        </tr>
                        <tr>
                                
                        <td  contenteditable="true"> Calculation Details </td>
                                <td  contenteditable="true">Weight per waste type emissions factor 
coefficient.
    </td>
                    
                        </tr>
                        <tr>
                        <td  contenteditable="true"> Additional Details </td>
                                <td  contenteditable="true">Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to GreenFeet 
sustainability platform.  </td>
                    
                        </tr>
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:16px; text-align:center"  contenteditable="true" >
                    g. Emissions Methodology by Source: Scope 3 - Waste


                            </p>

                            </div>
                    

                           <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                


                        </div>
                        
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Add a download button -->
                                <button id="downloadButton" class="btn btn-success" style="margin-left:20px ;">Download PDF</button>


                            </div>
                        </div>


<?php
        // $idproject=$_GET['id'];
        // $sqlp="select * from project_master where project_master_id='$idproject'";
        // $resultp=mysqli_query($conn,$sqlp);
        // $fetchp=mysqli_fetch_assoc($resultp);
        // $project_name=$fetchp['project_name'];

?>
                   
                       

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        
        // Add a click event listener to the download button
        // document.getElementById("downloadButton").addEventListener("click", function () {
        //     var element = document.getElementById("element");
        //     console.log(element);
        //     html2pdf(element)
        // });


           // Add a click event listener to the download button
           document.getElementById("downloadButton2").addEventListener("click", function () {
    var element = document.getElementById("element");
    var project_name = '<?php echo $project_name.'_Project_report'; ?>';  // Add quotation marks

    // Adjust scale and set options for better quality
    var options = {
        // margin: 5,
        filename: project_name,
        image: { type: 'jpeg', quality: 1.0 },  // Adjust quality as needed
        html2canvas: { scale: 2 }  // Adjust scale as needed
    };

    html2pdf(element, options);
});

  // Add a click event listener to the download button
  document.getElementById("downloadButton").addEventListener("click", function () {
    var element = document.getElementById("element");
    var project_name = '<?php echo $project_name.'_Project_report'; ?>';  // Add quotation marks

    // Adjust scale and set options for better quality
    var options = {
        // margin: 5,
        filename: project_name,
        image: { type: 'jpeg', quality: 1.0 },  // Adjust quality as needed
        html2canvas: { scale: 2 }  // Adjust scale as needed
    };

    html2pdf(element, options);
});

   

    </script>




















                        </div> <!-- container -->

                    </div> <!-- content -->


                </div>
                <!-- End content-page -->


                <!-- ============================================================== -->
                <!-- End Right content here -->
                <!-- ============================================================== -->


    <?php // require 'includes/footer_start.php' ?>  


            <!--Morris Chart-->
            <script src="plugins/morris/morris.min.js"></script>
            <script src="plugins/raphael/raphael.min.js"></script>

            <!-- Page specific js -->
            <script src="assets/pages/jquery.dashboard.js"></script>

     <?php // require 'includes/footer_end.php' ?>
