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
    /* .elementname p,h1,h5,h6{
    font-family: "Times New Roman" !important;
} */
/* .elementname p,
.elementname h1,
.elementname h5,
.elementname h6,
.elementname li,
.elementname td,
.elementname th,
.elementname span{
    font-family: "Times New Roman" !important;
} */
.div1 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 400px; /* Set the width of the background image */
    background-position: right;
}
.div2 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 450px; /* Set the width of the background image */
    background-position: right;
}
.div3 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 450px; /* Set the width of the background image */
    background-position: right;
}
.div4 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 500px; /* Set the width of the background image */
    background-position: right;
}
.div5 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 450px; /* Set the width of the background image */
    background-position: right;
}
.div6 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 450px; /* Set the width of the background image */
    background-position: right;
}
.div7 {
    background-image: url('media/logofooterpdf4.png'); /* Set the path to your background image */
    background-repeat: no-repeat;
    background-size: 450px; /* Set the width of the background image */
    background-position: right;
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


                  


                        //if condition to check project id
                        if(!empty($generate_pro_id)){
    
                     // fetching data from particular id 
                         $sql_date="SELECT * FROM project_master 
                         where  project_master_id =$generate_pro_id;";
                         $result_date=mysqli_query($conn, $sql_date);
                         $data_date=mysqli_fetch_array($result_date);
    
    
                         //fetching data from data source table
                         $sql_ds="SELECT * FROM data_source where is_visibility=1; ";
                         $result_ds=mysqli_query($conn,$sql_ds);
                         $data_ds=array();
                         while($row=mysqli_fetch_assoc($result_ds)){
                         // $data_ds[]=$row;
    
                         //giving feilds to array
                          $data_ds[]=array(
                            'data_source_id'=>$row['data_source_id'],
                            'icon'=>$row['icon'],
                            'data_source_name'=>$row['data_source_name'],
                            'data_source_emission'=>0,
                          );
                         }
    
                        // print_r($data_ds);
    
    
                         ///assinging start date and end date   
                         $project_name=$data_date['project_name']  ;  
                         $project_description=$data_date['project_master_description']  ;  
                         $string_sd=$data_date['project_master_start_date'];
                         $string_ed=$data_date['project_master_end_date'];
                         $start_date = new DateTime($data_date['project_master_start_date']);
                         $end_date   = new DateTime($data_date['project_master_end_date']);
                         $year = $end_date->format('Y');
                        // echo $string_sd;

                        // Calculate the difference in days between the two dates
                        $interval = $start_date->diff($end_date);

                        // Calculate the number of weeks
                        $weeks = floor($interval->days / 7);

                        $s_date = new DateTime($string_sd);
                        $start_month = $s_date->format('F');
                      
                        
                        $e_date = new DateTime($string_ed);
                        $end_month = $e_date->format('F');
                       
    
                    //arraya containg all emission value
                    $data_all_emission=array();
    
    
                    //declaring scope varible as 0
                    $scope_1_emission=0;
                    $scope_2_emission=0;
                    $scope_3_emission=0;
                    $scope_red_emission=0;
                    $reduction_emission=0;
                    // $reduction_emission = 0;
    $processed_months = array();
                    $month_name='';
                    $data_consumption_project=0;
                    $data_reduction_project=0;
                    $i=1;
    
    
                    // first loop for running no. of dates //
                    while ($start_date <= $end_date) {
    
    
    
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
    // echo $month_name;
    // echo $year_name.'<br>';
    
    
        // query for fetching emission values 
        $sql = "SELECT *, c.consumption_value*ef.emission_factors_value as emission_value FROM tbl_month_consumption_sub as c
        join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
        join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
        join data_source as ds on dss.data_source_id = ds.data_source_id
        where c.month='$month_name' and c.year=$year_name and ef.year=$year_name ";//and dss.is_reduction='no'
       
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

       //total emission value of that day = total data source subcategory of that day * fraction 
        $emission_dss=$data_dss*$fraction;
    
        //echo "emission value =>".$emission_dss;
    
        //total data emission value of every day add on
        $data_consumption_project+= $emission_dss;
    
        $emission_dss_red=$data_dss_reduction*$fraction;
    
        //echo "emission value =>".$emission_dss;
    
        //total data emission value of every day add on
       $data_reduction_project+= $emission_dss_red;
    
     // Check if the current month has already been processed
     if (!in_array($month_name, $processed_months)) {
        // Execute the SQL query for the current month
        $sql_reduction = "SELECT SUM(c.consumption_value * ef.emission_factors_value * CASE WHEN c.consumption_value2 = 0 THEN 1 ELSE c.consumption_value2 END) as emission_value 
                          FROM tbl_month_consumption_sub as c
                          JOIN emission_factors as ef ON c.data_source_subcategory_id = ef.data_source_subcategory_id
                          JOIN data_source_subcategory as dss ON c.data_source_subcategory_id = dss.data_source_subcategory_id
                          JOIN data_source as ds ON dss.data_source_id = ds.data_source_id
                          WHERE c.month = '$month_name' AND c.year = $year_name AND ef.year = $year_name AND dss.is_reduction = 'yes'";
    
        // Execute the SQL query
        $result_red = mysqli_query($conn, $sql_reduction);
    
        // Check if the query was successful
        if ($result_red) {
            // Fetch the result as an associative array
            $fetch_red = mysqli_fetch_assoc($result_red);
    
            // Add the emission value to the total reduction emission
            $reduction_emission += $fetch_red['emission_value'];
    
            // Add the current month to the list of processed months
            $processed_months[] = $month_name;
            // print_r($processed_months);
        } 
    }
    
        //loop end foreach
        // echo $reduction_emission;
    
       // echo "$date $year_name  $month_name<br>"; // Display date and month name
     
        $start_date->add(new DateInterval('P1D')); // Increment the date by one day
    
     
        }
    
    
        
      
    
     //declarying array 
     $data_ds_name=array();
    //declaring arr for icon
     $data_ds_icon=array();
     //declarying array 
    $data_ds_value=array();
      //declarying varible
      $total_donut_value = 0;
    
        foreach($data_ds as $value){
            $data_ds_name[]=$value['data_source_name'];
            $data_ds_icon[]=$value['icon'];
            $data_ds_value[]=$value['data_source_emission'];
            $total_donut_value += $value['data_source_emission'];
    
        }
    // print_r($data_ds);
    
    
        /*  // Calculate the percentage for each data point
          $data_percentage = array_map(function ($value) use ($total_donut_value) {
            return round(($value / $total_donut_value) * 100, 2);
        }, $data_ds_value);
    */
     
    
        // Use implode to concatenate elements with the single quotes
        $data_name = "'" . implode("', '", $data_ds_name) . "'";
    
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
       // echo  "scope 1".$scope_red_emission."<br>";
       // echo "reductio value ".$data_reduction_project."<br>";
    //    echo $generate_pro_id;
    
        // $emission_actual="SELECT  SUM(ip.add_Item_to_project_item_quantity * it.item_emission_factor * 
        //                                                     CASE WHEN ip.add_Item_to_project_item_quantity2 = 0 THEN 1 ELSE ip.add_Item_to_project_item_quantity2 END
        //                                                 ) as actual_emission 
        //                   FROM project_master as pm
        //                   join add_item_to_project as ip on pm.project_master_id = ip.add_Item_to_project_assign_id
        //                   join item as it on ip.add_Item_to_project_item_id= it.item_id
        //                   where pm.project_master_id = $generate_pro_id;";
        $emission_actual="SELECT sum(ip.add_Item_to_project_item_quantity*it.item_emission_factor) as actual_emission FROM add_item_to_project as ip join item as it on ip.add_Item_to_project_item_id=it.item_id join item_unit as iu on it.item_unit=iu.item_unit_name join item_category as ic on it.item_category_id=ic.item_category_id WHERE ip.add_Item_to_project_assign_id=$generate_pro_id and ip.add_Item_to_project_is_visibility=1 order by add_Item_to_project_id desc";
        // echo $data_consumption_project;
                          
        $result_actual=mysqli_query($conn, $emission_actual);
        $data_emission_actual=mysqli_fetch_array($result_actual);
        $emission_actual=$data_emission_actual['actual_emission'];
    //    echo $emission_actual;
    // echo $data_consumption_project;
        $total_emission_project=$emission_actual+$data_consumption_project;
    
    
                                                        $sql_item_emission = "SELECT *,
                                                        SUM(ip.add_Item_to_project_item_quantity * it.item_emission_factor * 
                                                        COALESCE(NULLIF(ip.add_Item_to_project_item_quantity2, 0), 1)
                                                        ) as emission_item_project
                                                    FROM project_master as pm
                                                    JOIN add_item_to_project as ip ON pm.project_master_id = ip.add_Item_to_project_assign_id
                                                    JOIN item as it ON ip.add_Item_to_project_item_id = it.item_id
                                                    WHERE ip.add_Item_to_project_assign_id = $generate_pro_id
                                                        AND ip.add_Item_to_project_is_visibility = 1;";
                                                        $result_item_emission = mysqli_query($conn, $sql_item_emission);
                                                        $data_item_emission = mysqli_fetch_array($result_item_emission);
    
                                                        // echo $data_item_emission['emission_item_project'];
    
                                                        $scope_3emission = $data_item_emission['emission_item_project'];
    
                                                        
    
    
       
        
        // print_r($reduction_emission);
        // echo $month_name;
        // echo $year_name;
    
        // $sql_landfill="SELECT *, sum(c.consumption_value*ef.emission_factors_value) as emission_value FROM tbl_month_consumption_sub as c
        // join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
        // join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
        // join data_source as ds on dss.data_source_id = ds.data_source_id
        // where c.month in ( '$month_name') and c.year=$year_name and ef.year=$year_name and dss.data_source_subcategory_name='Landfill';";
    
        $sql_landfill="SELECT *, 
        SUM(c.consumption_value *ef.emission_factors_value * CASE WHEN c.consumption_value2 = 0 THEN 1 ELSE c.consumption_value2 END)
         as emission_value FROM tbl_month_consumption_sub as c
            join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
            join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
            join data_source as ds on dss.data_source_id = ds.data_source_id
            where c.month in ( '$month_name') and c.year=$year_name and ef.year=$year_name and dss.data_source_subcategory_name='Landfill' ;";
        $result_landfill=mysqli_query($conn, $sql_landfill);
        $fetch_landfill=mysqli_fetch_assoc( $result_landfill );
        $emission_landfill=$fetch_landfill["emission_value"];
        
      
    
    }

   
    
   
  $facility_id=$_SESSION['auth_user']['facility_id'];
    
                        ?>
    



             

                <div class="card">
                    <div class="card-body">
                        <!-- download button-->
                    <button id="downloadButton2" class="btn btn-primary" style="margin-left:20px ;">Download PDF</button>
                    </div>
                </div>
                        <div class="card elementname" id="element">
                            <div class="card-body" >
                            
                            <!--///////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                            <div class="row" style="margin-bottom: 5%;">
                                <div class="col-md-6">
                                <img src="assets/images/alphalogo2.png" style="height: 120px; " alt="">
                                    
                                </div>
                                <div class="col-md-6 d-flex justify-content-end" >
                                <img src="assets/images/ecofirst.png" style="height: 90px;margin-top: 15px; " alt="">
                                </div>
                            </div>

                        <!-- <button class="btn btn-primary" onclick="window.print()" value="Print">Print</button> -->
                        
                            <h5 <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="color: white;font-weight: 600;background: #b28250;width: fit-content;    padding-top: 5px;">Alpha-Nero/<span style="color: white;font-size:large;"><?php echo $project_description?> </span> GHG Emissions Report <span style="color: white;font-size: large;"><?php echo $year; ?></span></h5>

                            <hr style="border-top: 2px solid black;color: black;">
                            <h6 <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="line-height: 2;font-weight:600;">Table of Contents: </h6>
                            <div class="div1">
                            <ul style="list-style-type: none;"  >
                                <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;line-height: 3;font-weight:600;">1.  Executive Summary</li>
                                <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ; line-height: 2;font-weight:600;">2.  Methodology
                                    <ul style="list-style-type: none;">
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5%;font-weight:600;">a. Primary vs Secondary Data</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5%;line-height: 1;font-weight:600;">b. Emissions Methodology Components</li>
                                    </ul>
                                </li>
                                <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 3;font-weight:600;">3.  Key Findings
                                    <ul style="list-style-type: none;">
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 1.2;font-weight:600;">a.  Alpha-Nero/<span style="color: black;font-size:14px;"><?php echo $project_description?> </span>  Project Emissions by Data source</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 1.2;font-weight:600;">b.  Alpha-Nero/<span style="color: black;font-size:14px;"><?php echo $project_description?> </span>  Project Emissions by Scope</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 1.2;font-weight:600;">c.  Alpha-Nero/<span style="color: black;font-size:14px;"><?php echo $project_description?> </span>  Project Emissions by Raw Materials</li>
                                    </ul>
                                </li>
                                <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 3;font-weight:600;">4. GHG Inventory Development Approach
                                    <ul style="list-style-type: none;">
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 2;">a. Boundary Conditions, Inclusions & Exclusions</li>
                                    </ul>
                                </li>
                                <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ;  line-height: 3;font-weight:600;">5. Calculations
                                    <ul style="list-style-type: none;">
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 1.2;"x>a. Emissions Methodology by Source: Scope 1 Vehicles</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 1.2;">b. Emissions Methodology by Source: Scope 2 Electricity Usage</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;  line-height: 1.2;">c. Emissions Methodology by Source: Scope 3 Employee Commute</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ; line-height: 1.2;">d. Emissions Methodology by Source: Scope 3 Business Travel</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ; line-height: 1.2;">e. Emissions Methodology by Source: Scope 3 Shipping</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ; line-height: 1.2;">f. Emissions Methodology by Source: Scope 3 Products</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> class="elementname" style="margin-left:5% ;line-height: 1.2;">g. Emissions Methodology by Source: Scope 3 Waste</li>
                                    </ul>
                                </li>
                            </ul>
                            </div>
                            <!--////////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 1/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            
                            <div class="card-body" >
                            <div class="row">
                                <h5 style="font-weight: 700; line-height:3"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>1.  Executive Summary</h5>
                            </div>
                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            This Greenhouse Gas Inventory (“Inventory”) describes the Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> project 
                            impact on the environment as measured in greenhouse gases (GHG) emitted in units 
                            of equivalent tons of carbon dioxide for a <span style="color: black; font-size: medium;"><?php echo $weeks; ?> week period spanning <?php echo $start_month; ?> and 
                            <?php echo $end_month; ?> in <?php echo $year; ?></span>. The purpose of this inventory is to record and calculate the related 
                            project emissions and to provide a consistent methodology for documenting the 
                            emissions inventory on an ongoing basis. 
                            </p>

                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            Alpha-Nero compiled the inventory and provided activity data from its business
activities in line with the GHG protocol

                            </p>

                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            In summary, the Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> project estimated carbon footprint is 
                            <span style="color: black;font-size:17px;"><?php echo number_format(round($total_emission_project), 0, '.', ',' ) ?> mtCO<sub>2</sub>e</span>. A breakdown by emission category is detailed below. 
                            </p>

                            <p style="line-height: 1.5; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>> 
                            Furthermore, Alpha-Nero has committed to a climate emergency strategy and is 
                            taking the following related actions:   
                            </p>
                            <ul >
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ;  line-height: 1.2; font-size:17px;">&nbsp;&nbsp;&nbsp;Completed baseline year emissions measurement as per the Greenhouse Gas Protocol</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ;  line-height: 1.2; font-size:17px;">&nbsp;&nbsp;&nbsp;Committed to monthly emissions measurement and tracking using the
Alpha-Nero sustainability emissions management platform</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ;  line-height: 1.2; font-size:17px;">&nbsp;&nbsp;&nbsp;Committed to annual reporting of GHG emissions for stakeholders</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ; line-height: 1.2; font-size:17px;">&nbsp;&nbsp;&nbsp;Set sustainability goals and will endeavor to work with partners and
suppliers with strong sustainability programs and goals to reduce emissions where 
possible</li>
                                       
                                    </ul>
                                    
                            <p style="line-height: 1.5; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Specifically in relation to the Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> project emissions Alpha-Nero is taking the following actions: </p>
                                    <ul >
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ;  line-height: 1.2; font-size:17px;">&nbsp;&nbsp;&nbsp;Completed a project specific emissions inventory outlining the specific
business activities responsible for emissions</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:5% ;  line-height: 1.2; font-size:17px;">&nbsp;&nbsp;&nbsp;Promotes the recycling of unused materials where possible</li>
                                    </ul>
                        
                    

                        </div>        
                    

                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 2/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                        
                        
                    
                    
                            <div class="card-body" >
                            <div class="row" >
                                <h5 style="font-weight: 700; line-height:2"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>2.  Methodology</h5>
                            </div>  
                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            This inventory is developed in accordance with the revised GHG Protocol Corporate 
                            Standard and the Corporate Value Chain Accounting and Reporting Standard.
                            Inventory development involves the collection and examination of documentation, 
                            testimony and data from internal and external sources. Development also includes a 
                            determination of completeness and accuracy of the data provided and calculations 
                            completed using this data.
                            </p>
<div class="div2">
                            <span style="font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>><i>a. Primary vs Secondary Data</i></span>

                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            Primary Data refers to activity data taken directly from meter readings, i.e., the “raw” 
                            utility bill data. Primary Data are generally considered to be the most accurate, and 
                            preferable to estimated data.
                            </p>

                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
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

                            

                            <p style="line-height:1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>><i>b. Emissions Methodology Components</br> Below the emissions methodology components are listed which are used to outline the 
                            calculation methodology and assumptions applied to each emission source.</i></p>
                            
                            </div>
                            
                            <div class="row" >

                            <p style="line-height: 1.7; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Emissions Methodology Components</p>
                            <ul >
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">&nbsp&nbsp&nbsp Emissions scope: Classification of emissions source as scope 1, 2 or 3.</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">&nbsp&nbsp&nbspActivity data: Source of reported raw activity data used in the inventory.</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">&nbsp&nbsp&nbspKey assumptions: Assumptions made in the process of cleaning raw reported data,filling data gaps, and calculating emissions.</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ; line-height: 1.2; font-size:17px;">&nbsp&nbsp&nbspKey assumptions: Assumptions made in the process of cleaning raw
    reported data, filling data gaps, and calculating emissions.</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ; line-height: 1.2; font-size:17px;">&nbsp&nbsp&nbspEstimation parameters: The estimation approach and factors used to fill
    data gaps in reported raw activity data.
    </li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ; line-height: 1.2; font-size:17px;">&nbsp&nbsp&nbspEmissions factor source(s): Original publication source information for
    applied emissions factors.</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;line-height: 1.2;  font-size:17px;">&nbsp&nbsp&nbspCalculation details: Description of calculations to compute emissions.
    </li>                               <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;line-height: 1.2;  font-size:17px;">&nbsp&nbsp&nbspAdditional details: Relevant info.

    </li>
                                    </ul>
                        
                    

                        </div>   
    </div>
                        
                        


                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 3/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="card-body" >
                            <div class="row" >
                                <h5 style="font-weight: 700; line-height:2"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>3.  Key Findings</h5>
                            </div>

                            <p style="line-height: 2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            The following tables and charts summarizes the Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> project 

                            </p>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row">
                                                    <div class="col-md-10" style="margin: auto;">

                        <div class="card" style="height:420px">
                        <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Data Source</h5>

                        <div class="card-body" >
                        
                            
                            <!-- displaying donut chart -->
                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

                        </div>
                        </div>
                        </div>
                        </div>
                  
                        <script>
                        //- DONUT CHART -
                        //-------------
                        // Get context with jQuery - using jQuery's .get() method.
                        // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                        // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                        var donutData        = {
                        labels: [<?php echo $data_name;?>
                        /*
                        'Chrome',
                        'IE',
                        'FireFox',
                        'orange',
                        'black'*/

                        ],
                        datasets: [
                        {
                        data: [<?php echo $data_value?>],
                        backgroundColor :['#74923C', '#089C08', '#D4E18F','#093908','#9EAB78','#00A86B','#D0F0BF','#01796F','#043927','#679267','#39FF14',
                        '#008080','#004953','#004953','#4F7942','#4F7942'],
                        }
                        ]
                        }
                        var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var currentValue = dataset.data[tooltipItem.index];
                                return data.labels[tooltipItem.index] + ': ' + currentValue + '%';
                            }
                        }
                        },
                        legend: {
                        display: true,
                        position: 'bottom' // Display the legend below the chart
                        }
                        }
                        //Create pie or douhnut chart
                        // You can switch between pie and douhnut using the method below.
                        new Chart(donutChartCanvas, {
                        type: 'pie',
                        data: donutData,
                        options: donutOptions
                        })
                        //donut chart ends


                        </script>
                        <!--./row-->
                        <div class="div3">
                        <div class="row" style="margin-top:20px ;">
                                <?php
                               


                                    $icon=["water.jpg","Electricity(scope1).png","Waste(scope1).png"];
                                    for($i=0;$i<count($data_ds_name);$i++){
                                ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-8">
                                <!-- displaying the name of data source -->
                                <p style="line-height:1; font-weight:600; font-size:medium; color:#768CB0;height: 34px;"><?php echo $data_ds_name[$i]?> Footprint</p>
                                <!-- displaying the emission of data source -->
                                <p style="line-height:1; display :inline-block;font-weight:600;font-size: 23px;"><?php echo number_format(($data_ds_value[$i] * 1000), 0, '.', ',' )?></p>
                                <p style="line-height:1;display :inline-block;font-weight:600; font-size:medium; margin-left:5%; color:#768CB0">kgCO<sub>2</sub>e</p>

                                </div>
                                <div class="col-md-4" >
                                <!-- displaying the image of data source -->
                                <img src="media/<?php echo $data_ds_icon[$i]?>.png" style="max-height :72px;"  alt="">
                                </div>
                                </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                             </div>
                             </div>



                            <p style="line-height: 2; font-size:17px; text-align:center"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            a. Total Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> Project Emissions by Data source


                            </p>
                           <?php
                                    if(count($data_ds_name) > 7)
                                    {
                           ?>
                            <div class="html2pdf__page-break"></div>
                            <?php }else{ ?>
                                <br>

                                <?php } ?>
                         

                            <div class="row" >
                                <div class="col-md-10" style="margin:auto;">
                                  
                             
    <div class="card" style="height: 420px;">
    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Scope</h5>
        <div class="card-body">
            <!-- <p style="font-size: medium; font-weight: 600; line-height: 0.5; color: #76828F">Combined Emission</p> -->
            <canvas id="emissionPieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <!-- <p style="font-size: x-large; font-weight: 600; color: blueviolet; display: inline-block; margin-left: 0%; color: #2FE52F">
                <?php
                    $combinedEmission = $scope_1_emission + $scope_2_emission + $scope_3_emission;

                    // echo number_format(round($scope_1_emission));
                    // echo number_format(round($scope_2_emission));
                    // echo number_format(round($scope_3_emission));
                    
                    echo number_format(round($combinedEmission), 0, '.', ',');
                  
                ?> -->
            </p>
        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
    // Chart data
    var scope1Emission = <?php echo $scope_1_emission ?>;
    var scope2Emission = <?php echo $scope_2_emission ?>;
    var scope3Emission = <?php echo $scope_3_emission + $scope_3emission  ?>;

    var combinedEmission = scope1Emission + scope2Emission + scope3Emission;
    

    
    var ctx = document.getElementById('emissionPieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Scope 1', 'Scope 2', 'Scope 3'],
            datasets: [{
                data: [scope1Emission, scope2Emission, scope3Emission],
                backgroundColor: ['#74923C', '#089C08', '#D4E18F','#093908','#9EAB78','#00A86B','#D0F0BF','#01796F','#043927','#679267','#39FF14',
                                '#008080','#004953','#004953','#4F7942','#4F7942']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    
</script>
                                    
                            </div>
                           

                            </div>
                    


                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                           
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                        
                    
                    
                            <div class="card-body" >

                    <!-- data source subcategory with emission value here -->
                    <p style="line-height: 2; font-size:17px; text-align:center"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >
                            b. Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> Project Emissions Breakdown by Scope.


                            </p>

                             <!--row-->
                             <div class="row" style="margin-top:20px">

<div class="col-md-12">
    <div class="card">
    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Items Category</h5>


    <?php
  

// echo $generate_pro_id;


$sql_chart = "SELECT ic.item_category_name, 
SUM(ip.add_Item_to_project_item_quantity * it.item_emission_factor * COALESCE(NULLIF(ip.add_Item_to_project_item_quantity2, 0), 1)) as actual_emission, 
SUM(ip.add_Item_to_project_item_quantity * it.ideal_emission_factor * COALESCE(NULLIF(ip.add_Item_to_project_item_quantity2, 0), 1)) as ideal_emission
FROM project_master as pm
JOIN add_item_to_project as ip ON pm.project_master_id = ip.add_Item_to_project_assign_id
JOIN item as it ON ip.add_Item_to_project_item_id = it.item_id
JOIN item_category as ic ON ic.item_category_id = it.item_category_id
WHERE pm.project_master_id = $generate_pro_id
GROUP BY ic.item_category_name;
";

$result_chart = mysqli_query($conn, $sql_chart);

$item_emission = array();
while ($row_chart = mysqli_fetch_assoc($result_chart)) {
$item_emission[] = $row_chart;
}
// print_r($item_emission);
?>
<!-- CSS only -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-G8sXFKRXLrEVA7voWy2jnx3+1a6lbpD9J/0L2rP9gXQ8Ammag2iSS3uPKFOJwDdQ" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Q7K1R/08wWhz3YO3etSf5Rb6oIvK8fZwU4Ls5AXn4gH0u0I5rNLC3K6DZpWs+II/" crossorigin="anonymous"></script>

<div class="card-body">
<canvas id="myChart" style="width: 80%; min-height: 250px; max-height: 400px;"></canvas>
</div>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+Ch6nMTB96lzH/JvpU3Bwe1iPMumZR3dP4yf5zQ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" ></script>


                        <script>
                        $(document).ready(function () {
                        var ctx = document.getElementById("myChart").getContext("2d");

                        var chartData = <?php echo json_encode($item_emission); ?>; // JavaScript array with dynamic data

                        var labels = chartData.map(function (item) {
                        return item.item_category_name;
                        });

                        var emi1Data = chartData.map(function (item) {
                        return item.actual_emission;
                        });

                        var emi2Data = chartData.map(function (item) {
                        return item.ideal_emission;
                        });

                        var myChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                        labels: labels,
                        datasets: [{
                        label: "Emission Actual",
                        backgroundColor: "#74923C",
                        data: emi1Data
                        }, {
                        label: "Emission Ideal",
                        backgroundColor: "#089C08",
                        data: emi2Data
                        }]
                        },
                        options: {
                        scales: {
                        y: {
                        display: true,
                        title: {
                        display: true,
                        text: "Emission"
                        }
                        }
                        },
                        title: {
                        display: true,
                        text: "Emission Comparison by Item Category"
                        },
                        legend: {
                        display: true,
                        position: "bottom"
                        },
                        tooltips: {
                        callbacks: {
                        label: function (tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || "";
                        if (label) {
                        label += ": ";
                        }
                        label += data.labels[tooltipItem.index] + " - " + tooltipItem.yLabel;
                        return label;
                        }
                        }
                        }
                        }
                        });

                        });

</script>


        </div>
    </div>
</div>
<br>
<br>
<p style="line-height: 1.1; font-size:17px;text-align: center;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>> c. Alpha-Nero/<span style="color: black; font-size:17px;"><?php echo $project_description?> </span> Emissions by Raw material category</p>
<div class="div5">
                            <h5 style="line-height: 2;font-weight:bold;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            4. Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> GHG Inventory Development Approach
                            </h5>
                    

                            <p style="line-height: 1.1; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>><i>The report includes scope 1 and 2 emissions from Alpha-Nero’s vehicles and offices 
    in the following locations:</i></p>
                           
                            <p style="line-height: 1.1; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Dubai, United Arab Eremites</p>
                            <ul >
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.1; font-size:17px;"> C07 warehouse, Dubai, UAE</li>
                                    </ul>
                                      <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->

                                    <!-- <div class="card" style=" margin-top:30px"> -->

                                    <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>><i>a. Boundary Conditions, Inclusions & Exclusions</i></p>
                            <p style="line-height: 1.3; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            The basis for reporting resource consumption and emissions data from Alpha-Nero’s 
    partially owned or controlled assets is based on a Control Approach: operational 
    control criterion.
                            </p>     
                            <p style="line-height: 1.3; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            An organization has operational control over a facility if the organization (or one of 
    its subsidiaries) has the full authority to introduce and implement its operating 
    policies (e.g. operating schedule, design, technologies, etc.). For Alpha-Nero, this 
    includes all spaces, including offices and warehouses in which the organization 
    operates.
                            </p>     
                            <p style="line-height: 1.3; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            In addition to scope 1 and scope 2 emissions from Alpha-Nero’s vehicles, office and 
    warehouse locations, development of the Alpha-Nero/<span style="color: black;font-size:17px;"><?php echo $project_description?> </span> project GHG 
    Inventory included an emissions screen of all 15 scope 3 categories. The results of 
    this screen, in conjunction with conversations with Alpha-Nero, identified the
                            </p>          
                        
                    
                <!-- </div> -->
                    
                    
                      
                
                    
                    
                            <div class="card-body" >


                            <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>following scope 3 categories that are applicable to the project and were included in 
    the Inventory:</p>      <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Scope 3 Categories</p>
                            <ul>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">Business Travel (category 6)</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">Employee Commuting (category 7)</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">Waste generated in Operations (category 5)</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">Products/Purchased Goods and Services (category 1)</li>
                                        <li <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="margin-left:2% ;  line-height: 1.2; font-size:17px;">Shipping/Transportation & Distribution (category 9 & 4)</li>
                                    </ul>

                    
                                    <p style="line-height: 1.7; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>><i>Exclusions:</i></p>

                                    <p style="line-height: 1.2; font-size:17px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Emissions from other scope 3 services beyond those listed above (e.g. water) were 
    deemed not to be material and while they may be included in the inventory
    calculations the were excluded from this report and the related calculations were not 
    discussed in detail. For more guidance on materiality see chapter 10 of the GHG 
    protocol here: <a href="https://ghgprotocol.org/sites/default/files/standards/ghg-protocol-revised.pdf" style="color:#0000FF ;"> https://ghgprotocol.org/sites/default/files/standards/ghg-protocol-revised.pdf</a> </p>
                    <!-- </div> -->
                    </div>
                    </div>
                    <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!-- <div class="row" style="margin-top:25px;"> -->

                            
                            <div class="card-body">
                            <h5 style="line-height: 2;font-weight:bold;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                            5. Calculations
                            </h5>
                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%; background-color:#b28250; color:white">Emissions Scope</th>
                                            <th style="width: 50%; background-color:#b28250;color:white">Scope 1</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Vehicle activity data values reported by 
Alpha-Nero via GHG Inventory Data 
Request collection template. Included 
exact vehicle type and milage 
information.</td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Key Assumptions </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Total emissions related to vehicles were 
distributed on a per project basis using 
timeframe of the project size of project
and the number of concurrent projects.</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Emission Factor Sources </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>DEFRA Emissions Factors (June 2023)</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Distance/Mileage to CO<sub>2</sub>e using vehicle 
type/fuel type emissions factors.</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-Nero
sustainability platform. </td>
                    
                        </tr>
                    </tbody>
                
                    </table>

                    </div>

                    <div class="div6">
                    <p style="line-height: 2; font-size:17px; text-align:center;margin-top: -27px;"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >
                    <i>a. Emissions Methodology by Source: Scope 1 - Vehicles</i>

                            </p>
                
                            <div class="card-body" style="margin-top: -30px;">

                            <table id="example1" class="table table-bordered table-striped" >
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#b28250; color:white"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Emissions Scope</th>
                                            <th style="width: 50%;background-color:#b28250; color:white"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Scope 2</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Electricity usage values reported by 
Alpha-Nero via GHG Inventory Data 
Request collection template. Included 
exact KWH usage.</td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Key Assumptions </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Total emissions related to vehicles were 
distributed on a per project basis using 
timeframe of the project size of project 
and the number of concurrent projects.</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Emission Factor Sources </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >Dubai Electricity and Water Authority
    </td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>KWH to CO<sub>2</sub>e using location based 
emissions factors accounting for local 
electricity grid mix</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-Nero
sustainability platform.</td>
                    
                        </tr>
                    </tbody>
                
                    </table>

                    </div>


                    <p style="line-height: 2; font-size:17px; text-align:center"   <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                    <i>b. Emissions Methodology by Source: Scope 2 - Electricity Usage</i>
                            </p>

 <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->



                            <table id="example1" class="table table-bordered table-striped" >
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#b28250; color:white">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#b28250; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Employee commute patterns reported by 
Alpha-Nero via GHG Inventory Data 
Request collection template. </td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Key Assumptions </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Assumed that the average daily 
distance travelled was 4km by bus and 
20km by minibus (based on employee 
commute patterns provided by Alpha-Nero). Employee commute survey 
was also used.</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Emission Factor Sources </td>
                                <td   <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>DEFRA 2023 Emissions Factors (June
2023)

    </td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Distance per KM to CO<sub>2</sub>e coefficient was 
utilized for the various transport modes
    </td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-Nero
sustainability platform.</td>
                    
                        </tr>
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:17px; text-align:center"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >
                    <i>c. Emissions Methodology by Source: Scope 3 - Employee Commute</i>

                            </p>

                            </div>
                    




                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                
                    
                            <div class="card-body"style="margin-top: -38px;" >


                            <table id="example1" class="table table-bordered table-striped" >
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#b28250; color:white">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#b28250; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td   <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Business Travel reported by Alpha-Nero
via GHG Inventory Data Request 
collection template</td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Emission Factor Sources</td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>EPA 2023 Emissions Factors (June
2023)</td>
                    
                        </tr>
                        <tr>
                                
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Distance per flight type (haul) and class 
coefficient utilized
    </td>
                    
                        </tr>
                        <tr>
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-nero
sustainability platform. </td>
                    
                        </tr>
                        
                    
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:17px; text-align:center"   <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>
                    <i>d. Emissions Methodology by Source: Scope 3 – Business Travel</i>
                            </p>





                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 10px;">
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%;background-color:#b28250; color:white">Emissions Scope</th>
                                            <th style="width: 50%;background-color:#b28250; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                    <tr>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Shipping activity data including distance,
transport mode and weight of shipments 
reported by Alpha-Nero via GHG 
Inventory Data Request collection 
template.</td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Emission Factor Sources</td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>EPA & DEFRA Emissions Factors
(June 2023) for Freighting Goods</td>
                    
                        </tr>
                        <tr>
                                
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Emissions calculated using
distance/weight per transport mode
    </td>
                    
                        </tr>
                        <tr>
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-Nero
sustainability platform. </td>
                    
                        </tr>
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:17px; text-align:center"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >
                
                    <i>e. Emissions Methodology by Source: Scope 3 - Shipping</i>


                            </p>

                            </div>
                    


                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                


<div class="div7">
                              <div class="card-body" style="margin-top: -38px;">


                            <table id="example1" class="table table-bordered table-striped" >
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%; background-color:#b28250; color:white">Emissions Scope</th>
                                            <th style="width: 50%; background-color:#b28250; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                        <tr>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>List of products, their material make up 
and weight per product reported by 
Alpha-Nero
via GHG Inventory Data Request 
collection template.
</td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Key Assumptions</td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Calculations cover the cradle-to-gate and 
are self-declared.</td>
                    
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Emission Factor Sources</td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Utilizes a range of internationally 
published emission factors as published 
in the Alpha-Nero documentation.</td>
                    
                        </tr>
                        <tr>
                                
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>> Emissions are calculated on average 
emissions factors for materials, energy 
consumption and transportation based on 
product category, total weight of product, 
the weight of unique materials used in 
each product (or packaging) part, location 
and distances between supplier, 
manufacturing facility and distribution 
center and modes of transport between 
each as well as the source of energy used 
in production.</td>
                    
                        </tr>
                        <tr>
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-Nero
sustainability platform. </td>
                    
                        </tr>
                        
                    
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:17px; text-align:center"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >
                    <i>f. Emissions Methodology by Source: Scope 3 - Products</i>

                            </p>


                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <div class="html2pdf__page-break"></div>
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                



                            <table id="example1" class="table table-bordered table-striped" >
                    <thead>

                    
                    <tr>
                                            <th style="width: 50%; background-color:#b28250; color:white">Emissions Scope</th>
                                            <th style="width: 50%; background-color:#b28250; color:white">Scope 3</th>
                                        
                    </tr>
                    
                    </form>
                    </thead>
                    <tbody>
                    <tr>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Activity Data </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>A percentage of product waste and related 
waste weight was reported by Alpha-Nero
via GHG Inventory Data Request 
collection template.</td>
                        </tr>
                        <tr>
                                
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;">Emission Factor Sources</td>
                                <td   <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>IPCC Emissions Factors (Feb 2023)
for Waste</td>
                    
                        </tr>
                        <tr>
                                
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Calculation Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Weight per waste type emissions factor 
coefficient.
    </td>
                    
                        </tr>
                        <tr>
                        <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> style="font-weight:bold;"> Additional Details </td>
                                <td  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?>>Detailed calculations and a full list of data 
sources/activity data available, 
documented and uploaded to Alpha-Nero
sustainability platform</td>
                    
                        </tr>
                        
                    </tbody>
                
                    </table>




                    <p style="line-height: 2; font-size:17px; text-align:center"  <?php echo ($facility_id===0) ? 'contenteditable="true"' : '' ?> >
                    <i>g. Emissions Methodology by Source: Scope 3 - Waste</i>


                            </p>

                            </div>
                            </div>

                           <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 4/////////////////////////////////////////////////////////////////////////// -->
                        
                            <!-- <div class="html2pdf__page-break"></div> -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                            <!--////////////////////////////////////////////// page 5/////////////////////////////////////////////////////////////////////////// -->
                


                        </div>
                        
                        </div>
                        

                        </div> <!-- container -->
                       
                    </div> <!-- content -->
                    <div class="card">
                            <div class="card-body">
                                <!-- Add a download button -->
                                <button id="downloadButton" class="btn btn-success" style="margin-left:20px ;">Download PDF</button>


                            </div>
                        </div>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.min.js" ></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.plugin.html.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<!-- Chart.js CDN link -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script> 
<!-- jsPDF CDN link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
      

document.getElementById("downloadButton").addEventListener("click", function () {
            var element = document.getElementById("element");
            var scale = 2; // Adjust scale for higher resolution
           
            // Use html2canvas to capture the content of the div as an image
            html2canvas(element, {
                scale: scale,
                scrollY: 0,
                windowWidth: document.body.scrollWidth,
                windowHeight: document.body.scrollHeight,
                x: 0,
                y: 0
            }).then(function(canvas) {
                var imgData = canvas.toDataURL('image/jpeg');
                var imgWidth = canvas.width / scale;
                var imgHeight = canvas.height / scale;
                var pdf = new jsPDF('p', 'pt', [imgWidth, imgHeight]);
                var project_name = '<?php echo $project_name . "_Project_report"; ?>';
                // Add the image to the PDF
                pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);
                
                // Save the PDF
                pdf.save(project_name);
            });
        });
        document.getElementById("downloadButton2").addEventListener("click", function () {
            var element = document.getElementById("element");
            var scale = 2; // Adjust scale for higher resolution
           
            // Use html2canvas to capture the content of the div as an image
            html2canvas(element, {
                scale: scale,
                scrollY: 0,
                windowWidth: document.body.scrollWidth,
                windowHeight: document.body.scrollHeight,
                x: 0,
                y: 0
            }).then(function(canvas) {
                var imgData = canvas.toDataURL('image/jpeg');
                var imgWidth = canvas.width / scale;
                var imgHeight = canvas.height / scale;
                var pdf = new jsPDF('p', 'pt', [imgWidth, imgHeight]);
                var project_name = '<?php echo $project_name . "_Project_report"; ?>';
                // Add the image to the PDF
                pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);
                
                // Save the PDF
                pdf.save(project_name);
            });
        });
    </script>

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
