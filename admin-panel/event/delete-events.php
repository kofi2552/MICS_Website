<?Php 
session_start();
?>

<?php
require "../includes/config.php"; 



if(!isset($_SESSION['email'])) {
    header("location: ../login-admins.php");
    exit(); 
}

// Check if post ID is provided
if(isset($_GET['id'])) {
    $eventid = htmlspecialchars($_GET['id']);

    // Delete the post from the database
    $deleteQuery = $conn->prepare("DELETE FROM events WHERE id = :id");
    $deleteQuery->execute([
        ':id' => $eventid
    ]);
        // Set session variable indicating update status
        $_SESSION['delete_status'] = $deleteQuery ? 'success' : 'failed';
    // Redirect back to admins page after deletion
    header("location: show-events.php");
    exit(); 
} else {
    /// Redirect back to admins page if post ID is not provided
    header("location: show-events.php");
    exit(); 
}
?>

