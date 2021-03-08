<?php require "includes/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The News Field | Contact Us</title>

    <base href="http://thenewsfield.epizy.com" />
    
    <link rel="icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <style>
        section{
            display: flex;
            text-align: center;
            justify-content: center;
        }

        section div{
            margin: 0px 10px;
        }

        section h1{
            font-weight: bold;
        }

        section a{
            text-decoration: none;
        }

        section a .fa{
            font-size: 40px;
        }

        section:last-child{
            display: block
        }

    </style>
</head>
<body>
    <div class="wrapper">   
        <?php require "includes/header.php"; ?>

        <section style='margin-top: 100px;'>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6" style="margin-top: 100px;">
                        <h1>Follow us on</h1>
                        <section>
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
                        </section>
                        <h1 style="margin-top: 50px;">Email us on</h1>
                        <section>
                            <div>
                                <a href="mailto:ads@thenewsfield.com"><i class="fa fa-envelope" style="font-size:18px;" aria-hidden="true"></i> ads@thenewsfield.com</a>
                            </div>
                            <div>
                                <a href="mailto:jobs@thenewsfield.com"><i class="fa fa-envelope" style="font-size:18px;" aria-hidden="true"></i> jobs@thenewsfield.com</a>
                            </div>
                            <div>
                                <a href="mailto:blogs@thenewsfield.com"><i class="fa fa-envelope" style="font-size:18px;" aria-hidden="true"></i> blogs@thenewsfield.com</a>
                            </div>
                            <div>
                                <a href="mailto:editor@thenewsfield.comm"><i class="fa fa-envelope" style="font-size:18px;" aria-hidden="true"></i> editor@thenewsfield.com</a>
                            </div>
                        </section>          
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require "includes/footer.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>