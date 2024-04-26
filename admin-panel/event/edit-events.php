<?php 
require "../layouts/header.php"; 
require "../includes/config.php"; 

if (!isset($_SESSION['email'])) {
    header("location:../admins/login-admins.php");
    exit(); 
}



// Check if event ID is provided via GET request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: show-events.php");
    exit();
}

// Fetch event data by ID
$event_id = $_GET['id'];
$query = "SELECT * FROM events WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $event_id);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    header("Location: show-events.php");
    exit();
}

if(isset($_POST['submit'])) {
    if($_POST['event_title'] == ''  OR $_POST['event_description'] == '' OR $_POST['event_date'] == '') {
        echo "<div class='alert alert-danger text-center role='alert'>
                Some fields are left empty!!!
              </div>";
    } else {
        $event_date = htmlspecialchars($_POST['event_date']);
        $event_title = htmlspecialchars($_POST['event_title']);
        $event_description = htmlspecialchars($_POST['event_description']);
        $event_color = htmlspecialchars($_POST['event_color']);

        // Update event data in the database
        $update = $conn->prepare("UPDATE events SET event_date = :event_date, event_title = :event_title, event_description = :event_description, event_color = :event_color WHERE id = :id");
        $update->execute([
            ':event_date' => $event_date,
            ':event_title' => $event_title,
            ':event_description' => $event_description,
            ':event_color' => $event_color,
            ':id' => $event_id
        ]);

        // Set session variable indicating updated status
        $_SESSION['updated_status'] = $update ? 'success' : 'failed';

        header("Location: show-events.php");
        exit();
    }
}
?>

<a href="../supa.php" class="btn btn-primary mb-4 text-center float-left">Home</a>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Edit Event</h5>
                    <form method="POST" action="edit-events.php?id=<?php echo $event_id; ?>">
                        <!-- Event Date input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="date" name="event_date" id="event_date" class="form-control" value="<?php echo $event['event_date']; ?>" required>
                        </div>

                        <!-- Event Title input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="event_title" id="event_title" class="form-control" placeholder="Event Title" value="<?php echo $event['event_title']; ?>" required>
                        </div>
                        
                        <!-- Event Description input -->
                        <div class="form-outline mb-4">
                            <textarea name="event_description" id="event_description" class="form-control" rows="3" placeholder="Event Description" required><?php echo $event['event_description']; ?></textarea>
                        </div>

                        <select class="form-control" id="event_color" name="event_color">
                            <option value="green" <?php echo ($event['event_color'] == 'green') ? 'selected' : ''; ?>>Green</option>
                            <option value="light" <?php echo ($event['event_color'] == 'light') ? 'selected' : ''; ?>>Light</option>
                            <option value="orange" <?php echo ($event['event_color'] == 'orange') ? 'selected' : ''; ?>>Orange</option>
                        </select>
                        
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary mb-4 text-center " onclick='return confirm("Are you sure you want to update this event?")'>Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
