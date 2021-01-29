<?php require_once 'controllers/auth-controller.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>201880126 | Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/14cfaf5485.js"></script>
</head>
<body class="bg-dark">
    <div class="container d-flex justify-content-center">
        <div class="card w-50 m-5">
            <article class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Log In</h4>
                <hr>
                <form method="POST" action="login.php">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="username" value="<?php echo $username; ?>" class="form-control form-control-lg" placeholder="Username" type="text">
                        </div> <!-- input-group.// -->
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password" class="form-control form-control-lg" placeholder="Password" type="password">
                        </div> <!-- input-group.// -->
                    </div> <!-- form-group// -->
                    <div class="form-group mb-2">
                        <button name="login-btn" type="submit" class="btn btn-primary btn-block">Login</button>
                    </div> <!-- form-group// -->
                    <div class="form-group mb-0">
                        <a href="register.php" class="btn btn-primary btn-block">Register</a>
                    </div> <!-- form-group// -->
                </form>
            </article>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>