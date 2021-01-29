<?php

    $db = mysqli_connect('localhost', 'root', '', 'homecillo');

    $id = 0;
    $iso = "";
    $name = "";
    $nicename = "";
    $iso3 = "";
    $numcode = "";
    $phonecode = "";
    $created_at = "";
    $edit_state = false;

    if (isset($_POST['save-btn'])) {
        $iso = $_POST['iso'];
        $name = $_POST['name'];
        $nicename = $_POST['nicename'];
        $iso3 = $_POST['iso3'];
        $numcode = $_POST['numcode'];
        $created_at = $_POST['created_at'];
        $edit_state = false;

        $query = "INSERT INTO country (iso, name, nicename, iso3, numcode, phonecode, created_at) VALUES ('$iso', '$name', '$nicename', '$iso3', '$numcode', '$phonecode', '$created_at')";
        mysqli_query($db, $query);
        $_SESSION['message'] = "Data saved to database.";
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
    }

    if (isset($_POST['update-btn'])) {
        $iso = mysqli_real_escape_string($db, $_POST['iso']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $nicename = mysqli_real_escape_string($db, $_POST['nicename']);
        $iso3 = mysqli_real_escape_string($db, $_POST['iso3']);
        $numcode = mysqli_real_escape_string($db, $_POST['numcode']);
        $phonecode = mysqli_real_escape_string($db, $_POST['phonecode']);
        $created_at = mysqli_real_escape_string($db, $_POST['created_at']);

        mysqli_query($db, "UPDATE country SET iso='$iso', name='$name', nicename='$nicename', iso3='$iso3', numcode='$numcode', phonecode='$phonecode' where id='$id'");
        $_SESSION['message'] = 'Data updated.';
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
    }

    if (isset($_GET['delete-btn'])) {
        $id = $_GET['delete-btn'];
        mysqli_query($db, "DELETE FROM country WHERE id='$id'");
        $_SESSION['message'] = "Data deleted from database.";
        header('location: index.php');
    }

    $results = mysqli_query($db, "SELECT * FROM country");
    
?>