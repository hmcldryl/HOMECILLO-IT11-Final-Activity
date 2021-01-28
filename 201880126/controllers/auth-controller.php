<?php
    session_start();

    require 'config/db.php';

        $errors = array();
        $username = "";
        $email = "";
        
        if (isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['verified']);
            header('location: login.php');
        }

        if (isset($_POST['login-btn'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            if (empty($username)) {
                $errors['username'] = "Username required";
            }
            if (empty($password)) {
                $errors['password'] = "Password required";
            }

            if (count($errors) === 0) {
                $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $username, $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
        
                if (null !== password_verify($password, $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['verified'] = $user['verified'];
        
                    $_SESSION['message'] = "You are now logged in.";
                    $_SESSION['alert-class'] = "alert-success";
                    header('location: index.php');
                    exit();
                } else {
                    $errors['login_fail'] = "Wrong credentials";
                }
            }

        }

        if (isset($_POST['register-btn'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        
            if (empty($username)) {
                $errors['username'] = "Username required";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email address is invalid";
            }
            if (empty($email)) {
                $errors['email'] = "Email required";
            }
            if (empty($password)) {
                $errors['password'] = "Password required";
            }
            if ($password != $passwordConf) {
                $errors['password'] = "Password does not match";
            }

            $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
            $stmt = $conn->prepare($emailQuery);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $userCount = $result->num_rows;
            $stmt->close();

            if ($userCount > 0) {
                $errors['email'] = "Email already exists";
            }

            if (count($errors) === 0) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $token = bin2hex(random_bytes(50));
                $verified = false;

                $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssbss', $username, $email, $verified, $token, $password);

                if ($stmt->execute()) {
                    $user_id = $conn->insert_id;
                    $_SESSION['id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['verified'] = $verified;

                    $_SESSION['message'] = "You are now logged in!";
                    $_SESSION['alert-class'] = "alert-success";
                    header('location: index.php');
                    exit();
                } else {
                    $errors['db_error'] = "Database error: failed to register";
                }
            }
        }
?>