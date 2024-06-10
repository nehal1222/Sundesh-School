<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES['filename']) && $_FILES['filename']['error'] == 0) {
        $upload_dir = 'uploads/'; // Directory to save the uploaded files
        $filename = $_FILES['filename']['name'];
        $file_tmp = $_FILES['filename']['tmp_name'];
        $file_size = $_FILES['filename']['size'];
        $file_type = $_FILES['filename']['type'];

        // Ensure the upload directory exists, create if not
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Sanitize the file name to avoid overwriting or security issues
        $filename = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $filename);

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($file_tmp, $upload_dir . $filename)) {
            echo "The file " . htmlspecialchars($filename) . " has been uploaded successfully.";
        } else {
            echo "There was an error moving the uploaded file.";
        }
    } else {
        echo "Error: " . $_FILES['filename']['error'];
    }
} else {
    echo "Invalid request method.";
}
?>
