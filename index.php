<?php require_once "config/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link href="assets/css/estilos.css" rel="stylesheet" />
    <link href="assets/css/estiloindexone.css" rel="stylesheet" />
</head>

<body>
    <a href="#" class="btn-flotante" id="btnCarrito">Carrito <span class="badge bg-success" id="carrito">0</span></a>
        <nav>
            <ul class="navbar-nav">
                <a></a>
                <a href="#" class="nav-link text-info" category="all">Todo</a>
                <a href="admin\index.php" class="nav-link" style="margin-right:28%" >Admin</a>
                <?php
                $query = mysqli_query($conexion, "SELECT * FROM categorias");
                while ($data = mysqli_fetch_assoc($query)) { ?>
                    <a href="#" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
                <?php } ?>
            </ul>
        </nav>
        <!-- Header-->
        <div style=" background-color: #8CC4FF ; text-align: center ;padding: 0% ; margin-bottom : 10 px">

        <div style="width:100%;height:0px;position:relative;padding-bottom:56.250%;"><iframe src="https://streamable.com/e/t5wqzj?nocontrols=1" frameborder="0" width="100%" height="100%" allowfullscreen style="width:100%;height:100%;position:absolute;left:0px;top:0px;overflow:hidden;"></iframe></div>
            <audio src="./assets/video/audio_video.m4a"></audio>
            <!-- <video width="640" controls>    
                <source src="http://techslides.com/demos/sample-videos/small.ogv" type=video/ogg>
                <source src="/build/videos/arcnet.io(7-sec).mp4" type=video/mp4>
            </video> -->
            <section>
            <br>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <img style="margin-bottom:2rem;" width="50%" src="./assets/img/moda_sustentable.jpg" alt="Moda sustentable" srcset="">
                    </div>
                    <div class="col-md-6 container-info" style="vertical-align: middle;">
                        <p class="text-informative">Somos una empresa socialmente responsable con el planeta y comprometida con el bienestar social a través de nuestros productos y la moda sostenible o sustentable</p>
                        <a class="button button-blue" target="_blank" href="https://www.vogue.mx/sustentabilidad/articulo/moda-sustentable-guia-definitiva-de-vogue-consejos-y-tips">
                             Descubre más acerca de la moda sustentable haciendo click aquí
                        </a>                        
                    </div>
                </div>
            </section>
        </div>
    <!-- Productos -->
    <section style="margin-top: 20px">
        <div class="container3 px-4 ">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <div class="productos" style="column-gap: normal ; text-align: center !important" category="<?php echo $data['categoria']; ?>">
                            <div class="card">
                                <div class="header-card">
                                    <img class="img-card-top" style ="text-align: center !important" src="assets/img/<?php echo $data['imagen']; ?>" alt="..." />
                                </div>
                                
                                <div class = "container" style="-ms-flex: 1 1 auto;
                                            flex: 1 1 auto;
                                            min-height: 1px;
                                            padding: 1.25rem;">
                                    <div style="text-align: center !important">
                                        <!-- Product name-->
                                        <h5><?php echo $data['nombre'] ?></h5>
                                        <p><?php echo $data['descripcion']; ?></p>
                                        <!-- Product price-->
                                        <span><?php echo $data['precio_normal'] ?></span>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div style="padding-bottom: 20px;">
                                    <a class="btn button-blue agregar" data-id="<?php echo $data['id']; ?>" href="#">Agregar</a>
                                </div>
                            </div>
                        </div>
                <?php  }
                } ?>

            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer>
        <p>Autores: Oswaldo Cabrera Pérez, Oscar Casasola García y Brayan Alexis<br>
        <a href="mailto:hege@example.com">hege@example.com</a></p>
    </footer>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        
    </script>
</body>

</html>