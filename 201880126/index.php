<?php require_once 'controllers/auth-controller.php';

    if (!isset($_SESSION['id'])) {
        header('location: login.php');
    }

?>
<?php include('crud.php');

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM crud WHERE id=$id");
        $record = mysqli_fetch_array($rec);
        $id = $record['id'];
        $fname = $record['fname'];
        $lname = $record['lname'];
        $program = $record['program'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>201880126 | Home</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>
<body class="bg-dark">
    <div class="container d-flex justify-content-center">
        <div class="card w-75 m-5">
            <div class="card-header">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        unset($_SESSION['alert-class']);
                        ?>
                    </div>
                <?php endif ?>
                <h3>Welcome, <?php echo $_SESSION['username']; ?>!</h3>
                <a class="btn btn-primary" href="index.php?logout=1">Logout</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Program</th>
                            <th colspan="2" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['program']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="crud.php?delete-btn=<?php echo $row['id'] ?>" class="btn btn-primary">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr class="mt-0 mb-1">
                <div class="container">
                    <form method="POST" action="crud.php">
                    <input name="id" value="<?php echo $id; ?>" type="hidden">
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-address-book"></i> </span>
                                </div>
                                <input name="fname" value="<?php echo $fname; ?>" class="form-control form-control-lg" placeholder="First Name" type="text">
                            </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-address-book"></i> </span>
                                </div>
                                <input name="lname" value="<?php echo $lname; ?>" class="form-control form-control-lg" placeholder="Last Name" type="text">
                            </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
                                </div>
                                <input name="program" value="<?php echo $program; ?>" class="form-control form-control-lg" placeholder="Program" type="text">
                            </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <?php if ($edit_state == false): ?>
                                <button name="save-btn" type="submit" class="btn btn-primary btn-block">Save</button>
                            <?php else: ?>
                                <button name="update-btn" type="submit" class="btn btn-primary btn-block">Update</button>
                            <?php endif ?>
                        </div> <!-- form-group// -->
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <!-- <?php if (!$_SESSION['verified']): ?>
                <div class="alert alert-warning">
                    You need to verify your account.
                    Sign in to your email account and click on the
                    verification link we just emailed you at
                    <strong><?php echo $_SESSION['email']; ?></strong>
                </div>
                <?php endif ?> -->
            </div>
        </div>
    </div>
</body>

</html>