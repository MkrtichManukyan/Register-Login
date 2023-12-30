<?php 
    include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="email" name="email" placeholder="Email" require><br>
        <input type="password" name="password" placeholder="Password" require><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        try{
            $sql = "SELECT ID, Mail, Password FROM users WHERE Mail = ?";
            $stmt = mysqli_prepare($con, $sql);

            if($stmt){
                mysqli_stmt_bind_param($stmt, "s", $email);

                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt, $userIdFromDatabase, $emailFromDatabase, $passwordHashFromDatabase);

                mysqli_stmt_fetch($stmt);
                
                mysqli_stmt_close($stmt);
            }
        }
        catch(mysqli_sql_exception $ex){
            echo $ex;
        }
        
        if(password_verify($password, $passwordHashFromDatabase)){
            session_start();

            $_SESSION["UserID"] = $userIdFromDatabase;
            $_SESSION["Login"] = true;

            header("Location: index.php");
        }
    }

    mysqli_close($con);
?>