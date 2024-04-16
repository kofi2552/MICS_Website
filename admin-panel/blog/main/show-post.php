<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>

<?php


if (!isset($_SESSION['email'])) {
    header("location: ../../admins/login-admins.php");
    exit(); // Always exit after header redirection
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch posts with categories, including created_date, and order by ID in descending order
$query = "SELECT blog_posts.id AS id, blog_posts.title AS title,
 blog_posts.img AS img, blog_posts.content AS content, blog_posts.created_date AS created_date, blog_categories.name AS name, blog_posts.is_published AS status, blog_posts.created_by AS createdby
FROM blog_categories 
JOIN blog_posts ON blog_categories.id = blog_posts.category_id ";

if (!empty($search)) {
    $query .= "WHERE blog_posts.title LIKE '%$search%' OR blog_posts.content LIKE '%$search%' ";
}

$query .= "ORDER BY blog_posts.id DESC";

$postsQuery = $conn->query($query);
$postsQuery->execute();
$posts = $postsQuery->fetchAll(PDO::FETCH_OBJ);

?>


<style>
    /* Custom styles */
    .image-thumbnail {
        max-width: 100px;
        max-height: 100px;
    }

    .content-limit {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="container">
    <h1 class="mb-4">Post Management</h1>

    <!-- Display update status message -->
    <?php if(isset($_SESSION['update_status'])): ?>
        <div class="alert <?php echo $_SESSION['update_status'] === 'success' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
            <?php echo $_SESSION['update_status'] === 'success' ? 'Changes applied successfully!' : 'Failed to update. Please try again.'; ?>
        </div>
        <?php unset($_SESSION['update_status']); ?>
    <?php endif; ?>

    <!-- Display created status message -->
    <?php if(isset($_SESSION['created_status'])): ?>
        <div class="alert <?php echo $_SESSION['created_status'] === 'success' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
            <?php echo $_SESSION['created_status'] === 'success' ? 'Post created successfully!' : 'Failed to create Post. Please try again.'; ?>
        </div>
        <?php unset($_SESSION['created_status']); ?>
    <?php endif; ?>

    <form action="" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" value="<?php echo htmlentities($search); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <div class="container"> 
        <a href="<?php echo APPURL; ?>/<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-left">Home</a>
        <a href="create-post.php" class="btn btn-primary mb-4 text-center float-right">Add New Post</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Created Date</th>
                    <th>Created By</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo $post->created_date; ?></td>
                        <td><?php echo $post->createdby; ?></td>
                        <td><?php echo $post->title; ?></td>
                        <td>
                            <div class="content-limit"><?php echo $post->content; ?></div>
                        </td>
                        <td><?php echo $post->name; ?></td>
                        <td><img src="../asset/uploads/<?php echo $post->img; ?>" alt="Post Image" class="image-thumbnail"></td>
                        <td>
                            <a href='edit-post.php?id=<?php echo $post->id; ?>' class="btn btn-primary btn-sm">Edit</a>
                            <a href='delete-post.php?id=<?php echo $post->id; ?>' class="btn btn-danger btn-sm" onclick='return confirm("Are you sure you want to delete this post?")'>Delete</a>
                            <?php if ($post->status == 'review') : ?>
                                <a href='#' class="btn btn-success btn-sm">Publish</a>
                            <?php elseif ($post->status == 'published') : ?>
                                <a href='#' class="btn btn-warning btn-sm">Unpublish</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
