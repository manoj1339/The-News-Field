<?php
$host = "sql203.epizy.com";
$username = "epiz_26595815";
$password = "EnJhQBpT0buP";
$db_name = "epiz_26595815_thenewsfield";

$conn = mysqli_connect($host, $username, $password, $db_name);
mysqli_set_charset($conn, 'utf8');

if(!$conn)
{
    echo "Database connection unsuccessful";
    exit();
}

$news_categories = array(
    'kay-chalalay' => 'काय चाललंय !',
    'zal-ki-viral' => 'झाल कि व्हायरल !',
    'khas-tumchyasathi' => 'खास तुमच्यासाठी !',
    'aapla-rajkaran' => 'आपलं राजकारण',
    'kisse' => 'किस्से',
    'mayanagari' => 'मायानगरी',
    'baliraja' => 'बळीराजा',
    'Khel-kud' => 'खेळ-कुद',
    'aarogya' => 'आरोग्य'
);

$month_array = array(
    'January' => 'जानेवारी',
    'February' => 'फेब्रुवारी',
    'March' => 'मार्च',
    'April' => 'एप्रिल',
    'May' => 'मे',
    'June' => 'जून',
    'July' => 'जुलै',
    'August' => 'ऑगस्ट',
    'September' => 'सप्टेंबर',
    'October' => 'ऑक्टोबर',
    'November' => 'नोव्हेंबर',
    'December' => 'डिसेंबर'
);

function stripFirstLine($text)
{        
  return substr($text, 0, strpos($text, ".")+1);
}

function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_admin_info($conn, $admin)
{
    $query = "SELECT * FROM users WHERE email='$admin' LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    $info_array = array();

    if($num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result)){
            array_push($info_array, $row['email']);
            array_push($info_array, $row['is_superuser']);
            array_push($info_array, $row['last_login']);
        }
    }
    else
    {
        array_push($info_array, "No info");
    }

    return $info_array;
}

function get_post_count($conn){
    $query = "SELECT * FROM news";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
}

function get_user_count($conn){
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
}

function insert_visitor($conn, $ip)
{
    $query = "SELECT * FROM visitors WHERE ip='$ip';";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows == 0)
    {
        $query1 = "INSERT INTO visitors (ip) VALUES ('$ip');";
        $result1 = mysqli_query($conn, $query1);
    }
}

insert_visitor($conn, $_SERVER['REMOTE_ADDR']);
?>