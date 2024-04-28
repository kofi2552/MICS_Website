<?php 
ob_start();
require "../includes/config.php";
require "../layouts/header.php"; 

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../admins/login-admins.php");
    exit(); 
}

// Fetch event years
$query = "SELECT * FROM events_year";
$stmt = $conn->query($query);
$event_years = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete action
if(isset($_POST['delete'])) {
    $event_year_id = $_POST['id'];

    $deleteQuery = $conn->prepare("DELETE FROM events_year WHERE id = :id");
    $deleteQuery->execute([':id' => $event_year_id]);

    // Set session variable indicating deletion status
    $_SESSION['deleted_status'] = $deleteQuery ? 'success' : 'failed';

    // Redirect back to the same page after deletion
    header("Location: show-events-year.php");
    exit(); 
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Event Years</h2>
            <a href="../<?php
                    if($_SESSION['roles'] == "director") {
                        echo "supa.php";
                    } elseif($_SESSION['roles'] == "admin") {
                        echo "index.php";
                    } else {
                        echo "unauthorized.php";
                    }
                ?>" class="btn btn-primary mb-4 text-center float-left padding 2">Home</a>

                <br><br>

            <!-- Display session message if any -->
            <?php if (isset($_SESSION['updated_status'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['updated_status'] == 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['updated_status'] == 'success' ? 'Event year updated  successfully!' : 'Failed to update event year!'; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['updated_status']); ?>
            <?php endif; ?>

                
            <ul class="list-group">
                <?php foreach ($event_years as $event_year) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $event_year['event_year']; ?>
                        <div>
                            <!-- Edit button -->
                            <a href="edit-events-year.php?id=<?php echo $event_year['id']; ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                            <!-- Delete form
                            <form method="POST" action="#">
                                <input type="hidden" name="event_year_id" value="<?php echo $event_year['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event year?')">Delete</button>
                            </form> -->
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
