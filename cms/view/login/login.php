<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <link rel="stylesheet" type="text/css" href="view/css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login</title>
        <script src="view/js/jquery.js"></script>
        <script src="view/js/jquery.min.js"></script>
        <script src="view/js/jquery.form.js"></script>
    </head>

    <script>
        $(document).ready(function(){
            $('#login').submit(function(event){
                event.preventDefault();
                
                //armazenando o formulário em uma variável
                var formulario = new FormData($('#login')[0]);

                //passando a variável modo com o parâmetro de logar
                formulario.append('modo', 'logar');

                //passando a variável controller com o parâmetro usuario
                formulario.append('controller', 'usuario');

                $.ajax({
                    type: 'POST',
                    url: 'router.php',
                    data: formulario,
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: true,
                    success: function(resposta){
                        //se o conteúdo da variável resposta for 1, significa que o usuário existe no banco
                        //então, é redirecionado para a home
                        if(resposta == 1){
                            window.location.href="view/home.php";
                        }else{
                            alert("USUARIO OU SENHA INCORRETOS!!");
                        }
                    }
                });
            });
        });

        
    </script>

    <body>
        <div class="main">
            <div class="login">
                <h1>LOGIN<h1>

                <form class="frmLogin" method="POST" id="login">
                    <div class="form_row">
                        <label class="lbl_login">Usuário:</label>
                        <input type="text" class="input" name="txtusuario" required>
                    </div>
                    
                    <div class="form_row">
                        <label class="lbl_login">Senha:</label>
                        <input type="password" class="input" name="txtsenha" required>
                    </div>

                    <button class="btn">ENTRAR</button>
                </form>
            </div>
        </div>
    </body>

</html>