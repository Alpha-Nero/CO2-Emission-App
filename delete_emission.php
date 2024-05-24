<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['year'])){
    $country_id=1;
    $year=$_GET['year'];

    $sql="delete from emission_factors where country_id='$country_id' and year='$year'";

    $result=mysqli_query($conn, $sql);

    if($result){

        $delete="Data Deleted Successfully";
        header('location: table_emission.php?delete='.$delete);
       // header('location:tableemission.php');


    }else{

        die(mysqli_error($conn));
    }
}

?>