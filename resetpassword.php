<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

$message = "";

if (isset($_POST['reset'])) {

    $username = $_SESSION['username'];

    $current = $_POST['current'];
    $new = $_POST['new'];
    $renew = $_POST['renew'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    $row = mysqli_fetch_assoc($query);

    if ($current != $row['password']) {

        $message = "Current password is not the same with the old password.";
    } elseif ($new != $renew) {

        $message = "New Password and Re-enter Password should be the same.";
    } else {

        mysqli_query(
            $conn,
            "UPDATE users
             SET password='$new'
             WHERE username='$username'"
        );

        $message = "Password Updated Successfully!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
        }
    </style>

</head>

<body>

    <div class="container">

        <h2>Reset Password</h2>

        <form method="POST">

            <input type="password" name="current" placeholder="Current Password" required>

            <input type="password" name="new" placeholder="New Password" required>

            <input type="password" name="renew" placeholder="Re-enter New Password" required>

            <button type="submit" name="reset">
                Reset Password
            </button>

        </form>

        <p style="color:red;">
            <?php echo $message; ?>
        </p>

        <a href="home.php">Back to Home</a>

    </div>

</body>

</html>