<?php
require "../../includes/config.php";

// Check if category ID is provided in the URL
if(isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Fetch the category details from the database
    $categoryQuery = $conn->prepare("SELECT * FROM blog_categories WHERE id = :id");
    $categoryQuery->execute([':id' => $categoryId]);
    $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);

    // Check if form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $categoryName = $_POST['name'];

        // Update category in the database
        $updateQuery = $conn->prepare("UPDATE blog_categories SET name = :name WHERE id = :id");
        $updateQuery->execute([':name' => $categoryName, ':id' => $categoryId]);

        // Redirect to show-categories.php page
        header("Location: show-categories.php");
        exit();
    }
} else {
    // Redirect back to show-categories.php if category ID is not provided
    header("Location: show-categories.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Category</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $category['name']; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Update Category</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
