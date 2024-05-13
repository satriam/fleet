<?php
// Include your database connection code
	include 'config.php';

// Check if the loading point is set in the POST request
if (isset($_POST['loadingPoint'])) {
    $loadingPoint = $_POST['loadingPoint'];
    $tanggal = $_POST['tanggal'];
    $grup = $_POST['grup'];
    $shift = $_POST['shift'];
    // var_dump($loadingPoint);die;

    // Query the database to get the dumping points associated with the selected loading point
    $query = "SELECT dumping_point FROM `detail_input` where Pengukuran='beltscale'AND tanggal='$tanggal' AND grup='$grup' AND shift='$shift'AND  loading_point='$loadingPoint' GROUP BY dumping_point;";
    $result = mysqli_query($conn, $query);

    // Build HTML options for dumping point dropdown
    $options = '<option disabled selected> Pilih </option>';
    while ($data = mysqli_fetch_array($result)) {
        $options .= '<option value="' . $data['dumping_point'] . '">' . $data['dumping_point'] . '</option>';
    }

    // Return the HTML options
    echo $options;
} else {
    // Return an error message if loading point is not set
    echo 'Error: Loading point not set.';
}

// Close the database connection
mysqli_close($conn);
?>
