<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post">
        <input type="file" name="thesis" id="thesis">
        <button name="submit">Upload</button>
    </form>

    <?php 
        if(isset($_POST["submit"])) {
            $DB_HOSTNAME = "localhost";
            $DB_USERNAME = "root";
            $DB_PASSWORD = "root";
            $DB_NAME = "LibrarySystems";
            $DB_PORT = "35234";

            echo "This works";    
        }
    ?>
</body>
</html>