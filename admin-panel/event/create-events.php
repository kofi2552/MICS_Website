<?php 
require "../layouts/header.php"; 
require "../includes/config.php"; 

if (!isset($_SESSION['email'])) {
    header("location:../admins/login-admins.php");
    exit(); 
}

// // Check if role of logged-in user is not "director"
// if ($_SESSION['roles'] !== 'director') {
//     // Redirect to unauthorized page if role is not "director"
//     header("Location: ../unauthorized.php"); // You can create this page to display an "Unauthorized Access" message
//     exit(); // Exit to prevent further execution
// }

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

        // Insert event data into the database
        $insert = $conn->prepare("INSERT INTO events (event_date, event_title, event_description, event_color) 
                                 VALUES (:event_date, :event_title, :event_description, :event_color)");
        $insert->execute([
            ':event_date' => $event_date,
            ':event_title' => $event_title,
            ':event_description' => $event_description,
            ':event_color' => $event_color
        ]);

        // Set session variable indicating created status
        $_SESSION['created_status'] = $insert ? 'success' : 'failed';

        header("Location: show-events.php");
        exit();
    }
}
?>

<a href="../<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-left padding 2">Home</a>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Event</h5>
                    <form method="POST" action="create-events.php">
                        <!-- Event Date input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="date" name="event_date" id="event_date" class="form-control" required>
                        </div>

                        <!-- Event Title input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="event_title" id="event_title" class="form-control" placeholder="Event Title" required>
                        </div>
                        
                        <!-- Event Description input -->
                        <div class="form-outline mb-4">
                            <textarea name="event_description" id="event_description" class="form-control" rows="3" placeholder="Event Description" required></textarea>
                        </div>

                        <!-- Event Color input -->
                        <div class="form-outline mb-4">
                            <label for=""> Color Picker</label>
                            
                                <select class="form-control" id="event_color" name="event_color">
                                <option value="green">Green</option>
                                <option value="light">Light</option>
                                <option value="orange">Orange</option>
                            </select>
                        </div>
                        
                        
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Create</button>
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
