<?php 
    $titlepage = 'Cadastro de Itens';
    require_once '../includes/header.php';
    

?>

    <h1>Cadastro de Itens</h1>

    <form action="../php/create-item.php" method="POST">
        <div class="form-group">
            <label for="description">Descrição do Item</label>
            <input type="text" class="form-control" name="description" id="description" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

<?php 
    require_once '../includes/footer.php';
?>