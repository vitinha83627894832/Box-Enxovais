<?php if (isset($mensagemErro)) { ?>
    <div class="alert alert-danger" role="alert">
        <i class="fa-solid fa-square-check"></i>
        <?= $mensagemErro ?>
    </div>
<?php } ?>