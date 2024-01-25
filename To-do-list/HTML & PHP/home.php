<?php
include 'data.php';
$query = "SELECT * FROM tasks";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/week1-tasks/To-do-list/CSS/home.css">
    <script src="https://kit.fontawesome.com/b21ac06503.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h2>Your To-Do-List</h2>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1"><b>
                        <h3>DATE</h3>
                    </b></div>
                <div class="col col-2"><b>
                        <h3>TIME</h3>
                    </b></div>
                <div class="col col-3"><b>
                        <h3>TASK</h3>
                    </b></div>
                <div class="col col-4"><b>
                        <h3>UPDATE</h3>
                    </b></div>
                <div class="col col-4"><b>
                        <h3>DELETE</h3>
                    </b></div>

            </li>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                /* $name = $row['package_name'];
                                     $pinc = $row['package_name'];
                                     $pkprice = $row['price_of_package'];*/
            ?>
                <li class="table-row">
                    <div class="col col-1" data-label="DATE"><?php echo $row['date_']; ?></div>
                    <div class="col col-2" data-label="TIME"><?php echo $row['time_']; ?></div>
                    <div class="col col-3" data-label="TASK"><?php echo $row['task']; ?></div>
                    <div class="col col-4" data-label="UPDATE_TASK"><a href="updatetask.php?updateid=<?php echo $id; ?>" class="btn btn-primary">Update <i class="fa-solid fa-pen-to-square"></i></a></div>
                    <div class="col col-4" data-label="REMOVE_TASK"><a href="removetask.php?deleteid=<?php echo $id; ?>" class="btn btn-danger">Remove <i class="fa-solid fa-trash"></i></a></div>
                </li>
            <?php
            }
            ?>
        </ul>
        <a href="addtask.php" class="btn btn-success">Add new task <i class="fa-solid fa-plus"></i></a>
        <a href="login.php" class="btn btn-danger">Logout <i class="fa-solid fa-right-from-bracket"></i></a>

    </div>

</body>

</html>