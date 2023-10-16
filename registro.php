<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT);
    $email = $_POST["email"];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=autenticacao", "
        root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("erro na conexão com o banco de dados: " . $e->getMessage(
        ));
    }
    // insira os dados na tabela 'users'
    $stmt = $pdo->prepare("INSET INTO usuarios (usuario, senha, email) VALUES (?, ?, ?)");
    $stmt->execute([$usuario, $senha, $email]);
    $_SESSION["usuario"] = $usuario;
    header("location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>REGISTRO</title>
</head>
<body>
    <h1>pagina de registro<h1>
        <form method="post">
            <input type="text" name="usuario" placeholder="Nome de usuario" required><br>
            <input type="password" name="senha" placeholder="senha" required><br>
            <input type="email" name="email" placeholder="email" required><br>
            <input type="submit" value="cadastrar">
</form>
</body>
</html>