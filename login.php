<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div id="particles-js"></div>
    <div class="first-container">
        <div class="container m-auto p-5 d-flex flex-column justify-content-center align-items-center">
            <div class="m-5 form-container border border-white pt-4 pb-4 pl-5 pr-5 bg-transparent-light">
                <div class="pt-2 pb-2 pl-3 pr-3">
                    <p class="h1 text-center">Login</p>
                    <br>
                    <form class="w-100" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="action" value="login">
                        <div class="form-group">
                            <label for="userinput">Usuario</label>
                            <input name="userinput" type="text" class="form-control" id="userinput" placeholder="Escribe tu usuario">
                        </div>
                        <div class="form-group">
                            <label for="passinput">Password</label>
                            <input name="passinput" type="password" class="form-control" id="passinput" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        <div class="pt-3">
                            <small class="s-1">No estás registrado? <span id="href-signup" class="text-primary">Crear una cuenta</span></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*PER SI DESPRÉS DE ENVIAR EL FORMULARI, REFRESQUEN LA PÀGINA, QUE NO ES TORNI A ENVIAR EL MATEIX FORMULARI, PER NO FER SPAM*/
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="js/particles.js"></script>
    <script src="js/particulas.js"></script>
</body>

</html>