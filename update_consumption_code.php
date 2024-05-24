<?php
include 'auth.php';
include 'database.php';

if(isset($_POST['submit'])){

  //  $facility_id=$_POST['facility_id'];
    $month=$_POST['month'];
    $year=$_POST['year'];
   // $date=$_POST['date'];
   // $key=$_POST['key'];
   // echo $key;
   
    for($i=0; $i<count($_POST['consumption_value']); $i++){
    
    $sql= "update tbl_month_consumption_sub set consumption_value='".$_POST['consumption_value'][$i]."',consumption_value2='".$_POST['consumption_value2'][$i]."' where consumption_id='".$_POST['consumption_id'][$i]."'";

    $result=mysqli_query($conn, $sql);

    if($result){
        $success="Data Updated Successfully";

      
        header('location: view_consumption.php?success='.$success."&consumption_year=".$year."&consumption_month=".$month."&key=0");

   
       

    }

    else{

        header('location:updateconsumption.php');

    }
    
    }

}

?>