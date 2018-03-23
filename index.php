<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
</head>
<body>
    <form action="/?action=upload" enctype="multipart/form-data" method="post">
        <input type="text" name="thesis_title"><br>
        <input type="file" name="thesis" id="thesis"><br>
        <button name="submit">Upload</button>
    </form>

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
        }
    ?>

</body>
</html>