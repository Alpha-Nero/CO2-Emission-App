<?php require 'includes/header_start.php';
include 'auth.php';
include 'database.php';
?>


        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">

<?php require 'includes/header_end.php'; ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                
                <div class="content">
                <div class="col-sm-6">
					<h4 style="margin-left: 15px;">Add Consumption</h4>
				</div>
                    <div class="container-fluid">



                    <div class="card">
                        <div class="card-body">
                    <h5 class="card-title">Enter Consumption Values </h5>
                
                    </div>
                    <hr>
                        <div class="card-body">
                            
                         

			  <!--Row starts -->	
              <div class="row">
                <!--Left Col starts -->
                <div class="col-md-6" style="padding-left:250px!important;">
				
                	
					<form  method="POST" action ="consumptioncode.php" onsubmit="return onFormSubmit(this);">


						<!--<select class="form-control select2 " name="month" data-dropdown-css-class="select2" style="margin-left:-60% ;" id="monthSelect">
						<div style="background-color: #17a2b8;" >	
						<option selected="selected" style="display: inline-block;">Jan</option>
							<option style="display: inline-block;">Feb</option>
							<option style="display: inline-block;">Mar</option>
						</div>
                        <div>
							<option>Apr </option>
							<option>May </option>
							<option>Jun </option>
						</div>
						<div>	
							<option>Jul </option>
							<option>Aug </option>
							<option>Sep </option>
						</div>
						<div>
							<option>Oct </option>
							<option>Nov </option>
							<option>Dec </option>




						</div>
											<input type='text' class="form-control select2 " id='datepicker' name= "datepicker" placeholder="MM"/>
	
						</select>-->
                  
                </div>
                
                <!--Left Col ends -->

				
              
                <!--Right Col starts -->
               <!-- <div class="col-md-6" style="padding-right:250px!important;">
                	<div class="form-group">
					<input id="example2"  type="text" class="form-control"  name="year" value="" style=" margin-left:-40%; " placeholder="Select Year"/>
						<select class="form-control select2 " name="year" data-dropdown-css-class="select2" style="margin-left: -40%;">
							<option selected="selected">2021</option>
							<option>2022</option>
							<option>2023 </option>
						</select>
                  	</div>
                </div>-->
                
            </div>
      
	
            <div class="card" style="margin-bottom:10px ;">
            <div class="card-body">
            <div class="row">
            <div class="col-md-4" style="margin-top:7px ;">
                       <!-- Radio button for Yes/No choice -->
            <label for="choice">Save Data on the basis of :</label>
            <input type="radio" name="choice" value="yes" id="yesRadio"> Month |
            <input type="radio" name="choice" value="no" id="noRadio"> Days
     

                  </div>
                    <div class="col-md-8">

                    <!-- row -- col-md-8-->
                    <div   id="monthYearFields">
                        <div class="row">
                    <label for="inputPassword3" class="col-form-label col-md-2" style ="width:100% ;" >Select Month</label>

                    <select class="form-control select2 col-md-3" name="month" data-dropdown-css-class="select2" style="margin-left:0%; width:50% ;" id="monthSelect" required>
						
					<option value="">Select Month</option>
                    <option value="JANUARY">JANUARY</option>
                    <option value="FEBRUARY">FEBRUARY</option>
                    <option value="MARCH">MARCH</option>
                    <option value="APRIL">APRIL</option>
                    <option value="MAY">MAY</option>
                    <option value="JUNE">JUNE</option>
                    <option value="JULY">JULY</option>
                    <option value="AUGUST">AUGUST</option>
                    <option value="SEPTEMBER">SEPTEMBER</option>
                    <option value="OCTOBER">OCTOBER</option>
                    <option value="NOVEMBER">NOVEMBER</option>
                    <option value="DECEMBER">DECEMBER</option>

                    </select>



                    <label for="inputPassword3" class="col-form-label col-md-2" style ="width:100% ;margin-left:20px">Select Year</label>

                    <select class="form-control select2 col-md-3" name="year" data-dropdown-css-class="select2" style="margin-left:0%; width:50% ;" id="monthSelect" required>
						
					<option value="">Select Year</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>


                    </select>

                    </div>
                    </div>
                      <!--./ row -- col-md-8./ -->

                      <div  id="dateFields" style="display:none;">
                      <div class="row">
                        <label for="date" class="col-form-label col-md-2" >Select Date</label>
                        <input type="date" class="form-control col-md-3" name="date" >
                        </div>
                     </div>
                      <!--./ row -- col-md-8./ -->
                    </div>

                    </div>
                    
                    <div class="col-md-2">

                    <h3 class="card-title"><a href="table_consumption.php"><input  style="margin-left:0; width:40%" class="btn btn-success float-left" value="Back"></a></h1>

                    </div>

                   </div>
                </div>
            </div>

            <script>
    // Function to show/hide fields based on radio button selection
    function toggleFields() {
        var yesRadio = document.getElementById("yesRadio");
        var noRadio = document.getElementById("noRadio");
        var monthYearFields = document.getElementById("monthYearFields");
        var dateFields = document.getElementById("dateFields");

        // If "Yes" is selected, show month/year fields and hide date fields
        if (yesRadio.checked) {
            monthYearFields.style.display = "block";
            dateFields.style.display = "none";
        }
        // If "No" is selected, show date fields and hide month/year fields
        else if (noRadio.checked) {
            monthYearFields.style.display = "none";
            dateFields.style.display = "block";
        }
    }

    // Attach the toggleFields function to the radio button change event
    var radios = document.querySelectorAll('input[name="choice"]');
    radios.forEach(function(radio) {
        radio.addEventListener("change", toggleFields);
    });

    // Initially, call toggleFields to set the initial state based on the default radio selection
    toggleFields();
</script>











			<?php
			//error message for incorrect selection of year and country
			if (isset($_GET['error'])) {
				$errorMessage = $_GET['error'];

			} else {
				$errorMessage = "";
			}

			?>

         <?php if (!empty($errorMessage)): ?>
			
			
			<div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto; padding:35px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                   <?php echo $errorMessage; ?>
                </div>
              <!--  <h3 class="card-title">General Elements</h3>-->
             
        
          <?php endif; ?>
			 
			
            <?php 
            // decalaring indexnum
			$indexnum=array();


//first loop for fetching data from data source table          
            $sql1= "select * from data_source where is_visibility='1'";
            $result1= mysqli_query($conn, $sql1);
            $data_source=array();

            if(mysqli_num_rows($result1)>0){
                while($row1=mysqli_fetch_assoc($result1)){
                    $data_source[]=$row1;
                }
            }

			//first loop start from here
            foreach($data_source as $value_source){

            ?>
			
			<div id="myDiv" class="myDiv" style=" border: 1px solid #ccc; padding: 20px;margin:20px; border-radius: 10px;">
            <div style="margin: -20px; background-color:#17a2b8; color:white; text-align: center; border-radius: 10px 10px 0px 0px;">
            <h2><?php print_r($value_source['data_source_name']); ?></h2>
			</div>
<br>

            <?php



          //second loop for fetcing data from data source group table by data source id
          $data_source_id=$value_source['data_source_id'];
           //  print_r($value1['data_source_id']);

            $sql2= "select * from data_source_group where data_source_id=$data_source_id and is_visibility='1'";
            $result2= mysqli_query($conn, $sql2);
            $data_source_group=array();

            if(mysqli_num_rows($result2)>0){
                while($row2=mysqli_fetch_assoc($result2)){
                    $data_source_group[]=$row2;
                }
            }





            // second loop start from here
            foreach($data_source_group as $value_group){

            ?>

            <h5 style="margin-left: 10px;"><?php print_r($value_group['data_source_group_name'])?></h5>
  
			<!--Electricity 1st Row -->
			<div class="row" style="padding-top:25px!important;">
					<div class="col-2">
						<div class="form-group">
							<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sr. No.</label><br>
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label>Data Source Name</label><br>
						</div>
					</div>

					<div class="col-2">
						<div class="form-group" >
							<label>Consumption</label>
						</div>
					</div>
					
					<div class="col-2">
						<div class="form-group" >
							<label></label>
						</div>
					</div>
				</div>
				<!--Electricity Row ends -->

              
            
				<?php

           //third loop
           //for fetching data from data source subcategory table by data source id and data source group id

            $data_source_id=$value_source['data_source_id'];
           // print_r($value2['data_source_id']);

			 $data_source_group_id=$value_group['data_source_group_id'];
           //  print_r($value2['data_source_group_id']);


            $sql3= "select * from  data_source_subcategory where data_source_id='$data_source_id' and data_source_group_id='$data_source_group_id' 
		   order by data_source_subcategory_id ASC";
            $result3= mysqli_query($conn, $sql3);
			$data_subcategory=array();
          

            if(mysqli_num_rows($result3)>0){
                while($row3=mysqli_fetch_assoc($result3)){
                    $data_subcategory[]=$row3;
                }
            }


		

$sno=1;
// third loop start 
            foreach($data_subcategory as $value_subcategory){


			
           // print_r($value3['data_source_subcategory_id']);  

            ?>

				<!--Electricity nd Row -->
				<div class="row">
					<div class="col-2">
						<div class="form-group">
							<label style="font-weight: 300;  margin-top: 4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sno;?></label>
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label style="font-weight: 300;  margin-top: 4px;"><?php print_r($value_subcategory['data_source_subcategory_name']);?></label>
						</div>
					</div>

					<div class="col-2">
						<div class="form-group" >
							<input type="text" class="form-control" name="consumption_value[]" placeholder="Enter Value" pattern="\d*\.?\d+" title="Please enter a numeric value." required>
							
							<input type="hidden" class="form-control" name="data_source_subcategory_id[]" value="<?php echo $value_subcategory['data_source_subcategory_id']?>" >
						</div>
					</div>
					
					<div class="col-2">
						<div class="form-group" >
						<label style="font-weight: 300; margin-top: 4px;"><?php print_r($value_subcategory['data_source_subcategory_unit']);?></label>
						<!--<select class="form-control select2 " name="unit" data-dropdown-css-class="select2">
								<option selected="selected">kWh</option>
								<option>mWh</option>
								<option>gWh</option>
							</select>-->
						</div>
					</div>
				</div>
				
				<!--Electricity Row ends -->
			
				<?php

				//$indexnum++;
				$sno++;
	// third loop ends here 
            }
			?>
			
<?php

//loop for storing data sorce category table into indexnum array variable 
        $count= count($data_subcategory);
		
		//echo"$count";
		
		for ($i=0; $i<$count; $i++){
		
		//	print_r($data_subcategory[$i]['data_source_subcategory_id']) ;
		
			$indexnum[]= $data_subcategory[$i]['data_source_subcategory_id'];
			
		}

//second loop end
		}
	?>
	
	<br></div><br>
	
	<?php

// first loop end
        }
		//echo "$count";

				?>
			
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<!--<input type="submit"  class="btn btn-info" name="submit" value="Save Appointment">-->
					
				</div>
				
			    <div class="card-footer">
				<input type="submit"  class="btn btn-info" name="submit" value="Save Consumption" >
					
				</div>
				</div>
				
				<!-- /.card -->
				

				</form>

			
                        </div>
                    </div>

                    

                      


                     

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


<?php require 'includes/footer_start.php' ?>

        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

<?php require 'includes/footer_end.php' ?>
