<?php

session_start();
include 'database.php';
if(isset($_POST['submit'])){

    $username=$_POST['username'];
    $password=$_POST['password'];

    // $facility_id=$_POST['facility_id'];
   
    $sql ="select * from user where username= '$username' and password= '$password' LIMIT 1";
    $result= mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){//3
    foreach($result as $row){//2
        
    //    if($facility_id==$row['facility_id']){//1

        $username= $row['username'];
        $password= $row['password'];
      //  $facility_id= $row['facility_id'];
       
       
        header('location:index.php');
    
   // echo $facility_id;
   // print_r($facility_id);
    $_SESSION['auth']=true;
    $_SESSION['auth_user']=[

        'username'=>$username, 
        'password'=>$password,
        'facility_id'=>0,
        
      
    ];
        $_SESSION['status']= "Logged successfully";
      
      
    // }//2
}
    }
    else{
        $sql ="select * from project_user where project_username= '$username' and project_password= '$password' LIMIT 1";
        $result= mysqli_query($conn, $sql);
    
        if(mysqli_num_rows($result)>0){//3
        foreach($result as $row){//2
            
          //  if($facility_id==$row['facility_id']){//1
    
            $username= $row['project_username'];
            $password= $row['project_password'];
           $project_user_id= $row['project_user_id'];
           
           
            header('location:index.php');
        
       // echo $facility_id;
       // print_r($facility_id);
        $_SESSION['auth']=true;
        $_SESSION['auth_user']=[
    
            'username'=>$username, 
            'password'=>$password,
            'facility_id'=>1,
            'project_user_id'=>$project_user_id
            
          
        ];
            $_SESSION['status']= "Logged successfully";
          
          
        }//2
            // $_SESSION['status']= "invalid details";
            // header('location:login.php');
        }else{
            $_SESSION['status']= "access denied";
            header('location:login.php');
        }
        // $_SESSION['status']= "invalid details";
        // header('location:login.php');
    }
}else{
    $_SESSION['status']= "access denied";
    header('location:login.php');
}
?>