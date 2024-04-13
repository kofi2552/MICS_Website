<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>

<?php
// Assuming $conn is your PDO connection

if(!isset($_SESSION['email'])) {
    header("location: http://localhost/micsweb/admin-panel/admins/login-admins.php");
    exit(); // Always exit after header redirection
}

// Fetch posts with categories, including created_date, and order by ID in descending order
$postsQuery = $conn->query("SELECT blog_posts.id AS id, blog_posts.title AS title,
 blog_posts.img AS img, blog_posts.content AS content, blog_posts.created_date AS created_date, blog_categories.name AS name, blog_posts.is_published AS status 
FROM blog_categories 
JOIN blog_posts ON blog_categories.id = blog_posts.category_id
ORDER BY blog_posts.id DESC"); // Order by ID in descending order
$postsQuery->execute();
$posts = $postsQuery->fetchAll(PDO::FETCH_OBJ);

?>


    <style>
        /* Custom styles */
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .image-thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
        .content-limit {
            max-width: 300px; /* Adjust the width as needed */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    <!-- //i created this code to dynamically take you to the right home page based on your roles you have      -->
<div class="container">
    <h1 class="mb-4">Post Management</h1>
    <table class="table table-bordered">
        <a href="<?php echo APPURL; ?>/<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-left">Home</a>
<!-- it ends here -->
                
    <a href="<?php echo APPURL?>/blog/main/create-post.php" class="btn btn-primary mb-4 text-center float-right">Add New Post</a>
                <br>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post->title; ?></td>
                <td><div class="content-limit"><?php echo $post->content; ?></div></td>
                <td><?php echo $post->name; ?></td>
                <td><img src="<?php echo APPURL ?>/blog/asset/uploads/<?php echo $post->img; ?>" alt="Post Image" class="image-thumbnail"></td>
                <td>
                    <a href='edit-post.php?id=<?php echo $post->id; ?>' class="btn btn-primary btn-sm">Edit</a>
                    <a href='delete-post.php?id=<?php echo $post->id; ?>' class="btn btn-danger btn-sm" onclick='return confirm("Are you sure you want to delete this post?")'>Delete</a>
                    <?php if ($post->status == 'review'): ?>
                        <a href='#' class="btn btn-success btn-sm">Publish</a>
                    <?php elseif ($post->status == 'published'): ?>
                        <a href='#?>' class="btn btn-warning btn-sm">Unpublish</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
