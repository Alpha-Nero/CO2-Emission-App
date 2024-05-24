<?php
            include "database.php";
            include "auth.php";

            if(isset($_POST['submit']))
            {
                $client_name=$_POST['client_name'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $project_user_id=$_POST['project_user_id'];

                // $cmd="select * from project_user where project_username='$username' and project_password='$password'";
                // $result=mysqli_query($conn,$cmd);
                // if(!mysqli_num_rows($result) > 2)
                // {

                // $sql="insert into project_user(project_username,project_password,project_client_name)values('$username','$password','$client_name')";
                $sql="update project_user set project_username='$username',project_password='$password',project_client_name='$client_name' where project_user_id='$project_user_id'";
                $result=mysqli_query($conn,$sql);
                if($result)
                {
                    $success="Data Inserted Successfully";
                    header("location:client_add.php?success=".$success);
                }else{
                    $error="Data not Inserted";
                    header("location:client_add.php?error=".$error);
                }
            // }else{
            //         $error="Data Already Exist";
            //         header("location:client_add.php?error=".$error);
            // }
            }

?>