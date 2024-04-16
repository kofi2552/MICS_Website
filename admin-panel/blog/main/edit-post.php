<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>

<?php


if(!isset($_SESSION['email'])) {
    header("location: ../../admins/login-admins.php");
    exit(); // Always exit after header redirection
}

// Fetch the post details
if(isset($_GET['id'])) {
    $postId =htmlspecialchars ($_GET['id']);
    $postQuery = $conn->prepare("SELECT blog_posts.id AS id, blog_posts.title AS title,
     blog_posts.img AS img, blog_posts.content AS content,blog_categories.name AS name, blog_posts.is_published AS status 
    FROM blog_categories 
    JOIN blog_posts ON blog_categories.id = blog_posts.category_id
    WHERE blog_posts.id = :id");
    $postQuery->execute([':id' => $postId]);
    $post = $postQuery->fetch(PDO::FETCH_OBJ);
}

// Update the post with new image if provided
if(isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $category = htmlspecialchars($_POST['category_id']);
    $status = htmlspecialchars($_POST['status']);
    $update_date = date("Y-m-d H:i:s"); // Get the current date and time
    $updated_by = $_SESSION['email']; // Get the user ID of the current user

    // Check if a new image file is uploaded
    if(isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $newImageName = $_FILES['new_image']['name'];
        $tempName = $_FILES['new_image']['tmp_name'];
        $uploadDir = "../../blog/asset/uploads/";
        $newImagePath = $uploadDir . $newImageName;

        // Move the uploaded file to the upload directory
        if(move_uploaded_file($tempName, $newImagePath)) {
            // Update the post with the new image path and updated_date
            $updateQuery = $conn->prepare("UPDATE blog_posts SET title = :title, img = :img, content = :content, category_id = :category_id, is_published = :status, updated_date = :updated_date, updated_by = :updated_by WHERE id = :id");
            $updateQuery->execute([
                ':title' => $title,
                ':img' => $newImageName, 
                ':content' => $content, 
                ':category_id' => $category, 
                ':status' => $status,
                ':updated_date' => $update_date, 
                ':updated_by' => $updated_by, 
                ':id' => $postId
            ]);
                // Set session variable indicating update status
                 $_SESSION['update_status'] = $updateQuery ? 'success' : 'failed';
            header("location: show-post.php");
            exit();
        }
    } else {
        // Update the post without changing the image
        $updateQuery = $conn->prepare("UPDATE blog_posts SET title = :title, content = :content, category_id = :category_id, is_published = :status, updated_date = :updated_date, updated_by = :updated_by WHERE id = :id");
        $updateQuery->execute([
            ':title' => $title,
            ':content' => $content, 
            ':category_id' => $category, 
            ':status' => $status, 
            ':updated_date' => $update_date, // Bind the updated_date value
            ':updated_by' => $updated_by, // Bind the updated_by value
            ':id' => $postId
        ]);
            // Set session variable indicating update status
            $_SESSION['update_status'] = $updateQuery ? 'success' : 'failed';
        header("location: show-post.php");
        exit();
    }
}
// echo "<script>succeddfully updated</script>"
?>



<style>
    /* Custom styles */
    .container {
        margin-top: 50px;
    }
    .image-thumbnail {
        max-width: 200px;
        max-height: 200px;
    }
</style>
</head>


<div class="container">
    <h1 class="mb-4">Edit Post</h1>
    <div class="container"> 
        <a href="<?php echo APPURL; ?>/<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-right">Home</a>

    <form action="edit-post.php?id=<?php echo $post->id; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo $post->title; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" class="form-control" rows="6" required><?php echo $post->content; ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category_id" class="form-control" required>
                <?php
                // Fetch categories from the database
                $categoriesQuery = $conn->query("SELECT id, name FROM blog_categories");
                $categories = $categoriesQuery->fetchAll(PDO::FETCH_OBJ);
                foreach ($categories as $category) {
                    $selected = ($category->id == $post->category_id) ? 'selected' : '';
                    echo "<option value='{$category->id}' $selected>{$category->name}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control">
                <option value="review" <?php echo ($post->status == 'review') ? 'selected' : ''; ?>>Review</option>
                <option value="published" <?php echo ($post->status == 'published') ? 'selected' : ''; ?>>Published</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Current Image:</label><br>
            <img src="../asset/uploads/<?php echo $post->img; ?>" alt="Post Image" class="image-thumbnail">
        </div>
        <div class="form-group">
            <label for="new_image">Choose New Image (Optional):</label>
            <input type="file" id="new_image" name="new_image" class="form-control-file">
        </div>
        <button type="submit" name="submit" class="btn btn-primary" >Save Changes </button>
    </form>
</div>

</body>
</html>
