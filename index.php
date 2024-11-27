<?php

// require './DB/Database.php';
require './Entity/Cliente.php';

$nome = "Maycon Pereira";
$cpf = "123456";
$email = "maycon@gmail.com";

$cliente = new Cliente($nome,$cpf,$email);

$cliente->cadastrar();

$result = $cliente->buscar();

// foreach ($result as $pessoa){
//     echo "<br> ".$pessoa['id'] . ' ' .$pessoa['nome'];
// }

// print_r($result);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>USUARIOS CADASTRADOS</h1>
    <table border='1'>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
            </tr>
        </thead>
    
        <tbody>
            <?php
                if(!empty($result))
                {
                    foreach($result as $pessoa):
            ?>
            <tr>
                <td><?php echo $pessoa['nome']?></td>
                <td><?php echo $pessoa['cpf']?></td>
                <td><?php echo $pessoa['email']?></td>
            </tr>
            <?php
                endforeach;
                }
                else
                {
                    echo "Nenhum registro encontrado";
                }
            ?>
        </tbody>
    </table>
</body>
</html>



    






