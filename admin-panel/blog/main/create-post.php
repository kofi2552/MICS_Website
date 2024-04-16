<?php require "../../layouts/header.php"; ?>
<?php require "../../includes/config.php"; ?>

<?php 
    if(!isset($_SESSION['email'])) {
        header("location: ../../admins/login-admins.php");
        exit(); 
    }
?>
<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    if ($_POST['title'] == ''  || $_POST['content'] == '' || $_POST['category_id'] == '' || !isset($_FILES['img'])) {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Some fields are left empty or image is not uploaded!!!
              </div>";
    } else {
        $title = htmlspecialchars($_POST['title']);
        $content = $_POST['content'];
        $category = htmlspecialchars($_POST['category_id']);
        $createdBy = $_SESSION['email']; 
        
        // Handle image upload
        $targetDir = "../asset/uploads/"; // Directory where images will be stored
        $targetFile = $targetDir . basename($_FILES["img"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "<div class='alert alert-danger text-center' role='alert'>
                        Sorry, only JPG, JPEG, PNG & GIF files are allowed.
                      </div>";
                exit();
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>
                    File is not an image.
                  </div>";
            exit();
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            $image = basename($_FILES["img"]["name"]);

            // Insert data into the database
            $insert = $conn->prepare("INSERT INTO blog_posts (title,img,content,category_id,created_by) VALUES
                (:title,:img,:content,:category_id,:created_by)");

            $insert->execute([
                ':title' => $title,
                ':img' => $image,
                ':content' => $content,
                ':category_id' => $category,
                ':created_by' => $createdBy
            ]);
            
            
            $_SESSION['created_status'] = $insert ? 'success' : 'failed';
            header("location: show-post.php?success=true");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>
                    Sorry, there was an error uploading your file.
                  </div>";
            exit();
        }
    }
}
?>




    <style>
        /* Additional CSS styles */
        body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h1 class="mb-4">Add Post</h1>
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

<?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
    <div class="alert alert-success" role="alert">
        Post added successfully!
    </div>
<?php endif; ?>
<br>
<form action="create-post.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>

   
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
    </div>

    <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category_id" class="form-control" required>
            <?php
            // Fetch categories from the database
            $stmt = $conn->query("SELECT id, name FROM blog_categories");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" id="img" name="img" class="form-control-file" accept="image/*" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
