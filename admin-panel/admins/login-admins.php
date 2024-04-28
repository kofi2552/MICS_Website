<?php 
ob_start();

require "../includes/config.php"; 
// require "../layouts/header.php"; 



session_start(); // Start or resume session




if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Enter data into the inputs
              </div>";
    } else {
        // Sanitize input and prepare query
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        // Query to retrieve user data based on email
        $login = $conn->prepare("SELECT * FROM admins WHERE email = :email");
        $login->execute(['email' => $email]);

        // Fetch user data
        if ($row = $login->fetch(PDO::FETCH_ASSOC)) {
            // Verify password
            if (password_verify($password, $row['mypassword'])) {
                // Set session variables
                $_SESSION['email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['roles'] = $row['roles']; // Set user role

                // Redirect based on user role
                if ($_SESSION['roles'] == 'director') {
                    header("Location: ../supa.php");
                    exit(); // Stop further script execution
                } elseif ($_SESSION['roles'] == 'admin') {
                    header("Location: ../index.php");
                    exit(); // Stop further script execution
                }
                
                // Debugging: Output session variables
                // echo "<pre>";
                // print_r($_SESSION);
                // echo "</pre>";

                // Redirect to supa.php upon successful login
                header("Location: ../supa.php");
                exit(); // Stop further script execution]
                
            } else {
                echo "<div class='alert alert-danger text-center' role='alert'>
                        The email or password is wrong
                      </div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>
                    The email or password is wrong
                  </div>";
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MICS | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
</head>


<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <h1>Admin CMS</h1>
        <div class="card-body">
          <h5 class="card-title mb-4 text-center">Login</h5>
          <form method="POST" action="login-admins.php">
            <!-- Email input -->
            <div class="mb-4">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
              <!-- HTML5 validation message for email -->
              <div class="invalid-feedback">
                Please enter a valid email address.
              </div>
            </div>
            <!-- Password input -->
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required minlength="6">
              <!-- HTML5 validation message for password -->
              <div class="invalid-feedback">
                Password must be at least 6 characters long.
              </div>
            </div>
            <!-- Submit button -->
            <div class="d-grid">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
 <script>
//     if ( window.history.replaceState ) {
//         window.history.replaceState( null, null, window.location.href );
//     }
 </script>

<?php require "../layouts/footer.php"; ?>