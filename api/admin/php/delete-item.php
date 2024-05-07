<?php 
    session_start();

    require_once '../../src/database/connect.php';


    if(isset($_GET['id'])){
        $item_id = mysqli_real_escape_string($connect, $_GET['id']);

        $sqlSearch = "SELECT status FROM chitems WHERE id = ?";
        $paramSearch = array($item_id);
        $stmtSearch = mysqli_prepare($connect, $sqlSearch);
        $executeSearch = mysqli_stmt_execute($stmtSearch, $paramSearch);
        $rsltSearch = mysqli_stmt_get_result($stmtSearch);

        $dataSearch = mysqli_fetch_array($rsltSearch);

        if($dataSearch['status'] == 'I'){
            $sqlDelete = "DELETE FROM chusers WHERE item_id = ?";
            $paramDelete = array($item_id);

            $stmtDelete = mysqli_prepare($connect, $sqlDelete);
            $executeDelete = mysqli_stmt_execute($stmtDelete, $paramDelete);
            $rsltDelete = mysqli_stmt_get_result($stmtDelete);

        }


        $sql = "DELETE FROM chitems WHERE id = ?";
        $param = array($item_id);

        $stmt = mysqli_prepare($connect, $sql);
        $execute = mysqli_stmt_execute($stmt, $param);
        $rslt = mysqli_stmt_get_result($stmt);

         
        if($execute == true){
            $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                                        <div class='d-flex'>
                                        <div class='toast-body'>
                                            Item deletado com sucesso!
                                        </div>
                                        <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                                        </div>
                                    </div>";
            header('Location: ../pages/list-items.php');
        } else {
            $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                                        <div class='d-flex'>
                                        <div class='toast-body'>
                                            Não foi possível deletar o item selecionado
                                        </div>
                                        <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                                        </div>
                                    </div>";
            header('Location: ../pages/list-items.php');
        }


        
    } else {
        $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                                            <div class='d-flex'>
                                            <div class='toast-body'>
                                                Não foi possível deletar o item selecionado. Alguém já reservou
                                            </div>
                                            <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                                            </div>
                                        </div>";
                header('Location: ../pages/list-items.php');
    }