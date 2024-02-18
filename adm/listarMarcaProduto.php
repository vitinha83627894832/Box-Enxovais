<?php
require_once("../assets/conexao.php");

//Bloco de exclusão
if (isset($_GET['codMarcaProd'])) {

    $sql = "delete from marca_produto where codMarcaProd = " . $_GET['codMarcaProd'];
    mysqli_query($conexao, $sql);
    $mensagem = "Exclusão realizada com sucesso";
}else{
    echo "Not Exc";
}
///////////////////////


//Geração de SQL dinâmica para relatório
$V_WHERE = "";
if (isset($_POST['pesquisar'])) { //Se clicou no botão de pesquisar
    $V_WHERE = " and nomeMarcaProd like '%" . $_POST['nomeMarca'] . "%'";
}

//2. preparar a sql
$sql = "select * from marca_produto
where 1 = 1" . $V_WHERE;

//3.executar a sql
$resultado = mysqli_query($conexao, $sql);

?>


<?php require_once("sidebar.php"); ?>

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

    <!-- Início do container -->
    <div class="card-listar">
        <div class="card-body pesquisar">
            <form method="POST">
                <div class="input-group">
                    <div class="input-box">
                        <label for="nomeMarca">Pesquisar</label>
                        <div class="search-box">
                            <input type="text" style="width: 50%;" class="search-text" placeholder="Nome da Marca" id="nomeMarca" name="nomeMarca" />
                            <button class="search-btn" name="pesquisar"><i class="fa-solid fa-magnifying-glass cor-i"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <h2 class="title-marca">Listagem Marca</h2>
            <a href="cadMarcaProduto.php" class="btn-plus"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="container mt-3">

        <div class="tbl_container">


            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Marca</th>
                        <th colspan="2">Ação</th> <!-- O "colpsan faz com que o action ocupe duas colunas" -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($linha = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td data-lable="ID"><?= $linha['codMarcaProd'] ?></td>
                            <td data-lable="Nome da Marca"><?= $linha['nomeMarcaProd'] ?></td>
                            <td data-lable="Editar">
                                <a href="alterarMarcaProduto.php?codMarcaProd=<?= $linha['codMarcaProd'] ?>" class="botao-listar btn_edit"><i class="fa fa-pencil"></i></a>

                            </td>
                            <td data-lable="Excluir">
                                <a href="listarMarcaProduto.php?codMarcaProd=<?= $linha['codMarcaProd'] ?>" class="botao-listar btn_trash" onclick="return confirm('Confirmar exclusão?')"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Fim do container -->

</section>

<?php require_once("rodapeSidebar.php") ?>