<?php
include 'database.php'; 
if (isset($_POST['submit'])){

    require('PHPExcel/PHPExcel.php');
    require('PHPExcel/PHPExcel/IOFactory.php');


    $file=$_FILES['doc']['tmp_name'];

    $obj=PHPExcel_IOFactory::load($file);
    foreach($obj->getWorksheetIterator() as $sheet){

        $getrow=$sheet->getHighestRow();

      /*  for($i=0;$i<=$getrow;$i++){

            $name=

        }*/

       // echo "<pre>";
       // print_r($sheet);
    }





   // echo '<pre>';
print_r($_FILES);
}





 
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
</head>
<body>
  hello

  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="doc" />
    <input type="submit" name="submit" />

  </form>


</body>
</html>