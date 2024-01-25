<?php

include 'data.php';

if (isset($_GET['deleteid'])) {
    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);

    $query = "DELETE FROM tasks where id= $id";
    echo $query;
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:home.php');
    } else {
        die(mysqli_errno($conn));
    }
}
