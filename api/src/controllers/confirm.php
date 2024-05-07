<?php 

    session_start();

    require_once '../database/connect.php';


    if(isset($_POST['name'])){
        $name = mysqli_escape_string($connect, $_POST['name']);
        $status = "I";
        $item_id = mysqli_escape_string($connect, $_POST['item_id']);

        $sqlUser = "INSERT INTO chusers (name, item_id) VALUES (?, ?)";
        $paramUser = array($name, $item_id);
        $stmtUser = mysqli_prepare($connect, $sqlUser);
        $resultUser = mysqli_stmt_execute($stmtUser, $paramUser);

        if($resultUser === true){
            $sqlItem = "UPDATE chitems SET status = ? WHERE id = ?";
            $param = array($status, $item_id);
            $stmtItem = mysqli_prepare($connect, $sqlItem);
            $resultItem = mysqli_stmt_execute($stmtItem, $param);

            if($resultItem === true){
                $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Item reservado com sucesso!
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
                header('Location: ../../index.php');

            } else {
                $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Não foi possível reservar o item selecionado
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
                header('Location: ../../index.php');
            }
        } else {
            $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Não foi possível reservar o item selecionado
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
                header('Location: ../../index.php');
        }

        



        
    } else {
        $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Informações não foram fornecidas
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
        header('Location: ../../index.php');
    }