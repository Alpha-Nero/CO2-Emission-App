<?php
include 'auth.php';
include 'database.php';
if((isset($_GET['consumption_month'])&&isset($_GET['consumption_year']))||isset($_GET['consumption_date'])){
    $consumption_month=$_GET['consumption_month'];
    $consumption_year=$_GET['consumption_year'];
    $consumption_date=$_GET['consumption_date'];
    $key=$_GET['key'];
    
   // $facility_id=$_GET['facility_id'];


   $sql='';
   if($key=='0'){

    $sql="delete from tbl_month_consumption_sub where month='$consumption_month' and year='$consumption_year'";
   }else{
    $sql="delete from tbl_month_consumption_sub where consumption_date='$consumption_date'";

   }

    $result=mysqli_query($conn, $sql);

    if($result){

        $delete="Data Deleted Successfully";

        
        header('location: table_consumption.php?delete='.$delete);
        //echo 'delted';
        //header('location:tableconsumption.php');


    }else{

        die(mysqli_error($conn));
    }
}

?>