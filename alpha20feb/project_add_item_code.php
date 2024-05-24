<?php


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


include 'database.php'; 


if (isset($_POST['save'])) {


    $project_id = $_POST['project_master_id'];
    $allowed = ['xls', 'csv', 'xlsx'];

    $filename = $_FILES['item_doc']['name'];
    $check = explode(",", $filename);
    $file_ext = end($check);

    $inputFileName = $_FILES['item_doc']['tmp_name'];

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
    $data = $spreadsheet->getActiveSheet()->toArray();
    array_shift($data);

    // $i = 0;
    $duplicateData = array();
$duplicatecategory = array();

foreach ($data as $row) {
    $item_c = mysqli_real_escape_string($conn, $row[0]);
    $item_code = mysqli_real_escape_string($conn, $row[1]);
    $item_unit1 = mysqli_real_escape_string($conn, $row[2]);
    $item_unit2 = mysqli_real_escape_string($conn, $row[3]);
    $emission_factor = mysqli_real_escape_string($conn, $row[4]);
    $ideal_emission = mysqli_real_escape_string($conn, $row[5]);
    $m_detail = mysqli_real_escape_string($conn, $row[6]);
    $description = mysqli_real_escape_string($conn, $row[7]);

    if (empty($item_c)) {
        continue;
    }

    $item_categ = strtolower($item_c);

    $sql_item_category = "SELECT item_category_id FROM item_category WHERE item_category_name='$item_categ'";
    $result_item_category = mysqli_query($conn, $sql_item_category);

    if (!mysqli_num_rows($result_item_category) > 0) {
        $duplicatecategory[] = $item_c;
        continue; // Skip the rest of the loop for this row
    }

    $data_item_category = mysqli_fetch_array($result_item_category);
    $item_id = $data_item_category['item_category_id'];

    $sql_c = "SELECT * FROM item WHERE item_code='$item_code'";
    $result_c = mysqli_query($conn, $sql_c);

    if (!mysqli_num_rows($result_c) > 0) {
        $sql = "INSERT INTO item (item_code, item_description, item_unit, item_unit2, item_material_detail, item_emission_factor, ideal_emission_factor, item_category_id)
                VALUES ('$item_code', '$description', '$item_unit1', '$item_unit2', '$m_detail', '$emission_factor', '$ideal_emission', '$item_id')";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // echo 'fail';
        }
    } else {
        $duplicateData[] = $row;
    }
}

if (!empty($duplicateData)) {
    $duplicatep = implode(',', array_map(function ($row) {
        return $row[1]; // Assuming the item_code is at index 1
    }, $duplicateData));

    $duplicatep = "<b>$duplicatep</b>";
    header('location: item.php?error=' . urlencode('Items ' . $duplicatep . ' already Existing'));
}

if (!empty($duplicatecategory)) {
    $uniqueCategories = array_unique($duplicatecategory);
    $duplicatecat = implode(', ', $uniqueCategories); // Note the space after the comma
    $duplicatecat = "<b>$duplicatecat</b>";
    header('location: item.php?error=' . urlencode('Categories ' . $duplicatecat . ' not found'));
    exit;
}


    
    // Continue with the rest of your code...
    

    // if(!empty($duplicatecategory))
    // {
    //     $duplicatecat = implode(',', array_map(function ($row) {
    //         return $row[1]; // Assuming the item_code is at index 1
    //     }, $duplicatecategory));
        
    //     $duplicatecat = "<b>$duplicatecat</b>";
    //     header('location: item.php?error=' . urlencode('Items ' . $duplicatecat . ' already Existing'));
    // }

   
    // ;
    
    
    
    // if (!empty($duplicateData)) {

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $headers = array('Item C', 'Item Code', 'Item Unit 1', 'Item Unit 2', 'Emission Factor', 'Ideal Emission', 'Material Detail', 'Description');
    //     $sheet->fromArray([$headers], null, 'A1');

    //     $sheet->fromArray($duplicateData, null, 'A2');

    //     $writer = new Xlsx($spreadsheet);

    //     $tmpFilePath = 'duplicate_data.xlsx';
    //     $writer->save($tmpFilePath);
         

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="duplicate_data.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     readfile($tmpFilePath);
   

    // } else {
    //     // $success="Data Added Successfully";
    //     // header('location: view_project.php?success='.$success."&id=".$project_id);
    // }
   
    if (!empty($success)) {
          $success="Data Added Successfully";
        header('location:item.php?success='.$success);
    } else {
        // echo 'fail';
    }
}




      
    
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
        */
?>