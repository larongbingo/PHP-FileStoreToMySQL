<?php 
    $DB_HOSTNAME = getenv("DB_HOSTNAME");
    $DB_USERNAME = getenv("DB_USERNAME");
    $DB_PASSWORD = getenv("DB_PASSWORD");
    $DB_PORT = getenv("DB_PORT");
    $DB_NAME = "LibrarySystems";

    try {
        $DB = new PDO("mysql:host=$DB_HOSTNAME;dbname=$DB_NAME;port=$DB_PORT;", $DB_USERNAME, $DB_PASSWORD);
    }
    catch(PDOException $e) {
        echo "Error at connection: " . $e -> getMessage();
    }

    $id = $_GET["thesis_id"];

    $query = $DB -> prepare("SELECT * FROM files WHERE id=?");

    $query -> bindParam(1, $id);

    $query -> execute();

    $row = $query -> fetch();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type:" . $row["file_type"]);
    echo $row["file_binaries"];
?>