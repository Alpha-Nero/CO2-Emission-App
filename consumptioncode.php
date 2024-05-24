<?php
include 'auth.php';

//include 'auth.php';

include 'database.php';

                    //submit form function
					if(isset($_POST['submit'])){


						$is_month=1;
						$month = $_POST["month"];
						$year = $_POST["year"];
						
						
						


/*
						$month='';
						$year='';
						$date='';
						$form_type = $_POST["form_type"];
						echo "form type".$form_type."<br>";
    
						if ($form_type == "1") {
							// Process month/year input fields
							$month = $_POST["month"];
							$year = $_POST["year"];
							echo "ok1";
							$is_month=1;
							// ... Your processing logic for month/year ...
						} elseif ($form_type == "0") {
							// Process date input fields
							$date = $_POST["date"];
							$is_month=0;
							// ... Your processing logic for date ...
						}

						echo "0/1".$is_month."<br>";
						echo "month =".$month."<br>";
						echo "year".$year."<br>";
						echo "date ".$date."<br>";

*/
					  
					//	$dateTime = new DateTime($month);
					//	$formattedMonth = $dateTime->format('Y F');
					  
					//	echo "Selected Month: " . $formattedMonth;	
					  

					//	list($year, $month) = explode(" ", $formattedMonth);

                     //   echo "Variable 1: " . $year . "<br>";
                     //   echo "Variable 2: " . $month;

					 //	$year= $_POST['year'];


					 if(!empty($month)){

						$consumption= $_POST['consumption_value'];

					   // $facility_id=$_SESSION['auth_user']['facility_id'];


						$sql_c="select * from tbl_month_consumption_sub where month='$month' and year='$year'  ";

						$result_c=mysqli_query($conn, $sql_c);


						if (!mysqli_num_rows($result_c) > 0) {
						// submit form loop
					for($i=0; $i<count($_POST['consumption_value']); $i++){
						
							
							$sql="insert into tbl_month_consumption_sub(data_source_subcategory_id,  consumption_value, month, year,is_monthly,consumption_value2)values('".$_POST['data_source_subcategory_id'][$i]."','".$_POST['consumption_value'][$i]."','$month','$year','$is_month','".$_POST['consumption_value2'][$i]."')";

							// echo $sql;

							$result=mysqli_query($conn,$sql);

							if($result){
								$success="Data Added Successfully";
                                header('location: table_consumption.php?success='.$success);

                              
								echo "";
							}

							else{
								echo "";
							}
						}
					}else{

						$error="Consumption data for "."<b>".$month." ". $year."</b>"." is already added into the system. Select another month and year.";
						header('location:consumption.php?error='.$error);
					}


				}else{
					$error2="Choose the correct Date or Month and Year for the consumption Data";
					header('location:consumption.php?error2='.$error2);
			

				}

					}

				?>
    