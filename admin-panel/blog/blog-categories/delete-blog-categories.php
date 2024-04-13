<?php
require "../../includes/config.php";

// Check if category ID is provided in the URL
if(isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Prepare and execute a DELETE query to delete the category
    $deleteQuery = $conn->prepare("DELETE FROM blog_categories WHERE id = :id");
    $deleteQuery->execute([':id' => $categoryId]);

    // Check if deletion was successful
    if($deleteQuery) {
        // Redirect back to the show-categories.php page with a success message
        header("Location: show-categories.php?success=Category+deleted+successfully");
        exit();
    } else {
        // Redirect back to the show-categories.php page with an error message
        header("Location: show-categories.php?error=Failed+to+delete+category");
        exit();
    }
} else {
    // Redirect back to the show-categories.php page if category ID is not provided
    header("Location: show-categories.php");
    exit();
}
?>
