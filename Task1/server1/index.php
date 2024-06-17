<?php
session_start();
include_once 'db.php';
$username = "";
$password = "";
if(isset($_SESSION['username']))
{
    session_unset();
    session_destroy();
}
if (isset($_POST['name']) && isset($_POST['user_password'])) {
    $username = $_POST['name'];
    $password = $_POST['user_password'];
    if (login($username, $password)) {
        $_SESSION['id'] = get_id($username);
        $_SESSION['username'] = $username;
        //echo $_SESSION['username'];
        error_reporting(E_ALL);
ini_set("display_errors", 1);
       exit(  header('Location: mytask.php'));  
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f2f2f2;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    .login-container form {
        display: flex;
        flex-direction: column;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .input-group input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 350px;
    }

    button {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>


<body>
    <div class="login-container">
        <form action="index.php" method="POST">
            <h2>Login</h2>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name='user_password' required>
            </div>
            <button type="submit">Login</button>
            <div>
                <br>
                Don't have an account?
                <form action="Register.php" method="post">
                   <a href="Register.php">Register here</a>
                </form>
            </div>
        </form>
    </div>
</body>

</html>