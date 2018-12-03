<div class="menu_usuario_responsivo" id="painel_usuario">
    <div class="idiomas">
        <form method="POST" action="../index.php?lang=ptbr">
            <label for="ptbr_responsivo">
                <img src="icones/ptbr.png" alt="idioma em português">
            </label>

            <input type="submit" id="ptbr_responsivo">
        </form>

        <form method="POST" action="../index.php?lang=en">
            <label for="en_responsivo">
                <img src="icones/usa.png" alt="idioma em inglês">
            </label>

            <input type="submit" id="en_responsivo">
        </form>
    </div>

    <div class="menu_usuario_itens entrar">
        <a href="login.php">
            Entrar
        </a>
    </div>

    <div class="menu_usuario_itens perfil_usuario">
        <a href="perfil.php">
            Perfil
        </a>
    </div>

    <div class="menu_usuario_itens logout">
        <a href="login.php" data-login="<?php echo($login) ?>" onClick="logout()">
            Logout
        </a>
    </div> 
</div>