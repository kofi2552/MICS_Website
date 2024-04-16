<?php 
include ("components/header.php");
require("admin-panel/includes/config.php");

// Check if the post ID is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $post_id = htmlspecialchars($_GET['id']);

    // Fetch the specific blog post from the database based on the post ID
    $query = $conn->prepare("SELECT blog_posts.*, blog_categories.name AS category_name 
                            FROM blog_posts 
                            JOIN blog_categories ON blog_posts.category_id = blog_categories.id 
                            WHERE blog_posts.id = ?");
    $query->execute([$post_id]);
    $post = $query->fetch(PDO::FETCH_ASSOC);

    // Check if a post with the given ID exists
    if($post) {
        // Display the blog post content
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-details">
                        <div class="blog-details-img">
                            <img class="img-fluid rounded-start p-3" src="admin-panel/blog/asset/uploads/<?php echo $post['img']; ?>" alt="<?php echo $post['title']; ?>"/>
                        </div>
                        <div class="blog-details-content">
                            <div class="content-heading">
                                <h2><?php echo $post['title']; ?></h2>
                                <ul class="list-unstyled">
                                    <li class="list-unstyled"><i class="fa-regular fa-calendar-check"> </i><?php echo $post['created_date']; ?></li>
                                    <li class="list-unstyled">Category: <?php echo $post['category_name']; ?></li>
                                    <li class="list-unstyled">&#9998; Admin</li>
                                
                                </ul>
                            </div>
                            <br>
                            <p class="card-text"><?php echo $post['content']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // If no post with the given ID exists, display an error message
        echo "Post not found.";
    }
} else {
    // If no post ID is provided in the URL, display an error message
    echo "Post ID not provided.";
}

echo "<br>";
echo "<br>";
echo "<br>";
?>
   
<?php
include ("components/footer.php");
?>
