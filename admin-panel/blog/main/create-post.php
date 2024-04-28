<?php 
ob_start();
require "../../layouts/header.php"; 
 require "../../includes/config.php"; 


    if(!isset($_SESSION['email'])) {
        header("location: ../../admins/login-admins.php");
        exit(); // Always exit after header redirection
    }


// Check if the form is submitted
if (isset($_POST['submit'])) {
    if ($_POST['title'] == ''  || $_POST['content'] == '' || $_POST['category_id'] == '' || !isset($_FILES['img'])) {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Some fields are left empty or image is not uploaded!!!
              </div>";
    } else {
        $title = htmlspecialchars($_POST['title']);
        $content = filter_var(htmlentities($_POST["content"]), FILTER_SANITIZE_STRING);
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
    #imageGroups .form-group{
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
    }

    .url-here {
        background: #f5f5f5;
        padding: 4px;
        width: 100%;
    }

    @media (max-width: 1200px) {
        #imageGroups .form-group{
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
    }
    .url-here {
        margin-top: 10px;
    }
    }
    
    </style>

<section class="create-post">
        <div class="container"> 
        <h1 class="mb-4 pt-3">Add Post</h1>
                <a href="../../<?php
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
            <!-- action="create-post.php" -->
                <form action="create-post.php"  method="POST" enctype="multipart/form-data" id="postForm">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea id="content_snote" name="content" class="form-control" rows="6"></textarea>
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

                    <button type="submit" name="submit" class="btn btn-primary" id="submit-post">Submit</button>
                </form>


                
                <div class="upload-images pt-5">
                    <h1>Upload your blog images here</h1>
                    <button type="button" id="addImageButton" class="btn btn-primary mt-2">Add an Image</button>
                
                    <form action="upload.php" id="uploadForm" method="POST" enctype="multipart/form-data">
                        <div id="imageGroups" class="pt-3">
                           
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Upload Images</button>
                    </form>
                </div>

</section>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageGroups = document.getElementById('imageGroups');
            const addImageButton = document.getElementById('addImageButton');

            addImageButton.addEventListener('click', function() {
                // Check if maximum number of image groups is reached
                if (imageGroups.children.length >= 1) {
                    alert('Remove the current one and add new image');
                    return;
                }

                // Create a new image group
                const newGroup = document.createElement('div');
                newGroup.classList.add('img-group');
                newGroup.innerHTML = `
                    <div class="form-group">
                        <input type="file" name="imageFile" accept="image/*">
                        <p class="url-here" id="imageUrl">Image URL will be displayed here after successful upload.</p>
                        <button type="button" class="remove-image btn-warning">Remove</button>
                        </div>
                        <br>
                `;
                imageGroups.appendChild(newGroup);

                // Attach event listener to remove button
                const removeButtons = document.querySelectorAll('.remove-image');
                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.img-group').remove();
                    });
                });
            });
        });
</script>

<?php require "../../layouts/footer.php"; ?>




