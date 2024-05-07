<?php 

    require_once '../../src/database/connect.php';
    $sessionLifetime = 7200;
    $sessionTimeout = 7200;

    session_set_cookie_params($sessionLifetime);
    ini_set('session.gc_maxlifetime', $sessionTimeout);

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    /* Captura dados da sessão */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM admusers WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titlepage ?></title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    

</head>
<body id="home-admin-panel">
    <input type="checkbox" id="check">
    <header>
        <div class="icon-menu">
            <label for="check">
                <ion-icon name="grid-outline" id="sidebar-btn"></ion-icon>
            </label>
        </div>
    </header>
    <div class="sidebar">
        <div class="center">
            
            <h4><?php echo $dados['username'] ?></h4>
        </div>
        

        <a href="list-items.php"><ion-icon name="calendar-clear-outline"></ion-icon> <span> Listar itens</span></a>
        

        <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span></a> <!-- Sair -->


    </div>

    <div class="content">

<?php 
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>