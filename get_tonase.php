<?php
include "config.php";

// Get the selected dt from the AJAX request
$namaDT = $_GET['nama_dt'];

// Query to retrieve tonase based on the selected dt
$sql = "SELECT pengukuran.nilai as tonase FROM unit_dt
        INNER JOIN pengukuran ON unit_dt.id_ukur = pengukuran.id_ukur
        WHERE unit_dt.unit = '$namaDT'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch tonase data
    $row = $result->fetch_assoc();
    $tonase = $row['tonase'];

    // Output tonase as JSON
    echo $tonase;
} else {
    // If no tonase data is found, output an empty JSON object
    echo "";
}

// Close the database connection
$conn->close();
?>


