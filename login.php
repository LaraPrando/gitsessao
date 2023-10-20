<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    //conecte ao banco de dados usando PDO  
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=autenticacao" , "root" , "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die ("erro na conexão com o banco de dados:" . $e->getMessage());
    }
    //verifique se o usuario existe e a senha esta correta
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user["senha"])) {
        $_SESSION["usuario"] = $usuario;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Login falhou. Verifique suas credenciais.')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>login</title>
</head>
<body>
    <h2> Login <h>
    <form method="post">
        <input type="text" name="usuario" placeholder="Nome de Usuário" required><br>
        <input type="password" name="senha" placeholder="senha" required><br>
        <input type="submit" value="entrar">
</form>
</body>
</html>