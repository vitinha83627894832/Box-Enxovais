<?php
require_once("../assets/conexao.php");

//Bloco de exclusão
if (isset($_GET['codCliente'])) {

    $sql = "delete from cliente where codCliente = " . $_GET['codCliente'];
    mysqli_query($conexao, $sql);
    $mensagem = "Exclusão realizada com sucesso";
}
///////////////////////


//Geração de SQL dinâmica para relatório
$V_WHERE = "";
if (isset($_POST['pesquisar'])) { //Se clicou no botão de pesquisar
    $V_WHERE = " AND nomeCliente like '%" . $_POST['nome'] . "%'";
}

//2. preparar a sql
$sql = "SELECT * FROM cliente
WHERE 1 = 1" . $V_WHERE;


//3.executar a sql
$resultado = mysqli_query($conexao, $sql);

?>
<?php require_once("sidebar.php"); ?>


<!-- Ajax -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



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

    .btn-modal {
        background-color: #008F8C;
    }
</style>

<section class="home-section">

    <div class="card-listar">
        <div class="card-body pesquisar">
            <h1 class="card-title">Pesquisar </h1>
            <form method="POST">
                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome do Usuário</label>
                        <div class="search-box">
                            <input type="text" class="search-text" placeholder="Pesquisar" id="nome" name="nome" />
                            <button class="search-btn" name="pesquisar"><i class="fa-solid fa-magnifying-glass cor-i"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <h2 class="title-marca">Listagem Usuário</h2>
            <a href="cadUsuario.php" class="btn-plus"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="container">
        <div class="tbl_container">


            <table class="tbl">
                <thead> <!-- cabeçalho -->
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Status</th>

                        <th colspan="3">Ação</th> <!-- O "colpsan faz com que o action ocupe duas colunas" -->
                    </tr>

                <tbody>
                    <?php while ($linha = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td data-lable="ID"><?= $linha['codCliente'] ?></th>
                            <td data-lable="Nome"><?= $linha['nome'] ?></th>
                            <td data-lable="Email"><?= $linha['email'] ?></th>
                            <td data-lable="Status"><?= $linha['status'] == 1 ? 'Ativo' : 'Inativo'; ?></th>
                            <td data-lable="Editar">
                                <a href="alterarUsuario.php?codCliente=<?= $linha['codCliente'] ?>" class="botao-listar btn_edit"><i class="fa fa-pencil"></i></a>

                            </td>
                            <td data-lable="Excluir">
                                <a href="listarUsuario.php?codCliente=<?= $linha['codCliente'] ?>" class="botao-listar btn_trash" onclick="return confirm('Confirmar exclusão?')"><i class="fa fa-trash"></i></a>

                            </td>
                            <td data-lable="Informações">
                                <button class="botao-listar btn-modal open-modal" data-product-id="<?= $linha['codCliente'] ?>"><i class="fa-solid fa-eye"></i></button>
                                <div class="fade hide" data-product-id="<?= $linha['codCliente'] ?>"></div>
                                <div class="modal hide" data-product-id="<?= $linha['codCliente'] ?>">

                                    <div class="modal-header">
                                        <h2>Informações de Usuário</h2>
                                        <button id="close-modal">Fechar</button>
                                    </div>
                                    <div class="modal-body">
                                        <span>
                                            <p><?= $linha['codCliente'] ?></p>
                                        </span>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </thead>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $(".open-modal").click(function() {
            const productId = $(this).data("product-id");
            const modal = $(`.modal[data-product-id="${productId}"]`);
            const fade = $(`.fade[data-product-id="${productId}"]`);

            $.ajax({
                url: `getUsuarioInfo.php?codCliente=${productId}`,
                type: "GET",
                dataType: "json",
                success: function(productInfo) {
                    const modalBody = modal.find(".modal-body");

                    if (productInfo.error) {
                        modalBody.html(`<p>${productInfo.error}</p>`);
                    } else {
                        const statusText = productInfo.status == 1 ? 'Ativo' : 'Inativo';
                        modalBody.html(`<p><strong>ID </strong>: ${productInfo.codCliente}</p>
                            <p><strong>Nome </strong>: ${productInfo.nome}</p>
                            <p><strong>Data Nascimento</strong>: ${productInfo.dn}</p>
                            <p><strong>Endereço </strong>: ${productInfo.endereco}</p>
                            <p><strong>Bairro </strong>: ${productInfo.bairro}</p>
                            <p><strong>CEP </strong>: ${productInfo.cep}</p>
                            <p><strong>Estado </strong>: ${productInfo.uf}</p>
                            <p><strong>Cidade </strong>: ${productInfo.cidade}</p>
                            <p><strong>Email </strong>: ${productInfo.email}</p>
                            <p><strong>Celular </strong>: ${productInfo.celular}</p>
                            <p><strong>CPF </strong>: ${productInfo.cpf}</p>
                            <p><strong>Data Cadastro </strong>: ${productInfo.data_cad}</p>
                            <p><strong>Senha </strong>: ${productInfo.senha}</p>
                            <p><strong>Status</strong>: ${statusText}</p>`); // Alterado para exibir statusText
                    }

                    modal.removeClass("hide");
                    fade.removeClass("hide");
                },
                error: function(error) {
                    console.error('Erro ao buscar informações do usuario:', error);
                }
            });
        });

        $(".close-modal, .fade").click(function() {
            $(".modal").addClass("hide");
            $(".fade").addClass("hide");
        });
    });
</script>

<?php require_once("rodapeSidebar.php") ?>