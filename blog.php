<?php 

include ("components/header.php");

require("admin-panel/includes/config.php");

$topic = isset($_GET['topic']) ? urldecode($_GET['topic']) : '';

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

    // Fetch related posts based on the category of the current post
    if($post) {
        $related_query = $conn->prepare("SELECT blog_posts.*, blog_categories.name AS category_name 
                                    FROM blog_posts 
                                    JOIN blog_categories ON blog_posts.category_id = blog_categories.id 
                                    WHERE blog_posts.category_id = ? AND blog_posts.id != ? AND blog_posts.is_published = 1
                                    ORDER BY blog_posts.created_date DESC 
                                    LIMIT 3");
        $related_query->execute([$post['category_id'], $post['id']]);

        $related_posts = $related_query->fetchAll(PDO::FETCH_ASSOC);
    }


 ?>


		<!-- Header Area End -->
		<!-- Banner Area Start -->
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
		<!-- Banner Area End -->
        <!-- Blog Start -->
        <div class="blog-details-area pt-60 pb-140">
            <div class="container">
                <div class="row">
                    <?php   // Check if a post with the given ID exists
                        if($post) {
                            // Display the blog post conten
                            ?>
                    <div class="col-md-8">
                        <div class="blog-details">
                            <div class="blog-details-img">
                                <img class="blog-image" src="admin-panel/blog/asset/uploads/<?php echo $post['img']; ?>" alt="MICS_blog-image"/>
                            </div>
                            <div class="blog-details-content">
                                <div class="content-heading">
                                  <h2><?php echo $post['title']; ?></h2>
                                    <ul>
                                        <li><i class="fa-regular fa-calendar-check"></i><?php echo date('M Y', strtotime($post['created_date'])); ?></li>
                                        <li><?php echo $post['category_name']; ?></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="post-content">
                                    <?php 
                                    // Get the content of the post
                                    $content = nl2br(html_entity_decode($post['content'])); 
                                    
                                    // Use regular expression to close any unclosed image tags
                                    $content = preg_replace('/<img(.*?)>/', '<img$1/>', $content);
                                    
                                    // Wrap the content in a valid HTML structure
                                    $content = '<div>' . $content . '</div>';
                                    
                                    // Create a DOMDocument instance
                                    $dom = new DOMDocument();
                                    
                                    // Suppress errors while loading HTML
                                    libxml_use_internal_errors(true);
                                    
                                    // Load the HTML content into the DOMDocument
                                    $dom->loadHTML($content);
                                    
                                    // Get all img tags
                                    $imgTags = $dom->getElementsByTagName('img');
                                    
                                    // Loop through each img tag
                                    foreach ($imgTags as $imgTag) {
                                        // Get the src attribute
                                        $src = $imgTag->getAttribute('src');
                                        
                                        // Remove HTML tags from the src attribute
                                        $src = strip_tags($src);
                                        
                                        // Set the cleaned src attribute
                                        $imgTag->setAttribute('src', $src);
                                        
                                        // Append two empty spaces after the img tag
                                        $imgTag->parentNode->appendChild($dom->createTextNode('  '));
                                    }
                                    
                                    // Output the modified content, excluding the wrapper div
                                    echo $dom->saveHTML($dom->documentElement->firstChild); 
                                    ?>
                                </div>


                            </div>
                        </div>
                    </div>
                    <?php  }   ?>
                    <div class="col-md-4">
                        <div class="right-content">
                            <div class="related-blog-posts blog-sidebar right">
                                <h3>Related Posts</h3>
                       
                                <?php
                                if (empty($related_posts)) {
                                    echo "<p>No related posts</p>";
                                } else {
                                    $counter = 1; // Initialize a counter to 1 to start from the second post

                                    foreach ($related_posts as $post) {
                                        // Check if the counter exceeds 3
                                        if ($counter > 3) {
                                            break; // Exit the loop if 3 posts have been displayed
                                        }
                                        ?>
                                        <a href="blog.php?id=<?php echo $post['id']; ?>&topic=<?php echo urlencode($post['title']); ?>">
                                            <div class="single-related-post">
                                                <img src="admin-panel/blog/asset/uploads/<?php echo $post['img']; ?>" alt="MICS_<?php echo $post['title']; ?>">
                                                <div class="overlay-content">
                                                    <p><?php echo substr($post['title'], 0, 200); ?>...</p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                        $counter++; // Increment the counter after displaying each post
                                    }

                                    // Check if the counter is still 0 after the loop
                                    if ($counter === 0) {
                                        echo "<p>No related posts</p>";
                                    }
                                }
                                ?>
                            </div>
                            <div class="blog-sidebar right">
                                <div class="single-blog-widget mb-47">
                                    <?php 
                                        include ("components/side_about.php");
                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
            
       

<?php
 }

include("components/footer.php");
?>