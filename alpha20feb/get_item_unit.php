<?php
include 'database.php';
// Your PHP code to fetch the item_unit based on the selected item_code goes here
// ...
$itemUnit=0;

if (isset($_POST['item_code'])) {
    $selectedItemCode = $_POST['item_code'];

    $sql="SELECT * FROM `item` WHERE item_id=$selectedItemCode;";
    $result=mysqli_query($conn, $sql);
    $data_unit=mysqli_fetch_array($result);

    // Query the database to get the corresponding item_unit
    // Replace this with your actual database query
    $itemUnit = $data_unit['item_unit'];

    if ($itemUnit !== false) {
        echo $itemUnit;
    } else {
        echo 'Item unit not found';
    }
} else {
    echo 'Invalid request';
}

?>
