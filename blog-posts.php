<?php 
include("components/header.php");
require("admin-panel/includes/config.php");

// Check if a category ID is provided in the URL
if(isset($_GET['category_id'])) {
    // Sanitize the input to prevent SQL injection
    $category_id = htmlspecialchars($_GET['category_id']);
    
    // Fetch the category name
    $category_query = $conn->prepare("SELECT name FROM blog_categories WHERE id = ?");
    $category_query->execute([$category_id]);
    $category = $category_query->fetch(PDO::FETCH_ASSOC);
    
    // Fetch blog posts filtered by category ID and is_published = 1
    $query = $conn->prepare("SELECT blog_posts.*, blog_categories.name AS category_name 
                            FROM blog_posts 
                            JOIN blog_categories ON blog_posts.category_id = blog_categories.id 
                            WHERE blog_posts.category_id = ? AND blog_posts.is_published = 1
                            ORDER BY blog_posts.created_date DESC");
    $query->execute([$category_id]);
} else {
    // Fetch all blog posts where is_published = 1
    $query = $conn->query("SELECT blog_posts.*, blog_categories.name AS category_name 
                            FROM blog_posts 
                            JOIN blog_categories ON blog_posts.category_id = blog_categories.id 
                            WHERE blog_posts.is_published = 1
                            ORDER BY blog_posts.created_date DESC");
}

$posts = $query->fetchAll(PDO::FETCH_ASSOC);
?>

   <section>
   <div class="banner-area-wrapper">
            <div class="banner-area">	
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="banner-content-wrapper">
                                <div class="banner-content">
                                    <h1>Blog</h1> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    <div class="blog-details-area pt-60 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="cards-lists">
                    <?php
                        // Check if there are posts available
                        if (empty($posts)) {
                            // Display message when no posts are available
                            echo '<p>No posts available</p>';
                        } else {
                        foreach ($posts as $post) {
                            ?>
                            <div class="blog-card mb-5">
                               
                                    <!-- Card image on the left -->
                                    <div class="card-image">
                                        <img src="admin-panel/blog/asset/uploads/<?php echo $post['img']; ?>" class="img-fluid rounded-start" alt="<?php echo $post['title']; ?>">
                                    </div>
                                    <!-- Card content on the right -->
                                    <div class="blog-text-content">
                                        <div class="blog-card-body">
                                            <div class="content-head">
                                                <h2 class="card-title"><?php echo substr($post['title'], 0, 50); ?>...</h2>
                                                <br>
                                                <ul class="list-unstyled">
                                                    <li class="list-unstyled"><i class="fa-regular fa-calendar-check"></i><?php echo date('M Y', strtotime($post['created_date'])); ?></li>
                                                    <!-- <li class="list-unstyled">Category: <?php echo $post['category_name']; ?></li>  -->
                                                </ul>
                                            </div>
                                            <div class="card-btm">
                                                <li class="list-unstyled">Category: <?php echo $post['category_name']; ?></li> 
                                                <a href="blog.php?id=<?php echo $post['id']; ?>&topic=<?php echo urlencode($post['title']); ?>" class="btn btn-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                               
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- Sidebar fixed on the right side -->
                <div class="col-md-4">
                    <div class="blog-sidebar right" style="position: sticky; top: 0;">
                        <div class="single-blog-widget mb-47">
                            <?php 
                                include("components/side_about.php");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("components/footer.php");
?>
