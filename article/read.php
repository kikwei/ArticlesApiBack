<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/article.php';

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);

$stmt = $article ->read();

$num = $stmt->rowCount();

if($num>0)
{
	$article_arr = array();
	$article_arr["details"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		extract($row);

		$article_item = array(
			"id" => $id,
			"title" => $title,
			"body" => $body,
			"created" => $created
		);

		array_push($article_arr["details"], $article_item);

	}

	echo json_encode($article_arr);
}
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}


?>