<?php
// Include your database configuration file
 require "../../includes/config.php";

//  if(!isset($_SESSION['email'])) {
//     header("location: ../../admins/login-admins.php");
//     exit(); 
// }

// Function to toggle the ispublished field for a post
function togglePublished($post_id) {
    global $conn;
    
    // Prepare the SQL statement to update the ispublished field
    $query = $conn->prepare("UPDATE blog_posts SET is_published = NOT is_published WHERE id = ?");
    
    // Bind the post_id parameter to the SQL statement
    $query->execute([$post_id]);
    
    // Check if the update was successful
    if ($query->rowCount() > 0) {
        return true; // Return true if the update was successful
    } else {
        return false; // Return false if no rows were affected (post_id not found)
    }
}

// Check if the post ID is provided in the URL

if (isset($_GET['id'])) {
    $post_id = htmlspecialchars($_GET['id']);
    
    // Call the togglePublished function with the post ID
    if (togglePublished($post_id)) {
        echo "<script>alert('Publication status toggled successfully.'); window.location.href = 'show-post.php';</script>";
    } else {
        echo "<script>alert('Post not found or unable to toggle publication status.'); window.location.href = 'show-post.php';</script>";
    }
} else {
    echo "<script>alert('Post ID not provided.'); window.location.href = 'show-post.php';</script>";
}
?>

 <section>
    <div class="post-status">
         <h1>The post status was toggled successfully!</h1>
     </div>
 </section>
