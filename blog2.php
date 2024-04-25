<?php 

include ("components/header.php");


?>

<!-- Header Area End -->
<!-- Banner Area Start -->
<div class="banner-area-wrapper">
    <div class="banner-area">    
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="banner-content-wrapper">
                        <div class="banner-content">
                            <h1>Blog</h1> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<!-- Banner Area End -->
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php foreach ($posts as $post): ?>
                <div class="card mb-3 blog-card">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="admin-panel/blog/asset/uploads/<?php echo $post['img']; ?>" class="img-fluid rounded-start p-3" alt="<?php echo $post['title']; ?>" style="padding-top: 20px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="content-heading">
                                    <h2 class="card-title"><?php echo $post['title']; ?></h2>
                                    <br>
                                    <ul class="list-unstyled">
                                        <li class="list-unstyled"><i class="fa-regular fa-calendar-check"></i> <?php echo $post['created_date']; ?></li>
                                        <li class="list-unstyled">&#9998; Admin</li>
                                        <li class="list-unstyled">Category: <?php echo $post['category_name']; ?></li> <!-- Include category name -->
                                    </ul>
                                </div>
                                <p class="card-text"><?php echo substr($post['content'], 0, 200); ?>...</p>
                                <!-- Other content goes here -->
                                <div class="text-end">
                                    <a href="view-blog-post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-4">
            <!-- Right Sidebar Content Goes Here -->
            <?php include "components/side_about.php" ?>;
        </div>
    </div>
</div>

<?php
include ("components/footer.php");
?>
