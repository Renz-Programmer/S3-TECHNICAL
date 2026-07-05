<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

$username = $_SESSION['username'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE username='$username'"
);

$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 700px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        td {
            border: 1px solid #ccc;
        }

        td {
            padding: 12px;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
            font-weight: bold;
        }

        .reset {
            background: orange;
        }

        .logout {
            background: red;
        }
    </style>

</head>

<body>

    <div class="container">

        <h2>Welcome <?php echo $row['username']; ?></h2>

        <table>

            <tr>
                <td><b>First Name</b></td>
                <td><?php echo $row['firstname']; ?></td>
            </tr>

            <tr>
                <td><b>Middle Name</b></td>
                <td><?php echo $row['middlename']; ?></td>
            </tr>

            <tr>
                <td><b>Last Name</b></td>
                <td><?php echo $row['lastname']; ?></td>
            </tr>

            <tr>
                <td><b>Birthday</b></td>
                <td><?php echo $row['birthday']; ?></td>
            </tr>

            <tr>
                <td><b>Email</b></td>
                <td><?php echo $row['email']; ?></td>
            </tr>

            <tr>
                <td><b>Contact Number</b></td>
                <td><?php echo $row['contact']; ?></td>
            </tr>

        </table>

        <div class="buttons">

            <a href="resetpassword.php" class="btn reset">
                Reset Password
            </a>

            <a href="logout.php" class="btn logout">
                Logout
            </a>

        </div>
    </div>

    </div>

</body>

</html>