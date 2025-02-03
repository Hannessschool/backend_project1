<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save The Date</title>
</head>
<body>
<div id="container">    <!-- Max width 800px -->
    <section>
        <article>
            <h2>3an</h2>
            <form action="uppg4.php" method="GET">
            Username: <input type= "text" name="username" required>
            Password: <input type= "psw" name="psw" required>
            <input type="submit" value="Register">
            </form>
                Welcome <?php print($_GET["name"]); ?><br>
                Your email address is: <?php print($_GET["email"]); ?>
                <?php include "proj1task3.php" ?>
        </article>
    </section>
</div>
</body>
</html>