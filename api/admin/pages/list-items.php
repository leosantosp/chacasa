<?php
    
    $titlepage = "Cadastro de Itens";
    require_once '../includes/header.php';
    

?>

    
    <a class="btn btn-primary" href="new-item.php">Cadastrar novo item</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Reservado por</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM chitems";
                $exe = mysqli_query($connect, $sql);

                if(mysqli_num_rows($exe) > 0):
                    while($dataItem = mysqli_fetch_array($exe)):
            ?>

            <tr>
                <td><?php echo $dataItem['id'] ?></td>
                <td><?php echo $dataItem['description'] ?></td>
                <td>
                    <?php 
                    
                    if($dataItem['status'] == 'A'){ 
                        echo "<button class='btn btn-success'>Disponível</button>"; 
                    } else { 
                        echo "<button class='btn btn-danger'>Já reservado</button>";
                    } 
                    

                    ?>
                </td>
                <td>
                    <?php 

                        if($dataItem['status'] == 'I'){
                            $itemid = $dataItem['id'];

                            $sqlUser = "SELECT name FROM chusers WHERE item_id = '$itemid'";
                            $queryUser = mysqli_query($connect, $sqlUser);

                            $dataUser = mysqli_fetch_array($queryUser);
                        
                            echo $dataUser['name'];
                        } else {
                            echo "Não reservado";
                        }
                        
                    ?>
                </td>
                <td colspan="2">
                    <a class="btn btn-primary" href="edit-item.php?id=<?php echo $dataItem['id']?>">Editar</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dataItem['id']?>">Excluir</button>
                </td>
            </tr>

            <div class="modal fade" id="modal<?php echo $dataItem['id'] ?>" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modal">OPA!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #FFF;"></button>
                        </div>
                        <div class="modal-body">
                            <p>Você escolheu o item <strong><?php echo $dataItem['description'] ?></strong>. Deseja excluir?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-modal-dismiss="modal" aria-label="Close">Fechar</button>
                            <a class="btn btn-danger" href="../php/delete-item.php?id=<?php echo $dataItem['id'] ?>">Sim, excluir</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                endwhile;
                else:
            ?>
            
            <tr>
                <td>Não existem itens cadastrados</td>
            </tr>

            <?php 
                endif;
            ?>
        </tbody>
    </table>



<?php 

    require_once '../includes/footer.php';

?>