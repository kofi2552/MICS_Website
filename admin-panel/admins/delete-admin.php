<?php require "../layouts/header.php"; ?>
<?php require "../includes/config.php"; ?>

<?php


if(!isset($_SESSION['email'])) {
    header("location: login-admins.php");
    exit(); 
}

// Check if post ID is provided
if(isset($_GET['id'])) {
    $adminid = htmlspecialchars($_GET['id']);

    // Delete the post from the database
    $deleteQuery = $conn->prepare("DELETE FROM admins WHERE id = :id");
    $deleteQuery->execute([
        ':id' => $adminid
    ]);
        // Set session variable indicating update status
        $_SESSION['delete_status'] = $deleteQuery ? 'success' : 'failed';
    // Redirect back to admins page after deletion
    header("location: admins.php");
    exit(); 
} else {
    /// Redirect back to admins page if post ID is not provided
    header("location: admins.php");
    exit(); 
}
?>

