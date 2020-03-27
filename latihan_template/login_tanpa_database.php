<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <style>
        #container {
            margin: 30px;
        }
    </style>
</head>
<body>
    <div id="container">
        <form action="template.php" method="POST">
            <fieldset style="width: 25%;">
            <label for="usernane">username &nbsp;:</label>
            <input type="text" id="username" name="username" value=""><br><br>
            <label for="password">password :</label>
            <input type="password" id="password" name="password" value=""><br><br>
            <p style="text-align: right;"><input type="submit" name="submit" value="Submit"></p>
            </fieldset>
    </div>
</body>
</html>