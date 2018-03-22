<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once'../config/databse.php';
include_once'../objects/article.php';

$databse = new Database();

$db = $databse->getConnection();

$article = new Article($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

//set article property values
$article->title = $data->title;
$article->body = $data->body;
$article->created = date('Y-m-d H:i:s');

// create the article
if($article->createArticle()){
    echo '{';
        echo '"message": "Article was created."';
    echo '}';
}
 
// if unable to create the article, tell the user
else
{
    echo '{';
        echo '"message": "Unable to create article."';
    echo '}';
}

?>