<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>You dont Register/Login</h1><br>

    <button onclick="redirectToRegister('register.php')">Register</button>
    <button onclick="redirectToRegister('login.php')">Login</button>

<script>
    function redirectToRegister(path) {
        window.location.href = path;
    }
</script>
</body>
</html>