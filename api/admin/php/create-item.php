<?php 
    session_start();
    require_once '../../src/database/connect.php';
    

    if(isset($_POST['description'])){

        $description = mysqli_real_escape_string($connect, $_POST['description']);

        $sqlItem = "INSERT INTO chitems (description) VALUES (?)";
        $stmt = mysqli_prepare($connect, $sqlItem);
        $execute = mysqli_stmt_execute($stmt, array($description));

        $result = mysqli_stmt_get_result($stmt);
        

        if($execute !== false){
            $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Item criado com sucesso!
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
                header('Location: ../pages/list-items.php');
        } else {
            $_SESSION['message'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Não foi possível criar o item. Tente novamente mais tarde
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
            Não foi possível criar o item. Tente novamente mais tarde
          </div>
          <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
        </div>
      </div>";
        header('Location: ../pages/list-items.php');
    }

?>