<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';

$item_id = $_POST['selectedValue'];

$sql_item = "SELECT * FROM item as it Where it.item_is_visibility=1 AND item_category_id = '$item_id' order by item_code asc;";

$result_item = mysqli_query($conn, $sql_item);

$data_item = array();
while ($row = mysqli_fetch_assoc($result_item)) {

    $data_item[] = $row;
}
    echo json_encode($data_item);


?>