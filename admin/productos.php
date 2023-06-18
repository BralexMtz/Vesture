<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $p_normal = $_POST['p_normal'];
        $p_rebajado = $_POST['p_rebajado'];
        $categoria = $_POST['categoria'];
        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../assets/img/" . $foto;
        $query = mysqli_query($conexion, "INSERT INTO productos(nombre, descripcion, precio_normal, precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre', '$descripcion', '$p_normal', '$p_rebajado', $cantidad, '$foto', $categoria)");
        if ($query) {
            if (move_uploaded_file($tmpname, $destino)) {
                header('Location: productos.php');
            }
        }
    }
}
include("includes/header.php"); 

$query_reporte = "select 
count(vp.producto_id) as unidades_vendidas,
sum(p.precio_rebajado) as ventas_totales,
count( distinct v.email) as num_clientes,
count( distinct v.venta_id) as num_tickets,
( select avg(a.precio_ticket) as ticket_promedio
    from(
        select  
            v.venta_id as ticket,
            sum(p.precio_rebajado) as precio_ticket
        from venta v 
        inner join venta_producto vp
        on v.venta_id =vp.venta_id 
        inner join productos p 
        on vp.producto_id =p.id 
        where MONTH(v.fecha) = MONTH(now())
           and YEAR(v.fecha) = YEAR(now())
        group by v.venta_id
    ) a
) as ticket_promedio_total
from venta v 
inner join venta_producto vp
on v.venta_id =vp.venta_id 
inner join productos p 
on vp.producto_id =p.id 
inner join categorias c 
on p.id_categoria = c.id
where MONTH(v.fecha) = MONTH(now())
   and YEAR(v.fecha) = YEAR(now())
limit 1;"

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
</div>

<section>
    <h3 style="text-align:center;">Reporte del mes</h3>
    <div class="row  justify-content-center">
        <?php
        $query = mysqli_query($conexion, $query_reporte);
        $ticket_promedio=0;
        while ($data = mysqli_fetch_assoc($query)) { 
            foreach ($data as $key => $value){
        ?>
        <div class="col-md-3 card_reporte">
            <div class="">
                <h3 style="text-align:center;"><?php echo str_replace("_"," ",$key); ?></h3>
                <div class="content" >
                    <h2 style="text-align:center;"><?php echo $value; ?></h2>
                </div>
            </div>
        </div>
        <?php  }} ?>
    </div>
</section>
<a href="#modal-productos" class=" button button-blue " id="abrirProducto">
    <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo
</a>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table fl-table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Normal</th>
                        <th>Precio Rebajado</th>
                        <th>Cantidad</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><img class="img-thumbnail" src="../assets/img/<?php echo $data['imagen']; ?>" width="50"></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['descripcion']; ?></td>
                            <td><?php echo $data['precio_normal']; ?></td>
                            <td><?php echo $data['precio_rebajado']; ?></td>
                            <td><?php echo $data['cantidad']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td>
                                <form method="post" action="eliminar.php?accion=pro&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
                                    <button class="button button-red" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal-productos" class="modal">
    <div class="modal__content">
        <div class="modal-header bg-gradient-primary text-white">
            <h2 class="modal-title" id="title">Nuevo Producto</h2>
        </div>
        <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                        <div class="col-md-6">
                            <div class="form__group field">
                                <input type="text" class="form__field" id="nombre" name="nombre" placeholder="Categoria" required />
                                <label for="nombre" class="form__label">Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form__group field">
                                <input type="text" class="form__field" id="cantidad" name="cantidad" placeholder="Cantidad" required />
                                <label for="cantidad" class="form__label">Cantidad</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form__group field">
                                <textarea class="form__field" id="descripcion" name="descripcion" placeholder="Descripción" rows="3"  required ></textarea>
                                <label for="descripcion" class="form__label">Descripción</label>
                            </div>
                            <!-- <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="form__group field">
                                <input type="text" class="form__field" id="p_normal" name="p_normal" placeholder="p_normal" required />
                                <label for="p_normal" class="form__label">Precio Normal</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form__group field">
                                <input type="text" class="form__field" id="p_rebajado" name="p_rebajado" placeholder="p_rebajado" required />
                                <label for="p_rebajado" class="form__label">Precio Rebajado</label>
                            </div>
                            <!-- <div class="form-group">
                                <label for="p_rebajado">Precio Rebajado</label>
                                <input id="p_rebajado" class="form-control" type="text" name="p_rebajado" placeholder="Precio Rebajado" required>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="form__group field">
                                <label for="categoria" class="form__label">Precio Categoria</label>
                                <select type="text" class="form__field" id="categoria" name="categoria" placeholder="categoria" required>
                                <?php
                                    $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
                                    foreach ($categorias as $cat) { 
                                ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                                <?php } 
                                ?>
                                </select>
                            </div>
                         
                        </div>
                        <div class="col-md-6">
                            <div class="form__group field">
                                <input type="file" class="form__field" id="imagen" name="foto" placeholder="imagen" required />
                                <label for="imagen" class="form__label">Foto</label>
                            </div>
                           
                        </div>
                </div>
                <div class="row d-flex end">
                    <button class="button button-blue" type="submit">Registrar</button>
                </div>
            </form>
        </div>
        <a href="#" class="modal__close">&times;</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>