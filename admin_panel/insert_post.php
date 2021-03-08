<?php
require "includes/header.php";
$error_message = "";

if(isset($_POST['submit']))
{
    if(isset($_FILES['myfile']['name'])){

        $id = uniqid('news');

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
                if(move_uploaded_file($fileTmpName, $uploadPath))
                {
                    $title = test_input($_POST['news_title']);
                    $eng_title = test_input($_POST['news_eng_title']);
                    $tag = test_input($_POST['news_tag']);
                    $tag_color = test_input($_POST['news_tag_color']);
                    $category = test_input($_POST['news_category']);
                    $desc = $_POST['news_desc'];
                    $posted_by = $_SESSION['admin'];

                    $query = "INSERT INTO news (news_id, news_eng_title, news_title, news_tag, news_tag_color, news_desc, news_thumbnail, category, posted_by, date_posted) VALUES ('$id', '$eng_title','$title', '$tag', '$tag_color', '$desc', '$uploadPath', '$category', '$posted_by', now());";
                    $result = mysqli_query($conn, $query);
                    if($result){
                        $error_message =  "<p class='alert alert-success'><b>News post inserted successfully</p>";
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
    else{
        $error_message =  "<p class='alert alert-danger'><b>No File</b> selected</p>";
    }

}
?>


<header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Add News post<small></small></h1>
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
                <li><a href="#">Add Post</a></li>
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
          <li class="active">Add Post</li>
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
                    <form method="POST" action="insert_post.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>News Title</label>
                            <input type="text" name="news_title" class="form-control" placeholder="News Title">
                        </div>
                        <div class="form-group">
                            <label>News English Title</label>
                            <input type="text" name="news_eng_title" class="form-control" placeholder="News English Title">
                        </div>
                        <div class="form-group">
                            <label>News Tag</label>
                            <input type="text" name="news_tag" class="form-control" placeholder="Add News tag">
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
                            <textarea name="news_desc" class="form-control" placeholder="News Body"></textarea>
                        </div>
                    
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" />
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
