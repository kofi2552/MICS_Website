<?php require "../layouts/header.php"; ?>
<?php require "../includes/config.php"; ?>

<?php  


    if(!isset($_SESSION['email'])) {
      header("location: <?php echo APPURL?>/admins/login-admins.php");
    }
    // if(!isset($_SESSION['roles'] =="director")) {
    //     header("location: http://localhost/micsweb/admin-panel/admins/login-admins.php");
    // }
  


    $admins = $conn->query("SELECT * FROM admins LIMIT 10");
    $admins->execute();
    $rows = $admins->fetchAll(PDO::FETCH_OBJ);


?>

<br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                
                
                <a href="<?php echo APPURL?>/supa.php" class="btn btn-primary mb-4 text-center float-left">Home</a>
                <a href="<?php echo APPURL?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
                <br>
                <br>
                <h5 class="card-title mb-4 d-inline loat-left">Admins</h5>
                <div class="table-responsive"> <!-- Add responsiveness to table -->
                    <table class="table table-striped table-hover"> <!-- Add Bootstrap table classes -->
                        <thead class="thead-dark"> <!-- Add dark header -->
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th> <!-- Added column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $row) : ?>
                                <tr>
                                    <th scope="row"><?php echo $row->id; ?></th>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->roles; ?></td>
                                    <td>
                                        <a href="edit-admin.php?id=<?php echo $row->id; ?>" class="btn btn-primary btn-sm">Edit</a> <!-- Edit button -->
                                        <a href="delete-admin.php?id=<?php echo $row->id; ?>" class="btn btn-danger btn-sm">Delete</a> <!-- Delete button -->
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>

