<?php
session_start();
if(!isset($_SESSION['admin']))
{
  header("location: login.php");
  exit();
}

$full_url = explode('/', $_SERVER['PHP_SELF']);
$short_url = end($full_url);
$remove_php = explode('.', $short_url);
$final_url = $remove_php[0];

require "includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | <?php echo "$final_url"; ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="icon" href="images/logo.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  </head>
  <body>

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
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="posts.php">News Posts</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="upload.php">Upload Images</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $_SESSION['admin']; ?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>