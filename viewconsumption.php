<?php 

include 'auth.php';
// data base connection file
include_once 'db.php';





?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consumption | ADIPEC ESG Tool</title>


  <!--Adding stylesheets and favicon -->
  <?php include 'link.php'; ?>
  
  <style>
  </style>
  
</head>
<body class="hold-transition sidebar-mini">


<div class="wrapper">
  
  <!-- Add Header file for menu -->
  <?php include 'header.php';?>
  
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<?php              
        $month= $_GET['consumption_month'];
        $year= $_GET['consumption_year'];
       // $id= $_GET['id'];
      //  echo $id;
      $consumption_id;


      $facility_id=$_SESSION['auth_user']['facility_id'];
         
      $sql ="SELECT * FROM facility where facility_id='$facility_id'";
      $result=mysqli_query($conn, $sql);
      $data= mysqli_fetch_assoc($result);
      $facility_country_id=$data['facility_country_id'];

      $scope_1=0;
      $scope_2=0;
      $scope_3=0;      


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
<div  style="margin-left: 22px;">
            <h4 style=" display: inline-block;">Consumption for the month of </h4><h4 style="color:#17a2b8; font-weight: 600;   display: inline-block; margin-left:6px"><?php echo"  ". $month;?> <?php echo $year;?></h4>
</div></div>
          <div class="col-sm-6">
           <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
 
              <h3 class="card-title"><a href="consumption.php"><input type="submit" style="margin-left:2%;" class="btn btn-info" name="addnewpatient" value="Add Consumption"></a></h3>

              <?php $url_e="updateconsumption.php?consumption_month=" . $month."&consumption_year=". $year;?>

              <h3 class="card-title"><a href="<?php echo $url_e;?>"><input type="submit" style="margin-left:23.8px; width:80px; height:37px; border-radius:4px"  class="btn btn-danger" name="addnewpatient" value="Edit"></a></h3>
              
              <h3 class="card-title"><a href="tableconsumption.php"><input type="submit" style="margin-left:20px; width:80px; height:37px; border-radius:4px; border:none" class="btn btn-success float-left" name="addnewpatient" value="Back"></a></h3>
                            
              </div>




              
             <!-- div for emission value display against scope No. -->
              <div class="card-body">


              <?php 
                    // data fetch according scope value
                    $sql_scope= "select sum(c.consumption_value*ef.emission_factors_value) as emission_value, ef.scope 
                    from consumption as c
                    join emission_factors as ef on c.data_source_subcategory_id= ef.data_source_subcategory_id
                    join facility_data_source_subcategory as fdss on c.data_source_subcategory_id= fdss.data_source_subcategory_id
                    join data_source_subcategory as dss on fdss.data_source_subcategory_id = dss.data_source_subcategory_id
                    where c.facility_id = $facility_id and c.consumption_month='$month' and c.consumption_year=$year and ef.country_id=$facility_country_id and ef.year=$year
                    and fdss.facility_id=$facility_id and dss.is_reduction='no'
                    group by ef.scope
                    order by ef.scope ASC;";
                    $result_scope=mysqli_query($conn, $sql_scope);

                    //declaring array
                    $data_scope=array();

                    //declaring scope variable null
                    $scope_1=0;
                    $scope_2=0;
                    $scope_3=0;



                    //storing table data in a array 
                    while ($row_scope = mysqli_fetch_assoc($result_scope)) {
                    $data_scope[]=$row_scope;

                    }


                    //using  forloop  for storing scope value to its same scope varible 
                    for ($j=0; $j<count($data_scope);$j++){
                    // fetching scope name in varible 
                    $scope_num=$data_scope[$j]['scope'];

                    //if condition checking scope_num equal to 'Scope 1' 
                    if ($scope_num=='Scope 1'){


                            $scope_1=$data_scope[$j]['emission_value'];
                        

                        }
                        else  if ($scope_num=='Scope 2'){

                        $scope_2=$data_scope[$j]['emission_value'];

                        }
                        else{

                        $scope_3=$data_scope[$j]['emission_value'];
                        
                        }




                    }
                    //storing scope value forloop end here





                    ?>

              <div class="row">
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner" style="padding-left: 25px;">
                

                <h3 id='' style="display: inline-block;"><?php echo number_format($scope_1, 0, '.', ',' ) ;?></h3>
                <h4 style="display: inline-block;margin-left:3px; "> tCO<sub>2</sub>e</h4>
                <h5 >Scope 1</h5>
              </div>
              <div class="icon">
              
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner " style="padding-left: 25px;">
               

                <h3 id='' style="display: inline-block;"><?php echo number_format($scope_2, 0, '.', ',' ) ;?></h3>
                <h4 style="display: inline-block;margin-left:3px; "> tCO<sub>2</sub>e</h4>
                <h5>Scope 2</h5>
              </div>
              <div class="icon">
              
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner" style="padding-left: 25px;">
                

                <h3 id='' style="display: inline-block;"><?php echo number_format($scope_3, 0, '.', ',' ) ;?></h3>
                <h4 style="display: inline-block;margin-left:3px; "> tCO<sub>2</sub>e</h4>
                <h5>Scope 3</h5>
              </div>
              <div class="icon">
                
              </div>
            </div>
          </div>
          <!-- ./col -->
         
        </div>
        <!-- /.row -->
              </div>


              <?php
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

      //fetching facility id from logincode page
      $facility_id=$_SESSION['auth_user']['facility_id'];


            //data source name fetch from data source table 
             $sql1= "select DISTINCT ds.data_source_id, ds.data_source_name from facility_data_source_subcategory as fdss
             join data_source as ds on fdss.data_source_id= ds.data_source_id
             where  fdss.facility_id='$facility_id' 
              ORDER BY ds.data_source_id ASC;"; 
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
            <div id="myDiv" class="myDiv" style=" border: 1px solid #ccc; padding: 20px; border-radius: 10px; margin:20px">
            <div style="margin: -20px; background-color:#17a2b8; color:white; text-align: center; border-radius: 10px 10px 0px 0px;">
            <h2><?php print_r($value_source['data_source_name']) ?></h2>
			</div>
      <br>


     <?php
            //second loop for fetcing data from data source group table by data source id
            $data_source_id=$value_source['data_source_id'];
            
            // data fetching from data source group table by data source id
            $sql2= "select distinct dsg.data_source_group_id, dsg.data_source_group_name from facility_data_source_subcategory as fdss
            join data_source_group as dsg on fdss.data_source_group_id= dsg.data_source_group_id
            where  fdss.facility_id='$facility_id'  and dsg.data_source_id='$data_source_id' ";
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
            <h5 style="margin-left: 18px; font-weight: 600;"> <?php print_r($value_group['data_source_group_name']) ?></h5>
              <!-- /.card-header -->
              <div  class="card-body">
                  <table id="example1" class="table table-bordered table-striped"  >
                  <thead >
                  <tr >
                  <th style="width: 10%" >S.No.</th>
                    <th style="width: 50%" >Data Source</th>
                    <th style="width: 20%">Consumption</th>
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

                 // print_r($emission_factor_value); 
                 /*
                   //fetching data from consumption table by year, month, facility , and by data source subcategory id. 
                     $sql = "SELECT * FROM  consumption WHERE consumption_year='$year' and consumption_month = '$month' and facility_id='$facility_id' and data_source_subcategory_id in ($id)" ;
                     $result = mysqli_query($conn, $sql);
                   

                 */      
              //  echo 'ok1';
                
                     //fetching data from consumption table by year, month, facility , and by data source subcategory id. 
                     $sql = "Select c.consumption_value*ef.emission_factors_value as emission_value, dss.data_source_subcategory_name, ef.emission_factors_value, c.consumption_value, fdss.data_source_subcategory_id  from facility_data_source_subcategory as fdss
                     join data_source_subcategory as dss on fdss.data_source_subcategory_id= dss.data_source_subcategory_id
                     join emission_factors as ef on fdss.data_source_subcategory_id=ef.data_source_subcategory_id
                     join consumption as c on fdss.data_source_subcategory_id=c.data_source_subcategory_id
                     where  fdss.facility_id=$facility_id and fdss.data_source_id=$data_source_id and fdss.data_source_group_id=$data_source_group_id and c.facility_id=$facility_id and c.consumption_month='$month' and c.consumption_year=$year and ef.year=$year" ;
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
                                <td>
                                 
                                  <?php echo $row['consumption_value'].'  ';
                              print_r($data_subcategory[$d]['data_source_subcategory_unit']); ?> </td>


						                		<td>
                                  <?php  
                                  echo number_format( $row['emission_value'], 2, '.', '' ).'  '."tCO<sub>2</sub>e";
                                    //checking value is numeric 
                                   /* if (is_numeric($row['consumption_value'])) {

                                    //stroing consumption value in $cv variable
                                    $cv=$row['consumption_value'];

                                    //stroing emission factors value in $efv variable
                                    $efv= $emission_factor_value[$d]['emission_factors_value'];


                                    //method for calculating emission values by mulitpling emission_factors_value to consumption_value
                                    $ev=$cv*$efv;
                                   

                                    //printing the value 
                                    echo number_format( $ev, 2, '.', '' );

                                    echo '  ';
                                    echo "tCO<sub>2</sub>e";
                                  //  print_r($emission_factor_value[$d]['scope']);

                                   if ($emission_factor_value[$d]['scope']=='Scope 1'){
                                    $scope_1+=$ev;

                                   }else  if ($emission_factor_value[$d]['scope']=='Scope 2'){
                                    $scope_2+=$ev;
                                   }else{
                                    $scope_3+=$ev;
                                   }


                                    }else{

                                          echo 'error';

                                    }*/
                                  
                                ?> 
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
                    <th style="width: 10%">S.No.</th>
                    <th style="width: 50%">Data Source</th>
                    <th style="width: 20%">Consumption</th>
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

       
       


        <div class="card">
        <div class="card-header">
                <h3 class="card-title">Upload Document</h3>
              </div>
        <div class="card-body" style="margin: 10px;">
          
           
        <form  method="POST" action="doc_upload.php" enctype="multipart/form-data">

        <div class="row">

       <?php
       
    //  echo $facility_id; 
       ?>
         
        
        <label >File Name  :</label>
        <input type="text" name="file_name" class="form-control col-md-4" style="margin-left:10.1% ;" placeholder="Enter File Name">
        <input type="hidden" name="month" value="<?php  echo $month?>">
        <input type="hidden" name="year" value="<?php  echo $year?>">
        <input type="hidden" name="facility_id" value="<?php  echo $facility_id?>">
      

        <label style="margin-left:2% ;">File Type  :</label>
        <select type="select" name="file_type" class="form-control select2 col-md-4"  style="margin-right:20px ;margin-left:3.2% ;">
          <option>Pdf</option>
          <option>Doc</option>
          <option>Image</option>
        </select>

        </div>
        <div class="row" style="margin-top:10px ;" >

        <label for="file">Select a file to Upload :</label>
        <input type="file" name="file" id="file" style="margin-left:3.3% ;height:40px" class="form-control col-md-4" >
      
       
        <input type="submit" name="submit" value="Upload File" style="margin-left:23%" class="btn btn-info">
        </div>
    </form>
          
          </div>

        </div>



        
        <?php
        //fetching data of consumption table and storing in data_doc array
        $sql_doc="select * from consumption_documents where facility_id =$facility_id and month='$month'";
        $result_doc=mysqli_query($conn, $sql_doc);

        $doc_data=array();
        while($row_doc=mysqli_fetch_assoc($result_doc)){

          $doc_data[]=$row_doc;

        }



        ?>



        
        <!-- Documents Upload starts -->
        <br>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Uploaded Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10%">#</th>
                      <th style="width: 50%">Name</th>
                      <th style="width: 20%">Type</th>
                      <th style="width: 20px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sn=1;
                    foreach($doc_data as $value){
                    ?>
                    <tr>
                      <td><?php echo $sn?></td>
                      <td><?php echo $value['file_name']?></td>
                      <td><?php echo $value['file_type']?></td>
                      <td>
                        <?php
                        $file_id=$value['document_id'];
                        $url_d="delete_doc.php?delete_id=".$file_id.'&year='.$year.'&month='.$month; 
                        
                        ?>
                      <a href="<?php echo $url_d; ?>"> <i class="fas fa-trash" style="margin-left:10px ;margin-right:40px ;"></i></a>
                        <a href="<?php echo $value['file_url']?>"><svg  height="1.25em" viewBox="0 0 384 512" ><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#125fe2}</style><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                      </a>
                      </td>
                    </tr>
                    <?php
                    $sn++;
                    }
                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
              
              <!-- Documents Upload ends -->
        
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer-->
  <?php include 'footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>

  //scope displaying function at h3 ta

const data = "<?php echo number_format( $scope_1, 2, '.', '' ); ?>";
const data2 = "<?php echo number_format( $scope_2, 2, '.', '' ); ?>";
const data3 = "<?php echo number_format( $scope_3, 2, '.', '' ); ?>";
    const result = document.getElementById("scope_placeholder_1");
    const result2 = document.getElementById("scope_placeholder_2");
    const result3 = document.getElementById("scope_placeholder_3");
    scope_placeholder_1.innerText = data;
    scope_placeholder_2.innerText = data2;
    scope_placeholder_3.innerText = data3;
  

const successMessage = document.getElementById('success-message');

// Function to hide the success message
const hideSuccessMessage = () => {
  successMessage.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(hideSuccessMessage, 1000);


</script>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="../../dist/js/demo.js"></script>-->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
