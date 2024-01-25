<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/week1-tasks/To-do-list/CSS/register.css">
    <title>Sign Up</title>
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
    if (isset($_POST["submit"])) //works only if someone clicks submit button
    {
        $fullname = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"]; //encrypting the passs
        $cpass = $_POST["con_pass"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        $errors = array();



        if (strlen($password) < 8) {
            echo '<script>
            Toastify({
                text: "Password needs to be at least 8 characters",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#DC4C64",
            }).showToast();
          </script>';
            array_push($errors, "");
        }
        if ($password !== $cpass) {
            '<script>
            Toastify({
                text: "Password does not match",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#DC4C64",
            }).showToast();
          </script>';
            array_push($errors, "");
        }
        require_once "data.php";
        $sql = "SELECT * FROM user_details WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            echo '<script>
            Toastify({
                text: "User already exists!",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#DC4C64",
            }).showToast();
          </script>';
            array_push($errors, "");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            $sql = "INSERT INTO user_details (username, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt) {
                mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo '<script>
                Toastify({
                    text: "Registration Successful",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#14A44D",
                }).showToast();
              </script>';
            } else {
                die("Something went wrong");
            }
        }
    }
    ?>
    <div class="container" id="container">
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-left">
                    <img class="signup" src="/week1-tasks/To-do-list/Icons/check (1).png" style="height: 256px; width: 256px" alt="Error">

                    <!--   <h1>HTML CSS Login Form</h1>
                    <p>This login form is created using pure HTML and CSS. For social icons, FontAwesome is used.</p>-->
                </div>
            </div>
        </div>
        <div class="form-container log-in-container">
            <form action="register.php" method="post">
                <h>TO-DO<B> LIST</B></h>
                <h1>Sign Up</h1>

                <span>Join us to complete your daily routine!</span>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>

                <input type="text" placeholder="Username" name="username" required />
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />
                <input type="password" placeholder="Confirm Password" name="con_pass" required />

                <button type="submit" name="submit">Sign up</button>

                <a href="#" onclick="login_page()">Sign In</a>
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
                                    text: "Register to start your journey with us...",
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
                    function login_page() {
                        swal({
                            title: "Already have an account!",
                            text: "...login!",
                            button: "OK",
                        }).then(function() {
                            window.location.href = "login.php";
                        });
                    }
                </script>




            </form>
        </div>
        <!--  <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-right">
                    <img src="/ResumeBuilder/icons/human-resources.png" alt="">
                      <h1>HTML CSS Login Form</h1>
                    <p>This login form is created using pure HTML and CSS. For social icons, FontAwesome is used.</p>
                </div>
            </div>
        </div> -->
    </div>
</body>

</html>