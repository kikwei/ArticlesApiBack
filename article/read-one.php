<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');


include_once '../config/database.php';
include_once '../objects/article.php';

$database = new Database();

$db = $database ->getConnection();

$article = new Article($db);

// set ID property of article to be edited
$article->id = isset($_GET['id']) ? $_GET['id'] : die();
// $article->id = isset($_GET['id']);

$article->readOne();

// create array
$article_arr = array(
    "id" =>  $article->id,
    "title" => $article->title,
    "body" => $article->body,
    "created" => $article->created,
    "modified" => $article->modified
 
);
 
// make it json format
print_r(json_encode($article_arr));
?>