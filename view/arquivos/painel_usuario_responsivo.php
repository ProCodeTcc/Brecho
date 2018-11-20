<div class="menu_usuario_responsivo" id="painel_usuario">
    <div class="idiomas">
        <img src="view/icones/ptbr.png">
        <img src="view/icones/usa.png">
    </div>

    <div class="menu_usuario_itens entrar">
        <a href="view/login.php">
            Entrar
        </a>
    </div>

    <div class="menu_usuario_itens perfil_usuario">
        <a href="view/perfil.php">
            Perfil
        </a>
    </div>

    <div class="menu_usuario_itens logout">
        <a href="view/login.php" data-login="<?php echo($login) ?>" onClick="logout()">
            Logout
        </a>
    </div> 
</div>