<?php
require_once("../assets/conexao.php");

//Esse "isset" serve para verificar se foi clicado no botão, caso não tenha sido clicado, não aparecerá o "warning" que aparece
$codCliente = $_GET['codCliente'];

if (isset($_POST['salvar'])) {

    //2º passo - Receber os dados para inserir no BD
    $nome  = $_POST['nome'];
    $dn = $_POST['dn'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $status = $_POST['status'];


    //3º passo - Preparar a SQL
    $sql = "UPDATE cliente
                SET nome     = '{$nome}',
                dn           = '{$dn}',
                endereco     = '{$endereco}',
                bairro       = '{$bairro}',
                cep          = '{$cep}',
                uf           = '{$uf}',
                cidade       = '{$cidade}',
                email        = '{$email}',
                celular      = '{$celular}',
                cpf          = '{$cpf}',
                senha        = '{$senha}',
                status       = '{$status}'
            where codCliente = {$codCliente} ";


    //4º passo - Executar a sql no banco de dados
    $resultado = mysqli_query($conexao, $sql);

    //5º passo
    $mensagem = "Registo atualizado com sucesso";
}

$sql = "SELECT * from cliente where codCliente = {$codCliente}";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_array($resultado);
?>

<?php require_once("sidebar.php") ?>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        height: 100vh;
        width: 90vw;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        margin-left: 9rem;
    }

    .alterar {
        display: flex;
        justify-content: flex-start;
    }

    .botao {
        color: white;
        font-family: 'Montserrat';
        font-size: 16px;
        font-weight: bolder;
        width: 200px;
        padding: 1rem;
        border-radius: 10px;
        letter-spacing: 2px;
        transition: 0.5s ease;
        border: none;
        text-align: center;
        text-transform: uppercase;
        margin: 10px auto;
    }

    .botao i {
        color: #fff;
    }

    .botao-alterar {
        background: #cb9897;
    }

    .botao-voltar {
        background: #4c4d4f;
        margin-left: 6px;
        text-decoration: none;
    }

    .botao:hover {
        cursor: pointer;
        background-color: #BFBFBF;
    }
</style>



<section class="home-section">

    <div class="cadastro">

        <?php require_once("mensagem.php") ?>


        <h2>Alterar Cliente</h2>
        <form class="form" action="" method="POST">
            <input type="hidden" name="codCliente" value="<?= $_GET['codCliente'] ?>">
            <div class="user-details">
                <div class="input-box">
                    <label class="details" for="nome">Nome</label>
                    <input type="text" class="input" id="nome" name="nome" value="<?= $linha['nome'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="dn">Data de Nascimento</label>
                    <input type="date" class="input" id="dn" name="dn" value="<?= $linha['dn'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="endereco">Endereço</label>
                    <input type="text" class="input" id="endereco" name="endereco" value="<?= $linha['endereco'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="bairro">Bairro</label>
                    <input type="text" class="input" id="bairro" name="bairro" value="<?= $linha['bairro'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="cep">CEP</label>
                    <input type="text" class="input" id="CEP" name="cep" value="<?= $linha['cep'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="uf">Estado</label>
                    <input type="text" class="input" id="uf" name="uf" value="<?= $linha['uf'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="cidade">Cidade</label>
                    <input type="text" class="input" id="cidade" name="cidade" value="<?= $linha['cidade'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="email">Email</label>
                    <input type="text" class="input" id="email" name="email" value="<?= $linha['email'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="celular">Celular</label>
                    <input type="text" class="input" id="celular" name="celular" value="<?= $linha['celular'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="cpf">CPF</label>
                    <input type="text" class="input" id="cpf" name="cpf" value="<?= $linha['cpf'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="senha">Senha</label>
                    <input type="text" class="input" id="senha" name="senha" value="<?= $linha['senha'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="status">Status</label>
                    <select class="input" name="status">
                        <option value="1" <?= ($linha['status'] == 1) ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= ($linha['status'] == 0) ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

            </div>

            <div class="alterar">
                <div class="button">
                    <button class="botao botao-alterar" type="submit" name="salvar"><i class="fa-solid fa-check"></i> Salvar</button>
                </div>
                <div class="button">
                    <a href="listarUsuario.php" class="botao botao-voltar"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
                </div>
            </div>


        </form>
    </div>

    <?php require_once("rodapeSidebar.php") ?>