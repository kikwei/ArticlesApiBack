<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/article.php';

$database = new Database();
$db = $database ->getConnection();

$article = new Article($db);

// get id of article to be edited
$data = json_decode(file_get_contents("php://input"));

//set article id

$article->id = $data->id;

//set other article values
$article->title = $data->title;
$article->body = $data->body;
$article->modified = date('Y-m-d H:i:s');

if($article->update())
{
	echo '{';
    	echo '"message": "Article was updated."';
    echo '}';
}
else
{
	echo '{';
        echo '"message": "Article was not updated."';
    echo '}';
}
?>
