<?php
include 'auth.php';
// require 'includes/header_start.php';
 ?>

<!--Morris Chart CSS -->
<link rel="stylesheet" href="plugins/morris/morris.css">

<?php
// require 'includes/header_end.php';
require 'header.php';

 ?>
<?php
include 'database.php';

/*
$month='';
$year='';
$date='';

$key=$_GET['key'];
if($key=='0'){
    $month= $_GET['consumption_month'];
    $year= $_GET['consumption_year'];


}else{
    $date= $_GET['consumption_date'];
}

$year_date = date('Y', strtotime($date)); // 'Y' format represents the year in YYYY format

//echo $year_date; 
*/

$month= $_GET['consumption_month'];
$year= $_GET['consumption_year'];

?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                


            <div class="card">
                <div class="card-body">
                <h5 style=" display: inline-block;">Consumption for the Month and Year</h4> &nbsp;<h4 style="color:#17a2b8; font-weight: 600;   display: inline-block; ">
                <?php 
               // if($key=='0'){
                 echo " " . $month." ".$year;
             //   }else{
               //     echo $date;
               // }
                 ?></h5>
                 
                </div>
                <hr>
                <div class="card-title">


              

                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title">
                            <a href="consumption.php" style="margin-left:15%; height:37px; border-radius:4px; border:none" class="btn btn-info float-left">Add Consumption</a>
                        </h3>
                    </div>
                    <div class="col-md-2">
                        <?php 
                         $url_e="update_consumption.php?consumption_month=".$month."&consumption_year=".$year."&key=1";
                        ?>
                        <h3 class="card-title">
                            <a href="<?php echo $url_e; ?>" style="margin-left:-43%; height:37px; border-radius:4px; border:none" class="btn btn-info float-left">Edit Consumption</a>
                        </h3>
                    </div>
                    <div class="col-md-2">
                        <h3 class="card-title">
                            <a href="table_consumption.php" style="margin-left:-55%; width:80px; height:37px; border-radius:4px; border:none;cursor: pointer;" class="btn btn-info btn-success float-left">Back</a>
                        </h3>
                    </div>
                </div>
                    </div>

          


    <?php /*
    if (isset($_GET['success'])) {
        $success = $_GET['success'];

    } else {
        $success = "";
    }

    ?>

<?php /* if (!empty($success)): ?>
<div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="success-message">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        <?php echo $success; ?>
        </div>


<?php endif;*/ ?>

<?php

//fetching facility id from logincode page
//  $facility_id=$_SESSION['auth_user']['facility_id'];


    //data source name fetch from data source table 
    $sql1= "select * from data_source where is_visibility='1'"; 
    $result1= mysqli_query($conn, $sql1);


    //data_sorce variale declared as array
    $data_source=array();
    
    //storing data in data_source variable
    if(mysqli_num_rows($result1)>0){

    while($row1=mysqli_fetch_assoc($result1)){
        $data_source[]=$row1;
        }

        
    }

    //first loop start from here
    foreach($data_source as $value_source){

?>

    <!--printing tha data source names-->
    <div id="myDiv" class="myDiv" style=" border: 1px solid #ccc; padding: 20px; border-radius: 10px; ">
				<div style="margin: -20px; background-color:#b28250;   color:white; text-align: center; border-radius: 5px 5px 0px 0px;">
				<h2 style="font-size: 22px; padding: 13px 0px 11px 0px; display:block;;"><?php print_r($value_source['data_source_name']); ?></h2>
				</div>
<br>


<?php
    //second loop for fetcing data from data source group table by data source id
    $data_source_id=$value_source['data_source_id'];
    
    // data fetching from data source group table by data source id
    $sql2= "select * from data_source_group where data_source_id=$data_source_id and is_visibility='1'";
    $result2= mysqli_query($conn, $sql2);

    //data_sorce_group variale declared as array
    $data_source_group=array();

    //storing data in data_source_group variable
    if(mysqli_num_rows($result2)>0){
        while($row2=mysqli_fetch_assoc($result2)){
            $data_source_group[]=$row2;
        }
    }

    // second loop start from here
    foreach($data_source_group as $value_group){

?>
    <h5 style=" text-align:left; "> <?php print_r($value_group['data_source_group_name']) ?></h5>
    <!-- /.card-header -->
    <div  class="card-body">
        <table id="example1" class="table table-bordered table-striped"  >
        <thead >
        <tr >
        <th style="width: 10%" >S.No.</th>
            <th style="width: 30%" >Data Source</th>
            <th style="width: 20%">Value 1</th>
            <th style="width: 20%">Value 2</th>
                    <th style="width: 20%">Emission</th>
                    
        

        </tr>
        </thead>
        <tbody>
<?php
        
            
            //storing data source id into $data_source_id variable
            $data_source_id=$value_source['data_source_id'];
        
            //storing data source group id into $data_source_group_id variable
            $data_source_group_id=$value_group['data_source_group_id'];

        /* //fetching data from data source subcategory table 
            $sql3= "select * from facility_data_source_subcategory as fdss
            join data_source_subcategory as dss on fdss.data_source_subcategory_id= dss.data_source_subcategory_id
            where  fdss.facility_id='$facility_id' and fdss.data_source_id='$data_source_id' and fdss.data_source_group_id='$data_source_group_id'";
            $result3= mysqli_query($conn, $sql3);

            //data_subcategory variale declared as array
            $data_subcategory=array();
        
            //storing data in data_subcategory variable
            if(mysqli_num_rows($result3)>0){
                while($row3=mysqli_fetch_assoc($result3)){
                    $data_subcategory[]=$row3;
                }
            }



            //declaring indexnum variable as array
            $indexnum=array();

            //loop for storing data sorce category table into indexnum array variable 
            $count= count($data_subcategory);

            //storing data from data subcategory table in $indexnum variable
            for ($i=0; $i<$count; $i++){

            //   print_r($data_subcategory[$i]['data_source_subcategory_id']);
            $indexnum[]= $data_subcategory[$i]['data_source_subcategory_id'];
            }
        
            //converting indexnum into string 
            $id=implode(',', $indexnum);


            // fetching data from emission_factors table  by parameter of data_source_subcategory_id and country_id
            $sql_ef="SELECT * FROM emission_factors where data_source_subcategory_id in ($id)  and country_id ='$facility_country_id' and year='$year'";
            $result_ef=mysqli_query($conn, $sql_ef);

            //declaring emission_factor_value as array 
            $emission_factor_value=array();

            if(mysqli_num_rows($result_ef)>0){
            while($row_ef=mysqli_fetch_assoc($result_ef)){
                //storing value in emission_factor_value 
                $emission_factor_value[]=$row_ef;
            }
        }

        // print_r($emission_factor_value); */
       
        // fetching data from consumption table by year, month, facility , and by data source subcategory id. 

            // $sql = "SELECT * FROM  tbl_month_consumption_sub WHERE year='$year' and consumption_month = '$month' and facility_id='$facility_id' and data_source_subcategory_id in ($id)" ;

            $sql_c="SELECT ef.year FROM tbl_month_consumption_sub  as cons 
            join emission_factors as ef on cons.data_source_subcategory_id=ef.data_source_subcategory_id
            join data_source_subcategory as dss on cons.data_source_subcategory_id=dss.data_source_subcategory_id
            where ef.year=$year ";

            $result_c = mysqli_query($conn, $sql_c);
            $fetch=mysqli_fetch_assoc($result_c);
      
       

        

       
    //  echo 'ok1';
        
            //fetching data from consumption table by year, month, facility , and by data source subcategory id. 
         //   $sql='';
          if(!empty($fetch['year'])){ 



           $sql = "SELECT *,cons.consumption_value*ef.emission_factors_value as emission_value FROM tbl_month_consumption_sub  as cons 
           join emission_factors as ef on cons.data_source_subcategory_id=ef.data_source_subcategory_id
           join data_source_subcategory as dss on cons.data_source_subcategory_id=dss.data_source_subcategory_id
           where ef.year=$year and cons.year=$year and cons.month='$month' and dss.data_source_id =$data_source_id and dss.data_source_group_id=$data_source_group_id" ;
        

         
        }else{
            $sql = "select * from tbl_month_consumption_sub  as cons join data_source_subcategory as dss on dss.data_source_subcategory_id=cons.data_source_subcategory_id  where year='$year' and month='$month' and dss.data_source_id =$data_source_id and dss.data_source_group_id=$data_source_group_id" ;
       
           }  
           $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) 
                {
                $id=1;
                $d=0;
                
                while($row= mysqli_fetch_assoc($result)) 
                    { 
                        // print_r($row['data_source_subcategory_id']);
                        
                      
?>
                    <tr>
                        <td><?php  echo $id;
                        $consumption_id=$row['data_source_subcategory_id'];
                    //  echo $consumption_id;?> </td>
                        <td><?php echo $row['data_source_subcategory_name'];?> </td>
                        <td><?php echo $row['consumption_value'];?> </td>
                        <td><?php echo ($row['consumption_value2']!=0) ? $row['consumption_value2'] :'' ?> </td>
                        <td>
                            <?php
                            if (!empty($fetch['year'])) {
                                if ($row['consumption_value2'] != 0) {
                                    echo number_format($row['consumption_value2'] * $row['emission_value'], 2, '.', ',');
                                } else {
                                    echo number_format($row['emission_value'], 2, '.', ',');
                                }
                            } else {
                                echo ''; 
                            }
                            ?>
                              &nbsp<?php echo "tCO<sub>2</sub>e";?> 
                        </td>

                      
        
                    



<?php
                        $d++;
                    $id++;
                    } 
                }else {
?>
                    <tr>
                    <td colspan="8">No data found</td>
                    </tr>
<?php 
                    }
?>
        </tbody>
        <tfoot>
        <tr>
            <!--<th>Facility Name</th>-->
            <th style="width: 10%" >S.No.</th>
            <th style="width: 30%" >Data Source</th>
            <th style="width: 20%">Value 1</th>
            <th style="width: 20%">Value 2</th>
                    <th style="width: 20%">Emission</th>
                 
        
            
        </tr>
        </tfoot>
        </table>
    </div>
    
    <!-- /.card-body -->

<?php

    }
?>        </div>
<?php 
        
}
?>


    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->







                
                

            

            </div> <!-- container -->

        </div> <!-- content -->


    </div>
    <!-- End content-page -->


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
