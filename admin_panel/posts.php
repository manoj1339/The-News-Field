<?php
 require "includes/header.php";
 if(isset($_GET['message'])){
   if($_GET['message'] == 'post_deleted')
   {
     echo "<script>alert('News deleted successfully');</script>";
   }
 }

$pageno = "";
if (isset($_GET['pageno']))
{
  $pageno = $_GET['pageno'];
}
else 
{
  $pageno = 1;
}
?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> News<small>Manage Site news</small></h1>
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
          <li class="active">News posts</li>
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
                <h3 class="panel-title">Posts</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  
                </div>
                <br>
                  <?php
                  $no_of_records_per_page = 10;
                  $offset = ($pageno-1) * $no_of_records_per_page; 

                  $query = "SELECT * FROM news ORDER BY date_posted DESC LIMIT $offset, $no_of_records_per_page;";
                  $result = mysqli_query($conn, $query);
                  $num_rows = mysqli_num_rows($result);

                  //for pagination
                  $total_pages = ceil($num_rows / $no_of_records_per_page);
                
                  if($num_rows > 0){

                    echo '<table class="table table-striped table-hover">
                    <tr>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Posted by</th>
                      <th>Posted on</th>
                      ';

                    if(get_admin_info($conn, $_SESSION['admin'])[1] == 'yes')
                      {
                        echo '
                          <th>Action</th>
                          </tr>
                        ';
                      }
                      else
                      {
                        echo '</tr>';
                      }
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                      echo '<tr>
                      <td>'. $row['news_title'] .'</td>
                      <td>'. $row['category'] .'</td>
                      <td>'. $row['posted_by'] .'</td>
                      <td>'. date('d F, Y h:i:sa', strtotime($row['date_posted'])) .'</td>
                      ';
                      if(get_admin_info($conn, $_SESSION['admin'])[1] == 'yes')
                      {
                        echo '
                          <td><a class="btn btn-default" href="edit.php?action=edit&news_id='. $row['news_id'] .'">Edit</a> <a class="btn btn-danger" href="edit.php?action=delete&news_id='. $row['news_id'] .'">Delete</a></td>
                        </tr>
                        ';
                      }
                      else
                      {
                        echo '</tr>';
                      }
                    }

                    echo '</table>';
                    ?>
                      
                      <ul class="pagination">
                          <li><a href="posts.php?pageno=1">First</a></li>
                          <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                              <a href="posts.php<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                          </li>
                          <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                              <a href="posts.php<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                          </li>
                          <li><a href="posts.php?pageno=<?php echo $total_pages; ?>">Last</a></li>
                      </ul>

                    <?php
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
