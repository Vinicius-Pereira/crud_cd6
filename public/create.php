<?php

require_once dirname(dirname(__FILE__)) . "\controller\UserController.php";
if (isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password_2"])) {
    $userController = new UserController();
    $result = $userController->createUser($_POST["name"], $_POST["phone"], $_POST["email"], $_POST["password"], $_POST["password_2"]);
}
?>

<html>

<head>
    <title>Formulário Javascript</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/form.js"></script>
    <link rel="stylesheet" href="./css/form.css">
</head>

<body>
    <div id="container-form">
        <h1 id="title">CADASTRO</h1>
        <div id="error_message">
            <?php
            if ($result) {
                echo ("Usuário cadastrado com sucesso!");
            } else {
                echo ("Falha no cadastro.");
            }
            ?>
        </div>
        <form action="./index.html" id="form" method="post">
            <input id="name" name="name" type="text" placeholder="nome completo" value="">
            <input id="phone" name="phone" type="text" placeholder="telefone" value="">
            <input id="email" name="email" type="email" placeholder="e-mail" value="">
            <input id="password" name="password" type="password" placeholder="senha" value="">
            <input id="password_2" name="password_2" type="password" placeholder="confirme sua senha" value="">
            <button id="submit" type="submit">Enviar</button>
        </form>
    </div>
</body>

</html>