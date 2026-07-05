<?php

include("db.php");

$message = "";

if (isset($_POST['register'])) {

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    if ($password != $confirm_password) {

        $message = "Password and Confirm Password are not the same.";
    } else {

        $sql = "INSERT INTO users(
                firstname,
                middlename,
                lastname,
                username,
                password,
                birthday,
                email,
                contact
                )
                VALUES(
                '$firstname',
                '$middlename',
                '$lastname',
                '$username',
                '$password',
                '$birthday',
                '$email',
                '$contact'
                )";

        if (mysqli_query($conn, $sql)) {

            echo "<script>
                    alert('Registration Successful!');
                    window.location='login.php';
                  </script>";
            exit();
        } else {
            $message = "Error Saving Record";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Registration</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 400px;
            margin: auto;
            margin-top: 30px;
            background: white;
            padding: 20px;
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
    </style>

</head>

<body>

    <div class="container">

        <h3>My Personal Information</h3>

        <form method="POST">

            <label>First Name</label>
            <input type="text" name="firstname" required>

            <label>Middle Name</label>
            <input type="text" name="middlename" required>

            <label>Last Name</label>
            <input type="text" name="lastname" required>

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <label>Birthday</label>
            <input type="text" name="birthday" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Contact Number</label>
            <input type="text" name="contact" required>

            <button type="submit" name="register">
                Register
            </button>

        </form>

        <p style="color:red;">
            <?php echo $message; ?>
        </p>

    </div>

</body>

</html>