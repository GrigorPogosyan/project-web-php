<?php
include "Middlewares/auth.php";
include "functions/mostrarAlerta.php";

function loginAfterRegister()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['user'] = $_POST['userinput'];
    $_SESSION['status-login'] = "correct";
    $_SESSION['register'] = "true";
    redirigirPagina("index.php");
}
function checkCampsOmplerts()
{
    if (($_POST['userinput']) == "" || ($_POST['passinput']) == "" || ($_POST['passinput2']) == "") {
        return False;
    }
    return True;
}

function contrasenyesIguals()
{
    if ($_POST['passinput'] == ($_POST['passinput2'])) {
        return True;
    }
    return False;
}

function usuariExisteix()
{
    include "database/connexio.php";
    $usuariRegistre = $_POST['userinput'];
    $consulta = "SELECT * FROM usuaris WHERE nom = :usuariRegistre;";
    $stmt = $connexio->prepare($consulta);
    $stmt->execute(array(':usuariRegistre' => $usuariRegistre));
    if ($stmt->rowCount() > 0) {
        return True;
    }
    return False;
}

function registrarUsuari()
{
    include "database/connexio.php";
    $usuariRegistre = $_POST['userinput'];
    $passwordEncriptat = password_hash($_POST['passinput'], PASSWORD_BCRYPT);
    $insert = "INSERT INTO usuaris (nom,password) VALUES (:nom, :passwordEncriptat)";
    $stmt = $connexio->prepare($insert);
    $stmt->execute(array(':nom' => $usuariRegistre, ':passwordEncriptat' => $passwordEncriptat));

    if ($stmt->rowCount() > 0) {
        return True;
    }
    return False;
}
?>
<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <title>Registre</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="particles-js"></div>
    <div class="first-container">
        <div class="container m-auto p-5 d-flex flex-column justify-content-center align-items-center">
            <div class="container m-auto p-5 d-flex flex-column justify-content-center align-items-center">
                <div class="m-5 form-container border border-white pt-4 pb-4 pl-3 pr-3 bg-transparent-light w-50">
                    <div class="pl-4 pt-4 pr-4 w-100">
                        <p class="h1 text-center">Registrar-se</p>
                        <br>
                        <form class="w-100 d-flex flex-column justify-content-center align-items-center" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group w-75">
                                <label for="userinput">Usuari</label>
                                <input name="userinput" type="text" class="form-control" id="userinput" placeholder="Escriu el teu usuari">
                            </div>
                            <div class="form-group w-75">
                                <label for="passinput">Contrasenya</label>
                                <input name="passinput" type="password" class="form-control" id="passinput" placeholder="Escriu la teva contrassenya">
                            </div>
                            <div class="form-group w-75">
                                <label for="passinput2">Repetir Contrasenya</label>
                                <input name="passinput2" type="password" class="form-control" id="passinput2" placeholder="Repeteix la contrassenya">
                            </div>
                            <button type="submit" name="register-submit" class="btn btn-primary w-75 mt-2">Registrar-se</button>
                            <div class="pt-3">
                                <small class="s-1">Ja tens un compte? <a href="login.php"><span id="href-signup" class="text-primary"><u>Inicia Sessió</u></span></small></a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                //Si s'envia el formulari de registre.
                if (isset($_POST['register-submit'])) {
                    //Verifiquem que tots els camps estan omplerts.
                    if (checkCampsOmplerts()) {

                        //Si tots els camps estan omplerts primer verificarem que les 2 contrasenyes son iguals.
                        if (contrasenyesIguals()) {

                            //Comprovarem si l'usuari existeix o no
                            if (usuariExisteix()) {
                                mostrarAlerta("danger", "Ja existeix un usuari amb aquest nom.", "w-50");
                            } else {
                                if (registrarUsuari()) {
                                    loginAfterRegister();
                                }
                            }
                        } else {
                            mostrarAlerta("danger", "Les contrasenyes no coincideixen", "w-50");
                        }
                    } else {
                        mostrarAlerta("danger", "Tots els camps són obligatoris", "w-50");
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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