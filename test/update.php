<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM users WHERE id = ?";
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $_GET["id"]);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $param_name = $row["task"];
                $param_address = $row["reason"];
                $param_age = $row["priority"];
            } else {
                echo "Error! Data Not Found";
                exit();
            }
        } else {
            echo "Error! Please try again later.";
            exit();
        }
        $stmt->close();
    }
} else {
    header("location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["task"]) && !empty($_POST["reason"]) && !empty($_POST["priority"])) {

        $sql = "UPDATE users SET task = ?, reason = ?, priority = ? WHERE id = ?";
        if ($stmt = $link->prepare($sql)) {

            $stmt->bind_param("ssii", $_POST["task"], $_POST["reason"], $_POST["priority"], $_GET["id"]);
            $stmt->execute();
            if ($stmt->error) {
                echo "Error!" . $stmt->error;
                exit();
            } else {
                header("location: index.php");
                exit();
            }
            $stmt->close();
        }
    }
    $link->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task </title>
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
               <div class="card" style="margin-top:20px;">
                   <div class="card-body">
                       <div class="page-header">
                           <h2>Update Task</h2>
                       </div>
                       <p>Edit the input to update the Task</p>
                       <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                           <div class="form-group">
                               <label>Task</label>
                               <input type="text" name="name" class="form-control" required value="<?php echo $param_name; ?>">
                           </div>
                           <div class="form-group">
                               <label>Reason</label>
                               <textarea name="address" class="form-control" required ><?php echo $param_address; ?></textarea>
                           </div>
                           <div class="form-group">
                               <label>Priority</label>
                               <input type="text" name="age" class="form-control" value="<?php echo $param_age; ?>" required>
                           </div>
                           <input type="submit" class="btn btn-primary" value="Submit">
                           <a href="index.php" class="btn btn-default">Cancel</a>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>