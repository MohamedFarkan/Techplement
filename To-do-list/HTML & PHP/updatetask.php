<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/week1-tasks/To-do-list/CSS/register.css">
    <title>UPDATE TASK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <!-- Replace this with the local path to your Font Awesome CSS file -->
    <link rel="stylesheet" href="/path/to/fontawesome.min.css">
    <link rel="icon" type="image/x-icon" href="/To-do-list/Icons/.png">

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


    include 'data.php';

    $id = isset($_GET['updateid']) ? $_GET['updateid'] : (isset($_POST['updateid']) ? $_POST['updateid'] : null);


    $query = "SELECT * FROM tasks WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    if (isset($_POST['updateid'])) {
        //$id = isset($_GET['updateid']) ? $_GET['updateid'] : null;



        // Check if the form was submitted
        if (isset($_POST['submit'])) {
            $date = mysqli_real_escape_string($conn, $_POST["date_"]);
            $time = mysqli_real_escape_string($conn, $_POST["time_"]);
            $ttask = mysqli_real_escape_string($conn, $_POST["task_"]);

            // Use a prepared statement to update data
            $query = "UPDATE tasks SET date_=?, time_=?, task=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssdi", $date, $time, $ttask, $id);
            if (mysqli_stmt_execute($stmt)) {
                echo '<script type="text/javascript">';
                echo 'alert("Task Updated Successfully");';
                echo 'window.location.href = "home.php";'; // Redirect using JavaScript
                echo '</script>';
            } else {
                die("Something went wrong: " . mysqli_error($conn));
            }
        } else {
            echo 'form not submited';
        }
    }


    ?>
    <div class="container" id="container">
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-left">
                    <img class="signup" src="/week1-tasks/To-do-list/Icons/exam.png" style="height: 256px; width: 256px" alt="Error">

                    <!--   <h1>HTML CSS Login Form</h1>
                    <p>This login form is created using pure HTML and CSS. For social icons, FontAwesome is used.</p>-->
                </div>
            </div>
        </div>
        <div class="form-container log-in-container">
            <form action="updatetask.php" method="post">
                <input type="hidden" name="updateid" value="<?php echo $row['id'] ?>">
                <h>TO-DO<B> LIST</B></h>
                <h1>MODIFY TASK</h1>

                <span>Any change in your task!</span>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>

                <input type="date" autocomplete="off" name="date_" value="<?php echo  $row['date_']  ?>" required />
                <input type="time" autocomplete="off" name="time_" value="<?php echo $row['time_'] ?>" required />
                <input type="text" autocomplete="off" name="task_" value="<?php echo $row['task'] ?>" required />


                <button type="submit" name="submit">MODIFY</button>

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
                            text: "...No more changes!",
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