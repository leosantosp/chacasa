<?php 
    
    session_start();
    require_once '../../src/database/connect.php';

    if(isset($_POST['id'], $_POST['description'])){
        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $description = mysqli_real_escape_string($connect, $_POST['description']);

        $sql = "UPDATE chitems SET description = ? WHERE id = ?";
        $params = array($description, $id);
        $stmt = mysqli_prepare($connect, $sql);
        $execute = mysqli_stmt_execute($stmt, $params);
        $rslt = mysqli_stmt_get_result($stmt);
        
        if($execute !== false) {
            $_SESSION['message'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
            header('Location: ../pages/list-items.php');
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Não foi possível atualizar!</div>";
            header('Location: ../pages/list-items.php');
        }

    }