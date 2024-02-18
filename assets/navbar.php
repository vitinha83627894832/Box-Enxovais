<body>

<!-- Topbar Start -->
<div class="container-fluid bg-dark text-white-50 py-2 px-0 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small>Olá, seja bem vindo!</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <img src="assets/img/phone-icon.png" alt="">
                <small>Atendimento: 0800 656 7846</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <ol class="breadcrumb justify-content-end mb-0" style="margin-top: -5px;">
                <li class="d-inline-block me-2"><a href="https://www.facebook.com/Bellaenx" target="blank"><img src="assets/img/facebook-icon.png" alt=""></a></li>
                <li class="d-inline-block me-2"><a href=""><img src="assets/img/instagram-icon.png" alt=""></a></li>
                <li class="d-inline-block me-2"><a href=""><img src="assets/img/pinterest-icon.png" alt=""></a></li>
                <li class="d-inline-block me-2"><a href=""><img src="assets/img/tik-tok-icon.png" alt=""></a></li>
            </ol>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg px-4 px-lg-5 bg-white">
    <div class="d-flex align-items-center">
        <a href="index.html"><img src="assets/img/Box-Enxovais.png" alt="Logo" class="navbar-logo mr-5"></a>
    </div>

    <!--search box-->
    <div class="search-container">
        <form action="">
            <div class="bloco-icone">
                <input type="text" class="search-box" placeholder="O que você procura?">
                <button class="search-button">
                    <img src="assets/img/search.png" alt="Pesquisar">
                </button>
            </div>
        </form>
    </div>

    <!-- Navigation items -->



    <div class="container mt-4">
        <div class="d-flex flex-column flex-sm-row justify-content-end align-items-center">
            <nav class="dp-menu">
                <ul>
                    <li>
                        <a href=""><img src="assets/img/user.png" alt="Usuário">
                            <span class="account-color">Minha conta</span></a>
                        <ul>
                            <li>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" style="margin: 10px 0 0 0; text-align: center;">
                                    Fazer login</button>
                                <div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bem vindo(a) de volta</h5>
                                                <div class="custom-line"></div>
                                                <span class="modal-subtitle">Faça login para continuar!</span>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div> <!--modal header close-->
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3 mt-4">
                                                        <div class="form-item-icon">
                                                            <img src="assets/img/email-login.png" alt="">
                                                            <input type="email" class="form-control" placeholder="Email" id="emailForm" autofocus required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-item-icon">
                                                            <img src="assets/img/senha-login.png" alt="">
                                                            <input type="password" class="form-control" placeholder="Senha" id="passwordForm" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-item">
                                                        <input type="checkbox" class="form-check-input" id="rememberCheckbox">
                                                        <label class="form-check-label" for="rememberCheckbox">Lembrar senha</label>
                                                    </div>
                                                    <div class="form-item">
                                                        <span class="forgot-password-link">Esqueceu a senha?</span>
                                                    </div>
                                                </form>
                                            </div> <!--modal-body close-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">Login</button>
                                            </div> <!--modal-footer close-->
                                        </div> <!--modal content close-->
                                    </div> <!--modal dialog-close-->
                                </div> <!--modal fade close-->
                            </li>
                            <hr class="header-divider-dp-menu">
                            <li>
                                <a href="adm/cadUsuario.php">
                                    <span class="text-cad">Novo aqui? Cadastre-se</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav> <!--dp-menu close-->
            <div>
                <img src="assets/img/cart.png" alt="Sacola de Compras" class="ml-2" style="height: 35px;">
            </div>
        </div>
    </div>
</nav> <!--navbar close-->

<nav class="navbar sticky-top ">
    <ul>
        <li><a href="cama.php">Cama</a>
            <div class="mega-menu">
                <h3>Cama</h3>
                <hr class="hr-mega-menu">
                <a href="edredom-malha.php">
                    <span>
                        <img src="assets/img/arrow.png" style="width: 16px;">
                        <a style="color: #4c4d4f;" href="edredom-malha.php">Edredom Malha</span></a>
                </a>
                <a href="cobre-leito-malha.php">
                    <span>
                        <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                        <a style="color: #4c4d4f;" href="cobre-leito-malha.php">Cobre Leito Malha</span></a>
                </a>
            </div>
        </li>
        <li><a href="travesseiro.php">Travesseiros</a></li>
        <li><a href="toalha.php">Toalhas</a>
            <div class="mega-menu">
                <h3>Toalhas</h3>
                <hr class="hr-mega-menu">
                <a href="#">
                    <span>
                        <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                        <a style="color: #4c4d4f;" href="toalha-rosto-corpo.php"> Toalhas de Rosto e Corpo</span></a>
                </a>
                <a href="#">
                    <span>
                        <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                        <a style="color: #4c4d4f;" href="toalha-piso.php">Toalhas de Piso</span></a>
                </a>
            </div>
        </li>
        <li><a href="almofada.php">Almofadas</a>
            <div class="mega-menu">
                <h3>Almofadas</h3>
                <hr class="hr-mega-menu">
                <a href="#">
                    <span>
                        <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                        <a style="color: #4c4d4f;" href="almofadas.php">Almofadas</span></a>
                </a>
                <a href="#">
                    <span>
                        <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                        <a style="color: #4c4d4f;" href="cortina.php">Cortinas</span></a>
                </a>
            </div>
        </li>
        <li><a href="mesa.php">Mesa</a></li>
    </ul>
</nav>