<?php
// Include your database connection file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the AJAX request
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Validate and sanitize input (you may need to customize this based on your requirements)
    $id = intval($id);
    $column = mysqli_real_escape_string($conn, $column);
    $value = mysqli_real_escape_string($conn, $value);

    // Update the data in the database
    $query = "UPDATE detail_input SET $column = '$value', status_data='Lengkap' WHERE id_temporary = $id";

    if (mysqli_query($conn, $query)) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method";
}
?>
