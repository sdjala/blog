<?php
include '../../utils/dbh.php';
include '../includes_admin/seoFriendlyUrl.php';
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if (isset($_POST["upload"])) {
    $article_id = test_input($_POST['article_id']);
    $title = test_input($_POST['title']);
    $author = test_input($_POST['author']);
    $tags = test_input($_POST['tags']);
    $category = test_input($_POST['category']);
    $date = test_input($_POST['date']);
    $is_feature = test_input($_POST['is_feature']);
    $status = test_input($_POST['status']);
    $summary = test_input($_POST['summary']);
    $body = trim($_POST['froala-editor']);
    $url=generateSeoURL($title, 6);

    $query = "  
                    UPDATE articles   
                    SET    
                    title = '$title',   
                    author = '$author',   
                    tags = '$tags',   
                    category = '$category',   
                    date = '$date',   
                    is_feature = '$is_feature',   
                    status = '$status',   
                    summary = '$summary',   
                    body = '$body',
                    seo_url = '$url' 
                    WHERE id='$article_id'";

                    $result = mysqli_query($connect, $query);
                    if($result){
                        echo 'ok';
                    }else{
                        echo 'err';
                    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

 ?>