<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="img\logo.png"/>
        <title>Automated Management System</title>
    </head>
    <body style = "background-color : #B3A492 "><br><br><br><br><br><br><br><br><br><br><br><br>
        <div  class="container">
            <h2>Automated Management System</h2>
            <form action="signin_form.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="example" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="*********" required>
                </div>
                <div class="form-group">
                    <input name="submit" type="submit" value="Login">
                </div>
            </form>
        </div>
    </body>
</html>