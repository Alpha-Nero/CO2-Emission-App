<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])){


    $item_category_id=$_POST['item_category_id'];
    $item_category_name=$_POST['item_category_name'];
    $item_category_description=$_POST['item_category_description'];
    
    
    $sql= "update item_category set item_category_name='$item_category_name',
           item_category_description='$item_category_description' where item_category_id='$item_category_id'";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
            header('location: item_category.php?update='.$update);
          //  header('location: datasource.php');
    
        }
    
        else{
    
            header('location:item_category_update.php');
    
        }
        
        

}


?>