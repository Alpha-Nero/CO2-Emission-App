<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];

    $sql="delete from project_master where project_master_id=$id";
    
    $result=mysqli_query($conn, $sql);
   
    if($result){
        $delete="Data Deleted Successfully";
        header('location: project.php?delete='.$delete);
        //header('location:datasource.php');

    }else{

        die(mysqli_error($conn));

    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectedItems'])) {
        
        if (is_array($_POST['selectedItems'])) {
            foreach ($_POST['selectedItems'] as $item_id) {
               
        $sql_delete="delete from project_master where project_master_id='$item_id'";
        // echo  $sql_delete;
    
         $result_delete=mysqli_query($conn, $sql_delete);
            }
             if($result_delete){

                    echo 1;
                    // header('location: item.php?delete='.$delete);
                    //header('location:datasource.php');

                }else{

                   echo 0;

                }


        } else {
            // echo 'item id=> ' . $_POST['selectedItems'] . '<br>';
        }
    } else {
        echo "error ";
    }
}


?>