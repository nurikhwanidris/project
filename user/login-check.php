<!-- Start Sessions -->
<?php session_start(); ?>

<!-- DB -->
<?php include('../src/model/dbconn.php') ?>

<?php
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query the data
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION["id"] = $row['emp_id'];
            $_SESSION['last_login_timestamp'] = time();
            header('Location:/project/templates/model/dashboard/index.php?success');
        } else {
            header('Location:/project/user/login?msg=Username or password is not right.&alert=danger');
        }
    }
} else {
    header('Location:/project/user/login?msg=Username or password is not right.&alert=danger');
}
?>