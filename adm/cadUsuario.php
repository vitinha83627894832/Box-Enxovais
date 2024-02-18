<?php
require_once("../assets/conexao.php");


if (isset($_POST['cadastrar'])) {
  $cpf = $_POST["cpf"];

  //2. Receber os dados para inserir no BD
  if (!validarCPF($cpf)) {
    $mensagemErro = "CPF inválido.";
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
  } else { //prossegue com o cadastro pq o CPF está válido
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


      // Verificar se o email já está cadastrado
      if (emailJaCadastrado($email)) {
        $mensagemErro = "Email já está cadastrado.";
    } else {


    //3. Preparar a SQL 
    $sql = "insert into cliente (nome, dn, endereco, bairro, cep, uf, cidade, email, celular, cpf, senha)
          values ('$nome', '$dn', '$endereco','$bairro','$cep', '$uf', '$cidade', '$email','$celular', '$cpf','$senha')";


    //4. Executar a SQL
    mysqli_query($conexao, $sql);

    //5. Mostrar uma mensagem ao usuário
    // $mensagem = "Registro salvo com sucesso.";

    header("Location: ../index.php"); // Substitua "index.php" pela URL da sua página principal
    exit;
  }
}
}
// NÃO DEIXAR CADASTRAR EMAIL IGUAL 
function emailJaCadastrado($email)
{
    global $conexao;

    // Consulta para verificar se o email já existe
    $sql = "SELECT * FROM cliente WHERE email = '$email'";
    $result = mysqli_query($conexao, $sql);

    // Se houver algum resultado, significa que o email já está cadastrado
    return mysqli_num_rows($result) > 0;
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

<script>
  //Validaçào de CEP - API do Correio
  //Busca automática pelo CEP através do ViaCEP
  function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
  }

  function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
      //Atualiza os campos com os valores.
      document.getElementById('bairro').value = (conteudo.bairro);
      document.getElementById('cidade').value = (conteudo.localidade);
      document.getElementById('uf').value = (conteudo.uf);
    } //end if.
    else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      alert("CEP não encontrado.");
    }
  }

  function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('bairro').value = "...";
        document.getElementById('cidade').value = "...";
        document.getElementById('uf').value = "...";

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  };
</script>




<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../assets/css/style2.css" />

  <link href="../assets/img/Box-Enxovais-icon.png" rel="icon">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

  <title>Cadastro — Box Enxovais</title>

</head>

<body>
  <div class="login-card-container mt-5">

    <!-- Bloco de mensagem -->
    <?php if (isset($mensagemErro)) { ?>
      <div class="alert alert-danger" role="alert">
        <i class="fa-solid fa-square-check"></i>
        <?= $mensagemErro ?>
      </div>
    <?php } ?>

    <div class="login-card">
      <div class="login-card-logo">
        <img src="../assets/img/Box-Enxovais-icon.png" alt="logo" style="width: 150px" />
      </div>
      <div class="login-card-header">
        <h1>Cadastre-se</h1>
        <div>Faça o cadastro para ter uma experiência melhor!</div>
      </div>

      <form method="post">

        <div class="coluna">
          <div class="input-group">
            <div class="input-box nome">
              <label for="nome">Nome</label>
              <input type="text" class="tamanho-input" id="nome" name="nome" placeholder="Ex: Mariana da Silva" 
              required value="<?php echo isset($nome) ? $nome : ''; ?>" />
            </div>
          </div>

          <div class="input-group">
            <div class="input-box">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Digite seu email" required 
              value="<?php echo isset($email) ? $email : ''; ?>" />
            </div>
          </div>

        </div>

        <div class="coluna">
          <div class="input-group">
            <div class="input-box">
              <label for="date">Data de Nascimento</label>
              <input type="date" id="date" name="dn" placeholder="Digite sua data de nascimento" 
              required max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" 
              value="<?php echo isset($dn) ? $dn : ''; ?>" />

            </div>
          </div>

          <div class="input-group">
            <div class="input-box">
              <label for="cpf">CPF</label>
              <input type="text" id="cpf" autocomplete="off" maxlength="14" name="cpf" 
              placeholder="Digite seu CPF" required onkeyup="mascara_cpf()" 
              required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="<?php echo isset($cpf) ? $cpf : ''; ?>" />
            </div>
          </div>

          <script>
            function mascara_cpf() {
              var cpf = document.getElementById('cpf')
              if (cpf.value.length == 3 || cpf.value.length == 7) {
                cpf.value = cpf.value += "."
              } else if (cpf.value.length == 11) {
                cpf.value += "-"
              }
            }
          </script>

          <div class="input-group">
            <div class="input-box">
              <label for="celular">Celular</label>
              <input type="tel" id="celular" autocomplete="off" maxlength="14" name="celular" 
              placeholder="(XX) xxxxx-xxxx" required onkeyup="mascara_celular()" value="<?php echo isset($celular) ? $celular : ''; ?>" />
            </div>
          </div>
        </div>
        <script>
          function mascara_celular() {
            var celular = document.getElementById('celular');
            if (celular.value.length == 2) {
              celular.value = '(' + celular.value + ')';
            }
            if (celular.value.length == 9) {
              celular.value = celular.value + '-';
            }
          }
        </script>

        <div class="coluna">
          <div class="input-group">
            <div class="input-box">
              <label for="cep">CEP</label>
              <input type="text" id="cep" autocomplete="off" maxlength="9" name="cep" placeholder="xxxxx-xxx" 
              required pattern="\d{5}-\d{3}" onkeyup="mascara_cep()" onblur="pesquisacep(this.value);" 
              value="<?php echo isset($cep) ? $cep : ''; ?>"/>
            </div>
          </div>
          <script>
            function mascara_cep() {
              var cep = document.getElementById('cep');
              cep.value = cep.value.replace(/\D/g, ''); // Remove caracteres não numéricos
              cep.value = cep.value.replace(/^(\d{5})(\d{3})$/, '$1-$2'); // Adiciona a máscara xxxx-xxx
            }
          </script>
          <div class="input-group">
            <div class="input-box">
              <label for="endereco">Endereço e N°</label>
              <input type="text" id="endereco" name="endereco" placeholder="XXXXXXXXXX XXX" required 
              value="<?php echo isset($endereco) ? $endereco : ''; ?>" />
            </div>
          </div>

          <div class="input-group">
            <div class="input-box">
              <label for="bairro">Bairro</label>
              <input type="text" id="bairro" name="bairro" placeholder="Digite seu bairro" 
              required value="<?php echo isset($bairro) ? $bairro : ''; ?>" />
            </div>
          </div>
        </div>



        <div class="coluna">
          <div class="input-group">
            <div class="input-box">
              <label for="uf">UF</label>
              <input type="text" name="uf" id="uf" value="<?php echo isset($uf) ? $uf : ''; ?>">
            </div>
          </div>

          <div class="input-group">
            <div class="input-box">
              <label for="cidade">Cidade</label>
              <input type="text" name="cidade" id="cidade" value="<?php echo isset($cidade) ? $cidade : ''; ?>">
            </div>
          </div>
        </div>

        <div class="coluna">
          <div class="input-group">
            <div class="input-box">
              <label for="senha">Senha</label>
              <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required value="<?php echo isset($senha) ? $senha : ''; ?>" />
            </div>
          </div>

          <div class="input-group">
            <div class="input-box">
              <label for="confsenha">Confirmar senha</label>
              <input type="password" id="confsenha" name="confsenha" placeholder="Confirmar senha" required value="<?php echo isset($confsenha) ? $confsenha : ''; ?>" />
            </div>
          </div>
        </div>

        <button name="cadastrar" type="submit" onclick="return validarSenha()" onclick="return validadata()">Cadastrar</button>
      </form>

      <div class="login-card-social">
        <div>Outras opções de cadastro</div>
        <div class="login-card-social-btns">
          <a href="#">
            <img src="../assets/img/facebook-app.png" />
          </a>
          <a href="#">
            <img src="../assets/img/google.png" />
          </a>
        </div>
      </div>
    </div>
  </div>
  <script>
    let senha = document.getElementById('senha');
    let confsenha = document.getElementById('confsenha');

    function validarSenha() {
      if (senha.value != confsenha.value) {
        confsenha.setCustomValidity("Senhas diferentes!");
        confsehha.reportValidity();
        return false;
      } else {
        confsenha.setCustomValidity("");
        return true;
      }
    }
    confsenha.addEventListener('input', validarSenha);
  </script>


  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="../assets/script.js"></script>


</body>

</html>