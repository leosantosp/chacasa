<?php 

    require_once '../src/database/connect.php';

    session_start();

    if(isset($_POST['login'], $_POST['password'])):
        $erros = array();


        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);

        if(empty($login) || empty($password)):
            $erros[] = "<li>O campo login/senha precisa ser preenchido</li>";
        else:
            $sqlUser = "SELECT login FROM admusers WHERE login = '$login'";
            $resultado = mysqli_query($connect, $sqlUser);


            if(mysqli_num_rows($resultado) > 0):
                $password = md5($password);
                $sql = "SELECT * FROM admusers WHERE login = '$login' AND password = '$password'";
                $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);

                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];

                    header('Location: pages/index.php');
                    
                else:
                    $erros[] = '<div class="alert-warning-login alert alert-warning" role="alert">
                                    Usuário/Senha não conferem!
                                </div>';
                endif;
        else:
            $erros[] = '<div class="alert-warning-login alert alert-danger" role="alert">
                            Usuário não encontrado!<br> Verifique os dados inseridos
                        </div>';
        endif;
    endif;

endif;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Área Restrita</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body id="login-page">
    <main class="row no-gutters">
        
            <h1>Área Restrita</h1>

                <form class="login-form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label class="label-login" for="login">Login</label>
                        <input id="login" name="login" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-login" type="submit" name="btn-entrar">ENTRAR</button>
                    </div>

                </form>

                <?php 
                                /**
                                 * Se o campo erro não estiver vazio
                                 * enquanto tiver erros, atribua a variável erro
                                 * e exiba o erro
                                 */
                                if(!empty($erros)):
                                    foreach($erros as $erro):
                                        echo $erro;
                                    endforeach;
                                endif;
                            ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>