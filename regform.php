<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <a href="index.php">Index</a>
        <a href="logform.php">Zaloguj</a>
        <a href="regform.php">Zarejestruj</a>
        <br><br><h3>Dziękujemy za wybranie naszej firmy. Prosimy o rejestrację.</h3>
<br>
<form method="post" action="register.php">
    <label for="login">Login:</label><br>
    <input minlength="3" maxlength="20" type="text" name="login" id="login" required><br>
	
	<label for="name">Name:</label><br>
    <input minlength="3" maxlength="20" type="text" name="name" id="name" required><br>
	
	<label for="surname">Surname:</label><br>
    <input minlength="3" maxlength="35" type="text" name="surname" id="surname" required><br>
	
    <label for="password">Hasło:</label><br>
    <input minlength="8" type="password" name="password" id="password" required><br>

    <label for="password_v">Hasło (ponownie):</label><br>
    <input minlength="8" type="password" name="password_v" id="password_v" required><br>

    <label for="email">Email:</label><br>
    <input type="email" name="email" maxlength="45" id="email" required><br>

    <label for="email_v">Email (ponownie):</label><br>
    <input type="email" name="email_v" maxlength="45" id="email_v" required><br>

    <input type="submit" value="Zarejestruj">
</form>
    </body>
</html>