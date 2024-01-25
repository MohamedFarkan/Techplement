<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/week1-tasks/To-do-list/CSS/register.css">
    <title>ADD NEW TASK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <!-- Replace this with the local path to your Font Awesome CSS file -->
    <link rel="stylesheet" href="/path/to/fontawesome.min.css">
    <link rel="icon" type="image/x-icon" href="/To-do-list/Icons/.png">
    <script src="https://kit.fontawesome.com/b21ac06503.js" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/b21ac06503.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>

<body>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500
        });
    </script>




    <!-- The rest of your content -->

    <!-- JavaScript for hiding the preloader -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                // Add 'loaded' class to body after a delay
                document.body.classList.add("loaded");
            }, 2000); // Adjust the delay time in milliseconds (e.g., 2000 for 2 seconds)
        });
    </script>
    <?php
    function formatTime($inputTime)
    {
        $ttime = new DateTime($inputTime);
        return $ttime->format("H.i");
    }
    ?>
    <?php
    if (isset($_POST["submit"])) //works only if someone clicks submit button
    {
        $tdate = $_POST["date_"];
        $ttime = date("H.i", strtotime($_POST["time_"])) . substr((string)microtime(), 1, 3);
        $task = $_POST["task"];
        $task_id = isset($_GET['task_id']) ? $_GET['task_id'] : null;

        $errors = array();
        require_once "data.php";

        // Fetch data from the database if a task ID is provided
        $rowcount = 0;
        if (!empty($task_id)) {
            $sql = "SELECT * FROM tasks WHERE task_id = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $task_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Fetch the row from the result set
                $row = mysqli_fetch_assoc($result);
                $rowcount = mysqli_num_rows($result);
            }
        }

        if ($rowcount > 0) {
            array_push($errors, "Entered task is already there in the TO-DO list!");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            $sql = "INSERT INTO tasks (date_, time_, task) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt) {
                mysqli_stmt_bind_param($stmt, "sss", $tdate, $ttime, $task);
                mysqli_stmt_execute($stmt);
                echo '<script type="text/javascript">';
                echo ' alert("New task Added Successfully")';
                header("Location: home.php");
                echo '</script>';
            } else {
            }
        }
    }
    ?>
    <div class="container" id="container">
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-left">
                    <img class="signup" src="/week1-tasks/To-do-list/Icons/to-do-list.png" style="height: 256px; width: 256px" alt="Error">

                    <!--   <h1>HTML CSS Login Form</h1>
                    <p>This login form is created using pure HTML and CSS. For social icons, FontAwesome is used.</p>-->
                </div>
            </div>
        </div>
        <div class="form-container log-in-container">

            </script>
            <form action="addtask.php" method="post">
                <h>TO-DO<B> LIST</B></h>
                <h1>ADD NEW TASK</h1>

                <span>All the best for your new task!</span>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>

                <input type="date" placeholder="Date" autocomplete="off" name="date_" value="<?php echo isset($row["date_"]) ? $row["date_"] : ''; ?>" required />
                <input type="time" placeholder="Time" autocomplete="off" name="time_" value="<?php echo isset($row["time_"]) ? $row["time_"] : ''; ?>" required />
                <input type="text" placeholder="Task" autocomplete="off" name="task" value="<?php echo isset($row["task"]) ? $row["task"] : ''; ?>" required />

                <button type="submit" name="submit">ADD</button>

                <a href="#" onclick="home_page()">BACK TO HOME PAGE</a>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Flag to check if the form was submitted
                        var formSubmitted = <?php echo isset($_POST["submit"]) ? "true" : "false"; ?>;

                        setTimeout(function() {
                            // Hide the preloader
                            document.getElementById('preloader').style.display = 'none';

                            // Show the welcome toast only if there are no errors and the form was not submitted
                            if (formSubmitted === false) {
                                Toastify({
                                    text: "Add new tasks...",
                                    duration: 2000,
                                    close: true,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "linear-gradient(to right, #fd746c, #ff9068)",
                                }).showToast();
                            }
                        }, 2000); // Adjust the delay time in milliseconds (e.g., 2000 for 2 seconds)
                    });
                </script>
                <script>
                    function home_page() {
                        swal({
                            title: "Back to home Page!",
                            text: "...No task to add!",
                            button: "OK",
                        }).then(function() {
                            window.location.href = "home.php";
                        });
                    }
                </script>




            </form>
        </div>

    </div>
</body>

</html>