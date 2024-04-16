<?php
require "../../layouts/header.php";
require "../../includes/config.php";


if (!isset($_SESSION['email'])) {
    header("location: ../../admins/login-admins.php");
    exit(); // Always exit after header redirection
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);

    // Prepare and execute SQL query to insert the category
    $insertQuery = $conn->prepare("INSERT INTO blog_categories (name) VALUES (:name)");
    $insertQuery->execute([':name' => $name]);

    // Redirect to a relevant page after category creation
    header("Location: show-categories.php"); // Redirect to a page to display categories
    exit();
}
?>


<div class="container">
    <h1 class="mb-4">Create Category</h1>
    <a href="<?php echo APPURL; ?>/<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-right">Home</a>
    <form action="create-blog-category.php" method="POST">
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>

</body>
</html>
