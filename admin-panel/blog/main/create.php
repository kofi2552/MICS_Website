<?php

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