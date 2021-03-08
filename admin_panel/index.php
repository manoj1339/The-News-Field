<?php
require "includes/header.php";

if(isset($_GET['delete']))
{
  $delete = test_input($_GET['delete']);
  if(!empty($delete))
  {
    $q = "DELETE FROM users WHERE id='$delete' LIMIT 1;";
    $r = mysqli_query($conn, $q);

    if($r){
      header('location: index.php');
      exit();
    }
  }
}

?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
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
          <li class="active">Dashboard</li>
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
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo get_user_count($conn); ?></h2>
                    <h4>Users</h4>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo get_post_count($conn); ?></h2>
                    <h4>Posts</h4>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <?php echo get_visitor($conn); ?></h2>
                    <h4>Visitors</h4>
                  </div>
                </div>
                
              </div>
              </div>

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Latest Users</h3>
                </div>
                <div class="panel-body">
                <?php
                  $query = "SELECT * FROM users;";
                  $result = mysqli_query($conn, $query);
                  $num_rows = mysqli_num_rows($result);

                  $is_admin = false;

                  if(get_admin_info($conn, $_SESSION['admin'])[1] == 'yes')
                  {
                    $is_admin = true;
                  }
                  else{
                    $is_admin = false;
                  }
                
                  if($num_rows > 0){

                    echo '<table class="table table-striped table-hover">
                    <tr>
                      <th>Email</th>
                      <th>Superuser</th>
                      <th>Last Login</th>
                      <th></th>
                    </tr>';
                    
                    while($row = mysqli_fetch_assoc($result))
                    {

                      $delete_btn = '';
                      $hide = false;

                      if($row['is_superuser'] == 'yes')
                      {
                        $hide = true;
                      }
                      else{
                        $hide = false;
                      }

                      if($is_admin && !$hide)
                      {
                        $delete_btn = '<a class="btn btn-danger" href="index.php?delete='. $row['id'] .'">Delete</a>';
                      }
                      else{
                        $delete_btn = '';
                      }

                      echo '<tr>
                      <td>'. $row['email'] .'</td>
                      <td>'. $row['is_superuser'] .'</td>
                      <td>'. date('d F, Y h:i:sa', strtotime($row['last_login'])) .'</td>
                      <td>'. $delete_btn .'</td>
                    </tr>';
                    }

                    echo '</table>';
                  }
                  else
                  {
                    echo "No users";
                  }
                ?>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <?php require "includes/footer.php"; ?> 

  </body>
</html>
