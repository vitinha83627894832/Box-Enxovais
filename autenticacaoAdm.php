<?php
require('assets/conexao.php');
if (isset($_POST['email'])) {
    
    //Pegar os dados do formulário
    $mensagem = "Email/senha inválido!";
    $email = $_POST['email'];
    $senha = $_POST['senha'];

 //   echo $email;
  //  echo $senha;

    //2º Preparar SQL
    $sql = "SELECT * FROM adm WHERE email = '$email' AND senha = '$senha'";
    
    //3º Executar SQL
    $resultado= mysqli_query($conexao, $sql);
    $registros = mysqli_num_rows($resultado); //Retorna a quantidade de registros
    
    //Verificar se o usuário existe no BD e concede PERMISSÃO ou VOLTA  AO LOGIN
    if ($registros > 0) {
        $linha = mysqli_fetch_array($resultado);
       
       session_start();
       $_SESSION['cod']  = $adm['cod'];
       $_SESSION['email'] = $linha['email'];
       $_SESSION['nome'] = $linha['nome'];

       // DIRNAME é o diretório pai do diretório atual, no caso a pasta BOXENXOVAIS2
       // $_SERVER['REQUEST_URI' obtém o URL após o nome do domínio
       header("Location: " . dirname($_SERVER['REQUEST_URI']) . "/adm/cadProduto.php");

    }else{
        echo "Usuário/senha inválido!";
        header("location: adm/index.php?mensagem=$mensagem");
    }

}
?>