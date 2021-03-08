<?php require "includes/header.php"; ?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Users<small>Manage Site Users</small></h1>
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
          <li class="active">Users</li>
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
                <h3 class="panel-title">Users</h3>
              </div>
              <div class="panel-body">
                <div class="row">
            
                </div>
                <br>
                <?php
                  $query = "SELECT * FROM users;";
                  $result = mysqli_query($conn, $query);
                  $num_rows = mysqli_num_rows($result);
                
                  if($num_rows > 0){

                    echo '<table class="table table-striped table-hover">
                    <tr>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Is superuser</th>
                      <th>Last login</th>
                    </tr>';
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                      echo '<tr>
                      <td>'. $row['email'] .'</td>
                      <td>'. $row['name'] .'</td>
                      <td>'. $row['is_superuser'] .'</td>
                      <td>'. date('d F, Y h:i:sa', strtotime($row['last_login'])) .'</td>
                    </tr>';
                    }

                    echo '</table>';
                  }
                  else
                  {
                    echo "No news posted yet";
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
