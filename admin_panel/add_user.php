<?php
require "includes/header.php";

$flag = get_admin_info($conn, $_SESSION['admin'])[1];

if($flag == 'no'){
    header('location: index.php');
    exit();
}

$error_message = "";
if(isset($_POST['submit']))
{
    if($flag == 'yes')
    {

        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $name = test_input($_POST['name']);
        $is_superuser = test_input($_POST['is_superuser']);

        if(empty($email) && empty($password) && empty($name))
        {
            $error_message =  "<p class='alert alert-danger'>Please fill all fields</p>";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error_message =  "<p class='alert alert-danger'>Invalid email address</p>";
        }
        else
        {
            $sql = "SELECT * FROM users WHERE email='$email';";
            $rslt = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($rslt);

            if($rows > 0)
            {
              $error_message =  "<p class='alert alert-danger'>This email already exists</p>";
            }
            else
            {
              $query = "INSERT INTO users (email, password, name, is_superuser) VALUES ('$email', '$password', '$name', '$is_superuser');";
              $result = mysqli_query($conn, $query);
              if($result)
              {
                  $error_message =  "<p class='alert alert-success'><b>User created successfully</p>";
              }
              else{
                  echo mysqli_error($conn);
            }
            }
        }
    }
    else
    {
        header('location: index.php');
        exit();
    }
}
?>

<header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Add User<small></small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Content
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                  if(get_admin_info($conn, $_SESSION['admin'])[1] == 'yes')
                  {
                    echo '<li><a href="add_user.php">Add User</a></li>';
                  } 
                 ?>
                <li><a href="insert_post.php">Add Post</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="posts.php">News posts</a></li>
          <li class="active">Add user</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge"><?php echo get_post_count($conn); ?></span></a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo get_user_count($conn); ?></span></a>
            </div>
          </div>

          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Add user</h3>
              </div>
              <?php echo "$error_message"; ?>
              <div class="panel-body">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <label>Superuser ?</label><br/>
                            Yes<input type="radio" name="is_superuser" value="yes" checked="true" style="margin-left:5px;"/><br/>
                            No<input type="radio" name="is_superuser" value="no" style="margin-left:5px;"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" />
                        </div> 
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </form>
                </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <?php require "includes/footer.php"; ?>
  </body>
</html>