<?php
    
    $db = mysqli_connect('localhost', 'root', '', 'homecillo');

    $id = 0;
    $fname = "";
    $lname = "";
    $program = "";
    $edit_state = false;

    if (isset($_POST['save-btn'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $program = $_POST['program'];

        $query = "INSERT INTO crud (fname, lname, program) VALUES ('$fname', '$lname', '$program')";
        mysqli_query($db, $query);
        $_SESSION['message'] = "Data saved to database.";
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
    }

    if (isset($_POST['update-btn'])) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $fname = mysqli_real_escape_string($db, $_POST['fname']);
        $lname = mysqli_real_escape_string($db, $_POST['lname']);
        $program = mysqli_real_escape_string($db, $_POST['program']);

        mysqli_query($db, "UPDATE crud SET fname='$fname', lname='$lname', program='$program' where id='$id'");
        $_SESSION['message'] = 'Data updated.';
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
    }

    if (isset($_GET['delete-btn'])) {
        $id = $_GET['delete-btn'];
        mysqli_query($db, "DELETE FROM crud WHERE id='$id'");
        $_SESSION['message'] = "Data deleted from database.";
        header('location: index.php');
    }

    $results = mysqli_query($db, "SELECT * FROM crud");
    
?>