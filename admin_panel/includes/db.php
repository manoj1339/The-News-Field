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

function get_visitor($conn)
{
    $query = "SELECT * FROM visitors;";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
}
?>