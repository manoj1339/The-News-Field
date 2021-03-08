<?php
session_start();
require "includes/db.php";

$error_message = "";

if(isset($_POST['submit'])){
  $email = test_input($_POST['email']);
  $password = test_input($_POST['password']);

  $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1;";
  $result = mysqli_query($conn, $query);
  $num_rows = mysqli_num_rows($result);

  if($num_rows > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      $_SESSION['admin'] = $row['email'];
      $query1 = "UPDATE users SET last_login=now() WHERE email='$email';";
      mysqli_query($conn, $query1);
      header('location: index.php');
      exit();
    }
  }
  else{
    $error_message =  "<p class='alert alert-danger'><b>Invalid</b> credentials</p>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <div style="min-height:100vh;">
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">TheNewsField</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">

          </div><!--/.nav-collapse -->
        </div>
      </nav>

      <header id="header">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
            </div>
          </div>
        </div>
      </header>

      <section id="main">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <?php echo "$error_message"; ?>
              <form method="POST" action="" class="well">
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" name="email" class="form-control" placeholder="Enter Email" />
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <input type="submit" name="submit" value="Log In" class="btn btn-default btn-block">
                </form>
            </div>
          </div>
        </div>
      </section>
    </div>

    <footer id="footer" style="margin-top: -121px;">
      <p>The News Field</p>
      <p>&copy; <?php echo date("Y"); ?></p>
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
