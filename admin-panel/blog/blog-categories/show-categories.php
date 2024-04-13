<?php
require "../../layouts/header.php";
require "../../includes/config.php";

// Assuming $conn is your PDO connection

if (!isset($_SESSION['email'])) {
    header("location: http://localhost/micsweb/admin-panel/admins/login-admins.php");
    exit(); // Always exit after header redirection
}

// Fetch categories from the database
$categoriesQuery = $conn->query("SELECT * FROM blog_categories");
$categories = $categoriesQuery->fetchAll(PDO::FETCH_OBJ);
?>



<div class="container">
    <br>
    <h1 class="mb-4">Categories</h1>
    <a href="<?php echo APPURL?>/blog/blog-categories/create-blog-category.php" class="btn btn-primary mb-4 text-center float-center">Add Categories</a>
        <a href="<?php echo APPURL; ?>/<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-right">Home</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category->id; ?></td>
                <td><?php echo $category->name; ?></td>
                <td>
                    <a href='edit-blog-categories.php?id=<?php echo $category->id; ?>' class="btn btn-primary btn-sm">Edit</a>
                    <a href='delete-blog-categories.php?id=<?php echo $category->id; ?>' class="btn btn-danger btn-sm" onclick='return confirm("Are you sure you want to delete this category?")'>Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
