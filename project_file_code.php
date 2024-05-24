<?php


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

echo 'ok2<br>';
include 'database.php'; 
echo 'ok3<br>';

//checking form submit
if (isset($_POST['submit'])){
    echo 'ok4<br>';

    //fetching project master id in varible
    $project_id=$_POST['project_master_id'];
    $allowed=['xls','csv','xlsx'];

    $filename=$_FILES['item_doc']['name'];
    $check=explode(",", $filename);
    $file_ext=end($check);


//fetching file name
        $inputFileName = $_FILES['item_doc']['tmp_name'];
       

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $data=$spreadsheet->getActiveSheet()->toArray();

         // Skip the first row (column headers)    
        array_shift($data);

        $i=0;
        echo 'ok5<br>';
        // foreach loop for $data in which file data sored as array 
        foreach ($data as $row){

            //$row[0] represent the excel files column 1 $row[1] == column 2
            echo $item_code =$row[0];
            echo $item_quantity =$row[1];

            // Checking if item code is null; if it is, break the loop and redirect
            if (empty($item_code)) {
                    // Redirect to index.php or any other page
                   // header("Location: index.php");
                    exit(); // Terminate script execution after the redirection
            }



                //query for fetching item it by item code 
            $sql_item="SELECT * FROM item where item_code='$item_code';";
            $result_item=mysqli_query($conn, $sql_item);
            $data_item=mysqli_fetch_array($result_item);
            //item it stored in varible 
            $item_id= $data_item['item_id'];

            echo $item_id;
            echo 'ok7<br>';
         

            $sql="Insert Into add_item_to_project (add_Item_to_project_assign_id, add_Item_to_project_item_id, add_Item_to_project_item_quantity, add_Item_to_project_is_visibility)
            Values('$project_id', '$item_id','$item_quantity','1')";
            $result=mysqli_query($conn, $sql);
            //checking value is inserted or not 
            if($result){
              //  echo 'data inserted';
                $success="Data Added Successfully";
                header('location: view_project.php?success='.$success."&id=".$project_id);
               
               //  echo 'ok8<br>';

                //else condition 
            }else{
                echo 'fail';

            }

          

            $i++;

            //foreach loop end here which run the loop as file array data
        }
        echo "done";


   /*

   echo 'ok6<br>';

            $sql_item="SELECT * FROM item where item_code='$item_code';";
            $result_item=mysqli_query($conn, $sql_item);
            $data_item=mysqli_fetch_array($result_item);
            $item_id= $data_item['item_id'];
            echo $item_id;
            echo 'ok7<br>';
         

            $sql="Insert Into add_item_to_project (add_Item_to_project_assign_id, add_Item_to_project_item_id, add_Item_to_project_item_quantity, add_Item_to_project_is_visibility)
            Values('$project_id', '$item_id','$item_quantity','1')";
            $result=mysqli_query($conn, $sql);
            if($result){
                echo 'data inserted';
                echo 'ok8<br>';

            }else{
                echo 'fail';

            }









}else{
        echo "fail to read file";

    }
*/
   
}





 
?>