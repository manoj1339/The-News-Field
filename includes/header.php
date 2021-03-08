<?php
$sql = "SELECT * FROM news LIMIT 0,5;";
$rslt = mysqli_query($conn, $sql);
$n_rows = mysqli_num_rows($rslt);

$scroll_output = "";
if($n_rows > 0)
{
    while($r = mysqli_fetch_assoc($rslt))
    {
        $scroll_output .= '
            <li><a href="search/'.$r['news_eng_title'].'">'.$r['news_title'].'</a></li>
        ';
    }
}
else
{
    $scroll_output = '<li><a href="#">No news</a></li>';
}
?>

<div class="myrow">
        <div style="display: flex;">
            <div id="hamburger">
                <i class="fa fa-bars" aria-hidden="true" style="font-size:24px;"></i>
            </div>
            <div id="logo">
                <a href="/"><img src="images/logo.gif" alt="The News Field" /></a>
            </div> 
        </div>

        <nav>
            <i id="nav-close" class="fa fa-times-circle" aria-hidden="true" style="font-size: 24px;color: #fff;margin: 15px 15px 0px 0px; cursor:pointer"></i>
            <div id="nav-logo">
                <a href="/"><img src="images/logo.gif" alt="Nav-Logo" /></a>
            </div>
            <ul>
                <?php
                foreach($news_categories as $news_category => $news)
                {
                    echo '<li><a href="category/'.$news_category.'">'.$news.'</a></li>';
                }
                ?>
            </ul>
        </nav>

        <!-- Scrolling content -->
        <div id="scroll-content-div">
            <div id="scroll-content">
                <a href="#">काय चाललंय !</a>
                <marquee onmouseover="stop()" onmouseout="start()" direction="left" style="max-width: 550px;">
                    <ul>
                        <?php echo "$scroll_output"; ?>
                    </ul>
                </marquee>
            </div>
        </div>

        <div id="social-search">
            <div>
                <a href="https://www.facebook.com/thenewsfield" target="_blank">
                    <i class="fa fa-facebook-square" aria-hidden="true" style="color: rgb(70, 70, 230);"></i>
                </a>
            </div>
            <div>
                <a href="https://www.youtube.com/channel/UCTizwpjwsvlHboGftlHSSJA" target="_blank">
                    <i class="fa fa-youtube-square" aria-hidden="true" style="color: rgb(238, 83, 83);"></i>
                </a>
            </div>
            <div>
                <a href="https://www.instagram.com/thenewsfield/" target="_blank">
                    <i class="fa fa-instagram" aria-hidden="true" style="color: rgb(236, 79, 79);"></i>
                </a>
            </div>
            <div>  
                <a href="https://www.twitter.com/Thenewsfield?s=20" target="_blank">
                    <i class="fa fa-twitter-square" aria-hidden="true" style="color: rgb(88, 205, 217);"></i>
                </a>
            </div>
            <div id="search-div" data-flag="close">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <form id="search-form" action="search.php">
                <input id="search-input" type="text" name="query" />
            </form>
        </div>

        
    </div>