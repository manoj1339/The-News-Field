<?php
require "includes/db.php";

$fb_share_image = '';
$fb_share_title = '';
$fb_share_desc = '';

$news_eng_title = '';
$news_id = '';

if(isset($_GET['news_eng_title']))
{
    $news_eng_title = test_input($_GET['news_eng_title']);
    $news_id = test_input($_GET['news_id']);

    $q = "SELECT * FROM news WHERE news_id='$news_id' LIMIT 1";
    $r = mysqli_query($conn, $q);
    $n_r = mysqli_num_rows($r);

    if($n_r > 0){
        while($rw = mysqli_fetch_assoc($r))
        {
            $fb_share_image = "https://thenewsfield.epizy.com/admin_panel/" . $rw['news_thumbnail'];
            $fb_share_title = test_input($rw['news_title']);
            $fb_share_desc = $rw['category'];
        }
    }
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

    <meta property="og:title"         content='<?php echo "$fb_share_title"; ?>' />
    <meta property="og:description"   content='<?php echo "$fb_share_desc"; ?>' />
    <meta property="og:image"         content='<?php echo "$fb_share_image"; ?>' />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content='<?php echo "$fb_share_title"; ?>' />
    <meta name="twitter:description" content='<?php echo "$fb_share_desc"; ?>' />
    <meta name="twitter:image" content='<?php echo "$fb_share_image"; ?>' />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The News Field | content</title>

    <base href="http://thenewsfield.epizy.com" />

    <link rel="icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/content.css" />

    <style>
    .instaFetch, .twitterFetch, .facebookFetch, .facebookVideoFetch, .youtubeFetch{
        max-width: 552px;
        margin: 20px auto;
    }
    .iframe-container{
        width: 100%;
        height: 0;
        padding-bottom: 56.2%;
        position:relative;
    }

    .iframe-container iframe{
        position: absolute;
        top: 0;
        left: 50%;
        transform:translateX(-50%);
        height: 100%;
        width: 100%;
    }

    .fbiframe-container{
        width: 100%;
        height: 0;
        padding-bottom: 90.2%;
        position:relative;
    }

    .fbiframe-container iframe{
        position: absolute;
        top: 0;
        left: 50%;
        transform:translateX(-50%);
        height: 100%;
        width: 100%;
    }
    </style>

</head>
<body>
    <div class="wrapper">
        <?php include_once "includes/header.php"; ?>
        
        <section id="content-main-section" style='margin-top: 160px;'>
            <div class="row">

                <div class="col-lg-8" style="margin-bottom:60px;">

                        <?php
                        $query = "SELECT * FROM news WHERE news_eng_title='$news_eng_title' AND news_id='$news_id';";
                        $result = mysqli_query($conn, $query);
                        $num_rows = mysqli_num_rows($result);

                        if($num_rows > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                        ?>

                        <ul class="bread-crumb">
                            <li><a href="/">Home</a></li>
                            <li><a href="category/<?php foreach($news_categories as $news => $n){ if($row['category'] == $n){ echo $news; } } ?>"><?php echo $row['category']; ?></a></li>
                        </ul>

                        <div class="content-news">
                            <h2><?php echo $row['news_title']; ?></h2>
                            <div class="content-header">
                                <div class="content-user-info">
                                    <div class="user">
                                        <div>
                                            <div class="user-image">
                                                <img src="images/user.png" alt="user" />
                                            </div>
                                        </div>
                                        <div style="margin-left: 10px;">
                                            <div class="user-name">
                                                TheNewsField
                                            </div>
                                            <div class="user-email">
                                                editor@thenewsfield.com
                                            </div>
                                            <?php
                                                $date = date('d F Y h:i:sa', strtotime($row['date_posted']));
                                                $marathi_date = explode(' ', $date);
                                                $date_output = $marathi_date[0].' '.$month_array[$marathi_date[1]] . ' ' . $marathi_date[2] . ' ' . $marathi_date[3];
                                            ?>
                                            <div class="user-posted-date">
                                                <i class="fa fa-clock-o" aria-hidden="true" style="font-size: 1.2rem;"></i> <?php echo "$date_output"; ?>
                                            </div>
                                        </div>
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

                            <div class="content-description">
                                <?php echo $row['news_desc']; ?>
                            </div>

                        </div>

                        <?php
                            }
                        }
                        else
                        {
                            header('location: index.php');
                            exit();
                        }
                        ?>

                </div>

                <div class="col-lg-4">

                    <div class="news-block">
                        <div class="news-main-tag yellow">बातम्या</div>
                        
                        <?php
                        $query1 = "SELECT * FROM news LIMIT 0, 5;";
                        $result1 = mysqli_query($conn, $query1);
                        $num_rows1 = mysqli_num_rows($result1);

                        if($num_rows1 > 0)
                        {
                            while($row = mysqli_fetch_assoc($result1))
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
            </div>
        </section>
    </div>
    <?php require "includes/footer.php"; ?>

    <!-- Script files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://www.instagram.com/embed.js"></script>

    <script>
		$(document).ready(function(){
		
			$('.instaFetch').each(function(item){
			    var insta_post = $(this).html().trim();
				var obj = $(this);
				var insta_fetch_url = "https://api.instagram.com/oembed/?omitscript=true&url=" + insta_post;
				
				$.ajax({
					method: 'get',
					url: insta_fetch_url,
					success: function(data){
						obj.html(data.html);
						instgrm.Embeds.process();
					}
				});
			});
			
			$('.twitterFetch').each(function(item){
			    var twitter_post = $(this).html().trim();
				var obj = $(this);
				var twitter_fetch_url = "https://publish.twitter.com/oembed?url=" + twitter_post;
				
				$.ajax({
					method: 'get',
					url: twitter_fetch_url,
					dataType: "jsonp",
					headers:{"Access-Control-Allow-Origin": "*"},
					success: function(data){
						obj.html(data.html);
						twttr.widgets.load();
					}
				});
			});

            $('.facebookFetch').each(function(item){
			    var facebook_post = $(this).html().trim();
				var obj = $(this);
				var facebook_fetch_url = "https://www.facebook.com/plugins/post/oembed.json/?url=" + facebook_post;
				
				$.ajax({
					method: 'get',
					url: facebook_fetch_url,
					dataType: "jsonp",
					headers:{"Access-Control-Allow-Origin": "*"},
					success: function(data){
						obj.html(data.html);
					}
				});
			});
			
			
			
			$('.facebookVideoFetch').each(function(item){
				var fb_video_post = $(this).html().trim();
				var fb_video = `
				<div class="fbiframe-container">
					<iframe src="https://www.facebook.com/plugins/post.php?href=`+ fb_video_post +`&show_text=true&width=552&appId=2230941490535131&height=402" width="552" height="402" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
				</div>
				`;
				
				$(this).html(fb_video);
			});
			
			$('.youtubeFetch').each(function(item){
			
                var str = $(this).html().trim();
                
                var first = str.indexOf("v=");
                var last = str.indexOf("&");
                
                var youtube_video_id = "";
                
                if(last == -1)
                {
                    youtube_video_id = str.substring(first+2);
                }
                else{
                    youtube_video_id = str.substring(first+2, last);
                }
                
                var youtube_video = `
                <div class="iframe-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/`+ youtube_video_id +`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                `;
                
                $(this).html(youtube_video);
                
            });
			
		});
		</script>


</body>
</html>