<?php
require_once "config.php";
$sql = "SELECT * FROM users";
$result = $link->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Tasks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .btn{
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 20px;margin-bottom: 20px;">
                    <div class="card-body">
                        <h2 class="pull-left">Task Details <a href="create.php" class="btn btn-success pull-right">Add New Task</a></h2>
                 
                    </div>
                </div>
                <?php
                if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Task</th>";
                        echo "<th>Reason</th>";
                        echo "<th>Priority</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['task'] . "</td>";
                            echo "<td>" . $row['reason'] . "</td>";
                            echo "<td>" . $row['priority'] . "</td>";
                            echo "<td>";
                            echo "<a href='read.php?id=" . $row['id'] . "' class='btn btn-primary'>Read</a>";
                            echo "<a href='update.php?id=" . $row['id'] . "' class='btn btn-info'>Update</a>";
                            echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        $result->free();
                    } else {
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                $link->close();
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>