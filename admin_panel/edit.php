<?php 
require "includes/header.php";

if(get_admin_info($conn, $_SESSION['admin'])[1] == "no"){
    header('location: index.php');
    exit();
}

$error_message = "";
$news_detail = array();

if(isset($_GET['action']))
{

  $action = test_input($_GET['action']);
  $news_id = test_input($_GET['news_id']);

  if($action == 'delete')
  {
    $query = "DELETE FROM news WHERE news_id='$news_id';";
    $result = mysqli_query($conn, $query);

    if(file_exists('images/news_thumbnails/'.$news_id.'.jpg'))
    {
      unlink('images/news_thumbnails/'.$news_id.'.jpg');
    }
    if(file_exists('images/news_thumbnails/'.$news_id.'.jpeg'))
    {
      unlink('images/news_thumbnails/'.$news_id.'.jpeg');
    }
    if(file_exists('images/news_thumbnails/'.$news_id.'.png'))
    {
      unlink('images/news_thumbnails/'.$news_id.'.png');
    }
    
    if($result){
      header('location: posts.php?message=post_deleted');
      exit();
    }
  }

  if($action == 'edit')
  {
    $query = "SELECT * FROM news WHERE news_id='$news_id';";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);
    
    while($row = mysqli_fetch_assoc($result))
    {
      $news_detail = array(
        'news_id'=> $row['news_id'],
        'news_title'=> $row['news_title'],
        'news_eng_title'=> $row['news_eng_title'],
        'news_tag'=> $row['news_tag'],
        'news_desc'=> $row['news_desc'],
        'category'=> $row['category']
      );
    }
  }
}

if(isset($_POST['submit']))
{
    if(isset($_FILES['myfile']['name']))
    {

        $id = test_input($_GET['news_id']);

        // File upload script
        $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

        $fileName = $_FILES['myfile']['name'];
        $fileSize = $_FILES['myfile']['size'];
        $fileTmpName  = $_FILES['myfile']['tmp_name'];
        $fileType = $_FILES['myfile']['type'];

        $file_name_array = explode('.',$fileName);
        $file_name_end = end($file_name_array);
        $fileExtension = strtolower($file_name_end);


        $new_filename = $id.'.'.$fileExtension;
        $uploadPath = 'images/news_thumbnails/'.$new_filename;

        if(in_array($fileExtension, $fileExtensions)){
            if($fileSize < 2000000){

                /* This script removes existing file in folder */
                if(file_exists('images/news_thumbnails/'.$id.'.jpg'))
                {
                  unlink('images/news_thumbnails/'.$id.'.jpg');
                }
                if(file_exists('images/news_thumbnails/'.$id.'.jpeg'))
                {
                  unlink('images/news_thumbnails/'.$id.'.jpeg');
                }
                if(file_exists('images/news_thumbnails/'.$id.'.png'))
                {
                  unlink('images/news_thumbnails/'.$id.'.png');
                }

                if(move_uploaded_file($fileTmpName, $uploadPath))
                {
                    $title = test_input($_POST['news_title']);
                    $eng_title = test_input($_POST['news_eng_title']);
                    $tag = test_input($_POST['news_tag']);
                    $tag_color = test_input($_POST['news_tag_color']);
                    $category = test_input($_POST['news_category']);
                    $desc = $_POST['news_desc'];
                    $posted_by = $_SESSION['admin'];

                    $query = "UPDATE news SET news_title='$title', news_eng_title='$eng_title', news_tag='$tag', news_tag_color='$tag_color', category='$category', news_desc='$desc' WHERE news_id='$id';";
                    $result = mysqli_query($conn, $query);
                    if($result)
                    {
                        $error_message =  "<p class='alert alert-success'><b>News post updated successfully</p>";
                        $query = "SELECT * FROM news WHERE news_id='$news_id';";
                        $result = mysqli_query($conn, $query);
                        $num_rows = mysqli_num_rows($result);
                        
                        while($row = mysqli_fetch_assoc($result))
                        {
                          $news_detail = array(
                            'news_id'=> $row['news_id'],
                            'news_title'=> $row['news_title'],
                            'news_eng_title'=> $row['news_eng_title'],
                            'news_tag'=> $row['news_tag'],
                            'news_desc'=> $row['news_desc'],
                            'category'=> $row['category']
                          );
                        }
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
                else
                {
                    $error_message =  "<p class='alert alert-danger'><b>Error</b> in uploading file</p>";
                }
            }
            else{
                $error_message =  "<p class='alert alert-danger'>File size should be less than <b>2MB</b></p>";
            }
        }
        else{
            $error_message =  "<p class='alert alert-danger'>only <b>jpg, jpeg, png</b> files allowed</p>";
        }
        // End file upload script
    }
    else
    {
        $error_message =  "<p class='alert alert-danger'><b>No File</b> selected</p>";
    }

}
?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Edit post<small></small></h1>
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
          <li><a href="posts.php">News Posts</a></li>
          <li class="active">Edit Post</li>
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
                <h3 class="panel-title">Add news post</h3>
              </div>
              <?php echo "$error_message"; ?>
              <div class="panel-body">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?action=edit&news_id='.$news_detail['news_id']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>News Title</label>
                            <input type="text" name="news_title" class="form-control" placeholder="News Title" value='<?php echo $news_detail["news_title"]; ?>' />
                        </div>
                        <div class="form-group">
                            <label>News English Title</label>
                            <input type="text" name="news_eng_title" class="form-control" placeholder="News Title" value='<?php echo $news_detail["news_eng_title"]; ?>' />
                        </div>
                        <div class="form-group">
                            <label>News Tag</label>
                            <input type="text" name="news_tag" class="form-control" placeholder="Add News tag" value='<?php echo $news_detail["news_tag"]; ?>' />
                        </div>
                        <div class="form-group">
                            <label>News Tag Color</label>
                            <select class="form-control" name="news_tag_color">
                                <option value="skyblue" selected="true">Sky Blue</option>
                                <option value="gray">Gray</option>
                                <option value="red">Red</option>
                                <option value="purple">Purple</option>
                                <option value="pink">pink</option>
                                <option value="green">Light Green</option>
                                <option value="orange">Orange</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>News Category</label>
                            <select class="form-control" name="news_category">
                                <option value="0">Select Category</option>
                                <option value="काय चाललंय !">काय चाललंय !</option>
                                <option value="झाल कि व्हायरल !">झाल कि व्हायरल !</option>
                                <option value="खास तुमच्यासाठी !">खास तुमच्यासाठी !</option>
                                <option value="आपलं राजकारण">आपलं राजकारण</option>
                                <option value="किस्से">किस्से</option>
                                <option value="मायानगरी">मायानगरी</option>
                                <option value="बळीराजा">बळीराजा</option>
                                <option value="खेळ-कुद">खेळ-कुद</option>
                                <option value="आरोग्य">आरोग्य</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>News Thumbnail</label>
                            <input type="file" name="myfile" id="fileToUpload" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>News Body</label>
                            <textarea name="news_desc" class="form-control" placeholder="News Body">
                            <?php echo $news_detail['news_desc']; ?>
                            </textarea>
                        </div>
                    
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save changes" />
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
