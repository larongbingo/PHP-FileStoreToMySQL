<?php 
        if(isset($_GET["action"])) {
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

            if($_GET["action"] == "upload") {
                // Get the File and Information
                $title = $_POST["thesis_title"];
                $name = $_FILES["thesis"]["name"];
                $type = $_FILES["thesis"]["type"];
                $data = file_get_contents($_FILES["thesis"]["tmp_name"]);

                $query = $DB -> prepare("INSERT INTO files VALUES (DEFAULT, ?, ?, ?, ?, NOW(), NOW())");

                $query -> bindParam(1, $title);
                $query -> bindParam(2, $name);
                $query -> bindParam(3, $type);
                $query -> bindParam(4, $data);

                $result = $query -> execute();

                if($result) {
                    echo "{success: true}";
                }
                else {
                    echo "{success: false}";
                }
            }
            else if($_GET["action"] == "download") {
                $id = $_POST["thesis_id"];

                $query = $DB -> prepare("SELECT * FROM files WHERE id=?");

                $query -> bindParam(1, $id);

                $query -> execute();

                $row = $query -> fetch();
                header("Content-Type:" . $row["file_type"]);
                echo $row["file_data"];
            }
        }
    ?>