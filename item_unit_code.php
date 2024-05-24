<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])) {
    $item_unit_name = $_POST['item_unit_name'];
    $item_unit_quantity = $_POST['item_unit_quantity'];

    // Establish your database connection here (assuming $conn is your connection object)
    mysqli_set_charset($conn, "utf8mb4");

    // Use prepared statement to prevent SQL injection
    $sql_c = "SELECT * FROM item_unit WHERE item_unit_name=?";
    $stmt = mysqli_prepare($conn, $sql_c);

    // Check if the statement was prepared successfully
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $item_unit_name);
        mysqli_stmt_execute($stmt);

     
        // Get the result
        $result_c = mysqli_stmt_get_result($stmt);

        if (!mysqli_num_rows($result_c) > 0) {
            // Record doesn't exist, you can proceed to insert or perform other actions
            $sql_ds = "INSERT INTO item_unit (item_unit_name, item_unit_quantity) VALUES (?, ?)";
            $stmt_ds = mysqli_prepare($conn, $sql_ds);

          



            // Check if the INSERT statement was prepared successfully
            if ($stmt_ds) {
                mysqli_stmt_bind_param($stmt_ds, "ss", $item_unit_name, $item_unit_quantity);
                $result_ds = mysqli_stmt_execute($stmt_ds);

                // Check if the INSERT statement was executed successfully
                if ($result_ds) {
                    $success = "Data Added Successfully";
                    header('location: item_unit.php?success=' . $success);
                    exit();
                } else {
                    echo "Error executing INSERT statement: " . mysqli_stmt_error($stmt_ds);
                }

                // Close the prepared statement
                mysqli_stmt_close($stmt_ds);
            } else {
                // Handle the case where the statement preparation failed
                echo "Error preparing statement for INSERT: " . mysqli_error($conn);
            }
        } else {
            $error = "Unit name $item_unit_name is already exist in the Data";
            header('location:item_unit.php?error=' . $error);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement preparation failed
        echo "Error preparing statement for SELECT: " . mysqli_error($conn);
    }

    // Close the database connection when done
    mysqli_close($conn);
}
?>
