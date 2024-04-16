<?php require "../layouts/header.php"; ?>
<?php require "../includes/config.php"; ?>

<?php
// Check if ID is provided in the URL
if(isset($_GET['id'])) {
    $adminId = htmlspecialchars($_GET['id']);

    // Fetch the admin details from the database
    $query = $conn->prepare("SELECT * FROM admins WHERE id = :id");
    $query->execute([':id' => $adminId]);
    $admin = $query->fetch(PDO::FETCH_ASSOC);

    // Check if form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $adminemail = htmlspecialchars($_POST['email']);
        $adminrole = htmlspecialchars($_POST['roles']);

        // Check if a new password is provided
        if (!empty($_POST['new_password'])) {
            // Hash the new password
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // Update admin with new password in the database
            $updateQuery = $conn->prepare("UPDATE admins SET email = :email, roles = :roles, mypassword = :mypassword WHERE id = :id");
            $updateQuery->execute([':email' => $adminemail, ':roles' => $adminrole, ':mypassword' => $new_password, ':id' => $adminId]);
        } else {
            // Update admin without changing password in the database
            $updateQuery = $conn->prepare("UPDATE admins SET email = :email, roles = :roles WHERE id = :id");
            $updateQuery->execute([':email' => $adminemail, ':roles' => $adminrole, ':id' => $adminId]);
        }
            
        // Set session variable indicating update status
        $_SESSION['update_status'] = $updateQuery ? 'success' : 'failed';

        // Redirect to the admins.php page
        header("Location: admins.php");
        exit();
    }
} else {
    // Redirect back to the admins.php if admin ID is not provided
    header("Location: admin.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Admin</h1>
    <a href="<?php echo APPURL; ?>/<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-right">Home</a>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Update Admin</h5>

                       

                        <form method="POST" action="edit-admin.php?id=<?php echo $adminId; ?>">
                            <!-- Email input -->
                            <div class="form-outline mb-4 mt-4">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $admin['email']; ?>" required>
                                <!-- email validation message -->
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            <!-- Role input -->
                            <div class="form-outline mb-4">
                                <select name="roles" class="form-control" id="roles">
                                    <option value="admin" <?php if($admin['roles'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="director" <?php if($admin['roles'] == 'director') echo 'selected'; ?>>Director</option>
                                </select>
                            </div>
                            <!-- New Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" minlength="6">
                                <!-- HTML5 password validation message -->
                                <div class="invalid-feedback">
                                    Password must be at least 6 characters long.
                                </div>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
