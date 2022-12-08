<?php
    //conexao
    require_once 'db_conect.php';

    // sessao
    session_start();
    
    // botao enviar
    if(isset($_POST['btn'])):
        $erros = array();
        $login = mysqli_escape_string($connect , $_POST['login']);
        $senha = mysqli_escape_string($connect , $_POST['senha']);

        if(empty($login) or empty($senha)){
            $erros[] = "<li> O Campo login/senha precisa ser preenchido </li>";
        }
        else{
            $sql = "SELECT username FROM usuario WHERE username = '$login' ";
            $resultado = mysqli_query($connect,$sql);

            if(mysqli_num_rows($resultado) > 0){
                $senha =md5($senha);
                $sql = "SELECT * FROM usuario WHERE username ='$login' and senha = '$senha' ";
                $resultado = mysqli_query($connect,$sql);
                mysqli_close($connect);
                if(mysqli_num_rows($resultado)== 1){
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('location: home.php');
                }
                else{
                    $erros[] = "<li> Usuário e senha não comferem</li>";
                }
            }

            else{
                $erros[] = "<li> Usuario inexistente </li>";
            }

        }


    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="formulario">
        <form action="" method="post">
            <h1>Login</h1>
            <?php
                if(!empty($erros)):
                    foreach ($erros as $erro): 
                        echo $erro;
                    endforeach;
                    
                endif;
            ?>
            <p>
                Login: <input type="text" name="login">
            </p>
            <p>
                senha: <input type="password" name="senha">
            </p>
            <button type="submit" name="btn">Entrar</button>
        </form>
    </div>
</body>
</html>