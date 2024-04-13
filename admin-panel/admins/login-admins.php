<?php require "../includes/config.php"; ?>
<?php require "../layouts/header.php"; ?>


<?php 

    if(isset($_SESSION['email'])) {
      // header("location: http://localhost/micsweb/admin-panel/admin.php");
      // Redirect user based on their role
      if ($_SESSION['roles'] == 'director') {
          header("Location: http://localhost/micsweb/admin-panel/supa.php");
      } elseif ($_SESSION['roles'] == 'admin') {
          header("Location: http://localhost/micsweb/admin-panel/index.php");
      } else {
          // Handle other roles or redirect to a default page
          header("Location: http://localhost/micsweb/admin-panel/admins/login-admins.php");
      }
      exit();
    
    }


    if(isset($_POST['submit'])) {
        if($_POST['email'] == '' OR $_POST['password'] == '') {
            echo "<div class='alert alert-danger  text-center  role='alert'>
                  enter data into the inputs
              </div>";
        } else {
          // validate and sanitize all input here. dont forget
            $email = $_POST['email'];
            $password = $_POST['password'];

            $login = $conn->query("SELECT * FROM admins WHERE email = '$email'");

            $login->execute();

            $row = $login->FETCH(PDO::FETCH_ASSOC);
            
           


            if($login->rowCount() > 0) {

                if(password_verify($password, $row['mypassword'])){
                    

                    $_SESSION['email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                  
                    $roles =  $_SESSION['roles']= $row['roles'];

                    
                    if($roles == 'director'){
                      header('location: http://localhost/micsweb/admin-panel/supa.php');
                    }
                    if($roles == 'admin'){
                      header('location: http://localhost/micsweb/admin-panel/index.php');
                    }
        
                   // header('location: http://localhost/micsweb/admin-panel/index.php');
                } else {

                  echo "<div class='alert alert-danger  text-center text-white role='alert'>
                            the email or password is wrong
                        </div>";
                }


            } else {

              echo "<div class='alert alert-danger  text-center  role='alert'>
                        the email or password is wrong
                    </div>";
            }
        }
    }



?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
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


<?php require "../layouts/footer.php"; ?>