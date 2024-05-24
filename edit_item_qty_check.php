<?php


include "database.php";
if (isset($_POST['action']) && $_POST['action'] === 'fetch_item_quantity') {
    // Fetch item quantity based on itemId
    $itemId = $_POST['itemId'];
 
    $sql_ch = "SELECT add_Item_to_project_item_quantity2 FROM add_item_to_project WHERE add_Item_to_project_id = $itemId";
    $result = mysqli_query($conn, $sql_ch);

    if ($result) {
        $fetch_ch = mysqli_fetch_assoc($result);
        // $unit2 = $fetch_ch['add_Item_to_project_item_quantity2'];

        // Check the value and send the response back
        if ($fetch_ch['add_Item_to_project_item_quantity2'] == 0) {
            echo 1; // Two input boxes
        } else {
            echo 0; // One input box
        }
    } else {
        // Handle if query fails
        echo -1; // Sending an error flag
    }
}
?>


