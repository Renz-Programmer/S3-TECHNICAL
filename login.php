<?php

session_start();

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

include("db.php");

$message = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['remember'])) {

        setcookie(
            "username",
            $username,
            time() + 86400,
            "/"
        );

        setcookie(
            "password",
            $password,
            time() + 86400,
            "/"
        );
    }

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE username='$username'
        AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {

        $_SESSION['username'] = $username;

        header("Location: home.php");
        exit();
    } else {

        $message = "Invalid Username or Password";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .remember {
            margin: 10px 0;
        }

        input[type="checkbox"] {
            width: auto;
            margin-right: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: darkblue;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            text-decoration: none;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>

</head>

<body>

    <div class="container">

        <h2>Login</h2>

        <form method="POST">

            <input
                type="text"
                name="username"
                placeholder="Username"
                value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>"
                required>

            <input
                type="password"
                name="password"
                placeholder="Password"
                value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>"
                required>

            <div class="remember">
                <label>
                    <input type="checkbox" name="remember">
                    Remember Me
                </label>
            </div>
            <button type="submit" name="login">
                Login
            </button>

        </form>

        <p class="error">
            <?php echo $message; ?>
        </p>


        <div class="register-link">
            <a href="register.php" class="register-btn">
                Register
            </a>
        </div>

    </div>

</body>

</html>


</div>

</body>

</html>