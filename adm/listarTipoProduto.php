<?php
require_once("../assets/conexao.php");

//Bloco de exclusão
if (isset($_GET['codTipoProd'])) {/* Chave Primária do tipo do produto */

    $sql = "DELETE FROM tipo_produto WHERE codTipoProd = " . $_GET['codTipoProd'];
    mysqli_query($conexao, $sql);
    $mensagem = "Exclusão realizada com sucesso";
}
///////////////////////


$V_WHERE = "";
if (isset($_POST['pesquisar'])) { //Se clicou no botão de pesquisar
    $V_WHERE = " AND nomeTipoProd LIKE '%" . $_POST['nomeTipo'] . "%'";
}

//2. preparar a sql
$sql = "SELECT * FROM tipo_produto
WHERE 1 = 1" . $V_WHERE;


//3.executar a sql
$resultado = mysqli_query($conexao, $sql);
?>

<?php require_once("sidebar.php") ?>


<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }

    body {
        background: #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .card-listar {
        display: flex;
        justify-content: space-between;
        background: #424949;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .pesquisar {
        width: 30%;
        justify-content: space-between;
    }

    .search-box {
        width: 90%;
        background: #0000001c;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
        height: 40px;
        padding: 10px;
        border-radius: 40px;
        display: flex;
        justify-content: space-between;
        /*joga o 1ºnitem totalmente pra direita e o 2º totalmente pra direita*/
        align-items: center;
    }

    .botao-listar i {
        color: #fff;
    }
</style>




<section class="home-section">

    <div class="card-listar">
        <div class="card-body pesquisar">
            <h1 class="card-title">Pesquisar </h1>
            <form method="POST">
                <div class="input-group">
                    <div class="input-box">
                        <label for="nomeTipo">Categoria do produto</label>
                        <div class="search-box">
                            <input type="text" class="search-text" placeholder="Pesquisar" id="nomeTipo" name="nomeTipo" />
                            <button class="search-btn" name="pesquisar"><i class="fa-solid fa-magnifying-glass cor-i"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <h2 class="title-marca">Listagem Categoria</h2>
            <a href="cadTipoProduto.php" class="btn-plus"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>
    <!-- Início do container -->
    <div class="container mt-3">
        <div class="tbl_container">


            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Categoria</th>
                        <th colspan="2">Ação</th> <!-- O "colpsan faz com que o action ocupe duas colunas" -->
                    </tr>

                <tbody>
                    <?php while ($linha = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td data-lable="ID"><?= $linha['codTipoProd'] ?></td>
                            <td data-lable="Categoria do Produto"><?= $linha['nomeTipoProd'] ?></td>
                            <td data-lable="Editar">
                                <a href="alterarTipoProduto.php?codTipoProd=<?= $linha['codTipoProd'] ?>" class="botao-listar btn_edit"><i class="fa fa-pencil"></i></a>

                            </td>
                            <td data-lable="Excluir">
                                <a href="listarTipoProduto.php?codTipoProd=<?= $linha['codTipoProd'] ?>" class="botao-listar btn_trash" onclick="return confirm('Confirmar exclusão?')"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </thead>
            </table>
        </div>
    </div>
    <!-- Fim do container -->

</section>
<?php require_once("rodapeSidebar.php") ?>