<?php
    //conexao
    require_once 'db_conect.php';

    // sessao
    session_start();

    // verificacao 
    if(!isset($_SESSION['logado'])){
        header('Location: iindex.php');
    }

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $reustado = mysqli_query($connect, $sql);
    mysqli_close($connect);
    $dados = mysqli_fetch_array($reustado);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM</title>
</head>
<body>
    <h3> Oi <?php echo $dados['nome']; ?> ! </h3>


    <a href="logout.php">Sair</a>
</body>
</html>