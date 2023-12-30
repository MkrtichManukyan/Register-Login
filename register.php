<?php 
    include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="text" name="username" placeholder="User Name" require><br>
        <input type="password" name="password" placeholder="Password" require><br>
        <input type="email" name="email" placeholder="Email" require><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        try{
            $sql = "INSERT INTO users (UserName, Password, Mail) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $email);

                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);
                
                header("Location: login.php");
            } 
        }
        catch(mysqli_sql_exception $ex){
            echo $ex;
        }
    }
    mysqli_close($con);
?>