<?php 
require "layouts/header.php"; 
require "includes/config.php"; 


// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: admins/login-admins.php");
    exit();
}

// Check if role of logged-in user is "admin"
if ($_SESSION['roles'] !== 'admin') {
    // Redirect to unauthorized page if role is not "admin"
    header("Location: unauthorized.php");
    exit(); 
}

?>

<div class="container">
    <div class="row">
        <!-- Main Content -->
        <main role="main" class="col-md-12 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                
            </div>

            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Blog Management
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="blog/main/show-post.php">
                                        <i class="fas fa-plus-circle mr-2"></i>Manage Blog
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="blog/blog-categories/show-categories.php">
                                        <i class="fas fa-edit mr-2"></i>Mange blog Categories
                                    </a>
                                </li>                              
                            </ul>

                        </div>
                    </div>
                    <div class="card">
                    <div class="card-header" id="headingEvent">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseEvent" aria-expanded="true" aria-controls="collapseEvent">
                                Events Management
                            </button>
                        </h5>
                    </div>

                    <div id="collapseEvent" class="collapse" aria-labelledby="headingEvent" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="event/show-events.php">
                                        <i class="fas fa-plus-circle mr-2"></i>Manage Events
                                    </a>

                                    <a class="nav-link" href="event/show-events-year.php">
                                        <i class="fas fa-plus-circle mr-2"></i>Events Year
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

<?php require "layouts/footer.php"; ?>

