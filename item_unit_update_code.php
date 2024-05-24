<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])) {
    $item_unit_id = $_POST['item_unit_id'];
    $item_unit_name = $_POST['item_unit_name'];
    $item_unit_quantity = $_POST['item_unit_quantity'];

    // Establish your database connection here (assuming $conn is your connection object)
    mysqli_set_charset($conn, "utf8mb4");

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE item_unit SET item_unit_name=?, item_unit_quantity=? WHERE item_unit_id=?";


    $stmt = mysqli_prepare($conn, $sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $item_unit_name, $item_unit_quantity, $item_unit_id);
        $result = mysqli_stmt_execute($stmt);
       
      
        // Check if the UPDATE statement was executed successfully
        if ($result) {
            $update = "Data Updated Successfully";
            header('location: item_unit.php?update=' . $update);
            exit();
        } else {
            echo "Error executing UPDATE statement: " . mysqli_stmt_error($stmt);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement preparation failed
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the database connection when done
    mysqli_close($conn);
}
?>
