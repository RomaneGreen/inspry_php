<?php
require_once "config.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $sql = "SELECT * FROM users WHERE id = ?";
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $_GET["id"]);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $task = $row["task"];
                

            } else {
                echo "Error! Please try again later.";
                exit();
            }

        } else {
            echo "Error! Please try again later.";
            exit();
        }
    }
    $stmt->close();
    $link->close();
} else {
    echo "Error! Please try again later.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 20px;">
                    <div class="card-body">
                        <div class="page-header">
                            <h1>View Task</h1>
                        </div>
                        <div class="form-group">
                            <label>Task</label>
                            <p class="form-control-static"><?php echo $task; ?></p>
                        </div>
                        
                        <p><a href="index.php" class="btn btn-primary">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>