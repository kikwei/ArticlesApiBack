<?php
class Article{
 
    // database connection and table name
    private $conn;
    private $table_name = "articles";
 
    // object properties
    public $id;
    public $title;
    public $body;
    public $created;
    public $modified;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // read articles
function read(){
 
    // select all query
    $query = "SELECT * FROM $this->table_name";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


function readOne()
{
    // $query = "SELECT * FROM $this->table_name WHERE id = ? LIMIT 0,1";
    // $query = "SELECT * FROM `articles` WHERE id = '".$article->id."'";
    $query = "SELECT * FROM $this->table_name WHERE id = '".$_GET['id']."'";

    $stmt = $this->conn->prepare($query);

    //bind id of article

    $stmt -> bindParam(1,$this->id);


    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

     // set values to object properties
    $this->id = $row["id"];
    $this->title = $row["title"];
    $this->body = $row["body"];
    $this->created = $row["created"];
    $this->modified = $row["modified"];
}


function createArticle()
{
    $query = "INSERT INTO `articles` SET title=:title, body=:body, created=:created";

    $stmt = $this->conn->prepare($query);

    $this->title = htmlspecialchars(strip_tags($this->name));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->created=htmlspecialchars(strip_tags($this->created));

    //bind parameters
    $stmt->bindParam(":title",$this->title);
    $stmt->bindParam(":body",$this->body);
    $stmt->bindParam(":created",$this->created);

    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

function update()
{
    $query = "UPDATE `articles` SET title=:title, body=:body, modified=:modified WHERE id=:id";
    $stmt = $this->conn->prepare($query);

    $this->title = htmlspecialchars(strip_tags($this->name));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->modified = htmlspecialchars(strip_tags($this->modified));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bidn parameters
    $stmt->bindParam(':title',$this->title);
    $stmt->bindParam(':body',$this->body);
    $stmt->bindParam(':modified',$this->modified);
    $stmt->bindParam(':id',$this->id);

    if($stmt->execute())
    {
        return true;
    }

    return false;

}

}
?>