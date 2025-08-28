<?php
include_once("./constante.php");
include_once("./includes/header.php");
include_once("./service/conexao.php");

$pagina = 2;
if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
}
if (!$pagina) {
    $pagina = 2;
}

$limite = 3;
$inicio = ($pagina * $limite) - $limite;

$sql = "SELECT COUNT(idPost) count FROM posts WHERE idUsuario= :idUser";
$select = $conexao->prepare($sql);
$select->bindParam(':idUser', $idUser);

if ($select->execute()) {
    $registros = $select->fetch()["count"];
}

$paginas = ceil($registros / $limite);


$sqlPost = "SELECT * FROM posts LIMIT $inicio, $limite";
$select = $conexao->prepare($sqlPost);
if ($select->execute()){
    $postagens = $select->fetchAll(PDO::FETCH_ASSOC);
}

?>

<main >
<div class="container">
<section class=" row" id="posts">
    <h2 class="section-title mb-4 text-danger pt-4">Nossos Posts</h2>
    <div class="row " id="conteudo">
        <?php foreach ($postagens as $post) { ?>
            <div class="col-mb-12 mb-5">
                <div class="card shadow-sm" >
                    <img class="card-img-top img-fluid" src="./img-posts/<?= $post['Imagem'] ?>"  style="height: 500px; width: 100%;" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post['Titulo'])?></h5>
                        <p class="card-text"><?= $post['Resumo']?></p>
                        <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-outline-primary" href="detalhes.php?id=<?= $doces['id']?>">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-2 pb-5">
                <li class="page-item"><a class="page-link text-danger" href="?pagina=<?= $pagina - 1 ?>">Anterior</a></li>

                <?php
                for ($i = 1; $i <= $paginas; $i++) {
                    $estilo = "";
                    if ($pagina == $i) {
                        $estilo = "active";
                    }

                ?>
                    <li class="page-item"><a class="page-link  <?= $estilo ?>" href="?pagina=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>


                <li class="page-item"><a class="page-link text-danger" href="?pagina=<?= $pagina + 1 ?>">Proximo</a></li>
            </ul>
        </nav>

</section>
</main>

<?php
include_once("./includes/footer.php");
?>


