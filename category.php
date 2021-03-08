<?php
require "includes/db.php";

$category = '';
if(isset($_GET['category']))
{
    $category_clean = test_input($_GET['category']);
    $category = $news_categories[$category_clean];
}
else
{
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The News Field | <?php echo "$category"; ?></title>

    <base href="http://thenewsfield.epizy.com" />

    <link rel="icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div class="wrapper">   
        <?php require "includes/header.php"; ?>

        <section style="margin: 160px 0 50px 0;">
            <div class="container-fluid">

                <div class="news-main-tag yellow"><?php echo "$category"; ?></div>
                <div class="row">
                    <?php
                    $query = "SELECT * FROM news WHERE category='$category';";
                    $result = mysqli_query($conn, $query);
                    $num_rows = mysqli_num_rows($result);

                    if($num_rows > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                    <div class="col-md-6">
                        <div class="news">
                            <div class="news-tag <?php echo $row['news_tag_color']; ?>"><?php echo $row['news_tag']; ?></div>
                            <div class="news-card">
                                <div class="news-image">
                                    <a href="content/<?php echo $row['news_eng_title']. '/'. $row['news_id']; ?>">
                                        <img src="admin_panel/<?php echo $row['news_thumbnail']; ?>" alt="<?php echo $row['news_title']; ?>">
                                    </a>
                                </div>
                                <div class="news-tag-date">
                                    <div class="news-title">
                                            <a href="content/<?php echo $row['news_eng_title']. '/'. $row['news_id']; ?>"><?php echo $row['news_title']; ?></a>
                                    </div>
                                    <div class="news-date">
                                        <?php
                                            $date = date('d F Y h:i:sa', strtotime($row['date_posted']));
                                            $marathi_date = explode(' ', $date);
                                            $date_output = $marathi_date[0].' '.$month_array[$marathi_date[1]] . ' ' . $marathi_date[2] . ' ' . $marathi_date[3];
                                        ?>
                                        <i class="fa fa-clock-o" aria-hidden="true" style="font-size: 1.2rem;"></i> <?php echo "$date_output"; ?>
                                    </div>
                                    <div class="share-links">
                                        <div>
                                            <a href="https://www.facebook.com/sharer.php?u=http://thenewsfield.epizy.com/content/<?php echo $row['news_eng_title']. '/'. $row['news_id']; ?>" target="_blank">
                                                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="whatsapp://send?text=http://thenewsfield.epizy.com/content/<?php echo $row['news_eng_title']. '/'. $row['news_id']; ?>" data-action="share/whatsapp/share" target="_blank">
                                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="http://twitter.com/share?url=http://thenewsfield.epizy.com/content/<?php echo $row['news_eng_title']. '/'. $row['news_id']; ?>" target="_blank">
                                                <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }   
                    }
                    else
                    {
                        echo "<p class='col-md-12'>No news for this section</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <?php require "includes/footer.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/main.js"></script>
<script async src="//www.instagram.com/embed.js"></script>
</body>
</html>