<?php

require './Entity/Cliente.php';  

$dados = new Cliente('','','');
$cliente_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $cliente = new Cliente($nome,$cpf,$email);
    $result = $cliente->cadastrar();
    if($result){
        echo '<script> alert("Cliente cadastrado com sucesso!!!") </script>';
    }else{
        echo '<script> alert("Erro ao cadastrar!") </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/cadastro.css">
    <title>Document</title>
</head>
<body>
    <h2>TELA DE CADASTRO DE USUÁRIO</h2>
    <div class="container-form">
        <form method = "POST">
            <label>Nome:</label><br>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome"><br>
            <label>CPF:</label><br>
            <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF"><br>
            <label>Email:</label><br>
            <input type="text" name="email" id="email"  placeholder="Digite o email"><br>
            <br>
            <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
        </form>
    </div>

    <table>
    <table border='1'>
        <h2>Clientes cadastrados</h2>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>CPF</td>
            <td>Editar</td>
            <td>Excluir</td>
        </tr>
        <?php
         foreach($cliente_banco as $cliente){
            echo '
            <tr>
                <td> '.$cliente['id'].' </td>
                <td> '.$cliente['nome'].' </td>
                <td> '.$cliente['cpf'].' </td>
                <td> <a href="editar_cliente.php?id_cliente='.$cliente['id'].'"> Editar </td>
                <td> <a href="excluir_cliente.php?id_cliente='.$cliente['id'].'"> Excluir </td>
            </tr>
            ';
         }
        ?>
    </table>
</body>
</html>
