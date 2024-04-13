<?php 
  session_start();
?>

<?php 
  
  // Define APPURL constant
  define('APPURL', 'http://localhost/micsweb/admin-panel');
  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <title>MICS | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
     <link href=" <?php echo APPURL?>/styles/admin.css" rel="stylesheet">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <?php if(isset($_SESSION['email'])) : ?>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav side-nav" >
         
          
          
          <?php endif; ?>
         
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <?php if(isset($_SESSION['email'])) : ?>
          <!-- <li class="nav-item">
            <a class="nav-link" href="http://localhost/micsweb/admin-panel/index.php">Home
              <span class="sr-only">(current)</span>
            </a> -->
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <?php echo $_SESSION['email']; ?>
            </a>
            
          </li>
          <button class="btn-success"><a class="btn-success" href=" <?php echo APPURL?>/admins/logout.php">Logout
        </button>
        </a>
          <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              
          </div> -->
           <?php else : ?> 
          <!-- <li class="nav-item">
            <a class="nav-link" href="http://localhost/micsweb/admin-panel/admins/login-admins.php">login
              <span class="sr-only">(current)</span>
            </a>
          </li> -->
          <?php endif;  ?> 
            
          
        </ul>
      </div>
    </div>
    </nav>
    <br>
    <br>
    <div class="container">