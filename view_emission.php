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
//$month= $_GET['consumption_month'];
$year= $_GET['year'];

?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                


            <div class="card">
                <div class="card-body" style="text-align:left;">
                <h5 style=" display: inline-block; text-align:left;">Emission for the year </h4><h4 style="color:#17a2b8; font-weight: 600;   display: inline-block; margin-left:6px"><?php  echo $year;?></h5>

                </div>
                <hr>
                <div class="card-title">
                <div class="row">
                    <div class="col-md-2">
                        <h3 class="card-title">
                            <a href="emission.php" style="margin-left:15%; height:37px; border-radius:4px; border:none" class="btn btn-info float-left">Add Emission</a>
                        </h3>
                    </div>
                    <div class="col-md-2">
                        <?php 
                        $url_ed = "emission_update.php?year=" . $year;
                        ?>
                        <h3 class="card-title">
                            <a href="<?php echo $url_ed; ?>" style="margin-left:-20%; height:37px; border-radius:4px; border:none" class="btn btn-info float-left">Edit Emission</a>
                        </h3>
                    </div>
                    <div class="col-md-2">
                        <h3 class="card-title">
                            <a href="table_emission.php" style="margin-left:-55%; width:80px; height:37px; border-radius:4px; border:none;cursor: pointer;" class="btn btn-info btn-success float-left">Back</a>
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
    <h5 style="margin-left: 18px; font-weight: 600; text-align:left"> <?php print_r($value_group['data_source_group_name']) ?></h5>
    <!-- /.card-header -->
    <div  class="card-body">
        <table id="example1" class="table table-bordered table-striped"  >
        <thead >
        <tr >
        <th style="width: 10%" >S.No.</th>
            <th style="width: 50%" >Data Source</th>
            <th style="width: 20%">Scope</th>
                    <th style="width: 20%">Emission</th>
               <!--     <th style="width: 20%">Unit</th>
    -->

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

        // print_r($emission_factor_value); 
        /*
        //fetching data from consumption table by year, month, facility , and by data source subcategory id. 
            $sql = "SELECT * FROM  consumption WHERE consumption_year='$year' and consumption_month = '$month' and facility_id='$facility_id' and data_source_subcategory_id in ($id)" ;
            $result = mysqli_query($conn, $sql);
        

        */      
    //  echo 'ok1';
        
            //fetching data from consumption table by year, month, facility , and by data source subcategory id. 
             
        
          
          
          
           $sql = "SELECT * FROM emission_factors as ef 
           join data_source_subcategory as dss on ef.data_source_subcategory_id=dss.data_source_subcategory_id
           where dss.data_source_id =$data_source_id and dss.data_source_group_id=$data_source_group_id and  ef.year=$year" ;
          
          $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) 
                {
                $id=1;
                $d=0;
                while($row= mysqli_fetch_assoc($result)) 
                    {
?>
                    <tr>
                        <td><?php  echo$id;
                        $consumption_id=$row['data_source_subcategory_id'];
                    //  echo $consumption_id;?> </td>
                        <td><?php echo $row['data_source_subcategory_name'];?> </td>
                        <td><?php echo $row['scope'];?> </td>
                        <td><?php echo $row['emission_factors_value'];?> </td>
                      <!--  <td><?php echo $row['unit'];?> </td>
                    -->
                    



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
            <th style="width: 50%" >Data Source</th>
            <th style="width: 20%">Scope</th>
                    <th style="width: 20%">Emission</th>
                <!--    <th style="width: 20%">Unit</th>
                -->
            
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
