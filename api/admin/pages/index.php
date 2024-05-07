<?php 
    $titlepage = "Painel Administrativo";
    require_once '../includes/header.php';

?>
    <h4><?php echo $titlepage ?></h4>
    <h2>Seja bem-vindo(a), <strong><?php echo $dados['username']; ?></strong></h2>
    <h5>Utilize o painel à esquerda para usar as funções do menu</h5>


<?php 
    require_once '../includes/footer.php';
?>