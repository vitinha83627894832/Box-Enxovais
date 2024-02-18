<?php
//1º passo - Conectar no Banco de Dados (IP, usuário, senha, nome do banco)
require_once("../assets/conexao.php");

if (isset($_POST['salvar'])) {

    $cpf = $_POST['cpf'];

    //2º passo - Receber os dados para inserir no BD
    if (!validarCPF($cpf)) {
        $mensagemErro = "CPF inválido.";
        $nome = $_POST['nome'];
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
    } else { //prossegue com o cadastro
        $nome = $_POST['nome'];
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



        $sql = "SELECT * FROM adm WHERE email = '{$email}'";
        $resultado = mysqli_query($conexao, $sql);
        $linhas = mysqli_num_rows($resultado); //número de linhas que retornou da consulta
      
        if ($linhas <= 0) {
        //3º passo - Preparar a SQL
        $sql = "INSERT INTO adm (nome, dn, endereco, bairro, cep, uf, cidade, email, celular, cpf, senha) 
                VALUES 
                ('$nome', '$dn', '$endereco', '$bairro', '$cep', '$uf', '$cidade', '$email', '$celular', '$cpf', '$senha')";

        //4º passo - Executar a sql no banco de dados
        $resultado = mysqli_query($conexao, $sql);

        $mensagem = "Cadastro realizado com sucesso!";
    }else{
        $mensagemErro = "Adm já cadastrado!";
    }
}
}

function validarCPF($cpf)
{
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    // Calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica se os dígitos verificadores estão corretos
    if ($cpf[9] == $digito1 && $cpf[10] == $digito2) {
        return true;
    } else {
        return false;
    }
}
?>


<?php require_once("sidebar.php"); ?>

<style>

    .home-section{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        height: 100%;
        width: 100%;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #cb9897, #91aec9);
    }

    .cadastro form .textarea {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    .textarea div {
        width: calc(100% - 20px);
        margin-bottom: 15px;
    }

    .textarea .input-box .detalhes {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .textarea .input-box .input {
        height: 100px;
        /* Define a altura desejada para o textarea */
        width: 100%;
        outline: none;
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
        resize: none;
        /* Impede o redimensionamento pelo usuário */
    }

    .textarea .input-box .input:focus,
    .textarea .input-box .input:valid {
        border-color: #9b59b6;
    }
</style>

<section class="home-section">

    <div class="cadastro">
        <?php if (isset($mensagemErro)) { ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa-solid fa-square-check"></i>
                <?= $mensagemErro ?>
            </div>
        <?php } ?>

        <div class="title">Cadastro de Administrador</div>
        <form class="form" action="" method="POST">

            <div class="user-details">

                <div class="input-box">
                    <label class="details" for="nome">Nome</label>
                    <input class="input" type="text" id="nome" name="nome" placeholder="Ex: Pedro Ricardo" required />
                </div>

                <div class="input-box">
                    <label class="details" for="dn">Data de Nascimento</label>
                    <input class="input" type="date" id="dn" name="dn" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" />
                </div>

                <div class="input-box">
                    <label class="details" for="cep">CEP</label>
                    <input class="input" type="text" id="cep" name="cep" placeholder="Ex: 87480-000" autocomplete="off" maxlength="9" pattern="\d{5}-\d{3}" onkeyup="mascara_cep()" onblur="pesquisacep(this.value);"/>
                </div>

                <div class="input-box">
                    <label class="details" for="endereco">Endereco</label>
                    <input class="input" type="text" id="endereco" name="endereco" placeholder="Ex: Avenida Paraná 1054" />
                </div>

                <div class="input-box">
                    <label class="details" for="bairro">Bairro</label>
                    <input class="input" type="text" id="bairro" name="bairro" placeholder="Ex: Jabuticabeira" />
                </div>

                <div class="input-box">
                    <label class="details" for="uf">Estado</label>
                    <input class="input" type="text" name="uf" id="uf">
                </div>

                <div class="input-box">
                    <label class="details" for="cidade">Cidade</label>
                    <input class="input" type="text" name="cidade" id="cidade">
                </div>

                <div class="input-box">
                    <label class="details" for="email">Email</label>
                    <input class="input" type="email" id="email" name="email" />
                </div>

                <div class="input-box">
                    <label class="details" for="celular">Celular</label>
                    <input class="input" type="tel" id="celular" name="celular" autocomplete="off" maxlength="14" onkeyup="mascara_celular()" />
                </div>

                <div class="input-box">
                    <label class="details" for="cpf">CPF</label>
                    <input class="input" type="text" id="cpf" name="cpf" autocomplete="off" maxlength="14" required onkeyup="mascara_cpf()" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="<?php echo isset($cpf) ? $cpf : ''; ?>" />
                </div>

                <div class="input-box">
                    <label class="details" for="senha">Senha</label>
                    <input class="input" type="password" id="senha" name="senha" />
                </div>

                <div class="input-box">
                    <label class="details" for="confsenha">Confirmar senha</label>
                    <input class="input" type="password" id="confsenha" name="confsenha" placeholder="Confirmar senha" required />
                </div>
            </div>

            <div class="button">
                <button class="input" type="submit" name="salvar" onclick="validarSenha() && validadata()">Cadastrar</button>
            </div>
    </div>

    </form>

    </div>

    <?php
    mysqli_close($conexao);
    ?>

</section>


<script src="../assets/js/adm.js"></script>
<script src="../assets/js/script.js"></script>

<?php require_once("rodapeSidebar.php"); ?>