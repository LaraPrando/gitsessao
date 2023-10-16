<?php
session_start();
session_destray();
header("Location: login.php");
exit;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logour</title>
</head>
<body>
    <h1>logout<h1>
</body>
</html>