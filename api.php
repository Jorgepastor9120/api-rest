<?php
require 'conexion.php';

if ( !isset( $_SERVER['HTTP_X_USER'] ) || empty( $_SERVER['HTTP_X_USER'] ) || !isset( $_SERVER['HTTP_X_PW'] ) || empty( $_SERVER['HTTP_X_PW'] ) ) {
    http_response_code( 400 );
    die;
}

$_SERVER['HTTP_X_USER'] = trim( strip_tags( $_SERVER['HTTP_X_USER'] ) );
$_SERVER['HTTP_X_PW'] = trim( strip_tags( $_SERVER['HTTP_X_PW'] ) );

$SQL_usuario = "SELECT id_usuario FROM usuarios WHERE nombre = '{$_SERVER['HTTP_X_USER']}' AND passwd  = '{$_SERVER['HTTP_X_PW']}'";
$RESULT_usuario = $mysqli->query($SQL_usuario);
$ROW_usuario = mysqli_fetch_array($RESULT_usuario);

if ( !isset( $ROW_usuario['id_usuario'] ) ) {
    
    http_response_code( 400 );
    die;
    
}

// Definimos los recursos disponibles
$allowedResourceType = [
    'productos'
];

// Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if ( !isset( $resourceType ) || !in_array ( $resourceType, $allowedResourceType ) ) {
    
    echo "Es necesario solicitar un recurso";
    
}

header( 'Content-Type: application/json');

$resourceid = array_key_exists( 'resource_id', $_GET ) ? $_GET['resource_id'] : '';

// Generamos la respuesta asumiendo que el pedido es correcto
switch ( strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {

    case 'GET':
        if ( empty( $resourceid ) ) {

            //Si no se pide ningún Id se muestran todas las lineas
            $SQL_productos = "SELECT * FROM productos";
            $RESULT_productos = $mysqli->query($SQL_productos);
            $ROW_productos = mysqli_fetch_array($RESULT_productos);

            echo json_encode( $ROW_productos );

        } else {

            //Si se pide un Id se muestra solo esa linea, comprobando además que el id existe en la tabla
            $SQL_productos = "SELECT * FROM productos WHERE id_producto = '$resourceid'";
            $RESULT_productos = $mysqli->query($SQL_productos);
            $ROW_productos = mysqli_fetch_array($RESULT_productos);

            if ( !empty( $ROW_productos) ) {
                
                echo json_encode( $ROW_productos );
                
            } else {
                
                echo "Esta Id no existe";
                
            }

        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');

        $producto = json_decode( $json, true);
        
        $producto['nombre'] = trim( strip_tags( $producto['nombre'] ) );
        $producto['categoria'] = trim( strip_tags( $producto['categoria'] ) );
        $producto['precio_iva_excl'] = trim( strip_tags( $producto['precio_iva_excl'] ) );
        $producto['id_iva'] = trim( strip_tags( $producto['id_iva'] ) );
        $producto['fecha_add'] = trim( strip_tags( $producto['fecha_add'] ) );
        $producto['fecha_upd'] = trim( strip_tags( $producto['fecha_upd'] ) );

        $mysqli->query(
            "INSERT INTO productos (nombre,categoria,precio_iva_excl,id_iva,fecha_add,fecha_upd) VALUES ('{$producto['nombre']}','{$producto['categoria']}','{$producto['precio_iva_excl']}','{$producto['id_iva']}','{$producto['fecha_add']}','{$producto['fecha_upd']}')"
        );
        
        $SQL_producto = "SELECT * FROM productos WHERE nombre = '{$producto['nombre']}' ORDER BY id_producto DESC LIMIT 1";
        $RESULT_producto = $mysqli->query($SQL_producto);
        $ROW_producto = mysqli_fetch_array($RESULT_producto);
        
        echo json_encode( $ROW_producto );
        
        break;
    case 'PUT':
        if ( !empty( $resourceid ) ) {
            
            $json = file_get_contents('php://input');

            $producto = json_decode($json, true);

            $SQL_producto = "SELECT id_producto FROM productos WHERE id_producto = '$resourceid'";
            $RESULT_producto = $mysqli->query($SQL_producto);
            $ROW_producto = mysqli_fetch_array($RESULT_producto);
            
            if ( isset( $ROW_producto ) ) {
                
                $producto['nombre'] = trim( strip_tags( $producto['nombre'] ) );
                $producto['categoria'] = trim( strip_tags( $producto['categoria'] ) );
                $producto['precio_iva_excl'] = trim( strip_tags( $producto['precio_iva_excl'] ) );
                $producto['id_iva'] = trim( strip_tags( $producto['id_iva'] ) );
                $producto['fecha_upd'] = trim( strip_tags( $producto['fecha_upd'] ) );
                
                $mysqli->query(
                    "UPDATE productos SET nombre = '{$producto['nombre']}', categoria = '{$producto['categoria']}', precio_iva_excl = '{$producto['precio_iva_excl']}', id_iva = '{$producto['id_iva']}', fecha_upd = '{$producto['fecha_upd']}' WHERE  id_producto = '$resourceid'"
                );
                
            }
        
        }
        
        break;
    case 'DELETE':
        if ( !empty( $resourceid ) ) {

            $mysqli->query(
                "DELETE FROM productos WHERE id_producto = '$resourceid'"
            );

        }
        
        break;

}

?>