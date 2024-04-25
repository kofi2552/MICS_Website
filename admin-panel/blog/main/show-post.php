<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>

<?php


if (!isset($_SESSION['email'])) {
    header("location: ../../admins/login-admins.php");
    exit(); // Always exit after header redirection
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10; // Number of items per page
$showAll = isset($_GET['show_all']) && $_GET['show_all'] == '1';

// Fetch posts with categories, including created_date, and order by ID in descending order
$query = "SELECT blog_posts.id AS id, blog_posts.title AS title,
 blog_posts.img AS img, blog_posts.content AS content, blog_posts.created_date AS created_date, blog_categories.name AS name, blog_posts.is_published AS status, blog_posts.created_by AS createdby
FROM blog_categories 
JOIN blog_posts ON blog_categories.id = blog_posts.category_id ";

if (!empty($search)) {
    $query .= "WHERE blog_posts.title LIKE '%$search%' OR blog_posts.content LIKE '%$search%' ";
}

if (!$showAll) {
    $offset = ($page - 1) * $limit;
    $query .= "ORDER BY blog_posts.id DESC LIMIT $limit OFFSET $offset";
}

$postsQuery = $conn->query($query);
$postsQuery->execute();
$posts = $postsQuery->fetchAll(PDO::FETCH_OBJ);

// Count total number of posts
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM blog_posts");
$totalQuery->execute();
$total = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($total / $limit);
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
        /* white-space: nowrap; */
    }
    .content-limit img {
        width: 50px !important;
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
        
        <div class="form-inline mt-2 mb-3">
            <div class="form-group mr-3">
             <label for="limit">Show:</label>
            <select class="form-control form-control-sm" name="limit" id="limit">
            <option value="10" <?php echo $limit == 10 ? 'selected' : ''; ?>>10</option>
            <option value="25" <?php echo $limit == 25 ? 'selected' : ''; ?>>25</option>
            <option value="50" <?php echo $limit == 50 ? 'selected' : ''; ?>>50</option>
            </select>
        </div>
            <div class="form-group mr-3">
                <label for="show_all">Show all records:</label>
                <select class="form-control form-control-sm" name="show_all" id="show_all">
                    <option value="0" <?php echo !$showAll ? 'selected' : ''; ?>>Paginated</option>
                    <option value="1" <?php echo $showAll ? 'selected' : ''; ?>>All</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Apply</button>
        </div>


        <a href="create-post.php" class="btn btn-primary mb-2 text-center float-right">Add New Post</a>
        <a href="../../<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-left padding 2">Home</a>
    </form>

    <div class="table-responsive">
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
                            <div class="content-limit"><?php echo nl2br(html_entity_decode(substr( $post->content, 0, 200))); ?></div>
                        </td>
                        <td><?php echo $post->name; ?></td>
                        <td><img src="../asset/uploads/<?php echo $post->img; ?>" alt="Post Image" class="image-thumbnail"></td>
                        <td>
                            <!-- <a href='edit-post.php?id=<?php //echo $post->id; ?>' class="btn btn-primary btn-sm m-1">Edit</a> -->
                            <a href='delete-post.php?id=<?php echo $post->id; ?>' class="btn btn-danger btn-sm m-1" onclick='return confirm("Are you sure you want to delete this post?")'>Delete</a>
                            
                            <?php if ($post->status == 1) : ?>
                            <a href='ispublished.php?id=<?php echo $post->id; ?>' class="btn btn-warning btn-sm m-1">Unpublish</a>
                        <?php else : ?>
                            <a href='ispublished.php?id=<?php echo $post->id; ?>' class="btn btn-success btn-sm m-1">Publish</a>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!$showAll && $totalPages > 1) : ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&search=<?php echo htmlentities($search); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
