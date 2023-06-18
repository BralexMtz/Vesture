<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: productos.php');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "../config/conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
            $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$clave'");
            mysqli_close($conexion);
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['id'] = $dato['id'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['user'] = $dato['usuario'];
                header('Location: productos.php');
            } else {
                $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/sb-admin-2.min.css"> -->
    <link rel="stylesheet" href="../assets/css/style_login_admin.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" />
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden shadow-lg" style="width: 50%;margin: auto;border: 0;margin-top: 3rem;margin-bottom: 3rem">
                    <div class="card-body" style="padding: 0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-lg-block " style="display: none;">
                                <img class="img-thumbnail" src="../assets/img/logo.jpg" alt="" width="100%">
                            </div>
                            <div class="col-lg-6">
                                <div style="padding: 3rem">
                                    <div class="">
                                        <h2 class="">Hola Administrador!</h2>
                                        <?php echo (isset($alert)) ? $alert : ''; ?>
                                    </div>
                                    <form class="user" method="POST" action="" autocomplete="off">
                                        <div class="form__group field">
                                            <input type="text" class="form__field" id="usuario" name="usuario" placeholder="Usuario..." required />
                                            <label for="usuario" class="form__label">Usuario</label>
                                        </div>
                                        <div class="form__group field">
                                            <input type="password" class="form__field" id="clave" name="clave" placeholder="Password" required />
                                            <label for="clave" class="form__label">Contraseña</label>
                                        </div>
                                        <button type="submit" class="button">
                                            Iniciar sesión
                                        </button>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="../assets/js/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="../assets/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="../assets/js/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="../assets/js/sb-admin-2.min.js"></script> -->

</body>

</html>