<?php 
include 'auth.php';
include 'database.php';

					// code to insert array value in consumption table
		        	// echo $_SESSION['auth_user']['facility_id'];
				
                       // submit form function
					if(isset($_POST['submit'])){

                        $country_id= 1;
						$year= $_POST['year'];
						  
						//echo $country_id;
						echo $year;
						
					/*	$sql_country="select * from country where country_id='$country_id' ";
						$result_country=mysqli_query($conn, $sql_country);
						$country=mysqli_fetch_array($result_country);
						$country_name=$country['country_name'];
*/
					$sql_c="select * from emission_factors where country_id='1' and year='$year' ";

                    $result_c=mysqli_query($conn, $sql_c);

                     if(!mysqli_num_rows($result_c) > 0){

						if(is_numeric($country_id)){
                        
                        $data_source_subcategory_id= $_POST['data_source_subcategory_id'];

						// submit form loop
						for($i=0; $i<count($_POST['emission_factors_value']); $i++){
							
							$sql="insert into emission_factors(data_source_subcategory_id,  emission_factors_value,unit,  year, country_id,scope)values('".$_POST['data_source_subcategory_id'][$i]."','".$_POST['emission_factors_value'][$i]."','".$_POST['unit'][$i]."','$year','$country_id','".$_POST['scope'][$i]."')";

							$result=mysqli_query($conn, $sql);

							if($result){
								$success="Data Added Successfully";
                                header('location: table_emission.php?success='.$success);
                               
								echo "";
							}

							else{
								
							}
						}
					}else{
						$error1="Please select the correct Country and Year";
					header('location:emission.php?error1='.$error1);
						//echo "Select Country and Year";
					}
				}
                else{
                  $error2="Emission Factors  for the year <b>".$year."</b> Select another year for the Emission Factors.";
						      header('location:emission.php?error2='.$error2);
              
                }   
					
					}
			?>