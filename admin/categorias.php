<?php
require_once "../config/conexion.php";
if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $query = mysqli_query($conexion, "INSERT INTO categorias(categoria) VALUES ('$nombre')");
        if ($query) {
            header('Location: categorias.php');
        }
    }
}
include("includes/header.php");

$query_reporte= "select c.categoria,
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
                group by c.categoria;"
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categorias</h1>
</div>
<section>
    <h3 style="text-align:center;">Reporte del mes</h3>
    <div class="row  justify-content-center">
        <?php
        $query = mysqli_query($conexion, $query_reporte);
        $ticket_promedio=0;
        while ($data = mysqli_fetch_assoc($query)) { 
        ?>
        <div class="col-md-3 card_reporte">
            <div class="">
                <h3 style="text-align:center;"><?php echo $data['categoria']; ?></h3>
                <div class="content">
                    <ul>
                        <li><b>unidades_vendidas: </b> <?php echo $data['unidades_vendidas']; ?>  unidades</li>
                        <li><b>ventas totales: </b> $<?php echo $data['ventas_totales']; ?> MXN</li>
                        <li><b>clientes que compraron: </b><?php echo $data['num_clientes']; ?> clientes</li>
                        <li><b>número de tickets: </b> <?php echo $data['num_tickets']; ?> tickets</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php $ticket_promedio=$data['ticket_promedio_total']; } ?>
    </div>
</section>
<a href="#modal-categorias" class="d-none button button-blue d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo
</a>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table fl-table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT * FROM categorias ORDER BY id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td>
                                <form method="post" action="eliminar.php?accion=cli&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
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

<div id="modal-categorias" class="modal">
    <div class="modal__content">
        <div class="modal-header bg-gradient-primary text-white">
            <h2 class="modal-title" id="title">Nueva Categoria</h2>
        </div>
        <div class="modal-body">
            <form action="" method="POST" autocomplete="off">
                <div class="form__group field">
                    <input type="text" class="form__field" id="nombre" name="nombre" placeholder="Categoria" required />
                    <label for="nombre" class="form__label">Nombre</label>
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