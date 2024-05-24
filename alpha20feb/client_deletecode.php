<?php
            include "database.php";
            include "auth.php";

            if(isset($_GET['project_client_id']))
            {
                $project_client_id=$_GET['project_client_id'];

                $sql="delete from project_user where project_user_id='$project_client_id'";
                $result=mysqli_query($conn,$sql);
                
                    if($result)
                {
                    $success="Data Deleted Successfully";
                    header("location:client_add.php?success=".$success);
                }else{
                    $error="Data not Deleted";
                    header("location:client_add.php?error=".$error);
                }
                }
          
?>