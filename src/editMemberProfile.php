<?php
session_start();
#fetch data from database
include 'config.php';



    $fname = "";
    $lname = "";
    $phone = "";
    $email = "";

    $query = "select * from users where email = '$_SESSION[userid]'";
    $query_run = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $fname = $row['first_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $lname = $row['last_name'];
    }

?>
<!DOCTYPE html>
<html>

<head>
    <title>Member Dashboard</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
            </div>
            <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
            <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></font>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="view_profile.php">View Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="editMemberProfile.php">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="change_password.php">Change Password</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <span>
        <marquee>This is library mangement system.</marquee>
    </span><br><br>
    <center>
        <h4>Edit Profile</h4><br>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="Firstname">First Name:</label>
                    <input type="text" class="form-control" name="Firstname" value="<?php echo $fname; ?>">
                </div>
                <div class="form-group">
                    <label for="Lastname">Last Name:</label>
                    <input type="text" class="form-control" name="Lastname" value="<?php echo $lname; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="mobile">Phone:</label>
                    <input type="text" name="mobile" class="form-control" value="<?php echo $phone; ?>">
                </div>
                <!-- <div class="form-group">
                    <label for="mobile">Address:</label>
                    <textarea rows="3" cols="40" name="address" class="form-control"><?php echo $address; ?></textarea>
                </div> -->
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>