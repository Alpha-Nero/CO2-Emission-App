<?php
        include "database.php";
        include "auth.php";

            if(isset($_POST['project_client_id']))
            {
                $project_client_id=$_POST['project_client_id'];
                $project_id=$_POST['project_id'];

                $sql_delete="delete from assign_project where user_id='$project_client_id'";
                $result_delete=mysqli_query($conn,$sql_delete);
                if(!empty($project_id))
                {
                $result='';
                for($i=0;$i<count($project_id);$i++)
                {
               $sql="insert into assign_project(user_id,project_id)values('$project_client_id','$project_id[$i]')";
               $result=mysqli_query($conn,$sql);
                }

                if($result)
                {
                    $success="Data Inserted Successfully";
                    header("location:client_view_project.php?project_client_id=".$project_client_id."&success=".$success);
                }else{
                    $error="Data not Inserted";
                    header("location:client_view_project.php?project_client_id=".$project_client_id."&error=".$error);
                }
            }else{
                    $success="Data Inserted Successfully";
                    header("location:client_view_project.php?project_client_id=".$project_client_id."&success=".$success);
            }
                
            }
?>