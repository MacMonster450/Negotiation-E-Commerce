<?php

require '../../Config/config.php';

    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Get image ID from URL parameter
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $image_id = $_GET['id'];
} else {
    echo "Invalid image ID";
    exit;
}


$sql = "SELECT image_data FROM images WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $image_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($image_data);
    $stmt->fetch();


    header("Content-type: image/*");
    

    echo $image_data;
} else {
    echo "Image not found";
}


$stmt->close();
$conn->close();
?>
