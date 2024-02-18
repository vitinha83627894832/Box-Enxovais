<?php
session_start();
require('assets/conexao.php');
if (isset($_POST['email'])) {
    
    //Pegar os dados do formulário
    $mensagem = "Email/senha inválido!";
    $email = $_POST['email'];
    $senha = $_POST['senha'];

 //   echo $email;
  //  echo $senha;

    //2º Preparar SQL
    $sql = "SELECT * FROM cliente WHERE (email = '$email' AND senha = '$senha')";
            
    //3º Executar SQL
    $resultado= mysqli_query($conexao, $sql);
    $registros = mysqli_num_rows($resultado); //Retorna a quantidade de registros
    
    //Verificar se o usuário existe no BD e concede PERMISSÃO ou VOLTA  AO LOGIN
    if ($registros > 0) {
        $linha = mysqli_fetch_array($resultado);
       
       session_start();
       $_SESSION['codCliente']  = $linha['codCliente'];
       $_SESSION['email'] = $linha['email'];
       $_SESSION['nome'] = $linha['nome'];


        header("location:index.php");
    }else{
        echo "Usuário/senha inválido!";
        header("location: index.php?mensagem=$mensagem");
    }

}
?> 