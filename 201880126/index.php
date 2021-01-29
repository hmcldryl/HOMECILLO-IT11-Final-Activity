<?php require_once 'controllers/auth-controller.php';

    if (!isset($_SESSION['id'])) {
        header('location: login.php');
    }

?>
<?php include('crud.php');

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM country WHERE id=$id");
        $record = mysqli_fetch_array($rec);
        $id = $record['id'];
        $iso = $record['iso'];
        $name = $record['name'];
        $nicename = $record['nicename'];
        $iso3 = $record['iso3'];
        $numcode = $record['numcode'];
        $phonecode = $record['phonecode'];
        $created_at = $record['created_at'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>201880126 | Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/14cfaf5485.js"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid d-flex justify-content-center">
        <div class="card m-5">
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
                            <th scope="col">ISO</th>
                            <th scope="col">NAME</th>
                            <th scope="col">NICE NAME</th>
                            <th scope="col">ISO3</th>
                            <th scope="col">NUMCODE</th>
                            <th scope="col">PHONECODE</th>
                            <th scope="col">CREATED AT</th>
                            <th colspan="2" scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr class="text-center">
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['iso']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['nicename']; ?></td>
                                <td><?php echo $row['iso3']; ?></td>
                                <td><?php echo $row['numcode']; ?></td>
                                <td><?php echo $row['phonecode']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
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
                                    <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                </div>
                                <input name="iso" value="<?php echo $iso; ?>" class="form-control form-control-lg" placeholder="ISO" type="text">
                            </div> 
                        </div> 
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                </div>
                                <input name="name" value="<?php echo $name; ?>" class="form-control form-control-lg" placeholder="NAME" type="text">
                            </div> 
                        </div> 
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                </div>
                                <input name="nicename" value="<?php echo $nicename; ?>" class="form-control form-control-lg" placeholder="NICENAME" type="text">
                            </div> 
                        </div>
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                </div>
                                <input name="iso3" value="<?php echo $iso3; ?>" class="form-control form-control-lg" placeholder="ISO3" type="text">
                            </div> 
                        </div>
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                </div>
                                <input name="numcode" value="<?php echo $numcode; ?>" class="form-control form-control-lg" placeholder="NUMCODE" type="text">
                            </div> 
                        </div>
                        <div class="form-group mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                </div>
                                <input name="phonecode" value="<?php echo $phonecode; ?>" class="form-control form-control-lg" placeholder="PHONECODE" type="text">
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php if ($edit_state == false): ?>
                                <button name="save-btn" type="submit" class="btn btn-primary btn-block">Save</button>
                            <?php else: ?>
                                <button name="update-btn" type="submit" class="btn btn-primary btn-block">Update</button>
                            <?php endif ?>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>