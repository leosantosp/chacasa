<?php

    require_once 'credentials/index.php';

    $connect = mysqli_connect(
        $serverHost,
        $userName,
        $userPwd,
        $dbName
    );
    mysqli_set_charset($connect, "UTF8");

    if(mysqli_connect_error()) : echo "Erro na Conexão: ".mysqli_connect_error();
    endif;