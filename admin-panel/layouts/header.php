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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
 
</head>

  <style>
      /* Additional CSS styles */
      body {
          padding: 20px;
      }
      .form-group {
          margin-bottom: 20px;
      }
    </style>

<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">MICS</a>
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
         
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <?php echo $_SESSION['email']; ?>
            </a>
            
          </li>
          <button class="btn-success"><a class="btn-success" href=" <?php echo APPURL?>/admins/logout.php">Logout
        </button>
        </a>
       
           <?php else : ?> 
          
          <?php endif;  ?> 
            
          
        </ul>
        </div>
      </div>
    </nav>
</div>
    <br>
    <br>
   