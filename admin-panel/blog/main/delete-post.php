<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>



<?php


if(!isset($_SESSION['email'])) {
    header("location: ../../admins/login-admins.php");
    exit(); 
}

// Check if post ID is provided
if(isset($_GET['id'])) {
    $postId = htmlspecialchars($_GET['id']);

    // Delete the post from the database
    $deleteQuery = $conn->prepare("DELETE FROM blog_posts WHERE id = :id");
    $deleteQuery->execute([
        ':id' => $postId
    ]);
        // Set session variable indicating update status
        $_SESSION['deleted_status'] = $deleteQuery ? 'success' : 'failed';
    // Redirect back to the post management page after deletion
    header("location: show-post.php");
    exit(); 
} else {
    // Set session variable indicating update status
    $_SESSION['deleted_status'] = $deleteQuery ? 'success' : 'failed';
    // Redirect back to the post management page if post ID is not provided
    header("location: show-post.php");
    exit(); 
}
?>

