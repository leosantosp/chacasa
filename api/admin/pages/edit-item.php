<?php 
    
    require_once '../includes/header.php';
    

    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($connect, $_GET['id']);
        $sql = "SELECT id, description FROM chitems WHERE id = $id";
        $exe = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($exe);
    }
?>
        <h1>Atualizar de Itens</h1>

        <form action="../php/update-item.php" method="POST">
            <div class="form-group">
                <label for="description">Descrição do Item</label>
                <input type="text" class="form-control" name="description" id="description" value="<?php echo $data['description'] ?>" required>
                <input type="hidden" name="id" value="<?php echo $id ?>">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>



<?php 
    require_once '../includes/footer.php';
?>