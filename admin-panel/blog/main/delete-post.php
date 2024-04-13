<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>



<?php


if(!isset($_SESSION['email'])) {
    header("location: http://localhost/micsweb/admin-panel/admins/login-admins.php");
    exit(); // Always exit after header redirection
}

// Check if post ID is provided
if(isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Delete the post from the database
    $deleteQuery = $conn->prepare("DELETE FROM blog_posts WHERE id = :id");
    $deleteQuery->execute([':id' => $postId]);

    // Redirect back to the post management page after deletion
    header("location: show-post.php");
    exit(); // Always exit after header redirection
} else {
    // Redirect back to the post management page if post ID is not provided
    header("location: show-post.php");
    exit(); // Always exit after header redirection
}
?>

