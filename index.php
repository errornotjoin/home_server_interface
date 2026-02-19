<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/Only_background.css">
    <title>Login -- Home Server Interface</title>
</head>
<body>
<header>
    <h2>Home Server Interface</h2>
    <h2>Drives information</h2>
    <div class="icons">
        
    </div>
    </header>

    <form action="database/decrpty.php" method="post" class="Login_form">
        <h2 for="username">Username:</h2>
        <input type="text" id="username" name="username" required><br><br>
        <h2 for="password">Password:</h2>
        <input type="password" id="password" name="password" required><br><br>
        <div class="Other_inputs">
            
            <div>
                <input type="reset" value="Reset">
                <input type="submit" value="Login">
            </div>
            <a href="create_account.php">Don't have an account? Create an account</a><br><br>
        </div>
    </form>
    
</body>
</html>