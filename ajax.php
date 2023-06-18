<?php
require_once "config/conexion.php";
if (isset($_POST)) {
    if ($_POST['action'] == 'buscar') {
        $array['datos'] = array();
        $total = 0;
        for ($i=0; $i < count($_POST['data']); $i++) { 
            $id = $_POST['data'][$i]['id'];
            $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
            $result = mysqli_fetch_assoc($query);
            $data['id'] = $result['id'];
            $data['precio'] = $result['precio_rebajado'];
            $data['nombre'] = $result['nombre'];
            $total = $total + $result['precio_rebajado'];
            array_push($array['datos'], $data);
        }
        $array['total'] = $total;
        echo json_encode($array);
        die();
    } elseif($_POST['action'] == 'comprar'){
        $nombre = ($_POST['nombre'])?$_POST['nombre']:NULL;
        $apellido_paterno = ($_POST['apellido_paterno'])?$_POST['apellido_paterno']:NULL;
        $apellido_materno = ($_POST['apellido_materno'])?$_POST['apellido_materno']:NULL;
        $correo = ($_POST['correo'])?$_POST['correo']:NULL;
        $last_id = 0;
        $query = " INSERT INTO `venta`(`nombre`, `apellido_paterno`, `apellido_materno`, `email`) VALUES (?,?,?,?);";
        if ($stmt = mysqli_prepare($conexion,$query)){
            mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido_paterno, $apellido_materno,$correo);
            if(mysqli_stmt_execute($stmt)){
                $last_id = mysqli_insert_id($conexion);
                if($_POST['productos']){
                    $arr_productos =json_decode( $_POST['productos'], true );
                    foreach ( $arr_productos as &$valor){
                        $valor['id'];
                        $query= "INSERT INTO `venta_producto`( `venta_id`, `producto_id`) VALUES (?,?);";
                        if ($stmt = mysqli_prepare($conexion,$query)){
                            mysqli_stmt_bind_param($stmt, "ii", $last_id,$valor['id']);
                            if(!mysqli_stmt_execute($stmt)){
                                http_response_code(500);
                                die( mysqli_error($conexion));
                            }
                        }else{
                            http_response_code(500);
                            die( mysqli_error($conexion));
                        }
                    }
                    echo "Comprado con éxito";
                }else{
                    http_response_code(402);
                    die("No hay productos");
                }        
            }else{
                http_response_code(500);
                echo mysqli_error($conexion);
            }
        }else{
            http_response_code(500);
            echo mysqli_error($conexion);
        }
        
        

    }
}

?>