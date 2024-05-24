<?php
include 'auth.php';

include 'database.php';

if(isset($_POST['submit'])){

    $country_id=1;
  //$country_name=$_POST['country_name'];
    $year=$_POST['year'];

    for($i=0; $i<count($_POST['emission_factors_value']); $i++){
    
    $sql= "update emission_factors set scope='".$_POST['scope'][$i]."', emission_factors_value='".$_POST['emission_factors_value'][$i]."' , unit='".$_POST['unit'][$i]."' where emission_factors_id='".$_POST['emission_factors_id'][$i]."'";

    $result=mysqli_query($conn, $sql);

    if($result){
        $update="Data Updated Successfully";
        header('location: view_emission.php?update='.$update."&year=".$year);
      //header('location: viewemission.php');

    }

    else{

        header('location:emission_update.php');

    }
    
    }

}

?>