<div class="single-blog-widget mb-47">
    <h3>Blog Categories</h3>
    <ul>
        <?php
        // Fetch all categories and the count of published posts in each category
        $category_query = $conn->query("SELECT blog_categories.*, COUNT(blog_posts.id) AS post_count 
                                        FROM blog_categories 
                                        LEFT JOIN blog_posts ON blog_categories.id = blog_posts.category_id 
                                        WHERE blog_posts.is_published = 1
                                        GROUP BY blog_categories.id");
        $categories = $category_query->fetchAll(PDO::FETCH_ASSOC);
        
        // Loop through each category and display it with the published post count
        foreach ($categories as $category) {
            ?>
            <li><a href="blog-posts.php?category_id=<?php echo $category['id']; ?>&<?php echo $category['name']; ?>"><?php echo $category['name']; ?> (<?php echo $category['post_count']; ?>)</a></li>
            <?php
        }
        ?>
    </ul>
</div>
