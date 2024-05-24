<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])){


    $item_category_id=$_POST['item_category_id'];
    $item_id=$_POST['item_id'];
    $item_code=$_POST['item_code'];
    $item_unit=$_POST['item_unit'];
    $item_unit2=$_POST['item_unit2'];
    $item_emission_factor=$_POST['item_emission_factor'];
    $ideal_emission_factor=$_POST['ideal_emission_factor'];
    $item_material_detail=$_POST['item_material_detail'];
    $item_description=$_POST['item_description'];
    // echo $item_unit."<br>";
    // echo $item_unit2;

    $item_descriptionn= preg_replace("/'/", "\\'",$item_description);  // it is used to replace the single quotes (') into (\');
    $sql= "update item set  item_category_id='$item_category_id', item_code='$item_code', item_unit='$item_unit',item_unit2='$item_unit2', item_emission_factor='$item_emission_factor',
           ideal_emission_factor='$ideal_emission_factor', item_material_detail='$item_material_detail', item_description='$item_descriptionn'  where item_id='$item_id'";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
            header('location: item.php?update='.$update);
          //  header('location: datasource.php');
    
        }
    
        else{
    
            header('location:item_update.php');
    
        }
        
        

}


?>