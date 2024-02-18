<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Adm | Box Enxovais - Cama, Mesa e Banho</title>

  <!-- script do bootstrap -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link href="../assets/img/Box-Enxovais-icon.png" rel="icon">


  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  

<?php
if (isset($_GET['mensagem'])) { ?>
  <div style="display: flex; align-items: center;">
    <img src="../assets/img/warning.png" style="margin-right: -10px; margin-left: 20px">
    <div class="alert alert-light" role="alert" style="border: none; background-color: transparent; margin-top: 10px;">
      <?= $_GET['mensagem'] ?>
    </div>
  </div>
<?php } ?>
  

  <div class="container-fluid">
    <div class="row no-gutter">
      <!-- The image half -->
      <div class="col-md-6 d-none d-md-flex bg-image">
      </div>


      <!-- The content half -->
      <div class="col-md-6 bg-light">
        <div class="login d-flex align-items-center py-5">

          <!-- Demo content-->
          <div class="container">
            <div class="row">
              <div class="col-lg-10 col-xl-7 mx-auto">
                <h3 class="display-4">Bem vindo de volta! </h3>
                <p class="text-muted mb-4">Faça login como administrador para continuar.</p>

                <form method="POST" action="../autenticacaoAdm.php">
                  <div class="form-group mb-3" style="display: flex; align-items: center;">
                    <img src="../assets/img/email-login.png" style="width: 18px; margin-right: 10px;">
                    <input id="inputEmail" type="email" name="email" placeholder="Digite seu email:" required=""
                      autofocus="" class="form-control border-0 shadow-sm px-4" style="border-radius: 10px;">
                  </div>

                  <div class="form-group mb-3"  style="display: flex; align-items: center;">
                  <img src="../assets/img/senha-login.png" style="width: 18px; margin-right: 10px;">
                    <input id="inputPassword" name="senha" type="password" placeholder="Digite sua senha" required=""
                      class="form-control border-0 shadow-sm px-4 text-primary" style="border-radius: 10px;">
                  </div>

                  <div class="custom-control custom-checkbox mb-3">
                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                    <label for="customCheck1" class="custom-control-label">Lembrar senha</label>
                  </div>

                  <input type="submit" class="btn btn-primary btn-block text-uppercase mb-2 shadow-sm"
                    value="login" style="background-color: #cb9897; border: #cb9897; letter-spacing: 2px;">

                  <button class="btn btn-voltar"><a href="../index.php">Voltar</a></button>
                </form>
              </div>
            </div>
          </div><!-- End -->
        </div>
      </div><!-- End -->
    </div>
  </div>
</body>

<script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</script>

</html>


<style>
  * {
    font-family: 'Montserrat';
  }

  .login,
  .image {
    min-height: 100vh;
  }

  .bg-image {
    background-image: url('../assets/img/cobre-leito-juliette-carousel.png');
    background-size: cover;
    background-position: center center;

  }

  .btn-voltar {
    display: inline-block;
    padding: 4px;
    margin-top: -5px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    border: 2px solid #cb9897; 
    border-radius:8px;
    cursor: pointer;
  }

  .btn-voltar:hover {
    border: 2px solid #cb9897;
  }

  .btn-voltar a {
    text-decoration: none;
    text-transform: uppercase;
    color: #4c4d4f;
    letter-spacing: 1px;
  }
</style>