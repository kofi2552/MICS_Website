<?php 
require "../includes/config.php";
require "../layouts/header.php"; 

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../admins/login-admins.php");
    exit(); 
}

// Check if event year ID is provided via GET request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: show-events-year.php");
    exit();
}

// Fetch event year data by ID
$event_year_id = $_GET['id'];
$query = "SELECT * FROM events_year WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $event_year_id);
$stmt->execute();
$event_year = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event_year) {
    header("Location: show-events-year.php");
    exit();
}

if(isset($_POST['submit'])) {
    if($_POST['event_year'] == '') {
        echo "<div class='alert alert-danger text-center' role='alert'>Event year field is required!</div>";
    } else {
        $event_year = htmlspecialchars($_POST['event_year']);

        // Update event year data in the database
        $update = $conn->prepare("UPDATE events_year SET event_year = :event_year WHERE id = :event_year_id");
        $update->execute([
            ':event_year' => $event_year,
            ':event_year_id' => $event_year_id
        ]);

        // Set session variable indicating updated status
        $_SESSION['updated_status'] = $update ? 'success' : 'failed';

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
                    <h5 class="card-title mb-5">Edit Event Year</h5>
                    <form method="POST" action="edit-events-year.php?id=<?php echo $event_year_id; ?>">
                        <div class="form-group">
                            <label for="event_year">Event Year</label>
                            <input type="text" class="form-control" id="event_year" name="event_year" value="<?php echo $event_year['event_year']; ?>" placeholder="Enter Event Year">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this event year?')">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
