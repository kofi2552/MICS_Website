<?php 
ob_start();

require "../includes/config.php";
require "../layouts/header.php"; 

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../admins/login-admins.php");
    exit(); 
}

if(isset($_POST['submit'])) {
    if($_POST['event_year'] == '') {
        echo "<div class='alert alert-danger text-center' role='alert'>Event year field is required!</div>";
    } else {
        $event_year = htmlspecialchars($_POST['event_year']);

        // Insert event year into the database
        $insert = $conn->prepare("INSERT INTO events_year (event_year) VALUES (:event_year)");
        $insert->execute([':event_year' => $event_year]);

        // Set session variable indicating created status
        $_SESSION['created_status'] = $insert ? 'success' : 'failed';

        header("Location: show-events-year.php");
        exit();
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5">Create Event Year</h5>
                    <form method="POST" action="create-events-year.php">
                        <div class="form-group">
                            <label for="event_year">Event Year</label>
                            <input type="text" class="form-control" id="event_year" name="event_year" placeholder="Enter Event Year">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
