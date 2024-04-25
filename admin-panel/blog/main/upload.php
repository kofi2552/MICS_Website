
<?php
// Check if file is uploaded successfully
if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
    $uploadedFileName = $_FILES['imageFile']['name'];
    $tempFilePath = $_FILES['imageFile']['tmp_name'];
    $targetDir = "blogImgs/"; // Directory to store uploaded images
    $targetFilePath = $targetDir . basename($_FILES["imageFile"]["name"]);

    // Move uploaded file to target directory
    if (move_uploaded_file($tempFilePath, $targetFilePath)) {
        // Generate image URL
        $imageUrl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $targetFilePath;

        // Return image URL as JSON
        echo json_encode(["imageUrl" => $imageUrl]);
    } else {
        // Return error message as JSON
        echo json_encode(["error" => "Failed to move uploaded file"]);
    }
} else {
    // Return error message as JSON
    echo json_encode(["error" => "No file uploaded"]);
}
?>



