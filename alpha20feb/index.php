
<?php
include 'auth.php'; 
error_reporting(0);
?>

<?php
//  require 'includes/header_start.php'; 
 ?>
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        
        <style>
         
        </style>
        <!-- <link rel="preload" href="plugins/morris/Nexa-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
        <link rel="preload" href="plugins/morris/Nexa-Regular.ttf" as="font" type="font/ttf" crossorigin> -->

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<!-- Include jsPDF Canvas plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.plugin.canvas.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <?php include 'database.php';

?>




<?php 
              
                    $facility_id_login=$_SESSION['auth_user']['facility_id'];
                    $project_user_id=$_SESSION['auth_user']['project_user_id'];
                    if($facility_id_login===0)
                    {
                              $sql_projec_master="SELECT * FROM project_master ORDER BY project_name ASC";
                              $result_pm=mysqli_query($conn, $sql_projec_master);

                              $pro_master=array();
                              while($row_pm=mysqli_fetch_assoc($result_pm)){
                              $pro_master[]=$row_pm;

                           }
                        }elseif($facility_id_login===1){

                            $sql_projec_master="SELECT * from assign_project as ap join project_master as pm on pm.project_master_id=ap.project_id where ap.user_id='$project_user_id' ORDER BY pm.project_name ASC;";
                              $result_pm=mysqli_query($conn, $sql_projec_master);

                              $pro_master=array();
                              while($row_pm=mysqli_fetch_assoc($result_pm)){
                              $pro_master[]=$row_pm;

                           }
                            

                        }
                     
                        $default_pro_id = 0;
                        if ($facility_id_login === 1) {
                            $sql_projec_master2 = "SELECT * FROM assign_project as ap 
                                                   JOIN project_master as pm ON pm.project_master_id = ap.project_id 
                                                   WHERE ap.user_id='$project_user_id' 
                                                   ORDER BY pm.project_master_id ASC 
                                                   LIMIT 1;";
                            $result_pm2 = mysqli_query($conn, $sql_projec_master2);
                            $data_pi = mysqli_fetch_array($result_pm2);
                            $default_pro_id = $data_pi['project_master_id'];
                        } elseif ($facility_id_login === 0) {
                            $sql_projec_master2 = "SELECT * FROM project_master 
                                                   ORDER BY project_master_id ASC 
                                                   LIMIT 1;";
                            $result_pm2 = mysqli_query($conn, $sql_projec_master2);
                            $data_pi = mysqli_fetch_array($result_pm2);
                            $default_pro_id = $data_pi['project_master_id'];
                        }
                        
                        // echo "ok";
//function for over ride the $year varible through default year and select year
                            function generate_pro_id($default_pro_id){
                               
                                

                                static $pro_id="";
                                $pro_id=$default_pro_id;
                                
                            //fetching select year input
                            if(isset($_POST['submit_pro_id'])){
                            $pro_id=$_POST['project_id'];


                            }
                                return $pro_id;
                            }


                            //storing function return in $year_generated
                            $generate_pro_id= generate_pro_id($default_pro_id);
                                                        

                            //facility id function
                            function generate_facility_id($default_pro_id){

                                static $facility_id=0;

                              
                                $facility_id =$default_pro_id;


                                if(isset($_POST['submit_pro_id'])){
                                if(!"0"==$_POST['project_id']){
                                
                                $facility_id=$_POST['project_id'];
                                }else{
                                    $facility_id =0;
                                }
                                }

                                return $facility_id;
                                }
                                //storing function return in $year_generated
                               $facility_id= generate_facility_id($default_pro_id);


                            ?>


<?php
//  require 'includes/header_end.php'; 
   require 'header.php';
 ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                    <div class="card" style="margin-bottom:20px">
                            <div class="card-body">
                                <div class="row" >
                                <div class="col-md-10" style="margin:auto;text-align: center;">
                            
                            <form action="" method="POST" id="projectForm">
                            <label style="font-size:medium; font-style:bold;font-weight:20px;" >Select Project Name 
                           
                            </label>
                            <select class="form-control select2 col-md-5" name="project_id" data-dropdown-css-class="select2" style="display:inline-block; margin-left:10px" required>
    <option value="" disabled>Select Project Name</option>

    <?php 
                                        //Foreach loop for providing datasource fields
                                            foreach($pro_master as $value){
                                                
                                                if($value['project_master_id']===$facility_id){
                                ?>
                                            
                                            <option value="<?php echo $value['project_master_id']; ?>" selected><?php print_r( $value['project_name']);?></option>
                                            
                                <?php          
                                    }  else{ ?>
                                        <option value="<?php echo $value['project_master_id']; ?>" ><?php print_r( $value['project_name']);?></option>
                                <?php

                                    }   
                                } 
                                ?>
</select>

                            <input type="submit" class="btn-info btn" name ="submit_pro_id" value="Submit" style="display: inline-block;  margin-left: 10px; margin-top:-6px;text-align:center;  padding-top: 8px;">   

                            </form>
                          

                                </div>
                                <div class="col-md-2" style="text-align: end;margin-top: -2px;">
                               
                          <?php
                                    if(!empty($generate_pro_id))
                                    {
                                        if($facility_id_login===1)
                                        {
                                            $url_report="editable_template.php?id=".$generate_pro_id;
                                ?>
                                            <a href="<?php echo $url_report; ?>" id="report_download"><label style="cursor:pointer;" for=""><img  src="./assets/images/report_download2.png" title="Download Project Report" alt="" style="width: 40px;"></label></a>
                                            <?php } ?>&nbsp;&nbsp;&nbsp;&nbsp; <a style="cursor: pointer;" id="cmd"><img  src="./assets/images/index_download_icon2.png" title="Download Dashboard" alt="" style="width: 40px;"></a>
                                          <?php } ?>
                          </div>
                                </div>
                               
                            </div>
                          
                         </div>



                    <?php


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
                    // echo $string_sd;

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
    $emission_dss=$data_dss*$fraction;

    //echo "emission value =>".$emission_dss;

    //total data emission value of every day add on
    $data_consumption_project+= $emission_dss;
    

    


    $emission_dss_red=$data_dss_reduction*$fraction;

    //echo "emission value =>".$emission_dss;

    //total data emission value of every day add on
   $data_reduction_project+= $emission_dss_red;



//     $sql_reduction="SELECT *, SUM(c.consumption_value *ef.emission_factors_value * CASE WHEN c.consumption_value2 = 0 THEN 1 ELSE c.consumption_value2 END) as emission_value FROM tbl_month_consumption_sub as c
//     join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
//     join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
//     join data_source as ds on dss.data_source_id = ds.data_source_id
//     where c.month in ('$month_name') and c.year in ($year_name) and ef.year in ($year_name) and dss.is_reduction='yes';";

//     // echo $sql_reduction;
//     $result_red=mysqli_query($conn, $sql_reduction);
//     // $reduction_emission=array();
//    $fetch_red=mysqli_fetch_assoc( $result_red );
//     // echo $fetch_red['emission_value'];
//     $reduction_emission+=$fetch_red['emission_value'];
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
    

   
                    ?>

                       

                    <!--card-->
                    <div class="card" id="pdfdownload">
                        <!--card-body-->
                        <div class="card-body">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="margin-bottom:20px ;">
                                    <img src="media/Carbon Footprint.png" alt="">
                                    <div class="card-body" style="position: absolute; top: 48%; left: 52%;  transform: translate(-50%, -50%); margin-left:0%">
                                    <p style="font-size: small;font-weight:700; text-align:center; color:black; line-height:0"><?php echo $project_description?></p>
                                     <p style="font-size: x-large;font-weight:700; text-align:center; color:black; line-height:0;margin-top: 26px;"><?php echo $project_name?></p>
                                     <p style="text-align:center; margin-left:-2% ;font-size: 23px;display:inline-block">
                                     <?php echo 'Total Emission - '.number_format(round($total_emission_project), 0, '.', ',' ) ?>
                                     </p>
                                     <p style="display:inline-block; font-size:large; margin-left:2% ">tCO<sub>2</sub>e</p>
                                    
                                </div>
                               
                            </div>
                            
                            </div>
                        </div>
                    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="height: 420px;">
                                    <h5 class="card-header" style="font-size: medium; font-weight:600; font-style:bold;  text-align:left;">Project Details</h5>
                                    
                                        <div class="card-body">
                                        

                                        <div class="row" >
                                        <div class="card col-md-12" style="height: 75px;">
                                        <div class="card-body">    
                                        <p style="font-size: medium;font-weight:500;line-height: 0.2; text-align:left;  color:#76828F;">Project Start date </p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo $string_sd?> </p>
                                        </div>
                                          
                                            </div>
                                            </div>

                                    <div class="row" style="margin-top:15px ;">
                                        <div class="card col-md-12" style="height: 75px;">
                                            <div class="card-body"> 
                                        <p  style="font-size: medium;font-weight:500; line-height: 0.2; text-align:left; color:#76828F;">Project End Date </p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo $string_ed?> </p>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="row" style="margin-top:15px ;">
                                        <div class="card col-md-12" style="height: 75px;">
                                            <div class="card-body">  
                                        <p  style="font-size: medium;font-weight:500;line-height: 0.2; text-align:left;  color:#76828F;">Emission Reducing</p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo number_format(round($reduction_emission * 1000), 0, '.', ',' )?> kgCO<sub>2</sub>e </p>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="row" style="margin-top:15px ;">
                                        <div class="card col-md-12" style="height: 75px;">
                                            <div class="card-body">  
                                        <p  style="font-size: medium;font-weight:500;line-height: 0.2; text-align:left;  color:#76828F;">Waste LandFill </p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo number_format(round($emission_landfill * 1000), 0, '.', ',' )?> kgCO<sub>2</sub>e</p>
                                        </div>
                                        </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <!--col-md-4-->

                                <div class="col-md-4" >
<!-- Chart.js 3.x -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                    <div class="card" style="height:420px">
                                    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Data Source</h5>

                                      <div class="card-body" >
                                     
                                        
                                        <!-- displaying donut chart -->
                                        <canvas id="donutChart" style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>

                                      </div>
                                    </div>
                                </div>
                                 <script>
                                
                                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                                var donutData        = {
                                labels: [<?php echo $data_name;?>
                                    
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
                                    
                                    plugins: {
                                            legend: {
                                                display: true,
                                                labels: {
                                                    textAlign: 'right',
                                                    
                                                },
                                                position: "bottom",
                                                
                                                
                                            }
                                        },
                                       

                                };

                                //Create pie or douhnut chart
                                // You can switch between pie and douhnut using the method below.
                                new Chart(donutChartCanvas, {
                                type: 'pie',
                                data: donutData,
                                options: donutOptions
                                })
                                    //donut chart ends
                                
                            
                                </script>
                                <!--./col-md-6-->
                                <!--col-md-6-->
                                <div class="col-md-4">
    <div class="card" style="height: 420px;">
    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Scope</h5>
        <div class="card-body">
            <!-- <p style="font-size: medium; font-weight: 600; line-height: 0.5; color: #76828F">Combined Emission</p> -->
            <canvas id="emissionPieChart" style="min-height: 240px; height: 240px; max-height: 240px; max-width: 100%;"></canvas>
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
            plugins: {
                                            legend: {
                                                display: true,
                                                labels: {
                                                    fontSize: 8
                                                },
                                                position: "bottom",
                                            }
                                        }
          
        }
    });

    
</script>

                                <!--./col-md-6-->
                               
                            </div>
                            <!--./row-->
                           

                                                        
                          


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

<div class="modal fade" id="emissionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;margin-left: 72px;">
        <div class="modal-content" style="width: 100.5%;margin: auto;">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
            </div>
            <div class="modal-body">
                <canvas id="modalChart" style="width: 100%; height: 120px;"></canvas>
            </div>
        </div>
    </div>
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

      
var myChartModal;

// Event listener for clicking on a bar in the chart
ctx.canvas.addEventListener('click', function (evt) {
    // ctx.canvas.style.cursor = "pointer";
    var activePoint = myChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true });
    if (activePoint.length) {
        var datasetIndex = activePoint[0].datasetIndex;
        var dataIndex = activePoint[0].index;
        var datasetLabel = myChart.data.datasets[datasetIndex].label;
        var dataLabel = myChart.data.labels[dataIndex];
        var dataValue = myChart.data.datasets[datasetIndex].data[dataIndex];
        $("#exampleModalLongTitle").text(dataLabel);
        $('#emissionmodal').modal('show');

        // AJAX request to fetch data
        var proid = "<?php echo $generate_pro_id ?>";
        $.ajax({
            url: "index_ajax.php",
            type: "POST",
            data: { itemname: dataLabel, emissiontype: datasetLabel, proid: proid },
            success: function (data) {
                // Parse the JSON data received from the server
                var chartData = JSON.parse(data);

                // Destroy the previous chart instance if it exists
                if (myChartModal) {
                    myChartModal.destroy();
                }

                var ctxModal = document.getElementById("modalChart").getContext("2d");
myChartModal = new Chart(ctxModal, {
    type: "bar",
    data: {
        labels: chartData.map(function (item) {
            return item.item_code;
        }),
        datasets: [
            {
                label: "Emission Actual",
                backgroundColor: "#74923C",
                data: chartData.map(function (item) {
                    return item.actual_emission;
                })
            },
            {
                label: "Emission Ideal",
                backgroundColor: "#089C08",
                data: chartData.map(function (item) {
                    return item.ideal_emission;
                })
            }
        ]
    },
    options: {
        plugins: {
            datalabels: {
                display: false // Initially hide the data labels
            }
        },
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
            enabled: true // Disable default tooltips
        }
    }
});




            }
        });
    }
});

// Event listener for when the modal is hidden
$('#emissionmodal').on('hidden.bs.modal', function () {
    // Destroy the chart instance when the modal is hidden
    if (myChartModal) {
        myChartModal.destroy();
    }
});



    });

    // window.location.href = "test2.php?dataset=" + encodeURIComponent(datasetLabel) + '&label=' + encodeURIComponent(dataLabel)+ '&value=' + encodeURIComponent(dataValue);
</script>


                                        </div>
                                    </div>
                                </div>

                               
                                
                            </div>
                             <!--./row-->
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
                                <p style="line-height:1.2; font-weight:600; font-size:medium; color:#768CB0"><?php echo $data_ds_name[$i]?> Footprint</p>
                                <!-- displaying the emission of data source -->
                                <p style="line-height:1; display :inline-block;font-weight:600;font-size: 23px;"><?php echo number_format(($data_ds_value[$i] * 1000), 0, '.', ',' )?></p>
                                <p style="line-height:1;display :inline-block;font-weight:600; font-size:medium; margin-left:5%; color:#768CB0">kgCO<sub>2</sub>e</p>

                                </div>
                                <div class="col-md-4" >
                                <!-- displaying the image of data source -->
                                <?php echo $data_ds_icon['data_source_icon_name'][$i];?>
                                <img src="media/<?php echo $data_ds_icon[$i];?>.png" style="max-height :72px;"  alt="">

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
                        <!--./card-body-->
                    </div>
                    <!--./card-->

                    <div id="editor"></div>

                    <?php


                    //if condiition end here which check the project id
                                }
                                else{ ?>

<div class="card" id="pdfdownload">
                        <!--card-body-->
                        <div class="card-body">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="margin-bottom:20px ;">
                                    <img src="media/Carbon Footprint.png" alt="">
                                    <div class="card-body" style="position: absolute; top: 48%; left: 52%;  transform: translate(-50%, -50%); margin-left:0%">
                                    <p style="font-size: small;font-weight:700; text-align:center; color:black; line-height:0"><?php echo $project_description?></p>
                                     <p style="font-size: x-large;font-weight:700; text-align:center; color:black; line-height:0;margin-top: 26px;"><?php echo $project_name?></p>
                                     <p style="text-align:center; margin-left:-2% ;font-size: 23px;display:inline-block">
                                     <?php echo 'Total Emission - '.number_format(round($total_emission_project), 0, '.', ',' ) ?>
                                     </p>
                                     <p style="display:inline-block; font-size:large; margin-left:2% ">tCO<sub>2</sub>e</p>
                                    
                                </div>
                               
                            </div>
                            
                            </div>
                        </div>
                    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="height: 420px;">
                                    <h5 class="card-header" style="font-size: medium; font-weight:600; font-style:bold;  text-align:left;">Project Details</h5>
                                    
                                        <div class="card-body">
                                        

                                        <div class="row" >
                                        <div class="card col-md-12" style="height: 75px;">
                                        <div class="card-body">    
                                        <p style="font-size: medium;font-weight:500;line-height: 0.2; text-align:left;color: #768CB0;">Project Start date </p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo $string_sd?> </p>
                                        </div>
                                          
                                            </div>
                                            </div>

                                    <div class="row" style="margin-top:15px ;">
                                        <div class="card col-md-12" style="height: 75px;">
                                            <div class="card-body"> 
                                        <p  style="font-size: medium;font-weight:500; line-height: 0.2; text-align:left;color: #768CB0;">Project End Date </p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo $string_ed?> </p>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="row" style="margin-top:15px ;">
                                        <div class="card col-md-12" style="height: 75px;">
                                            <div class="card-body">  
                                        <p  style="font-size: medium;font-weight:500;line-height: 0.2; text-align:left;color: #768CB0;">Emission Reducing</p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo number_format(round($reduction_emission * 1000), 0, '.', ',' )?> kgCO<sub>2</sub>e </p>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="row" style="margin-top:15px ;">
                                        <div class="card col-md-12" style="height: 75px;">
                                            <div class="card-body">  
                                        <p  style="font-size: medium;font-weight:500;line-height: 0.2; text-align:left;color: #768CB0;">Waste LandFill </p>
                                        <p  style="font-size: medium;font-weight:500;color:#1C95B0; text-align:left;"><?php echo number_format(round($emission_landfill * 1000), 0, '.', ',' )?> kgCO<sub>2</sub>e</p>
                                        </div>
                                        </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <!--col-md-4-->

                                <div class="col-md-4" >

                                    <div class="card" style="height:420px">
                                    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Data Source</h5>

                                      <div class="card-body" >
                                     
                                        
                                        <!-- displaying donut chart -->
                                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

                                      </div>
                                    </div>
                                </div>
                                
                                <!--./col-md-6-->
                                <!--col-md-6-->
                                <div class="col-md-4">
    <div class="card" style="height: 420px;">
    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Scope</h5>
        <div class="card-body">
            <!-- <p style="font-size: medium; font-weight: 600; line-height: 0.5; color: #76828F">Combined Emission</p> -->
            <canvas id="emissionPieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
           
            </p>
        </div>
    </div>
</div>


                               
                            </div>
                            <!--./row-->
                           

                                                        
                          


                             <!--row-->
                            <div class="row" style="margin-top:20px">

                                <div class="col-md-12">
                                    <div class="card">
                                    <h5 class="card-header" style="margin-left:0px ;  font-weight:600 ; font-size:medium ">Emission by Items Category</h5>


<div class="card-body">
    <canvas id="myChart" style="width: 80%; min-height: 250px; max-height: 400px;"></canvas>
</div>

<div class="modal fade" id="emissionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;margin-left: 72px;">
        <div class="modal-content" style="width: 100.5%;margin: auto;">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
            </div>
            <div class="modal-body">
                <canvas id="modalChart" style="width: 100%; height: 120px;"></canvas>
            </div>
        </div>
    </div>
</div>



                                        </div>
                                    </div>
                                </div>

                               
                                
                            </div>
                             <!--./row-->
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
                                <p style="line-height:1; font-weight:600; font-size:medium; color:#768CB0"><?php echo $data_ds_name[$i]?> Footprint</p>
                                <!-- displaying the emission of data source -->
                                <p style="line-height:1; display :inline-block;font-weight:600;font-size: 23px;"><?php echo number_format(($data_ds_value[$i] * 1000), 0, '.', ',' )?></p>
                                <p style="line-height:1;display :inline-block;font-weight:600; font-size:medium; margin-left:5%; color:#768CB0">kgCO<sub>2</sub>e</p>

                                </div>
                                <div class="col-md-4" >
                                <!-- displaying the image of data source -->
                                <img src="media/<?php echo $data_ds_icon[$i]?>" style="max: height 65px;"  alt="">

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

                                    <!-- echo "<h4> Note:<br></br>Add Data Source <br> Add Data Source Group <br> Add Data Source Subcategory <br> Add Emission Factors <br> Add Consumption <br> Add Item Category <br> Add Item Unit <br> Add Item <br> Add Location <br> Create Project</h4>"; -->
                               <?php }

                    ?>
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

<!-- jsPDF CDN link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<div id="editor"></div>


<!-- <script>

document.getElementById("cmd").addEventListener("click", function () {
    var element = document.getElementById("pdfdownload");
    var project_name = '<?php echo $project_name.'_Dashboard'; ?>';  // Add quotation marks

    // Adjust scale and set options for better quality
    var options = {
        // margin: 5,
        filename: project_name,
        image: { type: 'jpeg', quality: 5.0 },  // Adjust quality as needed
        html2canvas: { scale: 4 }  // Adjust scale as needed
    };

    html2pdf(element, options);
});
</script> -->
<script>
//     function downloadPDF() {
//     // Get the container element for the bar graph
//     var element = document.getElementById('pdfdownload');

//     // Use HTML2Canvas to capture the screenshot of the container element
//     html2canvas(element, { 
//         scrollX: 10, 
//         scrollY: 10, 
//         useCORS: true,
//         scale: 5, // Set the scale to 2 to increase the DPI (adjust as needed)
//         logging: true // Optional: Enable logging for debugging purposes
//     }).then(function(canvas) {
//         // Convert the canvas to a data URL
//         var imgData = canvas.toDataURL('image/jpeg');

//         // Create a new jsPDF instance
//         var pdf = new jsPDF();
//         var imgWidth = pdf.internal.pageSize.getWidth();
//         var imgHeight = pdf.internal.pageSize.getHeight();

//         // Check if the canvas height is greater than zero
//         if (canvas.height > 0) {
            
//             var aspectRatio = element.offsetWidth / element.offsetHeight;

//             pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);
//         }

//         // Add the image to the PDF
//         pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);
//         var project_name = '<?php echo $project_name . '_Dashboard'; ?>';
//         // Download the PDF
//         pdf.save(project_name + '.pdf');
//     });
// }

// // Add click event listener to the download button
// document.getElementById('cmd').addEventListener('click', downloadPDF);
// ================================================================================


// function downloadPDF() {
//     // Get the container element for the bar graph
//     var element = document.getElementById('pdfdownload');

//     // Use HTML2Canvas to capture the screenshot of the container element
//     html2canvas(element, { 
//         scrollX: 0, // Disable horizontal scrolling
//         scrollY: 0, // Disable vertical scrolling
//         useCORS: true,
//         logging: true // Optional: Enable logging for debugging purposes
//     }).then(function(canvas) {
//         // Convert the canvas to a data URL
//         var imgData = canvas.toDataURL('image/jpeg');

//         // Create a new jsPDF instance
//         var pdf = new jsPDF();
        
//         // Calculate the aspect ratio of the container element
//         var aspectRatio = element.offsetWidth / element.offsetHeight;

//         // Calculate the maximum dimensions for the image based on the aspect ratio
//         var maxWidth = pdf.internal.pageSize.getWidth();
//         var maxHeight = maxWidth / aspectRatio;

//         // Add the image to the PDF
//         pdf.addImage(imgData, 'JPEG', 0, 0, maxWidth, maxHeight);

//         var project_name = '<?php echo $project_name . '_Dashboard'; ?>';
        
//         // Download the PDF
//         pdf.save(project_name + '.pdf');
//     });
// }

// // Add click event listener to the download button
// document.getElementById('cmd').addEventListener('click', downloadPDF);

// ---------------------------------------------------------------------------------------
// function downloadPDF() {
//     // Get the container element for the bar graph
//     var element = document.getElementById('pdfdownload');
    
//     // Calculate the scrollable height and width of the content
//     var scrollHeight = element.scrollHeight;
//     var scrollWidth = element.scrollWidth;

//     // Use HTML2Canvas to capture the screenshot of the container element
//     html2canvas(element, { 
//         scrollX: 0, // Disable horizontal scrolling
//         scrollY: 0, // Disable vertical scrolling
//         useCORS: true,
//         width: scrollWidth, // Set canvas width to match scrollable width of the content
//         height: scrollHeight, // Set canvas height to match scrollable height of the content
//         logging: true // Optional: Enable logging for debugging purposes
//     }).then(function(canvas) {
//         // Convert the canvas to a data URL
//         var imgData = canvas.toDataURL('image/jpeg');

//         // Create a new jsPDF instance
//         var pdf = new jsPDF();
        
//         // Calculate the aspect ratio of the container element
//         var aspectRatio = scrollWidth / scrollHeight ;

//         // Calculate the maximum dimensions for the image based on the aspect ratio
//         var maxWidth = pdf.internal.pageSize.getWidth();
//         var maxHeight = maxWidth / aspectRatio;

//         // Add the image to the PDF with dynamically calculated height
//         pdf.addImage(imgData, 'JPEG', 0, 0, maxWidth , maxHeight - 35);

//         var project_name = '<?php echo $project_name . '_Dashboard'; ?>';
        
//         // Download the PDF
//         pdf.save(project_name + '.pdf');
//     });
// }

// // Add click event listener to the download button
// document.getElementById('cmd').addEventListener('click', downloadPDF);



// ========================================================================================================================


function downloadPDF() {
    // Get the container element for the bar graph
    var element = document.getElementById('pdfdownload');
    
    // Calculate the scrollable height and width of the content
    var scrollHeight = element.scrollHeight;
    var scrollWidth = element.scrollWidth;

    // Use HTML2Canvas to capture the screenshot of the container element
    html2canvas(element, { 
        scrollX: 0, // Disable horizontal scrolling
        scrollY: 0, // Disable vertical scrolling
        useCORS: true,
        width: scrollWidth, // Set canvas width to match scrollable width of the content
        height: scrollHeight, // Set canvas height to match scrollable height of the content
        logging: true // Optional: Enable logging for debugging purposes
    }).then(function(canvas) {
        // Convert the canvas to a data URL
        var imgData = canvas.toDataURL('image/jpeg');

        // Create a new jsPDF instance
        var pdf = new jsPDF();
        
        // Calculate the aspect ratio of the container element
        var aspectRatio = scrollWidth / scrollHeight ;

        // Calculate the maximum dimensions for the image based on the aspect ratio
        var maxWidth = pdf.internal.pageSize.getWidth();
        var maxHeight = maxWidth / aspectRatio;

        // Add the image to the PDF with dynamically calculated height
        pdf.addImage(imgData, 'JPEG', 0, 0, maxWidth , maxHeight);

        var project_name = '<?php echo $project_name . '_Dashboard'; ?>';
        
        // Download the PDF
        pdf.save(project_name + '.pdf');
    });
}

// Add click event listener to the download button
document.getElementById('cmd').addEventListener('click', downloadPDF);




</script>

                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

       


