<?php require "layouts/header.php"; ?>
<?php require "includes/config.php"; ?>

<?php

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: admins/login-admins.php");
    exit();
}

// Check if role of logged-in user is "admin"
if ($_SESSION['roles'] !== 'director') {
    // Redirect to unauthorized page if role is not "admin"
    header("Location: unauthorized.php");
    exit(); 
}

?>

<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <main role="main" class="col-md-12 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                
            </div>

            <div id="accordion">

            <div class="card">
                    <div class="card-header" id="headingAdmin">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
                                Admin Management
                            </button>
                        </h5>
                    </div>

                    <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="admins/admins.php">
                                        <i class="fas fa-plus-circle mr-2"></i>Manage Admins
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingBlog">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true" aria-controls="collapseBlog">
                                Blog Management
                            </button>
                        </h5>
                    </div>

                    <div id="collapseBlog" class="collapse" aria-labelledby="headingBlog" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="blog/main/show-post.php">
                                        <i class="fas fa-plus-circle mr-2"></i>Manage Post
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="blog/blog-categories/show-categories.php">
                                        <i class="fas fa-edit mr-2"></i>Mange blog Categories
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="edit-post.php">
                                        <i class="fas fa-edit mr-2"></i>Edit Post
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="delete-post.php">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete Post
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom script -->
<script>
    $(document).ready(function() {
        $('.btn-link').click(function() {
            var $collapse = $($(this).attr('data-target'));
            if ($collapse.hasClass('show')) {
                $collapse.collapse('hide');
            } else {
                $collapse.collapse('show');
            }
        });

        // Hide collapse when clicked outside
        $(document).on('click', function(event) {
            var $target = $(event.target);
            if (!$target.closest('.collapse').length && !$target.closest('.btn-link').length) {
                $('.collapse').collapse('hide');
            }
        });
    });
</script>



</body>
</html>
