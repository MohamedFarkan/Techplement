<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/week1-tasks/To-do-list/CSS/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/To-do-list/Icons/resume-builder-logo.png">
    <title>Login</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://kit.fontawesome.com/b21ac06503.js" crossorigin="anonymous"></script>
</head>

<body>
    <script>
        function displayErrorToast(message) {
            Toastify({
                text: message,
                duration: 3000, // Adjust duration as needed
                close: true,
                gravity: "top",
                position: 'center',
                backgroundColor: "linear-gradient(to right, #FF5E5B, #FF2F2F)",
            }).showToast();
        }
    </script>

    <?php
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "data.php";
        $sql = "SELECT * FROM user_details WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {

            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["user"] = $email;
                header("Location: home.php");
                die();
            } else {
                echo "<script>displayErrorToast('Wrong password');</script>";
            }
        } else {
            echo "<script>displayErrorToast('User does not exist');</script>";
        }
    }

    ?>




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

    <div class="container" id="container">
        <div class="form-container log-in-container">
            <form action="login.php" method="post">
                <h>TO-DO<B> LIST</B></h>
                <h1>Login</h1>

                <span>Wanna check out your tasks.....Login
                </span>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />

                <button name="submit" type="submit">Log In</button>


                <a href="#" onclick="reg_page()">Register</a>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        setTimeout(function() {
                            // Hide the preloader
                            document.getElementById('preloader').style.display = 'none';

                            // Show the welcome toast
                            Toastify({
                                text: "Login to continue your journey...",
                                duration: 2000,
                                close: true,
                                gravity: "top",
                                position: 'center',
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            }).showToast();
                        }, 2000); // Adjust the delay time in milliseconds (e.g., 2000 for 2 seconds)
                    });
                </script>
                <script>
                    function reg_page() {
                        swal({
                            title: "New user!",
                            text: "...click ok to register!",
                            button: "OK",
                        }).then(function() {
                            window.location.href = "register.php";
                        });
                    }
                </script>



            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-right">
                    <img src="/week1-tasks/To-do-list/Icons/check.png" alt="" style="height: 265px;width: 265px">
                </div>
            </div>
        </div>
    </div>
</body>

</html>