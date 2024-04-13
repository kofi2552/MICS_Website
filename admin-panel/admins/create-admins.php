<?php require "../layouts/header.php"; ?>
<?php require "../includes/config.php"; ?>

<?php  

     if(!isset($_SESSION['email'])) {
     header("location: <?php echo APPURL?>/admins/login-admins.php");
     }

        // Check if role of logged-in user is not "director"
    if ($_SESSION['roles'] !== 'director') {
      // Redirect to unauthorized page if role is not "director"
      header("Location: ../unauthorized.php"); // You can create this page to display an "Unauthorized Access" message
      exit();
    }


    if(isset($_POST['submit'])) {

        if($_POST['email'] == ''  OR $_POST['password'] == '') {
          echo "<div class='alert alert-danger  text-center  role='alert'>
                  some field are left empty!!!
                </div>";
        } else {
          $email = $_POST['email'];
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
          $roles =$_POST['roles'];

          $insert  = $conn->prepare("INSERT INTO admins (email,mypassword,roles) VALUES
          (:email,:mypassword,:roles)");

          $insert->execute([
            ':email' => $email,
            ':mypassword' => $password,
            ':roles' => $roles
           
          ]);

          header("location: <?php echo APPURL?>/admins/admins.php");



        }
      
    }
?>

<a href="<?php echo APPURL; ?>/supa.php" class="btn btn-primary mb-4 text-center float-left">Home</a>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php">
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
              <!-- HTML5 email validation message -->
              <div class="invalid-feedback">
                Please enter a valid email address.
              </div>
            </div>
            
            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="6" required>
              <!-- HTML5 password validation message -->
              <div class="invalid-feedback">
                Password must be at least 6 characters long.
              </div>
            </div>
              <div class="form-outline mb-4">
              <select name="roles" class="form-control" id="option">
                <option value="admin">Admin</option>
                <option value="director">Director</option>
              </select>
              </div>
            </div>
            <!-- Submit button -->
          

            <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
