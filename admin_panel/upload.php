
    <div class="wrapper" style="min-height:100vh; padding-bottom:150px;">
        <?php 
            include_once "includes/header.php";
            //upload.php

            $form_error = "";
            $file_msg = "";

            if(isset($_GET['id']))
            {
                $id = test_input($_GET['id']);
                if(!empty($id))
                {
                    $q = "SELECT * FROM images WHERE id='$id' LIMIT 1;";
                    $r = mysqli_query($conn, $q);
                    $n_r = mysqli_num_rows($r);

                    $image = '';

                    if($n_r > 0)
                    {
                        while($row = mysqli_fetch_assoc($r))
                        {
                            $url = explode('/', $row['file_url']);
                            $url_end = end($url);
                            $image = 'upload/' . $url_end;

                            if(file_exists($image))
                            {
                                $query = "DELETE FROM images WHERE id='$id' LIMIT 1;";
                                $result = mysqli_query($conn, $query);
                                if($result){
                                    // $file_msg = "<div class='alert alert-success'>File deleted successfully</div>";
                                    header('location: upload.php');
                                }
                                unlink($image);
                            }
                        }
                    }

                }
            }

            if(isset($_FILES['upload']['name']))
            {
                $file = $_FILES['upload']['tmp_name'];
                $file_name = $_FILES['upload']['name'];
                $file_name_array = explode(".", $file_name);
                $extension = end($file_name_array);
                $new_image_name = uniqid('image') . '.' . $extension;

                $file_tmp_name = $_FILES['upload']['tmp_name'];

                $destination = 'upload/' . $new_image_name;

                chmod('upload', 0777);
                $allowed_extension = array("jpg", "gif", "png", "jpeg");
                
                if(in_array($extension, $allowed_extension))
                {
                    if(move_uploaded_file($file_tmp_name, $destination))
                    {
                        $file_url = "https://thenewsfield.com/admin_panel/" . $destination;
                        $query = "INSERT INTO images (file_url) VALUES ('$file_url');";
                        $result = mysqli_query($conn, $query);

                        if($result)
                        {
                            $form_error = "<div class='alert alert-success'>File uploaded successfully</div>";
                        }
                        else{
                            $form_error = "<div class='alert alert-danger'>Something went wrong</div>";
                        }
                    }
                }
                else
                {
                    $form_error = "<div class='alert alert-danger'>Only jpg, jpeg, gif, png images are allowed</div>";
                }
            }
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 50px;">
                    <?php echo "$form_error"; ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                        <label>Upload image</label>
                            <input type="file" name="upload" />
                        </div>
                        <input type="submit" name="submit" value="Upload" class="btn btn-default btn-block">
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1" style="margin-top: 30px;">
                    <?php echo "$file_msg"; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Image url</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM images ORDER BY id DESC";
                                    $result = mysqli_query($conn, $query);
                                    $num_rows = mysqli_num_rows($result);

                                    $output = '';
                                    
                                    if($num_rows > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $output .= '
                                            <tr>
                                                <td>
                                                <img src="'. $row['file_url'] .'" alt="image" style="width: 80px; height: 50px;" />
                                                </td>
                                                <td style="text-align:center;">'. $row['file_url'] .'</td>
                                                <td><a href="upload.php?id='. $row['id'] .'" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            ';
                                        }
                                    }
                                    else{
                                        $output = "No images";
                                    }
                                    echo "$output";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer id="footer" style="margin-top:-120px;">
        <p>The News Field</p>
        <p>&copy; <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>