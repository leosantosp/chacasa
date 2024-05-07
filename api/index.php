<?php 

    require_once 'src/config/index.php';
    require_once 'src/database/connect.php';

    session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $eventName." | ".$eventCouple ?>">
    <meta name="robots" content="noindex">
    <meta name="author" content="Leonardo Santos">
    <title><?php echo $eventName." | ".$eventCouple ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body id="index">
            <?php 
                    if(isset($_SESSION['message'])){
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                ?>
    <header class="header row">
        <div class="container">
            <div class="hmc col-12">
                <h1 class="hmc-title">
                    <?php echo $eventName ?>
                </h1>
                <hr class="line">
                <h2 class="eventCouple">
                    <?php echo $eventCouple ?>
                </h2>

                
            </div>
        </div>
    </header>
    <main class="main-content row">
        <div class="container">
            <article class="mc-title col-12">
                <p>"Mais um passo importante em nossas vidas que gostaríamos de estar com você!"</p>
            </article>
            <article class="mc-description col-12">
                <p>Para escolher um dos itens de presente abaixo, clique no botão <strong>"Escolher este"</strong></p>
            </article>
            <article class="mc-table col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 

                            $sqlItems = "SELECT * FROM chitems";
                            $stmtItems = mysqli_prepare($connect, $sqlItems);
                            mysqli_stmt_execute($stmtItems);
                            $resultItems = mysqli_stmt_get_result($stmtItems);

                            if(mysqli_num_rows($resultItems) > 0):

                                while($dataItem = mysqli_fetch_array($resultItems)):
                        ?>
                            <tr>
                                <td>
                                    <?php echo $dataItem['description']; ?>
                                </td>
                                <td>
                                    
                                    <?php
                                        if($dataItem['status'] == 'A'):
                                    ?>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dataItem['id'] ?>">
                                        Escolher este
                                    </button>
                                    <?php
                                        else:
                                    ?>
                                        <button type="button" class="btn btn-danger">
                                            Já escolhido
                                        </button>
                                    <?php 
                                        endif;
                                    ?>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal<?php echo $dataItem['id'] ?>" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modal">REVISE O ITEM SELECINADO</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #FFF;"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Você acabou de selecionar o item <strong><?php echo $dataItem['description'] ?></strong>. Para prosseguir, clique em <strong>Confirmar</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFinish<?php echo $dataItem['id'] ?>">Confirmar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                        </div>

                                    </div>
                                </div>              
                            </div>


                            <div class="modal fade" id="modalFinish<?php echo $dataItem['id'] ?>" tabindex="-1" aria-labelledby="modalFinish" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalFinish">FINALIZAR</h1>
                                        </div>
                                        <div class="modal-body">
                                            <p>Você escolheu o item  <strong><?php echo $dataItem['description'] ?></strong></p>

                                            <form action="src/controllers/confirm.php" method="POST">
                                                <input type="hidden" name="item_id" value="<?php echo $dataItem['id'] ?>">
                                                <div class="form-group">
                                                    <label for="name">Digite seu nome para confirmar a escolha do item</label>
                                                    <input type="text" class="form-control" name="name" id="name" required>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                            <button class="btn btn-success" type="submit">Enviar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php 
                                endwhile;
                            else: ?>

                            <tr>
                                <td colspan="3" class="text-center">Não existem itens cadastrados para seleção</td>
                            </tr>
                        <?php 
                            endif;
                        ?>

                    </tbody>
                </table>
            </article>
        </div>
    </main>
    <footer class="footer row no-gutters">
        <p>Powered by Leonardo Santos</p>
    </footer>


    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>