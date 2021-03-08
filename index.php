<?php 
require "includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="VCQCmMyXXDRY7e-h8CRutqYBnxoXGff7HT1loon2jnE" />

    <title>The News Field - Latest News, opinion and viral stories all in Marathi</title>
    <base href="http://thenewsfield.epizy.com" />

    <link rel="icon" href="/images/logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div class="wrapper">   
        <?php include_once "includes/header.php"; ?>

        <section id="main-section">
            <div class="myrow2">

                <div id="left-div">
                    <h1 class="main-logo">
                        <span>The</span><span style="color:#feed01;">News</span><span>Field</span>
                    </h1>
                    <h5 style="font-weight:bold;">आईशप्पत <span style="color:#e8d800;">मज्जा</span> येईल</h5>
                    <div class="news-block">
                        <div class="news-main-tag yellow">बातम्या</div>

                        <?php
                        $query = "SELECT * FROM news ORDER BY date_posted DESC LIMIT 0, 20;";
                        $result = mysqli_query($conn, $query);
                        $num_rows = mysqli_num_rows($result);

                        if($num_rows > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                        ?>
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
                        <?php
                            }   
                        }
                        else
                        {
                            echo "<p>No news for this section</p>";
                        }
                        ?>
    
                    </div>
                </div>

                <div id="right-div">

                    <div class="news-block">

                        <?php
                        foreach($news_categories as $news_color => $news)
                        {
                        ?>
                            <div class='news-main-tag <?php echo "$news_color"; ?>'><?php echo "$news"; ?></div>

                            <?php
                            $query = "SELECT * FROM news WHERE category='$news' ORDER BY date_posted DESC LIMIT 0, 3;";
                            $result = mysqli_query($conn, $query);
                            $num_rows = mysqli_num_rows($result);

                            if($num_rows > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                            ?>

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
                            <?php
                                }   
                            }
                            else
                            {
                                echo "<p>No news for this section</p>";
                            }
                            ?>
        
                            <div class="readMore"><a href="category/<?php echo $news_color; ?>">पुढे वाचा</a></div>

                        <?php
                        }
                        ?>
                    </div>

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